<div>
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

            <div class="table-responsive">
                <table class="table table-hover table-light table-bordered">
                    <thead>
                        <tr>
                            <th>Mã Phiếu Nhập</th>
                            <th>Tên Vật Tư</th>
                            <th>Số Lượng</th>
                            <th>Đơn Giá</th>
                            <th>Thành Tiền</th>
                            <th>Mã Kho</th>
                            <th>Ngày Nhập</th>
                            <th>Mã Số Thuế - đối tác</th>
                            <th>Tên Nhân Viên</th>
                            <th>Lệnh Điều Động</th>
                            <th>Đơn Vị vận chuyển</th>
                            <th>Ngày Nhập</th>
                            <th>Địa Chỉ</th>
                            <th>Ghi chú</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nhapkhos as $item)
                            <tr>
                                <td>{{ $item->MaPhieuNhap }}</td>
                                <td>{{ $item->vattu->TenVatTu ?? 'N/A' }}</td>
                                <td>{{ $item->SoLuong }}</td>
                                <td>{{ number_format($item->DonGia, 0, ',', '.') }}</td>
                                <td>{{ number_format($item->ThanhTien, 0, ',', '.') }}</td>
                                <td>{{ $item->MaKho }}</td>
                                <td>{{ date('d/m/Y', strtotime($item->NgayNhap)) }}</td>
                                <td>{{ $item->doitac->MaSoThue_DoiTac ?? 'N/A' }}</td>
                                <td>{{ $item->nhanVien->TenNhanVien ?? 'N/A' }}</td>
                                <td>{{ $item->lenhDieuDong->MaLenhDieuDong ?? 'N/A' }}</td>
                                <td>{{ $item->donViVanChuyen->TenDonViVanChuyen ?? 'N/A' }}</td>
                                <td>{{ date('d/m/Y', strtotime($item->NgayNhap)) }}</td>
                                <td>{{ $item->DiaChi ?? 'N/A' }}</td>
                                <td>{{ $item->GhiChu ?? 'N/A' }}</td>
                                <td>
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
                    Hiển thị từ {{ $nhapkhos->firstItem() }} đến {{ $nhapkhos->lastItem() }} trong tổng số {{ $nhapkhos->total() }} đơn vị tính
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
                    <div class="modal-body">
                        <form wire:submit.prevent="{{ $isAdd ? 'save' : 'update' }}">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Mã Phiếu Nhập</label>
                                    <input type="text" class="form-control @error('MaPhieuNhap') is-invalid @enderror" 
                                           wire:model="MaPhieuNhap" {{ $isEdit ? 'readonly' : '' }} required>
                                    @error('MaPhieuNhap') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label>Mã Kho</label>
                                    <select class="form-control @error('MaKho') is-invalid @enderror" wire:model="MaKho" required>
                                        <option value="">-- Chọn Kho --</option>
                                        @foreach ($khos as $kho)
                                            <option value="{{ $kho->MaKho }}">{{ $kho->TenKho }}</option>
                                        @endforeach
                                    </select>
                                    @error('MaKho') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Tên Vật Tư</label>
                                    <select class="form-control @error('MaVatTu') is-invalid @enderror" wire:model.live="MaVatTu" required>
                                        <option value="">-- Chọn Vật Tư --</option>
                                        @foreach($vattus as $vatTu)
                                            <option value="{{ $vatTu->MaVatTu }}">{{ $vatTu->TenVatTu }}</option>
                                        @endforeach
                                    </select>
                                    @error('MaVatTu') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Số Lượng</label>
                                    <input type="number" class="form-control @error('SoLuong') is-invalid @enderror" wire:model.live="SoLuong" required>
                                    @error('SoLuong') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Đơn Giá</label>
                                    <input type="number" class="form-control @error('DonGia') is-invalid @enderror" wire:model="DonGia" required readonly>
                                    @error('DonGia') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Thành Tiền (tự động tính)</label>
                                    <input type="text" class="form-control" wire:model="ThanhTien" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Ngày Nhập</label>
                                    <input type="date" class="form-control @error('NgayNhap') is-invalid @enderror" 
                                           wire:model="NgayNhap" required>
                                    @error('NgayNhap') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Mã Số Thuế Đối Tác</label>
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
                                    <label>Mã Nhân Viên</label>
                                    <select class="form-control @error('MaNhanVien') is-invalid @enderror" 
                                            wire:model="MaNhanVien" required>
                                        <option value="">-- Chọn Nhân Viên --</option>
                                        @foreach ($nhanViens as $nhanvien)
                                            <option value="{{ $nhanvien->MaNhanVien }}">{{ $nhanvien->TenNhanVien }}</option>
                                        @endforeach
                                    </select>
                                    @error('MaNhanVien') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Mã Đơn Vị Vận Chuyển</label>
                                    <select class="form-control @error('MaDonViVanChuyen') is-invalid @enderror" 
                                            wire:model="MaDonViVanChuyen" required>
                                        <option value="">-- Chọn ĐVVC --</option>
                                        @foreach ($donViVanChuyen as $dvvc)
                                            <option value="{{ $dvvc->MaDonViVanChuyen }}">{{ $dvvc->TenDonViVanChuyen }}</option>
                                        @endforeach
                                    </select>
                                    @error('MaDonViVanChuyen') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Lệnh Điều Động (nếu có)</label>
                                    <select class="form-control" wire:model="MaLenhDieuDong">
                                        <option value="">-- Chọn Lệnh Điều Động --</option>
                                        @foreach($lenhDieuDongs as $ldd)
                                            <option value="{{ $ldd->MaLenhDieuDong }}">{{ $ldd->MaLenhDieuDong }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Địa Chỉ</label>
                                    <input type="text" class="form-control" wire:model="DiaChi">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label>Ghi Chú</label>
                                    <textarea class="form-control" wire:model="GhiChu"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" wire:click="closeModal">Hủy</button>
                        <button class="btn btn-lg-red" wire:click="{{ $isAdd ? 'save' : 'update' }}">Lưu</button>
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
    </div>
</div>