<?php

namespace App\Http\Controllers\Auth;

use App\Domains\Auth\Actions\ResendEmailVerificationAction;
use App\Domains\Auth\DTOs\ResendEmailVerificationData;
use App\Domains\Auth\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResendVerificationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class ResendEmailVerificationController extends Controller
{
    //

    public function __invoke(ResendVerificationRequest $request, ResendEmailVerificationAction $action) : JsonResponse
    {
            $dto = ResendEmailVerificationData::fromRequest($request);

            $action->execute($request->user());
            return response()->json([
                'message' => 'Verification email sent.',
            ]);
    }
}
