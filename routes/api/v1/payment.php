<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Payment\PaystackWebhookController;
use App\Http\Controllers\Payment\InitializePaymentController;

Route::post('/payments/webhook/paystack', PaystackWebhookController::class);
Route::post('/payments/orders/{order}/initialize', InitializePaymentController::class);