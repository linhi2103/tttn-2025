<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\LenhDieuDong;
use App\Models\NhanVien;

class DonViVanChuyen extends Model
{
    protected $table = 'donvivanchuyen';
    protected $primaryKey = 'MaDonViVanChuyen';
    protected $keyType = 'string';
    public $incrementing = false;
    
    protected $fillable = [
        'MaDonViVanChuyen',
        'TenDonViVanChuyen',
        'MaNhanVien',
        'PhuongTienVanChuyen',
        'GhiChu'
    ];
    
    public $timestamps = false;  // Disable timestamps since they're not in the database

    public function lenhdieudong()
    {
        return $this->hasMany(LenhDieuDong::class, 'MaDonViVanChuyen', 'MaDonViVanChuyen');
    }

    public function nhanvien()
    {
        return $this->belongsTo(NhanVien::class, 'MaNhanVien', 'MaNhanVien');
    }
}
