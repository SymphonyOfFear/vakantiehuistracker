<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
{
    public function authorize(): bool
    {
        $userID = Auth::id();
        $user = User::findOrFail($userID);

        return Auth::check() && $user->hasRole('admin');
    }

    public function rules(): array
    {
        return [
            'role' => 'required|exists:roles,id',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'permissions' => $this->input('permissions', []),
        ]);
    }
}
