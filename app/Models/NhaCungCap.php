<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\NhapKho;

class Nhacungcap extends Model
{
    protected $table = 'nhacungcap';
    protected $primaryKey = 'MaSoThue_NhaCungUng';
    protected $keyType = 'string';
    public $incrementing = false;
    
    protected $fillable = [
        'MaSoThue_NhaCungUng',
        'TenNhaCungCap',
        'Email',
        'Sdt',
        'DiaChi'
    ];
    
    public function nhapKho()
    {
        return $this->hasMany(NhapKho::class, 'MaSoThue_NhaCungUng');
    }
}
