<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ArticleGenre>
 */
class ArticleGenreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'article_id' => Article::factory(),
            'genre_id' => Genre::factory(),
        ];
    }
}
