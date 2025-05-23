-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 22, 2025 lúc 07:32 PM
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
-- Đang đổ dữ liệu cho bảng `chitietvattu`
--

INSERT INTO `chitietvattu` (`MaVatTu`, `ThuongHieu`, `KichThuoc`, `XuatXu`, `MoTa`, `created_at`, `updated_at`) VALUES
('VT001', 'LG', NULL, 'Trung Quốc', 'Bộ xử lý AI α7 Gen4 tự động nhận dạng thể loại nội dung và điều kiện ánh sáng xung quanh bạn, rồi tối ưu hóa thiết lập màn hình cho phù hợp. Mỗi điều chỉnh tự động đều mang lại hình ảnh chất lượng cao và sắc nét, đảm bảo cải thiện trải nghiệm xem TV.', NULL, NULL),
('VT002', 'IPhone', '9,6 inch (30,5 x 24,4 cm)', 'Trung Quốc', NULL, NULL, NULL);

--
-- Đang đổ dữ liệu cho bảng `danhmuckho`
--

INSERT INTO `danhmuckho` (`MaKho`, `TenKho`, `DiaChi`, `QuyMo`, `DienTichSuDung`) VALUES
('KHO001', 'Kho A', 'Số 1, Đường ABC, TP. HCM', 1000, 750),
('KHO002', 'Kho B', 'Số 2, Đường XYZ, TP. Hải Phòng', 1500, 500),
('KHO003', 'Kho C', 'Số 3, Đường DEF, TP. Đà Nẵng', 2000, 1000),
('KHO004', 'Kho D', 'Số 4, Đường GHI, TP. Cần Thơ', 1200, 0),
('KHO005', 'Kho E', 'Số 43, Đường ABC, TP. HCM', 320, 120);

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

INSERT INTO `donvivanchuyen` (`MaDonViVanChuyen`, `TenDonViVanChuyen`, `MaNhanVien`, `PhuongTienVanChuyen`, `GhiChu`) VALUES
('DVC001', 'Đơn Vị Vận Chuyển 1', 'NV002', 'Xe tải', 'Ghi chú đơn vị 1'),
('DVC002', 'Đơn Vị Vận Chuyển 2', 'NV002', 'Xe container', 'Ghi chú đơn vị 2'),
('DVC003', 'Đơn Vị Vận Chuyển 3', 'NV003', 'Xe máy', 'Ghi chú đơn vị 3');

--
-- Đang đổ dữ liệu cho bảng `lenhdieudong`
--

INSERT INTO `lenhdieudong` (`MaLenhDieuDong`, `TenLenhDieuDong`, `LyDo`, `MaNhanVien`, `NgayLapDon`, `TrangThai`, `GhiChu`) VALUES
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


--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`MaNhanVien`, `TenNhanVien`, `DiaChi`, `GioiTinh`, `NgaySinh`, `SDT`, `CCCD`, `MaChucVu`, `Anh`, `TrangThai`) VALUES
('NV001', 'Nguyễn Văn A', 'Hà Nội', 'Nam', '1990-01-01', 912345678, 1122334455, 'CV001', 'avatar1.jpg', 'Đang làm'),
('NV002', 'Trần Thị B', 'Hải Phòng', 'Nữ', '1992-02-02', 923456789, 2233445566, 'CV002', 'avatar2.jpg', 'Đang làm'),
('NV003', 'Lê Văn C', 'Đà Nẵng', 'Nam', '1988-03-03', 934567890, 3344556677, 'CV001', 'avatar3.jpg', 'Nghỉ việc'),
('NV004', 'Phạm Thị D', 'TP.HCM', 'Nữ', '1995-04-04', 945678901, 4455667788, 'CV003', 'avatar4.jpg', 'Đang làm'),
('NV005', 'Hoàng Văn E', 'Cần Thơ', 'Nam', '1991-05-05', 956789012, 5566778899, 'CV002', 'avatar5.jpg', 'Đang làm');

--
-- Đang đổ dữ liệu cho bảng `nhapkho`
--

