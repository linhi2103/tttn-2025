<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use App\Models\VatTu;
use App\Models\NhapKho;
use App\Models\DonViTinh;
use App\Models\DanhMucKho;
use App\Models\DonViVanChuyen;
use App\Models\NhanVien;
use App\Models\LenhDieuDong;
use App\Models\Doitac;

class NhapKhoComponent extends Component
{
    use WithFileUploads;
    use WithPagination;
    
    public $search = '';

    public $isEdit = false;
    public $isAdd = false;
    public $isDelete = false;

    public $MaPhieuNhap;
    public $MaVatTu;
    public $MaNhanVien;
    public $MaKho;
    public $SoLuong;
    public $DonGia;
    public $NgayNhap;
    public $MaDonViVanChuyen;
    public $GhiChu;
    public $MaLenhDieuDong;
    public $DiaChi;
    public $ThanhTien;
    public $MaSoThue_DoiTac;
    
    public function render()
    {
        return view('livewire.nhap-kho')
            ->with([
                'nhapkhos' => NhapKho::query()
                    ->when($this->search, function($query) {
                        $query->where('MaPhieuNhap', 'like', "%{$this->search}%")
                            ->orWhere('MaVatTu', 'like', "%{$this->search}%")
                            ->orWhere('MaNhanVien', 'like', "%{$this->search}%")
                            ->orWhere('MaKho', 'like', "%{$this->search}%")
                            ->orWhere('MaSoThue_DoiTac', 'like', "%{$this->search}%")
                            ->orWhereHas('vatTu', function($query) {
                                $query->where('TenVatTu', 'like', "%{$this->search}%");
                            });
                    })
                    ->orderBy('MaPhieuNhap', 'asc')
                    ->paginate(10),
                'vatTus' => VatTu::all(),
                'khos' => DanhMucKho::all(),
                'nhanViens' => NhanVien::all(),
                'donViVanChuyens' => DonViVanChuyen::all(),
                'doiTacs' => Doitac::all(),
                'lenhDieuDongs' => LenhDieuDong::all()
            ]);
    }

    
    
    public function showModalAdd()
    {
        $this->isAdd = true;
        $this->NgayNhap = date('Y-m-d');
        $this->ThanhTien = 0;
    }
    
    public function showModalEdit($MaPhieuNhap)
    {
        $this->MaPhieuNhap = $MaPhieuNhap;
        $nhapkho = NhapKho::where('MaPhieuNhap', $MaPhieuNhap)
            ->with([
                'vattu',
                'nhanvien',
                'donvivanchuyen',
                'lenhDieuDong',
                'doitac'
            ])
            ->first();

        if (!$nhapkho) {
            session()->flash('error', 'Không tìm thấy phiếu nhập kho');
            return;
        }

        $this->MaVatTu = $nhapkho->MaVatTu;
        $this->MaNhanVien = $nhapkho->MaNhanVien;
        $this->MaKho = $nhapkho->MaKho;
        $this->SoLuong = $nhapkho->SoLuong;
        $this->DonGia = $nhapkho->DonGia;
        $this->NgayNhap = $nhapkho->NgayNhap;
        $this->GhiChu = $nhapkho->GhiChu;
        $this->DiaChi = $nhapkho->DiaChi;
        $this->ThanhTien = $nhapkho->ThanhTien;

        $this->MaDonViVanChuyen = $nhapkho->MaDonViVanChuyen;
        $this->MaLenhDieuDong = $nhapkho->MaLenhDieuDong;
        $this->MaSoThue_DoiTac = $nhapkho->MaSoThue_DoiTac;

        $this->isEdit = true;
    }
    
    public function showModalDelete($MaPhieuNhap)
    {
        $this->isDelete = true;
        $this->MaPhieuNhap = $MaPhieuNhap;
    }
    
    public function closeModal()
    {
        $this->isEdit = false;
        $this->isAdd = false;
        $this->isDelete = false;
        $this->resetModal();
    }

    public function resetForm() {
        $this->reset([
            'MaPhieuNhap', 'MaVatTu', 'MaNhanVien', 'MaKho',
            'SoLuong', 'DonGia', 'NgayNhap', 'MaDonViVanChuyen',
            'GhiChu', 'DiaChi', 'ThanhTien', 'MaSoThue_DoiTac', 'MaLenhDieuDong'
        ]);
    }
    
