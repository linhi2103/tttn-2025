<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title">Báo cáo thống kê</h5>
        </div>
        <div class="d-flex">
            <div class="col-md-3 mb-3 me-3">
                <label class="form-label">Mẫu báo cáo</label>
                <select wire:model="MauBaoCao" class="form-select">
                    <option value="1">Báo cáo nhập</option>
                    <option value="2">Báo cáo xuất + thanh lý</option>
                </select>
            </div>
            <div class="col-md-2 mb-3 me-3">
                <label class="form-label">Từ ngày</label>
                <input type="date" class="form-control" wire:model="TuNgay" value="{{ $TuNgay || '' }}" required>
            </div>
            <div class="col-md-2 mb-3 me-3">
                <label class="form-label">Đến ngày</label>
                <input type="date" class="form-control" wire:model="DenNgay" value="{{ $DenNgay || '' }}" required>
            </div>
            <div class="col-md-3 mb-3 me-3 mt-sm-1">
                <br>
                <div>
                    <button class="btn bg-primary ms-2" wire:click="baoCao()">
                        Xem báo cáo
                    </button>
                    <!-- <button class="btn bg-success ms-2" wire:click="exportExcel()">
                        Xuất excel
                    </button> -->
                </div>
            </div>
        </div>
        @if($MauBaoCao === 1)
        <div class="table-responsive">
            <table class="table table-hover table-light table-bordered">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã phiếu nhập</th>
                        <th>Ngày tạo phiếu</th>
                        <th>Tên vật tư</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                @if(!empty($data))
                <tbody>
                    @foreach ($data as $key=>$item)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$item->MaPhieuNhap}}</td>
                        <td>{{$item->created_at}}</td>
                        <td>{{$item->TenVatTu}}</td>
                        <td>{{$item->SoLuong}}</td>
                        <td>{{number_format($item->ThanhTien, 0, ',', '.')}} đ</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="3" class="text-center">Tổng số</td>
                        <td>{{$total['VatTu']}}</td>
                        <td>{{$total['SoLuong']}}</td>
                        <td>{{$total['ThanhTien']}} đ</td>
                    </tr>
                </tbody>
                @endif
            </table>
        </div>
        @elseif($MauBaoCao === 2)
        <div class="table-responsive">
            <table class="table table-hover table-light table-bordered">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên vật tư</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                @if(!empty($data))
                <tbody>
                    @foreach ($data as $key=>$item)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$item->TenVatTu}}</td>
                        <td>{{$item->SoLuong}}</td>
                        <td>{{number_format($item->ThanhTien, 0, ',', '.')}} đ</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td class="text-center">Tổng số</td>
                        <td>{{$total['VatTu']}}</td>
                        <td>{{$total['SoLuong']}}</td>
                        <td>{{$total['ThanhTien']}} đ</td>
                    </tr>
                </tbody>
                @endif
            </table>
        </div>
        @endif
    </div>
</div>