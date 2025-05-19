<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use App\Models\NhanVien;
use App\Models\PhongBan;
use App\Models\VaiTro;

class NhanVienComponent extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $search = '';

    // Modal fields
    public $MaNhanVien;
    public $TenNhanVien;
    public $SDT;
    public $CCCD;
    public $DiaChi;
    public $GioiTinh = 'Nam'; // Gán giá trị mặc định
    public $MaPhongBan;
    public $Anh;
    public $TrangThai;

    // Modal status
    public $isEdit = false;
    public $isAdd = false;
    public $isDelete = false;
    
    public function showModalAdd()
    {
        $this->resetModal(); // Reset trước khi mở modal
        $this->GioiTinh = 'Nam'; // Đảm bảo luôn có giá trị mặc định
        $this->isAdd = true;
    }
    
    public function showModalEdit($MaNhanVien)
    {
        $this->MaNhanVien = $MaNhanVien;
        $nhanvien = NhanVien::where('MaNhanVien', $MaNhanVien)->first();
        $this->TenNhanVien = $nhanvien->TenNhanVien;
        $this->SDT = $nhanvien->SDT;
        $this->CCCD = $nhanvien->CCCD;
        $this->DiaChi = $nhanvien->DiaChi;
        $this->GioiTinh = $nhanvien->GioiTinh;
        $this->MaPhongBan = $nhanvien->MaPhongBan;
        $this->Anh = $nhanvien->Anh;
        $this->TrangThai = $nhanvien->TrangThai;
        $this->isEdit = true;
    }
    
    public function showModalDelete($MaNhanVien)
    {
        $this->isDelete = true;
        $this->MaNhanVien = $MaNhanVien;
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
        $this->MaNhanVien = null;
        $this->TenNhanVien = null;
        $this->SDT = null;
        $this->CCCD = null;
        $this->DiaChi = null;
        $this->GioiTinh = 'Nam'; // Reset về giá trị mặc định
        $this->MaPhongBan = null;
        $this->Anh = null;
        $this->TrangThai = null;
    }
    
    public function save()
    {
        try {
            $this->validate([
                'MaNhanVien' => 'required',
                'TenNhanVien' => 'required',
                'DiaChi' => 'required',
                'GioiTinh' => 'required|in:Nam,Nữ',
                'SDT' => 'required|numeric',
                'CCCD' => 'required|numeric',
                'MaPhongBan' => 'required',
                'Anh' => 'required',
                'TrangThai' => 'required|integer',
            ]);
            
            $nhanvien = new NhanVien();
            $nhanvien->MaNhanVien = $this->MaNhanVien;
            $nhanvien->TenNhanVien = $this->TenNhanVien;
            $nhanvien->DiaChi = $this->DiaChi;
            $nhanvien->GioiTinh = $this->GioiTinh;
            $nhanvien->SDT = $this->SDT;
            $nhanvien->CCCD = $this->CCCD;
            $nhanvien->MaPhongBan = $this->MaPhongBan;
            $nhanvien->Anh = $this->Anh;
            $nhanvien->TrangThai = $this->TrangThai;
            $nhanvien->save();
            
            $this->closeModal();
            session()->flash('success', 'Nhân viên đã được thêm thành công');
        } catch (\Exception $e) {
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
    
    public function update()
    {
        try {
            $this->validate([
                'TenNhanVien' => 'required',
                'DiaChi' => 'required',
                'GioiTinh' => 'required|in:Nam,Nữ',
                'SDT' => 'required|numeric',
                'CCCD' => 'required|numeric',
                'MaPhongBan' => 'required',
                'Anh' => 'required',
                'TrangThai' => 'required|integer',
            ]);
            
            $nhanvien = NhanVien::where('MaNhanVien', $this->MaNhanVien)->first();
            if ($nhanvien) {
                $nhanvien->TenNhanVien = $this->TenNhanVien;
                $nhanvien->DiaChi = $this->DiaChi;
                $nhanvien->GioiTinh = $this->GioiTinh;
                $nhanvien->SDT = $this->SDT;
                $nhanvien->CCCD = $this->CCCD;
                $nhanvien->MaPhongBan = $this->MaPhongBan;
                $nhanvien->Anh = $this->Anh;
                $nhanvien->TrangThai = $this->TrangThai;
                $nhanvien->save();
                
                $this->closeModal();
                session()->flash('success', 'Nhân viên đã được cập nhật thành công');
            } else {
                session()->flash('error', 'Không tìm thấy nhân viên');
                $this->closeModal();
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
    
    public function delete()
    {
        try {
            $nhanvien = NhanVien::where('MaNhanVien', $this->MaNhanVien)->first();
            
            // Kiểm tra các ràng buộc nếu cần
            if ($nhanvien->nhapkho()->exists() || 
                $nhanvien->donvivanchuyen()->exists() || 
                $nhanvien->xuatkho()->exists() || 
                $nhanvien->phieukiemke()->exists() || 
                $nhanvien->thanhlykho()->exists()) {
                
                session()->flash('error', 'Không thể xóa Nhân viên này vì đang được sử dụng trong các bảng khác.');
                $this->closeModal();
                return;
            }
            
            $nhanvien->delete();
            $this->closeModal();
            session()->flash('success', 'Nhân viên đã được xóa thành công');
        } catch (\Exception $e) {
            $this->closeModal();
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
    
    public function render()
    {
        $nhanviens = NhanVien::query()
            ->where(function($query) {
                $query->where('TenNhanVien', 'like', "%{$this->search}%")
                    ->orWhere('MaNhanVien', 'like', "%{$this->search}%")
                    ->orWhere('SDT', 'like', "%{$this->search}%")
                    ->orWhere('CCCD', 'like', "%{$this->search}%")
                    ->orWhere('DiaChi', 'like', "%{$this->search}%");
            })
            ->orderBy('MaNhanVien', 'asc')
            ->paginate(10);

        $phongbans = PhongBan::all();

        return view('livewire.nhan-vien', [
            'nhanviens' => $nhanviens,
            'phongbans' => $phongbans
        ]);
    }

    #[On('search')]
    public function search()
    {
        $this->resetPage();
    }
}