-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 26, 2025 lúc 08:56 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `tuan9`
--

--
-- Đang đổ dữ liệu cho bảng `activity_log`
--

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `event`, `subject_id`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(1, 'default', 'Tạo mới', 'App\\Models\\NguoiDung', NULL, '1', NULL, NULL, '{\"model_type\":\"App\\\\Models\\\\NguoiDung\",\"attributes\":{\"TaiKhoan\":\"admin\",\"MatKhau\":\"$2y$12$bhAfIIjsLT4N0f7q9DAvku9m05EeNXxFgjnrpq8ZZ4rxj76ZchOcK\",\"Email\":\"nhixinhgai2110@gmail.com\",\"MaNhanVien\":\"2110\",\"MaVaiTro\":\"0\",\"updated_at\":\"2025-05-25 17:47:06\",\"created_at\":\"2025-05-25 17:47:06\",\"id\":1}}', NULL, '2025-05-25 10:47:06', '2025-05-25 10:47:06'),
(2, 'default', 'Tạo mới', 'App\\Models\\PhieuKiemKe', NULL, '13321', 'App\\Models\\NguoiDung', 1, '{\"model_type\":\"App\\\\Models\\\\PhieuKiemKe\",\"attributes\":{\"MaPhieuKiemKe\":\"13321\",\"MaKho\":\"KHO002\",\"MaLenhDieuDong\":\"LD002\",\"ChiTietKiemKe\":\"[{\\\"MaVatTu\\\":\\\"VT014\\\",\\\"TenVatTu\\\":\\\"B\\\\u0103ng d\\\\u00ednh c\\\\u00e1ch \\\\u0111i\\\\u1ec7n 3M\\\",\\\"DonViTinh\\\":\\\"C\\\\u00e1i\\\",\\\"DonGia\\\":\\\"8000.00\\\",\\\"SoLuongTon\\\":1,\\\"SoLuongThucTe\\\":\\\"1\\\",\\\"ConTot\\\":\\\"1\\\",\\\"KemChatLuong\\\":\\\"0\\\",\\\"MatChatLuong\\\":0},{\\\"MaVatTu\\\":\\\"VT006\\\",\\\"TenVatTu\\\":\\\"Keo d\\\\u00e1n t\\\\u1ea3n nhi\\\\u1ec7t\\\",\\\"DonViTinh\\\":\\\"C\\\\u00e1i\\\",\\\"DonGia\\\":\\\"50000.00\\\",\\\"SoLuongTon\\\":1,\\\"SoLuongThucTe\\\":\\\"1\\\",\\\"ConTot\\\":\\\"1\\\",\\\"KemChatLuong\\\":\\\"0\\\",\\\"MatChatLuong\\\":0},{\\\"MaVatTu\\\":\\\"VT021\\\",\\\"TenVatTu\\\":\\\"\\\\u0110i\\\\u1ec7n tr\\\\u1edf 10k\\\\u03a9\\\",\\\"DonViTinh\\\":\\\"C\\\\u00e1i\\\",\\\"DonGia\\\":\\\"100.00\\\",\\\"SoLuongTon\\\":1000,\\\"SoLuongThucTe\\\":\\\"389\\\",\\\"ConTot\\\":\\\"232\\\",\\\"KemChatLuong\\\":\\\"145\\\",\\\"MatChatLuong\\\":12}]\",\"updated_at\":\"2025-05-25 17:48:27\",\"created_at\":\"2025-05-25 17:48:27\"}}', NULL, '2025-05-25 10:48:27', '2025-05-25 10:48:27'),
(3, 'default', 'Cập nhật', 'App\\Models\\PhieuKiemKe', NULL, '13321', 'App\\Models\\NguoiDung', 1, '{\"model_type\":\"App\\\\Models\\\\PhieuKiemKe\",\"old_values\":{\"TrangThai\":\"Ch\\u1edd Duy\\u1ec7t\",\"updated_at\":\"2025-05-25T17:48:27.000000Z\"},\"new_values\":{\"TrangThai\":\"\\u0110\\u00e3 Ki\\u1ec3m K\\u00ea\",\"updated_at\":\"2025-05-25 17:48:38\"}}', NULL, '2025-05-25 10:48:38', '2025-05-25 10:48:38'),
(4, 'default', 'Tạo mới', 'App\\Models\\ThanhLyKho', NULL, '2132', 'App\\Models\\NguoiDung', 1, '{\"model_type\":\"App\\\\Models\\\\ThanhLyKho\",\"attributes\":{\"MaPhieuThanhLy\":\"2132\",\"MaLenhDieuDong\":\"LD001\",\"MaKho\":\"KHO001\",\"ChiTietThanhLy\":\"[{\\\"MaVatTu\\\":\\\"VT005\\\",\\\"TenVatTu\\\":\\\"C\\\\u1ea3m bi\\\\u1ebfn LG Sensor Pro\\\",\\\"SoLuong\\\":\\\"1\\\",\\\"DonVi\\\":\\\"C\\\\u00e1i\\\",\\\"DonGia\\\":\\\"1000000.00\\\",\\\"ThanhTien\\\":1000000,\\\"NguyenNhanThanhLy\\\":\\\"h\\\\u1ecfng\\\",\\\"BienPhapThanhLy\\\":\\\"Xu\\\\u1ea5t tr\\\\u1ea3 nh\\\\u00e0 cung c\\\\u1ea5p\\\"}]\",\"updated_at\":\"2025-05-25 17:49:47\",\"created_at\":\"2025-05-25 17:49:47\"}}', NULL, '2025-05-25 10:49:47', '2025-05-25 10:49:47'),
(5, 'default', 'Tạo mới', 'App\\Models\\XuatKho', NULL, '534', 'App\\Models\\NguoiDung', 1, '{\"model_type\":\"App\\\\Models\\\\XuatKho\",\"attributes\":{\"MaPhieuXuat\":\"534\",\"MaKho\":\"KHO003\",\"MaDonViVanChuyen\":\"DVC002\",\"DiaDiemXuat\":\"dcsewe\",\"DonViTienTe\":\"vnd\",\"ChiTietXuatKho\":\"[{\\\"MaVatTu\\\":\\\"VT017\\\",\\\"TenVatTu\\\":\\\"IC ngu\\\\u1ed3n LG 1117-3.3V\\\",\\\"DonViTinh\\\":\\\"C\\\\u00e1i\\\",\\\"DonGia\\\":\\\"4000.00\\\",\\\"SoLuongXuat\\\":\\\"\\\",\\\"ThanhTien\\\":0,\\\"SoLuong\\\":\\\"1\\\"}]\",\"MaLenhDieuDong\":\"LD001\"}}', NULL, '2025-05-26 07:10:42', '2025-05-26 07:10:42'),
(6, 'default', 'Cập nhật', 'App\\Models\\VatTu', NULL, 'VT017', 'App\\Models\\NguoiDung', 1, '{\"model_type\":\"App\\\\Models\\\\VatTu\",\"old_values\":{\"SoLuongTon\":1},\"new_values\":{\"SoLuongTon\":\"231\"}}', NULL, '2025-05-26 07:11:07', '2025-05-26 07:11:07'),
(7, 'default', 'Cập nhật', 'App\\Models\\XuatKho', NULL, '534', 'App\\Models\\NguoiDung', 1, '{\"model_type\":\"App\\\\Models\\\\XuatKho\",\"old_values\":{\"TrangThai\":\"Ch\\u1edd duy\\u1ec7t\"},\"new_values\":{\"TrangThai\":\"\\u0110\\u00e3 duy\\u1ec7t\"}}', NULL, '2025-05-26 07:26:10', '2025-05-26 07:26:10'),
(8, 'default', 'Cập nhật', 'App\\Models\\VatTu', NULL, 'VT017', 'App\\Models\\NguoiDung', 1, '{\"model_type\":\"App\\\\Models\\\\VatTu\",\"old_values\":{\"SoLuongTon\":231},\"new_values\":{\"SoLuongTon\":220}}', NULL, '2025-05-26 07:50:25', '2025-05-26 07:50:25'),
(9, 'default', 'Cập nhật', 'App\\Models\\XuatKho', NULL, '534', 'App\\Models\\NguoiDung', 1, '{\"model_type\":\"App\\\\Models\\\\XuatKho\",\"old_values\":{\"ChiTietXuatKho\":\"[{\\\"MaVatTu\\\":\\\"VT017\\\",\\\"TenVatTu\\\":\\\"IC ngu\\\\u1ed3n LG 1117-3.3V\\\",\\\"DonViTinh\\\":\\\"C\\\\u00e1i\\\",\\\"DonGia\\\":\\\"4000.00\\\",\\\"SoLuongXuat\\\":\\\"\\\",\\\"ThanhTien\\\":0,\\\"SoLuong\\\":\\\"1\\\"}]\"},\"new_values\":{\"ChiTietXuatKho\":\"[{\\\"MaVatTu\\\":\\\"VT017\\\",\\\"TenVatTu\\\":\\\"IC ngu\\\\u1ed3n LG 1117-3.3V\\\",\\\"DonViTinh\\\":\\\"C\\\\u00e1i\\\",\\\"DonGia\\\":\\\"4000.00\\\",\\\"SoLuongXuat\\\":11,\\\"ThanhTien\\\":44000,\\\"SoLuong\\\":\\\"1\\\"}]\"}}', NULL, '2025-05-26 07:50:25', '2025-05-26 07:50:25'),
(10, 'default', 'Cập nhật', 'App\\Models\\VatTu', NULL, 'VT002', 'App\\Models\\NguoiDung', 1, '{\"model_type\":\"App\\\\Models\\\\VatTu\",\"old_values\":{\"SoLuongTon\":22},\"new_values\":{\"SoLuongTon\":12}}', NULL, '2025-05-26 07:50:45', '2025-05-26 07:50:45'),
(11, 'default', 'Cập nhật', 'App\\Models\\XuatKho', NULL, '534', 'App\\Models\\NguoiDung', 1, '{\"model_type\":\"App\\\\Models\\\\XuatKho\",\"old_values\":{\"ChiTietXuatKho\":\"[{\\\"MaVatTu\\\":\\\"VT017\\\",\\\"TenVatTu\\\":\\\"IC ngu\\\\u1ed3n LG 1117-3.3V\\\",\\\"DonViTinh\\\":\\\"C\\\\u00e1i\\\",\\\"DonGia\\\":\\\"4000.00\\\",\\\"SoLuongXuat\\\":11,\\\"ThanhTien\\\":44000,\\\"SoLuong\\\":\\\"1\\\"}]\"},\"new_values\":{\"ChiTietXuatKho\":\"[{\\\"MaVatTu\\\":\\\"VT002\\\",\\\"TenVatTu\\\":\\\"Bo m\\\\u1ea1ch ch\\\\u1ee7 LG Main X1\\\",\\\"DonViTinh\\\":\\\"C\\\\u00e1i\\\",\\\"DonGia\\\":\\\"1500000.00\\\",\\\"SoLuongXuat\\\":10,\\\"ThanhTien\\\":15000000,\\\"SoLuong\\\":\\\"1\\\"}]\"}}', NULL, '2025-05-26 07:50:45', '2025-05-26 07:50:45'),
(12, 'default', 'Cập nhật', 'App\\Models\\VatTu', NULL, 'VT002', 'App\\Models\\NguoiDung', 1, '{\"model_type\":\"App\\\\Models\\\\VatTu\",\"old_values\":{\"GiaNhap\":\"1500000.00\",\"SoLuongTon\":12},\"new_values\":{\"GiaNhap\":\"150000.00\",\"SoLuongTon\":\"120\"}}', NULL, '2025-05-26 07:51:03', '2025-05-26 07:51:03'),
(13, 'default', 'Cập nhật', 'App\\Models\\VatTu', NULL, 'VT003', 'App\\Models\\NguoiDung', 1, '{\"model_type\":\"App\\\\Models\\\\VatTu\",\"old_values\":{\"SoLuongTon\":1},\"new_values\":{\"SoLuongTon\":\"123\"}}', NULL, '2025-05-26 07:51:11', '2025-05-26 07:51:11'),
(14, 'default', 'Cập nhật', 'App\\Models\\VatTu', NULL, 'VT005', 'App\\Models\\NguoiDung', 1, '{\"model_type\":\"App\\\\Models\\\\VatTu\",\"old_values\":{\"SoLuongTon\":5},\"new_values\":{\"SoLuongTon\":\"543\"}}', NULL, '2025-05-26 07:51:18', '2025-05-26 07:51:18'),
(15, 'default', 'Cập nhật', 'App\\Models\\VatTu', NULL, 'VT002', 'App\\Models\\NguoiDung', 1, '{\"model_type\":\"App\\\\Models\\\\VatTu\",\"old_values\":{\"SoLuongTon\":120},\"new_values\":{\"SoLuongTon\":110}}', NULL, '2025-05-26 07:51:30', '2025-05-26 07:51:30'),
(16, 'default', 'Cập nhật', 'App\\Models\\NguoiDung', NULL, '1', 'App\\Models\\NguoiDung', 1, '{\"model_type\":\"App\\\\Models\\\\NguoiDung\",\"old_values\":{\"MatKhau\":\"$2y$12$bhAfIIjsLT4N0f7q9DAvku9m05EeNXxFgjnrpq8ZZ4rxj76ZchOcK\",\"MaNhanVien\":\"2110\",\"updated_at\":\"2025-05-25T17:47:06.000000Z\"},\"new_values\":{\"MatKhau\":\"$2y$12$BuSgOFZcPuZxFMbcoXoQNeO5bBH7UYpSlSEoVJ78V7fw1wRQs.P2C\",\"MaNhanVien\":\"NV001\",\"updated_at\":\"2025-05-26 18:34:15\"}}', NULL, '2025-05-26 11:34:15', '2025-05-26 11:34:15'),
(17, 'default', 'Cập nhật', 'App\\Models\\NhanVien', NULL, 'NV001', 'App\\Models\\NguoiDung', 1, '{\"model_type\":\"App\\\\Models\\\\NhanVien\",\"old_values\":{\"Anh\":\"nhanvien\\\\NV001.jpg\"},\"new_values\":{\"Anh\":\"images\\/nhanvien\\/NV001.jpg\"}}', NULL, '2025-05-26 11:34:50', '2025-05-26 11:34:50'),
(18, 'default', 'Tạo mới', 'App\\Models\\ChucVu', NULL, '0', 'App\\Models\\NguoiDung', 1, '{\"model_type\":\"App\\\\Models\\\\ChucVu\",\"attributes\":{\"MaPhongBan\":\"PB005\",\"MaChucVu\":\"CV001\",\"TenChucVu\":\"Qu\\u1ea3n l\\u00ed\",\"id\":0}}', NULL, '2025-05-26 11:38:36', '2025-05-26 11:38:36'),
(19, 'default', 'Tạo mới', 'App\\Models\\ChucVu', NULL, '0', 'App\\Models\\NguoiDung', 1, '{\"model_type\":\"App\\\\Models\\\\ChucVu\",\"attributes\":{\"MaPhongBan\":\"PB001\",\"MaChucVu\":\"CV002\",\"TenChucVu\":\"Nh\\u00e2n Vi\\u00ean\",\"id\":0}}', NULL, '2025-05-26 11:38:52', '2025-05-26 11:38:52'),
(20, 'default', 'Tạo mới', 'App\\Models\\ChucVu', NULL, '0', 'App\\Models\\NguoiDung', 1, '{\"model_type\":\"App\\\\Models\\\\ChucVu\",\"attributes\":{\"MaPhongBan\":\"PB002\",\"MaChucVu\":\"CV003\",\"TenChucVu\":\"Nh\\u00e2n Vi\\u00ean\",\"id\":0}}', NULL, '2025-05-26 11:39:04', '2025-05-26 11:39:04'),
(21, 'default', 'Tạo mới', 'App\\Models\\ChucVu', NULL, '0', 'App\\Models\\NguoiDung', 1, '{\"model_type\":\"App\\\\Models\\\\ChucVu\",\"attributes\":{\"MaPhongBan\":\"PB003\",\"MaChucVu\":\"CV004\",\"TenChucVu\":\"Nh\\u00e2n Vi\\u00ean\",\"id\":0}}', NULL, '2025-05-26 11:39:19', '2025-05-26 11:39:19'),
(22, 'default', 'Tạo mới', 'App\\Models\\ChucVu', NULL, '0', 'App\\Models\\NguoiDung', 1, '{\"model_type\":\"App\\\\Models\\\\ChucVu\",\"attributes\":{\"MaPhongBan\":\"PB004\",\"MaChucVu\":\"CV005\",\"TenChucVu\":\"Nh\\u00e2n Vi\\u00ean\",\"id\":0}}', NULL, '2025-05-26 11:39:38', '2025-05-26 11:39:38'),
(23, 'default', 'Cập nhật', 'App\\Models\\NhanVien', NULL, 'NV002', 'App\\Models\\NguoiDung', 1, '{\"model_type\":\"App\\\\Models\\\\NhanVien\",\"old_values\":{\"GioiTinh\":\"N\\u1eef\"},\"new_values\":{\"GioiTinh\":\"Nam\"}}', NULL, '2025-05-26 11:45:41', '2025-05-26 11:45:41'),
(24, 'default', 'Cập nhật', 'App\\Models\\NhanVien', NULL, 'NV001', 'App\\Models\\NguoiDung', 1, '{\"model_type\":\"App\\\\Models\\\\NhanVien\",\"old_values\":{\"GioiTinh\":\"Nam\"},\"new_values\":{\"GioiTinh\":\"N\\u1eef\"}}', NULL, '2025-05-26 11:45:48', '2025-05-26 11:45:48'),
(25, 'default', 'Cập nhật', 'App\\Models\\NhanVien', NULL, 'NV001', 'App\\Models\\NguoiDung', 1, '{\"model_type\":\"App\\\\Models\\\\NhanVien\",\"old_values\":{\"TenNhanVien\":\"Nguy\\u1ec5n V\\u0103n A\",\"DiaChi\":\"H\\u00e0 N\\u1ed9i\",\"SDT\":912345678},\"new_values\":{\"TenNhanVien\":\"Nguy\\u1ec5n Th\\u1ecb Linh Nhi\",\"DiaChi\":\"Th\\u00e1i B\\u00ecnh\",\"SDT\":\"0975053833\"}}', NULL, '2025-05-26 11:46:12', '2025-05-26 11:46:12');

