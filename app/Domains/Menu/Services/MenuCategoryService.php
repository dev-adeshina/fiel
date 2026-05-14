<?php 

namespace App\Domains\Menu\Services;

use Illuminate\Support\Str;
use App\Domains\Menu\Models\MenuCategory;
use App\Domains\Menu\Repositories\MenuCategoryRepository;
use App\Shared\Services\ImageUploadService;



class MenuCategoryService 
{
    public function __construct(
        protected MenuCategoryRepository $categories,
        protected ImageUploadService $images
    ) {}

    // public function create(array $data): MenuCategory
    // {
    //     $data['uuid'] = Str::uuid();

    //     $data['slug'] = Str::slug($data['name']);

    //     return $this->categories->create($data);
    // }

    // public function update(MenuCategory $category, array $data): bool
    // {
    //     if (isset($data['name'])) {

    //         $data['slug'] = Str::slug($data['name']);
    //     }

    //     return $this->categories->update($category, $data);
    // }

    // public function delete(MenuCategory $category): bool
    // {
    //     return $this->categories->delete($category);
    // }


    public function create(array $data): MenuCategory
    {
        if (isset($data['image'])) {

            $data['image_path'] = $this->images->upload($data['image'], 'menu-categories');

            unset($data['image']);
        }

        $data['uuid'] = Str::uuid();

        $data['slug'] = Str::slug($data['name']);

        return $this->categories->create($data);
    }

    public function update(MenuCategory $category, array $data): MenuCategory 
    {

        if (isset($data['image'])) {

            $this->images->delete($category->image_path);

            $data['image_path'] = $this->images->upload($data['image'], 'menu-categories');

            unset($data['image']);
        }

        if (isset($data['name'])) 
        {

            $data['slug'] = Str::slug($data['name']);
        }

        return $this->categories->update($category, $data);
    }

    public function delete(MenuCategory $category): void 
    {

        $this->images->delete($category->image_path);

        $this->categories->delete($category);
    }
}