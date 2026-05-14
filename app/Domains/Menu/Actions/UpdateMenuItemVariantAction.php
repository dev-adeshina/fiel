<?php

namespace App\Domains\Menu\Actions;

use App\Domains\Menu\Models\MenuItemVariant;

use App\Domains\Menu\Services\MenuItemVariantService;

use App\Domains\Menu\DTOs\UpdateMenuItemVariantData;

class UpdateMenuItemVariantAction
{
    public function __construct(
        protected MenuItemVariantService $variants
    ) {}

    public function execute(
        MenuItemVariant $variant,
        UpdateMenuItemVariantData $data
    ): MenuItemVariant {

        return $this->variants->update(
            $variant,
            $data->toArray()
        );
    }
}