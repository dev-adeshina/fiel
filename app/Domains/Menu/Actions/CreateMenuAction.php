<?php

namespace App\Domains\Menu\Actions;

use App\Domains\Menu\Models\Menu;
use App\Domains\Menu\Services\MenuService;
use App\Domains\Menu\DTOs\CreateMenuData;

class CreateMenuAction
{
    public function __construct(
        protected MenuService $menus
    ) {}

    public function execute(
        CreateMenuData $data
    ): Menu {

        return $this->menus->create(
            $data->toArray()
        );
    }
}