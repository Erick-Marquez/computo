<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdvancePaymentRequest extends FormRequest
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
            'id_quotation' => 'required|exists:quotations,id',

            'payments' => 'required',

            'payments.*.payment_type_id' => 'required',
            'payments.*.amount' => 'required|numeric|min:0|not_in:0'
        ];
    }


    public function messages()
    {

        return [
            'id_quotation.required' => 'Debe ingresar una cotización.',
            'id_quotation.exists' => 'La cotizacion que ingreso no existe.',

            'payments.required' => 'Debe ingresar al menos un anticipo.',

            'payments.*.payment_type_id.required' => 'El tipo de pago es requerido.',

            'payments.*.amount.required' => 'El tipo de monto es requerido.',
            'payments.*.amount.numeric' => 'El monto debe ser numérico.',
            'payments.*.amount.min' => 'El monto debe ser mayor que 0.',
            'payments.*.amount.not_in' => 'El monto no puede ser 0.',
        ];
    }
}
