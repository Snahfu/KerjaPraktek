-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2023 at 11:16 AM
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
-- Database: `rental_vendor`
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
  `selesai` date NOT NULL,
  `warna` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `agenda`
--

INSERT INTO `agenda` (`id`, `judul`, `deskripsi`, `mulai`, `selesai`, `warna`) VALUES
(1, 'Coba Vendor', 'vendornya dicoba', '2023-11-21', '2023-11-21', '#ff0000'),
(2, 'Meeting Client', 'Bertemu dengan Client untuk mendiskusikan harga', '2023-11-21', '2023-11-21', '#ff0000'),
(3, 'Meeting Client B', 'Bertemu dengan Client untuk mendiskusikan harga', '2023-11-22', '2023-11-22', '#ff0000'),
(4, 'test program', 'coba 1 lagi', '2023-11-23', '2023-11-24', '#ff0000'),
(5, 'coba', 'coba satu dua', '2023-11-16', '2023-11-18', '#ff0000'),
(6, 'tes', '123123123', '2023-11-14', '2023-11-24', '#0000ff');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `nama_pelanggan` longtext NOT NULL,
  `alamat_pelanggan` longtext NOT NULL,
  `nohp_pelanggan` varchar(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `nama_pelanggan`, `alamat_pelanggan`, `nohp_pelanggan`) VALUES
(1, 'Hans', 'Alamat sesungguhnya', '081299996666'),
(2, 'Elma Hastuti', 'Jln. Bara Tambar No. 627, Tasikmalaya 68728, Aceh', '081191403896'),
(3, 'Irnanto Sinaga', 'Dk. Sugiyopranoto No. 821, Surakarta 35485, JaTim', '081162830605'),
(4, 'Novi Hastuti', 'Dk. Pattimura No. 669, Tegal 25017, JaTeng', '081634213939'),
(5, 'Ulya Pratiwi ', 'Psr. Cihampelas No. 124, Makassar 92678, Lampung', '081682536144'),
(6, 'Kenes Hutagalung', 'Kpg. Uluwatu No. 352, Pagar Alam 60228, DIY', '08175243008'),
(7, 'Septi Mardhiyah', 'Jln. Bahagia  No. 492, Sungai Penuh 24561, KalTim', '0854564406475'),
(8, 'Ajeng Mandasari', 'Psr. Salak No. 388, Banjarbaru 61225, DIY', '08062746473'),
(9, 'Coba data pelanggan', 'JALAN SIMO POMAHAN BARU NO 3 KEL. SIMOMULYO BARU KEC. SUKOMANUNGGAL SURABAYA', '123123123123');

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
  `tanggal` datetime DEFAULT NULL,
  `jenis kegiatan` varchar(45) DEFAULT NULL,
  `budget` int(11) DEFAULT NULL,
  `status` varchar(45) NOT NULL,
  `lokasi` longtext NOT NULL,
  `jabatan_client` varchar(45) NOT NULL,
  `catatan` longtext DEFAULT NULL,
  `waktu_loading` datetime NOT NULL,
  `jam_mulai_acara` datetime NOT NULL,
  `jam_selesai_acara` datetime NOT NULL,
  `waktu_loading_out` datetime NOT NULL,
  `waktu_sampai_gudang` datetime DEFAULT NULL,
  `dp` datetime DEFAULT NULL,
  `tglDP` datetime DEFAULT NULL,
  `tglLunas` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `PIC`, `customers_id`, `nama`, `tanggal`, `jenis kegiatan`, `budget`, `status`, `lokasi`, `jabatan_client`, `catatan`, `waktu_loading`, `jam_mulai_acara`, `jam_selesai_acara`, `waktu_loading_out`, `waktu_sampai_gudang`, `dp`, `tglDP`, `tglLunas`) VALUES
