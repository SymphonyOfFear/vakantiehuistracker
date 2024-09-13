<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HuizenController extends Controller
{
    public function index()
    {
        // Dit toont de standaard huizenlijst, zonder filter.
    }

    public function search(Request $request)
    {
        // Haal de zoekterm op uit de querystring
        $query = $request->input('query');

        // Gesimuleerde dataset van huizen
        $huizen = [
            (object) ['name' => 'Vakantiehuis in Haarlem', 'location' => 'Haarlem', 'price' => '€ 500.000', 'image' => 'huis1.jpg'],
            (object) ['name' => 'Appartement in Amsterdam', 'location' => 'Amsterdam', 'price' => '€ 350.000', 'image' => 'huis2.jpg'],
            (object) ['name' => 'Vakantiehuis in Rotterdam', 'location' => 'Rotterdam', 'price' => '€ 600.000', 'image' => 'huis3.jpg'],
        ];

        // Filter huizen op basis van de zoekopdracht
        $filteredHuizen = array_filter($huizen, function ($huis) use ($query) {
            return stripos($huis->location, $query) !== false;
        });

        // Stuur de zoekterm en de gefilterde huizen naar de view
        return view('huizen.search-results', ['huizen' => $filteredHuizen, 'query' => $query]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
