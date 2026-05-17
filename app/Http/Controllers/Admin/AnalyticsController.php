<?php

namespace App\Http\Controllers\Admin;

use App\Domains\Inventory\Models\InventoryItem;
use App\Domains\Order\Models\OrderItem;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;



class AnalyticsController extends Controller
{
    public function topSellingItems()
    {
        $items = OrderItem::query()
            ->selectRaw('menu_item_id, SUM(quantity) as total_quantity')
            ->with('menuItem')
            ->groupBy('menu_item_id')
            ->orderByDesc('total_quantity')
            ->limit(10)
            ->get();

        return response()->json(['data' => $items,]);
    }

    public function lowStockItems()
    {
        $items = InventoryItem::query()
            ->whereColumn('stock_quantity', '<=', 'minimum_quantity')
            ->latest()
            ->get();

        return response()->json(['data' => $items,]);
    }
}
