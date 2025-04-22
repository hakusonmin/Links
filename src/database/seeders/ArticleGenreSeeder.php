<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleGenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('article_genres')->insert([
            [
                'id' => 1,
                'article_id' => 1,
                'genre_id' => 1,
            ],
            [
                'id' => 2,
                'article_id' => 1,
                'genre_id' => 2,
            ],
            [
                'id' => 3,
                'article_id' => 1,
                'genre_id' => 3,
            ],
            [
                'id' => 4,
                'article_id' => 3,
                'genre_id' => 6,
            ],
            [
                'id' => 5,
                'article_id' => 2,
                'genre_id' => 5,
            ],
        ]);
    }
}
