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
        $query = $request->input('query'); // Ophalen van de zoekterm, zoals 'Haarlem'


        // $huizen = Huizen::where('location', 'LIKE', '%' . $query . '%')->get();

        // Voor nu geven we gewoon de zoekterm door aan de view.
        return view('huizen.search-results', compact('query'));
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
