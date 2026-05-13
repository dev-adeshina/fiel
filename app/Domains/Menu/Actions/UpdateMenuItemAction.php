<?php

namespace App\Domains\Menu\Actions;

use App\Domains\Menu\Models\MenuItem;

use App\Domains\Menu\Services\MenuItemService;

use App\Domains\Menu\DTOs\UpdateMenuItemData;

class UpdateMenuItemAction
{
    public function __construct(protected MenuItemService $items) {}

    public function execute(MenuItem $item, UpdateMenuItemData $data): MenuItem 
    {
        return $this->items->update(
            $item,
            $data->toArray()
        );
    }
}