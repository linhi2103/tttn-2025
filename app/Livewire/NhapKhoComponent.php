<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use App\Models\VatTu;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Border;
use App\Models\NhapKho;
use App\Models\DonViTinh;
use App\Models\DanhMucKho;
use App\Models\DonViVanChuyen;
use App\Models\LenhDieuDong;
use App\Models\Doitac;
use Exception;

class NhapKhoComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $search = '';

    public $isEdit = false;
    public $isAdd = false;
    public $isDelete = false;
    public $isDetail = false;

    public $MaPhieuNhap;
    public $MaKho;
    public $MaLenhDieuDong;
    public $MaDonViVanChuyen;
    public $DonViTienTe;
    public $TrangThai;
    public $MaSoThue_DoiTac;

    public $ChiTietNhapKho = [];

    public function render()
    {
        return view('livewire.nhap-kho')
            ->with([
                'nhapkhos' => NhapKho::query()
                    ->when($this->search, function($query) {
                        $query->where('MaPhieuNhap', 'like', "%{$this->search}%")
                            ->orWhere('MaKho', 'like', "%{$this->search}%")
                            ->orWhere('MaLenhDieuDong', 'like', "%{$this->search}%")
                            ->orWhere('MaSoThue_DoiTac', 'like', "%{$this->search}%");
                    })
                    ->orderBy('MaPhieuNhap', 'asc')
                    ->paginate(10),
                'vattus' => VatTu::all(),
                'danhmuckhos' => DanhMucKho::all(),
                'donvivanchuyen' => DonViVanChuyen::all(), // Fixed: changed from donViVanChuyen to donvivanchuyen
                'doitacs' => Doitac::all(),
                'lenhdieudongs' => LenhDieuDong::all()
            ]);
    }

    public function addVatTu()
    {
        $this->ChiTietNhapKho[count($this->ChiTietNhapKho)] = [
            'MaVatTu' => '',
            'TenVatTu' => '',
            'DonViTinh' => '',
            'DonGia' => 0,
            'SoLuongNhap' => 0,
            'ThanhTien' => 0
        ];
    }

    public function showModalAdd()
    {
        $this->addVatTu();
        $this->isAdd = true;
    }

    public function showModalEdit($MaPhieuNhap)
    {
        $this->MaPhieuNhap = $MaPhieuNhap;
        $nhapkho = NhapKho::where('MaPhieuNhap', $MaPhieuNhap)->first();

        if (!$nhapkho) {
            session()->flash('error', 'Không tìm thấy phiếu nhập kho');
            return;
        }

        $this->MaKho = $nhapkho->MaKho;
        $this->MaDonViVanChuyen = $nhapkho->MaDonViVanChuyen;
        $this->MaLenhDieuDong = $nhapkho->MaLenhDieuDong;
        $this->DonViTienTe = $nhapkho->DonViTienTe;
        $this->ChiTietNhapKho = json_decode($nhapkho->ChiTietNhapKho, true);
        $this->TrangThai = $nhapkho->TrangThai;
        $this->MaSoThue_DoiTac = $nhapkho->MaSoThue_DoiTac;
        Log::info($this->ChiTietNhapKho);

        $this->isEdit = true;
    }
    
    public function showModalDelete($MaPhieuNhap)
    {
        $this->isDelete = true;
        $this->MaPhieuNhap = $MaPhieuNhap;
    }

    public function showModalDetail($MaPhieuNhap)
    {
        $this->MaPhieuNhap = $MaPhieuNhap;
        $nhapkho = NhapKho::where('MaPhieuNhap', $MaPhieuNhap)->first();
        $this->ChiTietNhapKho = json_decode($nhapkho->ChiTietNhapKho, true);
        $this->isDetail = true;
    }

    public function closeModal(){
        $this->isEdit = false;
        $this->isAdd = false;
        $this->isDelete = false;
        $this->isDetail = false;
        $this->resetModal();
    }

    public function resetForm()
    {
        $this->reset([
            'MaPhieuNhap', 'MaKho', 'MaLenhDieuDong', 'MaDonViVanChuyen', 
            'DonViTienTe', 'TrangThai', 'ChiTietNhapKho', 'MaSoThue_DoiTac'
        ]);
    }

    public function resetModal()
    {
        $this->MaPhieuNhap = null;
        $this->MaKho = null;
        $this->MaLenhDieuDong = null;
        $this->MaDonViVanChuyen = null;
        $this->DonViTienTe = null;
        $this->TrangThai = null;
        $this->ChiTietNhapKho = [];
        $this->MaSoThue_DoiTac = null;
    }

    public function save()
    {
        try {
            $this->validate([
                'MaPhieuNhap' => 'required|unique:nhapkho,MaPhieuNhap',
                'MaKho' => 'required',
                'MaDonViVanChuyen' => 'required',
                'DonViTienTe' => 'required',
                'ChiTietNhapKho' => 'required|array',
                'MaLenhDieuDong' => 'required',
                'MaSoThue_DoiTac' => 'required'
            ]);
            
            NhapKho::create([
                'MaPhieuNhap' => $this->MaPhieuNhap,
                'MaKho' => $this->MaKho,
                'MaDonViVanChuyen' => $this->MaDonViVanChuyen,
                'DonViTienTe' => $this->DonViTienTe,
                'ChiTietNhapKho' => json_encode($this->ChiTietNhapKho),
                'MaLenhDieuDong' => $this->MaLenhDieuDong,
                'MaSoThue_DoiTac' => $this->MaSoThue_DoiTac,
            ]);
            
            $this->resetForm();
            $this->isAdd = false;
            session()->flash('success', 'Đã thêm phiếu nhập thành công!');
        } catch (Exception $e) {
            session()->flash('error', 'Lỗi! Vui lòng thực hiện lại. ' . $e->getMessage());
        }
    }

    public function update()
    {
        $this->validate([
            'MaKho' => 'required',
            'MaDonViVanChuyen' => 'required',
            'DonViTienTe' => 'required',
            'ChiTietNhapKho' => 'required|array',
            'MaLenhDieuDong' => 'required',
            'TrangThai' => 'required',
            'MaSoThue_DoiTac' => 'required'
        ]);

        $nhapkho = NhapKho::where('MaPhieuNhap', $this->MaPhieuNhap)->first();

        if(!$nhapkho){
            session()->flash('error', 'Không tìm thấy phiếu nhập kho!');
            return;
        }

        if ($this->TrangThai == 'Đã duyệt') {
            foreach ($this->ChiTietNhapKho as $value) {
                $vattu = VatTu::where('MaVatTu', $value['MaVatTu'])->first();
                if ($vattu) {
                    // Chuyển đổi SoLuongNhap từ chuỗi sang số nguyên để tránh lỗi kiểu dữ liệu
                    $soLuongNhap = (int) ($value['SoLuongNhap'] ?? 0);
                    
                    $vattu->update([
                        'SoLuongTon' => $vattu->SoLuongTon + $soLuongNhap
                    ]);
                }
            }
        }
        
        $nhapkho->update([
            'MaKho' => $this->MaKho,
            'MaDonViVanChuyen' => $this->MaDonViVanChuyen,
            'DonViTienTe' => $this->DonViTienTe,
            'ChiTietNhapKho' => json_encode($this->ChiTietNhapKho),
            'MaLenhDieuDong' => $this->MaLenhDieuDong,
            'TrangThai' => $this->TrangThai,
            'MaSoThue_DoiTac' => $this->MaSoThue_DoiTac,
        ]);
        
        $this->resetForm();
        $this->isEdit = false;
        session()->flash('success', 'Đã cập nhật phiếu nhập thành công!');
        Log::info($this->ChiTietNhapKho);
    }

    public function delete()
    {
        try {
            $phieunhap = NhapKho::where('MaPhieuNhap', $this->MaPhieuNhap)->first();
            if (!$phieunhap) {
                session()->flash('error', 'Không tìm thấy phiếu nhập kho này!');
                return;
            }

            $phieunhap->delete();

            $this->resetForm();
            $this->isDelete = false;
            session()->flash('success', 'Phiếu nhập kho đã được hủy thành công!');
        } catch (\Exception $e) {
            session()->flash('error', 'Lỗi! Vui lòng thực hiện lại.' . $e->getMessage());
            $this->closeModal();
        }
    }

    public function removeVatTu($index)
    {
        unset($this->ChiTietNhapKho[$index]);
        $this->ChiTietNhapKho = array_values($this->ChiTietNhapKho);
        foreach($this->ChiTietNhapKho as $key => $value){
            $key++;
        }
    }

    public function updatedChiTietNhapKho($value, $key)
    {
        $index = intval(explode('.', $key)[0]);
        $field = explode('.', $key)[1];

        if($field == 'MaVatTu'){
            $vatTu = VatTu::where('MaVatTu', $value)->first();
            if (!$vatTu) {
                session()->flash('error', 'Không tìm thấy vật tư!');
                return;
            }
            
            // Cập nhật thông tin vật tư
            $this->ChiTietNhapKho[$index]['TenVatTu'] = $vatTu->TenVatTu;
            $this->ChiTietNhapKho[$index]['DonViTinh'] = $vatTu->donvitinh->TenDonViTinh;
            $this->ChiTietNhapKho[$index]['DonGia'] = $vatTu->GiaNhap;
            
            // Tính lại thành tiền nếu đã có số lượng
            $soLuong = (int) ($this->ChiTietNhapKho[$index]['SoLuongNhap'] ?? 0);
            $this->ChiTietNhapKho[$index]['ThanhTien'] = $soLuong * $vatTu->GiaNhap;
        }

        if($field == 'SoLuongNhap'){
            // Chuyển đổi giá trị thành số nguyên
            $soLuong = (int) ($value ?? 0);
            $this->ChiTietNhapKho[$index]['SoLuongNhap'] = $soLuong;
            
            // Lấy thông tin vật tư để tính thành tiền
            $maVatTu = $this->ChiTietNhapKho[$index]['MaVatTu'] ?? '';
            if (!empty($maVatTu)) {
                $vatTu = VatTu::where('MaVatTu', $maVatTu)->first();
                if ($vatTu) {
                    $donGia = $vatTu->GiaNhap;
                    $this->ChiTietNhapKho[$index]['DonGia'] = $donGia;
                    $this->ChiTietNhapKho[$index]['ThanhTien'] = $soLuong * $donGia;
                }
            }
        }
    }

    public function getTongThanhTien()
    {
        $tong = 0;
        foreach ($this->ChiTietNhapKho as $item) {
            $tong += (float) ($item['ThanhTien'] ?? 0);
        }
        return $tong;
    }

    public function exportExcel()
    {
        try {
            $phieunhap = NhapKho::where('MaPhieuNhap', $this->MaPhieuNhap)->first();
                
            if (!$phieunhap) {
                throw new \Exception('Không tìm thấy phiếu nhập');
            }

            $templatePath = public_path('/bieumau/phieunhap.xlsx');
            if (!file_exists($templatePath)) {
                throw new \Exception('Không tìm thấy file mẫu');
            }

            $spreadsheet = IOFactory::load($templatePath);
            $sheet = $spreadsheet->getActiveSheet();

            $sheet->setCellValue('K4', 'Số (No.): ' . $phieunhap->MaPhieuNhap);
            $sheet->setCellValue('F9', $phieunhap->MaKho ?? '');
            $sheet->setCellValue('E10', $phieunhap->danhmuckhos->TenDanhMucKho ?? '');
            $sheet->setCellValue('F10', $phieunhap->lenhdieudong->MaLenhDieuDong ?? '');
            $sheet->setCellValue('F12', $phieunhap->donViVanChuyen->TenDonViVanChuyen ?? ''); 
            $sheet->setCellValue('E14', $phieunhap->MaSoThue_DoiTac ?? '');
            $sheet->setCellValue('F13', $phieunhap->DoiTac->TenDoiTac ?? '');
            $sheet->setCellValue('D15', $phieunhap->DoiTac->DiaChi ?? '');
            $sheet->setCellValue('E16', $phieunhap->DonViTienTe ?? '');
            
            $row = 19;
            $stt = 1;
            $chiTiet = json_decode($phieunhap->ChiTietNhapKho, true);
            
            foreach ($chiTiet as $item) {
                $sheet->insertNewRowBefore($row, 1);
                
                $sheet->setCellValue('C' . $row, $stt);
                $sheet->setCellValue('D' . $row, $item['TenVatTu'] ?? '');
                $sheet->setCellValue('E' . $row, $item['MaVatTu'] ?? '');
                $sheet->setCellValue('F' . $row, $item['DonViTinh'] ?? '');
                $sheet->setCellValue('G' . $row, $item['SoLuongNhap'] ?? '');
                $sheet->setCellValue('H' . $row, $item['DonGia'] ?? '');
                $sheet->setCellValue('I' . $row, $item['ThanhTien'] ?? '');
                
                $style = $sheet->getStyle('C' . $row . ':I' . $row);
                $style->getFont()->setBold(false);
                $style->getAlignment()->setHorizontal('center');
                $style->getAlignment()->setVertical('center');
                
                $row++;
                $stt++;
            }

            $totalRow = $row;
            $sheet->setCellValue('C' . $totalRow, 'Tổng');
            $sheet->setCellValue('G' . $totalRow, '=SUM(G19:G' . ($row - 1) . ')');
            $sheet->setCellValue('I' . $totalRow, '=SUM(I19:I' . ($row - 1) . ')');
            
            $totalStyle = $sheet->getStyle('C' . $totalRow . ':I' . $totalRow);
            $totalStyle->getAlignment()->setHorizontal('center');
            $totalStyle->getAlignment()->setVertical('center');

            $directory = storage_path('app/public/exports');
            if (!file_exists($directory)) {
                mkdir($directory, 0777, true);
            }

            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $filename = 'phieunhap_' . $this->MaPhieuNhap . '.xlsx';
            $filePath = $directory . '/' . $filename;
            $writer->save($filePath);
            
            if (file_exists($filePath)) {
                return response()->download($filePath, $filename, [
                    'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    'Content-Disposition' => 'attachment; filename="' . $filename . '"'
                ])->deleteFileAfterSend(true);
            }

            session()->flash('success', 'Xuất file thành công!');
            $this->closeModal();
            $this->resetForm();
            
        } catch (\Exception $e) {
            session()->flash('error', 'Lỗi khi xuất file: ' . $e->getMessage());
            return;
        }
    }

    #[On('search')]
    public function search()
    {
        $this->resetPage();
    }
}