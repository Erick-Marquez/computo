<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseResource extends JsonResource
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
            'document_type' => $this->document_type,
            'document_number' => $this->document_number,
            'serie' => $this->serie,
            'exchange_rate' => $this->exchange_rate,
            'date_issue' => $this->date_issue,
            'total' => $this->total,
            'has_debt' => $this->has_debt,
            'provider' => ProviderResource::make($this->whenLoaded('provider')),
        ];
    }
}
