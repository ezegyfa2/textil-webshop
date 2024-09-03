<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Image;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $image = Image::create([
            'src' => 'Pozitive effects.webp',
        ]);
        Blog::create([
            'title' => 'Efectele pozitive ale uniformei de lucru',
            'short_content' => 'Uniformele de lucru au o influență semnificativă asupra culturii organizaționale și, implicit, asupra productivității întreprinderilor. De-a lungul timpului, uniforma a devenit un instrument nu doar de identificare și securitate, ci și un catalizator pentru coeziunea echipei și eficiența operațională. Acest articol explorează efectele pozitive ale uniformei de lucru asupra productivității într-o întreprindere.',
            'content' => 'Uniformele de lucru au o influență semnificativă asupra culturii organizaționale și, implicit, asupra productivității întreprinderilor. De-a lungul timpului, uniforma a devenit un instrument nu doar de identificare și securitate, ci și un catalizator pentru coeziunea echipei și eficiența operațională. Acest articol explorează efectele pozitive ale uniformei de lucru asupra productivității într-o întreprindere.',
            'image_id' => $image->id,
        ]);
        $image = Image::create([
            'src' => 'Importance of quality.webp',
        ]);
        Blog::create([
            'title' => 'Importanța îmbrăcămintei de lucru de calitate',
            'short_content' => 'Îmbrăcămintea de lucru de bună calitate este esențială pentru numeroase motive care influențează productivitatea, siguranța și confortul angajaților. Iată de ce este important să investim în uniforme de lucru de înaltă calitate',
            'content' => 'Îmbrăcămintea de lucru de bună calitate este esențială pentru numeroase motive care influențează productivitatea, siguranța și confortul angajaților. Iată de ce este important să investim în uniforme de lucru de înaltă calitate',
            'image_id' => $image->id,
        ]);
        $image = Image::create([
            'src' => 'Importance of fashion.jpg',
        ]);
        Blog::create([
            'title' => 'Cât de fashion trebuie să fie echipamentele de protecţie?',
            'short_content' => 'Echipamentele de protecție (EIP) trebuie să fie mai întâi funcționale și sigure, iar aspectul estetic sau "fashion" este un element secundar. Totuși, există anumite motive pentru care designul și estetica echipamentelor de protecție nu trebuie complet ignorate',
            'content' => 'Echipamentele de protecție (EIP) trebuie să fie mai întâi funcționale și sigure, iar aspectul estetic sau "fashion" este un element secundar. Totuși, există anumite motive pentru care designul și estetica echipamentelor de protecție nu trebuie complet ignorate',
            'image_id' => $image->id,
        ]);
    }
}
