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
            $table->text('DiaChi')->nullable();
            $table->string('MaVatTu', 20);
            $table->integer('SoLuong');
            $table->decimal('DonGia', 18, 2);
            $table->date('NgayNhap')->default(now());
            $table->string('MaSoThue_DoiTac', 20);
            $table->string('MaNhanVien', 20);
            $table->string('MaLenhDieuDong', 20)->nullable();
            $table->string('MaDonViVanChuyen', 20)->nullable();
            $table->text('GhiChu')->nullable();
        });

        // Add generated column for ThanhTien in nhapkho
        DB::statement("ALTER TABLE nhapkho ADD COLUMN ThanhTien decimal(18, 2) GENERATED ALWAYS AS (SoLuong * DonGia) STORED");

        // Create xuatkho table
        Schema::create('xuatkho', function (Blueprint $table) {
            $table->string('MaPhieuXuat', 20)->primary();
            $table->string('MaKho', 10);
            $table->date('NgayXuat');
            $table->string('MaNhanVien', 20);
            $table->string('MaDonViVanChuyen', 20);
            $table->string('DiaDiemXuat', 255);
            $table->string('DiaChi', 255);
            $table->string('DonViTienTe', 50);
            $table->string('MaVatTu', 20);
            $table->integer('SoLuong');
            $table->decimal('DonGia', 18, 2);
            $table->decimal('ThanhTien', 18, 2)->generatedAs('SoLuong * DonGia')->stored();
            $table->string('MaLenhDieuDong', 20)->nullable();
            $table->enum('TrangThai', ['Chờ duyệt', 'Đã duyệt', 'Đang thực hiện', 'Hoàn thành', 'Hủy'])->default('Chờ duyệt');
            $table->text('GhiChu')->nullable();
        });

        // Create phieukiemke table
        Schema::create('phieukiemke', function (Blueprint $table) {
            $table->string('MaPhieuKiemKe', 20)->primary();
            $table->string('MaKho', 10);
            $table->date('NgayKiemKe');
            $table->string('MaNhanVien', 20);
            $table->enum('TrangThai', ['Chờ Duyệt', 'Đã Kiểm Kê', 'Đã Hủy'])->default('Chờ Duyệt');
            $table->string('MaVatTu', 20);
            $table->integer('SoLuongThucTe');
            $table->integer('SoLuongTon');
            $table->enum('TinhTrang', ['Còn tốt 100%', 'Kém chất lượng', 'Mất chất lượng']);
            $table->string('MaLenhDieuDong', 20)->nullable();
            $table->text('GhiChu')->nullable();
        });

        // Create thanhlykho table
        Schema::create('thanhlykho', function (Blueprint $table) {
            $table->string('MaPhieuThanhLy', 20)->primary();
            $table->string('MaKho', 10);
            $table->date('NgayLap');
            $table->string('MaNhanVien', 20);
            $table->enum('TrangThai', ['Chờ duyệt', 'Đã thanh lý', 'Đã hủy']);
            $table->text('LyDoThanhLy')->nullable();
            $table->string('MaVatTu', 20);
            $table->integer('SoLuong');
            $table->decimal('DonGia', 18, 2);
            $table->enum('BienPhapThanhLy', ['Bán thanh lý', 'Chuyển đổi sử dụng', 'Tiêu hủy'])->default('Bán thanh lý');
            $table->string('MaLenhDieuDong', 20)->nullable();
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