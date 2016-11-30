-- phpMyAdmin SQL Dump
-- version 4.6.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 30, 2016 at 11:36 AM
-- Server version: 5.7.13
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `date_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `canvas`
--

CREATE TABLE `canvas` (
  `canvas_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `canvas_name` varchar(300) NOT NULL,
  `canvas_slideid` int(11) NOT NULL,
  `canvas_img` varchar(500) DEFAULT NULL,
  `canvas_width` float DEFAULT NULL,
  `canvas_height` float DEFAULT NULL,
  `_status` char(1) DEFAULT NULL,
  `_user` varchar(50) DEFAULT NULL,
  `_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `canvas`
--

INSERT INTO `canvas` (`canvas_id`, `event_id`, `canvas_name`, `canvas_slideid`, `canvas_img`, `canvas_width`, `canvas_height`, `_status`, `_user`, `_date`) VALUES
(28, 1, 'Hall A', 1, '28.png', 1000, 600, 'U', '0', '2016-10-17 11:42:23'),
(29, 1, 'Hall B', 2, '29.jpg', 1000, 600, 'U', '0', '2016-10-17 11:42:30'),
(30, 1, 'Hall C', 3, 'default.jpg', 1000, 600, 'D', '0', '2016-10-23 13:15:26'),
(31, 1, 'Hall C', 3, 'default.jpg', 1000, 600, 'D', '0', '2016-10-23 13:25:51'),
(32, 42, 'HALL A', 1, '32.png', 1000, 600, 'U', '1', '2016-11-26 15:39:17'),
(33, 42, 'test', 2, 'default.jpg', 1000, 600, 'I', '1', '2016-11-30 17:27:15');

-- --------------------------------------------------------

--
-- Table structure for table `card`
--

CREATE TABLE `card` (
  `card_id` varchar(30) NOT NULL,
  `event_id` int(11) NOT NULL,
  `participant_id` int(11) NOT NULL,
  `_status` char(1) DEFAULT NULL,
  `_user` varchar(50) DEFAULT NULL,
  `_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `card`
--

INSERT INTO `card` (`card_id`, `event_id`, `participant_id`, `_status`, `_user`, `_date`) VALUES
('1001-100', 42, 60, 'I', '1', '2016-11-26 13:45:39'),
('1002-101', 42, 61, 'I', '1', '2016-11-26 13:45:39'),
('1003-102', 42, 62, 'I', '1', '2016-11-26 13:45:39'),
('1004-103', 42, 63, 'I', '1', '2016-11-26 13:45:39'),
('1005-104', 42, 64, 'I', '1', '2016-11-26 13:45:39'),
('1006-105', 42, 65, 'I', '1', '2016-11-26 13:45:39'),
('1007-106', 42, 66, 'I', '1', '2016-11-26 13:45:39'),
('1008-107', 42, 67, 'I', '1', '2016-11-26 13:45:40'),
('100816000001', 1, 59, 'I', '1', '2016-11-12 17:40:12'),
('100816000111', 1, 53, 'I', '1', '2016-11-12 17:40:11'),
('100816000192', 1, 52, 'I', '1', '2016-11-12 17:40:11'),
('100816000323', 1, 57, 'I', '1', '2016-11-12 17:40:12'),
('100816000516', 1, 51, 'I', '1', '2016-11-12 17:40:11'),
('100816000967', 1, 50, 'I', '1', '2016-11-12 17:40:11'),
('100816001282', 1, 45, 'I', '1', '2016-11-12 17:40:10'),
('100816001289', 1, 58, 'I', '1', '2016-11-12 17:40:12'),
('100816001291', 1, 55, 'I', '1', '2016-11-12 17:40:11'),
('100816001303', 1, 56, 'I', '1', '2016-11-12 17:40:12'),
('100816001304', 1, 54, 'I', '1', '2016-11-12 17:40:11'),
('100816001324', 1, 48, 'I', '1', '2016-11-12 17:40:11'),
('100816001325', 1, 47, 'I', '1', '2016-11-12 17:40:11'),
('100816001326', 1, 46, 'I', '1', '2016-11-12 17:40:11'),
('100816001375', 1, 49, 'I', '1', '2016-11-12 17:40:11'),
('1009-108', 42, 68, 'I', '1', '2016-11-26 13:45:40'),
('1010-109', 42, 69, 'I', '1', '2016-11-26 13:45:40'),
('1011-110', 42, 70, 'I', '1', '2016-11-26 13:45:40'),
('1012-111', 42, 71, 'I', '1', '2016-11-26 13:45:40'),
('20161128153713-112', 42, 72, 'I', '1', '2016-11-28 15:37:13'),
('20161128153730-113', 42, 73, 'I', '1', '2016-11-28 15:37:30'),
('20161128153737-114', 42, 74, 'I', '1', '2016-11-28 15:37:37'),
('20161130133135-115', 42, 75, 'I', '1', '2016-11-30 13:31:35'),
('20161130133357-116', 42, 76, 'I', '1', '2016-11-30 13:33:57'),
('20161130134705-117', 42, 77, 'I', '1', '2016-11-30 13:47:05'),
('20161130150741-119', 42, 78, 'U', '1', '2016-11-30 15:07:41'),
('20161130151617-120', 42, 79, 'I', '1', '2016-11-30 15:16:17'),
('20161130151715-121', 42, 80, 'I', '1', '2016-11-30 15:17:15'),
('20161130151838-122', 42, 81, 'I', '1', '2016-11-30 15:18:38');

-- --------------------------------------------------------

--
-- Table structure for table `card_design`
--

