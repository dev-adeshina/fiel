<?php 

namespace App\Domains\Menu\Repositories;

use App\Domains\Menu\Models\Menu;
use Illuminate\Database\Eloquent\Collection;

class MenuRepository 
{
    public function all(): Collection
    {
        return Menu::query()
            ->with('categories.items')
            ->get();
    }

    public function active(): Collection
    {
        return Menu::query()
            ->where('is_active', true)
            ->with('categories.items')
            ->get();
    }

    public function findBySlug(string $slug): ?Menu
    {
        return Menu::query()
            ->where('slug', $slug)
            ->with('categories.items')
            ->first();
    }

    public function create(array $data): Menu
    {
        return Menu::create($data);
    }

    public function update(Menu $menu, array $data): bool
    {
        return $menu->update($data);
    }

    public function delete(Menu $menu): bool
    {
        return $menu->delete();
    }
}