<?php

namespace App\Domains\Order\Repositories;

use App\Domains\Order\Models\Order;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class OrderRepository
{
    public function paginateForUser(int $userId, int $perPage = 15): LengthAwarePaginator 
    {

        return Order::query()->with(['items',])->where('user_id', $userId)->latest()->paginate($perPage);
    }

    public function findUserOrder(int $userId, int $orderId): ?Order 
    {

        return Order::query()->with(['items',])->where('user_id', $userId)->find($orderId);
    }

    public function kitchenQueue()
    {
        return Order::query()->with(['items', 'items.menuItem',  'items.variant', 'items.modifiers', ])->whereIn('status', ['confirmed','preparing',])->latest()->get();
    }

    public function kitchenMetrics(): array
    {
        $activeOrders = Order::query()

            ->whereIn('status', ['confirmed', 'preparing',])

            ->count();

            $readyOrders = Order::query()

            ->where('status','ready')

            ->count();

            $completedToday = Order::query()

            ->where('status', 'completed')

            ->whereDate('completed_at', today())

            ->count();

            $averagePreparationTime = Order::query()

            ->whereNotNull('actual_preparation_time')

            ->avg('actual_preparation_time');

       

            // $delayedOrders = Order::query()

            // ->where( 'status', 'preparing')

            // ->whereRaw('actual_preparation_time > estimated_preparation_time')

            // ->count();

            $delayedOrders = Order::query()

            ->where('status', 'preparing')

            ->whereNotNull('preparation_started_at')

            ->get()

            ->filter(function ($order) {return now()->diffInMinutes($order->preparation_started_at) > $order->estimated_preparation_time;})

            ->count();

            return [

                'active_orders' => $activeOrders,

                'ready_orders' => $readyOrders,

                'completed_today' => $completedToday,

                'average_preparation_time' => round($averagePreparationTime ?? 0, 1 ),

                'delayed_orders' => $delayedOrders,
        ];
    }
}