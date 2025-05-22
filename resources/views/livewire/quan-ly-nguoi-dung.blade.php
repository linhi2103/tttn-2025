<div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-title">Danh sách Người dùng</h5>
                <div class="d-flex">
                    <input type="text" wire:model.live="search" class="form-control me-2" placeholder="Tìm kiếm...">
                    <button class="btn btn-lg-red ms-2" wire:click="showModalAdd">
                        <i class="fas fa-plus me-2"></i>Thêm Người dùng
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
                            <th>Tài Khoản</th>
                            <th>Mật Khẩu</th>
                            <th>Email</th>
                            <th>Mã Nhân Viên</th>
                            <th>Tên Nhân Viên</th>
                            <th>Quyền Hạn</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->TaiKhoan }}</td>
                                <td>******</td>
                                <td>{{ $user->Email }}</td>
                                <td>{{ $user->MaNhanVien }}</td>
                                <td>{{ $user->nhanvien->TenNhanVien ?? 'N/A' }}</td>
                                <td>{{ $user->QuyenHan }}</td>
                                <td>
                                    <button class="btn bg-warning ms-2" title="Sửa" wire:click="showModalEdit({{ $user->id }})">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn bg-danger ms-2" title="Xóa" wire:click="showModalDelete({{ $user->id }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-between align-items-center">
                    Hiển thị từ {{ $users->firstItem() ?? 0 }} đến {{ $users->lastItem() ?? 0 }} trong tổng số {{ $users->total() ?? 0 }} người dùng
                    {{ $users->links('pagination') }}
                </div>
            </div>
        </div>

        @if ($isAdd || $isEdit)
        <div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5);" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $isAdd ? 'Thêm Người dùng' : 'Chỉnh sửa Người dùng' }}</h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="{{ $isAdd ? 'createUser' : 'updateUser' }}">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Tài Khoản</label>
                                    <input type="text" class="form-control @error('TaiKhoan') is-invalid @enderror" 
                                           wire:model="TaiKhoan" {{ $isEdit ? 'readonly' : '' }} required>
                                    @error('TaiKhoan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Mật Khẩu</label>
                                    <input type="password" class="form-control @error('MatKhau') is-invalid @enderror" 
                                           wire:model="MatKhau" {{ $isEdit ? '' : 'required' }}>
                                    @error('MatKhau') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Email</label>
                                    <input type="email" class="form-control @error('Email') is-invalid @enderror" 
                                           wire:model="Email" required>
                                    @error('Email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Mã Nhân Viên</label>
                                    <select class="form-control @error('MaNhanVien') is-invalid @enderror" 
                                            wire:model.live="MaNhanVien" required>
                                        <option value="">-- Chọn Nhân Viên --</option>
                                        @foreach ($nhanViens as $nhanvien)
                                            <option value="{{ $nhanvien->MaNhanVien }}">{{ $nhanvien->MaNhanVien }}</option>
                                        @endforeach
                                    </select>
                                    @error('MaNhanVien') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Tên Nhân Viên</label>
                                    <input type="text" class="form-control" value="{{ optional($nhanViens->where('MaNhanVien', $MaNhanVien)->first())->TenNhanVien ?? '' }}" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Vai Trò</label>
                                    <select class="form-control @error('MaVaiTro') is-invalid @enderror" 
                                            wire:model="MaVaiTro" required>
                                        <option value="">-- Chọn Vai Trò --</option>
                                        @foreach ($vaitros as $vaitro)
                                            <option value="{{ $vaitro->MaVaiTro }}">{{ $vaitro->TenVaiTro }}</option>
                                        @endforeach
                                        <!-- Thêm các quyền khác nếu cần -->
                                    </select>
                                    @error('QuyenHan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" wire:click="closeModal">Hủy</button>
                        <button class="btn btn-lg-red" wire:click="{{ $isAdd ? 'createUser' : 'updateUser' }}">Lưu</button>
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
                        <h5 class="modal-title">Xóa Người dùng</h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Bạn có chắc chắn muốn xóa Người dùng này không?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal">Hủy</button>
                        <button type="button" class="btn btn-lg-red" wire:click="deleteUser">Xóa</button>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
