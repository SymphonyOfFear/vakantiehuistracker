<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Vakantiehuis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VerhuurderHuisController extends Controller
{
    // Display the dashboard for the landlord
    public function dashboard()
    {
        return view('verhuurder.dashboard');
    }

    // Display a list of the landlord's vacation homes
    public function index()
    {
        $verhuurderId = Auth::id();
        $mijnHuizen = Vakantiehuis::where('verhuurder_id', $verhuurderId)->with('images')->get();
        return view('verhuurder.huizen.index', compact('mijnHuizen'));
    }

    // Display the create page for adding a new vacation home
    public function create()
    {
        return view('verhuurder.huizen.create', ['vakantiehuis' => new Vakantiehuis()]);
    }

    // Store a new vacation home
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'naam' => 'required|string|max:255',
            'prijs' => 'required|numeric',
            'beschrijving' => 'nullable|string',
            'slaapkamers' => 'required|integer',
            'stad' => 'required|string',
            'straatnaam' => 'required|string',
            'postcode' => 'required|string',
            'huisnummer' => 'required|string',
            'fotos' => 'required|array',
            'fotos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $vakantiehuis = Vakantiehuis::create([
                'verhuurder_id' => Auth::id(),
                'naam' => $validatedData['naam'],
                'prijs' => $validatedData['prijs'],
                'beschrijving' => $validatedData['beschrijving'],
                'slaapkamers' => $validatedData['slaapkamers'],
                'stad' => $validatedData['stad'],
                'straatnaam' => $validatedData['straatnaam'],
                'postcode' => $validatedData['postcode'],
                'huisnummer' => $validatedData['huisnummer'],
                'latitude' => null,
                'longitude' => null,
                'wifi' => $request->has('wifi'),
                'zwembad' => $request->has('zwembad'),
                'parkeren' => $request->has('parkeren'),
                'speeltuin' => $request->has('speeltuin'),
                'beschikbaarheid' => $request->boolean('beschikbaarheid'),
            ]);

            if ($request->hasFile('fotos')) {
                foreach ($request->file('fotos') as $foto) {
                    if ($foto->isValid()) {
                        $path = $foto->store('public/fotos');
                        $url = Storage::url($path);
                        Image::create([
                            'url' => $url,
                            'vakantiehuis_id' => $vakantiehuis->id,
                        ]);
                    }
                }
            }

            return redirect()->route('verhuurder.huizen.index')->with('success', 'Vakantiehuis succesvol toegevoegd.');
        } catch (\Exception $e) {
            Log::error("Fout bij opslaan van vakantiehuis: " . $e->getMessage());
            return back()->with('error', 'Er is een fout opgetreden bij het opslaan van het vakantiehuis: ' . $e->getMessage());
        }
    }

    // Show the details of a vacation home
    public function show($id)
    {
        $vakantiehuis = Vakantiehuis::findOrFail($id);
        return view('verhuurder.huizen.show', compact('vakantiehuis'));
    }

    // Display the edit page for a vacation home
    public function edit($id)
    {
        $vakantiehuis = Vakantiehuis::findOrFail($id);
        return view('verhuurder.huizen.edit', compact('vakantiehuis'));
    }

    // Update a vacation home
    public function update(Request $request, $id)
    {
        $vakantiehuis = Vakantiehuis::findOrFail($id);

        $validatedData = $request->validate([
            'naam' => 'required|string|max:255',
            'prijs' => 'required|numeric',
            'beschrijving' => 'nullable|string',
            'slaapkamers' => 'required|integer',
            'stad' => 'required|string',
            'straatnaam' => 'required|string',
            'postcode' => 'required|string',
            'huisnummer' => 'required|string',
            'wifi' => 'boolean',
            'zwembad' => 'boolean',
            'parkeren' => 'boolean',
            'speeltuin' => 'boolean',
            'beschikbaarheid' => 'boolean',
            'fotos' => 'nullable|array',
            'fotos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'deleted_fotos' => 'nullable|array',
            'deleted_fotos.*' => 'nullable|string',
        ]);

        Log::info('Vakantiehuis wordt bijgewerkt, ID: ' . $id, $validatedData);

        // Update the vacation house data
        $vakantiehuis->update($validatedData);

        // Handle deleted photos
        if ($request->has('deleted_fotos') && is_array($request->deleted_fotos)) {
            foreach ($request->deleted_fotos as $deletedFotoUrl) {
                if (!empty($deletedFotoUrl)) {
                    Log::info("Processing deletion for URL: " . $deletedFotoUrl);
                    $image = Image::where('url', $deletedFotoUrl)->first();
                    if ($image) {
                        Log::info("Found image with URL: " . $image->url . ", Deleting...");
                        Storage::delete(str_replace('/storage', 'public', $image->url));
                        $image->delete();
                        Log::info("Deleted image with URL: " . $deletedFotoUrl);
                    } else {
                        Log::warning("No image found with URL: " . $deletedFotoUrl);
                    }
                }
            }
        }

        // Handle new image uploads
        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $foto) {
                if ($foto->isValid()) {
                    $path = $foto->store('public/fotos');
                    $url = Storage::url($path);
                    $vakantiehuis->images()->create(['url' => $url]);
                    Log::info("New image added with URL: " . $url);
                }
            }
        }

        return redirect()->route('verhuurder.huizen.index')->with('success', 'Vakantiehuis succesvol bijgewerkt.');
    }

    // Delete a vacation home
    public function destroy($id)
    {
        $vakantiehuis = Vakantiehuis::findOrFail($id);

        // Delete associated images from storage and database
        foreach ($vakantiehuis->images as $image) {
            Storage::delete(str_replace('/storage', 'public', $image->url));
            $image->delete();
        }

        // Delete the vacation home record
        $vakantiehuis->delete();

        return redirect()->route('verhuurder.huizen.index')->with('success', 'Vakantiehuis succesvol verwijderd.');
    }
}
