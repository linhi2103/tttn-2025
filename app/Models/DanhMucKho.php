<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\NhapKho;
use App\Models\XuatKho;
use App\Models\PhieuKiemKe;
use App\Models\ThanhLyKho;
use App\Models\ThongKeThucHi;

class DanhMucKho extends Model
{
    protected $table = 'danhmuckho';
    protected $primaryKey = 'MaKho';
    protected $fillable = [
        'TenKho', 
        'DiaChi', 
        'QuyMo', 
        'DienTichSuDung'
    ];

    public function nhapkho()
    {
        return $this->hasMany(NhapKho::class, 'MaKho', 'MaKho');
    }

    public function xuatkho()
    {
        return $this->hasMany(XuatKho::class, 'MaKho', 'MaKho');
    }   

    public function phieukiemke()
    {
        return $this->hasMany(PhieuKiemKe::class, 'MaKho', 'MaKho');
    }

    public function thanhlykho()
    {
        return $this->hasMany(ThanhLyKho::class, 'MaKho', 'MaKho');
    }

    public function thongkethuchi()
    {
        return $this->hasMany(ThongKeThucHi::class, 'MaKho', 'MaKho');
    }
}