--
-- Đang đổ dữ liệu cho bảng `chitietvattu`
--

INSERT INTO `chitietvattu` (`MaVatTu`, `ThuongHieu`, `KichThuoc`, `XuatXu`, `MoTa`, `created_at`, `updated_at`) VALUES
('VT001', 'LG', NULL, 'Trung Quốc', 'Bộ xử lý AI α7 Gen4 tự động nhận dạng thể loại nội dung và điều kiện ánh sáng xung quanh bạn, rồi tối ưu hóa thiết lập màn hình cho phù hợp. Mỗi điều chỉnh tự động đều mang lại hình ảnh chất lượng cao và sắc nét, đảm bảo cải thiện trải nghiệm xem TV.', NULL, NULL),
('VT002', 'IPhone', '9,6 inch (30,5 x 24,4 cm)', 'Trung Quốc', NULL, NULL, NULL);

--
-- Đang đổ dữ liệu cho bảng `chucvu`
--

INSERT INTO `chucvu` (`MaChucVu`, `MaPhongBan`, `TenChucVu`) VALUES
('CV001', 'PB002', 'Quản lí'),
('CV002', 'PB001', 'Nhân Viên');


--
-- Đang đổ dữ liệu cho bảng `danhmuckho`
--

INSERT INTO `danhmuckho` (`MaKho`, `TenKho`, `DiaChi`, `QuyMo`, `DienTichSuDung`) VALUES
('KHO001', 'Kho A', 'Số 1, Đường ABC, TP. HCM', 1000, 750),
('KHO002', 'Kho B', 'Số 2, Đường XYZ, TP. Hải Phòng', 1500, 1250),
('KHO003', 'Kho C', 'Số 3, Đường DEF, TP. Đà Nẵng', 2000, 1720),
('KHO004', 'Kho D', 'Số 4, Đường GHI, TP. Cần Thơ', 1200, 1100),
('KHO005', 'Kho E', 'Số 43, Đường ABC, TP. HCM', 320, 220);

