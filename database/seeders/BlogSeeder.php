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
            'src' => 'Pozitive effects',
        ]);
        Blog::create([
            'title' => 'Efectele pozitive ale uniformei de lucru',
            'short_content' => 'Uniforma de lucru joacă un rol semnificativ în multe domenii profesionale și poate avea numeroase efecte pozitive asupra angajaților și companiilor. Deși percepția asupra purtării uniforme poate varia de la un loc de muncă la altul, există câteva beneficii clare și bine documentate care merită menționate. În continuare, vom explora principalele avantaje ale purtării uniformei de lucru.',
            'content' => file_get_contents(__DIR__.'/blog1.html'),
            'image_id' => $image->id,
        ]);
        $image = Image::create([
            'src' => 'Importance of quality',
        ]);
        Blog::create([
            'title' => 'Importanța îmbrăcămintei de lucru din Bumbac Organic',
            'short_content' => 'În contextul actual, tot mai multe companii sunt preocupate de adoptarea unor practici sustenabile, fie că vorbim despre reducerea deșeurilor, folosirea energiei verzi sau selectarea unor materiale ecologice pentru produsele lor. Îmbrăcămintea de lucru din bumbac organic reprezintă una dintre aceste opțiuni ecologice, având numeroase avantaje atât pentru angajați, cât și pentru companie și mediu.',
            'content' => file_get_contents(__DIR__.'/blog2.html'),
            'image_id' => $image->id,
        ]);
        $image = Image::create([
            'src' => 'Importance of fashion',
        ]);
        Blog::create([
            'title' => 'Cât de Fashion Trebuie să Fie Îmbrăcămintea de Lucru?',
            'short_content' => 'Îmbrăcămintea de lucru joacă un rol esențial în mediul profesional, oferind atât protecție și confort, cât și o oportunitate de a reflecta imaginea companiei. Deși accentul pe funcționalitate este primordial, estetica îmbrăcămintei de lucru a căpătat o importanță tot mai mare în ultimii ani. De la uniforme moderne, personalizabile, până la echipamente de lucru care îmbină stilul cu funcționalitatea, companiile încep să recunoască valoarea pe care o aduce o abordare “fashion” în îmbrăcămintea de lucru.',
            'content' => file_get_contents(__DIR__.'/blog3.html'),
            'image_id' => $image->id,
        ]);
    }
}
