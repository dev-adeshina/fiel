<?php

namespace App\Http\Controllers\Auth;

use App\Domains\Auth\Actions\GetAuthenticatedUserAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;



class MeController extends Controller
{
    //

    public function __invoke(Request $request, GetAuthenticatedUserAction $action) : JsonResponse
    {
        

        $user = $action->execute(
            $request->user()
        );

        return response()->json([

            'data' => new UserResource($user),

        ]);
    }
   
}
