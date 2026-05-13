<?php

namespace Database\Factories;

use App\Domains\Menu\Models\MenuItem;
use App\Domains\Menu\Models\MenuItemVariant;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends Factory<Model>
 */
class MenuItemVariantFactory extends Factory
{
     protected $model = MenuItemVariant::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $name = fake()->randomElement([
            'Small',
            'Medium',
            'Large',
            'Extra Large',
        ]);

        return [
            'uuid' => Str::uuid(),

            'menu_item_id' => MenuItem::factory(),

            'name' => $name,

            'sku' => strtoupper(fake()->unique()->bothify('VAR-#####')),

            'price' => fake()->randomFloat(2, 5, 100),

            'price_adjustment' => fake()->randomFloat(2, 0, 20),

            'is_default' => fake()->boolean(),

            'sort_order' => fake()->numberBetween(0, 10),
        ];
    }
}
