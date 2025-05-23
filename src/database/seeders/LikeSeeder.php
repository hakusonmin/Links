<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('likes')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'article_id' => 1,
            ],
            [
                'id' => 2,
                'user_id' => 1,
                'article_id' => 2,
            ],
            [
                'id' => 3,
                'user_id' => 1,
                'article_id' => 3,
            ],
            [
                'id' => 4,
                'user_id' => 1,
                'article_id' => 4,
            ],
            [
                'id' => 5,
                'user_id' => 1,
                'article_id' => 5,
            ],
            [
                'id' => 6,
                'user_id' => 2,
                'article_id' => 1,
            ],
            [
                'id' => 7,
                'user_id' => 2,
                'article_id' => 6,
            ],
            [
                'id' => 8,
                'user_id' => 2,
                'article_id' => 8,
            ],
        ]);
    }
}
