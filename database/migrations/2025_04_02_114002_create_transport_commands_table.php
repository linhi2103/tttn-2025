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
        // Create lenhdieudong table
        Schema::create('lenhdieudong', function (Blueprint $table) {
            $table->string('MaLenhDieuDong', 20)->primary();
            $table->string('TenLenhDieuDong', 255);
            $table->text('LyDo');
            $table->string('MaNhanVien', 20);
            $table->timestamps();
            $table->enum('TrangThai', ['Đang hoạt động', 'Ngừng hoạt động'])->default('Đang hoạt động');
            $table->text('GhiChu')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lenhdieudong');
    }
};
