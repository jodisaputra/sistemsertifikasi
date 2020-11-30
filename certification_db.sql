-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 30, 2020 at 10:36 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sertifikasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `ssc_absen_peserta_sertifikasi`
--

CREATE TABLE `ssc_absen_peserta_sertifikasi` (
  `aps_absen` bigint(20) NOT NULL,
  `aps_peserta` varchar(150) NOT NULL,
  `aps_ishadir` enum('y','n','i') NOT NULL,
  `aps_userupdate` varchar(150) NOT NULL,
  `aps_lastupdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ssc_absen_peserta_sertifikasi`
--

INSERT INTO `ssc_absen_peserta_sertifikasi` (`aps_absen`, `aps_peserta`, `aps_ishadir`, `aps_userupdate`, `aps_lastupdate`) VALUES
(1, '1831119', 'n', 'jodi@uib.ac.id', '2020-11-30 03:16:52'),
(2, '1831119', 'y', 'jodi@uib.ac.id', '2020-11-20 15:08:18'),
(3, '1831119', 'y', 'jodi@uib.ac.id', '2020-11-20 15:15:33');

-- --------------------------------------------------------

--
-- Table structure for table `ssc_absen_sertifikasi`
--

CREATE TABLE `ssc_absen_sertifikasi` (
  `as_id` bigint(20) NOT NULL,
  `as_batch` bigint(20) NOT NULL,
  `as_nama_absen` varchar(150) DEFAULT NULL,
  `as_tanggal` date DEFAULT NULL,
  `as_nama_instruktur` varchar(150) DEFAULT NULL,
  `as_instruktur_ishadir` enum('y','n') DEFAULT NULL,
  `as_catatan` text,
  `as_userupdate` varchar(150) NOT NULL,
  `as_lastupdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ssc_absen_sertifikasi`
--

INSERT INTO `ssc_absen_sertifikasi` (`as_id`, `as_batch`, `as_nama_absen`, `as_tanggal`, `as_nama_instruktur`, `as_instruktur_ishadir`, `as_catatan`, `as_userupdate`, `as_lastupdate`) VALUES
(1, 1, 'Pertemuan Ke 1', '2020-11-20', 'jodi.saragih.29@gmail.com', 'y', 'Peserta Hadir', 'jodi@uib.ac.id', '2020-11-20 13:49:36'),
(2, 1, 'Pertemuan Ke 2', '2020-11-20', 'jodi.saragih.29@gmail.com', 'y', '', 'jodi@uib.ac.id', '2020-11-20 13:49:36'),
(3, 1, 'Pertemuan Ke 3', '2020-11-20', 'jodi.saragih.29@gmail.com', 'y', '', 'jodi@uib.ac.id', '2020-11-20 15:15:17'),
(4, 2, 'Pertemuan Ke 1', '2020-12-08', 'maya@uib.ac.id', 'y', '', 'maya@uib.ac.id', '2020-11-24 10:15:18'),
(5, 2, 'Pertemuan Ke ', NULL, NULL, NULL, NULL, 'maya@uib.ac.id', '2020-11-24 10:15:18'),
(6, 2, 'Pertemuan Ke ', NULL, NULL, NULL, NULL, 'maya@uib.ac.id', '2020-11-24 10:15:18'),
(7, 2, 'Pertemuan Ke ', NULL, NULL, NULL, NULL, 'maya@uib.ac.id', '2020-11-24 10:15:18'),
(8, 2, 'Pertemuan Ke ', NULL, NULL, NULL, NULL, 'maya@uib.ac.id', '2020-11-24 10:15:18'),
(9, 2, 'Pertemuan Ke ', NULL, NULL, NULL, NULL, 'maya@uib.ac.id', '2020-11-24 10:15:18'),
(10, 2, 'Pertemuan Ke ', NULL, NULL, NULL, NULL, 'maya@uib.ac.id', '2020-11-24 10:15:18'),
(11, 3, 'Pertemuan Ke ', NULL, NULL, NULL, NULL, 'maya@uib.ac.id', '2020-11-24 11:04:47'),
(12, 3, 'Pertemuan Ke ', NULL, NULL, NULL, NULL, 'maya@uib.ac.id', '2020-11-24 11:04:47'),
(13, 3, 'Pertemuan Ke ', NULL, NULL, NULL, NULL, 'maya@uib.ac.id', '2020-11-24 11:04:47'),
(14, 3, 'Pertemuan Ke ', NULL, NULL, NULL, NULL, 'maya@uib.ac.id', '2020-11-24 11:04:47'),
(15, 4, 'Pertemuan Ke ', NULL, NULL, NULL, NULL, 'jodi@uib.ac.id', '2020-11-30 03:21:58'),
(16, 4, 'Pertemuan Ke ', NULL, NULL, NULL, NULL, 'jodi@uib.ac.id', '2020-11-30 03:21:58'),
(17, 5, 'Pertemuan Ke ', NULL, NULL, NULL, NULL, 'jodi@uib.ac.id', '2020-11-30 03:27:06'),
(18, 5, 'Pertemuan Ke ', NULL, NULL, NULL, NULL, 'jodi@uib.ac.id', '2020-11-30 03:27:06'),
(19, 6, 'Pertemuan Ke ', NULL, NULL, NULL, NULL, 'jodi@uib.ac.id', '2020-11-30 03:29:16'),
(20, 6, 'Pertemuan Ke ', NULL, NULL, NULL, NULL, 'jodi@uib.ac.id', '2020-11-30 03:29:16');

-- --------------------------------------------------------

--
-- Table structure for table `ssc_batch_sertifikasi`
--

CREATE TABLE `ssc_batch_sertifikasi` (
  `bs_id` bigint(20) NOT NULL,
  `bs_subsertifikasi` int(11) NOT NULL,
  `bs_jumlahpertemuan` int(11) NOT NULL,
  `bs_mulai_daftar` date NOT NULL,
  `bs_terakhir_daftar` date NOT NULL,
  `bs_pendaftaranuntuk` enum('mahasiswa','umum','mahasiswa dan umum') NOT NULL,
  `bs_biaya_mhs` int(11) DEFAULT NULL,
  `bs_biaya_umum` int(11) DEFAULT NULL,
  `bs_banner` varchar(50) NOT NULL,
  `bs_keterangan` text NOT NULL,
  `bs_jumlahmax` int(11) NOT NULL,
  `bs_jumlahmin` int(11) NOT NULL,
  `bs_userupdate` varchar(150) NOT NULL,
  `bs_lastupdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ssc_batch_sertifikasi`
--

INSERT INTO `ssc_batch_sertifikasi` (`bs_id`, `bs_subsertifikasi`, `bs_jumlahpertemuan`, `bs_mulai_daftar`, `bs_terakhir_daftar`, `bs_pendaftaranuntuk`, `bs_biaya_mhs`, `bs_biaya_umum`, `bs_banner`, `bs_keterangan`, `bs_jumlahmax`, `bs_jumlahmin`, `bs_userupdate`, `bs_lastupdate`) VALUES
(1, 1, 3, '2020-11-20', '2020-11-20', 'mahasiswa', 120000, 120000, '1_Banner.jpg', '<p>Sertifikasi HTML 5</p><p><br></p>', 20, 10, 'jodi@uib.ac.id', '2020-11-20 15:15:17'),
(2, 2, 7, '2020-11-11', '2020-11-30', 'mahasiswa', 900000, 0, '2_Banner.PNG', '<p>Pembayaran sertifikasi melalui VA</p>', 60, 30, 'maya@uib.ac.id', '2020-11-24 10:15:18'),
(3, 3, 4, '2020-11-16', '2020-11-30', 'mahasiswa', 100000, 0, '3_Banner.jpeg', '<p>TES</p>', 30, 15, 'maya@uib.ac.id', '2020-11-24 11:04:47'),
(4, 1, 2, '2020-11-30', '2020-12-01', 'mahasiswa', 50000, NULL, '4_Banner.jpg', '<p>tidak ada<br></p>', 20, 10, 'jodi@uib.ac.id', '2020-11-30 04:41:49'),
(5, 1, 2, '2020-11-30', '2020-12-01', 'mahasiswa', 120000, NULL, '5_Banner.jpg', '<p>-<br></p>', 10, 10, 'jodi@uib.ac.id', '2020-11-30 03:27:06'),
(6, 1, 2, '2020-11-30', '2020-12-01', 'mahasiswa dan umum', 120000, 120000, '6_Banner.jpg', '<p>-<br></p>', 10, 10, 'jodi@uib.ac.id', '2020-11-30 03:29:16');

-- --------------------------------------------------------

--
-- Table structure for table `ssc_jadwal_subsertifikasi`
--

CREATE TABLE `ssc_jadwal_subsertifikasi` (
  `js_batch` bigint(20) NOT NULL,
  `js_tanggal` date NOT NULL,
  `js_mulai` time NOT NULL,
  `js_selesai` time NOT NULL,
  `js_tempat` varchar(150) DEFAULT NULL,
  `js_link` varchar(255) NOT NULL,
  `js_userupdate` varchar(150) NOT NULL,
  `js_lastupdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ssc_jadwal_subsertifikasi`
--

INSERT INTO `ssc_jadwal_subsertifikasi` (`js_batch`, `js_tanggal`, `js_mulai`, `js_selesai`, `js_tempat`, `js_link`, `js_userupdate`, `js_lastupdate`) VALUES
(1, '2020-11-21', '08:00:00', '12:00:00', 'UIB', '-', '', '2020-11-20 15:15:17'),
(2, '2020-12-08', '14:00:00', '15:00:00', 'Zoom', 'bitly/ujiancsmabatch5', 'maya@uib.ac.id', '2020-11-24 10:15:18'),
(3, '2020-11-27', '16:00:00', '14:00:00', 'Zoom', 'bitly/ujiancsmabatch5', 'maya@uib.ac.id', '2020-11-24 11:04:47'),
(4, '2020-12-01', '08:00:00', '12:00:00', '-', '-', '', '2020-11-30 04:41:49'),
(5, '2020-12-01', '08:00:00', '12:00:00', '-', '-', 'jodi@uib.ac.id', '2020-11-30 03:27:06'),
(6, '2020-12-01', '12:00:00', '17:00:00', '-', '-', 'jodi@uib.ac.id', '2020-11-30 03:29:16');

-- --------------------------------------------------------

--
-- Table structure for table `ssc_log_sertifikasi`
--

CREATE TABLE `ssc_log_sertifikasi` (
  `ls_id` varchar(20) NOT NULL,
  `ls_npm` varchar(9) NOT NULL,
  `ls_sertifikasi` varchar(150) NOT NULL,
  `ls_tanggal_ujian` date NOT NULL,
  `ls_nilai` decimal(6,2) DEFAULT NULL,
  `ls_jenis_sa` int(11) DEFAULT NULL,
  `ls_point` int(11) DEFAULT NULL,
  `ls_keteranganbpka` varchar(150) DEFAULT NULL,
  `ls_tanggal_set` datetime DEFAULT NULL,
  `ls_persetujuan_wr1` enum('w','y','n') NOT NULL,
  `ls_catatanwr1` varchar(150) DEFAULT NULL,
  `ls_tanggal_validasi_wr1` datetime NOT NULL,
  `ls_persetujuan_adc` enum('w','y','n') DEFAULT NULL,
  `ls_keteranganadc` varchar(150) DEFAULT NULL,
  `ls_tanggal_validasi_adc` datetime DEFAULT NULL,
  `ls_masuk_sa` enum('w','y','n') DEFAULT NULL,
  `ls_tanggal_masuk_sa` datetime DEFAULT NULL,
  `ls_userupdate` varchar(150) NOT NULL,
  `ls_lastupdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `ssc_model_sertifikat`
--

CREATE TABLE `ssc_model_sertifikat` (
  `ms_id` int(11) NOT NULL,
  `ms_model` varchar(150) NOT NULL,
  `ms_sertifikat` varchar(150) NOT NULL,
  `ms_bentuk_sertifikat` enum('portrait','landscape') NOT NULL,
  `ms_userupdate` varchar(150) NOT NULL,
  `ms_lastupdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ssc_model_sertifikat`
--

INSERT INTO `ssc_model_sertifikat` (`ms_id`, `ms_model`, `ms_sertifikat`, `ms_bentuk_sertifikat`, `ms_userupdate`, `ms_lastupdate`) VALUES
(1, 'Sertifikat 1', '1.jpeg', 'portrait', 'jodi@uib.ac.id', '2020-11-30 07:54:53');

-- --------------------------------------------------------

--
-- Table structure for table `ssc_modul`
--

CREATE TABLE `ssc_modul` (
  `mdl_id` int(11) NOT NULL,
  `mdl_modul` varchar(150) NOT NULL,
  `mdl_link` varchar(150) NOT NULL,
  `mdl_icon` varchar(150) NOT NULL,
  `mdl_mainmenu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ssc_modul`
--

INSERT INTO `ssc_modul` (`mdl_id`, `mdl_modul`, `mdl_link`, `mdl_icon`, `mdl_mainmenu`) VALUES
(1, 'Pengaturan Seminar', '#', 'fas fa-clipboard-list', 0),
(2, 'Model Sertifikat', 'model_sertifikat', 'far fa-file-alt', 1),
(3, 'Daftar Seminar', 'seminar', 'fas fa-clipboard-list', 1),
(4, 'Pembayaran Mahasiswa', 'validasipembayaranseminarmahasiswa', 'fas fa-money-check', 1),
(5, 'Pembayaran Umum', 'validasipembayaranseminarumum', 'fas fa-money-check-alt', 1),
(6, 'Pengaturan Sertifikasi', '#', 'fas fa-certificate', 0),
(7, 'Daftar Sertifikasi', 'sertifikasi', 'fas fa-certificate', 6),
(8, 'Batch Sertifikasi', 'batch_sertifikasi', 'fas fa-list-alt', 6),
(9, 'Daftar Penilaian Sertifikasi', 'penilaian', 'fas fa-sort-numeric-up-alt', 6),
(10, 'Pembayaran Mahasiswa', 'validasipembayaransertifikasimahasiswa', 'fas fa-money-check', 6),
(11, 'Pembayaran Umum', 'validasipembayaransertifikasiumum', 'fas fa-money-check-alt', 6),
(12, 'Pengaturan', '#', 'fas fa-cog', 0),
(13, 'Pengaturan Modul', 'modul', 'fas fa-bars', 12),
(14, 'Pengaturan Grup User', 'usergroup', 'fas fa-users-cog', 12),
(15, 'Pengaturan User', 'user', 'fas fa-user', 12);

-- --------------------------------------------------------

--
-- Table structure for table `ssc_modul_group`
--

CREATE TABLE `ssc_modul_group` (
  `mg_id` int(11) NOT NULL,
  `mg_usergroup` int(11) NOT NULL,
  `mg_modul` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ssc_modul_group`
--

INSERT INTO `ssc_modul_group` (`mg_id`, `mg_usergroup`, `mg_modul`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(10, 1, 10),
(11, 1, 11),
(12, 1, 12),
(13, 1, 13),
(14, 1, 14),
(15, 1, 15),
(16, 3, 1),
(17, 3, 2),
(18, 3, 3),
(19, 3, 6),
(20, 3, 7),
(21, 3, 8),
(22, 3, 9);

-- --------------------------------------------------------

--
-- Table structure for table `ssc_narasumber_seminar`
--

CREATE TABLE `ssc_narasumber_seminar` (
  `ns_id` int(11) NOT NULL,
  `ns_seminar` int(11) NOT NULL,
  `ns_narasumber` varchar(150) NOT NULL,
  `ns_gelardepan` varchar(50) DEFAULT NULL,
  `ns_gelarbelakang` varchar(50) DEFAULT NULL,
  `ns_institusi` varchar(150) DEFAULT NULL,
  `ns_set_tandatangan` enum('y','n') NOT NULL,
  `ns_tandatangan` varchar(150) DEFAULT NULL,
  `ns_sebagai` varchar(150) NOT NULL,
  `ns_userupdate` varchar(150) NOT NULL,
  `ns_lastupdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ssc_narasumber_seminar`
--

INSERT INTO `ssc_narasumber_seminar` (`ns_id`, `ns_seminar`, `ns_narasumber`, `ns_gelardepan`, `ns_gelarbelakang`, `ns_institusi`, `ns_set_tandatangan`, `ns_tandatangan`, `ns_sebagai`, `ns_userupdate`, `ns_lastupdate`) VALUES
(1, 2, 'Maya Marsevani', '', 'S.Kom, M.Kom', 'UIB', 'y', 'Tanda_tangan_bapak.png', 'Penandatangan sertifikat', 'jodi@uib.ac.id', '2020-11-30 07:47:28');

-- --------------------------------------------------------

--
-- Table structure for table `ssc_panitia_seminar`
--

CREATE TABLE `ssc_panitia_seminar` (
  `pan_id` int(11) NOT NULL,
  `pan_nama` varchar(150) NOT NULL,
  `pan_email` varchar(150) NOT NULL,
  `pan_seminar` int(11) NOT NULL,
  `pan_userupdate` varchar(150) NOT NULL,
  `pan_lastupdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ssc_panitia_seminar`
--

INSERT INTO `ssc_panitia_seminar` (`pan_id`, `pan_nama`, `pan_email`, `pan_seminar`, `pan_userupdate`, `pan_lastupdate`) VALUES
(1, 'Jodi Saragih', 'jodi.saragih.29@gmail.com', 1, 'jodi@uib.ac.id', '2020-11-30 08:11:29'),
(2, 'Jodi Saragih', 'jodi.saragih.29@gmail.com', 2, 'jodi@uib.ac.id', '2020-11-30 08:14:09');

-- --------------------------------------------------------

--
-- Table structure for table `ssc_pelatih_subsertifikasi`
--

CREATE TABLE `ssc_pelatih_subsertifikasi` (
  `ps_batch` bigint(20) NOT NULL,
  `ps_email` varchar(150) NOT NULL,
  `ps_nama` varchar(150) NOT NULL,
  `ps_institusi` varchar(150) DEFAULT NULL,
  `ps_sebagai` varchar(150) DEFAULT NULL,
  `ps_userupdate` varchar(150) NOT NULL,
  `ps_lastupdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ssc_pelatih_subsertifikasi`
--

INSERT INTO `ssc_pelatih_subsertifikasi` (`ps_batch`, `ps_email`, `ps_nama`, `ps_institusi`, `ps_sebagai`, `ps_userupdate`, `ps_lastupdate`) VALUES
(1, 'jodi.saragih.29@gmail.com', 'Jodi Saragih', 'UIB', 'Pelatih', 'jodi@uib.ac.id', '2020-11-20 13:52:53'),
(2, 'maya@uib.ac.id', 'Maya Marsevani', 'UIB', 'Instruktur', 'maya@uib.ac.id', '2020-11-24 10:18:50');

-- --------------------------------------------------------

--
-- Table structure for table `ssc_penilaian`
--

CREATE TABLE `ssc_penilaian` (
  `pn_id` int(11) NOT NULL,
  `pn_sertifikasi` int(11) NOT NULL,
  `pn_min` decimal(6,2) NOT NULL,
  `pn_max` decimal(6,2) NOT NULL,
  `pn_grade` varchar(2) NOT NULL,
  `pn_penghargaan` varchar(150) NOT NULL,
  `pn_lembagasertifikat` varchar(150) NOT NULL,
  `pn_status` enum('Lulus','Tidak Lulus') NOT NULL,
  `pn_userupdate` varchar(150) NOT NULL,
  `pn_lastupdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ssc_penilaian`
--

INSERT INTO `ssc_penilaian` (`pn_id`, `pn_sertifikasi`, `pn_min`, `pn_max`, `pn_grade`, `pn_penghargaan`, `pn_lembagasertifikat`, `pn_status`, `pn_userupdate`, `pn_lastupdate`) VALUES
(1, 1, '80.00', '100.00', 'A', 'Achievement', 'Multimatics', 'Lulus', 'jodi@uib.ac.id', '2020-11-20 13:56:00'),
(2, 1, '79.00', '70.00', 'B', 'Attendance', 'Multimatics', 'Lulus', 'jodi@uib.ac.id', '2020-11-20 13:56:38'),
(3, 2, '70.00', '100.00', 'A', 'Achievement', 'Logical Operations', 'Lulus', 'maya@uib.ac.id', '2020-11-24 10:25:13'),
(4, 2, '50.00', '69.00', 'B', 'Attendance', 'Logical Operations', 'Tidak Lulus', 'maya@uib.ac.id', '2020-11-24 10:26:04'),
(5, 2, '0.00', '49.00', 'C', 'Failed', 'Logical Operations', 'Tidak Lulus', 'maya@uib.ac.id', '2020-11-24 10:26:57');

-- --------------------------------------------------------

--
-- Table structure for table `ssc_peserta_umum`
--

CREATE TABLE `ssc_peserta_umum` (
  `pu_email` varchar(150) NOT NULL,
  `pu_password` varchar(150) NOT NULL,
  `pu_nama` varchar(150) NOT NULL,
  `pu_ktp` varchar(20) NOT NULL,
  `pu_wa` varchar(20) NOT NULL,
  `pu_asal_instansi` varchar(100) NOT NULL,
  `pu_isaktif` enum('y','n') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ssc_peserta_umum`
--

INSERT INTO `ssc_peserta_umum` (`pu_email`, `pu_password`, `pu_nama`, `pu_ktp`, `pu_wa`, `pu_asal_instansi`, `pu_isaktif`) VALUES
('jodi.saragih.29@gmail.com', '377bf4af7ea36f1a629e22dacd5e3dbf', 'Jodi Saputra Dermawan Saragih', '2171022000000000', '087732571273', 'UIB', 'y'),
('razer.29.gamer@gmail.com', '377bf4af7ea36f1a629e22dacd5e3dbf', 'Razer', '12345678901231313123', '081372851633', 'UIB', 'y');

-- --------------------------------------------------------

--
-- Table structure for table `ssc_seminar`
--

CREATE TABLE `ssc_seminar` (
  `smr_id` int(11) NOT NULL,
  `smr_acara` varchar(255) NOT NULL,
  `smr_tanggal` date NOT NULL,
  `smr_tempat` varchar(150) NOT NULL,
  `smr_jam_mulai` time NOT NULL,
  `smr_jam_selesai` time NOT NULL,
  `smr_moderator` varchar(150) NOT NULL,
  `smr_status_seminar` enum('bayar','gratis') NOT NULL,
  `smr_biaya_mhs` int(11) DEFAULT NULL,
  `smr_biaya_umum` int(11) DEFAULT NULL,
  `smr_banner` varchar(150) NOT NULL,
  `smr_keterangan` text,
  `smr_link_online` varchar(255) DEFAULT NULL,
  `smr_model_sertifikat` int(11) DEFAULT NULL,
  `smr_jumlahmax` int(11) NOT NULL,
  `smr_userupdate` varchar(150) NOT NULL,
  `smr_lastupdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ssc_seminar`
--

INSERT INTO `ssc_seminar` (`smr_id`, `smr_acara`, `smr_tanggal`, `smr_tempat`, `smr_jam_mulai`, `smr_jam_selesai`, `smr_moderator`, `smr_status_seminar`, `smr_biaya_mhs`, `smr_biaya_umum`, `smr_banner`, `smr_keterangan`, `smr_link_online`, `smr_model_sertifikat`, `smr_jumlahmax`, `smr_userupdate`, `smr_lastupdate`) VALUES
(1, 'Seminar ', '2020-11-23', 'UIB', '08:00:00', '12:00:00', 'Gladies Imanda Utami Rangkuty, S.T., M.Arch.', 'bayar', 0, 0, '1_Banner.jpg', '<p><span style=\"font-weight: normal; font-size: 1rem;\">Seminar ini dibawakan oleh BNN batam</span><br></p><p><img src=\"http://sertifikasi.uib.ac.id/daftarsertifikasi/./assets/summernote/JQDTVMMUd9.jpg\" style=\"width: 275px;\"><span style=\"font-weight: normal;\"><br></span></p>', '-', 1, 20, 'jodi@uib.ac.id', '2020-11-30 10:03:43'),
(2, 'Wadhwani Entrepreneurship', '2020-12-02', 'Zoom', '13:00:00', '16:00:00', 'Maya Marsevani', 'bayar', 120000, 120000, '2_Banner.PNG', '', 'bitly/ujiancsmabatch555', 1, 90, 'jodi@uib.ac.id', '2020-11-30 10:07:03'),
(3, 'Seminar ', '2020-11-30', 'Online Via Zoom', '08:00:00', '12:00:00', 'Tes', 'gratis', 0, 0, '3_Banner.jpg', '<p>-</p>', 'bitly/ujiancsmabatch', 1, 20, 'jodi@uib.ac.id', '2020-11-30 09:27:38');

-- --------------------------------------------------------

--
-- Table structure for table `ssc_seminar_mahasiswa`
--

CREATE TABLE `ssc_seminar_mahasiswa` (
  `smhs_seminar` int(11) NOT NULL,
  `smhs_mahasiswa` varchar(150) NOT NULL,
  `smhs_tanggaldaftar` date NOT NULL,
  `smhs_bank` varchar(150) DEFAULT NULL,
  `smhs_norekening` varchar(30) DEFAULT NULL,
  `smhs_namapemilik` varchar(150) DEFAULT NULL,
  `smhs_bukti` varchar(150) DEFAULT NULL,
  `smhs_ishadir` enum('y','n') DEFAULT NULL,
  `smhs_totalbayar` bigint(20) DEFAULT NULL,
  `smhs_status` enum('Menunggu Pembayaran','Validasi Pembayaran','Lunas','Tolak') DEFAULT NULL,
  `smhs_keteranganpembayaran` text,
  `smhs_userupdate` varchar(150) NOT NULL,
  `smhs_lastupdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ssc_seminar_mahasiswa`
--

INSERT INTO `ssc_seminar_mahasiswa` (`smhs_seminar`, `smhs_mahasiswa`, `smhs_tanggaldaftar`, `smhs_bank`, `smhs_norekening`, `smhs_namapemilik`, `smhs_bukti`, `smhs_ishadir`, `smhs_totalbayar`, `smhs_status`, `smhs_keteranganpembayaran`, `smhs_userupdate`, `smhs_lastupdate`) VALUES
(1, '1831119', '2020-11-20', 'OCBC', '12345', 'Jodi', '1831119_1.JPG', NULL, 20000, 'Lunas', 'Pembayaran Lunas', 'jodi@uib.ac.id', '2020-11-20 10:41:18'),
(2, '1831119', '2020-11-24', 'CIMB', '12345', 'Jodi', '1831119_2.png', 'y', 12000, 'Lunas', 'Pembayaran Lunas', 'maya@uib.ac.id', '2020-11-24 10:49:16'),
(3, '2032024', '2020-11-30', NULL, NULL, NULL, NULL, NULL, NULL, 'Lunas', 'Lunas', '2032024', '2020-11-30 10:32:49');

-- --------------------------------------------------------

--
-- Table structure for table `ssc_seminar_umum`
--

CREATE TABLE `ssc_seminar_umum` (
  `su_seminar` int(11) NOT NULL,
  `su_peserta` varchar(150) NOT NULL,
  `su_tanggaldaftar` date NOT NULL,
  `su_bank` varchar(150) DEFAULT NULL,
  `su_norekening` varchar(30) DEFAULT NULL,
  `su_namapemilik` varchar(150) DEFAULT NULL,
  `su_bukti` varchar(150) DEFAULT NULL,
  `su_ishadir` enum('y','n') DEFAULT NULL,
  `su_status` enum('Menunggu Pembayaran','Validasi Pembayaran','Lunas','Tolak') DEFAULT NULL,
  `su_userupdate` varchar(150) NOT NULL,
  `su_lastupdate` datetime NOT NULL,
  `su_keteranganpembayaran` text,
  `su_totalbayar` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ssc_seminar_umum`
--

INSERT INTO `ssc_seminar_umum` (`su_seminar`, `su_peserta`, `su_tanggaldaftar`, `su_bank`, `su_norekening`, `su_namapemilik`, `su_bukti`, `su_ishadir`, `su_status`, `su_userupdate`, `su_lastupdate`, `su_keteranganpembayaran`, `su_totalbayar`) VALUES
(2, 'jodi.saragih.29@gmail.com', '2020-11-30', NULL, NULL, NULL, NULL, 'y', 'Lunas', 'jodi.saragih.29@gmail.com', '2020-11-30 08:35:25', NULL, NULL),
(3, 'razer.29.gamer@gmail.com', '2020-11-30', NULL, NULL, NULL, NULL, NULL, 'Lunas', 'razer.29.gamer@gmail.com', '2020-11-30 10:36:22', 'Lunas', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ssc_sertifikasi`
--

CREATE TABLE `ssc_sertifikasi` (
  `cert_id` int(11) NOT NULL,
  `cert_sertifikasi` varchar(150) NOT NULL,
  `cert_prodi` int(11) NOT NULL,
  `cert_isaktif` enum('y','n') NOT NULL,
  `cert_userupdate` varchar(150) NOT NULL,
  `cert_lastupdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ssc_sertifikasi`
--

INSERT INTO `ssc_sertifikasi` (`cert_id`, `cert_sertifikasi`, `cert_prodi`, `cert_isaktif`, `cert_userupdate`, `cert_lastupdate`) VALUES
(1, 'HTML5', 31, 'y', 'jodi@uib.ac.id', '2020-11-20 13:40:19'),
(2, 'CSMA', 41, 'y', 'maya@uib.ac.id', '2020-11-24 10:09:33'),
(3, 'ACPAI', 42, 'y', 'maya@uib.ac.id', '2020-11-24 10:55:40');

-- --------------------------------------------------------

--
-- Table structure for table `ssc_sertifikasi_mahasiswa`
--

CREATE TABLE `ssc_sertifikasi_mahasiswa` (
  `sm_id` varchar(20) NOT NULL,
  `sm_sertifikasi` int(11) NOT NULL,
  `sm_tanggal_daftar` date NOT NULL,
  `sm_mahasiswa` varchar(150) NOT NULL,
  `sm_skor` decimal(6,2) DEFAULT NULL,
  `sm_grade` varchar(2) DEFAULT NULL,
  `sm_penghargaan` varchar(150) DEFAULT NULL,
  `sm_lembagasertifikasi` varchar(150) DEFAULT NULL,
  `sm_sertifikat` varchar(150) DEFAULT NULL,
  `sm_status` enum('Lulus','Tidak Lulus') DEFAULT NULL,
  `sm_tanggal_lulus` datetime DEFAULT NULL,
  `sm_catatan` text,
  `sm_userupdate` varchar(150) NOT NULL,
  `sm_lastupdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ssc_sertifikasi_mahasiswa`
--

INSERT INTO `ssc_sertifikasi_mahasiswa` (`sm_id`, `sm_sertifikasi`, `sm_tanggal_daftar`, `sm_mahasiswa`, `sm_skor`, `sm_grade`, `sm_penghargaan`, `sm_lembagasertifikasi`, `sm_sertifikat`, `sm_status`, `sm_tanggal_lulus`, `sm_catatan`, `sm_userupdate`, `sm_lastupdate`) VALUES
('1831119001', 1, '2020-11-20', '1831119', '90.00', 'A', 'Achievement', 'Multimatics', 'Halaman_Depan.pdf', 'Lulus', '2020-11-20 00:00:00', '-', 'jodi@uib.ac.id', '2020-11-20 15:37:35'),
('1831119002', 2, '2020-11-24', '1831119', '77.00', 'A', 'Achievement', 'Logical Operations', 'Reading_Practice_-_IELTS.pdf', 'Lulus', '2020-12-24 00:00:00', '', 'maya@uib.ac.id', '2020-11-24 10:29:00'),
('2032024001', 1, '2020-11-20', '2032024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2032024', '2020-11-20 14:18:01');

-- --------------------------------------------------------

--
-- Table structure for table `ssc_sertifikasi_umum`
--

CREATE TABLE `ssc_sertifikasi_umum` (
  `srtu_id` varchar(22) NOT NULL,
  `srtu_sertifikasi` int(11) NOT NULL,
  `srtu_peserta` varchar(150) NOT NULL,
  `srtu_tanggal_daftar` date NOT NULL,
  `srtu_skor` decimal(6,2) DEFAULT NULL,
  `srtu_grade` varchar(2) DEFAULT NULL,
  `srtu_penghargaan` varchar(150) DEFAULT NULL,
  `srtu_sertifikat` varchar(150) DEFAULT NULL,
  `srtu_lembagasertifikasi` varchar(150) DEFAULT NULL,
  `srtu_status` enum('Lulus','Tidak Lulus') DEFAULT NULL,
  `srtu_tanggal_lulus` date DEFAULT NULL,
  `srtu_catatan` text,
  `srtu_userupdate` varchar(150) NOT NULL,
  `srtu_lastupdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ssc_sertifikasi_umum`
--

INSERT INTO `ssc_sertifikasi_umum` (`srtu_id`, `srtu_sertifikasi`, `srtu_peserta`, `srtu_tanggal_daftar`, `srtu_skor`, `srtu_grade`, `srtu_penghargaan`, `srtu_sertifikat`, `srtu_lembagasertifikasi`, `srtu_status`, `srtu_tanggal_lulus`, `srtu_catatan`, `srtu_userupdate`, `srtu_lastupdate`) VALUES
('U2171022000000000-001', 1, 'jodi.saragih.29@gmail.com', '2020-11-20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'jodi.saragih.29@gmail.com', '2020-11-20 14:05:49');

-- --------------------------------------------------------

--
-- Table structure for table `ssc_subsertifikasi`
--

CREATE TABLE `ssc_subsertifikasi` (
  `scert_id` int(11) NOT NULL,
  `scert_sertifikasi` int(11) NOT NULL,
  `scert_subsertifikasi` varchar(150) NOT NULL,
  `scert_isaktif` enum('y','n') NOT NULL,
  `scert_userupdate` varchar(150) NOT NULL,
  `scert_lastupdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ssc_subsertifikasi`
--

INSERT INTO `ssc_subsertifikasi` (`scert_id`, `scert_sertifikasi`, `scert_subsertifikasi`, `scert_isaktif`, `scert_userupdate`, `scert_lastupdate`) VALUES
(1, 1, 'HTML5', 'y', 'jodi@uib.ac.id', '2020-11-20 13:42:51'),
(2, 2, 'CSMA', 'y', 'maya@uib.ac.id', '2020-11-24 10:10:07'),
(3, 3, 'ACPAI - A', 'y', 'maya@uib.ac.id', '2020-11-24 11:00:06'),
(4, 3, 'ACPAI - B', 'y', 'maya@uib.ac.id', '2020-11-24 11:00:18'),
(5, 3, 'ACPAI - C', 'y', 'maya@uib.ac.id', '2020-11-24 11:00:28'),
(6, 3, 'ACPAI - D', 'y', 'maya@uib.ac.id', '2020-11-24 11:00:37'),
(7, 3, 'ACPAI - D', 'y', 'maya@uib.ac.id', '2020-11-24 11:00:47');

-- --------------------------------------------------------

--
-- Table structure for table `ssc_subsertifikasi_mahasiswa`
--

CREATE TABLE `ssc_subsertifikasi_mahasiswa` (
  `ssm_id` varchar(22) NOT NULL,
  `ssm_sertifikasi_mahasiswa` varchar(20) NOT NULL,
  `ssm_subsertifikasi` int(11) NOT NULL,
  `ssm_batch` bigint(20) NOT NULL,
  `ssm_tanggaldaftar` datetime NOT NULL,
  `ssm_bank` varchar(150) DEFAULT NULL,
  `ssm_norekening` varchar(30) DEFAULT NULL,
  `ssm_namapemilik` varchar(150) DEFAULT NULL,
  `ssm_bukti` varchar(150) DEFAULT NULL,
  `ssm_status` enum('Menunggu Pembayaran','Validasi Pembayaran','Lunas','Tolak') DEFAULT NULL,
  `ssm_keteranganpembayaran` text,
  `ssm_tanggal_sertifikasi` date DEFAULT NULL,
  `ssm_skor` decimal(6,2) DEFAULT NULL,
  `ssm_userupdate` varchar(150) NOT NULL,
  `ssm_lastupdate` datetime NOT NULL,
  `ssm_totalbayar` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ssc_subsertifikasi_mahasiswa`
--

INSERT INTO `ssc_subsertifikasi_mahasiswa` (`ssm_id`, `ssm_sertifikasi_mahasiswa`, `ssm_subsertifikasi`, `ssm_batch`, `ssm_tanggaldaftar`, `ssm_bank`, `ssm_norekening`, `ssm_namapemilik`, `ssm_bukti`, `ssm_status`, `ssm_keteranganpembayaran`, `ssm_tanggal_sertifikasi`, `ssm_skor`, `ssm_userupdate`, `ssm_lastupdate`, `ssm_totalbayar`) VALUES
('183111900101', '1831119001', 1, 1, '2020-11-20 13:58:21', 'OCBC', '1234566', 'Jodi', '1831119_183111900101.JPG', 'Lunas', 'Pembayaran Lunas', '2020-11-20', '90.00', 'jodi@uib.ac.id', '2020-11-20 15:31:32', 120000),
('183111900201', '1831119002', 2, 2, '2020-11-24 10:21:50', 'CIMB', '1234', 'Jodi', '1831119_183111900201.png', 'Lunas', 'Pembayaran Lunas', '2020-12-23', '77.00', 'maya@uib.ac.id', '2020-11-24 10:27:35', 120000),
('203202400101', '2032024001', 1, 1, '2020-11-20 14:18:01', 'OCBC', '12345', 'Frandika', '2032024_203202400101.JPG', 'Validasi Pembayaran', NULL, NULL, NULL, '2032024', '2020-11-20 14:18:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ssc_subsertifikasi_umum`
--

CREATE TABLE `ssc_subsertifikasi_umum` (
  `ssu_id` varchar(25) NOT NULL,
  `ssu_sertifikasi_umum` varchar(22) NOT NULL,
  `ssu_subsertifikasi` int(11) NOT NULL,
  `ssu_batch` bigint(20) NOT NULL,
  `ssu_tanggaldaftar` date NOT NULL,
  `ssu_bank` varchar(150) DEFAULT NULL,
  `ssu_norekening` varchar(30) DEFAULT NULL,
  `ssu_namapemilik` varchar(150) DEFAULT NULL,
  `ssu_bukti` varchar(150) DEFAULT NULL,
  `ssu_status` enum('Menunggu Pembayaran','Validasi Pembayaran','Lunas','Tolak') DEFAULT NULL,
  `ssu_keteranganpembayaran` text,
  `ssu_tanggal_sertifikasi` date DEFAULT NULL,
  `ssu_skor` decimal(6,2) DEFAULT NULL,
  `ssu_userupdate` varchar(150) NOT NULL,
  `ssu_lastupdate` datetime NOT NULL,
  `ssu_totalbayar` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ssc_subsertifikasi_umum`
--

INSERT INTO `ssc_subsertifikasi_umum` (`ssu_id`, `ssu_sertifikasi_umum`, `ssu_subsertifikasi`, `ssu_batch`, `ssu_tanggaldaftar`, `ssu_bank`, `ssu_norekening`, `ssu_namapemilik`, `ssu_bukti`, `ssu_status`, `ssu_keteranganpembayaran`, `ssu_tanggal_sertifikasi`, `ssu_skor`, `ssu_userupdate`, `ssu_lastupdate`, `ssu_totalbayar`) VALUES
('U2171022000000000-001-01', 'U2171022000000000-001', 1, 1, '2020-11-20', 'OCBC', '12345678', 'Jodi', '2171022000000000_U2171022000000000-001-01.JPG', 'Validasi Pembayaran', NULL, NULL, NULL, 'jodi.saragih.29@gmail.com', '2020-11-20 14:06:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ssc_user`
--

CREATE TABLE `ssc_user` (
  `usr_email` varchar(150) NOT NULL,
  `usr_nama` varchar(150) NOT NULL,
  `usr_group` int(11) NOT NULL,
  `usr_prodi` int(11) NOT NULL,
  `usr_isaktif` enum('y','n') NOT NULL,
  `usr_userupdate` varchar(150) NOT NULL,
  `usr_lastupdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ssc_user`
--

INSERT INTO `ssc_user` (`usr_email`, `usr_nama`, `usr_group`, `usr_prodi`, `usr_isaktif`, `usr_userupdate`, `usr_lastupdate`) VALUES
('herman@uib.ac.id', 'Herman', 1, 0, 'y', '', '2020-11-19 03:05:31'),
('jodi@uib.ac.id', 'Jodi Saragih', 1, 0, 'y', '', '2020-11-19 03:05:43'),
('licen@uib.ac.id', 'Li Cen', 1, 0, 'y', 'jodi@uib.ac.id', '2020-11-19 03:03:53'),
('maya@uib.ac.id', 'Maya', 3, 0, 'y', 'jodi@uib.ac.id', '2020-11-24 10:05:38'),
('patrick@uib.ac.id', 'Patrick', 1, 0, 'y', 'jodi@uib.ac.id', '2020-11-19 03:04:08'),
('yefta@uib.ac.id', 'Yefta Christian', 1, 0, 'y', 'jodi@uib.ac.id', '2020-11-19 03:04:22');

-- --------------------------------------------------------

--
-- Table structure for table `ssc_user_group`
--

CREATE TABLE `ssc_user_group` (
  `ug_id` int(11) NOT NULL,
  `ug_group` varchar(150) NOT NULL,
  `ug_keterangan` text NOT NULL,
  `ug_isaktif` enum('y','n') NOT NULL,
  `ug_userupdate` varchar(150) NOT NULL,
  `ug_lastupdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ssc_user_group`
--

INSERT INTO `ssc_user_group` (`ug_id`, `ug_group`, `ug_keterangan`, `ug_isaktif`, `ug_userupdate`, `ug_lastupdate`) VALUES
(1, 'IT Center UIB', '-', 'y', 'jodi@uib.ac.id', '2020-11-19 02:48:15'),
(2, 'Keuangan', '-', 'y', 'jodi@uib.ac.id', '2020-11-19 02:48:23'),
(3, 'ADC', '-', 'y', 'jodi@uib.ac.id', '2020-11-19 02:48:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ssc_absen_peserta_sertifikasi`
--
ALTER TABLE `ssc_absen_peserta_sertifikasi`
  ADD PRIMARY KEY (`aps_absen`,`aps_peserta`) USING BTREE;

--
-- Indexes for table `ssc_absen_sertifikasi`
--
ALTER TABLE `ssc_absen_sertifikasi`
  ADD PRIMARY KEY (`as_id`,`as_batch`) USING BTREE;

--
-- Indexes for table `ssc_batch_sertifikasi`
--
ALTER TABLE `ssc_batch_sertifikasi`
  ADD PRIMARY KEY (`bs_id`) USING BTREE;

--
-- Indexes for table `ssc_jadwal_subsertifikasi`
--
ALTER TABLE `ssc_jadwal_subsertifikasi`
  ADD PRIMARY KEY (`js_batch`) USING BTREE;

--
-- Indexes for table `ssc_log_sertifikasi`
--
ALTER TABLE `ssc_log_sertifikasi`
  ADD PRIMARY KEY (`ls_id`) USING BTREE;

--
-- Indexes for table `ssc_model_sertifikat`
--
ALTER TABLE `ssc_model_sertifikat`
  ADD PRIMARY KEY (`ms_id`) USING BTREE;

--
-- Indexes for table `ssc_modul`
--
ALTER TABLE `ssc_modul`
  ADD PRIMARY KEY (`mdl_id`) USING BTREE;

--
-- Indexes for table `ssc_modul_group`
--
ALTER TABLE `ssc_modul_group`
  ADD PRIMARY KEY (`mg_id`) USING BTREE;

--
-- Indexes for table `ssc_narasumber_seminar`
--
ALTER TABLE `ssc_narasumber_seminar`
  ADD PRIMARY KEY (`ns_id`) USING BTREE;

--
-- Indexes for table `ssc_panitia_seminar`
--
ALTER TABLE `ssc_panitia_seminar`
  ADD PRIMARY KEY (`pan_id`);

--
-- Indexes for table `ssc_pelatih_subsertifikasi`
--
ALTER TABLE `ssc_pelatih_subsertifikasi`
  ADD PRIMARY KEY (`ps_batch`,`ps_email`) USING BTREE;

--
-- Indexes for table `ssc_penilaian`
--
ALTER TABLE `ssc_penilaian`
  ADD PRIMARY KEY (`pn_id`) USING BTREE;

--
-- Indexes for table `ssc_peserta_umum`
--
ALTER TABLE `ssc_peserta_umum`
  ADD PRIMARY KEY (`pu_email`) USING BTREE,
  ADD UNIQUE KEY `pu_ktp` (`pu_ktp`) USING BTREE;

--
-- Indexes for table `ssc_seminar`
--
ALTER TABLE `ssc_seminar`
  ADD PRIMARY KEY (`smr_id`) USING BTREE;

--
-- Indexes for table `ssc_seminar_mahasiswa`
--
ALTER TABLE `ssc_seminar_mahasiswa`
  ADD PRIMARY KEY (`smhs_seminar`,`smhs_mahasiswa`) USING BTREE;

--
-- Indexes for table `ssc_seminar_umum`
--
ALTER TABLE `ssc_seminar_umum`
  ADD PRIMARY KEY (`su_seminar`,`su_peserta`) USING BTREE;

--
-- Indexes for table `ssc_sertifikasi`
--
ALTER TABLE `ssc_sertifikasi`
  ADD PRIMARY KEY (`cert_id`) USING BTREE;

--
-- Indexes for table `ssc_sertifikasi_mahasiswa`
--
ALTER TABLE `ssc_sertifikasi_mahasiswa`
  ADD PRIMARY KEY (`sm_id`) USING BTREE;

--
-- Indexes for table `ssc_sertifikasi_umum`
--
ALTER TABLE `ssc_sertifikasi_umum`
  ADD PRIMARY KEY (`srtu_id`) USING BTREE;

--
-- Indexes for table `ssc_subsertifikasi`
--
ALTER TABLE `ssc_subsertifikasi`
  ADD PRIMARY KEY (`scert_id`) USING BTREE;

--
-- Indexes for table `ssc_subsertifikasi_mahasiswa`
--
ALTER TABLE `ssc_subsertifikasi_mahasiswa`
  ADD PRIMARY KEY (`ssm_id`) USING BTREE;

--
-- Indexes for table `ssc_subsertifikasi_umum`
--
ALTER TABLE `ssc_subsertifikasi_umum`
  ADD PRIMARY KEY (`ssu_id`) USING BTREE;

--
-- Indexes for table `ssc_user`
--
ALTER TABLE `ssc_user`
  ADD PRIMARY KEY (`usr_email`) USING BTREE;

--
-- Indexes for table `ssc_user_group`
--
ALTER TABLE `ssc_user_group`
  ADD PRIMARY KEY (`ug_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ssc_absen_sertifikasi`
--
ALTER TABLE `ssc_absen_sertifikasi`
  MODIFY `as_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `ssc_batch_sertifikasi`
--
ALTER TABLE `ssc_batch_sertifikasi`
  MODIFY `bs_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ssc_model_sertifikat`
--
ALTER TABLE `ssc_model_sertifikat`
  MODIFY `ms_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ssc_modul`
--
ALTER TABLE `ssc_modul`
  MODIFY `mdl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `ssc_modul_group`
--
ALTER TABLE `ssc_modul_group`
  MODIFY `mg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `ssc_narasumber_seminar`
--
ALTER TABLE `ssc_narasumber_seminar`
  MODIFY `ns_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ssc_panitia_seminar`
--
ALTER TABLE `ssc_panitia_seminar`
  MODIFY `pan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ssc_penilaian`
--
ALTER TABLE `ssc_penilaian`
  MODIFY `pn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ssc_seminar`
--
ALTER TABLE `ssc_seminar`
  MODIFY `smr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ssc_sertifikasi`
--
ALTER TABLE `ssc_sertifikasi`
  MODIFY `cert_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ssc_subsertifikasi`
--
ALTER TABLE `ssc_subsertifikasi`
  MODIFY `scert_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ssc_user_group`
--
ALTER TABLE `ssc_user_group`
  MODIFY `ug_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
