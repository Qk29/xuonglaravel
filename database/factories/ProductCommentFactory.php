<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\User;

class ProductCommentFactory extends Factory
{
    
    public function definition(): array
    {
        return [
            'product_id' => Product::query()->inRandomOrder()->value('id'),
            'user_id' => User::query()->inRandomOrder()->value('id'),
            'rating' => $this->faker->numberBetween(1, 5), // Rating từ 1 đến 5
            'comment' => $this->faker->text,
        ];
    }
}
