<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title">Danh sách Phiếu Xuất Kho</h5>
            <div class="d-flex">
            <input type="text" wire:model.live="search" class="form-control me-2" placeholder="Tìm kiếm...">
                <button class="btn btn-lg-red ms-2" wire:click="showModalAdd">
                    <i class="fas fa-plus me-2"></i>Thêm Phiếu Xuất
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
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Mã Phiếu Xuất</th>
                        <th>Tên Kho</th>
                        <th>Ngày Xuất</th>
                        <th>Mã Nhân Viên</th>
                        <th>Tên Nhân Viên</th>
                        <th>Đơn Vị Vận Chuyển</th>
                        <th>Mã Số Thuế - đối tác</th>
                        <th>Tên Đối Tác</th>
                        <th>Địa chỉ</th>
                        <th>Đơn Vị Tiền tệ</th>
                        <th>Tên Vật Tư</th>
                        <th>Số Lượng</th>
                        <th>Đơn vị tính</th>
                        <th>Đơn Giá</th>
                        <th>Thành Tiền</th>
                        <th>Lệnh Điều Động</th>
                        <th>Trạng thái</th>
                        <th>Ghi Chú</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($xuatkhos as $item)
                        <tr>
                            <td>{{ $item->MaPhieuXuat }}</td>
                            <td>{{ $item->kho->TenKho ?? 'N/A' }}</td>
                            <td>{{ date('d/m/Y', strtotime($item->NgayXuat)) }}</td>
                            <td>{{ $item->nhanvien->MaNhanVien ?? 'N/A' }}</td>
                            <td>{{ $item->nhanvien->TenNhanVien ?? 'N/A' }}</td>
                            <td>{{ $item->donvivanchuyen->TenDonViVanChuyen ?? 'N/A' }}</td>
                            
                            <td>{{ $item->doitac->MaSoThue_DoiTac ?? 'N/A' }}</td>
                            <td>{{ $item->doitac->TenDoiTac ?? 'N/A' }}</td>
                            <td>{{ $item->DiaChi }}</td>
                            <td>{{ $item->DonViTienTe }}</td>
                            <td>{{ $item->vatTu->TenVatTu ?? 'N/A' }}</td>
                            <td>{{ $item->SoLuong }}</td>
                            <td>{{ $item->vatTu->DonViTinh->TenDonViTinh ?? 'N/A' }}</td>
                            <td>{{ number_format($item->DonGia, 0, ',', '.') }}</td>
                            <td>{{ number_format($item->ThanhTien, 0, ',', '.') }}</td>
                            <td>{{ $item->lenhDieuDong->MaLenhDieuDong ?? 'N/A' }}</td>
                            <td>{{ $item->TrangThai }}</td>
                            <td>{{ $item->GhiChu ?? 'N/A' }}</td>
                            <td>
                                <button class="btn bg-warning ms-2" title="Sửa" wire:click="showModalEdit('{{ $item->MaPhieuXuat }}')">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn bg-danger ms-2" title="Xóa" wire:click="showModalDelete('{{ $item->MaPhieuXuat }}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-between align-items-center">
                Hiển thị từ {{ $xuatkhos->firstItem() }} đến {{ $xuatkhos->lastItem() }} trong tổng số {{ $xuatkhos->total() }} phiếu xuất kho
                {{ $xuatkhos->links('pagination') }}
            </div>
        </div>
    </div>

    @if ($isAdd || $isEdit)
    <div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $isAdd ? 'Thêm Phiếu Xuất' : 'Chỉnh sửa Phiếu Xuất' }}</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <form wire:submit.prevent="{{ $isAdd ? 'save' : 'update' }}">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Mã Phiếu Xuất</label>
                                <input type="text" class="form-control @error('MaPhieuXuat') is-invalid @enderror" 
                                        wire:model="MaPhieuXuat" {{ $isEdit ? 'readonly' : '' }} required>
                                @error('MaPhieuXuat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Tên Kho</label>
                                <select class="form-control @error('MaKho') is-invalid @enderror" wire:model="MaKho" required>
                                    <option value="">-- Chọn Kho --</option>
                                    @foreach ($danhmuckhos as $kho)
                                        <option value="{{ $kho->MaKho }}">{{ $kho->TenKho }}</option>
                                    @endforeach
                                </select>
                                @error('MaKho') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Ngày Xuất</label>
                                <input type="date" class="form-control @error('NgayXuat') is-invalid @enderror" 
                                        wire:model="NgayXuat" required>
                                @error('NgayXuat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Tên Nhân Viên</label>
                                <select class="form-control @error('MaNhanVien') is-invalid @enderror" 
                                        wire:model="MaNhanVien" required>
                                    <option value="">-- Chọn Nhân Viên --</option>
                                    @foreach ($nhanViens as $nhanvien)
                                        <option value="{{ $nhanvien->MaNhanVien }}">{{ $nhanvien->TenNhanVien }}</option>
                                    @endforeach
                                </select>
                                @error('MaNhanVien') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Tên Đơn Vị Vận Chuyển</label>
                                <select class="form-control @error('MaDonViVanChuyen') is-invalid @enderror" 
                                        wire:model="MaDonViVanChuyen" required>
                                    <option value="">-- Chọn ĐVVC --</option>
                                    @foreach ($donViVanChuyens as $dvvc)
                                        <option value="{{ $dvvc->MaDonViVanChuyen }}">{{ $dvvc->TenDonViVanChuyen }}</option>
                                    @endforeach
                                </select>
                                @error('MaDonViVanChuyen') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Mã Số Thuế Đối Tác</label>
                                <select class="form-control @error('MaSoThue_DoiTac') is-invalid @enderror" 
                                        wire:model="MaSoThue_DoiTac" required>
                                    <option value="">-- Chọn Đối Tác --</option>
                                    @foreach ($doiTacs as $doitac)
                                        <option value="{{ $doitac->MaSoThue_DoiTac }}">{{ $doitac->TenDoiTac }}</option>
                                    @endforeach
                                </select>
                                @error('MaSoThue_DoiTac') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Địa chỉ</label>
                                <input type="text" class="form-control @error('DiaChi') is-invalid @enderror" 
                                       wire:model="DiaChi" required>
                                @error('DiaChi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Đơn Vị Tiền Tệ</label>
                                <input type="text" class="form-control @error('DonViTienTe') is-invalid @enderror" 
                                       wire:model="DonViTienTe" required>
                                @error('DonViTienTe') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Tên Vật Tư</label>
                                <select class="form-control @error('MaVatTu') is-invalid @enderror" wire:model="MaVatTu" required>
                                    <option value="">-- Chọn Vật Tư --</option>
                                    @foreach ($vattus as $vattu)
                                        <option value="{{ $vattu->MaVatTu }}">{{ $vattu->TenVatTu }}</option>
                                    @endforeach
                                </select>
                                @error('MaVatTu') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Số Lượng</label>
                                <input type="number" class="form-control @error('SoLuong') is-invalid @enderror" 
                                        wire:model="SoLuong" min="1" required>
                                @error('SoLuong') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Đơn Giá</label>
                                <input type="number" class="form-control @error('DonGia') is-invalid @enderror" 
                                        wire:model="DonGia" min="0" required>
                                @error('DonGia') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Thành Tiền (tự động tính)</label>
                                <input type="text" class="form-control" 
                                    value="{{ number_format($SoLuong * $DonGia, 0, ',', '.') }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Trạng thái</label>
                                <select class="form-control @error('TrangThai') is-invalid @enderror"
                                        wire:model="TrangThai" required>
                                    <option value="">-- Chọn Trạng thái --</option>
                                    <option value="Chờ duyệt">Chờ duyệt</option>
                                    <option value="Đã duyệt">Đã duyệt</option>
                                    <option value="Đang thực hiện">Đang thực hiện</option>
                                    <option value="Hoàn thành">Hoàn thành</option>
                                    <option value="Hủy">Hủy</option>
                                </select>
                                @error('TrangThai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Lệnh Điều Động (nếu có)</label>
                                <select class="form-control @error('MaLenhDieuDong') is-invalid @enderror"
                                        wire:model="MaLenhDieuDong" required>
                                    <option value="">-- Chọn Lệnh Điều Động --</option>
                                    @foreach($lenhDieuDongs as $ldd)
                                        <option value="{{ $ldd->MaLenhDieuDong }}">{{ $ldd->MaLenhDieuDong }}</option>
                                    @endforeach
                                </select>
                                @error('MaLenhDieuDong') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Ghi Chú</label>
                                <textarea class="form-control @error('GhiChu') is-invalid @enderror"
                                          wire:model="GhiChu" required></textarea>
                                @error('GhiChu') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal">Hủy</button>
                        <button type="submit" class="btn btn-danger">Lưu</button>
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
                    <h5 class="modal-title">Xóa Phiếu Xuất Kho</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc chắn muốn xóa Phiếu Xuất Kho này không?</p>
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