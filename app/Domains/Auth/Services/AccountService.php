<?php 


namespace App\Domains\Auth\Services;

use App\Domains\Auth\Enums\UserStatus;
use App\Domains\Auth\Models\User;
use App\Domains\Auth\Services\TokenService;
use Illuminate\Support\Facades\DB;


class AccountService {

    public function __construct(protected TokenService $tokens){} 

    public function deleteAccount(User $user) : void
    {
        DB::transaction(function() use($user) {


            $this->tokens->revokeAll($user);

            $user->delete();

            // event(new AccountDeleted($user));
        });
    }

    public function suspendAccount(User $user): void  
    {

        DB::transaction(function() use($user) {
            $this->tokens->revokeAll($user);

            $user->update([
                'status'    => UserStatus::SUSPENDED->value
            ]);

            // event(new AccountDeleted($user));
        });
    }


    public function reactivateAccount(User $user) : void
    {
         DB::transaction(function() use($user) {
            $this->tokens->revokeAll($user);

            $user->update([
                'status'    => UserStatus::ACTIVE->value
            ]);

            // event(new AccountDeleted($user));
        });

    }

    public function deactivateAccount(User $user) : void
    {
         DB::transaction(function() use($user) {
            $this->tokens->revokeAll($user);

            $user->update([
                'status'    => UserStatus::DEACTIVATED->value
            ]);

            // event(new AccountDeleted($user));
        });
    }
}