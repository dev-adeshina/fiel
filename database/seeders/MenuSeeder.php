<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Domains\Menu\Models\Menu;
use App\Domains\Menu\Models\MenuCategory;
use App\Domains\Menu\Models\MenuItem;



class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Menu::factory()
            ->count(2)
            ->create()
            ->each(function ($menu) {

                MenuCategory::factory()
                    ->count(4)
                    ->create([
                        'menu_id' => $menu->id
                    ])
                    ->each(function ($category) {

                        MenuItem::factory()
                            ->count(10)
                            ->create([
                                'menu_category_id' => $category->id
                            ]);
                    });
            });
    }
}
