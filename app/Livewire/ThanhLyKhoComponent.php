<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use App\Models\VatTu;
use App\Models\DanhMucKho;
use App\Models\NhanVien;
use App\Models\LenhDieuDong;
use App\Models\ThanhLyKho;

class ThanhLyKhoComponent extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $search = '';
    public $vattus = [];
    public $danhmuckhos = [];
    public $nhanViens = [];
    public $lenhDieuDongs = [];

    public function mount()
    {
        $this->vattus = VatTu::all();
        $this->danhmuckhos = DanhMucKho::all();
        $this->nhanViens = NhanVien::all();
        $this->lenhDieuDongs = LenhDieuDong::all();
    }

    public $MaPhieuThanhLy;
    public $MaVatTu;
    public $MaKho;
    public $MaNhanVien;
    public $SoLuong;
    public $NgayLap;
    public $TrangThai;
    public $DonGia;
    public $GhiChu;
    public $LyDoThanhLy;
    public $BienPhapThanhLy;
    public $MaLenhDieuDong;
    public $TinhTrang;

    public $isEdit = false;
    public $isAdd = false;
    public $isDelete = false;

    public function showModalAdd()
    {
        $this->resetForm();
        $this->isAdd = true;
    }

    public function showModalEdit($MaPhieuThanhLy)
    {
        $this->MaPhieuThanhLy = $MaPhieuThanhLy;
        $phieuthanhly = ThanhLyKho::where('MaPhieuThanhLy', $MaPhieuThanhLy)->first();
        $this->MaVatTu = $phieuthanhly->MaVatTu;
        $this->MaKho = $phieuthanhly->MaKho;
        $this->MaNhanVien = $phieuthanhly->MaNhanVien;
        $this->NgayLap = $phieuthanhly->NgayLap;
        $this->TrangThai = $phieuthanhly->TrangThai;
        $this->MaLenhDieuDong = $phieuthanhly->MaLenhDieuDong;
        $this->SoLuong = $phieuthanhly->SoLuong;
        $this->DonGia = $phieuthanhly->DonGia;
        $this->GhiChu = $phieuthanhly->GhiChu;
        $this->LyDoThanhLy = $phieuthanhly->LyDoThanhLy;
        $this->BienPhapThanhLy = $phieuthanhly->BienPhapThanhLy;
        $this->TinhTrang = $phieuthanhly->TinhTrang;
        $this->isEdit = true;
    }
    public function showModalDelete($MaPhieuThanhLy)
    {
        $this->isDelete = true;
        $this->MaPhieuThanhLy = $MaPhieuThanhLy;
    }
    public function closeModal(){
        $this->isEdit = false;
        $this->isAdd = false;
        $this->isDelete = false;
        $this->resetModal();
    }
    public function resetModal(){
        $this->MaPhieuThanhLy = null;
        $this->MaVatTu = null;
        $this->MaKho = null;
        $this->MaNhanVien = null;
        $this->NgayLap = null;
        $this->TrangThai = null;
        $this->MaLenhDieuDong = null;
        $this->SoLuong = null;
        $this->DonGia = null;
        $this->GhiChu = null;
        $this->LyDoThanhLy = null;
        $this->BienPhapThanhLy = null;
        $this->TinhTrang = null;
    }
    public function resetForm()
    {
        $this->MaPhieuThanhLy = null;
        $this->MaVatTu = null;
        $this->MaKho = null;
        $this->MaNhanVien = null;
        $this->NgayLap = null;
        $this->TrangThai = 'Chờ duyệt';
        $this->MaLenhDieuDong = null;
        $this->SoLuong = 0;
        $this->DonGia = 0;
        $this->GhiChu = null;
        $this->LyDoThanhLy = null;
        $this->BienPhapThanhLy = null;
        $this->TinhTrang = null;
    }
    public function save()
    {
        $this->validate([
            'MaPhieuThanhLy' => 'required|unique:thanh-ly-kho,MaPhieuThanhLy',
            'MaVatTu' => 'required',
            'MaKho' => 'required',
            'MaNhanVien' => 'required',
            'NgayLap' => 'required',
            'TrangThai' => 'required',
            'SoLuong' => 'required|integer|min:1',
            'DonGia' => 'required|numeric|min:0',
            'LyDoThanhLy' => 'required',
            'BienPhapThanhLy' => 'required',
            'GhiChu' => 'nullable'
        ]);
        
        $phieuthanhly = new ThanhLyKho();
        $phieuthanhly->MaPhieuThanhLy = $this->MaPhieuThanhLy;
        $phieuthanhly->MaVatTu = $this->MaVatTu;
        $phieuthanhly->MaKho = $this->MaKho;
        $phieuthanhly->MaNhanVien = $this->MaNhanVien;
        $phieuthanhly->NgayLap = $this->NgayLap;
        $phieuthanhly->TrangThai = $this->TrangThai;
        $phieuthanhly->MaLenhDieuDong = $this->MaLenhDieuDong;
        $phieuthanhly->SoLuong = $this->SoLuong;
        $phieuthanhly->DonGia = $this->DonGia;
        $phieuthanhly->GhiChu = $this->GhiChu;
        $phieuthanhly->LyDoThanhLy = $this->LyDoThanhLy;
        $phieuthanhly->BienPhapThanhLy = $this->BienPhapThanhLy;
        $phieuthanhly->TinhTrang = $this->TinhTrang;
        
        $phieuthanhly->save();
        
        $this->resetForm();
        $this->isAdd = false;
        
        session()->flash('success', 'Thanh lý kho đã được tạo thành công!');
    }
    public function update()
    {
        $this->validate([
            'MaVatTu' => 'required',
            'MaKho' => 'required',
            'MaNhanVien' => 'required',
            'NgayLap' => 'required',
            'TrangThai' => 'required',
            'SoLuong' => 'required|integer|min:1',
            'DonGia' => 'required|numeric|min:0',
            'LyDoThanhLy' => 'required', // Added required validation
            'BienPhapThanhLy' => 'required', // Added required validation
            'GhiChu' => 'nullable'
        ]);
        
        $phieuthanhly = ThanhLyKho::where('MaPhieuThanhLy', $this->MaPhieuThanhLy)->first();
        if (!$phieuthanhly) {
            session()->flash('error', 'Không tìm thấy phiếu thanh lý này!');
            return;
        }
        
        $phieuthanhly->MaVatTu = $this->MaVatTu;
        $phieuthanhly->MaKho = $this->MaKho;
        $phieuthanhly->MaNhanVien = $this->MaNhanVien;
        $phieuthanhly->NgayLap = $this->NgayLap;
        $phieuthanhly->TrangThai = $this->TrangThai;
        $phieuthanhly->MaLenhDieuDong = $this->MaLenhDieuDong;
        $phieuthanhly->SoLuong = $this->SoLuong;
        $phieuthanhly->DonGia = $this->DonGia;
        $phieuthanhly->GhiChu = $this->GhiChu;
        $phieuthanhly->LyDoThanhLy = $this->LyDoThanhLy;
        $phieuthanhly->BienPhapThanhLy = $this->BienPhapThanhLy;
        $phieuthanhly->TinhTrang = $this->TinhTrang; // Added missing property
        
        $phieuthanhly->save();
        
        $this->resetForm();
        $this->isEdit = false;
        
        session()->flash('success', 'Thanh lý kho đã được cập nhật thành công!');
    }
    public function delete(){
        try {
            $phieuthanhly = ThanhLyKho::where('MaPhieuThanhLy', $this->MaPhieuThanhLy)->first();
            
            if (!$phieuthanhly) {
                session()->flash('error', 'Không tìm thấy phiếu thanh lý này!');
                $this->closeModal();
                return;
            }
            
            $phieuthanhly->delete();
            $this->closeModal();
            session()->flash('success', 'Thanh lý kho đã được xóa thành công');
        } catch (\Exception $e) {
            $this->closeModal();
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
    public function render()
    {
        $phieuthanhlys = ThanhLyKho::query()
            ->where(function($query) {
                $query->where('MaPhieuThanhLy', 'like', "%{$this->search}%")
                    ->orWhere('MaVatTu', 'like', "%{$this->search}%")
                    ->orWhere('MaKho', 'like', "%{$this->search}%")
                    ->orWhere('MaNhanVien', 'like', "%{$this->search}%")
                    ->orWhere('MaLenhDieuDong', 'like', "%{$this->search}%");
            })
            ->orderBy('MaPhieuThanhLy', 'asc')
            ->paginate(10);
        
        return view('livewire.thanh-ly-kho', [
            'phieuthanhlys' => $phieuthanhlys
        ]);
    }

    #[On('search')]
    public function search()
    {
        $this->resetPage();
    }
}