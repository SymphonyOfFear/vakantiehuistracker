<?php

namespace App\Http\Controllers;

use App\Models\Vakantiehuis;
use Illuminate\Http\Request;

class HuizenController extends Controller
{
    public function index()
    {
        $huizen = Vakantiehuis::all();
        // Zorg ervoor dat de juiste view wordt geladen
        return view('huizen.index', compact('huizen'));
    }


    public function search(Request $request)
    {
        $searchQuery = $request->get('query');
        $minPrijs = $request->get('min_prijs');
        $maxPrijs = $request->get('max_prijs');

        // Query for search results
        $huizen = Vakantiehuis::query()
            ->where('locatie', 'LIKE', "%{$searchQuery}%")
            ->when($minPrijs, function ($query, $minPrijs) {
                return $query->where('prijs', '>=', $minPrijs);
            })
            ->when($maxPrijs, function ($query, $maxPrijs) {
                return $query->where('prijs', '<=', $maxPrijs);
            })
            ->get();

        return view('huizen/search-results', compact('huizen', 'searchQuery'));
    }

    // Detailpagina voor een vakantiehuis
    public function show($id)
    {
        $huis = Vakantiehuis::findOrFail($id);  // Haalt een specifiek huis op

        return view('huizen.show', compact('huis'));
    }
}
