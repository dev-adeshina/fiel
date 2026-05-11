<?php

namespace App\Http\Controllers\Auth;

use App\Domains\Auth\Actions\ResendEmailVerificationAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ResendEmailVerificationController extends Controller
{
    //

    public function __invoke(Request $request, ResendEmailVerificationAction $action) : JsonResponse
    {
            $action->execute($request->user());
            return response()->json([
                'message' => 'Verification email sent.',
            ]);
    }
}
