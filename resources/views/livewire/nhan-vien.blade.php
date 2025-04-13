<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title">Danh sách Nhân viên</h5>
            <div class="d-flex">
                <input type="text" wire:model.live="search" class="form-control me-2" placeholder="Tìm kiếm Nhân viên">
                <button class="btn btn-lg-red ms-2" wire:click="showModalAdd">
                    <i class="fas fa-plus me-2"></i>Thêm Nhân viên
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
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Mã nhân viên</th>
                        <th>Tên nhân viên</th>
                        <th>Giới tính</th>
                        <th>SĐT</th>
                        <th>Địa chỉ</th>
                        <th>Phòng ban</th>
                        <th>Vai trò</th>
                        <th>CCCD</th> 
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($nhanviens as $nhanvien)
                        <tr>
                            <td>{{ $nhanvien->MaNhanVien }}</td>
                            <td>{{ $nhanvien->TenNhanVien }}</td>
                            <td>{{ $nhanvien->GioiTinh }}</td>
                            <td>{{ $nhanvien->Sdt }}</td>
                            <td>{{ $nhanvien->DiaChi }}</td>
                            <td>{{ $nhanvien->phongban->TenPhongBan }}</td>
                            <td>{{ $nhanvien->vaitro->TenVaiTro }}</td>
                            <td>{{ $nhanvien->Cccd }}</td>
                            <td>
                                <button class="btn bg-warning ms-2" title="Sửa" wire:click="showModalEdit('{{ $nhanvien->MaNhanVien }}')">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn bg-danger ms-2" title="Xóa" wire:click="showModalDelete('{{ $nhanvien->MaNhanVien }}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-between align-items-center">
                Hiển thị từ {{ $nhanviens->firstItem() }} đến {{ $nhanviens->lastItem() }} trong tổng số {{ $nhanviens->total() }} nhân viên
                {{ $nhanviens->links('pagination') }}
            </div>
        </div>
    </div>
    @if ($isAdd || $isEdit)
    <div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5);"  tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $isAdd ? 'Thêm Nhân viên' : 'Chỉnh sửa Nhân viên' }}</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="isAdd ? save : update" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Mã Nhân viên</label>
                                <input type="text" class="form-control" wire:model="MaNhanVien" {{ $isEdit ? 'readonly' : '' }} required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tên Nhân viên</label>
                                <input type="text" class="form-control" wire:model="TenNhanVien" value="{{ $TenNhanVien || '' }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Giới tính</label>
                                <select wire:model="GioiTinh" class="form-select">
                                    <option value="">-- Chọn giới tính --</option>
                                    <option value="Nam">Nam</option>
                                    <option value="Nữ">Nữ</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">SĐT</label>
                                <input type="text" class="form-control" wire:model="Sdt" value="{{ $Sdt || '' }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Địa chỉ</label>
                                <input type="text" class="form-control" wire:model="DiaChi" value="{{ $DiaChi || '' }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phòng ban</label>
                                <select class="form-select" wire:model="MaPhongBan">
                                    <option value="">--Chọn Phòng ban--</option>
                                    @foreach ($phongbans as $phongban)
                                        <option value="{{ $phongban->MaPhongBan }}">{{ $phongban->TenPhongBan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Vai trò</label>
                                <select class="form-select" wire:model="MaVaiTro">
                                    <option value="">--Chọn Vai trò--</option>
                                    @foreach ($vaitros as $vaitro)
                                        <option value="{{ $vaitro->MaVaiTro }}">{{ $vaitro->TenVaiTro }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">CCCD</label>
                                <input type="text" class="form-control" wire:model="Cccd" value="{{ $Cccd || '' }}" required>
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
                    <h5 class="modal-title">Xóa Nhân viên</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc chắn muốn xóa Nhân viên này không?</p>
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