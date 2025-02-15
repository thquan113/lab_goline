-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th2 15, 2025 lúc 04:07 AM
-- Phiên bản máy phục vụ: 8.0.30
-- Phiên bản PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `lab_goline`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `properties`
--

CREATE TABLE `properties` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text,
  `price` decimal(15,2) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `status` enum('available','sold','rented') DEFAULT 'available',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `properties`
--

INSERT INTO `properties` (`id`, `title`, `image`, `description`, `price`, `address`, `city`, `status`, `created_at`) VALUES
(2, 'Nhà phố Thủ Đức', '/public/assets/images/product1.jpeg', 'Nhà phố 2 tầng, gần làng đại học', 2000.00, 'Linh Trung, Thủ Đức', 'Hồ Chí Minh', 'rented', '2025-02-13 07:55:35'),
(3, 'Đất nền Bình Chánh', '/public/assets/images/product1.jpeg', 'Đất nền sổ đỏ chính chủ', 1233.00, 'Đinh Đức Thiện, Bình Chánh', 'Thành phố Hà Nội', 'rented', '2025-02-13 07:55:39'),
(19, 'Luxury Villa with Pool', '/public/assets/images/product1.jpeg', 'A beautiful luxury villa with a private swimming pool and a large garden.', 500000.00, '123 Ocean Drive', 'Los Angeles', 'available', '2025-02-15 03:31:22'),
(20, 'Modern Apartment in Downtown', '/public/assets/images/product1.jpeg', 'A stylish and modern apartment in the heart of downtown.', 250000.00, '45 Central Avenue', 'New York', 'available', '2025-02-15 03:31:22'),
(21, 'Cozy Cottage by the Lake', '/public/assets/images/product1.jpeg', 'A cozy cottage with stunning lake views and a warm fireplace.', 180000.00, '789 Lakeview Road', 'Chicago', 'sold', '2025-02-15 03:31:22'),
(22, 'Spacious Family House', '/public/assets/images/product1.jpeg', 'A large family home with a big backyard and garage.', 320000.00, '321 Elm Street', 'San Francisco', 'available', '2025-02-15 03:31:22'),
(23, 'Beachfront Bungalow', '/public/assets/images/product1.jpeg', 'A beautiful bungalow located right on the beach with ocean views.', 450000.00, '100 Sunset Blvd', 'Miami', 'available', '2025-02-15 03:31:22'),
(24, 'Luxury Penthouse', '/public/assets/images/product1.jpeg', 'An exclusive penthouse with a rooftop terrace and city skyline views.', 750000.00, '67 High Tower', 'New York', 'available', '2025-02-15 03:31:22'),
(25, 'Country Farmhouse', '/public/assets/images/product1.jpeg', 'A rustic farmhouse with farmland, ideal for those who love nature.', 220000.00, '88 Greenfield Drive', 'Texas', 'sold', '2025-02-15 03:31:22'),
(26, 'Elegant Townhouse', '/public/assets/images/product1.jpeg', 'A charming townhouse in a quiet neighborhood with great amenities.', 280000.00, '55 Maple Street', 'Boston', 'available', '2025-02-15 03:31:22'),
(27, 'Modern Loft', '/public/assets/images/product1.jpeg', 'An industrial-style loft with high ceilings and large windows.', 310000.00, '99 Warehouse Lane', 'Seattle', 'available', '2025-02-15 03:31:22'),
(28, 'Small Studio Apartment', '/public/assets/images/product1.jpeg', 'A compact and affordable studio apartment, perfect for singles.', 150000.00, '12 Downtown Road', 'Los Angeles', 'available', '2025-02-15 03:31:22');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
