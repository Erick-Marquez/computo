<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UbigeeResource extends JsonResource
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
            'cod' => $this->cod,
            'place_description' => $this->place_description,
        ];
    }
}
