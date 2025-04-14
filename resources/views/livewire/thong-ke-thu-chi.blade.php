<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title">Danh sách Thống kê Thu Chi</h5>
            <div class="d-flex">
            <input type="text" wire:model.live="search" class="form-control me-2" placeholder="Tìm kiếm...">
                <button class="btn btn-lg-red ms-2" wire:click="showModalAdd">
                    <i class="fas fa-plus me-2"></i>Thêm Thống kê
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
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Mã Thống kê</th>
                        <th>Ngày Thống kê</th>
                        <th>Tên Vật Tư</th>
                        <th>Từ ngày</th>
                        <th>Đến ngày</th>
                        <th>Tên Kho</th>
                        <th>Đơn Giá</th>
                        <th>Đơn Vị Tiền Tệ</th>
                        <th>Tổng Thu</th>
                        <th>Tổng Chi</th>
                        <th>Chênh lệch Thu Chi</th>
                        <th>Tên Nhân Viên</th>
                        <th>Trạng Thái</th>
                        <th>Ghi Chú</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($thongketuchis as $item)
                        <tr>
                            <td>{{ $item->MaThongKeThuChi }}</td>
                            <td>{{ date('d/m/Y', strtotime($item->NgayThongKe)) }}</td>
                            <td>{{ $item->vatTu->TenVatTu ?? 'N/A' }}</td>
                            <td>{{ date('d/m/Y', strtotime($item->Tungay)) }}</td>
                            <td>{{ date('d/m/Y', strtotime($item->Denngay)) }}</td>
                            <td>{{ $item->danhmuckho->TenKho ?? 'N/A' }}</td>
                            <td>{{ $item->DonGia }}</td>
                            <td>{{ $item->DonViTienTe }}</td>
                            <td>{{ $item->TongThu }}</td>
                            <td>{{ $item->TongChi }}</td>
                            <td>{{ $item->ChenhLechThuChi }}</td>
                            <td>{{ $item->nhanVien->TenNhanVien ?? 'N/A' }}</td>
                            <td>{{ $item->TrangThai }}</td>
                            <td>{{ $item->GhiChu ?? 'N/A' }}</td>
                            <td>
                                <button class="btn bg-warning ms-2" title="Sửa" wire:click="showModalEdit('{{ $item->MaThongKeThuChi }}')">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn bg-danger ms-2" title="Xóa" wire:click="showModalDelete('{{ $item->MaThongKeThuChi }}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-between align-items-center">
                Hiển thị từ {{ $thongketuchis->firstItem() }} đến {{ $thongketuchis->lastItem() }} trong tổng số {{ $thongketuchis->total() }} phiếu xuất kho
                {{ $thongketuchis->links('pagination') }}
            </div>
        </div>
    </div>

    @if ($isAdd || $isEdit)
    <div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $isAdd ? 'Thêm Phiếu Thống kê' : 'Chỉnh sửa Phiếu Thống kê' }}</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <form wire:submit.prevent="{{ $isAdd ? 'save' : 'update' }}">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Mã Thống kê</label>
                                <input type="text" class="form-control @error('MaThongKeThuChi') is-invalid @enderror" 
                                        wire:model="MaThongKeThuChi" {{ $isEdit ? 'readonly' : '' }} required>
                                @error('MaThongKeThuChi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Ngày Thống kê</label>
                                <input type="date" class="form-control @error('NgayThongKe') is-invalid @enderror" 
                                        wire:model="NgayThongKe" required>
                                @error('NgayThongKe') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
                                <label>Từ ngày</label>
                                <input type="date" class="form-control @error('Tungay') is-invalid @enderror" 
                                        wire:model="Tungay" required>
                                @error('Tungay') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Đến ngày</label>
                                <input type="date" class="form-control @error('Denngay') is-invalid @enderror" 
                                        wire:model="Denngay" required>
                                @error('Denngay') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Tên Kho</label>
                                <select class="form-control @error('MaKho') is-invalid @enderror" wire:model="MaKho" required>
                                    <option value="">-- Chọn Kho --</option>
                                    @foreach ($danhmuckhos as $kho)
                                        <option value="{{ $kho->MaKho }}">{{ $kho->TenKho }}</option>
                                    @endforeach
                                </select>
                                @error('MaKho') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Đơn Giá</label>
                                <input type="number" class="form-control @error('DonGia') is-invalid @enderror" 
                                        wire:model="DonGia" required>
                                @error('DonGia') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Đơn Vị Tiền Tệ</label>
                                <input type="text" class="form-control @error('DonViTienTe') is-invalid @enderror" 
                                        wire:model="DonViTienTe" required>
                                @error('DonViTienTe') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Tổng Thu</label>
                                <input type="number" class="form-control @error('TongThu') is-invalid @enderror" 
                                        wire:model="TongThu" required>
                                @error('TongThu') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Tổng Chi</label>
                                <input type="number" class="form-control @error('TongChi') is-invalid @enderror" 
                                        wire:model="TongChi" required>
                                @error('TongChi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Chênh lệch Thu Chi</label>
                                <input type="number" class="form-control @error('ChenhLechThuChi') is-invalid @enderror" 
                                        wire:model="ChenhLechThuChi" required>
                                @error('ChenhLechThuChi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Tên Nhân Viên</label>
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
                                <label>Trạng Thái</label>
                                <select class="form-control @error('TrangThai') is-invalid @enderror" 
                                        wire:model="TrangThai" required>
                                    <option value="">-- Chọn Trạng Thái --</option>
                                    <option value="1">Đã Thống kê</option>
                                    <option value="0">Chưa Thống kê</option>
                                </select>
                                @error('TrangThai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Ghi Chú</label>
                                <textarea class="form-control @error('GhiChu') is-invalid @enderror"
                                          wire:model="GhiChu" required></textarea>
                                @error('GhiChu') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal">Hủy</button>
                        <button type="submit" class="btn btn-danger">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    @if ($isDelete)
    <div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5);"  tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Xóa Thống kê</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc chắn muốn xóa Thống kê này không?</p>
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