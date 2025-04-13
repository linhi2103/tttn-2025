<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use App\Models\VatTu;
use App\Models\XuatKho;
use App\Models\DonViTinh;
use App\Models\DanhMucKho;
use App\Models\DonViVanChuyen;
use App\Models\NhanVien;
use App\Models\LenhDieuDong;
use App\Models\Doitac;

class XuatKhoComponent extends Component
{
    use WithFileUploads;
    use WithPagination;
    
    public $search = '';

    public $isEdit = false;
    public $isAdd = false;
    public $isDelete = false;

    public $MaPhieuXuat;
    public $MaVatTu;
    public $MaKho;
    public $MaNhanVien;
    public $SoLuong;
    public $MaDonViVanChuyen;
    public $NgayXuat;
    public $TrangThai;
    public $GhiChu;
    public $MaSoThue_DoiTac;
    public $DonGia;
    public $MaLenhDieuDong;
    public $DiaChi;
    public $ThanhTien;
    
    public function render()
    {
        return view('livewire.xuat-kho')
            ->with([
                'xuatkhos' => XuatKho::query()
                    ->when($this->search, function($query) {
                        $query->where('MaPhieuXuat', 'like', "%{$this->search}%")
                            ->orWhere('MaVatTu', 'like', "%{$this->search}%")
                            ->orWhere('MaNhanVien', 'like', "%{$this->search}%")
                            ->orWhere('MaKho', 'like', "%{$this->search}%")
                            ->orWhere('MaSoThue_DoiTac', 'like', "%{$this->search}%")
                            ->orWhereHas('vatTu', function($query) {
                                $query->where('TenVatTu', 'like', "%{$this->search}%");
                            });
                    })
                    ->orderBy('MaPhieuXuat', 'asc')
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
        $this->NgayXuat = date('Y-m-d');
        $this->ThanhTien = 0;
    }
    
    public function showModalEdit($MaPhieuXuat)
    {
        $this->MaPhieuXuat = $MaPhieuXuat;
        $xuatkho = XuatKho::where('MaPhieuXuat', $MaPhieuXuat)
            ->with([
                'vattu',
                'nhanvien',
                'donvivanchuyen',
                'lenhDieuDong',
                'doitac'
            ])
            ->first();

        if (!$xuatkho) {
            session()->flash('error', 'Không tìm thấy phiếu xuất kho');
            return;
        }

        $this->MaVatTu = $xuatkho->MaVatTu;
        $this->MaNhanVien = $xuatkho->MaNhanVien;
        $this->MaKho = $xuatkho->MaKho;
        $this->SoLuong = $xuatkho->SoLuong;
        $this->DonGia = $xuatkho->DonGia;
        $this->NgayXuat = $xuatkho->NgayXuat;
        $this->GhiChu = $xuatkho->GhiChu;
        $this->DiaChi = $xuatkho->DiaChi;
        $this->ThanhTien = $xuatkho->ThanhTien;
        $this->MaDonViVanChuyen = $xuatkho->MaDonViVanChuyen;
        $this->MaLenhDieuDong = $xuatkho->MaLenhDieuDong;
        $this->MaSoThue_DoiTac = $xuatkho->doitac->MaSoThue_DoiTac ?? $xuatkho->MaSoThue_DoiTac;

        $this->isEdit = true;
    }
    
    public function showModalDelete($MaPhieuXuat)
    {
        $this->isDelete = true;
        $this->MaPhieuXuat = $MaPhieuXuat;
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
            'MaPhieuXuat', 'MaVatTu', 'MaNhanVien', 'MaKho',
            'SoLuong', 'DonGia', 'NgayXuat', 'MaDonViVanChuyen',
            'GhiChu', 'DiaChi', 'ThanhTien', 'MaSoThue_DoiTac', 'MaLenhDieuDong'
        ]);
    }
    
