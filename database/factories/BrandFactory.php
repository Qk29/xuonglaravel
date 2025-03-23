<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\UploadFile;



class BrandFactory extends Factory
{
    
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'logo' => UploadFile::query()->inRandomOrder()->value('id'), // Chọn ngẫu nhiên logo từ bảng upload_files
            'description' => $this->faker->text,
        ];
    }
}
