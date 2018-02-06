<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompaniesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255|min:3',
            'phone' => 'required|telefone_com_ddd',
            'cnpj' => 'required|cnpj|formato_cnpj',
            'responsible_name' => 'required|max:255|min:3',
            'responsible_phone' => 'required|celular_com_ddd',
        ];
    }
}
