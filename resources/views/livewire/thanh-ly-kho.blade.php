<div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-title">Danh sách Thanh Lý Kho</h5>
                <div class="d-flex">
                    <input type="text" wire:model.live="search" class="form-control me-2" placeholder="Tìm kiếm...">
                    <button class="btn btn-lg-red ms-2" wire:click="showModalAdd">
                        <i class="fas fa-plus me-2"></i>Thêm Thanh Lý Kho
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
                        <th>Mã Thanh Lý Kho</th>
                        <th>Mã Kho</th>
                        <th>Ngày Lập</th>
                        <th>Lệnh Điều Động</th>
                        <th>Trạng Thái</th>
                        <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($phieuthanhlys as $item)
                            <tr>
                                <td>{{ $item->MaPhieuThanhLy }}</td>
                                <td>{{ $item->MaKho }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->MaLenhDieuDong ?? 'N/A'}}</td>
                                <td>
                                    <span class="badge rounded-pill 
                                        {{ 
                                            $item->TrangThai == 'Đã thanh lý' ? 'bg-success' : 
                                            ($item->TrangThai == 'Chờ duyệt' ? 'bg-warning text-dark' : 'bg-danger') 
                                        }}">
                                        {{$item->TrangThai}}
                                    </span>
                                </td>
                                <td>
                                    <button class="btn bg-primary ms-2" title="Xem chi tiết" wire:click="showModalDetail('{{ $item->MaPhieuThanhLy }}')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn bg-warning ms-2" title="Sửa" wire:click="showModalEdit('{{ $item->MaPhieuThanhLy }}')">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn bg-danger ms-2" title="Xóa" wire:click="showModalDelete('{{ $item->MaPhieuThanhLy }}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-between align-items-center">
                    Hiển thị từ {{ $phieuthanhlys->firstItem() ?? 0 }} đến {{ $phieuthanhlys->lastItem() ?? 0 }} trong tổng số {{ $phieuthanhlys->total() ?? 0 }} đơn vị tính
                    {{ $phieuthanhlys->links('pagination') }}
                </div>
            </div>
        </div>

        @if ($isAdd || $isEdit)
        <div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5);" tabindex="-1">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $isAdd ? 'Thêm Thanh Lý Kho' : 'Chỉnh sửa Thanh Lý Kho' }}</h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Mã Phiếu Thanh Lý</label>
                                    <input type="text" class="form-control @error('MaPhieuThanhLy') is-invalid @enderror" 
                                           wire:model="MaPhieuThanhLy" {{ $isEdit ? 'readonly' : '' }} required>
                                    @error('MaPhieuThanhLy') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Mã Kho</label>
                                    <select class="form-control @error('MaKho') is-invalid @enderror" wire:model="MaKho" required>
                                        <option value="">-- Chọn Kho --</option>
                                        @foreach ($danhmuckhos as $kho)
                                            <option value="{{ $kho->MaKho }}">{{ $kho->MaKho }}</option>
                                        @endforeach
                                    </select>
                                    @error('MaVatTu') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
                                        <option value="Đã hủy">Đã hủy</option>
                                        <option value="Chờ duyệt">Chờ duyệt</option>
                                        <option value="Đã thanh lý">Đã thanh lý</option>
                                    </select>
                                    @error('TrangThai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                @endif
                                <div class="col-md-12 mb-3">
                                    <div class="d-flex justify-content-between">
                                        <label>Danh sách vật tư</label>
                                        <button role="button" class="btn btn-danger" wire:click="addVatTu">Thêm vật tư</button>
                                    </div>
                                    <br>
                                    <div>
                                        <table class="table table-hover table-light table-bordered table-responsive text-center">
                                            <thead>
                                                <tr>
                                                    <th style="width: 5%;">STT</th>
                                                    <th style="width: 12%;">Mã Vật Tư</th>
                                                    <th style="width: 25%;">Tên Vật Tư</th>
                                                    <th style="width: 10%;">Số Lượng</th>
                                                    <th style="width: 8%;">Đơn Vị</th>
                                                    <th style="width: 15%;">Đơn giá</th>
                                                    <th style="width: 15%;">Thành Tiền</th>
                                                    <th style="width: 10%;">Thao tác</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($ChiTietThanhLy as $stt => $item)
                                                    <tr>
                                                        <td>{{ $stt + 1 }}</td>
                                                        <td>
                                                            <select class="form-control @error('MaVatTu') is-invalid @enderror" wire:model.live="ChiTietThanhLy.{{ $stt }}.MaVatTu" required>
                                                                <option value="">-- Chọn Vật Tư --</option>
                                                                @foreach ($vattus as $vattu)
                                                                    <option value="{{ $vattu->MaVatTu }}" {{ $vattu->MaVatTu == $item['MaVatTu'] ? 'selected' : '' }}>{{ $vattu->MaVatTu }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>{{ $item['TenVatTu'] }}</td>
                                                        <td>
                                                            <input type="number" class="form-control @error('ChiTietThanhLy.{{ $stt }}.SoLuong') is-invalid @enderror" wire:model.live="ChiTietThanhLy.{{ $stt }}.SoLuong" max="{{ $vattus->where('MaVatTu', $item['MaVatTu'])->first()->SoLuongTon ?? 0 }}" min="0" required>
                                                        </td>
                                                        <td>{{ $item['DonVi'] }}</td>
                                                        <td>{{ $item['DonGia'] }}</td>
                                                        <td>{{ $item['ThanhTien'] }}</td>
                                                        <td>
                                                            <button class="btn btn-danger" wire:click="removeVatTu({{ $stt }})"><i class="fas fa-trash"></i></button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" wire:click="closeModal">Hủy</button>
                        <button class="btn btn-lg-red" wire:click="{{ $isAdd ? 'save' : 'update' }}">Lưu</button>
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
                        <h5 class="modal-title">Xóa Thanh Lý Kho</h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Bạn có chắc chắn muốn xóa Thanh Lý Kho này không?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal">Hủy</button>
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
                        <h5 class="modal-title">Chi tiết Thanh Lý Kho</h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-hover table-light table-bordered table-responsive text-center">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">STT</th>
                                    <th style="width: 12%;">Mã Vật Tư</th>
                                    <th style="width: 25%;">Tên Vật Tư</th>
                                    <th style="width: 10%;">Số Lượng</th>
                                    <th style="width: 8%;">Đơn Vị</th>
                                    <th style="width: 15%;">Đơn giá</th>
                                    <th style="width: 15%;">Thành Tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ChiTietThanhLy as $stt => $item)
                                    <tr>
                                        <td>{{ $stt + 1 }}</td>
                                        <td>{{ $item['MaVatTu'] }}</td>
                                        <td>{{ $item['TenVatTu'] }}</td>
                                        <td>{{ $item['SoLuong'] }}</td>
                                        <td>{{ $item['DonVi'] }}</td>
                                        <td>{{ $item['DonGia'] }}</td>
                                        <td>{{ $item['ThanhTien'] }}</td>
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