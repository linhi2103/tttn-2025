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

    protected $fillable = [
        'MaPhieuKiemKe',
        'MaKho',
        'MaLenhDieuDong',
        'TrangThai',
        'ChiTietKiemKe',
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
