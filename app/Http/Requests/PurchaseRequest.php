<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
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
            'voucherDetail.document_type' => 'required|string',
            'voucherDetail.document_number' => 'required|numeric|min:1',
            'voucherDetail.serie' => 'required|string',
            'voucherDetail.handles_exchange_rate' => 'required|boolean',
            'voucherDetail.exchange_rate' => 'exclude_if:voucherDetail.handle_exchange_rate,false|required|numeric',
            'voucherDetail.date_issue' => 'required|date',
            'voucherDetail.is_credit' => 'required|boolean',
            'voucherDetail.subtotal' => 'numeric',
            'voucherDetail.total' => 'numeric',

            'provider.identification_document_id' => 'required|exists:identification_documents,id',
            'provider.document' => 'required|min:8|max:11',
            'provider.ubigee_id' => 'exists:ubigees,id',
            'provider.name' => 'required|string',
            'provider.phone' => 'max:20',
            'provider.email' => 'max:100',

            'products' => 'array|required',
            'products.*.id' => 'required|distinct|exists:products,id',
            'products.*.referential_purchase_price' => 'required|numeric',
            'products.*.quantity' => 'required|numeric|min:1',
            'products.*.manager_series' => 'required|boolean',
            'products.*.series' => 'bail|exclude_if:products.*.manager_series,0|required|array',
            'products.*.series.*' => 'distinct|string|min:1|unique:branch_product_series,serie',

            'installments.dates' => 'exclude_if:voucherDetail.is_credit,false|required|array',
            'installments.dates.*' => 'exclude_if:voucherDetail.is_credit,false|required|date',
        ];
    }

    public function messages()
    {
        return [
            'voucherDetail.document_type.required' => 'Seleccione un tipo de documento valido',

            'voucherDetail.document_number.required' => 'El # de voucher es necesario',
            'voucherDetail.document_number.numeric' => 'El # de voucher debe ser un numero',
            'voucherDetail.document_number.min' => 'Digite un numero valido mayor a 0',

            'voucherDetail.serie.string' => 'La serie debe ser una cadena',
            'voucherDetail.serie.required' => 'La serie del comprobante es requerida',

            'voucherDetail.handles_exchange_rate.required' => 'Necesita especificar si el comprobante tiene tipo de cambio',
            'voucherDetail.handles_exchange_rate.boolean' => 'Rompio el programa, por favor recargue la pagina',

            'voucherDetail.exchange_rate.required' => 'Especifique numericamente el tipo de cambio',
            'voucherDetail.exchange_rate.numeric' => 'El tipo de cambio debe ser un numero',

            'voucherDetail.date_issue.required' => 'La fecha de emision del comprobante es necesaria',
            'voucherDetail.date_issue.date' => 'Fecha invalida',

            'provider.name.required' => 'El nombre del proveedor es requerido',
            'provider.document.required' => 'El # de documento es requerido',
            'provider.identification_document_id.required' => 'El tipo de documento es requerido',
            'provider.identification_document_id.exists' => 'El tipo de documento no existe en los registros',
            'provider.phone.max' => 'El numero de telefono no debe contener mas de 20 caracteres',
            'provider.email' => 'Este es muy largo, max = 100',


            'products.required' => 'Debe ingresar al menos un producto',
            'products.*.id.exists' => 'EL producto no existe en los registros',

            'products.*.referential_purchase_price.required' => 'El precio unitario es requerido',
            'products.*.referential_purchase_price.numeric' => 'Debe ser un numero',
            'products.*.referential_purchase_price.min' => 'No puede ser negativo',

            'products.*.quantity.required' => 'La cantidad es requerida',
            'products.*.quantity.numeric' => 'Debe ser un numero',
            'products.*.quantity.min' => 'No puede ser negativo',

            'products.*.series.required' => 'Digite las series',
            'products.*.series.*.distinc' => 'La serie debe ser diferente, Asegurese de no poner series repetidas',
            'products.*.series.*.unique' => 'Esta serie ya existe',

            'installments.dates.*' => 'Te falta agregar fechas'
        ];
    }
}
