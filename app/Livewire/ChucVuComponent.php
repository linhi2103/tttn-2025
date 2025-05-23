<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\Attributes\On;
use App\Models\ChucVu;
use App\Models\PhongBan;

class ChucVuComponent extends Component
{
    use WithPagination,WithFileUploads;
    public $search = '';

    public $isEdit = false;
    public $isAdd = false;
    public $isDelete = false;

    public $MaChucVu;
    public $MaPhongBan;
    public $TenChucVu;
    
    public function showModalAdd()
    {
        $this->isAdd = true;
    }
    public function showModalEdit($MaChucVu)
    {
        $this->MaChucVu = $MaChucVu;
        $chucvu = ChucVu::where('MaChucVu',$MaChucVu)->first();
        $this->TenChucVu = $chucvu->TenChucVu;
        $this->isEdit = true;
    }
    public function showModalDelete($MaChucVu)
    {
        $this->isDelete = true;
        $this->MaChucVu = $MaChucVu;
    }
    public function closeModal(){
        $this->isEdit = false;
        $this->isAdd = false;
        $this->isDelete = false;
        $this->resetModal();
    }
    public function resetModal(){
        $this->MaChucVu = null;
        $this->MaPhongBan = null;
        $this->TenChucVu = null;
    }
    public function save(){
        try {
            $this->validate([
                'MaPhongBan' => 'required',
                'MaChucVu' => 'required',
                'TenChucVu' => 'required',
            ]);
            
            $chucvu = new ChucVu();
            $chucvu->MaPhongBan = $this->MaPhongBan;
            $chucvu->MaChucVu = $this->MaChucVu;
            $chucvu->TenChucVu = $this->TenChucVu;
            
            $chucvu->save();
            $this->closeModal();
            session()->flash('success', 'Chức vụ đã được thêm thành công');
        } catch (\Exception $e) {
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
            $this->closeModal();
        }
    }
    public function update(){
        try {
            $this->validate([
                'TenChucVu' => 'required',
                'MaChucVu' => 'required',
            ]);
            
            $chucvu = ChucVu::where('MaChucVu', $this->MaChucVu)->first();
            $chucvu->TenChucVu = $this->TenChucVu;
            $chucvu->MaPhongBan = $this->MaPhongBan;
            
            $chucvu->update();
            $this->closeModal();
            session()->flash('success', 'Chức vụ đã được cập nhật thành công');
        } catch (\Exception $e) {
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
            $this->closeModal();
        }
    }
    public function delete(){
        try {
            $chucvu = ChucVu::where('MaChucVu', $this->MaChucVu)->first();
            
            // Check if there are any related records in nhanvien table
            if ($chucvu->nhanVien()->exists()) {
                session()->flash('error', 'Không thể xóa Chức vụ này vì nó đang được sử dụng trong các nhân viên.');
                $this->closeModal();
                return;
            }
            
            $chucvu->delete();
            $this->closeModal();
            session()->flash('success', 'Chức vụ đã được xóa thành công');
        } catch (\Exception $e) {
            $this->closeModal();
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
    public function render()
    {
        $this->phongbans = PhongBan::all();
        $chucvus = ChucVu::query()
            ->where('TenChucVu', 'like', "%{$this->search}%")
            ->orWhere('MaChucVu', 'like', "%{$this->search}%")
            ->orderBy('MaChucVu', 'asc')
            ->paginate(10);

        return view('livewire.chuc-vu', [
            'chucvus' => $chucvus,
            'phongbans' => $this->phongbans,
        ]);
    }

    #[On('search')]
    public function search()
    {
        $this->resetPage();
    }
}
