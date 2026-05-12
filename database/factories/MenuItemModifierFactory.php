<?php

namespace Database\Factories;

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
        return [
            //
        ];
    }
}
