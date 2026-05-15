<?php

namespace App\Domains\Order\Actions;

use App\Domains\Order\Models\Order;

use App\Domains\Order\Enums\OrderStatus;

class UpdateOrderStatusAction
{
    public function execute(Order $order, OrderStatus $status): Order 
    {

        $data = [ 'status' => $status,];

        /*
        |--------------------------------------------------------------------------
        | Lifecycle timestamps
        |--------------------------------------------------------------------------
        */

        match ($status) {

            OrderStatus::Confirmed => $data['confirmed_at'] = now(),

            OrderStatus::Completed => $data['completed_at'] = now(),

            default => null,
        };

        $order->update($data);

        return $order->refresh();
    }
}