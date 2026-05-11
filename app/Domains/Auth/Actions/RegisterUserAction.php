<?php 


namespace App\Domains\Auth\Actions;

use App\Domains\Auth\DTOs\RegisterData;
use App\Domains\Auth\Services\AuthService;
use App\Domains\Auth\Models\User;

class RegisterUserAction {


    public function __construct(protected AuthService $auth) {}


    public function execute(RegisterData $data) : User
    {
        return $this->auth->register($data);
    }
}