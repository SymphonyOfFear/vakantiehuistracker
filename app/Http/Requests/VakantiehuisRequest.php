<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VakantiehuisRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'stad' => 'nullable|string|max:255',
            'postcode' => 'nullable|string|max:10',
            'straatnaam' => 'nullable|string|max:255',
            'huisnummer' => 'nullable|string|max:10',
            'min_prijs' => 'nullable|numeric|min:0',
            'max_prijs' => 'nullable|numeric|min:0',
            'wifi' => 'nullable|boolean',
            'zwembad' => 'nullable|boolean',
            'parkeren' => 'nullable|boolean',
            'speeltuin' => 'nullable|boolean',
            'location' => 'nullable|string|max:255'
        ];
    }

    public function messages()
    {
        return [
            'stad.string' => 'De stad moet een tekstwaarde zijn.',
            'postcode.string' => 'De postcode moet een geldige tekstwaarde zijn.',
            'straatnaam.string' => 'De straatnaam moet een geldige tekstwaarde zijn.',
            'huisnummer.string' => 'Het huisnummer moet een geldige tekstwaarde zijn.',
            'min_prijs.numeric' => 'De minimumprijs moet een geldig getal zijn.',
            'max_prijs.numeric' => 'De maximumprijs moet een geldig getal zijn.',
            'wifi.boolean' => 'De wifi-waarde moet true of false zijn.',
            'zwembad.boolean' => 'De zwembad-waarde moet true of false zijn.',
            'parkeren.boolean' => 'De parkeerwaarde moet true of false zijn.',
            'speeltuin.boolean' => 'De speeltuin-waarde moet true of false zijn.',
            'location.string' => 'De locatie moet een geldige tekstwaarde zijn.'
        ];
    }
}
