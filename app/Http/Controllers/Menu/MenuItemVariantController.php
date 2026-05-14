<?php

namespace App\Http\Controllers\Menu;

use App\Domains\Menu\Actions\CreateMenuItemVariantAction;
use App\Domains\Menu\Actions\DeleteMenuItemVariantAction;
use App\Domains\Menu\Actions\UpdateMenuItemVariantAction;
use App\Domains\Menu\DTOs\CreateMenuItemVariantData;
use App\Domains\Menu\DTOs\UpdateMenuItemVariantData;
use App\Domains\Menu\Models\MenuItemVariant;
use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateMenuItemVariantRequest;
use App\Http\Requests\Menu\UpdateMenuItemVariantRequest;
use App\Http\Resources\MenuItemVariantResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;



class MenuItemVariantController extends Controller
{
   public function store(CreateMenuItemVariantRequest $request, CreateMenuItemVariantAction $action): JsonResponse 
   {

        $dto = CreateMenuItemVariantData::fromRequest($request);

        $variant = $action->execute($dto);

        return response()->json([
            'message' => 'Variant created successfully.',

            'data' => new MenuItemVariantResource($variant),
        ]);
    }

    public function update(UpdateMenuItemVariantRequest $request, MenuItemVariant $variant, UpdateMenuItemVariantAction $action): JsonResponse 
    {

        $dto = UpdateMenuItemVariantData::fromRequest($request);

        $variant = $action->execute($variant,$dto);

        return response()->json([

            'message' => 'Variant updated successfully.',

            'data' => new MenuItemVariantResource($variant),
        ]);
    }

    public function destroy(MenuItemVariant $variant, DeleteMenuItemVariantAction $action): JsonResponse 
    {

        $action->execute($variant);

        return response()->json([

            'message' => 'Variant deleted successfully.',
        ]);
    }
}
