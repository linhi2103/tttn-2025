<?php

namespace App\Livewire;

use Livewire\Component;

use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;

class BaoCao extends Component
{
    public $TuNgay;
    public $DenNgay;
    public $MauBaoCao = 1;
    public $data = [];
    public $total = [
        'MaVatTu' => [],
        'VatTu' => 0,
        'SoLuong' => 0,
        'ThanhTien' => 0,
    ];
    public $stt = 0;

    public function render()
    {
        return view('livewire.bao-cao');
    }
    public function updatedMauBaoCao($value)
    {
        // Hàm này sẽ tự chạy mỗi khi MauBaoCao bị thay đổi từ giao diện
        $this->MauBaoCao = (int) $value;
        logger('Mẫu báo cáo đã chọn: ' . $this->MauBaoCao);
    }
    public function baoCao()
    {
        if ($this->MauBaoCao == 1) {
            return $this->baoCaoNhapKho();
        } elseif ($this->MauBaoCao == 2) {
            return $this->baoCaoXuatKho();
        }
    }
    public function baoCaoNhapKho()
    {
        $this->resetForm();
        $rows = [];
        $data = DB::select('SELECT * FROM nhapkho WHERE created_at >= ? AND created_at <= ?', [$this->TuNgay ?? '', $this->DenNgay ?? '']);
        foreach ($data as $phieuNhap) {
            // Decode chuỗi JSON ChiTietNhapKho thành mảng object
            $chiTiet = json_decode($phieuNhap->ChiTietNhapKho);

            // Với mỗi vật tư, tạo 1 row mới
            foreach ($chiTiet as $vatTu) {
                $rows[] = (object)[
                    'MaPhieuNhap' => $phieuNhap->MaPhieuNhap,
                    'TenVatTu'    => $vatTu->TenVatTu,
                    'SoLuong'     => $vatTu->SoLuongNhap,
                    'ThanhTien'   => $vatTu->ThanhTien,
                    'created_at' => date("d/m/Y", strtotime($phieuNhap->created_at)),
                ];
                if (!in_array($vatTu->MaVatTu, $this->total['MaVatTu'])) {
                    $this->total['MaVatTu'][] = $vatTu->MaVatTu;
                    $this->total['VatTu']++;
                }
                $this->total['SoLuong'] += $vatTu->SoLuongNhap;
                $this->total['ThanhTien'] += $vatTu->ThanhTien;
            }
        }
        $this->data = $rows ?? [];
    }
    public function baoCaoXuatKho()
    {
        $this->resetForm();
        $rows = [];
        $dataXuatKho = DB::select('SELECT * FROM xuatkho WHERE created_at >= ? AND created_at <= ?', [$this->TuNgay ?? '', $this->DenNgay ?? '']);
        foreach ($dataXuatKho as $xuatKho) {
            // Decode chuỗi JSON ChiTietNhapKho thành mảng object
            $chiTiet = json_decode($xuatKho->ChiTietXuatKho);
            // Với mỗi vật tư, tạo 1 row mới
            foreach ($chiTiet as $vatTu) {
                if (!isset($rows[$vatTu->MaVatTu])) {
                    $rows[$vatTu->MaVatTu] = (object)[
                        'TenVatTu'    => $vatTu->TenVatTu,
                        'SoLuong'     => $vatTu->SoLuongXuat,
                        'ThanhTien'   => $vatTu->ThanhTien,
                    ];
                } else
                {
                    $rows[$vatTu->MaVatTu]->SoLuong += $vatTu->SoLuongXuat;
                    $rows[$vatTu->MaVatTu]->ThanhTien += $vatTu->ThanhTien;
                }
                if (!in_array($vatTu->MaVatTu, $this->total['MaVatTu'])) {
                    $this->total['MaVatTu'][] = $vatTu->MaVatTu;
                    $this->total['VatTu']++;
                }
                $this->total['SoLuong'] += $vatTu->SoLuongXuat;
                $this->total['ThanhTien'] += $vatTu->ThanhTien;
            }
        }
        $dataThanhLy = DB::select('SELECT * FROM thanhlykho WHERE created_at >= ? AND created_at <= ?', [$this->TuNgay ?? '', $this->DenNgay ?? '']);
        foreach ($dataThanhLy as $thanhLy) {
            // Decode chuỗi JSON ChiTietNhapKho thành mảng object
            $chiTiet = json_decode($thanhLy->ChiTietThanhLy);
            // Với mỗi vật tư, tạo 1 row mới
            foreach ($chiTiet as $vatTu) {
                if (!isset($rows[$vatTu->MaVatTu])) {
                    $rows[$vatTu->MaVatTu] = (object)[
                        'TenVatTu'    => $vatTu->TenVatTu,
                        'SoLuong'     => $vatTu->SoLuong,
                        'ThanhTien'   => $vatTu->ThanhTien,
                    ];
                } else {
                    $rows[$vatTu->MaVatTu]->SoLuong += $vatTu->SoLuong;
                    $rows[$vatTu->MaVatTu]->ThanhTien += $vatTu->ThanhTien;
                }
                if (!in_array($vatTu->MaVatTu, $this->total['MaVatTu'])) {
                    $this->total['MaVatTu'][] = $vatTu->MaVatTu;
                    $this->total['VatTu']++;
                }
                $this->total['SoLuong'] += $vatTu->SoLuong;
                $this->total['ThanhTien'] += $vatTu->ThanhTien;
            }
        }
        $this->data = $rows ? array_values($rows) : [];
    }
    public function exportExcel()
    {
        try {

            $this->baoCao();
            $templatePath = public_path('/bieumau/baocaonhap.xlsx');
            if (!file_exists($templatePath)) {
                throw new \Exception('Không tìm thấy file mẫu');
            }

            $spreadsheet = IOFactory::load($templatePath);
            $sheet = $spreadsheet->getActiveSheet();

            $directory = storage_path('app/public/exports');
            if (!file_exists($directory)) {
                mkdir($directory, 0777, true);
            }

            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $filename = 'baocaonhap.xlsx';
            $filePath = $directory . '/' . $filename;
            $writer->save($filePath);

            if (file_exists($filePath)) {
                return response()->download($filePath, $filename, [
                    'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    'Content-Disposition' => 'attachment; filename="' . $filename . '"'
                ])->deleteFileAfterSend(true);
            }

            session()->flash('success', 'Xuất file thành công!');
        } catch (\Exception $e) {
            session()->flash('error', 'Lỗi khi xuất file: ' . $e->getMessage());
            return;
        }
    }
    public function resetForm()
    {
        $this->total = [
            'MaVatTu' => [],
            'VatTu' => 0,
            'SoLuong' => 0,
            'ThanhTien' => 0,
        ];
        $this->stt = 0;
    }
}
