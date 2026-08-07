<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HouseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [

            'id' => $this->id,
            'house_number' => $this->house_number,
            'block' => $this->block,
            'status' => $this->status,
            'residents' => HouseResidentResource::collection(
                $this->whenLoaded('residents')
            ),
        ];
    }
}
