-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2024 at 06:40 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `taxi`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `user` varchar(50) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `pic` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `user`, `pass`, `pic`) VALUES
(1, 'saber', 'imredhat', '$2y$10$N6UylgTRusDiCRg6.sggM.iq4j3y2kxL3usaWdrj.ggAp5GFkw7.u', '');

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_identities`
--

CREATE TABLE `auth_identities` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `secret` varchar(255) NOT NULL,
  `secret2` varchar(255) DEFAULT NULL,
  `expires` datetime DEFAULT NULL,
  `extra` text DEFAULT NULL,
  `force_reset` tinyint(1) NOT NULL DEFAULT 0,
  `last_used_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `id_type` varchar(255) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions_users`
--

CREATE TABLE `auth_permissions_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `permission` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_remember_tokens`
--

CREATE TABLE `auth_remember_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_token_logins`
--

CREATE TABLE `auth_token_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `id_type` varchar(255) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `TiD` int(11) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `created_at` varchar(100) NOT NULL,
  `updated_at` varchar(100) NOT NULL,
  `deleted_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`TiD`, `brand`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'تویوتا کمری', '', '', ''),
(4, 'تویوتا راو فور', '', '', ''),
(5, 'تویوتا کرولا', '', '', ''),
(6, 'تویوتا پریوس', '', '', ''),
(7, 'رنو سفران', '', '', ''),
(8, 'رنو فلوئنس', '', '', ''),
(9, 'هیوندا سوناتا', '', '', ''),
(10, 'هیوندا اکسنت', '', '', ''),
(11, 'آریو', '', '', ''),
(12, 'برلیانس', '', '', ''),
(13, 'پراید', '', '', ''),
(14, 'تیبا 2 هاچ بک', '', '', ''),
(15, 'ون هیوندا H350', '', '', ''),
(16, 'ون دلیکا', '', '', ''),
(17, 'اتوبوس 40 نفره شهری', '', '', ''),
(18, 'اتوبوس بین  شهری 44 نفره', '', '', ''),
(19, 'اتوبوس 25 نفره VIP', '', '', ''),
(20, 'میدل باس', '', '', ''),
(21, 'مینی بوس', '', '', ''),
(22, 'سمند LX', '', '', ''),
(23, 'پژو 405', '', '', ''),
(25, 'تویوتا پریوس', '', '', ''),
(27, 'پژو پارس', '', '', ''),
(28, 'پژو 206SD', '', '', ''),
(29, 'کیا سراتو', '', '', ''),
(30, 'ام وی ام 530', '', '', ''),
(31, 'جیلی', '', '', ''),
(32, 'دنا EF7', '', '', ''),
(33, 'پژو ROA', '', '', ''),
(34, 'ساینا - سایپا', '', '', ''),
(35, 'ون تویوتا هایس', '', '', ''),
(36, 'هیوندا سانتافه', '', '', ''),
(37, 'ون تویوتا هایس', '', '', ''),
(38, 'ام وی ام X33', '', '', ''),
(39, 'رنو تندر 90', '', '', ''),
(40, 'رانا', '', '', ''),
(41, 'ون وانا', '', '', ''),
(42, 'ام وی ام 110', '', '', ''),
(43, 'جک اس 5', '', '', ''),
(44, 'اتوبوس 40 نفره شهری', '', '', ''),
(46, 'پژو 206', '', '', ''),
(47, 'تویوتا یاریس هاچ بک', '', '', ''),
(48, 'جیلی امگراند 7', '', '', ''),
(49, 'تیبا', '', '', ''),
(50, 'پژو پرشیا', '', '', ''),
(51, 'مزدا  323', '', '', ''),
(52, 'چری تیگو 5', '', '', ''),
(53, 'لیفان 520', '', '', ''),
(54, 'پژو 207', '', '', ''),
(55, 'سمند سورن', '', '', ''),
(57, 'تیگو 5 شاسی', '', '', ''),
(59, 'ریو LS', '', '', ''),
(60, 'ون هیوندا H350 نفره 13', '', '', ''),
(61, 'فولکس کدی', '', '', ''),
(62, 'پژو 207 هاچ بک', '', '', ''),
(63, 'دانگ فنگ H30', '', '', ''),
(64, 'مزدا 3N', '', '', ''),
(65, 'رنو مگان', '', '', ''),
(66, 'ام وی ام 315 هاچ بک', '', '', ''),
(67, 'ام وی ام x22 هاچ بک', '', '', ''),
(68, 'اتوبوس 32 نفره', '', '', ''),
(69, 'ون هیوندا  اچ  8 نفره', '', '', ''),
(70, 'جک جی 5', '', '', ''),
(71, 'ام وی ام 550', '', '', ''),
(72, 'هاوال', '', '', ''),
(73, 'جک S3', '', '', ''),
(74, 'سمند سورن پلاس', '', '', ''),
(75, 'جک J4', '', '', ''),
(76, 'BMW 530i', '', '', ''),
(77, 'هیوندا النترا', '', '', ''),
(78, 'ولیکس C30', '', '', ''),
(80, 'هیوندا i30', '', '', ''),
(81, 'چانگان CS35', '', '', ''),
(82, 'چری آریزو 5', '', '', ''),
(83, 'ام.وی.ام آریزو 6', '', '', ''),
(84, 'رنو کولئوس', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `cid` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `brand` int(11) NOT NULL,
  `fuel` int(11) NOT NULL,
  `iran` int(11) NOT NULL,
  `pelak` varchar(50) NOT NULL,
  `harf` varchar(50) NOT NULL,
  `pelak_last` int(11) NOT NULL,
  `motor` varchar(50) NOT NULL,
  `pic_back` varchar(100) DEFAULT NULL,
  `pic_front` varchar(100) DEFAULT NULL,
  `pic_in_back` varchar(100) DEFAULT NULL,
  `pic_in_front` varchar(100) DEFAULT NULL,
  `scan_car_id` varchar(100) DEFAULT NULL,
  `shasi` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `vin` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`cid`, `driver_id`, `brand`, `fuel`, `iran`, `pelak`, `harf`, `pelak_last`, `motor`, `pic_back`, `pic_front`, `pic_in_back`, `pic_in_front`, `scan_car_id`, `shasi`, `type`, `vin`) VALUES
(5, 11, 13, 1, 10, '321', 'الف', 68, '654564654', 'Screenshot 2024-04-18 113441.png', 'Screenshot 2024-04-18 113343.png', 'Screenshot 2024-04-18 113252.png', 'Screenshot 2024-04-18 113415.png', 'Screenshot 2024-04-18 113622.png', '65456', '1', '65465'),
(8, 10, 13, 0, 66, '546', 'الف', 44, '654848484', 'back.jpg', 'front.jpg', 'in_back.jpg', 'in_front.jpg', NULL, '548489498', 'سواری', '544848484'),
(9, 11, 11, 1, 50, '5454', 'س', 54, '5645456458454', NULL, NULL, NULL, NULL, NULL, '', '1', '65465');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `cid` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `zip` varchar(20) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `fax` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `industry` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `did` int(11) NOT NULL,
  `ax` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `mobile2` varchar(20) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `work_type` enum('azad','sherkati') NOT NULL,
  `melli` varchar(20) DEFAULT NULL,
  `scan_melli` varchar(100) DEFAULT NULL,
  `bank` varchar(20) DEFAULT NULL,
  `shaba` varchar(100) NOT NULL,
  `note` text NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`did`, `ax`, `name`, `lname`, `gender`, `mobile`, `mobile2`, `phone`, `address`, `work_type`, `melli`, `scan_melli`, `bank`, `shaba`, `note`, `date_created`, `deleted_at`) VALUES
(10, 'Screenshot 2024-05-08 135742.png', 'علی', 'صادقی', '', '0959509590', '09595929', '656556564564', 'سئیبد تنسیبتسید تبدسینم', 'azad', '50584810516', NULL, NULL, '65564564564564564654', '', '2024-09-19 04:38:11', '2024-09-19 04:38:11'),
(11, 'IMG_6266.PNG', 'جلیل', 'رحیمی', '', '0959509590', '09595929', '656556564564', 'سئیبد تنسیبتسید تبدسینم', 'azad', '50584810516', NULL, NULL, '65564564564564564654', '', '2024-09-19 04:38:11', '2024-09-19 04:38:11');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2020-12-28-223112', 'CodeIgniter\\Shield\\Database\\Migrations\\CreateAuthTables', 'default', 'CodeIgniter\\Shield', 1725955153, 1),
(2, '2021-07-04-041948', 'CodeIgniter\\Settings\\Database\\Migrations\\CreateSettingsTable', 'default', 'CodeIgniter\\Settings', 1725955154, 1),
(3, '2021-11-14-143905', 'CodeIgniter\\Settings\\Database\\Migrations\\AddContextColumn', 'default', 'CodeIgniter\\Settings', 1725955158, 1);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(10) UNSIGNED NOT NULL,
  `passenger_id` int(11) NOT NULL,
  `passenger_type` enum('P','C') NOT NULL,
  `extraPassenger` varchar(200) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `service_type` enum('OneWay','Sweep','Full','Order') NOT NULL,
  `service_status` enum('Call','Reserve','Confirm','Cancled') NOT NULL,
  `category` enum('exclusive','ticket') NOT NULL,
  `call_date` varchar(100) NOT NULL,
  `trip_date` varchar(100) NOT NULL,
  `start_location` varchar(100) NOT NULL,
  `end_location` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `factor_status` enum('Yes','No') NOT NULL,
  `isPaid` enum('Yes','No') NOT NULL,
  `isTax` enum('Yes','No') NOT NULL,
  `extra` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `passenger_id`, `passenger_type`, `extraPassenger`, `driver_id`, `car_id`, `service_id`, `service_type`, `service_status`, `category`, `call_date`, `trip_date`, `start_location`, `end_location`, `price`, `factor_status`, `isPaid`, `isTax`, `extra`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 4, 'P', '', 9, 5, 1002154, 'OneWay', 'Confirm', 'exclusive', '545656 565', '1403/04/44', 'بابل', 'تهران', 1000000, 'Yes', 'Yes', 'Yes', 'شسی سشیشس', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(9) NOT NULL,
  `class` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `type` varchar(31) NOT NULL DEFAULT 'string',
  `context` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `status` varchar(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `lname`, `gender`, `mobile`, `phone`, `type`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'صابر', 'احمدپور', 'male', '09379062528', '09379062528', 'person', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Saber', 'احمدپور', '', '09379062528', '', '', 'V', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Saber', 'احمدپور', '', '09379062528', '09379062528', 'person', 'V', '2024-09-17 14:14:35', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `last_active` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`);

