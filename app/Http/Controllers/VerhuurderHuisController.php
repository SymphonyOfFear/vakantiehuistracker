<?php

namespace App\Http\Controllers;

use App\Models\Vakantiehuis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerhuurderHuisController extends Controller
{
    public function index()
    {
        $huisjes = Vakantiehuis::where('user_id', Auth::id())->get();
        return view('verhuurder.huizen.index', compact('huisjes'));
    }

    public function create()
    {
        return view('verhuurder.huizen.toevoegen');
    }

    public function store(Request $request)
    {
        Vakantiehuis::create([
            'user_id' => Auth::id(),
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

    public function edit($id)
    {
        $huisje = Vakantiehuis::findOrFail($id);
        return view('verhuurder.huizen.bewerken', compact('huisje'));
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

        return redirect()->route('verhuurder.huizen.index')->with('success', 'Huisje succesvol bijgewerkt!');
    }

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
