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
            $table->string('manhanvien', 20)->primary();
            $table->string('tennhanvien', 255);
            $table->string('diachi', 255);
            $table->enum('gioitinh', ['Nam', 'Nữ']);
            $table->bigInteger('sdt')->unique();
            $table->bigInteger('cccd')->unique();
            $table->string('MaPhongBan', 20);
            $table->integer('mavaitro', false, true);
            
            $table->foreign('MaPhongBan')->references('MaPhongBan')->on('phongban')->cascadeOnUpdate();
            $table->foreign('mavaitro')->references('mavaitro')->on('vaitro')->cascadeOnUpdate();
            
            $table->index('MaPhongBan', 'idx_nhanvien_maphongban');
            $table->index('mavaitro', 'idx_nhanvien_mavaitro');
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
