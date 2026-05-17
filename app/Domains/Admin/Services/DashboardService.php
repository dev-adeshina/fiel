<?php

namespace App\Domains\Admin\Services;

use App\Domains\Order\Models\Order;

use App\Domains\Reservation\Models\Reservation;

use App\Domains\Inventory\Models\InventoryItem;

class DashboardService
{
    public function summary(): array
    {
        return [
            'total_orders' => Order::count(),
            'total_sales' => Order::where('payment_status', 'paid')->sum('total'),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'confirmed_reservations' => Reservation::where('status', 'confirmed')->count(),
            'low_stock_items' => InventoryItem::query()->whereColumn('stock_quantity', '<=', 'minimum_quantity')->count(),
        ];
    }
}