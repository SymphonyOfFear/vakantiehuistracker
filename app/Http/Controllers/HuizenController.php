<?php

namespace App\Http\Controllers;

use App\Models\Vakantiehuis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HuizenController extends Controller
{
    public function index(Request $request)
    {
        // Basisquery voor het ophalen van alle huizen
        $query = Vakantiehuis::with('images');

        // Filter Functie maken voor de gebruiker

        // Filteren op stad
        if ($request->filled('stad')) {
            $query->where('stad', 'like', '%' . $request->input('stad') . '%');
        }

        // Filteren op postcode
        if ($request->filled('postcode')) {
            $query->where('postcode', 'like', '%' . $request->input('postcode') . '%');
        }

        // Filteren op straatnaam
        if ($request->filled('straatnaam')) {
            $query->where('straatnaam', 'like', '%' . $request->input('straatnaam') . '%');
        }

        // Filteren op huisnummer
        if ($request->filled('huisnummer')) {
            $query->where('huisnummer', 'like', '%' . $request->input('huisnummer') . '%');
        }

        // Filteren op radius (bijvoorbeeld binnen 10, 25, 50 km)
        if ($request->filled('radius') && $request->filled('postcode')) {
            // Gebruik de opgegeven postcode en bereken de lat/lng-coördinaten
            $postcode = $request->input('postcode');
            $radius = $request->input('radius');

            // Haal de coördinaten op van de postcode
            $locationResponse = Http::get("https://nominatim.openstreetmap.org/search", [
                'q' => $postcode,
                'format' => 'json',
                'country' => 'Netherlands',
            ]);

            if ($locationResponse->successful() && count($locationResponse->json()) > 0) {
                $latitude = $locationResponse->json()[0]['lat'];
                $longitude = $locationResponse->json()[0]['lon'];

                // Bereken huizen binnen de opgegeven straal (radius) van de coördinaten
                $query->selectRaw("
                    *, (6371 * acos(
                        cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) +
                        sin(radians(?)) * sin(radians(latitude))
                    )) AS distance", [$latitude, $longitude, $latitude])
                    ->having('distance', '<=', $radius);
            }
        }

        // Filteren op voorzieningen
        $voorzieningen = ['wifi', 'zwembad', 'parkeren', 'speeltuin'];
        foreach ($voorzieningen as $voorziening) {
            if ($request->filled($voorziening)) {
                $query->where($voorziening, 1);
            }
        }

        // Filteren op prijsbereik
        if ($request->filled('min_prijs')) {
            $query->where('prijs', '>=', $request->input('min_prijs'));
        }
        if ($request->filled('max_prijs')) {
            $query->where('prijs', '<=', $request->input('max_prijs'));
        }

        // Haal de gefilterde vakantiehuizen op
        $vakantiehuizen = $query->get();

        // Haal locaties op voor dropdown
        $response = Http::get('http://api.geonames.org/searchJSON', [
            'formatted' => 'true',
            'country' => 'NL',
            'featureClass' => 'P',
            'maxRows' => 1000,
            'username' => 'Keiji',
        ]);

        //  JSON response Ophalen
        $locations = $response->json();

        // Checken voor geonames key
        if (isset($locations['geonames'])) {
            $locations = $locations['geonames'];
        } else {
            $locations = []; // Set default value to prevent errors
        }

        // Maak een eenvoudige array met stadsnamen
        $locationsList = [];
        foreach ($locations as $location) {
            if (isset($location['name'])) {
                $locationsList[] = $location['name'];
            }
        }

        return view('huizen.index', compact('locationsList', 'vakantiehuizen'));
    }

    public function show($id)
    {
        $vakantiehuis = Vakantiehuis::with('images')->findOrFail($id);
        return view('huizen.show', compact('vakantiehuis'));
    }
}
