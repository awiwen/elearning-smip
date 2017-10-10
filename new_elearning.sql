-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2017 at 04:54 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `new_elearning`
--

-- --------------------------------------------------------

--
-- Table structure for table `el_field_tambahan`
--

CREATE TABLE `el_field_tambahan` (
  `id` varchar(255) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `value` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `el_field_tambahan`
--

INSERT INTO `el_field_tambahan` (`id`, `nama`, `value`) VALUES
('history-mengerjakan-1-3', 'History pengerjaan tugas', '{"mulai":"2017-10-02 14:18:50","uri_string":"tugas\\/kerjakan\\/3","valid_route":["\\/tugas\\/kerjakan","\\/tugas\\/finish","\\/tugas\\/submit_essay","\\/tugas\\/submit_upload"],"tugas":{"id":"3","mapel_id":"1","pengajar_id":"2","type_id":"1","judul":"vhkhfkjg","durasi":null,"info":"<p>lhfkjkyfkjfjhfkj<\\/p>\\r\\n","aktif":"1","tgl_buat":"2017-10-02 14:17:30","tampil_siswa":"1"},"unix_id":"42b47b9bef100dce99fa88010bc02f6c809236","ip":"::1","agent_string":"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36","file_name":"42b47b9bef100dce99fa88010bc02f6c809236.pdf","tgl_submit":"2017-10-02 14:19:20","nilai":"60"}');

-- --------------------------------------------------------

--
-- Table structure for table `el_kelas`
--

CREATE TABLE `el_kelas` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `urutan` int(11) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=aktif 0=tidak'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `el_kelas`
--

INSERT INTO `el_kelas` (`id`, `nama`, `parent_id`, `urutan`, `aktif`) VALUES
(1, 'KELAS X', NULL, 1, 1),
(2, 'KELAS X TKJ - 1', 1, 2, 1),
(3, 'KELAS X TKJ - 2', 1, 3, 1),
(4, 'KELAS X MM - 1', 1, 4, 1),
(5, 'KELAS X MM - 2', 1, 5, 1),
(6, 'KELAS XI', NULL, 6, 1),
(7, 'KELAS XI TKJ - 1', 6, 7, 1),
(8, 'KELAS XI TKJ - 2', 6, 8, 1),
(9, 'KELAS XI MM - 1', 6, 9, 1),
(10, 'KELAS XI MM - 2', 6, 10, 1),
(11, 'KELAS XII', NULL, 11, 1),
(12, 'KELAS XII TKJ - 1', 11, 12, 1),
(13, 'KELAS XII TKJ - 2', 11, 13, 1),
(14, 'KELAS XII MM - 1', 11, 14, 1),
(15, 'KELAS XII MM - 2', 11, 15, 1);

-- --------------------------------------------------------

--
-- Table structure for table `el_kelas_siswa`
--

CREATE TABLE `el_kelas_siswa` (
  `id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `aktif` tinyint(1) NOT NULL COMMENT '0 jika bukan, 1 jika ya'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `el_kelas_siswa`
--

INSERT INTO `el_kelas_siswa` (`id`, `kelas_id`, `siswa_id`, `aktif`) VALUES
(1, 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `el_komentar`
--

CREATE TABLE `el_komentar` (
  `id` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `materi_id` int(11) NOT NULL,
  `tampil` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=tidak,1=tampil',
  `konten` text,
  `tgl_posting` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `el_login`
--

CREATE TABLE `el_login` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `siswa_id` int(11) DEFAULT NULL,
  `pengajar_id` int(11) DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL COMMENT '0=tidak,1=ya',
  `reset_kode` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `el_login`
--

INSERT INTO `el_login` (`id`, `username`, `password`, `siswa_id`, `pengajar_id`, `is_admin`, `reset_kode`) VALUES
(1, 'admin@aaa.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, 1, 1, NULL),
(2, 'aa@11.com', '4124bc0a9335c27f086f24ba207a4912', 1, NULL, 0, NULL),
(3, 'qwerty@11.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', NULL, 2, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `el_login_log`
--

CREATE TABLE `el_login_log` (
  `id` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `lasttime` datetime NOT NULL,
  `agent` text NOT NULL,
  `last_activity` int(10) UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `el_login_log`
--

INSERT INTO `el_login_log` (`id`, `login_id`, `lasttime`, `agent`, `last_activity`) VALUES
(1, 1, '2017-09-14 20:54:46', '{"is_mobile":0,"browser":"Chrome 60.0.3112.113","platform":"Unknown Windows OS","agent_string":"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.113 Safari\\/537.36","ip":"::1"}', 1505402604),
(2, 1, '2017-09-14 22:24:31', '{"is_mobile":0,"browser":"Chrome 60.0.3112.113","platform":"Unknown Windows OS","agent_string":"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.113 Safari\\/537.36","ip":"::1"}', 1505410881),
(3, 1, '2017-09-16 08:19:57', '{"is_mobile":0,"browser":"Chrome 60.0.3112.113","platform":"Unknown Windows OS","agent_string":"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.113 Safari\\/537.36","ip":"::1"}', 1505529256),
(4, 1, '2017-09-16 09:34:19', '{"is_mobile":0,"browser":"Chrome 60.0.3112.113","platform":"Unknown Windows OS","agent_string":"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.113 Safari\\/537.36","ip":"::1"}', 1505540676),
(5, 1, '2017-09-23 22:09:52', '{"is_mobile":0,"browser":"Chrome 60.0.3112.113","platform":"Unknown Windows OS","agent_string":"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.113 Safari\\/537.36","ip":"::1"}', 1506179503),
(6, 1, '2017-09-23 22:14:12', '{"is_mobile":0,"browser":"Chrome 60.0.3112.113","platform":"Unknown Windows OS","agent_string":"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.113 Safari\\/537.36","ip":"::1"}', 1506179586),
(7, 1, '2017-09-23 22:15:40', '{"is_mobile":0,"browser":"Chrome 60.0.3112.113","platform":"Unknown Windows OS","agent_string":"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.113 Safari\\/537.36","ip":"::1"}', 1506179666),
(8, 1, '2017-09-23 22:16:40', '{"is_mobile":0,"browser":"Chrome 60.0.3112.113","platform":"Unknown Windows OS","agent_string":"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.113 Safari\\/537.36","ip":"::1"}', 1506179730),
(9, 1, '2017-09-23 22:18:05', '{"is_mobile":0,"browser":"Chrome 60.0.3112.113","platform":"Unknown Windows OS","agent_string":"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.113 Safari\\/537.36","ip":"::1"}', 1506179803),
(10, 2, '2017-09-23 22:19:04', '{"is_mobile":0,"browser":"Chrome 60.0.3112.113","platform":"Unknown Windows OS","agent_string":"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.113 Safari\\/537.36","ip":"::1"}', 1506179858),
(11, 1, '2017-09-23 22:19:40', '{"is_mobile":0,"browser":"Chrome 60.0.3112.113","platform":"Unknown Windows OS","agent_string":"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.113 Safari\\/537.36","ip":"::1"}', 1506179908),
(12, 2, '2017-09-23 22:20:42', '{"is_mobile":0,"browser":"Chrome 60.0.3112.113","platform":"Unknown Windows OS","agent_string":"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.113 Safari\\/537.36","ip":"::1"}', 1506179988),
(13, 1, '2017-09-23 22:21:50', '{"is_mobile":0,"browser":"Chrome 60.0.3112.113","platform":"Unknown Windows OS","agent_string":"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.113 Safari\\/537.36","ip":"::1"}', 1506184975),
(14, 1, '2017-09-23 23:43:02', '{"is_mobile":0,"browser":"Chrome 60.0.3112.113","platform":"Unknown Windows OS","agent_string":"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.113 Safari\\/537.36","ip":"::1"}', 1506185919),
(15, 1, '2017-10-02 12:39:59', '{"is_mobile":0,"browser":"Chrome 61.0.3163.100","platform":"Unknown Windows OS","agent_string":"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36","ip":"::1"}', 1506924047),
(16, 1, '2017-10-02 13:02:57', '{"is_mobile":0,"browser":"Chrome 61.0.3163.100","platform":"Unknown Windows OS","agent_string":"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36","ip":"::1"}', 1506925898),
(17, 3, '2017-10-02 13:33:50', '{"is_mobile":0,"browser":"Chrome 61.0.3163.100","platform":"Unknown Windows OS","agent_string":"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36","ip":"::1"}', 1506926040),
(18, 1, '2017-10-02 13:36:06', '{"is_mobile":0,"browser":"Chrome 61.0.3163.100","platform":"Unknown Windows OS","agent_string":"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36","ip":"::1"}', 1506926108),
(19, 2, '2017-10-02 13:37:17', '{"is_mobile":0,"browser":"Chrome 61.0.3163.100","platform":"Unknown Windows OS","agent_string":"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36","ip":"::1"}', 1506926162),
(20, 1, '2017-10-02 13:38:10', '{"is_mobile":0,"browser":"Chrome 61.0.3163.100","platform":"Unknown Windows OS","agent_string":"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36","ip":"::1"}', 1506927757),
(21, 2, '2017-10-02 14:04:53', '{"is_mobile":0,"browser":"Chrome 61.0.3163.100","platform":"Unknown Windows OS","agent_string":"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36","ip":"::1"}', 1506927802),
(22, 3, '2017-10-02 14:05:27', '{"is_mobile":0,"browser":"Chrome 61.0.3163.100","platform":"Unknown Windows OS","agent_string":"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36","ip":"::1"}', 1506927878),
(23, 2, '2017-10-02 14:06:44', '{"is_mobile":0,"browser":"Chrome 61.0.3163.100","platform":"Unknown Windows OS","agent_string":"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36","ip":"::1"}', 1506927898),
(24, 1, '2017-10-02 14:07:04', '{"is_mobile":0,"browser":"Chrome 61.0.3163.100","platform":"Unknown Windows OS","agent_string":"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36","ip":"::1"}', 1506928448),
(25, 3, '2017-10-02 14:16:18', '{"is_mobile":0,"browser":"Chrome 61.0.3163.100","platform":"Unknown Windows OS","agent_string":"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36","ip":"::1"}', 1506928591),
(26, 2, '2017-10-02 14:18:38', '{"is_mobile":0,"browser":"Chrome 61.0.3163.100","platform":"Unknown Windows OS","agent_string":"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36","ip":"::1"}', 1506928649),
(27, 3, '2017-10-02 14:19:34', '{"is_mobile":0,"browser":"Chrome 61.0.3163.100","platform":"Unknown Windows OS","agent_string":"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36","ip":"::1"}', 1506928736),
(28, 2, '2017-10-02 14:21:05', '{"is_mobile":0,"browser":"Chrome 61.0.3163.100","platform":"Unknown Windows OS","agent_string":"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36","ip":"::1"}', 1506928769),
(29, 1, '2017-10-02 14:21:34', '{"is_mobile":0,"browser":"Chrome 61.0.3163.100","platform":"Unknown Windows OS","agent_string":"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36","ip":"::1"}', 1506930665);

-- --------------------------------------------------------

--
-- Table structure for table `el_mapel`
--

CREATE TABLE `el_mapel` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `info` text,
  `aktif` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = ya, 0 = tidak'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `el_mapel`
--

INSERT INTO `el_mapel` (`id`, `nama`, `info`, `aktif`) VALUES
(1, 'Bahasa Indonesia', NULL, 1),
(2, 'Bahasa Inggris', NULL, 1),
(3, 'Matematika', NULL, 1),
(4, 'KWU', NULL, 1),
(5, 'Seni Budaya', NULL, 1),
(6, 'Budi Pekerti', NULL, 1),
(7, 'Penjaskes', NULL, 1),
(8, 'Agama', NULL, 1),
(9, 'Fisika', NULL, 1),
(10, 'Kimia', NULL, 1),
(11, 'PKN', NULL, 1),
(12, 'IPS', NULL, 1),
(13, 'IPA', NULL, 1),
(14, 'Bahasa Daerah', NULL, 1),
(15, 'KKPI', NULL, 1),
(16, 'Kejuruan TKJ I', NULL, 1),
(17, 'Kejuruan TKJ II', NULL, 1),
(18, 'Kejuruan TKJ III', NULL, 1),
(19, 'Kejuruan MM I', NULL, 1),
(20, 'Kejuruan MM II', NULL, 1),
(21, 'Kejuruan MM III', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `el_mapel_ajar`
--

CREATE TABLE `el_mapel_ajar` (
  `id` int(11) NOT NULL,
  `hari_id` tinyint(1) NOT NULL COMMENT '1=senin,2=selasa,3=rabu,4=kamis,5=jum''at,6=sabtu,7=minggu',
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `pengajar_id` int(11) NOT NULL,
  `mapel_kelas_id` int(11) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = aktif 0 = tidak'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `el_mapel_ajar`
--

INSERT INTO `el_mapel_ajar` (`id`, `hari_id`, `jam_mulai`, `jam_selesai`, `pengajar_id`, `mapel_kelas_id`, `aktif`) VALUES
(1, 1, '00:00:08', '00:00:11', 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `el_mapel_kelas`
--

CREATE TABLE `el_mapel_kelas` (
  `id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `mapel_id` int(11) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `el_mapel_kelas`
--

INSERT INTO `el_mapel_kelas` (`id`, `kelas_id`, `mapel_id`, `aktif`) VALUES
(1, 2, 1, 1),
(2, 2, 2, 1),
(3, 2, 3, 1),
(4, 2, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `el_materi`
--

CREATE TABLE `el_materi` (
  `id` int(11) NOT NULL,
  `mapel_id` int(11) NOT NULL,
  `pengajar_id` int(11) DEFAULT NULL,
  `siswa_id` int(11) DEFAULT NULL,
  `judul` varchar(255) NOT NULL,
  `konten` text,
  `file` text,
  `tgl_posting` datetime NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '0',
  `views` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `el_materi`
--

INSERT INTO `el_materi` (`id`, `mapel_id`, `pengajar_id`, `siswa_id`, `judul`, `konten`, `file`, `tgl_posting`, `publish`, `views`) VALUES
(1, 1, 1, NULL, 'materi 1', '<p>test</p>\r\n', NULL, '2017-09-23 22:20:18', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `el_materi_kelas`
--

CREATE TABLE `el_materi_kelas` (
  `id` int(11) NOT NULL,
  `materi_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `el_materi_kelas`
--

INSERT INTO `el_materi_kelas` (`id`, `materi_id`, `kelas_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `el_messages`
--

CREATE TABLE `el_messages` (
  `id` int(11) NOT NULL,
  `type_id` tinyint(1) NOT NULL COMMENT '1=inbox,2=outbox',
  `content` text NOT NULL,
  `owner_id` int(11) NOT NULL,
  `sender_receiver_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `opened` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=belum,1=sudah'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `el_messages`
--

INSERT INTO `el_messages` (`id`, `type_id`, `content`, `owner_id`, `sender_receiver_id`, `date`, `opened`) VALUES
(1, 2, '<p>test</p>\r\n', 2, 1, '2017-09-23 22:21:43', 1),
(2, 1, '<p>test</p>\r\n', 1, 2, '2017-09-23 22:21:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `el_nilai_tugas`
--

CREATE TABLE `el_nilai_tugas` (
  `id` int(11) NOT NULL,
  `nilai` float NOT NULL,
  `tugas_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `el_nilai_tugas`
--

INSERT INTO `el_nilai_tugas` (`id`, `nilai`, `tugas_id`, `siswa_id`) VALUES
(1, 60, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `el_pengajar`
--

CREATE TABLE `el_pengajar` (
  `id` int(11) NOT NULL,
  `nip` varchar(45) DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(9) NOT NULL,
  `tempat_lahir` varchar(45) NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` varchar(255) NOT NULL,
  `foto` text,
  `status_id` tinyint(1) NOT NULL COMMENT '0=pending, 1=aktif, 2=blok'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `el_pengajar`
--

INSERT INTO `el_pengajar` (`id`, `nip`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tgl_lahir`, `alamat`, `foto`, `status_id`) VALUES
(1, '4555', 'admin', 'Laki-laki', '', NULL, '', NULL, 1),
(2, '', 'qwerty', 'Laki-laki', '', NULL, '', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `el_pengaturan`
--

CREATE TABLE `el_pengaturan` (
  `id` varchar(255) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `value` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `el_pengaturan`
--

INSERT INTO `el_pengaturan` (`id`, `nama`, `value`) VALUES
('email-server', 'Email server', 'no-reply@domain.com'),
('email-template-approve-pengajar', 'Approve pengajar (email pengajar)', '{"subject":"Pengaktifan Akun","body":"<p>Hai {$nama},<\\/p>\\n<p>Anda telah diterima sebagai pengajar pada {$nama_sekolah}, berikut informasi data diri anda:<\\/p>\\n<p>{$tabel_profil}<\\/p>\\n<p>Anda dapat login ke sistem E-Learning menggunakan username dan password yang telah anda buat saat pendaftaran, login pada url berikut : {$url_login}<\\/p>"}'),
('email-template-approve-siswa', 'Approve siswa (email siswa)', '{"subject":"Pengaktifan Akun","body":"<p>Hai {$nama},<\\/p>\\n<p>Anda telah diterima sebagai siswa pada {$nama_sekolah}, berikut informasi data diri anda:<\\/p>\\n<p>{$tabel_profil}<\\/p>\\n<p>Anda dapat login ke sistem E-Learning menggunakan username dan password yang telah anda buat saat pendaftaran, login pada url berikut : {$url_login}<\\/p>"}'),
('email-template-link-reset', 'Link Reset Password', '{"subject":"Reset Password","body":"<p>Hai,<\\/p>\\n<p>Anda mengirimkan permintaan untuk reset password anda, klik link berikut untuk memulai reset password : {$link_reset}<\\/p>"}'),
('email-template-register-pengajar', 'Register pengajar (email pengajar)', '{"subject":"Registrasi Berhasil","body":"<p>Hai {$nama},<\\/p>\\n<p>Terimakasih telah melakukan pendaftaran sebagai pengajar di E-Learning {$nama_sekolah}. Akun anda akan segera diaktifkan oleh admin.<\\/p>"}'),
('email-template-register-siswa', 'Register siswa (email siswa)', '{"subject":"Registrasi Berhasil","body":"<p>Hai {$nama},<\\/p>\\n<p>Terimakasih telah melakukan pendaftaran sebagai siswa di E-Learning {$nama_sekolah}. Akun anda akan segera diaktifkan oleh admin.<\\/p>"}'),
('info-registrasi', 'Info Registrasi', '<p>Silakan mendaftar sebagai siswa atau pengajar (jika anda sebagai pengajar) dengan memilih sesuai tab berikut :</p>'),
('peraturan-elearning', 'Peraturan E-learning', ''),
('registrasi-pengajar', 'Registrasi Pengajar', '1'),
('registrasi-siswa', 'Registrasi Siswa', '1'),
('versi', 'Versi', '1.9'),
('jenjang', 'jenjang', 'SMA'),
('nama-sekolah', 'nama-sekolah', 'smk 2'),
('alamat', 'alamat', 'gadung'),
('telp', 'telp', '5582665'),
('install-success', 'install-success', '1');

-- --------------------------------------------------------

--
-- Table structure for table `el_pengumuman`
--

CREATE TABLE `el_pengumuman` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `konten` text NOT NULL,
  `tgl_tampil` date NOT NULL,
  `tgl_tutup` date NOT NULL,
  `tampil_siswa` tinyint(1) NOT NULL DEFAULT '1',
  `tampil_pengajar` tinyint(1) NOT NULL DEFAULT '1',
  `pengajar_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `el_pengumuman`
--

INSERT INTO `el_pengumuman` (`id`, `judul`, `konten`, `tgl_tampil`, `tgl_tutup`, `tampil_siswa`, `tampil_pengajar`, `pengajar_id`) VALUES
(1, 'libur', '<p>libur</p>\r\n', '2017-10-02', '2017-11-01', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `el_pilihan`
--

CREATE TABLE `el_pilihan` (
  `id` int(11) NOT NULL,
  `pertanyaan_id` int(11) NOT NULL,
  `konten` text NOT NULL,
  `kunci` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=tidak',
  `urutan` int(11) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `el_siswa`
--

CREATE TABLE `el_siswa` (
  `id` int(11) NOT NULL,
  `nis` varchar(45) DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(9) NOT NULL COMMENT 'Laki-laki dan Perempuan',
  `tempat_lahir` varchar(45) NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `agama` char(7) DEFAULT NULL,
  `alamat` varchar(255) NOT NULL,
  `tahun_masuk` year(4) NOT NULL,
  `foto` text,
  `status_id` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=pending, 1=aktif, 2=blok, 3=alumni, 4=deleted'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `el_siswa`
--

INSERT INTO `el_siswa` (`id`, `nis`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tgl_lahir`, `agama`, `alamat`, `tahun_masuk`, `foto`, `status_id`) VALUES
(1, '112', 'aa', 'Laki-laki', 'kapal', '1995-10-25', 'ISLAM', 'tbhn', 2017, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `el_tugas`
--

CREATE TABLE `el_tugas` (
  `id` int(11) NOT NULL,
  `mapel_id` int(11) NOT NULL,
  `pengajar_id` int(11) NOT NULL,
  `type_id` tinyint(1) NOT NULL COMMENT '1=upload,2=essay,3=ganda',
  `judul` varchar(255) NOT NULL,
  `durasi` int(11) DEFAULT NULL COMMENT 'lama pengerjaan dalam menit',
  `info` text,
  `aktif` tinyint(1) NOT NULL DEFAULT '0',
  `tgl_buat` datetime DEFAULT NULL,
  `tampil_siswa` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=tidak tampil di siswa, 1=tampil siswa'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `el_tugas`
--

INSERT INTO `el_tugas` (`id`, `mapel_id`, `pengajar_id`, `type_id`, `judul`, `durasi`, `info`, `aktif`, `tgl_buat`, `tampil_siswa`) VALUES
(1, 1, 2, 3, 'jj', 60, '<p>buat</p>\r\n', 0, '2017-10-02 14:06:14', 0),
(2, 1, 2, 2, 'hjjhj', 60, '<p>jhfkjhfjhfjhjhj</p>\r\n', 0, '2017-10-02 14:16:51', 0),
(3, 1, 2, 1, 'vhkhfkjg', NULL, '<p>lhfkjkyfkjfjhfkj</p>\r\n', 0, '2017-10-02 14:17:30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `el_tugas_kelas`
--

CREATE TABLE `el_tugas_kelas` (
  `id` int(11) NOT NULL,
  `tugas_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `el_tugas_kelas`
--

INSERT INTO `el_tugas_kelas` (`id`, `tugas_id`, `kelas_id`) VALUES
(1, 1, 2),
(2, 2, 2),
(3, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `el_tugas_pertanyaan`
--

CREATE TABLE `el_tugas_pertanyaan` (
  `id` int(11) NOT NULL,
  `pertanyaan` text NOT NULL,
  `urutan` int(11) NOT NULL,
  `tugas_id` int(11) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `essay`
--

CREATE TABLE `essay` (
  `id` int(11) NOT NULL,
  `jawaban` text NOT NULL,
  `pertanyaan_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `tugas_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ganda`
--

CREATE TABLE `ganda` (
  `id` int(11) NOT NULL,
  `pilihan_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `tugas_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `urutan` int(11) NOT NULL,
  `aktif` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=aktif 0=tidak'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kelas_siswa`
--

CREATE TABLE `kelas_siswa` (
  `id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `aktif` tinyint(4) NOT NULL COMMENT '0 jika bukan, 1 jika ya'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `siswa_id` int(11) DEFAULT NULL,
  `pengajar_id` int(11) DEFAULT NULL,
  `is_admin` int(11) NOT NULL COMMENT '0=tidak,1=ya',
  `reset_kode` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE `mapel` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `info` text,
  `aktif` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 = ya, 0 = tidak'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mapel_ajar`
--

CREATE TABLE `mapel_ajar` (
  `id` int(11) NOT NULL,
  `hari_id` tinyint(4) NOT NULL COMMENT '1=senin,2=selasa,3=rabu,4=kamis,5=jum''at,6=sabtu,7=minggu',
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `pengajar_id` int(11) NOT NULL,
  `mapel_kelas_id` int(11) NOT NULL,
  `aktif` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 = aktif 0 = tidak'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mapel_kelas`
--

CREATE TABLE `mapel_kelas` (
  `id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `mapel_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE `materi` (
  `id` int(11) NOT NULL,
  `mapel_id` int(11) NOT NULL,
  `pengajar_id` int(11) DEFAULT NULL,
  `siswa_id` int(11) DEFAULT NULL,
  `judul` varchar(255) NOT NULL,
  `konten` text,
  `file` text,
  `tgl_posting` datetime NOT NULL,
  `publish` tinyint(4) NOT NULL DEFAULT '0',
  `views` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `materi_kelas`
--

CREATE TABLE `materi_kelas` (
  `id` int(11) NOT NULL,
  `materi_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nilai_tugas`
--

CREATE TABLE `nilai_tugas` (
  `id` int(11) NOT NULL,
  `nilai` float NOT NULL,
  `tugas_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pengajar`
--

CREATE TABLE `pengajar` (
  `id` int(11) NOT NULL,
  `nip` varchar(45) DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(9) NOT NULL,
  `tempat_lahir` varchar(45) NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` varchar(255) NOT NULL,
  `foto` text,
  `status_id` tinyint(4) NOT NULL COMMENT '0=pending, 1=aktif, 2=blok'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pilihan`
--

CREATE TABLE `pilihan` (
  `id` int(11) NOT NULL,
  `pertanyaan_id` int(11) NOT NULL,
  `konten` varchar(255) NOT NULL,
  `kunci` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=tidak\n1=ya',
  `urutan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` int(11) NOT NULL,
  `nis` varchar(45) DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(9) NOT NULL COMMENT 'Laki-laki dan Perempuan',
  `tempat_lahir` varchar(45) NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `agama` char(7) DEFAULT NULL,
  `alamat` varchar(255) NOT NULL,
  `tahun_masuk` year(4) NOT NULL,
  `foto` text,
  `status_id` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=pending, 1=aktif, 2=blok, 3=alumni, 4=deleted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `nis`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tgl_lahir`, `agama`, `alamat`, `tahun_masuk`, `foto`, `status_id`) VALUES
(112, '112', 'awin', 'pria', 'kapal', '1999-04-02', 'hindu', 'kapal', 2017, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `site_config`
--

CREATE TABLE `site_config` (
  `site_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `telp` varchar(45) DEFAULT NULL,
  `date_format` varchar(20) DEFAULT 'F j, Y'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `id` int(11) NOT NULL,
  `mapel_ajar_id` int(11) NOT NULL,
  `type_id` tinyint(4) NOT NULL COMMENT '1=upload,2=essay,3=ganda',
  `judul` varchar(255) NOT NULL,
  `durasi` int(11) DEFAULT NULL COMMENT 'lama pengerjaan dalam menit',
  `info` text,
  `aktif` tinyint(4) NOT NULL DEFAULT '0',
  `tgl_buat` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tugas_pertanyaan`
--

CREATE TABLE `tugas_pertanyaan` (
  `id` int(11) NOT NULL,
  `pertanyaan` text NOT NULL,
  `urutan` int(11) NOT NULL,
  `tugas_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `upload`
--

CREATE TABLE `upload` (
  `id` int(11) NOT NULL,
  `file` text NOT NULL,
  `tgl_upload` datetime NOT NULL,
  `tugas_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `el_field_tambahan`
--
ALTER TABLE `el_field_tambahan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `el_kelas`
--
ALTER TABLE `el_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `el_kelas_siswa`
--
ALTER TABLE `el_kelas_siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `el_komentar`
--
ALTER TABLE `el_komentar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `el_login`
--
ALTER TABLE `el_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `el_login_log`
--
ALTER TABLE `el_login_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `el_mapel`
--
ALTER TABLE `el_mapel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `el_mapel_ajar`
--
ALTER TABLE `el_mapel_ajar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `el_mapel_kelas`
--
ALTER TABLE `el_mapel_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `el_materi`
--
ALTER TABLE `el_materi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `el_materi_kelas`
--
ALTER TABLE `el_materi_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `el_messages`
--
ALTER TABLE `el_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `el_nilai_tugas`
--
ALTER TABLE `el_nilai_tugas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `el_pengajar`
--
ALTER TABLE `el_pengajar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `el_pengaturan`
--
ALTER TABLE `el_pengaturan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `el_pengumuman`
--
ALTER TABLE `el_pengumuman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `el_pilihan`
--
ALTER TABLE `el_pilihan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `el_siswa`
--
ALTER TABLE `el_siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `el_tugas`
--
ALTER TABLE `el_tugas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `el_tugas_kelas`
--
ALTER TABLE `el_tugas_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `el_tugas_pertanyaan`
--
ALTER TABLE `el_tugas_pertanyaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `essay`
--
ALTER TABLE `essay`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_essay_tugas_essay1_idx` (`pertanyaan_id`),
  ADD KEY `fk_essay_siswa1_idx` (`siswa_id`),
  ADD KEY `fk_essay_tugas1_idx` (`tugas_id`);

--
-- Indexes for table `ganda`
--
ALTER TABLE `ganda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ganda_pilihan1_idx` (`pilihan_id`),
  ADD KEY `fk_ganda_siswa1_idx` (`siswa_id`),
  ADD KEY `fk_ganda_tugas1_idx` (`tugas_id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas_siswa`
--
ALTER TABLE `kelas_siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kelas_siswa_kelas_idx` (`kelas_id`),
  ADD KEY `fk_kelas_siswa_siswa1_idx` (`siswa_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_login_siswa1_idx` (`siswa_id`),
  ADD KEY `fk_login_pengajar1_idx` (`pengajar_id`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mapel_ajar`
--
ALTER TABLE `mapel_ajar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_mapel_ajar_pengajar1_idx` (`pengajar_id`),
  ADD KEY `fk_mapel_ajar_mapel_kelas1_idx` (`mapel_kelas_id`);

--
-- Indexes for table `mapel_kelas`
--
ALTER TABLE `mapel_kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_mapel_kelas_kelas1_idx` (`kelas_id`),
  ADD KEY `fk_mapel_kelas_mapel1_idx` (`mapel_id`);

--
-- Indexes for table `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_materi_pengajar1_idx` (`pengajar_id`),
  ADD KEY `fk_materi_siswa1_idx` (`siswa_id`),
  ADD KEY `fk_materi_mapel1_idx` (`mapel_id`);

--
-- Indexes for table `materi_kelas`
--
ALTER TABLE `materi_kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_materi_kelas_materi1_idx` (`materi_id`),
  ADD KEY `fk_materi_kelas_kelas1_idx` (`kelas_id`);

--
-- Indexes for table `nilai_tugas`
--
ALTER TABLE `nilai_tugas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_nilai_tugas1_idx` (`tugas_id`),
  ADD KEY `fk_nilai_siswa1_idx` (`siswa_id`);

--
-- Indexes for table `pengajar`
--
ALTER TABLE `pengajar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pilihan`
--
ALTER TABLE `pilihan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pilihan_tugas_pertanyaan1_idx` (`pertanyaan_id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tugas_mapel_ajar1_idx` (`mapel_ajar_id`);

--
-- Indexes for table `tugas_pertanyaan`
--
ALTER TABLE `tugas_pertanyaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tugas_essay_tugas1_idx` (`tugas_id`);

--
-- Indexes for table `upload`
--
ALTER TABLE `upload`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_upload_tugas1_idx` (`tugas_id`),
  ADD KEY `fk_upload_siswa1_idx` (`siswa_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `el_kelas`
--
ALTER TABLE `el_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `el_kelas_siswa`
--
ALTER TABLE `el_kelas_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `el_komentar`
--
ALTER TABLE `el_komentar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `el_login`
--
ALTER TABLE `el_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `el_login_log`
--
ALTER TABLE `el_login_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `el_mapel`
--
ALTER TABLE `el_mapel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `el_mapel_ajar`
--
ALTER TABLE `el_mapel_ajar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `el_mapel_kelas`
--
ALTER TABLE `el_mapel_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `el_materi`
--
ALTER TABLE `el_materi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `el_materi_kelas`
--
ALTER TABLE `el_materi_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `el_messages`
--
ALTER TABLE `el_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `el_nilai_tugas`
--
ALTER TABLE `el_nilai_tugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `el_pengajar`
--
ALTER TABLE `el_pengajar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `el_pengumuman`
--
ALTER TABLE `el_pengumuman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `el_pilihan`
--
ALTER TABLE `el_pilihan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `el_siswa`
--
ALTER TABLE `el_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `el_tugas`
--
ALTER TABLE `el_tugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `el_tugas_kelas`
--
ALTER TABLE `el_tugas_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `el_tugas_pertanyaan`
--
ALTER TABLE `el_tugas_pertanyaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `essay`
--
ALTER TABLE `essay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ganda`
--
ALTER TABLE `ganda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kelas_siswa`
--
ALTER TABLE `kelas_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mapel_ajar`
--
ALTER TABLE `mapel_ajar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mapel_kelas`
--
ALTER TABLE `mapel_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `materi_kelas`
--
ALTER TABLE `materi_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `nilai_tugas`
--
ALTER TABLE `nilai_tugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pengajar`
--
ALTER TABLE `pengajar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pilihan`
--
ALTER TABLE `pilihan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;
--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tugas_pertanyaan`
--
ALTER TABLE `tugas_pertanyaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `upload`
--
ALTER TABLE `upload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `essay`
--
ALTER TABLE `essay`
  ADD CONSTRAINT `fk_essay_siswa1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_essay_tugas1` FOREIGN KEY (`tugas_id`) REFERENCES `tugas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_essay_tugas_essay1` FOREIGN KEY (`pertanyaan_id`) REFERENCES `tugas_pertanyaan` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `ganda`
--
ALTER TABLE `ganda`
  ADD CONSTRAINT `fk_ganda_pilihan1` FOREIGN KEY (`pilihan_id`) REFERENCES `pilihan` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ganda_siswa1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ganda_tugas1` FOREIGN KEY (`tugas_id`) REFERENCES `tugas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `kelas_siswa`
--
ALTER TABLE `kelas_siswa`
  ADD CONSTRAINT `fk_kelas_siswa_kelas` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_kelas_siswa_siswa1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `fk_login_pengajar1` FOREIGN KEY (`pengajar_id`) REFERENCES `pengajar` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_login_siswa1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `mapel_ajar`
--
ALTER TABLE `mapel_ajar`
  ADD CONSTRAINT `fk_mapel_ajar_mapel_kelas1` FOREIGN KEY (`mapel_kelas_id`) REFERENCES `mapel_kelas` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_mapel_ajar_pengajar1` FOREIGN KEY (`pengajar_id`) REFERENCES `pengajar` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `mapel_kelas`
--
ALTER TABLE `mapel_kelas`
  ADD CONSTRAINT `fk_mapel_kelas_kelas1` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_mapel_kelas_mapel1` FOREIGN KEY (`mapel_id`) REFERENCES `mapel` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `materi`
--
ALTER TABLE `materi`
  ADD CONSTRAINT `fk_materi_mapel1` FOREIGN KEY (`mapel_id`) REFERENCES `mapel` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_materi_pengajar1` FOREIGN KEY (`pengajar_id`) REFERENCES `pengajar` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_materi_siswa1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `materi_kelas`
--
ALTER TABLE `materi_kelas`
  ADD CONSTRAINT `fk_materi_kelas_kelas1` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_materi_kelas_materi1` FOREIGN KEY (`materi_id`) REFERENCES `materi` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `nilai_tugas`
--
ALTER TABLE `nilai_tugas`
  ADD CONSTRAINT `fk_nilai_siswa1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_nilai_tugas1` FOREIGN KEY (`tugas_id`) REFERENCES `tugas` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `pilihan`
--
ALTER TABLE `pilihan`
  ADD CONSTRAINT `fk_pilihan_tugas_pertanyaan1` FOREIGN KEY (`pertanyaan_id`) REFERENCES `tugas_pertanyaan` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `tugas`
--
ALTER TABLE `tugas`
  ADD CONSTRAINT `fk_tugas_mapel_ajar1` FOREIGN KEY (`mapel_ajar_id`) REFERENCES `mapel_ajar` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `tugas_pertanyaan`
--
ALTER TABLE `tugas_pertanyaan`
  ADD CONSTRAINT `fk_tugas_essay_tugas1` FOREIGN KEY (`tugas_id`) REFERENCES `tugas` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `upload`
--
ALTER TABLE `upload`
  ADD CONSTRAINT `fk_upload_siswa1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_upload_tugas1` FOREIGN KEY (`tugas_id`) REFERENCES `tugas` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
