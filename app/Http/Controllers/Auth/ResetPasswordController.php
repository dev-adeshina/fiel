<?php

namespace App\Http\Controllers\Auth;

use App\Domains\Auth\Actions\ResetPasswordAction;
use App\Domains\Auth\DTOs\ResetPasswordData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;



class ResetPasswordController extends Controller
{
    public function __invoke(
        ResetPasswordRequest $request,
        ResetPasswordAction $action
    ): JsonResponse {

        $dto = ResetPasswordData::fromRequest($request);

        $action->execute($dto);

        return response()->json([
            'message' => 'Password has been reset successfully.'
        ]);
    }
}
