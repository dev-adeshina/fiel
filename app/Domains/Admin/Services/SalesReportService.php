<?php

namespace App\Domains\Admin\Services;

use App\Domains\Order\Models\Order;

class SalesReportService
{
    public function sales(): array
    {
        return [

            'today_sales' => Order::query()->whereDate('created_at', today())
                ->where('payment_status', 'paid')
                ->sum('total'),

            'monthly_sales' => Order::query()
                ->whereMonth('created_at', now()->month)
                ->where('payment_status', 'paid')
                ->sum('total'),

            'yearly_sales' => Order::query()
                ->whereYear('created_at', now()->year)
                ->where('payment_status', 'paid')
                ->sum('total'),
        ];
    }
}