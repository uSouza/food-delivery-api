<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocationsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'city' => 'required|max:100|min:3',
            'state' => 'required|max:100|min:3',
            'address' => 'required|max:200|min:3',
            'number' => 'required|max:20',
            'postal_code' => 'required|formato_cep',
        ];
    }
}