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
        // Zoekopdracht ophalen
        $query = $request->input('query'); // Ophalen van de zoekterm, bijvoorbeeld 'Haarlem'

        // Simuleer huizen of vervang dit met een echte database query
        $huizen = [
            (object) ['name' => 'Vakantiehuis in Haarlem', 'location' => 'Haarlem', 'price' => '€ 500.000', 'image' => 'huis1.jpg'],
            (object) ['name' => 'Appartement in Haarlem', 'location' => 'Haarlem', 'price' => '€ 350.000', 'image' => 'huis2.jpg'],
            // Meer huizen toevoegen...
        ];

        // Filter huizen op basis van de zoekopdracht
        $huizen = array_filter($huizen, function ($huis) use ($query) {
            return stripos($huis->location, $query) !== false;
        });

        // Return de zoekresultaten view met de gevonden huizen
        return view('huizen.search-results', ['huizen' => $huizen, 'query' => $query]);
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
