<?php

namespace Database\Seeders;

use App\Domains\Auth\Models\User;
use Database\Factories\MenuFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        

        $this->call([
            MenuSeeder::class,
        ]);

        Role::create([
            'name' => 'customer'
        ]);

        Role::create([
            'name' => 'admin'
        ]);

        Role::create([
            'name' => 'manager'
        ]);

        Role::create([
            'name' => 'staff'
        ]);
    }
}
