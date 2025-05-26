<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DanhMucKho;
use App\Models\DonViVanChuyen;
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
        'MaLenhDieuDong',
        'MaDonViVanChuyen',
        'DiaDiemXuat',
        'DonViTienTe',
        'TrangThai',
        'ChiTietXuatKho',
    ];
    
    public function donvivanchuyen()
    {
        return $this->belongsTo(DonViVanChuyen::class, 'MaDonViVanChuyen', 'MaDonViVanChuyen');
    }
    
    public function danhmuckho()
    {
        return $this->belongsTo(DanhMucKho::class, 'MaKho', 'MaKho');
    }
    
    public function lenhdieudong()
    {
        return $this->belongsTo(LenhDieuDong::class, 'MaLenhDieuDong', 'MaLenhDieuDong');
    }
}
