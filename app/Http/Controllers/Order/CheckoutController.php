<?php

namespace App\Http\Controllers\Order;

use App\Domains\Cart\Models\Cart;
use App\Domains\Order\Actions\CheckoutAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\CheckoutRequest;
use App\Http\Resources\OrderResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;



class CheckoutController extends Controller
{
    public function __invoke(CheckoutRequest $request, CheckoutAction $action): JsonResponse 
    {

        $cart = Cart::query()
            ->with(['items.menuItem', 'items.variant', 'items.modifiers',])

            ->where('user_id', auth()->id())

            ->firstOrFail();

        if ($cart->items->isEmpty()) {

            return response()->json([
                'message' => 'Cart is empty.',
            ], 422);
        }

        $order = $action->execute(
            $cart,
            $request->validated()
        );

        return response()->json([

            'message' => 'Checkout completed successfully.',

            'data' => new OrderResource($order),
        ], 201);
    }
}
