-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2023 at 08:02 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
--

CREATE TABLE `agenda` (
  `id` int(11) NOT NULL,
  `judul` varchar(190) NOT NULL,
  `deskripsi` longtext DEFAULT NULL,
  `mulai` date NOT NULL,
  `selesai` date DEFAULT NULL,
  `warna` varchar(45) NOT NULL,
  `karyawans_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `agenda`
--

INSERT INTO `agenda` (`id`, `judul`, `deskripsi`, `mulai`, `selesai`, `warna`, `karyawans_id`) VALUES
(1, 'Coba Vendor', 'vendornya dicoba', '2023-11-21', '2023-11-21', '#ff0000', 0),
(2, 'Meeting Client', 'Bertemu dengan Client untuk mendiskusikan harga', '2023-11-21', '2023-11-21', '#ff0000', 0),
(3, 'Meeting Client B', 'Bertemu dengan Client untuk mendiskusikan harga', '2023-11-22', '2023-11-22', '#ff0000', 0),
(4, 'test program', 'coba 1 lagi', '2023-11-23', '2023-11-24', '#ff0000', 0),
(5, 'coba', 'coba satu dua', '2023-11-16', '2023-11-18', '#ff0000', 0),
(6, 'tes', '123123123', '2023-11-14', '2023-11-24', '#0000ff', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `nama_pelanggan` longtext NOT NULL,
  `alamat_pelanggan` longtext NOT NULL,
  `nohp_pelanggan` varchar(99) NOT NULL,
  `sapaan` varchar(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `nama_pelanggan`, `alamat_pelanggan`, `nohp_pelanggan`, `sapaan`) VALUES
(1, 'Hans', 'Alamat sesungguhnya', '081299996666', ''),
(2, 'Elma Hastuti', 'Jln. Bara Tambar No. 627, Tasikmalaya 68728, Aceh', '081191403896', ''),
(3, 'Irnanto Sinaga', 'Dk. Sugiyopranoto No. 821, Surakarta 35485, JaTim', '081162830605', ''),
(4, 'Novi Hastuti', 'Dk. Pattimura No. 669, Tegal 25017, JaTeng', '081634213939', ''),
(5, 'Ulya Pratiwi ', 'Psr. Cihampelas No. 124, Makassar 92678, Lampung', '081682536144', ''),
(6, 'Kenes Hutagalung', 'Kpg. Uluwatu No. 352, Pagar Alam 60228, DIY', '08175243008', ''),
(7, 'Septi Mardhiyah', 'Jln. Bahagia  No. 492, Sungai Penuh 24561, KalTim', '0854564406475', ''),
(8, 'Ajeng Mandasari', 'Psr. Salak No. 388, Banjarbaru 61225, DIY', '08062746473', ''),
(9, 'Coba data pelanggan', 'JALAN SIMO POMAHAN BARU NO 3 KEL. SIMOMULYO BARU KEC. SUKOMANUNGGAL SURABAYA', '123123123123', '');

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id`, `nama`) VALUES
(1, 'Driver'),
(2, 'Kepala Gudang'),
(3, 'Teknisi'),
(4, 'Sales'),
(5, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `PIC` int(11) NOT NULL,
  `customers_id` int(11) NOT NULL,
  `nama` mediumtext NOT NULL,
  `tanggal` datetime NOT NULL,
  `lokasi` longtext NOT NULL,
  `jenis kegiatan` varchar(45) NOT NULL,
  `budget` int(11) DEFAULT NULL,
  `status` varchar(45) NOT NULL,
  `jabatan_client` varchar(45) NOT NULL,
  `catatan` longtext DEFAULT NULL,
  `waktu_loading` datetime NOT NULL,
  `jam_mulai_acara` datetime NOT NULL,
  `jam_selesai_acara` datetime NOT NULL,
  `waktu_loading_out` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `PIC`, `customers_id`, `nama`, `tanggal`, `lokasi`, `jenis kegiatan`, `budget`, `status`, `jabatan_client`, `catatan`, `waktu_loading`, `jam_mulai_acara`, `jam_selesai_acara`, `waktu_loading_out`) VALUES
