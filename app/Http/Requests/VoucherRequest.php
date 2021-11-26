<?php

namespace App\Http\Requests;

use App\Models\BranchProduct;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VoucherRequest extends FormRequest
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

            //'voucher.date_due' => ['required', 'date', 'after_or_equal:' . now()->toDateString()],

            'voucher.discount' => ['nullable', 'numeric', 'min:0'],

            'voucher.warranty' => ['required', 'boolean'],

            

            'voucher.payment.*.payment_type_id' => ['required', 'exists:payment_types,id'],

            'voucher.document_type' => [
                'required', 
                Rule::exists('voucher_types', 'id')->where(function ($query) {
                    $query->whereIn('id', [1, 2, 3]); // id 1, 2, 3  = factura, boleta, nota de venta
                }),
            ],

            'voucher.serie_id' => [
                'required', 
                Rule::exists('series', 'id')->where(function ($query) {
                    $query->where('branch_id', auth()->user()->branch_id)->whereIn('voucher_type_id', [1, 2, 3]); // id 1, 2, 3  = factura, boleta, nota de venta
                }), 
            ],

            // Validar Cliente

            'customer.identification_document_id' => 'required|exists:identification_documents,id',
            'customer.document' => 'required|min:8|max:11',
            'customer.name' => 'required|string',

            // Voucher detalle

            'detail' => ['required'],

            'detail.*.discount' => ['nullable', 'numeric', 'min:0'],
            'detail.*.sale_price' => ['required', 'numeric', 'min:0', 'not_in:0'],
            'detail.*.quantity' => ['required', 'integer', 'min:1'],

            'detail.*.igv_type_id' => ['required', 'exists:igv_types,id'],
            'detail.*.product_id' => [
                'required',
                Rule::exists('branch_product', 'id')->where(function ($query) {
                    $query->where('branch_id', auth()->user()->branch_id)->where('stock', '>', 0); // con stock mayor a 0
                }),
                'distinct'
            ],
            
        ];

        // TODO: Validar las series solo si el producto maneja series
        
        foreach ($this->detail as $i => $detail) {
            
            $branchProduct = BranchProduct::where('id', $detail['product_id'])->with('product')->first();

            if ($branchProduct->product->manager_series) {
                $rules['detail.' . $i . '.series.*.serie'] = [
                    'required',
                    Rule::exists('branch_product_series', 'serie')
                    ->where('branch_product_id', $detail['product_id']) // que pertenesca al producto
                    ->where('active', 1) // que este activo
                    ->where('sold', 0), // que no este vendida
                    'distinct'
                ];
            }

        }

        return $rules;
    }

    public function messages()
    {
        return [

            'voucher.date_due.required' => 'La fecha de validez es requerida.',
            'voucher.date_due.after_or_equal' => 'La fecha de validez debe ser mayor o igual a ' . now()->toDateString() .'.',

            'voucher.discount.numeric' => 'Ingrese un descuento válido.',
            'voucher.discount.min' => 'Debe ingresar un descuento mayor que 0.',

            'voucher.warranty.required' => 'El campo garantía es requerido.',
            'voucher.warranty.boolean' => 'El campo garantía debe ser un booleano.',

            'voucher.payment_type_id.required' => 'El tipo de pago es requerido.',
            'voucher.payment_type_id.exists' => 'Ingrese un tipo de pago válido.',

            'voucher.document_type.required' => 'El tipo de comprobante es requerida.',
            'voucher.document_type.exists' => 'Ingrese una tipo de comprobante válido.',

            'voucher.serie_id.required' => 'La serie es requerida.',
            'voucher.serie_id.exists' => 'Ingrese una serie válida.',

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

            // Serie de los productos

            'detail.*.series.*.serie.required' => 'El campo serie es requerido.',
            'detail.*.series.*.serie.exists' => 'Ingrese una serie válida.',
            'detail.*.series.*.serie.distinct' => 'Las series ingresadas deben ser distintas.',

        ];
    }
}
