-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3307
-- Generation Time: Nov 15, 2015 at 12:16 AM
-- Server version: 5.6.25
-- PHP Version: 5.4.43

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `simpatda`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_log`
--

CREATE TABLE IF NOT EXISTS `access_log` (
`id` int(11) NOT NULL,
  `type` int(1) DEFAULT NULL,
  `activity` text,
  `time` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=153 ;

--
-- Dumping data for table `access_log`
--

INSERT INTO `access_log` (`id`, `type`, `activity`, `time`, `user_id`) VALUES
(1, 0, '403 You do not have sufficient permissions to access this page. - Access Page : "/yii_core_app/"', '1431054577', 1),
(2, 0, '403 You do not have sufficient permissions to access this page. - Access Page : "/yii_core_app/"', '1431054580', 1),
(3, 0, '403 You do not have sufficient permissions to access this page. - Access Page : "/yii_core_app/"', '1431054582', 1),
(4, 0, '403 You do not have sufficient permissions to access this page. - Access Page : "/yii_core_app/dashboard"', '1431054583', 1),
(5, 0, '403 You do not have sufficient permissions to access this page. - Access Page : "/yii_core_app/"', '1431054619', 1),
(6, 0, '403 You do not have sufficient permissions to access this page. - Access Page : "/simpatda/"', '1447427864', 1),
(7, 0, '403 You do not have sufficient permissions to access this page. - Access Page : "/simpatda/"', '1447427868', 1),
(8, 0, '403 You do not have sufficient permissions to access this page. - Access Page : "/simpatda/profile/changePhoto"', '1447427973', 1),
(9, 3, 'Manage Operation ', '1447428014', 1),
(10, 0, '403 You do not have sufficient permissions to access this page. - Access Page : "/simpatda/operation/generateAll"', '1447428058', 1),
(11, 2, 'Generated operation.generateAll Operation GenerateAll Success | Generated profile.changePhoto Profile ChangePhoto Success | Generated report.userLog Report UserLog Success | Generated report.userLogForm Report UserLogForm Success | ', '1447428139', 1),
(12, 3, 'Manage Role', '1447428163', 1),
(13, 2, 'Update Role ID : 1', '1447428277', 1),
(14, 2, 'View Role ID : 1', '1447428278', 1),
(15, 3, 'Manage Operation ', '1447428289', 1),
(16, 3, 'Manage Operation ', '1447428304', 1),
(17, 2, 'Delete Operation ID : 25', '1447428310', 1),
(18, 3, 'Manage Operation ', '1447428311', 1),
(19, 2, 'Delete Operation ID : 26', '1447428314', 1),
(20, 3, 'Manage Operation ', '1447428316', 1),
(21, 2, 'Delete Operation ID : 27', '1447428317', 1),
(22, 3, 'Manage Operation ', '1447428318', 1),
(23, 2, 'Delete Operation ID : 28', '1447428320', 1),
(24, 3, 'Manage Operation ', '1447428322', 1),
(25, 2, 'Delete Operation ID : 47', '1447428324', 1),
(26, 3, 'Manage Operation ', '1447428326', 1),
(27, 2, 'Delete Operation ID : 48', '1447428329', 1),
(28, 2, 'Delete Operation ID : 46', '1447428330', 1),
(29, 3, 'Manage Operation ', '1447428332', 1),
(30, 2, 'Delete Operation ID : 29', '1447428333', 1),
(31, 3, 'Manage Operation ', '1447428335', 1),
(32, 2, 'Delete Operation ID : 49', '1447428338', 1),
(33, 3, 'Manage Operation ', '1447428339', 1),
(34, 3, 'Manage Operation ', '1447428344', 1),
(35, 3, 'Manage Operation ', '1447428358', 1),
(36, 2, 'Delete Operation ID : 30', '1447428362', 1),
(37, 3, 'Manage Operation ', '1447428363', 1),
(38, 0, '404 The requested page does not exist. - Access Page : "/simpatda/operation/delete/30?ajax=operation-grid"', '1447428365', 1),
(39, 2, 'Delete Operation ID : 32', '1447428370', 1),
(40, 3, 'Manage Operation ', '1447428371', 1),
(41, 0, '404 The requested page does not exist. - Access Page : "/simpatda/operation/delete/32?ajax=operation-grid"', '1447428373', 1),
(42, 2, 'Delete Operation ID : 34', '1447428377', 1),
(43, 3, 'Manage Operation ', '1447428378', 1),
(44, 2, 'Delete Operation ID : 31', '1447428379', 1),
(45, 3, 'Manage Operation ', '1447428381', 1),
(46, 2, 'Delete Operation ID : 33', '1447428398', 1),
(47, 3, 'Manage Operation ', '1447428399', 1),
(48, 2, 'Delete Operation ID : 50', '1447428401', 1),
(49, 3, 'Manage Operation ', '1447428402', 1),
(50, 3, 'Manage Operation ', '1447428408', 1),
(51, 3, 'Manage Operation ', '1447428431', 1),
(52, 2, 'Delete Operation ID : 35', '1447428438', 1),
(53, 3, 'Manage Operation ', '1447428439', 1),
(54, 2, 'Delete Operation ID : 36', '1447428440', 1),
(55, 2, 'Delete Operation ID : 39', '1447428442', 1),
(56, 3, 'Manage Operation ', '1447428443', 1),
(57, 2, 'Delete Operation ID : 51', '1447428444', 1),
(58, 3, 'Manage Operation ', '1447428447', 1),
(59, 2, 'Delete Operation ID : 40', '1447428448', 1),
(60, 3, 'Manage Operation ', '1447428449', 1),
(61, 2, 'Delete Operation ID : 37', '1447428451', 1),
(62, 3, 'Manage Operation ', '1447428452', 1),
(63, 2, 'Delete Operation ID : 42', '1447428454', 1),
(64, 3, 'Manage Operation ', '1447428456', 1),
(65, 2, 'Delete Operation ID : 38', '1447428458', 1),
(66, 3, 'Manage Operation ', '1447428459', 1),
(67, 0, '404 The requested page does not exist. - Access Page : "/simpatda/operation/delete/38?ajax=operation-grid"', '1447428461', 1),
(68, 2, 'Delete Operation ID : 53', '1447428466', 1),
(69, 3, 'Manage Operation ', '1447428467', 1),
(70, 2, 'Delete Operation ID : 41', '1447428470', 1),
(71, 3, 'Manage Operation ', '1447428471', 1),
(72, 3, 'Manage Operation ', '1447428476', 1),
(73, 2, 'Delete Operation ID : 43', '1447428487', 1),
(74, 3, 'Manage Operation ', '1447428488', 1),
(75, 2, 'Delete Operation ID : 44', '1447428492', 1),
(76, 3, 'Manage Operation ', '1447428493', 1),
(77, 2, 'Delete Operation ID : 45', '1447428503', 1),
(78, 3, 'Manage Operation ', '1447428505', 1),
(79, 3, 'Manage Operation ', '1447428511', 1),
(80, 3, 'Manage Operation ', '1447428529', 1),
(81, 3, 'Manage Operation ', '1447428606', 1),
(82, 3, 'Manage Role', '1447428721', 1),
(83, 3, 'View Profile', '1447428761', 1),
(84, 0, '404 Unable to resolve the request "upload/user/no_image.png". - Access Page : "/simpatda/upload/user/no_image.png"', '1447428762', 1),
(85, 0, '404 Unable to resolve the request "upload/user/no_image.jpg". - Access Page : "/simpatda/upload/user/no_image.jpg"', '1447428765', 1),
(86, 0, '404 Unable to resolve the request "upload/user/no_image.jpg". - Access Page : "/simpatda/upload/user/no_image.jpg"', '1447428769', 1),
(87, 3, 'Image has been changed.', '1447428770', 1),
(88, 3, 'View Profile', '1447428771', 1),
(89, 0, '403 You do not have sufficient permissions to access this page. - Access Page : "/simpatda/dashboard"', '1447428784', 1),
(90, 3, 'View Profile', '1447428793', 1),
(91, 3, 'View Profile', '1447428813', 1),
(92, 3, 'View Profile', '1447428972', 1),
(93, 3, 'View Profile', '1447428981', 1),
(94, 0, '404 The system is unable to find the requested action "download". - Access Page : "/simpatda/accessLog/download/93"', '1447428986', 1),
(95, 3, 'View Profile', '1447428993', 1),
(96, 3, 'View Profile', '1447429064', 1),
(97, 0, '404 Unable to resolve the request "backup". - Access Page : "/simpatda/backup"', '1447429253', 1),
(98, 0, '403 You do not have sufficient permissions to access this page. - Access Page : "/simpatda/backup"', '1447429397', 1),
(99, 3, 'View Profile', '1447429720', 1),
(100, 0, '403 You do not have sufficient permissions to access this page. - Access Page : "/simpatda/backup"', '1447429841', 1),
(101, 3, 'Manage Operation ', '1447429935', 1),
(102, 2, 'Generated backup.default.create Backup Default Create Success | Generated backup.default.delete Backup Default Delete Success | Generated backup.default.download Backup Default Download Success | Generated backup.default.index Backup Default Index Success | Generated backup.default.restore Backup Default Restore Success | Generated backup.default.upload Backup Default Upload Success | Generated translate.edit.create Translate Edit Create Success | Generated translate.edit.update Translate Edit Update Success | Generated translate.edit.delete Translate Edit Delete Success | Generated translate.edit.index Translate Edit Index Success | Generated translate.edit.missing Translate Edit Missing Success | Generated translate.edit.missingdelete Translate Edit Missingdelete Success | Generated translate.translate.index Translate Translate Index Success | ', '1447429989', 1),
(103, 3, 'Manage Role', '1447430030', 1),
(104, 2, 'Update Role ID : 1', '1447430043', 1),
(105, 2, 'View Role ID : 1', '1447430044', 1),
(106, 0, '403 You do not have sufficient permissions to access this page. - Access Page : "/simpatda/"', '1447430051', 1),
(107, 3, 'Manage Operation ', '1447430178', 1),
(108, 3, 'Manage Operation ', '1447430182', 1),
(109, 3, 'Manage Operation ', '1447430228', 1),
(110, 3, 'Manage Operation ', '1447430232', 1),
(111, 0, '403 You do not have sufficient permissions to access this page. - Access Page : "/simpatda/"', '1447430266', 1),
(112, 0, '403 You do not have sufficient permissions to access this page. - Access Page : "/simpatda/"', '1447430270', 1),
(113, 0, '403 You do not have sufficient permissions to access this page. - Access Page : "/simpatda/"', '1447430397', 1),
(114, 2, 'Generated accessLog.download AccessLog Download Success | Generated site.index Site Index Success | ', '1447430424', 1),
(115, 3, 'Manage Role', '1447430430', 1),
(116, 2, 'Update Role ID : 1', '1447430450', 1),
(117, 2, 'View Role ID : 1', '1447430451', 1),
(118, 3, 'User Log Report', '1447431009', 1),
(119, 2, 'Configuration has been changed.', '1447431130', 1),
(120, 2, 'Configuration has been changed.', '1447431175', 1),
(121, 0, '404 Unable to resolve the request "translate/tranlate/index". - Access Page : "/simpatda/translate/tranlate/index"', '1447431665', 1),
(122, 0, '404 Unable to resolve the request "translate/tranlate/index". - Access Page : "/simpatda/translate/tranlate/index"', '1447431880', 1),
(123, 3, 'User Log Report', '1447431911', 1),
(124, 3, 'User Log Report', '1447432091', 1),
(125, 2, 'Configuration has been changed.', '1447432722', 1),
(126, 3, 'User Log Report', '1447433128', 1),
(127, 3, 'User Log Report', '1447433346', 1),
(128, 3, 'User Log Report', '1447433441', 1),
(129, 3, 'View Profile', '1447433448', 1),
(130, 2, 'Configuration has been changed.', '1447456883', 1),
(131, 2, 'Generated jReport.userList JReport UserList Success | Generated jReport.userActivityList JReport UserActivityList Success | ', '1447460640', 1),
(132, 3, 'Manage Role', '1447460649', 1),
(133, 2, 'Update Role ID : 1', '1447460672', 1),
(134, 2, 'View Role ID : 1', '1447460673', 1),
(135, 0, '403 You do not have sufficient permissions to access this page. - Access Page : "/simpatda/jreport/userList"', '1447460710', 1),
(136, 0, 'Caught Exception: An unexpected HTTP status code was returned by the server', '1447460818', 1),
(137, 0, 'Caught Exception: An unexpected HTTP status code was returned by the server', '1447460833', 1),
(138, 0, 'Caught Exception: An unexpected HTTP status code was returned by the server', '1447461064', 1),
(139, 0, 'Caught Exception: An unexpected HTTP status code was returned by the server', '1447461252', 1),
(140, 0, 'Caught Exception: An unexpected HTTP status code was returned by the server', '1447461426', 1),
(141, 0, 'Caught Exception: An unexpected HTTP status code was returned by the server', '1447461602', 1),
(142, 0, 'Caught Exception: An unexpected HTTP status code was returned by the server', '1447461608', 1),
(143, 0, 'Caught Exception: An unexpected HTTP status code was returned by the server', '1447461611', 1),
(144, 0, 'Caught Exception: An unexpected HTTP status code was returned by the server', '1447461620', 1),
(145, 0, 'Caught Exception: An unexpected HTTP status code was returned by the server', '1447461633', 1),
(146, 0, 'Caught Exception: An unexpected HTTP status code was returned by the server', '1447461647', 1),
(147, 0, 'Caught Exception: An unexpected HTTP status code was returned by the server', '1447461692', 1),
(148, 0, 'Caught Exception: An unexpected HTTP status code was returned by the server', '1447461710', 1),
(149, 0, 'Caught Exception: An unexpected HTTP status code was returned by the server', '1447461761', 1),
(150, 0, 'Caught Exception: An unexpected HTTP status code was returned by the server', '1447461803', 1),
(151, 0, 'Caught Exception: An unexpected HTTP status code was returned by the server', '1447462554', 1),
(152, 0, 'Caught Exception: An unexpected HTTP status code was returned by the server', '1447462938', 1);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL DEFAULT '0',
  `language` varchar(16) NOT NULL DEFAULT '',
  `translation` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `operation`
--

CREATE TABLE IF NOT EXISTS `operation` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `nama_modul` varchar(255) NOT NULL,
  `grup` int(11) NOT NULL DEFAULT '1',
  `urutan_ke` int(11) NOT NULL DEFAULT '1',
  `tampilkan_dirole` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=75 ;

--
-- Dumping data for table `operation`
--

INSERT INTO `operation` (`id`, `name`, `description`, `nama_modul`, `grup`, `urutan_ke`, `tampilkan_dirole`) VALUES
(1, 'accessLog.index', 'View Access Log List', 'AccessLog', 1, 1, 1),
(2, 'site.config', 'Setting Site Config', 'Settings', 1, 1, 1),
(3, 'operation.create', 'Create New Operation ', 'Operation', 1, 1, 1),
(4, 'operation.update', 'Update Operation ', 'Operation', 1, 1, 1),
(5, 'operation.delete', 'Delete Operation ', 'Operation', 1, 1, 1),
(6, 'operation.admin', 'Manage All Operation', 'Operation', 1, 1, 1),
(7, 'operation.generate', 'Generate Operation ', 'Operation', 1, 1, 1),
(8, 'profile.profile', 'View Own Profile', 'Profile', 1, 1, 1),
(9, 'profile.edit', 'Edit Own Profile ', 'Profile', 1, 1, 1),
(10, 'profile.changepassword', 'Change Own Password', 'Profile', 1, 1, 1),
(11, 'role.view', 'View Role List', 'Role', 1, 1, 1),
(12, 'role.create', 'Create New Role ', 'Role', 1, 1, 1),
(13, 'role.update', 'Update Role ', 'Role', 1, 1, 1),
(14, 'role.delete', 'Delete Role ', 'Role', 1, 1, 1),
(15, 'role.ajaxRevoke', 'Revoke User Role Via Ajax', 'Role', 1, 1, 1),
(16, 'role.index', 'View Role List', 'Role', 1, 1, 1),
(17, 'role.admin', 'Manage All Role', 'Role', 1, 1, 1),
(18, 'role.assign', 'Assign User Role ', 'Role', 1, 1, 1),
(19, 'role.ajaxAssign', 'Assign User Role Via Ajax ', 'Role', 1, 1, 1),
(20, 'user.view', 'View User ', 'User', 2, 1, 1),
(21, 'user.create', 'Create New User ', 'User', 2, 1, 1),
(22, 'user.update', 'Update User ', 'User', 2, 1, 1),
(23, 'user.delete', 'Delete User ', 'User', 2, 1, 1),
(24, 'user.index', 'View All User List', 'User', 2, 1, 1),
(52, 'report.user', 'View User Log List Report', 'Report', 1, 1, 1),
(54, 'operation.generateAll', 'Operation GenerateAll', 'Operation', 1, 1, 1),
(55, 'profile.changePhoto', 'Profile ChangePhoto', 'Profile', 1, 1, 1),
(56, 'report.userLog', 'Report UserLog', 'Report', 1, 1, 1),
(57, 'report.userLogForm', 'Report UserLogForm', 'Report', 1, 1, 1),
(58, 'backup.default.create', 'Backup Default Create', 'Backup', 1, 1, 1),
(59, 'backup.default.delete', 'Backup Default Delete', 'Backup', 1, 1, 1),
(60, 'backup.default.download', 'Backup Default Download', 'Backup', 1, 1, 1),
(61, 'backup.default.index', 'Backup Default Index', 'Backup', 1, 1, 1),
(62, 'backup.default.restore', 'Backup Default Restore', 'Backup', 1, 1, 1),
(63, 'backup.default.upload', 'Backup Default Upload', 'Backup', 1, 1, 1),
(64, 'translate.edit.create', 'Translate Edit Create', 'Translate', 1, 1, 1),
(65, 'translate.edit.update', 'Translate Edit Update', 'Translate', 1, 1, 1),
(66, 'translate.edit.delete', 'Translate Edit Delete', 'Translate', 1, 1, 1),
(67, 'translate.edit.index', 'Translate Edit Index', 'Translate', 1, 1, 1),
(68, 'translate.edit.missing', 'Translate Edit Missing', 'Translate', 1, 1, 1),
(69, 'translate.edit.missingdelete', 'Translate Edit Missingdelete', 'Translate', 1, 1, 1),
(70, 'translate.translate.index', 'Translate Translate Index', 'Translate', 1, 1, 1),
(71, 'accessLog.download', 'AccessLog Download', 'AccessLog', 1, 1, 1),
(72, 'site.index', 'Site Index', 'Site', 1, 1, 1),
(73, 'jReport.userList', 'JReport UserList', 'JReport', 1, 1, 1),
(74, 'jReport.userActivityList', 'JReport UserActivityList', 'JReport', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'Super User');

-- --------------------------------------------------------

--
-- Table structure for table `role_access`
--

CREATE TABLE IF NOT EXISTS `role_access` (
  `role_id` int(11) NOT NULL,
  `operation_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role_access`
--

INSERT INTO `role_access` (`role_id`, `operation_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23),
(1, 24),
(1, 52),
(1, 54),
(1, 55),
(1, 56),
(1, 57),
(1, 58),
(1, 59),
(1, 60),
(1, 61),
(1, 62),
(1, 63),
(1, 64),
(1, 65),
(1, 66),
(1, 67),
(1, 68),
(1, 69),
(1, 70),
(1, 71),
(1, 72),
(1, 73),
(1, 74);

