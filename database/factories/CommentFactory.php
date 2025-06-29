<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


class CommentFactory extends Factory
{

    public function definition(): array
    {
        return [
            'content' => $this->faker->text
        ];
    }

    public function notApproved(): static
    {
        return $this->state(fn(array $attributes) => [
            'is_approved' => 0
        ]);
    }

    public function isApproved(): static
    {
        return $this->state(fn(array $attributes) => [
            'is_approved' => 1
        ]);
    }
}



