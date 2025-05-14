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
    use WithPagination;
    use WithFileUploads;

    public $search = '';

    public $isEdit = false;
    public $isAdd = false;
    public $isDelete = false;

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

    public function render()
    {
        return view('livewire.xuat-kho')
        ->with([
            'xuatkhos' => XuatKho::query()
            ->when($this->search, function($query) {
                $query->where('MaPhieuXuat', 'like', "%{$this->search}%")
                    ->orWhere('MaVatTu', 'like', "%{$this->search}%")
                    ->orWhereHas('vattu', function($query) {
                        $query->where('TenVatTu', 'like', "%{$this->search}%");
                    })
                    ->orWhere('MaKho', 'like', "%{$this->search}%")
                    ->orWhere('MaNhanVien', 'like', "%{$this->search}%")
                    ->orWhere('MaLenhDieuDong', 'like', "%{$this->search}%");
            })
            ->orderBy('MaPhieuXuat', 'asc')
            ->paginate(10),
            'vattus' => VatTu::all(),
            'khos' => DanhMucKho::all(),
            'nhanViens' => NhanVien::all(),
            'donViVanChuyen' => DonViVanChuyen::all(),
            'doitacs' => Doitac::all(),
            'lenhDieuDongs' => LenhDieuDong::all()
        ]);
    }

    public function showModalAdd()
    {
        $this->NgayXuat = now()->format('Y-m-d');
        $this->isAdd = true;
    }

    public function showModalEdit($MaPhieuXuat)
    {
        $this->MaPhieuXuat = $MaPhieuXuat;
        $xuatkho = XuatKho::where('MaPhieuXuat', $MaPhieuXuat)
            ->with([
                'vattu',
                'nhanVien',
                'donViVanChuyen',
                'lenhDieuDong',
                'doitac'
            ])
            ->first();

        if (!$xuatkho) {
            session()->flash('error', 'Không tìm thấy phiếu xuất kho');
            return;
        }

        $this->MaVatTu = $xuatkho->MaVatTu;
        $this->MaKho = $xuatkho->MaKho;
        $this->MaNhanVien = $xuatkho->MaNhanVien;
        $this->NgayXuat = $xuatkho->NgayXuat->format('Y-m-d');
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

    public function resetForm()
    {
        $this->reset([
            'MaPhieuXuat', 'MaVatTu', 'MaKho', 'MaNhanVien',
            'NgayXuat', 'MaDonViVanChuyen', 'MaSoThue_DoiTac',
            'DiaChi', 'DonViTienTe', 'SoLuong', 'DonGia',
            'ThanhTien', 'MaLenhDieuDong', 'GhiChu'
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
        $this->MaLenhDieuDong = null;
        $this->DiaChi = null;
        $this->DonViTienTe = null;
        $this->ThanhTien = null;
        $this->MaSoThue_DoiTac = null;
    }

    public function save()
    {
        $this->validate([
            'MaPhieuXuat' => 'required|unique:xuatkho,MaPhieuXuat',
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
            'MaLenhDieuDong' => 'required'
        ]);

        if(VatTu::where('MaVatTu', $this->MaVatTu)->exists()) {
            $vatTu = VatTu::where('MaVatTu', $this->MaVatTu)->first();
            if ($vatTu) {
                $vatTu->decrement('SoLuongTon', $this->SoLuong);
            }
        } else {
            session()->flash('error','Vật tư không tồn tại!');
            return;
        }
        
        XuatKho::create([
            'MaPhieuXuat' => $this->MaPhieuXuat,
            'MaVatTu' => $this->MaVatTu,
            'MaKho' => $this->MaKho,
            'MaNhanVien' => $this->MaNhanVien,
            'NgayXuat' => $this->NgayXuat,
            'MaDonViVanChuyen' => $this->MaDonViVanChuyen,
            'MaSoThue_DoiTac' => $this->MaSoThue_DoiTac,
            'DiaChi' => $this->DiaChi,
            'DonViTienTe' => $this->DonViTienTe,
            'SoLuong' => $this->SoLuong,
            'DonGia' => $this->DonGia,
            'ThanhTien' => $this->ThanhTien,
            'MaLenhDieuDong' => $this->MaLenhDieuDong,
            'GhiChu' => $this->GhiChu,
        ]);
        
        $this->resetForm();
        $this->isAdd = false;
        session()->flash('success', 'Đã thêm phiếu xuất thành công!');
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
            'SoLuong' => 'required|integer|min:1',
            'DonGia' => 'required|numeric|min:0',
            'ThanhTien' => 'required|numeric',
            'MaLenhDieuDong' => 'required'
        ]);

        if(VatTu::where('MaVatTu', $this->MaVatTu)->exists()) {
            $vatTu = VatTu::where('MaVatTu', $this->MaVatTu)->first();
            if ($vatTu) {
                $oldXuatKho = XuatKho::where('MaPhieuXuat', $this->MaPhieuXuat)->first();
                if ($oldXuatKho) {
                    if ($vatTu->SoLuongTon >= $oldXuatKho->SoLuong) {
                        $vatTu->SoLuongTon -= $oldXuatKho->SoLuong;
                        $vatTu->save();
                    } else {
                        session()->flash('error','Số lượng tồn kho không đủ!');
                        return;
                    }
                }
            }
        } else {
            session()->flash('error','Vật tư không tồn tại!');
            return;
        }
        
        $xuatkho = XuatKho::where('MaPhieuXuat', $this->MaPhieuXuat)->first();
        if ($xuatkho) {
            $xuatkho->update([
                'MaVatTu' => $this->MaVatTu,
                'MaKho' => $this->MaKho,
                'MaNhanVien' => $this->MaNhanVien,
                'NgayXuat' => $this->NgayXuat,
                'MaDonViVanChuyen' => $this->MaDonViVanChuyen,
                'MaSoThue_DoiTac' => $this->MaSoThue_DoiTac,
                'DiaChi' => $this->DiaChi,
                'DonViTienTe' => $this->DonViTienTe,
                'SoLuong' => $this->SoLuong,
                'DonGia' => $this->DonGia,
                'ThanhTien' => $this->ThanhTien,
                'MaLenhDieuDong' => $this->MaLenhDieuDong,
                'GhiChu' => $this->GhiChu,
            ]);
            $this->resetForm();
            $this->isEdit = false;
            session()->flash('success', 'Đã cập nhật phiếu xuất thành công!');
        } else {
            session()->flash('error', 'Không tìm thấy phiếu xuất kho');
        }
    }

    public function delete(){
        try {
            $xuatkho = XuatKho::where('MaPhieuXuat', $this->MaPhieuXuat)->first();
            
            if ($xuatkho->vattu()->exists()) {
                throw new \Exception('Không thể xóa phiếu xuất kho này vì nó đang được sử dụng trong các vật tư.');
            }
            
            $xuatkho->delete();
            $this->closeModal();
            session()->flash('success', 'Phiếu Xuất Kho đã được xóa thành công');
        } catch (\Exception $e) {
            $this->closeModal();
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    #[On('search')]
    public function search()
    {
        $this->resetPage();
    }

    #[On('MaVatTu')]
    public function updatedMaVatTu($value)
    {
        $vatTu = VatTu::where('MaVatTu', $value)->first();
        if ($vatTu) {
            $this->DonGia = $vatTu->GiaNhap;
            $this->ThanhTien = $this->SoLuong * $this->DonGia;
        }
    }

    #[On('SoLuong')]
    public function updatedSoLuong($value)
    {
        if (!empty($value) && $value > 0) {
            $this->ThanhTien = $value * $this->DonGia;
        }else{
            $this->ThanhTien = 0;
        }
    }  
}