-- --------------------------------------------------------

--
-- Table structure for table `sourcemessage`
--

CREATE TABLE IF NOT EXISTS `sourcemessage` (
`id` int(11) NOT NULL,
  `category` varchar(32) DEFAULT NULL,
  `message` text
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `sourcemessage`
--

INSERT INTO `sourcemessage` (`id`, `category`, `message`) VALUES
(1, 'config', 'Config'),
(2, 'trans', 'Settings'),
(3, 'trans', 'Fields with'),
(4, 'trans', 'are required.'),
(5, 'trans', 'Sistem'),
(6, 'config', 'Page Title'),
(7, 'config', 'Admin Email'),
(8, 'config', 'Company Name'),
(9, 'config', 'Company Email'),
(10, 'config', 'Allow user registration?'),
(11, 'config', 'New User Default Role'),
(12, 'config', 'Company Name Report'),
(13, 'config', 'Company Description Report'),
(14, 'config', 'Company Address Report'),
(15, 'config', 'Language'),
(16, 'config', 'Default Page Size'),
(17, 'trans', 'Perusahaan'),
(18, 'config', 'Company Address'),
(19, 'trans', 'Laporan'),
(20, 'trans', 'Save'),
(21, 'trans', 'Application Name Title'),
(22, 'trans', 'Administration'),
(23, 'trans', 'Manage User'),
(24, 'trans', 'Manage Role'),
(25, 'trans', 'Manage Operation'),
(26, 'trans', 'Manage Translation'),
(27, 'trans', 'User Access Log'),
(28, 'trans', 'Help'),
(29, 'trans', 'Profile'),
(30, 'trans', 'Edit Profile'),
(31, 'trans', 'Change Password'),
(32, 'trans', 'Login'),
(33, 'trans', 'Logout ({user})'),
(34, 'trans', '<span>Dashboard</span>'),
(35, 'trans', '<span>Report</span>'),
(36, 'trans', 'User Log Report'),
(37, 'trans', 'SIMPATDA'),
(38, 'trans', 'Manage Backup DB'),
(39, 'trans', 'Upload Photo'),
(40, 'trans', 'Translate'),
(41, 'trans', 'Tampil'),
(42, 'trans', 'Operations'),
(43, 'trans', 'List Backup'),
(44, 'trans', 'List Messages'),
(45, 'trans', 'Missing Translations'),
(46, 'trans', 'Language');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'no_image.png',
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `phone_1` varchar(15) DEFAULT NULL,
  `phone_2` varchar(15) DEFAULT NULL,
  `address` text,
  `status` int(1) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `activkey` varchar(45) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `image`, `password`, `email`, `fullname`, `phone_1`, `phone_2`, `address`, `status`, `last_login`, `activkey`, `role_id`) VALUES
