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
    public $NgayLapDon;
    public $TrangThai = false;
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
        $this->NgayLapDon = now()->format('Y-m-d');
        $this->TrangThai = false; // Default value
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
            $this->NgayLapDon = $lenhdieudong->NgayLapDon;
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
        $this->NgayLapDon = null;
        $this->TrangThai = false;
        $this->MaNhanVien = null;
        $this->GhiChu = null;
    }

    public function save()
    {
        $validated = $this->validate([
            'MaLenhDieuDong' => 'required|unique:lenhdieudong,MaLenhDieuDong',
            'TenLenhDieuDong' => 'required',
            'LyDo' => 'required',
            'NgayLapDon' => 'required|date',
            'MaNhanVien' => 'required|exists:nhanvien,MaNhanVien',
            'TrangThai' => 'boolean',
            'GhiChu' => 'nullable|string',
        ]);

        try {
            LenhDieuDong::create([
                'MaLenhDieuDong' => $this->MaLenhDieuDong,
                'TenLenhDieuDong' => $this->TenLenhDieuDong,
                'LyDo' => $this->LyDo,
                'NgayLapDon' => $this->NgayLapDon,
                'MaNhanVien' => $this->MaNhanVien,
                'TrangThai' => $this->TrangThai ?? false,
                'GhiChu' => $this->GhiChu,
            ]);
            
            $this->resetModal();
            $this->isAdd = false;
            
            session()->flash('success', 'Lệnh Điều Động đã được thêm thành công');
        } catch (\Exception $e) {
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function update()
    {
        $validated = $this->validate([
            'MaLenhDieuDong' => 'required',
            'TenLenhDieuDong' => 'required',
            'LyDo' => 'required',
            'NgayLapDon' => 'required|date',
            'MaNhanVien' => 'required|exists:nhanvien,MaNhanVien',
            'TrangThai' => 'boolean',
            'GhiChu' => 'nullable|string',
        ]);

        try {
            $lenhdieudong = LenhDieuDong::where('MaLenhDieuDong', $this->MaLenhDieuDong)->first();
            if ($lenhdieudong) {
                $lenhdieudong->update([
                    'TenLenhDieuDong' => $this->TenLenhDieuDong,
                    'LyDo' => $this->LyDo,
                    'NgayLapDon' => $this->NgayLapDon,
                    'MaNhanVien' => $this->MaNhanVien,
                    'TrangThai' => $this->TrangThai ?? false,
                    'GhiChu' => $this->GhiChu,
                ]);
                
                $this->resetModal();
                $this->isEdit = false;
                
                session()->flash('success', 'Lệnh Điều Động đã được cập nhật thành công');
            } else {
                session()->flash('error', 'Không tìm thấy Lệnh Điều Động');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
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
                        ->orWhere('TenLenhDieuDong', 'like', "%{$this->search}%")
                        ->orWhere('LyDo', 'like', "%{$this->search}%")
                        ->orWhere('GhiChu', 'like', "%{$this->search}%");
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