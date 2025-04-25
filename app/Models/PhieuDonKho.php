<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\VatTu;
use App\Models\NhanVien;
use App\Models\DanhMucKho;
use App\Models\LenhDieuDong;

class PhieuDonKho extends Model
{
    protected $table = 'phieudonkho';
    protected $primaryKey = 'MaPhieuDonKho';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'MaPhieuDonKho',
        'NgayDonKho',
        'MaKhoNguon',
        'MaKhoDich',
        'MaVatTu',
        'SoLuong',
        'MaNhanVien',
        'MaVanChuyen',
        'TrangThai',
        'MaLenhDieuDong',
        'GhiChu',
        'NgayTao'
    ];

    public function lenhDieuDong()
    {
        return $this->belongsTo(LenhDieuDong::class, 'MaLenhDieuDong', 'MaLenhDieuDong');
    }

    public function DanhMucKho()
    {
        return $this->belongsTo(DanhMucKho::class, 'MaKhoNguon', 'MaKho');
    }
    public function DanhMucKho2()
    {
        return $this->belongsTo(DanhMucKho::class, 'MaKhoDich', 'MaKho');
    }
    public function vanChuyen()
    {
        return $this->belongsTo(DanhMucKho::class, 'MaVanChuyen', 'MaVanChuyen');
    }
    
    public function vatTu()
    {
        return $this->belongsTo(VatTu::class, 'MaVatTu', 'MaVatTu');
    }
    
    public function nhanVien()
    {
        return $this->belongsTo(NhanVien::class, 'MaNhanVien', 'MaNhanVien');
    }
}
