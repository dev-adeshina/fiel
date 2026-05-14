<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\MenuItemResource;
use App\Http\Resources\MenuItemVariantResource;
use App\Http\Resources\MenuItemModifierResource;




class CartItemResource extends JsonResource
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

            'quantity'
                => $this->quantity,

            'unit_price'
                => $this->unit_price,

            'total_price'
                => $this->total_price,

            'special_instructions'
                => $this->special_instructions,

            'menu_item'
                => new MenuItemResource(
                    $this->whenLoaded(
                        'menuItem'
                    )
                ),

            'variant'
                => new MenuItemVariantResource(
                    $this->whenLoaded(
                        'variant'
                    )
                ),

            'modifiers'
                => MenuItemModifierResource::collection(
                    $this->whenLoaded(
                        'modifiers'
                    )
                ),
        ];
    }
}
