<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ImageResource;
class AssemblyResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'products' => ProductResource::collection($this->whenLoaded('products')),
            'image' => ImageResource::make($this->whenLoaded('image')),
        ];
    }
}
