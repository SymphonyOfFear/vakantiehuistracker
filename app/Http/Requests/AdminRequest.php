<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    // Permissie om de pagina weer te geven voor de gebruiker als de gebruiker admin is
    public function authorize(): bool
    {
        $userID = Auth::id();
        $user = User::findOrFail($userID);
        // Als de check true is en de gebruiker een admin is dan is die 'true' anders niet
        return Auth::check() && $user->hasRole('admin');
    }


    public function rules(): array
    {
        return [];
    }
    // Checken op de login of de gebruiker een admin is
    protected function passedValidation()
    {
        $userId = Auth::id();
        $user = User::findOrFail($userId);
        if ($user->hasRole('admin')) {
            $this->redirect = route('admin.dashboard');
        } elseif ($user && $user->hasRole('verhuurder')) {
            $this->redirect = route('verhuurder.dashboard');
        } else {
            $this->redirect = route('home');
        }
    }
    // Als de gebruiker geen admin is terug naar de home pagina redirecten
    protected function failedAuthorization()
    {
        abort(redirect()->route('home'));
    }
}
