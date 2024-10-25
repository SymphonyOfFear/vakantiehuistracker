<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    // Checken of de gebruiker een admin is
    public function authorize(): bool
    {
        $userID = Auth::id();
        $user = User::findOrFail($userID);

        return Auth::check() && $user->hasRole('admin');
    }
    // de variabelen registeren voor de validatie op request
    public function rules(): array
    {
        return [
            'name' => 'string|required',
            'email' => 'string|email|required',
            'role' => 'required|exists:roles,id',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id',
        ];
    }
    // De tabel van permissions ophalen voor validatie
    protected function prepareForValidation()
    {
        $this->merge([
            'permissions' => $this->input('permissions', []),
        ]);
    }
}
