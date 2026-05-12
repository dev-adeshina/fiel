<?php

namespace App\Http\Controllers\Auth;

use App\Domains\Auth\Actions\ForgotPasswordAction;
use App\Domains\Auth\DTOs\ForgotPasswordData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;



class ForgotPasswordController extends Controller
{
    public function __invoke(
        ForgotPasswordRequest $request,
        ForgotPasswordAction $action
    ): JsonResponse {

        $dto = ForgotPasswordData::fromRequest($request);

        $action->execute($dto);

        return response()->json([
            'message' => 'Password reset link sent.'
        ]);
    }
}
