<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PostComment;

class PostCommentSeeder extends Seeder
{
    
    public function run(): void
    {
        PostComment::factory(10)->create();
    }
}
