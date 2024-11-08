<?php

namespace App\Http\Controllers;

use App\Http\Requests\VakantiehuisRequest;
use App\Models\Vakantiehuis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class HuizenController extends Controller
{

    public function index(VakantiehuisRequest $request)
    {

        $query = Vakantiehuis::query();


        if ($request->filled('stad')) {
            $query->where('stad', 'like', '%' . $request->input('stad') . '%');
        }


        if ($request->filled('postcode')) {
            $query->where('postcode', 'like', '%' . $request->input('postcode') . '%');
        }


        if ($request->filled('straatnaam')) {
            $query->where('straatnaam', 'like', '%' . $request->input('straatnaam') . '%');
        }


        if ($request->filled('huisnummer')) {
            $query->where('huisnummer', 'like', '%' . $request->input('huisnummer') . '%');
        }





        if ($request->filled('min_prijs') && $request->filled('max_prijs')) {
            $query->whereBetween('prijs', [(int) $request->input('min_prijs'), (int) $request->input('max_prijs')]);
        }

        if ($request->filled('wifi')) {
            $query->where('wifi', true);
        }
        if ($request->filled('zwembad')) {
            $query->where('zwembad', true);
        }
        if ($request->filled('parkeren')) {
            $query->where('parkeren', true);
        }
        if ($request->filled('speeltuin')) {
            $query->where('speeltuin', true);
        }


        $huizen = $query->get();


        return view('huizen.index', compact('huizen'));
    }
// Show functie data ophalen van de huis met de juiste id
    public function show($id)
    {
        $vakantiehuis = Vakantiehuis::where($id);
        try {

            $vakantiehuis = Vakantiehuis::with('images', 'recensies')->findOrFail($id);
            return view('huizen.show', compact('vakantiehuis'));
        } catch (\Exception $e) {
// Debug statement
            Log::error("Er is een fout opgestreden tijdens het laten zien van deze vakantiehuis met de ID $id: " . $e->getMessage());
            return redirect()->route('huizen.index')->with('error', 'Vakantiehuis niet gevonden of een fout opgetreden.');
        }
    }
    // Zoek functie op postcode, straat en stad
    public function search(VakantiehuisRequest $request)
    {
        $query = $request->input('location');

        $huizen = Vakantiehuis::where('stad', 'LIKE', "%{$query}%")
            ->orWhere('straatnaam', 'LIKE', "%{$query}%")
            ->orWhere('postcode', 'LIKE', "%{$query}%")
            ->get();
// resultaten teruggeven
        return view(
            'huizen.index',
            compact('huizen')
        )->with('query', $query);
    }
}
