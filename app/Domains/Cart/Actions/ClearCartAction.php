<?php

namespace App\Domains\Cart\Actions;

use App\Domains\Cart\Models\Cart;

class ClearCartAction
{
    public function execute(Cart $cart): Cart 
    {

        $cart->items()->delete();

        $cart->update(['subtotal' => 0, 'tax' => 0, 'discount' => 0, 'total' => 0,]);

        return $cart->fresh();
    }
}