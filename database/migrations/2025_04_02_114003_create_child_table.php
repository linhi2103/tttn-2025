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

        // Create nhapkho table
        Schema::create('nhapkho', function (Blueprint $table) {
            $table->string('MaPhieuNhap', 20)->primary();
            $table->string('MaKho', 10);
            $table->string('MaLenhDieuDong', 20)->nullable();
            $table->string('MaDonViVanChuyen', 20)->nullable();
            $table->string('MaSoThue_DoiTac', 20);
            $table->string('DonViTienTe', 50);
            $table->enum('TrangThai', ['Chờ duyệt', 'Đã duyệt', 'Hủy'])->default('Chờ duyệt');
            $table->json('ChiTietNhapKho')->nullable();
            
            $table->timestamps();
        });
        
        // Create xuatkho table
        Schema::create('xuatkho', function (Blueprint $table) {
            $table->string('MaPhieuXuat', 20)->primary();
            $table->string('MaKho', 10);
            $table->string('MaLenhDieuDong', 20)->nullable();
            $table->string('MaDonViVanChuyen', 20);
            $table->string('DiaDiemXuat', 255);
            $table->string('DonViTienTe', 50);
            $table->enum('TrangThai', ['Chờ duyệt', 'Đã duyệt', 'Hủy'])->default('Chờ duyệt');
            $table->json('ChiTietXuatKho')->nullable();
            $table->timestamps();
        });

        // Create phieukiemke table
        Schema::create('phieukiemke', function (Blueprint $table) {
            $table->string('MaPhieuKiemKe', 20)->primary();
            $table->string('MaKho', 10);
            $table->string('MaLenhDieuDong', 20)->nullable();
            $table->enum('TrangThai', ['Chờ Duyệt', 'Đã Kiểm Kê', 'Đã Hủy'])->default('Chờ Duyệt');
            $table->json('ChiTietKiemKe')->nullable();
            $table->timestamps();
        });

        // Create thanhlykho table
        Schema::create('thanhlykho', function (Blueprint $table) {
            $table->string('MaPhieuThanhLy', 20)->primary();
            $table->string('MaKho', 10);
            $table->string('MaLenhDieuDong', 20)->nullable();
            $table->enum('TrangThai', ['Chờ duyệt', 'Đã thanh lý', 'Đã hủy'])->default('Chờ duyệt');
            $table->json('ChiTietThanhLy')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop tables in reverse order to respect foreign key constraints
        Schema::dropIfExists('thanhlykho');
        Schema::dropIfExists('phieukiemke');
        Schema::dropIfExists('xuatkho');
        Schema::dropIfExists('nhapkho');
    }
};