-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2021 at 03:32 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `watchan_erp`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `dept_id` int(10) UNSIGNED NOT NULL,
  `dept_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`dept_id`, `dept_name`) VALUES
(1, 'แพทย์แผนไทย'),
(2, 'กายภาพบำบัด'),
(3, 'เวชศาสตร์ชุมชนและครอบครัว'),
(4, 'รังสีวิทยา'),
(5, 'เภสัชกรรม'),
(6, 'ทันตกรรม'),
(7, 'เทคนิคการแพทย์'),
(8, 'งานประกันสุขภาพ ยุทธศาสตร์และสารสนเทศทางการแพทย์'),
(9, 'กลุ่มการพยาบาล'),
(10, 'งานบริหาร'),
(11, 'กลุ่มการแพทย์');

-- --------------------------------------------------------

--
-- Table structure for table `helpdesk`
--

CREATE TABLE `helpdesk` (
  `help_id` int(4) UNSIGNED ZEROFILL NOT NULL,
  `help_date` datetime NOT NULL,
  `help_title` text DEFAULT NULL,
  `help_fix` text DEFAULT NULL,
  `help_cause` text DEFAULT NULL,
  `help_create` varchar(10) DEFAULT NULL,
  `help_dept` varchar(10) DEFAULT NULL,
  `help_place` varchar(10) DEFAULT NULL,
  `help_status` varchar(50) DEFAULT '1',
  `help_type` varchar(50) DEFAULT NULL,
  `help_support` varchar(255) DEFAULT NULL,
  `help_end` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `helpdesk_rate`
--

CREATE TABLE `helpdesk_rate` (
  `rate_id` int(5) NOT NULL,
  `t_help_id` int(5) DEFAULT NULL,
  `rate_1` int(5) DEFAULT NULL,
  `rate_2` int(5) DEFAULT NULL,
  `rate_3` int(5) DEFAULT NULL,
  `rate_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `rate_user` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `helpdesk_status`
--

