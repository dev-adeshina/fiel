<?php

namespace App\Domains\Menu\DTOs;

use App\Http\Requests\Menu\CreateMenuItemVariantRequest;

class CreateMenuItemVariantData
{
    public function __construct(
        public readonly int $menuItemId,
        public readonly string $name,
        public readonly string $sku,
        public readonly float $price,
        public readonly ?float $priceAdjustment,
        public readonly bool $isDefault,
        public readonly int $sortOrder,
    ) {}

    public static function fromRequest(
        CreateMenuItemVariantRequest $request
    ): self {

        return new self(
            menuItemId: $request->menu_item_id,

            name: $request->name,

            sku: $request->sku,

            price: $request->price,

            priceAdjustment: $request->price_adjustment,

            isDefault: $request->boolean('is_default'),

            sortOrder: $request->input('sort_order', 0),
        );
    }

    public function toArray(): array
    {
        return [

            'menu_item_id' => $this->menuItemId,

            'name' => $this->name,

            'sku' => $this->sku,

            'price' => $this->price,

            'price_adjustment' => $this->priceAdjustment,

            'is_default' => $this->isDefault,

            'sort_order' => $this->sortOrder,
        ];
    }
}