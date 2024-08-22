<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'offer_name' => $this->offer_name,
            'offer_type' => $this->offer_type,
            'company_name' => $this->company_name,
            'offer_code' => $this->offer_code,
            'price' => $this->price,
            'subscription_type' => $this->subscription_type,
            'payment_type' => $this->payment_type,
            'created_at' => $this->created_at,







        ];
    }
}
