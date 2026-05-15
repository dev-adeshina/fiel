<?php

namespace App\Domains\Order\Enums;

enum PaymentStatus : string
{
    case Pending = 'pending';

    case Paid = 'paid';

    case Failed = 'failed';

    case Refunded = 'refunded';
}
