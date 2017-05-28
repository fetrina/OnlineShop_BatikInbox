-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 03, 2011 at 12:53 
-- Server version: 5.1.37
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `batikinbox`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_profile`
--

CREATE TABLE IF NOT EXISTS `admin_profile` (
  `nama` varchar(30) NOT NULL,
  `alamat` varchar(60) NOT NULL,
  `email` varchar(40) NOT NULL,
  `hp` varchar(17) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(35) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `admin_profile`
--

INSERT INTO `admin_profile` (`nama`, `alamat`, `email`, `hp`, `username`, `password`) VALUES
('tina', 'SKB depan msu', 'pabatikinbox@yahoo.co.id', '08122804407', 'tina', '166bf40feff088b2519b3ece1f944965'),
('tinul', 'SKB Kos Megaria', 'polkadog@rocketmail.com', '08572768072', 'tinul', 'ecc77881880a7350c9c323de866ee3a1');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `id_customer` int(10) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(30) NOT NULL,
  `alamat` varchar(60) NOT NULL,
  `kota` varchar(20) NOT NULL,
  `provinsi` varchar(20) NOT NULL,
  `hp` varchar(17) NOT NULL,
  `email` varchar(40) NOT NULL,
  PRIMARY KEY (`id_customer`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `nama_lengkap`, `alamat`, `kota`, `provinsi`, `hp`, `email`) VALUES
(1, 'Fendy Widya Laksana', 'Jl. kelengkeng no 15\r\n', '407', '27', '08156888888', 'banzae16@yahoo.com'),
(2, 'Ratih ria anggraeni', 'Jl. Jend sudirman no 12. Ds kebun RT2 RW2', '181', '12', '085721321111', 't2h_ratieh57@yahoo.com'),
(3, 'Harry Potter', 'Jl. Jend Sudirman no 7\r\nDs mangga RT1 RW1', '55', '5', '08122804141', 'harpot@gmail.com'),
(4, 'Titik mutiah', 'Jl. Imam bonjol no 10', '110', '8', '0893333333', 'titik.mutiah@gmail.com'),
(5, 'Hasmawati', 'Jl. notoprojo V/9A', '118', '8', '08525721171', 'asma@yahoo.com');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `id_kategori` int(10) NOT NULL AUTO_INCREMENT,
  `nama` varchar(20) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama`) VALUES
