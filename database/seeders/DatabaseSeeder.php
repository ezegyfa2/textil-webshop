<?php

namespace Database\Seeders;

use App\Models\Size;
use App\Models\Color;
use App\Models\Product\Product;
use Database\Seeders\BlogSeeder;
use Database\Seeders\ProductSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

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
            [
                'name' => 'White',
                'code' => 'FFFFFF',
            ],
            [
                'name' => 'Sea Blue',
                'code' => '194ec6',
            ],
            [
                'name' => 'Light Olive Green',
                'code' => '787059',
            ],
            [
                'name' => 'Green Field',
                'code' => '0c6d50',
            ],
            [
                'name' => 'Deep Plum',
                'code' => '4b3c4f',
            ],
            [
                'name' => 'Amazon Green',
                'code' => '22393d',
            ],
            [
                'name' => 'Teal',
                'code' => '006373',
            ],
            [
                'name' => 'Strawberry Red',
                'code' => 'db1936',
            ],
            [
                'name' => 'Salsa',
                'code' => 'b04a5a',
            ],
            [
                'name' => 'Rich Violet',
                'code' => '795fa9',
            ],
            [
                'name' => 'Raspberry Crush',
                'code' => 'ab00c9',
            ],
            [
                'name' => 'Peacock',
                'code' => '0c4047',
            ],
            [
                'name' => 'Oasis Green',
                'code' => '7d8039',
            ],
            [
                'name' => 'Mushroom',
                'code' => '4c3c47',
            ],
            [
                'name' => 'Mocha',
                'code' => '95655b',
            ],
            [
                'name' => 'Mid Blue',
                'code' => '7a92b8',
            ],
            [
                'name' => 'Marine Blue',
                'code' => '332d6b',
            ],
            [
                'name' => 'Magenta',
                'code' => 'ed008c',
            ],
            [
                'name' => 'Lilac',
                'code' => 'b8add5',
            ],
            [
                'name' => 'Latte',
                'code' => '9c8e82',
            ],
            [
                'name' => 'Grey Denim',
                'code' => '505759',
            ],
            [
                'name' => 'Duck Egg Blue',
                'code' => '70c7cb',
            ],
            [
                'name' => 'Cyan',
                'code' => '00aeef',
            ],
            [
                'name' => 'Cornflower',
                'code' => '85add1',
            ],
            [
                'name' => 'Chestnut',
                'code' => '9f614a',
            ],
            [
                'name' => 'Blue Denim',
                'code' => '5c92ae',
            ],
            [
                'name' => 'Aubergine',
                'code' => '763e5b',
            ],
            [
                'name' => 'Apple',
                'code' => '61bd68',
            ],
            [
                'name' => 'Marsala',
                'code' => 'bf757f',
            ],
            [
                'name' => 'Dark Pink',
                'code' => 'fba3c8',
            ],
            [
                'name' => 'Cacao',
                'code' => '5c3933',
            ],
            [
                'name' => 'Rosewood',
                'code' => '602b34',
            ],
            [
                'name' => 'Meadow Green',
                'code' => '8b9f61',
            ],
            [
                'name' => 'Hemp',
                'code' => 'a58f74',
            ],
            [
                'name' => 'Ecume',
                'code' => 'e5e8e8',
            ],
            [
                'name' => 'Sunflower',
                'code' => 'ffbf52',
            ],
            [
                'name' => 'Emerald',
                'code' => '188f5b',
            ],
            [
                'name' => 'Bottle',
                'code' => '02573e',
            ],
            [
                'name' => 'Solid Charcoal',
                'code' => '2a353c',
            ],
            [
                'name' => 'Bright Salmon',
                'code' => 'e5554f',
            ],
            [
                'name' => 'Dark Chocolate',
                'code' => '423238',
            ],
            [
                'name' => 'Dark Heather',
                'code' => '3f4444',
            ],
            [
                'name' => 'Heliconia',
                'code' => 'db3e79',
            ],
            [
                'name' => 'Maroon',
                'code' => '5b2b42',
            ],
            [
                'name' => 'Orange',
                'code' => 'df6426',
            ],
            [
                'name' => 'Cherry Red',
                'code' => 'ac2b37',
            ],
            [
                'name' => 'Black',
                'code' => '25282a',
            ],
            [
                'name' => 'Charcoal',
                'code' => '66676c',
            ],
            [
                'name' => 'Daisy',
                'code' => 'fed141',
            ],
            [
                'name' => 'Forest Green',
                'code' => '273b33',
            ],
            [
                'name' => 'Light Blue',
                'code' => 'a3b3cb',
            ],
            [
                'name' => 'Navy',
                'code' => '263147',
            ],
            [
                'name' => 'Purple',
                'code' => '3f2a56',
            ],
            [
                'name' => 'Red',
                'code' => 'b1302a',
            ],
            [
                'name' => 'Royal',
                'code' => '224d8f',
            ],
            [
                'name' => 'RS Sport Grey',
                'code' => '97999b',
            ],
            [
                'name' => 'Sand',
                'code' => 'cabfad',
            ],
            [
                'name' => 'Sapphire',
                'code' => '0077b5',
            ],
            [
                'name' => 'Carolina Blue',
                'code' => '7ba4db',
            ],
            [
                'name' => 'Gold',
                'code' => 'eead1a',
            ],
            [
                'name' => 'Graphite Heather',
                'code' => '707372',
            ],
            [
                'name' => 'Sport Grey',
                'code' => '97999b',
            ],
            [
                'name' => 'Duck Blue',
                'code' => '0f4d6c',
            ],
            [
                'name' => 'Golf Green',
                'code' => '104024',
            ],
            [
                'name' => 'Apple Green',
                'code' => 'becf39',
            ],
            [
                'name' => 'Aqua',
                'code' => '006d9e',
            ],
            [
                'name' => 'Atoll Blue',
                'code' => '32b4c3',
            ],
            [
                'name' => 'Burgundy',
                'code' => '540b22',
            ],
            [
                'name' => 'Chocolate',
                'code' => '251a16',
            ],
            [
                'name' => 'Fuchsia',
                'code' => 'b50057',
            ],
            [
                'name' => 'Grey Melange',
                'code' => 'aeadb3',
            ],
            [
                'name' => 'Kelly Green',
                'code' => '0f7a37',
            ],
            [
                'name' => 'Pink',
                'code' => 'f7cbd9',
            ],
            [
                'name' => 'Royal Blue',
                'code' => '00428e',
            ],
            [
                'name' => 'Sky Blue',
                'code' => '75afde',
            ],
            [
                'name' => 'Army',
                'code' => '3d433a',
            ],
            [
                'name' => 'Dark Purple',
                'code' => '3d156f',
            ],
            [
                'name' => 'Bottle Green',
                'code' => '113520',
            ],
            [
                'name' => 'French Navy',
                'code' => '092a3c',
            ],
            [
                'name' => 'Dark Grey',
                'code' => '575654',
            ],
            [
                'name' => 'Deep Black',
                'code' => '000000',
            ],
            [
                'name' => 'Ash Heather',
                'code' => 'e7e8ea',
            ],
            [
                'name' => 'Deep Blue',
                'code' => '464b65',
            ],
            [
                'name' => 'Light Royal Blue',
                'code' => '2c5697',
            ],
            [
                'name' => 'Light Sand',
                'code' => 'decbb5',
            ],
            [
                'name' => 'Lime',
                'code' => 'a0d868',
            ],
            [
                'name' => 'Oxford Grey',
                'code' => 'adafaf',
            ],
            [
                'name' => 'Pale Pink',
                'code' => 'f2dbdf',
            ],
            [
                'name' => 'Snow Grey',
                'code' => 'aeb2b5',
            ],
            [
                'name' => 'Tropical Blue',
                'code' => '0076a5',
            ],
            [
                'name' => 'True Coral',
                'code' => 'd9615b',
            ],
            [
                'name' => 'Wine',
                'code' => '642e38',
            ],
            [
                'name' => 'Yellow',
                'code' => 'ffcb4f',
            ],
            [
                'name' => 'Chalky Mint',
                'code' => '5cb8b2',
            ],
            [
                'name' => 'Coral Silk',
                'code' => 'df6b7c',
            ],
            [
                'name' => 'Flo Blue',
                'code' => '5576d1',
            ],
            [
                'name' => 'Kiwi',
                'code' => 'a3a76d',
            ],
            [
                'name' => 'Lagoon Blue',
                'code' => '4ac3e0',
            ],
            [
                'name' => 'Light Pink',
                'code' => 'e4bed2',
            ],
            [
                'name' => 'Military Green',
                'code' => '63655a',
            ],
            [
                'name' => 'Tangerine',
                'code' => 'e9954b',
            ],
            [
                'name' => 'Terracotta',
                'code' => 'e3775e',
            ],
            [
                'name' => 'Creamy Blue',
                'code' => 'c7c9d0',
            ],
            [
                'name' => 'Denim',
                'code' => '3d4d63',
            ],
            [
                'name' => 'Slate Blue',
                'code' => '34657f',
            ],
            [
                'name' => 'Grey Heather',
                'code' => '959ca6',
            ],
            [
                'name' => 'French Navy Heather',
                'code' => '30314d',
            ],
            [
                'name' => 'Light Khaki',
                'code' => '535435',
            ],
            [
                'name' => 'Khaki',
                'code' => '737e6a',
            ],
            [
                'name' => 'Orchid Pink',
                'code' => 'e6649c',
            ],
            [
                'name' => 'Ash',
                'code' => 'e7e8ea',
            ],
            [
                'name' => 'Mouse Grey',
                'code' => '42454c',
            ],
            [
                'name' => 'Silver',
                'code' => 'aea8a5',
            ],
            [
                'name' => 'Green',
                'code' => '3f9c35',
            ],
            [
                'name' => 'Light Grey',
                'code' => 'cfcdc9',
            ],
            [
                'name' => 'Neon Orange',
                'code' => 'f1771d',
            ],
            [
                'name' => 'Grey',
                'code' => 'aeadb3',
            ],
            [
                'name' => 'Neon Coral',
                'code' => 'f15c6e',
            ],
            [
                'name' => 'Sage',
                'code' => '99aca3',
            ],
            [
                'name' => 'Night Blue Heather',
                'code' => '46558d',
            ],
            [
                'name' => 'Slub Grey Heather',
                'code' => 'd5d5d2',
            ],
            [
                'name' => 'Vintage Dark Red',
                'code' => 'ba0c2f',
            ],
            [
                'name' => 'Vintage Charcoal',
                'code' => '404545',
            ],
            [
                'name' => 'Vintage Navy',
                'code' => '20314d',
            ],
            [
                'name' => 'Mint',
                'code' => '84c4ab',
            ],
            [
                'name' => 'Charcoal Melange',
                'code' => '3c4552',
            ],
            [
                'name' => 'Ultramarine',
                'code' => '053c84',
            ],
            [
                'name' => 'Deep Grey Heather',
                'code' => '45403b',
            ],
            [
                'name' => 'Dark Royal Blue',
                'code' => '00358e',
            ],
            [
                'name' => 'Sporty Grey',
                'code' => '54585a',
            ],
            [
                'name' => 'Sporty Navy',
                'code' => '253746',
            ],
            [
                'name' => 'Gunmetal Grey',
                'code' => '676767',
            ],
            [
                'name' => 'Wine Heather',
                'code' => '582e35',
            ],
            [
                'name' => 'Sporty Red',
                'code' => 'eb0024',
            ],
            [
                'name' => 'Sporty Royal Blue',
                'code' => '0380ff',
            ],
            [
                'name' => 'Jet Black',
                'code' => '171c21',
            ],
            [
                'name' => 'Arctic White',
                'code' => 'ffffff',
            ],
            [
                'name' => 'Fire Red',
                'code' => 'ba0c2f',
            ],
            [
                'name' => 'Black Slate Melange',
                'code' => '010407',
            ],
            [
                'name' => 'Navy Melange',
                'code' => '00152f',
            ],
            [
                'name' => 'Ocean',
                'code' => '22aebb',
            ],
            [
                'name' => 'Ocean Melange',
                'code' => '00bab3',
            ],
            [
                'name' => 'Red Melange',
                'code' => 'eb0024',
            ],
            [
                'name' => 'Royal Melange',
                'code' => '0065d2',
            ],
            [
                'name' => 'Raspberry Melange',
                'code' => 'c000eb',
            ],
            [
                'name' => 'Electric Pink Melange',
                'code' => 'f97394',
            ],
            [
                'name' => 'Sports Grey',
                'code' => '9ea2a2',
            ],
            [
                'name' => 'Silver Grey',
                'code' => '9dbab8',
            ],
            [
                'name' => 'Flashy Yellow',
                'code' => 'f8eb25',
            ],
            [
                'name' => 'Fluorescent Yellow',
                'code' => 'd1ff2e',
            ],
            [
                'name' => 'Aqua Blue',
                'code' => '0076a8',
            ],
            [
                'name' => 'Fine Grey',
                'code' => '8e8e8f',
            ],
            [
                'name' => 'Neon Green',
                'code' => '9dca2c',
            ],
            [
                'name' => 'Neon Yellow',
                'code' => 'dde128',
            ],
            [
                'name' => 'Electric Yellow',
                'code' => 'dfeb2f',
            ],
            [
                'name' => 'Sapphire Blue',
                'code' => '26c9ff',
            ],
            [
                'name' => 'Lime Green',
                'code' => '75ff00',
            ],
            [
                'name' => 'Electric Orange',
                'code' => 'f85c29',
            ],
            [
                'name' => 'Fluorescent Pink',
                'code' => 'eb5a81',
            ],
            [
                'name' => 'Black Heather',
                'code' => '000000',
            ],
            [
                'name' => 'Sporty Navy Heather',
                'code' => '253746',
            ],
            [
                'name' => 'Sporty Red Heather',
                'code' => 'eb0024',
            ],
            [
                'name' => 'Sporty Royal Blue Heather',
                'code' => '0380ff',
            ],
            [
                'name' => 'Sporty Yellow',
                'code' => 'ffcf1c',
            ],
            [
                'name' => 'Garnet',
                'code' => '550027',
            ],
            [
                'name' => 'Ice Mint',
                'code' => 'b5e3d8',
            ],
            [
                'name' => 'Light Turquoise',
                'code' => '42ffde',
            ],
            [
                'name' => 'Sporty Pink',
                'code' => 'd33669',
            ],
            [
                'name' => 'Sporty Purple',
                'code' => '512d7e',
            ],
            [
                'name' => 'Dark Grey Heather',
                'code' => '424b58',
            ],
            [
                'name' => 'Dark Khaki Heather',
                'code' => '434237',
            ],
            [
                'name' => 'Electric Pink',
                'code' => 'fd698e',
            ],
            [
                'name' => 'Hot Pink',
                'code' => 'ce0f69',
            ],
            [
                'name' => 'Iron Grey',
                'code' => '526066',
            ],
            [
                'name' => 'Mineral Green',
                'code' => '303828',
            ],
            [
                'name' => 'Cobalt Navy',
                'code' => '152038',
            ],
            [
                'name' => 'Bright Green',
                'code' => '13893f',
            ],
            [
                'name' => 'Fluorescent Orange',
                'code' => 'ff680a',
            ],
            [
                'name' => 'Black Urban Marl',
                'code' => '39373b',
            ],
            [
                'name' => 'Grey Urban Marl',
                'code' => '5e5b60',
            ],
            [
                'name' => 'Navy Urban Marl',
                'code' => '4e5368',
            ],
            [
                'name' => 'Digital Lavender',
                'code' => '7870f5',
            ],
            [
                'name' => 'Electric Green',
                'code' => 'a4dc30',
            ],
            [
                'name' => 'Sun Yellow',
                'code' => 'fedb00',
            ],
            [
                'name' => 'Sporty Sky Blue',
                'code' => '52a8ff',
            ],
            [
                'name' => 'Spicy Orange',
                'code' => 'eb6445',
            ],
            [
                'name' => 'Fluorescent Green',
                'code' => '',
            ],
            [
                'name' => 'Storm Grey Melange',
                'code' => '736f71',
            ],
            [
                'name' => 'Coral',
                'code' => 'e35456',
            ],
            [
                'name' => 'Olive',
                'code' => '635939',
            ],
            [
                'name' => 'True Yellow',
                'code' => 'ffcb00',
            ],
            [
                'name' => 'Violet',
                'code' => '4c4184',
            ],
            [
                'name' => 'Pure Grey',
                'code' => '99a5ab',
            ],
            [
                'name' => 'Neon Pink 2',
                'code' => 'e63c81',
            ],
            [
                'name' => 'Petroleum Blue',
                'code' => '003b49',
            ],
            [
                'name' => 'Lemon',
                'code' => 'ffea0d',
            ],
            [
                'name' => 'Sun Orange',
                'code' => 'e9864f',
            ],
            [
                'name' => 'Storm Grey',
                'code' => '736f71',
            ],
            [
                'name' => 'Deep Grey',
                'code' => '5e585a',
            ],
            [
                'name' => 'Bright Red',
                'code' => 'e53131',
            ],
            [
                'name' => 'Off White',
                'code' => 'fff8df',
            ],
            [
                'name' => 'Candy Pink',
                'code' => 'f7b3bc',
            ],
            [
                'name' => 'Spring Green',
                'code' => '2ea043',
            ],
            [
                'name' => 'Frozen Green',
                'code' => 'bedecb',
            ],
            [
                'name' => 'Natural',
                'code' => 'f4ece0',
            ],
            [
                'name' => 'Beige',
                'code' => 'beb2a6',
            ],
            [
                'name' => 'Dark Cool Grey',
                'code' => 'acacac',
            ],
            [
                'name' => 'Light Navy Heather',
                'code' => '36496a',
            ],
            [
                'name' => 'Sand Heather',
                'code' => 'cabcb3',
            ],
            [
                'name' => 'Silver Heather',
                'code' => '837c7e',
            ],
            [
                'name' => 'Steel Grey Heather',
                'code' => '5a5758',
            ],
            [
                'name' => 'Tawny Port Heather',
                'code' => '5e2c2f',
            ],
            [
                'name' => 'Alloy Grey Heather',
                'code' => '9f9f9f',
            ],
            [
                'name' => 'Dress Blue',
                'code' => '292b3a',
            ],
            [
                'name' => 'Anthracite melanged',
                'code' => '484140',
            ],
            [
                'name' => 'Gray Melanged',
                'code' => '938882',
            ],
            [
                'name' => 'Night Melanged',
                'code' => '38304f',
            ],
            [
                'name' => 'Night Navy',
                'code' => '2c3841',
            ],
            [
                'name' => 'Steel Grey',
                'code' => '63666a',
            ],
            [
                'name' => 'Shale Grey',
                'code' => '70635f',
            ],
            [
                'name' => 'Black Washed',
                'code' => '47484d',
            ],
            [
                'name' => 'Dark Pink Washed',
                'code' => 'fba3c8',
            ],
            [
                'name' => 'Navy Washed',
                'code' => '52636d',
            ],
            [
                'name' => 'Red Washed',
                'code' => 'c03e4f',
            ],
            [
                'name' => 'Sand Washed',
                'code' => 'd7d3c7',
            ],
            [
                'name' => 'Storm Grey Washed',
                'code' => '202b2d',
            ],
            [
                'name' => 'Shadow Grey Heather',
                'code' => '14202a',
            ],
            [
                'name' => 'Surf Blue',
                'code' => '31889c',
            ],
            [
                'name' => 'Pineapple',
                'code' => 'fedb77',
            ],
            [
                'name' => 'Light Green',
                'code' => 'b6da9d',
            ],
            [
                'name' => 'Off Grey',
                'code' => '73737d',
            ],
            [
                'name' => 'Off Navy',
                'code' => '2c333d',
            ],
            [
                'name' => 'Lagoon',
                'code' => '5cb5e4',
            ],
            [
                'name' => 'Slate Grey',
                'code' => '4b5657',
            ],
            [
                'name' => 'Corde',
                'code' => 'd4c096',
            ],
            [
                'name' => 'Jungle',
                'code' => '1f362a',
            ],
            [
                'name' => 'Charcoal Grey',
                'code' => '1d1c29',
            ],
            [
                'name' => 'Hibiscus Red',
                'code' => '861b2f',
            ],
            [
                'name' => 'Linen',
                'code' => 'dbceac',
            ],
            [
                'name' => 'Azur Blue',
                'code' => '6aade4',
            ],
            [
                'name' => 'Bordeaux',
                'code' => '843648',
            ],
            [
                'name' => 'Burnt Orange',
                'code' => 'c4622d',
            ],
            [
                'name' => 'Mastic',
                'code' => 'd9c0a9',
            ],
            [
                'name' => 'Turquoise',
                'code' => '009abc',
            ],
            [
                'name' => 'Striped White',
                'code' => 'ffffff',
            ],
            [
                'name' => 'Smoke',
                'code' => '98a5bf',
            ],
            [
                'name' => 'Vintage Graphite',
                'code' => '3b3b3a',
            ],
            [
                'name' => 'Vintage Sapphire',
                'code' => '14304b',
            ],
            [
                'name' => 'Striped Dark Grey',
                'code' => '3f4444',
            ],
            [
                'name' => 'Tropical Pink',
                'code' => 'ce0f69',
            ],
            [
                'name' => 'Striped Denim',
                'code' => '021e2f',
            ],
            [
                'name' => 'Light Navy',
                'code' => '002144',
            ],
            [
                'name' => 'Icy Grey',
                'code' => '75787b',
            ],
            [
                'name' => 'Icy Navy',
                'code' => '22314e',
            ],
            [
                'name' => 'Icy White',
                'code' => 'e7e8ea',
            ],
            [
                'name' => 'Olive Camouflage',
                'code' => '7f7163',
            ],
            [
                'name' => 'Silver Blue',
                'code' => 'bdc4d6',
            ],
            [
                'name' => 'Ecru',
                'code' => 'dcd7d4',
            ],
            [
                'name' => 'Taupe',
                'code' => '998576',
            ],
            [
                'name' => 'Ivory',
                'code' => 'd1ccbd',
            ],
            [
                'name' => 'Jade Green',
                'code' => '92aca0',
            ],
            [
                'name' => 'Moon Grey Heather',
                'code' => '6a6d68',
            ],
            [
                'name' => 'Navy Blue',
                'code' => '1d252d',
            ],
            [
                'name' => 'Aquamarine',
                'code' => 'a4bcc2',
            ],
            [
                'name' => 'Mineral Grey',
                'code' => '5b6770',
            ],
            [
                'name' => 'Black Camo',
                'code' => '000000',
            ],
            [
                'name' => 'Green Camo',
                'code' => '33342E',
            ],
            [
                'name' => 'Skate Graffiti',
                'code' => 'abcdef',
            ],
            [
                'name' => 'Heather Grey',
                'code' => 'a2aaad',
            ],
            [
                'name' => 'Oxford Navy',
                'code' => '13294b',
            ],
            [
                'name' => 'Baby Pink',
                'code' => 'f5b6cd',
            ],
            [
                'name' => 'New French Navy',
                'code' => '081f2c',
            ],
            [
                'name' => 'Desert Sand',
                'code' => 'e5cfa5',
            ],
            [
                'name' => 'Hawaiian Blue',
                'code' => '00a9e0',
            ],
            [
                'name' => 'Orange Crush',
                'code' => 'ff6a13',
            ],
            [
                'name' => 'Airforce Blue',
                'code' => '4f758b',
            ],
            [
                'name' => 'Black Smoke',
                'code' => '3e393f',
            ],
            [
                'name' => 'Candyfloss Pink',
                'code' => 'e782a9',
            ],
            [
                'name' => 'Dusty Green',
                'code' => '759d8b',
            ],
            [
                'name' => 'Dusty Pink',
                'code' => 'a67570',
            ],
            [
                'name' => 'Jade',
                'code' => '007377',
            ],
            [
                'name' => 'Olive Green',
                'code' => '4a412a',
            ],
            [
                'name' => 'Peppermint',
                'code' => '98dbce',
            ],
            [
                'name' => 'Plum',
                'code' => '653165',
            ],
            [
                'name' => 'Red Hot Chilli',
                'code' => '9d2235',
            ],
            [
                'name' => 'Heather Sport Dark Maroon',
                'code' => '651d32',
            ],
            [
                'name' => 'Heather Sport Scarlet Red',
                'code' => 'bf0d3e',
            ],
            [
                'name' => 'Irish Green',
                'code' => '009e69',
            ],
            [
                'name' => 'Mustard',
                'code' => 'c69229',
            ],
            [
                'name' => 'Blue',
                'code' => '1fa0c2',
            ],
            [
                'name' => 'Alien',
                'code' => '414e82',
            ],
            [
                'name' => 'Hi-Vis Orange',
                'code' => 'F49953',
            ],
            [
                'name' => 'Ice Hockey',
                'code' => '6F6991',
            ],
            [
                'name' => 'Hi-Vis Yellow',
                'code' => 'F6EA2F',
            ],
            [
                'name' => 'Soccer',
                'code' => '80AF5A',
            ],
            [
                'name' => 'Knight',
                'code' => 'CABD89',
            ],
            [
                'name' => 'UFO',
                'code' => '474966',
            ],
            [
                'name' => 'Neon Pink',
                'code' => 'fd6977',
            ],
            [
                'name' => 'Unicorn',
                'code' => 'FBC0CE',
            ],
            [
                'name' => 'Safety Pink',
                'code' => 'e16f8f',
            ],
            [
                'name' => 'Brown',
                'code' => '632510',
            ],
            [
                'name' => 'Camo',
                'code' => '574219',
            ],
            [
                'name' => 'Graphite',
                'code' => '6e7372',
            ],
            [
                'name' => 'Peacock Blue',
                'code' => '253746',
            ],
            [
                'name' => 'Petal Rose',
                'code' => 'ca9a8e',
            ],
            [
                'name' => 'Raspberry Sorbet',
                'code' => 'd23b6c',
            ],
            [
                'name' => 'Baby Blue',
                'code' => 'd1e0e6',
            ],
            [
                'name' => 'Medium Pink',
                'code' => 'fae0eb',
            ],
            [
                'name' => 'Pitch Black',
                'code' => '000000',
            ],
            [
                'name' => 'Melange Grey',
                'code' => '8c8d87',
            ],
            [
                'name' => 'Heather Pink',
                'code' => 'f3c6e1',
            ],
            [
                'name' => 'Heather Sky',
                'code' => 'c2dcee',
            ],
            [
                'name' => 'Ash Grey',
                'code' => 'c8c9c7',
            ],
            [
                'name' => 'Azalea',
                'code' => 'd977a9',
            ],
            [
                'name' => 'Cardinal Red',
                'code' => '8d2838',
            ],
            [
                'name' => 'Indigo Blue',
                'code' => '486d87',
            ],
            [
                'name' => 'Mint Green',
                'code' => 'a0cfa8',
            ],
            [
                'name' => 'Yellow Haze',
                'code' => 'f4d199',
            ],
            [
                'name' => 'Neon Lime',
                'code' => 'b2d225',
            ],
            [
                'name' => 'Neon Gold',
                'code' => 'c4d600',
            ],
            [
                'name' => 'Safety Green',
                'code' => 'c6d219',
            ],
            [
                'name' => 'Convoy Grey',
                'code' => '8c8b89',
            ],
            [
                'name' => 'Camel Heather',
                'code' => 'cc946c',
            ],
            [
                'name' => 'Cloudy Blue Heather',
                'code' => '569eac',
            ],
            [
                'name' => 'Green Marble Heather',
                'code' => '494c45',
            ],
            [
                'name' => 'Green Olive',
                'code' => '56584f',
            ],
            [
                'name' => 'True Indigo',
                'code' => '213638',
            ],
            [
                'name' => 'Fir Green',
                'code' => '066543',
            ],
            [
                'name' => 'Rope',
                'code' => 'bcb79d',
            ],
            [
                'name' => 'Moss Green',
                'code' => '445a3e',
            ],
            [
                'name' => 'Pepper Red',
                'code' => 'ab002d',
            ],
            [
                'name' => 'Magma',
                'code' => 'e2552c',
            ],
            [
                'name' => 'Rock Grey',
                'code' => '7f7c81',
            ],
            [
                'name' => 'Vibrant Purple',
                'code' => '4a287e',
            ],
            [
                'name' => 'Light Steel',
                'code' => 'aeb2b5',
            ],
            [
                'name' => 'Classic Red',
                'code' => 'c31623',
            ],
            [
                'name' => 'Dk Spruce',
                'code' => '515b50',
            ],
            [
                'name' => 'Extreme Green',
                'code' => '44883c',
            ],
            [
                'name' => 'French Blue',
                'code' => '0072b5',
            ],
            [
                'name' => 'New Royal',
                'code' => '124999',
            ],
            [
                'name' => 'Seal Grey',
                'code' => '425159',
            ],
            [
                'name' => 'Oxford Blue',
                'code' => 'c5d6e8',
            ],
            [
                'name' => 'Chambray Blue',
                'code' => '4a6994',
            ],
            [
                'name' => 'Action Navy',
                'code' => '1f2a44',
            ],
            [
                'name' => 'Calm Pink',
                'code' => 'b46b7a',
            ],
            [
                'name' => 'Ceil Blue',
                'code' => '5f8dda',
            ],
            [
                'name' => 'Clean Green',
                'code' => '00594c',
            ],
            [
                'name' => 'Dynamo Grey',
                'code' => '5b6770',
            ],
            [
                'name' => 'Exact Black',
                'code' => '000000',
            ],
            [
                'name' => 'Blue Jean',
                'code' => '64748b',
            ],
            [
                'name' => 'Bright Sky',
                'code' => 'b2c8e7',
            ],
            [
                'name' => 'Zinc',
                'code' => '353735',
            ],
            [
                'name' => 'Essential Light Blue',
                'code' => 'b5c1df',
            ],
            [
                'name' => 'Essential Blue',
                'code' => 'adbae3',
            ],
            [
                'name' => 'Titanium',
                'code' => '5d6167',
            ],
            [
                'name' => 'Dark Khaki',
                'code' => '655638',
            ],
            [
                'name' => 'Marl',
                'code' => '3a3124',
            ],
            [
                'name' => 'Camel',
                'code' => '8b6f4e',
            ],
            [
                'name' => 'Dark Grey Melange',
                'code' => '332e2c',
            ],
            [
                'name' => 'Dark Khaki Melange',
                'code' => '2e3428',
            ],
            [
                'name' => 'Light Grey Melange',
                'code' => 'a49e96',
            ],
            [
                'name' => 'Light Royal Blue Melange',
                'code' => '5171a0',
            ],
            [
                'name' => 'Dark Army',
                'code' => '3e5023',
            ],
            [
                'name' => 'Carbon Grey',
                'code' => '3a3422',
            ],
            [
                'name' => 'Shear Beige',
                'code' => 'fffbe6',
            ],
            [
                'name' => 'Bright Royal',
                'code' => '002dcb',
            ],
            [
                'name' => 'Cornflower Blue',
                'code' => '7da1c4',
            ],
            [
                'name' => 'Mocha Brown',
                'code' => '91827b',
            ],
            [
                'name' => 'Seafoam',
                'code' => '61bbaa',
            ],
            [
                'name' => 'Caramel Latte',
                'code' => 'a37c68',
            ],
            [
                'name' => 'Chocolate Fudge Brownie',
                'code' => '362421',
            ],
            [
                'name' => 'Cranberry',
                'code' => '861f41',
            ],
            [
                'name' => 'Dusty Lilac',
                'code' => '6b7292',
            ],
            [
                'name' => 'Dusty Rose',
                'code' => 'a8628d',
            ],
            [
                'name' => 'Earthy Green',
                'code' => '476240',
            ],
            [
                'name' => 'Festival Fuchsia',
                'code' => '8f10af',
            ],
            [
                'name' => 'Ginger Biscuit',
                'code' => '8f3923',
            ],
            [
                'name' => 'Hot Chocolate',
                'code' => '382f2d',
            ],
            [
                'name' => 'Lavender',
                'code' => 'c1a0da',
            ],
            [
                'name' => 'Moondust Grey',
                'code' => 'c1c6c8',
            ],
            [
                'name' => 'Natural Stone',
                'code' => 'a4ada6',
            ],
            [
                'name' => 'Nude',
                'code' => 'cda788',
            ],
            [
                'name' => 'Pistachio Green',
                'code' => '98c18c',
            ],
            [
                'name' => 'Pumpkin Pie',
                'code' => 'c26415',
            ],
            [
                'name' => 'Turquoise Surf',
                'code' => '00c1d5',
            ],
            [
                'name' => 'Vanilla Milkshake',
                'code' => 'f1e6b2',
            ],
            [
                'name' => 'Creamy Green',
                'code' => 'e9ede9',
            ],
            [
                'name' => 'Heather Sport Dark Green',
                'code' => '43695b',
            ],
            [
                'name' => 'Heather Sport Royal',
                'code' => '1d4f91',
            ],
            [
                'name' => 'Legion Blue',
                'code' => '1f495b',
            ],
            [
                'name' => 'Antique Cherry Red',
                'code' => '971b2f',
            ],
            [
                'name' => 'Antique Sapphire',
                'code' => '006a8e',
            ],
            [
                'name' => 'Heather Sport Dark Navy',
                'code' => '4a5b6e',
            ],
            [
                'name' => 'Old Gold',
                'code' => 'ca9f75',
            ],
            [
                'name' => 'Orchid',
                'code' => 'c5b4e3',
            ],
            [
                'name' => 'S.Orange',
                'code' => 'e5801c',
            ],
            [
                'name' => 'Cement',
                'code' => 'aeaeae',
            ],
            [
                'name' => 'Cocoa',
                'code' => '6b3d2e',
            ],
            [
                'name' => 'Pink Lemonade',
                'code' => 'f04e98',
            ],
            [
                'name' => 'Pistachio',
                'code' => 'bdc293',
            ],
            [
                'name' => 'Sky',
                'code' => '71c5e8',
            ],
            [
                'name' => 'Paragon',
                'code' => '948794',
            ],
            [
                'name' => 'Stone Blue',
                'code' => '788995',
            ],
            [
                'name' => 'Alien Green',
                'code' => '78be20',
            ],
            [
                'name' => 'Citrus',
                'code' => 'c2fa0f',
            ],
            [
                'name' => 'Soft Red',
                'code' => 'e12a66',
            ],
            [
                'name' => 'Brick Red',
                'code' => '8f3237',
            ],
            [
                'name' => 'Burgundy Smoke',
                'code' => '672146',
            ],
            [
                'name' => 'Caramel Toffee',
                'code' => '6b4c38',
            ],
            [
                'name' => 'Combat Green',
                'code' => '373b3c',
            ],
            [
                'name' => 'Deep Sea Blue',
                'code' => '004f71',
            ],
            [
                'name' => 'Denim Blue',
                'code' => '326295',
            ],
            [
                'name' => 'Dusty Blue',
                'code' => '728999',
            ],
            [
                'name' => 'Dusty Purple',
                'code' => '936c7f',
            ],
            [
                'name' => 'Ink Blue',
                'code' => '033b56',
            ],
            [
                'name' => 'Lipstick Pink',
                'code' => 'e0004d',
            ],
            [
                'name' => 'Magenta Magic',
                'code' => '6d2077',
            ],
            [
                'name' => 'Navy Smoke',
                'code' => '071e45',
            ],
            [
                'name' => 'Peach Perfect',
                'code' => 'fdd0bd',
            ],
            [
                'name' => 'Pinky Purple',
                'code' => 'c6579a',
            ],
            [
                'name' => 'Red Rust',
                'code' => '622938',
            ],
            [
                'name' => 'Shark Grey',
                'code' => '2a353c',
            ],
            [
                'name' => 'Sherbet Lemon',
                'code' => 'fbdb65',
            ],
            [
                'name' => 'Sunset Orange',
                'code' => 'fb2b29',
            ],
            [
                'name' => 'True Violet',
                'code' => '9595d2',
            ],
            [
                'name' => 'Ultra Violet',
                'code' => '330072',
            ],
            [
                'name' => 'Wild Mulberry',
                'code' => '64516c',
            ],
            [
                'name' => 'Candyfloss',
                'code' => 'db8480',
            ],
            [
                'name' => 'Caper Green',
                'code' => '76786e',
            ],
            [
                'name' => 'Dark Mustard',
                'code' => 'd2a034',
            ],
            [
                'name' => 'Emerald Green',
                'code' => '004d6f',
            ],
            [
                'name' => 'Grey Camouflage',
                'code' => '787772',
            ],
            [
                'name' => 'Hawaii Blue',
                'code' => '0077ac',
            ],
            [
                'name' => 'Moka Brown',
                'code' => '928579',
            ],
            [
                'name' => 'Orion Blue',
                'code' => '526171',
            ],
            [
                'name' => 'Peach',
                'code' => 'cd9179',
            ],
            [
                'name' => 'Pumpkin',
                'code' => 'd38b36',
            ],
            [
                'name' => 'Straw Yellow',
                'code' => 'f8e497',
            ],
            [
                'name' => 'Sweet Grey',
                'code' => 'c1c0bf',
            ],
            [
                'name' => 'Surf Ocean',
                'code' => '88d2d1',
            ],
            [
                'name' => 'Surf Pink',
                'code' => 'f9bbcc',
            ],
            [
                'name' => 'Surf Purple',
                'code' => 'd2b1d1',
            ],
            [
                'name' => 'Surf Yellow',
                'code' => 'fbf7cc',
            ],
            [
                'name' => 'Lemon Yellow',
                'code' => 'e2df81',
            ],
            [
                'name' => 'Mossy Green',
                'code' => '484f42',
            ],
            [
                'name' => 'Ocean Blue Heather',
                'code' => '365886',
            ],
            [
                'name' => 'Blue Melange',
                'code' => '4b4f6a',
            ],
            [
                'name' => 'Light Kelly Green',
                'code' => '00a355',
            ],
            [
                'name' => 'Clay',
                'code' => 'bcb4ae',
            ],
            [
                'name' => 'Deep Purple',
                'code' => '4a4069',
            ],
            [
                'name' => 'Light Orange',
                'code' => 'e2af63',
            ],
            [
                'name' => 'Sea Turquoise',
                'code' => '1aa3c4',
            ],
            [
                'name' => 'Terracotta Red',
                'code' => '8f3b43',
            ],
            [
                'name' => 'Black Denim',
                'code' => '171719',
            ],
            [
                'name' => 'Indigo Denim',
                'code' => '647692',
            ],
            [
                'name' => 'Steel',
                'code' => '42596c',
            ],
            [
                'name' => 'Angora',
                'code' => 'cebaa8',
            ],
            [
                'name' => 'Bright Turquoise',
                'code' => '00aed8',
            ],
            [
                'name' => 'Burnt Lime',
                'code' => 'a8b300',
            ],
            [
                'name' => 'Cobalt Blue',
                'code' => '264583',
            ],
            [
                'name' => 'Marl Storm Grey',
                'code' => '4d4d4d',
            ],
            [
                'name' => 'Urban Grey',
                'code' => '626879',
            ],
            [
                'name' => 'Oxford Silver',
                'code' => '747678',
            ],
            [
                'name' => 'Oxford Zinc',
                'code' => '9d9a9b',
            ],
            [
                'name' => 'Pale Blue',
                'code' => 'a7c6ed',
            ],
            [
                'name' => 'Dark Blue',
                'code' => '323545',
            ],
            [
                'name' => 'Striped Pale Blue',
                'code' => 'a7c6ed',
            ],
            [
                'name' => 'Almond Green',
                'code' => '7e7f74',
            ],
            [
                'name' => 'Amazon Green Heather',
                'code' => '051d23',
            ],
            [
                'name' => 'Blue Sapphire',
                'code' => '05577c',
            ],
            [
                'name' => 'Cool Blue Heather',
                'code' => '4c6983',
            ],
            [
                'name' => 'Gemstone Green',
                'code' => '098475',
            ],
            [
                'name' => 'Navy Blue Heather',
                'code' => '1c2029',
            ],
            [
                'name' => 'Organic Khaki',
                'code' => '51534a',
            ],
            [
                'name' => 'Peacock Green',
                'code' => '00575f',
            ],
            [
                'name' => 'Poppy Red',
                'code' => 'c01c2e',
            ],
            [
                'name' => 'Sienna',
                'code' => '876156',
            ],
            [
                'name' => 'Volcano Grey Heather',
                'code' => '202322',
            ],
            [
                'name' => 'Wet Sand',
                'code' => 'a69f88',
            ],
            [
                'name' => 'Mexican Skull',
                'code' => '1',
            ],
            [
                'name' => 'Mariniere',
                'code' => '2',
            ],
            [
                'name' => 'Red Tartan',
                'code' => '3',
            ],
            [
                'name' => 'Blue Camo',
                'code' => '2e405b',
            ],
            [
                'name' => 'Red Camo',
                'code' => 'c10a3f',
            ],
            [
                'name' => 'Grey Camo',
                'code' => 'a2aaad',
            ],
            [
                'name' => 'Blue Cloud',
                'code' => '89cff0',
            ],
            [
                'name' => 'Grey Pink Marble',
                'code' => 'd3d3d3',
            ],
            [
                'name' => 'Pastel Sunset Dip',
                'code' => 'ffe08f',
            ],
            [
                'name' => 'Tie-Dye Swirl',
                'code' => 'ffeb52',
            ],
            [
                'name' => 'Curcuma',
                'code' => 'a76d11',
            ],
            [
                'name' => 'Sporty Kelly Green',
                'code' => '00794f',
            ],
            [
                'name' => 'Dark Cherry',
                'code' => '512f2e',
            ],
            [
                'name' => 'Creamy Pink',
                'code' => 'f3dfd6',
            ],
            [
                'name' => 'Marl Green',
                'code' => '605c51',
            ],
            [
                'name' => 'Marl Grey',
                'code' => '818a90',
            ],
            [
                'name' => 'Heather Denim',
                'code' => '464d60',
            ],
            [
                'name' => 'Caribbean Blue',
                'code' => '00a9ce',
            ],
            [
                'name' => 'Charity Pink',
                'code' => 'F8A3BC',
            ],
            [
                'name' => 'Teal Ice',
                'code' => 'B1E4E3',
            ],
            [
                'name' => 'True Red',
                'code' => 'BB1237',
            ],
            [
                'name' => 'Heather Military Green',
                'code' => '7E7F74',
            ],
            [
                'name' => 'Heather Navy',
                'code' => '333F48',
            ],
            [
                'name' => 'Heather Royal',
                'code' => '307FE2',
            ],
            [
                'name' => 'Jade Dome',
                'code' => '008E85',
            ],
            [
                'name' => 'Antique Heliconia',
                'code' => 'AA0061',
            ],
            [
                'name' => 'Berry',
                'code' => '7F2952',
            ],
            [
                'name' => 'Cobalt',
                'code' => '374393',
            ],
            [
                'name' => 'Cornsilk',
                'code' => 'f0ec74',
            ],
            [
                'name' => 'Heather Orange',
                'code' => 'FF8D6D',
            ],
            [
                'name' => 'Heather Purple',
                'code' => '614B79',
            ],
            [
                'name' => 'Apricot',
                'code' => 'FF8D6D',
            ],
            [
                'name' => 'Light Purple',
                'code' => '68508E',
            ],
            [
                'name' => 'Tango Red',
                'code' => '8B001C',
            ],
            [
                'name' => 'Antique Irish Green',
                'code' => '00843D',
            ],
            [
                'name' => 'Antique Jade Dome',
                'code' => '006269',
            ],
            [
                'name' => 'Antique Orange',
                'code' => 'B33D26',
            ],
            [
                'name' => 'Blackberry',
                'code' => '4A3041',
            ],
            [
                'name' => 'Brown Savana',
                'code' => '776A60',
            ],
            [
                'name' => 'Heather Sapphire',
                'code' => '0076A8',
            ],
            [
                'name' => 'Midnight',
                'code' => '005670',
            ],
            [
                'name' => 'Russet',
                'code' => '512F2E',
            ],
            [
                'name' => 'Sunset',
                'code' => 'DC6B2F',
            ],
            [
                'name' => 'Tweed',
                'code' => '4B4F54',
            ],
            [
                'name' => 'Ancient Pink',
                'code' => 'A36167',
            ],
            [
                'name' => 'Chili',
                'code' => '5A151A',
            ],
            [
                'name' => 'Cream',
                'code' => 'F7EECF',
            ],
            [
                'name' => 'Earth',
                'code' => '3E281B',
            ],
            [
                'name' => 'Hibiscus',
                'code' => 'EF3340',
            ],
            [
                'name' => 'Ice Blue',
                'code' => '7F99A7',
            ],
            [
                'name' => 'Sage Green',
                'code' => 'CED7AD',
            ],
            [
                'name' => 'Coconut Milk',
                'code' => 'F7F4EC',
            ],
            [
                'name' => 'Blue Dusk',
                'code' => '253746',
            ],
            [
                'name' => 'Heather Cardinal',
                'code' => '9B2743',
            ],
            [
                'name' => 'Ice Grey',
                'code' => 'd0c4c5',
            ],
            [
                'name' => 'Iris',
                'code' => '3975B7',
            ],
            [
                'name' => 'Metro Blue',
                'code' => '264583',
            ],
            [
                'name' => 'Prairie Dust',
                'code' => '7a7256',
            ],
            [
                'name' => 'Tan',
                'code' => 'B29E69',
            ],
            [
                'name' => 'Texas Orange',
                'code' => 'B65A30',
            ],
            [
                'name' => 'Vegas Gold',
                'code' => 'F4D1A1',
            ],
            [
                'name' => 'Prepared for Dye (White)',
                'code' => 'FFFFFF',
            ],
            [
                'name' => 'Absolute White',
                'code' => 'FFFFFF',
            ],
            [
                'name' => 'Kelly Mist',
                'code' => '00957A',
            ],
            [
                'name' => 'Navy Mist',
                'code' => '2C4068',
            ],
            [
                'name' => 'Red Mist',
                'code' => 'CA3639',
            ],
            [
                'name' => 'Sport Dark Navy',
                'code' => '00263A',
            ],
            [
                'name' => 'Adriatic Blue',
                'code' => '4C8290',
            ],
            [
                'name' => 'Beige Cream',
                'code' => 'C9C2B5',
            ],
            [
                'name' => 'Butternut',
                'code' => 'F56F45',
            ],
            [
                'name' => 'Cool Blue',
                'code' => '5c788f',
            ],
            [
                'name' => 'Dark Camel',
                'code' => '916D50',
            ],
            [
                'name' => 'Deep Chocolate',
                'code' => '3B312F',
            ],
            [
                'name' => 'Lemon Citrus',
                'code' => 'EDEDB4',
            ],
            [
                'name' => 'Paprika',
                'code' => 'b7312c',
            ],
            [
                'name' => 'Parma',
                'code' => 'b3b0c4',
            ],
            [
                'name' => 'Clementine Heather',
                'code' => 'C97629',
            ],
            [
                'name' => 'Grizzly Brown Heather',
                'code' => '564534',
            ],
            [
                'name' => 'Organic Khaki Heather',
                'code' => '2A2E24',
            ],
            [
                'name' => 'Mango Tango',
                'code' => 'E65851',
            ],
            [
                'name' => 'Twilight Purple',
                'code' => '4D5EB0',
            ],
            [
                'name' => 'Grey Marl',
                'code' => 'D9D9D6',
            ],
            [
                'name' => 'Indigo',
                'code' => '13294B',
            ],
            [
                'name' => 'Antique Rose',
                'code' => 'A6646E',
            ],
            [
                'name' => 'Driftwood',
                'code' => '847361',
            ],
            [
                'name' => 'Heather Black',
                'code' => '030D18',
            ],
            [
                'name' => 'Solid Black',
                'code' => '1D1D1B',
            ],
            [
                'name' => 'Solid White',
                'code' => 'FFFFFF',
            ],
            [
                'name' => 'Light Yellow',
                'code' => 'FCEC7F',
            ],
            [
                'name' => 'Light Grey Heather',
                'code' => 'A6A9AA',
            ],
        ];
        foreach ($colors as $color) {
            Color::create($color);
        }

        $this->call([
            BlogSeeder::class,
            ProductSeeder::class,
            RoleSeeder::class,
        ]);
    }
}
