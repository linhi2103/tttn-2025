<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\LenhDieuDong;
use App\Models\VatTu;

class CTLenhDieuDong extends Model
{
    protected $table = 'chitiet_lenhdieudong';
    protected $primaryKey = 'malenhdieudong';
    protected $keyType = 'string';
    public $incrementing = false;
    
    protected $fillable = [
        'malenhdieudong',
        'mavattu',
        'soluong'
    ];
    
    public function lenhDieuDong()
    {
        return $this->belongsTo(LenhDieuDong::class, 'malenhdieudong', 'malenhdieudong');
    }
    
    public function vatTu()
    {
        return $this->belongsTo(VatTu::class, 'mavattu', 'MaVatTu');
    }
}
