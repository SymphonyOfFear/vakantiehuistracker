<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHuisRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'user_id' => 'required',
            'naam' => 'required|unique:posts|max:255',
            'prijs' => 'required',
            'locatie' => 'required|unique:posts|max:255',
            'beschikbaarheid' => 'required',
            'slaapkamers' => 'required',
            
        ];
    }
}
