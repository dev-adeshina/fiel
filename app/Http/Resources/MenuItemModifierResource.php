<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuItemModifierResource extends JsonResource
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

            'description' => $this->description,

            'price' => $this->price,

            'is_required' => $this->is_required,

            'max_selection' => $this->max_selection,
        ];
    }
}
