<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title">Danh sách Vai Trò</h5>
            <div class="d-flex">
                <input type="text" wire:model.live="search" class="form-control me-2" placeholder="Tìm kiếm Vai Trò">
                <button class="btn btn-lg-red ms-2" wire:click="showModalAdd">
                    <i class="fas fa-plus me-2"></i>Thêm Vai Trò
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
                        <th>Mã Vai Trò</th>
                        <th>Tên Vai Trò</th>
                        <th>Quyền Hạn</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vaitros as $vaitro)
                        <tr>
                            <td>{{ $vaitro->MaVaiTro }}</td>
                            <td>{{ $vaitro->TenVaiTro }}</td>
                            <td>{{ $vaitro->QuyenHan }}</td>
                            <td>
                                <button class="btn bg-warning ms-2" title="Sửa" wire:click="showModalEdit('{{ $vaitro->MaVaiTro }}')">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn bg-danger ms-2" title="Xóa" wire:click="showModalDelete('{{ $vaitro->MaVaiTro }}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-between align-items-center">
                Hiển thị từ {{ $vaitros->firstItem() }} đến {{ $vaitros->lastItem() }} trong tổng số {{ $vaitros->total() }} vai trò
                {{ $vaitros->links('pagination') }}
            </div>
        </div>
    </div>
    @if ($isAdd || $isEdit)
    <div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5);"  tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $isAdd ? 'Thêm Vai Trò' : 'Chỉnh sửa Vai Trò' }}</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="isAdd ? save : update" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Mã Vai Trò</label>
                                <input type="text" class="form-control" wire:model="MaVaiTro" {{ $isEdit ? 'readonly' : '' }} required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tên Vai Trò</label>
                                <input type="text" class="form-control" wire:model="TenVaiTro" value="{{ $TenVaiTro || '' }}" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Quyền Hạn</label>
                                <select class="form-select" wire:model="QuyenHan" required>
                                    <option value="">-- Chọn Quyền Hạn --</option>
                                    <option value="Admin">Quản trị viên</option>
                                    <option value="User">Người dùng</option>
                                </select>
                                @error('QuyenHan') <span class="text-danger">{{ $message }}</span> @enderror
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
                    <h5 class="modal-title">Xóa Vai Trò</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc chắn muốn xóa Vai Trò này không?</p>
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