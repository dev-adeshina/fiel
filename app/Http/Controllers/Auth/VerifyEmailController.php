<?php

namespace App\Http\Controllers\Auth;

use App\Domains\Auth\Actions\VerifyEmailAction;
use App\Domains\Auth\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\VerifyEmailRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;




class VerifyEmailController extends Controller
{

    public function __invoke(VerifyEmailRequest $request, VerifyEmailAction $action): JsonResponse
    {
        $user = User::findOrFail($request->route('id'));
        $action->execute($user);

        return response()->json([
            'message' => 'Email verified successfully.',
        ]);
    }
}
