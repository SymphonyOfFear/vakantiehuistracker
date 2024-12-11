<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReserveringRequest;
use App\Models\Reservering;
use App\Models\User;
use App\Models\Vakantiehuis;
use Illuminate\Support\Facades\Auth;

class ReserveringenController extends Controller
{
    // Toon een lijst van vakantiehuizen die de ingelogde gebruiker heeft gereserveerd
    public function index()
    {
        // Haal het ID op van de momenteel ingelogde gebruiker
        $user = Auth::id();

        // Haal de vakantiehuizen op die door de gebruiker zijn gereserveerd
        $gehuurdeHuizen = Vakantiehuis::whereHas('reserveringen', function ($query) use ($user) {
            $query->where('huurder_id', $user);
        })->get();

        // Geef de 'reserveringen.index'-view terug met de gereserveerde huizen
        return view('reserveringen.index', compact('gehuurdeHuizen'));
    }

    // Toon het formulier om een nieuwe reservering aan te maken
    public function create()
    {
        // Haal alle vakantiehuizen op om de keuzelijst te vullen
        $vakantiehuizen = Vakantiehuis::all();

        // Geef de vakantiehuizen door aan de 'reserveringen.create'-view
        return view('reserveringen.create', compact('vakantiehuizen'));
    }

    // Sla een nieuwe reservering op
    public function store(ReserveringRequest $request)
    {
        // Valideer en haal de formulierdata op
        $requestData = $request->validated();
        $user = auth()->user();
        
        // Voeg het ID van de ingelogde gebruiker toe als 'huurder_id' aan de reservering
        $requestData['huurder_id'] = $user;

        // // Maak een nieuwe reservering aan met de gevalideerde data
        $validated = $request->validated();
       

        // Maak een nieuwe reservering aan met de gevalideerde data
        $reserveringsnummer = 'RES-' . now()->format('Ymd') . '-' . mt_rand(1000, 9999);

        Reservering::create([
            'vakantiehuis_id' => $validated['vakantiehuis_id'],
            'huurder_id' => auth()->user()->id,
            'begindatum' => $validated['begindatum'],
            'einddatum' => $validated['einddatum'],
            'reserveringsnummer' => $reserveringsnummer,


            // 'huurder_name' => $validated['huurder_name'],
            // 'huurder_email' => $validated['huurder_email'],
        ]);

        // Leid de gebruiker om naar de reserveringen-pagina met een succesbericht
        return redirect()->route('reserveringen.index')->with('success', 'Reservering succesvol aangemaakt.');
        
    }

    // Toon de details van een specifieke reservering
    public function show(Reservering $reservering)
    {
        return view('reserveringen.show', compact('reservering'));
    }

    // Toon het formulier om een bestaande reservering te bewerken
    public function edit(Reservering $reservering)
    {
        // Haal alle vakantiehuizen op voor de keuzelijst
        $huizen = Vakantiehuis::all();

        // Geef de 'reserveringen.edit'-view terug met de reservering en huizen
        return view('reserveringen.edit', compact('reservering', 'huizen'));
    }

    // Werk een bestaande reservering bij
    public function update(ReserveringRequest $request, Reservering $reservering)
    {
        // Valideer en haal de formulierdata op
        $requestData = $request->validated();

        // Voeg het ID van de ingelogde gebruiker toe als 'huurder_id' aan de reservering
        $requestData['huurder_id'] = Auth::id();

        // Werk de reservering bij met de gevalideerde data
        $reservering->update($requestData);

        // Leid de gebruiker om naar de reserveringen-pagina
        return redirect()->route('reserveringen.index');
    }

    // Verwijder een bestaande reservering
    public function destroy(Reservering $reservering)
    {
        // Verwijder de reservering uit de database
        $reservering->delete();

        // Leid de gebruiker om naar de reserveringen-pagina
        return redirect()->route('reserveringen.index');
    }
}
