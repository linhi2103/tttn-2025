<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\Attributes\On;
use App\Models\DonViTinh;

class DonViTinhComponent extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $search = '';

    public $MaDonViTinh;
    public $TenDonViTinh;

    public $isEdit = false;
    public $isAdd = false;
    public $isDelete = false;

    public function showModalAdd()
    {
        $this->isAdd = true;
    }

    public function showModalEdit($MaDonViTinh)
    {
        $this->MaDonViTinh = $MaDonViTinh;
        $donvitinh = DonViTinh::where('MaDonViTinh', $MaDonViTinh)->first();
        $this->TenDonViTinh = $donvitinh->TenDonViTinh;
        $this->isEdit = true;
    }
    public function showModalDelete($MaDonViTinh)
    {
        $this->isDelete = true;
        $this->MaDonViTinh = $MaDonViTinh;
    }
    public function closeModal(){
        $this->isEdit = false;
        $this->isAdd = false;
        $this->isDelete = false;
        $this->resetModal();
    }
    public function resetModal(){
        $this->MaDonViTinh = null;
        $this->TenDonViTinh = null;
    }
    public function save(){
        try {
            $this->validate([
                'MaDonViTinh' => 'required',
                'TenDonViTinh' => 'required',
            ]);
            
            $donvitinh = new DonViTinh();
            $donvitinh->MaDonViTinh = $this->MaDonViTinh;
            $donvitinh->TenDonViTinh = $this->TenDonViTinh;
            
            $donvitinh->save();
            $this->closeModal();
            session()->flash('success', 'Đơn Vị Tính đã được thêm thành công');
        } catch (\Exception $e) {
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
            $this->closeModal();
        }
    }
    public function update(){
        try {
            $this->validate([
                'TenDonViTinh' => 'required',
            ]);
            
            $donvitinh = DonViTinh::where('MaDonViTinh', $this->MaDonViTinh)->first();
            $donvitinh->TenDonViTinh = $this->TenDonViTinh;
            
            $donvitinh->update();
            $this->closeModal();
            session()->flash('success', 'Đơn Vị Tính đã được cập nhật thành công');
        } catch (\Exception $e) {
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
            $this->closeModal();
        }
    }
    public function delete(){
        try {
            $donvitinh = DonViTinh::where('MaDonViTinh', $this->MaDonViTinh)->first();
            
            // Check if there are any related records in vattu table
            if ($donvitinh->vattu()->exists()) {
                session()->flash('error', 'Không thể xóa Đơn Vị Tính này vì nó đang được sử dụng trong các Vật Tư.');
                $this->closeModal();
                return;
            }
            
            $donvitinh->delete();
            $this->closeModal();
            session()->flash('success', 'Đơn Vị Tính đã được xóa thành công');
        } catch (\Exception $e) {
            $this->closeModal();
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
    public function render()
    {
        $donvitinhs = DonViTinh::query()
            ->where('TenDonViTinh', 'like', "%{$this->search}%")
            ->orWhere('MaDonViTinh', 'like', "%{$this->search}%")
            ->orderBy('MaDonViTinh', 'asc')
            ->paginate(10);
        
        return view('livewire.don-vi-tinh', [
            'donvitinhs' => $donvitinhs
        ]);
    }

    #[On('search')]
    public function search()
    {
        $this->resetPage();
    }
}
