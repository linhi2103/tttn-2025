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

    </footer>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v16.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
