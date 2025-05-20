<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title">Danh sách Lệnh Điều Động</h5>
            <div class="d-flex">
                <input type="text" wire:model.live="search" class="form-control me-2" placeholder="Tìm kiếm Lệnh Điều Động">
                <button class="btn btn-lg-red ms-2" wire:click="showModalAdd">
                    <i class="fas fa-plus me-2"></i>Thêm Lệnh Điều Động
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
                        <th>Mã LĐĐ</th>
                        <th>Tên LĐĐ</th>
                        <th>Lý do</th>
                        <th>Người lập đơn</th>
                        <th>Ngày lập</th>
                        <th>Trạng thái</th>
                        <th>Ghi chú</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lenhdieudongs as $lenhdieudong)
                        <tr>
                            <td>{{ $lenhdieudong->MaLenhDieuDong }}</td>
                            <td>{{ $lenhdieudong->TenLenhDieuDong }}</td>
                            <td>{{ $lenhdieudong->LyDo }}</td>
                            <td>{{ $lenhdieudong->nhanVien?->TenNhanVien ?? 'Không xác định' }}</td>
                            <td>{{ $lenhdieudong->NgayLapDon }}</td>
                            <td>{{ $lenhdieudong->TrangThai ? 'Hoạt động' : 'Ngừng hoạt động' }}</td>
                            <td>{{ $lenhdieudong->GhiChu }}</td>
                            <td>
                                <button class="btn bg-warning ms-2" title="Sửa" wire:click="showModalEdit('{{ $lenhdieudong->MaLenhDieuDong }}')">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn bg-danger ms-2" title="Xóa" wire:click="showModalDelete('{{ $lenhdieudong->MaLenhDieuDong }}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-between align-items-center">
                Hiển thị từ {{ $lenhdieudongs->firstItem() }} đến {{ $lenhdieudongs->lastItem() }} trong tổng số {{ $lenhdieudongs->total() }} Lệnh Điều Động
                {{ $lenhdieudongs->links('pagination') }}
            </div>
        </div>
    </div>
    @if ($isAdd || $isEdit)
    <div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5);"  tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $isAdd ? 'Thêm Lệnh Điều Động' : 'Chỉnh sửa Lệnh Điều Động' }}</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="{{ $isAdd ? 'save' : 'update' }}" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Mã LĐĐ</label>
                                <input type="text" class="form-control" wire:model="MaLenhDieuDong" {{ $isEdit ? 'readonly' : '' }} required>
                                @error('MaLenhDieuDong') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tên LĐĐ</label>
                                <input type="text" class="form-control" wire:model="TenLenhDieuDong" required>
                                @error('TenLenhDieuDong') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Lý do</label>
                                <input type="text" class="form-control" wire:model="LyDo" required>
                                @error('LyDo') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Người lập đơn</label>
                                <select class="form-select" wire:model="MaNhanVien" required>
                                    <option value="">--Chọn nhân viên--</option>
                                    @foreach($nhanViens as $nhanVien)
                                        <option value="{{ $nhanVien->MaNhanVien }}">{{ $nhanVien->TenNhanVien }}</option>
                                    @endforeach
                                </select>
                                @error('MaNhanVien') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Ngày lập</label>
                                <input type="date" class="form-control" wire:model="NgayLapDon" required>
                                @error('NgayLapDon') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Trạng thái</label>
                                <select class="form-select" wire:model="TrangThai">
                                    <option value="1">Hoạt động</option>
                                    <option value="0">Ngừng hoạt động</option>
                                </select>
                                @error('TrangThai') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Ghi chú</label>
                                <input type="text" class="form-control" wire:model="GhiChu">
                                @error('GhiChu') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">Hủy</button>
                    <button type="button" class="btn btn-danger" wire:click="{{ $isAdd ? 'save' : 'update' }}">Lưu</button>
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
                    <h5 class="modal-title">Xóa Lệnh Điều Động</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc chắn muốn xóa Lệnh Điều Động này không?</p>
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