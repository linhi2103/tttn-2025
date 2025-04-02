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
            $table->text('GhiChu')->nullable();
            $table->string('MaVatTu', 20);
            $table->integer('SoLuong');
            $table->decimal('DonGia', 18, 2);
            $table->string('MaSoThue_NhaCungUng', 20);
            $table->string('malenhdieudong', 20)->nullable();
            
            $table->primary(['MaPhieuNhap', 'MaKho', 'MaVatTu']);
            
            $table->foreign('MaKho')->references('MaKho')->on('danhmuckho')->cascadeOnUpdate();
            $table->foreign('MaVatTu')->references('MaVatTu')->on('vattu')->cascadeOnUpdate();
            $table->foreign('MaSoThue_NhaCungUng')->references('MaSoThue_NhaCungUng')->on('nhacungcap')->cascadeOnUpdate();
            $table->foreign('malenhdieudong')->references('malenhdieudong')->on('lenhdieudong')->cascadeOnUpdate();
        });

        // Add generated column for ThanhTien in nhapkho
        DB::statement("ALTER TABLE nhapkho ADD COLUMN ThanhTien decimal(18, 2) GENERATED ALWAYS AS (SoLuong * DonGia) STORED");

        // Create xuatkho table
        Schema::create('xuatkho', function (Blueprint $table) {
            $table->string('MaPhieuXuat', 20);
            $table->string('MaKho', 10);
            $table->date('NgayXuat');
            $table->string('LenhDieuDongNoiBoText', 255)->nullable();
            $table->string('TenNguoiVanChuyen', 255)->nullable();
            $table->string('PhuongTienVanChuyen', 255);
            $table->string('DonViMuaHang', 255);
            $table->string('MaSoThueMuaHang', 20);
            $table->string('DiaChiMuaHang', 255);
            $table->string('DonViTienTe', 50);
            $table->string('MaVatTu', 20);
            $table->integer('SoLuong');
            $table->decimal('DonGia', 18, 2);
            $table->string('malenhdieudong', 20)->nullable();
            
            $table->primary(['MaPhieuXuat', 'MaKho', 'MaVatTu']);
            
            $table->foreign('MaKho')->references('MaKho')->on('danhmuckho')->cascadeOnUpdate();
            $table->foreign('MaVatTu')->references('MaVatTu')->on('vattu')->cascadeOnUpdate();
            $table->foreign('malenhdieudong')->references('malenhdieudong')->on('lenhdieudong')->cascadeOnUpdate();
        });

        // Add generated column for ThanhTien in xuatkho
        DB::statement("ALTER TABLE xuatkho ADD COLUMN ThanhTien decimal(18, 2) GENERATED ALWAYS AS (SoLuong * DonGia) STORED");

        // Create phieukiemke table
        Schema::create('phieukiemke', function (Blueprint $table) {
            $table->string('MaPhieuKiemKe', 20);
            $table->string('MaKho', 10);
            $table->date('NgayKiemKe');
            $table->integer('MaNhanVien',false,true);
            $table->enum('TrangThai', ['Chờ duyệt', 'Hoàn thành', 'Hủy'])->default('Chờ duyệt');
            $table->text('GhiChu')->nullable();
            $table->string('MaVatTu', 20);
            $table->integer('SoLuongThucTe');
            $table->integer('SoLuongHeThong');
            $table->enum('TinhTrang', ['Còn tốt 100%', 'Kém chất lượng', 'Mất chất lượng']);
            $table->string('malenhdieudong', 20)->nullable();
            
            $table->primary(['MaPhieuKiemKe', 'MaKho', 'MaVatTu']);
            
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
            $table->date('NgayLap');
            $table->integer('MaNhanVien',false,true);
            $table->enum('TrangThai', ['Đề xuất', 'Đã duyệt', 'Đã thanh lý', 'Đã hủy']);
            $table->text('LyDoThanhLy');
            $table->string('MaVatTu', 20);
            $table->integer('SoLuong');
            $table->decimal('DonGia', 18, 2);
            $table->enum('BienPhapThanhLy', ['Bán thanh lý', 'Chuyển đổi sử dụng', 'Tiêu hủy']);
            $table->string('malenhdieudong', 20)->nullable();
            
            $table->primary(['MaPhieuThanhLy', 'MaVatTu']);
            
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
            $table->decimal('tongthu', 15, 2)->default(0.00);
            $table->decimal('tongchi', 15, 2)->default(0.00);
            $table->decimal('chenhlechthuchi', 15, 2)->default(0.00);
            $table->integer('manhanvien',false,true)->nullable();
            $table->text('ghichu')->nullable();
            $table->string('trangthai', 20)->default('Chưa duyệt');
            $table->timestamp('ngaytao')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('nguoitao', 50)->nullable();
            
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