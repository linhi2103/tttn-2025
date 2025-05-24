<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title">Danh sách Đối tác</h5>
            <div class="d-flex">
                <input type="text" wire:model.live="search" class="form-control me-2" placeholder="Tìm kiếm Đối tác">
                <button class="btn btn-lg-red ms-2" wire:click="showModalAdd">
                    <i class="fas fa-plus me-2"></i>Thêm Đối tác
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
                        <th>Mã số thuế</th>
                        <th>Tên đối tác</th>
                        <th>Email</th>
                        <th>SĐT</th>
                        <th>Địa chỉ</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($doitacs as $doitac)
                        <tr>
                            <td>{{ $doitac->MaSoThue_DoiTac }}</td>
                            <td>{{ $doitac->TenDoiTac }}</td>
                            <td>{{ $doitac->Email }}</td>
                            <td>{{ $doitac->SDT }}</td>
                            <td>{{ $doitac->DiaChi }}</td>
                            <td>
                                <button class="btn bg-warning ms-2" title="Sửa" wire:click="showModalEdit('{{ $doitac->MaSoThue_DoiTac }}')">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn bg-danger ms-2" title="Xóa" wire:click="showModalDelete('{{ $doitac->MaSoThue_DoiTac }}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-between align-items-center">
                Hiển thị từ {{ $doitacs->firstItem() }} đến {{ $doitacs->lastItem() }} trong tổng số {{ $doitacs->total() }} đơn vị tính
                {{ $doitacs->links('pagination') }}
            </div>
        </div>
    </div>
    @if ($isAdd || $isEdit)
    <div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5);"  tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $isAdd ? 'Thêm Đối Tác' : 'Chỉnh sửa Đối Tác' }}</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="isAdd ? save : update" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Mã số thuế</label>
                                <input type="text" class="form-control" wire:model="MaSoThue_DoiTac" {{ $isEdit ? 'readonly' : '' }} required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tên Đối Tác</label>
                                <input type="text" class="form-control" wire:model="TenDoiTac" value="{{ $TenDoiTac || '' }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" wire:model="Email" value="{{ $Email || '' }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">SĐT</label>
                                <input type="text" class="form-control" wire:model="Sdt" value="{{ $Sdt || '' }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Địa chỉ</label>
                                <input type="text" class="form-control" wire:model="DiaChi" value="{{ $DiaChi || '' }}" required>
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
                    <h5 class="modal-title">Xóa Đối Tác</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc chắn muốn xóa Đối Tác này không?</p>
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