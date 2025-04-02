<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThongKeThuChi extends Model
{
    protected $table = 'thongkethuchi';
    protected $primaryKey = 'MaThongKeThuChi';
    protected $fillable = [
        'MaThongKeThuChi',
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
