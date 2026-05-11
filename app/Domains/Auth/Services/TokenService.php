<?php 

namespace App\Domains\Auth\Services;

use App\Domains\Auth\Models\User;
use Laravel\Sanctum\PersonalAccessToken;


class TokenService {
    public function generate(User $user) : string
    {
        return $user->createToken('auth_token')->plainTextToken;
    }


    public function revokeCurrent(User $user) : void
    {
        $token = $user->currentAccessToken();

        if ($token instanceof PersonalAccessToken) {
            $token->delete();
        }
    }


    public function revokeAll(User $user) : void
    {
        $user->tokens()->delete();
    }
}