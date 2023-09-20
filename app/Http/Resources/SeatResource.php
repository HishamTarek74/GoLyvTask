<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SeatResource extends JsonResource
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
            'seat_no' => $this->seat_no,
            'is_available' => $this->is_available,
            'bus_id' => $this->bus_id,
            'bus_name' => $this->bus->name,
        ];
    }
}
