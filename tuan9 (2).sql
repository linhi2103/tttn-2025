-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 20, 2025 lúc 11:33 AM
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
-- Đang đổ dữ liệu cho bảng `danhmuckho`
--

INSERT INTO `danhmuckho` (`MaKho`, `TenKho`, `DiaChi`, `QuyMo`, `DienTichSuDung`) VALUES
('KHO001', 'Kho A', 'Số 1, Đường ABC, TP. HCM', 1000, 750),
('KHO002', 'Kho B', 'Số 2, Đường XYZ, TP. Hà Nội', 1500, 500),
('KHO003', 'Kho C', 'Số 3, Đường DEF, TP. Đà Nẵng', 2000, 1000),
('KHO004', 'Kho D', 'Số 4, Đường GHI, TP. Cần Thơ', 1200, 0),
('KHO005', 'Kho E', 'Số 43, Đường ABC, TP. HCM', 320, 120);

--
-- Đang đổ dữ liệu cho bảng `doitac`
--

INSERT INTO `doitac` (`MaSoThue_DoiTac`, `TenDoiTac`, `Email`, `Sdt`, `DiaChi`) VALUES
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

INSERT INTO `donvivanchuyen` (`MaDonViVanChuyen`, `TenDonViVanChuyen`, `MaNhanVien`, `PhuongTienVanChuyen`, `GhiChu`) VALUES
('DVC001', 'Đơn Vị Vận Chuyển 1', 'NV002', 'Xe tải', 'Ghi chú đơn vị 1'),
('DVC002', 'Đơn Vị Vận Chuyển 2', 'NV002', 'Xe container', 'Ghi chú đơn vị 2'),
('DVC003', 'Đơn Vị Vận Chuyển 3', 'NV003', 'Xe máy', 'Ghi chú đơn vị 3');

--
-- Đang đổ dữ liệu cho bảng `lenhdieudong`
--

INSERT INTO `lenhdieudong` (`MaLenhDieuDong`, `TenLenhDieuDong`, `LyDo`, `MaNhanVien`, `NgayLapDon`, `trangthai`, `GhiChu`) VALUES
('LD001', 'Lệnh điều động 1', 'Vận chuyển hàng hóa từ kho A đến kho B', 'NV001', '2025-04-05', '', 'nhy'),
('LD002', 'Lệnh điều động 2', 'Chuyển hàng từ kho C đến kho D', 'NV002', '2025-04-05', 'Đã duyệt', 'Ghi chú về lệnh điều động 2'),
('LD003', 'Lệnh điều động 3', 'Vận chuyển sản phẩm từ kho A đến kho C', 'NV003', '2025-04-05', 'Đang vận chuyển', 'Ghi chú về lệnh điều động 3');

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
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2025_04_02_110342_create_parent_table', 1),
(2, '2025_04_02_112343_create_staff_table', 1),
(3, '2025_04_02_113047_create_user_table', 1),
(4, '2025_04_02_114000_create_supplier_table', 1),
(5, '2025_04_02_114001_create_supplies_table', 1),
(6, '2025_04_02_114002_create_transport_commands_table', 1),
(7, '2025_04_02_114003_create_child_table', 1);

--
-- Đang đổ dữ liệu cho bảng `nguoidung`
--

INSERT INTO `nguoidung` (`taikhoan`, `MatKhau`, `Email`, `manhanvien`) VALUES
('admin01', '$2y$10$e0MYzXyjpJS7Pd0RVvHwHeFx4Ex4e0GeqZoTRpBqTfP4yx.mxy5eW', 'admin01@lg.com', 'NV001'),
('nhansu1', '$2y$10$e0MYzXyjpJS7Pd0RVvHwHeFx4Ex4e0GeqZoTRpBqTfP4yx.mxy5eW', 'nhansu01@lg.com', 'NV003'),
('quanlykho1', '$2y$10$e0MYzXyjpJS7Pd0RVvHwHeFx4Ex4e0GeqZoTRpBqTfP4yx.mxy5eW', 'kho01@lg.com', 'NV002');

--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`MaNhanVien`, `TenNhanVien`, `DiaChi`, `GioiTinh`, `Sdt`, `Cccd`, `MaPhongBan`, `MaVaiTro`) VALUES
('NV001', 'Nguyễn Văn A', '123 Đường ABC, Hà Nội', 'Nam', 1234567890, 123456789012, 'PB001', 1),
('NV002', 'Trần Thị B', '456 Đường XYZ, Hà Nội', 'Nữ', 2345678901, 234567890123, 'PB002', 0),
('NV003', 'Lê Minh C', '789 Đường LMN, Hà Nội', 'Nam', 3456789012, 345678901234, 'PB001', 0),
('NV004', 'Phạm Văn An', 'Đông Hưng, Thái Bình', 'Nam', 9650456310, 321353567632, 'PB005', 1);

--
-- Đang đổ dữ liệu cho bảng `phongban`
--

INSERT INTO `phongban` (`MaPhongBan`, `TenPhongBan`) VALUES
('PB001', 'Nhân Sự '),
('PB002', 'Vận Chuyển'),
('PB003', 'phòng ban kế toán'),
('PB004', 'bảo hành -  kiểm định'),
('PB005', 'Cán bộ Kho');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('4yza2yLtlHJeCwPH2tOCvIPQnWiEkIYlnht0X40Z', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoickFwbkN5VVVHcUJRaURPaU04TEZTbXdIV3JEbUhmNVoyZlFIRkJxcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQ/cGFnZT0yIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1745141580);

