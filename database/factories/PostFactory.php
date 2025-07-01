<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{

    public function definition(): array
    {
        return [
            'title' => $this->faker->title,
            'description' => $this->faker->text,
            'user_id' => User::factory(),
        ];
    }

    public function addImage(): static
    {
        return $this->state(fn(array $attributes) => [
            'image' => UploadedFile::fake()->image('te.png', 500, 400)
        ]);
    }
}



