<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" href="https://tongkhodieuhoalg.com/wp-content/uploads/2023/10/favicon-dieu-hoa-lg-100x100.png" sizes="32x32">
</head>
<body>
    <header class="header"> 
        <div class="main-header py-3 bg-white shadow-sm">
            <div class="container d-flex align-items-center justify-content-between">
                <a href="{{ url('/') }}" class="logo">
                    <img src="https://tuyendunglginnotek.vn/Data/images/banner/logo.png" alt="Logo" class="img-fluid" style="height: 60px;">
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
        <div class="row">
            <div class="col-12">
                <div class="product-detail animate__animated animate__fadeIn">
                    <div class="product-gallery">
                        <img src="{{ asset('images/' . $vatTu->AnhVatTu) }}" class="product-image" alt="{{ $vatTu->TenVatTu }}">
                    </div>
                    <div class="product-info">
                <h2 class="product-title">{{ $vatTu->TenVatTu }}</h2>
                <span class="product-category">{{ $vatTu->loaivattu->TenLoaiVatTu }}</span>
                <div class="product-price">
                    {{ number_format($vatTu->GiaNhap) }} VNĐ
                </div>
                <div class="product-specs">
                    <div class="spec-item">
                        <i class="fas fa-trademark"></i>
                        <span class="spec-label">Thương hiệu:</span>
                        <span class="spec-value">{{ $vatTu->chitietvattu->ThuongHieu ?? 'Không có thông tin' }}</span>
                    </div>
                    <div class="spec-item">
                        <i class="fas fa-ruler-combined"></i>
                        <span class="spec-label">Kích thước:</span>
                        <span class="spec-value">{{ $vatTu->chitietvattu->KichThuoc ?? 'Không có thông tin' }}</span>
                    </div>
                    <div class="spec-item">
                        <i class="fas fa-globe-asia"></i>
                        <span class="spec-label">Xuất xứ:</span>
                        <span class="spec-value">{{ $vatTu->chitietvattu->XuatXu ?? 'Không có thông tin' }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="product-description">
                <h2>Mô tả sản phẩm</h2>
                <p>{{ $vatTu->MoTa ?? 'Không có thông tin' }}</p>
            </div>
        </div>
        </div>
        
        <div class="related-products animate__animated animate__fadeIn">
            <h2 class="section-title">Sản phẩm liên quan</h2>
            <div class="products-slider">
                <div class="slider-container">
                    @php
                        $chunkedProducts = $vatTu->loaivattu->vattu->chunk(5);
                        $totalPages = count($chunkedProducts);
                    @endphp
                    
                    @foreach ($chunkedProducts as $index => $chunk)
                        <div class="slider-page {{ $index === 0 ? 'active' : '' }}" data-page="{{ $index + 1 }}">
                            <div class="products-grid products-grid-small">
                                @foreach ($chunk as $item)
                                    <div class="product-card">
                                        <img src="{{ asset('images/' . $item->AnhVatTu) }}" class="product-card-image" alt="{{ $item->TenVatTu }}">
                                        <div class="product-card-body">
                                            <h5 class="product-card-title">{{ $item->TenVatTu }}</h5>
                                            <p class="product-card-price">{{ number_format($item->GiaNhap) }} VNĐ</p>
                                            <a href="{{ url($item->MaVatTu) }}" class="product-card-link">Xem chi tiết</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="slider-navigation">
                    <button class="nav-btn prev-btn" disabled>
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <div class="pagination-indicators">
                        @for ($i = 1; $i <= $totalPages; $i++)
                            <span class="page-indicator {{ $i === 1 ? 'active' : '' }}" data-page="{{ $i }}"></span>
                        @endfor
                    </div>
                    <button class="nav-btn next-btn" {{ $totalPages <= 1 ? 'disabled' : '' }}>
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
        
    </div>
    </div>
    <hr>
    <footer class="footer py-4 bg-dark text-white">
        <p>&copy; 2025 Tổng Kho Điều Hòa LG. All rights reserved.</p>
    </footer>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
                const sliderContainer = document.querySelector('.slider-container');
                const pages = document.querySelectorAll('.slider-page');
                const prevBtn = document.querySelector('.prev-btn');
                const nextBtn = document.querySelector('.next-btn');
                const indicators = document.querySelectorAll('.page-indicator');
                
                let currentPage = 1;
                const totalPages = pages.length;
                
                function goToPage(pageNum) {
                    pages.forEach(page => {
                        page.classList.remove('active');
                    });
                    
                    indicators.forEach(indicator => {
                        indicator.classList.remove('active');
                    });
                    
                    document.querySelector(`.slider-page[data-page="${pageNum}"]`).classList.add('active');
                    document.querySelector(`.page-indicator[data-page="${pageNum}"]`).classList.add('active');
                    
                    currentPage = pageNum;
                    updateNavButtons();
                }
                
                function updateNavButtons() {
                    prevBtn.disabled = currentPage === 1;
                    nextBtn.disabled = currentPage === totalPages;
                }
                
                prevBtn.addEventListener('click', function() {
                    if (currentPage > 1) {
                        goToPage(currentPage - 1);
                    }
                });
                
                nextBtn.addEventListener('click', function() {
                    if (currentPage < totalPages) {
                        goToPage(currentPage + 1);
                    }
                });
                
                indicators.forEach(indicator => {
                    indicator.addEventListener('click', function() {
                        const page = parseInt(this.getAttribute('data-page'));
                        goToPage(page);
                    });
                });
            });
        </script>
</html>