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
            'voucherDetail.document_number' => 'required|numeric',
            'voucherDetail.serie' => 'required|string',
            'voucherDetail.handle_exchange_rate' => 'boolean',
            'voucherDetail.exchange_rate' => 'exclude_if:voucherDetail.handle_exchange_rate,false|required|numeric',
            'voucherDetail.date_issue' => 'required|date',
            'voucherDetail.subtotal' => 'numeric',
            'voucherDetail.total' => 'numeric',

            'provider.identification_document_id' => 'required|exists:identification_documents,id',
            'provider.document' => 'required|min:8|max:11',
            'provider.name' => 'required|string',

            'products' => 'array|required',
            'products.*.id' => 'required|distinct|exists:products,id',
            'products.*.referential_purchase_price' => 'required|numeric',
            'products.*.quantity' => 'required|numeric|min:1',
            'products.*.manager_series' => 'required|boolean',
            'products.*.series' => 'bail|exclude_if:products.*.manager_series,0|required|array',
            'products.*.series.*' => 'distinct|string|min:1|unique:branch_product_series,serie',
        ];
    }
}
