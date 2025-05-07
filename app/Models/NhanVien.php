<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\VaiTro;
use App\Models\PhongBan;

class NhanVien extends Model
{
    protected $table = 'nhanvien';
    protected $primaryKey = 'MaNhanVien';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;  // Disable timestamps since they're not in the database
    
    protected $fillable = [
        'MaNhanVien',
        'TenNhanVien',
        'DiaChi',
        'GioiTinh',
        'SDT',
        'CCCD',
        'MaPhongBan',
        'MaVaiTro'
    ];

    const GIOI_TINH_VALUES = ['Nam', 'Nữ'];

    protected $casts = [
        'SDT' => 'integer',
        'CCCD' => 'integer',
        'MaVaiTro' => 'integer'
    ];

    protected $attributes = [
        'GioiTinh' => 'Nam'
    ];

    public function phongban()
    {
        return $this->belongsTo(PhongBan::class, 'MaPhongBan', 'MaPhongBan');
    }

    public function vaitro()
    {
        return $this->belongsTo(VaiTro::class, 'MaVaiTro', 'MaVaiTro');
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
