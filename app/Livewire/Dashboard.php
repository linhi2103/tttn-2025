<?php

namespace App\Livewire;

use Livewire\WithPagination;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\VatTu;
use App\Models\DonViTinh;
use App\Models\DoiTac;
use App\Models\LoaiVatTu;


class Dashboard extends Component
{
    use WithPagination, WithFileUploads;
    public $search = '';
    public $filter = '';
    
    //Modal status
    public $isEdit = false;
    public $isAdd = false;
    public $isDelete = false;

    //Modal field
    public $MaVatTu;
    public $TenVatTu;
    public $MaLoaiVatTu;
    public $MaDonViTinh;
    public $GiaNhap;
    public $GiaXuat;
    public $DonViTienTe;
    public $SoLuongTon;
    public $MaSoThue_DoiTac;
    public $NgayNhap;
    public $HanSuDung;
    public $GhiChu;
    public $AnhVatTu;

    //Modal function
    public function showModalAdd()
    {
        $this->isAdd = true;
    }
    public function showModalEdit($MaVatTu)
    {
        $this->MaVatTu = $MaVatTu;
        $vattu = VatTu::where('MaVatTu',$MaVatTu)->first();
        $this->TenVatTu = $vattu->TenVatTu;
        $this->MaLoaiVatTu = $vattu->MaLoaiVatTu;
        $this->MaDonViTinh = $vattu->MaDonViTinh;
        $this->GiaNhap = $vattu->GiaNhap;
        $this->GiaXuat = $vattu->GiaXuat;
        $this->DonViTienTe = $vattu->DonViTienTe;
        $this->SoLuongTon = $vattu->SoLuongTon;
        $this->MaSoThue_DoiTac = $vattu->MaSoThue_DoiTac;
        $this->NgayNhap = $vattu->NgayNhap;
        $this->HanSuDung = $vattu->HanSuDung;
        $this->GhiChu = $vattu->GhiChu;
        $this->AnhVatTu = $vattu->AnhVatTu;
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
        $this->TenVatTu = null;
        $this->MaLoaiVatTu = null;
        $this->MaDonViTinh = null;
        $this->GiaNhap = null;
        $this->GiaXuat = null;
        $this->DonViTienTe = null;
        $this->SoLuongTon = null;
        $this->MaSoThue_DoiTac = null;
        $this->NgayNhap = null;
        $this->HanSuDung = null;
        $this->GhiChu = null;
        $this->AnhVatTu = null;
    }

    public function save(){
        try {
            $this->validate([
                'MaVatTu' => 'required',
                'TenVatTu' => 'required',
                'MaLoaiVatTu' => 'required',
                'MaDonViTinh' => 'required',
                'GiaNhap' => 'required',
                'DonViTienTe' => 'required',
                'SoLuongTon' => 'required',
                'MaSoThue_DoiTac' => 'required',
                'NgayNhap' => 'required',
                'AnhVatTu' => 'required',
            ]);
            
            $vatTu = new VatTu();
            $vatTu->MaVatTu = $this->MaVatTu;
            $vatTu->TenVatTu = $this->TenVatTu;
            $vatTu->MaLoaiVatTu = $this->MaLoaiVatTu;
            $vatTu->MaDonViTinh = $this->MaDonViTinh;
            $vatTu->GiaNhap = $this->GiaNhap;
            $vatTu->DonViTienTe = $this->DonViTienTe;
            $vatTu->SoLuongTon = $this->SoLuongTon;
            $vatTu->MaSoThue_DoiTac = $this->MaSoThue_DoiTac;
            $vatTu->NgayNhap = $this->NgayNhap;
            $vatTu->HanSuDung = $this->HanSuDung;
            $vatTu->GhiChu = $this->GhiChu;
            
            if ($this->AnhVatTu && !is_string($this->AnhVatTu)) {
                $file = $this->AnhVatTu;
                $imageName = $this->MaVatTu.'.jpg';
                $file->storeAs('images/'.$this->MaLoaiVatTu, $imageName, 'public_path');
                $vatTu->AnhVatTu = $this->MaLoaiVatTu . '/' . $imageName;
            } else {
                $vatTu->AnhVatTu = $this->AnhVatTu;
            }
            
            $vatTu->save();
            $this->closeModal();
            session()->flash('success', 'Vật Tư đã được thêm thành công');
        } catch (\Exception $e) {
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
            $this->closeModal();
        }
    }
    
    public function update(){
        try {
            $this->validate([
                'TenVatTu' => 'required',
                'MaLoaiVatTu' => 'required',
                'MaDonViTinh' => 'required',
                'GiaNhap' => 'required',
                'DonViTienTe' => 'required',
                'SoLuongTon' => 'required',
                'MaSoThue_DoiTac' => 'required',
                'NgayNhap' => 'required'
            ]);
            
            $vatTu = VatTu::where('MaVatTu', $this->MaVatTu)->first();
            $vatTu->TenVatTu = $this->TenVatTu;
            $vatTu->MaLoaiVatTu = $this->MaLoaiVatTu;
            $vatTu->MaDonViTinh = $this->MaDonViTinh;
            $vatTu->GiaNhap = $this->GiaNhap;
            $vatTu->DonViTienTe = $this->DonViTienTe;
            $vatTu->SoLuongTon = $this->SoLuongTon;
            $vatTu->MaSoThue_DoiTac = $this->MaSoThue_DoiTac;
            $vatTu->NgayNhap = $this->NgayNhap;
            $vatTu->HanSuDung = $this->HanSuDung;
            $vatTu->GhiChu = $this->GhiChu;
            
            if ($this->AnhVatTu && !is_string($this->AnhVatTu)) {
                $file = $this->AnhVatTu;
                $imageName = $this->MaVatTu.'.jpg';
                $file->storeAs('images/'.$this->MaLoaiVatTu, $imageName, 'public_path');
                $vatTu->AnhVatTu = $this->MaLoaiVatTu . '/' . $imageName;
            } else {
                $vatTu->AnhVatTu = $this->AnhVatTu;
            }
            
            $vatTu->update();
            $this->closeModal();
            session()->flash('success', 'Vật Tư đã được cập nhật thành công');
        } catch (\Exception $e) {
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
            $this->closeModal();
        }
    }

    public function delete(){
        try {
            $vatTu = VatTu::where('MaVatTu', $this->MaVatTu)->first();
            $vatTu->delete();
            $this->closeModal();
            session()->flash('success', 'Vật Tư đã được xóa thành công');
        } catch (\Exception $e) {
            $this->closeModal();
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $donvitinhs = DonViTinh::all();
        $loaivattus = LoaiVatTu::all();
        $doitacs = DoiTac::all();
        $vatTus = VatTu::query()
                ->with('loaivattu')
                ->where(function($query) {
                    $query->where('TenVatTu', 'like', "%{$this->search}%")
                        ->orWhereHas('loaivattu', function($q) {
                            $q->where('TenLoaiVatTu', 'like', "%{$this->search}%");
                        })
                        ->orWhere('MaVatTu', 'like', "%{$this->search}%");
                });

        if ($this->filter) {
            $vatTus->where('MaLoaiVatTu', $this->filter);
        }

        $vatTus = $vatTus->orderBy('MaVatTu', 'asc')->paginate(10);


        return view('livewire.dashboard', [
            'vatTus' => $vatTus,
            'donvitinhs' => $donvitinhs,
            'loaivattus' => $loaivattus,
            'doitacs' => $doitacs
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