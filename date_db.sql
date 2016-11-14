-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2016 at 12:06 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

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
(31, 1, 'Hall C', 3, 'default.jpg', 1000, 600, 'D', '0', '2016-10-23 13:25:51');

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
('100816001375', 1, 49, 'I', '1', '2016-11-12 17:40:11');

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
(60, 1, 1, 0.72, 49.969, 444.844, 0, 1, NULL, NULL, NULL, NULL, NULL, 0, 'qr', 'U', '1', '2016-10-23 12:32:21'),
(61, 1, 2, 0.51, 150, 250, 0, 0, NULL, NULL, NULL, NULL, 'img/kartu/comp_221954.png', 0, 'comp_221954', 'U', '2', '2016-09-19 22:58:17'),
(62, 1, 3, 1.58, 108.934, 243.884, 0, 2, 'Arial Black', 12, '#ff0000', 1, 's', 0, 'comp_222020', 'U', '2', '2016-09-13 22:20:37'),
(63, 1, 4, 1.04, 141.284, 244.106, 0, 3, 'Abril Fatface', 12, '#000000', 1, 'g', 0, 'comp_222051', 'U', '2', '2016-09-13 22:22:22'),
(64, 1, 5, 6.87, 216, 236, 0, 4, 'Arial Rounded MT Bold', 12, '#1100ff', 0.39, 's', 0, 'comp_222123', 'U', '2', '2016-09-19 23:06:21'),
(65, 1, 6, 1.63, 277.277, 157.014, 0, 5, 'Arial', 12, '#000000', 1, 'sTerima Kasih atas kedatangannya', 0, 'comp_222210', 'U', '2', '2016-09-13 22:22:16'),
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
(78, 2, 5, 1, 129, 281, 269.32, 3, 'Arial', 12, '#000000', 1, 's', 0, 'comp_130405', 'U', '0', '2016-10-24 22:25:25');

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
(4, 'Jumlah Undangan', NULL, 1, 'A', 'admin', '2016-08-27 00:00:00'),
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
  `event_descr` varchar(500) DEFAULT NULL,
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

