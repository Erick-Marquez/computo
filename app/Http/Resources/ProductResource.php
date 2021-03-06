<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'cod' => $this->cod,
            'name' => $this->name,
            'description' => $this->description,
            'referential_purchase_price' => $this->referential_purchase_price,
            'referential_sale_price' => $this->referential_sale_price,
            'referential_sale_price_one' => $this->referential_sale_price_one,
            'referential_sale_price_two' => $this->referential_sale_price_two,
            'manager_series' => $this->manager_series,
            'active' => $this->active,
            'igv_type_id' => $this->igv_type_id,

            'brand' => BrandResource::make($this->whenLoaded('brand')),
            'line' => LineResource::make($this->whenLoaded('line')),

            'sale_price' => $this->whenPivotLoaded('assembly_product', function () {
                return $this->pivot->sale_price;
            }),
            'quantity' => $this->whenPivotLoaded('assembly_product', function () {
                return $this->pivot->quantity;
            }),

        ];
    }
}
