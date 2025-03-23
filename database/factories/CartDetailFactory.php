<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Cart;
use App\Models\Product;
class CartDetailFactory extends Factory
{
    
    public function definition(): array
    {
        return [
            'cart_id' => Cart::query()->inRandomOrder()->value('id'),
            'product_id' => Product::query()->inRandomOrder()->value('id'),
            'quantity' => $this->faker->numberBetween(1, 5),
        ];
    }
}
