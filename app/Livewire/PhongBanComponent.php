<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\Attributes\On;
use App\Models\PhongBan;

class PhongBanComponent extends Component
{
    use WithPagination,WithFileUploads;
    public $search = '';

    public $isEdit = false;
    public $isAdd = false;
    public $isDelete = false;

    public $MaPhongBan;
    public $TenPhongBan;
    
    public function showModalAdd()
    {
        $this->isAdd = true;
    }
    public function showModalEdit($MaPhongBan)
    {
        $this->MaPhongBan = $MaPhongBan;
        $phongban = PhongBan::where('MaPhongBan',$MaPhongBan)->first();
        $this->TenPhongBan = $phongban->TenPhongBan;
        $this->isEdit = true;
    }
    public function showModalDelete($MaPhongBan)
    {
        $this->isDelete = true;
        $this->MaPhongBan = $MaPhongBan;
    }
    public function closeModal(){
        $this->isEdit = false;
        $this->isAdd = false;
        $this->isDelete = false;
        $this->resetModal();
    }
    public function resetModal(){
        $this->MaPhongBan = null;
        $this->TenPhongBan = null;
    }
    public function save(){
        try {
            $this->validate([
                'MaPhongBan' => 'required',
                'TenPhongBan' => 'required',
            ]);
            
            $phongban = new PhongBan();
            $phongban->MaPhongBan = $this->MaPhongBan;
            $phongban->TenPhongBan = $this->TenPhongBan;
            
            $phongban->save();
            $this->closeModal();
            session()->flash('success', 'Phòng Ban đã được thêm thành công');
        } catch (\Exception $e) {
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
            $this->closeModal();
        }
    }
    public function update(){
        try {
            $this->validate([
                'TenPhongBan' => 'required',
            ]);
            
            $phongban = PhongBan::where('MaPhongBan', $this->MaPhongBan)->first();
            $phongban->TenPhongBan = $this->TenPhongBan;
            
            $phongban->update();
            $this->closeModal();
            session()->flash('success', 'Phòng Ban đã được cập nhật thành công');
        } catch (\Exception $e) {
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
            $this->closeModal();
        }
    }
    public function delete(){
        try {
            $phongban = PhongBan::where('MaPhongBan', $this->MaPhongBan)->first();
            
            // Check if there are any related records in nhanvien table
            if ($phongban->nhanvien()->exists()) {
                session()->flash('error', 'Không thể xóa Phòng Ban này vì nó đang được sử dụng trong các nhân viên.');
                $this->closeModal();
                return;
            }
            
            $phongban->delete();
            $this->closeModal();
            session()->flash('success', 'Phòng Ban đã được xóa thành công');
        } catch (\Exception $e) {
            $this->closeModal();
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
    public function render()
    {
        $phongbans = PhongBan::query()
            ->where('TenPhongBan', 'like', "%{$this->search}%")
            ->orWhere('MaPhongBan', 'like', "%{$this->search}%")
            ->orderBy('MaPhongBan', 'asc')
            ->paginate(10);

        return view('livewire.phong-ban', [
            'phongbans' => $phongbans
        ]);
    }

    #[On('search')]
    public function search()
    {
        $this->resetPage();
    }
}
