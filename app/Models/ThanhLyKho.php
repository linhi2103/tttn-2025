<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\VatTu;
use App\Models\NhanVien;
use App\Models\DanhMucKho;

class ThanhLyKho extends Model
{
    protected $table = 'thanhlykho';
    protected $primaryKey = 'MaThanhLyKho';
    protected $fillable = [
        'MaThanhLyKho',
        'MaVatTu',
        'MaKho',
        'MaNhanVien',
        'SoLuong',
        'NgayThanhLy',
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
