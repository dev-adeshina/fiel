<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
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

            'guest_name' => $this->guest_name,

            'guest_email' => $this->guest_email,

            'guest_phone' => $this->guest_phone,

            'guest_count' => $this->guest_count,

            'reservation_date' => $this->reservation_date,

            'reservation_time' => $this->reservation_time,

            'special_request' => $this->special_request,

            'status' => $this->status,

            'table' => $this->whenLoaded('table', function () {

                return [

                    'id' => $this->table?->id,

                    'name' => $this->table?->name,
                ];
            }),

            'created_at' => $this->created_at,
        ];
    }
}
