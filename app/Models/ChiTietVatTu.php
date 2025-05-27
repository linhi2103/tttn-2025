<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\LoaiVatTu;
use App\Models\VatTu;

class ChiTietVatTu extends Model
{
    protected $table = 'chitietvattu';
    protected $primaryKey = 'MaVatTu';
    protected $fillable = [
        'MaVatTu',
        'ThuongHieu',
        'KichThuoc',
        'XuatXu',
        'MoTa',
    ];
    public function vatTu()
    {
        return $this->belongsTo(VatTu::class, 'MaVatTu');
    }
    public function loaivattu()
    {
        return $this->belongsTo(LoaiVatTu::class, 'MaLoaiVatTu', 'MaLoaiVatTu');
    }
}
