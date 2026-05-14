<?php

namespace App\Domains\Menu\Services;

use Illuminate\Support\Str;

use App\Domains\Menu\Models\MenuItemModifier;

use App\Domains\Menu\Repositories\MenuItemModifierRepository;

class MenuItemModifierService
{
    public function __construct(
        protected MenuItemModifierRepository $modifiers
    ) {}

    public function create(array $data): MenuItemModifier
    {
        $data['uuid'] = Str::uuid();

        return $this->modifiers->create($data);
    }

    public function update(
        MenuItemModifier $modifier,
        array $data
    ): MenuItemModifier {

        return $this->modifiers->update(
            $modifier,
            $data
        );
    }

    public function delete(
        MenuItemModifier $modifier
    ): void {

        $this->modifiers->delete($modifier);
    }
}