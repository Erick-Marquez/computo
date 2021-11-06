<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyExchangeRequest extends FormRequest
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
            'change' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'change.required' => 'Debe ingresar un tipo de cambio.',
            'change.numeric' => 'El tipo de cambio debe ser un número.',
        ];
    }
}
