<?php

namespace App\Domains\Menu\Actions;

use App\Domains\Menu\Models\MenuItem;

use App\Domains\Menu\Services\MenuItemService;

class DeleteMenuItemAction
{
    public function __construct(
        protected MenuItemService $items
    ) {}

    public function execute(MenuItem $item): void
    {
        $this->items->delete($item);
    }
}