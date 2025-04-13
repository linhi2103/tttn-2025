<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;
use App\Models\VaiTro;

class VaiTroComponent extends Component
{
    use WithPagination,WithFileUploads;
    public $search = '';

    public $isEdit = false;
    public $isAdd = false;
    public $isDelete = false;

    public $MaVaiTro;
    public $TenVaiTro;

    public function showModalAdd()
    {
        $this->isAdd = true;
    }
    public function showModalEdit($MaVaiTro)
    {
        $this->MaVaiTro = $MaVaiTro;
        $vaitro = VaiTro::where('MaVaiTro', $MaVaiTro)->first();
        $this->TenVaiTro = $vaitro->TenVaiTro;
        $this->isEdit = true;
    }
    public function showModalDelete($MaVaiTro)
    {
        $this->isDelete = true;
        $this->MaVaiTro = $MaVaiTro;
    }
    public function closeModal(){
        $this->isEdit = false;
        $this->isAdd = false;
        $this->isDelete = false;
        $this->resetModal();
    }
    public function resetModal(){
        $this->MaVaiTro = null;
        $this->TenVaiTro = null;
    }
    public function save(){
        try {
            $this->validate([
                'TenVaiTro' => 'required',
            ]);
            
            $vaitro = new VaiTro();
            $vaitro->MaVaiTro = $this->MaVaiTro;
            $vaitro->TenVaiTro = $this->TenVaiTro;
            
            $vaitro->save();
            $this->closeModal();
            session()->flash('success', 'Vai Trò đã được thêm thành công');
        } catch (\Exception $e) {
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
            $this->closeModal();
        }
    }
    public function update(){
        try {
            $this->validate([
                'TenVaiTro' => 'required',
            ]);
            
            $vaitro = VaiTro::where('MaVaiTro', $this->MaVaiTro)->first();
            $vaitro->TenVaiTro = $this->TenVaiTro;
            
            $vaitro->update();
            $this->closeModal();
            session()->flash('success', 'Vai Trò đã được cập nhật thành công');
        } catch (\Exception $e) {
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
            $this->closeModal();
        }
    }
    public function delete(){
        try {
            $vaitro = VaiTro::where('MaVaiTro', $this->MaVaiTro)->first();
            
            // Check if there are any related records in nhanvien table
            if ($vaitro->nhanvien()->exists()) {
                session()->flash('error', 'Không thể xóa Vai Trò này vì nó đang được sử dụng trong các nhân viên.');
                $this->closeModal();
                return;
            }
            
            $vaitro->delete();
            $this->closeModal();
            session()->flash('success', 'Vai Trò đã được xóa thành công');
        } catch (\Exception $e) {
            $this->closeModal();
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
    public function render()
    {
        $vaitros = VaiTro::query()
            ->where('TenVaiTro', 'like', "%{$this->search}%")
            ->orWhere('MaVaiTro', 'like', "%{$this->search}%")
            ->orderBy('MaVaiTro', 'asc')
            ->paginate(10);
        
        return view('livewire.vai-tro', [
            'vaitros' => $vaitros
        ]);
    }

    #[On('search')]
    public function search()
    {
        $this->resetPage();
    }
}
