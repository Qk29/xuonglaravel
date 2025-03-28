<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            PermissionSeeder::class,
            RolePermissionSeeder::class,
            UploadFileSeeder::class,
            BrandSeeder::class,
            ProductSeeder::class,
            ProductCommentSeeder::class,
            OrderSeeder::class,
            OrderDetailSeeder::class,
            CartSeeder::class,
            CartDetailSeeder::class,
            PostSeeder::class,
            PostCommentSeeder::class
        ]);
    }
}
