<?php

namespace App\Http\Controllers\Huurder;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
// Huurder/ResultsController
class ResultsController extends Controller
{
    public function dashboard()
    {
        $userId = Auth::id();
        $user = User::find($userId);

        if (!$role = $user->roles()->where('name', 'huurder')->first()) {
            return redirect('home');
        } else {
            return view('huurder.dashboard');
        }
    }
}
