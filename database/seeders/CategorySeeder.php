<?php

namespace Database\Seeders;

use App\Helpers\Helper;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $titles = ['Адабиёт', 'Донишномаҳо', 'Забоншиносӣ', 'Китобҳои хориҷӣ', 'Зиндагинома', 'Иқтисодиёт', 'Кӯдакон ва наврасон', 'Луғатнома', 'Мантиқ', 'Педагогика', 'Равоншиносӣ', 'Риёзӣ', 'Санъати сухан', 'Сиёсӣ', 'Табиатшиносӣ', 'Тарбиявӣ - ахлоқӣ', 'Ташаккули шахсият', 'Таърих', 'Технологияи иттилоотӣ', 'Тиб', 'Фалсафа', 'Фарҳангшиносӣ', 'Физика', 'Химия', 'Ҳуқуқ', 'Ҷомеашиносӣ'];

        $description = 'Книга — один из видов печатной продукции: непериодическое издание, состоящее из сброшюрованных или отдельных бумажных листов (страниц) или тетрадей, на которых нанесена типографским или рукописным способом текстовая и графическая (иллюстрации) информация, имеющее, как правило, твёрдый переплёт';

        foreach($titles as $title) {
            $category = new Category();
            $category->title = $title;
            $category->slug = Helper::generateUniqueSlug($title, Category::class);
            $category->description = $description;
            if($title == 'Китобҳои хориҷӣ' || $title == 'Табиатшиносӣ') {
                $category->description = null;
            }
            $category->save();
        }
    }
}
