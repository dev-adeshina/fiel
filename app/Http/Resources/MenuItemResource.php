<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            'id' => $this->uuid,

            'name' => $this->name,

            'slug' => $this->slug,

            'sku' => $this->sku,

            'description' => $this->description,

            'price' => $this->price,

            'compare_price' => $this->compare_price,

            'image' => $this->image_path,

            'gallery' => $this->gallery,

            'calories' => $this->calories,

            'preparation_time' => $this->preparation_time,

            'is_featured' => $this->is_featured,

            'is_available' => $this->is_available,

            'status' => $this->status,

            'variants' => MenuItemVariantResource::collection(
                $this->whenLoaded('variants')
            ),

            'modifiers' => MenuItemModifierResource::collection(
                $this->whenLoaded('modifiers')
            ),

            'availability' => MenuItemAvailabilityResource::collection(
                $this->whenLoaded('availabilities')
            ),

            'image_url' => $this->image_path ? asset('storage/' . $this->image_path) : null,
        ];
    }
}