--
-- Đang đổ dữ liệu cho bảng `vaitro`
--

INSERT INTO `vaitro` (`MaVaiTro`, `TenVaiTro`) VALUES
(0, 'user1'),
(1, 'admin'),
(2, 'user2');

--
-- Đang đổ dữ liệu cho bảng `vattu`
--

INSERT INTO `vattu` (`MaVatTu`, `MaLoaiVatTu`, `TenVatTu`, `MaDonViTinh`, `GiaNhap`, `GiaXuat`, `DonViTienTe`, `SoLuongTon`, `MaSoThue_DoiTac`, `NgayNhap`, `HanSuDung`, `GhiChu`, `AnhVatTu`, `TinhTrang`) VALUES
('VT001', 'LVT002', 'Chip xử lý LG Alpha', 'DVT001', 3000000.00, 3500000.00, 'VND', 8, '0505678901', '2025-04-05', NULL, NULL, 'LVT002\\download (1).jpg', 'Còn hàng'),
('VT002', 'LVT005', 'Bo mạch chủ LG Main X1', 'DVT001', 1500000.00, 1900000.00, 'VND', 10, '0505678901', '2025-04-05', NULL, NULL, 'LVT005\\download.jpg', 'Còn hàng'),
('VT003', 'LVT003', 'RAM LG DDR4 8GB', 'DVT001', 800000.00, 1000000.00, 'VND', 15, '0505678901', '2025-04-05', NULL, NULL, 'LVT003\\download (1).jpg', 'Còn hàng'),
('VT004', 'LVT008', 'Nguồn LG PSU 500W', 'DVT001', 1200000.00, 1500000.00, 'VND', 6, '0505678901', '2025-04-05', NULL, NULL, 'LVT008\\cu.jpg', 'Còn hàng'),
('VT005', 'LVT006', 'Cảm biến LG Sensor Pro', 'DVT001', 1000000.00, 1300000.00, 'VND', 5, '0505678901', '2025-04-05', NULL, NULL, 'LVT006\\download (1).jpg', 'Sắp hết'),
('VT006', 'LVT001', 'Keo dán tản nhiệt', 'DVT001', 50000.00, 70000.00, 'VND', 1, '0505678901', '2025-04-20', NULL, NULL, 'LVT001\\download.jpg', 'Còn hàng'),
('VT007', 'LVT001', 'Keo silicone', 'DVT001', 45000.00, 60000.00, 'VND', 1, '0505678901', '2025-04-20', NULL, NULL, 'LVT001\\download (7).jpg', 'Còn hàng'),
('VT008', 'LVT001', 'Keo AB', 'DVT001', 60000.00, 80000.00, 'VND', 1, '0505678901', '2025-04-20', NULL, NULL, 'LVT001\\VT001.jpg', 'Còn hàng'),
('VT009', 'LVT001', 'Dây điện lõi đồng LG 2.5mm', 'DVT001', 10000.00, 15000.00, 'VND', 1, '0505678901', '2025-04-20', NULL, NULL, 'LVT001\\download (8).jpg', 'Còn hàng'),
('VT010', 'LVT001', 'Dây cáp tín hiệu LG 3m', 'DVT001', 20000.00, 25000.00, 'VND', 1, '0505678901', '2025-04-20', NULL, NULL, 'LVT001\\download21.jpg', 'Còn hàng'),
('VT011', 'LVT001', 'Dây nguồn LG 220V', 'DVT001', 15000.00, 20000.00, 'VND', 1, '0505678901', '2025-04-20', NULL, NULL, 'LVT001\\download (1).jpg', 'Còn hàng'),
('VT012', 'LVT001', 'Ốc vít LG M4x10mm', 'DVT001', 500.00, 800.00, 'VND', 1, '0505678901', '2025-04-20', NULL, NULL, 'LVT001\\download (4).jpg', 'Còn hàng'),
('VT013', 'LVT001', 'Đinh tán nhôm 3mm', 'DVT001', 700.00, 1000.00, 'VND', 1, '0505678901', '2025-04-20', NULL, NULL, '\r\nLVT001\\download (2).jpg', 'Còn hàng'),
('VT014', 'LVT001', 'Băng dính cách điện 3M', 'DVT001', 8000.00, 10000.00, 'VND', 1, '0505678901', '2025-04-20', NULL, NULL, 'LVT001\\images (3).jpg', 'Còn hàng'),
('VT017', 'LVT002', 'IC nguồn LG 1117-3.3V', 'DVT001', 4000.00, 6000.00, 'VND', 1, '0601234567', '2025-04-20', NULL, NULL, 'LVT002\\download (11).jpg', 'Còn hàng'),
('VT018', 'LVT002', 'IC điều khiển ATmega328P', 'DVT001', 30000.00, 35000.00, 'VND', 1, '0601234567', '2025-04-20', NULL, NULL, 'LVT002\\download (5).jpg', 'Còn hàng'),
('VT019', 'LVT003', 'Điện trở 10KΩ 1/4W', 'DVT001', 100.00, 200.00, 'VND', 1, '0201234567', '2025-04-20', NULL, NULL, 'LVT003\\images (2).jpg', 'Còn hàng'),
('VT020', 'LVT003', 'Tụ điện gốm 100nF 50V', 'DVT001', 150.00, 250.00, 'VND', 1, '0201234567', '2025-04-20', NULL, NULL, 'LVT003\\images (3).jpg', 'Còn hàng');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
