<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReserveringRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'vakantiehuis_id' => 'required|exists:vakantiehuizen,id',
            'begindatum' => 'required|date|after_or_equal:today',
            'einddatum' => 'required|date|after:begindatum',
            'status' => 'in:bevestigd,in_afwachting,geannuleerd',
        ];
    }
}
