<?php 

namespace App\Domains\Auth\Actions;

use App\Domains\Auth\Models\User;
use App\Domains\Auth\Services\AccountService;



class DeleteAccountAction 
{
    public function __construct(protected AccountService $account){}


    public function execute(User $user): void 
    {
        $this->account->deleteAccount($user);
    }
}