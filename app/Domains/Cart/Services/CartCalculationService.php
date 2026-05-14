<?php 


namespace App\Domains\Cart\Services;

use App\Domains\Cart\Models\Cart;
use App\Domains\Cart\Models\CartItem;


class CartCalculationService 
{
    public function calculateItem(CartItem $item): array 
    {

        $basePrice = $item->menuItem->price;

        $variantPrice = $item->variant ? $item->variant->price_adjustment : 0;

        $modifierPrice = $item->modifiers->sum('price');

        $unitPrice = $basePrice + $variantPrice + $modifierPrice;

        $totalPrice = $unitPrice * $item->quantity;

        return [

            'unit_price' => round($unitPrice, 2),

            'total_price' => round($totalPrice, 2),
        ];
    }

    public function calculateCart(Cart $cart): Cart 
    {

        $subtotal = 0;

        $cart->load(['items.menuItem', 'items.variant', 'items.modifiers']);

        foreach ($cart->items as $item) {

            $prices = $this->calculateItem($item);

            $item->update([
                'unit_price' => $prices['unit_price'],
                'total_price' => $prices['total_price'],
            ]);

            $subtotal += $prices['total_price'];
        }

        /*
        |--------------------------------------------------------------------------
        | Tax Logic
        |--------------------------------------------------------------------------
        */

        $tax = $subtotal * 0.075;

        /*
        |--------------------------------------------------------------------------
        | Discount Logic
        |--------------------------------------------------------------------------
        */

        $discount = 0;

        /*
        |--------------------------------------------------------------------------
        | Final Total
        |--------------------------------------------------------------------------
        */

        $total = $subtotal + $tax - $discount;

        $cart->update([

            'subtotal' => round($subtotal, 2),

            'tax' => round($tax, 2),

            'discount' => round($discount, 2),

            'total' => round($total, 2),
        ]);

        return $cart->refresh();
    }
}