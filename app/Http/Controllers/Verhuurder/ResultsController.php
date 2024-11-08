<?php

namespace App\Http\Controllers\Verhuurder;

use App\Models\User;
use App\Models\Vakantiehuis;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
// Verhuurder/ResultsController
class ResultsController extends Controller
{
    public function index()
    {
        $huisjes = Vakantiehuis::where('user_id', Auth::id())->get();
        $userId = Auth::id();
        $user = User::find($userId);

        if (!$role = $user->roles()->where('name', 'verhuurder')->first()) {
            return redirect('home');
        } else {
            return view('verhuurder.dashboard', compact('huisjes'));
        }
    }
}
