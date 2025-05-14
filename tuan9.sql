-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 14, 2025 lúc 08:09 AM
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

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhmuckho`
--

CREATE TABLE `danhmuckho` (
  `MaKho` varchar(10) NOT NULL,
  `TenKho` varchar(255) NOT NULL,
  `DiaChi` text NOT NULL,
  `QuyMo` int(11) NOT NULL,
  `DienTichSuDung` int(11) NOT NULL DEFAULT 0,
  `TinhTrang` varchar(50) GENERATED ALWAYS AS (case when `DienTichSuDung` = 0 then 'Còn trống' when `DienTichSuDung` < `QuyMo` then 'Sắp đầy' else 'Đã đầy' end) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `danhmuckho`
--

INSERT INTO `danhmuckho` (`MaKho`, `TenKho`, `DiaChi`, `QuyMo`, `DienTichSuDung`) VALUES
('KHO001', 'Kho A', 'Số 1, Đường ABC, TP. HCM', 1000, 750),
('KHO002', 'Kho B', 'Số 2, Đường XYZ, TP. Hải Phòng', 1500, 500),
('KHO003', 'Kho C', 'Số 3, Đường DEF, TP. Đà Nẵng', 2000, 1000),
('KHO004', 'Kho D', 'Số 4, Đường GHI, TP. Cần Thơ', 1200, 0),
('KHO005', 'Kho E', 'Số 43, Đường ABC, TP. HCM', 320, 120);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `doitac`
--

CREATE TABLE `doitac` (
  `MaSoThue_DoiTac` varchar(20) NOT NULL,
  `TenDoiTac` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `SDT` varchar(10) NOT NULL,
  `DiaChi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donvitinh`
--

CREATE TABLE `donvitinh` (
  `MaDonViTinh` varchar(20) NOT NULL,
  `TenDonViTinh` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donvivanchuyen`
--

CREATE TABLE `donvivanchuyen` (
  `MaDonViVanChuyen` varchar(20) NOT NULL,
  `TenDonViVanChuyen` varchar(255) NOT NULL,
  `MaNhanVien` varchar(20) NOT NULL,
  `PhuongTienVanChuyen` varchar(255) NOT NULL,
  `GhiChu` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `donvivanchuyen`
--

INSERT INTO `donvivanchuyen` (`MaDonViVanChuyen`, `TenDonViVanChuyen`, `MaNhanVien`, `PhuongTienVanChuyen`, `GhiChu`) VALUES
('DVC001', 'Đơn Vị Vận Chuyển 1', 'NV002', 'Xe tải', 'Ghi chú đơn vị 1'),
('DVC002', 'Đơn Vị Vận Chuyển 2', 'NV002', 'Xe container', 'Ghi chú đơn vị 2'),
('DVC003', 'Đơn Vị Vận Chuyển 3', 'NV003', 'Xe máy', 'Ghi chú đơn vị 3');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lenhdieudong`
--

CREATE TABLE `lenhdieudong` (
  `MaLenhDieuDong` varchar(20) NOT NULL,
  `TenLenhDieuDong` varchar(255) NOT NULL,
  `LyDo` text NOT NULL,
  `MaNhanVien` varchar(20) NOT NULL,
  `NgayLapDon` date NOT NULL DEFAULT current_timestamp(),
  `TrangThai` enum('Chờ duyệt','Đã duyệt','Đang vận chuyển','Hoàn thành','Hủy') NOT NULL DEFAULT 'Chờ duyệt',
  `GhiChu` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lenhdieudong`
--

INSERT INTO `lenhdieudong` (`MaLenhDieuDong`, `TenLenhDieuDong`, `LyDo`, `MaNhanVien`, `NgayLapDon`, `TrangThai`, `GhiChu`) VALUES
('LD001', 'Lệnh điều động 1', 'Vận chuyển hàng hóa từ kho A đến kho B', 'NV001', '2025-04-05', '', 'nhy'),
('LD002', 'Lệnh điều động 2', 'Chuyển hàng từ kho C đến kho D', 'NV002', '2025-04-05', 'Đã duyệt', 'Ghi chú về lệnh điều động 2'),
('LD003', 'Lệnh điều động 3', 'Vận chuyển sản phẩm từ kho A đến kho C', 'NV003', '2025-04-05', 'Đang vận chuyển', 'Ghi chú về lệnh điều động 3');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaivattu`
--

CREATE TABLE `loaivattu` (
  `MaLoaiVatTu` varchar(20) NOT NULL,
  `TenLoaiVatTu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nguoidung`
--

CREATE TABLE `nguoidung` (
  `TaiKhoan` varchar(20) NOT NULL,
  `MatKhau` varchar(255) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `manhanvien` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nguoidung`
--

INSERT INTO `nguoidung` (`TaiKhoan`, `MatKhau`, `Email`, `manhanvien`) VALUES
('admin01', '$2y$10$e0MYzXyjpJS7Pd0RVvHwHeFx4Ex4e0GeqZoTRpBqTfP4yx.mxy5eW', 'admin01@lg.com', 'NV001'),
('nhansu1', '$2y$10$e0MYzXyjpJS7Pd0RVvHwHeFx4Ex4e0GeqZoTRpBqTfP4yx.mxy5eW', 'nhansu01@lg.com', 'NV003'),
('quanlykho1', '$2y$10$e0MYzXyjpJS7Pd0RVvHwHeFx4Ex4e0GeqZoTRpBqTfP4yx.mxy5eW', 'kho01@lg.com', 'NV002');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `MaNhanVien` varchar(20) NOT NULL,
  `TenNhanVien` varchar(255) NOT NULL,
  `DiaChi` varchar(255) NOT NULL,
  `GioiTinh` enum('Nam','Nữ') NOT NULL,
  `SDT` bigint(20) NOT NULL,
  `CCCD` bigint(20) NOT NULL,
  `MaPhongBan` varchar(20) NOT NULL,
  `MaVaiTro` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`MaNhanVien`, `TenNhanVien`, `DiaChi`, `GioiTinh`, `SDT`, `CCCD`, `MaPhongBan`, `MaVaiTro`) VALUES
