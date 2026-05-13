<?php

namespace Database\Factories;

use App\Domains\Menu\Models\MenuItem;
use App\Domains\Menu\Models\MenuItemModifier;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Model>
 */
class MenuItemModifierFactory extends Factory
{
     protected $model = MenuItemModifier::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->randomElement([
            'Extra Cheese',
            'Extra Sauce',
            'Bacon',
            'Chicken',
            'Avocado',
        ]);

        return [
           'uuid' => Str::uuid(),

            'menu_item_id' => MenuItem::factory(),

            'name' => $name,

            'description' => fake()->sentence(),

            'price' => fake()->randomFloat(2, 1, 15),

            'is_required' => fake()->boolean(),

            'max_selection' => fake()->numberBetween(1, 5),
        ];
    }
}
