<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [

            'id' => $this->id,

            // Needed for edit form
            'house_id' => $this->house_id,
            'payment_type_id' => $this->payment_type_id,

            'house' => [
                'id' => $this->house->id,
                'house_number' => $this->house->house_number,
                'block' => $this->house->block,
            ],

            'payment_type' => [
                'id' => $this->paymentType->id,
                'name' => $this->paymentType->name,
            ],

            'month' => $this->month,

            'year' => $this->year,

            'amount' => $this->amount,

            'paid_at' => $this->paid_at,

            'status' => $this->status,

            'notes' => $this->notes,

            'created_at' => $this->created_at,

            'updated_at' => $this->updated_at,

        ];
    }
}
