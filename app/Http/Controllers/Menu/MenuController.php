<?php

namespace App\Http\Controllers\Menu;

use App\Domains\Menu\Actions\CreateMenuAction;
use App\Domains\Menu\DTOs\CreateMenuData;
use App\Domains\Menu\Repositories\MenuRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateMenuRequest;
use App\Http\Resources\MenuResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;



class MenuController extends Controller
{
    public function __construct(
        protected MenuRepository $menus
    ) {}

    public function index(): JsonResponse
    {
        $menus = $this->menus->all();

        return response()->json([
            'message' => 'Menus retrieved successfully.',

            'data' => MenuResource::collection($menus),
        ]);
    }

    public function store(
        CreateMenuRequest $request,
        CreateMenuAction $action
    ): JsonResponse {

        $dto = CreateMenuData::fromRequest($request);

        $menu = $action->execute($dto);

        return response()->json([
            'message' => 'Menu created successfully.',

            'data' => new MenuResource($menu),
        ], 201);
    }

}
