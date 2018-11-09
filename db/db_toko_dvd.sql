-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2017 at 02:48 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_toko_dvd`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_user` int(3) NOT NULL,
  `username` varchar(40) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(40) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `no_telp` varchar(12) COLLATE latin1_general_ci NOT NULL,
  `level` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT 'user',
  `blokir` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_user`, `username`, `password`, `nama_lengkap`, `email`, `no_telp`, `level`, `blokir`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'admin@gmail.com', '08238923848', 'admin', 'N'),
(2, 'kasir', 'c7911af3adbd12a035b289556d96470a', 'Kasir', 'kasir@gmail.com', '121212', 'user', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `id_album` int(5) NOT NULL,
  `id_genre` int(5) NOT NULL,
  `nama_album` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `deskripsi` text COLLATE latin1_general_ci NOT NULL,
  `harga` int(10) NOT NULL,
  `stok` int(5) NOT NULL,
  `berat` decimal(5,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `tgl_masuk` date NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `dibeli` int(5) NOT NULL DEFAULT '1',
  `dilihat` int(5) NOT NULL,
  `diskon` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id_album`, `id_genre`, `nama_album`, `deskripsi`, `harga`, `stok`, `berat`, `tgl_masuk`, `gambar`, `dibeli`, `dilihat`, `diskon`) VALUES
