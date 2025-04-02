<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\VatTu;
use App\Models\NhanVien;
use App\Models\DanhMucKho;

class NhapKho extends Model
{
    protected $table = 'nhapkho';
    protected $primaryKey = 'MaNhapKho';
    protected $fillable = [
        'MaNhapKho',
        'MaVatTu',
        'MaKho',
        'MaNhanVien',
        'SoLuong',
        'NgayNhap',
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
