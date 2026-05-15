<?php

namespace Database\Factories;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Domains\Menu\Models\MenuItem;
use App\Domains\Menu\Models\MenuCategory;
/**
 * @extends Factory<Model>
 */
class MenuItemFactory extends Factory
{
     protected $model = MenuItem::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $name = fake()->randomElement([
            'Pepperoni Pizza',
            'Cheese Burger',
            'Chicken Pasta',
            'Coke',
            'Chocolate Cake',
        ]);

        return [
            'uuid' => Str::uuid(),

            'menu_category_id' => MenuCategory::factory(),

            'name' => $name,

            'slug' => Str::slug($name . '-' . Str::random(5)),

            // 'sku' => strtoupper(fake()->bothify('SKU-#####')),
            'sku' => strtoupper(fake()->unique(true)->bothify('SKU-#####')),

            'description' => fake()->paragraph(),

            'short_description' => fake()->sentence(),

            'price' => fake()->randomFloat(2, 5, 100),

            'compare_price' => null,

            'cost_price' => fake()->randomFloat(2, 2, 50),

            'image_path' => null,

            'gallery' => [],

            'calories' => fake()->numberBetween(100, 1200),

            'preparation_time' => fake()->numberBetween(5, 45),

            'is_featured' => fake()->boolean(),

            'is_available' => true,

            'status' => 'published',
        ];
    }
}
