<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReserveringRequest;
use App\Models\Reservering;
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
        
        // Voeg het ID van de ingelogde gebruiker toe als 'huurder_id' aan de reservering
        $requestData['huurder_id'] = Auth::id();

        // Maak een nieuwe reservering aan met de gevalideerde data
        Reservering::create($requestData);

        // Extra validatieregels voor het aanmaken van een reservering
        $validated = $request->validate([
            'vakantiehuis_id' => 'required|exists:vakantiehuizen,id', // Het vakantiehuis moet bestaan in de database
            'startdatum' => 'required|date|after_or_equal:today', // De startdatum moet vandaag of later zijn
            'einddatum' => 'required|date|after:startdatum', // De einddatum moet na de startdatum liggen
            'huurder_name' => 'required|string|max:255', // De naam van de huurder moet een string zijn van max. 255 tekens
            'huurder_email' => 'required|email|max:255', // Het e-mailadres van de huurder moet geldig zijn en max. 255 tekens lang
        ]);

        // Maak een nieuwe reservering aan met de gevalideerde data
        Reservering::create([
            'vakantiehuis_id' => $validated['vakantiehuis_id'],
            'startdatum' => $validated['startdatum'],
            'einddatum' => $validated['einddatum'],
            'huurder_name' => $validated['huurder_name'],
            'huurder_email' => $validated['huurder_email'],
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
