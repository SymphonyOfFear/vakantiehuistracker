<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerhuurderHuisRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'naam' => 'required|string|max:255',
            'prijs' => 'required|numeric|min:0',
            'slaapkamers' => 'required|integer|min:1',
            'beschrijving' => 'nullable|string',
            'wifi' => 'nullable|boolean',
            'zwembad' => 'nullable|boolean',
            'speeltuin' => 'nullable|boolean',
            'stad' => 'required|string|max:255',
            'straatnaam' => 'required|string|max:255',
            'postcode' => 'required|string|max:10',
            'huisnummer' => 'required|string|max:10',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'fotos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'wifi' => $this->input('wifi', 0),
            'parkeerplaats' => $this->input('parkeerplaats', 0),
            'zwembad' => $this->input('zwembad', 0),
            'speeltuin' => $this->input('speeltuin', 0),
        ]);
    }
}
