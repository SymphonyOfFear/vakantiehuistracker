<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recensie;
use App\Models\Reservering;
use App\Models\Vakantiehuis;
use Illuminate\Support\Facades\Auth;

class RecensiesController extends Controller
{
    public function store(Request $request, $vakantiehuisId)
    {
        // Validatie van de request data
        $validatedData = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        try {
            // Controleer of de gebruiker een reservering heeft voor dit vakantiehuis
            $hasReservation = Reservering::where('huurder_id', Auth::id())
                ->where('vakantiehuis_id', $vakantiehuisId)
                ->exists();

            if (!$hasReservation) {
                return back()->with('error', 'U kunt alleen een recensie schrijven als u een reservering heeft.');
            }

            // Opslaan van de recensie
            Recensie::create([
                'vakantiehuis_id' => $vakantiehuisId,
                'user_id' => Auth::id(),
                'rating' => $validatedData['rating'],
                'comment' => $validatedData['comment'],
            ]);

            return back()->with('success', 'Uw recensie is succesvol geplaatst.');
        } catch (\Exception $e) {
            return back()->with('error', 'Er is een fout opgetreden bij het plaatsen van uw recensie.');
        }
    }
}
