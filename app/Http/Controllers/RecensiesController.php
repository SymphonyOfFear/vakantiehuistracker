<?php

// app/Http/Controllers/RecensiesController.php

namespace App\Http\Controllers;

use App\Http\Requests\RecensieRequest;
use App\Models\Recensie;
use App\Models\Reservering;
use App\Models\Vakantiehuis;
use Illuminate\Support\Facades\Auth;
use Termwind\Components\Dd;

class RecensiesController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $vakantiehuizen = Vakantiehuis::whereHas('reserveringen', function ($query) use ($user) {
            $query->where('huurder_id', $user->id);
        })->get();

        $recensies = Recensie::whereIn('vakantiehuis_id', $vakantiehuizen->pluck('id'))->get();

        return view('recensies.index', compact('vakantiehuizen', 'recensies'));
    }

    public function store(RecensieRequest $request, $vakantiehuisId)
    {
     
    // Valideren van de input
    $validated = $request->validated();

    // Haal het vakantiehuis op om te controleren of het bestaat
    $vakantiehuis = Vakantiehuis::findOrFail($vakantiehuisId);
    
    // Maak een nieuwe recensie
    $recensie = new Recensie();
    $recensie->user_id = Auth::user()->id; // Huidige gebruiker
    $recensie->vakantiehuis_id = $vakantiehuis->id; // Koppel aan vakantiehuis
    $recensie->rating = $validated['rating'];
    $recensie->comment = $validated['opmerking'];
    
    // dd($recensie);

    // Opslaan in de database
    $recensie->save();

    // Redirect terug naar de vakantiehuispagina met succesbericht
    return redirect()->route('huizen.show', $vakantiehuis->id)
                     ->with('success', 'Je recensie is succesvol toegevoegd!');


    }
}
