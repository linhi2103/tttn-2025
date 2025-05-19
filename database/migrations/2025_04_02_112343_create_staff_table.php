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
        // Create nhanvien table
        Schema::create('nhanvien', function (Blueprint $table) {
            $table->string('MaNhanVien', 20)->primary();
            $table->string('TenNhanVien', 255);
            $table->string('DiaChi', 255);
            $table->enum('GioiTinh', ['Nam', 'Nữ']);
            $table->bigInteger('SDT')->unique();
            $table->bigInteger('CCCD')->unique();
            $table->string('MaPhongBan', 20);
            $table->string('Anh', 255);
            $table->string('TrangThai', 20);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nhanvien');
    }
};