INSERT INTO `nhapkho` (`MaPhieuNhap`, `MaKho`, `DiaChi`, `MaVatTu`, `SoLuong`, `DonGia`, `NgayNhap`, `MaSoThue_DoiTac`, `MaNhanVien`, `MaLenhDieuDong`, `MaDonViVanChuyen`, `GhiChu`) VALUES
('PN001', 'KHO001', 'HP', 'VT003', 8, 800000.00, '2025-05-10', '0201234567', 'NV001', 'LD001', 'DVC001', ''),
('PN002', 'KHO002', 'Số 2, Đường XYZ, TP. Hà Nội', 'VT002', 50, 30000.00, '2025-04-21', '0201234567', 'NV002', 'LD002', 'DVC002', 'Phiếu nhập đợt 2'),
('PN003', 'KHO003', 'Số 3, Đường DEF, TP. Đà Nẵng', 'VT003', 200, 10000.00, '2025-04-22', '0201234567', 'NV003', 'LD003', 'DVC003', 'Phiếu nhập hàng tồn kho'),
('PN004', 'KHO003', 'HP NA', 'VT001', 20, 3000000.00, '2025-05-12', '0201234567', 'NV002', 'LD003', 'DVC001', 'KO');

--
-- Đang đổ dữ liệu cho bảng `phieukiemke`
--

INSERT INTO `phieukiemke` (`MaPhieuKiemKe`, `MaKho`, `NgayKiemKe`, `MaNhanVien`, `TrangThai`, `MaVatTu`, `SoLuongThucTe`, `SoLuongTon`, `TinhTrang`, `MaLenhDieuDong`, `GhiChu`) VALUES
('PKK001', 'KHO001', '2025-05-14', 'NV001', 'Đã Hủy', 'VT001', 10, 100, 'Còn tốt 100%', 'LD001', 'Kiểm kê định kỳ quý 1'),
('PKK002', 'KHO002', '2025-05-14', 'NV002', 'Chờ Duyệt', 'VT002', 45, 50, 'Kém chất lượng', 'LD003', 'Sai lệch do bảo quản'),
('PKK003', 'KHO003', '2025-05-08', 'NV003', 'Đã Kiểm Kê', 'VT003', 22, 35, 'Còn tốt 100%', 'LD002', 'Mất mát trong quá trình vận chuyển');

--
-- Đang đổ dữ liệu cho bảng `phongban`
--

INSERT INTO `phongban` (`MaPhongBan`, `TenPhongBan`) VALUES
('PB001', 'Nhân Sự '),
('PB002', 'Vận Chuyển'),
('PB003', 'phòng ban kế toán'),
('PB004', 'bảo hành -  kiểm định'),
('PB005', 'Cán bộ Kho');

