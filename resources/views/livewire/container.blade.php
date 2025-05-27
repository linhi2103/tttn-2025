<div>
<nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/dashboard') }}">
                <img src="	https://tuyendunglginnotek.vn/Data/images/banner/logo.png" alt="LG Logo" class="img-fluid" style="height: 50px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#" wire:click.prevent="setActiveComponent('chitietvattu')">
                            <i class="fas fa-box"></i> Chi tiết vật tư
                        </a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="#" wire:click.prevent="setActiveComponent('dashboard')">
                            <i class="fas fa-box"></i> Vật Tư
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" wire:click.prevent="setActiveComponent('xuatkho')">
                            <i class="fas fa-exchange-alt"></i> Xuất Kho
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" wire:click.prevent="setActiveComponent('nhapkho')">
                            <i class="fas fa-exchange-alt"></i> Nhập Kho
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" wire:click.prevent="setActiveComponent('thanhlykho')">
                            <i class="fas fa-chart-bar"></i> Thanh lý kho
                        </a>
                    </li> 
                    <li class="nav-item">
                        <a class="nav-link" href="#" wire:click.prevent="setActiveComponent('phieukiemke')">
                            <i class="fas fa-chart-bar"></i> Phiếu Kiểm Kê
                        </a>
                    </li>
                </ul>
                <div class="d-flex">
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->TaiKhoan }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('profile') }}"><i class="fas fa-user-cog"></i> Hồ sơ</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ $activeComponent == 'dashboard' ? 'active' : '' }}" href="#" wire:click.prevent="setActiveComponent('dashboard')" data-bs-toggle="collapse" data-bs-target="#menu-tong-hop" aria-expanded="false">
                                Tổng hợp
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $activeComponent == 'vanchuyen' ? 'active' : '' }}" wire:click.prevent="setActiveComponent('vanchuyen')" >
                                <i class="fa-brands fa-codepen"></i> Quản lý đơn vị vận chuyển
                            </a>
                        </li>
                        @if(Auth::user()->vaitro->QuyenHan == 'Admin')
                        <li class="nav-item">
                            <a class="nav-link {{ $activeComponent == 'nguoidung' ? 'active' : '' }}" wire:click.prevent="setActiveComponent('nguoidung')">
                                <i class="fas fa-user"></i> Quản lý người dùng
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link {{ $activeComponent == 'nhanvien' ? 'active' : '' }}" wire:click.prevent="setActiveComponent('nhanvien')">
                                <i class="fas fa-users"></i> Quản lý nhân viên
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $activeComponent == 'doitac' ? 'active' : '' }}" wire:click.prevent="setActiveComponent('doitac')">
                                <i class="fas fa-handshake"></i> Quản lý đối tác
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $activeComponent == 'loaivattu' ? 'active' : '' }}" wire:click.prevent="setActiveComponent('loaivattu')">
                                <i class="fa-brands fa-codepen"></i> Quản lý Loại vật tư
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $activeComponent == 'donvitinh' ? 'active' : '' }}" wire:click.prevent="setActiveComponent('donvitinh')">
                                <i class="fas fa-ruler-combined"></i> Quản lý đơn vị tính
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $activeComponent == 'danhmuckho' ? 'active' : '' }}" wire:click.prevent="setActiveComponent('danhmuckho')">
                                <i class="fas fa-box"></i> Quản lý Danh Mục Kho
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $activeComponent == 'vaitro' ? 'active' : '' }}" wire:click.prevent="setActiveComponent('vaitro')">
                                <i class="fas fa-tag"></i> Quản lý Vai Trò
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $activeComponent == 'phongban' ? 'active' : '' }}" wire:click.prevent="setActiveComponent('phongban')">
                                <i class="fa-brands fa-building"></i> Quản lý Phòng ban
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $activeComponent == 'chucvu' ? 'active' : '' }}" wire:click.prevent="setActiveComponent('chucvu')">
                                <i class="fa-brands fa-building"></i> Quản lý Chức vụ
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $activeComponent == 'lenhDieuDong' ? 'active' : '' }}" wire:click.prevent="setActiveComponent('lenhDieuDong')">
                                <i class="fas fa-exchange-alt"></i> Quản lý Lệnh Điều Động
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $activeComponent == 'lichsu' ? 'active' : '' }}" wire:click.prevent="setActiveComponent('lichsu')">
                                <i class="fas fa-history"></i> Lịch sử thay đổi
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4" id="mainContent">
                @if ($activeComponent === 'dashboard')
                    @livewire('dashboard')
                @elseif ($activeComponent === 'chitietvattu')
                    @livewire('ChiTietVatTuComponent')
                @elseif ($activeComponent === 'nhapkho')
                    @livewire('NhapKhoComponent')
                @elseif ($activeComponent === 'xuatkho')
                    @livewire('XuatKhoComponent')
                @elseif ($activeComponent === 'loaivattu')
                    @livewire('LoaiVatTuComponent')
                @elseif ($activeComponent === 'donvitinh')
                    @livewire('DonViTinhComponent')
                @elseif ($activeComponent === 'vanchuyen')
                    @livewire('VanChuyenComponent')
                @elseif ($activeComponent === 'nhanvien')
                    @livewire('NhanVienComponent')
                @elseif ($activeComponent === 'danhmuckho')
                    @livewire('DanhMucKhoComponent')
                @elseif ($activeComponent === 'vaitro')
                    @livewire('VaiTroComponent')
                @elseif ($activeComponent === 'phongban')
                    @livewire('PhongBanComponent')
                @elseif ($activeComponent === 'chucvu')
                    @livewire('ChucVuComponent')
                @elseif ($activeComponent === 'doitac')
                    @livewire('DoiTacComponent')
                @elseif ($activeComponent === 'lenhDieuDong')
                    @livewire('LenhDieuDongComponent')
                @elseif ($activeComponent === 'phieukiemke')
                    @livewire('PhieuKiemKeComponent')
                @elseif ($activeComponent === 'thanhlykho')
                    @livewire('ThanhLyKhoComponent')
                @elseif ($activeComponent === 'nguoidung')
                    @livewire('QuanLyNguoiDung')
                @elseif ($activeComponent === 'lichsu')
                    @livewire('lich-su-thay-doi')
                @else
                    <div class="alert alert-danger" role="alert">
                        Không tìm thấy component tương ứng!
                    </div>
                @endif
            </main>
        </div>
    </div>
</div>
</div>
