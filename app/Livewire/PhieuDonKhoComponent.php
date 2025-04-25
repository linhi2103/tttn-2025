<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use App\Models\PhieuDonKho;
use App\Models\VatTu;
use App\Models\DanhMucKho;
use App\Models\NhanVien;
use App\Models\DonViVanChuyen;
use App\Models\LenhDieuDong;
use App\Models\Doitac;

class PhieuDonKhoComponent extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $search = '';
    public $vatTus = [];
    public $danhmuckhos = [];
    public $nhanViens = [];
    public $donViVanChuyens = [];
    public $lenhDieuDongs = [];
    public $doiTacs = [];

    public function mount()
    {
        $this->vatTus = VatTu::all();
        $this->danhmuckhos = DanhMucKho::all();
        $this->nhanViens = NhanVien::all();
        $this->donViVanChuyens = DonViVanChuyen::all();
        $this->lenhDieuDongs = LenhDieuDong::all();
        $this->doiTacs = Doitac::all();
    }

    public $MaPhieuDonKho;
    public $NgayDonKho;
    public $MaKhoNguon;
    public $MaKhoDich;
    public $MaVatTu;
    public $SoLuong;
    public $MaNhanVien;
    public $MaVanChuyen;
    public $MaLenhDieuDong;
    public $TrangThai;
    public $GhiChu;
    public $NgayTao;

    public $isEdit = false;
    public $isAdd = false;
    public $isDelete = false;

    public function showModalAdd()
    {
        $this->isAdd = true;
    }

    public function showModalEdit($MaPhieuDonKho)
    {
        $this->MaPhieuDonKho = $MaPhieuDonKho;
        $phieudonkho = PhieuDonKho::where('MaPhieuDonKho', $MaPhieuDonKho)->first();
        $this->MaVatTu = $phieudonkho->MaVatTu;
        $this->MaKho = $phieudonkho->MaKho;
        $this->MaNhanVien = $phieudonkho->MaNhanVien;
        $this->NgayXuat = $phieudonkho->NgayXuat;
        $this->SoLuong = $phieudonkho->SoLuong;
        $this->MaVanChuyen = $phieudonkho->MaVanChuyen;
        $this->MaLenhDieuDong = $phieudonkho->MaLenhDieuDong;
        $this->TrangThai = $phieudonkho->TrangThai;
        $this->GhiChu = $phieudonkho->GhiChu;
        $this->NgayTao = $phieudonkho->NgayTao;
        $this->isEdit = true;
    }
    public function showModalDelete($MaPhieuDonKho)
    {
        $this->isDelete = true;
        $this->MaPhieuDonKho = $MaPhieuDonKho;
    }
    public function closeModal(){
        $this->isEdit = false;
        $this->isAdd = false;
        $this->isDelete = false;
        $this->resetModal();
    }
    public function resetModal(){
        $this->MaPhieuDonKho = null;
        $this->NgayDonKho = null;
        $this->MaKhoNguon = null;
        $this->MaKhoDich = null;
        $this->MaVatTu = null;
        $this->SoLuong = null;
        $this->MaNhanVien = null;
        $this->MaVanChuyen = null;
        $this->MaLenhDieuDong = null;
        $this->TrangThai = null;
        $this->GhiChu = null;
        $this->NgayTao = null;
    }
    public function resetForm()
    {
        $this->MaPhieuDonKho = null;
        $this->NgayDonKho = null;
        $this->MaKhoNguon = null;
        $this->MaKhoDich = null;
        $this->MaVatTu = null;
        $this->SoLuong = null;
        $this->MaNhanVien = null;
        $this->MaVanChuyen = null;
        $this->MaLenhDieuDong = null;
        $this->TrangThai = null;
        $this->GhiChu = null;
        $this->NgayTao = null;
    }
    public function save()
    {
        $this->validate([
            'MaPhieuDonKho' => 'required',
            'NgayDonKho' => 'required',
            'MaKhoNguon' => 'required',
            'MaKhoDich' => 'required',
            'MaVatTu' => 'required',
            'SoLuong' => 'required|numeric',
            'MaLenhDieuDong' => 'required',
            'MaNhanVien' => 'required',
            'MaVanChuyen' => 'required',
            'TrangThai' => 'required',
            'GhiChu' => 'nullable',
            'NgayTao' => 'required'
        ]);
        
        $phieudonkho = new PhieuDonKho();
        $phieudonkho->MaPhieuDonKho = $this->MaPhieuDonKho;
        $phieudonkho->NgayDonKho = $this->NgayDonKho;
        $phieudonkho->MaKhoNguon = $this->MaKhoNguon;
        $phieudonkho->MaKhoDich = $this->MaKhoDich;
        $phieudonkho->MaVatTu = $this->MaVatTu;
        $phieudonkho->MaLenhDieuDong = $this->MaLenhDieuDong;
        $phieudonkho->SoLuong = $this->SoLuong;
        $phieudonkho->MaNhanVien = $this->MaNhanVien;
        $phieudonkho->MaVanChuyen = $this->MaVanChuyen;
        $phieudonkho->NgayTao = $this->NgayTao;
        $phieudonkho->TrangThai = $this->TrangThai;
        $phieudonkho->GhiChu = $this->GhiChu;
        
        $phieudonkho->save();
        
        $this->resetForm();
        $this->isAdd = false;
        
        session()->flash('success', 'Phieu don kho đã được tạo thành công!');
    }
    public function update()
    {
        $this->validate([
            'MaPhieuDonKho' => 'required',
            'NgayDonKho' => 'required',
            'MaKhoNguon' => 'required',
            'MaKhoDich' => 'required',
            'MaVatTu' => 'required',
            'MaLenhDieuDong' => 'required',
            'SoLuong' => 'required|numeric',
            'MaNhanVien' => 'required',
            'MaVanChuyen' => 'required',
            'TrangThai' => 'required',
            'GhiChu' => 'nullable',
            'NgayTao' => 'required'
        ]);
        
        $phieudonkho = PhieuDonKho::where('MaPhieuDonKho', $this->MaPhieuDonKho)->first();
        $phieudonkho->NgayDonKho = $this->NgayDonKho;
        $phieudonkho->MaKhoNguon = $this->MaKhoNguon;
        $phieudonkho->MaKhoDich = $this->MaKhoDich;
        $phieudonkho->MaVatTu = $this->MaVatTu;
        $phieudonkho->MaLenhDieuDong = $this->MaLenhDieuDong;
        $phieudonkho->SoLuong = $this->SoLuong;
        $phieudonkho->MaNhanVien = $this->MaNhanVien;
        $phieudonkho->MaVanChuyen = $this->MaVanChuyen;
        $phieudonkho->TrangThai = $this->TrangThai;
        $phieudonkho->NgayTao = $this->NgayTao;
        $phieudonkho->GhiChu = $this->GhiChu;
        
        $phieudonkho->save();
        
        $this->resetForm();
        $this->isAdd = false;
        
        session()->flash('success', 'Phieu don kho đã được tạo thành công!');
    }
    
    public function delete(){
        try {
            $phieudonkho = PhieuDonKho::where('MaPhieuDonKho', $this->MaPhieuDonKho)->first();
            
            if ($phieudonkho->vattu()->exists()) {
                session()->flash('error', 'Không thể xóa Phieu Don Kho này vì nó đang được sử dụng trong các Vật Tư.');
                $this->closeModal();
                return;
            }
            
            $phieudonkho->delete();
            $this->closeModal();
            session()->flash('success', 'Phieu don kho đã được xóa thành công');
        } catch (\Exception $e) {
            $this->closeModal();
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
    public function render()
    {
        $phieudonkho = PhieuDonKho::query()
            ->when($this->search, function ($query) {
                $query->where(function ($query) {
                    $query->where('MaPhieuDonKho', 'like', '%' . $this->search . '%')
                        ->orWhere('MaKhoNguon', 'like', '%' . $this->search . '%')
                        ->orWhere('MaKhoDich', 'like', '%' . $this->search . '%')
                        ->orWhere('MaVatTu', 'like', '%' . $this->search . '%')
                        ->orWhere('MaNhanVien', 'like', '%' . $this->search . '%')
                        ->orWhere('MaVanChuyen', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('MaPhieuDonKho', 'desc')
            ->paginate(10);
        
        return view('livewire.phieu-don-kho', [
            'phieudonkho' => $phieudonkho
        ]);
    }

    #[On('search')]
    public function search()
    {
        $this->resetPage();
    }
}
