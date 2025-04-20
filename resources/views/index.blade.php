<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tổng Kho Điều Hòa LG</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header class="header">
        <div class="top-bar">
            <span><i class="fas fa-dollar-sign"></i> Cam kết giá tốt nhất</span>
            <span><i class="fas fa-truck"></i> Miễn phí vận chuyển</span>
            <span><i class="fas fa-handshake"></i> Thanh toán khi nhận hàng</span>
            <span><i class="fas fa-undo"></i> Bảo hành tận nơi</span>
        </div>
        <div class="top-header bg-danger text-white py-2">
            <div class="container d-flex justify-content-between">
                <span>
                    <i class="fas fa-phone-alt"></i> Hotline: 0123.456.789
                </span>
                <span>
                    <i class="fas fa-envelope"></i> Email: contact@tongkholg.com
                </span>
            </div>
        </div>
        <div class="main-header py-3 bg-white shadow-sm">
            <div class="container d-flex align-items-center justify-content-between">
                <a href="index.php" class="logo">
                    <img src="{{ asset('images/download.png') }}" alt="Logo" class="img-fluid" style="height: 60px;">
                </a>
                <form class="search-form d-flex">
                    <input type="text" class="form-control" placeholder="Tìm kiếm sản phẩm...">
                    <button class="btn btn-danger">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
                <div class="header-contact d-flex align-items-center">
                    <i class="fas fa-headset fs-3 text-danger"></i>
                    <div class="contact-info ms-2">
                        <span>Tư vấn 24/7</span>
                        <strong>0123.456.789</strong>
                    </div>
                </div>
            </div>
        </div>
    </header>   
    <div class="container">
        <div class="row equal-height">
            <div class="col-md-3 py-4 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="category-dropdown-container">
                        <button class="btn btn-danger w-100 d-flex align-items-center justify-content-between" 
                                id="categoryDropdownBtn">
                            <span><i class="bi bi-list me-2"></i>Danh Mục Vật Tư</span>
                            <i class="bi bi-chevron-down"></i>
                        </button>
                        <div class="shadow-sm w-100" id="categoryDropdownMenu">
                            <div class="list-group list-group-flush rounded-0 border border-top-0">
                                @foreach ($loaivattus as $loaivattu)
                                    <a href="#{{ $loaivattu->MaLoaiVatTu }}" 
                                    class="list-group-item list-group-item-action d-flex align-items-center py-2 px-3 border-left-4">
                                        <i class="bi bi-box-seam me-2 text-secondary"></i>
                                        {{ $loaivattu->TenLoaiVatTu }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9 d-flex">
                <main class="main-content py-4 w-100">
                    <div class="slider-section mb-4">
                        <div id="mainSlider" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="images/slider1.png" class="d-block w-100" alt="Slider 1">
                                </div>
                                <div class="carousel-item">
                                    <img src="images/slider2.jpg" class="d-block w-100" alt="Slider 2">
                                </div>
                                <div class="carousel-item">
                                    <img src="images/slider3.png" class="d-block w-100" alt="Slider 3">
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#mainSlider" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#mainSlider" data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </button>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <hr>
    </div>  
    
    @forelse($loaivattus as $loaivattu)
    <section id="{{ $loaivattu->MaLoaiVatTu }}" class="container">
        <h2 class="text-danger">{{ $loaivattu->TenLoaiVatTu }}</h2>
        <div class="row row-cols-1 row-cols-md-5 g-3">
            @forelse($loaivattu->vattu as $vatTu)
                <div class="col">
                    <div class="card h-100">
                        <img src="{{ asset('images/' . $vatTu->AnhVatTu) }}" class="card-img-top" alt="{{ $vatTu->TenVatTu }}">
                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title fw-bold text-center">{{ $vatTu->TenVatTu }}</h6>
                            <p class="card-text"><strong class="text-success">Còn lại: {{ $vatTu->SoLuongTon }} cái</strong></p>
                            <a href="{{ url('vattu/' . $vatTu->MaVatTu) }}" class="btn btn-outline-danger mt-auto mx-auto w-75">Xem Chi Tiết</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted text-center">Chưa có sản phẩm nào.</p>
            @endforelse
        </div>
        <hr>
    </section>
    @empty
        <p class="text-muted text-center">Chưa có sản phẩm nào.</p>
    @endforelse
    
    <footer class="footer bg-dark text-light py-4">
        <div class="column">
            <h3>TỔNG KHO LG</h3>
            <p><i class="fas fa-map-marker-alt"></i> Địa chỉ: 286 Nguyễn Xiển, Thanh Xuân, Hà Nội</p>
            <p><i class="fas fa-phone"></i> Hotline: 0966.954.166</p>
            <p><i class="fas fa-envelope"></i> Email: tongkholg@gmail.com</p>
        </div>
        <div class="column">
            <h3>Chính sách</h3>
            <a href="#">Chính sách đổi trả hàng</a>
            <a href="#">Chính sách bảo hành</a>
            <a href="#">Hướng dẫn mua hàng</a>
            <a href="#">Chính sách đại lý</a>
        </div>
        <div class="column">
            <h3>Fanpage</h3>
            <div class="fb-page" 
                 data-href="https://www.facebook.com/LGInformationDisplay" 
                 data-tabs="timeline" 
                 data-width="250" 
                 data-height="150" 
                 data-small-header="true" 
                 data-adapt-container-width="true" 
                 data-hide-cover="false" 
                 data-show-facepile="true">
            </div>
        </div>
        <div class="column">
            <h3>Google Maps</h3>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.6532106779823!2d105.79934241493275!3d21.006555993870627!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135abccb5c6b9b5%3A0xa1b5c81bb7f1a9a5!2zMjg2IE5ndXnhu4VuIFhpw6puLCBUaGFuaCBYdcOibiwgSMOgIE7hu5lp!5e0!3m2!1svi!2s!4v1648207637478!5m2!1svi!2s" width="250" height="150" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </footer>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v16.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
