<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChucVu extends Model
{
    protected $table = 'chucvu';
    public $timestamps = false;

    protected $fillable = [
        'MaChucVu',
        'MaPhongBan',
        'TenChucVu',
    ];

    public function nhanVien()
    {
        return $this->hasMany(NhanVien::class, 'MaChucVu', 'MaChucVu');
    }

    public function phongBan()
    {
        return $this->belongsTo(PhongBan::class, 'MaPhongBan', 'MaPhongBan');
    }
}
