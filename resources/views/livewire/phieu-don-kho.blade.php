<div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-title">Danh sách Phiếu Dồn Kho</h5>
                <div class="d-flex">
                    <input type="text" wire:model.live="search" class="form-control me-2" placeholder="Tìm kiếm...">
                    <button class="btn btn-lg-red ms-2" wire:click="showModalAdd">
                        <i class="fas fa-plus me-2"></i>Thêm Phiếu Dồn
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
                            <th>Mã Phiếu Dồn</th>
                            <th>Ngày Tạo</th>
                            <th>Ngày Dồn</th>
                            <th>Tên Kho Nguồn</th>
                            <th>Tên Kho Dịch</th>
                            <th>Mã Vật Tư</th>
                            <th>Tên Vật Tư</th>
                            <th>Số Lượng</th>
                            <th>Tên Nhân Viên</th>
                            <th>Lệnh điều động</th>
                            <th>Mã Vận Chuyển</th>
                            <th>Trạng Thái</th>
                            <th>Ghi Chú</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($phieudonkho as $item)
                            <tr>
                                <td>{{ $item->MaPhieuDonKho }}</td>
                                <td>{{ $item->NgayTao }}</td>
                                <td>{{ $item->NgayDonKho }}</td>
                                <td>{{ $item->DanhMucKho->TenKho }}</td>
                                <td>{{ $item->DanhMucKho2->TenKho }}</td>
                                <td>{{ $item->vatTu->MaVatTu }}</td>
                                <td>{{ $item->vatTu->TenVatTu }}</td>
                                <td>{{ $item->SoLuong }}</td>
                                <td>{{ $item->nhanVien->TenNhanVien }}</td>
                                <td>{{ $item->lenhDieuDong->MaLenhDieuDong }}</td>
                                <td>{{ $item->vanChuyen->MaVanChuyen }}</td>
                                <td>{{ $item->TrangThai }}</td>
                                <td>{{ $item->GhiChu }}</td>
                                <td>
                                    <button class="btn bg-warning ms-2" title="Sửa" wire:click="showModalEdit('{{ $item->MaPhieuDonKho }}')">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn bg-danger ms-2" title="Xóa" wire:click="showModalDelete('{{ $item->MaPhieuDonKho }}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                                <td>{{ date('d/m/Y', strtotime($item->NgayTao)) }}</td>
                                <td>{{ $item->nhanvien->TenNhanVien ?? 'N/A' }}</td>
                                <td>{{ $item->vatTu->MaVatTu ?? 'N/A' }}</td>
                                <td>{{ $item->vatTu->TenVatTu ?? 'N/A' }}</td>
                                <td>{{ $item->DanhMucKho->TenKho ?? 'N/A' }}</td>
                                <td>{{ $item->DanhMucKho2->TenKho ?? 'N/A' }}</td>
                                <td>{{ $item->lenhDieuDong->MaLenhDieuDong ?? 'N/A' }}</td>
                                <td>{{ $item->vanChuyen->TenDonViVanChuyen ?? 'N/A' }}</td>
                                <td>{{ date('d/m/Y', strtotime($item->NgayDonKho)) }}</td>
                                <td>{{ $item->SoLuong }}</td>
                                <td>{{ $item->TrangThai ?? 'N/A' }}</td>
                                <td>{{ $item->GhiChu ?? 'N/A' }}</td>
                                <td>
                                    <button class="btn bg-warning ms-2" title="Sửa" wire:click="showModalEdit('{{ $item->MaPhieuDonKho }}')">
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
                    Hiển thị từ {{ $phieudonkho->firstItem() }} đến {{ $phieudonkho->lastItem() }} trong tổng số {{ $phieudonkho->total() }} đơn vị tính
                    {{ $phieudonkho->links('pagination') }}
                </div>
            </div>
        </div>

        @if ($isAdd || $isEdit)
        <div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5);" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $isAdd ? 'Thêm Phiếu Đơn Kho' : 'Chỉnh sửa Phiếu Đơn Kho' }}</h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="{{ $isAdd ? 'save' : 'update' }}">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Mã Phiếu Đơn Kho</label>
                                    <input type="text" class="form-control @error('MaPhieuDonKho') is-invalid @enderror" 
                                           wire:model="MaPhieuDonKho" {{ $isEdit ? 'readonly' : '' }} required>
                                    @error('MaPhieuDonKho') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Ngày Dồn Kho</label>
                                    <input type="date" class="form-control @error('NgayDonKho') is-invalid @enderror" 
                                           wire:model="NgayDonKho" required>
                                    @error('NgayDonKho') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Ngày Tạo</label>
                                    <input type="date" class="form-control @error('NgayTao') is-invalid @enderror" 
                                           wire:model="NgayTao" required>
                                    @error('NgayTao') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Tên Kho Nguồn</label>
                                    <select class="form-control @error('TenKho') is-invalid @enderror" wire:model="TenKho" required>
                                        <option value="">-- Chọn Kho --</option>
                                        @foreach ($khos as $kho)
                                            <option value="{{ $kho->MaKho }}">{{ $kho->TenKho }}</option>
                                        @endforeach
                                    </select>
                                    @error('TenKho') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Tên Kho Đích</label>
                                    <select class="form-control @error('TenKho') is-invalid @enderror" wire:model="TenKho" required>
                                        <option value="">-- Chọn Kho --</option>
                                        @foreach ($khos as $kho)
                                            <option value="{{ $kho->MaKho }}">{{ $kho->TenKho }}</option>
                                        @endforeach
                                    </select>
                                    @error('TenKho') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Mã Vật Tư</label>
                                    <select class="form-control @error('MaVatTu') is-invalid @enderror" wire:model="MaVatTu" required>
                                        <option value="">-- Chọn Vật Tư --</option>
                                        @foreach ($vatTus as $vattu)
                                            <option value="{{ $vattu->MaVatTu }}">{{ $vattu->MaVatTu }}</option>
                                        @endforeach
                                    </select>
                                    @error('MaVatTu') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Tên Vật Tư</label>
                                    <select class="form-control @error('TenVatTu') is-invalid @enderror" wire:model="TenVatTu" required>
                                        <option value="">-- Chọn Vật Tư --</option>
                                        @foreach ($vatTus as $vattu)
                                            <option value="{{ $vattu->MaVatTu }}">{{ $vattu->TenVatTu }}</option>
                                        @endforeach
                                    </select>
                                    @error('TenVatTu') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Số Lượng</label>
                                    <input type="number" class="form-control @error('SoLuong') is-invalid @enderror" 
                                           wire:model="SoLuong" min="1" required>
                                    @error('SoLuong') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
                                    <label>Trạng thái</label>
                                    <select class="form-control @error('TrangThai') is-invalid @enderror" 
                                            wire:model="TrangThai" required>
                                        <option value="">-- Chọn Trạng Thái --</option>
                                        <option value="1">Đang xử lý</option>
                                        <option value="2">Đã hoàn thành</option>
                                    </select>
                                    @error('TrangThai') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
                        <h5 class="modal-title">Xóa Phiếu Dồn Kho</h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Bạn có chắc chắn muốn xóa Phiếu Dồn Kho này không?</p>
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