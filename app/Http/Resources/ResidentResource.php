<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResidentResource extends JsonResource
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
            'nik' => $this->nik,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'birth_date' => $this->birth_date,
            'ktp_photo' => $this->ktp_photo,
            'resident_status' => $this->resident_status,
            'is_married' => $this->is_married,
        ];
    }
}
