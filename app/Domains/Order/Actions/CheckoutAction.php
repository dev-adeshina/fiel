<?php

namespace App\Domains\Order\Actions;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;

use App\Domains\Cart\Models\Cart;

use App\Domains\Order\Models\Order;

use App\Domains\Order\Models\OrderItem;

class CheckoutAction
{
    public function execute(Cart $cart, array $data): Order 
    {

        return DB::transaction(function () use ($cart, $data) 
        {

            /*
            |--------------------------------------------------------------------------
            | Create Order
            |--------------------------------------------------------------------------
            */

            $order = Order::create([

                'uuid' => Str::uuid(),

                'user_id' => $cart->user_id,

                'order_number' => 'ORD-'.strtoupper(Str::random(10)),

                'type' => $data['type'] ?? 'delivery',

                'status' => 'pending',

                'customer_name' => $data['customer_name'],

                'customer_email' => $data['customer_email'] ?? null,

                'customer_phone' => $data['customer_phone'] ?? null,

                'delivery_address' => $data['delivery_address'] ?? null,

                'notes' => $data['notes'] ?? null,

                'subtotal' => $cart->subtotal,

                'tax' => $cart->tax,

                'delivery_fee' => 0,

                'discount' => $cart->discount,

                'total' => $cart->total,

                'payment_status' => 'pending',

                'placed_at' => now(),
            ]);

            /*
            |--------------------------------------------------------------------------
            | Create Order Items
            |--------------------------------------------------------------------------
            */

            foreach ($cart->items as $item) {

                OrderItem::create([

                    'uuid' => Str::uuid(),

                    'order_id' => $order->id,

                    'menu_item_id' => $item->menu_item_id,

                    'item_name' => $item->menuItem->name,

                    'variant_name' => $item->variant?->name,

                    'modifier_names' => $item->modifiers->pluck('name')->values(),

                    'unit_price' => $item->unit_price,

                    'quantity' => $item->quantity,

                    'total_price' => $item->total_price,

                    'special_instructions' => $item->special_instructions,
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | Clear Cart
            |--------------------------------------------------------------------------
            */

            $cart->items()->delete();

            return $order->fresh(['items',]);
        });
    }
}