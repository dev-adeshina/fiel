<?php

namespace App\Domains\Auth\Actions;

use App\Domains\Auth\Models\User;

class GetAuthenticatedUserAction
{
    public function execute(
        User $user
    ): User {

        return $user->load('roles');
    }
}