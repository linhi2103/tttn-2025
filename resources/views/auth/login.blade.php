@extends('auth.app')

@section('title', 'Đăng nhập')

@section('content')
    <div class="container">
        <div class="row login-container g-0">
            <div class="col-md-6 brand-side">
                <div class="brand-logo">LG</div>
                <p class="text-center fs-5">Chào mừng bạn đến với hệ thống quản lí kho vật tư của LG</p>
                <div class="mt-4">
                    <i class="fa-solid fa-warehouse fa-4x"></i>
                </div>
            </div>
            <div class="col-md-6 form-side">
                <div class="form-header">
                    <h2 class="fw-bold">Đăng nhập</h2>
                    <p class="text-muted">Vui lòng đăng nhập để tiếp tục sử dụng hệ thống</p>
                </div>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        <label for="username" class="form-label">
                            <i class="fa-solid fa-user me-2"></i>Tên đăng nhập
                        </label>
                        <input type="text" class="form-control form-control-lg" name="username" id="username" placeholder="Nhập tên đăng nhập">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">
                            <i class="fa-solid fa-lock me-2"></i>Mật khẩu
                        </label>
                        <input type="password" class="form-control form-control-lg" name="password" id="password" placeholder="Nhập mật khẩu">
                    </div>
                    <div class="row mb-4">
                        <div class="col-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="rememberMe">
                                <label class="form-check-label" for="rememberMe">
                                    Ghi nhớ đăng nhập
                                </label>
                            </div>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('forgot-password') }}" class="link-lg">Quên mật khẩu?</a>
                        </div>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-lg btn-lg-primary">
                            <i class="fa-solid fa-sign-in-alt me-2"></i>Đăng nhập
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection