<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{

    public function authorize(): bool
    {
        $userID = Auth::id();
        $user = User::findOrFail($userID);

        return Auth::check() && $user->hasRole('admin');
    }


    public function rules(): array
    {
        return [];
    }

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
    protected function failedAuthorization()
    {
        abort(redirect()->route('home'));
    }
}
