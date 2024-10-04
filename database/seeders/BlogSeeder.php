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
            'title' => 'Importanța îmbrăcămintei de lucru de calitate',
            'short_content' => 'Îmbrăcămintea de lucru este un element esențial în multe industrii, având un rol nu doar funcțional, ci și de siguranță, confort și reprezentare a identității corporative. Alegerea unor uniforme de calitate superioară este o investiție importantă pentru orice companie, contribuind la bunăstarea și performanța angajaților. Articolul de față va explora în detaliu importanța îmbrăcămintei de lucru de calitate și efectele sale pozitive asupra angajaților, siguranței și imaginii companiei.',
            'content' => file_get_contents(__DIR__.'/blog2.html'),
            'image_id' => $image->id,
        ]);
        $image = Image::create([
            'src' => 'Importance of fashion',
        ]);
        Blog::create([
            'title' => 'Cât de fashion trebuie să fie echipamentele de protecţie?',
            'short_content' => 'Echipamentele de protecție reprezintă o componentă esențială în asigurarea siguranței angajaților în multe industrii, de la construcții și industrie grea până la laboratoare de cercetare și sectorul medical. În esență, rolul lor principal este de a proteja utilizatorii împotriva riscurilor fizice, chimice sau biologice care pot apărea în timpul muncii. Însă, pe măsură ce preocuparea pentru siguranță se îmbină cu tendințele moderne, se ridică întrebarea: cât de fashion trebuie să fie echipamentele de protecție? În continuare, vom analiza această problemă și vom explora avantajele și limitele unei abordări estetice în proiectarea acestor echipamente.',
            'content' => file_get_contents(__DIR__.'/blog3.html'),
            'image_id' => $image->id,
        ]);
    }
}
