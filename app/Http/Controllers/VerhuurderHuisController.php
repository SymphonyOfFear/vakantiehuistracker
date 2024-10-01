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
    // Functie om het dashboard van de verhuurder weer te geven
    public function dashboard()
    {
        return view('verhuurder.dashboard');
    }

    // Functie om de indexpagina met de vakantiehuizen van de verhuurder te tonen
    public function index()
    {
        // Haal de ID op van de ingelogde verhuurder
        $verhuurderId = Auth::id();

        // Haal alle vakantiehuizen op die bij de verhuurder horen
        $mijnHuizen = Vakantiehuis::where('verhuurder_id', $verhuurderId)->with('images')->get();

        // Toon de indexpagina van de vakantiehuizen van de verhuurder
        return view('verhuurder.huizen.index', compact('mijnHuizen'));
    }

    // Functie om de create-pagina weer te geven voor het toevoegen van een vakantiehuis
    public function create()
    {
        // Haal locaties op via een externe API (GeoNames)
        $response = Http::get('http://api.geonames.org/searchJSON', [
            'formatted' => 'true',
            'country' => 'NL',
            'featureClass' => 'P',
            'maxRows' => 1000,
            'username' => 'Keiji',
        ]);

        $locations = $response->json();
        $locations = $locations['geonames'] ?? [];

        // Toon de create-pagina met de opgehaalde locaties
        return view('verhuurder.huizen.create', compact('locations'));
    }

    // Functie om een nieuw vakantiehuis op te slaan
    public function store(Request $request)
    {
        // Valideer de invoer en controleer of 'fotos' een array is
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
            // Maak een nieuw vakantiehuis aan
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

            // Verwerk de geüploade afbeeldingen
            if ($request->hasFile('fotos')) {
                foreach ($request->file('fotos') as $foto) {
                    if ($foto->isValid()) {
                        $path = $foto->store('public/fotos');
                        $url = Storage::url($path);

                        // Sla de URL op in de images-tabel
                        Image::create([
                            'url' => $url,
                            'vakantiehuis_id' => $vakantiehuis->id,
                        ]);
                    }
                }
            }

            // Redirect naar de indexpagina met succesbericht
            return redirect()->route('verhuurder.huizen.index')->with('success', 'Vakantiehuis succesvol toegevoegd.');
        } catch (\Exception $e) {
            // Log fouten
            Log::error("Fout bij opslaan van vakantiehuis: " . $e->getMessage());
            return back()->with('error', 'Er is een fout opgetreden bij het opslaan van het vakantiehuis: ' . $e->getMessage());
        }
    }

    // Functie om een specifiek vakantiehuis weer te geven
    public function show($id)
    {
        $vakantiehuis = Vakantiehuis::findOrFail($id);
        return view('verhuurder.huizen.show', compact('vakantiehuis'));
    }

    // Functie om de edit-pagina van een vakantiehuis weer te geven
    public function edit($id)
    {
        // Haal locaties op via GeoNames API
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

    // Functie om een vakantiehuis te updaten
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
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        Log::info('Vakantiehuis wordt bijgewerkt, ID: ' . $id, $validatedData);

        // Update de vakantiehuisgegevens
        $vakantiehuis->update($validatedData);

        // Update de afbeelding indien aanwezig
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            if ($foto->isValid()) {
                $path = $foto->store('public/fotos');
                $url = Storage::url($path);

                Log::info('Geüploade afbeelding URL: ' . $url);

                $image = new Image(['url' => $url]);

                $vakantiehuis->images()->delete(); // Verwijder oude afbeeldingen
                $vakantiehuis->images()->save($image);
            }
        }

        return redirect()->route('verhuurder.huizen.index')->with('success', 'Vakantiehuis succesvol bijgewerkt.');
    }

    // Functie om een vakantiehuis te verwijderen
    public function destroy($id)
    {
        $vakantiehuis = Vakantiehuis::findOrFail($id);
        $vakantiehuis->delete();

        return redirect()->route('verhuurder.huizen.index')->with('success', 'Vakantiehuis succesvol verwijderd.');
    }
}
