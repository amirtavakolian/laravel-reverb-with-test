<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{

    public function definition(): array
    {
        return [
            'name' => implode('-', fake()->unique()->words(2))
        ];
    }
}
