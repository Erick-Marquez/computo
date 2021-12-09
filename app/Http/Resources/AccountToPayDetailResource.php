<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AccountToPayDetailResource extends JsonResource
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
            'installment' => $this->installment,
            'amount' => $this->amount,
            'date_issue' => $this->date_issue,
            'account_to_pay_id' => $this->account_to_pay_id,
            'payment' => PaymentTypeResource::make($this->whenLoaded('paymentType')),
            'payd' => $this->payd,
        ];
    }
}
