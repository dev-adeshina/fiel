<?php

namespace App\Domains\Menu\Actions;

use App\Domains\Menu\Models\MenuItem;

use App\Domains\Menu\Services\MenuItemService;

use App\Domains\Menu\DTOs\CreateMenuItemData;

class CreateMenuItemAction
{
    public function __construct(
        protected MenuItemService $items
    ) {}

    public function execute(
        CreateMenuItemData $data
    ): MenuItem {

        return $this->items->create(
            $data->toArray()
        );
    }
}