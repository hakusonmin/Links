<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => Str::limit($this->faker->paragraph(), 50, ''),
            'content' => Str::limit($this->faker->paragraph(5), 20000, ''),
            'priority' => $this->faker->randomElement(['high', 'middle', 'low']),
            'is_published' => true,
            'likes_count' => $this->faker->numberBetween(0, 1000),
        ];
    }
}
