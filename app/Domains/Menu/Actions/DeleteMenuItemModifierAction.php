<?php

namespace App\Domains\Menu\Actions;

use App\Domains\Menu\Models\MenuItemModifier;

use App\Domains\Menu\Services\MenuItemModifierService;

class DeleteMenuItemModifierAction
{
    public function __construct(
        protected MenuItemModifierService $modifiers
    ) {}

    public function execute(
        MenuItemModifier $modifier
    ): void {

        $this->modifiers->delete($modifier);
    }
}