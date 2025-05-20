<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title">Danh sách Kho</h5>
            <div class="d-flex">
                <input type="text" wire:model.live="search" class="form-control me-2" placeholder="Tìm kiếm Kho">
                <button class="btn btn-lg-red ms-2" wire:click="showModalAdd">
                    <i class="fas fa-plus me-2"></i>Thêm Kho
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
                        <th>Mã Kho</th>
                        <th>Tên Kho</th>
                        <th>Địa chỉ</th>
                        <th>Quy mô (m²)</th>
                        <th>Diện tích sử dụng</th>
                        <th>Tình trạng</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($danhmuckhos as $danhmuckho)
                        <tr>
                            <td>{{ $danhmuckho->MaKho }}</td>
                            <td>{{ $danhmuckho->TenKho }}</td>
                            <td>{{ $danhmuckho->DiaChi }}</td>
                            <td>{{ $danhmuckho->QuyMo }}</td>
                            <td>{{ $danhmuckho->DienTichSuDung }}</td>
                            <td>
                                <span class="badge rounded-pill {{ $danhmuckho->TinhTrang == 'Còn hàng' ? 'bg-success' : ($danhmuckho->TinhTrang == 'Gần hết' ? 'bg-warning' : 'bg-danger') }}">
                                    {{ $danhmuckho->TinhTrang }}
                                </span>
                            </td>
                            <td>
                                <button class="btn bg-warning ms-2" title="Sửa" wire:click="showModalEdit('{{ $danhmuckho->MaKho }}')">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn bg-danger ms-2" title="Xóa" wire:click="showModalDelete('{{ $danhmuckho->MaKho }}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-between align-items-center">
                Hiển thị từ {{ $danhmuckhos->firstItem() }} đến {{ $danhmuckhos->lastItem() }} trong tổng số {{ $danhmuckhos->total() }} kho
                {{ $danhmuckhos->links('pagination') }}
            </div>
        </div>
    </div>
    @if ($isAdd || $isEdit)
    <div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5);"  tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $isAdd ? 'Thêm Kho' : 'Chỉnh sửa Kho' }}</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="isAdd ? save : update" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Mã Kho</label>
                                <input type="text" class="form-control" wire:model="MaKho" {{ $isEdit ? 'readonly' : '' }} required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tên Kho</label>
                                <input type="text" class="form-control" wire:model="TenKho" value="{{ $TenKho || '' }}" required>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Địa chỉ</label>
                                <input type="text" class="form-control" wire:model="DiaChi" value="{{ $DiaChi || '' }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Quy mô (m²)</label>
                                <input type="number" class="form-control" wire:model="QuyMo" value="{{ $QuyMo || 0 }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Diện tích sử dụng</label>
                                <input type="number" class="form-control" wire:model="DienTichSuDung" value="{{ $DienTichSuDung || 0 }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tình trạng</label>
                                <select class="form-select" wire:model="TinhTrang" required>
                                    <option value="">-- Chọn Tình Trạng --</option>
                                    <option value="Còn hàng">Còn hàng</option>
                                    <option value="Gần hết">Gần hết</option>
                                    <option value="Hết hàng">Hết hàng</option>
                                </select>
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
                    <h5 class="modal-title">Xóa Kho</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc chắn muốn xóa Kho này không?</p>
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