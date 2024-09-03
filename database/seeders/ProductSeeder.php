<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Image;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $image = Image::create([
            'src' => 's.jpg',
        ]);
        $product = Product::create([
            'name' => 'Furo',
            'description' => 'Furasra hasznalhato muszaki targy.',
            'price' => 120,
            'main_image_id' => $image->id,
        ]);
        $product->images()->save($image);
        $product->images()->attach(Image::create([
            'src' => 's1.jpg',
        ]));
        $product->images()->attach(Image::create([
            'src' => 's2.jpg',
        ]));
        $product->images()->attach(Image::create([
            'src' => 's3.jpg',
        ]));
        $product->images()->attach(Image::create([
            'src' => 's4.jpg',
        ]));
    }
}
