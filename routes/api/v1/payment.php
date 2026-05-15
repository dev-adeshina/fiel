<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Payment\PaystackWebhookController;

Route::post('/payments/webhook/paystack', PaystackWebhookController::class);