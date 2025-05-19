<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center me-2">
            <h5 class="card-title">Danh sách Chi tiết Vật Tư</h5>
            <div class="d-flex" style="height: 60px;">
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
                        <th>Loại Vật Tư</th>
                        <th>Thương Hiệu</th>
                        <th>Kích Thước</th>
                        <th>Xuất Xứ</th>
                        <th>Mô Tả</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vatTus as $vatTu)
                        <tr>
                            <td><img src="{{ asset('images/' . $vatTu->AnhVatTu) }}" alt="{{ $vatTu->TenVatTu }}" width="120" height="120"></td>
                            <td>{{ $vatTu->MaVatTu }}</td>
                            <td>{{ $vatTu->loaivattu->TenLoaiVatTu }}</td>
                            <td>{{ $vatTu->ThuongHieu }}</td>
                            <td>{{ $vatTu->KichThuoc }}</td>
                            <td>{{ $vatTu->XuatXu }}</td>
                            <td>{{ $vatTu->MoTa }}</td>
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
                Hiển thị từ {{ $chitietvattu->firstItem() }} đến {{ $chitietvattu->lastItem() }} trong tổng số {{ $chitietvattu->total() }} vật tư
                {{ $chitietvattu->links('pagination') }}
            </div>
        </div>
    </div>
    @if ($isAdd || $isEdit)
    <div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5);"  tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $isAdd ? 'Thêm Chi tiết Vật Tư' : 'Chỉnh sửa Chi tiết Vật Tư' }}</h5>
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
                                <label class="form-label">Thương Hiệu</label>
                                <input type="text" class="form-control" wire:model="ThuongHieu" value="{{ $ThuongHieu || '' }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kích Thước</label>
                                <input type="text" class="form-control" wire:model="KichThuoc" value="{{ $KichThuoc || '' }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Xuất Xứ</label>
                                <input type="text" class="form-control" wire:model="XuatXu" value="{{ $XuatXu || '' }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Mô Tả</label>
                                <input type="text" class="form-control" wire:model="MoTa" value="{{ $MoTa || 'Không có mô tả' }}" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Ảnh Vật Tư</label>
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
                    <h5 class="modal-title">Xóa Chi tiết Vật Tư</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc chắn muốn xóa Chi tiết Vật Tư này không?</p>
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