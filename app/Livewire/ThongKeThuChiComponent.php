<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use App\Models\ThongKeThuChi;
use App\Models\VatTu;
use App\Models\DanhMucKho;
use App\Models\NhanVien;
use App\Models\DonViVanChuyen;
use App\Models\LenhDieuDong;
use App\Models\Doitac;

class ThongKeThuChiComponent extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $search = '';
    public $vattus = [];
    public $danhmuckhos = [];
    public $nhanViens = [];
    public $donViVanChuyens = [];
    public $lenhDieuDongs = [];
    public $doiTacs = [];

    public function mount()
    {
        $this->vattus = VatTu::all();
        $this->danhmuckhos = DanhMucKho::all();
        $this->nhanViens = NhanVien::all();
        $this->donViVanChuyens = DonViVanChuyen::all();
        $this->lenhDieuDongs = LenhDieuDong::all();
        $this->doiTacs = Doitac::all();
    }

    public $MaThongKeThuChi;
    public $NgayThongKe;
    public $Tungay;
    public $Denngay;
    public $MaVatTu;
    public $MaKho;
    public $DonGia;
    public $MaNhanVien;
    public $DonViTienTe;
    public $TongThu;
    public $TongChi;
    public $ChenhLechThuChi;
    public $TrangThai;
    public $NgayTao;
    public $GhiChu;

    public $isEdit = false;
    public $isAdd = false;
    public $isDelete = false;

    public function showModalAdd()
    {
        $this->isAdd = true;
    }

    public function showModalEdit($MaThongKeThuChi)
    {
        $this->MaThongKeThuChi = $MaThongKeThuChi;
        $thongketuchis = ThongKeThuChi::where('MaThongKeThuChi', $MaThongKeThuChi)->first();
        $this->MaVatTu = $thongketuchis->MaVatTu;
        $this->MaKho = $thongketuchis->MaKho;
        $this->MaNhanVien = $thongketuchis->MaNhanVien;
        $this->NgayXuat = $thongketuchis->NgayXuat;
        $this->DonGia = $thongketuchis->DonGia;
        $this->TongThu = $thongketuchis->TongThu;
        $this->TongChi = $thongketuchis->TongChi;
        $this->ChenhLechThuChi = $thongketuchis->ChenhLechThuChi;
        $this->TrangThai = $thongketuchis->TrangThai;
        $this->NgayTao = $thongketuchis->NgayTao;
        $this->GhiChu = $thongketuchis->GhiChu;
        $this->isEdit = true;
    }
    public function showModalDelete($MaThongKeThuChi)
    {
        $this->isDelete = true;
        $this->MaThongKeThuChi = $MaThongKeThuChi;
    }
    public function closeModal(){
        $this->isEdit = false;
        $this->isAdd = false;
        $this->isDelete = false;
        $this->resetModal();
    }
    public function resetModal(){
        $this->MaThongKeThuChi = null;
        $this->MaVatTu = null;
        $this->MaKho = null;
        $this->MaNhanVien = null;
        $this->NgayXuat = null;
        $this->DonGia = null;
        $this->TongThu = null;
        $this->TongChi = null;
        $this->ChenhLechThuChi = null;
        $this->TrangThai = null;
        $this->NgayTao = null;
        $this->GhiChu = null;
    }
    public function resetForm()
    {
        $this->MaThongKeThuChi = null;
        $this->MaVatTu = null;
        $this->MaKho = null;
        $this->MaNhanVien = null;
        $this->NgayXuat = null;
        $this->DonGia = null;
        $this->TongThu = null;
        $this->TongChi = null;
        $this->ChenhLechThuChi = null;
        $this->TrangThai = null;
        $this->NgayTao = null;
        $this->GhiChu = null;
    }
    public function save()
    {
        $this->validate([
            'MaVatTu' => 'required',
            'MaKho' => 'required',
            'MaNhanVien' => 'required',
            'NgayXuat' => 'required',
            'DonGia' => 'required|numeric',
            'TongThu' => 'required|numeric',
            'TongChi' => 'required|numeric',
            'ChenhLechThuChi' => 'required|numeric',
            'TrangThai' => 'required',
            'NgayTao' => 'required',
            'GhiChu' => 'nullable'
        ]);
        
        $thongketuchis = new ThongKeThuChi();
        $thongketuchis->MaThongKeThuChi = $this->MaThongKeThuChi;
        $thongketuchis->MaVatTu = $this->MaVatTu;
        $thongketuchis->MaKho = $this->MaKho;
        $thongketuchis->MaNhanVien = $this->MaNhanVien;
        $thongketuchis->NgayXuat = $this->NgayXuat;
        $thongketuchis->DonGia = $this->DonGia;
        $thongketuchis->TongThu = $this->TongThu;
        $thongketuchis->TongChi = $this->TongChi;
        $thongketuchis->ChenhLechThuChi = $this->ChenhLechThuChi;
        $thongketuchis->TrangThai = $this->TrangThai;
        $thongketuchis->NgayTao = $this->NgayTao;
        $thongketuchis->GhiChu = $this->GhiChu;
        
        $thongketuchis->save();
        
        $this->resetForm();
        $this->isAdd = false;
        
        session()->flash('success', 'Thống kê thu chi đã được tạo thành công!');
    }
    public function update()
    {
        $this->validate([
            'MaVatTu' => 'required',
            'MaKho' => 'required',
            'MaNhanVien' => 'required',
            'NgayXuat' => 'required',
            'DonGia' => 'required|numeric',
            'TongThu' => 'required|numeric',
            'TongChi' => 'required|numeric',
            'ChenhLechThuChi' => 'required|numeric',
            'TrangThai' => 'required',
            'NgayTao' => 'required',
            'GhiChu' => 'nullable'
        ]);
        
        $thongketuchis = ThongKeThuChi::where('MaThongKeThuChi', $this->MaThongKeThuChi)->first();
        $thongketuchis->MaVatTu = $this->MaVatTu;
        $thongketuchis->MaKho = $this->MaKho;
        $thongketuchis->MaNhanVien = $this->MaNhanVien;
        $thongketuchis->NgayXuat = $this->NgayXuat;
        $thongketuchis->DonGia = $this->DonGia;
        $thongketuchis->TongThu = $this->TongThu;
        $thongketuchis->TongChi = $this->TongChi;
        $thongketuchis->ChenhLechThuChi = $this->ChenhLechThuChi;
        $thongketuchis->TrangThai = $this->TrangThai;
        $thongketuchis->NgayTao = $this->NgayTao;
        $thongketuchis->GhiChu = $this->GhiChu;
        
        $thongketuchis->save();
        
        $this->resetForm();
        $this->isEdit = false;
        
        session()->flash('success', 'Thống kê thu chi đã được cập nhật thành công!');
    }
    public function delete(){
        try {
            $thongketuchis = ThongKeThuChi::where('MaThongKeThuChi', $this->MaThongKeThuChi)->first();
            
            if ($thongketuchis->vattu()->exists()) {
                session()->flash('error', 'Không thể xóa Thống kê Thu Chi này vì nó đang được sử dụng trong các Vật Tư.');
                $this->closeModal();
                return;
            }
            
            $thongketuchis->delete();
            $this->closeModal();
            session()->flash('success', 'Thống kê thu chi đã được xóa thành công');
        } catch (\Exception $e) {
            $this->closeModal();
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
    public function render()
    {
        $thongketuchis = ThongKeThuChi::query()
            ->where('MaThongKeThuChi', 'like', "%{$this->search}%")
            ->orWhere('MaKho', 'like', "%{$this->search}%")
            ->orWhere('MaVatTu', 'like', "%{$this->search}%")
            ->orWhere('MaNhanVien', 'like', "%{$this->search}%")
            ->orderBy('NgayTao', 'desc')
            ->paginate(10);
        
        return view('livewire.thong-ke-thu-chi', [
            'thongketuchis' => $thongketuchis
        ]);
    }

    #[On('search')]
    public function search()
    {
        $this->resetPage();
    }
}
