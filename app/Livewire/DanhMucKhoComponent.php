<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;
use App\Models\DanhMucKho;
use Livewire\Attributes\On;

class DanhMucKhoComponent extends Component
{
    use WithPagination,WithFileUploads;
    public $search = '';

    public $isEdit = false;
    public $isAdd = false;
    public $isDelete = false;

    public $MaKho;
    public $TenKho;
    public $DiaChi;
    public $QuyMo;
    public $TinhTrang;
    public $DienTichSuDung;
    
    public function showModalAdd()
    {
        $this->isAdd = true;
    }
    public function showModalEdit($MaKho)
    {
        $this->MaKho = $MaKho;
        $danhmuckho = DanhMucKho::where('MaKho',$MaKho)->first();
        $this->TenKho = $danhmuckho->TenKho;
        $this->DiaChi = $danhmuckho->DiaChi;
        $this->QuyMo = $danhmuckho->QuyMo;
        $this->TinhTrang = $danhmuckho->TinhTrang;
        $this->DienTichSuDung = $danhmuckho->DienTichSuDung;
        $this->isEdit = true;
    }
    public function showModalDelete($MaKho)
    {
        $this->isDelete = true;
        $this->MaKho = $MaKho;
    }
    public function closeModal(){
        $this->isEdit = false;
        $this->isAdd = false;
        $this->isDelete = false;
        $this->resetModal();
    }
    public function resetModal(){
        $this->MaKho = null;
        $this->TenKho = null;
        $this->DiaChi = null;
        $this->QuyMo = null;
        $this->TinhTrang = null;
        $this->DienTichSuDung = null;
    }

    public function save(){
        try {
            $this->validate([
                'MaKho' => 'required',
                'TenKho' => 'required',
                'DiaChi' => 'required',
                'QuyMo' => 'required',
                'DienTichSuDung' => 'required',
            ]);
            
            $danhmuckho = new DanhMucKho();
            $danhmuckho->MaKho = $this->MaKho;
            $danhmuckho->TenKho = $this->TenKho;
            $danhmuckho->DiaChi = $this->DiaChi;
            $danhmuckho->QuyMo = $this->QuyMo;
            $danhmuckho->DienTichSuDung = $this->DienTichSuDung;
            
            $danhmuckho->save();
            $this->closeModal();
            session()->flash('success', 'Danh Mục Kho đã được thêm thành công');
        } catch (\Exception $e) {
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
            $this->closeModal();
        }
    }

    public function update(){
        try {
            $this->validate([
                'TenKho' => 'required',
                'DiaChi' => 'required',
                'QuyMo' => 'required',
                'TinhTrang' => 'required',
                'DienTichSuDung' => 'required',
            ]);
            
            $danhmuckho = DanhMucKho::where('MaKho', $this->MaKho)->first();
            $danhmuckho->TenKho = $this->TenKho;
            $danhmuckho->DiaChi = $this->DiaChi;
            $danhmuckho->QuyMo = $this->QuyMo;
            $danhmuckho->TinhTrang = $this->TinhTrang;
            $danhmuckho->DienTichSuDung = $this->DienTichSuDung;
            
            $danhmuckho->update();
            $this->closeModal();
            session()->flash('success', 'Danh Mục Kho đã được cập nhật thành công');
        } catch (\Exception $e) {
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
            $this->closeModal();
        }
    }

    public function delete(){
        try {
            $danhmuckho = DanhMucKho::where('MaKho', $this->MaKho)->first();
            
            // Check if there are any related records in nhapkho table
            if ($danhmuckho->nhapkho()->exists()) {
                session()->flash('error', 'Không thể xóa Kho này vì nó đang được sử dụng trong các phiếu nhập kho.');
                $this->closeModal();
                return;
            }
            
            $danhmuckho->delete();
            $this->closeModal();
            session()->flash('success', 'Kho đã được xóa thành công');
        } catch (\Exception $e) {
            $this->closeModal();
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $danhmuckhos = DanhMucKho::query()
            ->where('TenKho', 'like', "%{$this->search}%")
            ->orWhere('MaKho', 'like', "%{$this->search}%")
            ->orWhere('DiaChi', 'like', "%{$this->search}%")
            ->orWhere('QuyMo', 'like', "%{$this->search}%")
            ->orWhere('DienTichSuDung', 'like', "%{$this->search}%")
            ->orderBy('MaKho', 'asc')
            ->paginate(10);

        return view('livewire.danh-muc-kho', [
            'danhmuckhos' => $danhmuckhos
        ]);
    }

    #[On('search')]
    public function search()
    {
        $this->resetPage();
    }
}
