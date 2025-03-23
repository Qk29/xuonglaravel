<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\UploadFile;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    
    public function definition(): array
    {
        $title = $this->faker->sentence();
        return [
            'user_id' => User::all()->random()->id,
            'title' => $title,
            'slug' => Str::slug($title) . '-' . Str::random(5),
            'content' => $this->faker->paragraphs(3, true),
            'image' => UploadFile::all()->random()->id,
            'status' => $this->faker->randomElement(['draft', 'published']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
