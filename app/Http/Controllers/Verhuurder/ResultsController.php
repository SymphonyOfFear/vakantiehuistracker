<?php

namespace App\Http\Controllers\Verhuurder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ResultsController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $user = User::find($userId);

        if (!$role = $user->roles()->where('name', 'verhuurder')->first()) {
            return redirect('home');
        } else {
            return view('verhuurder.dashboard');
        }
    }
}
