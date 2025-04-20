<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center me-2">
            <h5 class="card-title">Danh sách Vật Tư</h5>
            <div class="d-flex" style="height: 60px;">
                <select class="form-select me-2" wire:model.live="filter">
                    <option value="">-- Chọn Loại Vật Tư --</option>
                    @foreach($loaivattus as $loaivattu)
                        <option value="{{ $loaivattu->MaLoaiVatTu }}" {{ $loaivattu->MaLoaiVatTu == $MaLoaiVatTu ? 'selected': '' }}>{{ $loaivattu->TenLoaiVatTu }}</option>
                    @endforeach
                </select>
                <input type="text" wire:model.live="search" class="form-control me-2" placeholder="Tìm kiếm Vật Tư">
                <button class="btn btn-lg-red ms-2" wire:click="showModalAdd" style="white-space: nowrap;">
                    <i class="fas fa-plus me-2"></i>Thêm Vật Tư
                </button>
            </div>
        </div>
    </div>
    <div class="card-body">
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
                        <th>Ảnh Vật Tư</th>
                        <th>Mã Vật Tư</th>
                        <th>Tên Loại Vật Tư</th>
                        <th>Tên Vật Tư</th>
                        <th>Đơn Vị Tính</th>
                        <th>Giá Nhập</th>
                        <th>Giá Xuất</th>
                        <th>Số Lượng Tồn</th>
                        <th>Trạng Thái</th> 
                        <th>Mã Số Thuế</th>
                        <th>Ngày Nhập</th>
                        <th>Hạn Sử Dụng</th>
                        <th>Ghi Chú</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vatTus as $vatTu)
                        <tr>
                            <td><img src="{{ asset('images/' . $vatTu->AnhVatTu) }}" alt="{{ $vatTu->TenVatTu }}" width="120" height="120"></td>
                            <td>{{ $vatTu->MaVatTu }}</td>
                            <td>{{ $vatTu->loaivattu->TenLoaiVatTu }}</td>
                            <td>{{ $vatTu->TenVatTu }}</td>
                            <td>{{ $vatTu->donvitinh->TenDonViTinh }}</td>
                            <td>{{ $vatTu->GiaNhap }}</td>
                            <td>{{ $vatTu->GiaXuat }}</td>
                            <td>{{ $vatTu->SoLuongTon }}</td>
                            <td>
                                <span class="badge rounded-pill {{ $vatTu->TinhTrang == 'Còn hàng' ? 'bg-success' : ($vatTu->TinhTrang == 'Gần hết' ? 'bg-warning' : 'bg-danger') }}">
                                    {{ $vatTu->TinhTrang }}
                                </span>
                            </td>
                            <td>{{ $vatTu->doitac->MaSoThue_DoiTac }}</td>
                            <td>{{ $vatTu->NgayNhap }}</td>
                            <td>{{ $vatTu->HanSuDung }}</td>
                            <td>{{ $vatTu->GhiChu }}</td>
                            <td>
                                <button class="btn bg-warning ms-2" title="Sửa" wire:click="showModalEdit('{{ $vatTu->MaVatTu }}')">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn bg-danger ms-2" title="Xóa" wire:click="showModalDelete('{{ $vatTu->MaVatTu }}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-between align-items-center">
                Hiển thị từ {{ $vatTus->firstItem() }} đến {{ $vatTus->lastItem() }} trong tổng số {{ $vatTus->total() }} vật tư
                {{ $vatTus->links('pagination') }}
            </div>
        </div>
    </div>
    @if ($isAdd || $isEdit)
    <div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5);"  tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $isAdd ? 'Thêm Vật Tư' : 'Chỉnh sửa Vật Tư' }}</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="isAdd ? save : update" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Mã Vật Tư</label>
                                <input type="text" class="form-control" wire:model="MaVatTu" {{ $isEdit ? 'readonly' : '' }} required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tên Vật Tư</label>
                                <input type="text" class="form-control" wire:model="TenVatTu" value="{{ $TenVatTu || '' }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Loại Vật Tư</label>
                                <select class="form-select" wire:model="MaLoaiVatTu" required>
                                    <option value="">-- Chọn Loại Vật Tư --</option>
                                    @foreach($loaivattus as $loaivattu)
                                        <option value="{{ $loaivattu->MaLoaiVatTu }}" {{ $loaivattu->MaLoaiVatTu == $MaLoaiVatTu ? 'selected' : '' }}>{{ $loaivattu->TenLoaiVatTu }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Đơn Vị Tính</label>
                                <select class="form-select" wire:model="MaDonViTinh" required>
                                    <option value="">-- Chọn Đơn Vị Tính --</option>
                                    @foreach($donvitinhs as $donvitinh)
                                        <option value="{{ $donvitinh->MaDonViTinh }}" {{ $donvitinh->MaDonViTinh == $MaDonViTinh ? 'selected' : '' }}>{{ $donvitinh->TenDonViTinh }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Giá Nhập</label>
                                <input type="number" class="form-control" wire:model="GiaNhap" value="{{ $GiaNhap || 0 }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Giá Xuất</label>
                                <input type="number" class="form-control" wire:model="GiaXuat" value="{{ $GiaXuat || 0 }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Đơn Vị Tiền Tệ</label>
                                <input type="text" class="form-control" wire:model="DonViTienTe" value="{{ $DonViTienTe || 'VND' }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Số Lượng Tồn</label>
                                <input type="number" class="form-control" wire:model="SoLuongTon" value="{{ $SoLuongTon || 0 }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tình Trạng</label>
                                <input type="text" class="form-control" wire:model="TinhTrang" value="{{ $TinhTrang || 'Còn hàng' }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Đối Tác</label>
                                <select class="form-select" wire:model="MaSoThue_DoiTac" required>
                                    <option value="">-- Chọn Đối Tác --</option>
                                    @foreach($doitacs as $doitac)
                                        <option value="{{ $doitac->MaSoThue_DoiTac }}" {{ $doitac->MaSoThue_DoiTac == $MaSoThue_DoiTac ? 'selected' : '' }}>{{ $doitac->TenDoiTac }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Ngày Nhập</label>
                                <input type="date" class="form-control" wire:model="NgayNhap" value="{{ $NgayNhap ? new DateTime($NgayNhap)->format('Y-m-d') : '' }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Hạn Sử Dụng</label>
                                <input type="date" class="form-control" wire:model="HanSuDung" value="{{ $HanSuDung ? new DateTime($HanSuDung)->format('Y-m-d') : '' }}">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Ghi Chú</label>
                                <textarea class="form-control" wire:model="GhiChu" rows="3">{{ $GhiChu || '' }}</textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Ảnh Vật Tư</label>
                                <!-- <input type="file" class="form-control" wire:model="AnhVatTu" placeholder="Nhập URL ảnh" value="{{ $AnhVatTu ? basename($AnhVatTu) : ''}}"> -->
                                <input type="file" class="form-control" wire:model="AnhVatTu">
                                <div class="mt-2">
                                    <img src="{{ asset('images/' . $AnhVatTu) }}" alt="Ảnh xem trước" style="max-width: 200px; max-height: 200px; object-fit: cover;">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">Hủy</button>
                    <button type="button" class="btn btn-danger" wire:click="{{ $isEdit ? 'update' : 'save' }}">Lưu</button>
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
                    <h5 class="modal-title">Xóa Vật Tư</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc chắn muốn xóa Vật Tư này không?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">Hủy</button>
                    <button type="button" class="btn btn-danger" wire:click="delete">Xóa</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>