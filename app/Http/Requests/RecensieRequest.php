<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecensieRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'rating' => 'required|integer|min:1|max:5',
            'opmerking' => 'required|string|max:1000',
        ];
    }
}
