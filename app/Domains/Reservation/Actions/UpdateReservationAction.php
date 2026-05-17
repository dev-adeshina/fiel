<?php

namespace App\Domains\Reservation\Actions;

use App\Domains\Reservation\Models\Reservation;

class UpdateReservationStatusAction
{
    public function execute(Reservation $reservation, string $status): Reservation 
    {
        $reservation->update(['status' => $status,]);
        return $reservation->refresh();
    }
}