('NV001', 'Nguyễn Văn AN', '123 Đường ABC, Hà Nội', 'Nam', 9750521874, 34300307412, 'PB001', 1),
('NV002', 'Trần Thị B', '456 Đường XYZ, Hà Nội', 'Nữ', 2345678901, 234567890123, 'PB002', 0),
('NV003', 'Lê Minh C', '789 Đường LMN, Hà Nội', 'Nam', 3456789012, 345678901234, 'PB001', 0),
('NV004', 'Phạm Văn An', 'Đông Hưng, Thái Bình', 'Nam', 9650456310, 321353567632, 'PB005', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhapkho`
--

CREATE TABLE `nhapkho` (
  `MaPhieuNhap` varchar(20) NOT NULL,
  `MaKho` varchar(10) NOT NULL,
  `DiaChi` text DEFAULT NULL,
  `MaVatTu` varchar(20) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `DonGia` decimal(18,2) NOT NULL,
  `NgayNhap` date NOT NULL DEFAULT current_timestamp(),
  `MaSoThue_DoiTac` varchar(20) NOT NULL,
  `MaNhanVien` varchar(20) NOT NULL,
  `MaLenhDieuDong` varchar(20) DEFAULT NULL,
  `MaDonViVanChuyen` varchar(20) DEFAULT NULL,
  `GhiChu` text DEFAULT NULL,
  `ThanhTien` decimal(18,2) GENERATED ALWAYS AS (`SoLuong` * `DonGia`) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhapkho`
--

INSERT INTO `nhapkho` (`MaPhieuNhap`, `MaKho`, `DiaChi`, `MaVatTu`, `SoLuong`, `DonGia`, `NgayNhap`, `MaSoThue_DoiTac`, `MaNhanVien`, `MaLenhDieuDong`, `MaDonViVanChuyen`, `GhiChu`) VALUES
('PN001', 'KHO001', 'HP', 'VT003', 8, 800000.00, '2025-05-10', '0201234567', 'NV001', 'LD001', 'DVC001', ''),
('PN002', 'KHO002', 'Số 2, Đường XYZ, TP. Hà Nội', 'VT002', 50, 30000.00, '2025-04-21', '0201234567', 'NV002', 'LD002', 'DVC002', 'Phiếu nhập đợt 2'),
('PN003', 'KHO003', 'Số 3, Đường DEF, TP. Đà Nẵng', 'VT003', 200, 10000.00, '2025-04-22', '0201234567', 'NV003', 'LD003', 'DVC003', 'Phiếu nhập hàng tồn kho'),
('PN004', 'KHO003', 'HP NA', 'VT001', 20, 3000000.00, '2025-05-12', '0201234567', 'NV002', 'LD003', 'DVC001', 'KO');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phieukiemke`
--

CREATE TABLE `phieukiemke` (
  `MaPhieuKiemKe` varchar(20) NOT NULL,
  `MaKho` varchar(10) NOT NULL,
  `NgayKiemKe` date NOT NULL,
  `MaNhanVien` varchar(20) NOT NULL,
  `TrangThai` enum('Chờ Duyệt','Đã Kiểm Kê','Đã Hủy') NOT NULL DEFAULT 'Chờ Duyệt',
  `MaVatTu` varchar(20) NOT NULL,
  `SoLuongThucTe` int(11) NOT NULL,
  `SoLuongTon` int(11) NOT NULL,
  `TinhTrang` enum('Còn tốt 100%','Kém chất lượng','Hỏng','Hết','Thất Lạc') NOT NULL,
  `MaLenhDieuDong` varchar(20) DEFAULT NULL,
  `GhiChu` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `phieukiemke`
--

INSERT INTO `phieukiemke` (`MaPhieuKiemKe`, `MaKho`, `NgayKiemKe`, `MaNhanVien`, `TrangThai`, `MaVatTu`, `SoLuongThucTe`, `SoLuongTon`, `TinhTrang`, `MaLenhDieuDong`, `GhiChu`) VALUES
('PKK001', 'KHO001', '2025-05-14', 'NV001', 'Đã Hủy', 'VT001', 10, 100, 'Còn tốt 100%', 'LD001', 'Kiểm kê định kỳ quý 1'),
('PKK002', 'KHO002', '2025-05-14', 'NV002', 'Chờ Duyệt', 'VT002', 45, 50, 'Kém chất lượng', 'LD003', 'Sai lệch do bảo quản'),
('PKK003', 'KHO003', '2025-05-08', 'NV003', 'Đã Kiểm Kê', 'VT003', 22, 35, 'Còn tốt 100%', 'LD002', 'Mất mát trong quá trình vận chuyển');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phongban`
--

CREATE TABLE `phongban` (
  `MaPhongBan` varchar(20) NOT NULL,
  `TenPhongBan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
('IfnhU9CQ4ukbVBw3LH2oy1xKoUPXMPr27CSOnaCC', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTzZveUtpTEdyWDlsc2xpRkhlYkx0UGI2bUNsem84aXhuUndFUVhYdyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC92YXR0dS9WVDAwOCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1747202774);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thanhlykho`
--

CREATE TABLE `thanhlykho` (
  `MaPhieuThanhLy` varchar(20) NOT NULL,
  `MaKho` varchar(10) NOT NULL,
  `NgayLap` date NOT NULL,
  `MaNhanVien` varchar(20) NOT NULL,
  `TrangThai` enum('Đã hủy','Chờ duyệt','Đã thanh lý') NOT NULL,
  `LyDoThanhLy` text DEFAULT NULL,
  `MaVatTu` varchar(20) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `DonGia` decimal(18,2) NOT NULL,
  `BienPhapThanhLy` enum('Bán thanh lý','Chuyển đổi sử dụng','Tiêu hủy') NOT NULL DEFAULT 'Bán thanh lý',
  `MaLenhDieuDong` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `thanhlykho`
--

INSERT INTO `thanhlykho` (`MaPhieuThanhLy`, `MaKho`, `NgayLap`, `MaNhanVien`, `TrangThai`, `LyDoThanhLy`, `MaVatTu`, `SoLuong`, `DonGia`, `BienPhapThanhLy`, `MaLenhDieuDong`) VALUES
('PTL001', 'KHO001', '2025-05-01', 'NV001', 'Đã thanh lý', 'Hư hỏng do sử dụng lâu ngày', 'VT001', 10, 50000.00, 'Tiêu hủy', 'LD001'),
('PTL002', 'KHO002', '2025-05-02', 'NV002', 'Chờ duyệt', 'Không còn sử dụng trong sản xuất', 'VT002', 3, 70000.00, 'Chuyển đổi sử dụng', 'LD002'),
('PTL004', 'KHO001', '2025-05-04', 'NV004', 'Đã hủy', 'Lỗi đề xuất không chính xác', 'VT004', 8, 45000.00, 'Tiêu hủy', 'LD003'),
('TL003', 'KHO003', '2025-05-03', 'NV003', 'Đã thanh lý', 'Thanh lý định kỳ quý 1', 'VT003', 5, 150000.00, 'Bán thanh lý', 'LD003');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vaitro`
--

CREATE TABLE `vaitro` (
  `MaVaiTro` int(10) UNSIGNED NOT NULL,
  `TenVaiTro` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `vaitro`
--

INSERT INTO `vaitro` (`MaVaiTro`, `TenVaiTro`) VALUES
(0, 'user1'),
(1, 'admin'),
(2, 'user2');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vattu`
--

CREATE TABLE `vattu` (
  `MaVatTu` varchar(20) NOT NULL,
  `MaLoaiVatTu` varchar(20) NOT NULL,
  `TenVatTu` varchar(255) NOT NULL,
  `MaDonViTinh` varchar(20) NOT NULL,
  `GiaNhap` decimal(18,2) NOT NULL,
  `DonViTienTe` varchar(10) NOT NULL,
  `SoLuongTon` int(11) NOT NULL DEFAULT 0,
  `MaSoThue_DoiTac` varchar(20) NOT NULL,
  `NgayNhap` date NOT NULL,
  `HanSuDung` date DEFAULT NULL,
  `GhiChu` text DEFAULT NULL,
  `AnhVatTu` varchar(255) DEFAULT NULL,
  `TinhTrang` enum('Còn hàng','Hết hàng','Sắp hết') NOT NULL DEFAULT 'Còn hàng'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `vattu`
--

INSERT INTO `vattu` (`MaVatTu`, `MaLoaiVatTu`, `TenVatTu`, `MaDonViTinh`, `GiaNhap`, `DonViTienTe`, `SoLuongTon`, `MaSoThue_DoiTac`, `NgayNhap`, `HanSuDung`, `GhiChu`, `AnhVatTu`, `TinhTrang`) VALUES
('VT001', 'LVT002', 'Chip xử lý LG Alpha', 'DVT001', 3000000.00, 'VND', 2, '0505678901', '2025-04-05', '2025-05-02', 'nhy21', 'LVT002\\download (1).jpg', 'Còn hàng'),
('VT002', 'LVT005', 'Bo mạch chủ LG Main X1', 'DVT001', 1500000.00, 'VND', 22, '0505678901', '2025-04-05', '2025-05-17', 'NHYYY', 'LVT005\\download.jpg', 'Còn hàng'),
('VT003', 'LVT003', 'RAM LG DDR4 8GB', 'DVT001', 800000.00, 'VND', 1, '0505678901', '2025-04-05', NULL, NULL, 'LVT003\\download (1).jpg', 'Còn hàng'),
('VT004', 'LVT008', 'Nguồn LG PSU 500W', 'DVT001', 1200000.00, 'VND', 6, '0505678901', '2025-04-05', NULL, NULL, 'LVT008\\cu.jpg', 'Còn hàng'),
('VT005', 'LVT006', 'Cảm biến LG Sensor Pro', 'DVT001', 1000000.00, 'VND', 5, '0505678901', '2025-04-05', NULL, NULL, 'LVT006\\download (1).jpg', 'Sắp hết'),
('VT006', 'LVT001', 'Keo dán tản nhiệt', 'DVT001', 50000.00, 'VND', 1, '0505678901', '2025-04-20', NULL, NULL, 'LVT001\\download.jpg', 'Còn hàng'),
('VT007', 'LVT001', 'Keo silicone', 'DVT001', 45000.00, 'VND', 1, '0505678901', '2025-04-20', NULL, NULL, 'LVT001\\download (7).jpg', 'Còn hàng'),
('VT008', 'LVT001', 'Keo AB', 'DVT001', 60000.00, 'VND', 1, '0505678901', '2025-04-20', NULL, NULL, 'LVT001\\VT001.jpg', 'Còn hàng'),
('VT009', 'LVT001', 'Dây điện lõi đồng LG 2.5mm', 'DVT001', 10000.00, 'VND', 1, '0505678901', '2025-04-20', NULL, NULL, 'LVT001\\download (8).jpg', 'Còn hàng'),
('VT010', 'LVT001', 'Dây cáp tín hiệu LG 3m', 'DVT001', 20000.00, 'VND', 1, '0505678901', '2025-04-20', NULL, NULL, 'LVT001\\download21.jpg', 'Còn hàng'),
('VT011', 'LVT001', 'Dây nguồn LG 220V', 'DVT001', 15000.00, 'VND', 1, '0505678901', '2025-04-20', NULL, NULL, 'LVT001\\download (1).jpg', 'Còn hàng'),
('VT012', 'LVT001', 'Ốc vít LG M4x10mm', 'DVT001', 500.00, 'VND', 1, '0505678901', '2025-04-20', NULL, NULL, 'LVT001\\download (4).jpg', 'Còn hàng'),
('VT013', 'LVT001', 'Đinh tán nhôm 3mm', 'DVT001', 700.00, 'VND', 1, '0505678901', '2025-04-20', NULL, NULL, '\r\nLVT001\\download (2).jpg', 'Còn hàng'),
('VT014', 'LVT001', 'Băng dính cách điện 3M', 'DVT001', 8000.00, 'VND', 1, '0505678901', '2025-04-20', NULL, NULL, 'LVT001\\images (3).jpg', 'Còn hàng'),
('VT017', 'LVT002', 'IC nguồn LG 1117-3.3V', 'DVT001', 4000.00, 'VND', 1, '0601234567', '2025-04-20', NULL, NULL, 'LVT002\\download (11).jpg', 'Còn hàng'),
('VT018', 'LVT002', 'IC điều khiển ATmega328P', 'DVT001', 30000.00, 'VND', 1, '0601234567', '2025-04-20', NULL, NULL, 'LVT002\\download (5).jpg', 'Còn hàng'),
('VT019', 'LVT003', 'Điện trở 10KΩ 1/4W', 'DVT001', 100.00, 'VND', 1, '0201234567', '2025-04-20', NULL, NULL, 'LVT003\\images (2).jpg', 'Còn hàng'),
('VT020', 'LVT003', 'Tụ điện gốm 100nF 50V', 'DVT001', 150.00, 'VND', 1, '0201234567', '2025-04-20', NULL, NULL, 'LVT003\\images (3).jpg', 'Còn hàng'),
('VT021', 'LVT003', 'Điện trở 10kΩ', 'DVT001', 100.00, 'VND', 1000, '0601234567', '2025-04-23', NULL, NULL, 'LVT003\\images (1).jpg', 'Còn hàng'),
('VT022', 'LVT003', 'Tụ gốm 10nF', 'DVT001', 200.00, 'VND', 800, '0601234567', '2025-04-23', NULL, NULL, 'LVT003\\download (8).jpg', 'Còn hàng'),
('VT023', 'LVT003', 'Cuộn cảm 33uH', 'DVT001', 1200.00, 'VND', 300, '0601234567', '2025-04-23', NULL, NULL, 'LVT003\\download (3).jpg', 'Còn hàng'),
('VT024', 'LVT005', 'Biến áp xung 12V', 'DVT001', 25000.00, 'VND', 150, '0601234567', '2025-04-23', NULL, NULL, 'LVT005\\download (2).jpg', 'Còn hàng'),
('VT025', 'LVT004', 'OLED Panel 5.5 inch', 'DVT001', 450000.00, 'VND', 120, '0601234567', '2025-04-23', NULL, NULL, 'LVT004\\download (9).jpg', 'Còn hàng'),
('VT026', 'LVT004', 'Còi báo động 12V', 'DVT001', 18000.00, 'VND', 250, '0601234567', '2025-04-23', NULL, NULL, 'LVT004\\download.jpg', 'Còn hàng'),
('VT027', 'LVT004', 'Màn hình cảm ứng 7 inch', 'DVT001', 750000.00, 'VND', 90, '0601234567', '2025-04-23', NULL, NULL, 'LVT004\\download (1).jpg', 'Còn hàng'),
('VT028', 'LVT007', 'Quạt tản nhiệt 12V 80mm', 'DVT001', 30000.00, 'VND', 500, '0601234567', '2025-04-23', NULL, NULL, 'LVT005\\download (1).jpg', 'Còn hàng'),
('VT029', 'LVT005', 'Mainboard điều khiển trung tâm', 'DVT001', 1200000.00, 'VND', 60, '0601234567', '2025-04-23', NULL, NULL, 'LVT005\\download (3).jpg', 'Còn hàng'),
('VT030', 'LVT005', 'PCB mạch nguồn 2 lớp', 'DVT001', 25000.00, 'VND', 300, '0601234567', '2025-04-23', NULL, NULL, 'LVT005\\download (4).jpg', 'Còn hàng'),
('VT031', 'LVT005', 'Module WiFi ESP8266', 'DVT001', 45000.00, 'VND', 200, '0601234567', '2025-04-23', NULL, NULL, 'LVT005\\download (5).jpg', 'Còn hàng'),
('VT032', 'LVT006', 'Cụm cảm biến ánh sáng và cử động', 'DVT001', 110000.00, 'VND', 150, '0601234567', '2025-04-23', NULL, NULL, 'LVT005\\download (6).jpg', 'Còn hàng'),
('VT033', 'LVT006', 'Cảm biến nhiệt độ & độ ẩm DHT22', 'DVT001', 40000.00, 'VND', 300, '0601234567', '2025-04-23', NULL, NULL, 'LVT006\\download (7).jpg', 'Còn hàng'),
('VT034', 'LVT006', 'Cảm biến tiệm cận điện dung LJC18A3-H-Z/BX', 'DVT001', 50000.00, 'VND', 180, '0601234567', '2025-04-23', NULL, NULL, 'LVT006\\download.jpg', 'Còn hàng'),
('VT035', 'LVT006', 'Cảm biến áp suất BMP280', 'DVT001', 65000.00, 'VND', 200, '0601234567', '2025-04-23', NULL, NULL, 'LVT006\\download (2).jpg', 'Còn hàng'),
('VT036', 'LVT006', 'Thiết bị đo dòng & áp ACS712 30A', 'DVT001', 55000.00, 'VND', 220, '0601234567', '2025-04-23', NULL, NULL, 'LVT006\\download (3).jpg', 'Còn hàng'),
('VT037', 'LVT007', 'Relay 5V 10A SPDT', 'DVT001', 15000.00, 'VND', 500, '0601234567', '2025-04-23', NULL, NULL, 'LVT007\\download (3).jpg', 'Còn hàng'),
('VT038', 'LVT007', 'Động cơ servo SG90 9g', 'DVT001', 45000.00, 'VND', 300, '0601234567', '2025-04-23', NULL, NULL, 'LVT007\\download.jpg', 'Còn hàng'),
('VT039', 'LVT007', 'Bộ truyền động tuyến tính mini 12V', 'DVT001', 180000.00, 'VND', 100, '0601234567', '2025-04-23', NULL, NULL, 'LVT007\\download (1).jpg', 'Còn hàng'),
('VT040', 'LVT007', 'Công tắc nhấn tắt/mở 2 chân', 'DVT001', 5000.00, 'VND', 1000, '0601234567', '2025-04-23', NULL, NULL, 'LVT007\\download (2).jpg', 'Còn hàng'),
('VT041', 'LVT008', 'Adapter 12V 2A', 'DVT001', 55000.00, 'VND', 300, '0601234567', '2025-04-23', NULL, NULL, 'LVT008\\download (4).jpg', 'Còn hàng'),
('VT042', 'LVT008', 'Module nguồn LM2596 DC-DC Buck', 'DVT001', 20000.00, 'VND', 500, '0601234567', '2025-04-23', NULL, NULL, 'LVT008\\download.jpg', 'Còn hàng'),
('VT043', 'LVT008', 'Bộ chuyển đổi DC-AC mini inverter 150W', 'DVT001', 120000.00, 'VND', 150, '0601234567', '2025-04-23', NULL, NULL, 'LVT008\\download (1).jpg', 'Còn hàng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `xuatkho`
--

CREATE TABLE `xuatkho` (
  `MaPhieuXuat` varchar(20) NOT NULL,
  `MaKho` varchar(10) NOT NULL,
  `NgayXuat` date NOT NULL,
  `MaNhanVien` varchar(20) NOT NULL,
  `MaDonViVanChuyen` varchar(20) NOT NULL,
  `MaSoThue_DoiTac` varchar(20) NOT NULL,
  `DiaChi` varchar(255) NOT NULL,
  `DonViTienTe` varchar(50) NOT NULL,
  `MaVatTu` varchar(20) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `DonGia` decimal(18,2) NOT NULL,
  `ThanhTien` decimal(18,2) NOT NULL,
  `MaLenhDieuDong` varchar(20) DEFAULT NULL,
  `TrangThai` enum('Chờ duyệt','Đã duyệt','Đang thực hiện','Hoàn thành','Hủy') NOT NULL DEFAULT 'Chờ duyệt',
  `GhiChu` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `xuatkho`
--

INSERT INTO `xuatkho` (`MaPhieuXuat`, `MaKho`, `NgayXuat`, `MaNhanVien`, `MaDonViVanChuyen`, `MaSoThue_DoiTac`, `DiaChi`, `DonViTienTe`, `MaVatTu`, `SoLuong`, `DonGia`, `ThanhTien`, `MaLenhDieuDong`, `TrangThai`, `GhiChu`) VALUES
('PX1001', 'KHO001', '2025-05-05', 'NV001', 'DVC001', '0201234567', '12 Nguyễn Trãi, Hà Nội', 'VND', 'VT001', 10, 120000.00, 1200000.00, 'LD001', 'Đã duyệt', 'Xuất cho công trình A'),
('PX1002', 'KHO002', '2025-05-04', 'NV002', 'DVC002', '0209988776', '89 Trần Hưng Đạo, Hải Phòng', 'VND', 'VT002', 5, 230000.00, 1150000.00, 'LD002', 'Chờ duyệt', 'Xuất phục vụ bảo trì thiết bị'),
('PX1003', 'KHO003', '2025-05-03', 'NV003', 'DVC003', '0505678901', '45 Lý Thường Kiệt, Đà Nẵng', 'VND', 'VT003', 20, 85000.00, 1700000.00, 'LD003', 'Hoàn thành', 'Xuất nội bộ kho dự án B');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `danhmuckho`
--
ALTER TABLE `danhmuckho`
  ADD PRIMARY KEY (`MaKho`);

--
-- Chỉ mục cho bảng `doitac`
--
ALTER TABLE `doitac`
  ADD PRIMARY KEY (`MaSoThue_DoiTac`);

--
-- Chỉ mục cho bảng `donvitinh`
--
ALTER TABLE `donvitinh`
  ADD PRIMARY KEY (`MaDonViTinh`);

--
-- Chỉ mục cho bảng `donvivanchuyen`
--
ALTER TABLE `donvivanchuyen`
  ADD PRIMARY KEY (`MaDonViVanChuyen`);

--
-- Chỉ mục cho bảng `lenhdieudong`
--
ALTER TABLE `lenhdieudong`
  ADD PRIMARY KEY (`MaLenhDieuDong`);

--
-- Chỉ mục cho bảng `loaivattu`
--
ALTER TABLE `loaivattu`
  ADD PRIMARY KEY (`MaLoaiVatTu`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD PRIMARY KEY (`TaiKhoan`),
  ADD UNIQUE KEY `nguoidung_email_unique` (`Email`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`MaNhanVien`),
  ADD UNIQUE KEY `nhanvien_sdt_unique` (`SDT`),
  ADD UNIQUE KEY `nhanvien_cccd_unique` (`CCCD`);

--
-- Chỉ mục cho bảng `nhapkho`
--
ALTER TABLE `nhapkho`
  ADD PRIMARY KEY (`MaPhieuNhap`);

--
-- Chỉ mục cho bảng `phieukiemke`
--
ALTER TABLE `phieukiemke`
  ADD PRIMARY KEY (`MaPhieuKiemKe`);

--
-- Chỉ mục cho bảng `phongban`
--
ALTER TABLE `phongban`
  ADD PRIMARY KEY (`MaPhongBan`);

--
-- Chỉ mục cho bảng `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Chỉ mục cho bảng `thanhlykho`
--
ALTER TABLE `thanhlykho`
  ADD PRIMARY KEY (`MaPhieuThanhLy`);

--
-- Chỉ mục cho bảng `vaitro`
--
ALTER TABLE `vaitro`
  ADD PRIMARY KEY (`MaVaiTro`);

--
-- Chỉ mục cho bảng `vattu`
--
ALTER TABLE `vattu`
  ADD PRIMARY KEY (`MaVatTu`);

--
-- Chỉ mục cho bảng `xuatkho`
--
ALTER TABLE `xuatkho`
  ADD PRIMARY KEY (`MaPhieuXuat`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
