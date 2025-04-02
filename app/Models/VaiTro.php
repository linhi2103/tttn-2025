<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VaiTro extends Model
{
    protected $table = 'vaitro';
    protected $primaryKey = 'mavaitro';
    protected $fillable = ['tenvaitro'];

    public function nhanvien()
    {
        return $this->hasMany(NhanVien::class, 'mavaitro', 'mavaitro');
    }
}
