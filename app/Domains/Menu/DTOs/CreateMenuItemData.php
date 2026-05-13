<?php

namespace App\Domains\Menu\DTOs;

use App\Http\Requests\Menu\CreateMenuItemRequest;

class CreateMenuItemData
{
    public function __construct(
        public readonly int $menuCategoryId,
        public readonly string $name,
        public readonly ?string $description,
        public readonly float $price,
        public readonly ?float $comparePrice,
        public readonly ?float $costPrice,
        public readonly ?int $calories,
        public readonly ?int $preparationTime,
        public readonly bool $isFeatured,
        public readonly bool $isAvailable,
        public readonly string $status,
    ) {}

    public static function fromRequest(
        CreateMenuItemRequest $request
    ): self {

        return new self(
            menuCategoryId: $request->integer('menu_category_id'),

            name: $request->string('name')->value(),

            description: $request->string('description')->value(),

            price: (float) $request->price,

            comparePrice: $request->compare_price,

            costPrice: $request->cost_price,

            calories: $request->calories,

            preparationTime: $request->preparation_time,

            isFeatured: $request->boolean('is_featured'),

            isAvailable: $request->boolean('is_available', true),

            status: $request->input('status', 'published'),
        );
    }

    public function toArray(): array
    {
        return [

            'menu_category_id' => $this->menuCategoryId,

            'name' => $this->name,

            'description' => $this->description,

            'price' => $this->price,

            'compare_price' => $this->comparePrice,

            'cost_price' => $this->costPrice,

            'calories' => $this->calories,

            'preparation_time' => $this->preparationTime,

            'is_featured' => $this->isFeatured,

            'is_available' => $this->isAvailable,

            'status' => $this->status,
        ];
    }
}