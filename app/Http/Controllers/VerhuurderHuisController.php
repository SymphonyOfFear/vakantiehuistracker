<?php

namespace App\Http\Controllers;

use App\Models\Vakantiehuis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerhuurderHuisController extends Controller
{
    public function index()
    {
        $huisjes = Vakantiehuis::where('verhuurder_id', Auth::id())->get();
        return view('verhuurder.huis.index', compact('huisjes'));
    }

    public function create()
    {
        return view('verhuurder.huis.create');
    }

    public function store(Request $request)
    {
        Vakantiehuis::create([
            'verhuurder_id' => Auth::id(),
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

        return redirect()->route('verhuurder.huis.index')->with('success', 'Huisje succesvol toegevoegd!');
    }

    public function edit($id)
    {
        $huisje = Vakantiehuis::findOrFail($id);
        return view('verhuurder.huis.edit', compact('huisje'));
    }

    public function update(Request $request, $id)
    {
        $huisje = Vakantiehuis::findOrFail($id);

        $huisje->update([
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

        return redirect()->route('verhuurder.huis.index')->with('success', 'Huisje succesvol bijgewerkt!');
    }

    public function destroy($id)
    {
        $huisje = Vakantiehuis::findOrFail($id);
        $huisje->delete();

        return redirect()->route('verhuurder.huis.index')->with('success', 'Huisje succesvol verwijderd!');
    }
}