--
-- Đang đổ dữ liệu cho bảng `doitac`
--

INSERT INTO `doitac` (`MaSoThue_DoiTac`, `TenDoiTac`, `Email`, `SDT`, `DiaChi`) VALUES
('0201234567', 'Công ty TNHH Cơ khí Thành Công', 'thanhcong@doitac.vn', '0901234567', 'Lô A2, KCN An Dương, Hải Phòng 1'),
('0207654321', 'Công ty TNHH Bao bì Minh Long', 'minhlong@doitac.vn', '0912345678', 'Lô B5, KCN An Dương, Hải Phòng'),
('0209988776', 'Công ty TNHH Vận tải Hoàng Gia 34', 'hoanggia@doitac.vn', '0923456789', 'Lô C3, KCN An Dương, Hải Phòng'),
('0312345678', 'Công ty TNHH Thiết Bị Điện Ánh Dương', 'lienhe@anhduong.com', '0909123456', '123 Lê Văn Việt, Q.9, TP.HCM'),
('0409876543', 'Công ty CP Giao Nhận Hoàng Long', 'contact@hoanglonglogistics.vn', '0912345678', '456 Trường Chinh, Q.Tân Bình, TP.HCM'),
('0505678901', 'Công ty TNHH Bao Bì Đại Phát', 'info@baobidaiphat.vn', '0938765432', '789 Nguyễn Văn Cừ, Q.5, TP.HCM'),
('0601234567', 'Công ty TNHH Linh Kiện Điện Tử Miền Bắc', 'contact@lkmb.vn', '0971234567', 'Số 10, KCN Tiên Sơn, Bắc Ninh');

