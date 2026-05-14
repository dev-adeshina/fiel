<?php

namespace App\Domains\Menu\DTOs;

use App\Http\Requests\Menu\CreateMenuItemModifierRequest;

class CreateMenuItemModifierData
{
    public function __construct(
        public readonly int $menuItemId,
        public readonly string $name,
        public readonly ?string $description,
        public readonly float $price,
        public readonly bool $isRequired,
        public readonly int $maxSelection,
    ) {}

    public static function fromRequest(
        CreateMenuItemModifierRequest $request
    ): self {

        return new self(

            menuItemId: $request->menu_item_id,

            name: $request->name,

            description: $request->description,

            price: $request->price,

            isRequired: $request->boolean('is_required'),

            maxSelection: $request->input('max_selection', 0),
        );
    }

    public function toArray(): array
    {
        return [

            'menu_item_id' => $this->menuItemId,

            'name' => $this->name,

            'description' => $this->description,

            'price' => $this->price,

            'is_required' => $this->isRequired,

            'max_selection' => $this->maxSelection,
        ];
    }
}