<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\Attributes\On;
use App\Models\ChiTietVatTu;
use App\Models\VatTu;
use App\Models\LoaiVatTu;

class ChiTietVatTuComponent extends Component
{
    use WithPagination,WithFileUploads;
    public $search = '';

    public $isEdit = false;
    public $isAdd = false;
    public $isDelete = false;

    public $MaVatTu;
    public $MaLoaiVatTu;
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
        $chitietvatTu = ChiTietVatTu::where('MaVatTu', $MaVatTu)->first();

        if (!$chitietvatTu) {
            session()->flash('error', 'Không tìm thấy chi tiết vật tư có mã: ' . $MaVatTu);
            return;
        }

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
        $this->resetValidation();
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
            session()->flash('success', 'Chi tiết vật tư đã được thêm thành công');
        } catch (\Exception $e) {
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
            $this->closeModal();
        }
    }

    public function update(){
        try {
            $this->validate([
                'MaVatTu' => 'required|unique:chi_tiet_vat_tus,MaVatTu,' . $this->MaVatTu . ',MaVatTu',
                'ThuongHieu' => 'required',
                'KichThuoc' => 'required',
                'XuatXu' => 'required',
                'MoTa' => 'required',
            ]);
            
            $chitietvatTu = ChiTietVatTu::where('MaVatTu', $this->MaVatTu)->first();
            if (!$chitietvatTu) {
                session()->flash('error', 'Chi tiết vật tư không tồn tại');
                $this->closeModal();
                return;
            }
            $chitietvatTu->ThuongHieu = $this->ThuongHieu;
            $chitietvatTu->KichThuoc = $this->KichThuoc;
            $chitietvatTu->XuatXu = $this->XuatXu;
            $chitietvatTu->MoTa = $this->MoTa;
            
            $chitietvatTu->update();
            $this->closeModal();
            session()->flash('success', 'Chi tiết vật tư đã được cập nhật thành công');
        } catch (\Exception $e) {
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
            $this->closeModal();
        }
    }

    public function delete(){
        try {
            $chitietvatTu = ChiTietVatTu::where('MaVatTu', $this->MaVatTu)->first();
            
            if ($chitietvatTu->nhapkho()->exists()) {
                session()->flash('error', 'Không thể xóa Chi tiết Vật Tư này vì nó đang được sử dụng trong các phiếu nhập kho.');
                $this->closeModal();
                return;
            }
            
            $chitietvatTu->delete();
            $this->closeModal();
            session()->flash('success', 'Chi tiết vật tư đã được xóa thành công');
        } catch (\Exception $e) {
            $this->closeModal();
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $chitietvatTus = ChiTietVatTu::where(function($query) {
            $query->where('MaVatTu', 'like', "%{$this->search}%")
                  ->orWhere('ThuongHieu', 'like', "%{$this->search}%");
        })->orderBy('MaVatTu', 'asc')->paginate(10);

        $loaivattus = LoaiVatTu::all();

        return view('livewire.chi-tiet-vat-tu', [
            'chitietvatTus' => $chitietvatTus,
            'loaivattus' => $loaivattus,
        ]);
    }

    #[On('search')]
    public function search()
    {
        $this->resetPage();
    }
}
