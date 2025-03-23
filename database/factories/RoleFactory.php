<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Role;


class RoleFactory extends Factory
{
    protected $model = Role::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(), // Tạo một tên vai trò ngẫu nhiên
            'description' => $this->faker->optional()->text(200), // Mô tả có thể null
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

        ];
    }
}
