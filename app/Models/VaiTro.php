<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VaiTro extends Model
{
    protected $table = 'vaitro';
    protected $primaryKey = 'MaVaiTro';
    public $incrementing = false;
    public $timestamps = false;  // Disable automatic timestamps
    protected $keyType = 'string';
    protected $fillable = [
        'MaVaiTro',
        'TenVaiTro'
    ];

    public function nhanvien()
    {
        return $this->hasMany(NhanVien::class, 'MaVaiTro', 'MaVaiTro');
    }
}
