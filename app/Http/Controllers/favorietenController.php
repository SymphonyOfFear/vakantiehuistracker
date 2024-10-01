<?php

namespace App\Http\Controllers;

use App\Models\Favorieten;
use App\Models\Vakantiehuis;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class favorietenController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $favorieten = $user->favorieten;

        return view('favorieten.index', compact('favorieten'));
    }
    public function store(Request $request, $vakantiehuisId)
    {
        $userId = Auth::id();

        // Check of het vakantiehuis al in de favorieten staat
        $favoriet = Favorieten::where('vakantiehuis_id', $vakantiehuisId)
            ->where('user_id', $userId)
            ->first();

        if ($favoriet) {
            return redirect()->back()->with('info', 'Dit vakantiehuis staat al in uw favorieten.');
        }

        // Voeg het vakantiehuis toe aan de favorieten
        Favorieten::create([
            'vakantiehuis_id' => $vakantiehuisId,
            'user_id' => $userId,
        ]);

        return redirect()->back()->with('success', 'Vakantiehuis toegevoegd aan uw favorieten.');
    }

    /**
     * Verwijder een vakantiehuis uit de favorieten van de gebruiker.
     */
    public function destroy($vakantiehuisId)
    {
        $userId = Auth::id();

        // Verwijder de favoriet uit de database
        Favorieten::where('vakantiehuis_id', $vakantiehuisId)
            ->where('user_id', $userId)
            ->delete();

        return redirect()->back()->with('success', 'Vakantiehuis verwijderd uit uw favorieten.');
    }
}
