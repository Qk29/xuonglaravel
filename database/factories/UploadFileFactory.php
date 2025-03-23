<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class UploadFileFactory extends Factory
{
    
    public function definition(): array
    {
        return [
            'file_name' => $this->faker->word() . '.' . $this->faker->fileExtension(),
            'file_path' => 'uploads/' . $this->faker->uuid() . '.' . $this->faker->fileExtension(),
            'file_type' => $this->faker->mimeType(),
            'user_id' => User::all()->random()->id ,
        ];
    }
}
