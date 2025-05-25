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
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Border;

class ThanhLyKhoComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $search = '';

    public $isEdit = false;
    public $isAdd = false;
    public $isDelete = false;
    public $isDetail = false;

    public $MaPhieuThanhLy;
    public $MaLenhDieuDong;
    public $MaKho;
    public $TrangThai;

    
    
    public $ChiTietThanhLy = [];
    
    
    public function render()
    {
        return view('livewire.thanh-ly-kho')
        ->with([
            'phieuthanhlys' => ThanhLyKho::query()
            ->where(function($query) {
                $query->where('MaPhieuThanhLy', 'like', "%{$this->search}%")
                    ->orWhere('MaKho', 'like', "%{$this->search}%")
                    ->orWhere('MaLenhDieuDong', 'like', "%{$this->search}%");
            })
            ->orderBy('MaPhieuThanhLy', 'asc')
            ->paginate(10),
            'vattus' => VatTu::all(),
            'danhmuckhos' => DanhMucKho::all(),
            'lenhdieudongs' => LenhDieuDong::all()
        ]);
    }

    public function showModalAdd()
    {
        $this->addVatTu();
        $this->isAdd = true;
    }

    public function showModalEdit($MaPhieuThanhLy)
    {
        $this->MaPhieuThanhLy = $MaPhieuThanhLy;
        $phieuthanhly = ThanhLyKho::where('MaPhieuThanhLy', $MaPhieuThanhLy)
            ->with([
                'lenhdieudong',
                'kho'
            ])
            ->first();
        if (!$phieuthanhly) {
            session()->flash('error', 'Không tìm thấy phiếu thanh lý');
            return;
        }

        $this->MaLenhDieuDong = $phieuthanhly->MaLenhDieuDong;
        $this->MaKho = $phieuthanhly->MaKho;
        $this->TrangThai = $phieuthanhly->TrangThai;
        $this->ChiTietThanhLy = json_decode($phieuthanhly->ChiTietThanhLy, true);
        Log::info($this->ChiTietThanhLy);

        $this->isEdit = true;
    }

    public function showModalDelete($MaPhieuThanhLy)
    {
        $this->isDelete = true;
        $this->MaPhieuThanhLy = $MaPhieuThanhLy;
    }

    public function showModalDetail($MaPhieuThanhLy)
    {
        $this->MaPhieuThanhLy = $MaPhieuThanhLy;
        $phieuthanhly = ThanhLyKho::where('MaPhieuThanhLy', $MaPhieuThanhLy)->first();
        $this->ChiTietThanhLy = json_decode($phieuthanhly->ChiTietThanhLy, true);
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
            'MaPhieuThanhLy', 'MaLenhDieuDong', 'MaKho', 'TrangThai', 'ChiTietThanhLy'
        ]);
    }

    public function resetModal(){
        $this->MaPhieuThanhLy = null;
        $this->MaLenhDieuDong = null;
        $this->MaKho = null;
        $this->TrangThai = null;
        $this->ChiTietThanhLy = [];
    }

    public function save()
    {

        try {
            $this->validate([
                'MaPhieuThanhLy' => 'required|unique:thanhlykho,MaPhieuThanhLy',
                'MaLenhDieuDong' => 'required',
                'MaKho' => 'required',
                'ChiTietThanhLy' => 'required|array'
            ]);

            ThanhLyKho::create([
                'MaPhieuThanhLy' => $this->MaPhieuThanhLy,
                'MaLenhDieuDong' => $this->MaLenhDieuDong,
                'MaKho' => $this->MaKho,
                'ChiTietThanhLy' => json_encode($this->ChiTietThanhLy),
            ]);

            $this->resetForm();
            $this->isAdd = false;
            session()->flash('success', 'Thanh lý kho đã được tạo thành công!');
        } catch (Exception $e) {
            session()->flash('error', 'Lỗi! Vui lòng thực hiện lại. ' . $e->getMessage());
        }
    }

    public function update()
    {
        $this->validate([
            'MaPhieuThanhLy' => 'required',
            'MaLenhDieuDong' => 'required',
            'MaKho' => 'required',
            'TrangThai' => 'required',
            'ChiTietThanhLy' => 'required'
        ]);

        $phieuthanhly = ThanhLyKho::where('MaPhieuThanhLy', $this->MaPhieuThanhLy)->first();
        if (!$phieuthanhly) {
            session()->flash('error', 'Không tìm thấy phiếu thanh lý!');
            return;
        }

        if($this->TrangThai == 'Đã thanh lý'){
            foreach ($this->ChiTietThanhLy as $index => $value) {
                $vatTu = VatTu::where('MaVatTu', $value['MaVatTu'])->first();
                $vatTu->update([
                    'SoLuongTon' => $vatTu->SoLuongTon - $value['SoLuong']
                ]);
            }
        }

        $phieuthanhly->update([
            'MaPhieuThanhLy' => $this->MaPhieuThanhLy,
            'MaLenhDieuDong' => $this->MaLenhDieuDong,
            'MaKho' => $this->MaKho,
            'TrangThai' => $this->TrangThai,
            'ChiTietThanhLy' => json_encode($this->ChiTietThanhLy)
        ]);

        $this->resetForm();
        $this->isEdit = false;
        session()->flash('success', 'Thanh lý kho đã được cập nhật thành công!');
    }


    public function delete()
    {
        try {
            $phieuthanhly = ThanhLyKho::where('MaPhieuThanhLy', $this->MaPhieuThanhLy)->first();
            if (!$phieuthanhly) {
                session()->flash('error', 'Không tìm thấy phiếu thanh lý này!');
                return;
            }

            $phieuthanhly->update([
                'TrangThai' => 'Đã hủy'
            ]);

            $this->resetForm();
            $this->isDelete = false;
            session()->flash('success', 'Thanh lý kho đã được hủy thành công!');
        } catch (\Throwable $th) {
            session()->flash('error', 'Lỗi! Vui lòng thực hiện lại.');
        }
    }

    public function addVatTu()
    {
        $this->ChiTietThanhLy[count($this->ChiTietThanhLy)] = [
            'MaVatTu' => '',
            'TenVatTu' => '',
            'SoLuong' => '',
            'DonVi' => '',
            'DonGia' => '',
            'ThanhTien' => '',
            'NguyenNhanThanhLy' => '',
            'BienPhapThanhLy' => '',
        ];
    }

    public function removeVatTu($index)
    {
        unset($this->ChiTietThanhLy[$index]);
        $this->ChiTietThanhLy = array_values($this->ChiTietThanhLy);
        foreach($this->ChiTietThanhLy as $key => $value){
            $key++;
        }
    }

    public function updatedChiTietThanhLy($value, $key)
    {
        $index = intval(explode('.', $key)[0]);
        $field = explode('.', $key)[1];
        if($field == 'MaVatTu'){
            $vatTu = VatTu::where('MaVatTu', $value)->first();
            if (!$vatTu) {
                session()->flash('error', 'Không tìm thấy vật tư!');
                return;
            }
            if($this->ChiTietThanhLy[$index]['SoLuong'] != ''){
                $this->ChiTietThanhLy[$index]['ThanhTien'] = $this->ChiTietThanhLy[$index]['SoLuong'] * $vatTu->GiaNhap;
            }
            $this->ChiTietThanhLy[$index]['TenVatTu'] = $vatTu->TenVatTu;
            $this->ChiTietThanhLy[$index]['DonVi'] = $vatTu->donvitinh->TenDonViTinh;
            $this->ChiTietThanhLy[$index]['DonGia'] = $vatTu->GiaNhap;
        }
        if($field == 'SoLuong'){
            $vatTu = VatTu::where('MaVatTu', $this->ChiTietThanhLy[$index]['MaVatTu'])->first();
            if (!$vatTu) {
                return;
            }
            if($value == ''){
                $this->ChiTietThanhLy[$index]['ThanhTien'] = 0;
                return;
            }
            $this->ChiTietThanhLy[$index]['ThanhTien'] = $value * $vatTu->GiaNhap;
        }
    }

    public function exportExcel()
    {
        try {
            $phieuthanhly = ThanhLyKho::where('MaPhieuThanhLy', $this->MaPhieuThanhLy)
                ->with(['kho', 'lenhdieudong'])
                ->first();
                
            if (!$phieuthanhly) {
                throw new \Exception('Không tìm thấy phiếu thanh lý');
            }

            $templatePath = public_path('/bieumau/phieuthanhly.xlsx');
            if (!file_exists($templatePath)) {
                throw new \Exception('Không tìm thấy file mẫu');
            }

            $spreadsheet = IOFactory::load($templatePath);
            $sheet = $spreadsheet->getActiveSheet();

            $sheet->setCellValue('K4', 'Số (No.): ' . $phieuthanhly->MaPhieuThanhLy);
            $sheet->setCellValue('F7', $phieuthanhly->kho->TenKho ?? '');
            $sheet->setCellValue('F9', $phieuthanhly->kho->MaKho ?? '');
            $sheet->setCellValue('E9', $phieuthanhly->kho->DiaChi ?? '');
            $sheet->setCellValue('G10', $phieuthanhly->lenhdieudong->MaLenhDieuDong ?? '');
            
            $row = 13;
            $stt = 1;
            $chiTiet = json_decode($phieuthanhly->ChiTietThanhLy, true);
            
            foreach ($chiTiet as $item) {
                $sheet->insertNewRowBefore($row, 1);
                
                $sheet->setCellValue('C' . $row, $stt);
                $sheet->setCellValue('E' . $row, $item['MaVatTu'] ?? '');
                $sheet->setCellValue('D' . $row, $item['TenVatTu'] ?? '');
                $sheet->setCellValue('F' . $row, $item['DonVi'] ?? '');
                $sheet->setCellValue('G' . $row, $item['SoLuong'] ?? 0);
                $sheet->setCellValue('H' . $row, $item['DonGia'] ?? 0);
                $sheet->setCellValue('I' . $row, $item['ThanhTien'] ?? 0);
                
                $sheet->setCellValue('J' . $row, $item['NguyenNhanThanhLy'] ?? '');
                $sheet->mergeCells('J' . $row . ':K' . $row);
                
                $sheet->setCellValue('L' . $row, $item['BienPhapThanhLy'] ?? '');
                $sheet->mergeCells('L' . $row . ':M' . $row);
                
                $style = $sheet->getStyle('C' . $row . ':M' . $row);
                $style->getFont()->setBold(false);
                $style->getAlignment()->setHorizontal('center');
                $style->getAlignment()->setVertical('center');
                
                $row++;
                $stt++;
            }

            $totalRow = $row;
            $sheet->setCellValue('C' . $totalRow, 'Tổng');
            
            $sheet->setCellValue('G' . $totalRow, '=SUM(G13:G' . ($row) . ')');
            
            $sheet->setCellValue('I' . $totalRow, '=SUM(I13:I' . ($row) . ')');
            
            $totalStyle = $sheet->getStyle('C' . $totalRow . ':I' . $totalRow);

            $totalStyle->getAlignment()->setHorizontal('center');
            $totalStyle->getAlignment()->setVertical('center');

            $directory = storage_path('app/public/exports');
            if (!file_exists($directory)) {
                mkdir($directory, 0777, true);
            }
            
            $fileName = 'PhieuThanhLy_' . $phieuthanhly->MaPhieuThanhLy . '.xlsx';
            $filePath = $directory . '/' . $fileName;
            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save($filePath);
            
            if (file_exists($filePath)) {
                return response()->download($filePath, $fileName, [
                    'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    'Content-Disposition' => 'attachment; filename="' . $fileName . '"'
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
}