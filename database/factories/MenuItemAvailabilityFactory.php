<?php

namespace Database\Factories;

use App\Domains\Menu\Models\MenuItem;
use App\Domains\Menu\Models\MenuItemAvailability;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends Factory<Model>
 */
class MenuItemAvailabilityFactory extends Factory
{
     protected $model = MenuItemAvailability::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        

        return [
            'menu_item_id' => MenuItem::factory(),

            'description' => fake()->sentence(),

            'day_of_week' => fake()->randomElement([
                'monday',
                'tuesday',
                'wednesday',
                'thursday',
                'friday',
                'saturday',
                'sunday',
            ]),

            'start_time' => '08:00:00',

            'end_time' => '22:00:00',

            'is_available' => true,
        ];
    }
}
