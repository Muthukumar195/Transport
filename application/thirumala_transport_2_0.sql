-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2017 at 11:58 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `thirumala_transport_2.0`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `Admin_id` int(11) NOT NULL,
  `Admin_fullname` varchar(450) NOT NULL,
  `Admin_email` text NOT NULL,
  `Admin_phone` varchar(25) NOT NULL,
  `Admin_username` varchar(120) NOT NULL,
  `Admin_password` varchar(60) NOT NULL,
  `Admin_profile` text NOT NULL,
  `Admin_type` enum('A','E','M','I','AC') NOT NULL COMMENT 'A=Admin, E=Employee, M=Manager, I=Incharge, AC=Accountant',
  `Admin_user_rights` int(11) NOT NULL COMMENT 'reference id of user rights table',
  `Admin_created_dt_tme` datetime NOT NULL,
  `Admin_status` enum('A','D') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_id`, `Admin_fullname`, `Admin_email`, `Admin_phone`, `Admin_username`, `Admin_password`, `Admin_profile`, `Admin_type`, `Admin_user_rights`, `Admin_created_dt_tme`, `Admin_status`) VALUES
(1, 'Adminstrator', 'srithirumalatransport3247@gmail.com', '9840602093', 'admin', 'admin', 'profile_pic1.jpg', 'A', 0, '2016-09-26 16:50:37', 'A'),
(2, 'DEVI', 'srithirumalatransport3247@gmail.com', '8056083401', 'DEVI', 'DEVIRAJ', 'profile_pic2.jpg', 'A', 1, '2016-12-30 15:33:02', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `admin_user_rights_details`
--

CREATE TABLE IF NOT EXISTS `admin_user_rights_details` (
  `User_rights_id` int(11) NOT NULL,
  `User_rights_name` varchar(220) NOT NULL,
  `User_rights_type_value` text NOT NULL,
  `User_rights_created_dt_time` datetime NOT NULL,
  `User_rights_status` enum('A','D') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_user_rights_details`
--

