<?php

namespace App\Http\Controllers;

use App\Models\Vakantiehuis;
use Illuminate\Http\Request;

class HuizenController extends Controller
{
    public function index(Request $request)
    {
        // Lees de locaties uit de JSON
        $locations = json_decode(file_get_contents(resource_path('locations.json')), true);


        // Maak een query voor de vakantiehuizen
        $query = Vakantiehuis::query();

        // Verwerk de locatie filter alleen als het een string is
        if ($request->has('locatie') && is_string($request->input('locatie'))) {
            $locatie = trim($request->input('locatie'));
            $query->where('locatie', 'LIKE', '%' . $locatie . '%');
        }

        // Verwerk de prijsfilters
        if ($request->has('min_prijs')) {
            $query->where('prijs', '>=', $request->input('min_prijs'));
        }

        if ($request->has('max_prijs')) {
            $query->where('prijs', '<=', $request->input('max_prijs'));
        }

        // Voeg filters toe voor voorzieningen
        if ($request->has('zwembad')) {
            $query->where('zwembad', true);
        }

        if ($request->has('wifi')) {
            $query->where('wifi', true);
        }

        if ($request->has('spa')) {
            $query->where('spa', true);
        }

        if ($request->has('speeltuin')) {
            $query->where('speeltuin', true);
        }

        // Haal de gefilterde huizen op
        $huizen = $query->get();

        // Geef de locaties en huizen door aan de view
        return view('huizen.index', [
            'locations' => $locations,
            'huizen' => $huizen,
        ]);
    }
}
