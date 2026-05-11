<?php

namespace App\Http\Controllers\Auth;

use App\Domains\Auth\Actions\DeleteAccountAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteAccountController extends Controller
{
    //
    public function __invoke(Request $request, DeleteAccountAction $action) : JsonResponse
    {
        $action->execute($request->user());

        return response()->json([
            'message'   => 'Account Deleted Succesffuly'
        ]);
    }
}
