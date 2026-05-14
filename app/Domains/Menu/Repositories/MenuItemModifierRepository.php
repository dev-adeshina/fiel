<?php

namespace App\Domains\Menu\Repositories;

use App\Domains\Menu\Models\MenuItemModifier;

class MenuItemModifierRepository
{
    public function create(array $data): MenuItemModifier
    {
        return MenuItemModifier::create($data);
    }

    public function update(
        MenuItemModifier $modifier,
        array $data
    ): MenuItemModifier {

        $modifier->update($data);

        return $modifier->refresh();
    }

    public function delete(
        MenuItemModifier $modifier
    ): void {

        $modifier->delete();
    }
}