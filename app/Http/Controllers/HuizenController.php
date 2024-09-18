<?php

namespace App\Http\Controllers;

use App\Models\Vakantiehuis;
use Illuminate\Http\Request;

class HuizenController extends Controller
{
    public function index(Request $request)
    {
        // Locatie JSON bestand ophalen
        $locations = json_decode(file_get_contents(storage_path('app/public/locations.json')), true);

        // Begin query voor huizen zoeken
        $query = Vakantiehuis::query();

        // Query aan filter koppelen
        if ($request->filled('query')) {
            $query->where('locatie', 'LIKE', '%' . $request->input('query') . '%'); // Locatie naam in database zoeken
        }

        // Query laten checken voor locaties
        if ($request->filled('locatie')) {
            $query->where('locatie', $request->input('locatie')); // Locatie 
        }

        //  Query laten checken voor minimale prijs
        if ($request->filled('min_prijs')) {
            $query->where('prijs', '>=', $request->input('min_prijs')); // Minimale Prijs
        }
        //  Query laten checken voor Maximale prijs
        if ($request->filled('max_prijs')) {
            $query->where('prijs', '<=', $request->input('max_prijs')); // Maximale Prijs 
        }

        //  Query laten checken voor toevoegingen zoals zwembadden etc
        if ($request->filled('zwembad')) {
            $query->where('zwembad', true); // Heeft een zwembad checker
        }
        if ($request->filled('wifi')) {
            $query->where('wifi', true); // Heeft wifi checker
        }
        if ($request->filled('spa')) {
            $query->where('spa', true); // Heeft een spa checker
        }
        if ($request->filled('speeltuin')) {
            $query->where('speeltuin', true); // Heeft een speeltuin checker
        }

        // Resultaten ophalen van query
        $huizen = $query->get();

        // Locaties en huizen naar de index sturen
        return view('huizen.index', [
            'locations' => $locations,
            'huizen' => $huizen
        ]);
    }
}
