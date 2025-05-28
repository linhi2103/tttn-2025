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
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Border;

class PhieuKiemKeComponent extends Component
{
    use WithPagination;

    public $search = '';

    public $isEdit = false;
    public $isAdd = false;
    public $isDelete = false;
    public $isDetail = false;

    public $MaPhieuKiemKe;
    public $MaKho;
    public $MaLenhDieuDong;
    public $TrangThai;

    public $ChiTietKiemKe = [];

    public function render()
    {
        return view('livewire.phieu-kiem-ke', [
            'phieukiemkes' => PhieuKiemKe::query()
                ->where(function ($query) {
                    $query->where('MaPhieuKiemKe', 'like', "%{$this->search}%")
                        ->orWhere('MaKho', 'like', "%{$this->search}%")
                        ->orWhere('MaLenhDieuDong', 'like', "%{$this->search}%");
                })
                ->orderBy('MaPhieuKiemKe', 'asc')
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
        $this->MaKho = $phieukiemke->MaKho;
        $this->MaLenhDieuDong = $phieukiemke->MaLenhDieuDong;
        $this->TrangThai = $phieukiemke->TrangThai;
        $this->ChiTietKiemKe = json_decode($phieukiemke->ChiTietKiemKe, true);
        $this->isEdit = true;
    }

    public function showModalDelete($MaPhieuKiemKe)
    {
        $this->isDelete = true;
        $this->MaPhieuKiemKe = $MaPhieuKiemKe;
    }

    public function showModalDetail($MaPhieuKiemKe)
    {
        $phieukiemke = PhieuKiemKe::where('MaPhieuKiemKe', $MaPhieuKiemKe)->first();
        if (!$phieukiemke) {
            session()->flash('error', 'Không tìm thấy phiếu kiểm kê');
            return;
        }
        $this->isDetail = true;
        $this->MaPhieuKiemKe = $phieukiemke->MaPhieuKiemKe;
        $this->ChiTietKiemKe = json_decode($phieukiemke->ChiTietKiemKe, true);
    }

    public function closeModal()
    {
        $this->isEdit = false;
        $this->isAdd = false;
        $this->isDelete = false;
        $this->isDetail = false;
        $this->resetModal();
    }

    public function resetModal()
    {
        $this->reset([
            'MaPhieuKiemKe', 'MaKho', 'TrangThai', 'MaLenhDieuDong', 'ChiTietKiemKe',
        ]);
    }

    public function save()
    {
        try {
            $this->validate([
                'MaPhieuKiemKe' => 'required|unique:phieukiemke,MaPhieuKiemKe',
                'MaKho' => 'required',
                'MaLenhDieuDong' => 'required',
            ]);

            PhieuKiemKe::create([
                'MaPhieuKiemKe' => $this->MaPhieuKiemKe,
                'MaKho' => $this->MaKho,
                'MaLenhDieuDong' => $this->MaLenhDieuDong,
                'ChiTietKiemKe' => json_encode($this->ChiTietKiemKe),
            ]);

            $this->closeModal();
            session()->flash('success', 'Phiếu kiểm kê đã được tạo thành công!');
        } catch (\Exception $e) {
            session()->flash('error', 'Lỗi! ' . $e->getMessage());
        }
    }

    public function update()
    {
    $phieukiemke = PhieuKiemKe::where('MaPhieuKiemKe', $this->MaPhieuKiemKe)->first();
    if (!$phieukiemke) {
        session()->flash('error', 'Không tìm thấy phiếu kiểm kê!');
        return;
    }

    if ($this->ChiTietKiemKe == []) {
        session()->flash('error', 'Chi tiết kiểm kê không được để trống!');
        return;
    }

    // Cập nhật thông tin vào database trước
    $phieukiemke->update([
        'MaKho' => $this->MaKho,
        'TrangThai' => $this->TrangThai,
        'MaLenhDieuDong' => $this->MaLenhDieuDong,
        'ChiTietKiemKe' => json_encode($this->ChiTietKiemKe),
    ]);

    // Sau khi cập nhật xong mới xử lý cập nhật tồn kho nếu trạng thái là 'Đã Kiểm Kê'
    if ($this->TrangThai === 'Đã Kiểm Kê') {
        logger("Bắt đầu cập nhật tồn kho từ phiếu: " . $phieukiemke->MaPhieuKiemKe);
        foreach ($this->ChiTietKiemKe as $value) {
            $vattu = VatTu::where('MaVatTu', $value['MaVatTu'])->first();
            $SoLuongThucTe = (int)($value['SoLuongThucTe'] ?? 0);
            $vattu->SoLuongTon = $SoLuongThucTe;
            $vattu->save();
        }
    }

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
                    foreach ($this->ChiTietKiemKe as $item) {
                        $vatTu = VatTu::where('MaVatTu', $item['MaVatTu'])->first();
                        if ($vatTu) {
                            $vatTu->SoLuongTon = $item['SoLuongThucTe'];
                            $vatTu->save();
            }
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

    public function addVatTu()
    {
        $this->ChiTietKiemKe[] = [
            'MaVatTu' => '',
            'TenVatTu' => '',
            'DonViTinh' => '',
            'DonGia' => '',
            'SoLuongTon' => '',
            'SoLuongThucTe' => '',
            'ConTot' => '',
            'KemChatLuong' => '',
            'MatChatLuong' => '',
        ];
    }

    public function removeVatTu($index)
    {
        unset($this->ChiTietKiemKe[$index]);
        $this->ChiTietKiemKe = array_values($this->ChiTietKiemKe);
    }

    public function updatedChiTietKiemKe($value, $key)
    {
        $index = intval(explode('.', $key)[0]);
        $field = explode('.', $key)[1];
        if($field == 'MaVatTu'){
            $vatTu = VatTu::where('MaVatTu', $value)->first();
            if (!$vatTu) {
                session()->flash('error', 'Không tìm thấy vật tư!');
                return;
            }
            $this->ChiTietKiemKe[$index]['TenVatTu'] = $vatTu->TenVatTu;
            $this->ChiTietKiemKe[$index]['SoLuongTon'] = $vatTu->SoLuongTon;
            $this->ChiTietKiemKe[$index]['DonViTinh'] = $vatTu->DonViTinh->TenDonViTinh;
            $this->ChiTietKiemKe[$index]['DonGia'] = $vatTu->GiaNhap;
        }

        if ($field == 'ConTot' || $field == 'KemChatLuong') {
            $this->ChiTietKiemKe[$index]['MatChatLuong'] = 
                (intval($this->ChiTietKiemKe[$index]['SoLuongThucTe']) ?? 0) 
                - (intval($this->ChiTietKiemKe[$index]['ConTot']) ?? 0)
                - (intval($this->ChiTietKiemKe[$index]['KemChatLuong']) ?? 0);
        }
    }

    public function exportExcel()
    {
        try {
            $phieukiemke = PhieuKiemKe::where('MaPhieuKiemKe', $this->MaPhieuKiemKe)
                ->with(['kho', 'lenhDieuDong'])
                ->first();

            if (!$phieukiemke) {
                throw new \Exception('Không tìm thấy phiếu kiểm kê');
            }

            $templatePath = public_path('/bieumau/phieukiemke.xlsx');
            if (!file_exists($templatePath)) {
                throw new \Exception('Không tìm thấy file mẫu');
            }

            $spreadsheet = IOFactory::load($templatePath);
            $sheet = $spreadsheet->getActiveSheet();

            $sheet->setCellValue('K4', 'Số (No.): ' . $phieukiemke->MaPhieuKiemKe);
            $sheet->setCellValue('F7', $phieukiemke->kho->TenKho ?? '');
            $sheet->setCellValue('F8', $phieukiemke->kho->MaKho ?? '');
            $sheet->setCellValue('E9', $phieukiemke->kho->DiaChi ?? '');
            $sheet->setCellValue('G10', $phieukiemke->lenhDieuDong->MaLenhDieuDong ?? '');

            $row = 16;
            $stt = 1;
            $chiTiet = json_decode($phieukiemke->ChiTietKiemKe, true);

            foreach ($chiTiet as $item) {
                $sheet->insertNewRowBefore($row, 1);

                $sheet->setCellValue('B' . $row, $stt);
                $sheet->setCellValue('C' . $row, $item['TenVatTu']);
                $sheet->setCellValue('D' . $row, $item['MaVatTu']);
                $sheet->setCellValue('E' . $row, $item['DonViTinh']);
                $sheet->setCellValue('F' . $row, $item['DonGia']);
                $sheet->setCellValue('G' . $row, $item['SoLuongTon']);
                $sheet->setCellValue('H' . $row, $item['SoLuongTon'] * $item['DonGia']);
                $sheet->setCellValue('I' . $row, $item['SoLuongThucTe']);
                $sheet->setCellValue('J' . $row, $item['SoLuongThucTe'] * $item['DonGia']);
                if($item['SoLuongThucTe'] > $item['SoLuongTon']) {
                    $chenhlech = $item['SoLuongThucTe'] - $item['SoLuongTon'];
                    $sheet->setCellValue('K' . $row, $chenhlech);
                    $sheet->setCellValue('L' . $row, $chenhlech * $item['DonGia']);
                }
                if($item['SoLuongThucTe'] < $item['SoLuongTon']) {
                    $chenhlech = $item['SoLuongTon'] - $item['SoLuongThucTe'];
                    $sheet->setCellValue('M' . $row, $chenhlech);
                    $sheet->setCellValue('N' . $row, $chenhlech * $item['DonGia']);
                }
                $sheet->setCellValue('O' . $row, $item['ConTot']);
                $sheet->setCellValue('P' . $row, $item['KemChatLuong']);
                $sheet->setCellValue('Q' . $row, $item['MatChatLuong']);


                $style = $sheet->getStyle('B' . $row . ':Q' . $row);
                $style->getFont()->setBold(false);
                $style->getAlignment()->setHorizontal('center');
                $style->getAlignment()->setVertical('center');

                $row++;
                $stt++;
            }

            $totalRow = $row;
            $sheet->setCellValue('C' . $totalRow, 'Tổng cộng (Total):');
            foreach (range('G', 'Q') as $column) {
                $sheet->setCellValue($column . $totalRow, '=SUM(' . $column . '16:' . $column . ($row - 1) . ')');
            }
            $totalStyle = $sheet->getStyle('C' . $totalRow . ':Q' . $totalRow);
            $totalStyle->getAlignment()->setHorizontal('center');
            $totalStyle->getAlignment()->setVertical('center');

            $directory = storage_path('app/public/exports');
            if (!file_exists($directory)) {
                mkdir($directory, 0777, true);
            }

            $fileName = 'PhieuKiemKe_' . $phieukiemke->MaPhieuKiemKe . '.xlsx';
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

        } catch (\Exception $e) {
            session()->flash('error', 'Lỗi khi xuất file: ' . $e->getMessage());
            return;
        }
    }
}
