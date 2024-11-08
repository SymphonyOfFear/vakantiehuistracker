<?php

namespace App\Http\Controllers;

use App\Models\Favoriet;
use App\Models\User;
use App\Models\Vakantiehuis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavorietController extends Controller
{
    // Toont de lijst van favoriete vakantiehuizen van de gebruiker
    public function index()
    {
        $userId = Auth::id();
        $user = User::find($userId);
        $favorieten = $user->favorieten()->with('vakantiehuis')->get();

        return view('favorieten.index', compact('favorieten'));
    }

    // Voegt een vakantiehuis toe aan de favorieten of verwijdert deze uit de favorieten
    public function toggle($vakantiehuisId)
    {
        $userId = Auth::id();
        $favorite = Favoriet::where('user_id', $userId)
            ->where('vakantiehuis_id', $vakantiehuisId)
            ->first();

        if ($favorite) {
            $favorite->delete();
        } else {
            Favoriet::create([
                'user_id' => $userId,
                'vakantiehuis_id' => $vakantiehuisId,
            ]);
        }

        return redirect()->back();
    }
}
