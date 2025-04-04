<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doitac extends Model
{
    protected $table = 'doitac';
    protected $primaryKey = 'MaSoThue_DoiTac';
    protected $keyType = 'string';
    public $incrementing = false;
    
    protected $fillable = [
        'MaSoThue_DoiTac',
        'TenDoiTac',
        'Email',
        'Sdt',
        'DiaChi',
        'GhiChu',
    ];
    
    public function nhapKho()
    {
        return $this->hasMany(NhapKho::class, 'MaSoThue_DoiTac');
    }
}
