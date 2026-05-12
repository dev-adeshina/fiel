<?php

namespace Database\Factories;

use App\Domains\Menu\Models\Menu;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Str;

/**
 * @extends Factory<Model>
 */
class MenuFactory extends Factory
{
    protected $model = Menu::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->randomElement([
            'Main Menu',
            'Breakfast Menu',
            'Dinner Menu',
            'Weekend Specials'
        ]);


        return [
            'uuid' => Str::uuid(),

            'name' => $name,

            'slug' => Str::slug($name . '-' . Str::random(5)),

            'description' => fake()->sentence(),

            'is_active' => true,

            'start_date' => now(),

            'end_date' => now()->addMonths(6),
        ];
    }
}
