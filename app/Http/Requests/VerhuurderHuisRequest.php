<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerhuurderHuisRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'naam' => 'required|string|max:255',
            'prijs' => 'required|numeric',
            'beschrijving' => 'nullable|string',
            'slaapkamers' => 'nullable|integer',
            'stad' => 'required|string|max:255',
            'straatnaam' => 'required|string|max:255',
            'postcode' => 'required|string|max:10',
            'huisnummer' => 'required|string|max:10',
            'wifi' => 'boolean',
            'zwembad' => 'boolean',
            'parkeren' => 'boolean',
            'speeltuin' => 'boolean',
            'beschikbaarheid' => 'boolean',
            'fotos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'naam.required' => 'De naam is verplicht.',
            'prijs.required' => 'De prijs is verplicht.',
            'stad.required' => 'De stad is verplicht.',
            'straatnaam.required' => 'De straatnaam is verplicht.',
            'postcode.required' => 'De postcode is verplicht.',
            'huisnummer.required' => 'Het huisnummer is verplicht.',
            'fotos.*.image' => 'Elke foto moet een afbeelding zijn.',
            'fotos.*.mimes' => 'Elke foto moet een geldig bestandstype hebben (jpeg, png, jpg, gif).',
            'fotos.*.max' => 'Elke foto mag niet groter zijn dan 2 MB.',
        ];
    }
}
