<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InventoryMovementResource extends JsonResource
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

            'inventory_item_id' => $this->inventory_item_id,

            'type' => $this->type,

            'quantity' => $this->quantity,

            'note' => $this->note,

            'created_at' => $this->created_at,
        ];
    }
}
