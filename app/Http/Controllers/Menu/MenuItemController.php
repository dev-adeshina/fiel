<?php

namespace App\Http\Controllers\Menu;


use Illuminate\Http\Request;

use Illuminate\Http\JsonResponse;

use App\Http\Controllers\Controller;

use App\Http\Resources\MenuItemResource;

use App\Http\Requests\Menu\CreateMenuItemRequest;

use App\Domains\Menu\DTOs\CreateMenuItemData;

use App\Domains\Menu\Actions\CreateMenuItemAction;

use App\Domains\Menu\Repositories\MenuItemRepository;


class MenuItemController extends Controller
{
    public function __construct(
        protected MenuItemRepository $items
    ) {}

    public function index(): JsonResponse
    {
        $items = $this->items->paginate();

        return response()->json([
            'message' => 'Menu items retrieved successfully.',

            'data' => MenuItemResource::collection($items),
        ]);
    }

    public function show(string $slug): JsonResponse
    {
        $item = $this->items->findBySlug($slug);

        if (! $item) {

            return response()->json([
                'message' => 'Menu item not found.',
            ], 404);
        }

        return response()->json([
            'message' => 'Menu item retrieved successfully.',

            'data' => new MenuItemResource($item),
        ]);
    }

    public function store(
        CreateMenuItemRequest $request,
        CreateMenuItemAction $action
    ): JsonResponse {

        $dto = CreateMenuItemData::fromRequest($request);

        $item = $action->execute($dto);

        return response()->json([
            'message' => 'Menu item created successfully.',

            'data' => new MenuItemResource($item),
        ], 201);
    }
}
