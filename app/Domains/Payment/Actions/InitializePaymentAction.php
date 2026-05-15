<?php

namespace App\Domains\Payment\Actions;

use Exception;

use App\Domains\Order\Models\Order;

use App\Domains\Payment\Models\Payment;

use App\Domains\Payment\Repositories\PaymentRepository;

use App\Domains\Payment\Gateways\PaystackGateway;

class InitializePaymentAction
{
    public function __construct(
        protected PaymentRepository $payments,

        protected PaystackGateway $gateway
    ) {}

    public function execute(Order $order): array 
    {

        /*
        |--------------------------------------------------------------------------
        | Prevent duplicate paid orders
        |--------------------------------------------------------------------------
        */

        if ($order->payment_status === 'paid') {

            throw new Exception('Order already paid.');
        }

        /*
        |--------------------------------------------------------------------------
        | Initialize payment with provider
        |--------------------------------------------------------------------------
        */

        $response = $this->gateway->initialize($order);

        /*
        |--------------------------------------------------------------------------
        | Validate provider response
        |--------------------------------------------------------------------------
        */

        if (! isset($response['status']) || $response['status'] !== true) 
        {

            throw new Exception( 'Unable to initialize payment.');
        }

        /*
        |--------------------------------------------------------------------------
        | Create local payment record
        |--------------------------------------------------------------------------
        */

        $payment = $this->payments
            ->create(
                $order,

                [

                    'provider'
                        => 'paystack',

                    'reference'
                        => $response['data']['reference'],

                    'amount'
                        => $order->total_amount,

                    'currency'
                        => 'NGN',

                    'status'
                        => 'pending',

                    'provider_response'
                        => $response,
                ]
            );

        /*
        |--------------------------------------------------------------------------
        | Return frontend checkout data
        |--------------------------------------------------------------------------
        */

        return [

            'payment'
                => $payment,

            'checkout_url'
                => $response['data']['authorization_url'],

            'reference'
                => $response['data']['reference'],
        ];
    }
}