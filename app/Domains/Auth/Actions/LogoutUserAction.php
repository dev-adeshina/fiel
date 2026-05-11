<?php 


namespace App\Domains\Auth\Actions;

use App\Domains\Auth\Services\AuthService;
use App\Domains\Auth\Models\User;

class LogoutUserAction {

    public function __construct(protected AuthService $auth){}

    public function execute(User $user) : void  {
        $this->auth->logout($user);
    }
}