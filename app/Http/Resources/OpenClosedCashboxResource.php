<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OpenClosedCashboxResource extends JsonResource
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
            'opening_date' => $this->opening_date,
            'opening_amount' => $this->opening_amount,
            'closing_date' => $this->closing_date,
            'closing_amount' => $this->closing_amount,
            'state' => $this->state,
            'cashbox' => CashboxResource::make($this->whenLoaded('cashbox')),
            'user' => UserResource::make($this->whenLoaded('user'))
        ];
    }
}
