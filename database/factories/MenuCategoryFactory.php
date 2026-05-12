<?php

namespace Database\Factories;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Domains\Menu\Models\Menu;
use App\Domains\Menu\Models\MenuCategory;

/**
 * @extends Factory<Model>
 */
class MenuCategoryFactory extends Factory
{
     protected $model = MenuCategory::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->randomElement([
            'Pizza',
            'Drinks',
            'Desserts',
            'Burgers',
            'Pasta',
        ]);

        return [
            'uuid' => Str::uuid(),

            'menu_id' => Menu::factory(),

            'name' => $name,

            'slug' => Str::slug($name . '-' . Str::random(5)),

            'description' => fake()->sentence(),

            'image_path' => null,

            'position' => fake()->numberBetween(1, 10),

            'is_active' => true,
        ];
    }
}
