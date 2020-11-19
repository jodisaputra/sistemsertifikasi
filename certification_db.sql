/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50724
 Source Host           : localhost:3306
 Source Schema         : certification_db

 Target Server Type    : MySQL
 Target Server Version : 50724
 File Encoding         : 65001

 Date: 19/11/2020 09:55:25
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for ssc_absen_peserta_sertifikasi
-- ----------------------------
DROP TABLE IF EXISTS `ssc_absen_peserta_sertifikasi`;
CREATE TABLE `ssc_absen_peserta_sertifikasi`  (
  `aps_absen` bigint(20) NOT NULL,
  `aps_peserta` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `aps_ishadir` enum('y','n','i') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `aps_userupdate` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `aps_lastupdate` datetime(0) NOT NULL,
  PRIMARY KEY (`aps_absen`, `aps_peserta`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of ssc_absen_peserta_sertifikasi
-- ----------------------------

-- ----------------------------
-- Table structure for ssc_absen_sertifikasi
-- ----------------------------
DROP TABLE IF EXISTS `ssc_absen_sertifikasi`;
CREATE TABLE `ssc_absen_sertifikasi`  (
  `as_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `as_batch` bigint(20) NOT NULL,
  `as_nama_absen` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `as_tanggal` date NULL DEFAULT NULL,
  `as_nama_instruktur` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `as_instruktur_ishadir` enum('y','n') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `as_catatan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `as_userupdate` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `as_lastupdate` datetime(0) NOT NULL,
  PRIMARY KEY (`as_id`, `as_batch`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of ssc_absen_sertifikasi
-- ----------------------------

-- ----------------------------
-- Table structure for ssc_batch_sertifikasi
-- ----------------------------
DROP TABLE IF EXISTS `ssc_batch_sertifikasi`;
CREATE TABLE `ssc_batch_sertifikasi`  (
  `bs_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `bs_subsertifikasi` int(11) NOT NULL,
  `bs_jumlahpertemuan` int(11) NOT NULL,
  `bs_mulai_daftar` date NOT NULL,
  `bs_terakhir_daftar` date NOT NULL,
  `bs_biaya_mhs` int(11) NOT NULL,
  `bs_biaya_umum` int(11) NOT NULL,
  `bs_banner` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `bs_keterangan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `bs_jumlahmax` int(11) NOT NULL,
  `bs_jumlahmin` int(11) NOT NULL,
  `bs_userupdate` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `bs_lastupdate` datetime(0) NOT NULL,
  PRIMARY KEY (`bs_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of ssc_batch_sertifikasi
-- ----------------------------

-- ----------------------------
-- Table structure for ssc_jadwal_subsertifikasi
-- ----------------------------
DROP TABLE IF EXISTS `ssc_jadwal_subsertifikasi`;
CREATE TABLE `ssc_jadwal_subsertifikasi`  (
  `js_batch` bigint(20) NOT NULL,
  `js_tanggal` date NOT NULL,
  `js_mulai` time(0) NOT NULL,
  `js_selesai` time(0) NOT NULL,
  `js_tempat` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `js_link` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `js_userupdate` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `js_lastupdate` datetime(0) NOT NULL,
  PRIMARY KEY (`js_batch`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of ssc_jadwal_subsertifikasi
-- ----------------------------

-- ----------------------------
-- Table structure for ssc_log_sertifikasi
-- ----------------------------
DROP TABLE IF EXISTS `ssc_log_sertifikasi`;
CREATE TABLE `ssc_log_sertifikasi`  (
  `ls_id` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ls_npm` varchar(9) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ls_sertifikasi` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ls_tanggal_ujian` date NOT NULL,
  `ls_nilai` decimal(6, 2) NULL DEFAULT NULL,
  `ls_jenis_sa` int(11) NULL DEFAULT NULL,
  `ls_point` int(11) NULL DEFAULT NULL,
  `ls_keteranganbpka` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ls_tanggal_set` datetime(0) NULL DEFAULT NULL,
  `ls_persetujuan_wr1` enum('w','y','n') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ls_catatanwr1` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ls_tanggal_validasi_wr1` datetime(0) NOT NULL,
  `ls_persetujuan_adc` enum('w','y','n') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ls_keteranganadc` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ls_tanggal_validasi_adc` datetime(0) NULL DEFAULT NULL,
  `ls_masuk_sa` enum('w','y','n') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ls_tanggal_masuk_sa` datetime(0) NULL DEFAULT NULL,
  `ls_userupdate` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ls_lastupdate` datetime(0) NOT NULL,
  PRIMARY KEY (`ls_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of ssc_log_sertifikasi
-- ----------------------------

-- ----------------------------
-- Table structure for ssc_model_sertifikat
-- ----------------------------
DROP TABLE IF EXISTS `ssc_model_sertifikat`;
CREATE TABLE `ssc_model_sertifikat`  (
  `ms_id` int(11) NOT NULL AUTO_INCREMENT,
  `ms_model` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ms_sertifikat` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ms_linkmodel` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ms_userupdate` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ms_lastupdate` datetime(0) NOT NULL,
  PRIMARY KEY (`ms_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of ssc_model_sertifikat
-- ----------------------------

-- ----------------------------
-- Table structure for ssc_modul
-- ----------------------------
DROP TABLE IF EXISTS `ssc_modul`;
CREATE TABLE `ssc_modul`  (
  `mdl_id` int(11) NOT NULL AUTO_INCREMENT,
  `mdl_modul` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `mdl_link` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `mdl_icon` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `mdl_mainmenu` int(11) NOT NULL,
  PRIMARY KEY (`mdl_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of ssc_modul
-- ----------------------------
INSERT INTO `ssc_modul` VALUES (1, 'Pengaturan Seminar', '#', 'fas fa-clipboard-list', 0);
INSERT INTO `ssc_modul` VALUES (2, 'Model Sertifikat', 'model_sertifikat', 'far fa-file-alt', 1);
INSERT INTO `ssc_modul` VALUES (3, 'Daftar Seminar', 'seminar', 'fas fa-clipboard-list', 1);
INSERT INTO `ssc_modul` VALUES (4, 'Pembayaran Mahasiswa', 'validasipembayaranseminarmahasiswa', 'fas fa-money-check', 1);
INSERT INTO `ssc_modul` VALUES (5, 'Pembayaran Umum', 'validasipembayaranseminarumum', 'fas fa-money-check-alt', 1);
INSERT INTO `ssc_modul` VALUES (6, 'Pengaturan Sertifikasi', '#', 'fas fa-certificate', 0);
INSERT INTO `ssc_modul` VALUES (7, 'Daftar Sertifikasi', 'sertifikasi', 'fas fa-certificate', 6);
INSERT INTO `ssc_modul` VALUES (8, 'Batch Sertifikasi', 'batch_sertifikasi', 'fas fa-list-alt', 6);
INSERT INTO `ssc_modul` VALUES (9, 'Daftar Penilaian Sertifikasi', 'penilaian', 'fas fa-sort-numeric-up-alt', 6);
INSERT INTO `ssc_modul` VALUES (10, 'Pembayaran Mahasiswa', 'validasipembayaransertifikasimahasiswa', 'fas fa-money-check', 6);
INSERT INTO `ssc_modul` VALUES (11, 'Pembayaran Umum', 'validasipembayaransertifikasiumum', 'fas fa-money-check-alt', 6);
INSERT INTO `ssc_modul` VALUES (12, 'Pengaturan', '#', 'fas fa-cog', 0);
INSERT INTO `ssc_modul` VALUES (13, 'Pengaturan Modul', 'modul', 'fas fa-bars', 12);
INSERT INTO `ssc_modul` VALUES (14, 'Pengaturan Grup User', 'usergroup', 'fas fa-users-cog', 12);
INSERT INTO `ssc_modul` VALUES (15, 'Pengaturan User', 'user', 'fas fa-user', 12);

-- ----------------------------
-- Table structure for ssc_modul_group
-- ----------------------------
DROP TABLE IF EXISTS `ssc_modul_group`;
CREATE TABLE `ssc_modul_group`  (
  `mg_id` int(11) NOT NULL AUTO_INCREMENT,
  `mg_usergroup` int(11) NOT NULL,
  `mg_modul` int(11) NOT NULL,
  PRIMARY KEY (`mg_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of ssc_modul_group
-- ----------------------------
INSERT INTO `ssc_modul_group` VALUES (1, 1, 1);
INSERT INTO `ssc_modul_group` VALUES (2, 1, 2);
INSERT INTO `ssc_modul_group` VALUES (3, 1, 3);
INSERT INTO `ssc_modul_group` VALUES (4, 1, 4);
INSERT INTO `ssc_modul_group` VALUES (5, 1, 5);
INSERT INTO `ssc_modul_group` VALUES (6, 1, 6);
INSERT INTO `ssc_modul_group` VALUES (7, 1, 7);
INSERT INTO `ssc_modul_group` VALUES (8, 1, 8);
INSERT INTO `ssc_modul_group` VALUES (9, 1, 9);
INSERT INTO `ssc_modul_group` VALUES (10, 1, 10);
INSERT INTO `ssc_modul_group` VALUES (11, 1, 11);
INSERT INTO `ssc_modul_group` VALUES (12, 1, 12);
INSERT INTO `ssc_modul_group` VALUES (13, 1, 13);
INSERT INTO `ssc_modul_group` VALUES (14, 1, 14);
INSERT INTO `ssc_modul_group` VALUES (15, 1, 15);

-- ----------------------------
-- Table structure for ssc_narasumber_seminar
-- ----------------------------
DROP TABLE IF EXISTS `ssc_narasumber_seminar`;
CREATE TABLE `ssc_narasumber_seminar`  (
  `ns_id` int(11) NOT NULL AUTO_INCREMENT,
  `ns_seminar` int(11) NOT NULL,
  `ns_narasumber` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ns_institusi` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ns_set_tandatangan` enum('y','n') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ns_tandatangan` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ns_sebagai` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ns_userupdate` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ns_lastupdate` datetime(0) NOT NULL,
  PRIMARY KEY (`ns_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of ssc_narasumber_seminar
-- ----------------------------

-- ----------------------------
-- Table structure for ssc_pelatih_subsertifikasi
-- ----------------------------
DROP TABLE IF EXISTS `ssc_pelatih_subsertifikasi`;
CREATE TABLE `ssc_pelatih_subsertifikasi`  (
  `ps_batch` bigint(20) NOT NULL,
  `ps_email` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ps_nama` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ps_institusi` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ps_sebagai` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ps_userupdate` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ps_lastupdate` datetime(0) NOT NULL,
  PRIMARY KEY (`ps_batch`, `ps_email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of ssc_pelatih_subsertifikasi
-- ----------------------------

-- ----------------------------
-- Table structure for ssc_penilaian
-- ----------------------------
DROP TABLE IF EXISTS `ssc_penilaian`;
CREATE TABLE `ssc_penilaian`  (
  `pn_id` int(11) NOT NULL AUTO_INCREMENT,
  `pn_sertifikasi` int(11) NOT NULL,
  `pn_min` decimal(6, 2) NOT NULL,
  `pn_max` decimal(6, 2) NOT NULL,
  `pn_grade` varchar(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pn_penghargaan` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pn_lembagasertifikat` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pn_status` enum('Lulus','Tidak Lulus') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pn_userupdate` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pn_lastupdate` datetime(0) NOT NULL,
  PRIMARY KEY (`pn_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of ssc_penilaian
-- ----------------------------

-- ----------------------------
-- Table structure for ssc_peserta_umum
-- ----------------------------
DROP TABLE IF EXISTS `ssc_peserta_umum`;
CREATE TABLE `ssc_peserta_umum`  (
  `pu_email` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pu_password` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pu_nama` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pu_ktp` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pu_wa` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pu_asal_instansi` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pu_isaktif` enum('y','n') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`pu_email`) USING BTREE,
  UNIQUE INDEX `pu_ktp`(`pu_ktp`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of ssc_peserta_umum
-- ----------------------------

-- ----------------------------
-- Table structure for ssc_seminar
-- ----------------------------
DROP TABLE IF EXISTS `ssc_seminar`;
CREATE TABLE `ssc_seminar`  (
  `smr_id` int(11) NOT NULL AUTO_INCREMENT,
  `smr_acara` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `smr_tanggal` date NOT NULL,
  `smr_tempat` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `smr_jam_mulai` time(0) NOT NULL,
  `smr_jam_selesai` time(0) NOT NULL,
  `smr_moderator` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `smr_biaya_mhs` int(11) NOT NULL,
  `smr_biaya_umum` int(11) NOT NULL,
  `smr_banner` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `smr_keterangan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `smr_link_online` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `smr_model_sertifikat` int(11) NULL DEFAULT NULL,
  `smr_jumlahmax` int(11) NOT NULL,
  `smr_userupdate` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `smr_lastupdate` datetime(0) NOT NULL,
  PRIMARY KEY (`smr_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of ssc_seminar
-- ----------------------------

-- ----------------------------
-- Table structure for ssc_seminar_mahasiswa
-- ----------------------------
DROP TABLE IF EXISTS `ssc_seminar_mahasiswa`;
CREATE TABLE `ssc_seminar_mahasiswa`  (
  `smhs_seminar` int(11) NOT NULL,
  `smhs_mahasiswa` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `smhs_tanggaldaftar` date NOT NULL,
  `smhs_bank` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `smhs_norekening` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `smhs_namapemilik` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `smhs_bukti` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `smhs_ishadir` enum('y','n') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `smhs_totalbayar` bigint(20) NULL DEFAULT NULL,
  `smhs_status` enum('Menunggu Pembayaran','Validasi Pembayaran','Lunas','Tolak') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `smhs_keteranganpembayaran` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `smhs_userupdate` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `smhs_lastupdate` datetime(0) NOT NULL,
  PRIMARY KEY (`smhs_seminar`, `smhs_mahasiswa`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of ssc_seminar_mahasiswa
-- ----------------------------

-- ----------------------------
-- Table structure for ssc_seminar_umum
-- ----------------------------
DROP TABLE IF EXISTS `ssc_seminar_umum`;
CREATE TABLE `ssc_seminar_umum`  (
  `su_seminar` int(11) NOT NULL,
  `su_peserta` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `su_tanggaldaftar` date NOT NULL,
  `su_bank` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `su_norekening` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `su_namapemilik` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `su_bukti` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `su_ishadir` enum('y','n') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `su_status` enum('Menunggu Pembayaran','Validasi Pembayaran','Lunas','Tolak') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `su_userupdate` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `su_lastupdate` datetime(0) NOT NULL,
  `su_keteranganpembayaran` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `su_totalbayar` bigint(20) NULL DEFAULT NULL,
  PRIMARY KEY (`su_seminar`, `su_peserta`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of ssc_seminar_umum
-- ----------------------------

-- ----------------------------
-- Table structure for ssc_sertifikasi
-- ----------------------------
DROP TABLE IF EXISTS `ssc_sertifikasi`;
CREATE TABLE `ssc_sertifikasi`  (
  `cert_id` int(11) NOT NULL AUTO_INCREMENT,
  `cert_sertifikasi` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `cert_prodi` int(11) NOT NULL,
  `cert_isaktif` enum('y','n') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `cert_userupdate` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `cert_lastupdate` datetime(0) NOT NULL,
  PRIMARY KEY (`cert_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of ssc_sertifikasi
-- ----------------------------

-- ----------------------------
-- Table structure for ssc_sertifikasi_mahasiswa
-- ----------------------------
DROP TABLE IF EXISTS `ssc_sertifikasi_mahasiswa`;
CREATE TABLE `ssc_sertifikasi_mahasiswa`  (
  `sm_id` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `sm_sertifikasi` int(11) NOT NULL,
  `sm_tanggal_daftar` date NOT NULL,
  `sm_mahasiswa` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `sm_skor` decimal(6, 2) NULL DEFAULT NULL,
  `sm_grade` varchar(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sm_penghargaan` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sm_lembagasertifikasi` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sm_sertifikat` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sm_status` enum('Lulus','Tidak Lulus') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sm_tanggal_lulus` datetime(0) NULL DEFAULT NULL,
  `sm_catatan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `sm_userupdate` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `sm_lastupdate` datetime(0) NOT NULL,
  PRIMARY KEY (`sm_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of ssc_sertifikasi_mahasiswa
-- ----------------------------

-- ----------------------------
-- Table structure for ssc_sertifikasi_umum
-- ----------------------------
DROP TABLE IF EXISTS `ssc_sertifikasi_umum`;
CREATE TABLE `ssc_sertifikasi_umum`  (
  `srtu_id` varchar(22) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `srtu_sertifikasi` int(11) NOT NULL,
  `srtu_peserta` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `srtu_tanggal_daftar` date NOT NULL,
  `srtu_skor` decimal(6, 2) NULL DEFAULT NULL,
  `srtu_grade` varchar(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `srtu_penghargaan` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `srtu_sertifikat` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `srtu_lembagasertifikasi` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `srtu_status` enum('Lulus','Tidak Lulus') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `srtu_tanggal_lulus` date NULL DEFAULT NULL,
  `srtu_catatan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `srtu_userupdate` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `srtu_lastupdate` datetime(0) NOT NULL,
  PRIMARY KEY (`srtu_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of ssc_sertifikasi_umum
-- ----------------------------

-- ----------------------------
-- Table structure for ssc_subsertifikasi
-- ----------------------------
DROP TABLE IF EXISTS `ssc_subsertifikasi`;
CREATE TABLE `ssc_subsertifikasi`  (
  `scert_id` int(11) NOT NULL AUTO_INCREMENT,
  `scert_sertifikasi` int(11) NOT NULL,
  `scert_subsertifikasi` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `scert_isaktif` enum('y','n') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `scert_userupdate` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `scert_lastupdate` datetime(0) NOT NULL,
  PRIMARY KEY (`scert_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of ssc_subsertifikasi
-- ----------------------------

-- ----------------------------
-- Table structure for ssc_subsertifikasi_mahasiswa
-- ----------------------------
DROP TABLE IF EXISTS `ssc_subsertifikasi_mahasiswa`;
CREATE TABLE `ssc_subsertifikasi_mahasiswa`  (
  `ssm_id` varchar(22) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ssm_sertifikasi_mahasiswa` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ssm_subsertifikasi` int(11) NOT NULL,
  `ssm_batch` bigint(20) NOT NULL,
  `ssm_tanggaldaftar` datetime(0) NOT NULL,
  `ssm_bank` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ssm_norekening` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ssm_namapemilik` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ssm_bukti` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ssm_status` enum('Menunggu Pembayaran','Validasi Pembayaran','Lunas','Tolak') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ssm_keteranganpembayaran` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `ssm_tanggal_sertifikasi` date NULL DEFAULT NULL,
  `ssm_skor` decimal(6, 2) NULL DEFAULT NULL,
  `ssm_userupdate` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ssm_lastupdate` datetime(0) NOT NULL,
  `ssm_totalbayar` bigint(20) NULL DEFAULT NULL,
  PRIMARY KEY (`ssm_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of ssc_subsertifikasi_mahasiswa
-- ----------------------------

-- ----------------------------
-- Table structure for ssc_subsertifikasi_umum
-- ----------------------------
DROP TABLE IF EXISTS `ssc_subsertifikasi_umum`;
CREATE TABLE `ssc_subsertifikasi_umum`  (
  `ssu_id` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ssu_sertifikasi_umum` varchar(22) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ssu_subsertifikasi` int(11) NOT NULL,
  `ssu_batch` bigint(20) NOT NULL,
  `ssu_tanggaldaftar` date NOT NULL,
  `ssu_bank` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ssu_norekening` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ssu_namapemilik` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ssu_bukti` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ssu_status` enum('Menunggu Pembayaran','Validasi Pembayaran','Lunas','Tolak') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ssu_keteranganpembayaran` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `ssu_tanggal_sertifikasi` date NULL DEFAULT NULL,
  `ssu_skor` decimal(6, 2) NULL DEFAULT NULL,
  `ssu_userupdate` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ssu_lastupdate` datetime(0) NOT NULL,
  `ssu_totalbayar` bigint(20) NULL DEFAULT NULL,
  PRIMARY KEY (`ssu_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of ssc_subsertifikasi_umum
-- ----------------------------

-- ----------------------------
-- Table structure for ssc_user
-- ----------------------------
DROP TABLE IF EXISTS `ssc_user`;
CREATE TABLE `ssc_user`  (
  `usr_email` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `usr_nama` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `usr_group` int(11) NOT NULL,
  `usr_prodi` int(11) NOT NULL,
  `usr_isaktif` enum('y','n') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `usr_userupdate` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `usr_lastupdate` datetime(0) NOT NULL,
  PRIMARY KEY (`usr_email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of ssc_user
-- ----------------------------
INSERT INTO `ssc_user` VALUES ('herman@uib.ac.id', 'Herman', 4, 0, 'y', '', '2020-11-09 03:39:08');
INSERT INTO `ssc_user` VALUES ('jodi@uib.ac.id', 'Jodi Saragih', 1, 0, 'y', 'razer.29.gamer@gmail.com', '2020-11-19 02:51:03');

-- ----------------------------
-- Table structure for ssc_user_group
-- ----------------------------
DROP TABLE IF EXISTS `ssc_user_group`;
CREATE TABLE `ssc_user_group`  (
  `ug_id` int(11) NOT NULL AUTO_INCREMENT,
  `ug_group` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ug_keterangan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ug_isaktif` enum('y','n') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ug_userupdate` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ug_lastupdate` datetime(0) NOT NULL,
  PRIMARY KEY (`ug_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of ssc_user_group
-- ----------------------------
INSERT INTO `ssc_user_group` VALUES (1, 'IT Center UIB', '-', 'y', 'jodi@uib.ac.id', '2020-11-19 02:48:15');
INSERT INTO `ssc_user_group` VALUES (2, 'Keuangan', '-', 'y', 'jodi@uib.ac.id', '2020-11-19 02:48:23');
INSERT INTO `ssc_user_group` VALUES (3, 'ADC', '-', 'y', 'jodi@uib.ac.id', '2020-11-19 02:48:29');

SET FOREIGN_KEY_CHECKS = 1;
