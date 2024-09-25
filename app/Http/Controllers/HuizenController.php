<?php

namespace App\Http\Controllers;

use App\Models\Vakantiehuis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HuizenController extends Controller
{
    public function show($id)
    {
        $huis = Vakantiehuis::findOrFail($id);

        // Check if coordinates are available, pass to the view
        $latitude = $huis->latitude;
        $longitude = $huis->longitude;

        return view('verhuurder.huizen.show', compact('huis', 'latitude', 'longitude'));
    }
    public function index(Request $request)
    {
        $query = Vakantiehuis::query();

        // Filter op naam
        if ($request->has('naam') && $request->input('naam')) {
            $query->where('naam', 'like', '%' . $request->input('naam') . '%');
        }

        // Filter op locatie, straatnaam, huisnummer, stad en postcode
        if ($request->has('stad') && $request->input('stad')) {
            $query->where('stad', 'like', '%' . $request->input('stad') . '%');
        }

        if ($request->has('postcode') && $request->input('postcode')) {
            $query->where('postcode', 'like', '%' . $request->input('postcode') . '%');
        }

        if ($request->has('straatnaam') && $request->input('straatnaam')) {
            $query->where('straatnaam', 'like', '%' . $request->input('straatnaam') . '%');
        }

        if ($request->has('huisnummer') && $request->input('huisnummer')) {
            $query->where('huisnummer', 'like', '%' . $request->input('huisnummer') . '%');
        }

        // Filter op maximale prijs
        if ($request->has('max_prijs') && $request->input('max_prijs') != '') {
            $query->where('prijs', '<=', $request->input('max_prijs'));
        }

        // Resultaten ophalen
        $vakantiehuizen = $query->get();

        // Locaties ophalen voor de filter
        $response = Http::get('http://api.geonames.org/searchJSON', [
            'formatted' => 'true',
            'country' => 'NL',
            'featureClass' => 'P', // Alleen steden/dorpen
            'maxRows' => 1000,
            'username' => 'Keiji',
        ]);

        // Controleer of de API een geldige respons geeft
        if ($response->successful()) {
            $locations = array_column($response->json()['geonames'], 'name');
        } else {
            $locations = [];
        }

        return view('huizen.index', compact('locations', 'vakantiehuizen'));
    }
}
