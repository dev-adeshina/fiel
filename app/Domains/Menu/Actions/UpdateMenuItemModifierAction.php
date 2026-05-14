<?php

namespace App\Domains\Menu\Actions;

use App\Domains\Menu\Models\MenuItemModifier;

use App\Domains\Menu\Services\MenuItemModifierService;

use App\Domains\Menu\DTOs\UpdateMenuItemModifierData;

class UpdateMenuItemModifierAction
{
    public function __construct(
        protected MenuItemModifierService $modifiers
    ) {}

    public function execute(
        MenuItemModifier $modifier,

        UpdateMenuItemModifierData $data
    ): MenuItemModifier {

        return $this->modifiers->update(
            $modifier,
            $data->toArray()
        );
    }
}