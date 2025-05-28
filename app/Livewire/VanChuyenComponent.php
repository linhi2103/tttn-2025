<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;
use App\Models\DonViVanChuyen;
use App\Models\NhanVien;

class VanChuyenComponent extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $search = '';

    // Modal fields
    public $MaDonViVanChuyen;
    public $TenDonViVanChuyen;
    public $PhuongTienVanChuyen;
    public $GhiChu;

    // Modal status
    public $isEdit = false;
    public $isAdd = false;
    public $isDelete = false;
    
    public function showModalAdd()
    {
        $this->isAdd = true;
    }
    
    public function showModalEdit($MaDonViVanChuyen)
    {
        $this->MaDonViVanChuyen = $MaDonViVanChuyen;
        $donvivanchuyen = DonViVanChuyen::where('MaDonViVanChuyen', $MaDonViVanChuyen)->first();
        $this->TenDonViVanChuyen = $donvivanchuyen->TenDonViVanChuyen;
        $this->PhuongTienVanChuyen = $donvivanchuyen->PhuongTienVanChuyen;
        $this->GhiChu = $donvivanchuyen->GhiChu;
        $this->isEdit = true;
    }
    
    public function showModalDelete($MaDonViVanChuyen)
    {
        $this->isDelete = true;
        $this->MaDonViVanChuyen = $MaDonViVanChuyen;
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
        $this->MaDonViVanChuyen = null;
        $this->TenDonViVanChuyen = null;
        $this->PhuongTienVanChuyen = null;
        $this->GhiChu = null;
    }
    
    public function save()
    {
        try {
            $this->validate([
                'MaDonViVanChuyen' => 'required',
                'TenDonViVanChuyen' => 'required',
                'PhuongTienVanChuyen' => 'required',
                'GhiChu' => 'nullable',
            ]);
            
            $donvivanchuyen = new DonViVanChuyen();
            $donvivanchuyen->MaDonViVanChuyen = $this->MaDonViVanChuyen;
            $donvivanchuyen->TenDonViVanChuyen = $this->TenDonViVanChuyen;
            $donvivanchuyen->PhuongTienVanChuyen = $this->PhuongTienVanChuyen;
            $donvivanchuyen->GhiChu = $this->GhiChu;
            $donvivanchuyen->save();
            
            $this->closeModal();
            session()->flash('success', 'Đơn Vị Van Chuyen đã được thêm thành công');
        } catch (\Exception $e) {
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
            $this->closeModal();
        }
    }
    
    public function update()
    {
        try {
            $this->validate([
                'TenDonViVanChuyen' => 'required',
                'PhuongTienVanChuyen' => 'required',
                'GhiChu' => 'nullable',
            ]);
            
            $donvivanchuyen = DonViVanChuyen::where('MaDonViVanChuyen', $this->MaDonViVanChuyen)->first();
            $donvivanchuyen->TenDonViVanChuyen = $this->TenDonViVanChuyen;
            $donvivanchuyen->PhuongTienVanChuyen = $this->PhuongTienVanChuyen;
            $donvivanchuyen->GhiChu = $this->GhiChu;
            $donvivanchuyen->save();
            
            $this->closeModal();
            session()->flash('success', 'Đơn Vị Van Chuyen đã được cập nhật thành công');
        } catch (\Exception $e) {
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
            $this->closeModal();
        }
    }
    
    public function delete()
    {
        try {
            $donvivanchuyen = DonViVanChuyen::where('MaDonViVanChuyen', $this->MaDonViVanChuyen)->first();
            
            $donvivanchuyen->delete();
            $this->closeModal();
            session()->flash('success', 'Đơn Vị Van Chuyen đã được xóa thành công');
        } catch (\Exception $e) {
            $this->closeModal();
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
    public function render()
    {
        $donvivanchuyens = DonViVanChuyen::query()
            ->where('TenDonViVanChuyen', 'like', "%{$this->search}%")
            ->orWhere('MaDonViVanChuyen', 'like', "%{$this->search}%")
            ->orderBy('MaDonViVanChuyen', 'asc')
            ->paginate(10);

        return view('livewire.don-vi-van-chuyen', [
            'donvivanchuyens' => $donvivanchuyens,
        ]);
    }

    #[On('search')]
    public function search()
    {
        $this->resetPage();
    }
}
