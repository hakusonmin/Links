<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('articles')->insert([
            [
                'id' => 1,
                'title' => 'article_hoge',
                'content' => 'hogehogehoegehoehoghoeghoegghogehoge',
                'chapter_id' => 1,
            ],
            [
                'id' => 2,
                'title' => 'article_hoge2',
                'content' => 'hogehogehoegehoehoghoeghoegghogehoge2',
                'chapter_id' => 1,
            ],
            [
                'id' => 3,
                'title' => 'article_hoge3',
                'content' => 'hogehogehoegehoehoghoeghoegghogehoge3',
                'chapter_id' => 1,
            ],
        ]);
    }
}
