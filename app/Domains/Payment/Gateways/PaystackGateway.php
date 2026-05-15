<?php

namespace App\Domains\Payment\Gateways;

use Illuminate\Support\Facades\Http;

use App\Domains\Order\Models\Order;

use App\Domains\Payment\GatewayInterfaces\PaymentGatewayInterface;

class PaystackGateway implements PaymentGatewayInterface
{
    protected string $secretKey;

    protected string $baseUrl;

    public function __construct()
    {
        $this->secretKey = config(
            'services.paystack.secret_key'
        );

        $this->baseUrl = config(
            'services.paystack.base_url'
        );
    }

    /**
     * Initialize payment.
     */
    public function initialize(
        Order $order
    ): array {

        $response = Http::withToken($this->secretKey)
        ->post("{$this->baseUrl}/transaction/initialize",

            [

                'email' => $order->customer_email,

                'amount' => (int) ($order->total_amount * 100),

                'reference' => 'ORD-' . $order->uuid,

                'metadata' => ['order_id' => $order->id,],
            ]
        );

        return $response->json();
    }

    /**
     * Verify payment.
     */
    public function verify(string $reference): array 
    {

        $response = Http::withToken($this->secretKey)->get("{$this->baseUrl}/transaction/verify/{$reference}");

        return $response->json();
    }
}