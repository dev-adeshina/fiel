<?php

namespace App\Http\Controllers\Auth;

use App\Domains\Auth\Actions\LoginUserAction;
use App\Domains\Auth\DTOs\LoginData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    //
    public function __invoke(LoginRequest $request, LoginUserAction $action ) : JsonResponse
    {
        $dto = LoginData::fromRequest($request);
        $auth = $action->execute($dto);

        return response()->json([
            'message' => 'Login successful.',
            'data' => [
                'user' => new UserResource($auth['user']),
                'token' => $auth['token'],
            ]
        ]);
    }
}
