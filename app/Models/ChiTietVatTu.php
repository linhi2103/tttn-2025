<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    
}
