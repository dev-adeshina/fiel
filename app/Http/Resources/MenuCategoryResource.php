<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuCategoryResource extends JsonResource
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

            'description' => $this->description,

            'image' => $this->image_path,

            'position' => $this->position,

            'is_active' => $this->is_active,

            'items' => MenuItemResource::collection(
                $this->whenLoaded('items')
            ),
            'image_url' => $this->image_path
                ? asset('storage/' . $this->image_path)
                : null,
            'menu_items' => MenuItemResource::collection(
                $this->whenLoaded('menuItems')
            ),
        ];
    }
}