CREATE TABLE `helpdesk_status` (
  `hs_id` int(3) NOT NULL,
  `hs_name` text DEFAULT NULL,
  `hs_text` text DEFAULT NULL,
  `hs_icon` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `helpdesk_status`
--

INSERT INTO `helpdesk_status` (`hs_id`, `hs_name`, `hs_text`, `hs_icon`) VALUES
(1, 'รอดำเนินการ', 'badge badge-info', 'fa fa-spinner fa-spin'),
(2, 'ส่งซ่อม', 'badge badge-warning', 'fa fa-truck'),
(3, 'สำเร็จ', 'badge badge-success', 'fa fa-check-circle');

-- --------------------------------------------------------

--
-- Table structure for table `helpdesk_type`
--

CREATE TABLE `helpdesk_type` (
  `ht_id` int(11) NOT NULL,
  `ht_name` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `helpdesk_type`
--

INSERT INTO `helpdesk_type` (`ht_id`, `ht_name`) VALUES
(1, 'ปัญหาด้าน Software / โปรแกรม'),
(2, 'ปัญหาด้าน Hardware / อุปกรณ์'),
(3, 'ปัญหาด้าน Network / ระบบเครือข่าย'),
(4, 'อื่นๆ ไม่ระบุ');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `job_id` int(10) UNSIGNED NOT NULL,
  `job_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`job_id`, `job_name`) VALUES
(1, 'ข้าราชการ'),
(2, 'พนักงานราชการ'),
(3, 'พนักงานกระทรวง'),
(4, 'ลูกจ้างชั่วคราว'),
(5, 'จ้างเหมาบริการ');

-- --------------------------------------------------------

--
-- Table structure for table `leave_list`
--

CREATE TABLE `leave_list` (
  `leave_id` int(3) NOT NULL,
  `leave_create` datetime DEFAULT NULL,
  `leave_type` int(1) DEFAULT NULL,
  `leave_start` datetime DEFAULT NULL,
  `leave_end` datetime DEFAULT NULL,
  `leave_num` decimal(3,1) DEFAULT NULL,
  `leave_time` int(1) DEFAULT NULL,
  `leave_stead` varchar(255) DEFAULT NULL,
  `leave_note` text DEFAULT NULL,
  `leave_hnote` text DEFAULT NULL,
  `leave_dnote` text DEFAULT NULL,
  `leave_status` int(1) DEFAULT NULL,
  `leave_approve` datetime DEFAULT NULL,
  `leave_cancel` text DEFAULT NULL,
  `leave_cancel_note` text DEFAULT NULL,
  `leave_cancel_date` datetime DEFAULT NULL,
  `user_id` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `leave_list`
--

INSERT INTO `leave_list` (`leave_id`, `leave_create`, `leave_type`, `leave_start`, `leave_end`, `leave_num`, `leave_time`, `leave_stead`, `leave_note`, `leave_hnote`, `leave_dnote`, `leave_status`, `leave_approve`, `leave_cancel`, `leave_cancel_note`, `leave_cancel_date`, `user_id`) VALUES
(1, '2021-04-20 19:25:54', 3, '2021-05-03 00:00:00', '2021-05-03 00:00:00', '1.0', 1, 'เกียรติศักดิ์ เด่นแสงจันทร์', 'test', 'เห็นควร', 'อนุมัติรายการ', 3, '2021-04-20 19:26:21', NULL, NULL, NULL, 91);

-- --------------------------------------------------------

--
-- Table structure for table `leave_num`
--

CREATE TABLE `leave_num` (
  `leave_num_id` int(5) NOT NULL,
  `sick` varchar(10) DEFAULT NULL,
  `busy` varchar(10) DEFAULT NULL,
  `job_type` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `leave_num`
--

INSERT INTO `leave_num` (`leave_num_id`, `sick`, `busy`, `job_type`) VALUES
(1, '60', '45', '1'),
(2, '30', '10', '2'),
(3, '30', '15', '3'),
(4, '0', '0', '4'),
(5, '0', '0', '5');

-- --------------------------------------------------------

--
-- Table structure for table `leave_status`
--

CREATE TABLE `leave_status` (
  `status_id` int(5) NOT NULL,
  `status_name` varchar(255) NOT NULL,
  `status_style` text DEFAULT NULL,
  `status_icon` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `leave_status`
--

INSERT INTO `leave_status` (`status_id`, `status_name`, `status_style`, `status_icon`) VALUES
(1, 'รอดำเนินการ', 'badge badge-danger', 'fa fa-envelope-open-text'),
(2, 'รอการอนุมัติ', 'badge badge-info', 'far fa-clock'),
(3, 'อนุมัติ', 'badge badge-success', 'fa fa-check'),
(4, 'ไม่อนุมัติ', 'badge badge-warning', 'fa fa-ban'),
(5, 'ยกเลิก', 'badge badge-warning', 'fa fa-ban');

-- --------------------------------------------------------

--
-- Table structure for table `leave_time`
--

CREATE TABLE `leave_time` (
  `time_id` int(5) NOT NULL,
  `time_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `leave_time`
--

INSERT INTO `leave_time` (`time_id`, `time_name`) VALUES
(1, 'เต็มวัน'),
(2, 'ครึ่งเช้า'),
(3, 'ครึ่งบ่าย');

-- --------------------------------------------------------

--
-- Table structure for table `leave_type`
--

CREATE TABLE `leave_type` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `leave_type`
--

INSERT INTO `leave_type` (`type_id`, `type_name`) VALUES
(1, 'ลากิจ'),
(2, 'ลาป่วย'),
(3, 'ลาพักผ่อน');

-- --------------------------------------------------------

--
-- Table structure for table `leave_vacation`
--

CREATE TABLE `leave_vacation` (
  `leave_vacation_id` int(11) NOT NULL,
  `balance_new` decimal(10,0) DEFAULT NULL,
  `balance_old` decimal(10,0) DEFAULT NULL,
  `user_id` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `leave_vacation`
--

INSERT INTO `leave_vacation` (`leave_vacation_id`, `balance_new`, `balance_old`, `user_id`) VALUES
(1, '30', '0', 1),
(2, '10', '0', 2),
(3, '20', '0', 3),
(4, '26', '0', 4),
(5, '30', '0', 5),
(6, '10', '0', 6),
(7, '20', '0', 7),
(8, '12', '0', 8),
(9, '10', '0', 9),
(10, '20', '0', 10),
(11, '16', '0', 11),
(12, '24', '0', 12),
(13, '10', '0', 13),
(14, '18', '0', 14),
(15, '14', '0', 15),
(16, '15', '0', 16),
(17, '11', '0', 17),
(18, '16', '0', 18),
(19, '17', '0', 19),
(20, '20', '0', 20),
(21, '13', '0', 21),
(22, '19', '0', 22),
(23, '13', '0', 23),
(24, '20', '0', 24),
(25, '20', '0', 25),
(26, '14', '0', 26),
(27, '20', '0', 27),
(28, '18', '0', 28),
(29, '14', '0', 29),
(30, '18', '0', 30),
(31, '10', '0', 31),
(32, '15', '0', 32),
(33, '12', '0', 33),
(34, '13', '0', 34),
(35, '15', '0', 35),
(36, '15', '0', 36),
(37, '15', '0', 37),
(38, '11', '0', 38),
(39, '15', '0', 39),
(40, '15', '0', 40),
(41, '10', '0', 41),
(42, '13', '0', 42),
(43, '10', '0', 43),
(44, '15', '0', 44),
(45, '15', '0', 45),
(46, '11', '0', 46),
(47, '13', '0', 47),
(48, '12', '0', 48),
(49, '12', '0', 49),
(50, '15', '0', 50),
(51, '15', '0', 51),
(52, '10', '0', 52),
(53, '11', '0', 53),
(54, '13', '0', 54),
(55, '12', '0', 55),
(56, '13', '0', 56),
(57, '15', '0', 57),
(58, '15', '0', 58),
(59, '10', '0', 59),
(60, '13', '0', 60),
(61, '13', '0', 61),
(62, '15', '0', 62),
(63, '15', '0', 63),
(64, '15', '0', 64),
(65, '10', '0', 65),
(66, '14', '0', 66),
(67, '10', '0', 67),
(68, '10', '0', 68),
(69, '10', '0', 69),
(70, '10', '0', 70),
(71, '10', '0', 71),
(72, '10', '0', 72),
(73, '10', '0', 73),
(74, '15', '0', 74),
(75, '15', '0', 75),
(76, '0', '0', 76),
(77, '0', '0', 77),
(78, '0', '0', 78),
(79, '0', '0', 79),
(80, '0', '0', 80),
(81, '0', '0', 81),
(82, '0', '0', 82),
(83, '0', '0', 83),
(84, '10', '0', 84),
(85, '10', '0', 85),
(86, '14', '0', 86),
(87, '0', '0', 87),
(88, '0', '0', 88),
(89, '10', '0', 89),
(90, '14', '0', 90),
(91, '10', '0', 91),
(92, '0', '0', 92),
(93, '0', '0', 93),
(94, '0', '0', 94),
(95, '0', '0', 95),
(96, '0', '0', 96),
(97, '0', '0', 97),
(98, '0', '0', 98),
(99, '0', '0', 99),
(100, '0', '0', 100),
(101, '10', '0', 101),
(102, '0', '0', 102),
(103, '0', '0', 103),
(104, '18', '0', 104),
(105, '13', '0', 105),
(106, '17', '0', 106),
(107, '10', '0', 107),
(108, '15', '0', 108),
(109, '15', '0', 109),
(110, '10', '0', 110),
(111, '20', '0', 120),
(112, '10', '0', 125),
(113, '10', '0', 126),
(114, '15', '0', 123),
(115, '15', '0', 121),
(116, '10', '0', 116),
(117, '10', '0', 115),
(118, '10', '0', 113),
(119, '10', '0', 114),
(120, '10', '0', 112),
(121, '10', '0', 122),
(122, '10', '0', 124),
(123, '10', '0', 111);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `note_id` int(5) NOT NULL,
  `note_no` varchar(255) DEFAULT 'ชม 0032.301/',
  `note_emp` varchar(5) DEFAULT NULL,
  `note_list` varchar(255) DEFAULT NULL,
  `note_place` text DEFAULT NULL,
  `note_title` text DEFAULT NULL,
  `note_start` timestamp NULL DEFAULT NULL,
  `note_end` timestamp NULL DEFAULT NULL,
  `note_create` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `p_id` int(5) NOT NULL,
  `permission_name` text DEFAULT NULL,
  `permission_allow` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`p_id`, `permission_name`, `permission_allow`) VALUES
(1, 'Unithead', NULL),
(2, 'Director', NULL),
(3, 'HR', NULL),
(4, 'Administrator', NULL),
(5, 'IT Helpdesk', NULL),
(6, 'Maintenance', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personals`
--

CREATE TABLE `personals` (
  `per_id` int(10) UNSIGNED NOT NULL,
  `dob` date DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `person_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `person_tel` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `person_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personals`
--

INSERT INTO `personals` (`per_id`, `dob`, `email`, `address`, `tel`, `person_name`, `person_tel`, `person_address`, `user_id`) VALUES
(1, '1992-12-18', '', '34/2 ม.6 ต.แม่แตง อ.แม่แตง จ.เชียงใหม่ 50150', '0954502270', 'อารยา เชียงแรง', '0892631170', '34/2 ม.6 ต.แม่แตง อ.แม่แตง จ.เชียงใหม่ 50150', 91),
(2, '1976-12-08', '', '12 หมู่ 2 ต.แม่ลาน้อย อ.แม่ลาน้อย จ.แม่ฮ่องสอน', '0850404075', 'นางสาวนิตย์ มานะเฉิดฉาย', '0826923265', '12 หมู่ 2 ต.แม่ลาน้อย อ.แม่ลาน้อย จ.แม่ฮ่องสอน', 35),
(3, '0001-03-01', '', '', '0810273854', '0636687365', '', '', 36),
(4, '1994-03-31', '', '592 ม.12 ต.ปางหมู อ.เมือง จ.แม่ฮ่องสอน 58000', '0654835060', '', '', '', 0),
(5, '1987-12-21', '', '231  หมู่ 4 ต.บ้านจันทร์ อ.กัลยาณิวัฒนา จ.เชียงใหม่', '0931194064', '', '', '', 0),
(6, '2530-08-05', '', '3 หมู่ 6 ตำบลป่าตัน อำเภอแม่ทะ จังหวัดลำปาง 52150', '080-785103', '', '', '', 0),
(7, '1982-02-06', '', '289/63 หมู่ 3 ต.ดอนแก้ว อ.แม่ริม จ.เชียงใหม่ 50180', '090-232956', '0918890672', 'นายชาตรี  ', '289/63 หมู่ 3 ต.ดอนแก้ว อ.แม่ริม จ.เชียงใหม่ 50180', 38),
(8, '1993-03-16', '', '198 ม. 4 ซ. 9/4 ต. ป่าสัก อ.เมือง จ. ลำพูน 51000', '0636658936', 'นางพรพิมล คำสาร', '0650099495', '198 ม. 4 ซ. 9/4 ต. ป่าสัก อ.เมือง จ. ลำพูน 51000', 92),
(9, '1992-09-06', '', '211 หมู่4 ต.บ้านจันทร์ อ.กัลยาณิวัฒนา จ.เชียงใหม่ 58130', '0979942414', '0624941302', '', '', 83),
(10, '1989-12-20', '', '193/68 หมู่ 4 หมู่บ้านกุลพันธ์วิลล์ 7 ต.แม่เหียะ อ.เมือง จ.เชียงใหม่ 50100', '0857055534', '0819506601', '0818834488', '193/68 หมู่ 4 หมู่บ้านกุลพันธ์วิลล์ 7 ต.แม่เหียะ อ.เมือง จ.เชียงใหม่ 50100', 18),
(11, '1985-03-13', '', '361 ม.4 ต.บ้านจันทร์ อ.กัลยาณิวัฒนา จ.เชียงใหม่ 58130', '0833199375', 'นส.ศิริรัตน์ ลอแฮ', '0884046399', '361 ม.4 ต.บ้านจันทร์ อ.กัลยาณิวัฒนา จ.เชียงใหม่ 58130', 17),
(12, '2531-10-14', '', '7 ม.3 ต.ต้นธง อ.เมือง จ.ลำพูน 51000', '0622690566', 'นางณัติยาภรณ์ กมลธง', '0972384533', '7 ม.3 ต.ต้นธง อ.เมือง จ.ลำพูน 51000', 22),
(13, '1993-11-27', '', '44/3 ห.1 ต.บ่อแก้ว อ.สะเมิง จ.เชียงใหม่ 50250', '090-464824', 'บุญยืน พิทยาการนุรัตน์', '086-194203', '44/3 ห.1 ต.บ่อแก้ว อ.สะเมิง จ.เชียงใหม่ 50250', 25),
(14, '1986-07-21', '', '94 ม.3 ต.บ้านจันทร์ อ.กัลยาณิวัฒนา จ.เชียงใหม่ 58130', '0931692328', '', '', '', 63),
(15, '1991-08-08', '', '90/3 หมู่ 5 ต.น้ำดิบ อ.ป่าซาง จ.ลำพูน', '0837659329', 'รัชนีย์ เสาร์แก้ว', '0835535335', '90/3 หมู่ 5 ต.น้ำดิบ อ.ป่าซาง จ.ลำพูน', 23),
(16, '0000-00-00', '', '', '', '0884134676', '', '', 56),
(17, '1986-06-11', '', '129 ม.14 ต.ไกรใน อ.กงไกรลาศ จ.สุโขทัย 64170', '0925410195', '-', '-', '-', 6),
(18, '0000-00-00', '', '', '0821846850', '', '', '', 65);

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE `places` (
  `place_id` int(11) NOT NULL,
  `place_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`place_id`, `place_name`) VALUES
(1, 'ห้องบริหาร'),
(2, 'หอผู้ป่วยใน (อาคารพระราชทาน ๒๐)'),
(3, 'ผู้ป่วยนอก (อาคารผู้ป่วยนอก)'),
(4, 'ห้องอุบัติเหตุ และฉุกเฉิน (ER)'),
(5, 'ห้องชันสูตร (LAB)'),
(6, 'ห้องรังสีเทคนิค (X-RAY)'),
(7, 'ห้องกลุ่มงานปฐมภูมิและองค์รวม'),
(8, 'คลินิก (PCU)'),
(9, 'ห้องตรวจ 1 (อาคารผู้ป่วยนอก)'),
(10, 'ห้องตรวจ 2 (อาคารผู้ป่วยนอก)'),
(11, 'ห้องตรวจ 3 (อาคารผู้ป่วยนอก)'),
(12, 'อาคารแผนไทย / กายภาพ');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `barcode` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department` int(5) DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work_start` date DEFAULT NULL,
  `work_end` date DEFAULT NULL,
  `work_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `line_token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission` int(5) DEFAULT NULL,
  `img` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `barcode`, `name`, `department`, `position`, `job`, `work_start`, `work_end`, `work_status`, `line_token`, `unit`, `email`, `email_verified_at`, `password`, `permission`, `img`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'D011-H001', 'ประจินต์  เหล่าเที่ยง', 11, 'นายแพทย์', '1', '2093-04-01', NULL, '1', 'rJeUj5NcPslNXbv6sE8x2KMKXdbkyyfba2kNebCcyub', '1', 'pj18800@gmail.com', NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', 2, NULL, NULL, NULL, NULL),
(2, 'D011-H002', 'พลอย  ใจทอง', 11, 'นายแพทย์', '1', '2018-06-01', NULL, '2', NULL, '1', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(3, 'D011-H003', 'นัฐยา  กิติกูล', 11, 'นายแพทย์', '1', '2018-06-01', NULL, '1', NULL, '1', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(4, 'D009-H001', 'กาญจนา ตั้งต่อสุจริต', 9, 'พยาบาลวิชาชีพ', '1', '2009-12-21', NULL, '1', 'hC5WtDnNJ9yHmnX5HA9W0tFzNYisgOyGd6RILpiZouT', '1', 'aoykanjana999@gmail.com', NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', 1, NULL, NULL, NULL, NULL),
(5, 'D003-H001', 'อโณทัย  เหล่าเที่ยง', 3, 'พยาบาลวิชาชีพ', '1', '2018-08-01', NULL, '1', 'ksLUvoowkORKxVUsixQxVK9bwK1kls8o47vuQjVwqmi', '1', 'phupha14@gmail.com', NULL, '$2y$10$L5bV7TJDkIolyYp0nxEXJekYpSf6zl.A6YBx5xfn9flaPcq3nhPUy', 1, NULL, NULL, NULL, NULL),
(6, 'D009-H002', 'จิรัฏฐ์ ไกรกิจราษฎร์', 9, 'พยาบาลวิชาชีพชำนาญการ', '1', '2014-08-19', NULL, '1', NULL, '4', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(7, 'D009-H003', 'รัตติกาล สาธุเม', 9, 'พยาบาลวิชาชีพ', '1', '2015-11-16', NULL, '1', NULL, '4', NULL, NULL, '$2y$10$B54yFAvtFjBWdKbAAHhDS.6lgs.L4P3aiKLjHhNAjBB885K1SVjUK', NULL, NULL, NULL, NULL, NULL),
(8, 'D009-H004', 'ศิริรัตน์ ลอแฮ', 9, 'พยาบาลวิชาชีพ', '1', '2014-08-29', NULL, '1', NULL, '4', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(9, 'D003-H007', 'วิวัฒน์ คีรีรัตน์กมล', 9, 'พยาบาลวิชาชีพ', '1', '2008-07-25', NULL, '2', NULL, '4', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(10, 'D003-H008', 'ศันสนีย์ สุปัญญาวิโรจน์', 3, 'พยาบาลวิชาชีพ', '1', '2016-06-01', NULL, '1', NULL, '5', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(11, 'D009-H005', 'เพชร โชคนิรมิตร', 9, 'พยาบาลวิชาชีพ', '1', '2016-09-15', NULL, '1', NULL, '4', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(12, 'D005-H001', 'ณัฐพร ศศิฉาย', 5, 'เภสัชกร', '1', '2006-12-01', NULL, '1', '7ocum8rDs8Gc9uJN5RdowJO7KMiOtc64oVc1IQ0spx5', '1', 'jan_phar@hotmail.com', NULL, '$2y$10$EjcNKZbD23EdYr9qUZkhhehayjXZn6qG4L0Gf8vcK5TVDaQzZvYFW', 1, NULL, NULL, NULL, NULL),
(13, 'D005-H004', 'อนุสรณ์ แสนอินต๊ะ', 5, 'เจ้าพนักงานเภสัชกรรม', '1', '2011-05-02', NULL, '1', NULL, '12', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(14, 'D005-H002', 'ศุภลักษณ์ รักชาติ', 5, 'เภสัชกร', '1', '2013-04-01', NULL, '1', NULL, '12', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(15, 'D007-H001', 'จิมาดา ศักยเศกสกุล', 7, 'เจ้าพนักงานวิทยาศาสตร์การแพทย์', '1', '2017-07-11', NULL, '1', 'qgTCyCsmWZ8Xz3seD5qHfRDVxPth4nxPVS9lBcDi33Y', '1', 'sriwantawong99@gmail.com', NULL, '$2y$10$sOyvqGv/2NCNRIhFpdek5uP3W4LtIA5ipUMU9LUUtaqfCM73GBXUa', 1, NULL, NULL, NULL, NULL),
(16, 'D006-H001', 'เพ็ญพิสุทธิ์ พุทธโกษา', 6, 'ทันตแพทย์', '1', '2014-04-01', NULL, '1', '2SgUdEnHNgDVU4AoAo45kLr68xecZXFeB52Y2X2VzwN', '1', 'budakosar1234@gmail.com', NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', 1, NULL, NULL, NULL, NULL),
(17, 'D006-H004', 'พฤติพงษ์ รัตนย่อมงามดี', 6, 'เจ้าพนักงานทันตสาธารณสุข', '1', '2011-01-04', NULL, '1', NULL, '16', NULL, NULL, '$2y$10$2o99IL3B320o/OmfqJsFh.dEhThdjxr/Ij8wAOouJU96x4NesxKyW', NULL, NULL, NULL, NULL, NULL),
(18, 'D006-H003', 'วิมลรัตน์ โตโพธิ์ไทย', 6, 'ทันตแพทย์', '1', '2014-04-01', NULL, '1', NULL, '16', NULL, NULL, '$2y$10$./.oiZzcg/73VRu0d7M82OtyVwXvDVdvc/F/8TO669YjPyTgx.Lia', NULL, NULL, NULL, NULL, NULL),
(19, 'D001-H001', 'ธิดา ยิ่งสินสัมพันธ์', 1, 'แพทย์แผนไทย', '1', '2014-08-29', NULL, '1', 'f0x22EdCQRWOzYWSZduRRGWWhlVJ3ctTWcczpkn59oR', '1', '4717nueng@gmail.com', NULL, '$2y$10$b.CnKLrhY4Hdq3hKNI7ma.d6hW8QvwAtcVuC9QCGGMhWaehM3L1pO', 1, NULL, NULL, NULL, NULL),
(20, 'D003-H003', 'วรรณลี ปัญญา', 3, 'นักวิชาการสาธารณสุข', '1', '2017-01-11', NULL, '1', NULL, '5', NULL, NULL, '$2y$10$sZHdP3T38W1dNCHs9b69Nef5s7FliLPAsMtETdYDbENrlgsVXhwVq', NULL, NULL, NULL, NULL, NULL),
(21, 'D003-H004', 'นิราช นอรัตน์', 3, 'นักวิชาการสาธารณสุขปฏิบัติการ', '1', '2016-10-03', NULL, '2', NULL, '5', NULL, NULL, '$2y$10$0GR5XDrPLPw0wsgMJ56rRezF9WQpckEJEqrnDr0540Bh8iQi1EFmK', NULL, NULL, NULL, NULL, NULL),
(22, 'D002-H001', 'สุจิตรา กมลธง', 2, 'นักกายภาพบำบัด', '1', '2016-12-30', NULL, '1', 'NikHRPuHPb6lwDGeUO9Qg79gydvqFde3wP4X0NQ7sQX', '1', 'k.suchitra293@gmail.com', NULL, '$2y$10$0g8xyO/wu01EAGPXjpft3uKNjYivuSNxH8R3vsyQKIOyiybuM6CeC', NULL, NULL, NULL, NULL, NULL),
(23, 'D004-H001', 'สุพัตรา เสาร์แก้ว', 4, 'นักรังสีการแพทย์', '1', '2016-12-30', NULL, '1', 'QS7xp360Lsyg8yBspWDZKZLtzpLwnOoZwDW6OljalP0', '1', 'forever-tan@hotmail.com', NULL, '$2y$10$kZPae2xLYk0s9EV68U4Z8uOzBYq0FNsu0YJOYtVZCGdUVaD3XDNiu', NULL, NULL, NULL, NULL, NULL),
(24, 'D010-H001', 'กรรณิการ์ กันทคำ', 10, 'นักจัดการงานทั่วไป', '1', '2017-04-27', NULL, '2', '3vciqQOz0MVKGdmA4AyRPg066zgPwyj3eJxPsgIxAkT', NULL, 'kannikakm9@gmail.com', NULL, '$2y$10$9cDYW1ZJWB8FDfCgP5lXnOxGEPiKq4HLlJQRX3SBPRQQcwwUzhEgG', NULL, NULL, NULL, NULL, NULL),
(25, 'D008-H004', 'วนิดา พิทยาการนุรัตน์', 8, 'เจ้าพนักงานเวชสถิติ', '1', '2017-06-30', NULL, '1', NULL, '35', NULL, NULL, '$2y$10$0yRcRn133MtZcU/AwEOuzuhiUZ7HHsLm/t1sseA0nADIG04UTqdau', NULL, NULL, NULL, NULL, NULL),
(26, 'D009-H006', 'พรพิดา  คำสา', 9, 'พยาบาลวิชาชีพ', '1', '2017-09-01', NULL, '1', NULL, '4', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(27, 'D003-H009', 'อริยภา  สิทธิศักดิ์', 3, 'พยาบาลวิชาชีพ', '1', '2017-09-01', NULL, '1', NULL, '5', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(28, 'D009-H022', 'อรพินท์  สุธรรม', 9, 'เจ้าพนักงานสาธารณสุข(เวชกิจฉุกเฉิน)', '1', '2017-09-28', NULL, '1', NULL, '4', NULL, NULL, '$2y$10$ehHwzEplOXgOB3VKgIjo7.riEotYCOlB3Ea9f4SUDsMqaWfeAr0/K', NULL, NULL, NULL, NULL, NULL),
(29, 'D003-H010', 'พนาวรรณ กลิ่นอบ', 3, 'พยาบาลวิชาชีพ', '1', '2018-08-31', NULL, '1', NULL, '5', NULL, NULL, '$2y$10$O2v3NX/FugZDoThRu6zu2.x74ga6HBFFLTjT5O7YMWqndZZaiu09S', NULL, NULL, NULL, NULL, NULL),
(30, 'D010-H031', 'ทัศนีย์ ฤทัยปราโมทย์', 10, 'เจ้าพนักงานการเงินและบัญชี', '1', '2018-10-02', NULL, '1', 'I4Vs0VZ7GzW1HzvAKwVD6DdcEXuHiIfiqu1QVdFjJRC', '1', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', 1, NULL, NULL, NULL, NULL),
(31, 'D009-H012', 'กรกฎ จอมอิ่น', 9, 'พนักงานช่วยเหลือคนไข้', '2', '2009-01-05', NULL, '1', NULL, '4', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(32, 'D008-H006', 'จันทร์ดา เมธาประภาส', 8, 'พนักงานช่วยเหลือคนไข้', '2', '2008-01-03', NULL, '1', NULL, '35', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(33, 'D009-H021', 'สุพัตรา จินาคำ', 9, 'พนักงานช่วยเหลือคนไข้', '2', '2008-01-28', NULL, '1', NULL, '4', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(34, 'D009-H013', 'ธีรพร ลิทู', 9, 'พนักงานช่วยเหลือคนไข้', '2', '2009-06-01', NULL, '1', NULL, '4', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(35, 'D008-H001', 'พัชรินทร์ มานะเฉิดฉาย', 8, 'เจ้าพนักงานพัสดุ', '2', '2014-03-03', NULL, '1', 'IwLt940W6WN4NbjGSguvlgdtADxhjfdKMvYNYhHkzRT', '1', 'dadajung850@gmail.com', NULL, '$2y$10$4R13N5m2L3LRMlLPtvUxoONqP4W/hPVa1CEWqW1VbYlHSvxB6F6iW', 1, NULL, NULL, NULL, NULL),
(36, 'D010-H030', 'รวีพร สันติชัยชาญ', 10, 'เจ้าพนักงานธุรการ', '2', '2007-11-19', NULL, '1', NULL, '30', NULL, NULL, '$2y$10$z7vOyzvDG3S2c/aP.QHXSOJhdyd6.GotfcrKykgZHpK5xEUKBFeuy', NULL, NULL, NULL, NULL, NULL),
(37, 'D010-H026', 'วาสนา พนาสมบูรณ์ผล', 10, 'นักวิชาการเงินและบัญชี', '2', '2008-02-18', NULL, '1', NULL, '30', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(38, 'D010-H028', 'ศิริพรรณ นาชัยเวียง', 10, 'นักจัดการงานทั่วไป', '2', '2009-08-03', NULL, '1', NULL, '30', NULL, NULL, '$2y$10$1a/LuelSlN4oYKrU/DOoYOzxmO1c5/ktNuYJM/a8BdUowZDyNDgkW', NULL, NULL, NULL, NULL, NULL),
(39, 'D010-H024', 'สิทธิศักดิ์ บรมสิน', 10, 'นายช่างเทคนิค', '2', '2007-11-19', NULL, '1', NULL, '30', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(40, 'D010-H027', 'สุพรรษา ใจติขะ', 10, 'นักวิชาการเงินและบัญชี', '2', '2015-09-19', NULL, '1', NULL, '30', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(41, 'D003-H005', 'ปัทมาภรณ์ หินเพ็ชร', 3, 'นักวิชาการสาธารณสุข', '1', '2017-04-03', NULL, '1', NULL, '5', NULL, NULL, '$2y$10$giO5mTr/GGb0u.pAViLSbePWb90WCv3miPWsHtNSQkBFNAAu9fWt.', NULL, NULL, NULL, NULL, NULL),
(42, 'D010-H025', 'อภิชญา อภิบูลย์', 10, 'นักวิชาการพัสดุ', '2', '2018-06-08', NULL, '2', NULL, '30', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(43, 'D010-H018', 'อิทธิพล ดำรงธรรม', 10, 'พนักงานบริการ(พนักงานขับรถยนต์)', '3', '2007-11-19', NULL, '1', NULL, '30', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(44, 'D010-H019', 'บุทอง พิทักษ์ภูมิลำเนา', 10, 'พนักงานบริการ(พนักงานขับรถยนต์)', '3', '2010-06-01', NULL, '1', NULL, '30', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(45, 'D010-H020', 'นวพล ศรีสกุลคีรี', 10, 'พนักงานบริการ(พนักงานขับรถยนต์)', '3', '2011-04-01', NULL, '1', NULL, '30', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(46, 'D010-H004', 'ประชา พนาสมบูรณ์ผล', 10, 'พนักงานบริการ(พนักงานรักษาความปลอดภัย)', '3', '2007-11-19', NULL, '1', NULL, '30', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(47, 'D010-H005', 'พิชิต วนาเลิศ', 10, 'พนักงานบริการ(พนักงานรักษาความปลอดภัย)', '3', '2007-11-19', NULL, '1', NULL, '30', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(48, 'D010-H006', 'กำธร กงมะลิ', 10, 'พนักงาบริการ(พนักงานรักษาความปลอดภัย)', '3', '2007-12-20', NULL, '1', NULL, '30', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(49, 'D010-H023', 'จ่งวา  เมธาประภาส', 10, 'พนักงานเกษตรพื้นฐาน', '3', '2007-12-11', NULL, '1', NULL, '30', NULL, NULL, '$2y$10$K78FYbngIl/szmcojeJbQ.0/5L7Vyhp2zNvf8wrKY.Uj5ZVw9XBpO', NULL, NULL, NULL, NULL, NULL),
(50, 'D010-H033', 'วินิตา กมลดีเยี่ยม', 10, 'พนักงานประจำห้องครัว', '3', '2009-04-23', NULL, '1', NULL, '30', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(51, 'D010-H029', 'นฤมล พรดีเลิศ', 10, 'เจ้าพนักงานพัสดุ', '3', '2008-12-01', NULL, '1', NULL, '30', NULL, NULL, '$2y$10$RD1Qd.y8s/t5nBaOpw8hVuVZ6gEs9DGMzEUVIprhMioPn/8U1fxwe', NULL, NULL, NULL, NULL, NULL),
(52, 'D009-H014', 'อานี ฐานทิพย์', 9, 'พนักงานซักฟอก', '3', '2008-02-11', NULL, '1', NULL, '4', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(53, 'D009-H015', 'ฝนทิพย์ จรูญเกษมกุล', 9, 'พนักงานช่วยเหลือคนไข้', '3', '2007-12-03', NULL, '1', NULL, '4', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(54, 'D009-H016', 'ฐิติรัตน์ พงษ์น้อยไพรงาม', 9, 'พนักงานช่วยเหลือคนไข้', '3', '2008-01-02', NULL, '1', NULL, '4', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(55, 'D009-H017', 'จันทรา คงความซื่อ', 9, 'พนักงานช่วยเหลือคนไข้', '3', '2007-12-03', NULL, '1', NULL, '4', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(56, 'D003-H014', 'จิรพงษ์ ต่าสินิ', 3, 'พนักงานช่วยเหลือคนไข้', '3', '2009-07-21', NULL, '1', NULL, '5', NULL, NULL, '$2y$10$otzzmuy5rYeR1YHCP4fR/OrCIMB3paWBEe7t5ZJ4XmqFMNHJjEFha', NULL, NULL, NULL, NULL, NULL),
(57, 'D009-H018', 'ศศิธร สนวิเศษณ์', 9, 'พนักงานช่วยเหลือคนไข้', '3', '2012-10-15', NULL, '1', NULL, '4', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(58, 'D009-H019', 'วรรณี สุริยมลฑล', 9, 'พนักงานช่วยเหลือคนไข้', '3', '2012-10-15', NULL, '1', NULL, '4', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(59, 'D002-H002', 'ศิรินภา ฮ้าวเครือ', 2, 'นักกายภาพบำบัด', '1', '2013-08-01', NULL, '1', NULL, '22', NULL, NULL, '$2y$10$h1FbYOqBF53KdFOAGlO4GODmEMdr8k8f8hixMtAGs.lYwjll31rDW', NULL, NULL, NULL, NULL, NULL),
(60, 'D001-H002', 'ธาราทิพย์ พงศ์วารีรักษ์', 1, 'พนักงานช่วยการพยาบาล', '3', '2009-05-15', NULL, '1', NULL, '19', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(61, 'D001-H003', 'พิมล เขตปราการไทย', 1, 'พนักงานช่วยการพยาบาล', '3', '2010-10-01', NULL, '1', NULL, '19', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(62, 'D006-H005', 'ประภาพันธ์ คุณนิธิกรกุล', 6, 'ผู้ช่วยทันตแพทย์', '3', '2008-11-01', NULL, '1', NULL, '16', NULL, NULL, '$2y$10$kkIcN6WRMz.tcp/nCQIf6ui8AJ51RlCFMt9Fuw9j.ZBqhOE.8mcKy', NULL, NULL, NULL, NULL, NULL),
(63, 'D008-H005', 'นิเทศน์ จรูญเกษมกุล', 8, 'เจ้าพนักงานเครื่องคอมพิวเตอร์', '3', '2010-02-01', NULL, '1', NULL, '35', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(64, 'D005-H003', 'ศริญญา ยิ่งสินสุวัฒน์', 5, 'พนักงานประจำห้องยา', '3', '2007-12-03', NULL, '1', NULL, '12', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(65, 'D005-H005', 'พัชรี ลอแฮ', 5, 'เจ้าพนักงานเภสัชกรรม', '1', '2013-08-01', NULL, '1', NULL, '12', NULL, NULL, '$2y$10$11k3Wh5beI6teedoTb5.oO.9AF4ho2OGQ4DDQ6iUQKfQggqt4.egS', NULL, NULL, NULL, NULL, NULL),
(66, 'D004-H002', 'ฤาชัย วิเชอ', 4, 'พนักงานบริการ', '3', '2007-12-03', NULL, '1', NULL, '23', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(67, 'D003-H006', 'วิรัตน์ ซอระสี', 3, 'นักวิชาการสาธารณสุข', '3', '2017-02-01', NULL, '2', NULL, '5', NULL, NULL, '$2y$10$aM3s7/puRpFdCQ8P4wrSZeIl746D5gKlN2NVe9JoXt.Gt.Vqt1iNi', NULL, NULL, NULL, NULL, NULL),
(68, 'D009-H007', 'อาฐิฏิภัณฑ์ โชติฐานนนท์', 9, 'พยาบาลวิชาชีพ', '3', '2017-05-01', NULL, '2', NULL, '4', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(69, 'D009-H008', 'ปรียา   แสงสุรินทร์', 9, 'พยาบาลวิชาชีพ', '4', '2017-08-01', NULL, '2', NULL, '4', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(70, 'D003-H011', 'วิษณุพงษ์ ตระการศุภกร', 9, 'พยาบาลวิชาชีพ', '2', '2016-09-01', NULL, '2', NULL, '4', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(71, 'D009-H009', 'ปรานอม คำหวาย', 9, 'พยาบาลวิชาชีพ', '1', '2017-06-01', NULL, '1', NULL, '4', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(72, 'D009-H010', 'ฐิตินันท์ แสงน้อย', 9, 'พยาบาลวิชาชีพ', '1', '2017-06-01', NULL, '1', NULL, '4', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(73, 'D009-H011', 'กัลยาณี ไชยเทพ', 9, 'พยาบาลวิชาชีพ', '1', '2017-06-01', NULL, '1', NULL, '4', NULL, NULL, '$2y$10$Inx3CbaEc1FmGanBsZCTzu6ikCFCnyAceljK0T7SBcelUoBJgb66e', NULL, NULL, NULL, NULL, NULL),
(74, 'D010-H021', 'ชุมพล ทิศทิพย์', 10, 'พนักงานบริการ(พนักงานขับรถยนต์)', '3', '2017-01-04', NULL, '1', NULL, '30', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(75, 'D010-H032', 'อังคณา  วิเวกวนารมณ์', 10, 'เจ้าพนักงานการเงินและบัญชี', '3', '2016-09-15', NULL, '1', NULL, '30', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(76, 'D010-H013', 'เอเซ่ ดีโชคชัย', 10, 'พนักงานดูแลสวนและสนามหญ้า', '5', '2014-10-01', NULL, '1', NULL, '30', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(77, 'D010-H014', 'ลาพอ ดีโชคชัย', 10, 'พนักงานดูแลสวนและสนามหญ้า', '5', '2014-10-01', NULL, '1', NULL, '30', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(78, 'D010-H015', 'ฤทธิ์รอน มาลีชาวไพร', 10, 'พนักงานดูแลสวนและสนามหญ้า', '5', '2014-10-01', NULL, '1', NULL, '30', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(79, 'D010-H016', 'สีทอง เกษมวิริยะเลิศ', 10, 'พนักงานดูแลสวนและสนามหญ้า', '5', '2014-10-01', NULL, '1', NULL, '30', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(80, 'D010-H007', 'ศรุดา วงศ์ตุ่น', 10, 'พนักงานบริการ', '5', '2018-05-01', NULL, '2', NULL, '30', NULL, NULL, '$2y$10$kQdcBhW7rzrtedlNYQI8JexhaS/hq..FaGJxePpNmFDAAA00fxF8i', NULL, NULL, NULL, NULL, NULL),
(81, 'D008-H002', 'เกียรติศักดิ์ เด่นแสงจันทร์', 8, 'พนักงานเครื่องคอมพิวเตอร์', '5', NULL, NULL, '1', NULL, '35', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(82, 'D003-H002', 'ปิยะรัตน์ ปิติจันทร์', 3, 'พนักงานประจำห้องเวชปฏิบัติ ครอบครัว และชุมชน', '5', NULL, NULL, '1', NULL, '5', NULL, NULL, '$2y$10$TnkEMFYiB0myqxS6wB6mYukHblLXH3UlptxhutFeV./7bjiEbKPA2', NULL, NULL, NULL, NULL, NULL),
(83, 'D006-H002', 'ศศิกานต์ เกรียงไกรสโมสร', 6, 'พนักงานประจำห้องฟัน', '5', '2555-01-09', NULL, '1', NULL, '16', NULL, NULL, '$2y$10$W7.3uq.sCfQuU.7mWaRZDebLhO8lILqIMRGKxYpXyzAaLYvjITMAC', NULL, NULL, NULL, NULL, NULL),
(84, 'D003-H012', 'พรจินดา ภิญโญภาพพงษ์', 3, 'พยาบาลวิชาชีพ', '1', '2018-01-03', NULL, '1', NULL, '5', NULL, NULL, '$2y$10$YalVL9wQWaxoDphBTf6IY.9.Now24u4ipf.M.XuP/763EzO3K.tx.', NULL, NULL, NULL, NULL, NULL),
(85, 'D003-H013', 'สุภาภรณ์ อร่ามคีรีไพร', 3, 'พยาบาลวิชาชีพ', '1', '2018-10-29', NULL, '1', NULL, '5', NULL, NULL, '$2y$10$n067t80iQxnPCZjcOUhVW.RXb1MuXNnmk57eEWirJo3sAUiT5MTH2', NULL, NULL, NULL, NULL, NULL),
(86, 'D001-H004', 'จุฬาลักษณ์ วิเศษคุณ', 1, 'แพทย์แผนไทย', '3', '2018-10-29', NULL, '1', NULL, '19', NULL, NULL, '$2y$10$/c7aTa6dO7bx0mXZsApRb.xb5GESb5UrNflclfHTlxpGvaY/gZSCq', NULL, NULL, NULL, NULL, NULL),
(87, 'D010-H008', 'ผกาพร ชัยมังกร', 10, 'พนักงานทำความสะอาด', '5', '2018-10-01', NULL, '1', NULL, '30', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(88, 'D010-H009', 'วีพร  ลอพอ', 10, 'พนักงานทำความสะอาด', '5', '2018-10-01', NULL, '1', NULL, '30', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(89, 'D010-H010', 'อริศา พิทักษ์ภูมิลำเนา', 10, 'พนักงานทำความสะอาด', '5', NULL, NULL, '2', NULL, '24', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(90, 'D010-H034', 'กมลวรรณ สืบแสน', 10, 'นักโภชนาการ', '2', '2562-02-01', NULL, '2', NULL, '24', NULL, NULL, '$2y$10$sx.AgQgoKsqQs0ffKwLosOagv6bVstvMYIFdPXX9IPp5WnTBwEu36', NULL, NULL, NULL, NULL, NULL),
(91, 'D008-H003', 'ศติญา เชียงแรง', 8, 'นักวิชาการคอมพิวเตอร์', '1', '2019-08-24', NULL, '1', NULL, '35', NULL, NULL, '$2y$10$6OxGfiLz1R2.9n.RpRFQ2ehpNCVgah7Yr76h3Cj3FZXLZ0lIn0PaS', 4, 'D008-H003.jpg', 'yaHOHi6kph1nM4j4JlK7NbCUxiTCv8DXnKnJPg1OwpqtNmdfgRYzwG05GA7o', NULL, NULL),
(92, 'D007-H002', 'ภัทราภรณ์  คำสาร', 7, 'นักเทคนิคการแพทย์', '5', '2018-12-03', NULL, '1', NULL, '15', NULL, NULL, '$2y$10$BRqt/i9pABkccFOrinQjJe8eNy.Hyx/rrNKIJ7XRM5h2rmi4qUuUu', NULL, NULL, NULL, NULL, NULL),
(93, 'D010-H017', 'ธีรพงษ์ อินเนอละ', 10, 'พนักงานดูแลสวนและสนามหญ้า', '5', '2018-12-03', NULL, '2', NULL, '24', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(94, 'D010-H022', 'ณรงค์ฤทธิ์ เวนวล', 10, 'พนักงานบริการ (พนักงานขับรถยนต์)', '5', '2018-12-03', NULL, '1', NULL, '24', NULL, NULL, '$2y$10$mGjLc/mfUr5/m/kbD9eap.I1hrbQ9fv2B1mqu6TFwB7XA3AJBF1NC', NULL, NULL, NULL, NULL, NULL),
(95, 'D007-H003', 'วิไล จงจิตรเสรี', 7, 'พนักงานช่วยเหลือคนไข้', '5', '2018-12-03', NULL, '1', NULL, '15', NULL, NULL, '$2y$10$OecbRaGtLTJK9.NgTQr1oOos/OJFhIafeB4iyyBb0TxPt1wnEcSKG', NULL, NULL, NULL, NULL, NULL),
(96, 'D009-H020', 'นันฐิณี พงษ์น้อยไพรงาม', 9, 'พนักงานช่วยเหลือคนไข้', '5', '2018-12-03', NULL, '1', NULL, '4', NULL, NULL, '$2y$10$uMjdgQc5s8SOgzE9CQds2ePPhGr0H2raA2SZjN.ETfvreVJUGq.kC', NULL, NULL, NULL, NULL, NULL),
(97, 'D010-H011', 'สุทธิพร พนาสมบูรณ์ผล', 10, 'พนักงานทำความสะอาด', '5', '2018-12-03', NULL, '1', NULL, '24', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(98, 'D010-H012', 'สิริพร โกมลสายชล', 10, 'พนักงานทำความสะอาด', '5', '2018-12-03', NULL, '1', NULL, '24', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(99, 'D010-H002', 'วริยา ธรรมสามิสร', 10, 'พนักงานร้านกาแฟ', '5', '2018-12-03', NULL, '2', NULL, '24', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(100, 'D010-H003', 'ชบา ชุ่มอรัญสายวารี', 10, 'พนักงานร้านกาแฟ', '5', '2019-03-01', NULL, '1', NULL, '24', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(101, 'D009-H025', 'พิมฤดี จตุรพักตร์คีรี', 9, 'พยาบาลวิชาชีพ', '1', '2019-06-04', NULL, '1', NULL, '4', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(102, 'D010-H035', 'สายรุ้ง ไพรสิทธิฤทธิ์', 10, 'พนักงานทำความสะอาด', '5', '2019-09-02', NULL, '1', NULL, '24', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(103, 'D009-H023', 'เทียนชัย สิริภัทรตระกูล', 9, 'พนักงานช่วยเหลือคนไข้', '5', '2019-09-02', NULL, '1', NULL, '4', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(104, 'D011-H004', 'ชิตวัน ฝั้นชมภู', 11, 'นายแพทย์', '1', '2018-05-16', NULL, '2', NULL, '1', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(105, 'D007-H004', 'รังสินิจ นันทวิเชียร', 7, 'นักเทคนิคการแพทย์', '1', '2019-08-01', NULL, '2', NULL, '15', NULL, NULL, '$2y$10$5wp39bj/m3fFwj3DfkS4SufWRRuC25Tee52VweguKpOufHAmW.0j2', NULL, NULL, NULL, NULL, NULL),
(106, 'D009-H026', 'จุฑาธิป  อุตรินทร์', 9, 'พยาบาลวิชาชีพ', '1', '2019-05-31', NULL, '1', NULL, '4', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(107, 'D009-H024', 'ณัฐฌา ต๊ะชู้', 3, 'พยาบาลวิชาชีพ', '1', '2019-05-31', NULL, '1', NULL, '5', NULL, NULL, '$2y$10$xX.FrOKSJ2HrKinE5IKwAebJokXms/UFIuA5gNpnnSnVYY16pli5a', NULL, NULL, NULL, NULL, NULL),
(108, 'D003-H015', 'เจษฎา สุทธิแก้ว', 3, 'นักวิชาการสาธารณสุข', '3', '2009-04-02', NULL, '2', NULL, '5', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(109, 'D010-H036', 'จรัลภัทร เจนธุระกิจ', 10, 'นักวิชาการพัสดุ', '2', '2019-12-02', NULL, '1', NULL, '30', NULL, NULL, '$2y$10$xDseh2kTLEBMTawTBlAYkuzBP8XOSa8VQ9G69Fjh3nCJK9qJ21fxO', NULL, NULL, NULL, NULL, NULL),
(110, 'D009-H027', 'ปาริฉัตร พนะสัน', 9, 'พยาบาลวิชาชีพ', '5', '2019-10-01', NULL, '1', NULL, '4', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(111, 'D010-H037', 'ญดากานต์ แสนสมฤทธิ์', 10, 'นักโภชนาการ', '1', '2020-08-24', NULL, '1', NULL, '24', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(112, 'D009-H034', 'ดาวเรือง ยาแจ๊ะ', 9, 'พยาบาลวิชาชีพ', '3', '2020-06-01', NULL, '1', NULL, '4', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(113, 'D009-H032', 'สุดาพร ไพรลักษณ์', 9, 'พยาบาลวิชาชีพ', '3', '2020-06-01', NULL, '1', NULL, '4', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(114, 'D009-H033', 'เพ็ญพิสุทธิ์ คาโพ', 9, 'พยาบาลวิชาชีพ', '3', '2020-06-01', NULL, '1', NULL, '4', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(115, 'D009-H031', 'จุฑามาศ พรมทา', 9, 'พยาบาลวิชาชีพ', '3', '2020-06-01', NULL, '1', NULL, '4', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(116, 'D009-H030', 'คณาเดช คณากุลสวรรค์', 9, 'พยาบาลวิชาชีพ', '3', '2020-06-01', NULL, '1', NULL, '4', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(117, 'D009-H028', 'พรรณิพา สิงห์ไชย', 9, 'พยาบาลวิชาชีพ', '5', '2020-05-01', NULL, '1', NULL, '4', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(118, 'D009-H029', 'เอกสิทธิ์ สิริพรประภา', 9, 'พยาบาลวิชาชีพ', '5', '2020-05-01', NULL, '1', NULL, '4', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(119, 'D010-H038', 'กุลธวัธ ลาภภพเพิ่มพูน', 10, 'พนักงานบริการ', '5', '2020-06-01', NULL, '1', NULL, '24', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(120, 'D011-H005', 'ชาติชาย เชวงชุติรัตน์', 11, 'นายแพทย์', '1', '2020-06-01', NULL, '1', NULL, '1', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(121, 'D001-H005', 'ศุภิสรา ธาดาพิวัฒน์กุล', 1, 'แพทย์แผนไทย', '3', '2020-05-01', NULL, '1', NULL, '19', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(122, 'D009-H035', 'ชนานันท์ แดงกระจ่าง', 9, 'เวชกิจฉุกเฉิน', '3', '2020-08-03', NULL, '1', NULL, '4', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(123, 'D005-H006', 'ชยกร มงคลสวัสดิ์', 5, 'เภสัชกร', '2', '2020-07-01', NULL, '1', NULL, '12', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(124, 'D001-H006', 'สุชาดา การมั่งมี', 1, 'แพทย์แผนไทย', '1', '2020-08-24', NULL, '1', NULL, '19', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(125, 'D003-H017', 'อุไรวรรณ บริบทคุณธรรม', 3, 'นักวิชาการสาธารณสุข', '3', '2020-08-17', NULL, '1', NULL, '5', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL),
(126, 'D003-H016', 'ทยากร พงษ์ไพรวัน', 3, 'นักวิชาการสาธารณสุข', '3', '2020-08-17', NULL, '1', NULL, '5', NULL, NULL, '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `worktime`
--

CREATE TABLE `worktime` (
  `work_id` int(5) NOT NULL,
  `work_time` datetime DEFAULT NULL,
  `emp_barcode` varchar(255) DEFAULT NULL,
  `work_status` varchar(5) DEFAULT NULL,
  `work_note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `work_status`
--

CREATE TABLE `work_status` (
  `ws_id` int(11) NOT NULL,
  `ws_name` text DEFAULT NULL,
  `ws_icon` text DEFAULT NULL,
  `ws_text` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `work_status`
--

INSERT INTO `work_status` (`ws_id`, `ws_name`, `ws_icon`, `ws_text`) VALUES
(1, 'ทำงาน', 'fa fa-check-circle', 'success'),
(2, 'ย้าย', 'fa fa-sign-out-alt', 'warning');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `helpdesk`
--
ALTER TABLE `helpdesk`
  ADD PRIMARY KEY (`help_id`);

--
-- Indexes for table `helpdesk_rate`
--
ALTER TABLE `helpdesk_rate`
  ADD PRIMARY KEY (`rate_id`);

--
-- Indexes for table `helpdesk_status`
--
ALTER TABLE `helpdesk_status`
  ADD PRIMARY KEY (`hs_id`);

--
-- Indexes for table `helpdesk_type`
--
ALTER TABLE `helpdesk_type`
  ADD PRIMARY KEY (`ht_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `leave_list`
--
ALTER TABLE `leave_list`
  ADD PRIMARY KEY (`leave_id`);

--
-- Indexes for table `leave_num`
--
ALTER TABLE `leave_num`
  ADD PRIMARY KEY (`leave_num_id`);

--
-- Indexes for table `leave_status`
--
ALTER TABLE `leave_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `leave_time`
--
ALTER TABLE `leave_time`
  ADD PRIMARY KEY (`time_id`);

--
-- Indexes for table `leave_type`
--
ALTER TABLE `leave_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `leave_vacation`
--
ALTER TABLE `leave_vacation`
  ADD PRIMARY KEY (`leave_vacation_id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`note_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `personals`
--
ALTER TABLE `personals`
  ADD PRIMARY KEY (`per_id`);

--
-- Indexes for table `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`place_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `worktime`
--
ALTER TABLE `worktime`
  ADD PRIMARY KEY (`work_id`);

--
-- Indexes for table `work_status`
--
ALTER TABLE `work_status`
  ADD PRIMARY KEY (`ws_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `dept_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `helpdesk`
--
ALTER TABLE `helpdesk`
  MODIFY `help_id` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `helpdesk_rate`
--
ALTER TABLE `helpdesk_rate`
  MODIFY `rate_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `helpdesk_status`
--
ALTER TABLE `helpdesk_status`
  MODIFY `hs_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `helpdesk_type`
--
ALTER TABLE `helpdesk_type`
  MODIFY `ht_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `job_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `leave_list`
--
ALTER TABLE `leave_list`
  MODIFY `leave_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `leave_num`
--
ALTER TABLE `leave_num`
  MODIFY `leave_num_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `leave_status`
--
ALTER TABLE `leave_status`
  MODIFY `status_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `leave_time`
--
ALTER TABLE `leave_time`
  MODIFY `time_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `leave_type`
--
ALTER TABLE `leave_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `leave_vacation`
--
ALTER TABLE `leave_vacation`
  MODIFY `leave_vacation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `note_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `p_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personals`
--
ALTER TABLE `personals`
  MODIFY `per_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
  MODIFY `place_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `worktime`
--
ALTER TABLE `worktime`
  MODIFY `work_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `work_status`
--
ALTER TABLE `work_status`
  MODIFY `ws_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
