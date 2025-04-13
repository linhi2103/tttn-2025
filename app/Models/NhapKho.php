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
    public $table = 'nhapkho';
    public $primaryKey = 'MaPhieuNhap';
    public $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'MaPhieuNhap',
        'MaVatTu',
        'MaNhanVien',
        'MaKho',
        'SoLuong',
        'DonGia',
        'NgayNhap',
        'MaDonViVanChuyen',
        'GhiChu',
        'MaLenhDieuDong',
        'DiaChi',
        'MaSoThue_DoiTac',
    ];
    
    protected $casts = [
        'NgayNhap' => 'datetime',
    ];

    protected $appends = ['DonGia'];
    
    
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
