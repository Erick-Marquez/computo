<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BranchProductResource extends JsonResource
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
            'name' => $this->product->name,
            'brand' => $this->product->brandLine->brand->description,
            'sale_price' => $this->sale_price,
            'referential_sale_price_one' => $this->referential_sale_price_one,
            'referential_sale_price_two' => $this->referential_sale_price_two,
            'referential_purchase_price' => $this->referential_purchase_price,
            'manager_series' => $this->manager_series,
            'igv_type_id' => $this->igv_type_id,
            'active' => $this->active,
            'stock' => $this->stock,
        ];
    }
}