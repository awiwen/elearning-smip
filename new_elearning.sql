<<<<<<< HEAD
/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.1.9-MariaDB : Database - new_elearning
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`new_elearning` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `new_elearning`;

/*Table structure for table `el_field_tambahan` */

DROP TABLE IF EXISTS `el_field_tambahan`;

CREATE TABLE `el_field_tambahan` (
  `id` varchar(255) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `value` longtext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `el_field_tambahan` */

insert  into `el_field_tambahan`(`id`,`nama`,`value`) values 
('history-mengerjakan-1-3','History pengerjaan tugas','{\"mulai\":\"2017-10-02 14:18:50\",\"uri_string\":\"tugas\\/kerjakan\\/3\",\"valid_route\":[\"\\/tugas\\/kerjakan\",\"\\/tugas\\/finish\",\"\\/tugas\\/submit_essay\",\"\\/tugas\\/submit_upload\"],\"tugas\":{\"id\":\"3\",\"mapel_id\":\"1\",\"pengajar_id\":\"2\",\"type_id\":\"1\",\"judul\":\"vhkhfkjg\",\"durasi\":null,\"info\":\"<p>lhfkjkyfkjfjhfkj<\\/p>\\r\\n\",\"aktif\":\"1\",\"tgl_buat\":\"2017-10-02 14:17:30\",\"tampil_siswa\":\"1\"},\"unix_id\":\"42b47b9bef100dce99fa88010bc02f6c809236\",\"ip\":\"::1\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36\",\"file_name\":\"42b47b9bef100dce99fa88010bc02f6c809236.pdf\",\"tgl_submit\":\"2017-10-02 14:19:20\",\"nilai\":\"60\"}');

/*Table structure for table `el_kelas` */

DROP TABLE IF EXISTS `el_kelas`;

CREATE TABLE `el_kelas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(45) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `urutan` int(11) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=aktif 0=tidak',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

/*Data for the table `el_kelas` */

insert  into `el_kelas`(`id`,`nama`,`parent_id`,`urutan`,`aktif`) values 
(1,'KELAS X',NULL,1,1),
(2,'KELAS X TKJ - 1',1,2,1),
(3,'KELAS X TKJ - 2',1,3,1),
(4,'KELAS X MM - 1',1,4,1),
(5,'KELAS X MM - 2',1,5,1),
(6,'KELAS XI',NULL,6,1),
(7,'KELAS XI TKJ - 1',6,7,1),
(8,'KELAS XI TKJ - 2',6,8,1),
(9,'KELAS XI MM - 1',6,9,1),
(10,'KELAS XI MM - 2',6,10,1),
(11,'KELAS XII',NULL,11,1),
(12,'KELAS XII TKJ - 1',11,12,1),
(13,'KELAS XII TKJ - 2',11,13,1),
(14,'KELAS XII MM - 1',11,14,1),
(15,'KELAS XII MM - 2',11,15,1);

/*Table structure for table `el_kelas_siswa` */

DROP TABLE IF EXISTS `el_kelas_siswa`;

CREATE TABLE `el_kelas_siswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kelas_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `aktif` tinyint(1) NOT NULL COMMENT '0 jika bukan, 1 jika ya',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `el_kelas_siswa` */

insert  into `el_kelas_siswa`(`id`,`kelas_id`,`siswa_id`,`aktif`) values 
(1,2,1,1);

/*Table structure for table `el_komentar` */

DROP TABLE IF EXISTS `el_komentar`;

CREATE TABLE `el_komentar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login_id` int(11) NOT NULL,
  `materi_id` int(11) NOT NULL,
  `tampil` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=tidak,1=tampil',
  `konten` text,
  `tgl_posting` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `el_komentar` */

/*Table structure for table `el_login` */

DROP TABLE IF EXISTS `el_login`;

CREATE TABLE `el_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `siswa_id` int(11) DEFAULT NULL,
  `pengajar_id` int(11) DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL COMMENT '0=tidak,1=ya',
  `reset_kode` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `el_login` */

insert  into `el_login`(`id`,`username`,`password`,`siswa_id`,`pengajar_id`,`is_admin`,`reset_kode`) values 
(1,'admin@aaa.com','e10adc3949ba59abbe56e057f20f883e',NULL,1,1,NULL),
(2,'aa@11.com','4124bc0a9335c27f086f24ba207a4912',1,NULL,0,NULL),
(3,'qwerty@11.com','d8578edf8458ce06fbc5bb76a58c5ca4',NULL,2,0,NULL);

/*Table structure for table `el_login_log` */

DROP TABLE IF EXISTS `el_login_log`;

CREATE TABLE `el_login_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login_id` int(11) NOT NULL,
  `lasttime` datetime NOT NULL,
  `agent` text NOT NULL,
  `last_activity` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

/*Data for the table `el_login_log` */

insert  into `el_login_log`(`id`,`login_id`,`lasttime`,`agent`,`last_activity`) values 
(1,1,'2017-09-14 20:54:46','{\"is_mobile\":0,\"browser\":\"Chrome 60.0.3112.113\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.113 Safari\\/537.36\",\"ip\":\"::1\"}',1505402604),
(2,1,'2017-09-14 22:24:31','{\"is_mobile\":0,\"browser\":\"Chrome 60.0.3112.113\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.113 Safari\\/537.36\",\"ip\":\"::1\"}',1505410881),
(3,1,'2017-09-16 08:19:57','{\"is_mobile\":0,\"browser\":\"Chrome 60.0.3112.113\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.113 Safari\\/537.36\",\"ip\":\"::1\"}',1505529256),
(4,1,'2017-09-16 09:34:19','{\"is_mobile\":0,\"browser\":\"Chrome 60.0.3112.113\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.113 Safari\\/537.36\",\"ip\":\"::1\"}',1505540676),
(5,1,'2017-09-23 22:09:52','{\"is_mobile\":0,\"browser\":\"Chrome 60.0.3112.113\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.113 Safari\\/537.36\",\"ip\":\"::1\"}',1506179503),
(6,1,'2017-09-23 22:14:12','{\"is_mobile\":0,\"browser\":\"Chrome 60.0.3112.113\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.113 Safari\\/537.36\",\"ip\":\"::1\"}',1506179586),
(7,1,'2017-09-23 22:15:40','{\"is_mobile\":0,\"browser\":\"Chrome 60.0.3112.113\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.113 Safari\\/537.36\",\"ip\":\"::1\"}',1506179666),
(8,1,'2017-09-23 22:16:40','{\"is_mobile\":0,\"browser\":\"Chrome 60.0.3112.113\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.113 Safari\\/537.36\",\"ip\":\"::1\"}',1506179730),
(9,1,'2017-09-23 22:18:05','{\"is_mobile\":0,\"browser\":\"Chrome 60.0.3112.113\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.113 Safari\\/537.36\",\"ip\":\"::1\"}',1506179803),
(10,2,'2017-09-23 22:19:04','{\"is_mobile\":0,\"browser\":\"Chrome 60.0.3112.113\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.113 Safari\\/537.36\",\"ip\":\"::1\"}',1506179858),
(11,1,'2017-09-23 22:19:40','{\"is_mobile\":0,\"browser\":\"Chrome 60.0.3112.113\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.113 Safari\\/537.36\",\"ip\":\"::1\"}',1506179908),
(12,2,'2017-09-23 22:20:42','{\"is_mobile\":0,\"browser\":\"Chrome 60.0.3112.113\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.113 Safari\\/537.36\",\"ip\":\"::1\"}',1506179988),
(13,1,'2017-09-23 22:21:50','{\"is_mobile\":0,\"browser\":\"Chrome 60.0.3112.113\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.113 Safari\\/537.36\",\"ip\":\"::1\"}',1506184975),
(14,1,'2017-09-23 23:43:02','{\"is_mobile\":0,\"browser\":\"Chrome 60.0.3112.113\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.113 Safari\\/537.36\",\"ip\":\"::1\"}',1506185919),
(15,1,'2017-10-02 12:39:59','{\"is_mobile\":0,\"browser\":\"Chrome 61.0.3163.100\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36\",\"ip\":\"::1\"}',1506924047),
(16,1,'2017-10-02 13:02:57','{\"is_mobile\":0,\"browser\":\"Chrome 61.0.3163.100\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36\",\"ip\":\"::1\"}',1506925898),
(17,3,'2017-10-02 13:33:50','{\"is_mobile\":0,\"browser\":\"Chrome 61.0.3163.100\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36\",\"ip\":\"::1\"}',1506926040),
(18,1,'2017-10-02 13:36:06','{\"is_mobile\":0,\"browser\":\"Chrome 61.0.3163.100\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36\",\"ip\":\"::1\"}',1506926108),
(19,2,'2017-10-02 13:37:17','{\"is_mobile\":0,\"browser\":\"Chrome 61.0.3163.100\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36\",\"ip\":\"::1\"}',1506926162),
(20,1,'2017-10-02 13:38:10','{\"is_mobile\":0,\"browser\":\"Chrome 61.0.3163.100\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36\",\"ip\":\"::1\"}',1506927757),
(21,2,'2017-10-02 14:04:53','{\"is_mobile\":0,\"browser\":\"Chrome 61.0.3163.100\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36\",\"ip\":\"::1\"}',1506927802),
(22,3,'2017-10-02 14:05:27','{\"is_mobile\":0,\"browser\":\"Chrome 61.0.3163.100\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36\",\"ip\":\"::1\"}',1506927878),
(23,2,'2017-10-02 14:06:44','{\"is_mobile\":0,\"browser\":\"Chrome 61.0.3163.100\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36\",\"ip\":\"::1\"}',1506927898),
(24,1,'2017-10-02 14:07:04','{\"is_mobile\":0,\"browser\":\"Chrome 61.0.3163.100\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36\",\"ip\":\"::1\"}',1506928448),
(25,3,'2017-10-02 14:16:18','{\"is_mobile\":0,\"browser\":\"Chrome 61.0.3163.100\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36\",\"ip\":\"::1\"}',1506928591),
(26,2,'2017-10-02 14:18:38','{\"is_mobile\":0,\"browser\":\"Chrome 61.0.3163.100\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36\",\"ip\":\"::1\"}',1506928649),
(27,3,'2017-10-02 14:19:34','{\"is_mobile\":0,\"browser\":\"Chrome 61.0.3163.100\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36\",\"ip\":\"::1\"}',1506928736),
(28,2,'2017-10-02 14:21:05','{\"is_mobile\":0,\"browser\":\"Chrome 61.0.3163.100\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36\",\"ip\":\"::1\"}',1506928769),
(29,1,'2017-10-02 14:21:34','{\"is_mobile\":0,\"browser\":\"Chrome 61.0.3163.100\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36\",\"ip\":\"::1\"}',1506930665),
(30,1,'2017-10-06 00:05:25','{\"is_mobile\":0,\"browser\":\"Chrome 61.0.3163.100\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36\",\"ip\":\"::1\"}',1507228291),
(31,1,'2017-10-06 02:04:07','{\"is_mobile\":0,\"browser\":\"Chrome 61.0.3163.100\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36\",\"ip\":\"::1\"}',1507232479),
(32,1,'2017-10-06 22:46:36','{\"is_mobile\":0,\"browser\":\"Chrome 61.0.3163.100\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36\",\"ip\":\"::1\"}',1507314987),
(33,1,'2017-10-08 00:55:34','{\"is_mobile\":0,\"browser\":\"Chrome 61.0.3163.100\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36\",\"ip\":\"::1\"}',1507401458),
(34,1,'2017-10-09 11:26:40','{\"is_mobile\":0,\"browser\":\"Chrome 61.0.3163.100\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36\",\"ip\":\"::1\"}',1507535100),
(35,1,'2017-10-10 09:02:23','{\"is_mobile\":0,\"browser\":\"Chrome 61.0.3163.100\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36\",\"ip\":\"::1\"}',1507650795);

/*Table structure for table `el_mapel` */

DROP TABLE IF EXISTS `el_mapel`;

CREATE TABLE `el_mapel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `info` text,
  `aktif` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = ya, 0 = tidak',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

/*Data for the table `el_mapel` */

insert  into `el_mapel`(`id`,`nama`,`info`,`aktif`) values 
(1,'Bahasa Indonesia',NULL,1),
(2,'Bahasa Inggris',NULL,1),
(3,'Matematika',NULL,1),
(4,'KWU',NULL,1),
(5,'Seni Budaya',NULL,1),
(6,'Budi Pekerti',NULL,1),
(7,'Penjaskes',NULL,1),
(8,'Agama',NULL,1),
(9,'Fisika',NULL,1),
(10,'Kimia',NULL,1),
(11,'PKN',NULL,1),
(12,'IPS',NULL,1),
(13,'IPA',NULL,1),
(14,'Bahasa Daerah',NULL,1),
(15,'KKPI',NULL,1),
(16,'Kejuruan TKJ I',NULL,1),
(17,'Kejuruan TKJ II',NULL,1),
(18,'Kejuruan TKJ III',NULL,1),
(19,'Kejuruan MM I',NULL,1),
(20,'Kejuruan MM II',NULL,1),
(21,'Kejuruan MM III',NULL,1);

/*Table structure for table `el_mapel_ajar` */

DROP TABLE IF EXISTS `el_mapel_ajar`;

CREATE TABLE `el_mapel_ajar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hari_id` tinyint(1) NOT NULL COMMENT '1=senin,2=selasa,3=rabu,4=kamis,5=jum''at,6=sabtu,7=minggu',
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `pengajar_id` int(11) NOT NULL,
  `mapel_kelas_id` int(11) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = aktif 0 = tidak',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `el_mapel_ajar` */

insert  into `el_mapel_ajar`(`id`,`hari_id`,`jam_mulai`,`jam_selesai`,`pengajar_id`,`mapel_kelas_id`,`aktif`) values 
(1,1,'00:00:08','00:00:11',2,1,1);

/*Table structure for table `el_mapel_kelas` */

DROP TABLE IF EXISTS `el_mapel_kelas`;

CREATE TABLE `el_mapel_kelas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kelas_id` int(11) NOT NULL,
  `mapel_id` int(11) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `el_mapel_kelas` */

insert  into `el_mapel_kelas`(`id`,`kelas_id`,`mapel_id`,`aktif`) values 
(1,2,1,1),
(2,2,2,1),
(3,2,3,1),
(4,2,4,1);

/*Table structure for table `el_materi` */

DROP TABLE IF EXISTS `el_materi`;

CREATE TABLE `el_materi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mapel_id` int(11) NOT NULL,
  `pengajar_id` int(11) DEFAULT NULL,
  `siswa_id` int(11) DEFAULT NULL,
  `judul` varchar(255) NOT NULL,
  `konten` text,
  `file` text,
  `tgl_posting` datetime NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '0',
  `views` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `el_materi` */

insert  into `el_materi`(`id`,`mapel_id`,`pengajar_id`,`siswa_id`,`judul`,`konten`,`file`,`tgl_posting`,`publish`,`views`) values 
(1,1,1,NULL,'materi 1','<p>test</p>\r\n',NULL,'2017-09-23 22:20:18',1,3);

/*Table structure for table `el_materi_kelas` */

DROP TABLE IF EXISTS `el_materi_kelas`;

CREATE TABLE `el_materi_kelas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `materi_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `el_materi_kelas` */

insert  into `el_materi_kelas`(`id`,`materi_id`,`kelas_id`) values 
(1,1,1);

/*Table structure for table `el_messages` */

DROP TABLE IF EXISTS `el_messages`;

CREATE TABLE `el_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` tinyint(1) NOT NULL COMMENT '1=inbox,2=outbox',
  `content` text NOT NULL,
  `owner_id` int(11) NOT NULL,
  `sender_receiver_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `opened` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=belum,1=sudah',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `el_messages` */

insert  into `el_messages`(`id`,`type_id`,`content`,`owner_id`,`sender_receiver_id`,`date`,`opened`) values 
(1,2,'<p>test</p>\r\n',2,1,'2017-09-23 22:21:43',1),
(2,1,'<p>test</p>\r\n',1,2,'2017-09-23 22:21:43',1);

/*Table structure for table `el_nilai_tugas` */

DROP TABLE IF EXISTS `el_nilai_tugas`;

CREATE TABLE `el_nilai_tugas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nilai` float NOT NULL,
  `tugas_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `el_nilai_tugas` */

insert  into `el_nilai_tugas`(`id`,`nilai`,`tugas_id`,`siswa_id`) values 
(1,60,3,1);

/*Table structure for table `el_pengajar` */

DROP TABLE IF EXISTS `el_pengajar`;

CREATE TABLE `el_pengajar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nip` varchar(45) DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(9) NOT NULL,
  `tempat_lahir` varchar(45) NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` varchar(255) NOT NULL,
  `foto` text,
  `status_id` tinyint(1) NOT NULL COMMENT '0=pending, 1=aktif, 2=blok',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `el_pengajar` */

insert  into `el_pengajar`(`id`,`nip`,`nama`,`jenis_kelamin`,`tempat_lahir`,`tgl_lahir`,`alamat`,`foto`,`status_id`) values 
(1,'4555','admin','Laki-laki','',NULL,'',NULL,1),
(2,'','qwerty','Laki-laki','',NULL,'',NULL,1);

/*Table structure for table `el_pengaturan` */

DROP TABLE IF EXISTS `el_pengaturan`;

CREATE TABLE `el_pengaturan` (
  `id` varchar(255) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `value` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `el_pengaturan` */

insert  into `el_pengaturan`(`id`,`nama`,`value`) values 
('email-server','Email server','no-reply@domain.com'),
('email-template-approve-pengajar','Approve pengajar (email pengajar)','{\"subject\":\"Pengaktifan Akun\",\"body\":\"<p>Hai {$nama},<\\/p>\\n<p>Anda telah diterima sebagai pengajar pada {$nama_sekolah}, berikut informasi data diri anda:<\\/p>\\n<p>{$tabel_profil}<\\/p>\\n<p>Anda dapat login ke sistem E-Learning menggunakan username dan password yang telah anda buat saat pendaftaran, login pada url berikut : {$url_login}<\\/p>\"}'),
('email-template-approve-siswa','Approve siswa (email siswa)','{\"subject\":\"Pengaktifan Akun\",\"body\":\"<p>Hai {$nama},<\\/p>\\n<p>Anda telah diterima sebagai siswa pada {$nama_sekolah}, berikut informasi data diri anda:<\\/p>\\n<p>{$tabel_profil}<\\/p>\\n<p>Anda dapat login ke sistem E-Learning menggunakan username dan password yang telah anda buat saat pendaftaran, login pada url berikut : {$url_login}<\\/p>\"}'),
('email-template-link-reset','Link Reset Password','{\"subject\":\"Reset Password\",\"body\":\"<p>Hai,<\\/p>\\n<p>Anda mengirimkan permintaan untuk reset password anda, klik link berikut untuk memulai reset password : {$link_reset}<\\/p>\"}'),
('email-template-register-pengajar','Register pengajar (email pengajar)','{\"subject\":\"Registrasi Berhasil\",\"body\":\"<p>Hai {$nama},<\\/p>\\n<p>Terimakasih telah melakukan pendaftaran sebagai pengajar di E-Learning {$nama_sekolah}. Akun anda akan segera diaktifkan oleh admin.<\\/p>\"}'),
('email-template-register-siswa','Register siswa (email siswa)','{\"subject\":\"Registrasi Berhasil\",\"body\":\"<p>Hai {$nama},<\\/p>\\n<p>Terimakasih telah melakukan pendaftaran sebagai siswa di E-Learning {$nama_sekolah}. Akun anda akan segera diaktifkan oleh admin.<\\/p>\"}'),
('info-registrasi','Info Registrasi','<p>Silakan mendaftar sebagai siswa atau pengajar (jika anda sebagai pengajar) dengan memilih sesuai tab berikut :</p>'),
('peraturan-elearning','Peraturan E-learning',''),
('registrasi-pengajar','Registrasi Pengajar','1'),
('registrasi-siswa','Registrasi Siswa','1'),
('versi','Versi','1.9'),
('jenjang','jenjang','SMA'),
('nama-sekolah','nama-sekolah','smk 2'),
('alamat','alamat','gadung'),
('telp','telp','5582665'),
('install-success','install-success','1');

/*Table structure for table `el_pengumuman` */

DROP TABLE IF EXISTS `el_pengumuman`;

CREATE TABLE `el_pengumuman` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `konten` text NOT NULL,
  `tgl_tampil` date NOT NULL,
  `tgl_tutup` date NOT NULL,
  `tampil_siswa` tinyint(1) NOT NULL DEFAULT '1',
  `tampil_pengajar` tinyint(1) NOT NULL DEFAULT '1',
  `pengajar_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `el_pengumuman` */

insert  into `el_pengumuman`(`id`,`judul`,`konten`,`tgl_tampil`,`tgl_tutup`,`tampil_siswa`,`tampil_pengajar`,`pengajar_id`) values 
(1,'libur','<p>libur</p>\r\n','2017-10-02','2017-11-01',1,1,1);

/*Table structure for table `el_pilihan` */

DROP TABLE IF EXISTS `el_pilihan`;

CREATE TABLE `el_pilihan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pertanyaan_id` int(11) NOT NULL,
  `konten` text NOT NULL,
  `kunci` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=tidak',
  `urutan` int(11) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `el_pilihan` */

/*Table structure for table `el_siswa` */

DROP TABLE IF EXISTS `el_siswa`;

CREATE TABLE `el_siswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nis` varchar(45) DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(9) NOT NULL COMMENT 'Laki-laki dan Perempuan',
  `tempat_lahir` varchar(45) NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `agama` char(7) DEFAULT NULL,
  `alamat` varchar(255) NOT NULL,
  `tahun_masuk` year(4) NOT NULL,
  `foto` text,
  `status_id` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=pending, 1=aktif, 2=blok, 3=alumni, 4=deleted',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `el_siswa` */

insert  into `el_siswa`(`id`,`nis`,`nama`,`jenis_kelamin`,`tempat_lahir`,`tgl_lahir`,`agama`,`alamat`,`tahun_masuk`,`foto`,`status_id`) values 
(1,'112','aa','Laki-laki','kapal','1995-10-25','ISLAM','tbhn',2017,NULL,1);

/*Table structure for table `el_tugas` */

DROP TABLE IF EXISTS `el_tugas`;

CREATE TABLE `el_tugas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mapel_id` int(11) NOT NULL,
  `pengajar_id` int(11) NOT NULL,
  `type_id` tinyint(1) NOT NULL COMMENT '1=upload,2=essay,3=ganda',
  `judul` varchar(255) NOT NULL,
  `durasi` int(11) DEFAULT NULL COMMENT 'lama pengerjaan dalam menit',
  `info` text,
  `aktif` tinyint(1) NOT NULL DEFAULT '0',
  `tgl_buat` datetime DEFAULT NULL,
  `tampil_siswa` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=tidak tampil di siswa, 1=tampil siswa',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `el_tugas` */

insert  into `el_tugas`(`id`,`mapel_id`,`pengajar_id`,`type_id`,`judul`,`durasi`,`info`,`aktif`,`tgl_buat`,`tampil_siswa`) values 
(1,1,2,3,'jj',60,'<p>buat</p>\r\n',0,'2017-10-02 14:06:14',0),
(2,1,2,2,'hjjhj',60,'<p>jhfkjhfjhfjhjhj</p>\r\n',0,'2017-10-02 14:16:51',0),
(3,1,2,1,'vhkhfkjg',NULL,'<p>lhfkjkyfkjfjhfkj</p>\r\n',0,'2017-10-02 14:17:30',1);

/*Table structure for table `el_tugas_kelas` */

DROP TABLE IF EXISTS `el_tugas_kelas`;

CREATE TABLE `el_tugas_kelas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tugas_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `el_tugas_kelas` */

insert  into `el_tugas_kelas`(`id`,`tugas_id`,`kelas_id`) values 
(1,1,2),
(2,2,2),
(3,3,2);

/*Table structure for table `el_tugas_pertanyaan` */

DROP TABLE IF EXISTS `el_tugas_pertanyaan`;

CREATE TABLE `el_tugas_pertanyaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pertanyaan` text NOT NULL,
  `urutan` int(11) NOT NULL,
  `tugas_id` int(11) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `el_tugas_pertanyaan` */

/*Table structure for table `essay` */

DROP TABLE IF EXISTS `essay`;

CREATE TABLE `essay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jawaban` text NOT NULL,
  `pertanyaan_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `tugas_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_essay_tugas_essay1_idx` (`pertanyaan_id`),
  KEY `fk_essay_siswa1_idx` (`siswa_id`),
  KEY `fk_essay_tugas1_idx` (`tugas_id`),
  CONSTRAINT `fk_essay_siswa1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_essay_tugas1` FOREIGN KEY (`tugas_id`) REFERENCES `tugas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_essay_tugas_essay1` FOREIGN KEY (`pertanyaan_id`) REFERENCES `tugas_pertanyaan` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `essay` */

/*Table structure for table `ganda` */

DROP TABLE IF EXISTS `ganda`;

CREATE TABLE `ganda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pilihan_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `tugas_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ganda_pilihan1_idx` (`pilihan_id`),
  KEY `fk_ganda_siswa1_idx` (`siswa_id`),
  KEY `fk_ganda_tugas1_idx` (`tugas_id`),
  CONSTRAINT `fk_ganda_pilihan1` FOREIGN KEY (`pilihan_id`) REFERENCES `pilihan` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_ganda_siswa1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_ganda_tugas1` FOREIGN KEY (`tugas_id`) REFERENCES `tugas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ganda` */

/*Table structure for table `kelas` */

DROP TABLE IF EXISTS `kelas`;

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(45) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `urutan` int(11) NOT NULL,
  `aktif` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=aktif 0=tidak',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `kelas` */

insert  into `kelas`(`id`,`nama_kelas`,`parent_id`,`urutan`,`aktif`) values 
(1,'X TKJ',0,0,1),
(3,'X MM',NULL,0,1),
(5,'XI TKJ',NULL,0,1),
(7,'XI MM',NULL,0,1),
(9,'XII TKJ',NULL,0,1),
(11,'XII MM',NULL,0,1);

/*Table structure for table `kelas_siswa` */

DROP TABLE IF EXISTS `kelas_siswa`;

CREATE TABLE `kelas_siswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kelas_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `aktif` tinyint(4) NOT NULL COMMENT '0 jika bukan, 1 jika ya',
  PRIMARY KEY (`id`),
  KEY `fk_kelas_siswa_kelas_idx` (`kelas_id`),
  KEY `fk_kelas_siswa_siswa1_idx` (`siswa_id`),
  CONSTRAINT `fk_kelas_siswa_kelas` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_kelas_siswa_siswa1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `kelas_siswa` */

/*Table structure for table `login` */

DROP TABLE IF EXISTS `login`;

CREATE TABLE `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `siswa_id` int(11) DEFAULT NULL,
  `pengajar_id` int(11) DEFAULT NULL,
  `is_admin` int(11) NOT NULL COMMENT '0=tidak,1=ya',
  `reset_kode` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_login_siswa1_idx` (`siswa_id`),
  KEY `fk_login_pengajar1_idx` (`pengajar_id`),
  CONSTRAINT `fk_login_pengajar1` FOREIGN KEY (`pengajar_id`) REFERENCES `pengajar` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_login_siswa1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `login` */

/*Table structure for table `mapel` */

DROP TABLE IF EXISTS `mapel`;

CREATE TABLE `mapel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_mapel` varchar(255) NOT NULL,
  `info` text,
  `aktif` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 = ya, 0 = tidak',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

/*Data for the table `mapel` */

insert  into `mapel`(`id`,`nama_mapel`,`info`,`aktif`) values 
(1,'Agama',NULL,1),
(2,'Budi Pekerti',NULL,1),
(3,'PKN',NULL,1),
(4,'Bahasa Indonesia',NULL,1),
(5,'Matematika',NULL,1),
(6,'IPS',NULL,1),
(7,'Seni Budaya',NULL,1),
(8,'Bahasa Inggris',NULL,1),
(9,'Penjaskes',NULL,1),
(10,'IPA',NULL,1),
(11,'Fisika',NULL,1),
(12,'Bahasa Daerah',NULL,1),
(13,'KWU',NULL,1),
(14,'KKPI',NULL,1),
(15,'Kimia',NULL,1),
(16,'Kejuruan TKJ I',NULL,1),
(17,'Kejuruan TKJ II',NULL,1),
(18,'Kejuruan TKJ III',NULL,1),
(19,'Kejuruan MM I',NULL,1),
(20,'Kejuruan MM II',NULL,1),
(21,'Kejuruan MM III',NULL,1),
(22,'P.Wali',NULL,1),
(26,'Upacara',NULL,1);

/*Table structure for table `mapel_ajar` */

DROP TABLE IF EXISTS `mapel_ajar`;

CREATE TABLE `mapel_ajar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hari_id` tinyint(4) NOT NULL COMMENT '1=senin,2=selasa,3=rabu,4=kamis,5=jum''at,6=sabtu,7=minggu',
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `pengajar_id` int(11) NOT NULL,
  `mapel_kelas_id` int(11) NOT NULL,
  `aktif` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 = aktif 0 = tidak',
  PRIMARY KEY (`id`),
  KEY `fk_mapel_ajar_pengajar1_idx` (`pengajar_id`),
  KEY `fk_mapel_ajar_mapel_kelas1_idx` (`mapel_kelas_id`),
  CONSTRAINT `fk_mapel_ajar_mapel_kelas1` FOREIGN KEY (`mapel_kelas_id`) REFERENCES `mapel_kelas` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_mapel_ajar_pengajar1` FOREIGN KEY (`pengajar_id`) REFERENCES `pengajar` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mapel_ajar` */

/*Table structure for table `mapel_kelas` */

DROP TABLE IF EXISTS `mapel_kelas`;

CREATE TABLE `mapel_kelas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kelas_id` int(11) NOT NULL,
  `mapel_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_mapel_kelas_kelas1_idx` (`kelas_id`),
  KEY `fk_mapel_kelas_mapel1_idx` (`mapel_id`),
  CONSTRAINT `fk_mapel_kelas_kelas1` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_mapel_kelas_mapel1` FOREIGN KEY (`mapel_id`) REFERENCES `mapel` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=latin1;

/*Data for the table `mapel_kelas` */

insert  into `mapel_kelas`(`id`,`kelas_id`,`mapel_id`) values 
(5,1,7),
(6,1,11),
(7,1,14),
(8,1,8),
(9,1,16),
(10,1,4),
(11,1,12),
(12,1,3),
(13,1,5),
(14,1,10),
(15,1,6),
(16,1,15),
(17,1,1),
(18,1,2),
(19,1,13),
(20,1,22),
(21,3,7),
(22,3,11),
(23,3,14),
(24,3,8),
(25,3,19),
(26,3,4),
(27,3,12),
(28,3,3),
(29,3,5),
(30,3,10),
(31,3,6),
(32,3,15),
(33,3,1),
(34,3,2),
(35,3,13),
(36,3,22),
(37,5,3),
(38,5,8),
(39,5,12),
(40,5,4),
(41,5,13),
(42,5,11),
(43,5,7),
(44,5,2),
(45,5,6),
(46,5,17),
(47,5,15),
(48,5,8),
(49,5,22),
(50,5,14),
(51,5,5),
(52,5,1),
(53,5,10),
(56,7,3),
(57,7,8),
(58,7,12),
(59,7,4),
(60,7,13),
(61,7,11),
(62,7,2),
(63,7,6),
(65,7,20),
(66,7,15),
(67,7,8),
(68,7,22),
(69,7,14),
(70,7,5),
(71,7,1),
(72,7,10),
(77,9,15),
(78,9,8),
(80,9,11),
(81,9,18),
(82,9,5),
(83,9,3),
(84,9,7),
(85,9,2),
(86,9,12),
(87,9,13),
(88,9,10),
(89,9,4),
(90,9,6),
(91,9,14),
(92,9,1),
(93,9,22),
(94,11,15),
(95,11,8),
(96,11,21),
(97,11,5),
(98,11,3),
(99,11,7),
(100,11,2),
(101,11,12),
(102,11,13),
(103,11,10),
(104,11,4),
(105,11,6),
(106,11,14),
(107,11,1),
(108,11,22);

/*Table structure for table `materi` */

DROP TABLE IF EXISTS `materi`;

CREATE TABLE `materi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mapel_id` int(11) NOT NULL,
  `pengajar_id` int(11) DEFAULT NULL,
  `siswa_id` int(11) DEFAULT NULL,
  `judul` varchar(255) NOT NULL,
  `konten` text,
  `file` text,
  `tgl_posting` datetime NOT NULL,
  `publish` tinyint(4) NOT NULL DEFAULT '0',
  `views` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_materi_pengajar1_idx` (`pengajar_id`),
  KEY `fk_materi_siswa1_idx` (`siswa_id`),
  KEY `fk_materi_mapel1_idx` (`mapel_id`),
  CONSTRAINT `fk_materi_mapel1` FOREIGN KEY (`mapel_id`) REFERENCES `mapel` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_materi_pengajar1` FOREIGN KEY (`pengajar_id`) REFERENCES `pengajar` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_materi_siswa1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `materi` */

/*Table structure for table `materi_kelas` */

DROP TABLE IF EXISTS `materi_kelas`;

CREATE TABLE `materi_kelas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `materi_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_materi_kelas_materi1_idx` (`materi_id`),
  KEY `fk_materi_kelas_kelas1_idx` (`kelas_id`),
  CONSTRAINT `fk_materi_kelas_kelas1` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_materi_kelas_materi1` FOREIGN KEY (`materi_id`) REFERENCES `materi` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `materi_kelas` */

/*Table structure for table `nilai_tugas` */

DROP TABLE IF EXISTS `nilai_tugas`;

CREATE TABLE `nilai_tugas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nilai` float NOT NULL,
  `tugas_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_nilai_tugas1_idx` (`tugas_id`),
  KEY `fk_nilai_siswa1_idx` (`siswa_id`),
  CONSTRAINT `fk_nilai_siswa1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_nilai_tugas1` FOREIGN KEY (`tugas_id`) REFERENCES `tugas` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `nilai_tugas` */

/*Table structure for table `pengajar` */

DROP TABLE IF EXISTS `pengajar`;

CREATE TABLE `pengajar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nip` varchar(45) DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(9) NOT NULL,
  `tempat_lahir` varchar(45) NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` varchar(255) NOT NULL,
  `foto` text,
  `status_id` tinyint(4) NOT NULL COMMENT '0=pending, 1=aktif, 2=blok',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `pengajar` */

insert  into `pengajar`(`id`,`nip`,`nama`,`jenis_kelamin`,`tempat_lahir`,`tgl_lahir`,`alamat`,`foto`,`status_id`) values 
(1,'-','I Made Sudana','Laki-laki','-','0000-00-00','-',NULL,0),
(2,'-','I Made Agus Yogi Artha, S.Pd. H','Laki-laki','-','0000-00-00','-',NULL,0),
(3,NULL,'I Wayan Asta Apriadi, S.H, M.H','Laki-laki','',NULL,'',NULL,0),
(4,NULL,'Nyoman Bagus Sanjaya, S.Pd','Laki-laki','',NULL,'',NULL,0),
(5,NULL,'Ni Wayan Novi Rosita, S.Pd','Perempuan','',NULL,'',NULL,0),
(6,NULL,'I Nyoman Gede Aeiawan, SPd','Laki-laki','',NULL,'',NULL,0),
(7,NULL,'Ni Nyoman Sekar Sari','Perempuan','',NULL,'',NULL,0),
(8,NULL,'Yan Tanendra Bamagara, S.Pd','Laki-laki','',NULL,'',NULL,0),
(9,NULL,'I GST NGR AG BGS Arya Yudantha, S.pd','Laki-laki','',NULL,'',NULL,0),
(10,NULL,'Ni Nyoman Ayu Tirtawati, S,Pd','Perempuan','',NULL,'',NULL,0),
(11,NULL,'GST AG Ayu Putu Dwiyanti, S.pd','Perempuan','',NULL,'',NULL,0),
(12,NULL,'Rai Sintha Dewi, S.pd','Perempuan','',NULL,'',NULL,0),
(13,NULL,'Ni Kadek Dwijayanthi, S.E','Perempuan','',NULL,'',NULL,0),
(14,NULL,'Putu Dewi Indrayani, Amd','Perempuan','',NULL,'',NULL,0),
(15,NULL,'Ni Putu Eka Widyastari, S.Pd','Perempuan','',NULL,'',NULL,0),
(16,NULL,'Ni Ketut Kurniawati, S.Kom','Perempuan','',NULL,'',NULL,0),
(17,NULL,'Ni Luh Putu Asih Oktapiyanti, S.T','Perempuan','',NULL,'',NULL,0),
(18,NULL,'SEMUA','','',NULL,'',NULL,0);

/*Table structure for table `pilihan` */

DROP TABLE IF EXISTS `pilihan`;

CREATE TABLE `pilihan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pertanyaan_id` int(11) NOT NULL,
  `konten` varchar(255) NOT NULL,
  `kunci` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=tidak\n1=ya',
  `urutan` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pilihan_tugas_pertanyaan1_idx` (`pertanyaan_id`),
  CONSTRAINT `fk_pilihan_tugas_pertanyaan1` FOREIGN KEY (`pertanyaan_id`) REFERENCES `tugas_pertanyaan` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pilihan` */

/*Table structure for table `siswa` */

DROP TABLE IF EXISTS `siswa`;

CREATE TABLE `siswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nis` varchar(45) DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(9) NOT NULL COMMENT 'Laki-laki dan Perempuan',
  `tempat_lahir` varchar(45) NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `agama` char(7) DEFAULT NULL,
  `alamat` varchar(255) NOT NULL,
  `tahun_masuk` year(4) NOT NULL,
  `foto` text,
  `status_id` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=pending, 1=aktif, 2=blok, 3=alumni, 4=deleted',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=latin1;

/*Data for the table `siswa` */

insert  into `siswa`(`id`,`nis`,`nama`,`jenis_kelamin`,`tempat_lahir`,`tgl_lahir`,`agama`,`alamat`,`tahun_masuk`,`foto`,`status_id`) values 
(1,'112','awin','laki-laki','kapal','1999-04-02','hindu','kapal',2017,NULL,1),
(113,'113','surya','laki-laki','mengwi','2017-10-03','hindu','mengwi',2017,NULL,0);

/*Table structure for table `site_config` */

DROP TABLE IF EXISTS `site_config`;

CREATE TABLE `site_config` (
  `site_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `telp` varchar(45) DEFAULT NULL,
  `date_format` varchar(20) DEFAULT 'F j, Y'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `site_config` */

/*Table structure for table `tugas` */

DROP TABLE IF EXISTS `tugas`;

CREATE TABLE `tugas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mapel_ajar_id` int(11) NOT NULL,
  `type_id` tinyint(4) NOT NULL COMMENT '1=upload,2=essay,3=ganda',
  `judul` varchar(255) NOT NULL,
  `durasi` int(11) DEFAULT NULL COMMENT 'lama pengerjaan dalam menit',
  `info` text,
  `aktif` tinyint(4) NOT NULL DEFAULT '0',
  `tgl_buat` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tugas_mapel_ajar1_idx` (`mapel_ajar_id`),
  CONSTRAINT `fk_tugas_mapel_ajar1` FOREIGN KEY (`mapel_ajar_id`) REFERENCES `mapel_ajar` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tugas` */

/*Table structure for table `tugas_pertanyaan` */

DROP TABLE IF EXISTS `tugas_pertanyaan`;

CREATE TABLE `tugas_pertanyaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pertanyaan` text NOT NULL,
  `urutan` int(11) NOT NULL,
  `tugas_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tugas_essay_tugas1_idx` (`tugas_id`),
  CONSTRAINT `fk_tugas_essay_tugas1` FOREIGN KEY (`tugas_id`) REFERENCES `tugas` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tugas_pertanyaan` */

/*Table structure for table `upload` */

DROP TABLE IF EXISTS `upload`;

CREATE TABLE `upload` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file` text NOT NULL,
  `tgl_upload` datetime NOT NULL,
  `tugas_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_upload_tugas1_idx` (`tugas_id`),
  KEY `fk_upload_siswa1_idx` (`siswa_id`),
  CONSTRAINT `fk_upload_siswa1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_upload_tugas1` FOREIGN KEY (`tugas_id`) REFERENCES `tugas` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `upload` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
=======
/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.1.9-MariaDB : Database - new_elearning
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`new_elearning` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `new_elearning`;

/*Table structure for table `el_field_tambahan` */

DROP TABLE IF EXISTS `el_field_tambahan`;

CREATE TABLE `el_field_tambahan` (
  `id` varchar(255) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `value` longtext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `el_field_tambahan` */

insert  into `el_field_tambahan`(`id`,`nama`,`value`) values 
('history-mengerjakan-1-3','History pengerjaan tugas','{\"mulai\":\"2017-10-02 14:18:50\",\"uri_string\":\"tugas\\/kerjakan\\/3\",\"valid_route\":[\"\\/tugas\\/kerjakan\",\"\\/tugas\\/finish\",\"\\/tugas\\/submit_essay\",\"\\/tugas\\/submit_upload\"],\"tugas\":{\"id\":\"3\",\"mapel_id\":\"1\",\"pengajar_id\":\"2\",\"type_id\":\"1\",\"judul\":\"vhkhfkjg\",\"durasi\":null,\"info\":\"<p>lhfkjkyfkjfjhfkj<\\/p>\\r\\n\",\"aktif\":\"1\",\"tgl_buat\":\"2017-10-02 14:17:30\",\"tampil_siswa\":\"1\"},\"unix_id\":\"42b47b9bef100dce99fa88010bc02f6c809236\",\"ip\":\"::1\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36\",\"file_name\":\"42b47b9bef100dce99fa88010bc02f6c809236.pdf\",\"tgl_submit\":\"2017-10-02 14:19:20\",\"nilai\":\"60\"}');

/*Table structure for table `el_kelas` */

DROP TABLE IF EXISTS `el_kelas`;

CREATE TABLE `el_kelas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(45) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `urutan` int(11) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=aktif 0=tidak',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

/*Data for the table `el_kelas` */

insert  into `el_kelas`(`id`,`nama`,`parent_id`,`urutan`,`aktif`) values 
(1,'KELAS X',NULL,1,1),
(2,'KELAS X TKJ - 1',1,2,1),
(3,'KELAS X TKJ - 2',1,3,1),
(4,'KELAS X MM - 1',1,4,1),
(5,'KELAS X MM - 2',1,5,1),
(6,'KELAS XI',NULL,6,1),
(7,'KELAS XI TKJ - 1',6,7,1),
(8,'KELAS XI TKJ - 2',6,8,1),
(9,'KELAS XI MM - 1',6,9,1),
(10,'KELAS XI MM - 2',6,10,1),
(11,'KELAS XII',NULL,11,1),
(12,'KELAS XII TKJ - 1',11,12,1),
(13,'KELAS XII TKJ - 2',11,13,1),
(14,'KELAS XII MM - 1',11,14,1),
(15,'KELAS XII MM - 2',11,15,1);

/*Table structure for table `el_kelas_siswa` */

DROP TABLE IF EXISTS `el_kelas_siswa`;

CREATE TABLE `el_kelas_siswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kelas_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `aktif` tinyint(1) NOT NULL COMMENT '0 jika bukan, 1 jika ya',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `el_kelas_siswa` */

insert  into `el_kelas_siswa`(`id`,`kelas_id`,`siswa_id`,`aktif`) values 
(1,2,1,1);

/*Table structure for table `el_komentar` */

DROP TABLE IF EXISTS `el_komentar`;

CREATE TABLE `el_komentar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login_id` int(11) NOT NULL,
  `materi_id` int(11) NOT NULL,
  `tampil` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=tidak,1=tampil',
  `konten` text,
  `tgl_posting` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `el_komentar` */

/*Table structure for table `el_login` */

DROP TABLE IF EXISTS `el_login`;

CREATE TABLE `el_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `siswa_id` int(11) DEFAULT NULL,
  `pengajar_id` int(11) DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL COMMENT '0=tidak,1=ya',
  `reset_kode` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `el_login` */

insert  into `el_login`(`id`,`username`,`password`,`siswa_id`,`pengajar_id`,`is_admin`,`reset_kode`) values 
(1,'admin@aaa.com','e10adc3949ba59abbe56e057f20f883e',NULL,1,1,NULL),
(2,'aa@11.com','4124bc0a9335c27f086f24ba207a4912',1,NULL,0,NULL),
(3,'qwerty@11.com','d8578edf8458ce06fbc5bb76a58c5ca4',NULL,2,0,NULL);

/*Table structure for table `el_login_log` */

DROP TABLE IF EXISTS `el_login_log`;

CREATE TABLE `el_login_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login_id` int(11) NOT NULL,
  `lasttime` datetime NOT NULL,
  `agent` text NOT NULL,
  `last_activity` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

/*Data for the table `el_login_log` */

insert  into `el_login_log`(`id`,`login_id`,`lasttime`,`agent`,`last_activity`) values 
(1,1,'2017-09-14 20:54:46','{\"is_mobile\":0,\"browser\":\"Chrome 60.0.3112.113\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.113 Safari\\/537.36\",\"ip\":\"::1\"}',1505402604),
(2,1,'2017-09-14 22:24:31','{\"is_mobile\":0,\"browser\":\"Chrome 60.0.3112.113\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.113 Safari\\/537.36\",\"ip\":\"::1\"}',1505410881),
(3,1,'2017-09-16 08:19:57','{\"is_mobile\":0,\"browser\":\"Chrome 60.0.3112.113\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.113 Safari\\/537.36\",\"ip\":\"::1\"}',1505529256),
(4,1,'2017-09-16 09:34:19','{\"is_mobile\":0,\"browser\":\"Chrome 60.0.3112.113\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.113 Safari\\/537.36\",\"ip\":\"::1\"}',1505540676),
(5,1,'2017-09-23 22:09:52','{\"is_mobile\":0,\"browser\":\"Chrome 60.0.3112.113\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.113 Safari\\/537.36\",\"ip\":\"::1\"}',1506179503),
(6,1,'2017-09-23 22:14:12','{\"is_mobile\":0,\"browser\":\"Chrome 60.0.3112.113\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.113 Safari\\/537.36\",\"ip\":\"::1\"}',1506179586),
(7,1,'2017-09-23 22:15:40','{\"is_mobile\":0,\"browser\":\"Chrome 60.0.3112.113\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.113 Safari\\/537.36\",\"ip\":\"::1\"}',1506179666),
(8,1,'2017-09-23 22:16:40','{\"is_mobile\":0,\"browser\":\"Chrome 60.0.3112.113\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.113 Safari\\/537.36\",\"ip\":\"::1\"}',1506179730),
(9,1,'2017-09-23 22:18:05','{\"is_mobile\":0,\"browser\":\"Chrome 60.0.3112.113\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.113 Safari\\/537.36\",\"ip\":\"::1\"}',1506179803),
(10,2,'2017-09-23 22:19:04','{\"is_mobile\":0,\"browser\":\"Chrome 60.0.3112.113\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.113 Safari\\/537.36\",\"ip\":\"::1\"}',1506179858),
(11,1,'2017-09-23 22:19:40','{\"is_mobile\":0,\"browser\":\"Chrome 60.0.3112.113\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.113 Safari\\/537.36\",\"ip\":\"::1\"}',1506179908),
(12,2,'2017-09-23 22:20:42','{\"is_mobile\":0,\"browser\":\"Chrome 60.0.3112.113\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.113 Safari\\/537.36\",\"ip\":\"::1\"}',1506179988),
(13,1,'2017-09-23 22:21:50','{\"is_mobile\":0,\"browser\":\"Chrome 60.0.3112.113\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.113 Safari\\/537.36\",\"ip\":\"::1\"}',1506184975),
(14,1,'2017-09-23 23:43:02','{\"is_mobile\":0,\"browser\":\"Chrome 60.0.3112.113\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.113 Safari\\/537.36\",\"ip\":\"::1\"}',1506185919),
(15,1,'2017-10-02 12:39:59','{\"is_mobile\":0,\"browser\":\"Chrome 61.0.3163.100\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36\",\"ip\":\"::1\"}',1506924047),
(16,1,'2017-10-02 13:02:57','{\"is_mobile\":0,\"browser\":\"Chrome 61.0.3163.100\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36\",\"ip\":\"::1\"}',1506925898),
(17,3,'2017-10-02 13:33:50','{\"is_mobile\":0,\"browser\":\"Chrome 61.0.3163.100\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36\",\"ip\":\"::1\"}',1506926040),
(18,1,'2017-10-02 13:36:06','{\"is_mobile\":0,\"browser\":\"Chrome 61.0.3163.100\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36\",\"ip\":\"::1\"}',1506926108),
(19,2,'2017-10-02 13:37:17','{\"is_mobile\":0,\"browser\":\"Chrome 61.0.3163.100\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36\",\"ip\":\"::1\"}',1506926162),
(20,1,'2017-10-02 13:38:10','{\"is_mobile\":0,\"browser\":\"Chrome 61.0.3163.100\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36\",\"ip\":\"::1\"}',1506927757),
(21,2,'2017-10-02 14:04:53','{\"is_mobile\":0,\"browser\":\"Chrome 61.0.3163.100\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36\",\"ip\":\"::1\"}',1506927802),
(22,3,'2017-10-02 14:05:27','{\"is_mobile\":0,\"browser\":\"Chrome 61.0.3163.100\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36\",\"ip\":\"::1\"}',1506927878),
(23,2,'2017-10-02 14:06:44','{\"is_mobile\":0,\"browser\":\"Chrome 61.0.3163.100\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36\",\"ip\":\"::1\"}',1506927898),
(24,1,'2017-10-02 14:07:04','{\"is_mobile\":0,\"browser\":\"Chrome 61.0.3163.100\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36\",\"ip\":\"::1\"}',1506928448),
(25,3,'2017-10-02 14:16:18','{\"is_mobile\":0,\"browser\":\"Chrome 61.0.3163.100\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36\",\"ip\":\"::1\"}',1506928591),
(26,2,'2017-10-02 14:18:38','{\"is_mobile\":0,\"browser\":\"Chrome 61.0.3163.100\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36\",\"ip\":\"::1\"}',1506928649),
(27,3,'2017-10-02 14:19:34','{\"is_mobile\":0,\"browser\":\"Chrome 61.0.3163.100\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36\",\"ip\":\"::1\"}',1506928736),
(28,2,'2017-10-02 14:21:05','{\"is_mobile\":0,\"browser\":\"Chrome 61.0.3163.100\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36\",\"ip\":\"::1\"}',1506928769),
(29,1,'2017-10-02 14:21:34','{\"is_mobile\":0,\"browser\":\"Chrome 61.0.3163.100\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36\",\"ip\":\"::1\"}',1506930665),
(30,1,'2017-10-06 00:05:25','{\"is_mobile\":0,\"browser\":\"Chrome 61.0.3163.100\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36\",\"ip\":\"::1\"}',1507228291),
(31,1,'2017-10-06 02:04:07','{\"is_mobile\":0,\"browser\":\"Chrome 61.0.3163.100\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36\",\"ip\":\"::1\"}',1507232479),
(32,1,'2017-10-06 22:46:36','{\"is_mobile\":0,\"browser\":\"Chrome 61.0.3163.100\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36\",\"ip\":\"::1\"}',1507314987),
(33,1,'2017-10-08 00:55:34','{\"is_mobile\":0,\"browser\":\"Chrome 61.0.3163.100\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36\",\"ip\":\"::1\"}',1507401458),
(34,1,'2017-10-09 11:26:40','{\"is_mobile\":0,\"browser\":\"Chrome 61.0.3163.100\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36\",\"ip\":\"::1\"}',1507535100),
(35,1,'2017-10-10 09:02:23','{\"is_mobile\":0,\"browser\":\"Chrome 61.0.3163.100\",\"platform\":\"Unknown Windows OS\",\"agent_string\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/61.0.3163.100 Safari\\/537.36\",\"ip\":\"::1\"}',1507650795);

/*Table structure for table `el_mapel` */

DROP TABLE IF EXISTS `el_mapel`;

CREATE TABLE `el_mapel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `info` text,
  `aktif` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = ya, 0 = tidak',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

/*Data for the table `el_mapel` */

insert  into `el_mapel`(`id`,`nama`,`info`,`aktif`) values 
(1,'Bahasa Indonesia',NULL,1),
(2,'Bahasa Inggris',NULL,1),
(3,'Matematika',NULL,1),
(4,'KWU',NULL,1),
(5,'Seni Budaya',NULL,1),
(6,'Budi Pekerti',NULL,1),
(7,'Penjaskes',NULL,1),
(8,'Agama',NULL,1),
(9,'Fisika',NULL,1),
(10,'Kimia',NULL,1),
(11,'PKN',NULL,1),
(12,'IPS',NULL,1),
(13,'IPA',NULL,1),
(14,'Bahasa Daerah',NULL,1),
(15,'KKPI',NULL,1),
(16,'Kejuruan TKJ I',NULL,1),
(17,'Kejuruan TKJ II',NULL,1),
(18,'Kejuruan TKJ III',NULL,1),
(19,'Kejuruan MM I',NULL,1),
(20,'Kejuruan MM II',NULL,1),
(21,'Kejuruan MM III',NULL,1);

/*Table structure for table `el_mapel_ajar` */

DROP TABLE IF EXISTS `el_mapel_ajar`;

CREATE TABLE `el_mapel_ajar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hari_id` tinyint(1) NOT NULL COMMENT '1=senin,2=selasa,3=rabu,4=kamis,5=jum''at,6=sabtu,7=minggu',
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `pengajar_id` int(11) NOT NULL,
  `mapel_kelas_id` int(11) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = aktif 0 = tidak',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `el_mapel_ajar` */

insert  into `el_mapel_ajar`(`id`,`hari_id`,`jam_mulai`,`jam_selesai`,`pengajar_id`,`mapel_kelas_id`,`aktif`) values 
(1,1,'00:00:08','00:00:11',2,1,1);

/*Table structure for table `el_mapel_kelas` */

DROP TABLE IF EXISTS `el_mapel_kelas`;

CREATE TABLE `el_mapel_kelas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kelas_id` int(11) NOT NULL,
  `mapel_id` int(11) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `el_mapel_kelas` */

insert  into `el_mapel_kelas`(`id`,`kelas_id`,`mapel_id`,`aktif`) values 
(1,2,1,1),
(2,2,2,1),
(3,2,3,1),
(4,2,4,1);

/*Table structure for table `el_materi` */

DROP TABLE IF EXISTS `el_materi`;

CREATE TABLE `el_materi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mapel_id` int(11) NOT NULL,
  `pengajar_id` int(11) DEFAULT NULL,
  `siswa_id` int(11) DEFAULT NULL,
  `judul` varchar(255) NOT NULL,
  `konten` text,
  `file` text,
  `tgl_posting` datetime NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '0',
  `views` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `el_materi` */

insert  into `el_materi`(`id`,`mapel_id`,`pengajar_id`,`siswa_id`,`judul`,`konten`,`file`,`tgl_posting`,`publish`,`views`) values 
(1,1,1,NULL,'materi 1','<p>test</p>\r\n',NULL,'2017-09-23 22:20:18',1,3);

/*Table structure for table `el_materi_kelas` */

DROP TABLE IF EXISTS `el_materi_kelas`;

CREATE TABLE `el_materi_kelas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `materi_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `el_materi_kelas` */

insert  into `el_materi_kelas`(`id`,`materi_id`,`kelas_id`) values 
(1,1,1);

/*Table structure for table `el_messages` */

DROP TABLE IF EXISTS `el_messages`;

CREATE TABLE `el_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` tinyint(1) NOT NULL COMMENT '1=inbox,2=outbox',
  `content` text NOT NULL,
  `owner_id` int(11) NOT NULL,
  `sender_receiver_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `opened` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=belum,1=sudah',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `el_messages` */

insert  into `el_messages`(`id`,`type_id`,`content`,`owner_id`,`sender_receiver_id`,`date`,`opened`) values 
(1,2,'<p>test</p>\r\n',2,1,'2017-09-23 22:21:43',1),
(2,1,'<p>test</p>\r\n',1,2,'2017-09-23 22:21:43',1);

/*Table structure for table `el_nilai_tugas` */

DROP TABLE IF EXISTS `el_nilai_tugas`;

CREATE TABLE `el_nilai_tugas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nilai` float NOT NULL,
  `tugas_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `el_nilai_tugas` */

insert  into `el_nilai_tugas`(`id`,`nilai`,`tugas_id`,`siswa_id`) values 
(1,60,3,1);

/*Table structure for table `el_pengajar` */

DROP TABLE IF EXISTS `el_pengajar`;

CREATE TABLE `el_pengajar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nip` varchar(45) DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(9) NOT NULL,
  `tempat_lahir` varchar(45) NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` varchar(255) NOT NULL,
  `foto` text,
  `status_id` tinyint(1) NOT NULL COMMENT '0=pending, 1=aktif, 2=blok',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `el_pengajar` */

insert  into `el_pengajar`(`id`,`nip`,`nama`,`jenis_kelamin`,`tempat_lahir`,`tgl_lahir`,`alamat`,`foto`,`status_id`) values 
(1,'4555','admin','Laki-laki','',NULL,'',NULL,1),
(2,'','qwerty','Laki-laki','',NULL,'',NULL,1);

/*Table structure for table `el_pengaturan` */

DROP TABLE IF EXISTS `el_pengaturan`;

CREATE TABLE `el_pengaturan` (
  `id` varchar(255) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `value` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `el_pengaturan` */

insert  into `el_pengaturan`(`id`,`nama`,`value`) values 
('email-server','Email server','no-reply@domain.com'),
('email-template-approve-pengajar','Approve pengajar (email pengajar)','{\"subject\":\"Pengaktifan Akun\",\"body\":\"<p>Hai {$nama},<\\/p>\\n<p>Anda telah diterima sebagai pengajar pada {$nama_sekolah}, berikut informasi data diri anda:<\\/p>\\n<p>{$tabel_profil}<\\/p>\\n<p>Anda dapat login ke sistem E-Learning menggunakan username dan password yang telah anda buat saat pendaftaran, login pada url berikut : {$url_login}<\\/p>\"}'),
('email-template-approve-siswa','Approve siswa (email siswa)','{\"subject\":\"Pengaktifan Akun\",\"body\":\"<p>Hai {$nama},<\\/p>\\n<p>Anda telah diterima sebagai siswa pada {$nama_sekolah}, berikut informasi data diri anda:<\\/p>\\n<p>{$tabel_profil}<\\/p>\\n<p>Anda dapat login ke sistem E-Learning menggunakan username dan password yang telah anda buat saat pendaftaran, login pada url berikut : {$url_login}<\\/p>\"}'),
('email-template-link-reset','Link Reset Password','{\"subject\":\"Reset Password\",\"body\":\"<p>Hai,<\\/p>\\n<p>Anda mengirimkan permintaan untuk reset password anda, klik link berikut untuk memulai reset password : {$link_reset}<\\/p>\"}'),
('email-template-register-pengajar','Register pengajar (email pengajar)','{\"subject\":\"Registrasi Berhasil\",\"body\":\"<p>Hai {$nama},<\\/p>\\n<p>Terimakasih telah melakukan pendaftaran sebagai pengajar di E-Learning {$nama_sekolah}. Akun anda akan segera diaktifkan oleh admin.<\\/p>\"}'),
('email-template-register-siswa','Register siswa (email siswa)','{\"subject\":\"Registrasi Berhasil\",\"body\":\"<p>Hai {$nama},<\\/p>\\n<p>Terimakasih telah melakukan pendaftaran sebagai siswa di E-Learning {$nama_sekolah}. Akun anda akan segera diaktifkan oleh admin.<\\/p>\"}'),
('info-registrasi','Info Registrasi','<p>Silakan mendaftar sebagai siswa atau pengajar (jika anda sebagai pengajar) dengan memilih sesuai tab berikut :</p>'),
('peraturan-elearning','Peraturan E-learning',''),
('registrasi-pengajar','Registrasi Pengajar','1'),
('registrasi-siswa','Registrasi Siswa','1'),
('versi','Versi','1.9'),
('jenjang','jenjang','SMA'),
('nama-sekolah','nama-sekolah','smk 2'),
('alamat','alamat','gadung'),
('telp','telp','5582665'),
('install-success','install-success','1');

/*Table structure for table `el_pengumuman` */

DROP TABLE IF EXISTS `el_pengumuman`;

CREATE TABLE `el_pengumuman` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `konten` text NOT NULL,
  `tgl_tampil` date NOT NULL,
  `tgl_tutup` date NOT NULL,
  `tampil_siswa` tinyint(1) NOT NULL DEFAULT '1',
  `tampil_pengajar` tinyint(1) NOT NULL DEFAULT '1',
  `pengajar_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `el_pengumuman` */

insert  into `el_pengumuman`(`id`,`judul`,`konten`,`tgl_tampil`,`tgl_tutup`,`tampil_siswa`,`tampil_pengajar`,`pengajar_id`) values 
(1,'libur','<p>libur</p>\r\n','2017-10-02','2017-11-01',1,1,1);

/*Table structure for table `el_pilihan` */

DROP TABLE IF EXISTS `el_pilihan`;

CREATE TABLE `el_pilihan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pertanyaan_id` int(11) NOT NULL,
  `konten` text NOT NULL,
  `kunci` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=tidak',
  `urutan` int(11) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `el_pilihan` */

/*Table structure for table `el_siswa` */

DROP TABLE IF EXISTS `el_siswa`;

CREATE TABLE `el_siswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nis` varchar(45) DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(9) NOT NULL COMMENT 'Laki-laki dan Perempuan',
  `tempat_lahir` varchar(45) NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `agama` char(7) DEFAULT NULL,
  `alamat` varchar(255) NOT NULL,
  `tahun_masuk` year(4) NOT NULL,
  `foto` text,
  `status_id` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=pending, 1=aktif, 2=blok, 3=alumni, 4=deleted',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `el_siswa` */

insert  into `el_siswa`(`id`,`nis`,`nama`,`jenis_kelamin`,`tempat_lahir`,`tgl_lahir`,`agama`,`alamat`,`tahun_masuk`,`foto`,`status_id`) values 
(1,'112','aa','Laki-laki','kapal','1995-10-25','ISLAM','tbhn',2017,NULL,1);

/*Table structure for table `el_tugas` */

DROP TABLE IF EXISTS `el_tugas`;

CREATE TABLE `el_tugas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mapel_id` int(11) NOT NULL,
  `pengajar_id` int(11) NOT NULL,
  `type_id` tinyint(1) NOT NULL COMMENT '1=upload,2=essay,3=ganda',
  `judul` varchar(255) NOT NULL,
  `durasi` int(11) DEFAULT NULL COMMENT 'lama pengerjaan dalam menit',
  `info` text,
  `aktif` tinyint(1) NOT NULL DEFAULT '0',
  `tgl_buat` datetime DEFAULT NULL,
  `tampil_siswa` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=tidak tampil di siswa, 1=tampil siswa',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `el_tugas` */

insert  into `el_tugas`(`id`,`mapel_id`,`pengajar_id`,`type_id`,`judul`,`durasi`,`info`,`aktif`,`tgl_buat`,`tampil_siswa`) values 
(1,1,2,3,'jj',60,'<p>buat</p>\r\n',0,'2017-10-02 14:06:14',0),
(2,1,2,2,'hjjhj',60,'<p>jhfkjhfjhfjhjhj</p>\r\n',0,'2017-10-02 14:16:51',0),
(3,1,2,1,'vhkhfkjg',NULL,'<p>lhfkjkyfkjfjhfkj</p>\r\n',0,'2017-10-02 14:17:30',1);

/*Table structure for table `el_tugas_kelas` */

DROP TABLE IF EXISTS `el_tugas_kelas`;

CREATE TABLE `el_tugas_kelas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tugas_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `el_tugas_kelas` */

insert  into `el_tugas_kelas`(`id`,`tugas_id`,`kelas_id`) values 
(1,1,2),
(2,2,2),
(3,3,2);

/*Table structure for table `el_tugas_pertanyaan` */

DROP TABLE IF EXISTS `el_tugas_pertanyaan`;

CREATE TABLE `el_tugas_pertanyaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pertanyaan` text NOT NULL,
  `urutan` int(11) NOT NULL,
  `tugas_id` int(11) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `el_tugas_pertanyaan` */

/*Table structure for table `essay` */

DROP TABLE IF EXISTS `essay`;

CREATE TABLE `essay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jawaban` text NOT NULL,
  `pertanyaan_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `tugas_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_essay_tugas_essay1_idx` (`pertanyaan_id`),
  KEY `fk_essay_siswa1_idx` (`siswa_id`),
  KEY `fk_essay_tugas1_idx` (`tugas_id`),
  CONSTRAINT `fk_essay_siswa1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_essay_tugas1` FOREIGN KEY (`tugas_id`) REFERENCES `tugas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_essay_tugas_essay1` FOREIGN KEY (`pertanyaan_id`) REFERENCES `tugas_pertanyaan` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `essay` */

/*Table structure for table `ganda` */

DROP TABLE IF EXISTS `ganda`;

CREATE TABLE `ganda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pilihan_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `tugas_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ganda_pilihan1_idx` (`pilihan_id`),
  KEY `fk_ganda_siswa1_idx` (`siswa_id`),
  KEY `fk_ganda_tugas1_idx` (`tugas_id`),
  CONSTRAINT `fk_ganda_pilihan1` FOREIGN KEY (`pilihan_id`) REFERENCES `pilihan` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_ganda_siswa1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_ganda_tugas1` FOREIGN KEY (`tugas_id`) REFERENCES `tugas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ganda` */

/*Table structure for table `kelas` */

DROP TABLE IF EXISTS `kelas`;

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(45) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `urutan` int(11) NOT NULL,
  `aktif` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=aktif 0=tidak',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `kelas` */

insert  into `kelas`(`id`,`nama_kelas`,`parent_id`,`urutan`,`aktif`) values 
(1,'X TKJ',0,0,1),
(3,'X MM',NULL,0,1),
(5,'XI TKJ',NULL,0,1),
(7,'XI MM',NULL,0,1),
(9,'XII TKJ',NULL,0,1),
(11,'XII MM',NULL,0,1);

/*Table structure for table `kelas_siswa` */

DROP TABLE IF EXISTS `kelas_siswa`;

CREATE TABLE `kelas_siswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kelas_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `aktif` tinyint(4) NOT NULL COMMENT '0 jika bukan, 1 jika ya',
  PRIMARY KEY (`id`),
  KEY `fk_kelas_siswa_kelas_idx` (`kelas_id`),
  KEY `fk_kelas_siswa_siswa1_idx` (`siswa_id`),
  CONSTRAINT `fk_kelas_siswa_kelas` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_kelas_siswa_siswa1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `kelas_siswa` */

/*Table structure for table `login` */

DROP TABLE IF EXISTS `login`;

CREATE TABLE `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `siswa_id` int(11) DEFAULT NULL,
  `pengajar_id` int(11) DEFAULT NULL,
  `is_admin` int(11) NOT NULL COMMENT '0=tidak,1=ya',
  `reset_kode` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_login_siswa1_idx` (`siswa_id`),
  KEY `fk_login_pengajar1_idx` (`pengajar_id`),
  CONSTRAINT `fk_login_pengajar1` FOREIGN KEY (`pengajar_id`) REFERENCES `pengajar` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_login_siswa1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `login` */

/*Table structure for table `mapel` */

DROP TABLE IF EXISTS `mapel`;

CREATE TABLE `mapel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_mapel` varchar(255) NOT NULL,
  `info` text,
  `aktif` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 = ya, 0 = tidak',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

/*Data for the table `mapel` */

insert  into `mapel`(`id`,`nama_mapel`,`info`,`aktif`) values 
(1,'Agama',NULL,1),
(2,'Budi Pekerti',NULL,1),
(3,'PKN',NULL,1),
(4,'Bahasa Indonesia',NULL,1),
(5,'Matematika',NULL,1),
(6,'IPS',NULL,1),
(7,'Seni Budaya',NULL,1),
(8,'Bahasa Inggris',NULL,1),
(9,'Penjaskes',NULL,1),
(10,'IPA',NULL,1),
(11,'Fisika',NULL,1),
(12,'Bahasa Daerah',NULL,1),
(13,'KWU',NULL,1),
(14,'KKPI',NULL,1),
(15,'Kimia',NULL,1),
(16,'Kejuruan TKJ I',NULL,1),
(17,'Kejuruan TKJ II',NULL,1),
(18,'Kejuruan TKJ III',NULL,1),
(19,'Kejuruan MM I',NULL,1),
(20,'Kejuruan MM II',NULL,1),
(21,'Kejuruan MM III',NULL,1),
(22,'P.Wali',NULL,1),
(26,'Upacara',NULL,1);

/*Table structure for table `mapel_ajar` */

DROP TABLE IF EXISTS `mapel_ajar`;

CREATE TABLE `mapel_ajar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hari_id` tinyint(4) NOT NULL COMMENT '1=senin,2=selasa,3=rabu,4=kamis,5=jum''at,6=sabtu,7=minggu',
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `pengajar_id` int(11) NOT NULL,
  `mapel_kelas_id` int(11) NOT NULL,
  `aktif` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 = aktif 0 = tidak',
  PRIMARY KEY (`id`),
  KEY `fk_mapel_ajar_pengajar1_idx` (`pengajar_id`),
  KEY `fk_mapel_ajar_mapel_kelas1_idx` (`mapel_kelas_id`),
  CONSTRAINT `fk_mapel_ajar_mapel_kelas1` FOREIGN KEY (`mapel_kelas_id`) REFERENCES `mapel_kelas` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_mapel_ajar_pengajar1` FOREIGN KEY (`pengajar_id`) REFERENCES `pengajar` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mapel_ajar` */

/*Table structure for table `mapel_kelas` */

DROP TABLE IF EXISTS `mapel_kelas`;

CREATE TABLE `mapel_kelas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kelas_id` int(11) NOT NULL,
  `mapel_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_mapel_kelas_kelas1_idx` (`kelas_id`),
  KEY `fk_mapel_kelas_mapel1_idx` (`mapel_id`),
  CONSTRAINT `fk_mapel_kelas_kelas1` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_mapel_kelas_mapel1` FOREIGN KEY (`mapel_id`) REFERENCES `mapel` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=latin1;

/*Data for the table `mapel_kelas` */

insert  into `mapel_kelas`(`id`,`kelas_id`,`mapel_id`) values 
(5,1,7),
(6,1,11),
(7,1,14),
(8,1,8),
(9,1,16),
(10,1,4),
(11,1,12),
(12,1,3),
(13,1,5),
(14,1,10),
(15,1,6),
(16,1,15),
(17,1,1),
(18,1,2),
(19,1,13),
(20,1,22),
(21,3,7),
(22,3,11),
(23,3,14),
(24,3,8),
(25,3,19),
(26,3,4),
(27,3,12),
(28,3,3),
(29,3,5),
(30,3,10),
(31,3,6),
(32,3,15),
(33,3,1),
(34,3,2),
(35,3,13),
(36,3,22),
(37,5,3),
(38,5,8),
(39,5,12),
(40,5,4),
(41,5,13),
(42,5,11),
(43,5,7),
(44,5,2),
(45,5,6),
(46,5,17),
(47,5,15),
(48,5,8),
(49,5,22),
(50,5,14),
(51,5,5),
(52,5,1),
(53,5,10),
(56,7,3),
(57,7,8),
(58,7,12),
(59,7,4),
(60,7,13),
(61,7,11),
(62,7,2),
(63,7,6),
(65,7,20),
(66,7,15),
(67,7,8),
(68,7,22),
(69,7,14),
(70,7,5),
(71,7,1),
(72,7,10),
(77,9,15),
(78,9,8),
(80,9,11),
(81,9,18),
(82,9,5),
(83,9,3),
(84,9,7),
(85,9,2),
(86,9,12),
(87,9,13),
(88,9,10),
(89,9,4),
(90,9,6),
(91,9,14),
(92,9,1),
(93,9,22),
(94,11,15),
(95,11,8),
(96,11,21),
(97,11,5),
(98,11,3),
(99,11,7),
(100,11,2),
(101,11,12),
(102,11,13),
(103,11,10),
(104,11,4),
(105,11,6),
(106,11,14),
(107,11,1),
(108,11,22);

/*Table structure for table `materi` */

DROP TABLE IF EXISTS `materi`;

CREATE TABLE `materi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mapel_id` int(11) NOT NULL,
  `pengajar_id` int(11) DEFAULT NULL,
  `siswa_id` int(11) DEFAULT NULL,
  `judul` varchar(255) NOT NULL,
  `konten` text,
  `file` text,
  `tgl_posting` datetime NOT NULL,
  `publish` tinyint(4) NOT NULL DEFAULT '0',
  `views` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_materi_pengajar1_idx` (`pengajar_id`),
  KEY `fk_materi_siswa1_idx` (`siswa_id`),
  KEY `fk_materi_mapel1_idx` (`mapel_id`),
  CONSTRAINT `fk_materi_mapel1` FOREIGN KEY (`mapel_id`) REFERENCES `mapel` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_materi_pengajar1` FOREIGN KEY (`pengajar_id`) REFERENCES `pengajar` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_materi_siswa1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `materi` */

/*Table structure for table `materi_kelas` */

DROP TABLE IF EXISTS `materi_kelas`;

CREATE TABLE `materi_kelas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `materi_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_materi_kelas_materi1_idx` (`materi_id`),
  KEY `fk_materi_kelas_kelas1_idx` (`kelas_id`),
  CONSTRAINT `fk_materi_kelas_kelas1` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_materi_kelas_materi1` FOREIGN KEY (`materi_id`) REFERENCES `materi` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `materi_kelas` */

/*Table structure for table `nilai_tugas` */

DROP TABLE IF EXISTS `nilai_tugas`;

CREATE TABLE `nilai_tugas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nilai` float NOT NULL,
  `tugas_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_nilai_tugas1_idx` (`tugas_id`),
  KEY `fk_nilai_siswa1_idx` (`siswa_id`),
  CONSTRAINT `fk_nilai_siswa1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_nilai_tugas1` FOREIGN KEY (`tugas_id`) REFERENCES `tugas` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `nilai_tugas` */

/*Table structure for table `pengajar` */

DROP TABLE IF EXISTS `pengajar`;

CREATE TABLE `pengajar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nip` varchar(45) DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(9) NOT NULL,
  `tempat_lahir` varchar(45) NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` varchar(255) NOT NULL,
  `foto` text,
  `status_id` tinyint(4) NOT NULL COMMENT '0=pending, 1=aktif, 2=blok',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `pengajar` */

insert  into `pengajar`(`id`,`nip`,`nama`,`jenis_kelamin`,`tempat_lahir`,`tgl_lahir`,`alamat`,`foto`,`status_id`) values 
(1,'-','I Made Sudana','Laki-laki','-','0000-00-00','-',NULL,0),
(2,'-','I Made Agus Yogi Artha, S.Pd. H','Laki-laki','-','0000-00-00','-',NULL,0),
(3,NULL,'I Wayan Asta Apriadi, S.H, M.H','Laki-laki','',NULL,'',NULL,0),
(4,NULL,'Nyoman Bagus Sanjaya, S.Pd','Laki-laki','',NULL,'',NULL,0),
(5,NULL,'Ni Wayan Novi Rosita, S.Pd','Perempuan','',NULL,'',NULL,0),
(6,NULL,'I Nyoman Gede Aeiawan, SPd','Laki-laki','',NULL,'',NULL,0),
(7,NULL,'Ni Nyoman Sekar Sari','Perempuan','',NULL,'',NULL,0),
(8,NULL,'Yan Tanendra Bamagara, S.Pd','Laki-laki','',NULL,'',NULL,0),
(9,NULL,'I GST NGR AG BGS Arya Yudantha, S.pd','Laki-laki','',NULL,'',NULL,0),
(10,NULL,'Ni Nyoman Ayu Tirtawati, S,Pd','Perempuan','',NULL,'',NULL,0),
(11,NULL,'GST AG Ayu Putu Dwiyanti, S.pd','Perempuan','',NULL,'',NULL,0),
(12,NULL,'Rai Sintha Dewi, S.pd','Perempuan','',NULL,'',NULL,0),
(13,NULL,'Ni Kadek Dwijayanthi, S.E','Perempuan','',NULL,'',NULL,0),
(14,NULL,'Putu Dewi Indrayani, Amd','Perempuan','',NULL,'',NULL,0),
(15,NULL,'Ni Putu Eka Widyastari, S.Pd','Perempuan','',NULL,'',NULL,0),
(16,NULL,'Ni Ketut Kurniawati, S.Kom','Perempuan','',NULL,'',NULL,0),
(17,NULL,'Ni Luh Putu Asih Oktapiyanti, S.T','Perempuan','',NULL,'',NULL,0),
(18,NULL,'SEMUA','','',NULL,'',NULL,0);

/*Table structure for table `pilihan` */

DROP TABLE IF EXISTS `pilihan`;

CREATE TABLE `pilihan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pertanyaan_id` int(11) NOT NULL,
  `konten` varchar(255) NOT NULL,
  `kunci` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=tidak\n1=ya',
  `urutan` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pilihan_tugas_pertanyaan1_idx` (`pertanyaan_id`),
  CONSTRAINT `fk_pilihan_tugas_pertanyaan1` FOREIGN KEY (`pertanyaan_id`) REFERENCES `tugas_pertanyaan` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pilihan` */

/*Table structure for table `siswa` */

DROP TABLE IF EXISTS `siswa`;

CREATE TABLE `siswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nis` varchar(45) DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(9) NOT NULL COMMENT 'Laki-laki dan Perempuan',
  `tempat_lahir` varchar(45) NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `agama` char(7) DEFAULT NULL,
  `alamat` varchar(255) NOT NULL,
  `tahun_masuk` year(4) NOT NULL,
  `foto` text,
  `status_id` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=pending, 1=aktif, 2=blok, 3=alumni, 4=deleted',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=latin1;

/*Data for the table `siswa` */

insert  into `siswa`(`id`,`nis`,`nama`,`jenis_kelamin`,`tempat_lahir`,`tgl_lahir`,`agama`,`alamat`,`tahun_masuk`,`foto`,`status_id`) values 
(1,'112','awin','laki-laki','kapal','1999-04-02','hindu','kapal',2017,NULL,1),
(113,'113','surya','laki-laki','mengwi','2017-10-03','hindu','mengwi',2017,NULL,0);

/*Table structure for table `site_config` */

DROP TABLE IF EXISTS `site_config`;

CREATE TABLE `site_config` (
  `site_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `telp` varchar(45) DEFAULT NULL,
  `date_format` varchar(20) DEFAULT 'F j, Y'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `site_config` */

/*Table structure for table `tugas` */

DROP TABLE IF EXISTS `tugas`;

CREATE TABLE `tugas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mapel_ajar_id` int(11) NOT NULL,
  `type_id` tinyint(4) NOT NULL COMMENT '1=upload,2=essay,3=ganda',
  `judul` varchar(255) NOT NULL,
  `durasi` int(11) DEFAULT NULL COMMENT 'lama pengerjaan dalam menit',
  `info` text,
  `aktif` tinyint(4) NOT NULL DEFAULT '0',
  `tgl_buat` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tugas_mapel_ajar1_idx` (`mapel_ajar_id`),
  CONSTRAINT `fk_tugas_mapel_ajar1` FOREIGN KEY (`mapel_ajar_id`) REFERENCES `mapel_ajar` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tugas` */

/*Table structure for table `tugas_pertanyaan` */

DROP TABLE IF EXISTS `tugas_pertanyaan`;

CREATE TABLE `tugas_pertanyaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pertanyaan` text NOT NULL,
  `urutan` int(11) NOT NULL,
  `tugas_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tugas_essay_tugas1_idx` (`tugas_id`),
  CONSTRAINT `fk_tugas_essay_tugas1` FOREIGN KEY (`tugas_id`) REFERENCES `tugas` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tugas_pertanyaan` */

/*Table structure for table `upload` */

DROP TABLE IF EXISTS `upload`;

CREATE TABLE `upload` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file` text NOT NULL,
  `tgl_upload` datetime NOT NULL,
  `tugas_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_upload_tugas1_idx` (`tugas_id`),
  KEY `fk_upload_siswa1_idx` (`siswa_id`),
  CONSTRAINT `fk_upload_siswa1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_upload_tugas1` FOREIGN KEY (`tugas_id`) REFERENCES `tugas` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `upload` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
>>>>>>> 5d3a3f8ce8200066df22d184c933b9a29895de81
