<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QuotationRequest extends FormRequest
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

            'quotation.date_due' => ['required', 'date', 'after_or_equal:' . now()->toDateString()],

            'quotation.discount' => ['nullable', 'numeric', 'min:0'],

            'quotation.warranty' => ['required', 'boolean'],

            'quotation.serie_id' => [
                'required', 
                Rule::exists('series', 'id')->where(function ($query) {
                    $query->where('branch_id', auth()->user()->branch_id)->where('voucher_type_id', 8); // id 8  = cotización
                }),
            ],

            // Cotizacion detalle

            'detail' => ['required'],

            'detail.*.discount' => ['nullable', 'numeric', 'min:0'],
            'detail.*.sale_price' => ['required', 'numeric', 'min:0', 'not_in:0'],
            'detail.*.quantity' => ['required', 'integer', 'min:1'],

            'detail.*.igv_type_id' => ['required', 'exists:igv_types,id'],
            'detail.*.product_id' => [
                'required',
                Rule::exists('branch_product', 'id')->where(function ($query) {
                    $query->where('branch_id', auth()->user()->branch_id)->where('stock','>',0); // con stock mayor a 0
                }),
                'distinct'
            ],
        ];
    }

    public function messages()
    {
        return [

            'quotation.date_due.required' => 'La fecha de validez es requerida.',
            'quotation.date_due.after_or_equal' => 'La fecha de validez debe ser mayor o igual a ' . now()->toDateString() .'.',

            'quotation.discount.numeric' => 'Ingrese un descuento válido.',
            'quotation.discount.min' => 'Debe ingresar un descuento mayor que 0.',

            'quotation.warranty.required' => 'El campo garantía es requerido.',
            'quotation.warranty.boolean' => 'El campo garantía debe ser un booleano.',

            'quotation.payment_type_id.required' => 'El tipo de pago es requerido.',
            'quotation.payment_type_id.exists' => 'Ingrese un tipo de pago válido.',

            'quotation.serie_id.required' => 'La serie es requerida.',
            'quotation.serie_id.exists' => 'Ingrese una serie válida.',

            // Cotizacion Detalle

            'detail.required' => 'Debe ingresar al menos un producto.',

            'detail.*.discount.numeric' => 'Ingrese un descuento válido.',
            'detail.*.discount.min' => 'Debe ingresar un descuento mayor que 0.',

            'detail.*.sale_price.required' => 'Debe ingresar un precio para el producto.',
            'detail.*.sale_price.numeric' => 'Ingrese un precio válido.',
            'detail.*.sale_price.min' => 'Debe ingresar un precio mayor que 0.',
            'detail.*.sale_price.not_in' => 'El precio no puede ser 0.',

            'detail.*.quantity.required' => 'Debe ingresar una cantidad.',
            'detail.*.quantity.integer' => 'Debe ingresar un número entero.',
            'detail.*.quantity.min' => 'Debe ingresar una cantidad mayor que 0.',

            'detail.*.igv_type_id.required' => 'Debe seleccionar un tipo de IGV.',
            'detail.*.igv_type_id.exists' => 'Debe seleccionar un tipo de IGV válido.',

            'detail.*.product_id.required' => 'Debe ingresar un producto.',
            'detail.*.product_id.exists' => 'Ingrese un producto válido.',
            'detail.*.product_id.distinct' => 'Los productos no deben ser iguales.',

        ];
    }
}
