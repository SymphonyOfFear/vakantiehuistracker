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
        // Hier kun je alle benodigde data ophalen voor het dashboard
        // Bijvoorbeeld huizen van de verhuurder:
        $huisjes = Vakantiehuis::where('user_id', Auth::id())->get();

        // Geef een view terug voor het dashboard
        return view('verhuurder.dashboard', compact('huisjes'));
    }
    public function index()
    {
        // Haal de ID op van de ingelogde verhuurder
        $verhuurderId = Auth::id();

        // Haal alle vakantiehuizen op die bij de verhuurder horen
        $huisjes = Vakantiehuis::where('verhuurder_id', $verhuurderId)->with('images')->get();

        // Toon de indexpagina van de vakantiehuizen van de verhuurder
        return view('verhuurder.huizen.index', compact('huisjes'));
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
        Vakantiehuis::create([
            'user_id' => Auth::id(),
            'naam' => $request->naam,
            'prijs' => $request->prijs,
            'locatie' => $request->locatie,
            'beschikbaarheid' => $request->beschikbaarheid,
            'slaapkamers' => $request->slaapkamers,
            'wifi' => $request->has('wifi'),
            'zwembad' => $request->has('zwembad'),
            'spa' => $request->has('spa'),
            'speeltuin' => $request->has('speeltuin'),
            'fotos' => json_encode($request->fotos),
        ]);

        return redirect()->route('verhuurder.huizen.index')->with('success', 'Huisje succesvol toegevoegd!');
    }

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

        return redirect()->route('verhuurder.huizen.index')->with('success', 'Huisje succesvol verwijderd!');
    }
    public function show(Vakantiehuis $huisje)
    {
        return view('verhuurder.huizen.show', compact('huisje'));
    }
}
