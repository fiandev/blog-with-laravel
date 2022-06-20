<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "category_id" => mt_rand(1,10),
            "user_id" => mt_rand(1,10),
            "title" => $this->faker->unique()->sentence(8),
            "slug" => $this->faker->unique()->slug(8),
            "excerpt" => $this->faker->paragraph(),
            "body" => collect($this->faker->paragraphs())
              ->map(fn($p) => "<p>$p</p>")
              ->implode("")
        ];
    }
}
