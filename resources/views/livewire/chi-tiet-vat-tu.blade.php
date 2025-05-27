<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title">Danh sách Chi tiết Vật tư</h5>
            <div class="d-flex">
                <input type="text" wire:model.live="search" class="form-control me-2" placeholder="Tìm kiếm Vật tư">
                <button class="btn btn-lg-red ms-2" wire:click="showModalAdd">
                    <i class="fas fa-plus me-2"></i>Thêm Chi tiết Vật tư
                </button>
            </div>
        </div>
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
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
                        <th>Mã Vật tư</th>
                        <th>Tên Vật tư</th>
                        <th>Thương hiệu</th>
                        <th>Kích thước</th>
                        <th>Xuất xứ</th>
                        <th>Mô tả</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($chitietvatTus as $chitietvattu)
                        <tr>
                            <td>{{ $chitietvattu->vatTu->MaVatTu }}</td>
                            <td>{{ $chitietvattu->vatTu->TenVatTu }}</td>
                            <td>{{ $chitietvattu->ThuongHieu }}</td>
                            <td>{{ $chitietvattu->KichThuoc }}</td>
                            <td>{{ $chitietvattu->XuatXu }}</td>
                            <td>{{ $chitietvattu->MoTa }}</td>
                            <td>
                                <button class="btn bg-warning ms-2" title="Sửa" wire:click="showModalEdit('{{ $chitietvattu->MaVatTu }}')">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn bg-danger ms-2" title="Xóa" wire:click="showModalDelete('{{ $chitietvattu->MaVatTu }}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-between align-items-center">
                Hiển thị từ {{ $chitietvatTus->firstItem() }} đến {{ $chitietvatTus->lastItem() }} trong tổng số {{ $chitietvatTus->total() }} chi tiết vật tư
                {{ $chitietvatTus->links('pagination') }}
            </div>
        </div>
    </div>
    @if ($isAdd || $isEdit)
    <div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5);"  tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $isAdd ? 'Thêm Chi tiết Vật tư' : 'Chỉnh sửa Chi tiết Vật tư' }}</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="isAdd ? save : update" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Vật Tư</label>
                                <select class="form-control @error('MaVatTu') is-invalid @enderror" wire:model.live="MaVatTu" required>
                                    <option value="">-- Chọn Vật Tư --</option>
                                    @foreach ($vatTus as $vattu)
                                        <option value="{{ $vattu->MaVatTu }}">{{ $vattu->MaVatTu }} - {{ $vattu->TenVatTu }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Thương hiệu</label>
                                <input type="text" class="form-control @error('ThuongHieu') is-invalid @enderror" 
                                    wire:model.live="ThuongHieu" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kích thước</label>
                                <input type="text" class="form-control @error('KichThuoc') is-invalid @enderror" 
                                    wire:model.live="KichThuoc" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Mô tả</label>
                                <input type="text" class="form-control @error('MoTa') is-invalid @enderror" 
                                    wire:model.live="MoTa" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Xuất xứ</label>
                                <input type="text" class="form-control @error('XuatXu') is-invalid @enderror" 
                                    wire:model.live="XuatXu" required>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">Hủy</button>
                    <button type="button" class="btn btn-lg-red" wire:click="{{ $isEdit ? 'update' : 'save' }}">Lưu</button>
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
                    <h5 class="modal-title">Xóa Chức vụ</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc chắn muốn xóa Chức vụ này không?</p>
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