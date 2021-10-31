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
            'document_type' => 'required|string',
            'document_number' => 'required|numeric',
            'serie' => 'required|string',
            'exchange_rate' => 'numeric',
            'date_issue' => 'required|date',
            'subtotal' => 'numeric',
            'total' => 'numeric',
            'observation' => 'string',
        ];
    }
}
