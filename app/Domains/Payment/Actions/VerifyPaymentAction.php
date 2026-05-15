<?php

namespace App\Domains\Payment\Actions;

use Exception;

use App\Domains\Order\Models\Order;

use App\Domains\Payment\Models\Payment;

use App\Domains\Payment\Repositories\PaymentRepository;

use App\Domains\Payment\Gateways\PaystackGateway;

class VerifyPaymentAction
{
    public function __construct(
        protected PaymentRepository $payments,

        protected PaystackGateway $gateway
    ) {}

    public function execute(
        string $reference
    ): Payment {

        /*
        |--------------------------------------------------------------------------
        | Find local payment
        |--------------------------------------------------------------------------
        */

        $payment = $this->payments
            ->findByReference($reference);

        if (! $payment) {

            throw new Exception(
                'Payment not found.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Prevent duplicate verification
        |--------------------------------------------------------------------------
        */

        if ($payment->status === 'paid') {

            return $payment;
        }

        /*
        |--------------------------------------------------------------------------
        | Verify with provider
        |--------------------------------------------------------------------------
        */

        $response = $this->gateway
            ->verify($reference);

        /*
        |--------------------------------------------------------------------------
        | Validate provider response
        |--------------------------------------------------------------------------
        */

        if (
            ! isset($response['status'])

            ||

            $response['status'] !== true
        ) {

            throw new Exception(
                'Payment verification failed.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Confirm provider payment success
        |--------------------------------------------------------------------------
        */

        $providerPaymentStatus =
            $response['data']['status'];

        if ($providerPaymentStatus !== 'success') {

            $this->payments->updateStatus(

                $payment,

                'failed',

                $response
            );

            throw new Exception(
                'Payment not successful.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Update payment
        |--------------------------------------------------------------------------
        */

        $payment = $this->payments
            ->updateStatus(

                $payment,

                'paid',

                $response
            );

        /*
        |--------------------------------------------------------------------------
        | Update order
        |--------------------------------------------------------------------------
        */

        $order = $payment->order;

        $order->update([

            'payment_status'
                => 'paid',

            'status'
                => 'confirmed',
        ]);

        return $payment;
    }
}