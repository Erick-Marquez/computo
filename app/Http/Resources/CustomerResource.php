<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'name' => $this->name,
            'type_document' => $this->identificationDocument->description,
            'identification_document_id' => $this->identification_document_id,
            'document' => $this->document,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
            'ubigee' => UbigeeResource::make($this->whenLoaded('ubigee')),
        ];
    }
}
