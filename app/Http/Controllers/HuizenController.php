<?php

namespace App\Http\Controllers;

use App\Models\Vakantiehuis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class HuizenController extends Controller
{
    // Function to show the index page of the houses
    public function index()
    {
        $vakantiehuizen = Vakantiehuis::with('images')->get();
        return view('huizen.index', compact('vakantiehuizen'));
    }
    public function show($id)
    {
        try {
            // Retrieve the vacation house by its ID
            $vakantiehuis = Vakantiehuis::with('images', 'recensies')->findOrFail($id);

            // Return the view for the show page with the vakantiehuis data
            return view('huizen.show', compact('vakantiehuis'));
        } catch (\Exception $e) {
            // Log and redirect back if any exception occurs
            Log::error("Error displaying vakantiehuis with ID $id: " . $e->getMessage());
            return redirect()->route('huizen.index')->with('error', 'Vakantiehuis niet gevonden of een fout opgetreden.');
        }
    }
    // Function to show the form for creating a new house
    public function create()
    {


        return view('huizen.create');
    }

    // Function to store a new house in the database
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
            'fotos' => 'nullable|array',
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

            // Save uploaded images if any
            if ($request->hasFile('fotos')) {
                foreach ($request->file('fotos') as $foto) {
                    if ($foto->isValid()) {
                        $path = $foto->store('public/fotos');
                        $url = Storage::url($path);

                        $vakantiehuis->images()->create([
                            'url' => $url,
                        ]);
                    }
                }
            }

            return redirect()->route('huizen.index')->with('success', 'Vakantiehuis succesvol toegevoegd.');
        } catch (\Exception $e) {
            Log::error('Error storing vakantiehuis: ' . $e->getMessage());
            return back()->with('error', 'Er is een fout opgetreden bij het opslaan van het vakantiehuis.');
        }
    }

    // Function to show the edit page for a specific house
    public function edit($id)
    {
        $vakantiehuis = Vakantiehuis::findOrFail($id);




        return view('huizen.edit');
    }

    // Function to update an existing house in the database
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
        ]);

        try {
            $vakantiehuis->update($validatedData);

            // Handle images
            if ($request->hasFile('fotos')) {
                // Delete old images if any
                $vakantiehuis->images()->delete();
                foreach ($request->file('fotos') as $foto) {
                    if ($foto->isValid()) {
                        $path = $foto->store('public/fotos');
                        $url = Storage::url($path);

                        $vakantiehuis->images()->create(['url' => $url]);
                    }
                }
            }

            return redirect()->route('huizen.index')->with('success', 'Vakantiehuis succesvol bijgewerkt.');
        } catch (\Exception $e) {
            Log::error('Error updating vakantiehuis: ' . $e->getMessage());
            return back()->with('error', 'Er is een fout opgetreden bij het bijwerken van het vakantiehuis.');
        }
    }

    // Function to delete a house from the database
    public function destroy($id)
    {
        $vakantiehuis = Vakantiehuis::findOrFail($id);
        $vakantiehuis->delete();

        return redirect()->route('huizen.index')->with('success', 'Vakantiehuis succesvol verwijderd.');
    }
}
