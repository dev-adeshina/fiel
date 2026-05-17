<?php

namespace App\Domains\Reservation\Actions;

use App\Domains\Auth\Models\User;

use App\Domains\Reservation\Models\Reservation;

class CreateReservationAction
{
    public function execute(User $user, array $data): Reservation 
    {
        return Reservation::create([...$data, 'user_id' => $user->id,]);
    }
}