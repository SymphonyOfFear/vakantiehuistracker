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
    // Toon het dashboard voor de verhuurder
    public function dashboard()
    {
        return view('verhuurder.dashboard');
    }

    // Haal alle huizen van de ingelogde verhuurder op en toon ze in de index
    public function index()
    {
        $verhuurderId = Auth::id(); // Verkrijg het ID van de ingelogde verhuurder
        $mijnHuizen = Vakantiehuis::where('verhuurder_id', $verhuurderId)->with('images')->get(); // Haal huizen op met hun gekoppelde afbeeldingen

        return view('verhuurder.huizen.index', compact('mijnHuizen'));
    }

    // Toon het formulier voor het toevoegen van een nieuw vakantiehuis
    public function create()
    {
        // Haal locaties op van de API
        $response = Http::get('http://api.geonames.org/searchJSON', [
            'formatted' => 'true',
            'country' => 'NL',
            'featureClass' => 'P',
            'maxRows' => 1000,
            'username' => 'Keiji',
        ]);

        $locations = $response->json();
        $locations = $locations['geonames'] ?? [];

        return view('verhuurder.huizen.create', compact('locations'));
    }

    // Sla een nieuw vakantiehuis op met de ingevoerde gegevens en geüploade afbeeldingen
    public function store(Request $request)
    {
        // Validatie voor een enkele afbeelding (gebruik 'foto' i.p.v. 'fotos')
        $validatedData = $request->validate([
            'naam' => 'required|string|max:255',
            'prijs' => 'required|numeric',
            'beschrijving' => 'nullable|string',
            'slaapkamers' => 'required|integer',
            'stad' => 'required|string',
            'straatnaam' => 'required|string',
            'postcode' => 'required|string',
            'huisnummer' => 'required|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Specificeer 'foto' voor validatie
        ]);

        try {
            // Debug log voor input data
            Log::info('Request Data: ', $request->all());
            Log::info('File Data: ', [$request->file('foto')]);

            // Niewe vakantiehuis maken
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

            // Controleer of er een bestand is geüpload
            if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
                $file = $request->file('foto');
                $path = $file->store('public/fotos');
                $url = Storage::url($path);

                // Log de URL voor debugging
                Log::info('Uploaded File URL: ' . $url);

                // Maak een nieuw Image-model aan
                Image::create([
                    'url' => $url,
                    'vakantiehuis_id' => $vakantiehuis->id,
                ]);
            }

            return redirect()->route('verhuurder.huizen.index')->with('success', 'Vakantiehuis succesvol toegevoegd.');
        } catch (\Exception $e) {
            Log::error("Error storing vakantiehuis: " . $e->getMessage());
            return back()->with('error', 'Er is een fout opgetreden bij het opslaan van het vakantiehuis: ' . $e->getMessage());
        }
    }


    // Toon de details van een specifiek vakantiehuis
    public function show($id)
    {
        $vakantiehuis = Vakantiehuis::findOrFail($id);
        return view('verhuurder.huizen.show', compact('vakantiehuis'));
    }

    // Toon het formulier om een bestaand vakantiehuis te bewerken
    public function edit($id)
    {
        // Haal locaties op van de API
        $response = Http::get('http://api.geonames.org/searchJSON', [
            'formatted' => 'true',
            'country' => 'NL',
            'featureClass' => 'P',
            'maxRows' => 1000,
            'username' => 'Keiji',
        ]);

        $locations = $response->json();
        $locations = $locations['geonames'] ?? [];

        $vakantiehuis = Vakantiehuis::findOrFail($id);
        return view('verhuurder.huizen.edit', compact('vakantiehuis', 'locations'));
    }

    // Werk een bestaand vakantiehuis bij met de nieuwe gegevens
    public function update(Request $request, $id)
    {
        $vakantiehuis = Vakantiehuis::findOrFail($id);

        // Valideer de invoerdata
        $validatedData = $request->validate([
            'naam' => 'required|string|max:255',
            'prijs' => 'required|numeric',
            'beschrijving' => 'nullable|string',
            'slaapkamers' => 'required|integer',
            'stad' => 'required|string',
            'straatnaam' => 'required|string',
            'postcode' => 'required|string',
            'huisnummer' => 'required|string',
            'fotos' => 'sometimes|array',
            'fotos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        Log::info('Vakantiehuis ID bijwerken: ' . $id, $validatedData);

        // Update het vakantiehuis
        $vakantiehuis->update($validatedData);

        // Verwerk nieuwe afbeeldingen indien aanwezig
        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $foto) {
                $path = $foto->store('public/fotos');
                $url = Storage::url($path);

                Log::info('Geüploade afbeelding URL:', ['url' => $url]);

                // Maak een nieuwe Image entry aan
                Image::create([
                    'url' => $url,
                    'vakantiehuis_id' => $vakantiehuis->id,
                ]);
            }
        }

        return redirect()->route('verhuurder.huizen.index')->with('success', 'Vakantiehuis succesvol bijgewerkt.');
    }

    // Verwijder een vakantiehuis en de gekoppelde afbeeldingen
    public function destroy($id)
    {
        $vakantiehuis = Vakantiehuis::findOrFail($id);
        $vakantiehuis->delete();

        return redirect()->route('verhuurder.huizen.index')->with('success', 'Vakantiehuis succesvol verwijderd.');
    }
}