INSERT INTO `admin_user_rights_details` (`User_rights_id`, `User_rights_name`, `User_rights_type_value`, `User_rights_created_dt_time`, `User_rights_status`) VALUES
(1, 'Devi', 'Party Payment', '2016-12-30 15:30:26', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `container_details`
--

CREATE TABLE IF NOT EXISTS `container_details` (
  `Container_dtl_id` int(11) NOT NULL,
  `Container_dtl_container_no` varchar(60) NOT NULL,
  `Container_dtl_size` enum('T','F') NOT NULL COMMENT 'T=Twenty feet, F=Fourty Feed',
  `Container_dtl_created_dt_time` datetime NOT NULL,
  `Container_dtl_status` enum('A','D') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `daily_moment_details`
--

CREATE TABLE IF NOT EXISTS `daily_moment_details` (
  `Daily_mvnt_dtl_id` int(11) NOT NULL,
  `Daily_mvnt_dtl_date` date NOT NULL,
  `Daily_mvnt_dtl_transport_type` enum('T','O') NOT NULL COMMENT 'Thirumala,Other',
  `Daily_mvnt_dtl_vehicle_no` int(11) DEFAULT NULL COMMENT 'vehicle details table reference id',
  `Daily_mvnt_dtl_other_vehicle_no` int(20) DEFAULT NULL,
  `Daily_mvnt_dtl_container_type` enum('BC','NC') NOT NULL COMMENT 'Billing container,new container',
  `Daily_mvnt_dtl_container_no` int(11) DEFAULT NULL COMMENT 'Party billing reference id',
  `Daily_mvnt_dtl_new_container_no` varchar(200) DEFAULT NULL,
  `Daily_mvnt_dtl_place` int(11) NOT NULL COMMENT 'driver pay rate details reference id',
  `Daily_mvnt_dtl_pickup_place` varchar(200) NOT NULL,
  `Daily_mvnt_dtl_drop_place` varchar(200) NOT NULL,
  `Daily_mvnt_dtl_loading_status` enum('L','U') NOT NULL COMMENT 'L=Loading, U=Unloding',
  `Daily_mvnt_dtl_party_name` int(11) NOT NULL COMMENT 'party details reference id',
  `Daily_mvnt_dtl_party_adv` int(11) NOT NULL,
  `Daily_mvnt_dtl_driver_name` int(11) DEFAULT NULL COMMENT 'driver details table reference id',
  `Daily_mvnt_dtl_advance` int(11) DEFAULT NULL COMMENT 'Driver Advance Amount',
  `Daily_mvnt_dtl_trp_name` int(11) DEFAULT NULL COMMENT 'Transport Name',
  `Daily_mvnt_dtl_trp_adv` int(11) DEFAULT NULL,
  `Daily_mvnt_dtl_trp_rent` int(11) DEFAULT NULL,
  `Daily_mvnt_dtl_trp_expences` int(11) NOT NULL,
  `Daily_mvnt_dtl_trp_sum` enum('A','S') NOT NULL,
  `Daily_mvnt_dtl_trp_exp_remark` text NOT NULL,
  `Daily_mvnt_dtl_transport_pay_status` enum('U','P') NOT NULL COMMENT 'U=Unpaid , P=paid',
  `Daily_mvnt_dtl_party_pay_date` date NOT NULL,
  `Daily_mvnt_dtl_party_pay_status` enum('U','P') NOT NULL COMMENT 'U=Unpaid, P=Paid',
  `Daily_mvnt_dtl_driver_pay_date` date NOT NULL COMMENT 'Driver amount paid date',
  `Daily_mvnt_dtl_driver_pay_status` enum('U','P') NOT NULL COMMENT 'U=Unpaid, P=Paid',
  `Daily_mvnt_dtl_other_expences` int(11) NOT NULL COMMENT 'other expences amount',
  `Daily_mvnt_dtl_driver_remark` varchar(11) NOT NULL,
  `Daily_mvnt_dtl_driver_basic_pay` int(11) NOT NULL COMMENT 'for driver amount calculate by using driver pay rate table',
  `Daily_mvnt_dtl_driver_total_pay` int(11) NOT NULL COMMENT 'Driver Total Pay Amount',
  `Daily_mvnt_dtl_diesel_rate` int(11) NOT NULL COMMENT 'diesel rate',
  `Daily_mvnt_dtl_diesel_rate_status` enum('D','N') NOT NULL COMMENT 'D=default diesel rate , N = new diesel rate',
  `Daily_mvnt_dtl_party_mamul` int(11) NOT NULL COMMENT 'Party mamul',
  `Daily_mvnt_dtl_rent` int(11) NOT NULL COMMENT 'Rent Amount',
  `Daily_mvnt_dtl_profit` int(11) NOT NULL COMMENT 'Profit amount for company',
  `Daily_mvnt_dtl_created_dt_time` datetime NOT NULL,
  `Daily_mvnt_dtl_status` enum('A','D') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=332 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daily_moment_details`
--

INSERT INTO `daily_moment_details` (`Daily_mvnt_dtl_id`, `Daily_mvnt_dtl_date`, `Daily_mvnt_dtl_transport_type`, `Daily_mvnt_dtl_vehicle_no`, `Daily_mvnt_dtl_other_vehicle_no`, `Daily_mvnt_dtl_container_type`, `Daily_mvnt_dtl_container_no`, `Daily_mvnt_dtl_new_container_no`, `Daily_mvnt_dtl_place`, `Daily_mvnt_dtl_pickup_place`, `Daily_mvnt_dtl_drop_place`, `Daily_mvnt_dtl_loading_status`, `Daily_mvnt_dtl_party_name`, `Daily_mvnt_dtl_party_adv`, `Daily_mvnt_dtl_driver_name`, `Daily_mvnt_dtl_advance`, `Daily_mvnt_dtl_trp_name`, `Daily_mvnt_dtl_trp_adv`, `Daily_mvnt_dtl_trp_rent`, `Daily_mvnt_dtl_trp_expences`, `Daily_mvnt_dtl_trp_sum`, `Daily_mvnt_dtl_trp_exp_remark`, `Daily_mvnt_dtl_transport_pay_status`, `Daily_mvnt_dtl_party_pay_date`, `Daily_mvnt_dtl_party_pay_status`, `Daily_mvnt_dtl_driver_pay_date`, `Daily_mvnt_dtl_driver_pay_status`, `Daily_mvnt_dtl_other_expences`, `Daily_mvnt_dtl_driver_remark`, `Daily_mvnt_dtl_driver_basic_pay`, `Daily_mvnt_dtl_driver_total_pay`, `Daily_mvnt_dtl_diesel_rate`, `Daily_mvnt_dtl_diesel_rate_status`, `Daily_mvnt_dtl_party_mamul`, `Daily_mvnt_dtl_rent`, `Daily_mvnt_dtl_profit`, `Daily_mvnt_dtl_created_dt_time`, `Daily_mvnt_dtl_status`) VALUES
(1, '2017-04-01', 'T', 9, NULL, 'NC', NULL, 'CXNU-2225432', 172, 'CONCOR', 'CONCOR', 'U', 17, 0, 11, 7293, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 8209, 8209, 59, 'N', 0, 17500, 9291, '2017-04-04 10:33:01', 'A'),
(2, '2017-04-01', 'O', 28, NULL, 'NC', NULL, 'TTNU-3861850', 49, 'L&T', 'MCT-5', 'U', 5, 0, 15, 5000, 13, 5000, 10000, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 5585, 5585, 59, 'N', 0, 10500, 4915, '2017-04-04 10:35:32', 'A'),
(3, '2017-04-02', 'T', 1, NULL, 'NC', NULL, 'CXNU-1326029', 172, 'CONCOR', 'CONCOR', 'U', 17, 0, 1, 8000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 8900, 8900, 59, 'N', 0, 17500, 8600, '2017-04-27 14:00:25', 'A'),
(4, '2017-04-02', 'T', 8, NULL, 'NC', NULL, 'CXNU-1549043', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 16, 2500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3445, 3445, 59, 'N', 0, 7300, 3855, '2017-05-03 15:33:44', 'A'),
(5, '2017-04-02', 'T', 9, NULL, 'NC', NULL, 'ILCU-5106838', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 11, 1000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1891, 1891, 59, 'N', 0, 4200, 2309, '2017-04-04 10:43:27', 'A'),
(6, '2017-04-02', 'O', 11, NULL, 'NC', NULL, 'CXNU-2132847', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 10, 2000, 14, 2000, 6700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3445, 3445, 59, 'N', 0, 7300, 3855, '2017-04-04 10:44:50', 'A'),
(7, '2017-04-02', 'T', 13, NULL, 'NC', NULL, 'CXNU-0902027', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 17, 2000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3445, 3445, 59, 'N', 0, 7300, 3855, '2017-04-04 10:46:05', 'A'),
(8, '2017-04-02', 'T', 58, NULL, 'NC', NULL, 'ILCU-5109288', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 13, 2000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3445, 3445, 59, 'N', 0, 7300, 3855, '2017-04-04 10:48:58', 'A'),
(9, '2017-04-02', 'O', 28, NULL, 'NC', NULL, 'ILCU-5253470', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 15, 1000, 13, 1000, 3700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1891, 1891, 59, 'N', 0, 4200, 2309, '2017-04-04 10:50:10', 'A'),
(10, '2017-04-02', 'T', 57, NULL, 'NC', NULL, 'ILCU-5256782', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 11, 1000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1891, 1891, 59, 'N', 0, 4200, 2309, '2017-04-04 10:51:33', 'A'),
(11, '2017-04-02', 'T', 7, NULL, 'NC', NULL, 'CXNU-1141792', 59, 'CONCOR', 'CONCOR', 'U', 11, 0, 32, 3500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3880, 3880, 59, 'N', 0, 8000, 4120, '2017-04-04 10:55:15', 'A'),
(12, '2017-04-03', 'T', 7, NULL, 'NC', NULL, 'ILCU-5102600', 61, 'CONCOR', 'CONCOR', 'U', 11, 0, 32, 2000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2454, 2454, 59, 'N', 0, 4600, 2146, '2017-04-18 10:55:31', 'A'),
(13, '2017-04-03', 'T', 9, NULL, 'NC', NULL, 'CXNU-1525078', 1, 'CONCOR', 'CONCOR', 'U', 17, 0, 11, 8000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 7995, 7995, 59, 'N', 0, 17500, 9505, '2017-04-28 17:47:53', 'A'),
(14, '2017-04-03', 'O', 28, NULL, 'NC', NULL, 'ILCU-5111942', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 15, 1000, 13, 1000, 3700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1891, 1891, 59, 'N', 0, 4200, 2309, '2017-04-10 11:16:06', 'A'),
(15, '2017-04-03', 'O', 27, NULL, 'NC', NULL, 'CXNU-1132229', 74, 'NAGALKENI', 'CONCOR', 'L', 14, 0, 13, 2000, 13, 2000, 7500, 0, 'A', '', 'U', '2017-04-18', 'P', '0000-00-00', 'U', 0, '', 2860, 2860, 59, 'N', 0, 8000, 5140, '2017-04-10 11:21:24', 'A'),
(16, '2017-04-03', 'T', 57, NULL, 'NC', NULL, 'ILCU-5022294', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 16, 1400, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1891, 1891, 59, 'N', 0, 4200, 2309, '2017-04-10 11:46:21', 'A'),
(17, '2017-04-03', 'O', 56, NULL, 'NC', NULL, 'ILCU-5231969', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, NULL, NULL, 12, 0, 3700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1891, 1891, 59, 'N', 0, 4200, 2309, '2017-04-10 11:47:10', 'A'),
(18, '2017-04-04', 'T', 1, NULL, 'NC', NULL, 'CXNU-1527050', 172, 'CONCOR', 'CONCOR', 'U', 17, 0, 13, 8000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 8900, 8900, 59, 'N', 0, 17500, 8600, '2017-05-09 12:13:43', 'A'),
(19, '2017-04-04', 'T', 8, NULL, 'NC', NULL, 'CXNU-0900683', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 16, 3000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3445, 3445, 59, 'N', 0, 7300, 3855, '2017-04-10 11:49:23', 'A'),
(20, '2017-04-04', 'O', 11, NULL, 'NC', NULL, 'NSLU-2004056', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 10, 3000, 14, 3000, 6700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3445, 3445, 59, 'N', 0, 7300, 3855, '2017-04-10 11:50:24', 'A'),
(21, '2017-04-04', 'T', 12, NULL, 'NC', NULL, 'CXNU-0903110', 61, 'CONCOR', 'CONCOR', 'U', 11, 0, 32, 2200, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2454, 2454, 59, 'N', 0, 4600, 2146, '2017-04-18 10:55:09', 'A'),
(22, '2017-04-04', 'T', 13, NULL, 'NC', NULL, 'CXNU-0907137', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 17, 3000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3445, 3445, 59, 'N', 0, 7300, 3855, '2017-04-10 11:52:30', 'A'),
(23, '2017-04-04', 'T', 58, NULL, 'NC', NULL, 'CXNU-0904333', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 16, 1000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1891, 1891, 59, 'N', 0, 4200, 2309, '2017-04-10 11:53:30', 'A'),
(24, '2017-04-04', 'O', 28, NULL, 'NC', NULL, 'ILCU-5110062', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 15, 3000, 13, 3000, 6700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3445, 3445, 59, 'N', 0, 7300, 3855, '2017-04-10 11:54:32', 'A'),
(25, '2017-04-04', 'O', 27, NULL, 'NC', NULL, 'CXNU-1326029', 10, 'CONCOR', 'CONCOR', 'U', 14, 0, 13, 3500, 13, 3500, 7500, 0, 'A', '', 'U', '2017-04-18', 'P', '0000-00-00', 'U', 0, '', 4045, 4045, 59, 'N', 0, 8000, 3955, '2017-04-10 11:56:48', 'A'),
(26, '2017-04-04', 'T', 57, NULL, 'NC', NULL, 'CFLU-2131877', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 13, 2500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3445, 3445, 59, 'N', 0, 7300, 3855, '2017-04-10 11:58:01', 'A'),
(27, '2017-04-05', 'T', 7, NULL, 'NC', NULL, 'CXNU-1521318', 61, 'CONCOR', 'CONCOR', 'U', 11, 0, 32, 2300, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2454, 2454, 59, 'N', 0, 4600, 2146, '2017-04-18 10:54:14', 'A'),
(28, '2017-04-05', 'T', 8, NULL, 'NC', NULL, 'ILCU-5023815', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 16, 1500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1891, 1891, 59, 'N', 0, 4200, 2309, '2017-04-10 12:00:02', 'A'),
(29, '2017-04-05', 'T', 9, NULL, 'NC', NULL, 'CXNU-2221932', 172, 'CONCOR', 'CONCOR', 'U', 17, 0, 11, 8000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 8209, 8209, 59, 'N', 0, 17500, 9291, '2017-04-10 12:01:59', 'A'),
(30, '2017-04-05', 'O', 11, NULL, 'NC', NULL, 'ILCU-5018505', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 10, 3000, 14, 3000, 6700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3445, 3445, 59, 'N', 0, 7300, 3855, '2017-04-10 12:03:04', 'A'),
(31, '2017-04-05', 'T', 12, NULL, 'NC', NULL, 'CXNU-1141046', 61, 'CONCOR', 'CONCOR', 'U', 11, 0, 32, 2700, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2454, 2454, 59, 'N', 0, 4600, 2146, '2017-04-18 10:54:40', 'A'),
(32, '2017-04-05', 'T', 13, NULL, 'NC', NULL, 'CXIU-3210777', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 17, 1000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1891, 1891, 59, 'N', 0, 4200, 2309, '2017-04-10 15:23:10', 'A'),
(33, '2017-04-05', 'T', 58, NULL, 'NC', NULL, 'ILCU-5107958', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 16, 3500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3445, 3445, 59, 'N', 0, 7300, 3855, '2017-04-10 15:24:12', 'A'),
(34, '2017-04-05', 'T', 58, NULL, 'NC', NULL, 'CXNU-0907287', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 16, 700, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1891, 1891, 59, 'N', 0, 4200, 2309, '2017-04-10 15:24:56', 'A'),
(35, '2017-04-05', 'O', 28, NULL, 'NC', NULL, 'CXNU-2214281', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 15, 3000, 13, 3000, 6700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3445, 3445, 59, 'N', 0, 7300, 3855, '2017-04-10 15:25:36', 'A'),
(36, '2017-04-05', 'O', 27, NULL, 'NC', NULL, 'CXNU-1304689', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 11, 3000, 13, 3000, 6700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3445, 3445, 59, 'N', 0, 7300, 3855, '2017-04-10 15:26:26', 'A'),
(37, '2017-04-05', 'T', 57, NULL, 'NC', NULL, 'CXNU-0908426', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 16, 1500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1891, 1891, 59, 'N', 0, 4200, 2309, '2017-04-10 15:27:12', 'A'),
(38, '2017-04-05', 'T', 13, NULL, 'NC', NULL, 'CXNU-1302433', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 17, 3000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3445, 3445, 59, 'N', 0, 7300, 3855, '2017-04-10 15:27:54', 'A'),
(39, '2017-04-05', 'O', 61, NULL, 'NC', NULL, 'ILCU-5107942', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, NULL, NULL, 21, 1500, 3700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1891, 1891, 59, 'N', 0, 4200, 2309, '2017-04-10 15:29:58', 'A'),
(40, '2017-04-05', 'O', 44, NULL, 'NC', NULL, 'CXNU-2211338', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, NULL, NULL, 5, 0, 3700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1891, 1891, 59, 'N', 0, 4200, 2309, '2017-04-10 15:30:50', 'A'),
(41, '2017-04-05', 'O', 44, NULL, 'NC', NULL, 'ILCU-5054694', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, NULL, NULL, 5, 0, 6700, 0, 'A', '', 'P', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3200, 3200, 0, 'D', 0, 7300, 4100, '2017-04-10 15:31:41', 'A'),
(42, '2017-04-06', 'T', 1, NULL, 'NC', NULL, 'CXNU-0907672', 1, 'CONCOR', 'CONCOR', 'U', 1, 0, 13, 8000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 7995, 7995, 59, 'N', 0, 18300, 10305, '2017-04-10 15:34:21', 'A'),
(43, '2017-04-06', 'T', 7, NULL, 'NC', NULL, 'CXNU-1521133', 32, 'CONCOR', 'CONCOR', 'U', 11, 0, 32, 3000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3410, 3410, 59, 'N', 0, 6000, 2590, '2017-04-10 15:35:44', 'A'),
(44, '2017-04-06', 'T', 8, NULL, 'NC', NULL, 'ILCU-5252703', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 33, 3000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3445, 3445, 59, 'N', 0, 7300, 3855, '2017-04-10 15:39:03', 'A'),
(45, '2017-04-06', 'O', 11, NULL, 'NC', NULL, 'CXNU-0901890', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 10, 3000, 14, 3000, 6700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3445, 3445, 59, 'N', 0, 7300, 3855, '2017-04-10 15:40:38', 'A'),
(46, '2017-04-06', 'T', 12, NULL, 'NC', NULL, 'CXNU-1534254', 61, 'CONCOR', 'CONCOR', 'U', 11, 0, 32, 2000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2454, 2454, 59, 'N', 0, 4600, 2146, '2017-04-18 10:53:48', 'A'),
(47, '2017-04-06', 'T', 13, NULL, 'NC', NULL, 'CXNU-0902080', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 17, 3000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3445, 3445, 59, 'N', 0, 7300, 3855, '2017-04-10 15:42:49', 'A'),
(48, '2017-04-06', 'T', 14, NULL, 'NC', NULL, 'CXNU-1325254', 61, 'CONCOR', 'CONCOR', 'U', 11, 0, 33, 2000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2454, 2454, 59, 'N', 0, 4600, 2146, '2017-04-28 16:31:44', 'A'),
(49, '2017-04-06', 'T', 58, NULL, 'NC', NULL, 'ILCU-5109457', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 16, 1500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1891, 1891, 59, 'N', 0, 4200, 2309, '2017-04-10 15:44:40', 'A'),
(50, '2017-04-06', 'O', 28, NULL, 'NC', NULL, 'CXNU-1224916', 1, 'CONCOR', 'CONCOR', 'U', 1, 0, 15, 8000, 13, 8000, 17000, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 7995, 7995, 59, 'N', 0, 18300, 10305, '2017-04-10 15:46:56', 'A'),
(51, '2017-04-06', 'O', 27, NULL, 'NC', NULL, 'CXNU-0900596', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 16, 1500, 13, 1500, 3700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1891, 1891, 59, 'N', 0, 4200, 2309, '2017-04-10 16:00:23', 'A'),
(52, '2017-04-06', 'O', 61, NULL, 'NC', NULL, 'CXNU-0909042', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, NULL, NULL, 21, 4000, 3700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1891, 1891, 59, 'N', 0, 4200, 2309, '2017-04-10 16:02:14', 'A'),
(53, '2017-04-06', 'O', 61, NULL, 'NC', NULL, 'CXNU-2214126', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, NULL, NULL, 21, 0, 6700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3445, 3445, 59, 'N', 0, 7300, 3855, '2017-04-10 16:03:42', 'A'),
(54, '2017-04-06', 'T', 57, NULL, 'NC', NULL, 'CXNU-0901191', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 16, 3000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3445, 3445, 59, 'N', 0, 7300, 3855, '2017-04-10 16:06:22', 'A'),
(55, '2017-04-06', 'O', 62, NULL, 'NC', NULL, 'CXNU-1306850', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, NULL, NULL, 5, 0, 6700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3445, 3445, 59, 'N', 0, 7300, 3855, '2017-04-10 16:08:48', 'A'),
(56, '2017-04-06', 'O', 45, NULL, 'NC', NULL, 'ILCU-5108661', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, NULL, NULL, 12, 1000, 3700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1891, 1891, 59, 'N', 0, 4200, 2309, '2017-04-10 16:09:48', 'A'),
(57, '2017-04-06', 'O', 23, NULL, 'NC', NULL, 'ILCU-5106967', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, NULL, NULL, 12, 1000, 3700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1891, 1891, 59, 'N', 0, 4200, 2309, '2017-04-10 16:10:40', 'A'),
(58, '2017-04-06', 'O', 44, NULL, 'NC', NULL, 'CXNU-0904647', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, NULL, NULL, 5, 1000, 3700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1891, 1891, 59, 'N', 0, 4200, 2309, '2017-04-10 16:12:04', 'A'),
(59, '2017-04-07', 'T', 1, NULL, 'NC', NULL, 'ILCU-6512533', 1, 'CONCOR', 'CONCOR', 'U', 1, 0, 13, 8000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 7995, 7995, 59, 'N', 0, 18300, 10305, '2017-04-10 16:22:40', 'A'),
(60, '2017-04-07', 'T', 7, NULL, 'NC', NULL, 'CXNU-1140013', 61, 'CONCOR', 'CONCOR', 'U', 11, 0, 32, 2700, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2454, 2454, 59, 'N', 0, 4600, 2146, '2017-04-18 10:53:02', 'A'),
(61, '2017-04-07', 'T', 8, NULL, 'NC', NULL, 'ILCU-5022423', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 33, 1000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1891, 1891, 59, 'N', 0, 4200, 2309, '2017-04-11 12:29:54', 'A'),
(62, '2017-04-07', 'T', 9, NULL, 'NC', NULL, 'ILCU-5111006', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 11, 1000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1891, 1891, 59, 'N', 0, 4200, 2309, '2017-04-11 12:30:49', 'A'),
(63, '2017-04-07', 'O', 11, NULL, 'NC', NULL, 'ILCU-5107238', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 10, 0, 14, 5000, 6700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3445, 3445, 59, 'N', 0, 7300, 3855, '2017-04-22 17:20:37', 'A'),
(64, '2017-04-07', 'T', 12, NULL, 'NC', NULL, 'CXNU-1317705', 61, 'CONCOR', 'CONCOR', 'U', 11, 0, 32, 2000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2454, 2454, 59, 'N', 0, 4600, 2146, '2017-04-18 10:53:25', 'A'),
(65, '2017-04-07', 'T', 13, NULL, 'NC', NULL, 'CXNU-0902080', 74, 'NAGALKENI', 'CONCOR', 'U', 14, 0, 17, 2000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2860, 2860, 59, 'N', 0, 8000, 5140, '2017-04-11 12:34:12', 'A'),
(66, '2017-04-07', 'T', 58, NULL, 'NC', NULL, 'CXNU-0909401', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 16, 2500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3445, 3445, 59, 'N', 0, 7300, 3855, '2017-04-11 12:35:10', 'A'),
(67, '2017-04-07', 'O', 28, NULL, 'NC', NULL, 'ILCU-5105364', 1, 'CONCOR', 'CONCOR', 'U', 1, 0, 15, 8000, 13, 8000, 17000, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 7995, 7995, 59, 'N', 0, 18300, 10305, '2017-04-11 12:37:45', 'A'),
(68, '2017-04-07', 'T', 57, NULL, 'NC', NULL, 'CXNU-0901101', 74, 'NAGALKENI', 'CONCOR', 'U', 14, 0, 16, 2000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2860, 2860, 59, 'N', 0, 8000, 5140, '2017-04-11 12:38:58', 'A'),
(69, '2017-04-07', 'O', 48, NULL, 'NC', NULL, 'CXNU-0906228', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, NULL, NULL, 12, 1000, 3700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1891, 1891, 59, 'N', 0, 4200, 2309, '2017-04-11 12:39:55', 'A'),
(70, '2017-04-07', 'O', 23, NULL, 'NC', NULL, 'CXNU-2211791', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, NULL, NULL, 12, 1000, 3700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1891, 1891, 59, 'N', 0, 4200, 2309, '2017-04-11 12:40:33', 'A'),
(71, '2017-04-07', 'O', 44, NULL, 'NC', NULL, 'ILCU-5110530', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, NULL, NULL, 5, 2500, 6700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3445, 3445, 59, 'N', 0, 7300, 3855, '2017-04-11 12:41:21', 'A'),
(72, '2017-04-07', 'O', 62, NULL, 'NC', NULL, 'NSLU-2001102', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, NULL, NULL, 5, 2000, 6700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3445, 3445, 59, 'N', 0, 7300, 3855, '2017-04-11 12:42:15', 'A'),
(73, '2017-04-07', 'O', 61, NULL, 'NC', NULL, 'CXNU-0902325', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, NULL, NULL, 21, 3000, 6700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3445, 3445, 59, 'N', 0, 7300, 3855, '2017-04-11 12:43:43', 'A'),
(74, '2017-04-07', 'O', 37, NULL, 'NC', NULL, 'ILCU-5109457', 10, 'CONCOR', 'CONCOR', 'L', 14, 0, NULL, NULL, 17, 3500, 7000, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 4045, 4045, 59, 'N', 0, 8000, 3955, '2017-04-11 12:47:44', 'A'),
(75, '2017-04-07', 'O', 60, NULL, 'NC', NULL, 'CXNU-1121564', 10, 'CONCOR', 'CONCOR', 'L', 14, 0, NULL, NULL, 17, 3500, 7000, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 4045, 4045, 59, 'N', 0, 8000, 3955, '2017-04-11 12:47:59', 'A'),
(76, '2017-04-07', 'O', 39, NULL, 'NC', NULL, 'CXNU-131970', 10, 'CONCOR', 'CONCOR', 'L', 14, 0, NULL, NULL, 17, 3500, 7000, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 4045, 4045, 59, 'N', 0, 8000, 3955, '2017-04-11 12:48:29', 'A'),
(77, '2017-04-07', 'O', 59, NULL, 'NC', NULL, 'CXNU-1142248', 10, 'CONCOR', 'CONCOR', 'L', 14, 0, NULL, NULL, 17, 3500, 7000, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 4045, 4045, 59, 'N', 0, 8000, 3955, '2017-04-11 12:49:29', 'A'),
(78, '2017-04-07', 'O', 38, NULL, 'NC', NULL, 'CXNU-1537377', 10, 'CONCOR', 'CONCOR', 'L', 14, 0, NULL, NULL, 17, 3500, 7000, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 4045, 4045, 59, 'N', 0, 8000, 3955, '2017-04-11 12:51:05', 'A'),
(79, '2017-04-08', 'T', 7, NULL, 'NC', NULL, 'CXNU-1526428', 32, 'CONCOR', 'CONCOR', 'U', 11, 0, 32, 3000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3410, 3410, 59, 'N', 0, 6000, 2590, '2017-04-11 12:52:01', 'A'),
(80, '2017-04-08', 'T', 13, NULL, 'NC', NULL, 'CXNU-0906871', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 17, 3000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3445, 3445, 59, 'N', 0, 7300, 3855, '2017-04-11 12:53:12', 'A'),
(81, '2017-04-08', 'O', 28, NULL, 'NC', NULL, 'CXNU-1307570', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 15, 3000, 13, 3000, 6700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3445, 3445, 59, 'N', 0, 7300, 3855, '2017-04-11 12:54:04', 'A'),
(83, '2017-04-08', 'T', 57, NULL, 'NC', NULL, 'CXNU-0903640', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 16, 3000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3445, 3445, 59, 'N', 0, 7300, 3855, '2017-04-11 12:57:27', 'A'),
(84, '2017-04-08', 'O', 44, NULL, 'NC', NULL, 'CXNU-2217059', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, NULL, NULL, 5, 0, 6700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3445, 3445, 59, 'N', 0, 7300, 3855, '2017-04-11 13:04:59', 'A'),
(85, '2017-04-08', 'O', 27, NULL, 'NC', NULL, 'CXNU-0900596', 87, 'PUZHAL', 'CONCOR', 'U', 14, 0, 33, 3000, 13, 3000, 7500, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3510, 3510, 59, 'N', 0, 8000, 4490, '2017-04-11 13:06:12', 'A'),
(86, '2017-04-08', 'O', 44, NULL, 'NC', NULL, 'ILCU-5110530', 74, 'NAGALKENI', 'CONCOR', 'L', 14, 0, NULL, NULL, 5, 0, 7000, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2860, 2860, 59, 'N', 0, 8000, 5140, '2017-04-13 15:54:24', 'A'),
(87, '2017-04-09', 'T', 7, NULL, 'NC', NULL, 'CXNU-1318980', 59, 'CONCOR', 'CONCOR', 'U', 11, 0, 32, 3500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3880, 3880, 59, 'N', 0, 9000, 5120, '2017-04-11 13:27:32', 'A'),
(88, '2017-04-09', 'T', 8, NULL, 'NC', NULL, 'CXNU-1310721', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 33, 2500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3445, 3445, 59, 'N', 0, 7300, 3855, '2017-04-11 13:28:26', 'A'),
(89, '2017-04-09', 'O', 11, NULL, 'NC', NULL, 'CXNU-0902140', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 10, 2000, 14, 2000, 6700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3445, 3445, 59, 'N', 0, 7300, 3855, '2017-04-11 13:29:15', 'A'),
(90, '2017-04-09', 'O', 28, NULL, 'NC', NULL, 'CXNU-0908318', 10, 'CONCOR', 'CONCOR', 'L', 14, 0, 15, 3000, 13, 3000, 7500, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 4045, 4045, 59, 'N', 0, 8000, 3955, '2017-04-11 13:36:08', 'A'),
(91, '2017-04-09', 'O', 61, NULL, 'NC', NULL, 'CXNU-3210484', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, NULL, NULL, 21, 2500, 6700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3445, 3445, 59, 'N', 0, 7300, 3855, '2017-04-11 13:37:40', 'A'),
(92, '2017-04-09', 'O', 62, NULL, 'NC', NULL, 'CXNU-3210383', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, NULL, NULL, 5, 2500, 6700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3445, 3445, 59, 'N', 0, 7300, 3855, '2017-04-11 13:38:29', 'A'),
(93, '2017-04-09', 'O', 56, NULL, 'NC', NULL, 'CXNU-3211080', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, NULL, NULL, 12, 1000, 3700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1891, 1891, 59, 'N', 0, 4200, 2309, '2017-04-11 13:39:09', 'A'),
(94, '2017-04-09', 'O', 42, NULL, 'NC', NULL, 'CXNU-1534254', 10, 'CONCOR', 'CONCOR', 'L', 14, 0, NULL, NULL, 17, 3500, 7000, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 4045, 4045, 59, 'N', 0, 8000, 3955, '2017-04-11 13:40:55', 'A'),
(95, '2017-04-09', 'O', 37, NULL, 'NC', NULL, 'CXNU-1325254', 10, 'CONCOR', 'CONCOR', 'L', 14, 0, NULL, NULL, 17, 3500, 7000, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 4045, 4045, 59, 'N', 0, 8000, 3955, '2017-04-11 13:41:47', 'A'),
(96, '2017-04-09', 'O', 59, NULL, 'NC', NULL, 'CXNU-0907672', 10, 'CONCOR', 'CONCOR', 'L', 14, 0, NULL, NULL, 17, 3500, 7000, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 4045, 4045, 59, 'N', 0, 8000, 3955, '2017-04-11 13:42:43', 'A'),
(97, '2017-04-09', 'O', 39, NULL, 'NC', NULL, 'CXNU-0904647', 10, 'CONCOR', 'CONCOR', 'L', 14, 0, NULL, NULL, 17, 3500, 7000, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 4045, 4045, 59, 'N', 0, 8000, 3955, '2017-04-11 13:43:44', 'A'),
(98, '2017-04-09', 'O', 38, NULL, 'NC', NULL, 'CXNU-0901890', 10, 'CONCOR', 'CONCOR', 'L', 14, 0, NULL, NULL, 17, 3500, 7000, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 4045, 4045, 59, 'N', 0, 8000, 3955, '2017-04-12 18:16:54', 'A'),
(99, '2017-04-09', 'O', 44, NULL, 'NC', NULL, 'CXNU-0906572', 10, 'CONCOR', 'CONCOR', 'L', 14, 0, NULL, NULL, 5, 1000, 7000, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 4045, 4045, 59, 'N', 0, 8000, 3955, '2017-04-11 13:46:07', 'A'),
(100, '2017-04-09', 'T', 13, NULL, 'NC', NULL, 'CXNU-0906871', 74, 'NAGALKENI', 'CONCOR', 'U', 14, 0, 17, 2000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2860, 2860, 59, 'N', 0, 8000, 5140, '2017-04-13 13:11:13', 'A'),
(101, '2017-04-09', 'T', 57, NULL, 'NC', NULL, 'CXNU-0903640', 74, 'NAGALKENI', 'CONCOR', 'L', 14, 0, 16, 2000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2860, 2860, 59, 'N', 0, 8000, 5140, '2017-04-13 13:12:21', 'A'),
(102, '2017-04-10', 'T', 1, NULL, 'NC', NULL, 'ILCU-5017920', 1, 'CONCOR', 'CONCOR', 'U', 1, 0, 1, 8000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 7995, 7995, 59, 'N', 0, 18300, 10305, '2017-04-13 13:17:25', 'A'),
(103, '2017-04-10', 'T', 7, NULL, 'NC', NULL, 'ILCU-5111095', 61, 'CONCOR', 'CONCOR', 'U', 11, 0, 32, 2000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2454, 2454, 59, 'N', 0, 4600, 2146, '2017-04-18 18:45:42', 'A'),
(104, '2017-04-10', 'O', 11, NULL, 'NC', NULL, 'CXNU-0902140', 74, 'NAGALKENI', 'CONCOR', 'U', 14, 0, 10, 1500, 14, 1500, 7500, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2860, 2860, 59, 'N', 0, 8000, 5140, '2017-04-13 13:20:09', 'A'),
(105, '2017-04-10', 'T', 12, NULL, 'NC', NULL, 'CXNU-1128316', 61, 'CONCOR', 'CONCOR', 'U', 11, 0, 13, 2000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2454, 2454, 59, 'N', 0, 4600, 2146, '2017-05-10 14:53:23', 'A'),
(106, '2017-04-10', 'T', 13, NULL, 'NC', NULL, 'CXNU-1317705', 10, 'CONCOR', 'CONCOR', 'L', 14, 0, 17, 3500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 4045, 4045, 59, 'N', 0, 8000, 3955, '2017-04-13 13:23:07', 'A'),
(107, '2017-04-10', 'O', 28, NULL, 'NC', NULL, 'CXNU-1111870', 10, 'CONCOR', 'CONCOR', 'L', 14, 0, 15, 3500, 13, 3500, 7500, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 4045, 4045, 59, 'N', 0, 8000, 3955, '2017-04-13 13:24:13', 'A'),
(108, '2017-04-10', 'T', 57, NULL, 'NC', NULL, 'CXNU-1140013', 10, 'CONCOR', 'CONCOR', 'L', 14, 0, 33, 3500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 4045, 4045, 59, 'N', 0, 8000, 3955, '2017-04-13 13:25:25', 'A'),
(109, '2017-04-10', 'O', 11, NULL, 'NC', NULL, 'CXNU-1116850', 10, 'CONCOR', 'CONCOR', 'L', 14, 0, 10, 3500, 14, 3500, 7500, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 4045, 4045, 59, 'N', 0, 8000, 3955, '2017-04-13 13:26:33', 'A'),
(110, '2017-04-10', 'O', 31, NULL, 'NC', NULL, 'CXNU-0904539', 10, 'CONCOR', 'CONCOR', 'L', 14, 0, NULL, NULL, 10, 3500, 7000, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 4045, 4045, 59, 'N', 0, 8000, 3955, '2017-04-13 13:29:10', 'A'),
(111, '2017-04-10', 'O', 19, NULL, 'NC', NULL, 'CXNU-0905160', 10, 'CONCOR', 'CONCOR', 'L', 14, 0, NULL, NULL, 11, 3500, 7000, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 4045, 4045, 59, 'N', 0, 8000, 3955, '2017-04-13 13:30:05', 'A'),
(112, '2017-04-10', 'O', 41, NULL, 'NC', NULL, 'CXNU-0900683', 10, 'CONCOR', 'CONCOR', 'L', 14, 0, NULL, NULL, 17, 3500, 7000, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 4045, 4045, 59, 'N', 0, 8000, 3955, '2017-04-13 13:31:26', 'A'),
(113, '2017-04-10', 'O', 62, NULL, 'NC', NULL, 'CXNU-3210383', 74, 'NAGALKENI', 'CONCOR', 'L', 14, 0, NULL, NULL, 5, 2500, 7000, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2860, 2860, 59, 'N', 0, 8000, 5140, '2017-04-13 15:53:57', 'A'),
(114, '2017-04-10', 'O', 61, NULL, 'NC', NULL, 'CXNU-3210484', 74, 'NAGALKENI', 'CONCOR', 'L', 14, 0, NULL, NULL, 21, 2500, 7000, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2860, 2860, 59, 'N', 0, 8000, 5140, '2017-04-13 13:34:34', 'A'),
(115, '2017-04-10', 'O', 44, NULL, 'NC', NULL, 'CXNU-1541206', 10, 'CONCOR', 'CONCOR', 'L', 14, 0, NULL, NULL, 5, 0, 7000, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 4045, 4045, 59, 'N', 0, 8000, 3955, '2017-04-13 13:35:56', 'A'),
(116, '2017-04-10', 'O', 39, NULL, 'NC', NULL, 'CXNU-1541295', 10, 'CONCOR', 'CONCOR', 'L', 14, 0, NULL, NULL, 17, 3500, 7000, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 4045, 4045, 59, 'N', 0, 8000, 3955, '2017-04-13 13:37:39', 'A'),
(117, '2017-04-10', 'O', 59, NULL, 'NC', NULL, 'CXNU-1548052', 10, 'CONCOR', 'CONCOR', 'L', 14, 0, NULL, NULL, 17, 3500, 7000, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 4045, 4045, 59, 'N', 0, 8000, 3955, '2017-04-13 13:39:17', 'A'),
(118, '2017-04-10', 'O', 42, NULL, 'NC', NULL, 'CXNU-1318980', 10, 'CONCOR', 'CONCOR', 'L', 14, 0, NULL, NULL, 17, 3500, 7000, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 4045, 4045, 59, 'N', 0, 8000, 3955, '2017-04-13 13:40:18', 'A'),
(119, '2017-04-11', 'T', 1, NULL, 'NC', NULL, 'CXNU-1128316', 10, 'CONCOR', 'CONCOR', 'L', 14, 0, 1, 3500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 4045, 4045, 59, 'N', 0, 8000, 3955, '2017-04-13 13:43:30', 'A'),
(120, '2017-04-11', 'T', 9, NULL, 'NC', NULL, 'CXNU-1224454', 1, 'CONCOR', 'CONCOR', 'U', 1, 0, 16, 8000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 7995, 7995, 59, 'N', 0, 18300, 10305, '2017-04-22 17:22:29', 'A'),
(121, '2017-04-11', 'O', 11, NULL, 'NC', NULL, 'CXNU-0900050', 43, 'CONCOR', 'CONCOR', 'L', 12, 0, 10, 2500, 14, 2500, 5500, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2640, 2640, 59, 'N', 0, 6000, 3360, '2017-04-13 14:29:47', 'A'),
(122, '2017-04-11', 'T', 12, NULL, 'NC', NULL, 'CXNU-1109023', 61, 'CONCOR', 'CONCOR', 'U', 11, 0, 32, 2000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2454, 2454, 59, 'N', 0, 46000, 43546, '2017-04-18 10:52:09', 'A'),
(123, '2017-04-11', 'T', 13, NULL, 'NC', NULL, 'CXNU-1144087', 43, 'CONCOR', 'CONCOR', 'L', 12, 0, 17, 2500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2640, 2640, 59, 'N', 0, 6000, 3360, '2017-04-13 14:32:30', 'A'),
(124, '2017-04-11', 'O', 28, NULL, 'NC', NULL, 'ILCU-5111095', 43, 'CONCOR', 'CONCOR', 'L', 12, 0, 15, 2500, 13, 2500, 5500, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2640, 2640, 59, 'N', 0, 6000, 3360, '2017-04-13 14:33:35', 'A'),
(125, '2017-04-11', 'O', 27, NULL, 'NC', NULL, 'NSLU-2005659', 1, 'CONCOR', 'CONCOR', 'U', 1, 0, 13, 8000, 13, 8000, 17000, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 7995, 7995, 59, 'N', 0, 18300, 10305, '2017-04-22 17:23:13', 'A'),
(126, '2017-04-11', 'T', 57, NULL, 'NC', NULL, 'CXNU-0908010', 43, 'CONCOR', 'CONCOR', 'L', 12, 0, 33, 2500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2640, 2640, 59, 'N', 0, 6000, 3360, '2017-04-13 14:35:55', 'A'),
(127, '2017-04-11', 'O', 38, NULL, 'NC', NULL, 'CXNU-2211791', 10, 'CONCOR', 'CONCOR', 'L', 14, 0, NULL, NULL, 17, 3500, 7000, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 4045, 4045, 59, 'N', 0, 8000, 3955, '2017-04-13 15:00:58', 'A'),
(128, '2017-04-11', 'O', 61, NULL, 'NC', NULL, 'CXNU-2218815', 10, 'CONCOR', 'CONCOR', 'L', 14, 0, NULL, NULL, 21, 3500, 7000, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 4045, 4045, 59, 'N', 0, 8000, 3955, '2017-04-13 15:01:15', 'A'),
(129, '2017-04-11', 'O', 62, NULL, 'NC', NULL, 'ILCU-5015764', 10, 'CONCOR', 'CONCOR', 'L', 14, 0, NULL, NULL, 5, 3500, 7000, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 4045, 4045, 59, 'N', 0, 8000, 3955, '2017-04-13 14:54:01', 'A'),
(130, '2017-04-11', 'O', 44, NULL, 'NC', NULL, 'ILCU-5018505', 10, 'CONCOR', 'CONCOR', 'L', 14, 0, NULL, NULL, 5, 3500, 7000, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 4045, 4045, 59, 'N', 0, 8000, 3955, '2017-04-13 14:54:49', 'A'),
(131, '2017-04-11', 'O', 19, NULL, 'NC', NULL, 'ILCU-5022594', 10, 'CONCOR', 'CONCOR', 'L', 14, 0, NULL, NULL, 11, 3500, 7000, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 4045, 4045, 59, 'N', 0, 8000, 3955, '2017-04-13 14:55:46', 'A'),
(132, '2017-04-11', 'O', 39, NULL, 'NC', NULL, 'ILCU-5107942', 10, 'CONCOR', 'CONCOR', 'L', 14, 0, NULL, NULL, 17, 3500, 7000, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 4045, 4045, 59, 'N', 0, 8000, 3955, '2017-04-13 14:56:53', 'A'),
(133, '2017-04-11', 'O', 59, NULL, 'NC', NULL, 'ILCU-5111006', 10, 'CONCOR', 'CONCOR', 'L', 14, 0, NULL, NULL, 17, 3500, 7000, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 4045, 4045, 59, 'N', 0, 8000, 3955, '2017-04-13 14:57:47', 'A'),
(134, '2017-04-11', 'O', 41, NULL, 'NC', NULL, 'ILCU-5108954', 10, 'CONCOR', 'CONCOR', 'L', 14, 0, NULL, NULL, 17, 3500, 7000, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 4045, 4045, 59, 'N', 0, 8000, 3955, '2017-04-13 14:58:29', 'A'),
(135, '2017-04-11', 'O', 31, NULL, 'NC', NULL, 'CXNU-0909401', 10, 'CONCOR', 'CONCOR', 'L', 14, 0, NULL, NULL, 10, 3500, 7000, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 4045, 4045, 59, 'N', 0, 8000, 3955, '2017-04-13 15:03:52', 'A'),
(136, '2017-04-12', 'T', 1, NULL, 'NC', NULL, 'CXNU-1119593', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 1, 3000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3445, 3445, 59, 'N', 0, 7300, 3855, '2017-04-18 11:09:51', 'A'),
(137, '2017-04-12', 'T', 8, NULL, 'NC', NULL, 'CXNU-1536236', 13, 'CONCOR', 'CONCOR', 'U', 14, 0, 29, 5500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3474, 3474, 59, 'N', 0, 8500, 5026, '2017-04-18 11:15:31', 'A'),
(138, '2017-04-12', 'T', 9, NULL, 'NC', NULL, 'CXNU-1111910', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 16, 1500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1891, 1891, 59, 'N', 0, 4200, 2309, '2017-04-18 11:16:59', 'A'),
(139, '2017-04-12', 'O', 27, NULL, 'NC', NULL, 'CXNU-1135320', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 13, 1500, 13, 1500, 3700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1891, 1891, 59, 'N', 0, 4200, 2309, '2017-04-18 11:26:03', 'A'),
(140, '2017-04-12', 'O', 44, NULL, 'NC', NULL, 'CXNU-1137534', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, NULL, NULL, 5, 1500, 3700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1891, 1891, 59, 'N', 0, 4200, 2309, '2017-04-18 11:27:17', 'A'),
(141, '2017-04-12', 'O', 31, NULL, 'NC', NULL, 'CXNU-1138567', 176, 'CONCOR', 'CONCOR', 'L', 4, 0, NULL, NULL, 10, 2500, 5300, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2640, 2640, 59, 'N', 0, 5500, 2860, '2017-05-08 15:56:53', 'A'),
(143, '2017-04-12', 'O', 19, NULL, 'NC', NULL, 'CXNU-1318240', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, NULL, NULL, 11, 1500, 3700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1891, 1891, 59, 'N', 0, 4200, 2309, '2017-05-03 14:09:34', 'A'),
(144, '2017-04-12', 'T', 63, NULL, 'NC', NULL, 'CXNU-1144528', 13, 'CONCOR', 'CONCOR', 'U', 14, 0, 34, 3500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3474, 3474, 59, 'N', 0, 8500, 5026, '2017-05-09 13:30:31', 'A'),
(145, '2017-04-18', 'T', 1, NULL, 'NC', NULL, 'MSKU-3712431', 62, 'L&T', 'MCT-5', 'U', 3, 0, 1, 3000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1620, 1620, 60, 'N', 0, 3700, 2080, '2017-04-20 10:27:30', 'A'),
(146, '2017-04-18', 'T', 1, NULL, 'NC', NULL, 'MSKU-3344200', 62, 'CONCOR', 'CONCOR', 'U', 3, 0, 1, 0, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1620, 1620, 60, 'N', 0, 3700, 2080, '2017-04-20 10:28:27', 'A'),
(147, '2017-04-18', 'T', 3, NULL, 'NC', NULL, 'MSKU-2178980', 62, 'L&T', 'MCT-5', 'U', 3, 0, 16, 3000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1620, 1620, 60, 'N', 0, 3700, 2080, '2017-04-20 10:29:30', 'A'),
(148, '2017-04-18', 'T', 3, NULL, 'NC', NULL, 'MSKU-3894300', 62, 'L&T', 'MCT-5', 'U', 3, 0, 16, 0, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1620, 1620, 60, 'N', 0, 3700, 2080, '2017-04-20 10:30:19', 'A'),
(149, '2017-04-18', 'T', 8, NULL, 'NC', NULL, 'CXNU-1310172', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 29, 3000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3480, 3480, 60, 'N', 0, 7300, 3820, '2017-04-20 10:31:03', 'A'),
(150, '2017-04-18', 'T', 13, NULL, 'NC', NULL, 'TGHU-1590017', 62, 'L&T', 'MCT-5', 'U', 3, 0, 17, 2000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1620, 1620, 60, 'N', 0, 3700, 2080, '2017-04-20 10:32:16', 'A'),
(151, '2017-04-18', 'T', 13, NULL, 'NC', NULL, 'MSKU-2064720', 62, 'L&T', 'MCT-5', 'U', 3, 0, 17, 0, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1620, 1620, 60, 'N', 0, 3700, 2080, '2017-04-20 10:33:06', 'A'),
(152, '2017-04-18', 'O', 27, NULL, 'NC', NULL, 'ILCU-5103000', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 13, 3000, 13, 3000, 6700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3480, 3480, 60, 'N', 0, 7300, 3820, '2017-04-20 10:34:03', 'A'),
(153, '2017-04-18', 'T', 57, NULL, 'NC', NULL, 'MSKU-5817730', 62, 'L&T', 'MCT-5', 'U', 3, 0, 33, 1500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1620, 1620, 60, 'N', 0, 3700, 2080, '2017-04-20 10:34:54', 'A'),
(154, '2017-04-17', 'T', 1, NULL, 'NC', NULL, 'CXNU-1112198', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 1, 1500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1904, 1904, 60, 'N', 0, 4200, 2296, '2017-04-20 10:36:25', 'A'),
(155, '2017-04-17', 'T', 3, NULL, 'NC', NULL, 'CXNU-1327370', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 16, 1500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1904, 1904, 60, 'N', 0, 4200, 2296, '2017-04-20 10:37:38', 'A'),
(156, '2017-04-17', 'T', 8, NULL, 'NC', NULL, 'CXNU-1316355', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 29, 2500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3480, 3480, 60, 'N', 0, 7300, 3820, '2017-04-20 10:38:17', 'A'),
(157, '2017-04-17', 'T', 9, NULL, 'NC', NULL, 'CXNU-3211332', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 16, 1500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1904, 1904, 60, 'N', 0, 4200, 2296, '2017-04-20 10:39:55', 'A'),
(158, '2017-04-17', 'O', 11, NULL, 'NC', NULL, 'SCLD-2100577', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 10, 0, 14, 0, 3700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1904, 1904, 60, 'N', 0, 4200, 2296, '2017-04-20 10:41:28', 'A'),
(159, '2017-04-17', 'T', 12, NULL, 'NC', NULL, 'CXNU-1114117', 59, 'CONCOR', 'CONCOR', 'U', 11, 0, 10, 3500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3920, 3920, 60, 'N', 0, 9415, 5495, '2017-04-20 10:46:00', 'A'),
(160, '2017-04-17', 'T', 13, NULL, 'NC', NULL, 'CXNU-1312431', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 17, 3000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3480, 3480, 60, 'N', 0, 7300, 3820, '2017-04-20 10:46:59', 'A'),
(161, '2017-04-17', 'T', 14, NULL, 'NC', NULL, 'CXNU-1127515', 71, 'CONCOR', 'CONCOR', 'U', 11, 0, 33, 3000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3240, 3240, 60, 'N', 0, 6317, 3077, '2017-04-20 10:48:52', 'A'),
(162, '2017-04-17', 'O', 27, NULL, 'NC', NULL, 'SHRU-4211376', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 13, 2500, 13, 2500, 6700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3480, 3480, 60, 'N', 0, 7300, 3820, '2017-04-20 10:51:27', 'A'),
(163, '2017-04-19', 'T', 1, NULL, 'NC', NULL, 'CXNU-1537649', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 1, 1500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1904, 1904, 60, 'N', 0, 4200, 2296, '2017-04-21 10:07:56', 'A'),
(164, '2017-04-19', 'T', 3, NULL, 'NC', NULL, 'CXNU-1324474', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 16, 1500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1904, 1904, 60, 'N', 0, 4200, 2296, '2017-04-21 10:09:21', 'A'),
(165, '2017-04-19', 'T', 8, NULL, 'NC', NULL, 'CXNU-1141051', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 29, 1500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1904, 1904, 60, 'N', 0, 4200, 2296, '2017-04-21 10:10:16', 'A'),
(166, '2017-04-19', 'O', 11, NULL, 'NC', NULL, 'CXNU-1123171', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 10, 3000, 14, 3000, 3700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1904, 1904, 60, 'N', 0, 4200, 2296, '2017-04-21 10:11:25', 'A'),
(167, '2017-04-19', 'T', 13, NULL, 'NC', NULL, 'MSKU-7850673', 62, 'L&T', 'MCT-5', 'U', 3, 0, 17, 3000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1620, 1620, 60, 'N', 0, 3700, 2080, '2017-04-21 10:14:56', 'A'),
(168, '2017-04-19', 'T', 13, NULL, 'NC', NULL, 'MSKU-7122958', 62, 'L&T', 'MCT-5', 'U', 3, 0, 17, 0, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1620, 1620, 60, 'N', 0, 3700, 2080, '2017-04-21 10:16:02', 'A'),
(169, '2017-04-19', 'O', 28, NULL, 'NC', NULL, 'CXNU-1114170', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 31, 1500, 13, 1500, 3700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1904, 1904, 60, 'N', 0, 4200, 2296, '2017-04-21 10:17:25', 'A'),
(170, '2017-04-19', 'T', 57, NULL, 'NC', NULL, 'MSKU-2638303', 62, 'L&T', 'MCT-5', 'U', 3, 0, 33, 3000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1620, 1620, 60, 'N', 0, 3700, 2080, '2017-04-21 10:19:03', 'A'),
(171, '2017-04-19', 'T', 57, NULL, 'NC', NULL, 'MRKU-3764585', 62, 'L&T', 'MCT-5', 'U', 3, 0, 33, 0, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1620, 1620, 60, 'N', 0, 3700, 2080, '2017-04-21 10:19:56', 'A'),
(172, '2017-04-19', 'T', 63, NULL, 'NC', NULL, 'CXNU-1132954', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 34, 1500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 585, 'TOLL 3', 1904, 1904, 60, 'N', 0, 4200, 2296, '2017-04-21 10:22:11', 'A'),
(173, '2017-04-19', 'T', 1, NULL, 'NC', NULL, 'CXNU-1117250', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 1, 1500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1904, 1904, 60, 'N', 0, 4200, 2296, '2017-04-21 10:23:01', 'A'),
(174, '2017-04-19', 'T', 3, NULL, 'NC', NULL, 'CXNU-1143780', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 16, 1500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1904, 1904, 60, 'N', 0, 4200, 2296, '2017-04-21 10:23:51', 'A'),
(175, '2017-04-19', 'O', 11, NULL, 'NC', NULL, 'CXNU-2214276', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 10, 3000, 14, 3000, 6700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3480, 3480, 60, 'N', 0, 7300, 3820, '2017-04-21 10:25:13', 'A'),
(176, '2017-04-19', 'T', 57, NULL, 'NC', NULL, 'CXNU-1142401', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 33, 1500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1904, 1904, 60, 'N', 0, 4200, 2296, '2017-04-21 10:26:03', 'A'),
(177, '2017-04-19', 'T', 13, NULL, 'NC', NULL, 'CXNU-1326918', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 17, 1500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1904, 1904, 60, 'N', 0, 4200, 2296, '2017-04-21 10:26:53', 'A'),
(178, '2017-04-09', 'O', 64, NULL, 'NC', NULL, 'CXNU-2211338', 10, 'CONCOR', 'CONCOR', 'U', 14, 0, NULL, NULL, 22, 3500, 7000, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 4010, 4010, 58, 'N', 0, 8000, 3990, '2017-04-21 19:17:21', 'A'),
(179, '2017-04-10', 'O', 64, NULL, 'NC', NULL, 'CXNU-1130648', 10, 'CONCOR', 'CONCOR', 'U', 14, 0, NULL, NULL, 22, 4000, 7000, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 4010, 4010, 58, 'N', 0, 8000, 3990, '2017-04-21 19:18:23', 'A'),
(180, '2017-04-20', 'T', 1, NULL, 'NC', NULL, 'CXNU-1117250', 72, 'PUZHAL', 'CONCOR', 'U', 1, 0, 1, 3000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2660, 2660, 60, 'N', 0, 6500, 3840, '2017-04-22 10:09:47', 'A'),
(181, '2017-04-20', 'T', 3, NULL, 'NC', NULL, 'CXNU-1140179', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 16, 1500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1904, 1904, 60, 'N', 0, 4200, 2296, '2017-04-22 10:10:39', 'A'),
(182, '2017-04-20', 'T', 8, NULL, 'NC', NULL, 'CXNU-1317876', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 29, 3200, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3480, 3480, 60, 'N', 0, 7300, 3820, '2017-04-22 10:11:34', 'A'),
(183, '2017-04-20', 'T', 9, NULL, 'NC', NULL, 'CXNU-1108201', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 16, 1500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1904, 1904, 60, 'N', 0, 4200, 2296, '2017-04-22 10:12:32', 'A'),
(184, '2017-04-20', 'O', 11, NULL, 'NC', NULL, 'CXNU-2210476', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 10, 3000, 14, 3000, 6700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3480, 3480, 60, 'N', 0, 7300, 3820, '2017-04-22 10:13:58', 'A'),
(185, '2017-04-12', 'T', 58, NULL, 'NC', NULL, 'BLJU-2753531', 178, 'ISO', 'SICAL', 'U', 28, 0, 31, 300, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1029, 1029, 59, 'N', 0, 3220, 2191, '2017-04-22 17:40:24', 'A'),
(186, '2017-04-13', 'T', 1, NULL, 'NC', NULL, 'CXNU-1119593', 74, 'NAGALKENI', 'CONCOR', 'U', 14, 0, 1, 2500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2860, 2860, 59, 'N', 0, 8000, 5140, '2017-04-22 17:41:59', 'A'),
(187, '2017-04-13', 'T', 8, NULL, 'NC', NULL, 'CXNU-1536236', 74, 'NAGALKENI', 'CONCOR', 'L', 14, 0, 29, 2500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2860, 2860, 59, 'N', 0, 8000, 5140, '2017-04-22 17:43:21', 'A'),
(188, '2017-04-13', 'T', 9, NULL, 'NC', NULL, 'CXNU-1111910', 87, 'PUZHAL', 'CONCOR', 'U', 14, 0, 16, 3100, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3510, 3510, 59, 'N', 0, 8000, 4490, '2017-04-22 17:44:19', 'A'),
(189, '2017-04-13', 'T', 63, NULL, 'NC', NULL, 'CXNU-1144528', 74, 'NAGALKENI', 'CONCOR', 'U', 14, 0, 34, 2500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2860, 2860, 59, 'N', 0, 8000, 5140, '2017-04-22 17:45:24', 'A'),
(190, '2017-04-13', 'O', 11, NULL, 'NC', NULL, 'CXNU-1115920', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 10, 3000, 14, 3000, 6700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3445, 3445, 59, 'N', 0, 7300, 3855, '2017-04-22 17:46:37', 'A'),
(191, '2017-04-13', 'T', 13, NULL, 'NC', NULL, 'CXNU-1124394', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 17, 3500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3445, 3445, 59, 'N', 0, 7300, 3855, '2017-04-22 17:47:34', 'A'),
(192, '2017-04-13', 'T', 58, NULL, 'NC', NULL, 'CXNU-1326395', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 16, 1500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1891, 1891, 59, 'N', 0, 4200, 2309, '2017-05-03 15:32:07', 'A'),
(193, '2017-04-13', 'O', 28, NULL, 'NC', NULL, 'CXNU-1127460', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 15, 3000, 13, 3000, 6700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3445, 3445, 59, 'N', 0, 7300, 3855, '2017-04-22 18:02:50', 'A'),
(194, '2017-04-13', 'O', 27, NULL, 'NC', NULL, 'CXNU-1135320', 87, 'PUZHAL', 'CONCOR', 'L', 14, 0, 13, 3000, 13, 3000, 7500, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3510, 3510, 59, 'N', 0, 8000, 4490, '2017-04-22 18:04:42', 'A'),
(195, '2017-04-13', 'T', 57, NULL, 'NC', NULL, 'CXNU-1302053', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 33, 3000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3445, 3445, 59, 'N', 0, 7300, 3855, '2017-04-22 18:09:09', 'A'),
(196, '2017-04-13', 'O', 39, NULL, 'NC', NULL, 'CXNU-0908426', 10, 'CONCOR', 'CONCOR', 'L', 14, 0, NULL, NULL, 17, 3500, 7000, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 4045, 4045, 59, 'N', 0, 8000, 3955, '2017-04-22 18:10:17', 'A'),
(197, '2017-04-13', 'O', 59, NULL, 'NC', NULL, 'CXNU-0907224', 10, 'CONCOR', 'CONCOR', 'L', 14, 0, NULL, NULL, 17, 3500, 7000, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 4045, 4045, 59, 'N', 0, 8000, 3955, '2017-04-22 18:11:35', 'A');
INSERT INTO `daily_moment_details` (`Daily_mvnt_dtl_id`, `Daily_mvnt_dtl_date`, `Daily_mvnt_dtl_transport_type`, `Daily_mvnt_dtl_vehicle_no`, `Daily_mvnt_dtl_other_vehicle_no`, `Daily_mvnt_dtl_container_type`, `Daily_mvnt_dtl_container_no`, `Daily_mvnt_dtl_new_container_no`, `Daily_mvnt_dtl_place`, `Daily_mvnt_dtl_pickup_place`, `Daily_mvnt_dtl_drop_place`, `Daily_mvnt_dtl_loading_status`, `Daily_mvnt_dtl_party_name`, `Daily_mvnt_dtl_party_adv`, `Daily_mvnt_dtl_driver_name`, `Daily_mvnt_dtl_advance`, `Daily_mvnt_dtl_trp_name`, `Daily_mvnt_dtl_trp_adv`, `Daily_mvnt_dtl_trp_rent`, `Daily_mvnt_dtl_trp_expences`, `Daily_mvnt_dtl_trp_sum`, `Daily_mvnt_dtl_trp_exp_remark`, `Daily_mvnt_dtl_transport_pay_status`, `Daily_mvnt_dtl_party_pay_date`, `Daily_mvnt_dtl_party_pay_status`, `Daily_mvnt_dtl_driver_pay_date`, `Daily_mvnt_dtl_driver_pay_status`, `Daily_mvnt_dtl_other_expences`, `Daily_mvnt_dtl_driver_remark`, `Daily_mvnt_dtl_driver_basic_pay`, `Daily_mvnt_dtl_driver_total_pay`, `Daily_mvnt_dtl_diesel_rate`, `Daily_mvnt_dtl_diesel_rate_status`, `Daily_mvnt_dtl_party_mamul`, `Daily_mvnt_dtl_rent`, `Daily_mvnt_dtl_profit`, `Daily_mvnt_dtl_created_dt_time`, `Daily_mvnt_dtl_status`) VALUES
(198, '2017-04-13', 'O', 41, NULL, 'NC', NULL, 'CXNU-0904061', 10, 'CONCOR', 'CONCOR', 'L', 14, 0, NULL, NULL, 17, 3500, 7000, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 4045, 4045, 59, 'N', 0, 8000, 3955, '2017-04-24 10:48:35', 'A'),
(199, '2017-04-13', 'O', 38, NULL, 'NC', NULL, 'CXNU-0908241', 10, 'CONCOR', 'CONCOR', 'L', 14, 0, NULL, NULL, 17, 3500, 7000, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 4045, 4045, 59, 'N', 0, 8000, 3955, '2017-04-24 10:52:14', 'A'),
(200, '2017-04-13', 'O', 19, NULL, 'NC', NULL, 'CXNU-1318240', 87, 'PUZHAL', 'CONCOR', 'L', 14, 0, NULL, NULL, 11, 3500, 7000, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3510, 3510, 59, 'N', 0, 8000, 4490, '2017-04-24 10:58:12', 'A'),
(201, '2017-04-13', 'O', 44, NULL, 'NC', NULL, 'CXNU-1137534', 87, 'PUZHAL', 'CONCOR', 'L', 14, 0, NULL, NULL, 5, 3500, 7000, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3510, 3510, 59, 'N', 0, 8000, 4490, '2017-04-24 10:59:27', 'A'),
(202, '2017-04-14', 'T', 1, NULL, 'NC', NULL, 'ILCU-5103839', 172, 'CONCOR', 'CONCOR', 'U', 17, 0, 1, 8000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 8900, 8900, 59, 'N', 0, 17500, 8600, '2017-04-27 15:59:04', 'A'),
(203, '2017-04-14', 'T', 8, NULL, 'NC', NULL, 'CXNU-1138314', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 29, 4000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3445, 3445, 59, 'N', 0, 7300, 3855, '2017-04-24 12:11:54', 'A'),
(204, '2017-04-14', 'O', 11, NULL, 'NC', NULL, 'CXNU-1115920', 74, 'NAGALKENI', 'CONCOR', 'L', 14, 0, 10, 2500, 14, 2500, 7500, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2860, 2860, 59, 'N', 0, 8000, 5140, '2017-05-10 11:29:46', 'A'),
(205, '2017-04-14', 'T', 13, NULL, 'NC', NULL, 'CXNU-1124394', 74, 'NAGALKENI', 'CONCOR', 'L', 14, 0, 17, 2500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2860, 2860, 59, 'N', 0, 8000, 5140, '2017-04-24 12:25:16', 'A'),
(206, '2017-04-14', 'O', 28, NULL, 'NC', NULL, 'CXNU-1127460', 74, 'NAGALKENI', 'CONCOR', 'L', 14, 0, 15, 2500, 13, 2500, 7500, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2860, 2860, 59, 'N', 0, 8000, 5140, '2017-05-10 11:10:04', 'A'),
(207, '2017-04-14', 'O', 27, NULL, 'NC', NULL, 'BLJU-2750358', 133, 'CONCOR', 'CONCOR', 'U', 28, 0, 13, 3500, 13, 3500, 7500, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3175, 3175, 59, 'N', 0, 8000, 4825, '2017-04-24 12:28:34', 'A'),
(208, '2017-04-14', 'T', 57, NULL, 'NC', NULL, 'CXNU-1142335', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 33, 3000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3445, 3445, 59, 'N', 0, 7300, 3855, '2017-04-24 12:29:47', 'A'),
(209, '2017-04-13', 'O', 56, NULL, 'NC', NULL, 'CXNU-1129668', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, NULL, NULL, 12, 1500, 3700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1891, 1891, 59, 'N', 0, 4200, 2309, '2017-04-24 16:06:24', 'A'),
(210, '2017-04-13', 'O', 24, NULL, 'NC', NULL, 'CXNU-1324833', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, NULL, NULL, 12, 1500, 3700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1891, 1891, 59, 'N', 0, 4200, 2309, '2017-04-24 16:08:10', 'A'),
(211, '2017-04-13', 'O', 31, NULL, 'NC', NULL, 'BLJU-2181647', 2, 'CONCOR', 'CONCOR', 'U', 28, 0, NULL, NULL, 10, 2500, 5000, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2285, 2285, 59, 'N', 0, 5500, 3215, '2017-04-24 16:10:24', 'A'),
(212, '2017-04-13', 'T', 3, NULL, 'NC', NULL, 'BLJU-2452060', 178, 'CONCOR', 'SICAL', 'U', 28, 0, 31, 700, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1029, 1029, 59, 'N', 0, 3160, 2131, '2017-05-09 12:05:16', 'A'),
(213, '2017-04-13', 'T', 3, NULL, 'NC', NULL, 'BLJU-2129464', 178, 'CONCOR', 'SICAL', 'U', 28, 0, 31, 700, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1029, 1029, 59, 'N', 0, 3160, 2131, '2017-05-09 12:05:41', 'A'),
(214, '2017-04-14', 'O', 59, NULL, 'NC', NULL, 'CXNU-1324833', 10, 'CONCOR', 'CONCOR', 'L', 14, 0, NULL, NULL, 17, 0, 7000, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 4045, 4045, 59, 'N', 0, 8000, 3955, '2017-04-24 16:15:44', 'A'),
(215, '2017-04-14', 'O', 24, NULL, 'NC', NULL, 'CXNU-1549465', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, NULL, NULL, 12, 1500, 3700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1891, 1891, 59, 'N', 0, 4200, 2309, '2017-04-24 16:16:45', 'A'),
(216, '2017-04-14', 'O', 23, NULL, 'NC', NULL, 'CXNU-1535311', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, NULL, NULL, 12, 1500, 3700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1891, 1891, 59, 'N', 0, 4200, 2309, '2017-04-24 16:17:31', 'A'),
(217, '2017-04-14', 'O', 43, NULL, 'NC', NULL, 'CXNU-2214872', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, NULL, NULL, 17, 0, 3700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1891, 1891, 59, 'N', 0, 4200, 2309, '2017-04-24 16:18:44', 'A'),
(218, '2017-04-14', 'O', 38, NULL, 'NC', NULL, 'RPGU-2030283', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, NULL, NULL, 17, 0, 3700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1891, 1891, 59, 'N', 0, 4200, 2309, '2017-04-24 16:21:11', 'A'),
(219, '2017-04-14', 'T', 63, NULL, 'NC', NULL, 'CXNU-1326498', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 34, 4000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3445, 3445, 59, 'N', 0, 7300, 3855, '2017-04-24 16:22:29', 'A'),
(220, '2017-04-14', 'O', 19, NULL, 'NC', NULL, 'CXNU-1300528', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, NULL, NULL, 11, 3000, 6700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3445, 3445, 59, 'N', 0, 7300, 3855, '2017-04-24 16:23:31', 'A'),
(221, '2017-04-15', 'T', 3, NULL, 'NC', NULL, 'BLJU-2655875', 133, 'CONCOR', 'CONCOR', 'U', 28, 0, 16, 3000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3175, 3175, 59, 'N', 0, 8000, 4825, '2017-04-24 16:25:01', 'A'),
(222, '2017-04-15', 'O', 61, NULL, 'NC', NULL, 'CXNU-1301571', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, NULL, NULL, 21, 0, 6700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3445, 3445, 59, 'N', 0, 7300, 3855, '2017-04-24 16:26:36', 'A'),
(223, '2017-04-16', 'T', 1, NULL, 'NC', NULL, 'CXNU-1142715', 32, 'CONCOR', 'CONCOR', 'U', 12, 0, 1, 3000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3440, 3440, 60, 'N', 0, 6500, 3060, '2017-04-24 16:30:35', 'A'),
(224, '2017-04-16', 'T', 3, NULL, 'NC', NULL, 'CXNU-1123274', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 16, 1500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1904, 1904, 60, 'N', 0, 4200, 2296, '2017-04-24 16:32:43', 'A'),
(225, '2017-04-16', 'T', 8, NULL, 'NC', NULL, 'CXNU-1138314', 82, 'NAGALKENI', 'CONCOR', 'L', 12, 0, 29, 2000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2420, 2420, 60, 'N', 0, 6500, 4080, '2017-04-24 16:34:22', 'A'),
(226, '2017-04-16', 'T', 9, NULL, 'NC', NULL, 'CXNU-1115176', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 16, 1500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1904, 1904, 60, 'N', 0, 4200, 2296, '2017-04-24 16:35:19', 'A'),
(227, '2017-04-16', 'O', 11, NULL, 'NC', NULL, 'CXNU-1311498', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 10, 3000, 14, 3000, 6700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3480, 3480, 60, 'N', 0, 7300, 3820, '2017-04-24 16:36:49', 'A'),
(228, '2017-04-16', 'T', 12, NULL, 'NC', NULL, 'CXNU-1122318', 71, 'CONCOR', 'CONCOR', 'U', 11, 0, 10, 3000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3240, 3240, 60, 'N', 0, 6317, 3077, '2017-04-24 16:46:49', 'A'),
(229, '2017-04-16', 'T', 13, NULL, 'NC', NULL, 'CXNU-2211868', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 17, 1500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1904, 1904, 60, 'N', 0, 4200, 2296, '2017-04-24 16:54:38', 'A'),
(230, '2017-04-16', 'O', 28, NULL, 'NC', NULL, 'CXNU-1106723', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 17, 1500, 13, 1500, 3700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1904, 1904, 60, 'N', 0, 4200, 2296, '2017-04-24 16:56:15', 'A'),
(231, '2017-04-16', 'O', 27, NULL, 'NC', NULL, 'BLJU-2851100', 178, 'CONCOR', 'SICAL', 'L', 28, 0, 13, 500, 13, 500, 1250, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1036, 1036, 60, 'N', 0, 1500, 464, '2017-05-10 11:22:18', 'A'),
(232, '2017-04-16', 'T', 57, NULL, 'NC', NULL, 'CXNU-1142335', 82, 'NAGALKNI', 'CONCOR', 'L', 12, 0, 33, 2000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2420, 2420, 60, 'N', 0, 6500, 4080, '2017-04-24 16:58:58', 'A'),
(233, '2017-04-16', 'T', 63, NULL, 'NC', NULL, 'CXNU-1326498', 82, 'NAGALKENI', 'CONCOR', 'L', 12, 0, 34, 2000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 180, 'PUNCHER', 2420, 2420, 60, 'N', 0, 6500, 4080, '2017-05-05 16:49:07', 'A'),
(234, '2017-04-16', 'O', 27, NULL, 'NC', NULL, 'CXNU-1142309', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 13, 3000, 13, 3000, 6700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3480, 3480, 60, 'N', 0, 7300, 3820, '2017-04-24 17:03:49', 'A'),
(235, '2017-04-16', 'T', 57, NULL, 'NC', NULL, 'CXNU-1305089', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 33, 3000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3480, 3480, 60, 'N', 0, 7300, 3820, '2017-04-24 17:05:09', 'A'),
(236, '2017-04-16', 'T', 8, NULL, 'NC', NULL, 'CXNU-1311965', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 29, 3000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3480, 3480, 60, 'N', 0, 7300, 3820, '2017-04-24 17:20:25', 'A'),
(237, '2017-04-16', 'T', 63, NULL, 'NC', NULL, 'CXNU-1302011', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 34, 3000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3480, 3480, 60, 'N', 0, 7300, 3820, '2017-04-24 17:21:15', 'A'),
(238, '2017-04-16', 'O', 59, NULL, 'NC', NULL, 'CXNU-3211585', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, NULL, NULL, 17, 1500, 3700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1904, 1904, 60, 'N', 0, 4200, 2296, '2017-04-24 17:22:30', 'A'),
(239, '2017-04-16', 'O', 27, NULL, 'NC', NULL, 'CXNU-1142309', 74, 'NAGALKENI', 'CONCOR', 'L', 14, 0, 13, 2000, 13, 2000, 7500, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2880, 2880, 60, 'N', 0, 8000, 5120, '2017-05-10 11:21:26', 'A'),
(240, '2017-04-17', 'T', 63, NULL, 'NC', NULL, 'SHRU-4210805', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 34, 1500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1904, 1904, 60, 'N', 0, 4200, 2296, '2017-04-24 17:37:00', 'A'),
(242, '2017-04-20', 'T', 13, NULL, 'NC', NULL, 'CXNU-1109276', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 17, 1500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1904, 1904, 60, 'N', 0, 4200, 2296, '2017-04-24 18:34:39', 'A'),
(243, '2017-04-20', 'O', 28, NULL, 'NC', NULL, 'CXNU-1105394', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 17, 1500, 13, 1500, 3700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1904, 1904, 60, 'N', 0, 4200, 2296, '2017-04-24 18:42:40', 'A'),
(244, '2017-04-20', 'T', 57, NULL, 'NC', NULL, 'CXNU-1543066', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 33, 1500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1904, 1904, 60, 'N', 0, 4200, 2296, '2017-04-24 18:44:44', 'A'),
(245, '2017-04-20', 'O', 44, NULL, 'NC', NULL, 'CXNU-1109867', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, NULL, NULL, 5, 1500, 3700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1904, 1904, 60, 'N', 0, 4200, 2296, '2017-04-24 18:45:57', 'A'),
(246, '2017-04-20', 'T', 63, NULL, 'NC', NULL, 'CXNU-1113260', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 34, 1500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1904, 1904, 60, 'N', 0, 4200, 2296, '2017-04-24 18:49:59', 'A'),
(247, '2017-04-21', 'T', 1, NULL, 'NC', NULL, 'CXNU-1540637', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 1, 1500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1904, 1904, 60, 'N', 0, 4200, 2296, '2017-04-24 18:51:12', 'A'),
(248, '2017-04-24', 'T', 3, NULL, 'NC', NULL, 'GESU-8066056', 182, 'SICAL', 'CONCOR', 'L', 2, 0, 16, 2000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2868, 2868, 60, 'N', 0, 4000, 1132, '2017-04-26 10:40:05', 'A'),
(249, '2017-04-21', 'T', 3, NULL, 'NC', NULL, 'CXNU-1108747', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 16, 1500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1904, 1904, 60, 'N', 0, 4200, 2296, '2017-04-26 11:11:15', 'A'),
(250, '2017-04-21', 'T', 8, NULL, 'NC', NULL, 'CXNU-1317270', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 29, 3000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3480, 3480, 60, 'N', 0, 7300, 3820, '2017-04-26 11:12:12', 'A'),
(251, '2017-04-21', 'O', 11, NULL, 'NC', NULL, 'CXNU-1329223', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 10, 3000, 14, 3000, 6700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3480, 3480, 60, 'N', 0, 7300, 3820, '2017-04-26 11:13:13', 'A'),
(252, '2017-04-21', 'T', 9, NULL, 'NC', NULL, 'CXNU-1535651', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 16, 1500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1904, 1904, 60, 'N', 0, 4200, 2296, '2017-04-26 11:14:51', 'A'),
(253, '2017-04-21', 'T', 13, NULL, 'NC', NULL, 'CXNU-1136395', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 17, 1500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1904, 1904, 60, 'N', 0, 4200, 2296, '2017-04-26 11:16:17', 'A'),
(254, '2017-04-21', 'T', 14, NULL, 'NC', NULL, 'CXNU-1109759', 32, 'CONCOR', 'CONCOR', 'U', 11, 0, 33, 3000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3440, 3440, 60, 'N', 0, 6500, 3060, '2017-04-26 11:17:29', 'A'),
(255, '2017-04-21', 'O', 28, NULL, 'NC', NULL, 'CXNU-1128039', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 17, 1000, 13, 1000, 3700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1904, 1904, 60, 'N', 0, 4200, 2296, '2017-04-26 11:18:17', 'A'),
(256, '2017-04-21', 'O', 27, NULL, 'NC', NULL, 'CXNU-3211712', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 13, 3000, 13, 3000, 6700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3480, 3480, 60, 'N', 0, 7300, 3820, '2017-04-26 11:19:10', 'A'),
(257, '2017-04-21', 'T', 57, NULL, 'NC', NULL, 'CXNU-1132975', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 33, 1500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1904, 1904, 60, 'N', 0, 4200, 2296, '2017-04-26 11:19:54', 'A'),
(258, '2017-04-21', 'T', 58, NULL, 'NC', NULL, 'SHRU-4210493', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 34, 3000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3480, 3480, 60, 'N', 0, 7300, 3820, '2017-04-26 11:20:41', 'A'),
(259, '2017-04-21', 'O', 28, NULL, 'NC', NULL, 'CXNU-1106390', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 17, 1500, 13, 1500, 3700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1904, 1904, 60, 'N', 0, 4200, 2296, '2017-04-26 11:21:14', 'A'),
(260, '2017-04-21', 'O', 61, NULL, 'NC', NULL, 'CXNU-1542563', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, NULL, NULL, 21, 1500, 3700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1904, 1904, 60, 'N', 0, 4200, 2296, '2017-04-26 11:22:34', 'A'),
(261, '2017-04-22', 'T', 3, NULL, 'NC', NULL, 'GESU-8102195', 182, 'SICAL', 'CONCOR', 'U', 2, 0, 16, 2000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2868, 2868, 60, 'N', 0, 4000, 1132, '2017-04-26 11:23:53', 'A'),
(262, '2017-04-22', 'T', 8, NULL, 'NC', NULL, 'CXNU-1317270', 82, 'NAGALKENI', 'CONCOR', 'L', 12, 0, 29, 2000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2420, 2420, 60, 'N', 0, 6500, 4080, '2017-04-26 11:24:52', 'A'),
(263, '2017-04-22', 'O', 11, NULL, 'NC', NULL, 'CXNU-1329223', 82, 'NAGALKENI', 'CONCOR', 'L', 12, 0, 10, 2000, 14, 2000, 5500, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2420, 2420, 60, 'N', 0, 6000, 3580, '2017-05-10 11:29:21', 'A'),
(264, '2017-04-22', 'T', 13, NULL, 'NC', NULL, 'SEGU-8023151', 182, 'SICAL', 'CONCOR', 'L', 2, 0, 33, 2000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2868, 2868, 60, 'N', 0, 4000, 1132, '2017-04-26 11:26:43', 'A'),
(265, '2017-04-22', 'O', 27, NULL, 'NC', NULL, 'CXNU-3211712', 82, 'NAGALKENI', 'CONCOR', 'L', 12, 0, 13, 2000, 13, 2000, 5500, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2420, 2420, 60, 'N', 0, 6000, 3580, '2017-05-10 11:22:52', 'A'),
(266, '2017-04-23', 'T', 1, NULL, 'NC', NULL, 'CXNU-2215630', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 1, 1500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1904, 1904, 60, 'N', 0, 4200, 2296, '2017-04-26 11:28:22', 'A'),
(267, '2017-04-23', 'T', 3, NULL, 'NC', NULL, 'CXNU-0906207', 32, 'CONCOR', 'CONCOR', 'L', 12, 0, 16, 3000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3440, 3440, 60, 'N', 0, 6500, 3060, '2017-04-26 11:29:08', 'A'),
(268, '2017-04-23', 'T', 8, NULL, 'NC', NULL, 'CXNU-1536920', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 29, 3200, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3480, 3480, 60, 'N', 0, 7300, 3820, '2017-04-26 11:29:57', 'A'),
(269, '2017-04-23', 'O', 11, NULL, 'NC', NULL, 'ILCU-5107095', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 10, 1500, 14, 1500, 3700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1904, 1904, 60, 'N', 0, 4200, 2296, '2017-04-26 11:30:40', 'A'),
(270, '2017-04-23', 'T', 12, NULL, 'NC', NULL, 'CXNU-1546240', 59, 'CONCOR', 'CONCOR', 'U', 11, 0, 10, 3500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3920, 3920, 60, 'N', 0, 9000, 5080, '2017-04-26 11:31:24', 'A'),
(271, '2017-04-23', 'T', 13, NULL, 'NC', NULL, 'SCLD-2100670', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 13, 1500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1904, 1904, 60, 'N', 0, 4200, 2296, '2017-04-26 11:32:13', 'A'),
(272, '2017-04-23', 'O', 27, NULL, 'NC', NULL, 'CXNU-1125404', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, 13, 1500, 13, 1500, 3700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1904, 1904, 60, 'N', 0, 4200, 2296, '2017-04-26 11:33:17', 'A'),
(273, '2017-04-23', 'T', 57, NULL, 'NC', NULL, 'CXNU-0907651', 32, 'CONCOR', 'CONCOR', 'L', 12, 0, 33, 3000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3440, 3440, 60, 'N', 0, 6500, 3060, '2017-04-26 11:34:11', 'A'),
(274, '2017-04-23', 'T', 63, NULL, 'NC', NULL, 'CXNU-1112114', 29, 'CONCOR', 'CONCOR', 'U', 1, 0, 34, 3000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3480, 3480, 60, 'N', 0, 7300, 3820, '2017-04-26 11:34:58', 'A'),
(275, '2017-04-24', 'T', 8, NULL, 'NC', NULL, 'CXNU-1536920', 82, 'NAGALKENI', 'CONCOR', 'L', 12, 0, 29, 2000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2420, 2420, 60, 'N', 0, 6500, 4080, '2017-04-26 11:37:22', 'A'),
(276, '2017-04-24', 'T', 12, NULL, 'NC', NULL, 'CXNU-1535693', 32, 'CONCOR', 'CONCOR', 'U', 11, 0, 10, 3000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3440, 3440, 60, 'N', 0, 6500, 3060, '2017-04-26 11:38:21', 'A'),
(277, '2017-04-24', 'T', 13, NULL, 'NC', NULL, 'SEGU-8024271', 182, 'SICAL', 'CONCOR', 'L', 2, 0, 13, 2000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2868, 2868, 60, 'N', 0, 4000, 1132, '2017-04-26 11:39:33', 'A'),
(278, '2017-04-24', 'T', 14, NULL, 'NC', NULL, 'CXNU-1320458', 61, 'CONCOR', 'CONCOR', 'U', 11, 0, 33, 2200, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2476, 2476, 60, 'N', 0, 4600, 2124, '2017-04-26 11:40:33', 'A'),
(279, '2017-04-24', 'T', 12, NULL, 'NC', NULL, 'CXNU-2225330', 61, 'CONCOR', 'CONCOR', 'U', 11, 0, 1, 2200, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2476, 2476, 60, 'N', 0, 4600, 2124, '2017-04-26 11:41:42', 'A'),
(280, '2017-04-24', 'T', 63, NULL, 'NC', NULL, 'CXNU-1112114', 82, 'NAGALKENI', 'CONCOR', 'L', 12, 0, 34, 2500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2420, 2420, 60, 'N', 0, 6500, 4080, '2017-04-26 11:42:36', 'A'),
(281, '2017-04-22', 'T', 1, NULL, 'NC', NULL, 'CXNU-1540637', 72, 'PUZHAL', 'CONCOR', 'L', 12, 0, 1, 2500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2660, 2660, 60, 'N', 0, 6500, 3840, '2017-04-28 11:40:10', 'A'),
(282, '2017-04-06', 'O', 65, NULL, 'NC', NULL, 'ILCU-5105317', 34, 'CONCOR', 'CONCOR', 'U', 1, 0, NULL, NULL, 23, 0, 3700, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1891, 1891, 59, 'N', 0, 4200, 2309, '2017-05-01 12:13:28', 'A'),
(283, '2017-04-08', 'T', 1, NULL, 'NC', NULL, 'CXNU-1522320', 136, 'CONCOR', 'CONCOR', 'L', 21, 0, 13, 8000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 8870, 8870, 59, 'N', 0, 16500, 7630, '2017-05-09 12:00:44', 'A'),
(284, '2017-04-09', 'O', 66, NULL, 'NC', NULL, 'CXNU-0906022', 10, 'CONCOR', 'CONCOR', 'L', 14, 0, NULL, NULL, 24, 3500, 7000, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 4045, 4045, 59, 'N', 0, 8000, 3955, '2017-05-01 12:26:20', 'A'),
(285, '2017-04-09', 'O', 67, NULL, 'NC', NULL, 'ILCU-5256782', 10, 'CONCOR', 'CONCOR', 'L', 14, 0, NULL, NULL, 25, 3500, 7000, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 4045, 4045, 59, 'N', 0, 8000, 3955, '2017-05-01 12:32:17', 'A'),
(286, '2017-04-12', 'T', 3, NULL, 'NC', NULL, 'BLJU-2656594', 178, 'SICAL', 'CONCOR', 'U', 28, 0, 35, 300, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1029, 1029, 59, 'N', 0, 3220, 2191, '2017-05-01 12:42:00', 'A'),
(287, '2017-04-18', 'O', 68, NULL, 'NC', NULL, 'TSAU-2504403', 48, 'CONCOR', 'CONCOR', 'U', 26, 0, NULL, NULL, 26, 0, 4750, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 4360, 4360, 60, 'N', 0, 8000, 3640, '2017-05-08 16:09:01', 'A'),
(288, '2017-04-18', 'O', 68, NULL, 'NC', NULL, 'TSAU-2604589', 48, 'CONCOR', 'CONCOR', 'U', 26, 0, NULL, NULL, 26, 0, 4750, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 4360, 4360, 60, 'N', 0, 8000, 3640, '2017-05-08 16:09:38', 'A'),
(289, '2017-04-19', 'T', 12, NULL, 'NC', NULL, 'CXNU-1537649', 181, 'CONCOR', 'CONCOR', 'L', 11, 0, 16, 1200, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1614, 1614, 60, 'N', 0, 4000, 2386, '2017-05-01 13:30:12', 'A'),
(290, '2017-04-19', 'T', 14, NULL, 'NC', NULL, 'CXNU-1324474', 181, 'CONCOR', 'CONCOR', 'L', 11, 0, 33, 1200, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1614, 1614, 60, 'N', 0, 4000, 2386, '2017-05-01 13:31:39', 'A'),
(291, '2017-04-19', 'O', 27, NULL, 'NC', NULL, 'ILCU-5103000', 82, 'NAGALKENI', 'CONCOR', 'L', 12, 0, 13, 2500, 13, 2500, 5500, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2420, 2420, 60, 'N', 0, 6000, 3580, '2017-05-01 13:35:07', 'A'),
(292, '2017-04-19', 'T', 63, NULL, 'NC', NULL, 'CXNU-1132954', 72, 'PUZHAL', 'CONCOR', 'L', 12, 0, 34, 3000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2660, 2660, 60, 'N', 0, 6000, 3340, '2017-05-01 13:36:27', 'A'),
(293, '2017-04-25', 'T', 1, NULL, 'NC', NULL, 'PONU-0264077', 62, 'L&T', 'MCT-5', 'U', 3, 0, 1, 1500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1620, 1620, 60, 'N', 0, 3700, 2080, '2017-05-01 14:11:29', 'A'),
(294, '2017-04-25', 'T', 1, NULL, 'NC', NULL, 'CXNU-1320458', 10, 'CONCOR', 'CONCOR', 'L', 14, 0, 1, 3500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 4080, 4080, 60, 'N', 0, 8000, 3920, '2017-05-01 14:13:21', 'A'),
(295, '2017-04-25', 'T', 9, NULL, 'NC', NULL, 'MSKU-3357830', 62, 'L&T', 'MCT-5', 'U', 3, 0, 16, 3000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1620, 1620, 60, 'N', 0, 3700, 2080, '2017-05-01 14:16:25', 'A'),
(296, '2017-04-29', 'T', 12, NULL, 'NC', NULL, 'CXNU-1106718', 32, 'CONCOR', 'CONCOR', 'U', 11, 0, 16, 3000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3440, 3440, 60, 'N', 0, 7000, 3560, '2017-05-05 10:15:46', 'A'),
(297, '2017-04-29', 'O', 27, NULL, 'NC', NULL, 'CXNU-1548962', 180, 'CONCOR', 'CONCOR', 'U', 21, 0, 13, 8000, 13, 8000, 12500, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 9520, 9520, 60, 'N', 0, 13500, 3980, '2017-05-10 11:24:59', 'A'),
(298, '2017-04-27', 'T', 1, NULL, 'NC', NULL, 'CXNU-0901490', 172, 'CONCOR', 'CONCOR', 'U', 17, 0, 1, 8000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 9000, 9000, 60, 'N', 0, 17500, 8500, '2017-05-10 12:16:05', 'A'),
(299, '2017-04-27', 'T', 7, NULL, 'NC', NULL, 'CXNU-1324160', 144, 'CONCOR', 'CONCOR', 'L', 11, 0, 16, 1500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1556, 1556, 60, 'N', 0, 4000, 2444, '2017-05-05 10:19:49', 'A'),
(300, '2017-04-27', 'T', 57, NULL, 'NC', NULL, 'SSNU-2008234', 21, 'L&T', 'MCT-5', 'U', 2, 0, 33, 3500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3870, 3870, 60, 'N', 0, 7000, 3130, '2017-05-06 16:54:33', 'A'),
(301, '2017-04-27', 'T', 63, NULL, 'NC', NULL, 'CXNU-1318358', 10, 'CONCOR', 'CONCOR', 'L', 14, 0, 34, 3500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 4080, 4080, 60, 'N', 0, 8000, 3920, '2017-05-05 10:23:29', 'A'),
(302, '2017-04-28', 'T', 3, NULL, 'NC', NULL, 'SEGU-8023146', 182, 'CONCOR', 'CONCOR', 'L', 2, 0, 13, 2500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2868, 2868, 60, 'N', 0, 7000, 4132, '2017-05-05 10:24:47', 'A'),
(303, '2017-04-28', 'T', 9, NULL, 'NC', NULL, 'CXNU-1545653', 10, 'CONCOR', 'CONCOR', 'L', 14, 0, 16, 3500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 4080, 4080, 60, 'N', 0, 8000, 3920, '2017-05-05 10:25:38', 'A'),
(304, '2017-04-28', 'O', 11, NULL, 'NC', NULL, 'CXNU-1320191', 10, 'CONCOR', 'CONCOR', 'L', 14, 0, 10, 3500, 14, 3500, 7500, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 4080, 4080, 60, 'N', 0, 8000, 3920, '2017-05-05 10:26:34', 'A'),
(305, '2017-04-28', 'T', 13, NULL, 'NC', NULL, 'GESU-8067392', 182, 'L&T', 'SICAL', 'L', 14, 0, 17, 2850, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2868, 2868, 60, 'N', 0, 7000, 4132, '2017-05-05 10:27:55', 'A'),
(306, '2017-04-28', 'O', 28, NULL, 'NC', NULL, 'CXNU-1545691', 3, 'CONCOR', 'CONCOR', 'L', 8, 0, 29, 2500, 13, 2500, 4500, 0, 'A', '', 'U', '2017-05-16', 'P', '0000-00-00', 'U', 0, '', 2676, 2676, 60, 'N', 0, 5000, 2324, '2017-05-05 10:30:47', 'A'),
(307, '2017-04-28', 'T', 63, NULL, 'NC', NULL, 'ILCU-5112110', 10, 'CONCOR', 'CONCOR', 'L', 14, 0, 34, 3500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 1400, 'HALT', 4080, 4080, 60, 'N', 0, 8000, 3920, '2017-05-05 10:31:35', 'A'),
(308, '2017-04-26', 'T', 3, NULL, 'NC', NULL, 'TTNU-2657820', 31, 'L&T', 'MCT-5', 'U', 2, 0, 13, 3000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1680, 1680, 60, 'N', 0, 5000, 3320, '2017-05-05 10:33:50', 'A'),
(309, '2017-04-26', 'O', 11, NULL, 'NC', NULL, 'CXNU-1119628', 10, 'CONCOR', 'CONCOR', 'L', 14, 0, 10, 4000, 14, 4000, 7500, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 4080, 4080, 60, 'N', 0, 8000, 3920, '2017-05-05 10:36:04', 'A'),
(310, '2017-04-26', 'T', 57, NULL, 'NC', NULL, 'GESU-1127226', 96, 'L&T', 'MCT-5', 'U', 2, 0, 33, 2500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 1000, 'L&T PORT', 1564, 1564, 60, 'N', 0, 5000, 3436, '2017-05-06 16:59:19', 'A'),
(311, '2017-04-25', 'T', 9, NULL, 'NC', NULL, 'DAYU-2160644', 62, 'L&T', 'MCT-5', 'U', 3, 0, 16, 0, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1620, 1620, 60, 'N', 0, 3700, 2080, '2017-05-05 10:40:21', 'A'),
(312, '2017-04-26', 'T', 9, NULL, 'NC', NULL, 'BMOU-2472224', 62, 'L&T', 'MCT-5', 'U', 3, 0, 16, 2000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1620, 1620, 60, 'N', 0, 3700, 2080, '2017-05-05 10:43:40', 'A'),
(313, '2017-04-25', 'O', 28, NULL, 'NC', NULL, 'TCLU-7466880', 62, 'L&T', 'MCT-5', 'U', 3, 0, 29, 3000, 13, 3000, 3200, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1620, 1620, 60, 'N', 0, 3700, 2080, '2017-05-05 10:48:10', 'A'),
(314, '2017-04-25', 'O', 28, NULL, 'NC', NULL, 'MRSU-0206974', 62, 'L&T', 'MCT-5', 'U', 3, 0, 29, 0, 13, 0, 3200, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1620, 1620, 60, 'N', 0, 3700, 2080, '2017-05-05 10:51:28', 'A'),
(315, '2017-04-25', 'T', 8, NULL, 'NC', NULL, 'MSKU-3374653', 62, 'L&T', 'MCT-5', 'U', 3, 0, 29, 3000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1620, 1620, 60, 'N', 0, 3700, 2080, '2017-05-05 10:52:34', 'A'),
(316, '2017-04-25', 'T', 8, NULL, 'NC', NULL, 'MUIU-2000746', 62, 'L&T', 'MCT-5', 'U', 3, 0, 29, 0, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1620, 1620, 60, 'N', 0, 3700, 2080, '2017-05-05 10:53:16', 'A'),
(317, '2017-04-25', 'O', 11, NULL, 'NC', NULL, 'MSKU-5744232', 62, 'L&T', 'MCT-5', 'U', 3, 0, 10, 3000, 14, 3000, 3200, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1620, 1620, 60, 'N', 0, 3700, 2080, '2017-05-05 10:54:21', 'A'),
(318, '2017-04-25', 'O', 11, NULL, 'NC', NULL, 'MSKU-7940208', 62, 'L&T', 'MCT-5', 'U', 3, 0, 10, 0, 14, 0, 3200, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1620, 1620, 60, 'N', 0, 3700, 2080, '2017-05-05 10:55:05', 'A'),
(319, '2017-04-26', 'O', 11, NULL, 'NC', NULL, 'MRKU-9808523', 62, 'L&T', 'MCT-5', 'U', 3, 0, 10, 1000, 14, 1000, 3200, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1620, 1620, 60, 'N', 0, 3700, 2080, '2017-05-05 10:56:40', 'A'),
(320, '2017-04-25', 'T', 57, NULL, 'NC', NULL, 'PONU-0894237', 62, 'L&T', 'MCT-5', 'U', 3, 0, 33, 4500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1620, 1620, 60, 'N', 0, 3700, 2080, '2017-05-05 10:57:35', 'A'),
(321, '2017-04-25', 'T', 57, NULL, 'NC', NULL, 'TGHU-0384618', 62, 'L&T', 'MCT-5', 'U', 3, 0, 33, 0, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1620, 1620, 60, 'N', 0, 3700, 2080, '2017-05-05 10:58:16', 'A'),
(322, '2017-04-26', 'T', 57, NULL, 'NC', NULL, 'MRKU-7752786', 62, 'L&T', 'MCT-5', 'U', 3, 0, 33, 0, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1620, 1620, 60, 'N', 0, 3700, 2080, '2017-05-05 10:58:57', 'A'),
(323, '2017-04-25', 'O', 27, NULL, 'NC', NULL, 'MSKU-7394766', 62, 'L&T', 'MCT-5', 'U', 3, 0, 13, 3000, 13, 3000, 3200, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1620, 1620, 60, 'N', 0, 3700, 2080, '2017-05-05 10:59:53', 'A'),
(324, '2017-04-25', 'O', 27, NULL, 'NC', NULL, 'PONU-2065979', 62, 'L&T', 'MCT-5', 'U', 3, 0, 13, 0, 13, 0, 3200, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1620, 1620, 60, 'N', 0, 3700, 2080, '2017-05-05 11:00:37', 'A'),
(325, '2017-04-26', 'O', 27, NULL, 'NC', NULL, 'MSKU-2131793', 62, 'L&T', 'MCT-5', 'U', 3, 0, 13, 2500, 13, 2500, 3200, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1620, 1620, 60, 'N', 0, 3700, 2080, '2017-05-05 11:01:38', 'A'),
(326, '2017-04-25', 'O', 11, NULL, 'NC', NULL, 'ILCU-5107095', 3, 'PUZHAL', 'CONCOR', 'L', 8, 0, 10, 2000, 14, 2000, 4500, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 2676, 2676, 60, 'N', 0, 5000, 2324, '2017-05-10 12:20:35', 'A'),
(327, '2017-04-12', 'T', 12, NULL, 'NC', NULL, 'CXNU-1109023', 184, 'PRIYAPALAYAM', 'CONCOR', 'L', 11, 0, 32, 1500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 1442, 1442, 59, 'N', 0, 4000, 2558, '2017-05-05 11:40:00', 'A'),
(328, '2017-04-29', 'T', 63, NULL, 'NC', NULL, 'CXNU-1122663', 188, 'CONCOR', 'CONCOR', 'U', 6, 0, 34, 2500, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3300, 3300, 60, 'N', 0, 6000, 2700, '2017-05-06 16:17:26', 'A'),
(329, '2017-05-03', 'T', 63, NULL, 'NC', NULL, 'IPXU-3575610', 69, 'L&T', 'MCT-5', 'U', 5, 0, 34, 3000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 1400, 'L&T PORT HA', 2676, 2676, 60, 'N', 0, 8000, 5324, '2017-05-06 16:24:28', 'A'),
(330, '2017-04-24', 'O', 27, NULL, 'NC', NULL, 'CXNU-1125404', 185, 'PUZHAL', 'CONCOR', 'L', 5, 0, 13, 3500, 13, 3500, 8000, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 4460, 4460, 60, 'N', 0, 8500, 4040, '2017-05-09 11:53:27', 'A'),
(331, '2017-04-16', 'T', 1, NULL, 'NC', NULL, 'ILCU-5103839', 187, 'RENIGUNDA', 'CONCOR', 'L', 5, 0, 1, 2000, NULL, NULL, NULL, 0, 'A', '', 'U', '0000-00-00', 'U', '0000-00-00', 'U', 0, '', 3120, 3120, 60, 'N', 0, 12500, 9380, '2017-05-10 12:12:12', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `driver_details`
--

CREATE TABLE IF NOT EXISTS `driver_details` (
  `Driver_dtl_id` int(11) NOT NULL,
  `Driver_dtl_name` varchar(160) NOT NULL,
  `Driver_dtl_phone` varchar(20) NOT NULL,
  `Driver_dtl_address` text NOT NULL,
  `Driver_dtl_license_file` text NOT NULL,
  `Driver_dtl_type` enum('P','A') NOT NULL COMMENT 'P=Permanent, A=Acting',
  `Driver_dtl_created_dt_time` datetime NOT NULL,
  `Driver_dtl_status` enum('A','D') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `driver_details`
--

INSERT INTO `driver_details` (`Driver_dtl_id`, `Driver_dtl_name`, `Driver_dtl_phone`, `Driver_dtl_address`, `Driver_dtl_license_file`, `Driver_dtl_type`, `Driver_dtl_created_dt_time`, `Driver_dtl_status`) VALUES
(1, 'JAMBULINGAM', '8682001436', 'pondy', 'lecense1.jpg', 'P', '2016-09-28 10:55:07', 'A'),
(2, 'JAYARAMAN', '7418001247', 'VINAYAGAR KOVIL  ST KOVILOR  V&P CHEYYAR TK TVM DIST', 'lecense2.jpg', 'P', '2016-09-28 10:46:07', 'A'),
(3, 'MANI RAJ', '8754598060', 'THIRUNALVELLI', 'lecense3.jpg', 'P', '2016-09-28 10:47:28', 'D'),
(4, 'B.RAJU', '9095674143', '1/96C,PERIYA  STREET MADHURANTHANALLUR  CHIDAMBARAM CUDDALORE-608201', 'lecense4.jpg', 'P', '2016-09-28 10:52:53', 'D'),
(5, 'SURESH', '9003578788', 'T. VELLORE  VILLAGE TANIPADI  POST CHANGAM TALUK-606708', 'lecense5.jpg', 'P', '2016-09-28 10:58:14', 'A'),
(6, 'P.ANANTH', '8110835419', '75, NALLAPITCHANPATTI SENDURAI , NATHAM,  T.K  DINDIGUL-624403', 'lecense6.jpg', 'P', '2016-09-28 11:02:56', 'D'),
(7, 'MUTHUSAMY', '7092099440', 'NO. 11 KORALPAKKAM  PATHUR STREET THANIKAVADI POLLUR  TK THIRUVANNAMALAI  DIST', 'lecense7.jpg', 'P', '2016-09-28 11:06:23', 'A'),
(8, 'JAYAVEL', '9655718529', 'MELSEVALAM  PADI VILLAGE NARNA MANGALAM POST SENGEE TK  VILLUPURAM DIST-604201', 'lecense8.jpg', 'P', '2016-09-28 11:09:10', 'A'),
(9, 'YOVAN', '8675405097', 'ANNA NORTH STREET SIVAGIRI TK', 'lecense9.jpg', 'P', '2016-09-28 11:10:36', 'A'),
(10, 'ANTONY RAJ', '8608502790', 'CSI KOIL  STREET DURAISAMY PURAM POST THIRUNELVELI-627001', 'lecense10.jpg', 'P', '2016-09-28 11:12:54', 'A'),
(11, 'MURUGAN', '9087140219', 'THENKASI', 'lecense11.jpg', 'P', '2016-09-28 11:13:52', 'A'),
(12, 'POOVARAGAVAN', '9655921102', 'NO-113, PALLA STREET KORALPAKKAM POLUR- TK THIRUVANNAMALAI DIST', 'lecense12.jpg', 'P', '2016-09-28 11:16:36', 'A'),
(13, 'SANKARANARAYANAN', '9783637293', 'NO-19 , ANNA SOUTH STREET , SIVAGIRI- TK  THIRUNELVELI- 627757', 'lecense13.jpg', 'P', '2016-11-05 17:36:17', 'A'),
(14, 'MANI MARAN', '7373508216', 'THIRUNALVELI', 'lecense14.jpg', 'P', '2016-09-28 11:25:22', 'D'),
(15, 'DINAKAR', '8608508267', 'POLUR', 'lecense15.jpg', 'P', '2016-09-28 11:26:44', 'A'),
(16, 'KALERAJ', '8098129990', 'NO-24 , ANNA NORTH STREET , SIVAGIRI', 'lecense16.jpg', 'P', '2016-09-28 11:29:05', 'A'),
(17, 'SHANMUGAM', '8122480864', '117, THALAYATHAM  GOODANAGARAM ROAD GUDIYATTAM', 'lecense17.jpg', 'A', '2016-09-29 17:28:20', 'A'),
(18, 'BALAJI', '8682906997', 'NO ;39/12 NEW NO ;21A/11 APPARSAMY KOVIL ROAD ST TVT  CHENNAI-19', 'lecense18.jpg', 'A', '2016-09-29 17:30:41', 'D'),
(19, 'PALANISAMY', '7094829808', 'NO; 407MURAIYUR-PO , THIRUPATHUR -TK SIVAGANGAI', 'lecense19.jpg', 'A', '2016-09-29 17:59:27', 'A'),
(20, 'AROKIYARAJ', '9865109319', 'THOOTHUKUTI DIST', 'lecense20.jpg', 'A', '2016-10-01 13:03:44', 'D'),
(21, 'DHANAPAL', '9809413428', 'CHENNAI (DOUT)', 'lecense21.jpg', 'A', '2016-10-01 13:05:48', 'D'),
(22, 'SUBASH', '8124274961', 'CHENNAI', 'lecense22.jpg', 'P', '2016-10-12 14:55:57', 'D'),
(23, 'RAMADOSS', '8015559573', 'CHENNAI', 'lecense23.jpg', 'A', '2016-11-14 10:36:10', 'D'),
(24, 'SELADURAI', '9500183087', '30/1, SATHIRAKONDAN,  SANKARANKOVIL, TK NELLAI', 'lecense24.jpg', 'P', '2016-11-21 17:37:55', 'D'),
(25, 'RAM MOORTHI', '9994321362', 'RAJAPALAYAM', 'lecense25.jpg', 'P', '2016-11-19 13:31:52', 'D'),
(26, 'RAMESH KUMAR', '8015559573', 'NEW DRIVER', 'lecense26.jpg', 'P', '2016-12-08 10:23:46', 'D'),
(27, 'PONRAJ R', '8122677935', '119 MANJANAICKENPATTI  BLOCK-1 ETTAYAPURAM', 'lecense27.jpg', 'A', '2017-01-02 12:17:10', 'D'),
(28, 'RAMESH R', '9025517380', '1/38 ,NORTH STREET ,RUBANARAYANANALLUR  , VRIDHACHALAM TK', 'lecense28.jpg', 'A', '2017-01-02 12:14:17', 'D'),
(29, 'TAMIL SELVAN', '7339401865', 'SIVAGIRI TK THIRUNELVELI DIST', 'lecense29.jpg', 'P', '2017-01-10 17:40:02', 'A'),
(30, 'SURESH KUMAR', '9176457654', 'MARAVAMANGALAM PO , SIVAGANGAI -DT', 'lecense30.jpg', 'P', '2017-01-23 12:46:49', 'A'),
(31, 'ANNADURAI', '7448527670', 'CHENNAI', 'lecense31.jpg', 'A', '2017-02-02 11:05:20', 'A'),
(32, 'ANDREW', '7448527670', 'CHENNAI', 'lecense32.jpg', 'A', '2017-04-04 10:53:51', 'A'),
(33, 'S.MURUGAN', '7448527670', 'CHENNAI', 'lecense33.jpg', 'A', '2017-04-10 15:37:46', 'A'),
(34, 'GANESAN', '7448527670', 'CHENNAI', 'lecense34.jpg', 'A', '2017-04-19 15:18:40', 'A'),
(35, 'MEIYALAGAN', '7448527670', 'THIRUVOTTIYUR', 'lecense35.jpg', 'A', '2017-05-01 12:39:27', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `driver_payment_details`
--

CREATE TABLE IF NOT EXISTS `driver_payment_details` (
  `Driver_pymnt_id` int(11) NOT NULL,
  `Driver_pymnt_di_driver_name` int(11) NOT NULL COMMENT 'Driver  Details reference id',
  `Driver_pymnt_pay_date` date NOT NULL,
  `Driver_pymnt_pay_status` enum('U','P') NOT NULL COMMENT 'U=UNPAID, P=PAID',
  `Driver_pymnt_remarks` text NOT NULL,
  `Driver_pymnt_amount` int(11) NOT NULL,
  `Driver_pymnt_created_dt_tme` datetime NOT NULL,
  `Driver_pymnt_status` enum('A','D') NOT NULL COMMENT 'A=Approve, D=Deny'
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `driver_payment_details`
--

INSERT INTO `driver_payment_details` (`Driver_pymnt_id`, `Driver_pymnt_di_driver_name`, `Driver_pymnt_pay_date`, `Driver_pymnt_pay_status`, `Driver_pymnt_remarks`, `Driver_pymnt_amount`, `Driver_pymnt_created_dt_tme`, `Driver_pymnt_status`) VALUES
(1, 1, '2017-04-01', 'P', 'for checking', 0, '2017-04-12 18:21:37', 'A'),
(2, 10, '2017-04-01', 'P', 'for checking', 0, '2017-04-12 18:21:58', 'A'),
(3, 15, '2017-04-01', 'P', 'for checking', 0, '2017-04-12 18:22:16', 'A'),
(4, 17, '2017-04-01', 'P', 'for checking', 0, '2017-04-12 18:22:33', 'A'),
(5, 16, '2017-04-01', 'P', 'for checking', 0, '2017-04-12 18:23:50', 'A'),
(6, 11, '2017-04-01', 'P', 'for checking', 0, '2017-04-12 18:25:07', 'A'),
(7, 32, '2017-04-01', 'P', 'for checking', 0, '2017-04-18 10:31:14', 'A'),
(8, 13, '2017-04-01', 'P', 'for checking', 0, '2017-04-18 10:57:36', 'A'),
(9, 31, '2017-04-01', 'P', 'for checking', 0, '2017-04-25 10:16:34', 'A'),
(10, 33, '2017-04-01', 'P', 'FOR CHECKING', 0, '2017-04-28 13:04:09', 'A'),
(11, 29, '2017-04-01', 'P', 'FOR CHECKING', 0, '2017-04-28 16:01:12', 'A'),
(12, 34, '2017-04-01', 'P', 'FOR CHECKING', 0, '2017-04-28 16:01:45', 'A'),
(13, 35, '2017-04-01', 'P', 'FOR CHECKING', 0, '2017-05-05 13:13:34', 'A'),
(14, 15, '2017-04-01', 'P', 'FOR CHECKING', 0, '2017-05-10 15:17:28', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `driver_pay_rate`
--

CREATE TABLE IF NOT EXISTS `driver_pay_rate` (
  `Driver_pay_rate_id` int(11) NOT NULL,
  `Driver_pay_rate_place_name` text NOT NULL,
  `Driver_pay_rate_amount` int(11) NOT NULL,
  `Driver_pay_rate_diesel_ltr` int(11) NOT NULL,
  `Driver_pay_rate_diesel_rate` int(11) NOT NULL,
  `Driver_pay_rate_created_dt_time` datetime NOT NULL,
  `Driver_pay_rate_status` enum('A','D') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=189 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `driver_pay_rate`
--

INSERT INTO `driver_pay_rate` (`Driver_pay_rate_id`, `Driver_pay_rate_place_name`, `Driver_pay_rate_amount`, `Driver_pay_rate_diesel_ltr`, `Driver_pay_rate_diesel_rate`, `Driver_pay_rate_created_dt_time`, `Driver_pay_rate_status`) VALUES
(1, 'THIRUPATHI', 7400, 85, 52, '2017-02-17 14:27:03', 'A'),
(2, 'AMBATHUR', 2180, 15, 52, '2016-09-29 13:35:57', 'A'),
(3, 'AVADI', 2500, 22, 52, '2016-09-29 13:36:53', 'A'),
(4, 'ARUMBAKKAM', 3000, 22, 52, '2016-09-29 13:37:23', 'A'),
(5, 'ALAPAKKAM', 2500, 25, 52, '2016-10-13 13:51:44', 'A'),
(6, 'ABC YARD', 1800, 10, 52, '2016-09-29 13:39:05', 'A'),
(7, 'AYANAVARAM', 2500, 20, 52, '2016-09-29 13:39:28', 'A'),
(8, 'ANNA NAGAR', 2300, 15, 52, '2016-09-29 13:40:35', 'A'),
(9, 'ALAMATHI', 2200, 18, 52, '2016-09-29 13:40:53', 'A'),
(10, 'SRIPERUNDHUR ASIAN PAINT', 3800, 35, 52, '2016-11-04 14:55:42', 'A'),
(11, 'BRADWAY', 2600, 20, 52, '2016-09-29 13:43:35', 'A'),
(12, 'BINNIY', 2600, 22, 52, '2016-09-29 13:44:18', 'A'),
(13, 'CROMPET', 3250, 32, 52, '2016-10-12 17:37:36', 'A'),
(14, 'CUDALLUR', 8500, 110, 52, '2016-09-29 13:46:11', 'A'),
(15, 'CHETTOOR AMMARAJA', 7000, 85, 52, '2016-11-04 14:57:52', 'A'),
(16, 'CHETTOOR GRANITE', 8100, 97, 52, '2017-04-22 13:40:43', 'A'),
(17, 'CHENGELPET', 4400, 47, 52, '2016-09-29 13:54:16', 'A'),
(18, 'COYAMUTHUR', 21000, 270, 52, '2016-09-29 13:56:02', 'A'),
(19, 'ERNAYUR', 1800, 10, 52, '2016-09-29 13:56:48', 'A'),
(20, 'ELLAYUR', 3800, 37, 52, '2016-12-17 15:01:56', 'A'),
(21, 'L&T ELLAYUR', 3550, 40, 52, '2016-09-29 13:58:41', 'A'),
(22, 'KANCHIPURAM', 4800, 55, 52, '2016-09-29 14:01:21', 'A'),
(23, 'THANDAYARPET', 2500, 8, 52, '2016-09-29 14:02:20', 'A'),
(24, 'RANIPET', 6300, 65, 52, '2016-09-29 14:03:28', 'A'),
(25, 'GUINDY', 3300, 25, 52, '2016-09-29 14:04:34', 'A'),
(26, 'GUMMIDIPOONDI', 3300, 33, 52, '2016-09-29 14:05:09', 'A'),
(27, 'L&T GUDUR', 9500, 85, 52, '2016-10-04 17:24:56', 'A'),
(28, 'GUDUVANCHERY', 3600, 35, 52, '2016-09-29 14:07:21', 'A'),
(29, 'NAGALKENI', 3200, 35, 52, '2016-11-04 14:43:10', 'A'),
(30, 'MAMBAKKAM', 3500, 40, 52, '2016-09-29 14:08:49', 'A'),
(31, 'MADHAVARAM', 1600, 10, 52, '2016-09-29 14:09:08', 'A'),
(32, 'THANDALAM', 3200, 30, 52, '2016-09-29 14:09:31', 'A'),
(33, 'NEELANGARAI', 3400, 35, 52, '2016-09-29 14:09:57', 'A'),
(34, 'PUZHAL', 1800, 13, 52, '2016-09-29 14:10:40', 'A'),
(35, 'RENIGUNDA AMMRAJA EMTRY', 7300, 75, 52, '2017-03-22 14:21:37', 'A'),
(36, 'MBK NAGAR', 2300, 15, 52, '2016-09-29 14:31:41', 'A'),
(37, 'SALIGARAMAM', 2600, 22, 52, '2016-09-29 14:34:03', 'A'),
(38, 'PONDICHERY', 7900, 100, 52, '2017-04-22 13:48:37', 'A'),
(39, 'L&T SOLINGAR', 6800, 90, 52, '2016-09-29 14:40:45', 'A'),
(40, 'THIRUPATHUR', 10000, 130, 52, '2016-09-29 14:41:11', 'A'),
(41, 'KRISHNAGIRI', 12000, 140, 52, '2016-09-29 14:41:33', 'A'),
(42, 'JOTHI NAGAR', 1700, 10, 52, '2016-09-29 14:42:33', 'A'),
(43, 'NEMAM COCO COLA', 2300, 20, 52, '2017-04-18 18:33:36', 'A'),
(44, 'VANAGARAM', 2300, 22, 52, '2016-11-12 11:30:09', 'A'),
(45, 'VEDANTHANGAL', 5200, 60, 52, '2016-10-12 17:36:59', 'A'),
(46, 'VELLUR', 7200, 80, 52, '2016-09-29 14:45:31', 'A'),
(47, 'THIRUVANMIYUR', 2600, 40, 52, '2016-09-29 14:46:17', 'A'),
(48, 'HORBUR', 4200, 20, 52, '2016-09-29 14:50:35', 'A'),
(49, 'UTHIRAMERUR', 5200, 55, 52, '2016-09-29 15:48:27', 'A'),
(50, 'KARAPAKKAM', 3500, 40, 52, '2016-12-22 18:50:28', 'A'),
(51, 'KOYAMBEDU', 2600, 20, 52, '2016-09-29 15:49:19', 'A'),
(52, 'KODUNGAIYUR', 2300, 15, 52, '2016-09-29 15:49:41', 'A'),
(53, 'KILKATTALAI', 3400, 35, 52, '2016-09-29 15:50:14', 'A'),
(54, 'KELAMPAKKAM', 3500, 40, 52, '2016-10-12 17:38:24', 'A'),
(55, 'KOILAMPAKKAM', 3400, 37, 52, '2016-09-29 15:53:59', 'A'),
(56, 'KOLATHUR', 2000, 10, 52, '2016-09-29 15:54:20', 'A'),
(57, 'KAIYAR', 3500, 40, 52, '2016-09-29 15:54:46', 'A'),
(58, 'KARANODAI', 2650, 20, 52, '2016-09-29 15:55:15', 'A'),
(59, 'MAHENDRACITY', 3600, 40, 52, '2016-09-29 16:09:22', 'A'),
(60, 'RBI', 1600, 10, 52, '2016-10-04 14:37:37', 'A'),
(61, 'PERIYAPALAYAM', 2300, 22, 52, '2017-04-17 18:59:43', 'A'),
(62, 'CONCOR PNR', 1500, 15, 52, '2016-10-04 17:21:15', 'A'),
(63, 'PORUR', 2600, 25, 52, '2016-10-04 17:23:14', 'A'),
(64, 'PERUNGALATHUR', 3100, 30, 52, '2016-10-04 17:24:06', 'A'),
(65, 'CHETHALAPAKKAM', 3500, 35, 52, '2016-11-04 15:02:01', 'A'),
(66, 'NOOMBAL', 2500, 22, 52, '2016-10-04 17:27:05', 'A'),
(67, 'SICAL', 1500, 8, 52, '2016-10-04 17:27:30', 'A'),
(68, 'THURAIPAKKAM', 3500, 35, 52, '2016-11-04 15:11:11', 'A'),
(69, 'MADHURAVAYAL', 2500, 22, 52, '2016-10-04 17:28:36', 'A'),
(70, 'HOSUR', 15000, 140, 52, '2016-10-04 17:29:01', 'A'),
(71, 'IRUNGATTUKOTTAI', 3000, 30, 52, '2016-10-04 17:30:10', 'A'),
(72, 'PUZHAL TO THANDALAM', 2500, 20, 52, '2016-10-04 17:31:02', 'A'),
(73, 'THIRUPATHI TO CHETTOOR', 3900, 45, 52, '2017-04-22 13:42:13', 'A'),
(74, 'NAGALKENI TO SRIPERUMANDHUR', 2720, 20, 52, '2016-11-04 14:53:56', 'A'),
(75, 'RENIGUNDA TO MADHAVARAM', 6000, 60, 52, '2016-10-04 17:34:01', 'A'),
(76, 'PALLAVARAM', 3200, 32, 52, '2016-10-05 16:14:28', 'A'),
(77, 'VADAPALANI', 2500, 25, 52, '2016-10-06 17:07:30', 'A'),
(78, 'THIRUPATHI TO RENIGUNDA', 3000, 15, 52, '2016-10-08 19:21:48', 'A'),
(79, 'MADIPAKKAM', 3300, 35, 52, '2016-10-08 19:22:13', 'A'),
(80, 'THIRUMUDIVAKKAM', 3200, 32, 52, '2016-10-08 19:22:51', 'A'),
(81, 'MEDAVAKKAM', 3400, 35, 52, '2016-10-08 19:23:13', 'A'),
(82, 'NAGALKENI TO THANDALAM', 2300, 15, 52, '2016-10-08 19:24:26', 'A'),
(83, 'PADI', 2000, 15, 52, '2016-10-08 19:25:07', 'A'),
(84, 'POONAMALLI TO RENIGUNDA', 5800, 60, 52, '2016-11-03 12:50:16', 'A'),
(85, 'CHEMMANCHERY', 3400, 35, 52, '2016-10-08 19:26:20', 'A'),
(86, 'BALMAR CFS', 1300, 5, 52, '2016-10-08 19:28:27', 'A'),
(87, 'PUZHAL TO SRIPERUMANDHUR', 3300, 30, 52, '2016-11-04 14:54:22', 'A'),
(88, 'PREYAPALAYAM TO G.POONDI', 1700, 10, 52, '2016-10-13 17:16:24', 'A'),
(89, 'THANDALAM TO AMBATHUR', 1350, 5, 52, '2016-10-13 17:17:26', 'A'),
(90, 'THIRUPATHI TO SRIPERUMANDHUR', 2100, 10, 52, '2016-10-13 17:18:52', 'A'),
(91, 'PREYAPALAYAM TO REDHILLS', 1200, 1, 52, '2016-10-13 17:19:42', 'A'),
(92, 'PUZHAL TO RENIGUNDA', 6500, 65, 52, '2016-11-04 14:50:01', 'A'),
(93, 'THIRUPATHI TO  G.POONDI', 2200, 10, 52, '2016-10-13 17:21:35', 'A'),
(94, 'PUZHAL TO MANALI', 1000, 0, 52, '2016-10-13 17:22:02', 'A'),
(95, 'ORAGADAM', 2800, 25, 52, '2016-10-13 17:22:40', 'A'),
(96, 'MANJAMPAKKAM', 1500, 8, 52, '2016-10-13 17:23:56', 'A'),
(97, 'MADHAVARAM TO CHETTOOR', 6200, 70, 52, '2016-10-13 17:24:34', 'A'),
(98, 'G.POONDI TO RENIGUNDA', 4000, 50, 52, '2016-10-13 17:25:13', 'A'),
(99, 'NAGALKENI TO RENIGUNDA', 6500, 60, 52, '2016-11-04 14:49:24', 'A'),
(100, 'THIRUPATHUR TO RENIGUNDA', 3000, 20, 52, '2016-10-13 17:28:13', 'A'),
(101, 'CHETHALAPAKKAM TO SRIPERUMANDHUR', 2700, 20, 52, '2016-10-13 17:29:15', 'A'),
(102, 'NAGALKENI TO CHETTOOR', 6300, 70, 52, '2016-11-04 15:00:17', 'A'),
(103, 'THIRUPATHUR TO SRIPERUMATHUR', 1300, 5, 52, '2016-10-13 17:31:44', 'A'),
(104, 'CHEENGEE', 6700, 85, 52, '2016-10-19 12:23:58', 'A'),
(105, 'CHETHALAPAKKAM TO RENIGUNDA', 6500, 70, 52, '2016-11-04 15:01:16', 'A'),
(106, 'SANTHOSHPURAM', 3300, 35, 52, '2016-10-24 13:28:41', 'A'),
(107, 'MAHENDRACITY TO ORAGUDAM', 1500, 10, 52, '2016-10-25 10:26:30', 'A'),
(108, 'ARAKKONAM', 4200, 50, 52, '2016-10-25 13:10:01', 'A'),
(109, 'POONAMALLI TO CHETTOOR', 5800, 60, 52, '2016-11-03 12:51:34', 'A'),
(110, 'THIRUVALLUR TO G.POONDI', 2300, 15, 52, '2016-10-25 13:53:15', 'A'),
(111, 'SRIPERUMANDHUR TO G.POONDI', 2500, 20, 52, '2016-10-25 13:54:03', 'A'),
(112, 'ARAKKONAM TO RENIGUNDA', 5500, 50, 52, '2016-10-25 13:56:08', 'A'),
(113, 'ORAGADAM SRS', 3200, 35, 52, '2016-12-30 13:31:44', 'A'),
(114, 'ORAGADAM TO SRIPERUMANDHUR', 2200, 15, 52, '2016-10-25 13:58:10', 'A'),
(115, 'MAHENDRACITY TO G.POONDI', 2500, 20, 52, '2016-10-25 13:59:22', 'A'),
(116, 'THANDALAM TO G.POONDI', 2500, 20, 52, '2016-10-25 13:59:52', 'A'),
(117, 'NAGALKENI TO PERUNGUDI', 2000, 10, 52, '2016-10-25 14:00:21', 'A'),
(118, 'PERUNGUDI', 3300, 30, 52, '2016-10-25 14:01:07', 'A'),
(119, 'SELAM', 14300, 200, 52, '2017-02-27 13:06:55', 'A'),
(120, 'THIRUVALLUR', 2800, 30, 52, '2016-11-11 11:36:06', 'A'),
(121, 'KUTTHAMPAKKAM', 2800, 25, 52, '2016-11-11 11:37:46', 'A'),
(122, 'KUTTHAMPAKKM TO RENIGUNDA', 6300, 65, 52, '2016-11-11 11:39:14', 'A'),
(123, 'KUTTHAMPAKKM TO SRIPERUMANDHUR', 2100, 10, 52, '2016-11-11 11:40:18', 'A'),
(124, 'KUTTHAMPAKKAM TO MANALI', 1200, 0, 52, '2016-11-11 11:41:22', 'A'),
(125, 'ICF', 2100, 15, 52, '2016-11-11 11:42:06', 'A'),
(126, 'PUZHAL TO CHETTOOR', 6300, 75, 52, '2016-11-11 11:43:14', 'A'),
(127, 'KUTTHAMPAKKAM TO CHETTOOR', 5800, 60, 52, '2016-11-11 11:44:11', 'A'),
(128, 'CHETTOOR TO CHETTOOR', 3000, 10, 52, '2016-11-11 11:49:25', 'A'),
(129, 'THIRUPATHUR TO THIRUMUDIVAKKAM', 2300, 20, 52, '2016-11-28 13:23:55', 'A'),
(130, 'KUTHAMPAKKAM TO ELLAYUR', 3000, 30, 52, '2016-11-28 13:33:14', 'A'),
(131, 'KUTHAMPAKKAM TO RANIPET', 4800, 52, 52, '2016-11-28 14:22:06', 'A'),
(132, 'THADA SRI CITE', 5500, 70, 52, '2016-11-28 14:23:45', 'A'),
(133, 'ALANDHUR', 3000, 25, 52, '2016-11-28 14:24:39', 'A'),
(134, 'PERIYAPALAYAM TO SRIPERUMANDHUR DSO', 2700, 30, 52, '2017-04-18 19:38:57', 'A'),
(135, 'PERIYAPALAYAM TO MAMBAKKAM', 2900, 35, 52, '2016-11-28 14:29:35', 'A'),
(136, 'CHETTOOR AMMARAJA LOAD', 8100, 110, 52, '2017-04-22 13:45:15', 'A'),
(137, 'NAGALKENI TO ELLAVUR', 3100, 27, 52, '2016-12-30 11:51:56', 'A'),
(138, 'VIZHUPURAM', 8500, 95, 52, '2016-12-17 15:06:18', 'A'),
(139, 'ORAGUDAM TO VICHUR', 1200, 5, 52, '2016-12-30 11:06:15', 'A'),
(140, 'MAHENDRACITY TO MM NAGAR', 1600, 10, 52, '2016-12-30 11:48:22', 'A'),
(141, 'ARAKKONAM TO CHETTOOR', 5200, 55, 52, '2016-12-30 11:49:50', 'A'),
(142, 'MGR NAGAR MANALI', 1000, 1, 52, '2016-12-30 11:50:43', 'A'),
(143, 'THANDALAM TO VICHUR', 1100, 1, 52, '2016-12-30 11:51:16', 'A'),
(144, 'VICHUR', 1500, 7, 52, '2016-12-30 11:52:50', 'A'),
(145, 'PORUR TO CHETTOOR', 6100, 70, 52, '2016-12-30 11:55:34', 'A'),
(146, 'POONAMALLI TO THIRUMUDIVAKKAM', 1800, 10, 52, '2016-12-30 13:10:48', 'A'),
(147, 'SRIPERUMANDHUR', 3400, 35, 52, '2017-01-02 14:19:53', 'A'),
(148, 'PONDICHERY TO THANDALAM', 2000, 10, 52, '2017-01-10 17:04:51', 'A'),
(149, 'ARAKKONAM TO SRIPERUMADHUR', 2200, 10, 52, '2017-01-10 17:30:56', 'A'),
(150, 'THIRUMAZHESAI', 2700, 25, 52, '2017-01-10 17:32:37', 'A'),
(151, 'POONAMALLI TO SRIPERUMANDHUR', 2500, 20, 52, '2017-01-10 17:34:12', 'A'),
(152, 'PADUR TO SRIPERUMANDHUR', 2300, 15, 52, '2017-01-10 17:34:42', 'A'),
(153, 'PADUR', 2800, 25, 52, '2017-01-10 17:35:14', 'A'),
(154, 'PUZHAL TO BALMAR', 800, 0, 52, '2017-01-10 17:35:59', 'A'),
(155, 'KALPAKKAM', 4700, 60, 52, '2017-01-21 18:06:25', 'A'),
(156, 'PONDICHERRY TO SRIPERUMANDHUR', 2662, 20, 52, '2017-01-21 18:55:44', 'A'),
(157, 'ALAMATHI TO CCTL-HARBOUR', 3300, 30, 52, '2017-01-25 12:40:30', 'A'),
(158, 'ISO EY MUMENT', 750, 5, 52, '2017-01-25 15:16:20', 'A'),
(159, 'THIRUPATHI TO THANDALAM', 2300, 20, 52, '2017-02-01 17:16:34', 'A'),
(160, 'SATHVA TO SHAINT GOBAIN TO L&T PORT', 4570, 45, 52, '2017-02-15 12:26:55', 'A'),
(161, 'CCTL PORT TO ELLAYUR', 4453, 42, 52, '2017-02-15 12:28:50', 'A'),
(162, 'PATTABIRAM', 2600, 32, 52, '2017-03-21 19:32:54', 'A'),
(163, 'PERUMBAKKAM', 3600, 37, 52, '2017-03-28 18:40:53', 'A'),
(164, 'VELAPPANCHAVADI', 2300, 22, 52, '2017-02-27 12:38:56', 'A'),
(165, 'AYYAPAKKAM', 2200, 18, 52, '2017-02-27 12:39:55', 'A'),
(166, 'CADDALLUR', 8200, 110, 52, '2017-02-27 12:40:40', 'A'),
(167, 'THIRUPPORUR', 3800, 40, 52, '2017-02-27 12:42:52', 'A'),
(168, 'DHARMABURI', 13800, 175, 52, '2017-02-27 13:06:07', 'A'),
(169, 'NAGALKENI TO THIRUMUDIVAKKAM', 1700, 10, 52, '2017-03-22 11:53:50', 'A'),
(170, 'THIRUVERKADU', 2400, 20, 52, '2017-03-22 11:57:00', 'A'),
(172, 'RENIGUNDA  AMMARAJA LOAD', 8200, 100, 52, '2017-04-22 13:36:17', 'A'),
(173, 'SAIYAR', 4850, 60, 52, '2017-03-28 18:38:33', 'A'),
(174, 'POONAMALLI TO THANDALAM', 2100, 15, 52, '2017-03-28 18:45:55', 'A'),
(175, 'REDHILLS', 1800, 13, 52, '2017-03-30 15:33:05', 'A'),
(176, 'POONAMALLI', 2500, 20, 52, '2017-04-21 17:07:27', 'A'),
(177, 'ALANDHUR SASTHA', 2700, 25, 52, '2017-04-18 18:37:18', 'A'),
(178, 'ISO SASTHA GODWON', 980, 7, 52, '2017-04-18 18:40:45', 'A'),
(179, 'CHETTOOR JUICE', 8100, 105, 52, '2017-04-22 13:44:19', 'A'),
(180, 'PONDICHERRY POWDER LOAD SRS', 8600, 115, 52, '2017-04-22 13:51:31', 'A'),
(181, 'THIRUVOTHIYUR ITC', 1550, 8, 52, '2017-04-24 12:21:45', 'A'),
(182, 'SICAL - IOC - L&T PORT', 2700, 21, 52, '2017-04-25 11:04:03', 'A'),
(183, 'THARAMANI', 3300, 30, 52, '2017-04-25 16:18:08', 'A'),
(184, 'PERIYAPALAYAM TO THIRUVOTHUR ITC', 1400, 6, 52, '2017-05-02 18:48:02', 'A'),
(185, 'PUZHAL TO KANCHIPURAM SRC', 4100, 45, 52, '2017-05-02 18:48:12', 'A'),
(186, 'PUZHAL TO AVADI', 1800, 15, 52, '2017-05-02 18:48:25', 'A'),
(187, 'RENIGUNDA TO RENIGUNDA', 3000, 16, 52, '2017-06-02 12:01:48', 'A'),
(188, 'KARAVAPETAI', 3100, 50, 60, '2017-06-02 12:39:42', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `iso_movement_details`
--

CREATE TABLE IF NOT EXISTS `iso_movement_details` (
  `Iso_mvnt_id` int(11) NOT NULL,
  `Iso_mvnt_date` date NOT NULL,
  `Iso_mvnt_vehicle_type` enum('T','O') DEFAULT NULL COMMENT 'Thirumala,Other',
  `Iso_mvnt_vehicle_no` int(11) DEFAULT NULL COMMENT 'vehicle details table reference id',
  `Iso_mvnt_other_vehicle_no` varchar(200) DEFAULT NULL,
  `Iso_mvnt_container_type` enum('F','T') NOT NULL COMMENT 'F=Fourty, T=Twenty',
  `Iso_mvnt_container_no` text NOT NULL COMMENT 'container details table reference id',
  `Iso_mvnt_container_no2` text COMMENT 'for if container type twenty need to store additional container no from container details table ',
  `Iso_mvnt_ey_lo` enum('E','L') NOT NULL COMMENT 'Empty/Load',
  `Iso_mvnt_im_ex` enum('I','E') NOT NULL COMMENT 'Import/Export',
  `Iso_mvnt_pickup_place` varchar(200) NOT NULL,
  `Iso_mvnt_drop_place` varchar(200) NOT NULL,
  `Iso_mvnt_loading_status` enum('L','U','OL') DEFAULT NULL COMMENT 'L=Loading, U=Unloding',
  `Iso_mvnt_from` varchar(160) NOT NULL,
  `Iso_mvnt_to` varchar(160) NOT NULL,
  `Iso_mvnt_load_drop` varchar(160) NOT NULL,
  `Iso_mvnt_transport_name` int(11) NOT NULL COMMENT 'transport details reference id',
  `Iso_mvnt_tp_amount` int(11) NOT NULL,
  `Iso_mvnt_amount` int(11) NOT NULL,
  `Iso_mvnt_paid_status` enum('U','P') NOT NULL COMMENT 'U=Unpaid , P=paid',
  `Iso_mvnt_paid_date` date NOT NULL COMMENT 'amount paid date',
  `Iso_mvnt_created_dt_time` datetime NOT NULL,
  `Iso_mvnt_status` enum('A','D') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `iso_movement_details`
--

INSERT INTO `iso_movement_details` (`Iso_mvnt_id`, `Iso_mvnt_date`, `Iso_mvnt_vehicle_type`, `Iso_mvnt_vehicle_no`, `Iso_mvnt_other_vehicle_no`, `Iso_mvnt_container_type`, `Iso_mvnt_container_no`, `Iso_mvnt_container_no2`, `Iso_mvnt_ey_lo`, `Iso_mvnt_im_ex`, `Iso_mvnt_pickup_place`, `Iso_mvnt_drop_place`, `Iso_mvnt_loading_status`, `Iso_mvnt_from`, `Iso_mvnt_to`, `Iso_mvnt_load_drop`, `Iso_mvnt_transport_name`, `Iso_mvnt_tp_amount`, `Iso_mvnt_amount`, `Iso_mvnt_paid_status`, `Iso_mvnt_paid_date`, `Iso_mvnt_created_dt_time`, `Iso_mvnt_status`) VALUES
(1, '2017-05-03', 'O', NULL, 'TN18E4001', 'T', 'GESU2205318', 'GESU2476', 'E', 'E', 'ACT 2', 'CONCOR', 'OL', '', '', '', 7, 2200, 2500, 'U', '0000-00-00', '2017-05-08 17:03:27', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `party_billing`
--

CREATE TABLE IF NOT EXISTS `party_billing` (
  `Party_billing_id` int(11) NOT NULL,
  `Party_billing_date` date NOT NULL,
  `Party_billing_party_name` int(11) NOT NULL COMMENT 'Party details reference id',
  `Party_billing_container_no` varchar(60) NOT NULL,
  `Party_billing_consignee` varchar(250) NOT NULL,
  `Party_billing_consignor` varchar(200) NOT NULL,
  `Party_billing_material` varchar(200) NOT NULL,
  `Party_billing_ini_no` int(11) NOT NULL,
  `Party_billing_from` varchar(100) NOT NULL,
  `Party_billing_to` varchar(100) NOT NULL,
  `Party_billing_empty` varchar(250) NOT NULL,
  `Party_billing_cni_no` int(11) NOT NULL,
  `Party_billing_bill_recd_dt` date NOT NULL,
  `Party_billing_train_no` varchar(250) NOT NULL,
  `Party_billing_ph_no` int(11) NOT NULL,
  `Party_billing_ey_valid_dt` date NOT NULL,
  `Party_billing_ul_date` date NOT NULL,
  `Party_billing_last_date` date NOT NULL,
  `Party_billing_remark` varchar(300) NOT NULL,
  `Party_billing_created_dt_time` datetime NOT NULL,
  `Party_billing_status` enum('A','D') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `party_details`
--

CREATE TABLE IF NOT EXISTS `party_details` (
  `Party_dtl_id` int(11) NOT NULL,
  `Party_dtl_name` text NOT NULL,
  `Party_dtl_phone_no` varchar(20) NOT NULL,
  `Party_dtl_address` text NOT NULL,
  `Party_dtl_created_dt_time` datetime NOT NULL,
  `Party_dtl_status` enum('A','D') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `party_details`
--

INSERT INTO `party_details` (`Party_dtl_id`, `Party_dtl_name`, `Party_dtl_phone_no`, `Party_dtl_address`, `Party_dtl_created_dt_time`, `Party_dtl_status`) VALUES
(1, 'M/S.E2E', '9381503236', 'Rajaji Salai, Chennai-600 001', '2016-09-26 17:46:35', 'A'),
(2, 'M/S. SHREYAS', '9840863080', 'NO.2, 9TH LANE , "TRANS WORLD HOUSE " -ANNEX E , 4TH FLOOR DR. RADHAKRISHNAN   SALAI , MYLAPORE , CHENNAI -600004', '2016-09-28 11:48:09', 'A'),
(3, 'M/S. STT ISO CONCOR', '9840602093', 'NO: 3079 3rd MAIN ROAD MATHUR  CHENNAI -68', '2016-09-28 11:50:17', 'A'),
(4, 'M/S. HARI LOGIESTIC', '9810727867', 'PASCHIMVIHAR, NEW DELHI -110063 PH: 011-25251972', '2016-09-28 11:53:27', 'A'),
(5, 'M/S. SRS CARGO', '9840863631', 'NO. 16 GANDHI STREET , GANGATHESWARAN KOIL ROAD , PURASAWALKAM ,CHENNAI', '2016-09-28 11:58:35', 'A'),
(6, 'M/S. GILLCHAND', '9092633606', 'CHENNAI', '2016-09-28 12:03:40', 'A'),
(7, 'M/S . SANJAY', '9840863631', 'CHENNAI', '2016-09-28 12:04:47', 'A'),
(8, 'M/S.SEVEN HILLS TRANSPORT', '9841690918', 'SUNDARAMPILLAI  NAGAR , THANDAYARPET', '2016-09-28 12:08:04', 'A'),
(9, 'M/S. SATHISH SRC', '9444426724', 'PADI, CHENNAI-600001', '2016-09-28 12:09:31', 'A'),
(10, 'M/S.SATHISH TPT', '9840140043', 'THIRUVATHUR CHENNAI-68', '2016-09-28 12:13:47', 'A'),
(11, 'M/S.STT DSO CONCOR', '9840602093', '3079 3rd MAIN ROAD  MATHUR CHENNAI-68', '2016-09-28 12:15:31', 'A'),
(12, 'M/S.W/C', '9382129062', 'CHENNAI', '2016-09-28 12:18:25', 'A'),
(13, 'PUSHPARAJ TPT', '9884602394', 'MATHUR MMDA', '2016-09-28 17:26:41', 'A'),
(14, 'M/S.ISTL', '9350847387', 'CHENNAI', '2016-09-28 17:29:33', 'A'),
(15, 'M/S. AMT', '9382149166', 'CHENNAI', '2016-09-28 17:43:31', 'A'),
(16, 'M/S.K.RAJU', '9962925946', 'CHENNAI', '2016-09-28 17:44:37', 'A'),
(17, 'M/S.AVG TRANSPORT', '8015559573', 'CHENNAI', '2016-10-05 12:37:53', 'A'),
(18, 'M/S.MM SIVA TRANSPORT', '8015559573', 'CHENNAI', '2016-10-06 11:29:34', 'A'),
(19, 'SRI MURUGAN TRANSPORT', '8015559573', 'CHENNAI', '2016-10-06 12:48:03', 'A'),
(20, 'ARYA LAGISTIC', '9380714807', 'THAMBU CHETY STREET CHENNAI-68', '2016-10-08 19:27:50', 'A'),
(21, 'M/S. SRS', '9965002703', 'CHENNAI', '2016-10-25 15:08:46', 'A'),
(22, 'AMMAJI TPT', '9840309456', 'CHENNAI', '2016-11-02 16:35:55', 'A'),
(23, 'M/S.RAPID', '9382128856', 'CHENNAI', '2016-12-30 12:44:28', 'A'),
(24, 'GLOBAL CARRIER', '9841772540', 'KALADIPET CHENNAI 19', '2017-01-25 12:36:40', 'A'),
(25, 'INIGO TPT', '7448527670', 'CHENNAI', '2017-02-08 10:52:51', 'A'),
(26, 'MAPLE LOGISTICS', '9345791276', 'NEW DELHI  HEAD OFFICE', '2017-02-28 13:15:13', 'A'),
(27, 'M/S.TCI', '7448527670', 'CHENNAI', '2017-03-22 18:07:25', 'A'),
(28, 'SASTHA TRANSPORT', '7448527670', 'ISO CONCOR CHENNAI', '2017-04-22 17:26:03', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `party_payment`
--

CREATE TABLE IF NOT EXISTS `party_payment` (
  `Party_payment_id` int(11) NOT NULL,
  `Party_payment_party_name` int(11) NOT NULL COMMENT 'Party details reference id',
  `Party_payment_paid_amount` int(11) NOT NULL,
  `Party_payment_pay_date` date NOT NULL,
  `Party_payment_pay_status` enum('U','P') NOT NULL COMMENT 'U=Unpaid, P=Paid',
  `Party_payment_remarks` text NOT NULL,
  `Party_payment_creatred_dt_tme` datetime NOT NULL,
  `Party_payment_status` enum('A','D') NOT NULL COMMENT 'A=Approve, D=Deny'
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `party_payment`
--

INSERT INTO `party_payment` (`Party_payment_id`, `Party_payment_party_name`, `Party_payment_paid_amount`, `Party_payment_pay_date`, `Party_payment_pay_status`, `Party_payment_remarks`, `Party_payment_creatred_dt_tme`, `Party_payment_status`) VALUES
(1, 1, 0, '2017-04-01', 'P', 'FOR CHECKING', '2017-04-12 16:39:18', 'A'),
(2, 5, 0, '2017-04-01', 'P', 'FOR CHECKING', '2017-04-12 16:43:16', 'A'),
(3, 17, 0, '2017-04-01', 'P', 'FOR CHECKING', '2017-04-13 15:08:09', 'A'),
(4, 14, 0, '2017-04-01', 'P', 'FOR CHECKING', '2017-04-13 15:08:36', 'A'),
(5, 1, 0, '2017-04-01', 'P', 'FOR CHECKING', '2017-04-13 15:08:52', 'A'),
(6, 12, 0, '2017-04-01', 'P', 'FOR CHECKING', '2017-04-13 15:22:22', 'A'),
(7, 11, 0, '2017-04-01', 'P', 'for checking', '2017-04-18 10:29:37', 'A'),
(8, 14, 16000, '2017-04-16', 'P', 'INV  NO.14 PAYMENT', '2017-04-18 15:29:54', 'A'),
(9, 3, 0, '2017-04-01', 'P', 'FOR CHECKING', '2017-04-27 11:33:57', 'A'),
(10, 2, 0, '2017-04-01', 'P', 'FOR CHECKING', '2017-04-27 17:56:10', 'A'),
(11, 4, 0, '2017-04-01', 'P', 'FOR CHECKING', '2017-04-27 17:57:45', 'A'),
(12, 28, 0, '2017-04-01', 'P', 'FOR CHECKING', '2017-04-28 10:10:16', 'A'),
(13, 21, 0, '2017-04-01', 'P', 'FOR CHECKING', '2017-05-09 11:56:20', 'A'),
(14, 26, 0, '2017-04-01', 'P', 'FOR CHECKING', '2017-05-09 11:56:42', 'A'),
(15, 8, 0, '2017-04-01', 'P', 'FOR CHECKING', '2017-05-10 11:26:34', 'A'),
(16, 8, 5000, '2017-04-13', 'P', 'bcvb', '2017-05-16 12:25:46', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `party_pay_rate`
--

CREATE TABLE IF NOT EXISTS `party_pay_rate` (
  `party_pay_rate_id` int(11) NOT NULL,
  `party_pay_rate_place` int(11) NOT NULL,
  `party_pay_rate_party` int(11) NOT NULL,
  `party_pay_rate_rent` int(11) NOT NULL,
  `party_pay_rate_ot_rent` int(11) NOT NULL,
  `party_pay_rate_status` enum('A','D') NOT NULL,
  `party_pay_rate_crt_date_time` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `party_pay_rate`
--

INSERT INTO `party_pay_rate` (`party_pay_rate_id`, `party_pay_rate_place`, `party_pay_rate_party`, `party_pay_rate_rent`, `party_pay_rate_ot_rent`, `party_pay_rate_status`, `party_pay_rate_crt_date_time`) VALUES
(2, 9, 24, 300, 200, 'D', '2017-06-02 12:23:44'),
(3, 2, 20, 200, 700, 'A', '2017-06-02 12:42:20'),
(4, 2, 24, 500, 600, 'A', '2017-06-02 13:24:54'),
(5, 8, 24, 500, 100, 'A', '2017-06-02 13:24:36');

-- --------------------------------------------------------

--
-- Table structure for table `transport_details`
--

CREATE TABLE IF NOT EXISTS `transport_details` (
  `Transport_dtl_id` int(11) NOT NULL,
  `Transport_dtl_name` text NOT NULL,
  `Transport_dtl_phone_no` varchar(20) NOT NULL,
  `Transport_dtl_address` text NOT NULL,
  `Transport_dtl_created_dt_time` datetime NOT NULL,
  `Transport_dtl_status` enum('A','D') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transport_details`
--

INSERT INTO `transport_details` (`Transport_dtl_id`, `Transport_dtl_name`, `Transport_dtl_phone_no`, `Transport_dtl_address`, `Transport_dtl_created_dt_time`, `Transport_dtl_status`) VALUES
(1, 'SRI SAI TRANSPORT', '9840863631', 'CHENNAI-106', '2016-09-28 17:46:26', 'A'),
(2, 'SATHISH TRANSPORT RAVI', '9840140043', 'THIRUVATHUR CHENNAI-68', '2016-09-28 17:48:02', 'A'),
(3, 'MOHAN TPT', '9840198178', 'KALADIPET CHENNAI-68', '2016-09-28 17:49:20', 'A'),
(4, 'ARACHIYAMMAN TPT', '9940640654', 'MANCHAPAKKAM , CHENNAI', '2016-09-28 17:50:56', 'A'),
(5, 'SEVEN HILLS TRANSPORT', '9841690918', 'SUNDARAM PILLAI  NAGAR THANDAYARPET', '2016-09-28 17:52:57', 'A'),
(7, 'A K TRANSPORT', '8939201006', 'KANNIYAPPAN THIRUYOTHUR CHENNAI', '2016-09-28 17:57:07', 'A'),
(8, 'MANI TPT', '9940750892', 'CHENNAI', '2016-09-29 12:49:53', 'A'),
(9, 'PUSHPARAJ ST TRANSPORT', '9884602394', 'MATHUR, MANALI  CHENNAI-68', '2016-09-29 12:52:35', 'A'),
(10, 'SAMPATH TPT', '8754415293', 'SAMPATH CONCOR  CHENNAI', '2016-09-30 10:37:05', 'A'),
(11, 'PERIYAPALAYATHAMMAN TPT', '9841744271', 'ELUMALAI  THANDAYARPET', '2016-09-30 10:39:01', 'A'),
(12, 'AMMAJI TPT', '9840309456', 'IMMAN  CONCOR', '2016-09-30 10:40:18', 'A'),
(13, 'SRI SABAHRI TRANSPORT', '9840602093', 'MATHUR , MANALI -68', '2016-10-08 13:46:05', 'A'),
(14, 'SRI MURUGAN TRANSPORT', '8015559573', 'CHENNAI', '2016-10-06 12:37:21', 'A'),
(15, 'SURESH TRANSPORT', '8144888525', 'CHENNAI', '2016-10-10 12:12:52', 'A'),
(16, 'MM. SIVA TRANSPORT', '8015559573', 'CHENNAI', '2016-10-06 11:28:26', 'A'),
(17, 'GUKUL TRANSPORT', '9962380808', 'THANDAYARPET', '2016-10-08 19:30:15', 'A'),
(18, 'HARI DOSS TRANSPORT', '7448527670', 'NO DETAIL NUMBER HAS BEEN ERROR', '2016-12-24 12:01:17', 'A'),
(19, 'ARYA TPT', '9380714807', 'VICTOR  MADHAVARAM', '2017-04-18 13:28:08', 'A'),
(20, 'STAR TRANSPORT', '7448527670', 'CHENNAI', '2017-01-30 13:58:37', 'A'),
(21, 'OM SAKTHI TRANSPORT', '7448527670', 'CHENNAI', '2017-04-10 15:28:42', 'A'),
(22, 'SEETHAMMAL TRANSPORT', '9840677334', 'TONDIARPET, CHENNAI', '2017-04-21 19:16:01', 'A'),
(23, 'KUMAR TRANSPORT', '7448527670', 'CHENNAI', '2017-04-28 18:08:16', 'A'),
(24, 'OM SAKTHI TRANSPORT (SEKAR)', '7448527670', 'CHENNAI', '2017-04-28 18:08:53', 'A'),
(25, 'DILLI TRANSPORT', '7448527670', 'CHENNAI', '2017-05-01 12:29:52', 'A'),
(26, 'VVV TRANSPORT', '7448527670', 'CHENNAI', '2017-05-01 13:14:15', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `transport_payment`
--

CREATE TABLE IF NOT EXISTS `transport_payment` (
  `Transport_payment_id` int(11) NOT NULL,
  `Transport_payment_trans_name` int(11) NOT NULL COMMENT 'Transport name refer id transport details',
  `Transport_payment_amount` int(11) NOT NULL,
  `Transport_payment_date` date NOT NULL,
  `Transport_payment_paid_status` enum('U','P') NOT NULL COMMENT 'U=Unpaid,P=Paid',
  `Transport_payment_remark` text NOT NULL,
  `Transport_payment_creatred_dt_tme` datetime NOT NULL,
  `Transport_payment_status` enum('A','D') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transport_payment`
--

INSERT INTO `transport_payment` (`Transport_payment_id`, `Transport_payment_trans_name`, `Transport_payment_amount`, `Transport_payment_date`, `Transport_payment_paid_status`, `Transport_payment_remark`, `Transport_payment_creatred_dt_tme`, `Transport_payment_status`) VALUES
(1, 5, 0, '2017-04-01', 'P', 'FOR CHECKING', '2017-04-13 15:59:03', 'A'),
(2, 22, 0, '2017-04-01', 'P', 'FOR CHECKING', '2017-04-21 19:18:53', 'A'),
(3, 7, 0, '2017-05-01', 'P', 'FOR CHECKING', '2017-05-08 17:08:27', 'A'),
(4, 11, 10000, '2017-04-22', 'P', 'adv  payment', '2017-05-15 17:05:20', 'A'),
(5, 5, 5000, '2017-04-12', 'P', 'dfdf', '2017-05-19 12:15:37', 'A'),
(6, 5, 1700, '2017-04-12', 'P', 'dfdf', '2017-05-19 12:16:20', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_details`
--

CREATE TABLE IF NOT EXISTS `vehicle_details` (
  `Vehicle_dtl_id` int(11) NOT NULL,
  `Vehicle_dtl_number` varchar(60) NOT NULL,
  `Vehicle_dtl_make` varchar(60) NOT NULL,
  `Vehicle_dtl_permit` varchar(60) NOT NULL,
  `Vehicle_dtl_transport` enum('T','O') NOT NULL,
  `Vehicle_dtl_transport_name` int(11) NOT NULL COMMENT 'transport details table reference id',
  `Vehicle_dtl_created_dt_time` datetime NOT NULL,
  `Vehicle_dtl_status` enum('A','D') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle_details`
--

INSERT INTO `vehicle_details` (`Vehicle_dtl_id`, `Vehicle_dtl_number`, `Vehicle_dtl_make`, `Vehicle_dtl_permit`, `Vehicle_dtl_transport`, `Vehicle_dtl_transport_name`, `Vehicle_dtl_created_dt_time`, `Vehicle_dtl_status`) VALUES
(1, 'TN04AA3247', 'ASHOK LEYLANT', 'NP', 'T', 0, '2016-09-27 17:52:08', 'A'),
(2, 'TN04Q8953', 'A/L 4019 - 2006', 'NP', 'T', 0, '2016-09-27 17:53:18', 'A'),
(3, 'TN04AA3249', 'ASHOK LEYLANT', 'AP', 'T', 0, '2016-09-27 17:57:23', 'A'),
(4, 'TN20R6283', 'ASHOK LEYLANT', 'STATE', 'T', 0, '2016-09-27 17:55:18', 'A'),
(5, 'TN28AE9727', 'ASHOK LEYLANT', 'AP', 'T', 0, '2016-09-27 17:56:14', 'A'),
(6, 'TN05AE9218', 'ASHOK LEYLANT', 'AP', 'T', 0, '2016-09-27 18:00:02', 'A'),
(7, 'TN20CA1123', 'MAHENDRA', 'NP', 'T', 0, '2016-09-27 18:01:54', 'A'),
(8, 'TN20CA7378', 'MAHENDRA', 'NP', 'T', 0, '2016-11-03 12:57:44', 'A'),
(9, 'TN20CA8899', 'TATA', 'NP', 'T', 0, '2016-09-27 18:03:13', 'A'),
(10, 'TN03K2356', 'ASHOK LEYLANT', 'NP', 'T', 0, '2016-09-27 18:03:59', 'A'),
(11, 'TN28AB6005', '', '', 'O', 14, '2016-11-03 12:59:25', 'A'),
(12, 'TN18L6262', 'ASHOK LEYLANT', 'NP', 'T', 0, '2016-09-27 18:05:37', 'A'),
(13, 'TN04AE0799', 'ASHOK LEYLANT', 'STATE', 'T', 0, '2016-10-04 14:42:14', 'A'),
(14, 'TN03K2256', 'TATA', 'NP', 'T', 0, '2016-09-27 18:06:35', 'A'),
(15, 'TN03S7137', '', '', 'O', 2, '2016-09-29 15:59:18', 'A'),
(16, 'TN05AM4069', '', '', 'O', 4, '2016-09-29 16:01:30', 'A'),
(18, 'TN28AB6501', '', '', 'O', 12, '2016-09-30 10:41:45', 'A'),
(19, 'TN04Q4167', '', '', 'O', 11, '2016-09-30 11:43:49', 'A'),
(20, 'TN04AD2080', '', '', 'O', 9, '2016-09-30 18:05:28', 'A'),
(21, 'TN21AF7093', '', '', 'O', 9, '2016-09-30 18:05:55', 'A'),
(22, 'TN20AM3820', '', '', 'O', 9, '2016-09-30 18:06:28', 'A'),
(23, 'TN04AQ0587', '', '', 'O', 12, '2016-10-01 15:36:28', 'A'),
(24, 'TN05 B0599', '', '', 'O', 12, '2016-10-01 15:37:09', 'A'),
(25, 'TN04Q4167', '', '', 'O', 12, '2017-04-18 13:32:04', 'A'),
(26, 'TN31W1881', '', '', 'O', 9, '2016-10-01 15:41:21', 'A'),
(27, 'TN18AH1555', '', '', 'O', 13, '2016-10-04 13:44:47', 'A'),
(28, 'TN18AH1222', '', '', 'O', 13, '2016-10-04 13:45:09', 'A'),
(29, 'TN28E5394', '', '', 'O', 15, '2016-10-04 14:57:26', 'A'),
(30, 'TN58K0266', '', '', 'O', 9, '2016-10-07 16:36:27', 'A'),
(31, 'TN04Q2013', '', '', 'O', 10, '2016-10-08 10:58:53', 'A'),
(32, 'TN21R2299', '', '', 'O', 9, '2017-04-18 13:32:18', 'A'),
(33, 'TN39W1811', '', '', 'O', 9, '2017-04-18 13:31:48', 'A'),
(34, 'TN58K2066', '', '', 'O', 9, '2017-04-18 13:31:33', 'A'),
(35, 'TN02AD9549', '', '', 'O', 9, '2017-04-18 13:31:19', 'A'),
(36, 'TN04AF1039', '', '', 'O', 9, '2016-10-13 11:51:52', 'A'),
(37, 'TN03 7292', '', '', 'O', 17, '2016-10-22 20:25:25', 'A'),
(38, 'TN03 7499', '', '', 'O', 17, '2017-04-18 13:31:01', 'A'),
(39, 'TN04AB7211', '', '', 'O', 17, '2017-04-18 13:28:35', 'A'),
(40, 'TN04AC4636', '', '', 'O', 2, '2016-10-24 11:04:07', 'A'),
(41, 'TN04AC0031', '', '', 'O', 17, '2016-10-24 13:42:49', 'A'),
(42, 'TN05Q4911', '', '', 'O', 17, '2016-10-24 14:19:22', 'A'),
(43, 'TN05P8471', '', '', 'O', 17, '2017-04-18 13:30:34', 'A'),
(44, 'TN52A4277', '', '', 'O', 5, '2016-11-02 17:37:33', 'A'),
(45, 'TN20CA8890', '', '', 'O', 12, '2016-11-26 10:33:46', 'A'),
(46, 'TN05G0599', '', '', 'O', 12, '2016-12-24 11:41:11', 'A'),
(47, 'TN33CQ5105', '', '', 'O', 12, '2016-12-24 11:41:33', 'A'),
(48, 'TN20AC5775', '', '', 'O', 12, '2016-12-24 11:41:55', 'A'),
(49, 'TN20CM2760', '', '', 'O', 9, '2016-12-24 11:52:19', 'A'),
(50, 'TN05OP7546', '', '', 'O', 9, '2016-12-24 11:55:56', 'A'),
(51, 'TN04J5403', '', '', 'O', 18, '2017-04-18 13:30:19', 'A'),
(52, 'TN03-3726', '', '', 'O', 9, '2017-04-18 13:30:03', 'A'),
(53, 'TN04AH1692', '', '', 'O', 19, '2017-04-18 13:29:10', 'A'),
(54, 'TN28AE8019', '', '', 'O', 20, '2017-01-30 14:06:49', 'A'),
(55, 'TN22AH2133', '', '', 'O', 12, '2017-01-31 15:45:38', 'A'),
(56, 'TN04Q0587', '', '', 'O', 12, '2017-01-31 15:46:47', 'A'),
(57, 'TN05AR2621', 'TATA', '-', 'T', 0, '2017-02-23 13:32:18', 'A'),
(58, 'AP05Y8073', 'ASHOK LEYLAND', 'NP', 'T', 0, '2017-04-18 13:29:37', 'A'),
(59, 'TN04AC0060', '', '', 'O', 17, '2017-03-22 17:28:31', 'A'),
(60, 'TN05Q4911', '', '', 'O', 17, '2017-04-18 13:28:46', 'A'),
(61, 'TN04AE1899', '', '', 'O', 21, '2017-04-10 15:29:08', 'A'),
(62, 'TN04AE1099', '', '', 'O', 5, '2017-04-10 16:07:57', 'A'),
(63, 'TN20CX9209', '2012', 'TN', 'T', 0, '2017-04-19 15:16:31', 'A'),
(64, 'TN04AB5105', '', '', 'O', 22, '2017-04-21 19:16:20', 'A'),
(65, 'TN28AA5353', '', '', 'O', 23, '2017-04-28 18:27:34', 'A'),
(66, 'TN01 Y8262', '', '', 'O', 24, '2017-04-28 18:28:07', 'A'),
(67, 'TN03 J5983', '', '', 'O', 25, '2017-05-01 12:30:20', 'A'),
(68, 'TN04AP1284', '', '', 'O', 26, '2017-05-01 13:14:39', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_document_details`
--

CREATE TABLE IF NOT EXISTS `vehicle_document_details` (
  `Vehicle_doc_dtl_id` int(11) NOT NULL,
  `Vehicle_doc_dtl_vehicle_no` int(11) NOT NULL COMMENT 'vehicle details table reference id',
  `Vehicle_doc_dtl_m_permit_from` date NOT NULL,
  `Vehicle_doc_dtl_m_permit_to` date NOT NULL,
  `Vehicle_doc_dtl_n_permit_from` date NOT NULL,
  `Vehicle_doc_dtl_n_permit_to` date NOT NULL,
  `Vehicle_doc_dtl_ap_permit_from` date NOT NULL COMMENT 'Andhra Permit From',
  `Vehicle_doc_dtl_ap_permit_to` date NOT NULL COMMENT 'Andhra Permit To',
  `Vehicle_doc_dtl_insurance_from` date NOT NULL,
  `Vehicle_doc_dtl_insurance_to` date NOT NULL,
  `Vehicle_doc_dtl_fc_from` date NOT NULL,
  `Vehicle_doc_dtl_fc_to` date NOT NULL,
  `Vehicle_doc_dtl_tax_from` date NOT NULL,
  `Vehicle_doc_dtl_tax_to` date NOT NULL,
  `Vehicle_doc_dtl_pc_from` date NOT NULL,
  `Vehicle_doc_dtl_pc_to` date NOT NULL,
  `Vehicle_doc_dtl_created_dt_time` datetime NOT NULL,
  `Vehicle_doc_dtl_status` enum('A','D') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle_document_details`
--

INSERT INTO `vehicle_document_details` (`Vehicle_doc_dtl_id`, `Vehicle_doc_dtl_vehicle_no`, `Vehicle_doc_dtl_m_permit_from`, `Vehicle_doc_dtl_m_permit_to`, `Vehicle_doc_dtl_n_permit_from`, `Vehicle_doc_dtl_n_permit_to`, `Vehicle_doc_dtl_ap_permit_from`, `Vehicle_doc_dtl_ap_permit_to`, `Vehicle_doc_dtl_insurance_from`, `Vehicle_doc_dtl_insurance_to`, `Vehicle_doc_dtl_fc_from`, `Vehicle_doc_dtl_fc_to`, `Vehicle_doc_dtl_tax_from`, `Vehicle_doc_dtl_tax_to`, `Vehicle_doc_dtl_pc_from`, `Vehicle_doc_dtl_pc_to`, `Vehicle_doc_dtl_created_dt_time`, `Vehicle_doc_dtl_status`) VALUES
(1, 1, '2016-01-20', '2021-01-19', '2016-01-20', '2017-01-19', '1970-01-01', '1970-01-01', '2016-03-20', '2017-03-19', '2016-01-06', '2017-01-05', '2016-07-01', '2016-09-30', '2016-01-06', '2016-09-05', '2016-10-25 18:35:27', 'A'),
(2, 3, '2012-01-05', '2017-01-04', '1970-01-01', '1970-01-01', '2016-04-01', '2017-03-31', '2015-12-19', '2016-12-18', '2015-12-15', '2016-12-14', '2016-07-01', '2016-09-30', '2016-09-20', '2017-03-19', '2016-10-25 18:39:34', 'A'),
(3, 5, '2016-01-08', '2020-01-07', '1970-01-01', '1970-01-01', '2016-04-01', '2017-03-31', '2015-12-15', '2016-12-14', '2016-08-10', '2017-08-09', '2016-07-01', '2016-09-30', '2016-09-21', '2017-03-20', '2016-10-25 18:42:07', 'A'),
(4, 6, '2016-12-23', '2021-12-22', '2016-12-23', '2017-12-22', '1970-01-01', '1970-01-01', '2016-02-16', '2017-02-15', '2016-10-04', '2017-10-03', '2017-01-01', '2017-03-31', '2016-10-01', '2017-03-31', '2016-12-31 19:11:08', 'A'),
(5, 7, '2012-08-20', '2017-08-19', '1970-01-01', '1970-01-01', '1970-01-01', '1970-01-01', '2016-08-09', '2017-08-08', '2016-01-06', '2017-01-05', '2016-07-01', '2016-09-30', '2016-09-01', '2016-09-30', '2016-10-25 18:49:13', 'A'),
(6, 8, '2012-12-13', '2017-12-12', '1970-01-01', '1970-01-01', '1970-01-01', '1970-01-01', '2015-11-28', '2016-11-27', '2016-09-01', '2016-09-30', '2016-07-01', '2016-09-30', '2016-09-01', '2016-09-30', '2016-10-25 18:51:41', 'A'),
(7, 9, '2013-01-11', '2018-01-10', '2016-04-12', '2016-05-11', '1970-01-01', '1970-01-01', '2015-12-08', '2016-12-07', '2016-06-24', '2017-06-23', '2016-07-01', '2016-09-30', '2016-06-24', '2016-12-23', '2016-10-25 18:55:48', 'A'),
(8, 10, '2013-01-17', '2018-01-16', '2016-01-17', '2017-01-16', '1970-01-01', '1970-01-01', '2015-12-08', '2016-12-07', '2016-03-14', '2017-03-13', '2016-06-01', '2016-09-30', '2016-09-01', '2016-09-30', '2016-10-25 19:00:14', 'A'),
(9, 12, '2015-05-27', '2017-07-12', '1970-01-01', '1970-01-01', '1970-01-01', '1970-01-01', '2016-06-04', '2017-06-03', '2015-11-20', '2016-11-19', '2016-09-01', '2016-09-30', '2016-09-01', '2016-09-30', '2016-10-25 19:08:42', 'A'),
(10, 13, '2015-05-05', '2020-05-04', '1970-01-01', '1970-01-01', '1970-01-01', '1970-01-01', '2016-03-23', '2017-03-22', '2016-06-03', '2017-06-02', '2016-07-01', '2016-09-30', '2016-09-01', '2016-09-30', '2016-10-25 19:11:42', 'A'),
(11, 14, '2013-01-28', '2018-01-27', '2016-01-28', '2017-01-27', '1970-01-01', '1970-01-01', '2015-11-30', '2016-11-29', '2016-09-01', '2016-09-30', '2016-07-01', '2016-09-30', '2016-09-01', '2016-09-30', '2016-10-25 19:14:21', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_due_details`
--

CREATE TABLE IF NOT EXISTS `vehicle_due_details` (
  `Vehicle_due_dtl_id` int(11) NOT NULL,
  `Vehicle_due_dtl_vehicle_no` int(11) NOT NULL COMMENT 'vehicle details table reference id',
  `Vehicle_due_dtl_due_date` date NOT NULL COMMENT 'Due Date',
  `Vehicle_due_dtl_amount` int(11) NOT NULL COMMENT 'Due Amount',
  `Vehicle_due_dtl_mutual_date` date NOT NULL COMMENT 'pay due date',
  `Vehicle_due_dtl_pay_date` date NOT NULL COMMENT 'due amount paid date',
  `Vehicle_due_dtl_paid_date` date NOT NULL,
  `Vehicle_due_pay_status` enum('U','P') NOT NULL COMMENT 'U=Unpaid, P=Paid',
  `Vehicle_due_dtl_created_dt_time` datetime NOT NULL,
  `Vehicle_due_dtl_status` enum('A','D') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_id`);

--
-- Indexes for table `admin_user_rights_details`
--
ALTER TABLE `admin_user_rights_details`
  ADD PRIMARY KEY (`User_rights_id`);

--
-- Indexes for table `container_details`
--
ALTER TABLE `container_details`
  ADD PRIMARY KEY (`Container_dtl_id`);

--
-- Indexes for table `daily_moment_details`
--
ALTER TABLE `daily_moment_details`
  ADD PRIMARY KEY (`Daily_mvnt_dtl_id`);

--
-- Indexes for table `driver_details`
--
ALTER TABLE `driver_details`
  ADD PRIMARY KEY (`Driver_dtl_id`);

--
-- Indexes for table `driver_payment_details`
--
ALTER TABLE `driver_payment_details`
  ADD PRIMARY KEY (`Driver_pymnt_id`);

--
-- Indexes for table `driver_pay_rate`
--
ALTER TABLE `driver_pay_rate`
  ADD PRIMARY KEY (`Driver_pay_rate_id`);

--
-- Indexes for table `iso_movement_details`
--
ALTER TABLE `iso_movement_details`
  ADD PRIMARY KEY (`Iso_mvnt_id`);

--
-- Indexes for table `party_billing`
--
ALTER TABLE `party_billing`
  ADD PRIMARY KEY (`Party_billing_id`);

--
-- Indexes for table `party_details`
--
ALTER TABLE `party_details`
  ADD PRIMARY KEY (`Party_dtl_id`);

--
-- Indexes for table `party_payment`
--
ALTER TABLE `party_payment`
  ADD PRIMARY KEY (`Party_payment_id`);

--
-- Indexes for table `party_pay_rate`
--
ALTER TABLE `party_pay_rate`
  ADD PRIMARY KEY (`party_pay_rate_id`);

--
-- Indexes for table `transport_details`
--
ALTER TABLE `transport_details`
  ADD PRIMARY KEY (`Transport_dtl_id`);

--
-- Indexes for table `transport_payment`
--
ALTER TABLE `transport_payment`
  ADD PRIMARY KEY (`Transport_payment_id`);

--
-- Indexes for table `vehicle_details`
--
ALTER TABLE `vehicle_details`
  ADD PRIMARY KEY (`Vehicle_dtl_id`);

--
-- Indexes for table `vehicle_document_details`
--
ALTER TABLE `vehicle_document_details`
  ADD PRIMARY KEY (`Vehicle_doc_dtl_id`);

--
-- Indexes for table `vehicle_due_details`
--
ALTER TABLE `vehicle_due_details`
  ADD PRIMARY KEY (`Vehicle_due_dtl_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Admin_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `admin_user_rights_details`
--
ALTER TABLE `admin_user_rights_details`
  MODIFY `User_rights_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `container_details`
--
ALTER TABLE `container_details`
  MODIFY `Container_dtl_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `daily_moment_details`
--
ALTER TABLE `daily_moment_details`
  MODIFY `Daily_mvnt_dtl_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=332;
--
-- AUTO_INCREMENT for table `driver_details`
--
ALTER TABLE `driver_details`
  MODIFY `Driver_dtl_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `driver_payment_details`
--
ALTER TABLE `driver_payment_details`
  MODIFY `Driver_pymnt_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `driver_pay_rate`
--
ALTER TABLE `driver_pay_rate`
  MODIFY `Driver_pay_rate_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=189;
--
-- AUTO_INCREMENT for table `iso_movement_details`
--
ALTER TABLE `iso_movement_details`
  MODIFY `Iso_mvnt_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `party_billing`
--
ALTER TABLE `party_billing`
  MODIFY `Party_billing_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `party_details`
--
ALTER TABLE `party_details`
  MODIFY `Party_dtl_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `party_payment`
--
ALTER TABLE `party_payment`
  MODIFY `Party_payment_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `party_pay_rate`
--
ALTER TABLE `party_pay_rate`
  MODIFY `party_pay_rate_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `transport_details`
--
ALTER TABLE `transport_details`
  MODIFY `Transport_dtl_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `transport_payment`
--
ALTER TABLE `transport_payment`
  MODIFY `Transport_payment_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `vehicle_details`
--
ALTER TABLE `vehicle_details`
  MODIFY `Vehicle_dtl_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `vehicle_document_details`
--
ALTER TABLE `vehicle_document_details`
  MODIFY `Vehicle_doc_dtl_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `vehicle_due_details`
--
ALTER TABLE `vehicle_due_details`
  MODIFY `Vehicle_due_dtl_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
