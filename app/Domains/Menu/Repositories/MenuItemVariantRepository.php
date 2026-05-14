<?php

namespace App\Domains\Menu\Repositories;

use App\Domains\Menu\Models\MenuItemVariant;

class MenuItemVariantRepository
{
    public function create(array $data): MenuItemVariant
    {
        return MenuItemVariant::create($data);
    }

    public function update(
        MenuItemVariant $variant,
        array $data
    ): MenuItemVariant {

        $variant->update($data);

        return $variant->refresh();
    }

    public function delete(
        MenuItemVariant $variant
    ): void {

        $variant->delete();
    }
}