INSERT INTO `event` (`event_id`, `event_type_id`, `event_name`, `event_descr`, `start_at`, `end_at`, `address`, `city`, `late_tolerance`, `total_invitation`, `is_active`, `_status`, `_user`, `_date`) VALUES
(1, 1, 'Woman''s Festival', 'Woman''s Festival', '2016-08-10 09:00:00', '2016-08-10 14:00:00', 'Jl. Letjen. S. Parman No.28, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11470', 'Jakarta', 0, 1500, 1, 'U', '0', '2016-08-27 08:41:53'),
(2, 2, 'Pernikahan A dan B', 'Pernikahan A dan B', '2016-12-29 19:00:00', '2016-12-29 21:00:00', 'Jl. Jend. Gatot Subroto, Jakarta Selatan, Daerah Khusus Ibukota Jakarta 10270', 'Jakarta', 30, 500, 0, 'U', '0', '2016-08-27 08:49:36'),
(3, 2, 'testz', 'testz', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'asdz', 'Bengkulu', 0, 111, 0, 'D', '0', '2016-08-27 07:56:34'),
(4, 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'Ambon', 0, 0, 0, 'D', '0', '2016-08-25 23:28:13'),
(5, 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'Ambon', 0, 0, 0, 'D', '0', '2016-08-25 23:36:32'),
(6, 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'Ambon', 0, 0, 0, 'D', '0', '2016-08-25 23:36:36'),
(7, 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'Ambon', 0, 0, 0, 'D', '0', '2016-08-25 23:36:40'),
(8, 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'Ambon', 0, 0, 0, 'D', '0', '2016-08-25 23:36:43'),
(9, 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'Ambon', 0, 0, 0, 'D', '0', '2016-08-25 23:36:44'),
(10, 1, 'zzz', 'zzz', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'zzz', 'Banjar', 0, 1111, 0, 'D', '0', '2016-08-26 09:57:37'),
(11, 2, 'a', 'a', '2016-08-19 00:00:00', '2016-08-10 00:00:00', 'test', 'Ambon', 0, 11, 0, 'D', '0', '2016-08-27 07:56:36'),
(12, 2, 'a', 'a', '2016-08-19 00:00:00', '2016-08-10 00:00:00', 'test', 'Ambon', 0, 11, 0, 'D', '0', '2016-08-27 07:56:38'),
(13, 1, 'a', 'a', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'Ambon', 0, 0, 0, 'D', '0', '2016-08-27 08:00:55'),
(14, 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'Ambon', 0, 0, 0, 'D', '0', '2016-08-27 08:00:57'),
(15, 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'Ambon', 0, 0, 0, 'D', '0', '2016-08-27 08:01:52'),
(16, 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'Ambon', 0, 0, 0, 'D', '0', '2016-08-27 08:04:53'),
(17, 2, 'pernikahan abc & def', 'pernikahan abc & def', '2016-08-27 00:00:00', '2016-08-27 00:00:00', 'cp', 'Jakarta', 0, 100, 0, 'D', '0', '2016-08-27 08:18:59'),
(18, 1, 'sunat masal', 'sunat masal', '2016-09-01 08:10:00', '2016-09-01 10:15:00', 'rumah sendiri', 'Banda Aceh', 0, 2000, 0, 'D', '0', '2016-08-27 08:41:04'),
(19, 2, 'aasdasd', 'aasdasd', '1899-12-20 03:00:00', '1899-12-21 08:00:00', 'aaaaa', 'Banjarbaru', 0, 11, 0, 'D', '0', '2016-08-27 08:45:02'),
(20, 1, 'seminar kesehatan', 'seminar kesehatan', '2016-08-29 10:15:00', '2016-08-30 12:00:00', 'sekolah di bandung', 'Bandung', 0, 225, 0, 'D', '0', '2016-08-27 09:20:21');

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
(136, 1, 0, 28, 1, 1, 3, 'meja b', 751, 95, 'U', '1', '2016-10-17 20:13:56'),
(137, 2, 135, 28, 1, 1, 2, 'kursi a1', 260, 346, 'D', '0', '2016-10-17 11:58:42'),
(138, 2, 135, 28, 1, 1, 2, 'kursi a2', 240, 352, 'D', '0', '2016-10-17 11:58:42'),
(139, 2, 135, 28, 1, 1, 2, 'kursi a3', 279, 355, 'D', '0', '2016-10-17 11:58:42'),
(140, 2, 136, 28, 1, 1, 3, 'kursi b1', 718, 72, 'U', '1', '2016-10-17 20:13:56'),
(141, 2, 136, 28, 1, 1, 3, 'kursi b2', 778, 117, 'U', '1', '2016-10-17 20:13:56'),
(142, 1, 0, 28, 1, 1, 2, 'meja a', 519, 297, 'U', '1', '2016-10-17 20:13:09'),
(143, 2, 142, 28, 1, 1, 2, 'kursi a1', 480, 294, 'U', '1', '2016-10-17 20:13:09'),
(144, 2, 136, 28, 1, 1, 3, 'kursi b3', 717, 117, 'U', '1', '2016-10-17 20:13:56'),
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
(181, 2, 142, 28, 1, 1, 2, 'kursi a3', 518, 258, 'U', '1', '2016-11-01 06:24:43');

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
(5, 23, 'D', '0', '2016-10-19 22:07:54'),
(9, 23, 'D', '0', '2016-10-19 22:07:54'),
(7, 23, 'I', '0', '2016-10-19 22:07:54'),
(4, 23, 'I', '0', '2016-10-19 22:08:14'),
(1, 23, 'I', '0', '2016-10-19 22:08:14');

-- --------------------------------------------------------

--
-- Table structure for table `participant`
--

