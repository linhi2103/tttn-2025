<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ChucVu;
use App\Models\NhapKho;
use App\Models\DonViVanChuyen;
use App\Models\XuatKho;
use App\Models\PhieuKiemKe;
use App\Models\ThanhLyKho;

class NhanVien extends Model
{
    protected $table = 'nhanvien';
    protected $primaryKey = 'MaNhanVien';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;  
    
    protected $fillable = [
        'MaNhanVien',
        'TenNhanVien',
        'DiaChi',
        'GioiTinh',
        'SDT',
        'CCCD',
        'MaChucVu',
        'Anh',
        'TrangThai'
    ];

    const GIOI_TINH_VALUES = ['Nam', 'Nữ'];

    protected $casts = [
        'SDT' => 'integer',
        'CCCD' => 'integer',
    ];

    protected $attributes = [
        'GioiTinh' => 'Nam'
    ];

    public function chucvu()
    {
        return $this->belongsTo(ChucVu::class, 'MaChucVu', 'MaChucVu');
    }

    public function nhapkho()
    {
        return $this->hasMany(NhapKho::class, 'MaNhanVien', 'MaNhanVien');
    }
    public function donvivanchuyen()
    {
        return $this->hasMany(DonViVanChuyen::class, 'MaNhanVien', 'MaNhanVien');
    }

    public function xuatkho()
    {
        return $this->hasMany(XuatKho::class, 'MaNhanVien', 'MaNhanVien');
    }

    public function phieukiemke()
    {
        return $this->hasMany(PhieuKiemKe::class, 'MaNhanVien', 'MaNhanVien');
    }

    public function thanhlykho()
    {
        return $this->hasMany(ThanhLyKho::class, 'MaNhanVien', 'MaNhanVien');
    }

    
}
