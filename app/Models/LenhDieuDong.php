<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\NhanVien;
use App\Models\DonViVanChuyen;
use App\Models\NhapKho;
use App\Models\XuatKho;
use App\Models\PhieuKiemKe;
use App\Models\ThanhLyKho;

class LenhDieuDong extends Model
{
    public $table = 'lenhdieudong';
    public $primaryKey = 'MaLenhDieuDong';
    public $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'MaLenhDieuDong',
        'TenLenhDieuDong',
        'LyDo',
        'MaNhanVien',
        'GhiChu',
        'TrangThai'
    ];

    protected $casts = [
        'TrangThai' => 'boolean'
    ];

    public function nhanVien()
    {
        return $this->belongsTo(NhanVien::class, 'MaNhanVien', 'MaNhanVien');
    }
    
    public function nhapKho()
    {
        return $this->hasMany(NhapKho::class, 'MaLenhDieuDong', 'MaLenhDieuDong');
    }
    
    public function xuatKho()
    {
        return $this->hasMany(XuatKho::class, 'MaLenhDieuDong', 'MaLenhDieuDong');
    }
    
    public function phieuKiemKe()
    {
        return $this->hasMany(PhieuKiemKe::class, 'MaLenhDieuDong', 'MaLenhDieuDong');
    }
    
    public function thanhLyKho()
    {
        return $this->hasMany(ThanhLyKho::class, 'MaLenhDieuDong', 'MaLenhDieuDong');
    }
}