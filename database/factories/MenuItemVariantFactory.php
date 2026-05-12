<?php

namespace Database\Factories;

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
        return [
            //
        ];
    }
}
