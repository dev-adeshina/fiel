<?php

namespace App\Http\Controllers\Auth;

use App\Domains\Auth\Actions\ChangePasswordAction;
use App\Domains\Auth\DTOs\ChangePasswordData;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class ChangePasswordController extends Controller
{
    public function __invoke(
        Request $request,
        ChangePasswordAction $action
    ): JsonResponse {

        $dto = ChangePasswordData::fromRequest($request);

        $action->execute(
            $request->user(),
            $dto
        );

        return response()->json([
            'message' => 'Password changed successfully.'
        ]);
    }
}
