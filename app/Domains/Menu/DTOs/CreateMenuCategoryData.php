<?php

namespace App\Domains\Menu\DTOs;

use Illuminate\Http\UploadedFile;

use App\Http\Requests\Menu\CreateMenuCategoryRequest;

class CreateMenuCategoryData
{
    public function __construct(
        public readonly int $menuId,

        public readonly string $name,

        public readonly ?string $description,

        public readonly ?UploadedFile $image,

        public readonly int $position,

        public readonly bool $isActive,
    ) {}

    public static function fromRequest(
        CreateMenuCategoryRequest $request
    ): self {

        return new self(

            menuId: $request->menu_id,

            name: $request->name,

            description: $request->description,

            image: $request->file('image'),

            position: $request->input('position', 0),

            isActive: $request->boolean('is_active'),
        );
    }
}