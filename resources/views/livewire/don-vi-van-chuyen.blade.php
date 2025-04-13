<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title">Danh sách Đơn vị vận chuyển</h5>
            <div class="d-flex">
                <input type="text" wire:model.live="search" class="form-control me-2" placeholder="Tìm kiếm Đơn Vị Vận Chuyển">
                <button class="btn btn-lg-red ms-2" wire:click="showModalAdd">
                    <i class="fas fa-plus me-2"></i>Thêm DVVC
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
                        <th>Mã đơn vị vận chuyển</th>
                        <th>Tên đơn vị vận chuyển</th>
                        <th>Tên nhân viên</th>
                        <th>Phương tiện vận chuyển</th>
                        <th>Ghi chú</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($donvivanchuyens as $donvivanchuyen)
                        <tr>
                            <td>{{ $donvivanchuyen->MaDonViVanChuyen }}</td>
                            <td>{{ $donvivanchuyen->TenDonViVanChuyen }}</td>
                            <td>{{ $donvivanchuyen->NhanVien->TenNhanVien }}</td>
                            <td>{{ $donvivanchuyen->PhuongTienVanChuyen }}</td>
                            <td>{{ $donvivanchuyen->GhiChu ?? 'Không có' }}</td>
                            <td>
                                <button class="btn bg-warning ms-2" title="Sửa" wire:click="showModalEdit('{{ $donvivanchuyen->MaDonViVanChuyen }}')">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn bg-danger ms-2" title="Xóa" wire:click="showModalDelete('{{ $donvivanchuyen->MaDonViVanChuyen }}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-between align-items-center">
                Hiển thị từ {{ $donvivanchuyens->firstItem() }} đến {{ $donvivanchuyens->lastItem() }} trong tổng số {{ $donvivanchuyens->total() }} đơn vị vận chuyển
                {{ $donvivanchuyens->links('pagination') }}
            </div>
        </div>
    </div>
    @if ($isAdd || $isEdit)
    <div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5);"  tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $isAdd ? 'Thêm DVVC' : 'Chỉnh sửa DVVC' }}</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="isAdd ? save : update" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Mã ĐVVC</label>
                                <input type="text" class="form-control" wire:model="MaDonViVanChuyen" {{ $isEdit ? 'readonly' : '' }} required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tên ĐVVC</label>
                                <input type="text" class="form-control" wire:model="TenDonViVanChuyen" value="{{ $TenDonViVanChuyen || '' }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tên Nhân Viên</label>
                                <select class="form-select" wire:model="MaNhanVien">
                                    <option value="">--Chọn Nhân Viên--</option>
                                    @foreach ($nhanviens as $nhanvien)
                                        <option value="{{ $nhanvien->MaNhanVien }}">{{ $nhanvien->TenNhanVien }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phương tiện vận chuyển</label>
                                <input type="text" class="form-control" wire:model="PhuongTienVanChuyen" value="{{ $PhuongTienVanChuyen || '' }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Ghi chú</label>
                                <input type="text" class="form-control" wire:model="GhiChu" value="{{ $GhiChu || '' }}">
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
                    <h5 class="modal-title">Xóa Đơn Vị Vận Chuyển</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc chắn muốn xóa Đơn Vị Vận Chuyển này không?</p>
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