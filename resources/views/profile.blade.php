<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LG Profile - Bảng Điều Khiển Cá Nhân</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* ... giữ nguyên toàn bộ phần CSS như cũ ... */
        :root {
            --lg-red: #A50034;
            --lg-red-dark: #8B002C;
            --lg-red-light: #FFE8EE;
            --lg-gray: #F5F5F5;
            --lg-dark-gray: #333333;
            --lg-light-gray: #FAFAFA;
            --lg-border: #E0E0E0;
            --lg-success: #28A745;
            --lg-warning: #FFC107;
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--lg-light-gray);
            color: var(--lg-dark-gray);
        }
        .profile-container {
            max-width: 900px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        .profile-header {
            background: linear-gradient(135deg, var(--lg-red) 0%, var(--lg-red-dark) 100%);
            border-radius: 12px 12px 0 0;
            padding: 2rem;
            color: white;
            position: relative;
            overflow: hidden;
        }
        .profile-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="40" r="1.5" fill="rgba(255,255,255,0.1)"/><circle cx="40" cy="80" r="1" fill="rgba(255,255,255,0.1)"/></svg>');
        }
        .profile-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            overflow: hidden;
        }
        .header-content {
            display: flex;
            align-items: center;
            gap: 2rem;
            position: relative;
            z-index: 1;
        }
        .profile-avatar-container {
            position: relative;
        }
        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid rgba(255,255,255,0.2);
            background: var(--lg-gray);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: var(--lg-red);
            transition: all 0.3s ease;
        }
        .avatar-upload {
            position: absolute;
            bottom: 0;
            right: 0;
            background: var(--lg-red);
            color: white;
            border: 2px solid white;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }
        .profile-info h1 {
            font-size: 2rem;
            font-weight: 600;
            margin: 0 0 0.5rem;
        }
        .profile-info p {
            margin: 0;
            opacity: 0.9;
        }
        .profile-body {
            padding: 2rem;
        }
        .profile-section {
            margin-bottom: 2rem;
        }
        .section-header {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--lg-red-light);
        }
        .section-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--lg-red);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin: 0;
        }
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }
        .info-field {
            position: relative;
        }
        .field-label {
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--lg-red);
            margin-bottom: 0.5rem;
            display: block;
        }
        .form-control, .form-select {
            border: 1px solid var(--lg-border);
            border-radius: 8px;
            padding: 0.75rem 1rem;
            transition: all 0.2s ease;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--lg-red);
            box-shadow: 0 0 0 0.2rem rgba(165, 0, 52, 0.25);
        }
        .btn-lg-primary {
            background: var(--lg-red);
            border: none;
            color: white;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        .btn-lg-primary:hover {
            background: var(--lg-red-dark);
            color: white;
            transform: translateY(-1px);
        }
        .btn-lg-outline {
            border: 2px solid var(--lg-red);
            color: var(--lg-red);
            background: transparent;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        .btn-lg-outline:hover {
            background: var(--lg-red);
            color: white;
            transform: translateY(-1px);
        }
        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--lg-border);
        }
        .textarea-field {
            min-height: 100px;
            resize: vertical;
        }
        @media (max-width: 768px) {
            .profile-container {
                margin: 1rem auto;
            }
            .header-content {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
            }
            .info-grid {
                grid-template-columns: 1fr;
            }
            .action-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <div class="profile-card">
            <!-- Nội dung hồ sơ -->
            <form action="{{ route('profile.update') }}" method="POST" class="profile-body" enctype="multipart/form-data">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @csrf
                <!-- Header hồ sơ -->
                <div class="profile-header">
                    <div class="header-content">
                        <div class="profile-avatar-container">
                            <div class="profile-avatar">
                                <img src="{{ asset($user->nhanvien->Anh ?? '') }}" alt="Avatar" class="img-fluid rounded-circle" id="avatarPreview">
                            </div>
                            <div class="avatar-upload">
                                <i class="fas fa-camera"></i>
                                <input type="file" style="opacity:0;position:absolute;left:0;top:0;width:100%;height:100%;" accept="image/*" name="avatar" id="avatarEdit">
                            </div>
                        </div>
                        <div class="profile-info">
                            <h1>{{ $user->nhanvien->TenNhanVien }}</h1>
                        </div>
                    </div>
                </div>
                <hr>
                <!-- Thông tin cá nhân -->
                <div class="profile-section">
                    <div class="section-header">
                        <h3 class="section-title">
                            <i class="fas fa-user"></i>
                            Thông Tin Cá Nhân
                        </h3>
                    </div>
                    <div class="info-grid">
                        <div class="info-field">
                            <label class="field-label" for="nameEdit">Họ và Tên</label>
                            <input type="text" class="form-control" id="nameEdit" name="name" value="{{ $user->nhanvien->TenNhanVien }}" readonly>
                        </div>
                        <div class="info-field">
                            <label class="field-label" for="genderEdit">Giới Tính</label>
                            <input type="text" class="form-control" id="genderEdit" name="gender" value="{{ $user->nhanvien->GioiTinh }}" readonly>
                        </div>
                        <div class="info-field">
                            <label class="field-label" for="dobEdit">Ngày Sinh</label>
                            <input type="date" class="form-control" id="dobEdit" name="dob" value="{{ $user->nhanvien->NgaySinh }}" readonly>
                        </div>
                        <div class="info-field">
                            <label class="field-label" for="cccdEdit">Số Căn Cước Công Dân</label>
                            <input type="text" class="form-control" id="cccdEdit" name="cccd" value="{{ $user->nhanvien->CCCD }}" readonly>
                        </div>
                        <div class="info-field">
                            <label class="field-label" for="empIdEdit">Mã Nhân Viên</label>
                            <input type="text" class="form-control" id="empIdEdit" name="emp_id" value="{{ $user->nhanvien->MaNhanVien }}" readonly>
                        </div>
                        <div class="info-field">
                            <label class="field-label" for="positionEdit">Chức Vụ</label>
                            <input type="text" class="form-control" id="positionEdit" name="position" value="{{ $user->nhanvien->chucvu->TenChucVu ?? 'Chưa có chức vụ' }}" readonly>
                        </div>
                        <div class="info-field">
                            <label class="field-label" for="departmentEdit">Phòng Ban</label>
                            <input type="text" class="form-control" id="departmentEdit" name="department" value="{{ $user->nhanvien->chucvu->phongban->TenPhongBan ?? 'Chưa có phòng ban' }}" readonly>
                        </div>
                    </div>
                </div>
                <!-- Thông tin liên hệ -->
                <div class="profile-section">
                    <div class="section-header">
                        <h3 class="section-title">
                            <i class="fas fa-address-card"></i>
                            Thông Tin Liên Hệ
                        </h3>
                    </div>
                    <div class="info-grid">
                        <div class="info-field">
                            <label class="field-label" for="phoneEdit">Số Điện Thoại</label>
                            <input type="tel" class="form-control" id="phoneEdit" name="phone" value="{{ $user->nhanvien->SDT }}">
                        </div>
                        <div class="info-field">
                            <label class="field-label" for="locationEdit">Địa Chỉ</label>
                            <input type="text" class="form-control" id="locationEdit" name="location" value="{{ $user->nhanvien->DiaChi }}">
                        </div>
                    </div>
                </div>

                <!-- Thông tin tài khoản -->
                <div class="profile-section">
                    <div class="section-header">
                        <h3 class="section-title">
                            <i class="fas fa-key"></i>
                            Thông Tin Tài Khoản
                        </h3>
                    </div>
                    <div class="info-grid">
                        <div class="info-field">
                            <label class="field-label" for="usernameEdit">Tên Đăng Nhập</label>
                            <input type="text" class="form-control" id="usernameEdit" name="username" value="{{ $user->TaiKhoan }}" readonly>
                        </div>
                        <div class="info-field">
                            <label class="field-label" for="accountEmailEdit">Email</label>
                            <input type="email" class="form-control" id="accountEmailEdit" name="email" value="{{ $user->Email ?? '' }}">
                        </div>
                    </div>
                </div>

                <div class="action-buttons">
                    <a href="/" class="btn btn-lg-outline">
                        <i class="fas fa-times me-2"></i>
                        Hủy Bỏ
                    </a>
                    <button type="submit" class="btn btn-lg-primary">
                        <i class="fas fa-save me-2"></i>
                        Lưu Thay Đổi
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
<script>
    document.getElementById('avatarEdit').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatarPreview').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
</script>
</html>