(27, 13, 'Westlife - Greatest Hits', '<p>\r\n<font size=\"3\"><strong>Track :</strong></font>\r\n</p>\r\n<p>\r\n1. My Love\r\n</p>\r\n<p>\r\n2. Open Your Heart \r\n</p>\r\n<p>\r\ndan lain-lain \r\n</p>\r\n', 45000, 13, '0.30', '2014-04-14', '77Unbreakableukversion.jpg', 2, 6, 0),
(34, 9, 'Pee Wee Gaskins - A youth not wasted', '<p>\r\n<font size=\"3\"><strong>Track :</strong></font>\r\n</p>\r\n<p>\r\n1. You And I going south \r\n</p>\r\n<p>\r\n2. Berbagi Cerita \r\n</p>\r\n<p>\r\n3. Satir Sarkas, dll.\r\n</p>\r\n', 30000, 19, '0.20', '2017-04-24', '2348541c83_Pee Wee Gaskins - A Youth Not Wasted.jpg', 1, 2, 5),
(35, 9, 'Greenday - iUno', '<p>\r\n<font size=\"3\"><strong>Track :</strong></font>\r\n</p>\r\n<p>\r\n1. Oh Love\r\n</p>\r\n<p>\r\n2. American idiot\r\n</p>\r\n<p>\r\n3. I walk alone, dll.\r\n</p>\r\n', 40000, 2, '0.20', '2017-04-24', '975cfdb47c786481a57ed52bf0934aa478.jpg', 1, 5, 10),
(36, 13, 'Raisa - Breakthru menunggu', '<p>\r\n<font size=\"3\"><strong>Track :</strong></font>\r\n</p>\r\n<p>\r\n1. Terjebak Nostalgia\r\n</p>\r\n<p>\r\n2. Teka - Teki\r\n</p>\r\n<p>\r\n3. LDR , dll.\r\n</p>\r\n', 35000, 28, '0.20', '2017-04-24', '76Raisa_handmade.jpeg', 3, 53, 20),
(28, 13, 'Nidji - Breakthru', '<p>\r\n<font size=\"3\"><strong>Track :</strong></font>\r\n</p>\r\n<p>\r\n1. Biarlah\r\n</p>\r\n<p>\r\n2. Kau dan Aku \r\n</p>\r\n<p>\r\ndan lain-lain \r\n</p>\r\n', 30000, 10, '0.20', '2014-04-14', '44hqdefault.jpg', 1, 0, 8),
(29, 5, 'Marshmello- Joytime', '<p>\r\n<font size=\"3\"><strong>Track :</strong></font>\r\n</p>\r\n<p>\r\n1. Alone \r\n</p>\r\n<p>\r\ndan lain-lain \r\n</p>\r\n', 40000, 10, '1.00', '2014-04-14', '8Moving-On-Marshmello.jpg', 1, 28, 2),
(30, 13, 'Peterpan - Hari Yang Cerah', '<p>\r\n<font size=\"3\"><strong>Track :</strong></font>\r\n</p>\r\n<p>\r\n1. Hari yang cerah untuk jiwa yang sepi\r\n</p>\r\n<p>\r\n2. Alexandria, dll.\r\n</p>\r\n', 30000, 3, '0.20', '2014-04-14', '77Peterpan - Hari Yang Cerah.jpg', 2, 29, 10),
(31, 13, 'Noah - Born to make history', '<p>\r\n<font size=\"3\"><strong>Track :</strong></font>\r\n</p>\r\n<p>\r\n1. Separuh Aku \r\n</p>\r\n<p>\r\n2. Diatas normal \r\n</p>\r\n<p>\r\n3. Sally Sendiri, dll.\r\n</p>\r\n', 30000, 10, '0.20', '2014-04-14', '39NOAH_-_WEBSITE.jpg', 2, 22, 5),
(32, 13, 'Tompi - Tak Pernah Setengah Hati', '<p>\r\n<font size=\"3\"><strong>Track :</strong></font>\r\n</p>\r\n<p>\r\n1. Romansa \r\n</p>\r\n<p>\r\ndan lain-lain \r\n</p>\r\n', 30000, 20, '0.20', '2014-04-14', '49Tak_Pernah_Setengah_Hati.jpg', 1, 47, 10),
(37, 6, 'Rhoma Irama ', '<p>\r\n<font size=\"3\"><strong>Track :</strong></font>\r\n</p>\r\n<p>\r\n1. Menunggu\r\n</p>\r\n<p>\r\n2. Judi \r\n</p>\r\n<p>\r\ndan lain-lain \r\n</p>\r\n', 40000, 19, '0.20', '2017-06-14', '96Album Rhoma Irama - Soneta Volume 9 - Begadang 2.jpg', 2, 42, 2);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_customer` int(5) NOT NULL,
  `password` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `alamat` text COLLATE latin1_general_ci NOT NULL,
  `rekening` int(11) NOT NULL,
  `email` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `telpon` int(12) NOT NULL,
  `id_kota` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `password`, `nama_lengkap`, `alamat`, `rekening`, `email`, `telpon`, `id_kota`) VALUES
(8, 'cc4b2066cfef89f2475de1d4da4b29c7', 'cindy', 'sas', 2121, 'cindy@gmail.com', 120101223, 7);

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `id_genre` int(5) NOT NULL,
  `nama_genre` varchar(30) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`id_genre`, `nama_genre`) VALUES
(12, 'Jazz'),
(5, 'R & B'),
(6, 'Dangdut'),
(7, 'Hardcore'),
(9, 'Rock & Roll'),
(10, 'Dance'),
(13, 'Pop'),
(16, 'Electronic Dance'),
(17, 'EDM');

-- --------------------------------------------------------

--
-- Table structure for table `konfirmasi`
--

CREATE TABLE `konfirmasi` (
  `id_orders` int(5) NOT NULL,
  `bukti_bayar` varchar(60) NOT NULL,
  `status_bayar` varchar(10) NOT NULL,
  `tanggal_bayar` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `konfirmasi`
--

INSERT INTO `konfirmasi` (`id_orders`, `bukti_bayar`, `status_bayar`, `tanggal_bayar`) VALUES
(49, 'IMG_0001.jpg', 'terbayar', '2017-07-12'),
(50, 'IMG_0001.jpg', 'terbayar', '2017-07-12'),
(51, 'IMG_0001.jpg', 'terbayar', '2017-07-12');

-- --------------------------------------------------------

--
-- Table structure for table `kota`
--

CREATE TABLE `kota` (
  `id_kota` int(3) NOT NULL,
  `nama_kota` varchar(30) NOT NULL,
  `ongkos_kirim` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kota`
--

INSERT INTO `kota` (`id_kota`, `nama_kota`, `ongkos_kirim`) VALUES
(1, 'Jakarta', 7000),
(2, 'Bandung', 8000),
(3, 'Semarang', 10000),
(4, 'Medan', 20000),
(5, 'Aceh', 25000),
(6, 'Banjarmasin', 17500),
(7, 'Balikpapan', 18500),
(8, 'Samarinda', 19500),
(9, 'Gorontalo', 20000),
(10, 'Palembang', 23000),
(11, 'Surabaya', 13000),
(12, 'Lainnya', 8000);

-- --------------------------------------------------------

--
-- Table structure for table `modul_setting`
--

