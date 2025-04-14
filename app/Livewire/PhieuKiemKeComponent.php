<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\Attributes\On;
use App\Models\PhieuKiemKe;
use App\Models\VatTu;
use App\Models\DanhMucKho;
use App\Models\NhanVien;
use App\Models\LenhDieuDong;

class PhieuKiemKeComponent extends Component
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

    public $MaPhieuKiemKe;
    public $MaVatTu;
    public $MaKho;
    public $MaNhanVien;
    public $MaLenhDieuDong;
    public $NgayKiemKe;
    public $ChenhLech;

    public $TrangThai;
    public $SoLuongThucTe;
    public $SoLuongHeThong;
    public $TinhTrang;
    public $GhiChu;

    public $isEdit = false;
    public $isAdd = false;
    public $isDelete = false;

    public function showModalAdd()
    {
        $this->isAdd = true;
    }

    public function showModalEdit($MaPhieuKiemKe)
    {
        $this->MaPhieuKiemKe = $MaPhieuKiemKe;
        $phieukiemke = PhieuKiemKe::where('MaPhieuKiemKe', $MaPhieuKiemKe)->first();
        $this->MaVatTu = $phieukiemke->MaVatTu;
        $this->MaKho = $phieukiemke->MaKho;
        $this->MaNhanVien = $phieukiemke->MaNhanVien;
        $this->NgayKiemKe = $phieukiemke->NgayKiemKe;
        $this->ChenhLech = $phieukiemke->ChenhLech;
        $this->TrangThai = $phieukiemke->TrangThai;
        $this->MaLenhDieuDong = $phieukiemke->MaLenhDieuDong;
        $this->SoLuongThucTe = $phieukiemke->SoLuongThucTe;
        $this->SoLuongHeThong = $phieukiemke->SoLuongHeThong;
        $this->TinhTrang = $phieukiemke->TinhTrang;
        $this->GhiChu = $phieukiemke->GhiChu;
        $this->isEdit = true;
    }
    public function showModalDelete($MaPhieuKiemKe)
    {
        $this->isDelete = true;
        $this->MaPhieuKiemKe = $MaPhieuKiemKe;
    }
    public function closeModal(){
        $this->isEdit = false;
        $this->isAdd = false;
        $this->isDelete = false;
        $this->resetModal();
    }
    public function resetModal(){
        $this->MaPhieuKiemKe = null;
        $this->MaVatTu = null;
        $this->MaKho = null;
        $this->MaNhanVien = null;
        $this->NgayKiemKe = null;
        $this->ChenhLech = null;
        $this->TrangThai = null;
        $this->MaLenhDieuDong = null;
        $this->SoLuongThucTe = null;
        $this->SoLuongHeThong = null;
        $this->TinhTrang = null;
        $this->GhiChu = null;
    }
    public function resetForm()
    {
        $this->MaPhieuKiemKe = null;
        $this->MaVatTu = null;
        $this->MaKho = null;
        $this->MaNhanVien = null;
        $this->NgayKiemKe = null;
        $this->TrangThai = 'Chờ duyệt';
        $this->MaLenhDieuDong = null;
        $this->SoLuongThucTe = 0;
        $this->SoLuongHeThong = 0;
        $this->TinhTrang = 'Còn tốt 100%';
        $this->GhiChu = null;
    }
    public function save()
    {
        $this->validate([
            'MaVatTu' => 'required',
            'MaKho' => 'required',
            'MaNhanVien' => 'required',
            'NgayKiemKe' => 'required',
            'TrangThai' => 'required',
            'MaLenhDieuDong' => 'required',
            'SoLuongThucTe' => 'required|integer',
            'SoLuongHeThong' => 'required|integer',
            'TinhTrang' => 'required',
            'GhiChu' => 'nullable'
        ]);
        
        $phieukiemke = new PhieuKiemKe();
        $phieukiemke->MaPhieuKiemKe = $this->MaPhieuKiemKe;
        $phieukiemke->MaVatTu = $this->MaVatTu;
        $phieukiemke->MaKho = $this->MaKho;
        $phieukiemke->MaNhanVien = $this->MaNhanVien;
        $phieukiemke->NgayKiemKe = $this->NgayKiemKe;
        $phieukiemke->TrangThai = $this->TrangThai;
        $phieukiemke->MaLenhDieuDong = $this->MaLenhDieuDong;
        $phieukiemke->SoLuongThucTe = $this->SoLuongThucTe;
        $phieukiemke->SoLuongHeThong = $this->SoLuongHeThong;
        $phieukiemke->TinhTrang = $this->TinhTrang;
        $phieukiemke->GhiChu = $this->GhiChu;
        
        $phieukiemke->save();
        
        $this->resetForm();
        $this->isAdd = false;
        
        session()->flash('success', 'Phiếu kiểm kê đã được tạo thành công!');
    }
    public function update()
    {
        $this->validate([
            'MaVatTu' => 'required',
            'MaKho' => 'required',
            'MaNhanVien' => 'required',
            'NgayKiemKe' => 'required',
            'TrangThai' => 'required',
            'MaLenhDieuDong' => 'required',
            'SoLuongThucTe' => 'required|integer',
            'SoLuongHeThong' => 'required|integer',
            'TinhTrang' => 'required',
            'GhiChu' => 'nullable'
        ]);
        
        $phieukiemke = PhieuKiemKe::where('MaPhieuKiemKe', $this->MaPhieuKiemKe)->first();
        $phieukiemke->MaVatTu = $this->MaVatTu;
        $phieukiemke->MaKho = $this->MaKho;
        $phieukiemke->MaNhanVien = $this->MaNhanVien;
        $phieukiemke->NgayKiemKe = $this->NgayKiemKe;
        $phieukiemke->TrangThai = $this->TrangThai;
        $phieukiemke->MaLenhDieuDong = $this->MaLenhDieuDong;
        $phieukiemke->SoLuongThucTe = $this->SoLuongThucTe;
        $phieukiemke->SoLuongHeThong = $this->SoLuongHeThong;
        $phieukiemke->TinhTrang = $this->TinhTrang;
        $phieukiemke->GhiChu = $this->GhiChu;
        
        $phieukiemke->save();
        
        $this->resetForm();
        $this->isEdit = false;
        
        session()->flash('success', 'Phiếu kiểm kê đã được cập nhật thành công!');
    }
    public function delete(){
        try {
            $phieukiemke = PhieuKiemKe::where('MaPhieuKiemKe', $this->MaPhieuKiemKe)->first();
            
            if ($phieukiemke->vattu()->exists()) {
                session()->flash('error', 'Không thể xóa Phiếu Kiểm Kê này vì nó đang được sử dụng trong các Vật Tư.');
                $this->closeModal();
                return;
            }
            
            $phieukiemke->delete();
            $this->closeModal();
            session()->flash('success', 'Phiếu Kiểm Kê đã được xóa thành công');
        } catch (\Exception $e) {
            $this->closeModal();
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
    public function render()
    {
        $phieukiemkes = PhieuKiemKe::query()
            ->where('MaPhieuKiemKe', 'like', "%{$this->search}%")
            ->orWhere('MaVatTu', 'like', "%{$this->search}%")
            ->orWhere('MaKho', 'like', "%{$this->search}%")
            ->orWhere('MaNhanVien', 'like', "%{$this->search}%")
            ->orWhere('MaLenhDieuDong', 'like', "%{$this->search}%")
            ->orderBy('MaPhieuKiemKe', 'asc')
            ->paginate(10);
        
        return view('livewire.phieu-kiem-ke', [
            'phieukiemkes' => $phieukiemkes
        ]);
    }

    #[On('search')]
    public function search()
    {
        $this->resetPage();
    }
}
