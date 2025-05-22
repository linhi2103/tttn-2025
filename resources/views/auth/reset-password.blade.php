@extends('auth.app')

@section('title', 'Đặt lại mật khẩu')

@section('content')
<body>
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
                    <h2 class="fw-bold">Thay đổi mật khẩu</h2>
                    <p class="text-muted">Vui lòng nhập thông tin để tiếp tục sử dụng hệ thống</p>
                </div>
                <form action="{{ route('reset', $token) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        <input type="hidden" name="token" value="{{ $token }}">
                        <label for="password" class="form-label">
                            <i class="fa-solid fa-lock me-2"></i>Mật khẩu
                        </label>
                        <input type="password" class="form-control form-control-lg" name="password" id="password" placeholder="Nhập mật khẩu">
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">
                            <i class="fa-solid fa-lock me-2"></i>Nhập lại mật khẩu
                        </label>
                        <input type="password" class="form-control form-control-lg" name="password_confirmation" id="password_confirmation" placeholder="Nhập lại mật khẩu">
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-lg btn-lg-primary">
                            <i class="fa-solid fa-lock me-2"></i>Thay đổi mật khẩu
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