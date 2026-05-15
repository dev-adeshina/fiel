<?php

namespace App\Domains\Order\Actions;

use App\Domains\Order\Models\Order;

use App\Domains\Order\Enums\OrderStatus;

class UpdateOrderStatusAction
{
    public function execute(Order $order, OrderStatus $status): Order 
    {

        $data = ['status' => $status,];

        /*
        |--------------------------------------------------------------------------
        | Lifecycle timestamps
        |--------------------------------------------------------------------------
        */

        if ($status === OrderStatus::Confirmed) {

            $data['confirmed_at'] = now();
        }

        if ($status === OrderStatus::Preparing) {

            $data['preparation_started_at'] = now();

            /*
            |--------------------------------------------------------------------------
            | Default estimated prep time
            |--------------------------------------------------------------------------
            */

            $data['estimated_preparation_time']  = 20;
        }

        if ($status === OrderStatus::Ready) {

            $data['ready_at'] = now();

            if ($order->preparation_started_at) {

                $data['actual_preparation_time'] = now()->diffInMinutes( $order->preparation_started_at );
            }
        }

        if ($status === OrderStatus::Completed) {

            $data['completed_at'] = now();
        }

        $order->update($data);

        return $order->refresh();
    }
}