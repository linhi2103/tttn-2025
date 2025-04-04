<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\VatTu;
use App\Models\NhanVien;
use App\Models\DanhMucKho;
use App\Models\DonViVanChuyen;
use App\Models\Doitac;
use App\Models\LenhDieuDong;

class NhapKho extends Model
{
    protected $table = 'nhapkho';
    protected $primaryKey = 'MaPhieuNhap';
    protected $fillable = [
        'MaPhieuNhap',
        'MaVatTu',
        'MaKho',
        'MaNhanVien',
        'SoLuong',
        'NgayNhap',
        'MaDonViVanChuyen',
        'GhiChu',
        'MaLenhDieuDong',
        'DiaChi',
        'DonGia',
        'MaSoThue_DoiTac',
    ];
    
    public function vatTu()
    {
        return $this->belongsTo(VatTu::class, 'MaVatTu', 'MaVatTu');
    }   
    
    public function nhanVien()
    {
        return $this->belongsTo(NhanVien::class, 'MaNhanVien', 'MaNhanVien');
    }
    
    public function kho()
    {
        return $this->belongsTo(DanhMucKho::class, 'MaKho', 'MaKho');
    }
    
    public function donvivanchuyen()
    {
        return $this->belongsTo(DonViVanChuyen::class, 'MaDonViVanChuyen', 'MaDonViVanChuyen');
    }
    
    public function lenhDieuDong()
    {
        return $this->belongsTo(LenhDieuDong::class, 'MaLenhDieuDong', 'MaLenhDieuDong');
    }
    
    public function doitac()
    {
        return $this->belongsTo(Doitac::class, 'MaSoThue_DoiTac', 'MaSoThue_DoiTac');
    }
}
