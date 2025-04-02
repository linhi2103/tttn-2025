<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\VatTu;
use App\Models\NhanVien;
use App\Models\DanhMucKho;

class PhieuKiemKe extends Model
{
    protected $table = 'phieukiemke';
    protected $primaryKey = 'MaPhieuKiemKe';
    protected $fillable = [
        'MaPhieuKiemKe',
        'MaVatTu',
        'MaKho',
        'MaNhanVien',
        'SoLuong',
        'NgayKiemKe',
        'TrangThai'
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
}
