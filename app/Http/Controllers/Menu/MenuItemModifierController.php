<?php

namespace App\Http\Controllers\Menu;

use App\Domains\Menu\Actions\CreateMenuItemModifierAction;
use App\Domains\Menu\DTOs\CreateMenuItemModifierData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateMenuItemModifierRequest;
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
}
