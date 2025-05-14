<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Features\SupportPagination\WithPagination;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use App\Models\VatTu;

class ChiTietVatTuComponent extends Component
{
    use WithPagination, WithFileUploads;
    public $search = '';
    public $filter = '';

    public $MaVatTu;
    public $ThuongHieu;
    public $KichThuoc;
    public $XuatXu;
    public $MoTa;

    //Modal status
    public $isEdit = false;
    public $isAdd = false;
    public $isDelete = false;

    //Modal function
    public function showModalAdd()
    {
        $this->isAdd = true;
    }
    public function showModalEdit($MaVatTu)
    {
        $this->MaVatTu = $MaVatTu;
        $chitietvattu = VatTu::where('MaVatTu',$MaVatTu)->first();
        $this->ThuongHieu = $chitietvattu->ThuongHieu;
        $this->KichThuoc = $chitietvattu->KichThuoc;
        $this->XuatXu = $chitietvattu->XuatXu;
        $this->MoTa = $chitietvattu->MoTa;
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
            
            $chitietvatTu = new VatTu();
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
            
            $chitietvatTu = VatTu::where('MaVatTu', $this->MaVatTu)->first();
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
            $chitietvatTu = VatTu::where('MaVatTu', $this->MaVatTu)->first();
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
        $vatTus = VatTu::query()
                ->with('loaivattu')
                ->where(function($query) {
                    $query->where('TenVatTu', 'like', "%{$this->search}%")
                        ->orWhereHas('loaivattu', function($q) {
                            $q->where('TenLoaiVatTu', 'like', "%{$this->search}%");
                        })
                        ->orWhere('MaVatTu', 'like', "%{$this->search}%");
                });
        $vatTus = $vatTus->orderBy('MaVatTu', 'asc')->paginate(10);

        return view('livewire.chi-tiet-vat-tu-component', [
            'vatTus' => $vatTus,
        ]);
    }

    #[On('search')]
    public function search()
    {
        $this->resetPage();
    }

    #[On('filter')]
    public function filterByLoaiVatTu()
    {
        $this->resetPage();
    }
}
