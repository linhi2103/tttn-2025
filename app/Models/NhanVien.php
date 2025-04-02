<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\VaiTro;
use App\Models\PhongBan;
use App\Models\NhapKho;
use App\Models\XuatKho;
use App\Models\PhieuKiemKe;
use App\Models\ThanhLyKho;
use App\Models\ThongKeThucHi;

class NhanVien extends Model
{
    protected $table = 'nhanvien';
    protected $primaryKey = 'MaNhanVien';
    protected $fillable = [
        'TenNhanVien', 
        'MaPhongBan', 
        'MaVaiTro',
        'diachi',
        'sdt',
        'cccd',
        'gioitinh'
    ];

    public function phongban()
    {
        return $this->belongsTo(PhongBan::class, 'MaPhongBan', 'MaPhongBan');
    }

    public function vaitro()
    {
        return $this->belongsTo(VaiTro::class, 'MaVaiTro', 'mavaitro');
    }

    public function nhapkho()
    {
        return $this->hasMany(NhapKho::class, 'MaNhanVien', 'MaNhanVien');
    }

    public function xuatkho()
    {
        return $this->hasMany(XuatKho::class, 'MaNhanVien', 'MaNhanVien');
    }

    public function phieukiemke()
    {
        return $this->hasMany(PhieuKiemKe::class, 'MaNhanVien', 'MaNhanVien');
    }

    public function thanhlykho()
    {
        return $this->hasMany(ThanhLyKho::class, 'MaNhanVien', 'MaNhanVien');
    }

    public function thongkethuchi()
    {
        return $this->hasMany(ThongKeThucHi::class, 'MaNhanVien', 'MaNhanVien');
    }
}
