<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SerieRequest extends FormRequest
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

        return [
            'serie' => ['required', 'size:4', 'unique:series,serie', $serieRules[$this->voucher_type_id]],
            'current_number' => 'required|integer',
            'voucher_type_id' => 'required',
            'branch_id' => 'required'
        ];
    }

    public function messages()
    {
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

        return [
            'serie.required' => 'Debe ingresar una serie.',
            'serie.size' => 'La serie debe tener 4 caracteres.',
            'serie.unique' => 'No vengas aqui a querer sorprender. La serie ya existe (La serie debe ser unica y no debe repetirse entre sucursales).',
            'serie.regex' => $serieMessages[$this->voucher_type_id]
        ];
    }
}
