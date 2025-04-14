<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\VatTu;
use App\Models\NhanVien;
use App\Models\DanhMucKho;
use App\Models\LenhDieuDong;

class PhieuKiemKe extends Model
{
    protected $table = 'phieukiemke';
    protected $primaryKey = 'MaPhieuKiemKe';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'MaPhieuKiemKe',
        'MaKho',
        'NgayKiemKe',
        'MaNhanVien',
        'TrangThai',
        'MaVatTu',
        'SoLuongThucTe',
        'SoLuongHeThong',
        'TinhTrang',
        'MaLenhDieuDong',
        'GhiChu'
    ];
    
    protected $casts = [
        'NgayKiemKe' => 'date',
        'SoLuongThucTe' => 'integer',
        'SoLuongHeThong' => 'integer',
        'ChenhLech' => 'integer'
    ];

    protected $attributes = [
        'TrangThai' => 'Chờ duyệt',
        'TinhTrang' => 'Còn tốt 100%',
        'SoLuongThucTe' => 0,
        'SoLuongHeThong' => 0
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
    
    public function lenhDieuDong()
    {
        return $this->belongsTo(LenhDieuDong::class, 'MaLenhDieuDong', 'MaLenhDieuDong');
    }

    public function getChenhLechAttribute()
    {
        return $this->attributes['ChenhLech'] ?? ($this->SoLuongThucTe - $this->SoLuongHeThong);
    }

    public function save(array $options = [])
    {
        return parent::save($options);
    }
}
