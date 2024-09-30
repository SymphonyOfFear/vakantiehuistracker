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
        $huisjes = Vakantiehuis::where('user_id', Auth::id())->get();
        return view('verhuurder.huizen.index', compact('huisjes'));
    }


    // Show the form for creating a new vakantiehuis
    public function create()
    {
        return view('verhuurder.huizen.toevoegen');
    }

    // Store a newly created vakantiehuis in storage
    public function store(Request $request)
    {
        Vakantiehuis::create([
            'user_id' => Auth::id(),
            'naam' => $request->naam,
            'prijs' => $request->prijs,
            'locatie' => $request->locatie,
            'beschikbaarheid' => $request->has('beschikbaarheid'),
            'slaapkamers' => $request->slaapkamers,
            'wifi' => $request->has('wifi'),
            'zwembad' => $request->has('zwembad'),
            'spa' => $request->has('spa'),
            'speeltuin' => $request->has('speeltuin'),
            'fotos' => json_encode($request->fotos),
        ]);

        return redirect()->route('verhuurder.huizen.index')->with('success', 'Huisje succesvol toegevoegd!');
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
        $huisje = Vakantiehuis::findOrFail($id);
        return view('verhuurder.huizen.bewerken', compact('huisje'));
    }

    // Update the specified vakantiehuis in storage
    public function update(Request $request, $id)
    {
        $huisje = Vakantiehuis::findOrFail($id);

        $huisje->update([
            'prijs' => $request->prijs,
            'naam' => $request->naam,
            'locatie' => $request->locatie,
            'beschikbaarheid' => $request->has('beschikbaarheid'),
            'slaapkamers' => $request->slaapkamers,
            'wifi' => $request->has('wifi'),
            'zwembad' => $request->has('zwembad'),
            'spa' => $request->has('spa'),
            'speeltuin' => $request->has('speeltuin'),
            'fotos' => json_encode($request->fotos),
        ]);

        return redirect()->route('verhuurder.huizen.index')->with('success', 'Huisje succesvol bijgewerkt!');
    }

    // Remove the specified vakantiehuis from storage
    public function destroy($id)
    {
        
        $huisje = Vakantiehuis::findOrFail($id);
        $huisje->delete();

        return redirect()->route('verhuurder.huizen.index')->with('success', 'Huisje succesvol verwijderd!');
    }
    public function show(Vakantiehuis $huisje)
    {
        return view('verhuurder.huizen.show', compact('huisje'));
    }
}