CREATE TABLE `modul_setting` (
  `id_modul` int(5) NOT NULL,
  `static_content` text COLLATE latin1_general_ci NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `modul_setting`
--

INSERT INTO `modul_setting` (`id_modul`, `static_content`, `gambar`) VALUES
(1, '<p>\n<font face=\"tahoma,arial,helvetica,sans-serif\" size=\"4\"><strong>Harika Music , menjual berbagai album original.\n</strong></font>\n</p>\n<p>\n&nbsp;\n</p>\n<h4 style=\"margin: 0px 0px 20px; color: #000000\" class=\"headline font-inherit fontsize-s fontweight-700 lh-inherit align-left transform-inherit \">JAM OPERASIONAL.</h4>\n<div class=\"wpb_text_column wpb_content_element \">\n<div class=\"wpb_wrapper\">\n<p>\nBuka Setiap Hari<br />\n09:00 WIB &ndash; 20:00 WIB\n</p>\n</div>\n<div class=\"wpb_wrapper\">\n&nbsp;\n</div>\n</div>\n<h4 style=\"margin: 0px 0px 20px; color: #000000\" class=\"headline font-inherit fontsize-s fontweight-700 lh-inherit align-left transform-inherit \">ALAMAT.</h4>\n<div class=\"wpb_text_column wpb_content_element \">\n<div class=\"wpb_wrapper\">\n<p>\nBekasi: Jl. Kalimalang (Giant Bekasi)\n</p>\n</div>\n</div>\n<p>\n&nbsp;\n</p>\n<h4 style=\"margin: 0px 0px 20px; color: #000000\" class=\"headline font-inherit fontsize-s fontweight-700 lh-inherit align-left transform-inherit \">CUSTOMER SERVICE WEBSITE</h4>\n<div class=\"wpb_text_column wpb_content_element \">\n<div class=\"wpb_wrapper\">\n<p>\nAnda dapat bertanya tentang orderan seputar website dengan Customer Service Website kami\n</p>\n<p>\nIcha 0813 1980 5184\n</p>\n<p>\nSyafa 0813 8200 1028\n</p>\n</div>\n</div>\n<p>\n&nbsp;\n</p>\n', '22_big.jpg'),
(2, '<p>\r\n&nbsp;\r\n</p>\r\n<p>\r\n<font size=\"4\"><font face=\"arial black,avant garde\"><strong>Cara Beli Via Website : </strong></font></font>&nbsp;\r\n</p>\r\n<p>\r\n&nbsp;\r\n</p>\r\n<p>\r\n<font face=\"arial black,avant garde\" size=\"4\"><strong>\r\n</strong><font face=\"georgia,palatino\">1. Melakukan pendaftaran ( bagi yang belum terdaftar ) sebelum transaksi\r\n</font></font><font face=\"georgia,palatino\">\r\n</font>\r\n</p>\r\n<font face=\"georgia,palatino\">\r\n</font>\r\n<p>\r\n<font face=\"georgia,palatino\" size=\"4\">\r\n2. Login dengan email dan password kamu.\r\n</font>\r\n</p>\r\n<font face=\"georgia,palatino\">\r\n</font>\r\n<p>\r\n<font face=\"georgia,palatino\" size=\"4\">\r\n3. Klik tombol icon keranjang&nbsp; dibawah gambar </font><font face=\"georgia,palatino\" size=\"4\"><font size=\"4\">album</font> untuk menambahkan item kedalam keranjang, item akan otomatis masuk kedalam keranjang.\r\n</font>\r\n</p>\r\n<font face=\"georgia,palatino\">\r\n</font>\r\n<p>\r\n<font face=\"georgia,palatino\" size=\"4\">\r\n4. Klik tombol detail untuk melihat detail album. \r\n</font>\r\n</p>\r\n<font face=\"georgia,palatino\">\r\n</font>\r\n<p>\r\n<font face=\"georgia,palatino\" size=\"4\">\r\n5. Klik icon keranjang pada menu , untuk melihat keranjang pesanan. </font>\r\n</p>\r\n<font face=\"georgia,palatino\">\r\n</font>\r\n<p>\r\n<font face=\"georgia,palatino\" size=\"4\">6.&nbsp;&nbsp;Dihalaman Profile , Kamu bisa ubah tujuan order kirim jika kamu inginkan</font><font face=\"georgia,palatino\" size=\"4\">\r\n</font>\r\n</p>\r\n<font face=\"georgia,palatino\">\r\n</font>\r\n<p>\r\n<font face=\"georgia,palatino\" size=\"4\">7. Klik tombol Selesai untuk berhenti belanja, masukkan alamat tujuan pengiriman \r\n</font>\r\n</p>\r\n<font face=\"georgia,palatino\">\r\n</font>\r\n<p>\r\n<font face=\"georgia,palatino\" size=\"4\">\r\n8. Lakukan pembayaran melalui transfer ke salah satu No Rekening \r\n</font>\r\n</p>\r\n<font face=\"georgia,palatino\">\r\n</font>\r\n<p>\r\n<font face=\"georgia,palatino\">\r\n<font size=\"4\">\r\n9. Kirim konfirmasi transfer melalui SMS, LINE, atau Whatsapp</font></font>\r\n</p>\r\n', ''),
(3, '<p>\r\nPembayaran dilakukan Melalui Rekening Toko Kami di bawah ini :\r\n</p>\r\n<p>\r\n<strong>BRI :1909.8099.00.11</strong>\r\n</p>\r\n<p>\r\nA/n &nbsp; : Harika Music \r\n</p>\r\n<p>\r\n<strong>Mandiri : 503.0292.22</strong>\r\n</p>\r\n<p>\r\nA/n : Harika Music\r\n</p>\r\n<p>\r\n<strong>BCA :&nbsp; 09.8099.00.1.11</strong>\r\n</p>\r\n<p>\r\nA/n : Harika Music\r\n</p>\r\n<p>\r\n&nbsp;\r\n</p>\r\n<p>\r\n&nbsp;\r\n</p>\r\n<p>\r\n&nbsp;\r\n</p>\r\n<p>\r\n&nbsp;\r\n</p>\r\n<p>\r\n&nbsp;\r\n</p>\r\n<p>\r\n&nbsp;\r\n</p>\r\n', '');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id_orders` int(5) NOT NULL,
  `status_order` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT 'Baru',
  `tgl_order` date NOT NULL,
  `jam_order` time NOT NULL,
  `id_customer` int(5) NOT NULL,
  `pengiriman` varchar(3) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id_orders`, `status_order`, `tgl_order`, `jam_order`, `id_customer`, `pengiriman`) VALUES
