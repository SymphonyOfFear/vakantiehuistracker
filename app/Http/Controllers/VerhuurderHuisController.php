<?php

namespace App\Http\Controllers;

use App\Models\Vakantiehuis;
use Illuminate\Http\Request;

class VerhuurderHuisController extends Controller
{
    // Display a listing of vakantiehuizen for the verhuurder
    public function dashboard()
    {
        return view('verhuurder.dashboard');
    }
    public function index()
    {
        // Assuming you have a locations.json file to load locations from
        $locations = json_decode(file_get_contents(resource_path('locations.json')), true);


        // Fetch all vacation houses associated with the current user/verhuurder
        $huizen = Vakantiehuis::all();

        return view('verhuurder.huizen.index', [
            'locations' => $locations,
            'huizen' => $huizen,
        ]);
    }


    // Show the form for creating a new vakantiehuis
    public function create()
    {
        return view('verhuurder.huizen.create');
    }

    // Store a newly created vakantiehuis in storage
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'naam' => 'required|string|max:255',
            'prijs' => 'required|numeric',
            'beschrijving' => 'nullable|string',
            'locatie' => 'required|string|max:255',
            'slaapkamers' => 'required|integer',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Create a new Vakantiehuis instance and save to database
        $vakantiehuis = new Vakantiehuis($validated);

        // Handle the file upload if a file was provided
        if ($request->hasFile('foto')) {
            $vakantiehuis->foto = $request->file('foto')->store('vakantiehuizen', 'public');
        }

        $vakantiehuis->save();

        return redirect()->route('verhuurder.huizen.index')->with('success', 'Vakantiehuis succesvol toegevoegd');
    }

    // Show a specific vakantiehuis
    public function show($id)
    {
        $vakantiehuis = Vakantiehuis::findOrFail($id);
        return view('verhuurder.huizen.show', compact('vakantiehuis'));
    }

    // Show the form for editing the specified vakantiehuis
    public function edit($id)
    {
        $vakantiehuis = Vakantiehuis::findOrFail($id);
        return view('verhuurder.huizen.edit', compact('vakantiehuis'));
    }

    // Update the specified vakantiehuis in storage
    public function update(Request $request, $id)
    {
        // Validate the request data
        $validated = $request->validate([
            'naam' => 'required|string|max:255',
            'prijs' => 'required|numeric',
            'beschrijving' => 'nullable|string',
            'locatie' => 'required|string|max:255',
            'slaapkamers' => 'required|integer',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Fetch the existing Vakantiehuis model
        $vakantiehuis = Vakantiehuis::findOrFail($id);
        $vakantiehuis->fill($validated);

        // Handle file upload if a new image was provided
        if ($request->hasFile('foto')) {
            $vakantiehuis->foto = $request->file('foto')->store('vakantiehuizen', 'public');
        }

        $vakantiehuis->save();

        return redirect()->route('verhuurder.huizen.index')->with('success', 'Vakantiehuis succesvol bijgewerkt');
    }

    // Remove the specified vakantiehuis from storage
    public function destroy($id)
    {
        $vakantiehuis = Vakantiehuis::findOrFail($id);
        $vakantiehuis->delete();

        return redirect()->route('verhuurder.huizen.index')->with('success', 'Vakantiehuis succesvol verwijderd');
    }
}
