<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\VatTu;
use App\Models\NhanVien;
use App\Models\DanhMucKho;

class ThongKeThuChi extends Model
{
    protected $table = 'thongkethuchi';
    protected $primaryKey = 'MaThongKeThuChi';
    protected $fillable = [
        'MaThongKeThuChi',
        'NgayThongKe',
        'Tungay',
        'Denngay',
        'MaVatTu',
        'MaKho',
        'DonGia',
        'MaNhanVien',
        'DonViTienTe',
        'TongThu',
        'TongChi',
        'ChenhLechThuChi',
        'TrangThai',
        'NgayTao',
        'GhiChu'
    ];
    
    public function vatTu()
    {
        return $this->belongsTo(VatTu::class, 'MaVatTu', 'MaVatTu');
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
