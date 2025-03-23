<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UploadFile;

class UploadFileSeeder extends Seeder
{
    
    public function run(): void
    {
        UploadFile::factory(10)->create();
    }
}
