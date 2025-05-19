<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LG - Quên mật khẩu</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --lg-red: #a50034;
            --lg-red-dark: #8e0029;
        }
        
        body {
            background-color: #f5f5f5;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .login-container {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            overflow: hidden;
        }
        
        .brand-side {
            background-color: var(--lg-red);
            color: white;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
        
        .brand-logo {
            font-size: 4rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
        }
        
        .form-side {
            background-color: white;
            padding: 3rem;
        }
        
        .form-header {
            margin-bottom: 2rem;
        }
        
        .form-control:focus {
            border-color: var(--lg-red);
            box-shadow: 0 0 0 0.25rem rgba(165, 0, 52, 0.25);
        }
        
        .form-check-input:checked {
            background-color: var(--lg-red);
            border-color: var(--lg-red);
        }
        
        .btn-lg-primary {
            background-color: var(--lg-red);
            color: white;
            transition: background-color 0.3s;
        }
        
        .btn-lg-primary:hover {
            background-color: var(--lg-red-dark);
            color: white;
        }
        
        .link-lg {
            color: var(--lg-red);
            text-decoration: none;
        }
        
        .link-lg:hover {
            color: var(--lg-red-dark);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row login-container g-0">
            <div class="col-md-6 brand-side">
                <div class="brand-logo">LG</div>
                <p class="text-center fs-5">Chào mừng bạn đến với hệ thống quản lí kho vật tư của LG</p>
                <div class="mt-4">
                    <i class="fa-solid fa-warehouse"></i>
                </div>
            </div>
            <div class="col-md-6 form-side">
                <div class="form-header">
                    <h2 class="fw-bold">Quên mật khẩu</h2>
                    <p class="text-muted">Vui lòng nhập thông tin để tiếp tục sử dụng hệ thống</p>
                </div>
                <form action="{{ route('forgot-password') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        <label for="email" class="form-label">
                            <i class="fa-solid fa-envelope me-2"></i>Email
                        </label>
                        <input type="text" class="form-control form-control-lg" name="email" id="email" placeholder="Nhập email">
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-lg btn-lg-primary">
                            <i class="fa-solid fa-envelope me-2"></i>Quên mật khẩu
                        </button>
                    </div>
                </form>
                <div class="text-center mt-4">
                    <p class="mb-0">
                        Quay lại <a href="{{ route('login') }}" class="link-lg fw-semibold">Đăng nhập</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>