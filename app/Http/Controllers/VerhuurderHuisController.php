<?php

namespace App\Http\Controllers;

use App\Models\Recensies;
use App\Models\Vakantiehuis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerhuurderHuisController extends Controller
{
    public function index(Request $request)
    {
        $locations = json_decode(file_get_contents(storage_path('app/public/locations.json')), true);

        // Maak een query voor de vakantiehuizen
        $query = Vakantiehuis::query();

        // Verwerk de locatie filter alleen als het een string is
        if ($request->has('locatie') && is_string($request->input('locatie'))) {
            $locatie = trim($request->input('locatie'));
            $query->where('locatie', 'LIKE', '%' . $locatie . '%');
        }

        // Verwerk de prijsfilters
        if ($request->has('min_prijs')) {
            $query->where('prijs', '>=', $request->input('min_prijs'));
        }

        if ($request->has('max_prijs')) {
            $query->where('prijs', '<=', $request->input('max_prijs'));
        }

        // Voeg filters toe voor voorzieningen
        if ($request->has('zwembad')) {
            $query->where('zwembad', true);
        }

        if ($request->has('wifi')) {
            $query->where('wifi', true);
        }

        if ($request->has('spa')) {
            $query->where('spa', true);
        }

        if ($request->has('speeltuin')) {
            $query->where('speeltuin', true);
        }

        // Haal de gefilterde huizen op
        $huizen = $query->get();

        $vakantiehuizen = Vakantiehuis::where('verhuurder_id', Auth::id())->get();
        return view('verhuurder.huizen.index', [
            'locations' => $locations,
            'huizen' => $huizen,
        ], compact('vakantiehuizen'));
    }
    public function recensies()
    {
        $recensies = Recensies::where('verhuurder_id', Auth::id())->get();
        return view('recensies.index', compact('recensies'));
    }

    public function create()
    {
        return view('verhuurder.huizen.create');
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

        return redirect()->route('verhuurder.huizen.index')->with('success', 'Huisje succesvol toegevoegd!');
    }

    public function edit($id)
    {
        $vakantiehuis = Vakantiehuis::findOrFail($id);
        return view('verhuurder.huizen.edit', compact('vakantiehuis'));
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
}
