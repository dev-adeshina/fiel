<?php

namespace App\Http\Controllers\Menu;

use App\Domains\Menu\Actions\CreateMenuCategoryAction;
use App\Domains\Menu\Actions\DeleteMenuCategoryAction;
use App\Domains\Menu\Actions\UpdateMenuCategoryAction;
use App\Domains\Menu\DTOs\CreateMenuCategoryData;
use App\Domains\Menu\DTOs\UpdateMenuCategoryData;
use App\Domains\Menu\Models\MenuCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateMenuCategoryRequest;
use App\Http\Requests\Menu\UpdateMenuCategoryRequest;
use App\Http\Resources\MenuCategoryResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;



class MenuCategoryController extends Controller
{
    //

    public function store(CreateMenuCategoryRequest $request, CreateMenuCategoryAction $action): JsonResponse 
    {

        $dto = CreateMenuCategoryData::fromRequest($request);

        $category = $action->execute($dto);

        return response()->json([

            'message' => 'Category created successfully.',

            'data' => new MenuCategoryResource($category),
        ]);
    }

    public function update(UpdateMenuCategoryRequest $request, MenuCategory $category, UpdateMenuCategoryAction $action): JsonResponse 
    {

        $dto = UpdateMenuCategoryData::fromRequest($request);

        $category = $action->execute(
            $category,
            $dto
        );

        return response()->json([

            'message' => 'Category updated successfully.',

            'data' => new MenuCategoryResource($category),
        ]);
    }

    public function destroy(MenuCategory $category, DeleteMenuCategoryAction $action): JsonResponse 
    {

        $action->execute($category);

        return response()->json([

            'message' => 'Category deleted successfully.',
        ]);
    }
}
