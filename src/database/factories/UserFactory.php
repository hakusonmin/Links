<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Str::limitで出力制限掛けます..
        return [
            // '' を第三引数につけないと末尾に...がつきます..
            'name' => Str::limit($this->faker->name(), 10, ''),
            'profile_text' => Str::limit($this->faker->paragraph(2), 100),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // ← 任意のダミー
            'remember_token' => Str::random(10),
            'followers_count' => $this->faker->numberBetween(0, 1000),
            'is_admin' => $this->faker->boolean(),
            'github_url' => $this->faker->url(),
            'x_url' => $this->faker->url(),
            'another_url' => $this->faker->url(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