(1, 'admin', 'eb775e4610fe263212b228cb1290253c8dbe66ac.jpg', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin@taneweb.com', 'Administrator', '081888888', NULL, 'Jl. Jambu Klutuk', 1, '2015-11-14 08:09:00', NULL, 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_userlist`
--
CREATE TABLE IF NOT EXISTS `v_userlist` (
`id` int(11)
,`username` varchar(255)
,`image` varchar(255)
,`password` varchar(255)
,`email` varchar(255)
,`fullname` varchar(255)
,`phone_1` varchar(15)
,`phone_2` varchar(15)
,`address` text
,`status` int(1)
,`last_login` datetime
,`activkey` varchar(45)
,`role_id` int(11)
,`namarole` varchar(255)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_userlog`
--
CREATE TABLE IF NOT EXISTS `v_userlog` (
`id` int(11)
,`type` int(1)
,`activity` text
,`time` varchar(50)
,`user_id` int(11)
,`username` varchar(255)
);
-- --------------------------------------------------------

--
-- Structure for view `v_userlist`
--
DROP TABLE IF EXISTS `v_userlist`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_userlist` AS select `a`.`id` AS `id`,`a`.`username` AS `username`,`a`.`image` AS `image`,`a`.`password` AS `password`,`a`.`email` AS `email`,`a`.`fullname` AS `fullname`,`a`.`phone_1` AS `phone_1`,`a`.`phone_2` AS `phone_2`,`a`.`address` AS `address`,`a`.`status` AS `status`,`a`.`last_login` AS `last_login`,`a`.`activkey` AS `activkey`,`a`.`role_id` AS `role_id`,`b`.`name` AS `namarole` from (`user` `a` join `role` `b`) where (`a`.`role_id` = `b`.`id`) order by `a`.`username`;

-- --------------------------------------------------------

--
-- Structure for view `v_userlog`
--
DROP TABLE IF EXISTS `v_userlog`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_userlog` AS select `a`.`id` AS `id`,`a`.`type` AS `type`,`a`.`activity` AS `activity`,`a`.`time` AS `time`,`a`.`user_id` AS `user_id`,`b`.`username` AS `username` from (`access_log` `a` join `user` `b`) where (`a`.`user_id` = `b`.`id`) order by `a`.`time` desc;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_log`
--
ALTER TABLE `access_log`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_access_log_user1_idx` (`user_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
 ADD PRIMARY KEY (`id`,`language`);

--
-- Indexes for table `operation`
--
ALTER TABLE `operation`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_access`
--
ALTER TABLE `role_access`
 ADD PRIMARY KEY (`role_id`,`operation_id`), ADD KEY `fk_role_has_operation_operation1_idx` (`operation_id`), ADD KEY `fk_role_has_operation_role_idx` (`role_id`);

--
-- Indexes for table `sourcemessage`
--
ALTER TABLE `sourcemessage`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_user_role1_idx` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_log`
--
ALTER TABLE `access_log`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=153;
--
-- AUTO_INCREMENT for table `operation`
--
ALTER TABLE `operation`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sourcemessage`
--
ALTER TABLE `sourcemessage`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `access_log`
--
ALTER TABLE `access_log`
ADD CONSTRAINT `fk_access_log_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
ADD CONSTRAINT `FK_Message_SourceMessage` FOREIGN KEY (`id`) REFERENCES `sourcemessage` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_access`
--
ALTER TABLE `role_access`
ADD CONSTRAINT `fk_role_has_operation_operation1` FOREIGN KEY (`operation_id`) REFERENCES `operation` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_role_has_operation_role` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
ADD CONSTRAINT `fk_user_role1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