(1, 'Ransel batik'),
(2, 'Tas slempang batik'),
(4, 'Tas laptop batik'),
(6, 'Kaos batik'),
(7, 'Baju batik wanita'),
(8, 'Kemeja batik pria'),
(9, 'Rok batik '),
(10, 'Jaket batik'),
(11, 'Aksesoris');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang_belanja`
--

CREATE TABLE IF NOT EXISTS `keranjang_belanja` (
  `id_pembelian_temp` int(15) NOT NULL AUTO_INCREMENT,
  `id_session` varchar(60) NOT NULL,
  `id_produk` int(10) NOT NULL,
  `id_stok` int(10) NOT NULL,
  `jumlah_item_temp` int(10) NOT NULL,
  `subtotal_bayar_temp` int(10) NOT NULL,
  `tgl_pembelian_temp` date NOT NULL,
  `jam_pembelian_temp` time NOT NULL,
  PRIMARY KEY (`id_pembelian_temp`),
  KEY `id_produk` (`id_produk`),
  KEY `id_stok` (`id_stok`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `keranjang_belanja`
--


-- --------------------------------------------------------

--
-- Table structure for table `kota_kirim`
--

CREATE TABLE IF NOT EXISTS `kota_kirim` (
  `id_kota` int(5) NOT NULL AUTO_INCREMENT,
  `nama_kota` varchar(30) NOT NULL,
  `harga_kirim` int(10) DEFAULT NULL,
  `id_prov` int(5) NOT NULL,
  PRIMARY KEY (`id_kota`),
  KEY `id_prov` (`id_prov`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=410 ;

--
-- Dumping data for table `kota_kirim`
--

INSERT INTO `kota_kirim` (`id_kota`, `nama_kota`, `harga_kirim`, `id_prov`) VALUES
(1, 'Denpasar', 12000, 1),
(2, 'Amlapura', 12000, 1),
(3, 'Bajera', 12000, 1),
(4, 'Bangli', 12000, 1),
(5, 'Buleleng', 12000, 1),
(6, 'Gianyar', 12000, 1),
(7, 'Jimbaran', 12000, 1),
(8, 'Karang Asem', 12000, 1),
(9, 'Klungkkung', 12000, 1),
(10, 'Kuta Bali', 12000, 1),
(11, 'Mengui', 12000, 1),
(12, 'Negara', 12000, 1),
(13, 'Ngurah Rai', 12000, 1),
(14, 'Nusa Dua', 12000, 1),
(15, 'Samarapura', 12000, 1),
(16, 'Sanur', 12000, 1),
(17, 'Seririt', 12000, 1),
(18, 'Singaraja', 12000, 1),
(19, 'Tabanan', 12000, 1),
(20, 'Serang', 6000, 2),
(21, 'Cilegon', 6000, 2),
(22, 'Padeglang', 6000, 2),
(23, 'Rangkas Bitung', 6000, 2),
(24, 'Balaraja', 6000, 2),
(25, 'Batam', 15000, 3),
(26, 'Batu ALI', 15000, 3),
(27, 'Kabil', 15000, 3),
(28, 'Kijang Tanjung Pinang', 15000, 3),
(29, 'Lagoi Pulau Bintang', 15000, 3),
(30, 'Lobam', 15000, 3),
(31, 'Pulau Natuna', 15000, 3),
(32, 'Pulau Sambu', 15000, 3),
(33, 'Segulung', 15000, 3),
(34, 'Seiharapan Sekupang', 15000, 3),
(35, 'Tanjung Batu Kundur', 15000, 3),
(36, 'Tanjung Pinang', 15000, 3),
(37, 'Tanjung Uban', 15000, 3),
(38, 'Tanjung Balai Karimun', 15000, 3),
(39, 'Tanjung Ucang', 15000, 3),
(40, 'Sekupang', 15000, 3),
(41, 'Bengkulu', 12000, 4),
(42, 'Arga Makmur', 12000, 4),
(43, 'Bintuhan', 12000, 4),
(44, 'Curup', 12000, 4),
(45, 'Kepahiang', 12000, 4),
(46, 'Ketahun', 12000, 4),
(47, 'Manna', 12000, 4),
(48, 'Muara Aman', 12000, 4),
(49, 'Muko Muko', 12000, 4),
(50, 'Tais', 12000, 4),
(51, 'Ujan Mas', 12000, 4),
(52, 'Jakarta Barat', 6500, 5),
(53, 'Jakarta Pusat', 6500, 5),
(54, 'Jakarta Selatan', 6500, 5),
(55, 'Jakarta Timur', 6500, 5),
(56, 'Jakarta Utara', 6500, 5),
(57, 'Jambi', 11000, 6),
(58, 'Air Hitam', 11000, 6),
(59, 'Bangko', 11000, 6),
(60, 'Kualatungkai', 11000, 6),
(61, 'Muara Bulian', 11000, 6),
(62, 'Muara Bungo', 11000, 6),
(63, 'Sorolangun', 11000, 6),
(64, 'Sungai Penuh', 11000, 6),
(65, 'Univ. Jambi Mandolo', 11000, 6),
(66, 'Bandung', 7000, 7),
(67, 'Ciamis', 7000, 7),
(68, 'Cianjur', 7000, 7),
(69, 'Cimahi', 7000, 7),
(70, 'Cimareme', 7000, 7),
(71, 'Cirebon', 7000, 7),
(72, 'Garut', 7000, 7),
(73, 'Indramayu', 7000, 7),
(74, 'Karang Ampel', 7000, 7),
(75, 'Kuningan', 7000, 7),
(76, 'Lembang', 7000, 7),
(77, 'Majalengka', 7000, 7),
(78, 'Padalarang', 7000, 7),
(79, 'Rancaekek', 7000, 7),
(80, 'Soreang', 7000, 7),
(81, 'Subang', 7000, 7),
(82, 'Sukabumi', 7000, 7),
(83, 'Sumedang', 7000, 7),
(84, 'Bekasi', 7000, 7),
(85, 'Bogor', 7000, 7),
(86, 'Cibinong', 7000, 7),
(87, 'Cikampek', 7000, 7),
(88, 'Cikarang', 7000, 7),
(89, 'Depok', 7000, 7),
(90, 'Jonggol', 7000, 7),
(91, 'Karawang', 7000, 7),
(92, 'Purwakarta', 7000, 7),
(93, 'Tangerang', 7000, 7),
(94, 'Kab. Tanggerang', 7000, 7),
(95, 'Cibubur', 7000, 7),
(96, 'Semarang', 9000, 8),
(97, 'Ajibarang', 9000, 8),
(98, 'Banjar Negara', 9000, 8),
(99, 'Banyumas', 9000, 8),
(100, 'Blora', 9000, 8),
(101, 'Boyolali', 9000, 8),
(102, 'Brebes', 9000, 8),
(103, 'Cilacap', 9000, 8),
(104, 'Demak', 9000, 8),
(105, 'Grobogan', 9000, 8),
(106, 'Jepara', 9000, 8),
(107, 'Krg. Anyar, Semarang', 9000, 8),
(108, 'Kebumen', 9000, 8),
(109, 'Kendal', 9000, 8),
(110, 'Klaten', 9000, 8),
(111, 'Kudus', 9000, 8),
(112, 'Pati', 9000, 8),
(113, 'Pekalongan', 9000, 8),
(114, 'Pemalang', 9000, 8),
(115, 'Purbalingga', 9000, 8),
(116, 'Purwokerto', 9000, 8),
(117, 'Purworejo', 9000, 8),
(118, 'Rembang', 9000, 8),
(119, 'Salatiga', 9000, 8),
(120, 'Sideraja', 9000, 8),
(121, 'Solo', 9000, 8),
(122, 'Sragen', 9000, 8),
(123, 'Sukoharjo', 9000, 8),
(124, 'Tegal', 9000, 8),
(125, 'Winong SMRNG', 9000, 8),
(126, 'Wonogiri', 9000, 8),
(127, 'Wonogiri Kota', 9000, 8),
(128, 'Wonosobo', 9000, 8),
(129, 'Magelang', 9000, 8),
(130, 'Temanggung', 9000, 8),
(131, 'Surabaya', 10500, 9),
(132, 'Bangkalan', 10500, 9),
(133, 'Banyuwangi', 10500, 9),
(134, 'Blitar', 10500, 9),
(135, 'Bondowoso', 10500, 9),
(136, 'Gresik', 10500, 9),
(137, 'Jember', 10500, 9),
(138, 'Jombang', 10500, 9),
(139, 'Kediri', 10500, 9),
(140, 'Lamongan', 10500, 9),
(141, 'Lumajang', 10500, 9),
(142, 'Madiun', 10500, 9),
(143, 'Magetan', 10500, 9),
(144, 'Malang', 10500, 9),
(145, 'Mojokerto', 10500, 9),
(146, 'Nganjuk', 10500, 9),
(147, 'Ngawi', 10500, 9),
(148, 'Pacitan', 10500, 9),
(149, 'Pamekasan', 10500, 9),
(150, 'Pandaan', 10500, 9),
(151, 'Pasuruan', 10500, 9),
(152, 'Ponorogo', 10500, 9),
(153, 'Probolinggo', 10500, 9),
(154, 'Sampang', 10500, 9),
(155, 'Sidoarjo', 10500, 9),
(156, 'Situbondo', 10500, 9),
(157, 'Sumenep Madura', 10500, 9),
(158, 'Trenggalek', 10500, 9),
(159, 'Tuban, Surabaya', 10500, 9),
(160, 'Tulung Agung', 10500, 9),
(161, 'Pontianak', 19000, 10),
(162, 'Jungkat', 19000, 10),
(163, 'Ketapang', 19000, 10),
(164, 'Mempawah', 19000, 10),
(165, 'Ngabang', 19000, 10),
(166, 'Putusibau', 19000, 10),
(167, 'Sambas', 19000, 10),
(168, 'Sanggau', 19000, 10),
(169, 'Singkawang', 19000, 10),
(170, 'Sintang', 19000, 10),
(171, 'Wajok', 19000, 10),
(172, 'Banjarmasin', 18000, 11),
(173, 'Amuntai', 18000, 11),
(174, 'Tanjung', 18000, 11),
(175, 'Banjar Baru', 18000, 11),
(176, 'Barabai', 18000, 11),
(177, 'Kandangan, Banjaramasin', 18000, 11),
(178, 'KotaBARU, Ulau Laut', 18000, 11),
(179, 'Peleihari', 18000, 11),
(180, 'Rantau', 18000, 11),
(181, 'Palangkaraya', 19000, 12),
(182, 'Pangkalan Bun', 19000, 12),
(183, 'Butok Kuala Kapuas', 19000, 12),
(184, 'Muara Teweh', 19000, 12),
(185, 'Balikpapan', 26000, 13),
(186, 'Bontang', 26000, 13),
(187, 'Samarinda', 26000, 13),
(188, 'Sangata', 26000, 13),
(189, 'Tanah Grogot', 26000, 13),
(190, 'Tanjung Redep', 26000, 13),
(191, 'Tanjung Selor', 26000, 13),
(192, 'Tarakan', 26000, 13),
(193, 'Tenggarong', 26000, 13),
(194, 'Bandar Lampung', 15000, 14),
(195, 'Bakauheuni', 15000, 14),
(196, 'Bandar Jaya', 15000, 14),
(197, 'Bukit Kemuning', 15000, 14),
(198, 'Kalianda', 15000, 14),
(199, 'Kedondong', 15000, 14),
(200, 'Kemiling', 15000, 14),
(201, 'Kota Bumi', 15000, 14),
(202, 'Krui', 15000, 14),
(203, 'Liwa', 15000, 14),
(204, 'Metro', 15000, 14),
(205, 'Pertama Biru', 15000, 14),
(206, 'Perum Pantai Gading', 15000, 14),
(207, 'Sumber Jaya  Lampung', 15000, 14),
(208, 'Talang Padang', 15000, 14),
(209, 'Tanjung bintang', 15000, 14),
(210, 'Ambon', 35000, 15),
(211, 'Banda Aceh', 23000, 16),
(212, 'Batuphat', 23000, 16),
(213, 'Bireun', 23000, 16),
(214, 'Blang Pide', 23000, 16),
(215, 'Cut Girek', 23000, 16),
(216, 'Kota Cane', 23000, 16),
(217, 'Kruenggeukeh', 23000, 16),
(218, 'Kuala Simpang', 23000, 16),
(219, 'Langsa', 23000, 16),
(220, 'Lhoknga', 23000, 16),
(221, 'Lhokseumawe', 23000, 16),
(222, 'Lhoksukon', 23000, 16),
(223, 'Meulaboh', 23000, 16),
(224, 'Sabang', 23000, 16),
(225, 'Sigli', 23000, 16),
(226, 'Singkil', 23000, 16),
(227, 'Takengon', 23000, 16),
(228, 'Tapaktuan', 23000, 16),
(229, 'Ulee Glee', 23000, 16),
(230, 'Univ. Abdulyatama', 23000, 16),
(231, 'Mataram', 23000, 17),
(232, 'Atambua', 23000, 17),
(233, 'Bajawa', 23000, 17),
(234, 'Batu Hijau', 23000, 17),
(235, 'Benete', 23000, 17),
(236, 'Bima', 23000, 17),
(237, 'Dompu', 23000, 17),
(238, 'Ende', 23000, 32),
(239, 'Kalabahi', 23000, 17),
(240, 'Kefamenanu', 23000, 17),
(241, 'Kupang', 23000, 32),
(242, 'Larantuka', 23000, 17),
(243, 'Masohi', 23000, 17),
(244, 'Jayapura', 75000, 18),
(245, 'Biak', 75000, 18),
(246, 'Fak-fak', 75000, 18),
(247, 'Manokwari', 75000, 18),
(248, 'Merauke', 75000, 18),
(249, 'Nabire', 75000, 18),
(250, 'Serui', 75000, 18),
(251, 'Sorong', 75000, 18),
(252, 'Timika', 75000, 18),
(253, 'Wamena', 75000, 18),
(254, 'Pekan Baru', 24000, 19),
(255, 'Arengka', 24000, 19),
(256, 'Bagan Siapi-api', 24000, 19),
(257, 'Bengkalis', 24000, 19),
(258, 'Dumai', 24000, 19),
(259, 'Duri', 24000, 19),
(260, 'Kerinci, Pekan Baru', 24000, 19),
(261, 'Kulim', 24000, 19),
(262, 'Minas', 24000, 19),
(263, 'Panam', 24000, 19),
(264, 'Pangkalan Kerinci', 24000, 19),
(265, 'Perawang', 24000, 19),
(266, 'Rengat', 24000, 19),
(267, 'Rumbai', 24000, 19),
(268, 'Selat Panjang', 24000, 19),
(269, 'Siak-II', 24000, 19),
(270, 'Sungai Pakning', 24000, 19),
(271, 'Tangkerang', 24000, 19),
(272, 'Tembilahan', 24000, 19),
(273, 'Teratak Buluh', 24000, 19),
(274, 'Makassar', 30000, 20),
(275, 'Bantaeng', 30000, 20),
(276, 'Barru', 30000, 20),
(277, 'Bone', 30000, 20),
(278, 'Bontosungu', 30000, 20),
(279, 'Bulukumba', 30000, 20),
(280, 'Enrekang', 30000, 20),
(281, 'Gowa', 30000, 20),
(282, 'Majene', 30000, 20),
(283, 'Makale/Tanatoraja', 30000, 20),
(284, 'Malili', 30000, 20),
(285, 'Mamasa', 30000, 20),
(286, 'Mamuju', 30000, 20),
(287, 'Maros', 30000, 20),
(288, 'Palopo', 30000, 20),
(289, 'Pare-Pare', 30000, 20),
(290, 'Pinrang Polewali', 30000, 20),
(291, 'Polewali', 30000, 20),
(292, 'Selayar', 30000, 20),
(293, 'Sengkang', 30000, 20),
(294, 'Sinjai', 30000, 20),
(295, 'Sidrap', 30000, 20),
(296, 'Soppeng', 30000, 20),
(297, 'Sungguminasa', 30000, 20),
(298, 'Takalar', 30000, 20),
(299, 'Watampone', 30000, 20),
(300, 'Watansoppeng', 30000, 20),
(301, 'Soroako', 30000, 20),
(302, 'Palu', 33000, 21),
(303, 'Donggala', 33000, 21),
(304, 'Luwuk', 33000, 21),
(305, 'Poso', 33000, 21),
(306, 'Toli-toli', 33000, 21),
(307, 'Kendari', 41000, 22),
(308, 'Bau-bau', 41000, 22),
(309, 'Kolaka', 41000, 22),
(310, 'Maumere', 41000, 22),
(311, 'Praya', 41000, 22),
(312, 'Raba', 41000, 22),
(313, 'Ruteng', 41000, 22),
(314, 'Selong', 41000, 22),
(315, 'Soa Siu', 41000, 22),
(316, 'Soe', 41000, 22),
(317, 'Sumbawa Besar', 41000, 22),
(318, 'Ternate', 41000, 22),
(319, 'Tual', 41000, 22),
(320, 'Waingapu', 41000, 22),
(321, 'Waikabubak', 41000, 22),
(322, 'Manado', 55000, 23),
(323, 'Bitung', 55000, 23),
(324, 'Gorontalo', 55000, 23),
(325, 'Kota Mobago', 55000, 23),
(326, 'Limboto', 55000, 23),
(327, 'Tahuna', 55000, 23),
(328, 'Tondano', 55000, 23),
(329, 'Padang Sidempun', 22000, 24),
(330, 'Batu  Sangkar', 22000, 24),
(331, 'Bukit Tinggi', 22000, 24),
(332, 'Limau Manis', 22000, 24),
(333, 'Lubuk Alung', 22000, 24),
(334, 'Lubuk Buaya', 22000, 24),
(335, 'Lubuk Sikaping', 22000, 24),
(336, 'Maninjau', 22000, 24),
(337, 'Padang Panjang', 22000, 24),
(338, 'Painan', 22000, 24),
(339, 'Pariaman', 22000, 24),
(340, 'Pasaman', 22000, 24),
(341, 'Payakumbuh', 22000, 24),
(342, 'Sawahlunto', 22000, 24),
(343, 'Sicincin', 22000, 24),
(344, 'Sijunjung', 22000, 24),
(345, 'Solok', 22000, 24),
(346, 'Teluk Bayur', 22000, 24),
(347, 'Univ. Andalas', 22000, 24),
(348, 'Padang', 22000, 24),
(349, 'Palembang', 19000, 25),
(350, 'Bangka', 19000, 25),
(351, 'Batu Raja', 19000, 25),
(352, 'Belinyu', 19000, 25),
(353, 'Indralaya', 19000, 25),
(354, 'Jebus', 19000, 25),
(355, 'Kayu Agung', 19000, 25),
(356, 'Koba', 19000, 25),
(357, 'Lahat', 19000, 25),
(358, 'Lubuk Linggau', 19000, 25),
(359, 'Mentok', 19000, 25),
(360, 'Muara Enim', 19000, 25),
(361, 'Pagar Alam', 19000, 25),
(362, 'Pangkal Pinang', 19000, 25),
(363, 'Sungai Liat', 19000, 25),
(364, 'Tobo Ali', 19000, 25),
(365, 'Medan', 25000, 26),
(366, 'Asahan', 25000, 26),
(367, 'Bah Jambi', 25000, 26),
(368, 'Balige', 25000, 26),
(369, 'Belawan', 25000, 26),
(370, 'Brastagi', 25000, 26),
(371, 'Binjai', 25000, 26),
(372, 'Deli Serdang', 25000, 26),
(373, 'Deli Tua', 25000, 26),
(374, 'Gunung Sitoli', 25000, 26),
(375, 'Indrapura', 25000, 26),
(376, 'Kabanyahe', 25000, 26),
(377, 'Kisaran', 25000, 26),
(378, 'Langkat', 25000, 26),
(379, 'Lubuk Pakam', 25000, 26),
(380, 'Mandailing Natal', 25000, 26),
(381, 'Marihat', 25000, 26),
(382, 'Padang Sidempuan', 25000, 26),
(383, 'Pancuran Batu', 25000, 26),
(384, 'Pangkalan Brandan', 25000, 26),
(385, 'Prapat', 25000, 26),
(386, 'Pematang Siantar', 25000, 26),
(387, 'Perbaungan', 25000, 26),
(388, 'Rantau Prapat', 25000, 26),
(389, 'Sibolga', 25000, 26),
(390, 'Sidikalang', 25000, 26),
(391, 'Stabat', 25000, 26),
(392, 'Tanjung Morawa', 25000, 26),
(393, 'Tanjung Pura', 25000, 26),
(394, 'Tanjung Balai  Asahan', 25000, 26),
(395, 'Tarutung', 25000, 26),
(396, 'Tebing  Tinggi', 25000, 26),
(397, 'Tlk. Dalam Niad Selatan', 25000, 26),
(398, 'Tuntungan', 25000, 26),
(399, 'Yogyakarta', 12000, 27),
(400, 'Bantul', 12000, 27),
(401, 'Depok Yogyakarta', 12000, 27),
(402, 'Gombong', 12000, 27),
(403, 'Magelang', 12000, 27),
(404, 'Melati Cebongan', 12000, 27),
(405, 'Pleret Yogyakarta', 12000, 27),
(406, 'Prambanan', 12000, 27),
(407, 'Sleman', 12000, 27),
(408, 'Wates', 12000, 27),
(409, 'teskota', 20000, 19);

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE IF NOT EXISTS `pembelian` (
  `id_pembelian` varchar(15) NOT NULL,
  `id_customer` int(15) NOT NULL,
  `biaya_kirim` int(10) NOT NULL,
  `total_bayar_item` int(15) NOT NULL,
  `total_bayar_all` int(15) NOT NULL,
  `total_item_dibeli` int(5) NOT NULL,
  `jam_pembelian` time NOT NULL,
  `tgl_pembelian` date NOT NULL,
  `bulan_pembelian` varchar(15) NOT NULL,
  `tahun_pembelian` varchar(5) NOT NULL,
  `status_pembelian` varchar(20) NOT NULL,
  `atas_nama` varchar(25) NOT NULL,
  `bank_asal` varchar(20) NOT NULL,
  `rekening_asal` varchar(20) NOT NULL,
  `cabang_bank` varchar(20) NOT NULL,
  `jumlah_transfer` int(15) NOT NULL,
  `tgl_transfer` date NOT NULL,
  `status_dilihat` varchar(10) NOT NULL,
  PRIMARY KEY (`id_pembelian`),
  KEY `id_customer` (`id_customer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_customer`, `biaya_kirim`, `total_bayar_item`, `total_bayar_all`, `total_item_dibeli`, `jam_pembelian`, `tgl_pembelian`, `bulan_pembelian`, `tahun_pembelian`, `status_pembelian`, `atas_nama`, `bank_asal`, `rekening_asal`, `cabang_bank`, `jumlah_transfer`, `tgl_transfer`, `status_dilihat`) VALUES
('201108240001', 2, 19000, 180000, 199000, 3, '03:42:15', '2011-08-24', '08', '2011', 'sudah dikirim', 'Ratih ria', 'mandiri', '0703424034200', 'palangkaraya', 199000, '2011-08-25', 'sudah'),
('201108270001', 1, 12000, 180000, 192000, 2, '03:28:56', '2011-08-27', '08', '2011', 'sudah dikirim', 'Fendy Widya Laksana', 'mandiri', '', 'yogya', 192000, '2011-08-28', 'sudah'),
('201109210001', 3, 6500, 50000, 56500, 1, '06:05:48', '2011-09-21', '09', '2011', 'sudah dikirim', 'Taylor swift', 'mandiri', '0703532101010', 'jakarta timur', 56500, '2011-09-22', 'sudah'),
('201109230001', 4, 9000, 40000, 49000, 1, '06:14:40', '2011-09-23', '09', '2011', 'kadaluarsa', '', '', '', '', 0, '0000-00-00', 'sudah'),
('201110030001', 5, 9000, 60000, 69000, 1, '06:29:38', '2011-10-03', '10', '2011', 'baru beli', '', '', '', '', 0, '0000-00-00', 'belum');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_detail`
--

