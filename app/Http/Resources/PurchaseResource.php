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
            'handles_exchange_rate' => $this->handles_exchange_rate,
            'exchange_rate' => $this->exchange_rate,
            'date_issue' => $this->date_issue,
            'subtotal' => $this->subtotal,
            'total' => $this->total,
            'total_igv' => $this->total_igv,
            'provider' => ProviderResource::make($this->whenLoaded('provider')),
            'account_to_pay' => AccountToPayResource::make($this->whenLoaded('accountToPay')),
        ];
    }
}
