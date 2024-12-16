<?php

namespace Database\Seeders;

use App\Models\Size;
use App\Models\Color;
use App\Models\CombinedColor;
use App\Models\Product\Product;
use App\Models\Product\Brand;
use App\Models\Product\BrandImage;
use App\Models\Product\ProductCategory;
use App\Models\Product\ProductCategoryImage;
use App\Models\Product\ProductType;
use App\Models\Product\ProductTypeImage;
use App\Models\Product\FabricProperty;
use App\Models\Product\CutProperty;
use App\Helpers\FileMethods;
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

    protected $colors = [];
    protected $combinedColors = [];
    
    public function run(): void
    {
        $this->imageNames = array_filter(scandir(storage_path('app/public/images/producttype')), function($fileName) {
            return is_dir(storage_path('app/public/images/producttype') . '/' . $fileName);
        });
        $enProductTypes = require(__DIR__ . '/EnProducts.php');
        $productTypes = require(__DIR__ . '/Products.php');
        $productTypes = array_map(function ($productType) use ($enProductTypes) {
            $enProductType = $this->getEnProductType($productType, $enProductTypes);
            $productType[6] = $enProductType[6];

            return $productType;
        }, $productTypes);
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
                $productType[8]
            );
        }
    }

    protected function create(
        string $name,
        ?int $gPerM2,
        string $brandName,
        string $categoryName,
        array $fabricProperties,
        array $cutProperties,
        array $products,
        array $sizes,
        ?array $priceSizes = null
    ) {
        if (!$priceSizes) {
            if ($products[0]['sizeInterval'] != '') {
                $startIndex = array_search($products[0]['sizeInterval'][0], $this->sizes);
                $endIndex = array_search($products[count($products) - 1]['sizeInterval'][1], $this->sizes);
                $priceSizes = array_slice(
                    $this->sizes,
                    $startIndex,
                    $endIndex - $startIndex + 1
                );
            } else {
                $priceSizes = $this->sizes;
            }
        }
        $productCode = explode(' ', $name)[0];
        $imageNames = [];
        foreach ($this->imageNames as $imageName) {
            if (str_starts_with(strtolower($imageName), strtolower($productCode) . '-')) {
                array_push($imageNames, $imageName);
            }
        }
        
        $brand = Brand::where('name', $brandName)->first();
        if (!$brand) {
            $brandImage = BrandImage::Create([
                'relative_path' => $imageNames[0],
            ]);
            $productTypeImage = new ProductTypeImage();
            $productTypeImage->relative_path = $brandImage->relative_path;
            //FileMethods::copyFolder($productTypeImage->getFolderPath(), $brandImage->getFolderPath());
            $brand = Brand::create([
                'name' => $brandName,
                'image_id' => $brandImage->id,
            ]);
        }
        
        $category = ProductCategory::where('name', $categoryName)->first();
        if (!$category) {
            $categoryImage = ProductCategoryImage::Create([
                'relative_path' => $imageNames[0],
            ]);
            $productTypeImage = new ProductTypeImage();
            $productTypeImage->relative_path = $categoryImage->relative_path;
            //FileMethods::copyFolder($productTypeImage->getFolderPath(), $categoryImage->getFolderPath());
            $category = ProductCategory::Create([
                'name' => $categoryName,
                'image_id' => $categoryImage->id,
            ]);
        }

        $productType = ProductType::create([
            'name' => $name,
            'gram_per_m2' => $gPerM2,
            'brand_id' => $brand->id,
            'product_category_id' => $category->id,
        ]);
        foreach ($imageNames as $imageName) {
            $image = ProductTypeImage::create([
                'relative_path' => $imageName,
                'product_type_id' => $productType->id,
            ]);
            if (!$productType->main_image_id) {
                $productType->main_image_id = $image->id;
            }
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
            foreach ($productData['colors'] as $colorName) {
                $combinedColor = $this->getCombinedColor($colorName);
                $product->combinedColors()->attach($combinedColor->id);
                
                /*$color = Color::where('name', $colorName)->first();
                if ($color) {
                    $product->colors()->attach($color->id);
                } else {
                    //throw new \Exception('itt a hiba');
                    $currentColors = explode('/', $colorName);
                    foreach ($currentColors as $currentColor) {
                        if (!in_array($currentColor, array_keys($this->colors))) {
                            $this->colors[$currentColor] = $name;
                        }
                    }
                }*/
            }
            foreach ($this->getIntervalSizes($productData, $priceSizes) as $intervalSize) {
                $size = Size::firstOrCreate([
                    'name' => $intervalSize,
                ]);
                $product->sizes()->attach($size->id);
            }
        }
        foreach ($sizes as $sizeTypeName => $sizeValues) {
            for ($i = 0; $i < count($sizeValues); ++$i) {
                //try {
                    $productType->sizes()->create([
                        'name' => $sizeTypeName,
                        'value' => $sizeValues[$i],
                        'size_id' => Size::firstOrCreate([
                            'name' => $priceSizes[$i]
                        ])->id,
                    ]);
                //} catch (\Exception $e) {
                //    dd($priceSizes, $name, $sizeValues);
                //}
            }
        }
        $productType->main_image_id = $productType->images[0]->id;
        $productType->save();
    }

    protected function getIntervalSizes(array $productData, array $priceSizes): array
    {
        if (count($productData['sizeInterval']) == 2 && $productData['sizeInterval'][0] != '') {
            $startIndex = array_search($productData['sizeInterval'][0], $priceSizes);
            $endIndex = array_search($productData['sizeInterval'][1], $priceSizes);

            return array_slice(
                $priceSizes,
                $startIndex,
                $endIndex - $startIndex + 1
            );
        } else {
            return $priceSizes;
        }
    }

    protected function getCombinedColor(string $colorName): CombinedColor
    {
        $currentColorNames = collect(explode('/', $colorName));
        foreach ($this->combinedColors as $combinedColor) {
            if ($this->colorNamesAreEquals($currentColorNames, $combinedColor['colors'])) {
                return CombinedColor::find($combinedColor['id']);
            }
        }
        $newCombinedColor = CombinedColor::create([]);
        foreach ($currentColorNames as $colorName) {
            $color = Color::firstOrCreate([
                'name' => $colorName,
            ]);
            $newCombinedColor->colors()->attach($color->id);
        }
        $newCombinedColor->save();
        array_push($this->combinedColors, [
            'id' => $newCombinedColor->id,
            'colors' => $currentColorNames,
        ]);
        return $newCombinedColor;
    }

    protected function colorNamesAreEquals($colorNames, $expectedColorNames): bool
    {
        if ($colorNames->count() == $expectedColorNames->count()) {
            for ($i = 0; $i < $colorNames->count(); ++$i) {
                if ($colorNames[$i] !== $expectedColorNames[$i]) {
                    return false;
                }
            }
            return true;
        } else {
            return false;
        }
    }

    protected function getEnProductType($productType, $enProductTypes)
    {
        foreach ($enProductTypes as $enProductType) {
            if ($enProductType[0] == $productType[0]) {
                return $enProductType;
            }
        }
        throw new \Exception('Nincs angol valtozat ' . $productType[0]);
    }

    protected function getSizeInterval(string $beginSize, string $endSize)
    {
        return array_slice($this->sizes, array_search($beginSize, $this->sizes), array_search($endSize, $this->sizes));
    }
}
