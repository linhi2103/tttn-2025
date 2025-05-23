<?php

namespace App\Livewire;

use Livewire\Component;
use Spatie\Activitylog\Models\Activity as ActivityLog;
use App\Models\NguoiDung;

class LichSuThayDoi extends Component
{
    public $propertiesName = [
        'id' => 'ID',
        // NguoiDung model fields
        'TaiKhoan' => 'Tài khoản',
        'Email' => 'Email',
        'MaNhanVien' => 'Mã nhân viên',
        'MaVaiTro' => 'Mã vai trò',
        'MatKhau' => 'Mật khẩu',
        
        // NhanVien model fields
        'TenNhanVien' => 'Tên nhân viên',
        'DiaChi' => 'Địa chỉ',
        'GioiTinh' => 'Giới tính',
        'SDT' => 'Số điện thoại',
        'CCCD' => 'Căn cước công dân',
        'MaChucVu' => 'Mã chức vụ',
        'Anh' => 'Ảnh đại diện',
        'TrangThai' => 'Trạng thái',
        
        // VaiTro model fields
        'TenVaiTro' => 'Tên vai trò',
        'created_at' => 'Ngày tạo',
        'updated_at' => 'Ngày cập nhật',

        // ChucVu model fields
        'TenChucVu' => 'Tên chức vụ',
        'MaPhongBan' => 'Mã phòng ban',

        // DanhMucKho model fields
        'TenKho' => 'Tên kho',
        'DiaChi' => 'Địa chỉ',
        'QuyMo' => 'Quy mô',
        'DienTichSuDung' => 'Diện tích sử dụng',
        'TinhTrang' => 'Tình trạng',

        // NhapKho model fields
        'MaKho' => 'Mã kho',
        'MaNhanVien' => 'Mã nhân viên',
        'MaVatTu' => 'Mã vật tư',
        'SoLuong' => 'Số lượng',
        'DonViTinh' => 'Đơn vị tính',
        'DonGia' => 'Đơn giá',
        'ThanhTien' => 'Thành tiền',
        'NgayNhap' => 'Ngày nhập',
        'MaDonViVanChuyen' => 'Mã đơn vị vận chuyển',
        'MaDoiTac' => 'Mã đối tác',
        'MaDonViTienTe' => 'Mã đơn vị tiền tệ',
        'MaVatTu' => 'Mã vật tư',
        'SoLuong' => 'Số lượng',
        'DonViTinh' => 'Đơn vị tính',
        'DonGia' => 'Đơn giá',
        'ThanhTien' => 'Thành tiền',
        'NgayNhap' => 'Ngày nhập',
        'MaDonViVanChuyen' => 'Mã đơn vị vận chuyển',
        'MaDoiTac' => 'Mã đối tác',
        'MaDonViTienTe' => 'Mã đơn vị tiền tệ',

        // XuatKho model fields
        'MaKho' => 'Mã kho',
        'MaNhanVien' => 'Mã nhân viên',
        'MaVatTu' => 'Mã vật tư',
        'SoLuong' => 'Số lượng',
        'DonViTinh' => 'Đơn vị tính',
        'DonGia' => 'Đơn giá',
        'ThanhTien' => 'Thành tiền',
        'NgayXuat' => 'Ngày xuất',
        'MaDonViVanChuyen' => 'Mã đơn vị vận chuyển',
        'MaDoiTac' => 'Mã đối tác',
        'MaDonViTienTe' => 'Mã đơn vị tiền tệ',

        // PhieuKiemKe model fields
        
    ];

    public $showModalDetail = false;
    public $lstd;
    public $properties;

    public function render()
    {
        $nguoidungs = NguoiDung::all();
        $lichsuthaydois = ActivityLog::paginate(10);
        return view('livewire.lich-su-thay-doi',[
            'lichsuthaydois' => $lichsuthaydois,
            'nguoidungs' => $nguoidungs,
        ]);
    }

    public function openModalDetail($id)
    {
        $this->lstd = ActivityLog::where('id', $id)->first();
        $this->properties = json_decode($this->lstd->properties, true);
        $this->showModalDetail = true;
    }

    public function closeModalDetail()
    {
        $this->showModalDetail = false;
        $this->resetModalDetail();
    }

    public function resetModalDetail()
    {
        $this->showModalDetail = false;
        $this->lstd = null;
        $this->properties = null;
    }
}
