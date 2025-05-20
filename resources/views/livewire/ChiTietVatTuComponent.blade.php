<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center me-2">
            <h5 class="card-title">Danh sách Chi tiết Vật Tư</h5>
            <div class="d-flex" style="height: 60px;">
                <input type="text" wire:model.live="search" class="form-control me-2" placeholder="Tìm kiếm Vật Tư">
                <button class="btn btn-lg-red ms-2" wire:click="showModalAdd" style="white-space: nowrap;">
                    <i class="fas fa-plus me-2"></i>Thêm chi tiết Vật Tư
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
            <table class="table table-hover table-light table-bordered">
                <thead>
                    <tr>
                        <th>Ảnh Vật Tư</th>
                        <th>Mã Vật Tư</th>
                        <th>Tên Vật Tư</th>
                        <th>Loại Vật Tư</th>
                        <th>Thương Hiệu</th>
                        <th>Kích Thước</th>
                        <th>Xuất Xứ</th>
                        <th>Mô Tả</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($chitietvatTus as $chitietvatTu)
                        <tr>
                            <td>
                                @if ($chitietvatTu->vatTu)
                                    <img src="{{ asset('images/' . $chitietvatTu->vatTu->AnhVatTu) }}" alt="{{ $chitietvatTu->vatTu->TenVatTu }}" width="120" height="120">
                                @else
                                    <span>Không có ảnh</span>
                                @endif
                            </td>
                            <td>{{ $chitietvatTu?->vatTu?->MaVatTu ?? 'N/A' }}</td>
                            <td>{{ $chitietvatTu?->vatTu?->TenVatTu ?? 'N/A' }}</td>
                            <td>{{ $chitietvatTu?->vatTu?->loaivattu?->TenLoaiVatTu ?? 'N/A' }}</td>
                            <td>{{ $chitietvatTu?->ThuongHieu ?? 'N/A' }}</td>
                            <td>{{ $chitietvatTu?->KichThuoc ?? 'N/A' }}</td>
                            <td>{{ $chitietvatTu?->XuatXu ?? 'N/A' }}</td>
                            <td>{{ $chitietvatTu?->MoTa ?? 'N/A' }}</td>
                            <td>
                                <button class="btn bg-warning ms-2" title="Sửa" wire:click="showModalEdit('{{ $chitietvatTu->MaVatTu }}')">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn bg-danger ms-2" title="Xóa" wire:click="showModalDelete('{{ $chitietvatTu->MaVatTu }}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-between align-items-center">
                Hiển thị từ {{ $chitietvatTus->firstItem() }} đến {{ $chitietvatTus->lastItem() }} trong tổng số {{ $chitietvatTus->total() }} vật tư
                {{ $chitietvatTus->links('pagination') }}
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