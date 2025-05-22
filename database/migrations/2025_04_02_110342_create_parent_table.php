<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create phongban table
        Schema::create('phongban', function (Blueprint $table) {
            $table->string('MaPhongBan', 20)->primary();
            $table->string('TenPhongBan', 100);
        });

        // Create vaitro table
        Schema::create('vaitro', function (Blueprint $table) {
            $table->integer('MaVaiTro', false, true)->primary();
            $table->string('TenVaiTro', 255);
            $table->enum('QuyenHan', ['Admin', 'User'])->default('User');
        });

        // Create danhmuckho table
        Schema::create('danhmuckho', function (Blueprint $table) {
            $table->string('MaKho', 10)->primary();
            $table->string('TenKho', 255);
            $table->text('DiaChi');
            $table->integer('QuyMo');
            $table->integer('DienTichSuDung')->default(0);
        });

        // Add generated column for TinhTrang in danhmuckho
        DB::statement("ALTER TABLE danhmuckho ADD COLUMN TinhTrang varchar(50) GENERATED ALWAYS AS (CASE WHEN DienTichSuDung = 0 THEN 'Còn trống' WHEN DienTichSuDung < QuyMo THEN 'Sắp đầy' ELSE 'Đã đầy' END) STORED");

        // Create donvitinh table
        Schema::create('donvitinh', function (Blueprint $table) {
            $table->string('MaDonViTinh', 20)->primary();
            $table->string('TenDonViTinh', 255);
        });

        // Create loaivattu table
        Schema::create('loaivattu', function (Blueprint $table) {
            $table->string('MaLoaiVatTu', 20)->primary();
            $table->string('TenLoaiVatTu', 255);
        });

        Schema::create('donvivanchuyen', function (Blueprint $table) {
            $table->string('MaDonViVanChuyen', 20)->primary();
            $table->string('TenDonViVanChuyen', 255);
            $table->string('MaNhanVien', 20);
            $table->string('PhuongTienVanChuyen', 255);
            $table->text('GhiChu')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phongban');
        Schema::dropIfExists('vaitro');
        Schema::dropIfExists('danhmuckho');
        Schema::dropIfExists('donvitinh');
        Schema::dropIfExists('loaivattu');
        Schema::dropIfExists('donvivanchuyen');
        Schema::dropIfExists('sessions');
    }
};
