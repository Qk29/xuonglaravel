<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use APP\Models\Category;


class CategoryFactory extends Factory
{
    
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'parent_id' => $this->faker->optional()->randomElement(Category::pluck('id')->toArray()),
            'description' => $this->faker->optional()->sentence(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
