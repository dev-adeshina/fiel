<?php

namespace App\Domains\Menu\Actions;

use App\Domains\Menu\Models\Menu;

use App\Domains\Menu\Services\MenuService;

class DeleteMenuAction
{
    public function __construct(
        protected MenuService $menus
    ) {}

    public function execute(Menu $menu): void
    {
        $this->menus->delete($menu);
    }
}