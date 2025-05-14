<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use App\Models\PhieuKiemKe;
use App\Models\VatTu;
use App\Models\DanhMucKho;
use App\Models\NhanVien;
use App\Models\LenhDieuDong;


class PhieuKiemKeComponent extends Component
{
    use WithPagination;

    public $search = '';

    public $isEdit = false;
    public $isAdd = false;
    public $isDelete = false;

    public $MaPhieuKiemKe;
    public $MaVatTu;
    public $MaKho;
    public $MaNhanVien;
    public $MaLenhDieuDong;
    public $NgayKiemKe;
    public $TrangThai;
    public $SoLuongThucTe;
    public $SoLuongTon;
    public $TinhTrang;
    public $GhiChu;

    public function render()
    {
        return view('livewire.phieu-kiem-ke', [
            'phieukiemkes' => PhieuKiemKe::query()
                ->where(function ($query) {
                    $query->where('MaPhieuKiemKe', 'like', "%{$this->search}%")
                        ->orWhere('MaVatTu', 'like', "%{$this->search}%")
                        ->orWhere('MaKho', 'like', "%{$this->search}%")
                        ->orWhere('MaNhanVien', 'like', "%{$this->search}%")
                        ->orWhere('MaLenhDieuDong', 'like', "%{$this->search}%");
                })
                ->orderBy('MaPhieuKiemKe', 'asc')
                ->paginate(10),
            'vattus' => VatTu::all(),
            'danhmuckhos' => DanhMucKho::all(),
            'nhanViens' => NhanVien::all(),
            'lenhDieuDongs' => LenhDieuDong::all()
        ]);
    }

    public function showModalAdd()
    {
        $this->NgayKiemKe = now()->format('Y-m-d');
        $this->TrangThai = 'Chờ duyệt';
        $this->isAdd = true;
    }

    public function showModalEdit($MaPhieuKiemKe)
    {
        $phieukiemke = PhieuKiemKe::with(['vattu', 'kho', 'nhanVien', 'lenhDieuDong'])
            ->where('MaPhieuKiemKe', $MaPhieuKiemKe)
            ->first();

        if (!$phieukiemke) {
            session()->flash('error', 'Không tìm thấy phiếu kiểm kê');
            return;
        }

        $this->MaPhieuKiemKe = $phieukiemke->MaPhieuKiemKe;
        $this->MaVatTu = $phieukiemke->MaVatTu;
        $this->MaKho = $phieukiemke->MaKho;
        $this->MaNhanVien = $phieukiemke->MaNhanVien;
        $this->NgayKiemKe = $phieukiemke->NgayKiemKe;
        $this->TrangThai = $phieukiemke->TrangThai;
        $this->MaLenhDieuDong = $phieukiemke->MaLenhDieuDong;
        $this->SoLuongThucTe = $phieukiemke->SoLuongThucTe;
        $this->SoLuongTon = $phieukiemke->vatTu->SoLuongTon;
        $this->TinhTrang = $phieukiemke->TinhTrang;
        $this->GhiChu = $phieukiemke->GhiChu;

        $this->isEdit = true;
    }

    public function showModalDelete($MaPhieuKiemKe)
    {
        $this->isDelete = true;
        $this->MaPhieuKiemKe = $MaPhieuKiemKe;
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
        $this->reset([
            'MaPhieuKiemKe', 'MaVatTu', 'MaKho', 'MaNhanVien', 'NgayKiemKe',
            'TrangThai', 'MaLenhDieuDong',
            'SoLuongThucTe', 'SoLuongTon', 'TinhTrang', 'GhiChu'
        ]);
    }

    public function save()
    {
        $this->validate([
            'MaPhieuKiemKe' => 'required|unique:phieu_kiem_ke,MaPhieuKiemKe',
            'MaVatTu' => 'required',
            'MaKho' => 'required',
            'MaNhanVien' => 'required',
            'NgayKiemKe' => 'required',
            'TrangThai' => 'required',
            'MaLenhDieuDong' => 'required',
            'SoLuongThucTe' => 'required|integer|min:0',
            'SoLuongTon' => 'required|integer|min:0',
            'TinhTrang' => 'required',
            'GhiChu' => 'nullable'
        ]);

        $vatTu = VatTu::where('MaVatTu', $this->MaVatTu)->first();
        if (!$vatTu) {
            session()->flash('error', 'Vật tư không tồn tại!');
            return;
        }

        if ($this->TrangThai === 'Đã Kiểm Kê') {
            if ($vatTu->SoLuongTon < $this->SoLuongThucTe) {
                session()->flash('error', 'Số lượng tồn kho không đủ!');
                return;
            }
            $vatTu->decrement('SoLuongTon', $this->SoLuongThucTe);
        }

        PhieuKiemKe::create([
            'MaPhieuKiemKe' => $this->MaPhieuKiemKe,
            'MaVatTu' => $this->MaVatTu,
            'MaKho' => $this->MaKho,
            'MaNhanVien' => $this->MaNhanVien,
            'NgayKiemKe' => $this->NgayKiemKe,
            'TrangThai' => $this->TrangThai,
            'MaLenhDieuDong' => $this->MaLenhDieuDong,
            'SoLuongThucTe' => $this->SoLuongThucTe,
            'SoLuongTon' => $this->SoLuongTon,
            'TinhTrang' => $this->TinhTrang,
            'GhiChu' => $this->GhiChu
        ]);

        $this->closeModal();
        session()->flash('success', 'Phiếu kiểm kê đã được tạo thành công!');
    }

