<?php 

namespace App\Domains\Menu\Actions;

use App\Domains\Menu\Models\MenuCategory;
use App\Domains\Menu\Services\MenuCategoryService;


class DeleteMenuCategoryAction
{
    public function __construct(
        protected MenuCategoryService $categories
    ) {}

    public function execute(
        MenuCategory $category
    ): void {

        $this->categories->delete($category);
    }
}