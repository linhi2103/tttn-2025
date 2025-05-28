<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\LenhDieuDong;

class DonViVanChuyen extends Model
{
    protected $table = 'donvivanchuyen';
    protected $primaryKey = 'MaDonViVanChuyen';
    protected $keyType = 'string';
    public $incrementing = false;
    
    protected $fillable = [
        'MaDonViVanChuyen',
        'TenDonViVanChuyen',
        'PhuongTienVanChuyen',
        'GhiChu'
    ];
    
    public $timestamps = false;  // Disable timestamps since they're not in the database

    public function lenhdieudong()
    {
        return $this->hasMany(LenhDieuDong::class, 'MaDonViVanChuyen', 'MaDonViVanChuyen');
    }
}