(54, 'Baru', '2017-07-14', '18:42:56', 8, 'jne'),
(53, 'Baru', '2017-07-14', '18:27:07', 8, 'jne'),
(52, 'Baru', '2017-07-14', '17:57:47', 8, 'jne'),
(51, 'Lunas', '2017-07-12', '17:30:09', 8, 'jne'),
(50, 'Lunas', '2017-07-12', '16:57:37', 8, 'jne'),
(55, 'Baru', '2017-07-16', '13:24:42', 8, 'jne'),
(56, 'Baru', '2017-07-16', '13:24:55', 8, 'jne'),
(57, 'Baru', '2017-07-16', '13:25:06', 8, 'jne'),
(58, 'Baru', '2017-07-16', '13:25:40', 8, 'jne'),
(59, 'Baru', '2017-07-16', '13:25:54', 8, 'jne'),
(60, 'Baru', '2017-07-16', '13:26:20', 8, 'jne'),
(61, 'Baru', '2017-07-16', '13:26:35', 8, 'jne');

-- --------------------------------------------------------

--
-- Table structure for table `orders_detail`
--

CREATE TABLE `orders_detail` (
  `id_orders` int(5) NOT NULL,
  `id_album` int(5) NOT NULL,
  `jumlah` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `orders_detail`
--

INSERT INTO `orders_detail` (`id_orders`, `id_album`, `jumlah`) VALUES
(50, 37, 1),
(51, 27, 1),
(52, 37, 1),
(53, 37, 1),
(54, 36, 1),
(55, 36, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders_temp`
--

CREATE TABLE `orders_temp` (
  `id_orders_temp` int(5) NOT NULL,
  `id_album` int(5) NOT NULL,
  `id_session` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `jumlah` int(5) NOT NULL,
  `tgl_order_temp` date NOT NULL,
  `jam_order_temp` time NOT NULL,
  `stok_temp` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id_album`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id_genre`);

--
-- Indexes for table `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`id_kota`);

--
-- Indexes for table `modul_setting`
--
ALTER TABLE `modul_setting`
  ADD PRIMARY KEY (`id_modul`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_orders`);

--
-- Indexes for table `orders_temp`
--
ALTER TABLE `orders_temp`
  ADD PRIMARY KEY (`id_orders_temp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_user` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `id_album` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `id_genre` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `kota`
--
ALTER TABLE `kota`
  MODIFY `id_kota` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `modul_setting`
--
ALTER TABLE `modul_setting`
  MODIFY `id_modul` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id_orders` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `orders_temp`
--
ALTER TABLE `orders_temp`
  MODIFY `id_orders_temp` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
