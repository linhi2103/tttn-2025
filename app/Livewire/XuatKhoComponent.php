<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use App\Models\VatTu;
use App\Models\XuatKho;
use App\Models\DonViTinh;
use App\Models\DanhMucKho;
use App\Models\DonViVanChuyen;
use App\Models\LenhDieuDong;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Border;

class XuatKhoComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $search = '';

    public $isEdit = false;
    public $isAdd = false;
    public $isDelete = false;
    public $isDetail = false;

    public $MaPhieuXuat;
    public $MaKho;
    public $MaLenhDieuDong;
    public $MaDonViVanChuyen;
    public $DiaDiemXuat;
    public $DonViTienTe;
    public $TrangThai;

    public $ChiTietXuatKho = [];

    public function render()
    {
        return view('livewire.xuat-kho')
        ->with([
            'xuatkhos' => XuatKho::query()
            ->when($this->search, function($query) {
                $query->where('MaPhieuXuat', 'like', "%{$this->search}%")
                    ->orWhere('MaVatTu', 'like', "%{$this->search}%")
                    ->orWhere('MaKho', 'like', "%{$this->search}%")
                    ->orWhere('MaLenhDieuDong', 'like', "%{$this->search}%");
            })
            ->orderBy('MaPhieuXuat', 'asc')
            ->paginate(10),
            'vattus' => VatTu::all(),
            'danhmuckhos' => DanhMucKho::all(),
            'donViVanChuyen' => DonViVanChuyen::all(),
            'lenhdieudongs' => LenhDieuDong::all()
        ]);
    }

    public function addVatTu()
    {
        $this->ChiTietXuatKho[] = [
            'MaVatTu' => '',
            'TenVatTu' => '',
            'DonViTinh' => '',
            'DonGia' => '',
            'SoLuongXuat' => '',
            'ThanhTien' => 0
        ];
    }

    public function showModalAdd()
    {
        $this->addVatTu();
        $this->isAdd = true;
    }

    public function showModalEdit($MaPhieuXuat)
    {
        $this->MaPhieuXuat = $MaPhieuXuat;
        $xuatkho = XuatKho::where('MaPhieuXuat', $MaPhieuXuat)
            ->with([
                'vattus',
                'donViVanChuyen',
                'lenhdieudongs',
            ])
            ->first();

        if (!$xuatkho) {
            session()->flash('error', 'Không tìm thấy phiếu xuất kho');
            return;
        }

        $this->MaKho = $xuatkho->MaKho;
        $this->MaDonViVanChuyen = $xuatkho->MaDonViVanChuyen;
        $this->MaLenhDieuDong = $xuatkho->MaLenhDieuDong;
        $this->DiaDiemXuat = $xuatkho->DiaDiemXuat;
        $this->DonViTienTe = $xuatkho->DonViTienTe;
        $this->ChiTietXuatKho = json_decode($xuatkho->ChiTietXuatKho, true);
        $this->TrangThai = $xuatkho->TrangThai;
        Log::info($this->ChiTietXuatKho);

        $this->isEdit = true;
    }
    
    public function showModalDelete($MaPhieuXuat)
    {
        $this->isDelete = true;
        $this->MaPhieuXuat = $MaPhieuXuat;
    }

    public function showModalDetail($MaPhieuXuat)
    {
        $this->MaPhieuXuat = $MaPhieuXuat;
        $xuatkho = XuatKho::where('MaPhieuXuat', $MaPhieuXuat)->first();
        $this->ChiTietXuatKho = json_decode($xuatkho->ChiTietXuatKho, true);
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
            'MaPhieuXuat', 'MaKho', 'MaDonViVanChuyen', 'MaLenhDieuDong',
            'DiaDiemXuat', 'DonViTienTe', 'ChiTietXuatKho', 'TrangThai'
        ]);
    }

    public function resetModal()
    {
        $this->MaPhieuXuat = null;
        $this->MaKho = null;
        $this->MaDonViVanChuyen = null;
        $this->MaLenhDieuDong = null;
        $this->DiaDiemXuat = null;
        $this->DonViTienTe = null;
        $this->ChiTietXuatKho = [];
        $this->TrangThai = null;
    }

    public function save()
    {
        $this->validate([
            'MaPhieuXuat' => 'required|unique:xuatkho,MaPhieuXuat',
            'MaKho' => 'required',
            'MaDonViVanChuyen' => 'required',
            'DiaDiemXuat' => 'required',
            'DonViTienTe' => 'required',
            'ChiTietXuatKho' => 'required|array',
            'MaLenhDieuDong' => 'required'
        ]);
        
        XuatKho::create([
            'MaPhieuXuat' => $this->MaPhieuXuat,
            'MaKho' => $this->MaKho,
            'MaDonViVanChuyen' => $this->MaDonViVanChuyen,
            'DiaDiemXuat' => $this->DiaDiemXuat,
            'DonViTienTe' => $this->DonViTienTe,
            'ChiTietXuatKho' => json_encode($this->ChiTietXuatKho),
            'MaLenhDieuDong' => $this->MaLenhDieuDong,
            'TrangThai' => $this->TrangThai,
        ]);
        
        $this->resetForm();
        $this->isAdd = false;
        session()->flash('success', 'Đã thêm phiếu xuất thành công!');
    }

    public function update()
    {
        $this->validate([
            'MaKho' => 'required',
            'MaDonViVanChuyen' => 'required',
            'DiaDiemXuat' => 'required',
            'DonViTienTe' => 'required',
            'ChiTietXuatKho' => 'required|array',
            'MaLenhDieuDong' => 'required',
            'TrangThai' => 'required'
        ]);

        $xuatkho = XuatKho::where('MaPhieuXuat', $this->MaPhieuXuat)->first();

        if(!$xuatkho){
            session()->flash('error', 'Không tìm thấy phiếu xuất kho!');
            return;
        }

        if ($this->TrangThai == 'Hoàn thành') {
            foreach ($this->ChiTietXuatKho as $value) {
                $vattu = VatTu::where('MaVatTu', $value['MaVatTu'])->first();
                if ($vattu) {
                    $vattu->SoLuongTon -= $value['SoLuongXuat'];
                    $vattu->save();
                }
            }
        }
        
        if ($xuatkho) {
            $xuatkho->update([
                'MaKho' => $this->MaKho,
                'MaDonViVanChuyen' => $this->MaDonViVanChuyen,
                'DiaDiemXuat' => $this->DiaDiemXuat,
                'DonViTienTe' => $this->DonViTienTe,
                'ChiTietXuatKho' => json_encode($this->ChiTietXuatKho),
                'MaLenhDieuDong' => $this->MaLenhDieuDong,
                'TrangThai' => $this->TrangThai,
            ]);
            $this->resetForm();
            $this->isEdit = false;
            session()->flash('success', 'Đã cập nhật phiếu xuất thành công!');
        } else {
            session()->flash('error', 'Không tìm thấy phiếu xuất kho');
        }
    }

    public function delete(){
        try {
            $xuatkho = XuatKho::where('MaPhieuXuat', $this->MaPhieuXuat)->first();
            if (!$xuatkho) {
                session()->flash('error', 'Không tìm thấy phiếu xuất kho này!');
                return;
            }
            $xuatkho->update([
                'TrangThai' => 'Đã hủy'
            ]);

            $this->resetForm();
            $this->isDelete = false;
            session()->flash('success', 'Phiếu xuất kho đã được hủy thành công!');
        } catch (\Throwable $th) {
            session()->flash('error', 'Lỗi! Vui lòng thực hiện lại.');
        }
    }

    public function removeVatTu($index)
    {
        unset($this->ChiTietXuatKho[$index]);
        $this->ChiTietXuatKho = array_values($this->ChiTietXuatKho);
        foreach($this->ChiTietXuatKho as $key => $value){
            $key++;
        }
    }

    public function updatedChiTietXuatKho($value, $key)
    {
        $index = intval(explode('.', $key)[0]);
        $field = explode('.', $key)[1];
        if($field == 'MaVatTu'){
            $vattu = VatTu::where('MaVatTu', $value)->first();
            if (!$vattu) {
                session()->flash('error', 'Không tìm thấy vật tư!');
                return;
            }
            if($this->ChiTietXuatKho[$index]['SoLuongXuat'] != ''){
                $this->ChiTietXuatKho[$index]['ThanhTien'] = $this->ChiTietXuatKho[$index]['SoLuongXuat'] * $vatTu->GiaNhap;
            } else {
                $this->ChiTietXuatKho[$index]['ThanhTien'] = 0;
            }
            $this->ChiTietXuatKho[$index]['TenVatTu'] = $vatTu->TenVatTu;
            $this->ChiTietXuatKho[$index]['DonVi'] = $vatTu->donvitinh->TenDonViTinh;
            $this->ChiTietXuatKho[$index]['DonGia'] = $vatTu->GiaNhap;
        }
        if ($field == 'SoLuongXuat') {
            $vattu = VatTu::where('MaVatTu', $this->ChiTietXuatKho[$index]['MaVatTu'])->first();
            if (!$vattu) return;
        
            if ($value > $vattu->SoLuongTon) {
                session()->flash('error', 'Số lượng xuất vượt quá số lượng tồn!');
                $this->ChiTietXuatKho[$index]['SoLuongXuat'] = $vattu->SoLuongTon;
                $value = $vattu->SoLuongTon;
            }

            $this->ChiTietXuatKho[$index]['ThanhTien'] = $value * $vattu->GiaNhap;
        }
    }
    public function exportExcel()
    {
        try {
            $phieuxuat = XuatKho::where('MaPhieuXuat', $this->MaPhieuXuat)
                ->with(['danhmuckhos', 'donvivangchuyen', 'lenhdieudong'])
                ->first();
                
            if (!$phieuxuat) {
                throw new \Exception('Không tìm thấy phiếu xuất');
            }

            $templatePath = public_path('/bieumau/phieuxuat.xlsx');
            if (!file_exists($templatePath)) {
                throw new \Exception('Không tìm thấy file mẫu');
            }

            $spreadsheet = IOFactory::load($templatePath);
            $sheet = $spreadsheet->getActiveSheet();

            $sheet->setCellValue('K4', 'Số (No.): ' . $phieuxuat->MaPhieuXuat);
            $sheet->setCellValue('F8', $phieuxuat->MaKho ?? '');
            $sheet->setCellValue('F10', $phieuxuat->DiaDiemXuat ?? '');
            $sheet->setCellValue('F11', $phieuxuat->lenhdieudong->MaLenhDieuDong ?? '');
            $sheet->setCellValue('E12', $phieuxuat->DonViTienTe ?? '');
            
            $row = 15;
            $stt = 1;
            $chiTiet = json_decode($phieuxuat->ChiTietXuatKho, true);
            
            foreach ($chiTiet as $item) {
                $sheet->insertNewRowBefore($row, 1);
                
                $sheet->setCellValue('C' . $row, $stt);
                $sheet->setCellValue('E' . $row, $item['MaVatTu'] ?? '');
                $sheet->setCellValue('D' . $row, $item['TenVatTu'] ?? '');
                $sheet->setCellValue('F' . $row, $item['DonVi'] ?? '');
                $sheet->setCellValue('G' . $row, $item['SoLuongXuat'] ?? '');
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
            $sheet->setCellValue('G' . $totalRow, '=SUM(G15:G' . ($row) . ')');
            
            $sheet->setCellValue('I' . $totalRow, '=SUM(I15:I' . ($row) . ')');
            
            $totalStyle = $sheet->getStyle('C' . $totalRow . ':I' . $totalRow);

            $totalStyle->getAlignment()->setHorizontal('center');
            $totalStyle->getAlignment()->setVertical('center');

            $directory = storage_path('app/public/exports');
            if (!file_exists($directory)) {
                mkdir($directory, 0777, true);
            }

            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $filename = 'phieuxuat_' . $this->MaPhieuXuat . '.xlsx';
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