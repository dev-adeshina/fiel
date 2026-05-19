<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Domains\Order\Models\Order;
use App\Domains\Order\Enums\OrderStatus;

class KitchenDashboard extends Page
{

    protected static ?string $navigationLabel =
        'Kitchen Dashboard';

    // protected static ?string $navigationGroup =
    //     'Operations';

    // protected static ?string $navigationIcon =
    //     'heroicon-o-fire';

    protected static ?int $navigationSort = 1;

    protected string $view = 'filament.pages.kitchen-dashboard';


    public function getOrders()
    {
        return Order::query()

            ->with('items.menuItem')

            ->whereIn('status', [

                OrderStatus::Confirmed,

                OrderStatus::Preparing,

                OrderStatus::Ready,
            ])

            ->latest()

            ->get();
    }

    public function startPreparing(
        int $orderId
    ): void {

        $order = Order::findOrFail($orderId);

        $order->update([

            'status'
                => OrderStatus::Preparing,
        ]);
    }

    public function markReady(
        int $orderId
    ): void {

        $order = Order::findOrFail($orderId);

        $order->update([

            'status'
                => OrderStatus::Ready,
        ]);
    }
    
}
