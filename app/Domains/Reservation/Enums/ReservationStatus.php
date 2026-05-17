<?php

namespace App\Domains\Reservation\Enums;

enum ReservationStatus: string
{
    case Pending = 'pending';

    case Confirmed = 'confirmed';

    case Cancelled = 'cancelled';

    case Completed = 'completed';

    case Rejected = 'rejected';
}