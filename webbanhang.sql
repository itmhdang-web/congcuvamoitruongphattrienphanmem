-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2025 at 10:18 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webbanhang`
--

-- --------------------------------------------------------

--
-- Table structure for table `table_comment`
--

CREATE TABLE `table_comment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED DEFAULT NULL,
  `id_product` bigint(20) UNSIGNED DEFAULT NULL,
  `content` mediumtext DEFAULT NULL,
  `status` int(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `table_comment`
--

INSERT INTO `table_comment` (`id`, `id_user`, `id_product`, `content`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, NULL, 20, 'Chất lượng ok', 1, '2024-08-15 07:26:41', '2024-08-15 07:26:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `table_order`
--

CREATE TABLE `table_order` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `id_user` bigint(20) UNSIGNED DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `payment` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `total_price` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `table_order`
--

INSERT INTO `table_order` (`id`, `code`, `id_user`, `fullname`, `email`, `phone`, `address`, `content`, `payment`, `status`, `total_price`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '67ed0a17-2e0a-4d47-af08-baa6ae5966df', NULL, 'admin', 'admin@gmail.com', '0912345678', 'Trường trinh', NULL, 'cod', 'completed', 2580000, '2024-07-25 16:59:30', '2024-07-25 10:04:32', NULL),
(2, '12697999-2e52-4870-9bb5-89182061428c', NULL, 'admin', 'admin@gmail.com', '0912345678', 'Trường trinh', NULL, 'cod', 'delivering', 20799999, '2024-07-25 17:01:00', '2024-07-25 10:04:05', NULL),
(12, 'a78d1d11-1a28-4241-ba33-96058dac0c3b', NULL, 'user', 'user@gmail.com', '0906222592', 'Cộng Hòa', 'Đã chuyển khoản qua VNPay', 'vnpay', 'paid', 3699999, '2024-08-15 14:26:21', '2024-08-15 07:26:21', NULL),
(17, 'ca3b77ca-115e-4410-b1c4-d1f256b0b1dc', 12, 'tongquocanh', 'atong@gmail.com', '0937552224', '325', NULL, 'cod', 'pending', 32980000, '2025-03-23 09:00:17', '2025-03-23 02:00:17', NULL),
(18, '572b2ad3-d8a7-40f5-9d06-b8d66e40b268', 12, 'tongquocanh', 'atong@gmail.com', '0937552224', '325', NULL, 'cod', 'completed', 19680000, '2025-03-23 09:02:32', '2025-03-23 02:07:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `table_order_detail`
--

CREATE TABLE `table_order_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_order` bigint(20) UNSIGNED DEFAULT NULL,
  `id_user` bigint(20) UNSIGNED DEFAULT NULL,
  `id_product` bigint(20) UNSIGNED DEFAULT NULL,
  `name_product` varchar(255) DEFAULT NULL,
  `photo_product` varchar(255) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `table_order_detail`
--

INSERT INTO `table_order_detail` (`id`, `id_order`, `id_user`, `id_product`, `name_product`, `photo_product`, `price`, `quantity`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 32, 'Thùng máy Case NZXT H6 Flow RGB - Trắng', 'product-9d22265c-80dc-494d-a926-e6cca212578a.png', 2580000, 1, '2024-07-25 09:59:30', '2024-07-25 09:59:30', NULL),
(2, 2, 1, 20, 'Mainboard MSI B760M Gaming Plus WiFi', 'product-947642f0-6ac2-45b1-ad09-c6be7c6fa243.jpg', 3699999, 1, '2024-07-25 10:01:00', '2024-07-25 10:01:00', NULL),
(3, 2, 1, 28, 'Card màn hình VGA MSI GeForce RTX 4070 Super 12G Ventus 2X OC', 'product-b295cd6f-3bbb-41dc-bffa-ad8918c36ed5.jpg', 17100000, 1, '2024-07-25 10:01:00', '2024-07-25 10:01:00', NULL),
(17, 12, 10, 20, 'Mainboard MSI B760M Gaming Plus WiFi', 'product-947642f0-6ac2-45b1-ad09-c6be7c6fa243.jpg', 3699999, 1, '2024-08-15 07:26:21', '2024-08-15 07:26:21', NULL),
(22, 17, 12, 33, 'Laptop gaming Gigabyte G5 MF5 H2VN353KH', 'product-d45803ea-e5c8-4f82-8c5d-7c4f5179482d.jpg', 11490000, 1, '2025-03-23 02:00:17', '2025-03-23 02:00:17', NULL),
(23, 17, 12, 32, 'Laptop Gaming Acer Aspire 7 A715-76G-5806', 'product-62aa8c2f-1c85-4d56-a5f7-301bac1182ba.jpg', 21490000, 1, '2025-03-23 02:00:17', '2025-03-23 02:00:17', NULL),
(24, 18, 12, 30, 'Tai nghe Logitech G733 LIGHTSPEED', 'product-56e733f2-388b-4422-8f89-4dd75b378afc.jpg', 2580000, 1, '2025-03-23 02:02:32', '2025-03-23 02:02:32', NULL),
(25, 18, 12, 28, 'Turtle Beach Recon Wired Gaming Controller', 'product-17eeee83-921d-4d4f-bb96-9c8ee84daa34.jpg', 17100000, 1, '2025-03-23 02:02:32', '2025-03-23 02:02:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `table_product`
--

CREATE TABLE `table_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_type` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `content` mediumtext DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `price_regular` double DEFAULT NULL,
  `sale_price` double DEFAULT NULL,
  `view` varchar(255) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `table_product`
--

INSERT INTO `table_product` (`id`, `id_type`, `name`, `brand`, `content`, `photo`, `price_regular`, `sale_price`, `view`, `created_at`, `updated_at`, `deleted_at`) VALUES
(14, 4, 'CPU Intel Core i5 14400F', 'Intel', '&lt;p&gt;&lt;span style=&quot;color:rgb(255,0,0);&quot;&gt;&lt;strong&gt;⚙ THÔNG SỐ CƠ BẢN:&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;&lt;ul&gt;&lt;li&gt;Thương hiệu: Intel&lt;/li&gt;&lt;li&gt;Socket: LGA 1700&lt;/li&gt;&lt;li&gt;Số nhân/luồng: 10/16&lt;/li&gt;&lt;li&gt;Xung nhịp cơ bản: 2.5 GHz&lt;/li&gt;&lt;li&gt;Xung nhịp tối đa: 4.7 GHz&lt;/li&gt;&lt;li&gt;Bộ nhớ Cache L2 / L3: 9.5/ 20 MB&lt;/li&gt;&lt;li&gt;Điện năng tiêu thụ: 65W&lt;/li&gt;&lt;/ul&gt;', 'product-27382c6b-bd37-406f-8069-7fe859178d0e.jpg', 5499999, 0, '0', '2024-07-25 06:07:20', '2024-07-25 06:07:20', NULL),
(15, 4, 'CPU Intel Core i3 14100', 'intel', '&lt;p&gt;&lt;span style=&quot;color:rgb(255,0,0);&quot;&gt;&lt;strong&gt;⚙ THÔNG SỐ CƠ BẢN:&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;&lt;ul&gt;&lt;li&gt;CPU: Intel Core i3-14100&lt;/li&gt;&lt;li&gt;Socket: LGA1700&lt;/li&gt;&lt;li&gt;Số nhân/luồng: 4(4P-Core|0E-Core)/8 luồng&lt;/li&gt;&lt;li&gt;Base Clock (P-Core): 3.5 GHz&lt;/li&gt;&lt;li&gt;Boost Clock (P-Core): TBC&lt;/li&gt;&lt;li&gt;TDP: 65W&lt;/li&gt;&lt;/ul&gt;', 'product-89dd93a6-5f91-41e8-a69d-a8d85d250986.jpg', 3890000, 0, '0', '2024-07-25 06:08:04', '2024-07-25 06:09:35', NULL),
(16, 4, 'CPU Intel Core i9 14900', 'Intel', '&lt;p&gt;&lt;span style=&quot;color:rgb(255,0,0);&quot;&gt;&lt;strong&gt;⚙ THÔNG SỐ CƠ BẢN:&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;&lt;ul&gt;&lt;li&gt;&lt;strong&gt;Socket:&lt;/strong&gt; LGA1700&amp;nbsp;&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Số nhân:&lt;/strong&gt; 24&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Số luồng:&lt;/strong&gt; 32&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Xung nhịp CPU:&lt;/strong&gt; 5.8 GHz&lt;/li&gt;&lt;/ul&gt;', 'product-ce4c8f0d-873d-4dc7-9081-428ef0177bb8.jpg', 15190000, 0, '0', '2024-07-25 06:09:20', '2024-07-25 06:09:20', NULL),
(17, 4, 'CPU AMD Ryzen 5 8600G', 'AMD', '&lt;p&gt;&lt;span style=&quot;color:rgb(255,0,0);&quot;&gt;&lt;strong&gt;⚙ THÔNG SỐ CƠ BẢN:&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;&lt;ul&gt;&lt;li&gt;&lt;strong&gt;Socket:&lt;/strong&gt; AM5&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Số nhân:&lt;/strong&gt; 6&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Số luồng:&lt;/strong&gt; 12&lt;/li&gt;&lt;/ul&gt;', 'product-dd39adb6-fefa-44df-8d96-ee08db49a97b.jpg', 6400000, 5900000, '13', '2024-07-25 06:11:27', '2025-03-19 07:38:42', NULL),
(18, 6, 'Mainboard Asus TUF Gaming B760M', 'Asus', '&lt;p&gt;Các bo mạch chủ TUF GAMING cũng đã phải trải qua quá trình kiểm tra độ bền nghiêm ngặt để đảm bảo có thể xử lý các điều kiện mà các bo mạch chủ khác có thể gặp lỗi. Nói về thiết kế, mẫu bo mạch chủ nổi bật với phần logo dập nổi cùng các tản nhiệt vát theo khối hình học, phản ánh độ tin cậy và độ ổn định vốn là đặc trưng của dòng TUF GAMING.&lt;/p&gt;&lt;h3&gt;&lt;strong&gt;Hiệu quả năng lượng toàn diện&lt;/strong&gt;&lt;/h3&gt;&lt;p&gt;Chức năng Tiết kiệm năng lượng gồm một số cài đặt có thể dễ dàng tối ưu hóa mức tiêu thụ điện năng và tiết kiệm năng lượng tối đa. Bạn có thể bật giới hạn năng lượng CPU, giảm sáng Aura và đặt cấu hình quạt ở chế độ tiết kiệm năng lượng. Bạn cũng có thể chuyển đổi cài đặt Tiết kiệm năng lượng được tích hợp trong Microsoft Windows.&lt;/p&gt;', 'product-ebf95862-d5a1-428a-950d-175791785654.png', 0, 0, '0', '2024-07-25 06:13:43', '2024-07-25 06:13:43', NULL),
(19, 6, 'Mainboard Gigabyte Z690M Aorus Elite DDR4', 'Gigabyte', '&lt;ul&gt;&lt;li&gt;CPU : Intel Socket 1700 Gen 12th Intel Core Series&lt;/li&gt;&lt;li&gt;Chipset: Intel Z690&lt;/li&gt;&lt;li&gt;Thiết kế VRM 12+1+2&amp;nbsp; Digital VRM&lt;/li&gt;&lt;li&gt;Bộ nhớ: 4 x DIMM, Max. 128GB, DDR4&lt;/li&gt;&lt;li&gt;LAN: Fast 2.5GbE LAN&lt;/li&gt;&lt;li&gt;Thiết kế PCIe 5.0, 3x Ultra-Fast NVMe PCIe 4.0/3.0 x4 M.2 với Giáp tản nhiệt&lt;/li&gt;&lt;li&gt;USB 3.2 Gen2x2 TYPE-C, RGB FUSION 2.0, Q-Flash Plus&lt;/li&gt;&lt;li&gt;Kích thước: Micro ATX (24.4cm x 24.4cm)&lt;/li&gt;&lt;/ul&gt;', 'product-56f3086c-7ac0-4c2b-929f-11eece8a5e49.png', 3490000, 0, '0', '2024-07-25 06:15:26', '2024-07-25 06:19:10', NULL),
(20, 6, 'Mainboard MSI B760M Gaming Plus WiFi', 'MSI', '&lt;p&gt;&lt;span style=&quot;color:rgb(255,0,0);&quot;&gt;&lt;strong&gt;⚙ THÔNG SỐ CƠ BẢN:&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;&lt;ul&gt;&lt;li&gt;Support Intel&lt;sup&gt;®&lt;/sup&gt;&amp;nbsp;Core™ 14th/ 13th/ 12th Gen Processors, Intel&lt;sup&gt;®&lt;/sup&gt;&amp;nbsp;Pentium&lt;sup&gt;®&lt;/sup&gt;&amp;nbsp;Gold and Celeron&lt;sup&gt;®&lt;/sup&gt;&amp;nbsp;Processors for LGA 1700 socket&lt;/li&gt;&lt;li&gt;Supports DDR5 Memory, Dual Channel DDR5 6800+MHz (OC)&lt;/li&gt;&lt;li&gt;Enhanced Power Design: 12+1 Duet Rail Power System with P-PAK, 8-pin + 4-pin CPU power connectors, Core Boost, Memory Boost&lt;/li&gt;&lt;li&gt;Premium Thermal Solution: Extended Heatsink, MOSFET thermal pads rated for 7W/mK, additional choke thermal pads are built for high performance system and non-stop gaming experience&lt;/li&gt;&lt;li&gt;Lightning Fast Game experience: PCIe 4.0 slot, Lightning Gen 4 x4 M.2 with M.2 Shield Frozr, USB 3.2 Gen 2 10G&lt;/li&gt;&lt;li&gt;2.5G LAN with Wi-Fi 6E Solution: Upgraded network solution for professional and multimedia use. Delivers a secure, stable and fast network connection&lt;/li&gt;&lt;li&gt;High Quality PCB: 6-layer PCB made by 2oz thickened copper&lt;/li&gt;&lt;li&gt;Audio Boost: Reward your ears with studio grade sound quality for the most immersive gaming experience&lt;/li&gt;&lt;/ul&gt;', 'product-947642f0-6ac2-45b1-ad09-c6be7c6fa243.jpg', 3699999, 0, '6', '2024-07-25 06:17:16', '2024-08-15 07:26:33', NULL),
(21, 5, 'Ram Kingston Fury Beast 16GB | 1x16GB, DDR5, 5600MHz', 'Kingston', '&lt;p&gt;&lt;span style=&quot;color:rgb(255,0,0);&quot;&gt;&lt;strong&gt;⚙ THÔNG SỐ CƠ BẢN:&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;&lt;ul&gt;&lt;li&gt;Dung lượng: 16GB&lt;/li&gt;&lt;li&gt;Bus: 5600 Mhz&lt;/li&gt;&lt;li&gt;Điện áp: 1.25V&lt;/li&gt;&lt;li&gt;Cải thiện độ ổn định để ép xung&lt;/li&gt;&lt;li&gt;Nâng cao hiệu suất&lt;/li&gt;&lt;li&gt;Được chứng nhận Intel® XMP 3.0&lt;/li&gt;&lt;li&gt;Được chứng nhận AMD EXPO™&lt;/li&gt;&lt;li&gt;Được chứng nhận bởi các nhà sản xuất bo mạch chủ hàng đầu thế giới&lt;/li&gt;&lt;li&gt;Thiết kế bộ tản nhiệt đơn giản theo tông màu đen hoặc trắng&lt;/li&gt;&lt;li&gt;Tương thích với AMD Ryzen™&lt;/li&gt;&lt;/ul&gt;', 'product-1f0ba233-1344-4e8b-987c-aea20a77aedc.jpg', 1422000, 1360000, '5', '2024-07-25 06:20:54', '2024-08-15 08:03:30', NULL),
(22, 6, 'PC Ram PC Corsair Vengeance RGB RS 64GB DDR4 3200', 'Corsair', '&lt;p&gt;&lt;span style=&quot;color:rgb(255,0,0);&quot;&gt;&lt;strong&gt;⚙ THÔNG SỐ SẢN PHẨM:&lt;/strong&gt;&lt;/span&gt;&lt;br&gt;&amp;nbsp;&lt;/p&gt;&lt;ul&gt;&lt;li&gt;Dung lượng: 64GB (2x32GB)&lt;/li&gt;&lt;li&gt;Bus: 3200MHz&lt;/li&gt;&lt;li&gt;Độ trễ: 16-20-20-38&lt;/li&gt;&lt;li&gt;Điện áp: 1.35V&lt;/li&gt;&lt;li&gt;Tản nhiệt: Có&lt;/li&gt;&lt;/ul&gt;', 'product-6a270787-52fb-4d9c-be12-2294e512a26a.jpg', 3755000, 0, '1', '2024-07-25 06:22:06', '2025-03-23 01:23:14', NULL),
(23, 9, 'Lap top Ram GSkill Trident Z5 RGB 64GB | 32GB x 2, DDR5, 5600MHz', 'GSkill', '&lt;p&gt;&lt;span style=&quot;color:rgb(255,0,0);&quot;&gt;&lt;strong&gt;⚙ THÔNG SỐ CƠ BẢN:&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;&lt;ul&gt;&lt;li&gt;&lt;strong&gt;Dung lượng:&lt;/strong&gt; 64GB | 32GB x 2&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Bus:&lt;/strong&gt; DDR5 5600MHz&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Độ trễ:&lt;/strong&gt; CL30-36-36-89 1.25V&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Tản nhiệt:&lt;/strong&gt; Có&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Số thanh:&lt;/strong&gt; 2 thanh&lt;/li&gt;&lt;li&gt;&lt;strong&gt;LED:&lt;/strong&gt; RGB&lt;/li&gt;&lt;/ul&gt;', 'product-e76e7bf4-046a-4f63-81e3-e387e2ee3d7b.jpg', 0, 0, '0', '2024-07-25 06:23:31', '2025-03-23 01:22:31', NULL),
(24, 7, 'Bàn phím cơ Asus ROG Azoth Wireless NX Snow switch', 'ROG', '&lt;p&gt;&lt;span style=&quot;color:rgb(255,0,0);&quot;&gt;&lt;strong&gt;⚙ THÔNG SỐ SẢN PHẨM:&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;&lt;h2 style=&quot;text-align:center;&quot;&gt;&lt;span style=&quot;color:rgb(51,102,255);&quot;&gt;&lt;strong&gt;Bàn phím cơ Asus ROG Azoth Wireless NX Red switch&lt;/strong&gt;&lt;/span&gt;&lt;/h2&gt;&lt;h2 style=&quot;text-align:center;&quot;&gt;&lt;span style=&quot;color:rgb(51,102,255);&quot;&gt;&lt;strong&gt;Vượt qua giới hạn&lt;/strong&gt;&lt;/span&gt;&lt;/h2&gt;&lt;p&gt;&amp;nbsp;&lt;a href=&quot;https://www.anphatpc.com.vn/ban-phim-co-asus-rog-azoth-wireless-nx-red-switch.html&quot;&gt;&lt;span style=&quot;color:rgb(51,102,255);&quot;&gt;&lt;strong&gt;Asus ROG Azoth Wireless NX Red switch&lt;/strong&gt;&lt;/span&gt;&lt;/a&gt;&amp;nbsp;là chiếc&amp;nbsp;&lt;a href=&quot;https://www.anphatpc.com.vn/ban-phim-co-choi-game.html&quot;&gt;&lt;span style=&quot;color:rgb(51,102,255);&quot;&gt;bàn phím cơ chơi Game&lt;/span&gt;&lt;/a&gt; không dây Custom đầu tiên mới được Asus ROG cho ra mắt. Mang ngoại hình chuẩn Gaming, chất lượng Build siêu hạng cùng nhiều ưu điểm nổi trội khác, chiếc bàn phím này xứng đáng nằm trong Top phím ngon nhất dành cho anh em Game thủ.&lt;/p&gt;&lt;h2 style=&quot;text-align:center;&quot;&gt;&lt;span style=&quot;color:rgb(51,102,255);&quot;&gt;&lt;strong&gt;Kết nối 3 chế độ&lt;/strong&gt;&lt;/span&gt;&lt;/h2&gt;&lt;p&gt;&lt;strong&gt;Asus ROG Azoth Wireless NX Red switch&lt;/strong&gt;&amp;nbsp;mang tới 3 chế độ kết nối: USB, Bluetooth và kết nối không dây băng tần 2,4GGHz. Sử dụng công nghệ không dây ROG SpeedNova mang đến hơn 2.000 giờ chơi game ổn định, không gián đoạn với độ trễ gần như bằng 0 ở chế độ RF 2,4 GHz (tắt RGB và OLED).&amp;nbsp;Ngoài ra, bạn có thể sử dụng chế độ Bluetooth để kết nối với tối đa ba thiết bị cùng lúc hoặc vừa sạc vừa sử dụng cùng lúc bằng dây kết nối USB.&lt;/p&gt;&lt;p style=&quot;text-align:center;&quot;&gt;&lt;img src=&quot;https://anphat.com.vn/media/lib/25-03-2023/sobv.png&quot; alt=&quot;&quot;&gt;&lt;/p&gt;&lt;h2 style=&quot;text-align:center;&quot;&gt;&lt;span style=&quot;color:rgb(51,102,255);&quot;&gt;&lt;strong&gt;Cấu trúc Gasket Mount cao cấp nhất&lt;/strong&gt;&lt;/span&gt;&lt;/h2&gt;&lt;p&gt;Bàn phím cơ Asus ROG Azoth Wireless sở hữu thiết kế&amp;nbsp;Gasket Mount cao cấp với những miếng đệm Silicon mang lại cảm giác gõ phím nhẹ nhàng và dễ chịu.&lt;/p&gt;&lt;p&gt;Ở phía dưới là miếng đệm silicon dày 3,5 mm kết hợp với lớp PORON Foam hấp thụ âm thanh, cho bạn trải nghiệm gõ phím êm ái nhất có thể.&amp;nbsp;&lt;/p&gt;&lt;p&gt;Cuối cùng là phần vỏ đế&amp;nbsp;được lót bằng bọt silicon giúp loại bỏ hoàn toàn tiếng vang và đảm bảo bề mặt phẳng cho bọt PORON®.&lt;/p&gt;', 'product-e462df93-3afd-41b0-bb40-cacacb4ab065.jpg', 850000, 0, '1', '2024-07-25 06:24:55', '2025-03-23 01:18:46', NULL),
(25, 7, 'Bàn phím cơ DareU EK87 Pro', 'DAREU', '&lt;p&gt;&lt;span style=&quot;color:rgb(255,0,0);&quot;&gt;&lt;strong&gt;⚙ THÔNG SỐ CƠ BẢN:&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;&lt;h2 style=&quot;text-align:center;&quot;&gt;&lt;span style=&quot;color:rgb(51,102,255);&quot;&gt;&lt;strong&gt;Bàn phím cơ DareU EK87 Pro&lt;/strong&gt;&lt;/span&gt;&lt;/h2&gt;&lt;p&gt;&lt;a href=&quot;https://www.anphatpc.com.vn/ban-phim-co-dareu-ek87-pro-triple-mode-proto-dareu-dream-switch.html&quot;&gt;&lt;span style=&quot;color:rgb(51,102,255);&quot;&gt;&lt;strong&gt;Bàn phím cơ DareU EK87 Pro&lt;/strong&gt;&lt;/span&gt;&lt;/a&gt;&amp;nbsp;là mẫu&amp;nbsp;&lt;a href=&quot;https://www.anphatpc.com.vn/ban-phim-co-choi-game.html&quot;&gt;&lt;span style=&quot;color:rgb(51,102,255);&quot;&gt;bàn phím cơ&lt;/span&gt;&lt;/a&gt;&amp;nbsp;Layout 87 cực kỳ đáng sở hữu ở thời điểm hiện tại với chất lượng Build tốt, trải nghiệm gõ êm ái và kết nối không dây cực kỳ tiện lợi. Cùng tìm hiểu ngay về mẫu&amp;nbsp;&lt;a href=&quot;https://www.anphatpc.com.vn/ban-phim-dareu.html&quot;&gt;&lt;span style=&quot;color:rgb(51,102,255);&quot;&gt;bàn phím DareU&lt;/span&gt;&lt;/a&gt;&amp;nbsp;này qua bài viết ngay dưới đây của An Phát Computer.&lt;/p&gt;&lt;h3 style=&quot;text-align:center;&quot;&gt;&lt;span style=&quot;color:rgb(51,102,255);&quot;&gt;&lt;strong&gt;Cấu trúc Gasket Mount tốt nhất&lt;/strong&gt;&lt;/span&gt;&lt;/h3&gt;&lt;p&gt;Gasket Mount luôn là sự lựa chọn tốt nhất cho bất kỳ mẫu phím cơ nào. Cấu trúc này giúp giảm thiểu tiếng ồn trong khoang phím để bạn có được trải nghiệm gõ phím mềm mại và êm ái hơn.&lt;/p&gt;&lt;figure class=&quot;image&quot;&gt;&lt;img src=&quot;https://anphat.com.vn/media/lib/07-08-2024/ban-phim-co-ek-87-pro-3.jpg&quot; alt=&quot;Bàn phím cơ DareU EK87 Pro Gasket Mount&quot;&gt;&lt;/figure&gt;&lt;h3 style=&quot;text-align:center;&quot;&gt;&lt;span style=&quot;color:rgb(51,102,255);&quot;&gt;&lt;strong&gt;Hotswap 5 Pin mạch xuôi&lt;/strong&gt;&lt;/span&gt;&lt;/h3&gt;&lt;p&gt;&lt;strong&gt;DareU EK87 Pro&amp;nbsp;&lt;/strong&gt;trang bị mạch hotswap 5 pin, cho phép bạn dễ dàng thay thế và sử dụng bất cứ dòng Switch nào trên thị trường.&amp;nbsp;Cấu trúc mạch xuôi cao cấp cho cảm giác gõ tốt nhất đồng thời giúp bộ phím sẽ không bị cấn khi bạn lắp đặt những bộ Keycap cherry profile.&amp;nbsp;&lt;/p&gt;', 'product-22320247-d702-41e0-bca6-031c60f9c80b.png', 2439000, 0, '0', '2024-07-25 06:26:37', '2025-03-23 01:17:27', NULL),
(26, 7, 'Bàn phím cơ DareU EK106 Pro', 'DAREU', '&lt;p&gt;&lt;span style=&quot;color:rgb(255,0,0);&quot;&gt;&lt;strong&gt;⚙ THÔNG SỐ CƠ BẢN:&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;&lt;h2 style=&quot;text-align:center;&quot;&gt;&lt;span style=&quot;color:rgb(51,102,255);&quot;&gt;&lt;strong&gt;Bàn phím cơ DareU EK106 Pro&lt;/strong&gt;&lt;/span&gt;&lt;/h2&gt;&lt;p&gt;Kế tiếp sự thành công từ phiên bản EK98, bàn phím cơ&amp;nbsp;&lt;a href=&quot;https://www.anphatpc.com.vn/ban-phim-co-dareu-ek106-pro-triple-mode-black-golden-dareu-cloud-switch.html&quot;&gt;&lt;span style=&quot;color:rgb(51,102,255);&quot;&gt;&lt;strong&gt;DareU EK106 Pro&lt;/strong&gt;&lt;/span&gt;&lt;/a&gt;&amp;nbsp;là chiếc&amp;nbsp;&lt;a href=&quot;https://www.anphatpc.com.vn/ban-phim-co-choi-game.html&quot;&gt;&lt;span style=&quot;color:rgb(51,102,255);&quot;&gt;bàn phím cơ&lt;/span&gt;&lt;/a&gt;&amp;nbsp;Layout 106 tuyệt vời dành cho những ai đang tìm kiếm một chiếc bàn phím Full Size có 3 Mode kết nối&amp;nbsp;tiện lợi và trải nghiệm gõ êm ái. Cùng tìm&amp;nbsp;hiểu&amp;nbsp;ngay về mẫu&amp;nbsp;&lt;a href=&quot;https://www.anphatpc.com.vn/ban-phim-dareu.html&quot;&gt;&lt;span style=&quot;color:rgb(51,102,255);&quot;&gt;bàn phím DareU&lt;/span&gt;&lt;/a&gt;&amp;nbsp;này qua bài viết ngay dưới đây của An Phát Computer.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;span style=&quot;color:rgb(51,102,255);&quot;&gt;&lt;strong&gt;Hỗ trợ 3 Mode kết nối&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;Bàn phím cơ DareU EK106 Pro&lt;/strong&gt;&amp;nbsp;mang đến sự linh hoạt tối đa với ba tùy chọn kết nối: không dây 2.4 Ghz, Bluetooth và có dây USB. Kết nối WIreless 2.4Ghz mang lại trải nghiệm không dây siêu tốc không độ trễ, kết nối Bluetooth mang lại khả năng kết nối với mọi thiết bị mà không cần USB Receiver và kết nối dây USB mang tới sự ổn định, tốc độ phản hồi nhanh nhất và cho phép vừa sạc vừa sử dụng. Bạn có thể linh hoạt thay đổi các Mode kết nối bằng phần nút gạt ở phía cạnh trái bàn phím.&lt;/p&gt;', 'product-c8e84815-aa9d-44b6-8cc2-dd5a7393f105.jpg', 4550000, 0, '2', '2024-07-25 06:29:38', '2025-03-23 01:15:34', NULL),
(27, 6, 'Chuột Asus TUF M3 Gen 2', 'TUF', '&lt;p&gt;&lt;span style=&quot;color:rgb(255,0,0);&quot;&gt;&lt;strong&gt;⚙ THÔNG SỐ SẢN PHẨM:&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;&lt;h2 style=&quot;text-align:center;&quot;&gt;&lt;span style=&quot;color:rgb(51,102,255);&quot;&gt;&lt;strong&gt;Chuột Asus TUF M3 Gen 2&lt;/strong&gt;&lt;/span&gt;&lt;/h2&gt;&lt;p&gt;&lt;strong&gt;Chuột Asus TUF M3 Gen 2&lt;/strong&gt; là phiên bản mới được nâng cấp từ siêu phẩm TUF M3 đã quá quen thuộc với anh em Game thủ. Thiết kế công thái học siêu nhẹ, độ bền ấn tượng cùng cảm biến siêu nhạy, ASUS TUF M3 Gen 2 nổi bật lên là&amp;nbsp;mẫu&amp;nbsp;&lt;a href=&quot;https://www.anphatpc.com.vn/chuot-choi-game.html&quot;&gt;&lt;span style=&quot;color:rgb(51,102,255);&quot;&gt;chuột Gaming&lt;/span&gt;&lt;/a&gt; ngon nhất trong tầm giá. Cùng &lt;strong&gt;An Phát Computer&lt;/strong&gt; điểm qua những điểm đáng chú ý của mẫu&amp;nbsp;&lt;a href=&quot;https://www.anphatpc.com.vn/chuot-asus.html&quot;&gt;&lt;span style=&quot;color:rgb(51,102,255);&quot;&gt;chuột Asus&lt;/span&gt;&lt;/a&gt; này ngay qua bài viết dưới đây.&lt;/p&gt;&lt;figure class=&quot;image image_resized&quot; style=&quot;width:83.69%;&quot;&gt;&lt;img src=&quot;https://anphat.com.vn/media/lib/23-06-2023/tufm3gen210.jpg&quot; alt=&quot;&quot;&gt;&lt;/figure&gt;&lt;h2 style=&quot;text-align:center;&quot;&gt;&lt;span style=&quot;color:rgb(51,102,255);&quot;&gt;&lt;strong&gt;Trọng lượng siêu nhẹ, thiết kế công thái học thoải mái&lt;/strong&gt;&lt;/span&gt;&lt;/h2&gt;&lt;p&gt;Phiên bản thứ 2 của TUF M3 vẫn mang form cầm công thái học thoải mái giống như phiên bản trước. Nó cũng đã được tối ưu về trọng lượng, TUF M3 Gen 2 nhỏ gọn và nhẹ chỉ 59 gram - nhẹ hơn phiên bản trước tới 30%.&lt;/p&gt;', 'product-2c806f35-ddf4-4d95-a462-eef63f6020e3.jpg', 1120000, 0, '2', '2024-07-25 06:31:22', '2025-03-23 01:14:01', NULL),
(28, 6, 'Turtle Beach Recon Wired Gaming Controller', 'MSI', '&lt;p&gt;&lt;span style=&quot;color:rgb(255,0,0);&quot;&gt;&lt;strong&gt;⚙ THÔNG SỐ CƠ BẢN:&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;&lt;ul&gt;&lt;li&gt;&lt;strong&gt;Graphic Engine:&lt;/strong&gt; GeForce RTX 4070 Super&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Bộ nhớ:&lt;/strong&gt; 12GB GDDR6X&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Giao diện bộ nhớ:&lt;/strong&gt; 192-bit&lt;/li&gt;&lt;li&gt;&lt;strong&gt;PSU khuyến nghị:&lt;/strong&gt; 650W&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;Lorem ipsum dolor sit amet consectetur adipiscing diam tortor sit feugiat dictum eu diam euismod ultrices convallis eget vel velit posuere mi consequat leo egestas sed odio molestie non imperdiet malesuada.&lt;/p&gt;&lt;h2&gt;Take Control&lt;/h2&gt;&lt;p&gt;There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don’t look even slightly believable.&lt;br&gt;&amp;nbsp;&lt;/p&gt;', 'product-17eeee83-921d-4d4f-bb96-9c8ee84daa34.jpg', 17200000, 17100000, '20', '2024-07-25 06:32:38', '2025-03-23 02:01:25', NULL),
(29, 4, 'Ghế game E-Dra Wisdom EGC231 Fabric', 'E-Dra', '&lt;p&gt;&lt;strong&gt;MÔ TẢ SẢN PHẨM&lt;/strong&gt;&lt;/p&gt;&lt;h2 style=&quot;text-align:center;&quot;&gt;&lt;span style=&quot;color:rgb(51,102,255);&quot;&gt;&lt;strong&gt;Ghế game E-Dra Wisdom EGC231 Fabric&lt;/strong&gt;&lt;/span&gt;&lt;/h2&gt;&lt;p&gt;&lt;strong&gt;E-Dra Wisdom EGC231&lt;/strong&gt;&amp;nbsp;là mẫu&amp;nbsp;&lt;a href=&quot;https://www.anphatpc.com.vn/ghe-choi-game.html&quot;&gt;&lt;span style=&quot;color:rgb(51,102,255);&quot;&gt;ghế Gaming&lt;/span&gt;&lt;/a&gt;&amp;nbsp;cao cấp dành cho Game thủ vừa được E-Dra cho ra mắt. Kích thước lớn cùng bộ khung vững chắc, EGC231 mang lại trải nghiệm sử dụng thoải mái nhất tới anh em Game thủ. Cùng tìm hiểu ngay về mẫu&amp;nbsp;&lt;a href=&quot;https://www.anphatpc.com.vn/ghe-e-dra.html&quot;&gt;&lt;span style=&quot;color:rgb(51,102,255);&quot;&gt;ghế E-Dra&lt;/span&gt;&lt;/a&gt;&amp;nbsp;này ngay qua bài viết dưới đây.&lt;/p&gt;&lt;p&gt;&lt;strong&gt;E-Dra Wisdom EGC231&lt;/strong&gt;&lt;span style=&quot;background-color:rgb(255,255,255);color:rgb(51,51,51);&quot;&gt;&amp;nbsp;được thiết kế với Form lớn, đặc biệt ngon đối với những người cao và nặng.Theo như thông tin từ hãng, EGC231 hỗ trợ tốt nhất cho người cao từ 1m40 tới 1m75 và tối đa lên tới 1m80.&lt;/span&gt;&lt;/p&gt;&lt;h2 style=&quot;text-align:center;&quot;&gt;&lt;span style=&quot;color:rgb(51,102,255);&quot;&gt;&lt;strong&gt;Vật liệu Fabric cao cấp&lt;/strong&gt;&lt;/span&gt;&lt;/h2&gt;&lt;p&gt;Phiên bản&amp;nbsp;E-Dra Wisdom EGC231 sử dụng chất liệu bọc vải Fabric mang tới người dùng sự&amp;nbsp;cảm giác thoáng mát và mềm mại trong quá trình sử dụng. Vải Fabric cũng có khả năng chống nước tốt, không bị ám mùi mồ hôi khó chịu.&lt;/p&gt;', 'product-6306989a-7abc-4644-9e3b-8d07a9431fc8.jpg', 2690000, 0, '1', '2024-07-25 06:35:01', '2025-03-22 20:54:44', NULL),
(30, 5, 'Tai nghe Logitech G733 LIGHTSPEED', 'Logitech', '&lt;p&gt;&lt;span style=&quot;color:rgb(255,0,0);&quot;&gt;&lt;strong&gt;⚙ THÔNG SỐ SẢN PHẨM&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;&lt;h2 style=&quot;text-align:center;&quot;&gt;&lt;span style=&quot;color:rgb(255,0,0);&quot;&gt;CÔNG NGHỆ KHÔNG DÂY LIGHTSPEED SIÊU CAO CẤP&lt;/span&gt;&lt;/h2&gt;&lt;p&gt;&lt;span style=&quot;color:rgb(255,0,0);&quot;&gt;&lt;strong&gt;LightSpeed là công nghệ không dây tiên tiên nhất trên thế giới&lt;/strong&gt;&lt;/span&gt; do chính Logitech nghiên cứu và phát triển, đã được ứng dụng rất nhiều trên các loại chuột gaming không dây cao cấp. Và nay, lần đầu tiên được ứng dụng cho&amp;nbsp;&lt;a href=&quot;https://www.anphatpc.com.vn/tai-nghe-choi-game_dm1258.html&quot;&gt;&lt;span style=&quot;color:rgb(0,0,255);&quot;&gt;&lt;strong&gt;tai nghe gaming&lt;/strong&gt;&lt;/span&gt;&lt;/a&gt; với phiên bản &lt;span style=&quot;color:rgb(0,128,0);&quot;&gt;&lt;strong&gt;Logitech G733 LightSpeed Wireless&lt;/strong&gt;&lt;/span&gt;. Nhờ công nghệ này, &lt;span style=&quot;color:rgb(0,128,0);&quot;&gt;&lt;strong&gt;Logitech G733 LightSpeed Wireless&lt;/strong&gt;&lt;/span&gt; có khả năng kết &lt;span style=&quot;color:rgb(255,0,0);&quot;&gt;&lt;strong&gt;nối ổn định và gần như không có độ trễ&lt;/strong&gt;&lt;/span&gt;, đặc biệt &lt;span style=&quot;color:rgb(255,0,0);&quot;&gt;&lt;strong&gt;phạm vi hoạt động lên tới 20m&lt;/strong&gt;&lt;/span&gt; (so với khoảng 10m với công nghệ thông thường).&lt;/p&gt;&lt;h2 style=&quot;text-align:center;&quot;&gt;&lt;span style=&quot;color:rgb(255,0,0);&quot;&gt;HẤT LƯỢNG ÂM THANH ĐỈNH CAO&lt;/span&gt;&lt;/h2&gt;&lt;p&gt;Với &lt;span style=&quot;color:rgb(255,0,0);&quot;&gt;&lt;strong&gt;màng loa G-Pro&lt;/strong&gt;&lt;/span&gt; thế hệ mới nhất, chất lượng âm thanh của &lt;span style=&quot;color:rgb(0,128,0);&quot;&gt;&lt;strong&gt;Logitech G733 LightSpeed Wireless&lt;/strong&gt;&lt;/span&gt; là tuyệt vời. &lt;span style=&quot;color:rgb(255,0,0);&quot;&gt;&lt;strong&gt;&quot;Trong suốt như pha lê&quot;&lt;/strong&gt;&lt;/span&gt; chính xác để mô tả về sự rõ ràng và chi tiết của &lt;span style=&quot;color:rgb(0,128,0);&quot;&gt;&lt;strong&gt;Logitech G733&lt;/strong&gt;&lt;/span&gt;. Tai nghe còn được ứng dụng công nghệ &lt;span style=&quot;color:rgb(255,0,0);&quot;&gt;&lt;strong&gt;7.1 DTS Headphone 2.0 X rất cao cấp&lt;/strong&gt;&lt;/span&gt;, tạo ra thứ âm thanh vòm chính xác hơn, sống động và trung thực hơn. Micro của &lt;span style=&quot;color:rgb(0,128,0);&quot;&gt;&lt;strong&gt;Logitech G733 LightSpeed Wireless&lt;/strong&gt;&lt;/span&gt; đạt chứng nhận Discord. Cụ thể hơn:&lt;/p&gt;&lt;p&gt;&amp;nbsp;&lt;/p&gt;&lt;h3 style=&quot;text-align:center;&quot;&gt;&lt;span style=&quot;color:rgb(255,0,0);&quot;&gt;TUYỆT VỜI CHO TẤT CẢ NHU CẦU PHIM - GAME - NHẠC&lt;/span&gt;&lt;/h3&gt;&lt;p&gt;Với cả game và nhạc, &lt;span style=&quot;color:rgb(0,128,0);&quot;&gt;&lt;strong&gt;Logitech G733 LightSpeed Wireless&lt;/strong&gt;&lt;/span&gt; đều thể hiện xuất sắc, đặc biệt là âm trầm với &lt;span style=&quot;color:rgb(255,0,0);&quot;&gt;&lt;strong&gt;màng loa G-Pro tạo ra từ vật liệu vải lưới hybrid độc đáo&lt;/strong&gt;&lt;/span&gt;, cho âm thanh căng tròn, rõ ràng chi tiết và có độ méo rất thấp. Âm thanh sẽ sống động như rạp chiều phim.&lt;br&gt;&amp;nbsp;&lt;/p&gt;', 'product-56e733f2-388b-4422-8f89-4dd75b378afc.jpg', 2580000, 0, '12', '2024-07-25 06:35:58', '2025-03-23 02:01:15', NULL),
(31, 8, 'Màn Hình Gaming ASUS TUF VG249Q3A', 'ASUS', '&lt;p&gt;&lt;span style=&quot;color:rgb(255,0,0);&quot;&gt;&lt;strong&gt;⚙ THÔNG SỐ CƠ BẢN:&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;&lt;ul&gt;&lt;li&gt;The new Smart Device V2 with faster microprocessor with two RGB LED strips&lt;/li&gt;&lt;li&gt;USB 3.1 Gen2-compatible USB-C connector on front panel&lt;/li&gt;&lt;li&gt;Iconic cable management bar and uninterrupted tempered-glass side panel&lt;/li&gt;&lt;li&gt;Cable routing kit with pre-installed channels and straps&lt;/li&gt;&lt;li&gt;Two Aer F120mm fans&lt;/li&gt;&lt;li&gt;Front panel and PSU intakes includes removable filters&lt;/li&gt;&lt;li&gt;Includes a removeable bracket designed for radiators up to 240mm that simplifies the installation of either closed-loop or custom-loop water cooling&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;&lt;br&gt;&amp;nbsp;&lt;/p&gt;', 'product-63197fe8-f3ca-44ab-b9c2-18d587bd3fac.jpg', 4990000, 4599000, '9', '2024-07-25 06:36:53', '2025-03-23 01:37:32', NULL),
(32, 9, 'Laptop Gaming Acer Aspire 7 A715-76G-5806', 'Acer', '&lt;p&gt;&lt;span style=&quot;color:rgb(255,0,0);&quot;&gt;&lt;strong&gt;⚙ THÔNG SỐ SẢN PHẨM&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;&lt;ul&gt;&lt;li&gt;Hãng sản xuất: Acer&lt;br&gt;&amp;nbsp;&lt;/li&gt;&lt;li&gt;Bảo hành: 24 Tháng&lt;br&gt;&amp;nbsp;&lt;/li&gt;&lt;li&gt;Màu sắc: Trắng&lt;br&gt;&amp;nbsp;&lt;/li&gt;&lt;li&gt;Chất liệu: Thép SGCC, kính cường lực&lt;br&gt;&amp;nbsp;&lt;/li&gt;&lt;li&gt;Trọng lượng: 7.01 kg&lt;br&gt;&amp;nbsp;&lt;/li&gt;&lt;li&gt;Hỗ trợ Mainboad: Mini-ITX, Micro-ATX, ATX&lt;br&gt;&amp;nbsp;&lt;/li&gt;&lt;li&gt;Kích thước: H: 464 mm, W: 227 mm, D: 446 mm&lt;br&gt;&amp;nbsp;&lt;/li&gt;&lt;li&gt;Kích thước chuẩn: Mid Tower&lt;br&gt;&amp;nbsp;&lt;/li&gt;&lt;li&gt;Hỗ trợ CPU tối đa: 165 mm&lt;br&gt;&amp;nbsp;&lt;/li&gt;&lt;li&gt;Hỗ trợ GPU tối đa: 365 mm&lt;br&gt;&amp;nbsp;&lt;/li&gt;&lt;li&gt;Quạt và khe tản nhiệt: Trước: 45mm, Trên nóc: 30mm&lt;/li&gt;&lt;/ul&gt;', 'product-62aa8c2f-1c85-4d56-a5f7-301bac1182ba.jpg', 22580000, 21490000, '19', '2024-07-25 06:39:13', '2025-03-23 02:00:08', NULL),
(33, 9, 'Laptop gaming Gigabyte G5 MF5 H2VN353KH', 'Gigabyte', '&lt;p&gt;&lt;span style=&quot;color:rgb(255,0,0);&quot;&gt;&lt;strong&gt;⚙ THÔNG SỐ CƠ BẢN:&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;&lt;ul&gt;&lt;li&gt;&lt;strong&gt;Sản phẩm chỉ bán kèm RAM DDR5 32GB&lt;/strong&gt;&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Intel&lt;sup&gt;®&lt;/sup&gt;&amp;nbsp;Socket LGA 1700：&lt;/strong&gt;Support 13th and 12th Gen Series Processors&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Unparalleled Performance：&lt;/strong&gt;Hybrid 8+1+1 Phases Digital VRM Solution&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Dual Channel DDR5：&lt;/strong&gt;4*DIMMs XMP Memory Module Support&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Next Generation Storage：&lt;/strong&gt;2*PCIe 4.0 x4 M.2 Connectors&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Advanced Thermal Design &amp;amp; M.2 Thermal Guard：&lt;/strong&gt;To Ensure VRM Power Stability &amp;amp; M.2 SSD Performance&lt;/li&gt;&lt;li&gt;&lt;strong&gt;EZ-Latch：&lt;/strong&gt;PCIe 4.0x16 Slot with Quick Release Design&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Fast Networks：&lt;/strong&gt;2.5GbE LAN &amp;amp; Wi-Fi 6E 802.11ax&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Extended Connectivity：&lt;/strong&gt;Front USB-C&lt;sup&gt;®&lt;/sup&gt;&amp;nbsp;10Gb/s, DP, HDMI&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Smart Fan 6：&lt;/strong&gt;Features Multiple Temperature Sensors, Hybrid Fan Headers with FAN STOP&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Q-Flash Plus：&lt;/strong&gt;Update BIOS Without Installing the CPU, Memory and Graphics Card&lt;/li&gt;&lt;/ul&gt;', 'product-d45803ea-e5c8-4f82-8c5d-7c4f5179482d.jpg', 12000000, 11490000, '4', '2024-08-14 06:47:39', '2025-03-23 01:59:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `table_product_type`
--

CREATE TABLE `table_product_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `table_product_type`
--

INSERT INTO `table_product_type` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 'Ghế - Bàn', '2024-07-25 05:54:50', '2025-03-22 20:43:47', NULL),
(5, 'Tai nghe', '2024-07-25 05:54:56', '2025-03-22 20:43:31', NULL),
(6, 'Chuột - Lót chuột', '2024-07-25 05:55:06', '2025-03-22 20:43:20', NULL),
(7, 'Bàn phím', '2024-07-25 05:55:10', '2025-03-22 20:43:02', NULL),
(8, 'Màn Hình', '2024-07-25 05:55:19', '2025-03-22 20:42:45', NULL),
(9, 'Laptop Gaming', '2024-07-25 05:55:27', '2025-03-22 20:42:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `table_user`
--

CREATE TABLE `table_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(16) DEFAULT 'user',
  `name` varchar(255) DEFAULT NULL,
  `gender` int(11) NOT NULL DEFAULT 0,
  `birthday` date DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `table_user`
--

INSERT INTO `table_user` (`id`, `role`, `name`, `gender`, `birthday`, `email`, `phone`, `address`, `avatar`, `username`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(11, 'admin', 'Tong Quoc anh', 1, '2010-01-02', 'anh@tong.local', '0937552224', '41', NULL, 'anh', '$2y$10$RPvpWj0jUFR5mx34tztUWOREGE.4Pd2kLpabK2H2KtX53Zl8rM.xC', NULL, '2025-03-22 19:12:29', '2025-03-22 19:12:29', NULL),
(12, 'user', 'Tong Quoc anh', 1, '2010-01-02', 'atong@gmail.com', '0937552224', '325', 'avatar-78923170-c0a7-4230-bd1e-812a2cde7e24.jpg', 'tongquocanh', '$2y$10$DLtcP9TM8B.GbDcUMT3McOvAJSKl/8cfchKvw6WQPfP.sdXSkmBh2', NULL, '2025-03-23 01:53:21', '2025-03-23 01:59:47', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `table_comment`
--
ALTER TABLE `table_comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `table_comment_id_user_foreign` (`id_user`),
  ADD KEY `table_comment_id_product_foreign` (`id_product`);

--
-- Indexes for table `table_order`
--
ALTER TABLE `table_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `table_order_id_user_foreign` (`id_user`);

--
-- Indexes for table `table_order_detail`
--
ALTER TABLE `table_order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `table_order_detail_id_order_foreign` (`id_order`),
  ADD KEY `table_order_detail_id_product_foreign` (`id_product`);

--
-- Indexes for table `table_product`
--
ALTER TABLE `table_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `table_product_id_type_foreign` (`id_type`);

--
-- Indexes for table `table_product_type`
--
ALTER TABLE `table_product_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_user`
--
ALTER TABLE `table_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `table_comment`
--
ALTER TABLE `table_comment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `table_order`
--
ALTER TABLE `table_order`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `table_order_detail`
--
ALTER TABLE `table_order_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `table_product`
--
ALTER TABLE `table_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `table_product_type`
--
ALTER TABLE `table_product_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `table_user`
--
ALTER TABLE `table_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `table_comment`
--
ALTER TABLE `table_comment`
  ADD CONSTRAINT `table_comment_id_product_foreign` FOREIGN KEY (`id_product`) REFERENCES `table_product` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `table_comment_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `table_user` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `table_order`
--
ALTER TABLE `table_order`
  ADD CONSTRAINT `table_order_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `table_user` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `table_order_detail`
--
ALTER TABLE `table_order_detail`
  ADD CONSTRAINT `table_order_detail_id_order_foreign` FOREIGN KEY (`id_order`) REFERENCES `table_order` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `table_order_detail_id_product_foreign` FOREIGN KEY (`id_product`) REFERENCES `table_product` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `table_product`
--
ALTER TABLE `table_product`
  ADD CONSTRAINT `table_product_id_type_foreign` FOREIGN KEY (`id_type`) REFERENCES `table_product_type` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
