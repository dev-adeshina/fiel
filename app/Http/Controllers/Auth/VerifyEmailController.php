<?php

namespace App\Http\Controllers\Auth;

use App\Domains\Auth\Actions\VerifyEmailAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    //

    public function __invoke(Request $request, VerifyEmailAction $action): JsonResponse
    {
        $action->execute($request->user());

        return response()->json([
            'message' => 'Email verified successfully.',
        ]);
    }
}
