<?php

namespace App\Domains\Menu\DTOs;

use App\Http\Requests\Menu\CreateMenuRequest;

class CreateMenuData
{
    public function __construct(
        public readonly string $name,
        public readonly ?string $description,
        public readonly bool $isActive,
        public readonly ?string $startDate,
        public readonly ?string $endDate,
    ) {}

    public static function fromRequest(
        CreateMenuRequest $request
    ): self {

        return new self(
            name: $request->string('name')->value(),

            description: $request->string('description')->value(),

            isActive: $request->boolean('is_active'),

            startDate: $request->input('start_date'),

            endDate: $request->input('end_date'),
        );
    }

    public function toArray(): array
    {
        return [

            'name' => $this->name,

            'description' => $this->description,

            'is_active' => $this->isActive,

            'start_date' => $this->startDate,

            'end_date' => $this->endDate,
        ];
    }
}