--
-- Đang đổ dữ liệu cho bảng `donvitinh`
--

INSERT INTO `donvitinh` (`MaDonViTinh`, `TenDonViTinh`) VALUES
('DVT001', 'Cái'),
('DVT002', 'Hộp'),
('DVT003', 'Kg'),
('DVT004', 'Lít 1'),
('DVT005', 'Thùng'),
('DVT006', 'Mét'),
('DVT007', 'Kệ');

--
-- Đang đổ dữ liệu cho bảng `donvivanchuyen`
--

INSERT INTO `donvivanchuyen` (`MaDonViVanChuyen`, `TenDonViVanChuyen`, `PhuongTienVanChuyen`, `GhiChu`) VALUES
('DVC001', 'Đơn Vị Vận Chuyển 1', 'Xe tải', 'Ghi chú đơn vị 1'),
('DVC002', 'Đơn Vị Vận Chuyển 2', 'Xe container', 'Ghi chú đơn vị 2'),
('DVC003', 'Đơn Vị Vận Chuyển 3', 'Xe tải 5T', 'Ghi chú đơn vị 3');

--
-- Đang đổ dữ liệu cho bảng `lenhdieudong`
--

INSERT INTO `lenhdieudong` (`MaLenhDieuDong`, `TenLenhDieuDong`, `LyDo`, `MaNhanVien`, `created_at`, `updated_at`, `TrangThai`, `GhiChu`) VALUES
('LD001', 'Lệnh điều động 1', 'Vận chuyển hàng hóa từ kho A đến kho B', 'NV001', '2025-05-26', '2025-05-26', 'Đang hoạt động', 'nhy'),
('LD002', 'Lệnh điều động 2', 'Chuyển hàng từ kho C đến kho D', 'NV002', '2025-05-26', '2025-05-26', 'Đang hoạt động', 'Ghi chú về lệnh điều động 2'),
('LD003', 'Lệnh điều động 3', 'Vận chuyển sản phẩm từ kho A đến kho C', 'NV003', '2025-05-26', '2025-05-26', 'Đang hoạt động', 'Ghi chú về lệnh điều động 3');

