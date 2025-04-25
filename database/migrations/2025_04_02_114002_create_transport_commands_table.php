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
            $table->date('NgayLapDon')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->enum('TrangThai', ['Chờ duyệt', 'Đã duyệt', 'Đang vận chuyển', 'Hoàn thành', 'Hủy'])->default('Chờ duyệt');
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
