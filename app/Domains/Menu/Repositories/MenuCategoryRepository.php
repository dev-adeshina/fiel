<?php 

namespace App\Domains\Menu\Repositories;


use App\Domains\Menu\Models\MenuCategory;
use Illuminate\Database\Eloquent\Collection;

class MenuCategoryRepository 
{
    public function all(): Collection
    {
        return MenuCategory::query()
            ->with('items')
            ->get();
    }

    public function active(): Collection
    {
        return MenuCategory::query()
            ->where('is_active', true)
            ->with('items')
            ->get();
    }

    public function findBySlug(string $slug): ?MenuCategory
    {
        return MenuCategory::query()
            ->where('slug', $slug)
            ->with('items')
            ->first();
    }

    public function create(array $data): MenuCategory
    {
        return MenuCategory::create($data);
    }

    public function update(MenuCategory $category, array $data): MenuCategory
    {

        $category->update($data);

        return $category->refresh();
    }

    public function delete(MenuCategory $category): bool
    {
        return $category->delete();
    }
}