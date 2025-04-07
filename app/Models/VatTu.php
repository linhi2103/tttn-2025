<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\NhapKho;
use App\Models\XuatKho;
use App\Models\PhieuKiemKe;
use App\Models\ThanhLyKho;
use App\Models\ThongKeThucHi;
use App\Models\DonViVanChuyen;
use App\Models\LoaiVatTu;
use App\Models\LenhDieuDong;

class VatTu extends Model
{
    protected $table = 'vattu';
    protected $primaryKey = 'MaVatTu';
    protected $fillable = [
        'MaVatTu', 
        'MaLoaiVatTu', 
        'TenVatTu', 
        'MaDonViTinh', 
        'GiaNhap', 
        'GiaXuat', 
        'SoLuongTon', 
        'MaSoThue_DoiTac', 
        'DonViTienTe', 
        'NgayNhap', 
        'HanSuDung', 
        'GhiChu', 
        'AnhVatTu', 
        'TrangThai'
    ];

    public function loaivattu()
    {
        return $this->belongsTo(LoaiVatTu::class, 'MaLoaiVatTu', 'MaLoaiVatTu');
    }

    public function donvitinh()
    {
        return $this->belongsTo(DonViTinh::class, 'MaDonViTinh', 'MaDonViTinh');
    }
    
    public function doitac()
    {
        return $this->belongsTo(Doitac::class, 'MaSoThue_DoiTac', 'MaSoThue_DoiTac');
    }

    public function nhapkho()
    {
        return $this->hasMany(NhapKho::class, 'MaVatTu', 'MaVatTu');
    }

    public function xuatkho()
    {
        return $this->hasMany(XuatKho::class, 'MaVatTu', 'MaVatTu');
    }

    public function phieukiemke()
    {
        return $this->hasMany(PhieuKiemKe::class, 'MaVatTu', 'MaVatTu');
    }

    public function thanhlykho()
    {
        return $this->hasMany(ThanhLyKho::class, 'MaVatTu', 'MaVatTu');
    }

    public function thongkethuchi()
    {
        return $this->hasMany(ThongKeThucHi::class, 'MaVatTu', 'MaVatTu');
    }

}
