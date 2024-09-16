<?php

namespace App\Http\Controllers;

use App\Models\Vakantiehuis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HuizenController extends Controller
{
    // Index function to display vakantiehuizen with optional filters
    public function index()
    {
        // Fetch the locations from the database
        $locations = json_decode(file_get_contents(storage_path('app/public/locations.json')), true);

        // Fetch vakantiehuizen from the database (replace this with your actual query)
        $huizen = Vakantiehuis::all();

        // Pass both locations and huizen to the view
        return view('huizen.index', [
            'locations' => $locations,
            'huizen' => $huizen
        ]);
    }


    // Search results
    public function search(Request $request)
    {
        $query = $request->input('query');
        $huizen = Vakantiehuis::where('locatie', 'LIKE', '%' . $query . '%')->get()->toArray();  // Ensure it's always an array

        // Fetch locations from the JSON file for filters
        $locations = json_decode(file_get_contents(storage_path('app/public/locations.json')), true);

        return view('huizen.search-results', [
            'huizen' => $huizen,
            'locations' => $locations,
            'query' => $query,
        ]);
    }

    // Show single vakantiehuis
    public function show($id)
    {
        $huis = Vakantiehuis::findOrFail($id);
        return view('huizen.show', compact('huis'));
    }
}
