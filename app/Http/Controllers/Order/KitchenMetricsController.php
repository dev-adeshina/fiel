<?php

namespace App\Http\Controllers\Order;

use App\Domains\Order\Repositories\OrderRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;



class KitchenMetricsController extends Controller
{
    public function __construct(
        protected OrderRepository $orders
    ) {}

    public function __invoke(): JsonResponse
    {
        return response()->json([

            'message'
                => 'Kitchen metrics retrieved successfully.',

            'data'
                => $this->orders->kitchenMetrics(),
        ]);
    }
}