CREATE TABLE IF NOT EXISTS `pembelian_detail` (
  `id_pembelian` varchar(15) NOT NULL,
  `id_produk` int(10) NOT NULL,
  `id_stok` int(10) NOT NULL,
  `jumlah_item` int(5) NOT NULL,
  `subtotal_bayar` int(10) NOT NULL,
  KEY `id_pembelian` (`id_pembelian`),
  KEY `id_produk` (`id_produk`),
  KEY `id_stok` (`id_stok`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian_detail`
--

INSERT INTO `pembelian_detail` (`id_pembelian`, `id_produk`, `id_stok`, `jumlah_item`, `subtotal_bayar`) VALUES
('201108270001', 11, 1648, 2, 180000),
('201108240001', 2, 1637, 1, 55000),
('201108240001', 4, 1639, 1, 60000),
('201108240001', 18, 1655, 1, 65000),
('201109210001', 5, 1642, 1, 50000),
('201109230001', 26, 1665, 1, 40000),
('201110030001', 33, 1678, 1, 60000);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE IF NOT EXISTS `produk` (
  `id_produk` int(10) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(10) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `harga_normal` int(10) NOT NULL,
  `biaya_produksi` int(10) NOT NULL,
  `tgl_input` date NOT NULL,
  `status_tampil` varchar(10) NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`id_produk`),
  KEY `id_kategori` (`id_kategori`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `nama`, `gambar`, `harga_normal`, `biaya_produksi`, `tgl_input`, `status_tampil`, `keterangan`) VALUES
(1, 9, 'RB-1', '4413rok-panjang-cantik-batik-madura-cbur17m6.jpg', 55000, 40000, '2011-09-27', 'ya', 'Rok panjang anggun, terbuat dari bahan katun dengan motif  batik madura klasik \r\nMenarik dan nyaman untuk segala suasana.\r\n\r\nM panjang rok (90cm)\r\nL panjang rok (100cm)'),
(2, 9, 'RB-2', '651rok-panjang-cantik-batik-madura-cbur17m5.jpg', 55000, 40000, '2011-09-27', 'ya', 'Rok panjang anggun, terbuat dari bahan katun dengan motif  batik madura klasik \r\nMenarik dan nyaman untuk segala suasana.\r\n\r\nAllsize, lebar pinggang bisa melar. Panjang 95cm'),
(3, 9, 'RB-3', '2646rok-panjang-cantik-batik-madura-cbur17m4.jpg', 65000, 50000, '2011-09-27', 'ya', 'Rok panjang anggun, terbuat dari bahan katun dengan motif  batik madura klasik \r\nMenarik dan nyaman untuk segala suasana.\r\n\r\nAllsize, lebar pinggang bisa melar. Panjang 95cm'),
(4, 9, 'RB-4', '8815rok-panjang-cantik-batik-madura-cbur17m3-2.jpg', 60000, 45000, '2011-09-27', 'ya', 'Rok panjang anggun, terbuat dari bahan katun dengan motif  batik madura klasik \r\nMenarik dan nyaman untuk segala suasana.'),
(5, 9, 'RB-5', '1107rok-batik-perca-segitiga-motif-batik-kontemporer-cbur10.jpg', 50000, 45000, '2011-09-27', 'ya', 'Rok panjang anggun, terbuat dari bahan katun dengan motif  batik madura klasik \r\nMenarik dan nyaman untuk segala suasana.\r\n\r\nS panjang rok (85cm)\r\nM panjang rok (90cm)\r\nL panjang rok (100cm)'),
(6, 9, 'RB-6', '949rok-batik-pendek-motif-bintang-pucuk-cbur26m5.jpg', 50000, 35000, '2011-09-27', 'ya', 'Rok pendek yang anggun, terbuat dari bahan katun dengan motif  batik madura klasik \r\nMenarik dan nyaman untuk segala suasana.\r\nAllsize, lebar pinggang bisa melar. Panjang 95cm'),
(9, 9, 'RB-7', '436rok-batik-cantik-pendek-motif-batik-madura-cbur12m5.jpg', 50000, 35000, '2011-09-27', 'ya', 'Rok pendek yang anggun, terbuat dari bahan katun dengan motif  batik madura klasik \r\nMenarik dan nyaman untuk segala suasana.\r\n\r\nM panjang rok (45cm)'),
(10, 9, 'RB-8', '663rok-batik-cantik-pendek-motif-batik-madura-cbur02m2.jpg', 50000, 35000, '2011-09-27', 'ya', 'Rok pendek yang anggun, terbuat dari bahan katun dengan motif  batik madura klasik \r\nMenarik dan nyaman untuk segala suasana.\r\n\r\nAllsize panjang rok (55cm), lebar dinamis(bisa melar)\r\n'),
(11, 8, 'KBP-1', '4466baju-batik-koko-katun-aplikasi-batik-cbuk94m10.jpg', 90000, 75000, '2011-09-27', 'ya', 'Baju koko pria\r\n\r\nM 	Bahu (shoulder): 16 cm, Lingkar Dada (Chest): 107 cm, Panjang produk (Length): 72 cm \r\n\r\nL 	Pundak (Shoulder): 17.5 cm, Lingkar Dada (Chest): 114 cm, Panjang produk (Length): 77 cm\r\n\r\n'),
(12, 8, 'KBP-2', '7769baju-batik-koko-katun-aplikasi-batik-cbuk94m5.jpg', 65000, 50000, '2011-09-27', 'ya', 'Baju koko pria dengan motif batik\r\n\r\nM 	Bahu (shoulder): 16 cm, Lingkar Dada (Chest): 107 cm, Panjang produk (Length): 72 cm \r\n	\r\nL 	Bahu (shoulder): 16 cm, Lingkar Dada (Chest): 114 cm, Panjang produk (Length): 70,5 cm'),
(14, 8, 'KBP-3', '8056baju-batik-kemeja-panjang-motif-batik-parang-taruntum-cbue18m2.jpg', 90000, 75000, '2011-09-27', 'ya', 'Kemeja batik lengan panjang, motif batik parang taruntum terbaru dengan warna2 yang menarik. \r\nTerbuat dari bahan katun yang nyaman dikenakan untuk ibadah ataupun aktifitas anda lainnya.\r\n\r\nL 	Bahu (shoulder): 16 cm, Lingkar Dada (Chest): 114 cm, Panjang produk (Length): 70,5 cm'),
(15, 8, 'KBP-4', '5293baju-batik-kemeja-panjang-motif-batik-parang-taruntum-cbue18m1.jpg', 90000, 75000, '2011-09-27', 'ya', 'Kemeja batik lengan panjang, motif batik parang taruntum terbaru dengan warna2 yang menarik. \r\nTerbuat dari bahan katun yang nyaman dikenakan untuk ibadah ataupun aktifitas anda lainnya.\r\n\r\nAllsize Bahu (shoulder): 16 cm, Lingkar Dada (Chest): 114 cm, Panjang produk (Length): 70,5 cm'),
(16, 7, 'BBW-1', '3068bt-123.jpg', 65000, 50000, '2011-09-27', 'ya', 'Blus batik cantik dengan kerah lancip dan kancing bablas. \r\nMotif batik modern dalam warna2 cerah, simple dan elegan. \r\nTerbuat dari bahan katun, sangat nyaman untuk bekerja maupun beraktifitas sehari2\r\n\r\n\r\nAll size lengan pndek:	Lingkar dada (Chest):86cm, Pundak (Shoulder):10cm, Panjang produk (Length):67,5cm\r\n'),
(17, 7, 'BBW-2', '4767blus panjang 1.JPG', 90000, 75000, '2011-09-27', 'ya', 'Blus cantik lengan panjang, \r\nmodel simple dengan motif batik terbaru dalam warna2 cerah, \r\ndilengkapi smok dada   yang memberi kesan langsing, sangat cocok untuk busana muslim. \r\nTerbuat dari bahan katun, nyaman untuk segala aktifitas.\r\n\r\nAll Size 	Bahu (shoulder): 12 cm, Lingkar Dada (Chest): 108 cm, \r\nPanjang produk (Length): 69 cm, Panjang Lengan: 54 cm'),
(18, 7, 'BBW-3', '6729baju-batik-blus-abg-motif-rumput-laut-cbub24m4.jpg', 65000, 50000, '2011-09-27', 'ya', 'Blus batik cantik dengan kerah lancip dan kancing bablas. \r\nMotif batik modern dalam warna2 cerah, simple dan elegan. \r\nTerbuat dari bahan katun, sangat nyaman untuk bekerja maupun beraktifitas sehari2\r\n\r\nAll size lengan pndek:	Lingkar dada (Chest):86cm, Pundak (Shoulder):10cm, Panjang produk (Length):67,5cm'),
(19, 6, 'KB-1', '6376baju-batik-casual-kaos-motif-animatif-cbuks04m5.jpg', 65000, 50000, '2011-09-27', 'ya', 'Kaos batik etnik dengan motif-motif menarik. Sangat unik dan elegan dengan gambar ciri khas kota Jogja. \r\nTerbuat dari bahan   kaos yang nyaman untuk aktifitas liburan dan bersantai anda.\r\nCocok juga sebagai cinderamata.'),
(20, 6, 'KB-2', '9082baju-batik-casual-kaos-motif-wayang-pelangi-etnik--size-s-cbuks10m1.jpg', 60000, 45000, '2011-09-27', 'ya', 'Kaos batik etnik dengan motif-motif menarik. Sangat unik dan elegan dengan gambar ciri khas kota Jogja. \r\nTerbuat dari bahan   kaos yang nyaman untuk aktifitas liburan dan bersantai anda.\r\nCocok juga sebagai cinderamata.\r\n\r\nM 	Bahu (shoulder): 16 cm, Lingkar Dada (Chest): 100 cm, Panjang produk (Length): 62 cm 	\r\n'),
(22, 10, 'JB-1', '556jaket-batik-adidas.jpg', 120000, 90000, '2011-09-27', 'ya', 'Jaket Batik Adidas\r\n\r\nBahan kain batik lasem berkualitas. Ukuran L 	Bahu (shoulder): 16 cm, \r\nLingkar Dada (Chest): 114 cm, Panjang produk (Length): 70,5 cm'),
(23, 10, 'JB-2', '578jaket-batik-back-and-forth-motif-parang-modern-cbuj01m2.jpg', 75000, 60000, '2011-09-27', 'ya', 'Jaket batik lengan panjang.\r\nTerbuat dari bahan katun yang nyaman dikenakan dan hangat.\r\nM 	Bahu (shoulder): 16 cm, Lingkar Dada (Chest): 107 cm, Panjang produk (Length): 67 cm 	\r\nL 	Bahu (shoulder): 16 cm, Lingkar Dada (Chest): 114 cm, Panjang produk (Length): 70,5 cm'),
(24, 2, 'TSB-1', '9694nb-01_45ribu.jpg', 40000, 30000, '2011-09-27', 'ya', 'Tas ini sangat cocok digunakan untuk acara santai \r\nseperti rekreasi , piknik. ataupun sekolah\r\n\r\nPanjang Produk: 35 cm; Lebar: 32 cm; Panjang Tali: 90 cm'),
(25, 2, 'TSB-2', '9441nb-01_versi2 45ribu.jpg', 40000, 30000, '2011-09-27', 'ya', 'Tas ini sangat cocok digunakan untuk acara santai \r\nseperti rekreasi , piknik. ataupun sekolah\r\n	\r\nPanjang Produk: 35 cm; Lebar: 32 cm; Panjang Tali: 90 cm'),
(26, 2, 'TSB-3', '5204tb-01.jpg', 40000, 30000, '2011-09-27', 'ya', 'Tas Slempang yang cocok untuk jalan ataupun bersekolah.\r\nMemiliki aksen pita dengan bahan batik.\r\n\r\nPanjang Produk: 35 cm; Lebar: 32 cm; Panjang Tali: 90 cm'),
(27, 2, 'TSB-4', '3866tb-02_40ribu.jpg', 45000, 30000, '2011-09-27', 'ya', 'Tas Slempang yang cocok untuk jalan ataupun bersekolah.\r\nMemiliki aksen kantong depan dengan bahan batik.\r\n\r\nPanjang Produk: 35 cm; Lebar: 32 cm; Panjang Tali: 90 cm'),
(28, 2, 'TSB-5', '6753tas-rebbeca-motif--ceplok-warna-dj-td-16.jpg', 55000, 40000, '2011-09-27', 'ya', 'Tas Slempang yang cocok untuk jalan ataupun bersekolah.\r\nMemiliki aksen pita dengan bahan batik.\r\n\r\nPanjang Produk: 35 cm; Lebar: 32 cm; Panjang Tali: 123 cm'),
(30, 4, 'TLB-1', '6713tas-laptop-motif-batik-aneka-parang-14-inchi-dj-tbl-1.jpg', 60000, 45000, '2011-09-27', 'ya', 'Tas laptop dengan motif batik\r\nDpat sebagai softcover yang melindungi dari goresan atau debu\r\n\r\nM untuk laptop 13inch\r\nL untuk laptop 14 inch'),
(31, 4, 'TLB-2', '5824tas-laptop-batik-motif-parang-lasem-klasik-cbut01.jpg', 60000, 45000, '2011-09-27', 'ya', 'Tas laptop dengan motif batik\r\nDpat sebagai softcover yang melindungi dari goresan atau debu\r\n\r\nS untuk laptop 10inch\r\nL untuk laptop 14 inch'),
(32, 4, 'TLB-3', '4115tas-laptop-batik-motif-batik-klasik-10-inchi-dj-tblk-13.jpg', 60000, 45000, '2011-09-27', 'ya', 'Tas laptop dengan motif batik\r\nDpat sebagai softcover yang melindungi dari goresan atau debu\r\n\r\nM untuk laptop 13inch\r\nL untuk laptop 14 inch'),
(33, 4, 'TLB-4', '3708tas-laptop-batik-motif-bulat-buat-putih--10-inchi-dj-tblk-6.jpg', 60000, 45000, '2011-09-27', 'ya', 'Tas laptop dengan motif batik\r\nDpat sebagai softcover yang melindungi dari goresan atau debu\r\n\r\nM untuk laptop 13inch\r\nL untuk laptop 14 inch'),
(34, 4, 'TLB-5', '4273tas-laptop-batik-motif-batik-klasik-10-inchi-dj-tblk-16.jpg', 60000, 45000, '2011-09-27', 'ya', 'Tas laptop dengan motif batik\r\nDpat sebagai softcover yang melindungi dari goresan atau debu\r\n\r\nS untuk laptop 10inch\r\nL untuk laptop 14 inch'),
(35, 1, 'TRB-1', '4330tas-rangsel-3-fungsi-motif-batik-parang-dj-tbp-9.jpg', 60000, 45000, '2011-09-27', 'ya', 'Tas ini memiliki 1 kantong besar , 1 kantong kecil di depan \r\nuntuk menyimpan hp ataupun uang. \r\nTas ini sangat cocok digunakan untuk pergi ke sekolah, piknik, dan jalan-jalan. \r\nTas ini sangat cocok digunakan oleh semua kalangan.\r\n\r\nPanjang: 27 cm; Lebar: 35 cm ; Berat: 450 gram\r\n'),
(36, 1, 'TRB-2', '86tas-rangsel-3-fungsi-pita-depan-dj-tbp-6.jpg', 60000, 45000, '2011-09-27', 'ya', 'Tas ini memiliki 1 kantong besar , 1 kantong kecil di depan.\r\nTas ini sangat cocok digunakan untuk pergi ke sekolah, piknik, dan jalan-jalan. \r\nTas ini sangat cocok digunakan oleh semua kalangan.\r\n\r\nPanjang: 27 cm; Lebar: 35 cm ; Berat: 450 gram\r\n'),
(37, 1, 'TRB-3', '3839tas-rangsel-oval-motif-batik-parang-bunga-ungu-dj-tro-1.jpg', 60000, 45000, '2011-09-27', 'ya', 'Tas ini memiliki 1 kantong besar , 1 kantong kecil di depan serta memiliki \r\n2 saku kecil di bagian samping untuk menyimpan tempat minum atau hp. \r\nTas ini sangat cocok digunakan untuk pergi ke sekolah, piknik, dan jalan-jalan. \r\nTas ini sangat cocok digunakan oleh semua kalangan.\r\n\r\nPanjang 43 cm; Lebar: 33 cm; Berat 550 gram'),
(38, 1, 'TRB-4', '9971tas-rangsel-oval-motif-batik-parang-putih-dj-tro-4.jpg', 60000, 45000, '2011-09-27', 'ya', 'Tas ini memiliki 1 kantong besar , 1 kantong kecil di depan serta memiliki \r\n2 saku kecil di bagian samping untuk menyimpan tempat minum atau hp. \r\nTas ini sangat cocok digunakan untuk pergi ke sekolah, piknik, dan jalan-jalan. \r\nTas ini sangat cocok digunakan oleh semua kalangan.\r\n\r\n\r\nPanjang: 43 cm; Lebar: 33 cm\r\nBerat 550 gram'),
(39, 11, 'AB-1', '2241capadidas_mat_ind_01.jpg', 30000, 15000, '2011-10-01', 'ya', 'Topi batik gaul\r\n\r\nM : lingkar kepala(70cm)\r\nL : lingkar kepala(75cm)');

-- --------------------------------------------------------

--
-- Table structure for table `provinsi`
--

CREATE TABLE IF NOT EXISTS `provinsi` (
  `id_prov` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) NOT NULL,
  PRIMARY KEY (`id_prov`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `provinsi`
--

INSERT INTO `provinsi` (`id_prov`, `nama`) VALUES
(1, 'Bali'),
(2, 'Banten'),
(3, 'Batam & Kepri'),
(4, 'Bengkulu'),
(5, 'DKI Jakarta'),
(6, 'Jambi'),
(7, 'Jawa Barat'),
(8, 'Jawa Tengah'),
(9, 'Jawa Timur'),
(10, 'Kalimantan Barat'),
(11, 'Kalimantan Selatan'),
(12, 'Kalimantan Tengah'),
(13, 'Kalimantan Timur'),
(14, 'Lampung'),
(15, 'Maluku'),
(16, 'NAD'),
(17, 'NTB'),
(18, 'Papua'),
(19, 'Riau'),
(20, 'Sulawesi Selatan'),
(21, 'Sulawesi Tengah'),
(22, 'Sulawesi Tenggara'),
(23, 'Sulawesi Utara'),
(24, 'Sumatra Barat'),
(25, 'Sumatra Selatan'),
(26, 'Sumatra Utara'),
(27, 'Yogyakarta'),
(28, 'Kepulauan Bangka Belitung '),
(29, 'Gorontalo'),
(30, 'Maluku Utara'),
(31, 'Papua Barat'),
(32, 'NTT');

-- --------------------------------------------------------

--
-- Table structure for table `stok_detail`
--

CREATE TABLE IF NOT EXISTS `stok_detail` (
  `id_stok` int(10) NOT NULL AUTO_INCREMENT,
  `id_produk` int(10) NOT NULL,
  `size` varchar(15) NOT NULL,
  `stok_max` int(10) NOT NULL,
  `stok_diweb` int(10) NOT NULL,
  PRIMARY KEY (`id_stok`),
  KEY `id_produk` (`id_produk`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1687 ;

--
-- Dumping data for table `stok_detail`
--

INSERT INTO `stok_detail` (`id_stok`, `id_produk`, `size`, `stok_max`, `stok_diweb`) VALUES
(1635, 1, 'M', 4, 4),
(1636, 1, 'L', 4, 4),
(1637, 2, 'allsize', 3, 2),
(1638, 3, 'allsize', 2, 2),
(1639, 4, 'allsize', 6, 5),
(1640, 5, 'S', 2, 2),
(1641, 5, 'M', 3, 3),
(1642, 5, 'L', 3, 2),
(1643, 6, 'allsize', 4, 4),
(1644, 6, 'M', 10, 10),
(1645, 9, 'allsize', 4, 4),
(1646, 10, 'allsize', 5, 5),
(1647, 11, 'M', 3, 3),
(1648, 11, 'L', 4, 2),
(1649, 12, 'allsize', 4, 4),
(1650, 12, 'L', 4, 4),
(1651, 14, 'L', 3, 3),
(1652, 15, 'allsize', 3, 3),
(1653, 16, 'allsize', 3, 3),
(1654, 17, 'allsize', 3, 3),
(1655, 18, 'allsize', 4, 3),
(1656, 19, 'L', 3, 3),
(1657, 20, 'M', 3, 3),
(1658, 20, 'L', 7, 7),
(1659, 22, 'L', 7, 7),
(1660, 22, 'M', 7, 7),
(1661, 23, 'M', 2, 2),
(1662, 23, 'L', 2, 2),
(1663, 24, 'M', 8, 8),
(1664, 25, 'M', 6, 6),
(1665, 26, 'M', 5, 4),
(1666, 27, 'M', 10, 10),
(1668, 28, 'S', 2, 2),
(1669, 28, 'M', 2, 2),
(1670, 28, 'L', 5, 5),
(1671, 30, 'M', 3, 3),
(1672, 30, 'L', 6, 6),
(1673, 31, 'S', 2, 2),
(1674, 31, 'L', 8, 8),
(1675, 32, 'M', 2, 2),
(1676, 32, 'L', 6, 6),
(1677, 33, 'M', 3, 3),
(1678, 33, 'L', 8, 7),
(1679, 34, 'S', 4, 4),
(1680, 34, 'L', 6, 6),
(1681, 35, 'M', 8, 8),
(1682, 36, 'M', 12, 12),
(1683, 37, 'L', 6, 6),
(1684, 38, 'L', 10, 10),
(1685, 39, 'M', 3, 3),
(1686, 39, 'L', 6, 6);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `keranjang_belanja`
--
ALTER TABLE `keranjang_belanja`
  ADD CONSTRAINT `keranjang_belanja_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`),
  ADD CONSTRAINT `keranjang_belanja_ibfk_2` FOREIGN KEY (`id_stok`) REFERENCES `stok_detail` (`id_stok`);

--
-- Constraints for table `kota_kirim`
--
ALTER TABLE `kota_kirim`
  ADD CONSTRAINT `kota_kirim_ibfk_1` FOREIGN KEY (`id_prov`) REFERENCES `provinsi` (`id_prov`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_customer`);

--
-- Constraints for table `pembelian_detail`
--
ALTER TABLE `pembelian_detail`
  ADD CONSTRAINT `pembelian_detail_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `pembelian_detail_ibfk_3` FOREIGN KEY (`id_stok`) REFERENCES `stok_detail` (`id_stok`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `pembelian_detail_ibfk_4` FOREIGN KEY (`id_pembelian`) REFERENCES `pembelian` (`id_pembelian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);

--
-- Constraints for table `stok_detail`
--
ALTER TABLE `stok_detail`
  ADD CONSTRAINT `stok_detail_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
