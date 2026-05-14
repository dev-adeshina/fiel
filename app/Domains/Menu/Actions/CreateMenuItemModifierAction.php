<?php

namespace App\Domains\Menu\Actions;

use App\Domains\Menu\Models\MenuItemModifier;

use App\Domains\Menu\Services\MenuItemModifierService;

use App\Domains\Menu\DTOs\CreateMenuItemModifierData;

class CreateMenuItemModifierAction
{
    public function __construct(
        protected MenuItemModifierService $modifiers
    ) {}

    public function execute(
        CreateMenuItemModifierData $data
    ): MenuItemModifier {

        return $this->modifiers->create(
            $data->toArray()
        );
    }
}