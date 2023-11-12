<?php

namespace Database\Seeders;

use App\Helpers\Helper;
use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $authors = ['Абдулҳафиз Қодирӣ', 'Ю. Аҳмадзода', 'Шарифи Маҳмадёр', 'Ҳайдар Алиев', 'Дилафрӯз Қурбонӣ', 'Диловари Мирзо', 'Гулназар', 'Бобораҷаби Сабурӣ', 'Субҳон Ҳабибулло', 'Фарангис Шарифова'];

        for($i = 0; $i < count($authors); $i++)
        {
            $author = new Author();
            $author->name = $authors[$i];
            $author->slug = Helper::generateUniqueSlug($authors[$i], Author::class);
            $author->image = Helper::generateUniqueSlug($authors[$i], Author::class) . '.jpg';
            $author->foreign = false;
            if($i == 4 || $i == 7) {
                $author->foreign = true; 
            }
            $author->popular = false;
            if(($i+1) % 2 == 0) $author->popular = true;
            $author->biography = 'Абуабдулло Рудаки родился в середине IX в. в селе Пандж Руд (вблизи Пенджикента) в крестьянской семье. О жизни этого замечательного поэта, и особенно о его детстве, сохранилось очень мало данных.<br><br>
            Рудаки в юности стал популярен благодаря своему прекрасному голосу, поэтическому таланту и мастерской игре на музыкальном инструменте руде. Он был приглашен Насром II ибн Ахмадом Саманидом (914-943 гг.) ко двору, где и прошла большая часть жизни. Как говорит Абу-л-Фазл Балами, «Рудаки в свое время был первым среди своих современников в области стихотворства, и ни у арабов, ни у персов нет ему подобного»; он считался не только мастером стиха, но и прекрасным исполнителем, музыкантом, певцом.';
            $author->save();
        }
    }
}
