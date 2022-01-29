<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'identification_document_id' => 'required|exists:identification_documents,id',
            'document' => 'required|string',
            'phone' => 'max:20',
            'email' => 'max:100',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es requerido',

            'document.required' => 'El # de documento es requerido',
            'document.unique' => 'El # de documento ya existe',

            'identification_document_id.required' => 'El tipo de documento es requerido',
            'identification_document_id.exists' => 'El tipo de documento no existe en los registros',

            'phone.max' => 'El numero de telefono no debe contener mas de 20 caracteres',
            'email' => 'Este es muy largo, max = 100'
        ];
    }
}
