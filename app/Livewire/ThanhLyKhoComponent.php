<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use App\Models\VatTu;
use App\Models\DanhMucKho;
use App\Models\NhanVien;
use App\Models\LenhDieuDong;
use App\Models\ThanhLyKho;

class ThanhLyKhoComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $search = '';

    public $isEdit = false;
    public $isAdd = false;
    public $isDelete = false;

    public $MaPhieuThanhLy;
    public $MaVatTu;
    public $MaKho;
    public $MaNhanVien;
    public $SoLuong;
    public $NgayLap;
    public $TrangThai;
    public $DonGia;
    public $LyDoThanhLy;
    public $BienPhapThanhLy;
    public $MaLenhDieuDong;
    
    public function render()
    {
        return view('livewire.thanh-ly-kho')
        ->with([
            'phieuthanhlys' => ThanhLyKho::query()
            ->where(function($query) {
                $query->where('MaPhieuThanhLy', 'like', "%{$this->search}%")
                    ->orWhere('MaVatTu', 'like', "%{$this->search}%")
                    ->orWhere('MaKho', 'like', "%{$this->search}%")
                    ->orWhere('MaNhanVien', 'like', "%{$this->search}%")
                    ->orWhere('MaLenhDieuDong', 'like', "%{$this->search}%");
            })
            ->orderBy('MaPhieuThanhLy', 'asc')
            ->paginate(10),
            'vattus' => VatTu::all(),
            'danhmuckhos' => DanhMucKho::all(),
            'nhanViens' => NhanVien::all(),
            'lenhDieuDongs' => LenhDieuDong::all()
        ]);
    }

    public function showModalAdd()
    {
        $this->NgayLap = now()->format('Y-m-d');
        $this->TrangThai = 'Chờ duyệt';
        $this->isAdd = true;
    }

    public function showModalEdit($MaPhieuThanhLy)
    {
        $this->MaPhieuThanhLy = $MaPhieuThanhLy;
        $phieuthanhly = ThanhLyKho::where('MaPhieuThanhLy', $MaPhieuThanhLy)
            ->with([
                'vattu',
                'nhanVien',
                'lenhDieuDong',
                'kho'
            ])
            ->first();
        if (!$phieuthanhly) {
            session()->flash('error', 'Không tìm thấy phiếu thanh lý');
            return;
        }

        $this->MaVatTu = $phieuthanhly->MaVatTu;
        $this->MaKho = $phieuthanhly->MaKho;
        $this->MaNhanVien = $phieuthanhly->MaNhanVien;
        $this->NgayLap = $phieuthanhly->NgayLap;
        $this->TrangThai = $phieuthanhly->TrangThai;
        $this->MaLenhDieuDong = $phieuthanhly->MaLenhDieuDong;
        $this->SoLuong = $phieuthanhly->SoLuong;
        $this->DonGia = $phieuthanhly->DonGia;
        $this->LyDoThanhLy = $phieuthanhly->LyDoThanhLy;
        $this->BienPhapThanhLy = $phieuthanhly->BienPhapThanhLy;

        $this->isEdit = true;
    }

    public function showModalDelete($MaPhieuThanhLy)
    {
        $this->isDelete = true;
        $this->MaPhieuThanhLy = $MaPhieuThanhLy;
    }
    public function closeModal(){
        $this->isEdit = false;
        $this->isAdd = false;
        $this->isDelete = false;
        $this->resetModal();
    }

    public function resetForm()
    {
        $this->reset([
            'MaPhieuThanhLy', 'MaVatTu', 'MaKho', 'MaNhanVien',
            'NgayLap', 'TrangThai', 'MaLenhDieuDong', 'SoLuong',
            'DonGia', 'LyDoThanhLy', 'BienPhapThanhLy'
        ]);
    }

    public function resetModal(){
        $this->MaPhieuThanhLy = null;
        $this->MaVatTu = null;
        $this->MaKho = null;
        $this->MaNhanVien = null;
        $this->NgayLap = null;
        $this->TrangThai = null;
        $this->MaLenhDieuDong = null;
        $this->SoLuong = null;
        $this->DonGia = null;
        $this->LyDoThanhLy = null;
        $this->BienPhapThanhLy = null;
    }

    public function save()
    {
        $this->validate([
            'MaPhieuThanhLy' => 'required|unique:thanh-ly-kho,MaPhieuThanhLy',
            'MaVatTu' => 'required',
            'MaKho' => 'required',
            'MaNhanVien' => 'required',
            'NgayLap' => 'required',
            'TrangThai' => 'required',
            'SoLuong' => 'required|integer|min:1',
            'DonGia' => 'required|numeric|min:0',
            'LyDoThanhLy' => 'required',
            'BienPhapThanhLy' => 'required'
        ]);

        $vatTu = VatTu::where('MaVatTu', $this->MaVatTu)->first();
        if (!$vatTu) {
            session()->flash('error', 'Vật tư không tồn tại!');
            return;
        }

        if ($this->TrangThai === 'Đã Thanh Lý') {
            if ($vatTu->SoLuongTon < $this->SoLuong) {
                session()->flash('error', 'Số lượng tồn kho không đủ!');
                return;
            }
            $vatTu->decrement('SoLuongTon', $this->SoLuong);
        }

        ThanhLyKho::create([
            'MaPhieuThanhLy' => $this->MaPhieuThanhLy,
            'MaVatTu' => $this->MaVatTu,
            'MaKho' => $this->MaKho,
            'MaNhanVien' => $this->MaNhanVien,
            'NgayLap' => $this->NgayLap,
            'TrangThai' => $this->TrangThai,
            'MaLenhDieuDong' => $this->MaLenhDieuDong,
            'SoLuong' => $this->SoLuong,
            'DonGia' => $this->DonGia,
            'LyDoThanhLy' => $this->LyDoThanhLy,
            'BienPhapThanhLy' => $this->BienPhapThanhLy
        ]);

        $this->resetForm();
        $this->isAdd = false;
        session()->flash('success', 'Thanh lý kho đã được tạo thành công!');
    }


    public function update()
    {
        $this->validate([
            'MaPhieuThanhLy' => 'required',
            'MaVatTu' => 'required',
            'MaKho' => 'required',
            'MaNhanVien' => 'required',
            'NgayLap' => 'required',
            'TrangThai' => 'required',
            'SoLuong' => 'required|integer|min:1',
            'DonGia' => 'required|numeric|min:0',
            'LyDoThanhLy' => 'required',
            'BienPhapThanhLy' => 'required'
        ]);

        $phieuthanhly = ThanhLyKho::where('MaPhieuThanhLy', $this->MaPhieuThanhLy)->first();
        if (!$phieuthanhly) {
            session()->flash('error', 'Không tìm thấy phiếu thanh lý này!');
            return;
        }

        $oldTrangThai = $phieuthanhly->TrangThai;
        $oldSoLuong = $phieuthanhly->SoLuong;

        // Nếu vật tư bị thay đổi
        if ($this->MaVatTu !== $phieuthanhly->MaVatTu) {
            $oldVatTu = VatTu::where('MaVatTu', $phieuthanhly->MaVatTu)->first();
            $newVatTu = VatTu::where('MaVatTu', $this->MaVatTu)->first();

            if (!$oldVatTu || !$newVatTu) {
                session()->flash('error', 'Vật tư không tồn tại!');
                return;
            }

            if ($oldTrangThai === 'Đã Thanh Lý') {
                $oldVatTu->increment('SoLuongTon', $oldSoLuong);
            }

            if ($this->TrangThai === 'Đã Thanh Lý') {
                if ($newVatTu->SoLuongTon < $this->SoLuong) {
                    session()->flash('error', 'Số lượng tồn kho không đủ!');
                    return;
                }
                $newVatTu->decrement('SoLuongTon', $this->SoLuong);
            }

        } else {
            $vatTu = VatTu::where('MaVatTu', $this->MaVatTu)->first();
            if (!$vatTu) {
                session()->flash('error', 'Vật tư không tồn tại!');
                return;
            }

            if ($oldTrangThai === 'Đã Thanh Lý') {
                $vatTu->increment('SoLuongTon', $oldSoLuong);
            }

            if ($this->TrangThai === 'Đã Thanh Lý') {
                if ($vatTu->SoLuongTon < $this->SoLuong) {
                    session()->flash('error', 'Số lượng tồn kho không đủ!');
                    return;
                }
                $vatTu->decrement('SoLuongTon', $this->SoLuong);
            }
        }

        $phieuthanhly->update([
            'MaVatTu' => $this->MaVatTu,
            'MaKho' => $this->MaKho,
            'MaNhanVien' => $this->MaNhanVien,
            'NgayLap' => $this->NgayLap,
            'TrangThai' => $this->TrangThai,
            'MaLenhDieuDong' => $this->MaLenhDieuDong,
            'SoLuong' => $this->SoLuong,
            'DonGia' => $this->DonGia,
            'LyDoThanhLy' => $this->LyDoThanhLy,
            'BienPhapThanhLy' => $this->BienPhapThanhLy
        ]);

        $this->resetForm();
        $this->isEdit = false;
        session()->flash('success', 'Thanh lý kho đã được cập nhật thành công!');
    }

    public function delete(){
        try {
            $phieuthanhly = ThanhLyKho::where('MaPhieuThanhLy', $this->MaPhieuThanhLy)->first();
            
            if (!$phieuthanhly) {
                throw new \Exception('Không tìm thấy phiếu thanh lý!');
            }
            
            $phieuthanhly->delete();
            $this->closeModal();
            session()->flash('success', 'Thanh lý kho đã được xóa thành công');
        } catch (\Exception $e) {
            $this->closeModal();
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
}