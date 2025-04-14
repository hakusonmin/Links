<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ArticleSeeder::class,
            GenreSeeder::class,
            ArticleGenreSeeder::class,
            LinkSeeder::class,
            FollowSeeder::class,
            LikeSeeder::class,
            CommentSeeder::class,
          ]);
    }
}
