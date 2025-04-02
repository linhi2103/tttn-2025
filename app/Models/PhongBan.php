<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\NhanVien;

class PhongBan extends Model
{
    protected $table = 'phongban';
    protected $primaryKey = 'MaPhongBan';
    protected $fillable = ['TenPhongBan'];

    public function nhanvien()
    {
        return $this->hasMany(NhanVien::class, 'MaPhongBan', 'MaPhongBan');
    }
}
