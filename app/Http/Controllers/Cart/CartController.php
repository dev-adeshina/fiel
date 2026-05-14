<?php

namespace App\Http\Controllers\Cart;

use App\Domains\Cart\Actions\AddToCartAction;
use App\Domains\Cart\Actions\ClearCartAction;
use App\Domains\Cart\Actions\RemoveCartItemAction;
use App\Domains\Cart\Actions\UpdateCartItemQuantityAction;
use App\Domains\Cart\DTOs\AddToCartData;
use App\Domains\Cart\Models\Cart;
use App\Domains\Cart\Models\CartItem;
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

    public function update(Request $request, CartItem $cartItem, UpdateCartItemQuantityAction $action): JsonResponse 
    {

        $request->validate(['quantity' => ['required', 'integer', 'min:1',],]);

        $cart = $action->execute($cartItem, $request->integer('quantity'));

        return response()->json([
            'message' => 'Cart updated successfully.',
            'data' => new CartResource($cart),
        ]);
    }

    public function destroy(CartItem $cartItem, RemoveCartItemAction $action): JsonResponse 
    {

        $cart = $action->execute($cartItem);

        return response()->json([
            'message'  => 'Item removed from cart.',
            'data' => new CartResource($cart),
        ]);
    }

    public function clear(ClearCartAction $action): JsonResponse 
    {

        $cart = Cart::query()->where('user_id', auth()->id())->firstOrFail();

        $cart = $action->execute($cart);

        return response()->json([
            'message' => 'Cart cleared successfully.',
            'data'  => new CartResource($cart),
        ]);
    }
}