--
-- Đang đổ dữ liệu cho bảng `loaivattu`
--

INSERT INTO `loaivattu` (`MaLoaiVatTu`, `TenLoaiVatTu`) VALUES
('LVT001', 'Vật tư tiêu hao & phụ trợ sản xuất'),
('LVT002', 'Linh kiện bán dẫn'),
('LVT003', 'Linh kiện thụ động'),
('LVT004', 'Linh kiện hiển thị & đầu ra'),
('LVT005', 'Bo mạch & cụm linh kiện'),
('LVT006', 'Cảm biến & thiết bị đo'),
('LVT007', 'Thiết bị cơ điện tử'),
('LVT008', 'Nguồn điện & linh kiện nguồn');

--
-- Đang đổ dữ liệu cho bảng `nguoidung`
--

INSERT INTO `nguoidung` (`id`, `TaiKhoan`, `MatKhau`, `Email`, `MaNhanVien`, `MaVaiTro`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$12$BuSgOFZcPuZxFMbcoXoQNeO5bBH7UYpSlSEoVJ78V7fw1wRQs.P2C', 'nhixinhgai2110@gmail.com', 'NV001', '0', NULL, '2025-05-25 10:47:06', '2025-05-26 11:34:15');

--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`MaNhanVien`, `TenNhanVien`, `DiaChi`, `GioiTinh`, `NgaySinh`, `SDT`, `CCCD`, `MaChucVu`, `Anh`, `TrangThai`) VALUES
('NV001', 'Nguyễn Thị Linh Nhi', 'Thái Bình', 'Nữ', '1990-01-01', 975053833, 1122334455, 'CV001', 'images/nhanvien/NV001.jpg', 'Đang làm'),
('NV002', 'Trần Thị B', 'Hải Phòng', 'Nam', '1992-02-02', 923456789, 2233445566, 'CV002', 'avatar2.jpg', 'Đang làm'),
('NV004', 'Phạm Thị D', 'TP.HCM', 'Nữ', '1995-04-04', 945678901, 4455667788, 'CV003', 'avatar4.jpg', 'Đang làm'),
('NV005', 'Hoàng Văn E', 'Cần Thơ', 'Nam', '1991-05-05', 956789012, 5566778899, 'CV002', 'avatar5.jpg', 'Đang làm');