(1, 3, 3, 'JAFEST', '2023-12-12 00:52:39', '', '', 0, 'Draft', 'Koordinator Acara', NULL, '2023-11-20 14:13:56', '2023-11-20 14:13:54', '2023-11-20 14:13:55', '2023-11-20 14:13:57'),
(2, 2, 1, 'Pesta Bintang Malam', '2023-12-03 00:52:45', '', '', 0, 'Menunggu Persetujuan', 'Ketua Acara', NULL, '2023-10-23 11:00:00', '2023-10-23 15:00:00', '2023-10-23 23:00:00', '2023-10-24 00:00:00'),
(3, 5, 2, 'Harmoni Seni Lokal', '2023-12-12 00:52:48', '', '', 0, 'Diproses', 'Koordinator Perlengkapan', NULL, '2023-10-11 10:00:00', '2023-10-11 18:00:00', '2023-10-11 22:00:00', '2023-10-11 23:00:00'),
(4, 7, 3, 'Serba Seru Weekend Fiesta', '2023-12-06 00:52:51', '', '', 0, 'Diterima', 'Manajer Pemasaran', NULL, '2023-10-04 02:00:00', '2023-10-04 09:00:00', '2023-10-04 14:00:00', '2023-10-04 15:00:00'),
(5, 1, 4, 'Inspirasi Kreatif Expo', '2023-11-15 00:52:55', '', '', 0, 'Event Berlangsung', 'Koordinator Acara', NULL, '2023-10-08 07:00:00', '2023-10-08 11:00:00', '2023-10-08 19:00:00', '2023-10-08 20:00:00'),
(6, 3, 5, 'Santai di Bawah Bintang', '2023-11-04 00:52:58', '', '', 0, 'Selesai', 'Ketua Acara', NULL, '2023-10-10 11:00:00', '2023-10-10 18:00:00', '2023-10-10 23:00:00', '2023-10-11 00:00:00'),
(7, 5, 6, 'Festival Kuliner Asli', '2023-11-19 00:53:03', '', '', 0, 'Tagihan', 'Koordinator Perlengkapan', NULL, '2023-10-27 10:00:00', '2023-10-27 18:00:00', '2023-10-27 22:00:00', '2023-10-27 23:00:00'),
(8, 7, 4, 'Pasar Seni Urban', '2023-10-10 00:53:08', '', '', 0, 'Diterima', 'Manajer Pemasaran', NULL, '2023-10-01 01:00:00', '2023-10-01 08:00:00', '2023-10-01 13:00:00', '2023-10-01 14:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `events_has_divisi`
--

CREATE TABLE `events_has_divisi` (
  `events_id` int(11) NOT NULL,
  `divisi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` varchar(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `tanggal_jatuh_tempo` datetime NOT NULL,
  `diskon` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `catatan` longtext DEFAULT NULL,
  `events_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `tanggal`, `tanggal_jatuh_tempo`, `diskon`, `total_harga`, `catatan`, `events_id`) VALUES
('1', '2023-12-11 18:59:53', '2023-12-11 18:59:53', 0, 5000000, NULL, 1),
('2', '2023-12-11 19:31:19', '2023-12-11 19:31:19', 0, 2000000, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `item_barang`
--

CREATE TABLE `item_barang` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `type` enum('serial','batch') NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `satuan` enum('unit','set') DEFAULT NULL,
  `tanggalBeli` datetime DEFAULT NULL,
  `hargaBeli` int(11) DEFAULT NULL,
  `jenis_barang_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `item_barang`
--

INSERT INTO `item_barang` (`id`, `nama`, `type`, `qty`, `satuan`, `tanggalBeli`, `hargaBeli`, `jenis_barang_id`) VALUES
(1, '', '', 64, 'unit', '1971-02-26 02:47:30', 755656, 3),
(2, '', '', 82, 'unit', '2015-03-12 16:46:16', 339316, 11),
(3, '', '', 40, 'unit', '2002-10-26 21:09:32', 827056, 35),
(4, '', '', 3, 'set', '2009-09-15 02:12:12', 965324, 25),
(5, '', '', 86, 'set', '2006-11-19 15:51:25', 87620, 23),
(6, '', '', 57, 'set', '1990-10-11 17:58:34', 752722, 3),
(7, '', '', 95, 'set', '2004-10-04 02:20:14', 982152, 27),
(8, '', '', 52, 'set', '1983-02-16 02:34:59', 573917, 32),
(9, '', '', 63, 'unit', '1994-06-04 20:14:15', 987948, 33),
(10, '', '', 83, 'set', '2011-11-05 18:46:22', 970723, 39),
(11, '', '', 82, 'set', '1987-11-23 07:41:16', 492789, 24),
(12, '', '', 88, 'unit', '1997-05-30 06:55:59', 689410, 6),
(13, '', '', 41, 'set', '1998-11-17 17:51:27', 451254, 17),
(14, '', '', 97, 'set', '1996-12-23 21:26:26', 686043, 28),
(15, '', '', 76, 'set', '1974-07-13 22:07:18', 597737, 38),
(16, '', '', 64, 'set', '2000-08-03 06:44:47', 518169, 26),
(17, '', '', 8, 'unit', '2009-06-27 13:59:23', 756275, 35),
(18, '', '', 0, 'unit', '2000-01-09 15:17:37', 549684, 28),
(19, '', '', 20, 'unit', '2021-04-03 10:12:58', 421368, 30),
(20, '', '', 45, 'unit', '1999-12-11 20:42:11', 997058, 17),
(21, '', '', 13, 'unit', '1999-07-19 05:44:23', 289517, 33),
(22, '', '', 72, 'unit', '1990-12-25 14:59:26', 452191, 11),
(23, '', '', 38, 'unit', '1995-11-13 03:04:17', 967755, 21),
(24, '', '', 23, 'unit', '1998-04-22 01:57:24', 940523, 40),
(25, '', '', 22, 'set', '2008-05-13 09:37:53', 826773, 2),
(26, '', '', 68, 'unit', '2016-10-31 20:33:09', 376282, 2),
(27, '', '', 66, 'unit', '1998-10-23 15:23:56', 38726, 41),
(28, '', '', 78, 'set', '1983-12-04 06:24:21', 87621, 27),
(29, '', '', 93, 'unit', '2009-06-22 00:48:41', 732122, 12),
(30, '', '', 64, 'set', '2008-09-24 18:49:44', 784465, 41),
(31, '', '', 45, 'unit', '1990-09-26 02:29:06', 411563, 9),
(32, '', '', 12, 'set', '1983-08-17 23:56:43', 533910, 18),
(33, '', '', 90, 'unit', '2009-03-08 21:16:38', 782185, 34),
(34, '', '', 71, 'unit', '1985-04-03 00:42:47', 309525, 26),
(35, '', '', 35, 'unit', '2011-02-09 14:26:07', 191828, 26),
(36, '', '', 15, 'set', '2021-08-17 16:19:33', 94835, 31),
(37, '', '', 78, 'unit', '1989-08-31 07:22:41', 149191, 24),
(38, '', '', 1, 'set', '2020-11-30 19:49:32', 308700, 36),
(39, '', '', 93, 'unit', '1998-08-17 09:19:26', 330452, 41),
(40, '', '', 17, 'unit', '1996-08-09 20:34:31', 261404, 27),
(41, '', '', 52, 'unit', '2021-04-24 01:21:49', 379817, 11),
(42, '', '', 99, 'unit', '1987-08-08 00:23:13', 878381, 37),
(43, '', '', 79, 'set', '2022-06-27 11:50:27', 666069, 19),
(44, '', '', 66, 'unit', '1994-11-17 14:28:44', 363485, 14),
(45, '', '', 77, 'set', '2020-01-16 14:03:31', 748702, 1),
(46, '', '', 74, 'set', '2009-08-23 19:57:06', 492994, 5),
(47, '', '', 84, 'unit', '1987-11-30 06:50:51', 116939, 32),
(48, '', '', 66, 'set', '2005-04-13 20:06:01', 569987, 12),
(49, '', '', 70, 'set', '1988-06-30 18:55:59', 513938, 30),
(50, '', '', 73, 'unit', '1984-03-04 22:37:34', 252129, 11),
(51, '', '', 59, 'unit', '2010-11-10 19:37:53', 878113, 33),
(52, '', '', 77, 'unit', '1995-11-07 01:56:51', 86746, 2),
(53, '', '', 16, 'set', '2011-10-20 15:57:26', 518289, 41),
(54, '', '', 38, 'unit', '1977-04-08 00:55:31', 850469, 33),
(55, '', '', 42, 'unit', '1986-02-11 18:05:14', 805289, 14),
(56, '', '', 36, 'set', '2011-12-31 17:48:54', 657122, 18),
(57, '', '', 68, 'set', '1994-09-16 22:49:00', 396797, 26),
(58, '', '', 46, 'set', '1986-05-07 23:47:50', 158955, 1),
(59, '', '', 3, 'set', '1995-01-24 16:29:55', 355013, 9),
(60, '', '', 67, 'set', '1991-01-03 17:24:46', 676866, 25),
(61, '', '', 45, 'set', '1985-06-21 08:28:59', 794216, 14),
(62, '', '', 19, 'set', '1984-11-07 01:53:17', 877721, 29),
(63, '', '', 49, 'set', '2014-08-14 02:47:37', 783301, 10),
(64, '', '', 14, 'unit', '2014-06-08 13:38:34', 957523, 13),
(65, '', '', 13, 'set', '2012-12-01 20:06:44', 590684, 32),
(66, '', '', 58, 'set', '1992-11-23 03:34:08', 200913, 2),
(67, '', '', 87, 'set', '1977-08-07 18:20:20', 188690, 30),
(68, '', '', 52, 'set', '2021-04-30 05:33:35', 327452, 21),
(69, '', '', 58, 'unit', '2004-04-29 07:48:27', 372331, 39),
(70, '', '', 84, 'unit', '1998-08-02 18:47:36', 908662, 32),
(71, '', '', 96, 'unit', '2021-08-14 12:55:41', 473790, 4),
(72, '', '', 77, 'set', '1990-06-12 06:19:19', 894741, 20),
(73, '', '', 89, 'unit', '1979-12-05 23:05:01', 79870, 32),
(74, '', '', 77, 'unit', '1972-03-11 10:28:25', 186901, 28),
(75, '', '', 6, 'set', '2008-11-01 01:28:15', 349009, 7),
(76, '', '', 35, 'unit', '1996-10-10 19:33:45', 125475, 5),
(77, '', '', 67, 'unit', '1984-02-11 06:09:58', 498940, 12),
(78, '', '', 48, 'set', '1972-04-13 23:23:59', 650526, 31),
(79, '', '', 95, 'set', '2019-03-24 09:56:21', 33985, 16),
(80, '', '', 9, 'set', '1978-05-28 19:09:20', 205012, 25),
(81, '', '', 81, 'unit', '2018-09-27 10:04:44', 23958, 2),
(82, '', '', 84, 'set', '1972-09-22 21:57:54', 859006, 18),
(83, '', '', 29, 'set', '1995-08-07 18:53:47', 833088, 24),
(84, '', '', 66, 'unit', '2022-06-01 12:27:49', 12868, 4),
(85, '', '', 93, 'set', '2017-08-09 14:03:09', 68103, 11),
(86, '', '', 19, 'unit', '2010-01-07 02:28:25', 916405, 18),
(87, '', '', 33, 'unit', '1995-01-27 08:12:07', 971848, 9),
(88, '', '', 84, 'set', '2014-05-06 08:04:44', 27050, 21),
(89, '', '', 82, 'set', '1976-04-28 04:07:57', 81547, 30),
(90, '', '', 77, 'set', '1973-02-22 19:58:06', 384333, 2),
(91, '', '', 2, 'unit', '2023-01-08 20:07:46', 415393, 33),
(92, '', '', 38, 'unit', '1995-07-05 15:59:00', 147032, 38),
(93, '', '', 31, 'unit', '1979-06-24 19:53:13', 264004, 33),
(94, '', '', 91, 'set', '2005-01-18 21:40:28', 907721, 30),
(95, '', '', 41, 'unit', '2008-07-21 04:31:28', 725445, 12),
(96, '', '', 25, 'unit', '2008-12-24 21:50:10', 425224, 24),
(97, '', '', 69, 'set', '2023-07-14 10:39:48', 178619, 15),
(98, '', '', 72, 'set', '2020-09-30 19:49:03', 762262, 4),
(99, '', '', 89, 'unit', '2023-06-30 14:16:40', 769194, 11),
(100, '', '', 73, 'set', '1984-10-08 07:35:18', 885562, 16);

-- --------------------------------------------------------

--
-- Table structure for table `item_barang_has_invoices`
--

CREATE TABLE `item_barang_has_invoices` (
  `item_barang_id` int(11) NOT NULL,
  `invoices_id` varchar(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `status_in` datetime NOT NULL,
  `status_out` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `item_barang_has_invoices`
--

INSERT INTO `item_barang_has_invoices` (`item_barang_id`, `invoices_id`, `qty`, `status_in`, `status_out`) VALUES
(1, '1', 2, '2023-12-14 12:53:34', '2023-12-14 13:53:34'),
(1, '2', 3, '2023-12-14 18:54:46', '2023-12-15 18:54:46'),
(2, '1', 2, '2023-12-14 12:54:46', '2023-12-15 18:54:46'),
(4, '2', 1, '2023-12-14 12:54:46', '2023-12-14 19:55:59');

-- --------------------------------------------------------

--
-- Table structure for table `item_barang_has_item_shipping`
--

CREATE TABLE `item_barang_has_item_shipping` (
  `item_barang_id` int(11) NOT NULL,
  `item_shipping_id` int(11) NOT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `item_barang_has_item_shipping`
--

INSERT INTO `item_barang_has_item_shipping` (`item_barang_id`, `item_shipping_id`, `qty`) VALUES
(1, 1, 2),
(2, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `item_damage`
--

CREATE TABLE `item_damage` (
  `id` int(11) NOT NULL,
  `damage_date` datetime NOT NULL,
  `damage_type` varchar(45) NOT NULL,
  `damage_details` varchar(200) DEFAULT NULL,
  `repair_status` varchar(45) DEFAULT NULL,
  `repair_date` datetime DEFAULT NULL,
  `repair_notes` varchar(200) DEFAULT NULL,
  `estimated_completion` datetime DEFAULT NULL,
  `user_reporter` int(11) NOT NULL,
  `item_barang_id` int(11) NOT NULL,
  `user_servicer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `item_damage`
--

INSERT INTO `item_damage` (`id`, `damage_date`, `damage_type`, `damage_details`, `repair_status`, `repair_date`, `repair_notes`, `estimated_completion`, `user_reporter`, `item_barang_id`, `user_servicer`) VALUES
(1, '2023-12-14 19:16:43', 'Suara', 'Suara tidak keluar', 'Selesai', '2023-12-15 19:16:43', 'Sudah oke mas', '2023-12-15 18:16:43', 1, 1, 5),
(2, '2023-12-13 19:16:43', 'Cahaya', 'Lampu tidak menyala', 'Proses', NULL, NULL, '2023-12-15 19:16:43', 1, 10, 6);

-- --------------------------------------------------------

--
-- Table structure for table `item_shipping`
--

CREATE TABLE `item_shipping` (
  `id` int(11) NOT NULL,
  `jenis` enum('Kirim','Jemput') DEFAULT NULL,
  `driver` int(11) NOT NULL,
  `events_id` int(11) NOT NULL,
  `tglInput` datetime DEFAULT NULL,
  `tglJalan` datetime DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `item_shipping`
--

INSERT INTO `item_shipping` (`id`, `jenis`, `driver`, `events_id`, `tglInput`, `tglJalan`, `notes`) VALUES
(1, 'Kirim', 2, 1, '2023-12-14 12:58:10', '2023-12-15 18:58:11', NULL),
(2, 'Kirim', 2, 1, '2023-12-14 12:58:10', '2023-12-15 19:58:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_barang`
--

CREATE TABLE `jenis_barang` (
  `id` int(11) NOT NULL,
  `nama` mediumtext DEFAULT NULL,
  `harga_sewa` int(11) DEFAULT NULL,
  `kategori_barang_id` int(11) NOT NULL,
  `spesifikasi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `jenis_barang`
--

INSERT INTO `jenis_barang` (`id`, `nama`, `harga_sewa`, `kategori_barang_id`, `spesifikasi`) VALUES
(1, 'Sound System 1000w', 1000000, 1, 'Ini Deskripsi untuk Sound System 1000w'),
(2, 'Sound System 2000w', 1500000, 1, 'Ini Deskripsi untuk Sound System 2000w'),
(3, 'Sound System 3000w', 1750000, 1, 'Ini Deskripsi untuk Sound System 3000w'),
(4, 'Sound System 4000w', 2200000, 1, 'Ini Deskripsi untuk Sound System 4000w'),
(5, 'Sound System 5000w', 2750000, 1, 'Ini Deskripsi untuk Sound System 5000w'),
(6, 'Sound System 6000w', 3300000, 1, 'Ini Deskripsi untuk Sound System 6000w'),
(7, 'Sound System 7000w', 3850000, 1, 'Ini Deskripsi untuk Sound System 7000w'),
(8, 'Sound System 8000w', 4400000, 1, 'Ini Deskripsi untuk Sound System 8000w'),
(9, 'Sound System 9000w', 4950000, 1, 'Ini Deskripsi untuk Sound System 9000w'),
(10, 'Sound System 10000w', 5500000, 1, 'Ini Deskripsi untuk Sound System 10000w'),
(11, 'Sound System 20000w', 11000000, 1, 'Ini Deskripsi untuk Sound System 20000w'),
(12, 'Mic Wireless', 250000, 1, 'Ini Deskripsi untuk Mic Wireless'),
(13, 'Ampli Guitar', 300000, 1, 'Ini Deskripsi untuk Ampli Guitar'),
(14, 'Ampli Bass', 300000, 1, 'Ini Deskripsi untuk Ampli Bass'),
(15, 'Drum Elektrik', 450000, 1, 'Ini Deskripsi untuk Drum Elektrik'),
(16, 'Drum Accoustic Tama', 500000, 1, 'Ini Deskripsi untuk Drum Accoustic Tama'),
(17, 'Bass Instrument', 200000, 1, 'Ini Deskripsi untuk Bass Instrument'),
(18, 'Guitar Instrument', 200000, 1, 'Ini Deskripsi untuk Guitar Instrument'),
(19, 'Keyboard Yamaha PSR950', 500000, 1, 'Ini Deskripsi untuk Keyboard Yamaha PSR950'),
(20, 'Keyboard Korg RD700', 750000, 1, 'Ini Deskripsi untuk Keyboard Korg RD700'),
(21, 'Stand Mic', 20000, 1, 'Ini Deskripsi untuk Stand Mic'),
(22, 'Stand Double Keyboard', 100000, 1, 'Ini Deskripsi untuk Stand Double Keyboard'),
(23, 'Stand Book', 20000, 1, 'Ini Deskripsi untuk Stand Book'),
(24, 'Mixer Audio Midas M32', 1000000, 1, 'Ini Deskripsi untuk Mixer Audio Midas M32'),
(25, 'Mixer Audio QSC32', 800000, 1, 'Ini Deskripsi untuk Mixer Audio QSC32'),
(26, 'Mixer Audio QSC16', 500000, 1, 'Ini Deskripsi untuk Mixer Audio QSC16'),
(27, 'Mixer Audio Analog 8ch', 100000, 1, 'Ini Deskripsi untuk Mixer Audio Analog 8ch'),
(28, 'Fresnell COB', 250000, 2, 'Ini Deskripsi untuk Fresnell COB'),
(29, 'Fresnell 2000w', 350000, 2, 'Ini Deskripsi untuk Fresnell 2000w'),
(30, 'Parled Outdoor', 200000, 2, 'Ini Deskripsi untuk Parled Outdoor'),
(31, 'Parled Indoor', 150000, 2, 'Ini Deskripsi untuk Parled Indoor'),
(32, 'Parled CTO', 150000, 2, 'Ini Deskripsi untuk Parled CTO'),
(33, 'Moving Beam 230', 450000, 2, 'Ini Deskripsi untuk Moving Beam 230'),
(34, 'Moving Beam 260', 550000, 2, 'Ini Deskripsi untuk Moving Beam 260'),
(35, 'Strobo LED', 400000, 2, 'Ini Deskripsi untuk Strobo LED'),
(36, 'Mini Brute', 450000, 2, 'Ini Deskripsi untuk Mini Brute'),
(37, 'Tripod Lighting Heavy Duty', 0, 2, 'Ini Deskripsi untuk Tripod Lighting Heavy Dut'),
(38, 'Flood Light 500w', 200000, 2, 'Ini Deskripsi untuk Flood Light 500w'),
(39, 'LED Screen Videotron', 600000, 3, 'Ini Deskripsi untuk LED Screen Videotron'),
(40, 'Proyektor 5000', 1000000, 4, 'Ini Deskripsi untuk Proyektor 5000'),
(41, 'Screen 2.5x2.5m', 200000, 4, 'Ini Deskripsi untuk Screen 2.5x2.5m'),
(42, 'Screen 3x4m', 400000, 4, 'Ini Deskripsi untuk Screen 3x4m');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_barang_has_events`
--

CREATE TABLE `jenis_barang_has_events` (
  `jenis_barang_id` int(11) NOT NULL,
  `events_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga_barang` int(11) DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `karyawans`
--

CREATE TABLE `karyawans` (
  `id` int(11) NOT NULL,
  `username` mediumtext NOT NULL,
  `password` varchar(99) NOT NULL,
  `email` mediumtext NOT NULL,
  `nama` longtext NOT NULL,
  `nomer_telepon` mediumtext NOT NULL,
  `divisi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `karyawans`
--

INSERT INTO `karyawans` (`id`, `username`, `password`, `email`, `nama`, `nomer_telepon`, `divisi_id`) VALUES
(1, 'alvin', '$2y$10$H5EIVJ12771oq1gqQnp.2eCcz2f0uIN8NKJc5Qgyb0Gcv80tmTpBC', 'coba@gmail.com', 'Alvin', '123456789012', 5),
(2, 'hans', '$2y$10$H5EIVJ12771oq1gqQnp.2eCcz2f0uIN8NKJc5Qgyb0Gcv80tmTpBC', 'halo@gmail.com', 'Hans', '123456789014', 1),
(3, 'john', '$2y$10$H5EIVJ12771oq1gqQnp.2eCcz2f0uIN8NKJc5Qgyb0Gcv80tmTpBC', 'john@example.com', 'John', '123456789016', 2),
(4, 'emma', '$2y$10$H5EIVJ12771oq1gqQnp.2eCcz2f0uIN8NKJc5Qgyb0Gcv80tmTpBC', 'emma@gmail.com', 'Emma', '123456789018', 2),
(5, 'alex', '$2y$10$H5EIVJ12771oq1gqQnp.2eCcz2f0uIN8NKJc5Qgyb0Gcv80tmTpBC', 'alex@example.com', 'Alex', '123456789020', 3),
(6, 'lisa', '$2y$10$H5EIVJ12771oq1gqQnp.2eCcz2f0uIN8NKJc5Qgyb0Gcv80tmTpBC', 'lisa@gmail.com', 'Lisa', '123456789022', 3),
(7, 'mike', '$2y$10$H5EIVJ12771oq1gqQnp.2eCcz2f0uIN8NKJc5Qgyb0Gcv80tmTpBC', 'mike@example.com', 'Mike', '123456789024', 1),
(8, 'sara', '$2y$10$H5EIVJ12771oq1gqQnp.2eCcz2f0uIN8NKJc5Qgyb0Gcv80tmTpBC', 'sara@gmail.com', 'Sara', '123456789026', 1),
(9, 'peter', '$2y$10$H5EIVJ12771oq1gqQnp.2eCcz2f0uIN8NKJc5Qgyb0Gcv80tmTpBC', 'peter@example.com', 'Peter', '123456789028', 2),
(10, 'linda', '$2y$10$H5EIVJ12771oq1gqQnp.2eCcz2f0uIN8NKJc5Qgyb0Gcv80tmTpBC', 'linda@gmail.com', 'Linda', '123456789030', 2),
(11, 'ryan', '$2y$10$H5EIVJ12771oq1gqQnp.2eCcz2f0uIN8NKJc5Qgyb0Gcv80tmTpBC', 'ryan@example.com', 'Ryan', '123456789032', 3),
(12, 'olivia', '$2y$10$H5EIVJ12771oq1gqQnp.2eCcz2f0uIN8NKJc5Qgyb0Gcv80tmTpBC', 'olivia@gmail.com', 'Olivia', '123456789034', 3);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_barang`
--

CREATE TABLE `kategori_barang` (
  `id` int(11) NOT NULL,
  `nama` varchar(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `kategori_barang`
--

INSERT INTO `kategori_barang` (`id`, `nama`) VALUES
(1, 'Sound System'),
(2, 'Lighting System'),
(3, 'LED Screen'),
(4, 'Multimedia'),
(5, 'Genset'),
(6, 'Stage'),
(7, 'Rigging'),
(8, 'Communication');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `events_id` int(11) NOT NULL,
  `products_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tagihan`
--

CREATE TABLE `tagihan` (
  `id` int(11) NOT NULL,
  `invoices_id` varchar(11) NOT NULL,
  `termin_number` int(11) NOT NULL,
  `tanggal_input` datetime NOT NULL,
  `tanggal_tagihan` datetime NOT NULL,
  `nominal` int(11) NOT NULL,
  `status` varchar(45) NOT NULL,
  `bukti_pembayaran` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_agenda_karyawans1_idx` (`karyawans_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_events_customers_idx` (`customers_id`),
  ADD KEY `fk_events_karyawans1_idx` (`PIC`);

--
-- Indexes for table `events_has_divisi`
--
ALTER TABLE `events_has_divisi`
  ADD PRIMARY KEY (`events_id`,`divisi_id`),
  ADD KEY `fk_events_has_divisi_divisi1_idx` (`divisi_id`),
  ADD KEY `fk_events_has_divisi_events1_idx` (`events_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_invoices_events1_idx` (`events_id`);

--
-- Indexes for table `item_barang`
--
ALTER TABLE `item_barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_item_barang_jenis_barang1_idx` (`jenis_barang_id`);

--
-- Indexes for table `item_barang_has_invoices`
--
ALTER TABLE `item_barang_has_invoices`
  ADD PRIMARY KEY (`item_barang_id`,`invoices_id`),
  ADD KEY `fk_item_barang_has_invoices_invoices1_idx` (`invoices_id`),
  ADD KEY `fk_item_barang_has_invoices_item_barang1_idx` (`item_barang_id`);

--
-- Indexes for table `item_barang_has_item_shipping`
--
ALTER TABLE `item_barang_has_item_shipping`
  ADD PRIMARY KEY (`item_barang_id`,`item_shipping_id`),
  ADD KEY `fk_item_barang_has_item_shipping_item_shipping1_idx` (`item_shipping_id`),
  ADD KEY `fk_item_barang_has_item_shipping_item_barang1_idx` (`item_barang_id`);

--
-- Indexes for table `item_damage`
--
ALTER TABLE `item_damage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_item_damage_karyawans1_idx` (`user_reporter`),
  ADD KEY `fk_item_damage_item_barang1_idx` (`item_barang_id`),
  ADD KEY `fk_item_damage_karyawans2_idx` (`user_servicer`);

--
-- Indexes for table `item_shipping`
--
ALTER TABLE `item_shipping`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_item_shipping_karyawans1_idx` (`driver`),
  ADD KEY `fk_item_shipping_events1_idx` (`events_id`);

--
-- Indexes for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_jenis_barang_kategori_barang1_idx` (`kategori_barang_id`);

--
-- Indexes for table `jenis_barang_has_events`
--
ALTER TABLE `jenis_barang_has_events`
  ADD PRIMARY KEY (`jenis_barang_id`,`events_id`),
  ADD KEY `fk_jenis_barang_has_events_events1_idx` (`events_id`),
  ADD KEY `fk_jenis_barang_has_events_jenis_barang1_idx` (`jenis_barang_id`);

--
-- Indexes for table `karyawans`
--
ALTER TABLE `karyawans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_karyawans_divisi1_idx` (`divisi_id`);

--
-- Indexes for table `kategori_barang`
--
ALTER TABLE `kategori_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`events_id`,`products_id`),
  ADD KEY `fk_events_has_products_events1_idx` (`events_id`);

--
-- Indexes for table `tagihan`
--
ALTER TABLE `tagihan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tagihan_invoices1_idx` (`invoices_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `item_damage`
--
ALTER TABLE `item_damage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `item_shipping`
--
ALTER TABLE `item_shipping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `karyawans`
--
ALTER TABLE `karyawans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `kategori_barang`
--
ALTER TABLE `kategori_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tagihan`
--
ALTER TABLE `tagihan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `fk_events_customers` FOREIGN KEY (`customers_id`) REFERENCES `customers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_events_karyawans1` FOREIGN KEY (`PIC`) REFERENCES `karyawans` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
