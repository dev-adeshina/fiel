<?php

namespace App\Domains\Menu\DTOs;

use App\Http\Requests\Menu\UpdateMenuItemVariantRequest;

class UpdateMenuItemVariantData
{
    public function __construct(
        public readonly ?string $name,
        public readonly ?string $sku,
        public readonly ?float $price,
        public readonly ?float $priceAdjustment,
        public readonly ?bool $isDefault,
        public readonly ?int $sortOrder,
    ) {}

    public static function fromRequest(
        UpdateMenuItemVariantRequest $request
    ): self {

        return new self(

            name: $request->input('name'),

            sku: $request->input('sku'),

            price: $request->input('price'),

            priceAdjustment: $request->input('price_adjustment'),

            isDefault: $request->input('is_default'),

            sortOrder: $request->input('sort_order'),
        );
    }

    public function toArray(): array
    {
        return array_filter([

            'name' => $this->name,

            'sku' => $this->sku,

            'price' => $this->price,

            'price_adjustment' => $this->priceAdjustment,

            'is_default' => $this->isDefault,

            'sort_order' => $this->sortOrder,

        ], fn ($value) => ! is_null($value));
    }
}