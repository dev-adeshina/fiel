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
        return Order::query()->with(['items',])->whereIn('status', ['confirmed','preparing',])->latest()->get();
    }
}