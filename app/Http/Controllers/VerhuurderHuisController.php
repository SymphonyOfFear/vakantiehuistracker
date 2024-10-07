<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Vakantiehuis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class VerhuurderHuisController extends Controller
{
    public function dashboard()
    {
        return view('verhuurder.dashboard');
    }

    public function index()
    {
        $verhuurderId = Auth::id();
        $mijnHuizen = Vakantiehuis::where('verhuurder_id', $verhuurderId)->with('images')->get();
        return view('verhuurder.huizen.index', compact('mijnHuizen'));
    }

    public function create()
    {

        return view('verhuurder.huizen.create', ['vakantiehuis' => new Vakantiehuis()]);
    }

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

    public function show($id)
    {
        $vakantiehuis = Vakantiehuis::findOrFail($id);
        return view('verhuurder.huizen.show', compact('vakantiehuis'));
    }

    public function edit($id)
    {
        $vakantiehuis = Vakantiehuis::findOrFail($id);
        return view('verhuurder.huizen.edit', compact('vakantiehuis'));
    }

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
            'fotos' => 'nullable|array',
            'fotos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'deleted_fotos' => 'nullable|array',  // Ensure 'deleted_fotos' is present
            'deleted_fotos.*' => 'nullable|string',
        ]);

        // Update the vacation house
        $vakantiehuis->update($validatedData);

        // Check if there are deleted_fotos URLs to process
        if ($request->has('deleted_fotos') && is_array($request->deleted_fotos)) {
            foreach ($request->deleted_fotos as $deletedFotoUrl) {
                if ($deletedFotoUrl) {  // Make sure it's not null
                    // Convert the URL to the stored path and find the image record
                    $image = Image::where('url', $deletedFotoUrl)->first();

                    if ($image) {
                        // Delete the file from storage and the database record
                        Storage::delete(str_replace('/storage', 'public', $image->url));
                        $image->delete();

                        Log::info("Deleted image URL: " . $deletedFotoUrl);
                    }
                }
            }
        }

        // Handle new image uploads if present
        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $foto) {
                if ($foto->isValid()) {
                    $path = $foto->store('public/fotos');
                    $url = Storage::url($path);
                    $vakantiehuis->images()->create(['url' => $url]);
                }
            }
        }

        return redirect()->route('verhuurder.huizen.index')->with('success', 'Vakantiehuis succesvol bijgewerkt.');
    }









    public function destroy($id)
    {
        $vakantiehuis = Vakantiehuis::findOrFail($id);
        $vakantiehuis->delete();

        return redirect()->route('verhuurder.huizen.index')->with('success', 'Vakantiehuis succesvol verwijderd.');
    }
}
