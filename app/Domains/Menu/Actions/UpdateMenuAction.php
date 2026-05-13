<?php

namespace App\Domains\Menu\Actions;

use App\Domains\Menu\Models\Menu;

use App\Domains\Menu\Services\MenuService;

use App\Domains\Menu\DTOs\UpdateMenuData;

class UpdateMenuAction
{
    public function __construct(
        protected MenuService $menus
    ) {}

    public function execute(
        Menu $menu,
        UpdateMenuData $data
    ): Menu {

        return $this->menus->update(
            $menu,
            $data->toArray()
        );
    }
}