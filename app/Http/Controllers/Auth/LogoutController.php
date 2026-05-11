<?php

namespace App\Http\Controllers\Auth;

use App\Domains\Auth\Actions\LogoutUserAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    //
    public function __invoke(LogoutUserAction $action, Request $request) : JsonResponse
    {
        
        $action->execute($request->user());

        return response()->json([
            'message' => 'Logout successful.',
        ]);
    }
}
