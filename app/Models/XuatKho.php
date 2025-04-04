<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\VatTu;
use App\Models\NhanVien;
use App\Models\DanhMucKho;
use App\Models\DonViVanChuyen;
use App\Models\Doitac;
use App\Models\LenhDieuDong;


class XuatKho extends Model
{
    protected $table = 'xuatkho';
    protected $primaryKey = 'MaXuatKho';
    protected $fillable = [
        'MaXuatKho',
        'MaVatTu',
        'MaKho',
        'MaNhanVien',
        'SoLuong',
        'MaDonViVanChuyen',
        'NgayXuat',
        'TrangThai',
        'GhiChu',
        'MaSoThue_DoiTac',
        'DonGia',
        'MaLenhDieuDong',
    ];
    
    public function doitac()
    {
        return $this->belongsTo(Doitac::class, 'MaSoThue_DoiTac', 'MaSoThue_DoiTac');
    }
    
    public function vatTu()
    {
        return $this->belongsTo(VatTu::class, 'MaVatTu', 'MaVatTu');
    }
    
    public function donvivanchuyen()
    {
        return $this->belongsTo(DonViVanChuyen::class, 'MaDonViVanChuyen', 'MaDonViVanChuyen');
    }
    
    public function nhanVien()
    {
        return $this->belongsTo(NhanVien::class, 'MaNhanVien', 'MaNhanVien');
    }
    
    public function kho()
    {
        return $this->belongsTo(DanhMucKho::class, 'MaKho', 'MaKho');
    }
    
    public function lenhDieuDong()
    {
        return $this->belongsTo(LenhDieuDong::class, 'MaLenhDieuDong', 'MaLenhDieuDong');
    }
}
