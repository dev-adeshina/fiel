<?php

namespace App\Domains\Menu\DTOs;

use App\Http\Requests\Menu\UpdateMenuItemModifierRequest;

class UpdateMenuItemModifierData
{
    public function __construct(
        public readonly ?string $name,
        public readonly ?string $description,
        public readonly ?float $price,
        public readonly ?bool $isRequired,
        public readonly ?int $maxSelection,
    ) {}

    public static function fromRequest(
        UpdateMenuItemModifierRequest $request
    ): self {

        return new self(

            name: $request->input('name'),

            description: $request->input('description'),

            price: $request->input('price'),

            isRequired: $request->input('is_required'),

            maxSelection: $request->input('max_selection'),
        );
    }

    public function toArray(): array
    {
        return array_filter([

            'name' => $this->name,

            'description' => $this->description,

            'price' => $this->price,

            'is_required' => $this->isRequired,

            'max_selection' => $this->maxSelection,

        ], fn ($value) => ! is_null($value));
    }
}