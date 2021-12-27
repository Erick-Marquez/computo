<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ExpenseIncomeRequest extends FormRequest
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
            'type' => ['required', Rule::in(['INGRESO', 'EGRESO'])],
            'amount' => 'required|min:0|numeric',
            'observation' => 'required|min:1|string',
            'payment_type_id' => 'required|exists:payment_types,id'
        ];
    }
}
