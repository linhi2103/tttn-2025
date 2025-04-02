<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VatTu extends Model
{
    protected $table = 'vattu';
    protected $primaryKey = 'MaVatTu';
    protected $fillable = [
        'MaVatTu', 
        'MaLoaiVatTu', 
        'TenVatTu', 
        'MaDonViTinh', 
        'GiaNhap', 
        'GiaXuat', 
        'SoLuongTon', 
        'MaSoThue_NhaCungUng', 
        'NgayNhap', 
        'HanSuDung', 
        'GhiChu', 
        'AnhVatTu', 
        'TrangThai'
    ];

    public function loaivattu()
    {
        return $this->belongsTo(LoaiVatTu::class, 'MaLoaiVatTu', 'MaLoaiVatTu');
    }

    public function donvitinh()
    {
        return $this->belongsTo(DonViTinh::class, 'MaDonViTinh', 'MaDonViTinh');
    }
    
    public function chitiet_lenhdieudong()
    {
        return $this->hasMany(ChiTietLenhDieuDong::class, 'MaVatTu', 'MaVatTu');
    } 

    public function nhacungcap()
    {
        return $this->belongsTo(NhaCungCap::class, 'MaSoThue_NhaCungUng', 'MaSoThue_NhaCungUng');
    }

    public function nhapkho()
    {
        return $this->hasMany(NhapKho::class, 'MaVatTu', 'MaVatTu');
    }

    public function xuatkho()
    {
        return $this->hasMany(XuatKho::class, 'MaVatTu', 'MaVatTu');
    }

    public function phieukiemke()
    {
        return $this->hasMany(PhieuKiemKe::class, 'MaVatTu', 'MaVatTu');
    }

    public function thanhlykho()
    {
        return $this->hasMany(ThanhLyKho::class, 'MaVatTu', 'MaVatTu');
    }

    public function thongkethuchi()
    {
        return $this->hasMany(ThongKeThucHi::class, 'MaVatTu', 'MaVatTu');
    }

}
