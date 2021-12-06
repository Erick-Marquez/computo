<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AccountToPayResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'debt' => $this->debt,
            'residue' => $this->residue,
            'active' => $this->active,
            'created' => $this->created_at,
            'purchase' => PurchaseResource::make($this->whenLoaded('purchase')),
            'details' => AccountToPayDetailResource::collection($this->whenLoaded('accountToPayDetails'))
        ];
    }
}
