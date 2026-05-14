<?php

namespace App\Http\Controllers\Menu;

use App\Domains\Menu\Actions\CreateMenuItemModifierAction;
use App\Domains\Menu\Actions\DeleteMenuItemModifierAction;
use App\Domains\Menu\Actions\UpdateMenuItemModifierAction;
use App\Domains\Menu\DTOs\CreateMenuItemModifierData;
use App\Domains\Menu\DTOs\UpdateMenuItemModifierData;
use App\Domains\Menu\Models\MenuItemModifier;
use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateMenuItemModifierRequest;
use App\Http\Requests\Menu\UpdateMenuItemModifierRequest;
use App\Http\Resources\MenuItemModifierResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class MenuItemModifierController extends Controller
{
    //
    public function store(CreateMenuItemModifierRequest $request, CreateMenuItemModifierAction $action): JsonResponse 
    {

        $dto = CreateMenuItemModifierData::fromRequest($request);

        $modifier = $action->execute($dto);

        return response()->json([

            'message' => 'Modifier created successfully.',

            'data' => new MenuItemModifierResource($modifier),
        ]);
    }

    public function update(UpdateMenuItemModifierRequest $request, MenuItemModifier $modifier, UpdateMenuItemModifierAction $action): JsonResponse 
    {

        $dto = UpdateMenuItemModifierData::fromRequest(
            $request
        );

        $modifier = $action->execute(
            $modifier,
            $dto
        );

        return response()->json([

            'message' => 'Modifier updated successfully.',

            'data' => new MenuItemModifierResource($modifier),
        ]);
    }

    public function destroy(MenuItemModifier $modifier, DeleteMenuItemModifierAction $action): JsonResponse 
    {

        $action->execute($modifier);

        return response()->json([

            'message' => 'Modifier deleted successfully.',
        ]);
    }
}
