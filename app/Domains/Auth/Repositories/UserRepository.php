<?php 

namespace App\Domains\Auth\Repositories;

use App\Domains\Auth\Models\User;
use Illuminate\Database\Eloquent\Collection;


class UserRepository
{
    
    public function findById(int $id): ?User
    {
        return User::find($id);
    }

    public function findByUuid(string $uuid) : ?User
    {
        return User::where('uuid', $uuid)->first();
    }

    public function findByEmail(string $email) : ?User
    {
        return User::where('email', $email)->first();
    }


    public function create(array $data) : User
    {
        return User::create($data);
    }

    public function update(User $user, array $data) : ?bool
    {
        return $user->update($data);
    }


    public function delete(User $user) : ?bool
    {   
        return $user->delete();
    }

    public function all() : Collection
    {
        return User::latest()->get();
    }


}