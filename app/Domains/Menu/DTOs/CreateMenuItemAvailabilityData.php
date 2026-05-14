<?php

namespace App\Domains\Menu\DTOs;

use App\Http\Requests\Menu\CreateMenuItemAvailabilityRequest;

class CreateMenuItemAvailabilityData
{
    public function __construct(
        public readonly int $menuItemId,

        public readonly ?string $description,

        public readonly int $dayOfWeek,

        public readonly string $startTime,

        public readonly string $endTime,

        public readonly bool $isAvailable,
    ) {}

    public static function fromRequest(
        CreateMenuItemAvailabilityRequest $request
    ): self {

        return new self(

            menuItemId: $request->menu_item_id,

            description: $request->description,

            dayOfWeek: $request->day_of_week,

            startTime: $request->start_time,

            endTime: $request->end_time,

            isAvailable: $request->boolean(
                'is_available'
            ),
        );
    }

    public function toArray(): array
    {
        return [

            'menu_item_id' => $this->menuItemId,

            'description' => $this->description,

            'day_of_week' => $this->dayOfWeek,

            'start_time' => $this->startTime,

            'end_time' => $this->endTime,

            'is_available' => $this->isAvailable,
        ];
    }
}