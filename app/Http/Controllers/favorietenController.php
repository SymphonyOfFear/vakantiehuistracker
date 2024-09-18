<?php

namespace App\Http\Controllers;

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
    public function addFavorite($vakantiehuisId) {}
    public function removeFavorite($favorietId) {}
}
