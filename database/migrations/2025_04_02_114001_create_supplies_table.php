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
        // Create vattu table
        Schema::create('vattu', function (Blueprint $table) {
            $table->string('MaVatTu', 20)->primary();
            $table->string('MaLoaiVatTu', 20);
            $table->string('TenVatTu', 255);
            $table->string('MaDonViTinh', 20);
            $table->decimal('GiaNhap', 18, 2);
            $table->string('DonViTienTe', 10);
            $table->integer('SoLuongTon')->default(0);
            $table->string('MaSoThue_DoiTac', 20);
            $table->date('NgayNhap');
            $table->date('HanSuDung')->nullable();
            $table->text('GhiChu')->nullable();
            $table->string('AnhVatTu', 255)->nullable();    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vattu');
    }
};
