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
    protected $primaryKey = 'MaPhieuXuat';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'MaPhieuXuat',
        'MaKho',
        'NgayXuat',
        'MaNhanVien',
        'MaDonViVanChuyen',
        'MaSoThue_DoiTac',
        'DiaChi',
        'DonViTienTe',
        'MaVatTu',
        'SoLuong',
        'DonGia',
        'MaLenhDieuDong',
        'GhiChu'
    ];
    
    protected $casts = [
        'NgayXuat' => 'date',
        'SoLuong' => 'integer',
        'DonGia' => 'decimal:2',
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
    
    public function kho()
    {
        return $this->belongsTo(DanhMucKho::class, 'MaKho', 'MaKho');
    }
    
    public function nhanvien()
    {
        return $this->belongsTo(NhanVien::class, 'MaNhanVien', 'MaNhanVien');
    }
    
    public function lenhdieudong()
    {
        return $this->belongsTo(LenhDieuDong::class, 'MaLenhDieuDong', 'MaLenhDieuDong');
    }
}
