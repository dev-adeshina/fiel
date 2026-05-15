<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            'id'
                => $this->id,

            'item_name'
                => $this->item_name,

            'variant_name'
                => $this->variant_name,

            'modifier_names'
                => $this->modifier_names,

            'unit_price'
                => $this->unit_price,

            'quantity'
                => $this->quantity,

            'total_price'
                => $this->total_price,

            'special_instructions'
                => $this->special_instructions,
        ];
    }
}
