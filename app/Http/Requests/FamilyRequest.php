<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FamilyRequest extends FormRequest
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
            'description' => 'required|unique:families,description',
        ];
    }

    public function messages()
    {
        return [

            'description.required' => 'La descripción es requerida.',
            'description.unique' => 'Ya existe la familia ingresada.',

        ];
    }
}
