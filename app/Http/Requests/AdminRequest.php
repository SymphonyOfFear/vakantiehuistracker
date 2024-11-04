<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    public function authorize(): bool
    {
        $userId = Auth::id();
        $user = User::find($userId);

        return $user && $user->roles()->where('name', 'admin')->exists();
    }

    public function rules(): array
    {
        return [];
    }

    protected function failedAuthorization()
    {
        redirect()->route('home')->send();
    }

    protected function passedValidation()
    {
        $userId = Auth::id();
        $user = User::find($userId);

        if ($user && $user->roles()->where('name', 'admin')->exists()) {
            $this->redirect = route('admin.dashboard');
        } elseif ($user && $user->roles()->where('name', 'verhuurder')->exists()) {
            $this->redirect = route('verhuurder.dashboard');
        } else {
            $this->redirect = route('home');
        }
    }
}
