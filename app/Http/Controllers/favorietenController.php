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
    public function add($vakantiehuisId)
    {
        // Ophalen van de ID van de gebruiker
        $userId = Auth::id();

        // Checken of de vakantiehuis al tussen de gebruikers favorieten staat
        $favorite = Favorieten::where('vakantiehuis_id', $vakantiehuisId)
            ->where('user_id', $userId) // Id van gebruiker zoeken in database
            ->first();
        // Verwijderen van al bestaande favorieten vakantiehuis
        if ($favorite) {
            $favorite->delete();
            return response()->json(['success' => true, 'message' => 'Removed from favorites']); // Output
        }

        // Als de vakantiehuis hem niet in de favorieten staat van de gebruiker
        Favorieten::create([
            'user_id' => $userId,
            'vakantiehuis_id' => $vakantiehuisId,
        ]);
        // Output
        return response()->json(['success' => true, 'message' => 'Added to favorites']);
    }
}
