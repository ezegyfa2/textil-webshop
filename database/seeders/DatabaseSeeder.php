<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Size;
use App\Models\Color;
use App\Models\Product\Product;
use Database\Seeders\BlogSeeder;
use Database\Seeders\ProductSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'first_name' => 'MA',
            'last_name' => 'Textil',
            'email' => 'matextil@gmail.com',
            'password' => Hash::make('matextil@54321'),
        ]);

        $sizes = [
            'XXS',
            'XS',
            'S',
            'M',
            'L',
            'XL',
            '2XL',
            '3XL',
            '4XL',
            '5XL',
        ];
        foreach ($sizes as $size) {
            Size::create([
                'name' => $size,
            ]);
        }

        $colors = [
            'Alb',
            'Colorat',
        ];
        foreach ($colors as $color) {
            Color::create([
                'name' => $color,
            ]);
        }

        $this->call([
            BlogSeeder::class,
            ProductSeeder::class,
        ]);
    }
}
