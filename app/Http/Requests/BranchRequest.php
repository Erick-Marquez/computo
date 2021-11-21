<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BranchRequest extends FormRequest
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
        $rules = [
            'cod_sunat' => 'required|numeric',
            'description' => 'required',
            'direction' => 'required',
            // 'phone' => 'nullable',
            'ubigeo' => 'required|numeric',

            // Validar series

            'series' => 'required',
            'series.*.voucher_type_id' => 'required|exists:voucher_types,id',
            'series.*.current_number' => 'required|integer|min:1'
        ];

        $serieRules = [
            1 => 'regex:/^[F]/',          // Factura
            2 => 'regex:/^[B]/',          // Boleta
            3 => 'regex:/^[N]/',          // Nota de Venta
            4 => 'regex:/^[F][C]/',       // Nota de Crédito que modifica una Factura
            5 => 'regex:/^[B][C]/',       // Nota de Crédito que modifica una Boleta
            6 => 'regex:/^[F][D]/',       // Nota de Débito que modifica una Factura
            7 => 'regex:/^[B][D]/',       // Nota de Débito que modifica una Boleta
            8 => 'regex:/^[C]/',          // Cotización
            9 => 'regex:/^[G]/'           // Garantía
        ];

        foreach ($this->series as $i => $serie) {
            
            $rules['series.' . $i . '.serie'] = [
                'required',
                'size:4',
                'unique:series,serie',
                $serieRules[$serie['voucher_type_id']]
            ];

        }

        $rules['series.*.serie'] = 'distinct';

        return $rules;
    }

    public function messages()
    {
        $messages = [

            'cod_sunat.required' => 'El codigo SUNAT es requerido.',
            'cod_sunat.numeric' => 'El codigo SUNAT debe ser un número.',

            'description.required' => 'La descripción es requerida.',

            'direction.required' => 'La dirección es requerida.',

            'ubigeo.required' => 'El ubigeo es requerido.',
            'ubigeo.numeric' => 'El ubigeo debe ser un número.',

            'series.required' => 'Las series son requeridas.',

            'series.*.voucher_type_id.required' => 'Las tipo de documento es requerido.',
            'series.*.voucher_type_id.exists' => 'Ingrese un tipo de documento válido.',

            'series.*.current_number.required' => 'El número es requerido.',
            'series.*.current_number.integer' => 'El número debe ser un entero.',
            'series.*.current_number.min' => 'El número debe ser mayor que 1.',


            'series.*.serie.required' => 'Debe ingresar una serie.',
            'series.*.serie.size' => 'La serie debe tener 4 caracteres.',
            'series.*.serie.unique' => 'La serie ya existe (La serie debe ser unica y no debe repetirse entre sucursales).',
            'series.*.serie.distinct' => 'Las series no pueden ser iguales.',

        ];

        $serieMessages = [
            1 => 'La serie de una Factura debe empezar por la letra F',                                          // Factura
            2 => 'La serie de una Boleta debe empezar por la letra B',                                           // Boleta
            3 => 'La serie de una Nota de Venta debe empezar por la letra N',                                    // Nota de Venta
            4 => 'La serie de una Nota de Crédito que modifica una Factura debe empezar por las letras FC',      // Nota de Crédito que modifica una Factura
            5 => 'La serie de una Nota de Crédito que modifica una Boleta debe empezar por las letras BC',       // Nota de Crédito que modifica una Boleta
            6 => 'La serie de una Nota de Débito que modifica una Factura debe empezar por las letras FD',       // Nota de Débito que modifica una Factura
            7 => 'La serie de una Nota de Débito que modifica una Boleta debe empezar por las letras BD',        // Nota de Débito que modifica una Boleta
            8 => 'La serie de una Cotización debe empezar por la letra C',                                       // Cotización
            9 => 'La serie de una Garantía debe empezar por la letra G'                                          // Garantía
        ];

        foreach ($this->series as $i => $serie) {
            
            $messages['series.' . $i . '.serie.regex'] = $serieMessages[$serie['voucher_type_id']];

        }

        return $messages;
    }
}
