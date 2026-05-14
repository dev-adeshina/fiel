<?php

namespace App\Domains\Menu\Actions;

use App\Domains\Menu\Models\MenuItemVariant;

use App\Domains\Menu\Services\MenuItemVariantService;

class DeleteMenuItemVariantAction
{
    public function __construct(
        protected MenuItemVariantService $variants
    ) {}

    public function execute(
        MenuItemVariant $variant
    ): void {

        $this->variants->delete($variant);
    }
}