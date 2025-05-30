<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title">Danh sách Phiếu Nhập Kho</h5>
            <div class="d-flex">
                <input type="text" wire:model.live="search" class="form-control me-2" placeholder="Tìm kiếm...">
                    <button class="btn btn-lg-red ms-2" wire:click="showModalAdd">
                        <i class="fas fa-plus me-2"></i>Thêm Phiếu Nhập
                    </button>
                </div>
            </div>

            <!-- Success Message -->
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <!-- Error Message -->
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

            <div class="table-responsive">
                <table class="table table-hover table-light table-bordered">
                    <thead>
                        <tr>
                        <th>Mã Phiếu Nhập</th>
                        <th>Mã Kho</th>
                        <th>Đơn Vị Vận Chuyển</th>
                        <th>Lệnh Điều Động</th>
                        <th>Ngày Nhập</th>
                        <th>Đơn Vị Tiền tệ</th>
                        <th>Trạng thái</th>
                        <th>Mã Số Thuế - đối tác</th>
                        <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nhapkhos as $item)
                            <tr>
                                <td>{{ $item->MaPhieuNhap }}</td>
                                <td>{{ $item->MaKho ?? 'N/A' }}</td>
                                <td>{{ $item->donViVanChuyen->TenDonViVanChuyen ?? 'N/A' }}</td>
                                <td>{{ $item->lenhDieuDong->MaLenhDieuDong ?? 'N/A' }}</td>
                                <td>{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
                                <td>{{ $item->DonViTienTe }}</td>
                                <td>{{ $item->TrangThai }}</td>
                                <td>{{ $item->MaSoThue_DoiTac }}</td>
                                <td>
                                <span class="badge rounded-pill 
                                    {{ 
                                        ($item->TrangThai == 'Chờ duyệt' ? 'bg-warning text-dark' : 
                                        ($item->TrangThai == 'Đã duyệt' ? 'bg-primary' : 
                                        ($item->TrangThai == 'Hủy' ? 'bg-danger' : 'bg-danger')))
                                    }}">
                                    {{ $item->TrangThai }}
                                </span>
                            </td>
                            <td>
                                <button class="btn bg-primary ms-2" title="Xem chi tiết" wire:click="showModalDetail('{{ $item->MaPhieuNhap }}')">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn bg-warning ms-2" title="Sửa" wire:click="showModalEdit('{{ $item->MaPhieuNhap }}')">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn bg-danger ms-2" title="Xóa" wire:click="showModalDelete('{{ $item->MaPhieuNhap }}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-between align-items-center">
                Hiển thị từ {{ $nhapkhos->firstItem() }} đến {{ $nhapkhos->lastItem() }} trong tổng số {{ $nhapkhos->total() }} phiếu nhập kho
                {{ $nhapkhos->links('pagination') }}
            </div>
        </div>
    </div>

        @if ($isAdd || $isEdit)
        <div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5);" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $isAdd ? 'Thêm Phiếu Nhập' : 'Chỉnh sửa Phiếu Nhập' }}</h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                        <form wire:submit.prevent="{{ $isAdd ? 'save' : 'update' }}">
                            <div class="modal-body">
                            @if (session()->has('message'))
                                <div class="alert alert-{{ session('message.type') }}">
                                    {{ session('message.content') }}
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Mã Phiếu Nhập</label>
                                    <input type="text" class="form-control @error('MaPhieuNhap') is-invalid @enderror" wire:model="MaPhieuNhap" {{ $isEdit ? 'readonly' : '' }} required>
                                    @error('MaPhieuNhap') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label>Kho</label>
                                    <select class="form-control @error('MaKho') is-invalid @enderror" wire:model="MaKho" required>
                                        <option value="">-- Chọn Kho --</option>
                                        @foreach ($danhmuckhos as $kho)
                                            <option value="{{ $kho->MaKho }}">{{ $kho->MaKho  }}</option>
                                        @endforeach
                                    </select>
                                    @error('MaKho') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Đối Tác</label>
                                    <select class="form-control @error('MaSoThue_DoiTac') is-invalid @enderror" 
                                            wire:model="MaSoThue_DoiTac" required>
                                        <option value="">-- Chọn Đối Tác --</option>
                                        @foreach ($doitacs as $doitac)
                                            <option value="{{ $doitac->MaSoThue_DoiTac }}">{{ $doitac->TenDoiTac }}</option>
                                        @endforeach
                                    </select>
                                    @error('MaSoThue_DoiTac') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Tên Đơn Vị Vận Chuyển</label>
                                    <select class="form-control @error('MaDonViVanChuyen') is-invalid @enderror" 
                                            wire:model="MaDonViVanChuyen" required>
                                        <option value="">-- Chọn ĐVVC --</option>
                                        @foreach ($donvivanchuyen as $dvvc)
                                            <option value="{{ $dvvc->MaDonViVanChuyen }}">{{ $dvvc->TenDonViVanChuyen }}</option>
                                        @endforeach
                                    </select>
                                    @error('MaDonViVanChuyen') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Mã Lệnh Điều Động</label>
                                    <select class="form-control @error('MaLenhDieuDong') is-invalid @enderror" wire:model="MaLenhDieuDong" required>
                                        <option value="">-- Chọn Lệnh Điều Động --</option>
                                        @foreach ($lenhdieudongs as $lenhdieudong)
                                            <option value="{{ $lenhdieudong->MaLenhDieuDong }}">{{ $lenhdieudong->MaLenhDieuDong }}</option>
                                        @endforeach
                                    </select>
                                    @error('MaLenhDieuDong') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Đơn Vị Tiền Tệ</label>
                                    <input type="text" class="form-control @error('DonViTienTe') is-invalid @enderror" 
                                           wire:model="DonViTienTe" required>
                                    @error('DonViTienTe') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                @if($isEdit)
                                <div class="col-md-6 mb-3">
                                    <label>Trạng Thái</label>
                                    <select class="form-control @error('TrangThai') is-invalid @enderror" wire:model="TrangThai" required>
                                        <option value="">-- Chọn Trạng Thái --</option>
                                        <option value="Chờ duyệt">Chờ duyệt</option>
                                        <option value="Đã duyệt">Đã duyệt</option>
                                        <option value="Hủy">Hủy</option>
                                    </select>
                                    @error('TrangThai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                @endif
                                <div class="col-md-12 mb-3">
                                    <div class="d-flex justify-content-between">
                                        <label>Danh sách vật tư</label>
                                        <button type="button" class="btn btn-danger" wire:click="addVatTu">Thêm vật tư</button>
                                    </div>
                                    <br>
                                    <div>
                                        <table class="table table-hover table-light table-bordered table-responsive text-center" style="table-layout: auto;">
                                            <thead>
                                                <tr>
                                                <th>STT</th>
                                                <th>Mã Vật Tư</th>
                                                <th>Tên Vật Tư</th>
                                                <th>Số Lượng</th>
                                                <th>Đơn Vị Tính</th>
                                                <th>Đơn giá</th>
                                                <th>Thành Tiền</th>
                                                <th>Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($ChiTietNhapKho as $stt => $item)
                                                <tr>
                                                    <td>{{ $stt + 1 }}</td>
                                                    <td>
                                                        <select class="form-control @error('ChiTietNhapKho.'.$stt.'.MaVatTu') is-invalid @enderror" 
                                                            wire:model.live="ChiTietNhapKho.{{ $stt }}.MaVatTu" required>
                                                            <option value="">-- Chọn Vật Tư --</option>
                                                            @foreach ($vattus as $vattu)
                                                                <option value="{{ $vattu->MaVatTu }}">{{ $vattu->MaVatTu }} - {{ $vattu->TenVatTu }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>{{ $item['TenVatTu'] ?? '' }}</td>
                                                    <td>
                                                        <input type="number" class="form-control @error('ChiTietNhapKho.'.$stt.'.SoLuongNhap') is-invalid @enderror" 
                                                            wire:model.live="ChiTietNhapKho.{{ $stt }}.SoLuongNhap" min="1" step="1" placeholder="1" required
                                                            title="Số lượng phải lớn hơn 0">
                                                        @error('ChiTietNhapKho.'.$stt.'.SoLuongNhap') 
                                                            <div class="invalid-feedback">{{ $message }}</div> 
                                                        @enderror
                                                    </td>
                                                    <td>{{ $item['DonViTinh'] ?? '' }}</td>
                                                    <td>{{ number_format($item['DonGia'] ?? 0, 0, ',', '.') }} VNĐ</td>
                                                    <td class="fw-bold text-primary">{{ number_format($item['ThanhTien'] ?? 0, 0, ',', '.') }} VNĐ</td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger btn-sm" wire:click="removeVatTu({{ $stt }})">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            @if(count($ChiTietNhapKho) > 0)
                                                <tr class="table-info">
                                                    <td colspan="6" class="text-end fw-bold">TỔNG CỘNG:</td>
                                                    <td class="fw-bold text-danger">{{ number_format($this->getTongThanhTien(), 0, ',', '.') }} VNĐ</td>
                                                    <td></td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                    @if(count($ChiTietNhapKho) == 0)
                                        <div class="text-center text-muted py-3">
                                            <i class="fas fa-inbox fa-2x mb-2"></i>
                                            <p>Chưa có vật tư nào được thêm. Nhấn "Thêm vật tư" để bắt đầu.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" wire:click="closeModal">Hủy</button>
                            <button type="submit" class="btn btn-lg-red">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if ($isDelete)
        <div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5);"  tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Xóa Phiếu Nhập</h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Bạn có chắc chắn muốn xóa Phiếu Nhập này không?</p>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">Hủy</button>
                    <button type="button" class="btn btn-lg-red" wire:click="delete">Xóa</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($isDetail)
        <div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5);"  tabindex="-1">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Chi tiết Nhập Kho</h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <strong>Mã Phiếu Nhập:</strong> {{ $MaPhieuNhap }}
                            </div>
                        </div>
                        <table class="table table-hover table-light table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">STT</th>
                                    <th style="width: 10%;">Mã Vật Tư</th>
                                    <th style="width: 25%;">Tên Vật Tư</th>
                                    <th style="width: 8%;">Số Lượng</th>
                                    <th style="width: 10%;">Đơn Vị Tính</th>
                                    <th style="width: 12%;">Đơn giá</th>
                                    <th style="width: 12%;">Thành Tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ChiTietNhapKho as $stt => $item)
                                    <tr>
                                        <td class="text-center">{{ $stt + 1 }}</td>
                                        <td>{{ $item['MaVatTu'] ?? '' }}</td>
                                        <td>{{ $item['TenVatTu'] ?? '' }}</td>
                                        <td class="text-center">{{ $item['SoLuongNhap'] ?? 0 }}</td>
                                        <td class="text-center">{{ $item['DonViTinh'] ?? '' }}</td>
                                        <td class="text-end">{{ number_format($item['DonGia'] ?? 0, 0, ',', '.') }} VNĐ</td>
                                        <td class="text-end fw-bold">{{ number_format($item['ThanhTien'] ?? 0, 0, ',', '.') }} VNĐ</td>
                                    </tr>
                                @endforeach
                                <tr class="table-warning">
                                    <td colspan="6" class="text-end fw-bold">TỔNG CỘNG:</td>
                                    <td class="text-end fw-bold text-danger fs-5">{{ number_format($this->getTongThanhTien(), 0, ',', '.') }} VNĐ</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal">Hủy</button>
                        <button type="button" class="btn btn-lg-red" wire:click="exportExcel">Xuất Excel</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>