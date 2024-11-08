<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vakantiehuis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\VakantiehuisRequest;

class HuizenController extends Controller
{
    public function welcome(Request $request)
    {
        $zoekopdracht = $request->input('query', ''); 
    
        if (!empty($zoekopdracht)) {
            session(['last_search' => $zoekopdracht]);
        }

        $huizen = Vakantiehuis::where(function ($q) use ($zoekopdracht) {
                $q->where('stad', 'like', '%' . $zoekopdracht . '%')
                  ->orWhere('straatnaam', 'like', '%' . $zoekopdracht . '%')
                  ->orWhere('postcode', 'like', '%' . $zoekopdracht . '%');
            })
            ->get();
    
   
        return view('welcome', compact('huizen'));
    }
    
   
     

public function index(Request $request)
{
    $queryParam = $request->input('zoekopdracht', '');
    
    $query = Vakantiehuis::query();

    if (!empty($queryParam)) {
        session(['last_search' => $queryParam]);
        $query->where(function ($subQuery) use ($queryParam) {
            $subQuery->where('stad', 'like', '%' . $queryParam . '%')
                     ->orWhere('straatnaam', 'like', '%' . $queryParam . '%')
                     ->orWhere('postcode', 'like', '%' . $queryParam . '%');
        });
    }

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


    public function show($id)
    {
        $user = Auth::user();

        try {
            $vakantiehuis = Vakantiehuis::with(['images', 'recensies'])->findOrFail($id);
            return view('huizen.show', compact('vakantiehuis', 'user'));
        } catch (\Exception $e) {
            Log::error("Error showing Vakantiehuis with ID $id: " . $e->getMessage());
            return redirect()->route('huizen.index')->with('error', 'Vakantiehuis not found or an error occurred.');
        }
    }

    public function search(VakantiehuisRequest $request)
    {
        $query = $request->input('location');

        $huizen = Vakantiehuis::where('stad', 'LIKE', "%{$query}%")
            ->orWhere('straatnaam', 'LIKE', "%{$query}%")
            ->orWhere('postcode', 'LIKE', "%{$query}%")
            ->get();

        return view(
            'huizen.index',
            compact('huizen')
        )->with('query', $query);
    }
}
