-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 17, 2024 lúc 06:18 PM
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
-- Cơ sở dữ liệu: `my_sql`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `admin_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `username`, `password`, `admin_status`) VALUES
(1, 'teu', 'e10adc3949ba59abbe56e057f20f883e', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_chi_tiet_don_hang`
--

CREATE TABLE `tbl_chi_tiet_don_hang` (
  `id` int(11) NOT NULL,
  `id_donhang` int(11) NOT NULL,
  `id_sanpham` int(11) NOT NULL,
  `soluong` int(11) NOT NULL,
  `gia` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_chi_tiet_don_hang`
--

INSERT INTO `tbl_chi_tiet_don_hang` (`id`, `id_donhang`, `id_sanpham`, `soluong`, `gia`) VALUES
(50, 48, 78, 4, 25000.00),
(51, 49, 80, 2, 25000.00),
(52, 49, 79, 1, 25000.00),
(53, 49, 78, 1, 25000.00),
(54, 50, 80, 2, 25000.00),
(55, 50, 81, 2, 30000.00),
(56, 51, 146, 2, 30000.00),
(57, 51, 147, 2, 30000.00),
(58, 51, 145, 1, 30000.00),
(59, 51, 144, 1, 30000.00),
(60, 51, 142, 1, 30000.00),
(61, 47735, 119, 2, 30000.00),
(62, 47735, 126, 1, 25000.00),
(63, 47735, 145, 1, 30000.00),
(64, 47735, 89, 1, 25000.00),
(65, 28481, 107, 1, 40000.00),
(66, 0, 151, 1, 25000.00),
(67, 0, 150, 2, 30000.00),
(68, 0, 149, 1, 25000.00),
(69, 0, 119, 1, 30000.00),
(70, 0, 118, 1, 30000.00),
(71, 47737, 151, 1, 25000.00),
(72, 47737, 150, 2, 30000.00),
(73, 47737, 149, 1, 25000.00),
(74, 47737, 119, 1, 30000.00),
(75, 47737, 118, 1, 30000.00),
(76, 47738, 149, 1, 25000.00),
(77, 47739, 148, 2, 30000.00),
(78, 47740, 148, 1, 30000.00),
(79, 47741, 147, 1, 30000.00),
(80, 47741, 148, 1, 30000.00),
(81, 60657, 147, 1, 30000.00),
(82, 87097, 147, 1, 30000.00),
(83, 87098, 147, 1, 30000.00),
(84, 87098, 148, 1, 30000.00),
(85, 95023, 147, 1, 30000.00),
(86, 95024, 147, 1, 30000.00),
(87, 95025, 147, 2, 30000.00),
(88, 95026, 147, 1, 30000.00),
(89, 5413, 147, 2, 30000.00),
(90, 93636, 147, 2, 30000.00),
(91, 95027, 147, 1, 30000.00),
(92, 95028, 147, 2, 30000.00),
(93, 93576, 147, 1, 30000.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_danhmuc`
--

CREATE TABLE `tbl_danhmuc` (
  `id_danhmuc` int(11) NOT NULL,
  `tendanhmuc` varchar(100) NOT NULL,
  `thutu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_danhmuc`
--

INSERT INTO `tbl_danhmuc` (`id_danhmuc`, `tendanhmuc`, `thutu`) VALUES
(21, 'Trà', 2),
(22, 'Sinh tố', 4),
(23, 'Đồ uống đá xay', 6),
(26, 'Sữa chua', 7),
(27, 'Bánh ngọt', 1),
(28, 'Nước ép', 3),
(29, 'Cà phê', 8);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_donhang`
--

CREATE TABLE `tbl_donhang` (
  `id_donhang` int(11) NOT NULL,
  `ngaymua` datetime DEFAULT NULL,
  `tongtien` int(11) NOT NULL,
  `payment_method` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_donhang`
--

INSERT INTO `tbl_donhang` (`id_donhang`, `ngaymua`, `tongtien`, `payment_method`) VALUES
(48, '2023-12-13 03:52:54', 100000, 'cash'),
(49, '2023-12-18 11:07:03', 100000, 'cash'),
(50, '2023-12-19 11:18:22', 110000, 'cash'),
(51, '2023-12-20 10:36:56', 210000, 'cash'),
(5413, '2024-01-16 14:28:41', 60000, 'VNPay'),
(28481, '2023-12-20 18:05:10', 40000, 'Tiền Mặt'),
(47735, '2023-12-20 17:58:19', 140000, 'Chuyển Khoản'),
(47736, '2024-01-16 14:24:39', 170000, 'VNPay'),
(47737, '2024-01-16 14:24:44', 170000, 'Tiền Mặt'),
(47738, '2024-01-16 14:24:52', 25000, 'Tiền Mặt'),
(47739, '2024-01-16 14:24:58', 60000, 'Tiền Mặt'),
(47740, '2024-01-16 14:25:35', 30000, 'Tiền Mặt'),
(47741, '2024-01-16 14:25:42', 60000, 'Tiền Mặt'),
(60657, '2024-01-16 14:25:56', 30000, 'VNPay'),
(87097, '2024-01-16 14:27:43', 30000, 'VNPay'),
(87098, '2024-01-16 14:27:57', 60000, 'Tiền Mặt'),
(93576, '2024-01-16 14:29:54', 30000, 'VNPay'),
(93636, '2024-01-16 14:29:02', 60000, 'VNPay'),
(95023, '2024-01-16 14:28:03', 30000, 'VNPay'),
(95024, '2024-01-16 14:28:21', 30000, 'Chuyển Khoản'),
(95025, '2024-01-16 14:28:28', 60000, 'Tiền Mặt'),
(95026, '2024-01-16 14:28:35', 30000, 'Chuyển Khoản'),
(95027, '2024-01-16 14:29:38', 30000, 'Tiền Mặt'),
(95028, '2024-01-16 14:29:47', 60000, 'Tiền Mặt');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_nhanvien`
--

CREATE TABLE `tbl_nhanvien` (
  `id_nhanvien` int(11) NOT NULL,
  `hoten` varchar(255) NOT NULL,
  `namsinh` date DEFAULT NULL,
  `gioitinh` varchar(10) DEFAULT NULL,
  `diachi` varchar(255) DEFAULT NULL,
  `sodienthoai` varchar(15) DEFAULT NULL,
  `tendangnhap` varchar(50) NOT NULL,
  `matkhau` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_nhanvien`
--

INSERT INTO `tbl_nhanvien` (`id_nhanvien`, `hoten`, `namsinh`, `gioitinh`, `diachi`, `sodienthoai`, `tendangnhap`, `matkhau`) VALUES
(1, 'Nguyễn Tiến Đạt', '2002-07-11', 'Nam', 'Vũ Hội - Vũ Thư -Thái Bình', '0338099132', 'teu', '$2y$10$nH9gf5NwbDKX60Jnh2.sX.vshPBDjS1/R9OBKZoaGzkLCdpJljkZ6'),
(10, 'Nguyễn Thị Thảo', '2010-02-12', 'Nữ', 'Hà Nội', '0338168456', 'thao', '$2y$10$3Sw2ndHNjKJ9necnP0ibe.f8p.RE5AduilGfc53sehVL5J7P44TfW'),
(11, 'Đỗ Văn Cương', '1995-08-03', 'Nam', 'Bắc Ninh', '0985831995', 'Cuong', '$2y$10$n2HZd1DVoffgJckyf7AFV.fd0Omq9H.4dUc2.v9WV0Nc8pwGojRkq'),
(12, 'Nguyễn Đình Hoàn', '2000-04-08', 'Nam', 'Nha Trang', '0812456789', 'Hoan', '$2y$10$0xZldjIVkVelMS/wgx7VAetc.VBvFqzOKABMP5KEJgzYZH./U54lO');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_sanpham`
--

CREATE TABLE `tbl_sanpham` (
  `id_sanpham` int(11) NOT NULL,
  `tensanpham` varchar(250) NOT NULL,
  `giasanpham` varchar(100) NOT NULL,
  `soluong` int(11) NOT NULL,
  `hinhanh` varchar(100) NOT NULL,
  `id_danhmuc` int(11) NOT NULL,
  `tinhtrang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_sanpham`
--

INSERT INTO `tbl_sanpham` (`id_sanpham`, `tensanpham`, `giasanpham`, `soluong`, `hinhanh`, `id_danhmuc`, `tinhtrang`) VALUES
(82, 'Bạc hà đá xay', '35000', 10, '1703059759_bac-ha-da-xay.jpg', 23, 1),
(85, 'Bánh kem su', '40000', 10, '1703059824_banh-kem-su.jpg', 27, 1),
(86, 'Bánh mochi', '45000', 10, '1703059845_banh-mochi.jpg', 27, 1),
(87, 'Bánh macaron', '50000', 10, '1703059869_banh-macaron.jpg', 27, 1),
(88, 'Bánh muffin', '35000', 25, '1703059888_banh-muffin.jpg', 27, 1),
(89, 'Bánh quy', '25000', 25, '1703059908_banh-quy.jpg', 27, 1),
(90, 'Bánh torte', '50000', 10, '1703059928_banh-torte.jpg', 27, 1),
(91, 'Cà phê sữa đá', '30000', 25, '1703059995_Ca_Phe_Sua_Da.jpg', 29, 1),
(92, 'Capuchino', '35000', 25, '1703060018_cac-loai-thuc-uong-ca-phe-9.jpg', 29, 1),
(93, 'Cà phê đen đá', '30000', 25, '1703060036_cafedenda.jpg', 29, 1),
(94, 'Cam đá xay', '35000', 25, '1703060062_cam_da_xay_1.jpg', 23, 1),
(95, 'Cà phê bạc xỉu', '35000', 10, '1703060090_caphebacxiu.jpg', 29, 1),
(96, 'Cà phê cốt dừa', '35000', 10, '1703060106_caphecotdua.jpg', 29, 1),
(97, 'Cà phê sữa chua', '30000', 25, '1703060132_caphesuachua.jpg', 29, 1),
(98, 'Cà phê sữa nóng', '30000', 25, '1703060169_Caphesuanong.jpg', 29, 1),
(99, 'Cà phê trứng', '35000', 25, '1703060187_caphetrung.jpg', 29, 1),
(100, 'Caramel phô mai', '35000', 25, '1703060217_CARAMELPHOMAI.jpg', 27, 1),
(102, 'Dâu đá xay', '30000', 10, '1703060263_dau-da-xay.jpg', 23, 1),
(103, 'Hồng trà', '25000', 25, '1703060282_hong-tra.jpg', 21, 1),
(104, 'Hồng trà sữa', '35000', 10, '1703060317_hong-tra-sua.jpg', 21, 1),
(105, 'Matcha đá xay', '30000', 25, '1703060336_matcha-da-xay.jpg', 23, 1),
(106, 'Mousse ca cao', '45000', 10, '1703060356_MOUSSECACAO.png', 27, 1),
(107, 'Mousse đào', '40000', 10, '1703060379_MOUSSEDAO.png', 27, 1),
(108, 'Nước dừa', '25000', 10, '1703060400_nuocdua.jpg', 28, 1),
(109, 'Nước ép cam', '25000', 10, '1703060418_nuocepcam.jpg', 28, 1),
(110, 'Nước chanh leo', '25000', 10, '1703060452_nuocepchanhleo.jpg', 28, 1),
(111, 'Nước ép chanh tươi', '25000', 10, '1703060469_nuocepchanhtuoi.jpg', 28, 1),
(112, 'Nước ép dứa', '30000', 25, '1703060485_nuocepdua.jpg', 28, 1),
(113, 'Nước ép dưa hấu', '25000', 10, '1703060542_nuocepduahau.jpg', 28, 1),
(114, 'Nước ép ổi', '25000', 15, '1703060568_nuocepoi.jpg', 28, 1),
(115, 'Nước ép táo', '25000', 0, '1703060594_nuoceptao.jpg', 28, 1),
(117, 'Phô mai cà phê', '30000', 25, '1703060710_PHOMAICAPHE.jpg', 27, 1),
(118, 'Phô mai chanh dây', '30000', 25, '1703060734_PHOMAICHANHDAY.jpg', 27, 1),
(119, 'Phô mai trà xanh', '30000', 10, '1703060760_PHOMAITRAXANH.jpg', 27, 1),
(120, 'Sinh tố bơ', '30000', 10, '1703060801_sinhtobo.jpg', 22, 1),
(121, 'Sinh tố chanh tuyết', '30000', 25, '1703060826_sinhtochanhtuyet.jpg', 22, 1),
(122, 'Sinh tố dừa xiêm', '25000', 10, '1703060843_sinhtoduaxiem.jpg', 22, 1),
(123, 'Sinh tố mãng cầu', '25000', 10, '1703060860_sinhtomangcau.jpg', 22, 1),
(124, 'Sinh tố nho', '35000', 25, '1703060898_sinh-to-nho.jpg', 22, 1),
(125, 'Sinh tố rau má', '30000', 15, '1703060920_sinh-to-rau-ma.jpg', 22, 1),
(126, 'Sinh tố xoài', '25000', 25, '1703060938_sinhtoxoai.jpg', 22, 1),
(127, 'Sữa chua đậu lành', '30000', 10, '1703060972_suachuadaulanh.jpg', 26, 1),
(129, 'Sữa chua hoàng kim', '30000', 10, '1703061025_sua-chua-dau-tam-hat-de-.png', 26, 1),
(130, 'Sữa chua dâu tằm', '30000', 10, '1703061175_sua-chua-dau-tam-hoang-kim.png', 26, 1),
(131, 'Sữa chua mít', '25000', 25, '1703061197_suachuamit.jpg', 26, 1),
(132, 'Sữa chua nếp cẩm', '25000', 25, '1703061227_suachuanepcam.jpg', 26, 1),
(133, 'Sữa chua trắng', '30000', 25, '1703061255_sua-chua-trang-.png', 26, 1),
(134, 'Sữa chua tầng', '25000', 10, '1703061279_suachutang.jpg', 26, 1),
(135, 'Tắc đá xay', '25000', 10, '1703061301_tac-da-xay.jpg', 23, 1),
(136, 'Trà thạch vải', '30000', 10, '1703061337_TRA_TACH_VAI.jpg', 21, 1),
(137, 'Trà thanh đào', '35000', 25, '1703061357_TRA_THANH_DAO-08.jpg', 21, 1),
(138, 'Trà thạch đào', '35000', 10, '1703061378_TRA_THANH_DAO-09.jpg', 21, 1),
(139, 'Trà xanh xoài', '35000', 25, '1703061401_tra_xanh_xoai_35d69664c31248faaf3eeade044035ba_grande.jpg', 21, 1),
(141, 'Trà hoa quả', '30000', 10, '1703061440_tra-hoa-qua-nhiet-doi.jpg', 21, 1),
(142, 'Trà anh đào', '30000', 10, '1703061464_traquamonganhdao.jpg', 21, 1),
(143, 'Trà sen vàng', '30000', 25, '1703061480_tra-sen-vang.jpg', 21, 1),
(144, 'Trà vải', '30000', 15, '1703061496_tra-vai.jpg', 21, 1),
(145, 'Trà xanh đậu đỏ', '30000', 15, '1703061518_traxanhdaudo.jpg', 21, 1),
(146, 'Trà xoài bưởi hồng', '30000', 15, '1703061544_trà-xoài-bưởi-hồng.png', 21, 1),
(147, 'Việt quất đá xay', '30000', 10, '1703061558_viet-quat-da-xay.jpg', 23, 1),
(148, 'Sinh tố kiwi', '30000', 25, '1703062010_sinhtokiwi(1)-800x500.jpg', 22, 1),
(149, 'Đá xay oreo', '25000', 10, '1703062122_da-xay-oreo-1.jpg', 23, 1),
(150, 'Chocolate đá xay', '30000', 25, '1703062171_chocolate-da-xay-3.jpg', 23, 1),
(151, 'Thạch lá nếp', '25000', 25, '1703062489_suachuathachlanep.jpg', 26, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_thongke`
--

CREATE TABLE `tbl_thongke` (
  `id` int(11) NOT NULL,
  `ngaydat` varchar(50) NOT NULL,
  `donhang` int(11) NOT NULL,
  `doanhthu` varchar(100) NOT NULL,
  `soluongban` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_thongke`
--

INSERT INTO `tbl_thongke` (`id`, `ngaydat`, `donhang`, `doanhthu`, `soluongban`) VALUES
(47, '2023-12-21 15:36:12', 1, '85000', 3),
(48, '2023-12-21 15:36:20', 1, '85000', 3),
(49, '2023-12-21 15:37:08', 1, '80000', 3),
(50, '2023-12-21 15:47:47', 1, '115000', 4),
(51, '2023-12-17 15:36:12', 10, '885000', 10),
(52, '2023-12-07 15:36:20', 3, '785000', 8),
(53, '2023-11-21 15:37:08', 1, '80000', 3),
(54, '2023-12-21 15:37:08', 1, '80000', 3),
(55, '2023-12-21 15:47:47', 1, '115000', 4),
(56, '2023-12-21 15:36:12', 1, '85000', 3),
(57, '2023-12-21 15:36:20', 1, '85000', 3),
(58, '2023-12-21 15:52:11', 1, '110000', 4),
(59, '2023-12-21 15:37:08', 1, '80000', 3),
(60, '2023-12-21 15:52:12', 1, '110000', 4),
(61, '2023-12-21 15:47:47', 1, '115000', 4),
(62, '2023-12-21 15:36:12', 1, '85000', 3),
(63, '2023-12-21 15:36:20', 1, '85000', 3),
(64, '2023-12-21 15:52:11', 1, '110000', 4),
(65, '2023-12-21 15:37:08', 1, '80000', 3),
(66, '2023-12-21 15:52:12', 1, '110000', 4),
(67, '2023-12-21 15:47:47', 1, '115000', 4),
(68, '2023-12-21 15:36:12', 1, '85000', 3),
(69, '2023-12-21 15:36:20', 1, '85000', 3),
(70, '2023-12-21 15:52:42', 1, '85000', 3),
(71, '2023-12-21 15:52:11', 1, '110000', 4),
(72, '2023-3-21 15:36:12', 1, '85000', 3),
(73, '2023-7-21 15:36:20', 1, '85000', 3),
(74, '2023-1-21 15:37:08', 1, '80000', 3),
(75, '2023-12-21 15:37:08', 1, '80000', 3),
(76, '2023-12-21 15:52:12', 1, '110000', 4),
(77, '2023-12-21 15:47:47', 1, '115000', 4),
(78, '2023-12-21 15:36:12', 1, '85000', 3),
(79, '2023-12-21 15:36:20', 1, '85000', 3),
(80, '2023-12-21 15:52:42', 1, '85000', 3),
(81, '2023-12-21 15:52:11', 1, '110000', 4),
(82, '2023-12-21 16:37:26', 1, '145000', 5),
(83, '2023-12-21 16:38:03', 1, '110000', 4),
(84, '2023-12-21 17:20:10', 1, '55000', 2),
(85, '2023-12-21 17:20:34', 1, '160000', 6),
(86, '2023-12-21 17:40:55', 1, '85000', 3),
(87, '2023-12-21 17:45:39', 1, '85000', 3),
(88, '2023-12-21 17:49:25', 1, '65000', 2),
(89, '2023-12-21 17:49:38', 1, '60000', 2),
(90, '2023-12-21 17:49:55', 1, '60000', 2),
(91, '2023-12-21 17:50:12', 1, '55000', 2),
(92, '2023-12-21 18:02:02', 1, '30000', 1),
(93, '2023-12-21 18:02:14', 1, '60000', 2),
(94, '2023-12-21 18:07:50', 1, '1', 1),
(95, '2023-12-21 20:15:38', 1, '60000', 2),
(96, '2023-12-21 20:15:56', 1, '60000', 2),
(97, '2023-12-21 20:16:33', 1, '90000', 3),
(98, '2023-12-13 03:52:54', 1, '100000', 4),
(99, '2023-12-18 11:07:03', 1, '100000', 4),
(100, '2023-12-19 11:18:22', 1, '110000', 4),
(101, '2023-12-20 10:36:56', 1, '210000', 7),
(102, '2023-12-20 18:05:10', 1, '40000', 1),
(103, '2023-12-20 17:58:19', 1, '140000', 5),
(104, '2024-01-16 14:24:39', 1, '0', 0),
(105, '2024-01-16 14:24:44', 1, '170000', 6),
(106, '2024-01-16 14:24:52', 1, '25000', 1),
(107, '2024-01-16 14:24:58', 1, '60000', 2),
(108, '2024-01-16 14:25:35', 1, '30000', 1),
(109, '2024-01-16 14:25:42', 1, '60000', 2),
(110, '2024-01-16 14:25:56', 1, '30000', 1),
(111, '2024-01-16 14:27:43', 1, '30000', 1),
(112, '2024-01-16 14:27:57', 1, '60000', 2),
(113, '2024-01-16 14:28:03', 1, '30000', 1),
(114, '2024-01-16 14:28:21', 1, '30000', 1),
(115, '2024-01-16 14:28:28', 1, '60000', 2),
(116, '2024-01-16 14:28:35', 1, '30000', 1),
(117, '2024-01-16 14:28:41', 1, '60000', 2),
(118, '2024-01-16 14:29:02', 1, '60000', 2),
(119, '2024-01-16 14:29:38', 1, '30000', 1),
(120, '2024-01-16 14:29:47', 1, '60000', 2),
(121, '2024-01-16 14:29:54', 1, '30000', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_vnpay`
--

CREATE TABLE `tbl_vnpay` (
  `id_vnpay` int(11) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `bankcode` varchar(100) NOT NULL,
  `banktrano` varchar(100) NOT NULL,
  `cardtype` varchar(100) NOT NULL,
  `orderinfo` varchar(100) NOT NULL,
  `paydate` varchar(100) NOT NULL,
  `tmncode` varchar(100) NOT NULL,
  `transactionno` varchar(100) NOT NULL,
  `id_hang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_vnpay`
--

INSERT INTO `tbl_vnpay` (`id_vnpay`, `amount`, `bankcode`, `banktrano`, `cardtype`, `orderinfo`, `paydate`, `tmncode`, `transactionno`, `id_hang`) VALUES
(45, '3500000', 'VNPAY', '', '', 'Thanh toan GD:457', '20231220095455', 'KMO2OYPL', '0', '457'),
(46, '3500000', 'VNPAY', '', '', 'Thanh toan GD:12784', '20231220140106', 'KMO2OYPL', '0', '12784'),
(47, '11000000', 'NCB', '', '', 'Thanh toan GD:4707', '20231220140324', 'KMO2OYPL', '14253281', '4707'),
(48, '6000000', 'VNPAY', '', '', 'Thanh toan GD:92323', '20231220162034', 'KMO2OYPL', '0', '92323'),
(49, '3000000', 'VNPAY', '', '', 'Thanh toan GD:87097', '20240116142742', 'KMO2OYPL', '0', '87097'),
(50, '3000000', 'VNPAY', '', '', 'Thanh toan GD:95023', '20240116142803', 'KMO2OYPL', '0', '95023'),
(51, '6000000', 'VNPAY', '', '', 'Thanh toan GD:5413', '20240116142841', 'KMO2OYPL', '0', '5413'),
(52, '6000000', 'VNPAY', '', '', 'Thanh toan GD:93636', '20240116142901', 'KMO2OYPL', '0', '93636'),
(53, '3000000', 'VNPAY', '', '', 'Thanh toan GD:93576', '20240116142954', 'KMO2OYPL', '0', '93576');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Chỉ mục cho bảng `tbl_chi_tiet_don_hang`
--
ALTER TABLE `tbl_chi_tiet_don_hang`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_danhmuc`
--
ALTER TABLE `tbl_danhmuc`
  ADD PRIMARY KEY (`id_danhmuc`);

--
-- Chỉ mục cho bảng `tbl_donhang`
--
ALTER TABLE `tbl_donhang`
  ADD PRIMARY KEY (`id_donhang`);

--
-- Chỉ mục cho bảng `tbl_nhanvien`
--
ALTER TABLE `tbl_nhanvien`
  ADD PRIMARY KEY (`id_nhanvien`),
  ADD UNIQUE KEY `tendangnhap` (`tendangnhap`);

--
-- Chỉ mục cho bảng `tbl_sanpham`
--
ALTER TABLE `tbl_sanpham`
  ADD PRIMARY KEY (`id_sanpham`);

--
-- Chỉ mục cho bảng `tbl_thongke`
--
ALTER TABLE `tbl_thongke`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_vnpay`
--
ALTER TABLE `tbl_vnpay`
  ADD PRIMARY KEY (`id_vnpay`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tbl_chi_tiet_don_hang`
--
ALTER TABLE `tbl_chi_tiet_don_hang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT cho bảng `tbl_danhmuc`
--
ALTER TABLE `tbl_danhmuc`
  MODIFY `id_danhmuc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT cho bảng `tbl_donhang`
--
ALTER TABLE `tbl_donhang`
  MODIFY `id_donhang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95029;

--
-- AUTO_INCREMENT cho bảng `tbl_nhanvien`
--
ALTER TABLE `tbl_nhanvien`
  MODIFY `id_nhanvien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `tbl_sanpham`
--
ALTER TABLE `tbl_sanpham`
  MODIFY `id_sanpham` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT cho bảng `tbl_thongke`
--
ALTER TABLE `tbl_thongke`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT cho bảng `tbl_vnpay`
--
ALTER TABLE `tbl_vnpay`
  MODIFY `id_vnpay` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