CREATE TABLE `card_design` (
  `design_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `component_id` int(11) NOT NULL,
  `size` float DEFAULT NULL,
  `x_axis` float DEFAULT NULL,
  `y_axis` float DEFAULT NULL,
  `rotation` float DEFAULT NULL,
  `z_index` int(11) DEFAULT NULL,
  `font_type` varchar(200) DEFAULT NULL,
  `font_size` float DEFAULT NULL,
  `color` varchar(8) DEFAULT NULL,
  `opacity` float DEFAULT NULL,
  `value` varchar(2000) DEFAULT NULL,
  `side` int(11) DEFAULT NULL,
  `comp_name` varchar(30) DEFAULT NULL,
  `_status` char(1) NOT NULL,
  `_user` varchar(50) NOT NULL,
  `_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `card_design`
--

INSERT INTO `card_design` (`design_id`, `event_id`, `component_id`, `size`, `x_axis`, `y_axis`, `rotation`, `z_index`, `font_type`, `font_size`, `color`, `opacity`, `value`, `side`, `comp_name`, `_status`, `_user`, `_date`) VALUES
(59, 1, 1, 1, 150, 250, 0, 0, NULL, NULL, NULL, NULL, NULL, 0, 'comp_221214', 'D', '2', '2016-09-13 22:12:18'),
(60, 1, 1, 0.72, 31.969, 487.844, 0, 1, NULL, NULL, NULL, NULL, NULL, 0, 'qr', 'U', '1', '2016-11-26 14:26:49'),
(61, 1, 2, 0.51, 150, 250, 0, 0, NULL, NULL, NULL, NULL, 'img/kartu/comp_221954.png', 0, 'comp_221954', 'U', '2', '2016-09-19 22:58:17'),
(62, 1, 3, 1.58, 108.934, 243.884, 0, 2, 'Arial Black', 12, '#ff0000', 1, 's', 0, 'comp_222020', 'U', '2', '2016-09-13 22:20:37'),
(63, 1, 4, 1.04, 141.284, 244.106, 0, 3, 'Abril Fatface', 12, '#000000', 1, 'g', 0, 'comp_222051', 'U', '2', '2016-09-13 22:22:22'),
(64, 1, 5, 6.87, 216, 236, 0, 4, 'Arial Rounded MT Bold', 12, '#1100ff', 0.39, 's', 0, 'comp_222123', 'U', '2', '2016-09-19 23:06:21'),
(65, 1, 6, 1.63, 307.277, 147.014, 0, 5, 'Arial', 12, '#000000', 1, 'sTerima Kasih atas kedatangannya', 0, 'comp_222210', 'U', '1', '2016-11-26 14:26:52'),
(66, 1, 2, 0.38, 143, 205, 0, 0, NULL, NULL, NULL, NULL, 'img/kartu/thx.png', 1, 'thx', 'D', '2', '2016-09-13 22:27:28'),
(67, 1, 3, 1, 150, 250, 0, 2, 'Arial', 12, '#000000', 1, 's', 1, 'comp_222412', 'D', '2', '2016-09-13 22:26:26'),
(68, 1, 2, 0.55, 149, 222, 0, 0, NULL, NULL, NULL, NULL, 'img/kartu/comp_222450.png', 1, 'comp_222450', 'D', '2', '2016-09-13 22:26:47'),
(69, 1, 3, 4.52, 157.434, 139.083, 0, 2, 'Arial', 12, '#000000', 1, 's', 1, 'comp_222635', 'D', '2', '2016-09-13 22:26:43'),
(70, 1, 2, 1, 236, 219, 0, 0, NULL, NULL, NULL, NULL, 'img/kartu/comp_222737.png', 1, 'comp_222737', 'U', '2', '2016-09-13 22:28:49'),
(71, 1, 2, 0.36, 110.653, 353.409, 0, 1, NULL, NULL, NULL, NULL, 'img/kartu/comp_222745.png', 1, 'comp_222745', 'U', '2', '2016-09-13 22:28:48'),
(72, 1, 3, 6.25, 252.439, 248.142, 0, 2, 'Arial', 12, '#ff0000', 1, 's', 1, 'comp_222802', 'U', '1', '2016-10-23 12:55:36'),
(73, 1, 2, 1, 636, 383, 0, 6, NULL, NULL, NULL, NULL, 'img/kartu/wew.jpg', 0, 'wew', 'D', '2', '2016-09-20 18:45:05'),
(74, 1, 4, 1, 149, 409, 0, 3, 'Arial', 12, '#000000', 1, 's', 1, 'comp_125545', 'U', '1', '2016-10-23 12:55:52'),
(75, 2, 1, 0.68, 127.875, 348.875, 0, 0, NULL, NULL, NULL, NULL, NULL, 0, 'comp_125845', 'U', '0', '2016-10-24 22:25:23'),
(76, 2, 3, 1, 207, 172, -76.08, 1, 'Arial', 12, '#000000', 1, 's', 0, 'comp_125856', 'U', '0', '2016-10-24 22:25:30'),
(77, 2, 4, 1, 132, 250, 269.81, 2, 'Arial', 12, '#000000', 1, 's', 0, 'comp_130356', 'U', '0', '2016-10-24 22:25:37'),
(78, 2, 5, 1, 129, 281, 269.32, 3, 'Arial', 12, '#000000', 1, 's', 0, 'comp_130405', 'U', '0', '2016-10-24 22:25:25'),
(79, 1, 2, 1, 150, 250, 0, 6, NULL, NULL, NULL, NULL, 'img/comp_142637.png', 0, 'comp_142637', 'D', '1', '2016-11-24 14:27:39'),
(80, 1, 2, 1, 150, 250, 0, 6, NULL, NULL, NULL, NULL, 'img/comp_142810.png', 0, 'comp_142810', 'D', '1', '2016-11-24 14:28:31'),
(81, 1, 2, 1, 150, 250, 0, 6, NULL, NULL, NULL, NULL, 'img/test.png', 0, 'test', 'D', '1', '2016-11-24 14:32:43'),
(82, 1, 2, 1, 150, 250, 0, 6, NULL, NULL, NULL, NULL, 'img/kartu/comp_143250.png', 0, 'comp_143250', 'D', '1', '2016-11-24 14:33:17'),
(83, 42, 4, 1, 150, 250, 0, 0, 'Arial', 12, '#000000', 1, 's', 0, 'comp_130817', 'D', '1', '2016-11-30 13:17:19'),
(84, 42, 4, 1, 141, 330, 0, 1, 'Arial', 12, '#000000', 1, 's', 0, 'asdsadasd', 'D', '1', '2016-11-30 13:17:31'),
(85, 42, 1, 1, 160, 368, 0, 0, NULL, NULL, NULL, NULL, NULL, 0, 'comp_131739', 'D', '1', '2016-11-30 13:18:09'),
(86, 42, 3, 1, 150, 250, 0, 1, 'Arial', NULL, '#000000', 1, 's', 0, 'comp_131744', 'D', '1', '2016-11-30 13:18:08'),
(87, 42, 3, 1, 133, 197, 0, 0, 'Arial', 12, '#000000', 1, 's', 0, 'comp_131819', 'D', '1', '2016-11-30 13:18:23'),
(88, 42, 4, 1, 162, 187, 0, 0, 'Arial', 12, '#000000', 1, 's', 0, 'comp_131828', 'D', '1', '2016-11-30 13:18:43'),
(89, 42, 4, 1, 150, 250, 0, 1, 'Arial', 12, '#000000', 1, 's', 0, 'comp_131838', 'D', '1', '2016-11-30 13:18:41'),
(90, 42, 3, 1, 120, 79, 0, 0, 'Arial', 12, '#000000', 1, 's', 0, 'comp_131849', 'D', '1', '2016-11-30 13:19:09'),
(91, 42, 1, 1, 68, 429, 0, 1, NULL, NULL, NULL, NULL, NULL, 0, 'comp_154755', 'U', '1', '2016-11-30 15:49:03'),
(92, 42, 2, 1, 166, 166, 0, 0, NULL, NULL, NULL, NULL, 'img/kartu/comp_154853.jpeg', 0, 'comp_154853', 'U', '1', '2016-11-30 15:50:40'),
(93, 42, 3, 1.67, 26.4437, 92.4365, 0, 2, 'Cherry Cream Soda', 12, '#000000', 1, 'g', 0, 'comp_154930', 'U', '1', '2016-11-30 15:49:43'),
(94, 42, 6, 4.04, 254.376, 407.691, 0, 3, 'Caesar Dressing', 12, '#000000', 1, 'gThanks', 0, 'Thanks', 'U', '1', '2016-11-30 15:50:19'),
(95, 42, 4, 1, 51, 25, 0, 4, 'Arial Black', 12, '#ff0000', 1, 's', 0, 'comp_155033', 'U', '1', '2016-11-30 16:07:50'),
(96, 42, 6, 1, 50, 77, 0, 5, 'Arial Black', 12, '#000000', 1, 'syang hadir', 0, 'comp_155108', 'U', '1', '2016-11-30 15:51:14'),
(97, 42, 5, 2.16, 30.1154, 287.051, 0, 6, 'Sancreek', 12, '#000000', 1, 'g', 0, 'comp_155135', 'U', '1', '2016-11-30 15:51:45'),
(98, 42, 2, 1.1, 149.372, 183.378, 0, 0, NULL, NULL, NULL, NULL, 'img/kartu/comp_155220.jpeg', 1, 'comp_155220', 'U', '1', '2016-11-30 15:52:27');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `city` varchar(100) NOT NULL,
  `_status` char(1) DEFAULT NULL,
  `_user` varchar(50) DEFAULT NULL,
  `_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city`, `_status`, `_user`, `_date`) VALUES
