<?php

namespace App\Domains\Menu\Actions;

use App\Domains\Menu\Services\MenuItemVariantService;

use App\Domains\Menu\DTOs\CreateMenuItemVariantData;

use App\Domains\Menu\Models\MenuItemVariant;

class CreateMenuItemVariantAction
{
    public function __construct(
        protected MenuItemVariantService $variants
    ) {}

    public function execute(
        CreateMenuItemVariantData $data
    ): MenuItemVariant {

        return $this->variants->create(
            $data->toArray()
        );
    }
}