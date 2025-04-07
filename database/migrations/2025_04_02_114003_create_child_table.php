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
            $table->string('MaPhieuNhap', 20);
            $table->string('MaKho', 10);
            $table->text('DiaChi')->nullable();
            $table->string('MaVatTu', 20);
            $table->integer('SoLuong');
            $table->decimal('DonGia', 18, 2);
            $table->date('NgayNhap')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('MaSoThue_DoiTac', 20);
            $table->string('MaNhanVien', 20);
            $table->string('malenhdieudong', 20)->nullable();
            $table->string('MaDonViVanChuyen', 20)->nullable();
            $table->text('GhiChu')->nullable();
            
            $table->primary(['MaPhieuNhap', 'MaKho', 'MaVatTu', 'MaNhanVien', 'MaSoThue_DoiTac', 'MaDonViVanChuyen']);
            
            $table->foreign('MaKho')->references('MaKho')->on('danhmuckho')->cascadeOnUpdate();
            $table->foreign('MaNhanVien')->references('manhanvien')->on('nhanvien')->cascadeOnUpdate();
            $table->foreign('MaVatTu')->references('MaVatTu')->on('vattu')->cascadeOnUpdate();
            $table->foreign('MaSoThue_DoiTac')->references('MaSoThue_DoiTac')->on('doitac')->cascadeOnUpdate();
            $table->foreign('malenhdieudong')->references('malenhdieudong')->on('lenhdieudong')->cascadeOnUpdate();
            $table->foreign('MaDonViVanChuyen')->references('MaDonViVanChuyen')->on('donvivanchuyen')->cascadeOnUpdate();
        });

        // Add generated column for ThanhTien in nhapkho
        DB::statement("ALTER TABLE nhapkho ADD COLUMN ThanhTien decimal(18, 2) GENERATED ALWAYS AS (SoLuong * DonGia) STORED");

        // Create xuatkho table
        Schema::create('xuatkho', function (Blueprint $table) {
            $table->string('MaPhieuXuat', 20);
            $table->string('MaKho', 10);
            $table->date('NgayXuat');
            $table->string('MaNhanVien', 20);
            $table->string('MaDonViVanChuyen', 20);
            $table->string('DonViMuaHang', 255);
            $table->string('MaSoThue_DoiTac', 20);
            $table->string('DiaChiMuaHang', 255);
            $table->string('DonViTienTe', 50);
            $table->string('MaVatTu', 20);
            $table->integer('SoLuong');
            $table->decimal('DonGia', 18, 2);
            $table->string('malenhdieudong', 20)->nullable();
            $table->text('GhiChu')->nullable();

            
            $table->primary(['MaPhieuXuat', 'MaKho', 'MaVatTu', 'MaNhanVien', 'MaSoThue_DoiTac', 'MaDonViVanChuyen']);
            
            $table->foreign('MaKho')->references('MaKho')->on('danhmuckho')->cascadeOnUpdate();
            $table->foreign('MaDonViVanChuyen')->references('MaDonViVanChuyen')->on('donvivanchuyen')->cascadeOnUpdate();
            $table->foreign('MaVatTu')->references('MaVatTu')->on('vattu')->cascadeOnUpdate();
            $table->foreign('MaSoThue_DoiTac')->references('MaSoThue_DoiTac')->on('doitac')->cascadeOnUpdate();
            $table->foreign('malenhdieudong')->references('malenhdieudong')->on('lenhdieudong')->cascadeOnUpdate();
            $table->foreign('MaNhanVien')->references('manhanvien')->on('nhanvien')->cascadeOnUpdate();
        });

        // Add generated column for ThanhTien in xuatkho
        DB::statement("ALTER TABLE xuatkho ADD COLUMN ThanhTien decimal(18, 2) GENERATED ALWAYS AS (SoLuong * DonGia) STORED");

        // Create phieukiemke table
        Schema::create('phieukiemke', function (Blueprint $table) {
            $table->string('MaPhieuKiemKe', 20);
            $table->string('MaKho', 10);
            $table->date('NgayKiemKe');
            $table->string('MaNhanVien', 20);
            $table->enum('TrangThai', ['Chờ duyệt', 'Hoàn thành', 'Hủy'])->default('Chờ duyệt');
            $table->string('MaVatTu', 20);
            $table->integer('SoLuongThucTe');
            $table->integer('SoLuongHeThong');
            $table->enum('TinhTrang', ['Còn tốt 100%', 'Kém chất lượng', 'Mất chất lượng']);
            $table->string('malenhdieudong', 20)->nullable();
            $table->text('GhiChu')->nullable();
            
            $table->primary(['MaPhieuKiemKe', 'MaKho', 'MaVatTu', 'MaNhanVien']);
            
            $table->foreign('MaKho')->references('MaKho')->on('danhmuckho')->cascadeOnUpdate();
            $table->foreign('MaNhanVien')->references('manhanvien')->on('nhanvien')->cascadeOnUpdate();
            $table->foreign('MaVatTu')->references('MaVatTu')->on('vattu')->cascadeOnUpdate();
            $table->foreign('malenhdieudong')->references('malenhdieudong')->on('lenhdieudong')->cascadeOnUpdate();
        });

        // Add generated column for ChenhLech in phieukiemke
        DB::statement("ALTER TABLE phieukiemke ADD COLUMN ChenhLech integer GENERATED ALWAYS AS (SoLuongThucTe - SoLuongHeThong) STORED");

        // Create thanhlykho table
        Schema::create('thanhlykho', function (Blueprint $table) {
            $table->string('MaPhieuThanhLy', 20);
            $table->string('MaKho', 10);
            $table->date('NgayLap');
            $table->string('MaNhanVien', 20);
            $table->enum('TrangThai', ['Đề xuất', 'Đã duyệt', 'Đã thanh lý', 'Đã hủy']);
            $table->text('LyDoThanhLy')->nullable();
            $table->string('MaVatTu', 20);
            $table->integer('SoLuong');
            $table->decimal('DonGia', 18, 2);
            $table->enum('BienPhapThanhLy', ['Bán thanh lý', 'Chuyển đổi sử dụng', 'Tiêu hủy'])->default('Bán thanh lý');
            $table->string('malenhdieudong', 20)->nullable();
            $table->text('GhiChu')->nullable();
            
            $table->primary(['MaPhieuThanhLy', 'MaVatTu', 'MaNhanVien', 'MaKho']);
            
            $table->foreign('MaKho')->references('MaKho')->on('danhmuckho')->cascadeOnUpdate();
            $table->foreign('MaNhanVien')->references('manhanvien')->on('nhanvien')->cascadeOnUpdate();
            $table->foreign('MaVatTu')->references('MaVatTu')->on('vattu')->cascadeOnUpdate();
            $table->foreign('malenhdieudong')->references('malenhdieudong')->on('lenhdieudong')->cascadeOnUpdate();
        });

        // Create thongkethuchi table
        Schema::create('thongkethuchi', function (Blueprint $table) {
            $table->string('mathongke', 20)->primary();
            $table->date('ngaythongke');
            $table->date('tungay');
            $table->date('denngay');
            $table->string('mavattu', 20);
            $table->string('makho', 10);
            $table->decimal('dongia', 18, 2);
            $table->string('donvitiente', 10);
            $table->string('manhanvien', 20)->nullable();
            $table->decimal('tongthu', 15, 2)->default(0.00);
            $table->decimal('tongchi', 15, 2)->default(0.00);
            $table->decimal('chenhlechthuchi', 15, 2)->default(0.00);
            $table->string('trangthai', 20)->default('Chưa duyệt');
            $table->timestamp('ngaytao')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->text('ghichu')->nullable();
            
            $table->foreign('manhanvien')->references('manhanvien')->on('nhanvien')->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop tables in reverse order to respect foreign key constraints
        Schema::dropIfExists('thongkethuchi');
        Schema::dropIfExists('thanhlykho');
        Schema::dropIfExists('phieukiemke');
        Schema::dropIfExists('xuatkho');
        Schema::dropIfExists('nhapkho');
    }
};