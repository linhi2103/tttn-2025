<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\NhanVien;

class NguoiDung extends Model
{
    protected $table = 'nguoidung';
    protected $fillable = ['TaiKhoan', 'MatKhau', 'Email', 'MaNhanVien'];

    public function nhanvien()
    {
        return $this->belongsTo(NhanVien::class, 'MaNhanVien', 'MaNhanVien');
    }
}