    public function update()
    {
        $this->validate([
            'MaVatTu' => 'required',
            'MaKho' => 'required',
            'MaNhanVien' => 'required',
            'NgayKiemKe' => 'required',
            'TrangThai' => 'required',
            'MaLenhDieuDong' => 'required',
            'SoLuongThucTe' => 'required|integer|min:0',
            'SoLuongTon' => 'required|integer|min:0',
            'TinhTrang' => 'required',
            'GhiChu' => 'nullable'
        ]);

        $phieukiemke = PhieuKiemKe::where('MaPhieuKiemKe', $this->MaPhieuKiemKe)->first();
        if (!$phieukiemke) {
            session()->flash('error', 'Không tìm thấy phiếu kiểm kê!');
            return;
        }

        $vatTu = VatTu::where('MaVatTu', $this->MaVatTu)->first();
        if (!$vatTu) {
            session()->flash('error', 'Vật tư không tồn tại!');
            return;
        }

        $oldTrangThai = $phieukiemke->TrangThai;
        $oldSoLuongThucTe = $phieukiemke->SoLuongThucTe;

        if ($oldTrangThai !== $this->TrangThai) {
            if ($this->TrangThai === 'Đã Kiểm Kê') {
                if ($vatTu->SoLuongTon < $this->SoLuongThucTe) {
                    session()->flash('error', 'Số lượng tồn kho không đủ!');
                    return;
                }
                $vatTu->decrement('SoLuongTon', $this->SoLuongThucTe);
            }

            if ($oldTrangThai === 'Đã Kiểm Kê') {
                $vatTu->increment('SoLuongTon', $oldSoLuongThucTe);
            }
        } else {
            if ($this->TrangThai === 'Đã Kiểm Kê') {
                $diff = $this->SoLuongThucTe - $oldSoLuongThucTe;
                if ($diff > 0) {
                    if ($vatTu->SoLuongTon < $diff) {
                        session()->flash('error', 'Số lượng tồn kho không đủ để cập nhật!');
                        return;
                    }
                    $vatTu->decrement('SoLuongTon', $diff);
                } elseif ($diff < 0) {
                    $vatTu->increment('SoLuongTon', abs($diff));
                }
            }
        }

        $phieukiemke->update([
            'MaVatTu' => $this->MaVatTu,
            'MaKho' => $this->MaKho,
            'MaNhanVien' => $this->MaNhanVien,
            'NgayKiemKe' => $this->NgayKiemKe,
            'TrangThai' => $this->TrangThai,
            'MaLenhDieuDong' => $this->MaLenhDieuDong,
            'SoLuongThucTe' => $this->SoLuongThucTe,
            'SoLuongTon' => $this->SoLuongTon,
            'TinhTrang' => $this->TinhTrang,
            'GhiChu' => $this->GhiChu
        ]);

        $this->closeModal();
        session()->flash('success', 'Phiếu kiểm kê đã được cập nhật thành công!');
    }

    public function delete()
    {
        try {
            $phieukiemke = PhieuKiemKe::where('MaPhieuKiemKe', $this->MaPhieuKiemKe)->first();

            if (!$phieukiemke) {
                throw new \Exception('Không tìm thấy phiếu kiểm kê!');
            }

            if ($phieukiemke->TrangThai === 'Đã Kiểm Kê') {
                $vatTu = VatTu::where('MaVatTu', $phieukiemke->MaVatTu)->first();
                if ($vatTu) {
                    $vatTu->increment('SoLuongTon', $phieukiemke->SoLuongThucTe);
                }
            }

            $phieukiemke->delete();
            $this->closeModal();
            session()->flash('success', 'Phiếu kiểm kê đã được xóa thành công!');
        } catch (\Exception $e) {
            $this->closeModal();
            session()->flash('error', 'Lỗi: ' . $e->getMessage());
        }
    }

    #[On('MaVatTu')]
    public function updatedMaVatTu($value){
        $vatTu = VatTu::where('MaVatTu', $value)->first();
        if($vatTu){
            $this->SoLuongTon = $vatTu->SoLuongTon;
        }else{
            $this->SoLuongTon = null;
        }
    }
}
