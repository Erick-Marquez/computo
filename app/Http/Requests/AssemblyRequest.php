<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssemblyRequest extends FormRequest
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
            'cod' => 'required|unique:assemblies,cod',
            'price' => 'required|numeric|min:0',

            'products' => 'array|required',
            'products.*.id' => 'required|distinct|exists:products,id',
            'products.*.sale_price' => 'required|numeric',
            'products.*.quantity' => 'required|numeric|min:1',
        ];
    }
}
