<?php

namespace App\Http\Controllers\Auth;

use App\Domains\Auth\Actions\RegisterUserAction;
use App\Domains\Auth\DTOs\RegisterData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;


class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request, RegisterUserAction $action) 
    {
        $dto = RegisterData::fromRequest($request);
        $user = $action->execute($dto);

        return response()->json([
            'message'   => 'Register Successfully',
            'data'      => $user
        ]);
    }
}
