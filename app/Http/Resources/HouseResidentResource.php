<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HouseResidentResource extends JsonResource
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

            'house_id' => $this->house_id,

            'resident_id' => $this->resident_id,

            'house' => [
                'id' => $this->house->id,
                'house_number' => $this->house->house_number,
                'block' => $this->house->block,
            ],

            'resident' => [
                'id' => $this->resident->id,
                'name' => $this->resident->name,
                'nik' => $this->resident->nik,
            ],

            'start_date' => $this->start_date,

            'end_date' => $this->end_date,

            'is_active' => $this->is_active,

        ];
    }
}
