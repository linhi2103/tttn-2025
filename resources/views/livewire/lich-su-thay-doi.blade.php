<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title">Lịch Sử Thay Đổi</h5>
            <div class="d-flex">
                <input type="text" wire:model.live="search" class="form-control me-2" placeholder="Tìm kiếm Lịch Sử Thay Đổi">
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
                        <th>Tên thay đổi</th>
                        <th>Loại thay đổi</th>
                        <th>Người thay đổi</th>
                        <th>Ngày thay đổi</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lichsuthaydois as $lichsuthaydoi)
                        <tr>
                            <td>{{ $lichsuthaydoi->description }}</td>
                            <td>{{ explode('\\', $lichsuthaydoi->subject_type)[2] ?? '' }}</td>
                            <td>{{ $nguoidungs->find($lichsuthaydoi->causer_id)?->TaiKhoan }}</td>
                            <td>{{ $lichsuthaydoi->created_at }}</td>
                            <td>
                                <button class="btn bg-primary ms-2" title="Xem chi tiết" wire:click="showModalDetail('{{ $lichsuthaydoi->MaLichSu }}')">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-between align-items-center">
                Hiển thị từ {{ $lichsuthaydois->firstItem() }} đến {{ $lichsuthaydois->lastItem() }} trong tổng số {{ $lichsuthaydois->total() }} Lịch Sử Thay Đổi
                {{ $lichsuthaydois->links('pagination') }}
            </div>
        </div>
    </div>
</div>