--
-- Đang đổ dữ liệu cho bảng `phieukiemke`
--

INSERT INTO `phieukiemke` (`MaPhieuKiemKe`, `MaKho`, `MaLenhDieuDong`, `TrangThai`, `ChiTietKiemKe`, `created_at`, `updated_at`) VALUES
('13321', 'KHO002', 'LD002', 'Đã Kiểm Kê', '[{\"MaVatTu\":\"VT014\",\"TenVatTu\":\"B\\u0103ng d\\u00ednh c\\u00e1ch \\u0111i\\u1ec7n 3M\",\"DonViTinh\":\"C\\u00e1i\",\"DonGia\":\"8000.00\",\"SoLuongTon\":1,\"SoLuongThucTe\":\"1\",\"ConTot\":\"1\",\"KemChatLuong\":\"0\",\"MatChatLuong\":0},{\"MaVatTu\":\"VT006\",\"TenVatTu\":\"Keo d\\u00e1n t\\u1ea3n nhi\\u1ec7t\",\"DonViTinh\":\"C\\u00e1i\",\"DonGia\":\"50000.00\",\"SoLuongTon\":1,\"SoLuongThucTe\":\"1\",\"ConTot\":\"1\",\"KemChatLuong\":\"0\",\"MatChatLuong\":0},{\"MaVatTu\":\"VT021\",\"TenVatTu\":\"\\u0110i\\u1ec7n tr\\u1edf 10k\\u03a9\",\"DonViTinh\":\"C\\u00e1i\",\"DonGia\":\"100.00\",\"SoLuongTon\":1000,\"SoLuongThucTe\":\"389\",\"ConTot\":\"232\",\"KemChatLuong\":\"145\",\"MatChatLuong\":12}]', '2025-05-25 10:48:27', '2025-05-25 10:48:38');

--
-- Đang đổ dữ liệu cho bảng `phongban`
--

INSERT INTO `phongban` (`MaPhongBan`, `TenPhongBan`) VALUES
('PB001', 'Nhân Viên '),
('PB002', 'Cán Bộ Kho');