    public function resetModal()
    {
        $this->MaPhieuXuat = null;
        $this->MaVatTu = null;
        $this->MaNhanVien = null;
        $this->MaKho = null;
        $this->SoLuong = null;
        $this->DonGia = null;
        $this->NgayXuat = null;
        $this->MaDonViVanChuyen = null;
        $this->GhiChu = null;
        $this->DiaChi = null;
        $this->ThanhTien = null;
        $this->MaSoThue_DoiTac = null;
        $this->MaLenhDieuDong = null;
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
            'MaPhieuXuat' => 'required|unique:xuatkho,MaPhieuXuat',
            'MaVatTu' => 'required',
            'MaNhanVien' => 'required',
            'MaKho' => 'required',
            'MaSoThue_DoiTac' => 'required',
            'SoLuong' => 'required|numeric|min:1',
            'DonGia' => 'required|numeric|min:0',
            'NgayXuat' => 'required|date',
            'MaDonViVanChuyen' => 'required',
            'MaLenhDieuDong' => 'required',
            'DiaChi' => 'required',
            'GhiChu' => 'required',
        ]);
    
        XuatKho::create([
            'MaPhieuXuat' => $this->MaPhieuXuat,
            'MaVatTu' => $this->MaVatTu,
            'MaNhanVien' => $this->MaNhanVien,
            'MaKho' => $this->MaKho,
            'SoLuong' => $this->SoLuong,
            'DonGia' => $this->DonGia,
            'ThanhTien' => $this->SoLuong * $this->DonGia,
            'NgayXuat' => $this->NgayXuat,
            'MaDonViVanChuyen' => $this->MaDonViVanChuyen,
            'MaSoThue_DoiTac' => $this->MaSoThue_DoiTac,
            'MaLenhDieuDong' => $this->MaLenhDieuDong,
            'DiaChi' => $this->DiaChi,
            'GhiChu' => $this->GhiChu
        ]);
    
        $this->resetForm();
        $this->isAdd = false;
        session()->flash('success', 'Đã thêm phiếu nhập thành công!');
    }
    
    public function update() {
        $this->validate([
            'MaPhieuXuat' => 'required',
            'MaVatTu' => 'required',
            'MaNhanVien' => 'required',
            'MaKho' => 'required',
            'MaSoThue_DoiTac' => 'required',
            'SoLuong' => 'required|numeric|min:1',
            'DonGia' => 'required|numeric|min:0',
            'NgayXuat' => 'required|date',
            'MaDonViVanChuyen' => 'required',
            'MaLenhDieuDong' => 'required',
            'DiaChi' => 'required',
            'GhiChu' => 'required',
        ]);
        
        // Debugging output
        dd([
            'MaPhieuXuat' => $this->MaPhieuXuat,
            'MaVatTu' => $this->MaVatTu,
            'MaNhanVien' => $this->MaNhanVien,
            'MaKho' => $this->MaKho,
            'SoLuong' => $this->SoLuong,
            'DonGia' => $this->DonGia,
            'NgayXuat' => $this->NgayXuat,
            'MaDonViVanChuyen' => $this->MaDonViVanChuyen,
            'MaSoThue_DoiTac' => $this->MaSoThue_DoiTac,
            'MaLenhDieuDong' => $this->MaLenhDieuDong,
            'DiaChi' => $this->DiaChi,
            'GhiChu' => $this->GhiChu
        ]);

        $xuatkho = XuatKho::where('MaPhieuXuat', $this->MaPhieuXuat)->first();
        if ($xuatkho) {
            $xuatkho->update([
                'MaVatTu' => $this->MaVatTu,
                'MaNhanVien' => $this->MaNhanVien,
                'MaKho' => $this->MaKho,
                'SoLuong' => $this->SoLuong,
                'DonGia' => $this->DonGia,
                'ThanhTien' => $this->SoLuong * $this->DonGia,
                'NgayXuat' => $this->NgayXuat,
                'MaDonViVanChuyen' => $this->MaDonViVanChuyen,
                'MaSoThue_DoiTac' => $this->MaSoThue_DoiTac,
                'MaLenhDieuDong' => $this->MaLenhDieuDong,
                'DiaChi' => $this->DiaChi,
                'GhiChu' => $this->GhiChu
            ]);
        }
    }
    
    public function delete()
    {
        try {
            $xuatkho = XuatKho::where('MaPhieuXuat', $this->MaPhieuXuat)->first();
            if (!$xuatkho) {
                throw new \Exception('Không tìm thấy phiếu xuất kho!');
            }
            
            $xuatkho->delete();
            $this->closeModal();
            session()->flash('success', 'Phiếu Xuất Kho đã được xóa thành công');
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
