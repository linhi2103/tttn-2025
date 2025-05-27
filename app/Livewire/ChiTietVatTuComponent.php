<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\Attributes\On;
use App\Models\ChiTietVatTu;
use App\Models\VatTu;
use App\Models\LoaiVatTu;
use Illuminate\Support\Facades\Storage;

class ChiTietVatTuComponent extends Component
{
    use WithPagination,WithFileUploads;
    public $search = '';

    public $isEdit = false;
    public $isAdd = false;
    public $isDelete = false;

    public $MaVatTu;
    public $ThuongHieu;
    public $KichThuoc;
    public $XuatXu;
    public $MoTa;
    
    public function showModalAdd()
    {
        $this->isAdd = true;
    }
    public function showModalEdit($MaVatTu)
    {
        $this->MaVatTu = $MaVatTu;
        $chitietvatTu = ChiTietVatTu::where('MaVatTu',$MaVatTu)->first();
        $this->ThuongHieu = $chitietvatTu->ThuongHieu;
        $this->KichThuoc = $chitietvatTu->KichThuoc;
        $this->XuatXu = $chitietvatTu->XuatXu;
        $this->MoTa = $chitietvatTu->MoTa;
        $this->isEdit = true;
    }
    public function showModalDelete($MaVatTu)
    {
        $this->isDelete = true;
        $this->MaVatTu = $MaVatTu;
    }
    public function closeModal(){
        $this->isEdit = false;
        $this->isAdd = false;
        $this->isDelete = false;
        $this->resetModal();
    }
    public function resetModal(){
        $this->MaVatTu = null;
        $this->ThuongHieu = null;
        $this->KichThuoc = null;
        $this->XuatXu = null;
        $this->MoTa = null;
    }
    public function save(){
        try {
            $this->validate([
                'MaVatTu' => 'required',
                'ThuongHieu' => 'required',
                'KichThuoc' => 'required',
                'XuatXu' => 'required',
                'MoTa' => 'required',
            ]);
            
            $chitietvatTu = new ChiTietVatTu();
            $chitietvatTu->MaVatTu = $this->MaVatTu;
            $chitietvatTu->ThuongHieu = $this->ThuongHieu;
            $chitietvatTu->KichThuoc = $this->KichThuoc;
            $chitietvatTu->XuatXu = $this->XuatXu;
            $chitietvatTu->MoTa = $this->MoTa;
            
            $chitietvatTu->save();
            $this->closeModal();
            session()->flash('success', 'Chi tiết Vật Tư đã được thêm thành công');
        } catch (\Exception $e) {
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
            $this->closeModal();
        }
    }
    public function update(){
        try {
            $this->validate([
                'MaVatTu' => 'required',
                'ThuongHieu' => 'required',
                'KichThuoc' => 'required',
                'XuatXu' => 'required',
                'MoTa' => 'required',
            ]);
            
            $chitietvatTu = ChiTietVatTu::where('MaVatTu', $this->MaVatTu)->first();
            $chitietvatTu->MaVatTu = $this->MaVatTu;
            $chitietvatTu->ThuongHieu = $this->ThuongHieu;
            $chitietvatTu->KichThuoc = $this->KichThuoc;
            $chitietvatTu->XuatXu = $this->XuatXu;
            $chitietvatTu->MoTa = $this->MoTa;
            
            $chitietvatTu->update();
            $this->closeModal();
            session()->flash('success', 'Chi tiết Vật Tư đã được cập nhật thành công');
        } catch (\Exception $e) {
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
            $this->closeModal();
        }
    }
    public function delete(){
        try {
            $chitietvatTu = ChiTietVatTu::where('MaVatTu', $this->MaVatTu)->first();
            
            // Check if there are any related records in nhanvien table
            if ($chitietvatTu->vatTu()->exists()) {
                session()->flash('error', 'Không thể xóa Chi tiết Vật Tư này vì nó đang được sử dụng trong các Vật Tư.');
                $this->closeModal();
                return;
            }
            
            $chitietvatTu->delete();
            $this->closeModal();
            session()->flash('success', 'Chi tiết Vật Tư đã được xóa thành công');
        } catch (\Exception $e) {
            $this->closeModal();
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
    public function render()
    {
        $this->vatTus = VatTu::all();
        $chitietvatTus = ChiTietVatTu::query()
            ->where('ThuongHieu', 'like', "%{$this->search}%")
            ->orWhere('MaVatTu', 'like', "%{$this->search}%")
            ->orderBy('MaVatTu', 'asc')
            ->paginate(10);

        return view('livewire.chuc-vu', [
            'chitietvatTus' => $chitietvatTus,
            'vatTus' => $this->vatTus,
        ]);
    }

    #[On('search')]
    public function search()
    {
        $this->resetPage();
    }
}