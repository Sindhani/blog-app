<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence,
            'excerpt' => fake()->text(150),
            'description' => fake()->paragraphs(5, true),
            'image' => fake()->imageUrl(),
            'keywords' => json_encode(fake()->words(5)),
            'seo_metadata' => json_encode(['meta_title' => fake()->sentence, 'meta_description' => fake()->text]),
            'publish_date' => now(),
            'is_published' => fake()->boolean,
            'author_id' => User::factory(),
        ];
    }
}
