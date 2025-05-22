<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\NguoiDung;
use App\Models\VaiTro;
use App\Models\NhanVien;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Hash;


class QuanLyNguoiDung extends Component
{
    use WithPagination;
    public $isAdd = false;
    public $isEdit = false;
    public $isDelete = false;

    public $userId;
    public $TaiKhoan;
    public $MatKhau;
    public $Email;
    public $MaVaiTro;
    public $MaNhanVien;
    public $TenNhanVien;
    public function render()
    {
        $users = NguoiDung::with('vaitro')->paginate(10);
        $vaitros = VaiTro::all();
        $nhanviens = NhanVien::all();
        return view('livewire.quan-ly-nguoi-dung', [
            'users' => $users,
            'vaitros' => $vaitros,
            'nhanViens' => $nhanviens,
        ]);
    }

    public function showModalAdd()
    {
        $this->isAdd = true;
        $this->isEdit = false;
        $this->isDelete = false;
    }
    public function showModalEdit($userId)
    {
        $this->isAdd = false;
        $this->isEdit = true;
        $this->isDelete = false;
        $this->userId = $userId;

        $user = NguoiDung::where('id', $userId)->first();
        if ($user) {
            $this->userId = $user->id;
            $this->TaiKhoan = $user->TaiKhoan;
            $this->MatKhau = $user->MatKhau;
            $this->Email = $user->Email;
            $this->MaVaiTro = $user->MaVaiTro;
            $this->MaNhanVien = $user->MaNhanVien;
            $this->TenNhanVien = NhanVien::where('MaNhanVien', $user->MaNhanVien)->value('TenNhanVien');
        }
    }
    public function showModalDelete($userId)
    {
        $this->isAdd = false;
        $this->isEdit = false;
        $this->isDelete = true;
        $this->userId = $userId;
    }
    public function closeModal()
    {
        $this->isAdd = false;
        $this->isEdit = false;
        $this->isDelete = false;
        $this->resetForm();
    }
    public function createUser()
    {
        $this->validate([
            'TaiKhoan' => 'required|string|max:20',
            'MatKhau' => 'required|string|min:6',
            'Email' => 'nullable|email|max:100',
            'MaNhanVien' => 'required|exists:nhanvien,MaNhanVien',
            'MaVaiTro' => 'required|exists:vaitro,MaVaiTro',
        ]);
        NguoiDung::create([
            'TaiKhoan' => $this->TaiKhoan,
            'MatKhau' => Hash::make($this->MatKhau),
            'Email' => $this->Email,
            'MaNhanVien' => $this->MaNhanVien,
            'MaVaiTro' => $this->MaVaiTro,
        ]);
        session()->flash('success', 'User created successfully.');
        $this->closeModal();
    }
    public function updateUser()
    {
        $this->validate([
            'TaiKhoan' => 'required|string|max:20',
            'MatKhau' => 'nullable|string|min:6',
            'Email' => 'nullable|email|max:100',
            'MaNhanVien' => 'required|exists:nhanvien,MaNhanVien',
            'MaVaiTro' => 'required|exists:vaitro,MaVaiTro',
        ]);
        $user = NguoiDung::where('id', $this->userId)->first();
        if ($user) {
            $user->TaiKhoan = $this->TaiKhoan;
            if ($this->MatKhau) {
                $user->MatKhau = Hash::make($this->MatKhau);
            }
            $user->Email = $this->Email;
            $user->MaNhanVien = $this->MaNhanVien;
            $user->MaVaiTro = $this->MaVaiTro;
            $user->save();
            session()->flash('success', 'User updated successfully.');
        }else {
            session()->flash('error', 'User not found.');
        }
        
        $this->closeModal();
    }
    public function deleteUser($userId)
    {
        $this->validate([
            'userId' => 'required|exists:nguoidung,id',
        ]);
        $user = NguoiDung::find($userId);
        if ($user) {
            $user->delete();
        }
        session()->flash('success', 'User deleted successfully.');
        $this->closeModal();
    }
    public function resetForm()
    {
        $this->TaiKhoan = '';
        $this->MatKhau = '';
        $this->Email = '';
        $this->MaVaiTro = '';
        $this->MaNhanVien = '';
        $this->TenNhanVien = '';
    }  

    #[On('MaNhanVien')]
    public function updatedMaNhanVien($value)
    {
        $this->MaNhanVien = $value;
        $this->TenNhanVien = NhanVien::where('MaNhanVien', $value)->value('TenNhanVien');
    }
}