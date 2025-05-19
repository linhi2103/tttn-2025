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
        // Create nguoidung table
        Schema::create('nguoidung', function (Blueprint $table) {
            $table->id();
            $table->string('TaiKhoan', 20)->unique();
            $table->string('MatKhau', 255);
            $table->string('Email', 100)->unique();
            $table->string('MaNhanVien', 20)->nullable();
            $table->string('MaVaiTro', 20)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nguoidung');
    }
};