(1, 3, 3, 'JAFEST', NULL, NULL, NULL, 'Draft', 'PTC', 'Koordinator Acara', NULL, '2023-11-20 14:13:56', '2023-11-20 14:13:54', '2023-11-20 14:13:55', '2023-11-20 14:13:57', NULL, NULL, NULL, NULL),
(2, 2, 1, 'Pesta Bintang Malam', NULL, NULL, NULL, 'Menunggu Persetujuan', 'Taman Bungkul', 'Ketua Acara', NULL, '2023-10-23 11:00:00', '2023-10-23 15:00:00', '2023-10-23 23:00:00', '2023-10-24 00:00:00', NULL, NULL, NULL, NULL),
(3, 5, 2, 'Harmoni Seni Lokal', NULL, NULL, NULL, 'Diproses', 'Surabaya Town Square (Sutos)', 'Koordinator Perlengkapan', NULL, '2023-10-11 10:00:00', '2023-10-11 18:00:00', '2023-10-11 22:00:00', '2023-10-11 23:00:00', NULL, NULL, NULL, NULL),
(4, 7, 3, 'Serba Seru Weekend Fiesta', NULL, NULL, NULL, 'Diterima', 'Suroboyo Carnival Park', 'Manajer Pemasaran', NULL, '2023-10-04 02:00:00', '2023-10-04 09:00:00', '2023-10-04 14:00:00', '2023-10-04 15:00:00', NULL, NULL, NULL, NULL),
(5, 1, 4, 'Inspirasi Kreatif Expo', NULL, NULL, NULL, 'Event Berlangsung', 'Gedung Grahadi', 'Koordinator Acara', NULL, '2023-10-08 07:00:00', '2023-10-08 11:00:00', '2023-10-08 19:00:00', '2023-10-08 20:00:00', NULL, NULL, NULL, NULL),
(6, 3, 5, 'Santai di Bawah Bintang', NULL, NULL, NULL, 'Selesai', 'Monumen Kapal Selam', 'Ketua Acara', NULL, '2023-10-10 11:00:00', '2023-10-10 18:00:00', '2023-10-10 23:00:00', '2023-10-11 00:00:00', NULL, NULL, NULL, NULL),
(7, 5, 6, 'Festival Kuliner Asli', NULL, NULL, NULL, 'Tagihan', 'Lapangan Rampal', 'Koordinator Perlengkapan', NULL, '2023-10-27 10:00:00', '2023-10-27 18:00:00', '2023-10-27 22:00:00', '2023-10-27 23:00:00', NULL, NULL, NULL, NULL),
(8, 7, 4, 'Pasar Seni Urban', NULL, NULL, NULL, 'Diterima', 'Kebun Binatang Surabaya', 'Manajer Pemasaran', NULL, '2023-10-01 01:00:00', '2023-10-01 08:00:00', '2023-10-01 13:00:00', '2023-10-01 14:00:00', NULL, NULL, NULL, NULL);

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

-- --------------------------------------------------------

--
-- Table structure for table `itemdamage`
--

