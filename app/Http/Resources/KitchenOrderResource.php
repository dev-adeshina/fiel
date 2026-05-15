<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KitchenOrderResource extends JsonResource
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
            'order_number' => $this->uuid,
            'status' => $this->status,
            'customer_name' => $this->customer_name,
            'created_at' => $this->created_at,
            'preparation_started_at' => $this->preparation_started_at,
            'estimated_preparation_time' => $this->estimated_preparation_time,
            'elapsed_minutes' => $this->preparation_started_at ? now()->diffInMinutes($this->preparation_started_at) : null,


            'items' => $this->items->map(fn ($item) => [
                        'id' => $item->id,
                        'name' => $item->menuItem->name ?? null,
                        'quantity' => $item->quantity,
                        'notes' => $item->notes,
                        'variant' => $item->variant?->name,
                        'modifiers' => $item->modifiers->pluck('name'),
                    ]
                ),
        ];
    }
}
