<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VakantiehuisRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'naam' => 'required|string|max:255',
            'prijs' => 'required|numeric|min:0',
            'beschrijving' => 'nullable|string',
            'slaapkamers' => 'required|integer|min:1',
            'stad' => 'required|string|max:255',
            'straatnaam' => 'required|string|max:255',
            'postcode' => 'required|string|max:20',
            'huisnummer' => 'required|string|max:10',
            'fotos' => 'nullable|array',
            'fotos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'wifi' => 'boolean',
            'zwembad' => 'boolean',
            'parkeren' => 'boolean',
            'speeltuin' => 'boolean',
            'beschikbaarheid' => 'boolean',
        ];
    }
}
