<?php 

namespace App\Domains\Menu\Actions;

use App\Domains\Menu\DTOs\CreateMenuCategoryData;
use App\Domains\Menu\Models\MenuCategory;
use App\Domains\Menu\Services\MenuCategoryService;



class CreateMenuCategoryAction
{
    public function __construct(
        protected MenuCategoryService $categories
    ) {}

    public function execute(CreateMenuCategoryData $data): MenuCategory 
    {

        return $this->categories->create([
            'menu_id' => $data->menuId,
            'name' => $data->name,
            'description' => $data->description,
            'image' => $data->image,
            'position' => $data->position,
            'is_active' => $data->isActive,
        ]);
    }
}