<?php

namespace App\Http\Requests;

use App\Models\BranchProduct;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StockModificationRequest extends FormRequest
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

            'quantity' => ['required', 'integer', 'min:1'],
            'operation' => ['required'],

            'branch_id' => ['required', 'exists:branches,id'],
            'branch_product_id' => [
                'required',
                Rule::exists('branch_product', 'id')->where(function ($query) {
                    $query->where('branch_id', $this->branch_id);
                }),
            ],

            'series' => ['required', 'distinct'],
            'series.*' => ['required', 'distinct'],

        ];

        if ($this->operation == "ENTRADA") {

            

            for ($i=0; $i < $this->quantity; $i++) { 
                $rules['series.' . $i] = [
                    'required',
                    'distinct',
                    Rule::unique('branch_product_series', 'serie')->where(function ($query) {
                        $query->where('branch_product_id', '=', $this->branch_product_id);
                    })
                ];
            }

        }
        else {

            for ($i=0; $i < $this->quantity; $i++) { 
                $rules['series.' . $i] = [
                    'required',
                    'distinct',
                    Rule::exists('branch_product_series', 'serie')->where(function ($query) {
                        $query->where('branch_product_id', '=', $this->branch_product_id)
                            ->where('active', 1) // que este activo
                            ->where('sold', 0); // que no este vendida
                    })
                        
                ];
            }

        }

        return $rules;
    }

    public function messages()
    {
        return [

            'quantity.required' => 'La cantidad es requerida.',
            'quantity.integer' => 'La cantidad debe ser un número.',
            'quantity.min' => 'La cantidad debe ser mínimo 1.',

            'operation.required' => 'La operación es requerida.',

            'branch_id.required' => 'La sucursal es requerida.',
            'branch_id.exists' => 'La sucursal debe existir.',

            'branch_product_id.required' => 'El producto es requerido.',
            'branch_product_id.exists' => 'El producto debe existir.',

            'series.required' => 'Las series son requeridas.',
            'series.distinct' => 'Las series ingresadas deben ser distintas.',


            'series.*.required' => 'El campo serie es requerido.',
            'series.*.distinct' => 'Las series ingresadas deben ser distintas.',

            'series.*.exists' => 'La serie no existe.',
            'series.*.unique' => 'La serie ya esta registrada.',


        ];
    }
}
