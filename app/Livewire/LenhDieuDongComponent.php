<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\Attributes\On;

use App\Models\LenhDieuDong;
use App\Models\NhanVien;

class LenhDieuDongComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $search = '';

    public $MaLenhDieuDong;
    public $TenLenhDieuDong;
    public $LyDo;
    public $TrangThai;
    public $GhiChu;
    public $MaNhanVien;

    public $nhanViens = [];

    public $isEdit = false;
    public $isAdd = false;
    public $isDelete = false;

    public function mount()
    {
        $this->nhanViens = NhanVien::select('MaNhanVien', 'TenNhanVien')->get();
    }

    public function showModalAdd()
    {
        $this->isAdd = true;
    }

    public function showModalEdit($MaLenhDieuDong)
    {
        $this->MaLenhDieuDong = $MaLenhDieuDong;
        $lenhdieudong = LenhDieuDong::where('MaLenhDieuDong', $MaLenhDieuDong)
            ->with('nhanVien')  
            ->first();

        if ($lenhdieudong) {
            $this->TenLenhDieuDong = $lenhdieudong->TenLenhDieuDong;
            $this->LyDo = $lenhdieudong->LyDo;
            $this->TrangThai = $lenhdieudong->TrangThai;
            $this->MaNhanVien = $lenhdieudong->MaNhanVien;
            $this->GhiChu = $lenhdieudong->GhiChu;

            $this->isEdit = true;
        }
    }

    public function showModalDelete($MaLenhDieuDong)
    {
        $this->isDelete = true;
        $this->MaLenhDieuDong = $MaLenhDieuDong;
    }

    public function closeModal(){
        $this->isEdit = false;
        $this->isAdd = false;
        $this->isDelete = false;
        $this->resetModal();
    }

    public function resetModal(){
        $this->MaLenhDieuDong = null;
        $this->TenLenhDieuDong = null;
        $this->LyDo = null;
        $this->TrangThai = null;
        $this->MaNhanVien = null;
        $this->GhiChu = null;
    }

    public function save()
    {
        $this->validate([
            'MaLenhDieuDong' => 'required|unique:lenh_dieu_dongs,MaLenhDieuDong',
            'TenLenhDieuDong' => 'required',
            'LyDo' => 'required',
            'MaNhanVien' => 'required',
        ]);

        LenhDieuDong::create([
            'MaLenhDieuDong' => $this->MaLenhDieuDong,
            'TenLenhDieuDong' => $this->TenLenhDieuDong,
            'LyDo' => $this->LyDo,
            'TrangThai' => 'Đang hoạt động',
            'MaNhanVien' => $this->MaNhanVien,
            'GhiChu' => $this->GhiChu,
        ]);

        session()->flash('success', 'Thêm Lệnh Điều Động thành công!');
        $this->closeModal();
    }


    public function update()
    {
        $this->validate([
            'TenLenhDieuDong' => 'required',
            'LyDo' => 'required',
            'MaNhanVien' => 'required',
            'TrangThai' => 'required|in:Đang hoạt động,Ngừng hoạt động',
        ]);

        $lenhdieudong = LenhDieuDong::where('MaLenhDieuDong', $this->MaLenhDieuDong)->first();

        if ($lenhdieudong) {
            $lenhdieudong->update([
                'TenLenhDieuDong' => $this->TenLenhDieuDong,
                'LyDo' => $this->LyDo,
                'TrangThai' => $this->TrangThai,
                'MaNhanVien' => $this->MaNhanVien,
                'GhiChu' => $this->GhiChu,
            ]);

            session()->flash('success', 'Cập nhật Lệnh Điều Động thành công!');
        } else {
            session()->flash('error', 'Không tìm thấy Lệnh Điều Động để cập nhật!');
        }

        $this->closeModal();
    }

    public function delete(){
        try {
            $lenhdieudong = LenhDieuDong::where('MaLenhDieuDong', $this->MaLenhDieuDong)->first();
            
            if (!$lenhdieudong) {
                session()->flash('error', 'Không tìm thấy Lệnh Điều Động');
                $this->closeModal();
                return;
            }
            
            // Check if there are any related records
            if ($lenhdieudong->nhapKho()->exists() || 
                $lenhdieudong->xuatKho()->exists() || 
                $lenhdieudong->phieuKiemKe()->exists() || 
                $lenhdieudong->thanhLyKho()->exists()) {
                session()->flash('error', 'Không thể xóa Lệnh Điều Động này vì nó đang được sử dụng trong các bảng khác.');
                $this->closeModal();
                return;
            }
            
            $lenhdieudong->delete();
            $this->closeModal();
            session()->flash('success', 'Lệnh Điều Động đã được xóa thành công');
        } catch (\Exception $e) {
            $this->closeModal();
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.lenh-dieu-dong', [
            'lenhdieudongs' => LenhDieuDong::query()
                ->when($this->search, function($query) {
                    $query->where('MaLenhDieuDong', 'like', "%{$this->search}%")
                        ->orWhere('LyDo', 'like', "%{$this->search}%");
                })
                ->with('nhanVien')
                ->orderBy('MaLenhDieuDong', 'asc')
                ->paginate(10),
            'nhanViens' => $this->nhanViens,
        ]);
    }

    #[On('search')]
    public function search()
    {
        $this->resetPage();
    }
}