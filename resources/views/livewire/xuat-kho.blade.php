<div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-title">Danh sách Phiếu Xuất Kho</h5>
                <div class="d-flex">
                    <input type="text" wire:model.live="search" class="form-control me-2" placeholder="Tìm kiếm...">
                    <button class="btn btn-lg-red ms-2" wire:click="showModalAdd">
                        <i class="fas fa-plus me-2"></i>Thêm Phiếu Xuất
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
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Mã Phiếu Xuất</th>
                            <th>Tên Vật Tư</th>
                            <th>Số Lượng</th>
                            <th>Đơn Giá</th>
                            <th>Thành Tiền</th>
                            <th>Mã Kho</th>
                            <th>Ngày Xuất</th>
                            <th>Mã Số Thuế - đối tác</th>
                            <th>Tên Nhân Viên</th>
                            <th>Lệnh Điều Động</th>
                            <th>Đơn Vị vận chuyển</th>
                            <th>Ngày Lập</th>
                            <th>Địa Chỉ</th>
                            <th>Ghi chú</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($xuatkhos as $item)
                            <tr>
                                <td>{{ $item->MaPhieuXuat }}</td>
                                <td>{{ $item->vattu->TenVatTu ?? 'N/A' }}</td>
                                <td>{{ $item->SoLuong }}</td>
                                <td>{{ number_format($item->DonGia, 0, ',', '.') }}</td>
                                <td>{{ number_format($item->ThanhTien, 0, ',', '.') }}</td>
                                <td>{{ $item->MaKho }}</td>
                                <td>{{ date('d/m/Y', strtotime($item->NgayXuat)) }}</td>
                                <td>{{ $item->doitac->MaSoThue_DoiTac ?? 'N/A' }}</td>
                                <td>{{ $item->nhanvien->TenNhanVien ?? 'N/A' }}</td>
                                <td>{{ $item->lenhDieuDong->MaLenhDieuDong ?? 'N/A' }}</td>
                                <td>{{ $item->donvivanchuyen->TenDonViVanChuyen ?? 'N/A' }}</td>
                                <td>{{ date('d/m/Y', strtotime($item->NgayLap)) }}</td>
                                <td>{{ $item->DiaChi ?? 'N/A' }}</td>
                                <td>{{ $item->GhiChu ?? 'N/A' }}</td>
                                <td>
                                    <button class="btn bg-warning ms-2" title="Sửa" wire:click="showModalEdit('{{ $item->MaPhieuXuat }}')">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn bg-danger ms-2" title="Xóa" wire:click="showModalDelete('{{ $item->MaPhieuXuat }}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-between align-items-center">
                    Hiển thị từ {{ $xuatkhos->firstItem() }} đến {{ $xuatkhos->lastItem() }} trong tổng số {{ $xuatkhos->total() }} đơn vị tính
                    {{ $xuatkhos->links('pagination') }}
                </div>
            </div>
        </div>

        @if ($isAdd || $isEdit)
        <div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5);" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $isAdd ? 'Thêm Phiếu Xuất' : 'Chỉnh sửa Phiếu Xuất' }}</h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="{{ $isAdd ? 'save' : 'update' }}">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Mã Phiếu Xuất</label>
                                    <input type="text" class="form-control @error('MaPhieuXuat') is-invalid @enderror" 
                                           wire:model="MaPhieuXuat" {{ $isEdit ? 'readonly' : '' }} required>
                                    @error('MaPhieuXuat') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
                                    <label>Mã Vật Tư</label>
                                    <select class="form-control @error('MaVatTu') is-invalid @enderror" wire:model="MaVatTu" required>
                                        <option value="">-- Chọn Vật Tư --</option>
                                        @foreach ($vatTus as $vattu)
                                            <option value="{{ $vattu->MaVatTu }}">{{ $vattu->TenVatTu }}</option>
                                        @endforeach
                                    </select>
                                    @error('MaVatTu') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Số Lượng</label>
                                    <input type="number" class="form-control @error('SoLuong') is-invalid @enderror" 
                                           wire:model="SoLuong" min="1" required>
                                    @error('SoLuong') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Đơn Giá</label>
                                    <input type="number" class="form-control @error('DonGia') is-invalid @enderror" 
                                           wire:model="DonGia" min="0" required>
                                    @error('DonGia') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Thành Tiền (tự động tính)</label>
                                    <input type="text" class="form-control" 
                                           value="{{ number_format($SoLuong * $DonGia, 0, ',', '.') }}" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Ngày Xuất</label>
                                    <input type="date" class="form-control @error('NgayXuat') is-invalid @enderror" 
                                           wire:model="NgayXuat" required>
                                    @error('NgayXuat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Mã Số Thuế Đối Tác</label>
                                    <select class="form-control @error('MaSoThue_DoiTac') is-invalid @enderror" 
                                            wire:model="MaSoThue_DoiTac" required>
                                        <option value="">-- Chọn Đối Tác --</option>
                                        @foreach ($doiTacs as $doitac)
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
                                        @foreach ($donViVanChuyens as $dvvc)
                                            <option value="{{ $dvvc->MaDonViVanChuyen }}">{{ $dvvc->TenDonViVanChuyen }}</option>
                                        @endforeach
                                    </select>
                                    @error('MaDonViVanChuyen') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Lệnh Điều Động (nếu có)</label>
                                    <select wire:model="MaLenhDieuDong">
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
                        <button class="btn btn-danger" wire:click="{{ $isAdd ? 'save' : 'update' }}">Lưu</button>
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
                        <h5 class="modal-title">Xóa Phiếu Xuất</h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Bạn có chắc chắn muốn xóa Phiếu Xuất này không?</p>
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