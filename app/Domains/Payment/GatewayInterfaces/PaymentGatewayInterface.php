<?php

namespace App\Domains\Payment\GatewayInterfaces;

use App\Domains\Order\Models\Order;



interface PaymentGatewayInterface 
{
    public function initialize(Order $order): array;

    public function verify(string $reference) : array;
}