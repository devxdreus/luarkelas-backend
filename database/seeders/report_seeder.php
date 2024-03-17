<?php

namespace Database\Seeders;

use App\Models\Report;
use Illuminate\Database\Seeder;

class report_seeder extends Seeder
{
    public function run(): void
    {
        // loop 10
        for ($i = 0; $i < 25; $i++) {
            // make report
            Report::create([
                "student_id" => rand(1, 20),
                "teacher_id" => rand(1, 6),
                "title" => "Report Title " . $i + 1,
                "content" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Accusantium eveniet dicta ipsam doloremque quo autem perferendis pariatur soluta aspernatur cumque. Temporibus sint culpa soluta dolore libero quod iusto, id, quae veniam ratione, harum molestiae facilis maxime labore animi. Magni nobis impedit harum explicabo delectus animi fugiat voluptatibus! Voluptatibus voluptatum consequatur et necessitatibus nulla, quod officiis. Impedit alias voluptatibus placeat iure adipisci mollitia aut, quibusdam aspernatur odit eius eligendi veritatis perspiciatis blanditiis nemo quos a deserunt vel quisquam perferendis voluptatum! Modi ut accusamus repellendus natus dicta eaque, nulla commodi nesciunt architecto earum reiciendis, accusantium nihil, temporibus odio consectetur excepturi ex. Nemo eveniet atque, voluptatem, quas, accusantium error distinctio architecto saepe fuga esse aliquid adipisci dicta maxime possimus? Nemo, nulla. Quasi maxime ut explicabo, natus eum cum sint earum vero ipsa? Ipsam dolor eius hic doloribus suscipit esse perspiciatis. Eum soluta neque rerum voluptate alias, repellendus dolorum facilis distinctio consequatur praesentium modi ad numquam recusandae facere. Maxime ea tempora sint reiciendis, doloremque, blanditiis assumenda beatae ipsam ad officiis consequatur exercitationem accusamus deleniti ipsum esse minima aperiam saepe. Numquam quia quidem eaque accusamus commodi exercitationem ratione eos, magni, minima odit maiores qui minus voluptatibus sed veritatis ex dolorem. Suscipit quasi eligendi necessitatibus repudiandae.",
                "duration" => rand(1, 120),
                "created_at" => now(),
                "updated_at" => now(),
            ]);
        }

    }
}
