<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
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
            'month' => $this->month,
            'year' => $this->year,
            'amount' => $this->amount,
            'paid_at' => $this->paid_at,
            'status' => $this->status,
            'notes' => $this->notes,

            'house' => $this->whenLoaded('house', function () {
                return [
                    'id' => $this->house->id,
                    'house_number' => $this->house->house_number,
                ];
            }),

            'payment_type' => $this->whenLoaded('paymentType', function () {
                return [
                    'id' => $this->paymentType->id,
                    'name' => $this->paymentType->name,
                    'default_amount' => $this->paymentType->default_amount,
                ];
            }),
        ];
    }
}
