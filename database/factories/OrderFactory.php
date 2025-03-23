<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class OrderFactory extends Factory
{
    
    public function definition(): array
    {
        return [
            'user_id' => User::query()->inRandomOrder()->value('id'), // Chọn user ngẫu nhiên
            'total_amount' => $this->faker->randomFloat(2, 100, 5000), // Tổng tiền từ 100 đến 5000
            'status' => $this->faker->randomElement(['pending', 'completed', 'cancelled']), // Trạng thái đơn hàng
            'payment_method' => $this->faker->randomElement(['COD', 'Online']), // Phương thức thanh toán
            'shipping_address' => $this->faker->address(), // Địa chỉ giao hàng giả lập
        ];
    }
}
