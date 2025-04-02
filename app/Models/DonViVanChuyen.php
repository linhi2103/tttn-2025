<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\LenhDieuDong;

class DonViVanChuyen extends Model
{
    protected $table = 'donvivanchuyen';
    protected $primaryKey = 'MaDonViVanChuyen';
    protected $fillable = ['TenDonViVanChuyen'];

    public function lenhdieudong()
    {
        return $this->hasMany(LenhDieuDong::class, 'MaDonViVanChuyen', 'MaDonViVanChuyen');
    }
}
