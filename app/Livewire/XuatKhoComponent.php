<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use App\Models\VatTu;
use App\Models\XuatKho;
use App\Models\PhieuKiemKe;
use App\Models\DonViTinh;
use App\Models\DanhMucKho;
use App\Models\DonViVanChuyen;
use App\Models\NhanVien;
use App\Models\LenhDieuDong;
use App\Models\Doitac;

class XuatKhoComponent extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $search = '';
    public $vattus = [];
    public $danhmuckhos = [];
    public $nhanViens = [];
    public $donViVanChuyens = [];
    public $lenhDieuDongs = [];
    public $doiTacs = [];

    public function mount()
    {
        $this->vattus = VatTu::all();
        $this->danhmuckhos = DanhMucKho::all();
        $this->nhanViens = NhanVien::all();
        $this->donViVanChuyens = DonViVanChuyen::all();
        $this->lenhDieuDongs = LenhDieuDong::all();
        $this->doiTacs = DoiTac::all();
    }

    public $MaPhieuXuat;
    public $MaKho;
    public $NgayXuat;
    public $MaNhanVien;
    public $MaDonViVanChuyen;
    public $MaSoThue_DoiTac;
    public $DiaChi;
    public $DonViTienTe;
    public $MaVatTu;
    public $ThanhTien;
    public $SoLuong;
    public $DonGia;
    public $MaLenhDieuDong;
    public $GhiChu;

    public $isEdit = false;
    public $isAdd = false;
    public $isDelete = false;

    public function showModalAdd()
    {
        $this->isAdd = true;
    }

    public function showModalEdit($MaPhieuXuat)
    {
        $this->MaPhieuXuat = $MaPhieuXuat;
        $xuatkho = XuatKho::where('MaPhieuXuat', $MaPhieuXuat)->first();
        $this->MaVatTu = $xuatkho->MaVatTu;
        $this->MaKho = $xuatkho->MaKho;
        $this->MaNhanVien = $xuatkho->MaNhanVien;
        $this->NgayXuat = $xuatkho->NgayXuat;
        $this->MaDonViVanChuyen = $xuatkho->MaDonViVanChuyen;
        $this->MaSoThue_DoiTac = $xuatkho->MaSoThue_DoiTac;
        $this->DiaChi = $xuatkho->DiaChi;
        $this->DonViTienTe = $xuatkho->DonViTienTe;
        $this->SoLuong = $xuatkho->SoLuong;
        $this->DonGia = $xuatkho->DonGia;
        $this->ThanhTien = $xuatkho->ThanhTien;
        $this->MaLenhDieuDong = $xuatkho->MaLenhDieuDong;
        $this->GhiChu = $xuatkho->GhiChu;
        $this->isEdit = true;
    }
    public function showModalDelete($MaPhieuXuat)
    {
        $this->isDelete = true;
        $this->MaPhieuXuat = $MaPhieuXuat;
    }
    public function closeModal(){
        $this->isEdit = false;
        $this->isAdd = false;
        $this->isDelete = false;
        $this->resetModal();
    }
    public function resetModal(){
        $this->MaPhieuXuat = null;
        $this->MaVatTu = null;
        $this->MaKho = null;
        $this->MaNhanVien = null;
        $this->NgayXuat = null;
        $this->MaDonViVanChuyen = null;
        $this->MaSoThue_DoiTac = null;
        $this->DiaChi = null;
        $this->DonViTienTe = null;
        $this->SoLuong = null;
        $this->DonGia = null;
        $this->MaLenhDieuDong = null;
        $this->GhiChu = null;
    }
    public function resetForm()
    {
        $this->MaPhieuXuat = null;
        $this->MaVatTu = null;
        $this->MaKho = null;
        $this->MaNhanVien = null;
        $this->NgayXuat = null;
        $this->MaDonViVanChuyen = null;
        $this->MaSoThue_DoiTac = null;
        $this->DiaChi = null;
        $this->DonViTienTe = null;
        $this->SoLuong = null;
        $this->DonGia = null;
        $this->ThanhTien = null;
        $this->MaLenhDieuDong = null;
        $this->GhiChu = null;
    }
    public function save()
    {
        $this->validate([
            'MaVatTu' => 'required',
            'MaKho' => 'required',
            'MaNhanVien' => 'required',
            'NgayXuat' => 'required',
            'MaDonViVanChuyen' => 'required',
            'MaSoThue_DoiTac' => 'required',
            'DiaChi' => 'required',
            'DonViTienTe' => 'required',
            'SoLuong' => 'required|integer',
            'ThanhTien' => 'required|numeric',
            'DonGia' => 'required|numeric',
            'MaLenhDieuDong' => 'required',
            'GhiChu' => 'nullable'
        ]);
        
        $xuatkho = new XuatKho();
        $xuatkho->MaPhieuXuat = $this->MaPhieuXuat;
        $xuatkho->MaVatTu = $this->MaVatTu;
        $xuatkho->MaKho = $this->MaKho;
        $xuatkho->MaNhanVien = $this->MaNhanVien;
        $xuatkho->NgayXuat = $this->NgayXuat;
        $xuatkho->MaDonViVanChuyen = $this->MaDonViVanChuyen;
        $xuatkho->MaSoThue_DoiTac = $this->MaSoThue_DoiTac;
        $xuatkho->DiaChi = $this->DiaChi;
        $xuatkho->DonViTienTe = $this->DonViTienTe;
        $xuatkho->SoLuong = $this->SoLuong;
        $xuatkho->DonGia = $this->DonGia;
        $xuatkho->ThanhTien = $this->ThanhTien;
        $xuatkho->MaLenhDieuDong = $this->MaLenhDieuDong;
        $xuatkho->GhiChu = $this->GhiChu;
        
        $xuatkho->save();
        
        $this->resetForm();
        $this->isAdd = false;
        
        session()->flash('success', 'Phiếu xuất kho đã được tạo thành công!');
    }
    public function update()
    {
        $this->validate([
            'MaVatTu' => 'required',
            'MaKho' => 'required',
            'MaNhanVien' => 'required',
            'NgayXuat' => 'required',
            'MaDonViVanChuyen' => 'required',
            'MaSoThue_DoiTac' => 'required',
            'DiaChi' => 'required',
            'DonViTienTe' => 'required',
            'SoLuong' => 'required|integer',
            'DonGia' => 'required|numeric',
            'ThanhTien' => 'required|numeric',
            'MaLenhDieuDong' => 'required',
            'GhiChu' => 'nullable'
        ]);
        
        $xuatkho = XuatKho::where('MaPhieuXuat', $this->MaPhieuXuat)->first();
        $xuatkho->MaVatTu = $this->MaVatTu;
        $xuatkho->MaKho = $this->MaKho;
        $xuatkho->MaNhanVien = $this->MaNhanVien;
        $xuatkho->NgayXuat = $this->NgayXuat;
        $xuatkho->MaDonViVanChuyen = $this->MaDonViVanChuyen;
        $xuatkho->MaSoThue_DoiTac = $this->MaSoThue_DoiTac;
        $xuatkho->DiaChi = $this->DiaChi;
        $xuatkho->DonViTienTe = $this->DonViTienTe;
        $xuatkho->SoLuong = $this->SoLuong;
        $xuatkho->DonGia = $this->DonGia;
        $xuatkho->ThanhTien = $this->ThanhTien;
        $xuatkho->MaLenhDieuDong = $this->MaLenhDieuDong;
        $xuatkho->GhiChu = $this->GhiChu;
        
        $xuatkho->save();
        
        $this->resetForm();
        $this->isEdit = false;
        
        session()->flash('success', 'Phiếu xuất kho đã được cập nhật thành công!');
    }
    public function delete(){
        try {
            $xuatkho = XuatKho::where('MaPhieuXuat', $this->MaPhieuXuat)->first();
            
            if ($xuatkho->vattu()->exists()) {
                session()->flash('error', 'Không thể xóa Phiếu Xuất Kho này vì nó đang được sử dụng trong các Vật Tư.');
                $this->closeModal();
                return;
            }
            
            $xuatkho->delete();
            $this->closeModal();
            session()->flash('success', 'Phiếu Xuất Kho đã được xóa thành công');
        } catch (\Exception $e) {
            $this->closeModal();
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
    public function render()
    {
        $xuatkhos = XuatKho::query()
            ->where('MaPhieuXuat', 'like', "%{$this->search}%")
            ->orWhere('MaVatTu', 'like', "%{$this->search}%")
            ->orWhere('MaKho', 'like', "%{$this->search}%")
            ->orWhere('MaNhanVien', 'like', "%{$this->search}%")
            ->orWhere('MaLenhDieuDong', 'like', "%{$this->search}%")
            ->orderBy('MaPhieuXuat', 'asc')
            ->paginate(10);
        
        return view('livewire.xuat-kho', [
            'xuatkhos' => $xuatkhos
        ]);
    }

    #[On('search')]
    public function search()
    {
        $this->resetPage();
    }
}