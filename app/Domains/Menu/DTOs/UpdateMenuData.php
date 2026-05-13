<?php

namespace App\Domains\Menu\DTOs;

use App\Http\Requests\Menu\UpdateMenuRequest;

class UpdateMenuData
{
    public function __construct(
        public readonly ?string $name,
        public readonly ?string $description,
        public readonly ?bool $isActive,
        public readonly ?string $startDate,
        public readonly ?string $endDate,
    ) {}

    public static function fromRequest(
        UpdateMenuRequest $request
    ): self {

        return new self(
            name: $request->input('name'),

            description: $request->input('description'),

            isActive: $request->input('is_active'),

            startDate: $request->input('start_date'),

            endDate: $request->input('end_date'),
        );
    }

    public function toArray(): array
    {
        return array_filter([

            'name' => $this->name,

            'description' => $this->description,

            'is_active' => $this->isActive,

            'start_date' => $this->startDate,

            'end_date' => $this->endDate,

        ], fn ($value) => ! is_null($value));
    }
}