<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Vakantiehuis;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\VerhuurderHuisRequest;

class VerhuurderHuisController extends Controller
{
    public function dashboard()
    {
        $huisjes = Vakantiehuis::where('user_id', Auth::id())->get();
        return view('verhuurder.dashboard', compact('huisjes'));
    }

    public function index()
    {
        $verhuurderId = Auth::id();
        $huisjes = Vakantiehuis::where('user_id', $verhuurderId)->with('images')->get();
        return view('verhuurder.huizen.index', compact('huisjes'));
    }

    public function create()
    {
        $response = Http::get('http://api.geonames.org/searchJSON', [
            'formatted' => 'true',
            'country' => 'NL',
            'featureClass' => 'P',
            'maxRows' => 1000,
            'username' => 'Keiji',
        ]);

        $locations = $response->json();
        $locations = $locations['geonames'] ?? [];

        return view('verhuurder.huizen.create', compact('locations'));
    }

    public function store(VerhuurderHuisRequest $request)
    {
        $vakantiehuis = Vakantiehuis::create([
            'user_id' => Auth::id(),
            'naam' => $request->naam,
            'prijs' => $request->prijs,
            'beschrijving' => $request->beschrijving,
            'slaapkamers' => $request->slaapkamers,
            'wifi' => $request->has('wifi'),
            'zwembad' => $request->has('zwembad'),
            'speeltuin' => $request->has('speeltuin'),
            'stad' => $request->stad,
            'straatnaam' => $request->straatnaam,
            'postcode' => $request->postcode,
            'huisnummer' => $request->huisnummer,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $foto) {
                if ($foto->isValid()) {
                    $path = $foto->store('public/fotos');
                    $url = Storage::url($path);
                    Image::create(['url' => $url, 'vakantiehuis_id' => $vakantiehuis->id]);
                }
            }
        }

        return redirect()->route('verhuurder.huizen.index')->with('success', 'Huisje succesvol toegevoegd!');
    }

    public function edit($id)
    {
        $response = Http::get('http://api.geonames.org/searchJSON', [
            'formatted' => 'true',
            'country' => 'NL',
            'featureClass' => 'P',
            'maxRows' => 1000,
            'username' => 'Keiji',
        ]);

        $locations = $response->json();
        $locations = $locations['geonames'] ?? [];

        $vakantiehuis = Vakantiehuis::findOrFail($id);
        return view('verhuurder.huizen.edit', compact('vakantiehuis', 'locations'));
    }

    public function update(VerhuurderHuisRequest $request, $id)
    {
        $vakantiehuis = Vakantiehuis::findOrFail($id);

        $vakantiehuis->update([
            'naam' => $request->naam,
            'prijs' => $request->prijs,
            'beschrijving' => $request->beschrijving,
            'slaapkamers' => $request->slaapkamers,
            'stad' => $request->stad,
            'straatnaam' => $request->straatnaam,
            'postcode' => $request->postcode,
            'huisnummer' => $request->huisnummer,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        if ($request->hasFile('fotos')) {
            $vakantiehuis->images()->delete();
            foreach ($request->file('fotos') as $foto) {
                if ($foto->isValid()) {
                    $path = $foto->store('public/fotos');
                    $url = Storage::url($path);
                    Image::create(['url' => $url, 'vakantiehuis_id' => $vakantiehuis->id]);
                }
            }
        }

        return redirect()->route('verhuurder.huizen.index')->with('success', 'Vakantiehuis succesvol bijgewerkt.');
    }

    public function destroy($id)
    {
        $vakantiehuis = Vakantiehuis::findOrFail($id);

        foreach ($vakantiehuis->images as $image) {
            Storage::delete(str_replace('/storage', 'public', $image->url));
            $image->delete();
        }

        $vakantiehuis->delete();

        return redirect()->route('verhuurder.huizen.index')->with('success', 'Huisje succesvol verwijderd!');
    }

    public function show(VerhuurderHuisRequest $request, $id)
    {
$huisje = Vakantiehuis::where($id);
        return view('verhuurder.huizen.show', compact('huisje'));
    }
}
