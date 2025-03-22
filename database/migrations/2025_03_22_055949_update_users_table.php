<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            
            $table->unsignedBigInteger('avatar')->nullable();
            // Khóa ngoại
            $table->foreign('avatar')->references('id')->on('upload_files')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('users', function (Blueprint $table) {
            
            $table->dropForeign(['avatar']);
        
            // Xóa cột avatar
            $table->dropColumn('avatar');
        });
    }
};
