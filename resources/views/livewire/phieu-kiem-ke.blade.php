<div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-title">Danh sách Phiếu Kiểm Kê</h5>
                <div class="d-flex">
                    <input type="text" wire:model.live="search" class="form-control me-2" placeholder="Tìm kiếm...">
                    <button class="btn btn-lg-red ms-2" wire:click="showModalAdd">
                        <i class="fas fa-plus me-2"></i>Thêm Phiếu Kiểm Kê
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
                        <th>Mã Phiếu Kiểm Kê</th>
                        <th>Mã Vật Tư</th>
                        <th>Tên Vật Tư</th>
                        <th>Mã Kho</th>
                        <th>Mã Nhân Viên</th>
                        <th>Tên Nhân Viên</th>
                        <th>Chênh Lệch</th>
                        <th>Ngày Kiểm Kê</th>
                        <th>Trạng Thái</th>
                        <th>Mã Lệnh Điều Động</th>
                        <th>Số Lượng Thực Tế</th>
                        <th>Số Lượng Hệ Thống</th>
                        <th>Tình Trạng</th>
                        <th>Ghi Chú</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($phieukiemkes as $item)
                            <tr>
                                <td>{{ $item->MaPhieuKiemKe }}</td>
                                <td>{{ $item->MaVatTu }}</td>
                                <td>{{ $item->vattu->TenVatTu ?? 'N/A' }}</td>
                                <td>{{ $item->MaKho }}</td>
                                <td>{{ $item->nhanvien->MaNhanVien ?? 'N/A' }}</td>
                                <td>{{ $item->nhanvien->TenNhanVien ?? 'N/A' }}</td>
                                <td>{{ $item->ChenhLech }}</td>
                                <td>{{ $item->NgayKiemKe }}</td>
                                <td>{{ $item->TrangThai ?? 'N/A' }}</td>
                                <td>{{ $item->lenhDieuDong->MaLenhDieuDong ?? 'N/A' }}</td>
                                <td>{{ $item->SoLuongThucTe }}</td>
                                <td>{{ $item->SoLuongHeThong }}</td>
                                <td>{{ $item->TinhTrang ?? 'N/A' }}</td>
                                <td>{{ $item->GhiChu ?? 'N/A' }}</td>
                                <td>
                                    <button class="btn bg-warning ms-2" title="Sửa" wire:click="showModalEdit('{{ $item->MaPhieuKiemKe }}')">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn bg-danger ms-2" title="Xóa" wire:click="showModalDelete('{{ $item->MaPhieuKiemKe }}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-between align-items-center">
                    Hiển thị từ {{ $phieukiemkes->firstItem() }} đến {{ $phieukiemkes->lastItem() }} trong tổng số {{ $phieukiemkes->total() }} đơn vị tính
                    {{ $phieukiemkes->links('pagination') }}
                </div>
            </div>
        </div>

        @if ($isAdd || $isEdit)
        <div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5);" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $isAdd ? 'Thêm Phiếu Kiểm Kê' : 'Chỉnh sửa Phiếu Kiểm Kê' }}</h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="{{ $isAdd ? 'save' : 'update' }}">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Mã Phiếu Kiểm Kê</label>
                                    <input type="text" class="form-control @error('MaPhieuKiemKe') is-invalid @enderror" 
                                           wire:model="MaPhieuKiemKe" {{ $isEdit ? 'readonly' : '' }} required>
                                    @error('MaPhieuKiemKe') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Tên Vật Tư</label>
                                    <select class="form-control @error('MaVatTu') is-invalid @enderror" wire:model="MaVatTu" required>
                                        <option value="">-- Chọn Vật Tư --</option>
                                        @foreach ($vattus as $vattu)
                                            <option value="{{ $vattu->MaVatTu }}">{{ $vattu->TenVatTu }}</option>
                                        @endforeach
                                    </select>
                                    @error('MaVatTu') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Mã Kho</label>
                                    <select class="form-control @error('MaKho') is-invalid @enderror" wire:model="MaKho" required>
                                        <option value="">-- Chọn Kho --</option>
                                        @foreach ($danhmuckhos as $kho)
                                            <option value="{{ $kho->MaKho }}">{{ $kho->TenKho }}</option>
                                        @endforeach
                                    </select>
                                    @error('MaKho') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Mã Nhân Viên</label>
                                    <select class="form-control @error('MaNhanVien') is-invalid @enderror" 
                                            wire:model="MaNhanVien" required>
                                        <option value="">-- Chọn Nhân Viên --</option>
                                        @foreach ($nhanViens as $nhanvien)
                                            <option value="{{ $nhanvien->MaNhanVien }}">{{ $nhanvien->MaNhanVien }}</option>
                                        @endforeach
                                    </select>
                                    @error('MaNhanVien') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Chênh Lệch</label>
                                    <input type="number" class="form-control @error('ChenhLech') is-invalid @enderror" 
                                           wire:model="ChenhLech" min="1" required>
                                    @error('ChenhLech') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Ngày Kiểm Kê</label>
                                    <input type="date" class="form-control @error('NgayKiemKe') is-invalid @enderror" 
                                           wire:model="NgayKiemKe" required>
                                    @error('NgayKiemKe') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Trạng Thái</label>
                                    <select class="form-control @error('TrangThai') is-invalid @enderror" 
                                            wire:model="TrangThai" required>
                                        <option value="">-- Chọn Trạng Thái --</option>
                                        <option value="1">Đã Kiểm Kê</option>
                                        <option value="0">Chưa Kiểm Kê</option>
                                    </select>
                                    @error('TrangThai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Lệnh Điều Động (nếu có)</label>
                                    <select class="form-control @error('MaLenhDieuDong') is-invalid @enderror" 
                                            wire:model="MaLenhDieuDong">
                                        <option value="">-- Chọn Lệnh Điều Động --</option>
                                        @foreach($lenhDieuDongs as $ldd)
                                            <option value="{{ $ldd->MaLenhDieuDong }}">{{ $ldd->MaLenhDieuDong }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                
                                <div class="col-md-6 mb-3">
                                    <label>Số Lượng Thực Tế</label>
                                    <input type="number" class="form-control @error('SoLuongThucTe') is-invalid @enderror" 
                                           wire:model="SoLuongThucTe" min="0" required>
                                    @error('SoLuongThucTe') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Số Lượng Hệ Thống</label>
                                    <input type="number" class="form-control @error('SoLuongHeThong') is-invalid @enderror" 
                                           wire:model="SoLuongHeThong" min="0" required>
                                    @error('SoLuongHeThong') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Tình Trạng</label>
                                    <select class="form-control @error('TinhTrang') is-invalid @enderror" 
                                            wire:model="TinhTrang" required>
                                        <option value="">-- Chọn Tình Trạng --</option>
                                        <option value="1">Đã Kiểm Kê</option>
                                        <option value="0">Chưa Kiểm Kê</option>
                                    </select>
                                    @error('TinhTrang') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
                        <button class="btn btn-primary" wire:click="{{ $isAdd ? 'save' : 'update' }}">Lưu</button>
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
                        <h5 class="modal-title">Xóa Phiếu Kiểm Kê</h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Bạn có chắc chắn muốn xóa Phiếu Kiểm Kê này không?</p>
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