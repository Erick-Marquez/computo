<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BranchResource extends JsonResource
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
            'cod_sunat' => $this->cod_sunat,
            'description' => $this->description,
            'phone' => $this->phone,
            'direction' => $this->direction,
            'ubigeo' => $this->ubigeo,
            'state' => $this->state,
        ];
    }
}
