<div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-title">Danh sách Phiếu kiểm kê</h5>
                <div class="d-flex">
                    <input type="text" wire:model.live="search" class="form-control me-2" placeholder="Tìm kiếm...">
                    <button class="btn btn-lg-red ms-2" wire:click="showModalAdd">
                        <i class="fas fa-plus me-2"></i>Thêm phiếu kiểm kê
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
                        <th>Mã Phiếu Kiểm Kê</th>
                        <th>Mã Kho</th>
                        <th>Ngày Lập</th>
                        <th>Lệnh Điều Động</th>
                        <th>Trạng Thái</th>
                        <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($phieukiemkes as $item)
                            <tr>
                                <td>{{ $item->MaPhieuKiemKe }}</td>
                                <td>{{ $item->MaKho }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->MaLenhDieuDong ?? 'N/A'}}</td>
                                <td>
                                    <span class="badge rounded-pill 
                                        {{ 
                                            $item->TrangThai == 'Đã Kiểm Kê' ? 'bg-success' : 
                                            ($item->TrangThai == 'Chờ Duyệt' ? 'bg-warning text-dark' : 'bg-danger') 
                                        }}">
                                        {{$item->TrangThai}}
                                    </span>
                                </td>
                                <td>
                                    <button class="btn bg-primary ms-2" title="Xem chi tiết" wire:click="showModalDetail('{{ $item->MaPhieuKiemKe }}')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn bg-warning ms-2" title="Sửa" wire:click="showModalEdit('{{ $item->MaPhieuKiemKe }}')" {{ $item->TrangThai == 'Đã Kiểm Kê' ? 'disabled' : '' }}>
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn bg-danger ms-2" title="Xóa" wire:click="showModalDelete('{{ $item->MaPhieuKiemKe }}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-between align-items-center">
                    Hiển thị từ {{ $phieukiemkes->firstItem() ?? 0 }} đến {{ $phieukiemkes->lastItem() ?? 0 }} trong tổng số {{ $phieukiemkes->total() ?? 0 }} phiếu kiểm kê
                    {{ $phieukiemkes->links('pagination') }}
                </div>
            </div>
        </div>

        @if ($isAdd || $isEdit)
        <div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5);" tabindex="-1">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $isAdd ? 'Thêm Phiếu Kiểm Kê' : 'Chỉnh sửa Phiếu Kiểm Kê' }}</h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <form wire:submit.prevent="{{ $isAdd ? 'save' : 'update' }}">
                        <div class="modal-body">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <div class="row">
                                <!-- Mã Phiếu Kiểm Kê -->
                                <div class="col-md-6 mb-3">
                                    <label>Mã Phiếu Kiểm Kê</label>
                                    <input type="text" 
                                        class="form-control @error('MaPhieuKiemKe') is-invalid @enderror" 
                                        wire:model="MaPhieuKiemKe" 
                                        {{ $isEdit ? 'readonly' : '' }} 
                                        required>
                                    @error('MaPhieuKiemKe') 
                                        <div class="invalid-feedback">{{ $message }}</div> 
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Mã Kho</label>
                                    <select class="form-control @error('MaKho') is-invalid @enderror" wire:model="MaKho" required>
                                        <option value="">-- Chọn Kho --</option>
                                        @foreach ($danhmuckhos as $kho)
                                            <option value="{{ $kho->MaKho }}">{{ $kho->MaKho }}</option>
                                        @endforeach
                                    </select>
                                    @error('MaKho') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Mã Lệnh Điều Động</label>
                                    <select class="form-control @error('MaLenhDieuDong') is-invalid @enderror" wire:model="MaLenhDieuDong" required>
                                        <option value="">-- Chọn Lệnh Điều Động --</option>
                                        @foreach ($lenhdieudongs as $lenhdieudong)
                                            <option value="{{ $lenhdieudong->MaLenhDieuDong }}">{{ $lenhdieudong->MaLenhDieuDong }}</option>
                                        @endforeach
                                    </select>
                                    @error('MaLenhDieuDong') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                @if($isEdit)
                                <div class="col-md-6 mb-3">
                                    <label>Trạng Thái</label>
                                    <select class="form-control @error('TrangThai') is-invalid @enderror" wire:model="TrangThai" required>
                                        <option value="">-- Chọn Trạng Thái --</option>
                                        <option value="Đã Hủy">Đã hủy</option>
                                        <option value="Chờ Duyệt">Chờ duyệt</option>
                                        <option value="Đã Kiểm Kê">Đã kiểm kê</option>
                                    </select>
                                    @error('TrangThai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                @endif
                                <div class="col-md-12 mb-3">
                                    <div class="d-flex justify-content-between">
                                        <label>Danh sách vật tư kiểm kê</label>
                                        <button type="button" class="btn btn-danger" wire:click="addVatTu">Thêm vật tư</button>
                                    </div>
                                    <br>
                                    <div>
                                        <table class="table table-hover table-light table-bordered table-responsive text-center" style="table-layout: auto;">
                                            <thead>
                                                <tr>
                                                    <th>STT</th>
                                                    <th>Mã Vật Tư</th>
                                                    <th>Tên Vật Tư</th>
                                                    <th>Đơn Vị</th>
                                                    <th>Đơn giá</th>
                                                    <th>Số Lượng Tồn</th>
                                                    <th>Số Lượng Thực Tế</th>
                                                    <th>Chênh Lệch</th>
                                                    <th style="width: 10%;">Còn tốt 100%</th>
                                                    <th style="width: 10%;">Kém chất lượng</th>
                                                    <th style="width: 10%;">Mất chất lượng</th>
                                                    <th>Thao tác</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($ChiTietKiemKe as $stt => $item)
                                                    <tr>
                                                        <td>{{ $stt + 1 }}</td>
                                                        <td>
                                                            <select class="form-control @error('ChiTietKiemKe.'.$stt.'.MaVatTu') is-invalid @enderror" wire:model.live="ChiTietKiemKe.{{ $stt }}.MaVatTu" required>
                                                                <option value="">-- Chọn Vật Tư --</option>
                                                                @foreach ($vattus as $vattu)
                                                                    <option value="{{ $vattu->MaVatTu }}" {{ $vattu->MaVatTu == $item['MaVatTu'] ? 'selected' : '' }}>{{ $vattu->MaVatTu }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>{{ $item['TenVatTu'] }}</td>
                                                        <td>{{ $item['DonViTinh'] }}</td>
                                                        <td>{{ $item['DonGia'] }}</td>
                                                        <td>{{ $item['SoLuongTon'] }}</td>
                                                        <td>
                                                            <input type="number" class="form-control @error('ChiTietKiemKe.'.$stt.'.SoLuongThucTe') is-invalid @enderror" wire:model.lazy="ChiTietKiemKe.{{ $stt }}.SoLuongThucTe" min="0" required>
                                                        </td>
                                                        <td>{{ (intval($item['SoLuongThucTe']) - intval($item['SoLuongTon'])) }}</td>
                                                        <td>
                                                            <input type="number" class="form-control @error('ChiTietKiemKe.'.$stt.'.ConTot') is-invalid @enderror" wire:model.lazy="ChiTietKiemKe.{{ $stt }}.ConTot" min="0" required>
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control @error('ChiTietKiemKe.'.$stt.'.KemChatLuong') is-invalid @enderror" wire:model.lazy="ChiTietKiemKe.{{ $stt }}.KemChatLuong" min="0" required>
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control @error('ChiTietKiemKe.'.$stt.'.MatChatLuong') is-invalid @enderror" wire:model.lazy="ChiTietKiemKe.{{ $stt }}.MatChatLuong" min="0" disabled>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger" wire:click="removeVatTu({{ $stt }})"><i class="fas fa-trash"></i></button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" wire:click="closeModal">Hủy</button>
                            <button type="submit" class="btn btn-lg-red">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif

        @if ($isDelete)
        <div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5);"  tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Xóa Phiếu Kiểm Kê</h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Bạn có chắc chắn muốn xóa Phiếu Kiểm Kê này không?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gray" wire:click="closeModal">Hủy</button>
                        <button type="button" class="btn btn-lg-red" wire:click="delete">Xóa</button>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if ($isDetail)
        <div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5);"  tabindex="-1">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Chi tiết Phiếu Kiểm Kê</h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-hover table-light table-bordered table-responsive text-center" style="table-layout: auto;">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Mã Vật Tư</th>
                                    <th>Tên Vật Tư</th>
                                    <th>Số Lượng Tồn</th>
                                    <th>Số Lượng Thực Tế</th>
                                    <th>Chênh Lệch</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ChiTietKiemKe as $stt => $item)
                                    <tr>
                                        <td>{{ $stt + 1 }}</td>
                                        <td>{{ $item['MaVatTu'] }}</td>
                                        <td>{{ $item['TenVatTu'] }}</td>
                                        <td>{{ $item['SoLuongTon'] }}</td>
                                        <td>{{ $item['SoLuongThucTe'] }}</td>
                                        <td>{{ $item['ChenhLech'] ?? ($item['SoLuongThucTe'] - $item['SoLuongTon']) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal">Hủy</button>
                        <button type="button" class="btn btn-lg-red" wire:click="exportExcel">Xuất Excel</button>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>