<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\VatTu;

class LoaiVatTu extends Model
{
    protected $table = 'loaivattu';
    protected $primaryKey = 'MaLoaiVatTu';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'MaLoaiVatTu',
        'TenLoaiVatTu'
    ];

    public function vattu()
    {
        return $this->hasMany(VatTu::class, 'MaLoaiVatTu', 'MaLoaiVatTu');
    }
}
