<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\VatTu;
use App\Models\NhapKho;

class Doitac extends Model
{
    public $table = 'doitac';
    public $primaryKey = 'MaSoThue_DoiTac';
    public $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    
    public $fillable = [
        'MaSoThue_DoiTac',
        'TenDoiTac',
        'Email',
        'Sdt',
        'DiaChi',
    ];
    
    public function nhapKho()
    {
        return $this->hasMany(NhapKho::class, 'MaSoThue_DoiTac');
    }

    public function vattu()
    {
        return $this->hasMany(VatTu::class, 'MaSoThue_DoiTac', 'MaSoThue_DoiTac');
    }
}
