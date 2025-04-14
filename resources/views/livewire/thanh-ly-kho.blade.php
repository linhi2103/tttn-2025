<div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-title">Danh sách Thanh Lý Kho</h5>
                <div class="d-flex">
                    <input type="text" wire:model.live="search" class="form-control me-2" placeholder="Tìm kiếm...">
                    <button class="btn btn-lg-red ms-2" wire:click="showModalAdd">
                        <i class="fas fa-plus me-2"></i>Thêm Thanh Lý Kho
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
                        <th>Mã Thanh Lý Kho</th>
                        <th>Tên Vật Tư</th>
                        <th>Tên Kho</th>
                        <th>Tên Nhân Viên</th>
                        <th>Số Lượng</th>
                        <th>Ngày Lập</th>
                        <th>Trạng Thái</th>
                        <th>Lệnh Điều Động</th>
                        <th>Đơn Giá</th>
                        <th>Lý Do Thanh Lý</th>
                        <th>Biện Pháp Thanh Lý</th>
                        <th>Tình Trạng</th>
                        <th>Ghi Chú</th>
                        <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($phieuthanhlys as $item)
                            <tr>
                                <td>{{ $item->MaPhieuThanhLy }}</td>
                                <td>{{ $item->vattu->TenVatTu ?? 'N/A' }}</td>
                                <td>{{ $item->danhmuckho->TenKho ?? 'N/A' }}</td>
                                <td>{{ $item->nhanvien->TenNhanVien ?? 'N/A' }}</td>
                                <td>{{ $item->SoLuong }}</td>
                                <td>{{ $item->NgayLap }}</td>
                                <td>{{ $item->TrangThai ?? 'N/A' }}</td>
                                <td>{{ $item->lenhDieuDong->MaLenhDieuDong ?? 'N/A' }}</td>
                                <td>{{ $item->DonGia }}</td>
                                <td>{{ $item->LyDoThanhLy ?? 'N/A' }}</td>
                                <td>{{ $item->BienPhapThanhLy ?? 'N/A' }}</td>
                                <td>{{ $item->TinhTrang ?? 'N/A' }}</td>
                                <td>{{ $item->GhiChu ?? 'N/A' }}</td>
                                <td>
                                    <button class="btn bg-warning ms-2" title="Sửa" wire:click="showModalEdit('{{ $item->MaPhieuThanhLy }}')">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn bg-danger ms-2" title="Xóa" wire:click="showModalDelete('{{ $item->MaPhieuThanhLy }}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-between align-items-center">
                    Hiển thị từ {{ $phieuthanhlys->firstItem() ?? 0 }} đến {{ $phieuthanhlys->lastItem() ?? 0 }} trong tổng số {{ $phieuthanhlys->total() ?? 0 }} đơn vị tính
                    {{ $phieuthanhlys->links('pagination') }}
                </div>
            </div>
        </div>

        @if ($isAdd || $isEdit)
        <div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5);" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $isAdd ? 'Thêm Thanh Lý Kho' : 'Chỉnh sửa Thanh Lý Kho' }}</h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="{{ $isAdd ? 'save' : 'update' }}">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Mã Phiếu Thanh Lý</label>
                                    <input type="text" class="form-control @error('MaPhieuThanhLy') is-invalid @enderror" 
                                           wire:model="MaPhieuThanhLy" {{ $isEdit ? 'readonly' : '' }} required>
                                    @error('MaPhieuThanhLy') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
                                    <label>Số Lượng</label>
                                    <input type="number" class="form-control @error('SoLuong') is-invalid @enderror" 
                                           wire:model="SoLuong" min="1" required>
                                    @error('SoLuong') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Ngày Lập</label>
                                    <input type="date" class="form-control @error('NgayLap') is-invalid @enderror" 
                                           wire:model="NgayLap" required>
                                    @error('NgayLap') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Trạng Thái</label>
                                    <select class="form-control @error('TrangThai') is-invalid @enderror" 
                                            wire:model="TrangThai" required>
                                        <option value="">-- Chọn Trạng Thái --</option>
                                        <option value="Đã Thanh Lý">Đã Thanh Lý</option>
                                        <option value="Chờ duyệt">Chờ duyệt</option>
                                        <option value="Chưa Thanh Lý">Chưa Thanh Lý</option>
                                    </select>
                                    @error('TrangThai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Đơn Giá</label>
                                    <input type="number" class="form-control @error('DonGia') is-invalid @enderror" 
                                           wire:model="DonGia" min="0" required>
                                    @error('DonGia') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                
                                <div class="col-md-12 mb-3">
                                    <label>Lý Do Thanh Lý</label>
                                    <textarea class="form-control @error('LyDoThanhLy') is-invalid @enderror" 
                                              wire:model="LyDoThanhLy" required></textarea>
                                    @error('LyDoThanhLy') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label>Biện Pháp Thanh Lý</label>
                                    <textarea class="form-control @error('BienPhapThanhLy') is-invalid @enderror" 
                                              wire:model="BienPhapThanhLy" required></textarea>
                                    @error('BienPhapThanhLy') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
                                    @error('MaLenhDieuDong') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Tình Trạng</label>
                                    <input type="text" class="form-control" wire:model="TinhTrang">
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
                        <h5 class="modal-title">Xóa Thanh Lý Kho</h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Bạn có chắc chắn muốn xóa Thanh Lý Kho này không?</p>
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