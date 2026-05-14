<?php

namespace App\Domains\Menu\DTOs;

use Illuminate\Http\UploadedFile;

use App\Http\Requests\Menu\UpdateMenuCategoryRequest;

class UpdateMenuCategoryData
{
    public function __construct(
        public readonly ?string $name,

        public readonly ?string $description,

        public readonly ?UploadedFile $image,

        public readonly ?int $position,

        public readonly ?bool $isActive,
    ) {}

    public static function fromRequest(
        UpdateMenuCategoryRequest $request
    ): self {

        return new self(

            name: $request->input('name'),

            description: $request->input('description'),

            image: $request->file('image'),

            position: $request->input('position'),

            isActive: $request->input('is_active'),
        );
    }

    public function toArray(): array
    {
        return array_filter([

            'name' => $this->name,

            'description' => $this->description,

            'position' => $this->position,

            'is_active' => $this->isActive,

        ], fn ($value) => ! is_null($value));
    }
}