('Ambon', 'A', 'admin', '2016-08-25 20:27:57'),
('Balikpapan', 'A', 'admin', '2016-08-25 20:27:57'),
('Banda Aceh', 'A', 'admin', '2016-08-25 20:27:57'),
('Bandar Lampung', 'A', 'admin', '2016-08-25 20:27:57'),
('Bandung', 'A', 'admin', '2016-08-25 20:27:57'),
('Banjar', 'A', 'admin', '2016-08-25 20:27:57'),
('Banjarbaru', 'A', 'admin', '2016-08-25 20:27:57'),
('Banjarmasin', 'A', 'admin', '2016-08-25 20:27:57'),
('Batam', 'A', 'admin', '2016-08-25 20:27:57'),
('Batu', 'A', 'admin', '2016-08-25 20:27:57'),
('Bau-Bau', 'A', 'admin', '2016-08-25 20:27:57'),
('Bekasi', 'A', 'admin', '2016-08-25 20:27:57'),
('Bengkulu', 'A', 'admin', '2016-08-25 20:27:57'),
('Bima', 'A', 'admin', '2016-08-25 20:27:57'),
('Binjai', 'A', 'admin', '2016-08-25 20:27:58'),
('Bitung', 'A', 'admin', '2016-08-25 20:27:57'),
('Blitar', 'A', 'admin', '2016-08-25 20:27:57'),
('Bogor', 'A', 'admin', '2016-08-25 20:27:57'),
('Bontang', 'A', 'admin', '2016-08-25 20:27:57'),
('Bukittinggi', 'A', 'admin', '2016-08-25 20:27:58'),
('Cilegon', 'A', 'admin', '2016-08-25 20:27:57'),
('Cimahi', 'A', 'admin', '2016-08-25 20:27:57'),
('Cirebon', 'A', 'admin', '2016-08-25 20:27:57'),
('Denpasar', 'A', 'admin', '2016-08-25 20:27:57'),
('Depok', 'A', 'admin', '2016-08-25 20:27:57'),
('Dumai', 'A', 'admin', '2016-08-25 20:27:57'),
('Gorontalo', 'A', 'admin', '2016-08-25 20:27:57'),
('Jakarta', 'A', 'admin', '2016-08-25 20:27:57'),
('Jambi', 'A', 'admin', '2016-08-25 20:27:57'),
('Jayapura', 'A', 'admin', '2016-08-25 20:27:57'),
('Kediri', 'A', 'admin', '2016-08-25 20:27:57'),
('Kendari', 'A', 'admin', '2016-08-25 20:27:57'),
('Kotabumi', 'A', 'admin', '2016-08-25 20:27:57'),
('Kotamobagu', 'A', 'admin', '2016-08-25 20:27:57'),
('Kupang', 'A', 'admin', '2016-08-25 20:27:57'),
('Langsa', 'A', 'admin', '2016-08-25 20:27:57'),
('Lhokseumawe', 'A', 'admin', '2016-08-25 20:27:57'),
('Liwa', 'A', 'admin', '2016-08-25 20:27:57'),
('Lubuklinggau', 'A', 'admin', '2016-08-25 20:27:58'),
('Madiun', 'A', 'admin', '2016-08-25 20:27:57'),
('Magelang', 'A', 'admin', '2016-08-25 20:27:57'),
('Makassar', 'A', 'admin', '2016-08-25 20:27:57'),
('Malang', 'A', 'admin', '2016-08-25 20:27:57'),
('Manado', 'A', 'admin', '2016-08-25 20:27:57'),
('Mataram', 'A', 'admin', '2016-08-25 20:27:57'),
('Medan', 'A', 'admin', '2016-08-25 20:27:58'),
('Metro', 'A', 'admin', '2016-08-25 20:27:57'),
('Meulaboh', 'A', 'admin', '2016-08-25 20:27:57'),
('Mojokerto', 'A', 'admin', '2016-08-25 20:27:57'),
('Padang', 'A', 'admin', '2016-08-25 20:27:58'),
('Padang Sidempuan', 'A', 'admin', '2016-08-25 20:27:58'),
('Padangpanjang', 'A', 'admin', '2016-08-25 20:27:58'),
('Pagaralam', 'A', 'admin', '2016-08-25 20:27:58'),
('Palangkaraya', 'A', 'admin', '2016-08-25 20:27:57'),
('Palembang', 'A', 'admin', '2016-08-25 20:27:58'),
('Palopo', 'A', 'admin', '2016-08-25 20:27:57'),
('Palu', 'A', 'admin', '2016-08-25 20:27:57'),
('Pangkalpinang', 'A', 'admin', '2016-08-25 20:27:57'),
('Parepare', 'A', 'admin', '2016-08-25 20:27:57'),
('Pariaman', 'A', 'admin', '2016-08-25 20:27:58'),
('Pasuruan', 'A', 'admin', '2016-08-25 20:27:57'),
('Payakumbuh', 'A', 'admin', '2016-08-25 20:27:58'),
('Pekalongan', 'A', 'admin', '2016-08-25 20:27:57'),
('Pekanbaru', 'A', 'admin', '2016-08-25 20:27:57'),
('Pematangsiantar', 'A', 'admin', '2016-08-25 20:27:58'),
('Pontianak', 'A', 'admin', '2016-08-25 20:27:57'),
('Prabumulih', 'A', 'admin', '2016-08-25 20:27:58'),
('Probolinggo', 'A', 'admin', '2016-08-25 20:27:57'),
('Purwokerto', 'A', 'admin', '2016-08-25 20:27:57'),
('Sabang', 'A', 'admin', '2016-08-25 20:27:57'),
('Salatiga', 'A', 'admin', '2016-08-25 20:27:57'),
('Samarinda', 'A', 'admin', '2016-08-25 20:27:57'),
('Sawahlunto', 'A', 'admin', '2016-08-25 20:27:58'),
('Semarang', 'A', 'admin', '2016-08-25 20:27:57'),
('Serang', 'A', 'admin', '2016-08-25 20:27:57'),
('Sibolga', 'A', 'admin', '2016-08-25 20:27:58'),
('Singkawang', 'A', 'admin', '2016-08-25 20:27:57'),
('Solok', 'A', 'admin', '2016-08-25 20:27:58'),
('Sorong', 'A', 'admin', '2016-08-25 20:27:57'),
('Subulussalam', 'A', 'admin', '2016-08-25 20:27:57'),
('Sukabumi', 'A', 'admin', '2016-08-25 20:27:57'),
('Sungai Penuh', 'A', 'admin', '2016-08-25 20:27:57'),
('Surabaya', 'A', 'admin', '2016-08-25 20:27:57'),
('Surakarta', 'A', 'admin', '2016-08-25 20:27:57'),
('Tangerang', 'A', 'admin', '2016-08-25 20:27:57'),
('Tangerang Selatan', 'A', 'admin', '2016-08-25 20:27:57'),
('Tanjungbalai', 'A', 'admin', '2016-08-25 20:27:58'),
('Tanjungpinang', 'A', 'admin', '2016-08-25 20:27:57'),
('Tarakan', 'A', 'admin', '2016-08-25 20:27:57'),
('Tasikmalaya', 'A', 'admin', '2016-08-25 20:27:57'),
('Tebingtinggi', 'A', 'admin', '2016-08-25 20:27:58'),
('Tegal', 'A', 'admin', '2016-08-25 20:27:57'),
('Ternate', 'A', 'admin', '2016-08-25 20:27:57'),
('Tidore Kepulauan', 'A', 'admin', '2016-08-25 20:27:57'),
('Tomohon', 'A', 'admin', '2016-08-25 20:27:58'),
('Tual', 'A', 'admin', '2016-08-25 20:27:57'),
('Yogyakarta', 'A', 'admin', '2016-08-25 20:27:58');

-- --------------------------------------------------------

--
-- Table structure for table `delegate_verification`
--

