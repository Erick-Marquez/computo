<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KardexResource extends JsonResource
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
            'date' => $this->date,
            'quantity' => $this->quantity,
            'movement_type' => $this->movement_type,
            'description' => $this->description,
            'document' => $this->document,
            'series' => $this->series
        ];
    }
}