    public function resetModal()
    {
        $this->MaPhieuNhap = null;
        $this->MaVatTu = null;
        $this->MaNhanVien = null;
        $this->MaKho = null;
        $this->SoLuong = null;
        $this->DonGia = null;
        $this->NgayNhap = null;
        $this->MaDonViVanChuyen = null;
        $this->GhiChu = null;
        $this->MaLenhDieuDong = null;
        $this->DiaChi = null;
        $this->ThanhTien = null;
        $this->MaSoThue_DoiTac = null;
    }
    
    public function calculateThanhTien()
    {
        if ($this->SoLuong && $this->DonGia) {
            $this->ThanhTien = $this->SoLuong * $this->DonGia;
        } else {
            $this->ThanhTien = 0;
        }
    }
    
    public function save() {
        $this->validate([
            'MaPhieuNhap' => 'required|unique:nhap_khos,MaPhieuNhap',
            'MaVatTu' => 'required',
            'MaNhanVien' => 'required',
            'MaKho' => 'required',
            'SoLuong' => 'required|numeric|min:1',
            'DonGia' => 'required|numeric|min:0',
            'NgayNhap' => 'required|date',
            'MaDonViVanChuyen' => 'required',
            'MaSoThue_DoiTac' => 'required',
        ]);
    
        NhapKho::create([
            'MaPhieuNhap' => $this->MaPhieuNhap,
            'MaVatTu' => $this->MaVatTu,
            'MaNhanVien' => $this->MaNhanVien,
            'MaKho' => $this->MaKho,
            'SoLuong' => $this->SoLuong,
            'DonGia' => $this->DonGia,
            'ThanhTien' => $this->SoLuong * $this->DonGia,
            'NgayNhap' => $this->NgayNhap,
            'MaDonViVanChuyen' => $this->MaDonViVanChuyen,
            'MaSoThue_DoiTac' => $this->MaSoThue_DoiTac,
            'MaLenhDieuDong' => $this->MaLenhDieuDong,
            'DiaChi' => $this->DiaChi,
            'GhiChu' => $this->GhiChu,
        ]);
    
        $this->resetForm();
        $this->isAdd = false;
        session()->flash('success', 'Đã thêm phiếu nhập thành công!');
    }
    
    public function update() {
        $this->validate([
            'MaVatTu' => 'required',
            'MaNhanVien' => 'required',
            'MaKho' => 'required',
            'SoLuong' => 'required|numeric|min:1',
            'DonGia' => 'required|numeric|min:0',
            'NgayNhap' => 'required|date',
            'MaDonViVanChuyen' => 'required',
            'MaSoThue_DoiTac' => 'required',
        ]);
    
        $nhapkho = NhapKho::where('MaPhieuNhap', $this->MaPhieuNhap)->first();
        if ($nhapkho) {
            $nhapkho->update([
                'MaVatTu' => $this->MaVatTu,
                'MaNhanVien' => $this->MaNhanVien,
                'MaKho' => $this->MaKho,
                'SoLuong' => $this->SoLuong,
                'DonGia' => $this->DonGia,
                'ThanhTien' => $this->SoLuong * $this->DonGia,
                'NgayNhap' => $this->NgayNhap,
                'MaDonViVanChuyen' => $this->MaDonViVanChuyen,
                'MaSoThue_DoiTac' => $this->MaSoThue_DoiTac,
                'MaLenhDieuDong' => $this->MaLenhDieuDong,
                'DiaChi' => $this->DiaChi,
                'GhiChu' => $this->GhiChu,
            ]);
    
            $this->resetForm();
            $this->isEdit = false;
            session()->flash('success', 'Đã cập nhật phiếu nhập thành công!');
        }
    }
    
    public function delete()
    {
        try {
            $nhapkho = NhapKho::where('MaPhieuNhap', $this->MaPhieuNhap)->first();
            if (!$nhapkho) {
                throw new \Exception('Không tìm thấy phiếu nhập kho!');
            }
            
            $nhapkho->delete();
            $this->closeModal();
            session()->flash('success', 'Phiếu Nhập Kho đã được xóa thành công');
        } catch (\Exception $e) {
            $this->closeModal();
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function updatedSoLuong()
    {
        $this->calculateThanhTien();
    }

    public function updatedDonGia()
    {
        $this->calculateThanhTien();
    }

    #[On('search')]
    public function search()
    {
        $this->resetPage();
    }
}