--
-- Đang đổ dữ liệu cho bảng `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('dtdsna9TZoF5QqZCUOEPHBYao19Bjk4ipUvg4iRA', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiaHFIU1l5UzlZZkxpU3pIUThvTkZ1cTNWazBoNVNCMWJBZU5SMGhNMCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1748285239),
('o00xFwtJCO4lBa9MLF9ialAuwfKFxohkaHLz0c31', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiNFVjSk1laTZqWkRPYXFKTnFNMDdYZFlLWGgxUERZYUZ0ZFp0YmNCVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM6InVybCI7YTowOnt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1748272684);

--
-- Đang đổ dữ liệu cho bảng `thanhlykho`
--

INSERT INTO `thanhlykho` (`MaPhieuThanhLy`, `MaKho`, `MaLenhDieuDong`, `TrangThai`, `ChiTietThanhLy`, `created_at`, `updated_at`) VALUES
('2132', 'KHO001', 'LD001', 'Chờ duyệt', '[{\"MaVatTu\":\"VT005\",\"TenVatTu\":\"C\\u1ea3m bi\\u1ebfn LG Sensor Pro\",\"SoLuong\":\"1\",\"DonVi\":\"C\\u00e1i\",\"DonGia\":\"1000000.00\",\"ThanhTien\":1000000,\"NguyenNhanThanhLy\":\"h\\u1ecfng\",\"BienPhapThanhLy\":\"Xu\\u1ea5t tr\\u1ea3 nh\\u00e0 cung c\\u1ea5p\"}]', '2025-05-25 10:49:47', '2025-05-25 10:49:47');

--
-- Đang đổ dữ liệu cho bảng `vaitro`
--

INSERT INTO `vaitro` (`MaVaiTro`, `TenVaiTro`, `QuyenHan`) VALUES
(0, 'admin', 'Admin'),
(1, 'user', 'User');

--
-- Đang đổ dữ liệu cho bảng `vattu`
--

INSERT INTO `vattu` (`MaVatTu`, `MaLoaiVatTu`, `TenVatTu`, `MaDonViTinh`, `GiaNhap`, `DonViTienTe`, `SoLuongTon`, `MaSoThue_DoiTac`, `NgayNhap`, `HanSuDung`, `GhiChu`, `AnhVatTu`) VALUES
('VT001', 'LVT002', 'Chip xử lý LG Alpha', 'DVT001', 3000000.00, 'VND', 2, '0505678901', '2025-04-05', '2025-05-02', 'nhy21', 'LVT002\\download (1).jpg'),
('VT002', 'LVT005', 'Bo mạch chủ LG Main X1', 'DVT001', 150000.00, 'VND', 110, '0505678901', '2025-04-05', '2025-05-17', 'NHYYY', 'LVT005\\download.jpg'),
('VT003', 'LVT003', 'RAM LG DDR4 8GB', 'DVT001', 800000.00, 'VND', 123, '0505678901', '2025-04-05', NULL, NULL, 'LVT003\\download (1).jpg'),
('VT004', 'LVT008', 'Nguồn LG PSU 500W', 'DVT001', 1200000.00, 'VND', 6, '0505678901', '2025-04-05', NULL, NULL, 'LVT008\\cu.jpg'),
('VT005', 'LVT006', 'Cảm biến LG Sensor Pro', 'DVT001', 1000000.00, 'VND', 543, '0505678901', '2025-04-05', NULL, NULL, 'LVT006\\download (1).jpg'),
('VT006', 'LVT001', 'Keo dán tản nhiệt', 'DVT001', 50000.00, 'VND', 1, '0505678901', '2025-04-20', NULL, NULL, 'LVT001\\download.jpg'),
('VT007', 'LVT001', 'Keo silicone', 'DVT001', 45000.00, 'VND', 1, '0505678901', '2025-04-20', NULL, NULL, 'LVT001\\download (7).jpg'),
('VT008', 'LVT001', 'Keo AB', 'DVT001', 60000.00, 'VND', 1, '0505678901', '2025-04-20', NULL, NULL, 'LVT001\\VT001.jpg'),
('VT009', 'LVT001', 'Dây điện lõi đồng LG 2.5mm', 'DVT001', 10000.00, 'VND', 1, '0505678901', '2025-04-20', NULL, NULL, 'LVT001\\download (8).jpg'),
('VT010', 'LVT001', 'Dây cáp tín hiệu LG 3m', 'DVT001', 20000.00, 'VND', 1, '0505678901', '2025-04-20', NULL, NULL, 'LVT001\\download21.jpg'),
('VT011', 'LVT001', 'Dây nguồn LG 220V', 'DVT001', 15000.00, 'VND', 1, '0505678901', '2025-04-20', NULL, NULL, 'LVT001\\download (1).jpg'),
('VT012', 'LVT001', 'Ốc vít LG M4x10mm', 'DVT001', 500.00, 'VND', 1, '0505678901', '2025-04-20', NULL, NULL, 'LVT001\\download (4).jpg'),
('VT013', 'LVT001', 'Đinh tán nhôm 3mm', 'DVT001', 700.00, 'VND', 1, '0505678901', '2025-04-20', NULL, NULL, '\r\nLVT001\\download (2).jpg'),
('VT014', 'LVT001', 'Băng dính cách điện 3M', 'DVT001', 8000.00, 'VND', 1, '0505678901', '2025-04-20', NULL, NULL, 'LVT001\\images (3).jpg'),
('VT017', 'LVT002', 'IC nguồn LG 1117-3.3V', 'DVT001', 4000.00, 'VND', 220, '0601234567', '2025-04-20', NULL, NULL, 'LVT002\\download (11).jpg'),
('VT018', 'LVT002', 'IC điều khiển ATmega328P', 'DVT001', 30000.00, 'VND', 1, '0601234567', '2025-04-20', NULL, NULL, 'LVT002\\download (5).jpg'),
('VT019', 'LVT003', 'Điện trở 10KΩ 1/4W', 'DVT001', 100.00, 'VND', 1, '0201234567', '2025-04-20', NULL, NULL, 'LVT003\\images (2).jpg'),
('VT020', 'LVT003', 'Tụ điện gốm 100nF 50V', 'DVT001', 150.00, 'VND', 1, '0201234567', '2025-04-20', NULL, NULL, 'LVT003\\images (3).jpg'),
('VT021', 'LVT003', 'Điện trở 10kΩ', 'DVT001', 100.00, 'VND', 1000, '0601234567', '2025-04-23', NULL, NULL, 'LVT003\\images (1).jpg'),
('VT022', 'LVT003', 'Tụ gốm 10nF', 'DVT001', 200.00, 'VND', 800, '0601234567', '2025-04-23', NULL, NULL, 'LVT003\\download (8).jpg'),
('VT023', 'LVT003', 'Cuộn cảm 33uH', 'DVT001', 1200.00, 'VND', 300, '0601234567', '2025-04-23', NULL, NULL, 'LVT003\\download (3).jpg'),
('VT024', 'LVT005', 'Biến áp xung 12V', 'DVT001', 25000.00, 'VND', 150, '0601234567', '2025-04-23', NULL, NULL, 'LVT005\\download (2).jpg'),
('VT025', 'LVT004', 'OLED Panel 5.5 inch', 'DVT001', 450000.00, 'VND', 120, '0601234567', '2025-04-23', NULL, NULL, 'LVT004\\download (9).jpg'),
('VT026', 'LVT004', 'Còi báo động 12V', 'DVT001', 18000.00, 'VND', 250, '0601234567', '2025-04-23', NULL, NULL, 'LVT004\\download.jpg'),
('VT027', 'LVT004', 'Màn hình cảm ứng 7 inch', 'DVT001', 750000.00, 'VND', 90, '0601234567', '2025-04-23', NULL, NULL, 'LVT004\\download (1).jpg'),
('VT028', 'LVT007', 'Quạt tản nhiệt 12V 80mm', 'DVT001', 30000.00, 'VND', 500, '0601234567', '2025-04-23', NULL, NULL, 'LVT005\\download (1).jpg'),
('VT029', 'LVT005', 'Mainboard điều khiển trung tâm', 'DVT001', 1200000.00, 'VND', 60, '0601234567', '2025-04-23', NULL, NULL, 'LVT005\\download (3).jpg'),
('VT030', 'LVT005', 'PCB mạch nguồn 2 lớp', 'DVT001', 25000.00, 'VND', 300, '0601234567', '2025-04-23', NULL, NULL, 'LVT005\\download (4).jpg'),
('VT031', 'LVT005', 'Module WiFi ESP8266', 'DVT001', 45000.00, 'VND', 200, '0601234567', '2025-04-23', NULL, NULL, 'LVT005\\download (5).jpg'),
('VT032', 'LVT006', 'Cụm cảm biến ánh sáng và cử động', 'DVT001', 110000.00, 'VND', 150, '0601234567', '2025-04-23', NULL, NULL, 'LVT005\\download (6).jpg'),
('VT033', 'LVT006', 'Cảm biến nhiệt độ & độ ẩm DHT22', 'DVT001', 40000.00, 'VND', 300, '0601234567', '2025-04-23', NULL, NULL, 'LVT006\\download (7).jpg'),
('VT034', 'LVT006', 'Cảm biến tiệm cận điện dung LJC18A3-H-Z/BX', 'DVT001', 50000.00, 'VND', 180, '0601234567', '2025-04-23', NULL, NULL, 'LVT006\\download.jpg'),
('VT035', 'LVT006', 'Cảm biến áp suất BMP280', 'DVT001', 65000.00, 'VND', 200, '0601234567', '2025-04-23', NULL, NULL, 'LVT006\\download (2).jpg'),
('VT036', 'LVT006', 'Thiết bị đo dòng & áp ACS712 30A', 'DVT001', 55000.00, 'VND', 220, '0601234567', '2025-04-23', NULL, NULL, 'LVT006\\download (3).jpg'),
('VT037', 'LVT007', 'Relay 5V 10A SPDT', 'DVT001', 15000.00, 'VND', 500, '0601234567', '2025-04-23', NULL, NULL, 'LVT007\\download (3).jpg'),
('VT038', 'LVT007', 'Động cơ servo SG90 9g', 'DVT001', 45000.00, 'VND', 300, '0601234567', '2025-04-23', NULL, NULL, 'LVT007\\download.jpg'),
('VT039', 'LVT007', 'Bộ truyền động tuyến tính mini 12V', 'DVT001', 180000.00, 'VND', 100, '0601234567', '2025-04-23', NULL, NULL, 'LVT007\\download (1).jpg'),
('VT040', 'LVT007', 'Công tắc nhấn tắt/mở 2 chân', 'DVT001', 5000.00, 'VND', 1000, '0601234567', '2025-04-23', NULL, NULL, 'LVT007\\download (2).jpg'),
('VT041', 'LVT008', 'Adapter 12V 2A', 'DVT001', 55000.00, 'VND', 300, '0601234567', '2025-04-23', NULL, NULL, 'LVT008\\download (4).jpg'),
('VT042', 'LVT008', 'Module nguồn LM2596 DC-DC Buck', 'DVT001', 20000.00, 'VND', 500, '0601234567', '2025-04-23', NULL, NULL, 'LVT008\\download.jpg'),
('VT043', 'LVT008', 'Bộ chuyển đổi DC-AC mini inverter 150W', 'DVT001', 120000.00, 'VND', 150, '0601234567', '2025-04-23', NULL, NULL, 'LVT008\\download (1).jpg');

--
-- Đang đổ dữ liệu cho bảng `xuatkho`
--

INSERT INTO `xuatkho` (`MaPhieuXuat`, `MaKho`, `MaLenhDieuDong`, `MaDonViVanChuyen`, `DiaDiemXuat`, `DonViTienTe`, `TrangThai`, `ChiTietXuatKho`, `created_at`, `updated_at`) VALUES
('534', 'KHO003', 'LD001', 'DVC002', 'dcsewe', 'vnd', 'Đã duyệt', '[{\"MaVatTu\":\"VT002\",\"TenVatTu\":\"Bo m\\u1ea1ch ch\\u1ee7 LG Main X1\",\"DonViTinh\":\"C\\u00e1i\",\"DonGia\":\"1500000.00\",\"SoLuongXuat\":10,\"ThanhTien\":15000000,\"SoLuong\":\"1\"}]', NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