CREATE TABLE `itemdamage` (
  `iditemDamage` int(11) NOT NULL,
  `damage_date` datetime DEFAULT NULL,
  `damaga_type` varchar(45) DEFAULT NULL,
  `damage_details` varchar(45) DEFAULT NULL,
  `repair_status` varchar(45) DEFAULT NULL,
  `repair_date` varchar(45) DEFAULT NULL,
  `repair_notes` varchar(45) DEFAULT NULL,
  `estimated_completion` datetime DEFAULT NULL,
  `user_reporter` int(11) NOT NULL,
  `item_barang_iditem_barang` int(11) NOT NULL,
  `user_servicer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_barang`
--

CREATE TABLE `item_barang` (
  `iditem_barang` int(11) NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `satuan` enum('unit','set') DEFAULT NULL,
  `tanggalBeli` datetime DEFAULT NULL,
  `hargaBeli` int(11) DEFAULT NULL,
  `jenis_barang_idjenis_barang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_barang_has_invoices`
--

CREATE TABLE `item_barang_has_invoices` (
  `item_barang_iditem_barang` int(11) NOT NULL,
  `invoices_id` varchar(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `status_in` datetime NOT NULL,
  `status_out` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_barang_has_item_shipping`
--

CREATE TABLE `item_barang_has_item_shipping` (
  `item_barang_iditem_barang` int(11) NOT NULL,
  `item_shipping_iditem_shipping` int(11) NOT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_shipping`
--

CREATE TABLE `item_shipping` (
  `iditem_shipping` int(11) NOT NULL,
  `jenis` enum('Kirim','Jemput') DEFAULT NULL,
  `driver` int(11) NOT NULL,
  `events_id` int(11) NOT NULL,
  `tglInput` datetime DEFAULT NULL,
  `tglJalan` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_barang`
--

CREATE TABLE `jenis_barang` (
  `idjenis_barang` int(11) NOT NULL,
  `nama` mediumtext DEFAULT NULL,
  `harga_sewa` int(11) DEFAULT NULL,
  `kategori_barang_idkategori` int(11) NOT NULL,
  `spesifikasi` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `jenis_barang`
--

INSERT INTO `jenis_barang` (`idjenis_barang`, `nama`, `harga_sewa`, `kategori_barang_idkategori`, `spesifikasi`) VALUES
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
  `jenis_barang_idjenis_barang` int(11) NOT NULL,
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
(1, 'alvin', '$2y$10$H5EIVJ12771oq1gqQnp.2eCcz2f0uIN8NKJc5Qgyb0Gcv80tmTpBC', 'coba@gmail.com', 'Alvin', '123456789012', 1),
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
  `idkategori` int(11) NOT NULL,
  `nama` varchar(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `kategori_barang`
--

INSERT INTO `kategori_barang` (`idkategori`, `nama`) VALUES
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
  `events_id` int(11) NOT NULL,
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
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `itemdamage`
--
ALTER TABLE `itemdamage`
  ADD PRIMARY KEY (`iditemDamage`),
  ADD KEY `fk_itemDamage_karyawans1_idx` (`user_reporter`),
  ADD KEY `fk_itemDamage_item_barang1_idx` (`item_barang_iditem_barang`),
  ADD KEY `fk_itemDamage_karyawans2_idx` (`user_servicer`);

--
-- Indexes for table `item_barang`
--
ALTER TABLE `item_barang`
  ADD PRIMARY KEY (`iditem_barang`),
  ADD KEY `fk_item_barang_jenis_barang1_idx` (`jenis_barang_idjenis_barang`);

--
-- Indexes for table `item_barang_has_invoices`
--
ALTER TABLE `item_barang_has_invoices`
  ADD PRIMARY KEY (`item_barang_iditem_barang`,`invoices_id`),
  ADD KEY `fk_item_barang_has_invoices_invoices1_idx` (`invoices_id`),
  ADD KEY `fk_item_barang_has_invoices_item_barang1_idx` (`item_barang_iditem_barang`);

--
-- Indexes for table `item_barang_has_item_shipping`
--
ALTER TABLE `item_barang_has_item_shipping`
  ADD PRIMARY KEY (`item_barang_iditem_barang`,`item_shipping_iditem_shipping`),
  ADD KEY `fk_item_barang_has_item_shipping_item_shipping1_idx` (`item_shipping_iditem_shipping`),
  ADD KEY `fk_item_barang_has_item_shipping_item_barang1_idx` (`item_barang_iditem_barang`);

--
-- Indexes for table `item_shipping`
--
ALTER TABLE `item_shipping`
  ADD PRIMARY KEY (`iditem_shipping`),
  ADD KEY `fk_item_shipping_karyawans1_idx` (`driver`),
  ADD KEY `fk_item_shipping_events1_idx` (`events_id`);

--
-- Indexes for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  ADD PRIMARY KEY (`idjenis_barang`),
  ADD KEY `fk_jenis_barang_kategori_barang1_idx` (`kategori_barang_idkategori`);

--
-- Indexes for table `jenis_barang_has_events`
--
ALTER TABLE `jenis_barang_has_events`
  ADD PRIMARY KEY (`jenis_barang_idjenis_barang`,`events_id`),
  ADD KEY `fk_jenis_barang_has_events_events1_idx` (`events_id`),
  ADD KEY `fk_jenis_barang_has_events_jenis_barang1_idx` (`jenis_barang_idjenis_barang`);

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
  ADD PRIMARY KEY (`idkategori`);

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
  ADD KEY `fk_tagihan_events1_idx` (`events_id`);

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
-- AUTO_INCREMENT for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  MODIFY `idjenis_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `karyawans`
--
ALTER TABLE `karyawans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `kategori_barang`
--
ALTER TABLE `kategori_barang`
  MODIFY `idkategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `fk_events_customers` FOREIGN KEY (`customers_id`) REFERENCES `customers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_events_karyawans1` FOREIGN KEY (`PIC`) REFERENCES `karyawans` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `events_has_divisi`
--
ALTER TABLE `events_has_divisi`
  ADD CONSTRAINT `fk_events_has_divisi_divisi1` FOREIGN KEY (`divisi_id`) REFERENCES `divisi` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_events_has_divisi_events1` FOREIGN KEY (`events_id`) REFERENCES `events` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `fk_invoices_events1` FOREIGN KEY (`events_id`) REFERENCES `events` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `itemdamage`
--
ALTER TABLE `itemdamage`
  ADD CONSTRAINT `fk_itemDamage_item_barang1` FOREIGN KEY (`item_barang_iditem_barang`) REFERENCES `item_barang` (`iditem_barang`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_itemDamage_karyawans1` FOREIGN KEY (`user_reporter`) REFERENCES `karyawans` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_itemDamage_karyawans2` FOREIGN KEY (`user_servicer`) REFERENCES `karyawans` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `item_barang`
--
ALTER TABLE `item_barang`
  ADD CONSTRAINT `fk_item_barang_jenis_barang1` FOREIGN KEY (`jenis_barang_idjenis_barang`) REFERENCES `jenis_barang` (`idjenis_barang`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `item_barang_has_invoices`
--
ALTER TABLE `item_barang_has_invoices`
  ADD CONSTRAINT `fk_item_barang_has_invoices_invoices1` FOREIGN KEY (`invoices_id`) REFERENCES `invoices` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_item_barang_has_invoices_item_barang1` FOREIGN KEY (`item_barang_iditem_barang`) REFERENCES `item_barang` (`iditem_barang`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `item_barang_has_item_shipping`
--
ALTER TABLE `item_barang_has_item_shipping`
  ADD CONSTRAINT `fk_item_barang_has_item_shipping_item_barang1` FOREIGN KEY (`item_barang_iditem_barang`) REFERENCES `item_barang` (`iditem_barang`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_item_barang_has_item_shipping_item_shipping1` FOREIGN KEY (`item_shipping_iditem_shipping`) REFERENCES `item_shipping` (`iditem_shipping`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `item_shipping`
--
ALTER TABLE `item_shipping`
  ADD CONSTRAINT `fk_item_shipping_events1` FOREIGN KEY (`events_id`) REFERENCES `events` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_item_shipping_karyawans1` FOREIGN KEY (`driver`) REFERENCES `karyawans` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  ADD CONSTRAINT `fk_jenis_barang_kategori_barang1` FOREIGN KEY (`kategori_barang_idkategori`) REFERENCES `kategori_barang` (`idkategori`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `jenis_barang_has_events`
--
ALTER TABLE `jenis_barang_has_events`
  ADD CONSTRAINT `fk_jenis_barang_has_events_events1` FOREIGN KEY (`events_id`) REFERENCES `events` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_jenis_barang_has_events_jenis_barang1` FOREIGN KEY (`jenis_barang_idjenis_barang`) REFERENCES `jenis_barang` (`idjenis_barang`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `karyawans`
--
ALTER TABLE `karyawans`
  ADD CONSTRAINT `fk_karyawans_divisi1` FOREIGN KEY (`divisi_id`) REFERENCES `divisi` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `fk_events_has_products_events1` FOREIGN KEY (`events_id`) REFERENCES `events` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tagihan`
--
ALTER TABLE `tagihan`
  ADD CONSTRAINT `fk_tagihan_events1` FOREIGN KEY (`events_id`) REFERENCES `events` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
