<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\VatTu;
use App\Models\NhanVien;
use App\Models\DanhMucKho;
use App\Models\LenhDieuDong;

class ThanhLyKho extends Model
{
    protected $table = 'thanhlykho';
    protected $primaryKey = 'MaPhieuThanhLy';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'MaPhieuThanhLy',
        'MaKho',
        'MaLenhDieuDong',
        'TrangThai',
        'ChiTietThanhLy'
    ];

    public function lenhDieuDong()
    {
        return $this->belongsTo(LenhDieuDong::class, 'MaLenhDieuDong', 'MaLenhDieuDong');
    }
    
    public function kho()
    {
        return $this->belongsTo(DanhMucKho::class, 'MaKho', 'MaKho');
    }
}
