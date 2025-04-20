<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\Attributes\On;
use App\Models\LoaiVatTu;

class LoaiVatTuComponent extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $search = '';

    public $MaLoaiVatTu;
    public $TenLoaiVatTu;

    public $isEdit = false;
    public $isAdd = false;
    public $isDelete = false;

    public function showModalAdd()
    {
        $this->isAdd = true;
    }
    public function showModalEdit($MaLoaiVatTu)
    {
        $this->MaLoaiVatTu = $MaLoaiVatTu;
        $loaivattu = LoaiVatTu::where('MaLoaiVatTu',$MaLoaiVatTu)->first();
        $this->TenLoaiVatTu = $loaivattu->TenLoaiVatTu;
        $this->isEdit = true;
    }
    public function showModalDelete($MaLoaiVatTu)
    {
        $this->isDelete = true;
        $this->MaLoaiVatTu = $MaLoaiVatTu;
    }
    public function closeModal(){
        $this->isEdit = false;
        $this->isAdd = false;
        $this->isDelete = false;
        $this->resetModal();
    }
    public function resetModal(){
        $this->MaLoaiVatTu = null;
        $this->TenLoaiVatTu = null;
    }
    public function save(){
        try {
            $this->validate([
                'MaLoaiVatTu' => 'required',
                'TenLoaiVatTu' => 'required',
            ]);
            
            $loaivattu = new LoaiVatTu();
            $loaivattu->MaLoaiVatTu = $this->MaLoaiVatTu;
            $loaivattu->TenLoaiVatTu = $this->TenLoaiVatTu;
            
            $loaivattu->save();
            $this->closeModal();
            session()->flash('success', 'Loại Vật Tư đã được thêm thành công');
        } catch (\Exception $e) {
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
            $this->closeModal();
        }
    }
    public function update(){
        try {
            $this->validate([
                'TenLoaiVatTu' => 'required',
            ]);
            
            $loaivattu = LoaiVatTu::where('MaLoaiVatTu', $this->MaLoaiVatTu)->first();
            $loaivattu->TenLoaiVatTu = $this->TenLoaiVatTu;
            
            $loaivattu->update();
            $this->closeModal();
            session()->flash('success', 'Loại Vật Tư đã được cập nhật thành công');
        } catch (\Exception $e) {
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
            $this->closeModal();
        }
    }

    public function delete(){
        try {
            $loaivattu = LoaiVatTu::where('MaLoaiVatTu', $this->MaLoaiVatTu)->first();
            
            if ($loaivattu->vattu()->exists()) {
                session()->flash('error', 'Không thể xóa Loại Vật Tư này vì nó đang được sử dụng trong các Vật Tư.');
                $this->closeModal();
                return;
            }
            
            $loaivattu->delete();
            $this->closeModal();
            session()->flash('success', 'Loại Vật Tư đã được xóa thành công');
        } catch (\Exception $e) {
            $this->closeModal();
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $loaivattus = LoaiVatTu::query()
            ->where('TenLoaiVatTu', 'like', "%{$this->search}%")
            ->orWhere('MaLoaiVatTu', 'like', "%{$this->search}%")
            ->orderBy('MaLoaiVatTu', 'asc')
            ->paginate(10);
        
        return view('livewire.loai-vat-tu', [
            'loaivattus' => $loaivattus
        ]);
    }

    #[On('search')]
    public function search()
    {
        $this->resetPage();
    }
}
