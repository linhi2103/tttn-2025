<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\Attributes\On;
use App\Models\Doitac;

class DoiTacComponent extends Component
{
    use WithPagination;
    use WithFileUploads;
    
    public $search = '';
    
    // Modal fields
    public $MaSoThue_DoiTac;
    public $TenDoiTac;
    public $Email;
    public $Sdt;
    public $DiaChi;
    
    // Modal status
    public $isEdit = false;
    public $isAdd = false;
    public $isDelete = false;
    
    public function showModalAdd()
    {
        $this->isAdd = true;
    }
    
    public function showModalEdit($MaSoThue_DoiTac)
    {
        $doitac = Doitac::where('MaSoThue_DoiTac', $MaSoThue_DoiTac)->first();
        $this->MaSoThue_DoiTac = $doitac->MaSoThue_DoiTac;
        $this->TenDoiTac = $doitac->TenDoiTac;
        $this->Email = $doitac->Email;
        $this->Sdt = $doitac->Sdt;
        $this->DiaChi = $doitac->DiaChi;
        $this->isEdit = true;
    }
    
    public function showModalDelete($id)
    {
        $this->isDelete = true;
        $this->id = $id;
    }
    
    public function closeModal()
    {
        $this->isEdit = false;
        $this->isAdd = false;
        $this->isDelete = false;
        $this->resetModal();
    }
    
    public function resetModal()
    {
        $this->MaSoThue_DoiTac = null;
        $this->TenDoiTac = null;
        $this->Email = null;
        $this->Sdt = null;
        $this->DiaChi = null;
    }
    
    public function save()
    {
        try {
            $this->validate([
                'MaSoThue_DoiTac' => 'required',
                'TenDoiTac' => 'required',
                'Email' => 'nullable|email',
                'Sdt' => 'nullable',
                'DiaChi' => 'nullable',
            ]);
            
            $doitac = new Doitac();
            $doitac->MaSoThue_DoiTac = $this->MaSoThue_DoiTac;
            $doitac->TenDoiTac = $this->TenDoiTac;
            $doitac->Email = $this->Email;
            $doitac->Sdt = $this->Sdt;
            $doitac->DiaChi = $this->DiaChi;
            $doitac->save();
            
            $this->closeModal();
            session()->flash('success', 'Đối Tác đã được thêm thành công');
        } catch (\Exception $e) {
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
            $this->closeModal();
        }
    }
    
    public function update()
    {
        try {
            $this->validate([
                'MaSoThue_DoiTac' => 'required',
                'TenDoiTac' => 'required',
                'Email' => 'nullable|email',
                'Sdt' => 'nullable',
                'DiaChi' => 'nullable',
            ]);
            
            $doitac->MaSoThue_DoiTac = $this->MaSoThue_DoiTac;
            $doitac->TenDoiTac = $this->TenDoiTac;
            $doitac->Email = $this->Email;
            $doitac->Sdt = $this->Sdt;
            $doitac->DiaChi = $this->DiaChi;
            $doitac->save();
            
            $this->closeModal();
            session()->flash('success', 'Đối Tác đã được cập nhật thành công');
        } catch (\Exception $e) {
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
            $this->closeModal();
        }
    }
    
    public function delete()
    {
        try {
            $doitac = Doitac::where('id', $this->id)->first();
            // Check if there are any related records in vattu table
            if ($doitac->vattu()->exists()) {
                session()->flash('error', 'Không thể xóa Đối Tác này vì nó đang được sử dụng trong các Vật Tư.');
                $this->closeModal();
                return;
            }
            
            $doitac->delete();
            $this->closeModal();
            session()->flash('success', 'Đối Tác đã được xóa thành công');
        } catch (\Exception $e) {
            $this->closeModal();
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
    
    public function render()
    {
        $doitacs = Doitac::query()
            ->where('TenDoiTac', 'like', "%{$this->search}%")
            ->orWhere('MaSoThue_DoiTac', 'like', "%{$this->search}%")
            ->orderBy('TenDoiTac', 'asc')
            ->paginate(10);
            
        return view('livewire.doi-tac', [
            'doitacs' => $doitacs
        ]);
    }
    
    #[On('search')]
    public function search()
    {
        $this->resetPage();
    }
}