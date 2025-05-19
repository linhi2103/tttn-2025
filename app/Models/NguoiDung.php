<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\NhanVien;

class NguoiDung extends Authenticatable
{
    protected $table = 'nguoidung';
    protected $fillable = [
        'TaiKhoan',
        'MatKhau',
        'Email',
        'MaNhanVien',
        'MaVaiTro',
    ];

    protected $hidden = ['MatKhau', 'remember_token'];

    public function nhanvien()
    {
        return $this->belongsTo(NhanVien::class, 'MaNhanVien', 'MaNhanVien');
    }

    public function vaitro()
    {
        return $this->belongsTo(VaiTro::class, 'MaVaiTro', 'MaVaiTro');
    }
}
