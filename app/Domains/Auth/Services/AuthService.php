<?php 


namespace App\Domains\Auth\Services;

use App\Domains\Auth\DTOs\LoginData;
use App\Domains\Auth\Repositories\UserRepository;
use App\Domains\Auth\Services\TokenService;
use App\Domains\Auth\Models\User;
use App\Domains\Auth\DTOs\RegisterData;
use App\Domains\Auth\Events\UserRegistered;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\AuthenticationException;


class AuthService 
{
    public function __construct(
        protected UserRepository $users,
        protected TokenService $token
    ) {}


    public function register(RegisterData $data) : User
    {
        return DB::transaction(function() use ($data) {
            
            $user = $this->users->create([
                'uuid'          => Str::Uuid(),
                'first_name'    => $data->firstName,
                'last_name'     => $data->lastName,
                'email'         => $data->email,
                'password'      => Hash::make($data->password),
                'status'        => 'active',
            ]);

            $user->assignRole('customer');

            //event maker
            event(new UserRegistered($user));

            return $user;
        });
    }



    public function login(LoginData $data) : array 
    {
        $user = $this->users->findByEmail($data->email);

        if(! $user ) {
            throw new AuthenticationException('Invalid credentials');
        }


        if(! Hash::check($data->password, $user->password)) {
            throw new AuthenticationException('Invalid credentials');

        }
       

        if($user->status !== 'active') {
            throw new AuthenticationException('Your account is not active');

        }

        $user->update([
            'last_login_at' => now()
        ]);

        $token = $this->token->generate($user);

        return [
            'user' => $user,
            'token' => $token
        ];
    }


    public function logout(User $user) : void
    {
        $this->token->revokeCurrent($user);
    }
}