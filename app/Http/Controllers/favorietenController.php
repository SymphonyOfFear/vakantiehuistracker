<?php

namespace App\Http\Controllers;

use App\Models\Favorieten;
use App\Models\Vakantiehuis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavorietenController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $favorieten = $user->favorieten;

        return view('favorieten.index', compact('favorieten'));
    }

    /**
     * Schakelaar voor favorieten toevoegen en verwijderen
     **/

    public function toggle($vakantiehuisId)
    {
        $userId = Auth::id();
        $favorite = Favorieten::where('user_id', $userId)
            ->where('vakantiehuis_id', $vakantiehuisId)
            ->first();

        if ($favorite) {
            $favorite->delete();
        } else {
            Favorieten::create([
                'user_id' => $userId,
                'vakantiehuis_id' => $vakantiehuisId,
            ]);
        }


        return redirect()->back();
    }
}
