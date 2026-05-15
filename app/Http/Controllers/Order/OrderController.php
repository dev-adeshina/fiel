<?php

namespace App\Http\Controllers\Order;

use Illuminate\Http\JsonResponse;

use App\Http\Controllers\Controller;

use App\Http\Resources\OrderResource;

use App\Domains\Order\Repositories\OrderRepository;

class OrderController extends Controller
{
    public function __construct(
        protected OrderRepository $orders
    ) {}

    public function index(): JsonResponse
    {
        $orders = $this->orders->paginateForUser(auth()->id());

        return response()->json([

            'message' => 'Orders retrieved successfully.',

            'data' => OrderResource::collection( $orders),

            'meta' => [
                'current_page' => $orders->currentPage(),

                'last_page' => $orders->lastPage(),

                'per_page' => $orders->perPage(),

                'total' => $orders->total(),
            ],
        ]);
    }

    public function show(int $order): JsonResponse 
    {

        $order = $this->orders->findUserOrder(auth()->id(), $order);

        if (! $order) {

            return response()->json([
                'message' => 'Order not found.',
            ], 404);
        }

        return response()->json([
            'message' => 'Order retrieved successfully.',
            'data' => new OrderResource($order),
        ]);
    }
}