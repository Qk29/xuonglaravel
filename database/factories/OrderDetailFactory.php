<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;
use App\Models\Product;

class OrderDetailFactory extends Factory
{
    
    public function definition(): array
    {
        return [
            'order_id' => Order::query()->inRandomOrder()->value('id'),
            'product_id' => Product::query()->inRandomOrder()->value('id'),
            'quantity' => $this->faker->numberBetween(1, 5),
            'price' =>  Product::query()->inRandomOrder()->value('price'),
            'subtotal' => fn(array $attrs) => $attrs['quantity'] * $attrs['price'],
        ];
    }
}
