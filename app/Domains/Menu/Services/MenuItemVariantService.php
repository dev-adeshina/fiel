<?php

namespace App\Domains\Menu\Services;

use Illuminate\Support\Str;

use App\Domains\Menu\Models\MenuItemVariant;

use App\Domains\Menu\Repositories\MenuItemVariantRepository;

class MenuItemVariantService
{
    public function __construct(
        protected MenuItemVariantRepository $variants
    ) {}

    public function create(array $data): MenuItemVariant
    {
        $data['uuid'] = Str::uuid();

        return $this->variants->create($data);
    }

    public function update(
        MenuItemVariant $variant,
        array $data
    ): MenuItemVariant {

        return $this->variants->update(
            $variant,
            $data
        );
    }

    public function delete(
        MenuItemVariant $variant
    ): void {

        $this->variants->delete($variant);
    }
}