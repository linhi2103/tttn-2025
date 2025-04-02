<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\VatTu;

class DonViTinh extends Model
{
    protected $table = 'donvitinh';
    protected $primaryKey = 'MaDonViTinh';
    protected $fillable = ['TenDonViTinh'];

    public function vattu()
    {
        return $this->hasMany(VatTu::class, 'MaDonViTinh', 'MaDonViTinh');
    }
}
