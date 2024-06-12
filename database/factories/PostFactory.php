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
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween(1, 3),
            'category_id' => fake()->numberBetween(1, 2),
            'title' => fake()->sentence(),
            'content' => fake()->paragraph(10),
            'cover_img' => 'post/post_cover.jpg'
        ];
    }
}
