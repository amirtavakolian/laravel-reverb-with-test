<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{

    public function definition(): array
    {
        return [
            'title' => fake()->title,
            'description' => fake()->text,
            'image' => "test-image.png",
        ];
    }
}


