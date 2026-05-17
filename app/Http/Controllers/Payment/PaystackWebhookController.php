<?php

namespace App\Http\Controllers\Payment;

use App\Domains\Payment\Actions\VerifyPaymentAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;




class PaystackWebhookController extends Controller
{
    public function __invoke(Request $request, VerifyPaymentAction $action): Response 
    {

        /*
        |--------------------------------------------------------------------------
        | Verify webhook signature
        |--------------------------------------------------------------------------
        */

        $signature = $request->header('x-paystack-signature');

        $computedSignature = hash_hmac(
            'sha512', 
            $request->getContent(),

            config( 'services.paystack.secret_key' )
        );

        if ($signature !== $computedSignature) 
        {

            Log::warning('Invalid Paystack webhook signature.');

            return response('Invalid signature', 401);
        }

        
            
        /*
        |--------------------------------------------------------------------------
        | Get event payload
        |--------------------------------------------------------------------------
        */

        $payload = $request->all();

        /*
        |--------------------------------------------------------------------------
        | Handle successful charge
        |--------------------------------------------------------------------------
        */

        if ($payload['event'] === 'charge.success') 
        {

            $reference = $payload['data']['reference'];

            try {

                $action->execute($reference);

            } catch (\Throwable $e) {

                Log::error( $e->getMessage());
            }
        }

        if (! hash_equals($computedSignature, $signature))
        {
                $event = $payload['event'] ?? null;

                Log::error('Paystack webhook failed.', [
                    'reference' => $reference,
                    'message' => $e->getMessage(),
                ]);
        }

        return response( 'Webhook handled', 200 );
    }
}