--
-- Indexes for table `auth_identities`
--
ALTER TABLE `auth_identities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type_secret` (`type`,`secret`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_type_identifier` (`id_type`,`identifier`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_permissions_users`
--
ALTER TABLE `auth_permissions_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_permissions_users_user_id_foreign` (`user_id`);

--
-- Indexes for table `auth_remember_tokens`
--
ALTER TABLE `auth_remember_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `selector` (`selector`),
  ADD KEY `auth_remember_tokens_user_id_foreign` (`user_id`);

--
-- Indexes for table `auth_token_logins`
--
ALTER TABLE `auth_token_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_type_identifier` (`id_type`,`identifier`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`TiD`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`did`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_identities`
--
ALTER TABLE `auth_identities`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_permissions_users`
--
ALTER TABLE `auth_permissions_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_remember_tokens`
--
ALTER TABLE `auth_remember_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_token_logins`
--
ALTER TABLE `auth_token_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `TiD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `cid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `did` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_identities`
--
ALTER TABLE `auth_identities`
  ADD CONSTRAINT `auth_identities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_permissions_users`
--
ALTER TABLE `auth_permissions_users`
  ADD CONSTRAINT `auth_permissions_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_remember_tokens`
--
ALTER TABLE `auth_remember_tokens`
  ADD CONSTRAINT `auth_remember_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
