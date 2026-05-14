<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuItemVariantResource extends JsonResource
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

            'uuid' => $this->uuid,

            'name' => $this->name,

            'sku' => $this->sku,

            'price' => $this->price,

            'price_adjustment' => $this->price_adjustment,

            'is_default' => $this->is_default,

            'sort_order' => $this->sort_order,
        ];
    }
}
