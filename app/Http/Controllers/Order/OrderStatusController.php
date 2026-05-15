<?php

namespace App\Http\Controllers\Order;

use App\Domains\Order\Actions\UpdateOrderStatusAction;
use App\Domains\Order\Enums\OrderStatus;
use App\Domains\Order\Models\Order;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\UpdateOrderStatusRequest;
use App\Http\Resources\OrderResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;



class OrderStatusController extends Controller
{
    public function update(UpdateOrderStatusRequest $request, Order $order, UpdateOrderStatusAction $action): JsonResponse 
    {

        $status = OrderStatus::from($request->status);

        $order = $action->execute($order, $status);

        return response()->json([
            'message' => 'Order status updated successfully.',

            'data' => new OrderResource($order),
        ]);
    }
}
