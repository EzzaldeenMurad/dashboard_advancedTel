<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OperationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'category' => $this->category,
            'description' => $this->description,
            'phone_namber' => $this->phone_namber,
            'price' => $this->price,
            'service_name' => $this->service_name,
            'status' => $this->status,
            'readiness' => $this->readiness,
            'token' => $this->token,
            'trans_id' => $this->trans_id,
            'date_added' =>   $this->date_added,
            'created_at' => $this->created_at,
        ];
    }
}
