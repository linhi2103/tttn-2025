<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\VatTu;
use App\Models\NhanVien;
use App\Models\DanhMucKho;
use App\Models\LenhDieuDong;
use App\Models\NhaCungCap;

class ThanhLyKho extends Model
{
    protected $table = 'thanhlykho';
    protected $primaryKey = 'MaPhieuThanhLy';
    protected $fillable = [
        'MaPhieuThanhLy',
        'MaVatTu',
        'MaKho',
        'MaNhanVien',
        'SoLuong',
        'NgayLap',
        'TrangThai',
        'DonGia',
        'GhiChu',
        'LyDoThanhLy',
        'BienPhapThanhLy',
        'MaLenhDieuDong',
    ];
    
    public function vatTu()
    {
        return $this->belongsTo(VatTu::class, 'MaVatTu', 'MaVatTu');
    }
    
    public function lenhDieuDong()
    {
        return $this->belongsTo(LenhDieuDong::class, 'MaLenhDieuDong', 'MaLenhDieuDong');
    }
    
    public function nhanVien()
    {
        return $this->belongsTo(NhanVien::class, 'MaNhanVien', 'MaNhanVien');
    }
    
    public function kho()
    {
        return $this->belongsTo(DanhMucKho::class, 'MaKho', 'MaKho');
    }
}
