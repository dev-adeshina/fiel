<?php 

namespace App\Domains\Menu\Services;

use Illuminate\Support\Str;
use App\Domains\Menu\Models\MenuCategory;
use App\Domains\Menu\Repositories\MenuCategoryRepository;

class MenuCategoryService 
{
    public function __construct(
        protected MenuCategoryRepository $categories
    ) {}

    public function create(array $data): MenuCategory
    {
        $data['uuid'] = Str::uuid();

        $data['slug'] = Str::slug($data['name']);

        return $this->categories->create($data);
    }

    public function update(MenuCategory $category, array $data): bool
    {
        if (isset($data['name'])) {

            $data['slug'] = Str::slug($data['name']);
        }

        return $this->categories->update($category, $data);
    }

    public function delete(MenuCategory $category): bool
    {
        return $this->categories->delete($category);
    }
}