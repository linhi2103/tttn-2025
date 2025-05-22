@extends('auth.app')

@section('title', 'Quên mật khẩu')

@section('content')
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
@endsection