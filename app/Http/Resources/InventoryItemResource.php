<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InventoryItemResource extends JsonResource
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

            'name' => $this->name,

            'sku' => $this->sku,

            'stock_quantity' => $this->stock_quantity,

            'minimum_quantity' => $this->minimum_quantity,

            'unit' => $this->unit,

            'created_at' => $this->created_at,
        ];
    }
}
