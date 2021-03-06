<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CashboxResource extends JsonResource
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
            'description' => $this->description,
            'state' => $this->is_open,
            'balance' => $this->balance($this->id),
            'details' => OpenClosedCashboxResource::collection($this->whenLoaded('openClosedCashboxes')),
        ];
    }
}