--
-- Đang đổ dữ liệu cho bảng `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('eK01AICynQRDkAIU2P84Jit2pA9ParA9XHRVJhtH', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoieElSYmJSYzJ1czhpaUhZMzJBR3hXOUs1R3plQmw0aUx1TEpUZUdCQyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1747916026);

--
-- Đang đổ dữ liệu cho bảng `thanhlykho`
--

INSERT INTO `thanhlykho` (`MaPhieuThanhLy`, `MaKho`, `NgayLap`, `MaNhanVien`, `TrangThai`, `LyDoThanhLy`, `MaVatTu`, `SoLuong`, `DonGia`, `BienPhapThanhLy`, `MaLenhDieuDong`) VALUES
('PTL001', 'KHO001', '2025-05-01', 'NV001', 'Đã thanh lý', 'Hư hỏng do sử dụng lâu ngày', 'VT001', 10, 50000.00, 'Tiêu hủy', 'LD001'),
('PTL002', 'KHO002', '2025-05-02', 'NV002', 'Chờ duyệt', 'Không còn sử dụng trong sản xuất', 'VT002', 3, 70000.00, 'Chuyển đổi sử dụng', 'LD002'),
('PTL004', 'KHO001', '2025-05-04', 'NV004', 'Đã hủy', 'Lỗi đề xuất không chính xác', 'VT004', 8, 45000.00, 'Tiêu hủy', 'LD003'),
('TL003', 'KHO003', '2025-05-03', 'NV003', 'Đã thanh lý', 'Thanh lý định kỳ quý 1', 'VT003', 5, 150000.00, 'Bán thanh lý', 'LD003');

--
-- Đang đổ dữ liệu cho bảng `vaitro`
--

INSERT INTO `vaitro` (`MaVaiTro`, `TenVaiTro`, `QuyenHan`) VALUES
(0, 'admin', 'Admin'),
(1, 'user', 'User');

--
-- Đang đổ dữ liệu cho bảng `vattu`
--

INSERT INTO vattu (MaVatTu, MaLoaiVatTu, TenVatTu, MaDonViTinh, GiaNhap, DonViTienTe, SoLuongTon, MaSoThue_DoiTac, NgayNhap, HanSuDung, GhiChu, AnhVatTu) VALUES
('VT001', 'LVT002', 'Chip xử lý LG Alpha', 'DVT001', 3000000.00, 'VND', 2, '0505678901', '2025-04-05', '2025-05-02', 'nhy21', 'LVT002\\download (1).jpg'),
('VT002', 'LVT005', 'Bo mạch chủ LG Main X1', 'DVT001', 1500000.00, 'VND', 22, '0505678901', '2025-04-05', '2025-05-17', 'NHYYY', 'LVT005\\download.jpg'),
('VT003', 'LVT003', 'RAM LG DDR4 8GB', 'DVT001', 800000.00, 'VND', 1, '0505678901', '2025-04-05', NULL, NULL, 'LVT003\\download (1).jpg'),
('VT004', 'LVT008', 'Nguồn LG PSU 500W', 'DVT001', 1200000.00, 'VND', 6, '0505678901', '2025-04-05', NULL, NULL, 'LVT008\\cu.jpg'),
('VT005', 'LVT006', 'Cảm biến LG Sensor Pro', 'DVT001', 1000000.00, 'VND', 5, '0505678901', '2025-04-05', NULL, NULL, 'LVT006\\download (1).jpg'),
('VT006', 'LVT001', 'Keo dán tản nhiệt', 'DVT001', 50000.00, 'VND', 1, '0505678901', '2025-04-20', NULL, NULL, 'LVT001\\download.jpg'),
('VT007', 'LVT001', 'Keo silicone', 'DVT001', 45000.00, 'VND', 1, '0505678901', '2025-04-20', NULL, NULL, 'LVT001\\download (7).jpg'),
('VT008', 'LVT001', 'Keo AB', 'DVT001', 60000.00, 'VND', 1, '0505678901', '2025-04-20', NULL, NULL, 'LVT001\\VT001.jpg'),
('VT009', 'LVT001', 'Dây điện lõi đồng LG 2.5mm', 'DVT001', 10000.00, 'VND', 1, '0505678901', '2025-04-20', NULL, NULL, 'LVT001\\download (8).jpg'),
('VT010', 'LVT001', 'Dây cáp tín hiệu LG 3m', 'DVT001', 20000.00, 'VND', 1, '0505678901', '2025-04-20', NULL, NULL, 'LVT001\\download21.jpg'),
('VT011', 'LVT001', 'Dây nguồn LG 220V', 'DVT001', 15000.00, 'VND', 1, '0505678901', '2025-04-20', NULL, NULL, 'LVT001\\download (1).jpg'),
('VT012', 'LVT001', 'Ốc vít LG M4x10mm', 'DVT001', 500.00, 'VND', 1, '0505678901', '2025-04-20', NULL, NULL, 'LVT001\\download (4).jpg'),
('VT013', 'LVT001', 'Đinh tán nhôm 3mm', 'DVT001', 700.00, 'VND', 1, '0505678901', '2025-04-20', NULL, NULL, '\r\nLVT001\\download (2).jpg'),
('VT014', 'LVT001', 'Băng dính cách điện 3M', 'DVT001', 8000.00, 'VND', 1, '0505678901', '2025-04-20', NULL, NULL, 'LVT001\\images (3).jpg'),
('VT017', 'LVT002', 'IC nguồn LG 1117-3.3V', 'DVT001', 4000.00, 'VND', 1, '0601234567', '2025-04-20', NULL, NULL, 'LVT002\\download (11).jpg'),
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

INSERT INTO `xuatkho` (`MaPhieuXuat`, `MaKho`, `NgayXuat`, `MaNhanVien`, `MaDonViVanChuyen`, `DiaDiemXuat`, `DiaChi`, `DonViTienTe`, `MaVatTu`, `SoLuong`, `DonGia`, `ThanhTien`, `MaLenhDieuDong`, `TrangThai`, `GhiChu`) VALUES
('PX1001', 'KHO001', '2025-05-05', 'NV001', 'DVC001', '12 Nguyễn Trãi, Hà Nội', '', 'VND', 'VT001', 10, 120000.00, 1200000.00, 'LD001', 'Đã duyệt', 'Xuất cho công trình A'),
('PX1002', 'KHO002', '2025-05-04', 'NV002', 'DVC002', '89 Trần Hưng Đạo, Hải Phòng', '', 'VND', 'VT002', 5, 230000.00, 1150000.00, 'LD002', 'Chờ duyệt', 'Xuất phục vụ bảo trì thiết bị'),
('PX1003', 'KHO003', '2025-05-03', 'NV003', 'DVC003', '45 Lý Thường Kiệt, Đà Nẵng', '', 'VND', 'VT003', 20, 85000.00, 1700000.00, 'LD003', 'Hoàn thành', 'Xuất nội bộ kho dự án B');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
