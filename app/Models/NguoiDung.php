<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\NhanVien;

class NguoiDung extends Model
{
    protected $table = 'nguoidung';
    protected $fillable = ['taikhoan', 'MatKhau', 'Email', 'manhanvien'];

    public function nhanvien()
    {
        return $this->belongsTo(NhanVien::class, 'manhanvien', 'manhanvien');
    }
}
