<?php

namespace App\Http\Controllers\Cart;

use App\Domains\Cart\Actions\AddToCartAction;
use App\Domains\Cart\DTOs\AddToCartData;
use App\Domains\Cart\Models\Cart;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\AddToCartRequest;
use App\Http\Resources\CartResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;



class CartController extends Controller
{
    public function index(): JsonResponse
    {
        $cart = Cart::query()->with(['items.menuItem', 'items.variant', 'items.modifiers',])
            ->where('user_id', auth()->id())->first();

        return response()->json(['message' => 'Cart retrieved successfully.',   
            'data' => $cart ? new CartResource($cart) : null,
        ]);
    }


    public function store(AddToCartRequest $request, AddToCartAction $action): JsonResponse 
    {

        $dto = AddToCartData::fromRequest($request);

        $cart = $action->execute($dto);

        return response()->json(['message' => 'Item added to cart.', 'data' => new CartResource($cart),], 201);
    }
}
