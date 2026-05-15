<?php

namespace App\Domains\Payment\Repositories;

use Illuminate\Support\Str;

use App\Domains\Order\Models\Order;

use App\Domains\Payment\Models\Payment;

class PaymentRepository
{
    public function create(Order $order, array $data): Payment 
    {

        return Payment::create([

            'uuid'
                => Str::uuid(),

            'order_id'
                => $order->id,

            'provider'
                => $data['provider'],

            'reference'
                => $data['reference'],

            'transaction_id'
                => $data['transaction_id']
                    ?? null,

            'amount'
                => $data['amount'],

            'currency'
                => $data['currency']
                    ?? 'NGN',

            'status'
                => $data['status']
                    ?? 'pending',

            'provider_response'
                => $data['provider_response']
                    ?? null,
        ]);
    }

    public function findByReference(string $reference): ?Payment 
    {

        return Payment::query()

            ->where(
                'reference',
                $reference
            )

            ->first();
    }

    public function updateStatus(Payment $payment, string $status, ?array $providerResponse = null): Payment 
    {

        $payment->update([

            'status'
                => $status,

            'paid_at'
                => $status === 'paid'
                    ? now()
                    : null,

            'provider_response'
                => $providerResponse
                    ?? $payment->provider_response,
        ]);

        return $payment->refresh();
    }

    public function updateTransactionId(Payment $payment, string $transactionId): Payment 
    {

        $payment->update([

            'transaction_id'
                => $transactionId,
        ]);

        return $payment->refresh();
    }
}