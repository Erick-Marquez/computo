<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LineRequest extends FormRequest
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
            'description' => 'required|unique:lines,description',
            'family_id' => 'required'
        ];
    }

    public function messages()
    {
        return [

            'description.required' => 'La descripción es requerida.',
            'description.unique' => 'Ya existe la linea ingresada.',

            'family_id.required' => 'La familia es requerida.'

        ];
    }
}
