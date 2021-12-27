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
            'document' => $this->document,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
            'ubigee' => UbigeeResource::make($this->whenLoaded('ubigee')),
            'identification_document' => IdentificationDocumentResource::make($this->whenLoaded('identificationDocument'))
        ];
    }
}
