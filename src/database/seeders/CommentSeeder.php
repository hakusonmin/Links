<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('comments')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'article_id' => 1,
                'content' => 'とても参考になりました！',
                'created_at' => now(),
            ],            [
                'id' => 2,
                'user_id' => 2,
                'article_id' => 1,
                'content' => 'とても参考になりました2!',
                'created_at' => now(),
            ],            [
                'id' => 3,
                'user_id' => 3,
                'article_id' => 1,
                'content' => 'とても参考になりました3!',
                'created_at' => now(),
            ]
        ]);
    }
}
