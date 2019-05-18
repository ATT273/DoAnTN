-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2019 at 08:48 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopping`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `total` int(255) NOT NULL,
  `date_oder` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tranfer_status` tinyint(1) DEFAULT NULL,
  `payment_status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bill_detail`
--

CREATE TABLE `bill_detail` (
  `id` int(11) NOT NULL,
  `bill_id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `product_price` int(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lowcase_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `lowcase_name`, `created_at`, `updated_at`) VALUES
(1, 'Laptop', 'laptop', '2018-12-28 03:38:29', '2018-12-28 03:38:29'),
(2, 'Máy tính văn phong', 'may-tinh-van-phong', '2018-12-28 03:40:36', '2018-12-29 03:48:57');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` int(2) NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` int(15) DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lowcase_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type_id` int(255) NOT NULL,
  `price` int(255) NOT NULL,
  `promo_price` int(255) NOT NULL,
  `unit` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `sold` int(11) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `lowcase_name`, `type_id`, `price`, `promo_price`, `unit`, `quantity`, `sold`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Laptop Asus K102', 'laptop-asus-k102', 3, 20000000, 500000, 'Chiec', 10, NULL, '<p>may tinh assusu</p>\r\n\r\n<p>---</p>\r\n\r\n<p>may tinh rat la dep</p>', '2019-01-04 03:47:10', '2019-04-16 03:10:13'),
(2, 'adada1', 'adada1', 3, 1250, 0, 'Chiec', 10, 3, '<p>san pham adada1</p>\r\n\r\n<p>---</p>\r\n\r\n<p>ada1</p>', '2019-01-07 10:27:26', '2019-04-25 09:15:56'),
(3, 'adada2', 'adada2', 3, 1250, 0, 'Chiec', 10, 2, '<p>san pham ada2</p>\r\n\r\n<p>---</p>\r\n\r\n<p>ad2</p>', '2019-01-07 10:30:06', '2019-04-25 09:16:14'),
(4, 'adada3', 'adada3', 3, 1250, 300, 'Chiec', 10, 1, '<p>san pham adada3</p>\r\n\r\n<p>---</p>\r\n\r\n<p>adada3</p>', '2019-01-07 10:30:30', '2019-04-25 09:16:35'),
(5, 'adada4', 'adada4', 3, 1250, 300, 'fdgdg', 10, 5, '<p>test thu san pham</p>\r\n\r\n<p>---</p>\r\n\r\n<p>test thu san phammoi</p>', '2019-01-07 14:25:30', '2019-04-25 09:16:52'),
(6, 'dfdfdf1', 'dfdfdf1', 3, 1250, 0, 'fdgdg', 10, NULL, '<p>san pham dfdf 1</p>\r\n\r\n<p>---</p>\r\n\r\n<p>fdfdfdfd</p>', '2019-01-07 14:28:12', '2019-04-25 09:17:21'),
(7, 'dfdfdf', 'dfdfdf', 3, 1250, 0, 'fdgdg', 10, NULL, NULL, '2019-01-07 14:30:27', '2019-01-07 14:30:27'),
(8, 'Laptop HP 1500', 'laptop-hp-1500', 4, 5000000, 400000, 'Chiec', 10, NULL, '<p><strong>san pham moi</strong></p>\r\n\r\n<p>---</p>\r\n\r\n<p>day la san pham moi cua chung toi</p>', '2019-01-23 03:57:02', '2019-04-16 02:56:55');

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`id`, `product_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 7, '2019-01-07 21-30-28chipu.jpg', '2019-01-07 14:30:28', '2019-01-07 14:30:28'),
(2, 7, '2019-01-07 21-30-28king.jpg', '2019-01-07 14:30:28', '2019-01-07 14:30:28'),
(4, 8, '2019-01-23 10-57-0242535_tin_tuc_cong_nghe_hp_tung_laptop_envy_13_the_he_moi_gia_tu_20_trieu_dong_3.jpg', '2019-01-23 03:57:02', '2019-01-23 03:57:02'),
(5, 1, '2019-03-27 16-21-2843879_1__small_.jpeg', '2019-03-27 09:21:28', '2019-03-27 09:21:28'),
(6, 8, '2019-04-20 09-01-1342535_15124743_eaabc90b_3fce_4ae2_9094_855f9fbdc67a_1073_768.jpg', '2019-04-20 02:01:13', '2019-04-20 02:01:13'),
(7, 5, '2019-04-25 11-25-1542535_1.jpg', '2019-04-25 04:25:15', '2019-04-25 04:25:15');

-- --------------------------------------------------------

--
-- Table structure for table `type_product`
--

CREATE TABLE `type_product` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lowcase_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `type_product`
--

INSERT INTO `type_product` (`id`, `category_id`, `name`, `lowcase_name`, `created_at`, `updated_at`) VALUES
(3, 1, 'Laptop Asus', 'laptop-asus', '2019-01-01 01:42:54', '2019-01-01 01:42:54'),
(4, 1, 'Laptop HP', 'laptop-hp', '2019-01-23 03:26:20', '2019-01-23 03:26:20');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_id` int(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `customer_id`, `created_at`, `updated_at`) VALUES
(1, 'ahaha', NULL, '12345', NULL, '2019-02-23 07:58:37', '2019-02-23 07:58:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` int(2) DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` tinyint(1) DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `gender`, `address`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'abc1', 'admin', 'abc@gmail.com', '123456', NULL, NULL, NULL, NULL, NULL, '2019-03-25 09:15:35'),
(2, NULL, 'test ko bcrypt', 'kBcrypt@gmail.com', 'abc12345', 1, NULL, 0, NULL, '2019-03-21 08:33:21', '2019-03-21 08:33:21'),
(3, NULL, 'test bcrypt', 'Bcrypt@gmail.com', '$2y$10$1OYnsYa1s9wWEvLVCYvYKeKW8gYBngW1gqcj3LTMfZcXJlLx8gWIS', 1, NULL, 0, 'NXuPXIkk6n97K5NpyCj3Pwo8fcwGbs4Xoa3yeCBzqjH947bq5rfxC4oFulJ2', '2019-03-21 08:34:36', '2019-03-21 08:34:36'),
(4, NULL, 'khack1', 'khach1@gmail.com', '$2y$10$NTzsOz/kZzdacSquIkm1vOItlyZwrl3gx3NJPRgPkN/T5h9p7whtu', 1, NULL, 0, 'xkl70uYfPmyFPWDt171YWmyW7RUwZHgz73LChwa69bSvJUaTxkEokOv99Pkd', '2019-05-07 03:00:26', '2019-05-07 03:00:26'),
(5, NULL, 'admin', 'admin@gmail.com', '$2y$10$ALlTyfxX8CXC5TZ4IBxxjuQrDIT.DDA.D0pPCFiypN3skpS8Cn3q6', 1, NULL, 1, 'wZ5vMRXk8fsFjvLHVEDqyuP8r6DGgMkXaXfATRc7ty5SGNRyN3S9NGzLkM2z', '2019-05-07 03:13:38', '2019-05-07 03:13:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`user_id`);

--
-- Indexes for table `bill_detail`
--
ALTER TABLE `bill_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_id` (`bill_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_id` (`type_id`),
  ADD KEY `type_id_2` (`type_id`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `type_product`
--
ALTER TABLE `type_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bill_detail`
--
ALTER TABLE `bill_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `type_product`
--
ALTER TABLE `type_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `customer` (`id`);

--
-- Constraints for table `bill_detail`
--
ALTER TABLE `bill_detail`
  ADD CONSTRAINT `bill_detail_ibfk_1` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`id`),
  ADD CONSTRAINT `bill_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `type_product` (`id`);

--
-- Constraints for table `product_image`
--
ALTER TABLE `product_image`
  ADD CONSTRAINT `product_image_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `type_product`
--
ALTER TABLE `type_product`
  ADD CONSTRAINT `type_product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
