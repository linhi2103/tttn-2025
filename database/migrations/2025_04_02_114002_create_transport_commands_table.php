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
            $table->string('malenhdieudong', 20)->primary();
            $table->string('tenlenhdieudong', 255);
            $table->string('noidi', 255);
            $table->string('noiden', 255);
            $table->text('lydo');
            $table->integer('nguoilapdon_id', false, true);
            $table->string('donvivanchuyen_id', 20);
            $table->date('ngaylap')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->enum('trangthai', ['Chờ duyệt', 'Đã duyệt', 'Đang vận chuyển', 'Hoàn thành', 'Hủy'])->default('Chờ duyệt');
            
            $table->foreign('nguoilapdon_id')->references('manhanvien')->on('nhanvien')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('donvivanchuyen_id')->references('MaDonViVanChuyen')->on('donvivanchuyen')->cascadeOnUpdate()->cascadeOnDelete();
        });

        // Create chitiet_lenhdieudong table
        Schema::create('chitiet_lenhdieudong', function (Blueprint $table) {
            $table->string('malenhdieudong', 20);
            $table->string('mavattu', 20);
            $table->integer('soluong');
            $table->text('ghichu')->nullable();
            
            $table->foreign('malenhdieudong')->references('malenhdieudong')->on('lenhdieudong')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('mavattu')->references('MaVatTu')->on('vattu')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lenhdieudong');
        Schema::dropIfExists('chitiet_lenhdieudong');
    }
};
