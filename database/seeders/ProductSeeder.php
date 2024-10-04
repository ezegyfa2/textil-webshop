<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Size;
use App\Models\Product\Product;
use App\Models\Product\Brand;
use App\Models\Product\ProductCategory;
use App\Models\Product\ProductType;
use App\Models\Product\FabricProperty;
use App\Models\Product\CutProperty;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    protected $sizes = [
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
    protected $whiteColorId = 1;
    protected $coloredColorId = 2;

    public function run(): void
    {
        $productTypes = require(__DIR__ . '/Products.php');
        foreach ($productTypes as $productType) {
            $this->create(
                $productType[0],
                $productType[1],
                $productType[2],
                $productType[3],
                $productType[4],
                $productType[5],
                $productType[6],
                $productType[7],
            );
        }
        /*$product = $this->createWithImage('s.jpg');
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
        $this->createWithImage('s1.jpg');
        $this->createWithImage('s2.jpg');
        $this->createWithImage('s3.jpg');
        $this->createWithImage('s4.jpg');
        $this->createWithImage('s5.jpg');
        $this->createWithImage('s6.jpg');
        $this->createWithImage('s7.jpg');
        $this->createWithImage('s8.jpg');
        $this->createWithImage('s9.jpg');
        $this->createWithImage('s10.jpg');
        $this->createWithImage('s11.png');*/
    }

    protected function createWithImage($imageName)
    {
        $image = Image::create([
            'src' => $imageName,
        ]);
        $product = Product::create([
            'name' => fake()->name(),
            'price' => fake()->numberBetween(0, 20) * 10,
            'main_image_id' => $image->id,
        ]);
        $product->images()->save($image);

        return $product;
    }

    protected function create(
        string $name,
        int $gPerM2,
        string $brandName,
        string $categoryName,
        array $fabricProperties,
        array $cutProperties,
        array $products,
        array $sizes
    ) {
        $productCode = explode(' ', $name)[0];
        $images = [];
        for ($i = 1; $i <= 7; ++$i) {
            array_push($images, Image::firstOrCreate([
                'src' => $productCode . '-' . $i,
            ]));
        }
        $brand = Brand::firstOrCreate([
            'name' => $brandName,
        ], [
            'image_id' => Image::where('src', $productCode . '-1')->first()->id,
        ]);
        $category = ProductCategory::firstOrCreate([
            'name' => $categoryName,
        ]);
        $productType = ProductType::create([
            'name' => $name,
            'gram_per_m2' => $gPerM2,
            'brand_id' => $brand->id,
            'product_category_id' => $category->id,
        ]);
        foreach ($images as $image) {
            $productType->images()->attach($image);
        }
        foreach ($fabricProperties as $fabricProperty) {
            $property = FabricProperty::firstOrCreate([
                'name' => $fabricProperty,
            ]);
            $productType->fabricProperties()->attach($property);
        }
        foreach ($cutProperties as $cutProperty) {
            $property = CutProperty::firstOrCreate([
                'name' => $cutProperty,
            ]);
            $productType->cutProperties()->attach($property);
        }
        foreach ($products as $productData) {
            $product = Product::create([
                'purchase_price' => $productData['purchase_price'],
                'price' => $productData['price'],
                'product_type_id' => $productType->id,
            ]);
            switch ($productData['color']) {
                case 'all':
                    $product->colors()->attach($this->whiteColorId);
                    $product->colors()->attach($this->coloredColorId);
                    break;
                case 'white':
                    $product->colors()->attach($this->whiteColorId);
                    break;
                case 'colored':
                    $product->colors()->attach($this->coloredColorId);
                    break;
            }

            $intervalSizes = array_slice(
                $this->sizes,
                array_search($productData['sizeInterval'][0], $this->sizes),
                array_search($productData['sizeInterval'][1], $this->sizes)
            );
            $beginSizeId = array_search($productData['sizeInterval'][0], $this->sizes) + 1;
            $endSizeId = array_search($productData['sizeInterval'][1], $this->sizes) + 1;
            for ($sizeId = $beginSizeId; $sizeId <= $endSizeId; ++$sizeId) {
                $product->sizes()->attach(Size::find($sizeId));
            }
        }
        foreach ($sizes as $sizeTypeName => $sizeValues) {
            $firstSizeId = array_search($products[0]['sizeInterval'][0], $this->sizes) + 1;
            for ($i = 0; $i < count($sizeValues); ++$i) {
                $productType->sizes()->create([
                    'name' => $sizeTypeName,
                    'value' => $sizeValues[$i],
                    'size_id' => $i + $firstSizeId,
                ]);
            }
        }
        $productType->main_image_id = $productType->images[0]->id;
        $productType->save();
    }

    protected function getSizeInterval(string $beginSize, string $endSize)
    {
        return array_slice($this->sizes, array_search($beginSize, $this->sizes), array_search($endSize, $this->sizes));
    }
}
