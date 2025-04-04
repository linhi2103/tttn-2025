<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\NhanVien;
use App\Models\DonViVanChuyen;
// use App\Models\ChiTietLenhDieuDong;
use App\Models\NhapKho;
use App\Models\XuatKho;
use App\Models\PhieuKiemKe;
use App\Models\ThanhLyKho;

class LenhDieuDong extends Model
{
    protected $table = 'lenhdieudong';
    protected $primaryKey = 'malenhdieudong';
    protected $keyType = 'string';
    public $incrementing = false;
    
    protected $fillable = [
        'malenhdieudong',
        'tenlenhdieudong',
        'lydo',
        'nguoilapdon_id',
        'ngaylap',
        'trangthai',
        'ghichu'
    ];
    
    protected $casts = [
        'ngaylap' => 'date',
        'nguoilapdon_id' => 'integer'
    ];
    
    public function nhanVien()
    {
        return $this->belongsTo(NhanVien::class, 'nguoilapdon_id', 'manhanvien');
    }
    
    // public function chitietlenhdieudong()
    // {
    //     return $this->hasMany(ChiTietLenhDieuDong::class, 'malenhdieudong');
    // }
    
    public function nhapKho()
    {
        return $this->hasMany(NhapKho::class, 'malenhdieudong');
    }
    
    public function xuatKho()
    {
        return $this->hasMany(XuatKho::class, 'malenhdieudong');
    }
    
    public function phieuKiemKe()
    {
        return $this->hasMany(PhieuKiemKe::class, 'malenhdieudong');
    }
    
    public function thanhLyKho()
    {
        return $this->hasMany(ThanhLyKho::class, 'malenhdieudong');
    }
}