CREATE TABLE `participant` (
  `participant_id` int(11) NOT NULL,
  `participant_name` varchar(100) DEFAULT NULL,
  `title_id` int(11) DEFAULT NULL,
  `delegate_to` int(11) DEFAULT NULL,
  `follower` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `additional_chair` int(11) DEFAULT '0',
  `_status` char(1) DEFAULT NULL,
  `_user` varchar(50) DEFAULT NULL,
  `_date` datetime DEFAULT NULL,
  `phone_num` varchar(100) DEFAULT NULL,
  `is_confirm` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `participant`
--

INSERT INTO `participant` (`participant_id`, `participant_name`, `title_id`, `delegate_to`, `follower`, `group_id`, `event_id`, `additional_chair`, `_status`, `_user`, `_date`, `phone_num`, `is_confirm`) VALUES
(45, 'Gunawan', 1, 0, 1, 1, 1, 0, 'I', '1', '2016-11-12 17:40:10', '08324224523', NULL),
(46, 'test', 1, 0, 1, 3, 1, 0, 'I', '1', '2016-11-12 17:40:10', '9876654321', NULL),
(47, 'asd', 1, 0, 1, 2, 1, 0, 'I', '1', '2016-11-12 17:40:11', '123', NULL),
(48, 'sudi mampir', 1, 0, 1, 1, 1, 0, 'I', '1', '2016-11-12 17:40:11', '123123', NULL),
(49, 'kantika', 4, 0, 0, 3, 1, 0, 'I', '1', '2016-11-12 17:40:11', '0832423123', NULL),
(50, 'Bagus', 1, 0, 0, 2, 1, 0, 'I', '1', '2016-11-12 17:40:11', '08324276423', NULL),
(51, 'Cynthia', 3, 0, 1, 2, 1, 0, 'I', '1', '2016-11-12 17:40:11', '08324235741', NULL),
(52, 'Nina', 2, 0, 1, 3, 1, 0, 'I', '1', '2016-11-12 17:40:11', '0832423271', NULL),
(53, 'Budiman', 1, 0, 0, 1, 1, 0, 'I', '1', '2016-11-12 17:40:11', '08324233324', NULL),
(54, 'Deborah', 3, 0, 0, 3, 1, 0, 'I', '1', '2016-11-12 17:40:11', '08324124234', NULL),
(55, 'Joko', 1, 0, 0, 4, 1, 0, 'I', '1', '2016-11-12 17:40:11', '08324233331', NULL),
(56, 'Debby', 4, 0, 0, 4, 1, 0, 'I', '1', '2016-11-12 17:40:11', '08379312423', NULL),
(57, 'ASF', 3, 0, 1, 3, 1, 0, 'I', '1', '2016-11-12 17:40:12', '8234523423', NULL),
(58, 'qwer', 1, 0, 0, 4, 1, 0, 'I', '1', '2016-11-12 17:40:12', '2354565454', NULL),
(59, 'aewf', 4, 0, 0, 4, 1, 0, 'I', '1', '2016-11-12 17:40:12', '345345345', NULL);

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
(1, 140, 52, '2016-11-12 17:57:33', NULL, 'I', '1', '2016-11-12 17:57:33'),
(1, 141, 52, '2016-11-12 17:57:33', NULL, 'I', '1', '2016-11-12 17:57:33'),
(1, 143, 47, '2016-11-12 17:55:43', NULL, 'I', '1', '2016-11-12 17:55:43'),
(1, 144, 49, '2016-11-12 17:59:17', NULL, 'I', '1', '2016-11-12 17:59:17'),
(1, 145, 47, '2016-11-12 17:55:43', NULL, 'I', '1', '2016-11-12 17:55:43'),
(1, 154, 57, '2016-11-12 18:02:30', NULL, 'I', '1', '2016-11-12 18:02:30'),
(1, 155, 57, '2016-11-12 18:02:30', NULL, 'I', '1', '2016-11-12 18:02:30'),
(1, 157, 45, '2016-11-12 18:01:20', NULL, 'I', '1', '2016-11-12 18:01:20'),
(1, 159, 45, '2016-11-12 18:01:20', NULL, 'I', '1', '2016-11-12 18:01:20'),
(1, 160, 53, '2016-11-12 18:01:39', NULL, 'I', '1', '2016-11-12 18:01:39'),
(1, 177, 59, '2016-11-12 17:59:39', NULL, 'I', '1', '2016-11-12 17:59:39'),
(1, 178, 58, '2016-11-12 17:59:57', NULL, 'I', '1', '2016-11-12 17:59:57'),
(1, 179, 55, '2016-11-12 18:00:14', NULL, 'I', '1', '2016-11-12 18:00:14'),
(1, 181, 50, '2016-11-12 17:56:43', NULL, 'I', '1', '2016-11-12 17:56:43');

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
(24, 1, 'payung', 'payung cantik', 1, 'payung.jpg', 1, 'I', '1', '2016-10-09 21:24:11');

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
(99, 2, 'boneka', 50, 'I', '0', '2016-08-27 09:21:07');

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
(17, 'feli', 2, 'feli', 'feli', 'I', '1', '2016-10-09 20:55:13');

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
  MODIFY `canvas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `card_design`
--
ALTER TABLE `card_design`
  MODIFY `design_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
--
-- AUTO_INCREMENT for table `design_component`
--
ALTER TABLE `design_component`
  MODIFY `component_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `facility`
--
ALTER TABLE `facility`
  MODIFY `facility_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;
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
  MODIFY `participant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `prize`
--
ALTER TABLE `prize`
  MODIFY `prize_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `souvenir`
--
ALTER TABLE `souvenir`
  MODIFY `souvenir_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;
--
-- AUTO_INCREMENT for table `titles`
--
ALTER TABLE `titles`
  MODIFY `title_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
