<?php 


namespace App\Domains\Auth\Actions;

use App\Domains\Auth\DTOs\LoginData;
use App\Domains\Auth\Services\AuthService;


class LoginUserAction {

    public function __construct(protected AuthService $auth) {}
    public function execute(LoginData $data): array 
    {   
        return $this->auth->login($data);
    }
}