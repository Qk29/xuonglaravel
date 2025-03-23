<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Category;
use App\Models\Brand;
use App\Models\UploadFile;

class ProductFactory extends Factory
{
    
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'slug' => $this->faker->unique()->slug(),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 100, 5000), // Giá từ 100 đến 5000
            'discount' => $this->faker->randomFloat(2, 0, 50), // Giảm giá từ 0% đến 50%
            'stock' => $this->faker->numberBetween(0, 100), // Số lượng từ 0 đến 100
            'category_id' => Category::query()->inRandomOrder()->value('id'), // Chọn ngẫu nhiên từ bảng categories
            'brand_id' => Brand::query()->inRandomOrder()->value('id'), // Chọn ngẫu nhiên từ bảng brands
            'image' => UploadFile::query()->inRandomOrder()->value('id'), // Chọn ngẫu nhiên từ bảng upload_files
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
