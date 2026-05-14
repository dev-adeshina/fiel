<?php

namespace App\Domains\Menu\Services;

use Carbon\Carbon;

use App\Domains\Menu\Models\MenuItem;

class MenuAvailabilityService
{
    public function isAvailableNow(MenuItem $item): bool 
    {

        if (! $item->is_available) {
            return false;
        }

        $now = now();

        return $this->isAvailableAt($item, $now);
    }

    public function isAvailableAt(MenuItem $item, Carbon $dateTime): bool 
    {

        $day = $dateTime->dayOfWeek;

        $time = $dateTime->format('H:i:s');

        return $item->availabilities()

            ->where('day_of_week', $day)

            ->where('is_available', true)

            ->where('start_time', '<=', $time)

            ->where('end_time', '>=', $time)

            ->exists();
    }
}