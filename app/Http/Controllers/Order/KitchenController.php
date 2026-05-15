<?php

namespace App\Http\Controllers\Order;

use App\Domains\Order\Repositories\OrderRepository;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;



class KitchenController extends Controller
{
    public function __construct(
        protected OrderRepository $orders
    ) {}

    public function index(): JsonResponse
    {
        $orders = $this->orders->kitchenQueue();

        return response()->json([
            'message' => 'Kitchen queue retrieved successfully.',

            'data' => OrderResource::collection( $orders),
        ]);
    }
}
