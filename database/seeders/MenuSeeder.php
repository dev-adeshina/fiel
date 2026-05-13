<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Domains\Menu\Models\Menu;
use App\Domains\Menu\Models\MenuCategory;
use App\Domains\Menu\Models\MenuItem;
use App\Domains\Menu\Models\MenuItemAvailability;
use App\Domains\Menu\Models\MenuItemModifier;
use App\Domains\Menu\Models\MenuItemVariant;



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
                            ])

                            ->each(function ($item) {

                                MenuItemVariant::factory()
                                    ->count(3)
                                    ->create([
                                        'menu_item_id' => $item->id
                                    ]);

                                MenuItemModifier::factory()
                                    ->count(5)
                                    ->create([
                                        'menu_item_id' => $item->id
                                    ]);

                                MenuItemAvailability::factory()
                                    ->count(7)
                                    ->create([
                                        'menu_item_id' => $item->id
                                    ]);
                            });
                    });
            });
    }
}
