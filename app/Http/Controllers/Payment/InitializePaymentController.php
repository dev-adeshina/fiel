<?php

namespace App\Http\Controllers\Payment;

use App\Domains\Order\Models\Order;
use App\Domains\Payment\Actions\InitializePaymentAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class InitializePaymentController extends Controller
{
    public function __invoke(Request $request, Order $order, InitializePaymentAction $action): JsonResponse 
    {

        abort_if(
           // $order->user_id !== auth()->id(),
            403,
            'Unauthorized'
        );

        $result = $action->execute($order);

        return response()->json([
            'message' => 'Payment initialized',
            'data' => $result
        ]);
    }
}
