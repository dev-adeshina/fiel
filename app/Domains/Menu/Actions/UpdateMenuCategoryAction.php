<?php 

namespace App\Domains\Menu\Actions;

use App\Domains\Menu\DTOs\UpdateMenuCategoryData;
use App\Domains\Menu\Models\MenuCategory;
use App\Domains\Menu\Services\MenuCategoryService;



class UpdateMenuCategoryAction
{
    public function __construct(
        protected MenuCategoryService $categories
    ) {}

    public function execute(MenuCategory $category, UpdateMenuCategoryData $data): MenuCategory 
    {

        return $this->categories->update(
            $category,
            [
                ...$data->toArray(),

                'image' => $data->image,
            ]
        );
    }
}