CREATE TABLE `delegate_verification` (
  `card_id` varchar(30) NOT NULL,
  `verification_date` datetime NOT NULL,
  `delegate_to` int(11) NOT NULL,
  `_status` char(1) NOT NULL,
  `_user` varchar(50) NOT NULL,
  `_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delegate_verification`
--

INSERT INTO `delegate_verification` (`card_id`, `verification_date`, `delegate_to`, `_status`, `_user`, `_date`) VALUES
('1006-105', '2016-11-26 16:37:14', 67, 'D', '20', '2016-11-26 16:38:38'),
('1006-105', '2016-11-26 16:38:38', 67, 'I', '20', '2016-11-26 16:38:38'),
('1007-106', '2016-11-30 13:35:51', 63, 'D', '1', '2016-11-30 13:36:08'),
('1007-106', '2016-11-30 13:36:08', 63, 'I', '1', '2016-11-30 13:36:08'),
('1010-109', '2016-11-26 16:25:32', 61, 'I', '17', '2016-11-26 16:25:32'),
('20161128153713-112', '2016-11-30 14:47:34', 77, 'I', '1', '2016-11-30 14:47:34');

-- --------------------------------------------------------

--
-- Table structure for table `design_component`
--

CREATE TABLE `design_component` (
  `component_id` int(11) NOT NULL,
  `component_name` varchar(100) DEFAULT NULL,
  `default_img` varchar(300) DEFAULT NULL,
  `is_dynamic` tinyint(1) DEFAULT NULL,
  `_status` char(1) DEFAULT NULL,
  `_user` varchar(50) DEFAULT NULL,
  `_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `design_component`
--

INSERT INTO `design_component` (`component_id`, `component_name`, `default_img`, `is_dynamic`, `_status`, `_user`, `_date`) VALUES
(1, 'QR Code', 'img/qrcode-sample.png', 1, 'A', 'admin', '2016-08-27 00:00:00'),
(2, 'Gambar', NULL, 0, 'A', 'admin', '2016-08-27 00:00:00'),
(3, 'Nama Peserta', NULL, 1, 'A', 'admin', '2016-08-27 00:00:00'),
(4, '0', NULL, 1, 'A', 'admin', '2016-08-27 00:00:00'),
(5, 'Nama Grup', NULL, 1, 'A', 'admin', '2016-08-27 00:00:00'),
(6, 'Text', NULL, 0, 'A', 'Admin', '2016-09-08 20:40:37');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `event_id` int(11) NOT NULL,
  `event_type_id` int(11) NOT NULL,
  `event_name` varchar(50) DEFAULT NULL,
  `event_img` varchar(300) DEFAULT NULL,
  `start_at` datetime DEFAULT NULL,
  `end_at` datetime DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `late_tolerance` int(11) DEFAULT NULL,
  `total_invitation` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `_status` char(1) DEFAULT NULL,
  `_user` varchar(50) DEFAULT NULL,
  `_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`event_id`, `event_type_id`, `event_name`, `event_img`, `start_at`, `end_at`, `address`, `city`, `late_tolerance`, `total_invitation`, `is_active`, `_status`, `_user`, `_date`) VALUES
(1, 1, 'Woman\'s Festival', 'logo_acara_2.png', '2016-08-10 09:00:00', '2016-08-10 14:00:00', 'Jl. Letjen. S. Parman No.28, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11470', 'Jakarta', 0, 1500, 0, 'U', '1', '2016-11-24 15:15:49'),
(2, 2, 'Pernikahan A dan B', NULL, '2016-12-29 19:00:00', '2016-12-29 21:00:00', 'Jl. Jend. Gatot Subroto, Jakarta Selatan, Daerah Khusus Ibukota Jakarta 10270', 'Jakarta', 30, 500, 0, 'U', '0', '2016-08-27 08:49:36'),
(3, 2, 'testz', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'asdz', 'Bengkulu', 0, 111, 0, 'D', '0', '2016-08-27 07:56:34'),
(4, 1, '', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'Ambon', 0, 0, 0, 'D', '0', '2016-08-25 23:28:13'),
(5, 1, '', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'Ambon', 0, 0, 0, 'D', '0', '2016-08-25 23:36:32'),
(6, 1, '', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'Ambon', 0, 0, 0, 'D', '0', '2016-08-25 23:36:36'),
(7, 1, '', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'Ambon', 0, 0, 0, 'D', '0', '2016-08-25 23:36:40'),
(8, 1, '', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'Ambon', 0, 0, 0, 'D', '0', '2016-08-25 23:36:43'),
(9, 1, '', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'Ambon', 0, 0, 0, 'D', '0', '2016-08-25 23:36:44'),
(10, 1, 'zzz', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'zzz', 'Banjar', 0, 1111, 0, 'D', '0', '2016-08-26 09:57:37'),
(11, 2, 'a', NULL, '2016-08-19 00:00:00', '2016-08-10 00:00:00', 'test', 'Ambon', 0, 11, 0, 'D', '0', '2016-08-27 07:56:36'),
(12, 2, 'a', NULL, '2016-08-19 00:00:00', '2016-08-10 00:00:00', 'test', 'Ambon', 0, 11, 0, 'D', '0', '2016-08-27 07:56:38'),
(13, 1, 'a', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'Ambon', 0, 0, 0, 'D', '0', '2016-08-27 08:00:55'),
(14, 1, '', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'Ambon', 0, 0, 0, 'D', '0', '2016-08-27 08:00:57'),
(15, 1, '', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'Ambon', 0, 0, 0, 'D', '0', '2016-08-27 08:01:52'),
(16, 1, '', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'Ambon', 0, 0, 0, 'D', '0', '2016-08-27 08:04:53'),
(17, 2, 'pernikahan abc & def', NULL, '2016-08-27 00:00:00', '2016-08-27 00:00:00', 'cp', 'Jakarta', 0, 100, 0, 'D', '0', '2016-08-27 08:18:59'),
(18, 1, 'sunat masal', NULL, '2016-09-01 08:10:00', '2016-09-01 10:15:00', 'rumah sendiri', 'Banda Aceh', 0, 2000, 0, 'D', '0', '2016-08-27 08:41:04'),
(19, 2, 'aasdasd', NULL, '1899-12-20 03:00:00', '1899-12-21 08:00:00', 'aaaaa', 'Banjarbaru', 0, 11, 0, 'D', '0', '2016-08-27 08:45:02'),
(20, 1, 'seminar kesehatan', NULL, '2016-08-29 10:15:00', '2016-08-30 12:00:00', 'sekolah di bandung', 'Bandung', 0, 225, 0, 'D', '0', '2016-08-27 09:20:21'),
(21, 1, 'test', NULL, '2016-11-24 13:07:00', '2016-11-25 13:07:00', 'jalan sumatera', 'Banda Aceh', 0, 100, 0, 'D', '1', '2016-11-24 13:12:25'),
(22, 1, 'test', '\r\n<div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">\r\n\r\n<h4>A PHP Error was encountered</h4>\r\n\r\n<p>Severity: Notice</p>\r\n<p>Message:  Undefined index: userfile</p>\r\n<p>Filename: acara/Pengaturan_acara.php</p>\r\n<p>Line Number: 81</p>\r\n\r\n\r\n	<p>Backtrace:</p>\r\n	\r\n		\r\n	\r\n		\r\n	\r\n', '2016-11-24 13:13:00', '2016-11-25 13:13:00', 'jalan subang', 'Bandung', 0, 100, 0, 'D', '1', '2016-11-24 13:16:35'),
(23, 1, 'test', 'logo_acara_2.png', '2016-11-24 13:16:00', '2016-11-25 13:16:00', 'jalan cirebon', 'Cirebon', 0, 100, 0, 'D', '1', '2016-11-24 13:17:28'),
(24, 1, 'a', 'logo_acara_2.png', '2016-11-24 13:18:00', '2016-11-25 13:18:00', 'a', 'Ambon', 0, 1, 0, 'D', '1', '2016-11-24 13:30:34'),
(25, 1, 'a', 'masuk', '2016-11-24 13:20:00', '2016-11-25 13:20:00', 'a', 'Ambon', 0, 1, 0, 'D', '1', '2016-11-24 13:30:36'),
(26, 1, 'asd', 'masuk', '2016-11-24 13:30:00', '2016-11-24 13:30:00', 'asd', 'Ambon', 0, 0, 0, 'D', '1', '2016-11-24 13:30:37'),
(27, 1, 'asd', 'logo_acara_2.png', '2016-11-24 13:32:00', '2016-11-25 13:32:00', 'asd', 'Ambon', 0, 1, 0, 'D', '1', '2016-11-24 13:34:43'),
(28, 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'Ambon', 0, 0, 0, 'D', '1', '2016-11-24 13:34:45'),
(29, 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'Ambon', 0, 0, 0, 'D', '1', '2016-11-24 13:34:46'),
(30, 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'Ambon', 0, 0, 0, 'D', '1', '2016-11-24 13:34:48'),
(31, 1, '', 'logo_acara_2.png', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'Ambon', 0, 0, 0, 'D', '1', '2016-11-24 14:33:25'),
(32, 1, '', 'string(43) "<p>You did not select a file to upload.</p>"\nlogo_acara_2.png', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'Ambon', 0, 0, 0, 'D', '1', '2016-11-24 14:33:27'),
(33, 1, '', 'array(5) {\n  ["name"]=>\n  string(16) "logo_acara_2.png"\n  ["type"]=>\n  string(9) "image/png"\n  ["tmp_name"]=>\n  string(24) "C:\\xampp\\tmp\\phpBA49.tmp"\n  ["error"]=>\n  int(0)\n  ["size"]=>\n  int(9670)\n}\nstring(43) "<p>You did not select a file to upload.</p>"\nlogo_acara_2.png', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'Ambon', 0, 0, 0, 'D', '1', '2016-11-24 14:33:30'),
(34, 1, '', 'array(14) {\n  ["file_name"]=>\n  string(16) "logo_acara_2.png"\n  ["file_type"]=>\n  string(9) "image/png"\n  ["file_path"]=>\n  string(38) "C:/xampp/htdocs/date/assets/img/acara/"\n  ["full_path"]=>\n  string(54) "C:/xampp/htdocs/date/assets/img/acara/logo_acara_2.png"\n  ["raw_name"]=>\n  string(12) "logo_', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'Ambon', 0, 0, 0, 'D', '1', '2016-11-24 15:01:26'),
(35, 1, 'Woman\'s Festival', 'array(14) {\n  ["file_name"]=>\n  string(16) "logo_acara_2.png"\n  ["file_type"]=>\n  string(9) "image/png"\n  ["file_path"]=>\n  string(38) "C:/xampp/htdocs/date/assets/img/acara/"\n  ["full_path"]=>\n  string(54) "C:/xampp/htdocs/date/assets/img/acara/logo_acara_2.png"\n  ["raw_name"]=>\n  string(12) "logo_', '2016-08-10 09:00:00', '2016-08-10 14:00:00', 'Jl. Letjen. S. Parman No.28, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11470', 'Jakarta', 0, 1500, 0, 'D', '1', '2016-11-24 15:01:58'),
(36, 1, 'Woman\'s Festival', 'array(14) {\n  ["file_name"]=>\n  string(16) "logo_acara_2.png"\n  ["file_type"]=>\n  string(9) "image/png"\n  ["file_path"]=>\n  string(38) "C:/xampp/htdocs/date/assets/img/acara/"\n  ["full_path"]=>\n  string(54) "C:/xampp/htdocs/date/assets/img/acara/logo_acara_2.png"\n  ["raw_name"]=>\n  string(12) "logo_', '2016-08-10 09:00:00', '2016-08-10 14:00:00', 'Jl. Letjen. S. Parman No.28, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11470', 'Jakarta', 0, 1500, 0, 'D', '1', '2016-11-24 15:03:12'),
(37, 1, 'asd', 'string(43) "<p>You did not select a file to upload.</p>"\n', '2016-11-24 15:03:00', '2016-11-25 15:03:00', 'sad', 'Ambon', 0, 1, 0, 'D', '1', '2016-11-24 15:03:40'),
(38, 1, 'Woman\'s Festival', 'string(43) "<p>You did not select a file to upload.</p>"\n', '2016-08-10 09:00:00', '2016-08-10 14:00:00', 'Jl. Letjen. S. Parman No.28, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11470', 'Jakarta', 0, 1500, 0, 'D', '1', '2016-11-24 15:03:46'),
(39, 1, 'Woman\'s Festival', 'string(43) "<p>You did not select a file to upload.</p>"\n', '2016-08-10 09:00:00', '2016-08-10 14:00:00', 'Jl. Letjen. S. Parman No.28, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11470', 'Jakarta', 0, 1500, 0, 'D', '1', '2016-11-24 15:06:14'),
(40, 1, 'Woman\'s Festival', 'string(43) "<p>You did not select a file to upload.</p>"\n', '2016-08-10 09:00:00', '2016-08-10 14:00:00', 'Jl. Letjen. S. Parman No.28, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11470', 'Jakarta', 0, 1500, 0, 'D', '1', '2016-11-24 15:10:13'),
(41, 1, 'Woman\'s Festival', 'string(43) "<p>You did not select a file to upload.</p>"\n', '2016-08-10 09:00:00', '2016-08-10 14:00:00', 'Jl. Letjen. S. Parman No.28, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11470', 'Jakarta', 0, 1500, 0, 'D', '1', '2016-11-24 15:11:02'),
(42, 2, 'Chris&Steffi Wedding', 'acara.png', '2016-11-27 11:53:00', '2016-11-27 17:00:00', 'Hotel Mulia', 'Jakarta', 0, 1000, 1, 'I', '1', '2016-11-26 11:54:41');

-- --------------------------------------------------------

--
-- Table structure for table `event_type`
--

CREATE TABLE `event_type` (
  `event_type_id` int(11) NOT NULL,
  `event_type_name` varchar(10) DEFAULT NULL,
  `_status` char(1) DEFAULT NULL,
  `_user` varchar(50) DEFAULT NULL,
  `_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_type`
--

INSERT INTO `event_type` (`event_type_id`, `event_type_name`, `_status`, `_user`, `_date`) VALUES
(1, 'Seminar', 'A', 'robin', '2016-08-24 00:00:00'),
(2, 'Wedding', 'A', 'robin', '2016-08-24 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `facility`
--

CREATE TABLE `facility` (
  `facility_id` int(11) NOT NULL,
  `facility_type_id` int(11) NOT NULL,
  `facility_parent_id` int(11) NOT NULL,
  `canvas_id` int(11) NOT NULL,
  `canvas_slideid` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `facility_name` varchar(30) NOT NULL,
  `x_axis` int(11) NOT NULL,
  `y_axis` int(11) NOT NULL,
  `_status` char(1) DEFAULT NULL,
  `_user` varchar(50) DEFAULT NULL,
  `_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `facility`
--

INSERT INTO `facility` (`facility_id`, `facility_type_id`, `facility_parent_id`, `canvas_id`, `canvas_slideid`, `event_id`, `group_id`, `facility_name`, `x_axis`, `y_axis`, `_status`, `_user`, `_date`) VALUES
(135, 1, 0, 28, 1, 1, 2, 'meja a', 256, 386, 'D', '0', '2016-10-17 11:58:42'),
(136, 1, 0, 28, 1, 1, 3, 'meja b', 751, 99, 'U', '1', '2016-10-17 20:13:56'),
(137, 2, 135, 28, 1, 1, 2, 'kursi a1', 260, 346, 'D', '0', '2016-10-17 11:58:42'),
(138, 2, 135, 28, 1, 1, 2, 'kursi a2', 240, 352, 'D', '0', '2016-10-17 11:58:42'),
(139, 2, 135, 28, 1, 1, 2, 'kursi a3', 279, 355, 'D', '0', '2016-10-17 11:58:42'),
(140, 2, 136, 28, 1, 1, 3, 'kursi b1', 717, 75, 'U', '1', '2016-10-17 20:13:56'),
(141, 2, 136, 28, 1, 1, 3, 'kursi b2', 777, 120, 'U', '1', '2016-10-17 20:13:56'),
(142, 1, 0, 28, 1, 1, 2, 'meja a', 519, 297, 'U', '1', '2016-10-17 20:13:09'),
(143, 2, 142, 28, 1, 1, 2, 'kursi a1', 480, 294, 'U', '1', '2016-10-17 20:13:09'),
(144, 2, 136, 28, 1, 1, 3, 'kursi b3', 716, 120, 'U', '1', '2016-10-17 20:13:56'),
(145, 2, 142, 28, 1, 1, 2, 'kursi a2', 554, 297, 'U', '1', '2016-10-17 20:13:09'),
(146, 1, 0, 29, 2, 1, 3, 'meja b', 759, 387, 'D', '0', '2016-10-17 13:22:11'),
(147, 2, 146, 29, 2, 1, 3, 'kursi b1', 726, 364, 'D', '0', '2016-10-17 13:22:11'),
(148, 2, 146, 29, 2, 1, 3, 'kursi b2', 786, 409, 'D', '0', '2016-10-17 13:22:11'),
(149, 1, 0, 29, 2, 1, 1, 'meja a', 146, 69, 'D', '0', '2016-10-17 13:22:11'),
(150, 2, 149, 29, 2, 1, 1, 'kursi a1', 109, 68, 'D', '0', '2016-10-17 13:22:11'),
(151, 2, 146, 29, 2, 1, 3, 'kursi b3', 725, 409, 'D', '0', '2016-10-17 13:22:11'),
(152, 2, 149, 29, 2, 1, 1, 'kursi a2', 182, 68, 'D', '0', '2016-10-17 13:22:11'),
(153, 1, 0, 29, 2, 1, 3, 'meja b', 325, 397, 'U', '1', '2016-10-23 13:19:14'),
(154, 2, 153, 29, 2, 1, 3, 'kursi b1', 293, 374, 'U', '1', '2016-10-23 13:19:14'),
(155, 2, 153, 29, 2, 1, 3, 'kursi b2', 353, 419, 'U', '1', '2016-10-23 13:19:14'),
(156, 1, 0, 29, 2, 1, 1, 'meja a', 634, 204, 'U', '1', '2016-10-23 13:19:23'),
(157, 2, 156, 29, 2, 1, 1, 'kursi a1', 595, 200, 'U', '1', '2016-10-23 13:19:23'),
(158, 2, 153, 29, 2, 1, 3, 'kursi b3', 292, 419, 'U', '1', '2016-10-23 13:19:14'),
(159, 2, 156, 29, 2, 1, 1, 'kursi a2', 668, 200, 'U', '1', '2016-10-23 13:19:23'),
(160, 2, 156, 29, 2, 1, 1, 'kursi tambahan', 631, 165, 'U', '1', '2016-10-24 22:35:11'),
(161, 1, 0, 30, 3, 1, 5, 'meja b', 333, 382, 'I', '0', '2016-10-23 13:25:29'),
(162, 2, 161, 30, 3, 1, 5, 'kursi b1', 301, 360, 'I', '0', '2016-10-23 13:25:29'),
(163, 2, 161, 30, 3, 1, 5, 'kursi b2', 361, 405, 'I', '0', '2016-10-23 13:25:29'),
(164, 1, 0, 30, 3, 1, 1, 'meja a', 624, 203, 'I', '0', '2016-10-23 13:25:29'),
(166, 2, 161, 30, 3, 1, 5, 'kursi b3', 300, 405, 'I', '0', '2016-10-23 13:25:29'),
(168, 1, 0, 31, 3, 1, 3, 'meja b', 333, 382, 'I', '0', '2016-10-23 13:27:44'),
(169, 2, 168, 31, 3, 1, 3, 'kursi b1', 301, 360, 'I', '0', '2016-10-23 13:27:44'),
(170, 2, 168, 31, 3, 1, 3, 'kursi b2', 361, 405, 'I', '0', '2016-10-23 13:27:44'),
(171, 1, 0, 31, 3, 1, 1, 'meja a', 629, 202, 'I', '0', '2016-10-23 13:27:44'),
(173, 2, 168, 31, 3, 1, 3, 'kursi b3', 300, 405, 'I', '0', '2016-10-23 13:27:44'),
(176, 1, 0, 28, 1, 1, 4, 'meja c', 155, 382, 'U', '1', '2016-10-24 19:13:19'),
(177, 2, 176, 28, 1, 1, 4, 'kursi c1', 180, 356, 'U', '1', '2016-10-24 19:13:28'),
(178, 2, 176, 28, 1, 1, 4, 'kursi c2', 123, 403, 'U', '1', '2016-10-24 19:13:34'),
(179, 2, 176, 28, 1, 1, 4, 'kursi c3', 125, 350, 'U', '1', '2016-10-29 14:27:34'),
(180, 2, 153, 29, 2, 1, 3, 'kursi b4', 353, 369, 'U', '1', '2016-10-29 20:58:35'),
(181, 2, 142, 28, 1, 1, 2, 'kursi a3', 518, 258, 'U', '1', '2016-11-01 06:24:43'),
(182, 2, 142, 28, 1, 1, 2, 'kursi a4', 519, 335, 'U', '1', '2016-11-15 14:43:23'),
(183, 2, 136, 28, 1, 1, 3, 'kursi b4', 783, 73, 'U', '1', '2016-11-15 14:43:43'),
(184, 2, 176, 28, 1, 1, 4, 'kursi c4', 184, 407, 'U', '1', '2016-11-15 14:43:55'),
(185, 2, 156, 29, 2, 1, 1, 'kursi tambahan 2', 637, 242, 'U', '1', '2016-11-15 14:44:11'),
(186, 1, 0, 32, 1, 42, 1, 'A', 903, 207, 'U', '1', '2016-11-26 15:38:39'),
(187, 1, 0, 32, 1, 42, 2, 'B', 641, 92, 'U', '1', '2016-11-26 15:38:39'),
(188, 1, 0, 32, 1, 42, 3, 'C', 537, 310, 'U', '1', '2016-11-26 15:38:39'),
(189, 1, 0, 32, 1, 42, 4, 'D', 396, 210, 'U', '1', '2016-11-26 15:38:39'),
(190, 2, 186, 32, 1, 42, 1, 'A1', 875, 181, 'U', '1', '2016-11-26 15:38:39'),
(191, 2, 186, 32, 1, 42, 1, 'A2', 878, 236, 'U', '1', '2016-11-26 15:38:39'),
(192, 2, 186, 32, 1, 42, 1, 'A3', 930, 181, 'U', '1', '2016-11-26 15:38:39'),
(193, 2, 186, 32, 1, 42, 1, 'A4', 928, 236, 'U', '1', '2016-11-26 15:38:39'),
(194, 2, 187, 32, 1, 42, 2, 'B1', 671, 118, 'U', '1', '2016-11-26 15:38:39'),
(195, 2, 187, 32, 1, 42, 2, 'B2', 672, 67, 'U', '1', '2016-11-26 15:38:39'),
(196, 2, 187, 32, 1, 42, 2, 'B3', 606, 118, 'U', '1', '2016-11-26 15:38:39'),
(197, 2, 187, 32, 1, 42, 2, 'B4', 607, 68, 'U', '1', '2016-11-26 15:38:39'),
(198, 2, 188, 32, 1, 42, 3, 'C1', 564, 335, 'U', '1', '2016-11-26 15:38:39'),
(199, 2, 188, 32, 1, 42, 3, 'C2', 506, 284, 'U', '1', '2016-11-26 15:38:39'),
(200, 2, 188, 32, 1, 42, 3, 'C3', 507, 336, 'U', '1', '2016-11-26 15:38:39'),
(201, 2, 188, 32, 1, 42, 3, 'C4', 563, 282, 'U', '1', '2016-11-26 15:38:39'),
(202, 2, 189, 32, 1, 42, 4, 'D1', 363, 235, 'U', '1', '2016-11-26 15:38:39'),
(203, 2, 189, 32, 1, 42, 4, 'D2', 425, 176, 'U', '1', '2016-11-26 15:38:39'),
(204, 2, 189, 32, 1, 42, 4, 'D3', 427, 236, 'U', '1', '2016-11-26 15:38:39'),
(205, 2, 189, 32, 1, 42, 4, 'D4', 367, 175, 'U', '1', '2016-11-26 15:38:39'),
(206, 1, 0, 32, 1, 42, 7, 'S', 151, 367, 'U', '1', '2016-11-26 15:38:39'),
(207, 2, 206, 32, 1, 42, 7, 'S1', 169, 323, 'U', '1', '2016-11-26 15:38:39'),
(208, 2, 206, 32, 1, 42, 7, 'S2', 116, 381, 'U', '1', '2016-11-26 15:38:39'),
(209, 2, 206, 32, 1, 42, 7, 'S3', 168, 402, 'U', '1', '2016-11-26 15:38:39'),
(210, 2, 206, 32, 1, 42, 7, 'S4', 135, 403, 'U', '1', '2016-11-26 15:38:39'),
(211, 2, 206, 32, 1, 42, 7, 'S5', 116, 343, 'U', '1', '2016-11-26 15:38:39'),
(212, 2, 206, 32, 1, 42, 7, 'S6', 139, 324, 'U', '1', '2016-11-26 15:38:39'),
(213, 2, 189, 32, 1, 42, 4, 'D5', 396, 245, 'U', '1', '2016-11-26 15:59:08'),
(214, 2, 186, 32, 1, 42, 1, 'A5', 864, 208, 'U', '1', '2016-11-26 16:47:13'),
(215, 2, 186, 32, 1, 42, 1, 'A6', 902, 170, 'U', '1', '2016-11-26 16:47:24');

-- --------------------------------------------------------

--
-- Table structure for table `facility_type`
--

CREATE TABLE `facility_type` (
  `facility_type_id` int(11) NOT NULL,
  `facility_shape` varchar(100) DEFAULT NULL,
  `facility_type_name` varchar(100) DEFAULT NULL,
  `is_parent` tinyint(1) DEFAULT NULL,
  `_status` char(1) DEFAULT NULL,
  `_user` varchar(50) DEFAULT NULL,
  `_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `facility_type`
--

INSERT INTO `facility_type` (`facility_type_id`, `facility_shape`, `facility_type_name`, `is_parent`, `_status`, `_user`, `_date`) VALUES
(1, 'round', 'Meja', 1, 'A', 'admin', '2016-08-31 00:00:00'),
(2, 'trapezoid', 'Kursi', 0, 'A', 'admin', '2016-08-31 00:00:00'),
(3, 'square', 'Meja Persegi', 1, 'D', 'robin', '2016-08-31 00:00:00'),
(4, 'rectangle', 'Meja Persegi Panjang', 1, 'D', 'robin', '2016-08-31 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `group_id` int(11) NOT NULL,
  `group_name` varchar(50) DEFAULT NULL,
  `bookable` tinyint(1) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  `_status` char(1) DEFAULT NULL,
  `_user` varchar(50) DEFAULT NULL,
  `_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`group_id`, `group_name`, `bookable`, `priority`, `_status`, `_user`, `_date`) VALUES
(0, '', 1, 8, 'A', 'admin', '2016-09-13 00:00:00'),
(1, 'VVIP', 1, 1, 'A', 'admin', '2016-03-25 00:00:00'),
(2, 'VIP', 1, 2, 'A', 'admin', '2016-03-25 00:00:00'),
(3, 'Keluarga', 1, 3, 'A', 'admin', '2016-03-25 00:00:00'),
(4, 'Teman', 1, 4, 'A', 'admin', '2016-03-25 00:00:00'),
(5, 'Tamu', 1, 5, 'A', 'admin', '2016-03-25 00:00:00'),
(6, 'Lainnya', 1, 6, 'A', 'admin', '2016-03-25 00:00:00'),
(7, 'Tambahan', 1, 7, 'A', 'admin', '2016-03-25 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `lottery`
--

CREATE TABLE `lottery` (
  `participant_id` int(11) NOT NULL,
  `prize_id` int(11) NOT NULL,
  `_status` char(1) DEFAULT NULL,
  `_user` varchar(50) DEFAULT NULL,
  `_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lottery`
--

INSERT INTO `lottery` (`participant_id`, `prize_id`, `_status`, `_user`, `_date`) VALUES
(64, 28, 'I', '1', '2016-11-30 10:50:25'),
(63, 28, 'I', '1', '2016-11-30 10:50:25'),
(60, 29, 'I', '1', '2016-11-30 10:50:26');

-- --------------------------------------------------------

--
-- Table structure for table `participant`
--

CREATE TABLE `participant` (
  `participant_id` int(11) NOT NULL,
  `participant_name` varchar(100) DEFAULT NULL,
  `title_id` int(11) DEFAULT NULL,
  `delegate_to` int(11) DEFAULT NULL,
  `follower_prev` int(11) DEFAULT NULL,
  `follower` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `additional_chair` int(11) DEFAULT '0',
  `_status` char(1) DEFAULT NULL,
  `_user` varchar(50) DEFAULT NULL,
  `_date` datetime DEFAULT NULL,
  `phone_num` varchar(100) DEFAULT NULL,
  `is_confirm` tinyint(1) DEFAULT NULL,
  `souvenir_qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `participant`
--

INSERT INTO `participant` (`participant_id`, `participant_name`, `title_id`, `delegate_to`, `follower_prev`, `follower`, `group_id`, `event_id`, `additional_chair`, `_status`, `_user`, `_date`, `phone_num`, `is_confirm`, `souvenir_qty`) VALUES
(45, 'Gunawan', 1, 0, 0, 1, 1, 1, 0, 'I', '1', '2016-11-12 17:40:10', '08324224523', NULL, 1),
(46, 'test', 1, 0, 0, 1, 3, 1, 0, 'I', '1', '2016-11-12 17:40:10', '9876654321', NULL, 1),
(47, 'asd', 1, 0, 0, 1, 2, 1, 0, 'I', '1', '2016-11-12 17:40:11', '123', NULL, 1),
(48, 'sudi mampir', 1, 0, 0, 1, 1, 1, 0, 'I', '1', '2016-11-12 17:40:11', '123123', NULL, 1),
(49, 'kantika', 4, 0, 0, 0, 3, 1, 0, 'I', '1', '2016-11-12 17:40:11', '0832423123', NULL, 1),
(50, 'Bagus', 1, 0, 0, 0, 2, 1, 0, 'I', '1', '2016-11-12 17:40:11', '08324276423', NULL, 1),
(51, 'Cynthia', 3, 0, 0, 1, 2, 1, 0, 'I', '1', '2016-11-12 17:40:11', '08324235741', NULL, 1),
(52, 'Nina', 2, 0, 0, 0, 3, 1, 0, 'U', '1', '2016-11-23 15:01:34', '0832423271', NULL, 1),
(53, 'Budiman', 1, 0, 0, 0, 1, 1, 0, 'U', '17', '2016-11-23 14:15:06', '08324233324', NULL, 1),
(54, 'Deborah', 3, 0, 0, 0, 3, 1, 0, 'I', '1', '2016-11-12 17:40:11', '08324124234', NULL, 1),
(55, 'Joko', 1, 0, 0, 0, 4, 1, 0, 'I', '1', '2016-11-12 17:40:11', '08324233331', NULL, 1),
(56, 'Debby', 4, 0, 0, 0, 4, 1, 0, 'I', '1', '2016-11-12 17:40:11', '08379312423', NULL, 1),
(57, 'ASF', 3, 0, 0, 2, 3, 1, 0, 'U', '1', '2016-11-23 14:53:32', '8234523423', NULL, 1),
(58, 'qwer', 1, 0, 0, 0, 4, 1, 0, 'I', '1', '2016-11-12 17:40:12', '2354565454', NULL, 1),
(59, 'aewf', 4, 0, 0, 0, 4, 1, 0, 'U', '1', '2016-11-24 15:55:25', '345345345', NULL, 1),
(60, 'Anton', 1, 0, 0, 1, 1, 42, 0, 'U', '17', '2016-11-26 16:21:35', '081234567801', 1, 1),
(61, 'Alicia', 2, 0, 0, 0, 2, 42, 0, 'U', '17', '2016-11-26 16:25:32', '081234567802', 1, 1),
(62, 'Agnes', 3, 0, 0, 0, 3, 42, 0, 'U', '17', '2016-11-26 16:41:07', '081234567803', 1, 1),
(63, 'Anna', 4, 0, 0, 0, 4, 42, 0, 'U', '1', '2016-11-30 13:36:08', '081234567804', 1, NULL),
(64, 'Budi', 1, 0, 0, 0, 1, 42, 0, 'U', '17', '2016-11-26 16:54:36', '081234567805', 1, 1),
(65, 'Billy', 1, 67, 0, 1, 2, 42, 0, 'U', '20', '2016-11-26 16:38:38', '081234567806', 0, 1),
(66, 'Bella', 3, 63, 0, 1, 3, 42, 0, 'U', '1', '2016-11-30 13:36:08', '081234567807', 0, 1),
(67, 'Betty', 4, 0, 0, 0, 4, 42, 0, 'U', '20', '2016-11-26 16:38:38', '081234567808', 0, 1),
(68, 'Doni', 1, 0, 0, 1, 1, 42, 0, 'U', '1', '2016-11-26 16:48:57', '081234567809', 1, 1),
(69, 'Debby', 2, 61, 0, 2, 2, 42, 0, 'U', '17', '2016-11-26 16:25:32', '081234567810', 0, 1),
(70, 'Della', 3, 0, 0, 2, 3, 42, 0, 'U', '17', '2016-11-26 16:18:27', '081234567811', 1, 1),
(71, 'Dora', 4, 0, 0, 1, 4, 42, 0, 'U', '17', '2016-11-26 16:41:49', '081234567812', 1, 1),
(72, 'peserta tambahan', 0, 77, 0, 0, 1, 42, 0, 'U', '1', '2016-11-30 14:47:34', '', 0, 1),
(73, 'peserta tambahan', 0, NULL, 0, 0, 2, 42, 0, 'I', '1', '2016-11-28 15:37:30', '', 0, 1),
(74, 'peserta tambahan', 0, NULL, 0, 0, 2, 42, 0, 'I', '1', '2016-11-28 15:37:37', '', 0, 1),
(75, 'testing enhancement', 1, 61, 12, 12, 1, 42, 0, 'D', '1', '2016-11-30 13:32:02', '123', 0, 0),
(76, 'wew', 0, NULL, 0, 0, 0, 42, 0, 'I', '1', '2016-11-30 13:33:17', '', 0, 0),
(77, 'testing enhancement', 1, NULL, 1, 2, 2, 42, 0, 'U', '1', '2016-11-30 14:47:34', 'wew', 0, 2),
(78, 'Billy', 1, NULL, 0, 0, 2, 42, 0, 'U', '1', '2016-11-30 14:09:12', '', 0, 0),
(79, 'okeoke', 1, NULL, 1, 1, 4, 42, 0, 'I', '1', '2016-11-30 15:16:17', '123', 1, 3),
(80, 'okeokeoke', 1, NULL, 1, 1, 4, 42, 0, 'I', '1', '2016-11-30 15:17:15', '123', 1, 3),
(81, 'okeokeokeoke', 1, NULL, 1, 1, 4, 42, 0, 'I', '1', '2016-11-30 15:18:38', '123', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `participant_facility`
--

CREATE TABLE `participant_facility` (
  `event_id` int(11) NOT NULL,
  `facility_id` int(11) NOT NULL,
  `participant_id` int(11) NOT NULL,
  `reserve_at` datetime DEFAULT NULL,
  `checkin_at` datetime DEFAULT NULL,
  `_status` char(1) DEFAULT NULL,
  `_user` varchar(50) DEFAULT NULL,
  `_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `participant_facility`
--

INSERT INTO `participant_facility` (`event_id`, `facility_id`, `participant_id`, `reserve_at`, `checkin_at`, `_status`, `_user`, `_date`) VALUES
(1, 143, 47, '2016-11-12 17:55:43', NULL, 'I', '1', '2016-11-12 17:55:43'),
(1, 144, 49, '2016-11-12 17:59:17', NULL, 'I', '1', '2016-11-12 17:59:17'),
(1, 145, 47, '2016-11-12 17:55:43', NULL, 'I', '1', '2016-11-12 17:55:43'),
(1, 157, 45, '2016-11-12 18:01:20', NULL, 'I', '1', '2016-11-12 18:01:20'),
(1, 159, 45, '2016-11-12 18:01:20', NULL, 'I', '1', '2016-11-12 18:01:20'),
(1, 160, 53, '2016-11-12 18:01:39', NULL, 'U', '17', '2016-11-23 14:15:06'),
(1, 177, 59, '2016-11-12 17:59:39', NULL, 'U', '1', '2016-11-24 15:55:25'),
(1, 178, 58, '2016-11-12 17:59:57', NULL, 'I', '1', '2016-11-12 17:59:57'),
(1, 179, 55, '2016-11-12 18:00:14', NULL, 'I', '1', '2016-11-12 18:00:14'),
(1, 181, 50, '2016-11-12 17:56:43', NULL, 'I', '1', '2016-11-12 17:56:43'),
(42, 190, 60, '2016-11-26 15:40:53', '2016-11-26 16:21:35', 'U', '17', '2016-11-26 16:21:35'),
(42, 191, 64, '2016-11-26 15:51:10', '2016-11-26 16:54:36', 'U', '17', '2016-11-26 16:54:36'),
(42, 192, 64, '2016-11-26 15:51:10', '2016-11-26 16:54:36', 'U', '17', '2016-11-26 16:54:36'),
(42, 193, 60, NULL, '2016-11-26 16:21:35', 'I', '17', '2016-11-26 16:21:35'),
(42, 194, 61, '2016-11-26 15:57:21', '2016-11-26 16:25:32', 'U', '17', '2016-11-26 16:25:32'),
(42, 195, 77, '2016-11-30 14:15:47', '2016-11-30 14:47:34', 'U', '1', '2016-11-30 14:47:34'),
(42, 196, 77, '2016-11-30 14:15:47', '2016-11-30 14:47:34', 'U', '1', '2016-11-30 14:47:34'),
(42, 197, 77, NULL, '2016-11-30 14:47:34', 'I', '1', '2016-11-30 14:47:34'),
(42, 198, 62, '2016-11-26 15:59:40', '2016-11-26 16:41:07', 'U', '17', '2016-11-26 16:41:07'),
(42, 199, 70, '2016-11-26 15:59:59', '2016-11-26 16:18:27', 'U', '17', '2016-11-26 16:18:27'),
(42, 200, 70, '2016-11-26 15:59:59', '2016-11-26 16:18:27', 'U', '17', '2016-11-26 16:18:27'),
(42, 201, 70, '2016-11-26 15:59:59', '2016-11-26 16:18:27', 'U', '17', '2016-11-26 16:18:27'),
(42, 202, 71, '2016-11-26 15:57:58', '2016-11-26 16:41:49', 'U', '17', '2016-11-26 16:41:49'),
(42, 203, 71, '2016-11-26 15:57:58', '2016-11-26 16:41:49', 'U', '17', '2016-11-26 16:41:49'),
(42, 204, 81, NULL, '2016-11-30 15:18:38', 'I', '1', '2016-11-30 15:18:38'),
(42, 205, 63, '2016-11-26 15:59:16', '2016-11-30 13:36:08', 'U', '1', '2016-11-30 13:36:08'),
(42, 207, 67, NULL, '2016-11-26 16:38:38', 'U', '20', '2016-11-26 16:38:38'),
(42, 213, 81, NULL, '2016-11-30 15:18:38', 'I', '1', '2016-11-30 15:18:38'),
(42, 214, 68, '2016-11-26 16:48:16', '2016-11-26 16:48:57', 'U', '1', '2016-11-26 16:48:57'),
(42, 215, 68, '2016-11-26 16:48:16', '2016-11-26 16:48:57', 'U', '1', '2016-11-26 16:48:57');

-- --------------------------------------------------------

--
-- Table structure for table `prize`
--

CREATE TABLE `prize` (
  `prize_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `prize_name` varchar(200) DEFAULT NULL,
  `prize_descr` varchar(500) DEFAULT NULL,
  `prize_priority` int(11) DEFAULT NULL,
  `prize_img` varchar(300) DEFAULT NULL,
  `total_winner` int(11) DEFAULT NULL,
  `_status` char(1) DEFAULT NULL,
  `_user` varchar(50) DEFAULT NULL,
  `_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prize`
--

INSERT INTO `prize` (`prize_id`, `event_id`, `prize_name`, `prize_descr`, `prize_priority`, `prize_img`, `total_winner`, `_status`, `_user`, `_date`) VALUES
(23, 1, 'gelas', 'gelas cantik', 2, 'gelas-cantik.jpg', 3, 'I', '1', '2016-10-09 21:23:57'),
(24, 1, 'payung', 'payung cantik', 1, 'payung.jpg', 1, 'I', '1', '2016-10-09 21:24:11'),
(25, 1, 'asd', 'asd', 0, 'logo_acara_2.png', 0, 'D', '1', '2016-11-24 13:31:51'),
(26, 1, '', '', 0, 'array(14) {\n  ["file_name"]=>\n  string(16) "logo_acara_2.png"\n  ["file_type"]=>\n  string(9) "image/png"\n  ["file_path"]=>\n  string(39) "C:/xampp/htdocs/date/assets/img/hadiah/"\n  ["full_path"]=>\n  string(55) "C:/xampp/htdocs/date/assets/img/hadiah/logo_acara_2.png"\n  ["raw_name"]=>\n  string(12) "log', 0, 'D', '1', '2016-11-24 13:54:21'),
(27, 1, '', '', 0, 'logo_acara_2.png', 0, 'I', '1', '2016-11-24 14:18:40'),
(28, 42, 'Tiket JKT - SIN Round Trip', 'Tiket pulang pergi JKT - SIN - Garuda Indonesia', 2, 'tiket.jpg', 2, 'I', '1', '2016-11-26 12:01:23'),
(29, 42, 'IPhone 7', 'Iphone 7 Black', 1, 'iphone7.jpg', 1, 'I', '1', '2016-11-26 12:01:42');

-- --------------------------------------------------------

--
-- Table structure for table `prize_setting`
--

CREATE TABLE `prize_setting` (
  `prize_id` int(11) NOT NULL,
  `participant_id` varchar(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `_status` char(1) NOT NULL,
  `_user` varchar(50) NOT NULL,
  `_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `souvenir`
--

CREATE TABLE `souvenir` (
  `souvenir_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `souvenir_name` varchar(200) DEFAULT NULL,
  `souvenir_qty` int(11) DEFAULT NULL,
  `_status` char(1) DEFAULT NULL,
  `_user` varchar(50) DEFAULT NULL,
  `_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `souvenir`
--

INSERT INTO `souvenir` (`souvenir_id`, `event_id`, `souvenir_name`, `souvenir_qty`, `_status`, `_user`, `_date`) VALUES
(1, 1, 'gelas', 10, 'A', '0', '2016-08-27 08:02:48'),
(2, 1, 'senter', 5, 'A', '0', '2016-08-27 08:02:48'),
(98, 2, 'piring', 25, 'I', '0', '2016-08-27 09:21:07'),
(99, 2, 'boneka', 50, 'I', '0', '2016-08-27 09:21:07'),
(100, 42, NULL, NULL, 'D', '1', '2016-11-29 22:57:07'),
(101, 42, 'gelas', 1000, 'I', '1', '2016-11-29 22:57:07'),
(102, 42, 'piring', 500, 'I', '1', '2016-11-29 22:57:07');

-- --------------------------------------------------------

--
-- Table structure for table `titles`
--

CREATE TABLE `titles` (
  `title_id` int(11) NOT NULL,
  `title_name` varchar(50) DEFAULT NULL,
  `_status` char(1) DEFAULT NULL,
  `_user` varchar(50) DEFAULT NULL,
  `_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `titles`
--

INSERT INTO `titles` (`title_id`, `title_name`, `_status`, `_user`, `_date`) VALUES
(0, '', 'A', 'admin', '2016-09-11 00:00:00'),
(1, 'Mr. ', 'A', 'admin', '0000-00-00 00:00:00'),
(2, 'Mrs. ', 'A', 'admin', '0000-00-00 00:00:00'),
(3, 'Miss ', 'A', 'admin', '0000-00-00 00:00:00'),
(4, 'Ms. ', 'A', 'admin', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `operator_name` varchar(100) DEFAULT NULL,
  `privilege` int(11) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `_status` char(1) DEFAULT NULL,
  `_user` varchar(50) DEFAULT NULL,
  `_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `operator_name`, `privilege`, `username`, `password`, `_status`, `_user`, `_date`) VALUES
(1, 'admin', 1, 'admin', 'admin', 'A', 'admin', '2016-09-20 00:00:00'),
(2, 'asd', 1, 'asd', 'asd', 'D', '0', '2016-10-07 17:59:41'),
(4, 'wew', 2, 'wew', 'wew', 'D', '0', '2016-10-07 18:31:52'),
(5, 'wew', 1, 'wewz', 'wew', 'D', '0', '2016-10-07 18:32:01'),
(6, '123123', 2, '123', '123123', 'D', '0', '2016-10-07 18:33:15'),
(7, 'wewz', 2, 'wewz', 'wewz', 'D', '0', '2016-10-07 18:43:10'),
(8, 'asd', 2, 'admin', 'asd', 'D', '0', '2016-10-07 18:54:48'),
(9, '', 2, '', '', 'D', '0', '2016-10-07 18:55:52'),
(10, 'admin', 1, 'admin', 'admin', 'D', '0', '2016-10-07 18:56:19'),
(11, 'wew', 1, 'wewz', 'wew', 'D', '0', '2016-10-07 18:56:32'),
(12, 'wew', 1, 'wew', 'wew', 'D', '0', '2016-10-07 18:56:54'),
(13, 'wew', 1, 'wew', 'wew', 'D', '0', '2016-10-07 18:59:11'),
(14, 'wew', 1, 'aaa', 'aaa', 'D', '1', '2016-10-07 18:59:58'),
(15, 'wew', 2, 'wew', 'wew', 'D', '1', '2016-10-07 19:09:05'),
(16, 'wew', 1, 'wewzz', 'wew', 'D', '0', '2016-10-07 19:09:15'),
(17, 'feli', 2, 'feli', 'feli', 'I', '1', '2016-10-09 20:55:13'),
(18, 'peter', 2, 'peter', 'peter', 'I', '1', '2016-11-24 12:27:10'),
(19, 'robin', 2, 'robin', 'robin', 'I', '1', '2016-11-26 16:08:20'),
(20, 'refata', 2, 'refata', 'refata', 'I', '1', '2016-11-26 16:08:32');

-- --------------------------------------------------------

--
-- Table structure for table `verification`
--

CREATE TABLE `verification` (
  `card_id` varchar(30) NOT NULL,
  `verification_date` datetime NOT NULL,
  `_status` char(1) NOT NULL,
  `_user` varchar(50) NOT NULL,
  `_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `verification`
--

INSERT INTO `verification` (`card_id`, `verification_date`, `_status`, `_user`, `_date`) VALUES
('1001-100', '2016-11-26 16:21:35', 'I', '17', '2016-11-26 16:21:35'),
('1002-101', '2016-11-26 16:25:31', 'I', '17', '2016-11-26 16:25:31'),
('1003-102', '2016-11-26 16:41:07', 'I', '17', '2016-11-26 16:41:07'),
('1004-103', '2016-11-26 16:55:54', 'D', '1', '2016-11-30 13:36:08'),
('1004-103', '2016-11-30 13:35:51', 'D', '1', '2016-11-30 13:36:08'),
('1004-103', '2016-11-30 13:36:08', 'I', '1', '2016-11-30 13:36:08'),
('1005-104', '2016-11-26 16:54:35', 'D', '1', '2016-11-30 15:31:15'),
('1008-107', '2016-11-26 16:37:13', 'D', '20', '2016-11-26 16:38:37'),
('1008-107', '2016-11-26 16:38:38', 'I', '20', '2016-11-26 16:38:38'),
('1009-108', '2016-11-26 16:48:57', 'I', '1', '2016-11-26 16:48:57'),
('1011-110', '2016-11-26 16:18:26', 'I', '17', '2016-11-26 16:18:26'),
('1012-111', '2016-11-26 16:41:49', 'I', '17', '2016-11-26 16:41:49'),
('20161130134705-117', '2016-11-30 14:47:34', 'I', '1', '2016-11-30 14:47:34'),
('20161130151617-120', '2016-11-30 15:16:17', 'I', '1', '2016-11-30 15:16:17'),
('20161130151715-121', '2016-11-30 15:17:15', 'I', '1', '2016-11-30 15:17:15'),
('20161130151838-122', '2016-11-30 15:18:38', 'D', '1', '2016-11-30 15:31:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `canvas`
--
ALTER TABLE `canvas`
  ADD PRIMARY KEY (`canvas_id`);

--
-- Indexes for table `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`card_id`);

--
-- Indexes for table `card_design`
--
ALTER TABLE `card_design`
  ADD PRIMARY KEY (`design_id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city`);

--
-- Indexes for table `delegate_verification`
--
ALTER TABLE `delegate_verification`
  ADD PRIMARY KEY (`card_id`,`verification_date`,`delegate_to`);

--
-- Indexes for table `design_component`
--
ALTER TABLE `design_component`
  ADD PRIMARY KEY (`component_id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `event_type`
--
ALTER TABLE `event_type`
  ADD PRIMARY KEY (`event_type_id`);

--
-- Indexes for table `facility`
--
ALTER TABLE `facility`
  ADD PRIMARY KEY (`facility_id`);

--
-- Indexes for table `facility_type`
--
ALTER TABLE `facility_type`
  ADD PRIMARY KEY (`facility_type_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `participant`
--
ALTER TABLE `participant`
  ADD PRIMARY KEY (`participant_id`);

--
-- Indexes for table `participant_facility`
--
ALTER TABLE `participant_facility`
  ADD PRIMARY KEY (`event_id`,`facility_id`,`participant_id`);

--
-- Indexes for table `prize`
--
ALTER TABLE `prize`
  ADD PRIMARY KEY (`prize_id`);

--
-- Indexes for table `prize_setting`
--
ALTER TABLE `prize_setting`
  ADD PRIMARY KEY (`prize_id`,`participant_id`,`group_id`);

--
-- Indexes for table `souvenir`
--
ALTER TABLE `souvenir`
  ADD PRIMARY KEY (`souvenir_id`);

--
-- Indexes for table `titles`
--
ALTER TABLE `titles`
  ADD PRIMARY KEY (`title_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `verification`
--
ALTER TABLE `verification`
  ADD PRIMARY KEY (`card_id`,`verification_date`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `canvas`
--
ALTER TABLE `canvas`
  MODIFY `canvas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `card_design`
--
ALTER TABLE `card_design`
  MODIFY `design_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;
--
-- AUTO_INCREMENT for table `design_component`
--
ALTER TABLE `design_component`
  MODIFY `component_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `facility`
--
ALTER TABLE `facility`
  MODIFY `facility_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=216;
--
-- AUTO_INCREMENT for table `facility_type`
--
ALTER TABLE `facility_type`
  MODIFY `facility_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `participant`
--
ALTER TABLE `participant`
  MODIFY `participant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
--
-- AUTO_INCREMENT for table `prize`
--
ALTER TABLE `prize`
  MODIFY `prize_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `souvenir`
--
ALTER TABLE `souvenir`
  MODIFY `souvenir_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;
--
-- AUTO_INCREMENT for table `titles`
--
ALTER TABLE `titles`
  MODIFY `title_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
