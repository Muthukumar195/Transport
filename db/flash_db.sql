-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 12, 2019 at 11:34 PM
-- Server version: 5.6.44-cll-lve
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mk_thirumala`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_permission`
--

CREATE TABLE `access_permission` (
  `id` int(11) NOT NULL,
  `module_name` varchar(255) NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `access_permission`
--

INSERT INTO `access_permission` (`id`, `module_name`, `status_id`) VALUES
(1, 'Driver Details', 1),
(2, 'Driver Pay Rate', 1),
(3, 'Driver Payment', 1),
(4, 'Party Pay rate', 1),
(5, 'Vehicle Details', 1),
(6, 'Vehicle Document Details', 1),
(7, 'Daily Movement', 1),
(8, 'Party Details', 1),
(9, 'Party Billing', 1),
(10, 'Party Payments', 1),
(11, 'ISO Movement', 1),
(12, 'Transport Details', 1),
(13, 'Transport Payment', 1),
(14, 'Vehicle Due Details', 1),
(15, 'Vehicle Maintenance', 1),
(16, 'Admin User Rights', 1),
(17, 'User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin_id` int(11) NOT NULL,
  `Admin_fullname` varchar(450) NOT NULL,
  `Admin_email` text NOT NULL,
  `Admin_phone` varchar(25) NOT NULL,
  `Admin_username` varchar(120) NOT NULL,
  `Admin_password` varchar(60) NOT NULL,
  `Admin_profile` text NOT NULL,
  `Admin_type` enum('A','E','M','I','AC') NOT NULL COMMENT 'A=Admin, E=Employee, M=Manager, I=Incharge, AC=Accountant',
  `Admin_role` int(11) NOT NULL,
  `Admin_access_permission` varchar(250) NOT NULL,
  `Admin_user_rights` int(11) NOT NULL COMMENT 'reference id of user rights table',
  `Admin_created_dt_tme` datetime NOT NULL,
  `Admin_status` enum('A','D') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_id`, `Admin_fullname`, `Admin_email`, `Admin_phone`, `Admin_username`, `Admin_password`, `Admin_profile`, `Admin_type`, `Admin_role`, `Admin_access_permission`, `Admin_user_rights`, `Admin_created_dt_tme`, `Admin_status`) VALUES
(1, 'Adminstrator', 'srithirumalatransport3247@gmail.com', '9840602093', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'profile_pic1.jpg', 'A', 1, '1,2,3', 0, '2019-10-11 07:32:05', 'A'),
(2, 'Mr.Muthu kumar', 'muthukumaran195@gmail.com', '8675752575', 'muthu', 'Test@123', 'profile_pic2.jpg', 'A', 2, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15', 1, '2019-10-12 23:25:25', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `admin_user_rights_details`
--

CREATE TABLE `admin_user_rights_details` (
  `User_rights_id` int(11) NOT NULL,
  `User_rights_name` varchar(220) NOT NULL,
  `User_rights_type_value` text NOT NULL,
  `User_rights_created_dt_time` datetime NOT NULL,
  `User_rights_status` enum('A','D') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_user_rights_details`
--

INSERT INTO `admin_user_rights_details` (`User_rights_id`, `User_rights_name`, `User_rights_type_value`, `User_rights_created_dt_time`, `User_rights_status`) VALUES
(1, 'Employee', 'Driver Details,Driver Pay Rate,Driver Payment,Party Pay rate,Vehicle Details,Vehicle Document Details,Daily Movement,Party Details,Party Billing,Party Payments,ISO Movement,Transport Details,Transport Payment,Vehicle Due Details,Vehicle Maintenance', '2019-10-12 23:23:23', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `common_status`
--

CREATE TABLE `common_status` (
  `id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `common_status`
--

INSERT INTO `common_status` (`id`, `status`) VALUES
(1, 'Active'),
(2, 'Deny');

-- --------------------------------------------------------

--
-- Table structure for table `container_details`
--

CREATE TABLE `container_details` (
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

CREATE TABLE `daily_moment_details` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `driver_details`
--

CREATE TABLE `driver_details` (
  `Driver_dtl_id` int(11) NOT NULL,
  `Driver_dtl_name` varchar(160) NOT NULL,
  `Driver_dtl_phone` varchar(20) NOT NULL,
  `Driver_dtl_address` text NOT NULL,
  `Driver_dtl_license_file` text NOT NULL,
  `Driver_dtl_type` enum('P','A') NOT NULL COMMENT 'P=Permanent, A=Acting',
  `Driver_dtl_created_dt_time` datetime NOT NULL,
  `Driver_dtl_status` enum('A','D') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `driver_details`
--

INSERT INTO `driver_details` (`Driver_dtl_id`, `Driver_dtl_name`, `Driver_dtl_phone`, `Driver_dtl_address`, `Driver_dtl_license_file`, `Driver_dtl_type`, `Driver_dtl_created_dt_time`, `Driver_dtl_status`) VALUES
(1, 'JAMBULINGAM', '8682001436', 'pondy', 'lecense1.jpg', 'P', '2016-09-28 10:55:07', 'A'),
(2, 'JAYARAMAN', '7418001247', 'VINAYAGAR KOVIL  ST KOVILOR  V&P CHEYYAR TK TVM DIST', 'lecense2.jpg', 'P', '2016-09-28 10:46:07', 'D'),
(3, 'MANI RAJ', '8754598060', 'THIRUNALVELLI', 'lecense3.jpg', 'P', '2016-09-28 10:47:28', 'D'),
(4, 'B.RAJU', '9095674143', '1/96C,PERIYA  STREET MADHURANTHANALLUR  CHIDAMBARAM CUDDALORE-608201', 'lecense4.jpg', 'P', '2016-09-28 10:52:53', 'D'),
(5, 'SURESH', '9003578788', 'T. VELLORE  VILLAGE TANIPADI  POST CHANGAM TALUK-606708', 'lecense5.jpg', 'P', '2016-09-28 10:58:14', 'A'),
(6, 'P.ANANTH', '8110835419', '75, NALLAPITCHANPATTI SENDURAI , NATHAM,  T.K  DINDIGUL-624403', 'lecense6.jpg', 'P', '2016-09-28 11:02:56', 'D'),
(7, 'MUTHUSAMY', '7092099440', 'NO. 11 KORALPAKKAM  PATHUR STREET THANIKAVADI POLLUR  TK THIRUVANNAMALAI  DIST', 'lecense7.jpg', 'P', '2016-09-28 11:06:23', 'D'),
(8, 'JAYAVEL', '9655718529', 'MELSEVALAM  PADI VILLAGE NARNA MANGALAM POST SENGEE TK  VILLUPURAM DIST-604201', 'lecense8.jpg', 'P', '2016-09-28 11:09:10', 'A'),
(9, 'YOVAN', '8675405097', 'ANNA NORTH STREET SIVAGIRI TK', 'lecense9.jpg', 'P', '2016-09-28 11:10:36', 'A'),
(10, 'ANTONY RAJ', '8608502790', 'CSI KOIL  STREET DURAISAMY PURAM POST THIRUNELVELI-627001', 'lecense10.jpg', 'P', '2016-09-28 11:12:54', 'D'),
(11, 'MURUGAN', '9087140219', 'THENKASI', 'lecense11.jpg', 'P', '2016-09-28 11:13:52', 'A'),
(12, 'POOVARAGAVAN', '9655921102', 'NO-113, PALLA STREET KORALPAKKAM POLUR- TK THIRUVANNAMALAI DIST', 'lecense12.jpg', 'P', '2016-09-28 11:16:36', 'D'),
(13, 'SANKARANARAYANAN', '9783637293', 'NO-19 , ANNA SOUTH STREET , SIVAGIRI- TK  THIRUNELVELI- 627757', 'lecense13.jpg', 'P', '2016-11-05 17:36:17', 'A'),
(14, 'MANI MARAN', '7373508216', 'THIRUNALVELI', 'lecense14.jpg', 'P', '2016-09-28 11:25:22', 'D'),
(15, 'DINAKAR', '8608508267', 'POLUR', 'lecense15.jpg', 'P', '2016-09-28 11:26:44', 'D'),
(16, 'KALERAJ', '8098129990', 'NO-24 , ANNA NORTH STREET , SIVAGIRI', 'lecense16.jpg', 'P', '2016-09-28 11:29:05', 'A'),
(17, 'SHANMUGAM', '8122480864', '117, THALAYATHAM  GOODANAGARAM ROAD GUDIYATTAM', 'lecense17.jpg', 'A', '2016-09-29 17:28:20', 'A'),
(18, 'BALAJI', '8682906997', 'NO ;39/12 NEW NO ;21A/11 APPARSAMY KOVIL ROAD ST TVT  CHENNAI-19', 'lecense18.jpg', 'A', '2016-09-29 17:30:41', 'D'),
(19, 'PALANISAMY', '7094829808', 'NO; 407MURAIYUR-PO , THIRUPATHUR -TK SIVAGANGAI', 'lecense19.jpg', 'A', '2016-09-29 17:59:27', 'D'),
(20, 'AROKIYARAJ', '9865109319', 'THOOTHUKUTI DIST', 'lecense20.jpg', 'A', '2016-10-01 13:03:44', 'D'),
(21, 'DHANAPAL', '9809413428', 'CHENNAI (DOUT)', 'lecense21.jpg', 'A', '2016-10-01 13:05:48', 'D'),
(22, 'SUBASH', '8124274961', 'CHENNAI', 'lecense22.jpg', 'P', '2016-10-12 14:55:57', 'D'),
(23, 'RAMADOSS', '8015559573', 'CHENNAI', 'lecense23.jpg', 'A', '2016-11-14 10:36:10', 'D'),
(24, 'SELADURAI', '9500183087', '30/1, SATHIRAKONDAN,  SANKARANKOVIL, TK NELLAI', 'lecense24.jpg', 'P', '2016-11-21 17:37:55', 'D'),
(25, 'RAM MOORTHI', '9994321362', 'RAJAPALAYAM', 'lecense25.jpg', 'P', '2016-11-19 13:31:52', 'D'),
(26, 'RAMESH KUMAR', '8015559573', 'NEW DRIVER', 'lecense26.jpg', 'P', '2016-12-08 10:23:46', 'D'),
(27, 'PONRAJ R', '8122677935', '119 MANJANAICKENPATTI  BLOCK-1 ETTAYAPURAM', 'lecense27.jpg', 'A', '2017-01-02 12:17:10', 'D'),
(28, 'RAMESH R', '9025517380', '1/38 ,NORTH STREET ,RUBANARAYANANALLUR  , VRIDHACHALAM TK', 'lecense28.jpg', 'A', '2017-01-02 12:14:17', 'D'),
(29, 'TAMIL SELVAN', '7339401865', 'SIVAGIRI TK THIRUNELVELI DIST', 'lecense29.jpg', 'P', '2017-01-10 17:40:02', 'D'),
(30, 'SURESH KUMAR', '9176457654', 'MARAVAMANGALAM PO , SIVAGANGAI -DT', 'lecense30.jpg', 'P', '2017-01-23 12:46:49', 'D'),
(31, 'ANNADURAI', '7448527670', 'CHENNAI', 'lecense31.jpg', 'A', '2017-02-02 11:05:20', 'A'),
(33, 'S.MURUGAN', '7448527670', 'CHENNAI', 'lecense33.jpg', 'A', '2017-04-10 15:37:46', 'D'),
(34, 'GANESAN', '7448527670', 'CHENNAI', 'lecense34.jpg', 'A', '2017-04-19 15:18:40', 'D'),
(35, 'MEIYALAGAN', '7448527670', 'THIRUVOTTIYUR', 'lecense35.jpg', 'A', '2017-05-01 12:39:27', 'A'),
(36, 'CHANDRAN', '7448527670', 'SIVAGIRI', 'lecense36.jpg', 'P', '2017-05-17 13:45:40', 'D'),
(37, 'GOVINDARAJ(NEW)', '7448527670', 'CHENNAI', 'lecense37.jpg', 'A', '2017-06-17 11:10:10', 'D'),
(38, 'SUDHAKAR', '7448265220', 'CHENNAI', 'lecense38.jpg', 'A', '2017-06-17 12:04:30', 'D'),
(39, 'LASER', '7448527670', 'SIVAGIRI ,THIRUNELVELI', 'lecense39.jpg', 'P', '2017-07-18 14:46:15', 'A'),
(40, 'NATRAJAN', '7448527670', 'SIVAGIRI', 'lecense40.jpg', 'A', '2017-07-29 19:40:17', 'D'),
(41, 'SEKAR', '7448527670', 'CHENNAI', 'lecense41.jpg', 'A', '2017-07-31 11:03:17', 'D'),
(42, 'MURUGAN 3', '7448527670', 'CHENNAI', 'lecense42.jpg', 'A', '2017-07-31 11:20:46', 'D'),
(43, 'BABU', '7448527670', 'CHENNAI', 'lecense43.jpg', 'A', '2017-08-11 12:05:16', 'D'),
(44, 'M.S.MANI', '7448527670', 'CHENNAI', 'lecense44.jpg', 'A', '2017-08-22 11:24:20', 'D'),
(45, 'MURUGAN 4', '7448527670', 'CHENNAI', 'lecense45.jpg', 'P', '2017-08-22 11:35:08', 'A'),
(46, 'MANIKANDAN', '9435281035', 'CHENNAI', 'lecense46.jpg', 'A', '2017-08-22 12:32:13', 'D'),
(47, 'SHAMPATH', '9648215325', 'CHENNAI', 'lecense47.jpg', 'A', '2017-09-30 10:51:00', 'D'),
(48, 'ANANDRAJ', '9536253685', 'UCHALAMPATTI', 'lecense48.jpg', 'A', '2017-10-03 14:36:59', 'D'),
(49, 'KANNAIYAN', '7448527670', 'CHENNAI', 'lecense49.jpg', 'A', '2017-10-31 13:20:07', 'D'),
(50, 'SELVAM (NEW)', '9832586956', '2 DRIVER  CHENNAI', 'lecense50.jpg', 'A', '2017-10-31 13:44:24', 'D'),
(51, 'MURUGANDHAM DURAI', '8838266776', 'THOOTHUKUDI ,TAMILNADU', 'lecense51.jpg', 'A', '2017-11-27 11:02:25', 'A'),
(52, 'MOORTHY', '9820358521', 'THOOTHUKUDI', 'lecense52.jpg', 'A', '2017-11-27 16:00:26', 'A'),
(53, 'PARAMASIVAM', '9820653652', 'THOOTHUKUDI', 'lecense53.jpg', 'A', '2017-11-27 16:01:31', 'A'),
(54, 'M.MURUGAN  (NEW)', '9840602093', 'CHENNAI', 'lecense54.jpg', 'A', '2017-11-29 17:24:53', 'A'),
(55, 'S.MURUGAN (NEW)', '9840602093', 'CHENNAI', 'lecense55.jpg', 'A', '2017-11-29 17:25:33', 'D'),
(56, 'MARIMUTHU', '9856215653', 'THOTHUKUDI', 'lecense56.jpg', 'A', '2017-11-29 17:36:57', 'A'),
(57, 'JABBA', '9500063507', 'CHENNAI', 'lecense57.jpg', 'A', '2017-12-06 17:08:11', 'D'),
(58, 'MUTHU', '9092141859', 'THOOTHUKUDI', 'lecense58.jpg', 'P', '2017-12-27 11:59:07', 'A'),
(59, 'SELVA KUMAR', '9876543210', 'NO', 'lecense59.jpg', 'A', '2018-01-12 14:07:10', 'A'),
(60, 'LOGU', '7395917231', 'TUTICORIN', 'lecense60.jpg', 'A', '2018-01-20 18:09:53', 'A'),
(61, 'PONDIYAN', '9843415418', 'CHINNAKKATTALAI,MADURAI.', 'lecense61.jpg', 'A', '2018-01-31 14:24:52', 'A'),
(62, 'PRATHISH KUMAR', '9003211709', 'CHOOLAIMEDU', 'lecense62.jpg', 'A', '2018-02-08 14:55:30', 'A'),
(63, 'MURUGAPANDIYAN', '9047086488', 'THIRUMAYAM,PUDUKKOTTAI', 'lecense63.jpg', 'A', '2018-02-20 10:43:39', 'A'),
(64, 'THANGAPANDI', '9840602093', 'PUDUKKOTTAI', 'lecense64.jpg', 'A', '2018-02-26 18:48:43', 'A'),
(65, 'K.MUTHU', '9655541438', '2/300 Valacheri Vattak Mannargudi Thiruvarur', 'lecense65.jpg', 'P', '2018-03-05 14:01:56', 'D'),
(66, 'KABIL', '9840602093', 'NO', 'lecense66.jpg', 'A', '2018-03-02 17:50:44', 'A'),
(67, 'K Mari Muthu', '9655541438', 'No.2-300 Valachery Vattar Mannaragudi TK Thiruvarur', 'lecense67.jpg', 'P', '2018-03-05 14:08:33', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `driver_payment_details`
--

CREATE TABLE `driver_payment_details` (
  `Driver_pymnt_id` int(11) NOT NULL,
  `Driver_pymnt_di_driver_name` int(11) NOT NULL COMMENT 'Driver  Details reference id',
  `Driver_pymnt_pay_date` date NOT NULL,
  `Driver_pymnt_pay_status` enum('U','P') NOT NULL COMMENT 'U=UNPAID, P=PAID',
  `Driver_pymnt_remarks` text NOT NULL,
  `Driver_pymnt_amount` int(11) NOT NULL,
  `Driver_pymnt_created_dt_tme` datetime NOT NULL,
  `Driver_pymnt_status` enum('A','D') NOT NULL COMMENT 'A=Approve, D=Deny'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `driver_pay_rate`
--

CREATE TABLE `driver_pay_rate` (
  `Driver_pay_rate_id` int(11) NOT NULL,
  `Driver_pay_rate_place_name` text NOT NULL,
  `Driver_pay_rate_amount` int(11) NOT NULL,
  `Driver_pay_rate_diesel_ltr` int(11) NOT NULL,
  `Driver_pay_rate_diesel_rate` int(11) NOT NULL,
  `Driver_pay_rate_created_dt_time` datetime NOT NULL,
  `Driver_pay_rate_status` enum('A','D') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `iso_movement_details`
--

CREATE TABLE `iso_movement_details` (
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
  `Iso_mvnt_diesel_ltr` int(11) NOT NULL,
  `Iso_mvnt_loading_status` enum('L','U','OL') DEFAULT NULL COMMENT 'L=Loading, U=Unloding',
  `Iso_mvnt_from` varchar(160) NOT NULL,
  `Iso_mvnt_to` varchar(160) NOT NULL,
  `Iso_mvnt_load_drop` varchar(160) NOT NULL,
  `Iso_mvnt_transport_name` int(11) NOT NULL COMMENT 'transport details reference id',
  `Iso_mvnt_tp_amount` int(11) NOT NULL,
  `Iso_mvnt_driver_name` int(11) NOT NULL,
  `Iso_mvnt_driver_amount` int(11) NOT NULL,
  `Iso_mvnt_driver_adv` int(11) NOT NULL,
  `Iso_mvnt_driver_trip_amount` int(11) NOT NULL,
  `Iso_mvnt_driver_po_ex` int(11) NOT NULL,
  `Iso_mvnt_driver_pc_ex` int(11) NOT NULL,
  `Iso_mvnt_driver_mamul` int(11) NOT NULL,
  `Iso_mvnt_driver_other_ex` int(11) NOT NULL,
  `Iso_mvnt_driver_remark` text NOT NULL,
  `Iso_mvnt_driver_pay_status` enum('U','P') NOT NULL,
  `Iso_mvnt_driver_pay_date` date NOT NULL,
  `Iso_mvnt_party_name` int(11) NOT NULL,
  `Iso_mvnt_party_amt` int(11) NOT NULL,
  `Iso_mvnt_amount` int(11) NOT NULL,
  `Iso_mvnt_paid_status` enum('U','P') NOT NULL COMMENT 'U=Unpaid , P=paid',
  `Iso_mvnt_paid_date` date NOT NULL COMMENT 'amount paid date',
  `Iso_mvnt_created_dt_time` datetime NOT NULL,
  `Iso_mvnt_status` enum('A','D') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `modules_permissions`
--

CREATE TABLE `modules_permissions` (
  `id` int(11) NOT NULL,
  `module_name` varchar(250) NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modules_permissions`
--

INSERT INTO `modules_permissions` (`id`, `module_name`, `status_id`) VALUES
(1, 'Driver Details', 1),
(2, 'Driver Pay Rate', 1),
(3, 'Driver Payment', 1),
(4, 'Party Pay Rate', 1),
(5, 'Vehicle Details', 1),
(6, 'Vehicle Document Details', 1),
(7, 'Daily Movement', 1),
(8, 'Party Details', 1),
(9, 'Party Billing', 1),
(10, 'Party Payment', 1),
(11, 'ISO Movement', 1),
(12, 'Transport Details', 1),
(13, 'Transport Payment', 1),
(14, 'Vehicle Due Details', 1),
(15, 'Vehicle Maintenance', 1),
(16, 'User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `party_billing`
--

CREATE TABLE `party_billing` (
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

CREATE TABLE `party_details` (
  `Party_dtl_id` int(11) NOT NULL,
  `Party_dtl_name` text NOT NULL,
  `Party_dtl_phone_no` varchar(20) NOT NULL,
  `Party_dtl_address` text NOT NULL,
  `Party_dtl_created_dt_time` datetime NOT NULL,
  `Party_dtl_status` enum('A','D') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `party_details`
--

INSERT INTO `party_details` (`Party_dtl_id`, `Party_dtl_name`, `Party_dtl_phone_no`, `Party_dtl_address`, `Party_dtl_created_dt_time`, `Party_dtl_status`) VALUES
(1, 'M/S.E2E', '9381503236', 'Rajaji Salai, Chennai-600 001', '2016-09-26 17:46:35', 'A'),
(2, 'M/S. SHREYAS', '9840863080', 'NO.2, 9TH LANE , \"TRANS WORLD HOUSE \" -ANNEX E , 4TH FLOOR DR. RADHAKRISHNAN   SALAI , MYLAPORE , CHENNAI -600004', '2016-09-28 11:48:09', 'A'),
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
(28, 'SASTHA SENIOR', '9940450705', 'CONCOR ISO TNPM CHENNAI', '2017-09-02 19:29:45', 'A'),
(29, 'MR.KALYANITRANSPORT', '9841095807', 'CHENNAI', '2018-02-05 16:34:40', 'A'),
(30, 'M/S.SPICE(PERINTHAVANAM)', '9525435802', 'GREEN TECH SOLUTION\r\nGUNDY', '2017-08-22 19:41:09', 'A'),
(31, 'M/S. VISHAKAM ROAD LINE (GARADA)', '9248536253', 'CHENNAI', '2017-09-01 15:17:30', 'A'),
(32, 'SS ENTERPRISES', '9082035624', 'KRISHNA KOVIL STREET , PARRIES CHENNAI-01', '2017-09-01 15:38:13', 'A'),
(33, 'OMRT', '9444028920', 'WALL TEX ROAD CHENNAI', '2017-09-02 19:02:28', 'A'),
(34, 'SASTHA BUILDON', '9940450705', 'CONCOR ISO CHENNAI 19', '2017-09-02 19:30:58', 'A'),
(35, 'FALCON', '9789524269', 'SANTHOSAPURAM', '2017-09-08 18:51:02', 'A'),
(36, 'M/S.GREEN TECH SOLU', '9840806132', 'T.NAGAR CHENNAI', '2017-09-08 18:55:18', 'A'),
(37, 'SURFACE LOGISTICS', '9886553571', 'BASAVANAPURA MAIN ROAD, BANGALORE -560036', '2017-10-06 12:38:26', 'A'),
(38, 'SRI MASILAMANI LOGISTICS', '7338910620', 'CHOLAPURAM , AMBATHUR ,CHENNAI-53', '2017-10-06 15:49:55', 'A'),
(39, 'AMMAJI TPT  (IMMAM)', '9842615025', 'TONDAYARPET  CHENNAI', '2017-10-26 16:37:04', 'A'),
(40, 'ELUMALAI TPT', '9841744271', 'CHENNAI', '2018-02-05 16:35:11', 'A'),
(41, 'DILLI TRANSPORT', '9884448629', 'SATHUMA N AGAR , THIRUVOTTIYUR  , CHENNAI - 600019', '2017-12-07 16:53:58', 'A'),
(42, 'M/S. T RAM', '9840200032', 'THAMBUCHITTY STREET CHENNAI 600001', '2018-03-01 13:21:47', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `party_payment`
--

CREATE TABLE `party_payment` (
  `Party_payment_id` int(11) NOT NULL,
  `Party_payment_party_name` int(11) NOT NULL COMMENT 'Party details reference id',
  `Party_payment_paid_amount` int(11) NOT NULL,
  `Party_payment_pay_date` date NOT NULL,
  `Party_payment_pay_status` enum('U','P') NOT NULL COMMENT 'U=Unpaid, P=Paid',
  `Party_payment_remarks` text NOT NULL,
  `Party_payment_creatred_dt_tme` datetime NOT NULL,
  `Party_payment_status` enum('A','D') NOT NULL COMMENT 'A=Approve, D=Deny'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `party_pay_rate`
--

CREATE TABLE `party_pay_rate` (
  `party_pay_rate_id` int(11) NOT NULL,
  `party_pay_rate_place` int(11) NOT NULL,
  `party_pay_rate_party` int(11) NOT NULL,
  `party_pay_rate_rent` int(11) NOT NULL,
  `party_pay_rate_ot_rent` int(11) NOT NULL,
  `party_pay_rate_status` enum('A','D') NOT NULL,
  `party_pay_rate_crt_date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Party pay rate';

--
-- Dumping data for table `party_pay_rate`
--

INSERT INTO `party_pay_rate` (`party_pay_rate_id`, `party_pay_rate_place`, `party_pay_rate_party`, `party_pay_rate_rent`, `party_pay_rate_ot_rent`, `party_pay_rate_status`, `party_pay_rate_crt_date_time`) VALUES
(2, 34, 1, 5300, 4800, 'A', '2017-12-06 18:41:26'),
(3, 29, 1, 8300, 7700, 'A', '2017-12-06 18:40:25'),
(4, 10, 14, 8000, 7000, 'A', '2017-06-21 17:56:27'),
(5, 32, 12, 7500, 7000, 'A', '2017-11-12 15:09:22'),
(6, 49, 5, 10500, 10000, 'A', '2017-06-22 11:03:44'),
(7, 38, 8, 14000, 13000, 'A', '2017-06-26 10:55:02'),
(8, 62, 3, 3700, 3200, 'A', '2017-06-26 11:22:12'),
(9, 172, 17, 16000, 15000, 'A', '2017-06-26 11:23:10'),
(10, 187, 17, 12500, 11000, 'A', '2017-06-26 11:24:31'),
(11, 204, 4, 6500, 5500, 'A', '2017-07-19 11:05:15'),
(12, 205, 17, 16000, 15000, 'A', '2017-07-03 16:13:14'),
(13, 61, 11, 4800, 4300, 'A', '2017-07-03 16:43:26'),
(14, 15, 5, 12500, 11500, 'A', '2017-07-03 17:43:39'),
(15, 206, 5, 12500, 11500, 'A', '2017-07-03 17:52:48'),
(16, 176, 4, 5500, 5000, 'A', '2017-07-07 11:01:33'),
(17, 158, 28, 1500, 1250, 'A', '2017-09-11 14:31:58'),
(18, 198, 28, 32000, 30000, 'A', '2017-07-10 18:22:22'),
(19, 189, 28, 5500, 5000, 'A', '2017-07-10 18:23:21'),
(20, 22, 20, 11000, 10500, 'A', '2017-07-10 18:40:28'),
(21, 144, 11, 3300, 2700, 'A', '2017-07-14 11:28:12'),
(22, 209, 6, 9000, 8500, 'A', '2017-07-15 13:13:55'),
(23, 208, 17, 4000, 3500, 'A', '2017-07-15 14:32:25'),
(24, 207, 14, 8000, 7000, 'A', '2017-07-15 14:39:27'),
(25, 99, 17, 12500, 11500, 'A', '2017-07-15 17:55:16'),
(26, 32, 11, 6500, 6000, 'A', '2017-07-17 10:40:29'),
(27, 187, 5, 11500, 10500, 'A', '2017-07-17 10:48:22'),
(28, 1, 1, 20000, 17000, 'A', '2018-02-06 11:09:58'),
(29, 178, 28, 3000, 2500, 'A', '2017-07-18 14:42:51'),
(30, 35, 17, 12500, 11500, 'A', '2017-07-18 15:44:53'),
(31, 15, 17, 13500, 12500, 'A', '2017-07-21 13:08:07'),
(32, 77, 28, 6000, 5500, 'A', '2017-07-21 14:45:44'),
(33, 163, 28, 10000, 9500, 'A', '2017-07-28 15:03:11'),
(34, 106, 28, 10000, 9500, 'A', '2017-07-28 15:03:26'),
(35, 95, 29, 7000, 6500, 'A', '2017-07-28 15:43:18'),
(36, 63, 28, 6000, 5500, 'A', '2017-07-29 18:39:42'),
(37, 59, 11, 9000, 8500, 'A', '2017-07-29 18:42:54'),
(38, 68, 28, 12000, 11500, 'A', '2017-07-29 19:04:05'),
(39, 210, 11, 3000, 2500, 'A', '2017-07-29 19:08:53'),
(40, 133, 28, 10000, 9500, 'A', '2017-07-29 19:13:51'),
(41, 6, 26, 8000, 7500, 'A', '2017-07-29 19:30:54'),
(42, 200, 26, 8000, 7500, 'A', '2017-09-11 11:18:39'),
(43, 147, 5, 7000, 6500, 'A', '2017-07-31 10:51:45'),
(44, 10, 5, 7000, 6500, 'A', '2017-07-31 10:53:10'),
(45, 211, 11, 3000, 2500, 'A', '2017-07-31 11:02:03'),
(46, 35, 5, 11500, 11000, 'A', '2017-07-31 11:23:59'),
(47, 204, 11, 5000, 4500, 'A', '2017-08-11 12:51:27'),
(48, 206, 17, 13500, 13000, 'A', '2017-08-11 16:32:04'),
(49, 32, 4, 7700, 7200, 'A', '2017-08-23 16:12:08'),
(50, 3, 11, 5500, 5000, 'A', '2017-08-12 15:23:05'),
(51, 136, 26, 18000, 17000, 'A', '2017-08-22 11:08:44'),
(52, 13, 30, 8000, 7000, 'A', '2017-08-22 19:42:06'),
(53, 87, 14, 8000, 7000, 'A', '2017-09-01 10:44:10'),
(54, 82, 12, 8000, 7000, 'A', '2017-10-13 20:25:46'),
(55, 119, 31, 23500, 22000, 'A', '2017-09-01 15:18:00'),
(56, 14, 29, 16000, 14000, 'A', '2017-09-01 15:53:34'),
(57, 212, 28, 10000, 9500, 'A', '2017-09-08 12:05:22'),
(58, 213, 33, 25000, 24000, 'A', '2017-09-02 19:15:20'),
(59, 45, 34, 10000, 7500, 'A', '2017-09-02 19:33:19'),
(60, 178, 34, 3000, 2500, 'A', '2017-09-02 19:40:05'),
(61, 158, 34, 1500, 1250, 'A', '2017-09-11 14:32:16'),
(62, 32, 4, 9400, 8400, 'A', '2017-09-05 12:29:27'),
(63, 128, 5, 12500, 11500, 'A', '2017-09-08 12:37:32'),
(64, 214, 5, 32000, 30000, 'A', '2017-09-08 18:58:00'),
(65, 106, 35, 10000, 9500, 'A', '2017-09-08 18:51:23'),
(66, 212, 36, 10000, 9500, 'A', '2017-09-08 18:55:44'),
(67, 240, 32, 3500, 3250, 'A', '2017-12-18 20:59:47'),
(68, 195, 11, 8000, 7500, 'A', '2017-09-25 16:46:27'),
(69, 78, 5, 11500, 11000, 'A', '2017-09-25 17:07:49'),
(70, 175, 11, 5000, 4500, 'A', '2017-09-27 12:28:22'),
(71, 133, 4, 7500, 7000, 'A', '2017-09-27 12:36:18'),
(72, 136, 29, 19000, 18500, 'A', '2017-12-09 18:23:09'),
(73, 216, 11, 5000, 4500, 'A', '2017-09-27 14:18:08'),
(74, 217, 11, 6000, 5500, 'A', '2017-09-27 14:25:17'),
(75, 44, 11, 7000, 6500, 'A', '2017-09-27 14:44:18'),
(76, 180, 21, 15500, 14500, 'A', '2017-09-27 15:08:56'),
(77, 38, 21, 15500, 14500, 'A', '2017-09-27 15:09:40'),
(78, 53, 21, 10000, 9500, 'A', '2017-09-28 16:47:52'),
(79, 32, 21, 7500, 7000, 'A', '2017-09-28 16:48:06'),
(80, 26, 5, 7500, 7000, 'A', '2017-09-28 16:54:01'),
(81, 13, 5, 8500, 8000, 'A', '2017-09-28 17:02:49'),
(82, 65, 4, 10000, 8500, 'A', '2017-10-13 20:27:17'),
(83, 148, 12, 6000, 5500, 'A', '2017-09-30 17:20:28'),
(84, 174, 12, 6000, 5500, 'A', '2017-09-30 17:20:55'),
(85, 191, 12, 6000, 5000, 'A', '2017-09-30 17:23:43'),
(86, 218, 12, 8000, 7000, 'A', '2017-10-13 20:26:34'),
(87, 144, 5, 4000, 3500, 'A', '2017-09-30 17:43:39'),
(88, 31, 5, 4000, 3500, 'A', '2017-09-30 17:56:25'),
(89, 32, 5, 7500, 7000, 'A', '2017-09-30 18:01:52'),
(90, 73, 5, 12500, 11500, 'A', '2017-10-03 10:59:51'),
(91, 31, 11, 4500, 4000, 'A', '2017-10-03 13:38:49'),
(92, 219, 11, 8000, 7500, 'A', '2017-10-04 12:40:44'),
(93, 220, 37, 15000, 14000, 'A', '2017-10-06 12:40:13'),
(94, 221, 38, 12000, 11000, 'A', '2017-10-06 15:51:23'),
(95, 100, 17, 12500, 11500, 'A', '2017-10-09 13:14:25'),
(96, 74, 14, 8000, 7000, 'A', '2017-10-26 16:03:26'),
(97, 204, 39, 5000, 4500, 'A', '2017-10-26 16:38:17'),
(98, 31, 21, 4800, 4300, 'A', '2017-10-26 16:56:25'),
(99, 24, 11, 11000, 10000, 'A', '2017-10-26 19:27:12'),
(100, 222, 39, 5000, 4500, 'A', '2017-10-27 11:01:33'),
(101, 9, 21, 5800, 5300, 'A', '2017-10-27 11:22:34'),
(102, 204, 21, 6000, 5500, 'A', '2017-10-27 12:03:24'),
(103, 222, 21, 5000, 4500, 'A', '2017-10-27 13:02:02'),
(104, 95, 21, 8500, 8000, 'A', '2017-10-31 13:07:37'),
(105, 70, 21, 32000, 31000, 'A', '2017-10-31 13:40:04'),
(106, 108, 21, 10500, 10000, 'A', '2017-10-31 14:03:13'),
(107, 223, 5, 7500, 7000, 'A', '2017-10-31 14:43:06'),
(108, 175, 21, 5000, 4500, 'A', '2017-11-08 17:07:11'),
(109, 226, 21, 6500, 6000, 'A', '2017-11-09 14:33:17'),
(110, 176, 40, 6200, 5700, 'A', '2017-11-11 09:38:24'),
(111, 227, 11, 4861, 4581, 'A', '2017-11-12 13:19:19'),
(112, 228, 11, 6881, 6581, 'A', '2017-11-12 13:28:11'),
(113, 204, 5, 6000, 5500, 'A', '2017-11-12 13:31:07'),
(114, 229, 11, 7500, 7000, 'A', '2017-11-12 13:50:14'),
(115, 229, 12, 7500, 7000, 'A', '2017-11-12 13:52:24'),
(116, 230, 11, 6881, 6581, 'A', '2017-11-12 13:58:47'),
(117, 229, 21, 7500, 7000, 'A', '2017-11-12 14:20:21'),
(118, 113, 21, 8500, 8000, 'A', '2017-11-16 18:23:28'),
(119, 234, 11, 3514, 3200, 'A', '2017-12-06 18:50:40'),
(120, 95, 11, 8000, 7500, 'A', '2017-11-23 15:30:49'),
(121, 231, 11, 3000, 2500, 'A', '2017-11-28 17:35:10'),
(122, 232, 11, 9000, 8500, 'A', '2017-11-28 18:18:15'),
(123, 31, 40, 4700, 4200, 'A', '2017-11-28 19:07:57'),
(124, 233, 5, 12500, 11500, 'A', '2017-11-29 14:54:29'),
(125, 35, 21, 11500, 11000, 'A', '2017-11-29 15:55:52'),
(126, 92, 5, 11500, 11000, 'A', '2017-11-29 19:16:51'),
(127, 99, 21, 11500, 11000, 'A', '2017-12-06 19:25:07'),
(128, 235, 17, 6500, 6000, 'A', '2017-12-06 19:35:40'),
(129, 172, 26, 18500, 17500, 'A', '2017-12-07 12:00:56'),
(130, 236, 41, 8500, 8000, 'A', '2017-12-07 17:18:50'),
(131, 237, 14, 8000, 7000, 'A', '2017-12-07 17:31:49'),
(132, 179, 29, 19000, 18500, 'A', '2017-12-09 18:24:04'),
(133, 238, 5, 12500, 11500, 'A', '2017-12-12 16:08:28'),
(134, 2, 22, 5000, 4500, 'A', '2017-12-12 17:38:36'),
(135, 15, 21, 13500, 12500, 'A', '2017-12-12 17:42:38'),
(136, 42, 5, 4800, 4300, 'A', '2017-12-14 17:52:00'),
(137, 155, 21, 10000, 9500, 'A', '2017-12-18 17:03:40'),
(138, 71, 11, 8000, 7500, 'A', '2017-12-23 17:44:21'),
(139, 156, 14, 8000, 7000, 'A', '2017-12-25 11:11:53'),
(140, 196, 11, 7000, 6500, 'A', '2017-12-25 11:55:59'),
(141, 26, 8, 7000, 6500, 'A', '2017-12-25 12:03:42'),
(142, 147, 21, 8000, 7000, 'A', '2017-12-27 14:42:23'),
(143, 19, 5, 5000, 4500, 'A', '2017-12-27 15:11:43'),
(144, 53, 5, 9000, 8500, 'A', '2017-12-28 12:41:25'),
(145, 3, 5, 6000, 5500, 'A', '2017-12-28 13:24:01'),
(146, 69, 5, 6800, 6300, 'A', '2018-01-24 13:41:03'),
(147, 138, 14, 18000, 17000, 'A', '2018-01-03 13:32:14'),
(148, 241, 14, 23000, 22000, 'A', '2018-01-03 13:40:30'),
(149, 245, 20, 8000, 7500, 'A', '2018-01-05 12:20:40'),
(150, 245, 5, 8000, 7500, 'A', '2018-01-05 12:52:34'),
(151, 243, 14, 35000, 28000, 'A', '2018-01-05 13:08:00'),
(152, 23, 13, 6000, 5500, 'A', '2018-01-05 13:19:37'),
(153, 244, 20, 9000, 8000, 'A', '2018-01-05 13:33:55'),
(154, 242, 8, 5000, 4500, 'A', '2018-01-05 16:38:15'),
(155, 158, 11, 1500, 1250, 'A', '2018-01-05 16:42:04'),
(156, 53, 14, 6000, 5500, 'A', '2018-01-08 16:43:53'),
(157, 3, 14, 7000, 6500, 'A', '2018-01-23 10:28:23'),
(158, 246, 1, 8500, 8000, 'A', '2018-01-24 11:45:18'),
(159, 46, 1, 17000, 16000, 'A', '2018-01-24 11:49:50'),
(160, 38, 1, 17000, 16000, 'A', '2018-01-24 11:50:43'),
(161, 69, 14, 7000, 6500, 'A', '2018-01-24 11:55:05'),
(162, 248, 11, 24500, 23000, 'A', '2018-02-02 16:20:50'),
(163, 247, 11, 19734, 21000, 'A', '2018-02-02 16:22:11'),
(164, 11, 14, 10000, 9000, 'A', '2018-02-02 16:25:22'),
(165, 31, 14, 5000, 4500, 'A', '2018-02-02 16:26:06'),
(166, 249, 11, 22500, 21000, 'A', '2018-02-02 18:45:13'),
(167, 250, 11, 24000, 23000, 'A', '2018-02-03 12:03:27'),
(168, 251, 11, 6946, 6000, 'A', '2018-02-03 12:15:25'),
(169, 252, 11, 38900, 37000, 'A', '2018-02-03 12:47:14'),
(170, 253, 11, 39800, 35000, 'A', '2018-02-03 13:43:36'),
(171, 254, 11, 15400, 14000, 'A', '2018-02-03 17:48:03'),
(172, 38, 13, 15500, 12500, 'A', '2018-02-12 15:22:07'),
(173, 255, 1, 17000, 16000, 'A', '2018-02-14 14:46:17'),
(174, 260, 26, 16000, 12000, 'A', '2018-02-14 15:48:25'),
(175, 198, 11, 22382, 21000, 'A', '2018-02-14 16:56:35'),
(176, 261, 11, 37400, 35000, 'A', '2018-02-14 16:59:12'),
(177, 120, 11, 6591, 6000, 'A', '2018-02-14 19:09:33'),
(178, 176, 11, 4861, 4500, 'A', '2018-02-14 19:10:07'),
(179, 259, 11, 6946, 6000, 'A', '2018-02-14 19:10:33'),
(180, 264, 12, 7500, 6500, 'A', '2018-02-20 13:41:53'),
(181, 262, 12, 7500, 6500, 'A', '2018-02-20 13:42:23'),
(182, 263, 12, 7500, 6500, 'A', '2018-02-20 13:42:43'),
(183, 226, 12, 7500, 6500, 'A', '2018-02-20 13:43:02'),
(184, 265, 1, 9000, 6500, 'A', '2018-02-20 13:45:09'),
(185, 175, 5, 6000, 5500, 'A', '2018-02-20 13:47:33'),
(186, 20, 5, 9000, 8000, 'A', '2018-02-20 13:48:36'),
(187, 44, 5, 6800, 6500, 'A', '2018-02-20 13:49:16'),
(188, 267, 2, 7500, 6500, 'A', '2018-02-20 13:55:55'),
(189, 36, 5, 7000, 6500, 'A', '2018-02-20 13:58:29'),
(190, 72, 12, 7500, 6500, 'A', '2018-02-20 14:00:01'),
(191, 257, 11, 4861, 4500, 'A', '2018-02-20 14:01:43'),
(192, 66, 2, 7000, 6500, 'A', '2018-03-01 13:19:55'),
(193, 268, 26, 16000, 10000, 'A', '2018-03-01 13:26:02'),
(194, 269, 42, 9000, 7000, 'A', '2018-03-01 13:30:51'),
(195, 80, 42, 9500, 8500, 'A', '2018-03-01 13:31:45'),
(196, 95, 42, 8500, 7500, 'A', '2018-03-01 13:46:10'),
(197, 242, 42, 5500, 5000, 'A', '2018-03-01 13:41:39'),
(198, 272, 42, 8500, 7500, 'A', '2018-03-01 13:55:14'),
(199, 270, 42, 6000, 5000, 'A', '2018-03-01 13:55:48'),
(200, 273, 11, 35000, 33500, 'A', '2018-03-01 14:04:06'),
(201, 46, 11, 12033, 11500, 'A', '2018-03-01 14:15:21'),
(202, 119, 11, 18771, 21000, 'A', '2018-03-01 14:15:42'),
(203, 274, 11, 26900, 24000, 'A', '2018-03-01 14:16:32'),
(204, 276, 11, 16900, 15000, 'A', '2018-03-01 14:17:03'),
(205, 275, 11, 27500, 24000, 'A', '2018-03-01 14:17:40'),
(206, 67, 42, 4800, 4000, 'A', '2018-03-05 12:03:31'),
(207, 2, 8, 6000, 5000, 'A', '2018-03-05 12:04:35'),
(208, 214, 7, 32000, 25000, 'A', '2018-03-05 13:07:34'),
(209, 277, 7, 32000, 25000, 'A', '2018-03-05 13:17:56'),
(210, 32, 33, 7500, 6500, 'A', '2018-03-05 19:05:28'),
(211, 44, 14, 7000, 6500, 'A', '2018-03-13 17:53:48'),
(212, 20, 2, 7700, 7200, 'A', '2018-03-13 17:56:33'),
(213, 170, 2, 7000, 6500, 'A', '2018-03-13 17:57:34'),
(214, 120, 2, 9400, 8500, 'A', '2018-03-13 17:58:06'),
(215, 54, 2, 9900, 9000, 'A', '2018-03-13 17:58:30'),
(216, 69, 2, 7700, 7000, 'A', '2018-03-13 17:59:53'),
(217, 32, 42, 7000, 6000, 'A', '2018-03-13 18:00:24'),
(218, 2, 42, 5500, 5000, 'A', '2018-03-13 18:00:57'),
(219, 278, 42, 6500, 6000, 'A', '2018-03-13 18:04:12'),
(220, 175, 42, 5500, 4500, 'A', '2018-03-13 18:04:32'),
(221, 24, 42, 12000, 11500, 'A', '2018-03-13 18:05:13'),
(222, 144, 42, 4800, 4000, 'A', '2018-03-13 18:05:38'),
(223, 3, 42, 6500, 5500, 'A', '2018-03-13 18:06:55'),
(225, 26, 33, 7000, 6000, 'A', '2018-03-13 18:11:48'),
(226, 282, 5, 8400, 8000, 'A', '2018-03-13 18:18:03'),
(227, 22, 13, 10000, 9000, 'A', '2018-03-13 18:19:29'),
(228, 26, 42, 7000, 6500, 'A', '2018-03-13 18:20:33'),
(229, 26, 2, 7000, 6500, 'A', '2018-03-13 18:21:13'),
(230, 280, 26, 16000, 12000, 'A', '2018-03-19 13:55:53'),
(231, 126, 21, 12500, 12000, 'A', '2018-03-19 13:57:44'),
(232, 281, 33, 18000, 15000, 'A', '2018-03-19 14:02:20'),
(233, 2, 5, 6000, 5000, 'A', '2018-03-19 14:03:05'),
(234, 285, 13, 6500, 6200, 'A', '2018-03-19 14:05:18'),
(235, 284, 13, 6700, 6200, 'A', '2018-03-19 14:05:48'),
(236, 286, 13, 6700, 6200, 'A', '2018-03-19 14:09:18'),
(237, 287, 5, 9500, 8500, 'A', '2018-03-19 14:14:14'),
(238, 279, 42, 6500, 5500, 'A', '2018-03-19 14:16:25'),
(239, 288, 14, 8000, 7000, 'A', '2018-03-19 14:20:31'),
(240, 290, 42, 7000, 6500, 'A', '2018-03-19 14:25:22'),
(241, 289, 12, 7500, 6000, 'A', '2018-03-19 14:26:01'),
(242, 291, 42, 5500, 4500, 'A', '2018-03-19 14:32:32'),
(243, 256, 11, 5899, 5500, 'A', '2018-03-19 14:34:12'),
(244, 22, 11, 7701, 7200, 'A', '2018-03-21 18:33:59'),
(245, 292, 11, 20400, 18000, 'A', '2018-03-21 18:49:21'),
(246, 293, 5, 9000, 6500, 'A', '2018-03-23 18:04:19'),
(247, 179, 21, 18000, 16000, 'A', '2018-03-23 18:05:13'),
(248, 294, 5, 5500, 5000, 'A', '2018-03-23 18:07:04'),
(249, 63, 1, 8000, 6500, 'A', '2018-03-23 18:10:29'),
(250, 283, 1, 8000, 7000, 'A', '2018-03-23 18:12:26'),
(251, 295, 42, 12000, 11000, 'A', '2018-03-23 18:13:07'),
(252, 296, 42, 12000, 11000, 'A', '2018-03-23 18:13:49'),
(253, 302, 1, 8000, 7000, 'A', '2018-03-23 18:22:38'),
(254, 297, 42, 7000, 6500, 'A', '2018-03-23 18:25:13'),
(255, 298, 42, 7000, 6500, 'A', '2018-03-23 18:26:58'),
(256, 299, 11, 8490, 7000, 'A', '2018-03-23 18:28:59'),
(257, 301, 12, 12000, 9000, 'A', '2018-03-23 18:30:07'),
(258, 300, 11, 4861, 4500, 'A', '2018-03-23 18:31:41'),
(259, 304, 2, 8200, 7500, 'A', '2018-03-23 18:46:30'),
(262, 305, 33, 5500, 4800, 'A', '2018-04-06 12:59:25'),
(263, 256, 33, 6500, 5500, 'A', '2018-04-06 12:59:54'),
(264, 306, 2, 8200, 8000, 'A', '2018-04-06 13:02:20'),
(265, 307, 26, 16000, 14000, 'A', '2018-04-06 13:03:57'),
(266, 308, 11, 8492, 7000, 'A', '2018-04-06 13:07:28'),
(267, 303, 11, 5887, 5000, 'A', '2018-04-06 13:08:50'),
(268, 309, 11, 5887, 5000, 'A', '2018-04-06 13:12:04'),
(269, 69, 11, 5347, 5000, 'A', '2018-04-06 13:12:55'),
(270, 313, 11, 5887, 5000, 'A', '2018-04-06 13:18:52'),
(271, 164, 11, 6833, 5000, 'A', '2018-04-06 13:18:40'),
(272, 310, 11, 6871, 5000, 'A', '2018-04-06 13:19:39'),
(273, 311, 11, 6871, 5000, 'A', '2018-04-06 13:19:59'),
(274, 312, 11, 8014, 6500, 'A', '2018-04-06 13:22:26'),
(275, 314, 11, 6871, 5000, 'A', '2018-04-06 13:22:16'),
(276, 315, 42, 7000, 6500, 'A', '2018-04-06 13:26:54'),
(277, 316, 42, 6500, 5500, 'A', '2018-04-06 13:27:32'),
(278, 303, 42, 5500, 5000, 'A', '2018-04-06 13:28:01'),
(279, 317, 42, 6000, 5000, 'A', '2018-04-06 13:29:49'),
(280, 175, 33, 5500, 4500, 'A', '2018-04-09 10:06:38'),
(281, 92, 17, 12500, 11000, 'A', '2018-04-12 10:30:22'),
(282, 319, 42, 7000, 6000, 'A', '2018-04-12 10:30:47'),
(283, 320, 42, 7000, 6500, 'A', '2018-04-12 10:31:59'),
(284, 321, 11, 8014, 6500, 'A', '2018-04-12 10:33:02'),
(285, 94, 11, 4294, 3500, 'A', '2018-04-12 12:29:10'),
(286, 179, 5, 12500, 11000, 'A', '2018-04-17 16:53:22');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_type` varchar(20) NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_type`, `status_id`) VALUES
(1, 'Admin', 1),
(2, 'Employee', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transport_details`
--

CREATE TABLE `transport_details` (
  `Transport_dtl_id` int(11) NOT NULL,
  `Transport_dtl_name` text NOT NULL,
  `Transport_dtl_phone_no` varchar(20) NOT NULL,
  `Transport_dtl_address` text NOT NULL,
  `Transport_dtl_created_dt_time` datetime NOT NULL,
  `Transport_dtl_status` enum('A','D') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(18, 'AYYAPPA TRANSPORT', '7448527670', 'NO DETAIL NUMBER HAS BEEN ERROR', '2017-09-11 14:28:55', 'A'),
(19, 'ARYA TPT', '9380714807', 'VICTOR  MADHAVARAM', '2017-04-18 13:28:08', 'A'),
(20, 'STAR TRANSPORT', '9940416060', 'ARJUN STAR TRANSPORT RAJAKADAI CHENNAI 19', '2018-02-02 16:28:47', 'A'),
(21, 'OM SAKTHI TRANSPORT', '7448527670', 'CHENNAI', '2017-04-10 15:28:42', 'A'),
(22, 'SEETHAMMAL TRANSPORT', '9840677334', 'TONDIARPET, CHENNAI', '2017-04-21 19:16:01', 'A'),
(23, 'KUMAR TRANSPORT', '7448527670', 'CHENNAI', '2017-04-28 18:08:16', 'A'),
(24, 'OM SAKTHI TRANSPORT (SEKAR)', '7448527670', 'CHENNAI', '2017-04-28 18:08:53', 'A'),
(25, 'DILLI TRANSPORT', '7448527670', 'CHENNAI', '2017-05-01 12:29:52', 'A'),
(26, 'VVV TRANSPORT', '7448527670', 'CHENNAI', '2017-05-01 13:14:15', 'A'),
(27, 'KALYANI TRANSPORT', '8098456515', 'CHENNAI', '2017-05-17 14:00:52', 'A'),
(28, 'RAMKUMAR TPT', '9840602093', 'CHENNAI', '2017-05-23 11:00:58', 'A'),
(29, 'BALAJI TRANSPORT', '9282468216', 'CHENNAI THANDAYARPET', '2017-06-10 10:37:42', 'A'),
(30, 'SRI SENTHIL MURUGAN TPT', '9789848976', 'KRISHNA KOIL STREET , CHENNAI-600001', '2017-06-20 12:06:49', 'A'),
(31, 'GOPALAMT TRANSPORT', '7448527670', 'CHENNAI', '2017-07-21 13:21:40', 'A'),
(32, 'MANI TRANPORT', '7448527670', 'CHENNAI', '2017-07-21 13:22:45', 'A'),
(33, 'SENTHILMURUGAN TRANSPORT', '9941119832', 'CHENNAI', '2017-09-11 14:27:30', 'A'),
(34, 'KANNAN TRANSPORT', '9860238598', 'CHENNAI', '2017-10-06 16:15:13', 'A'),
(35, 'MANJU TRANS', '9941198851', 'SUBBARAYAN MAIN STREET , NAMMALWARPET , CHENNAI -600012', '2018-01-03 16:41:33', 'A'),
(36, 'RANI TRANSPORT', '9566168696', 'VILLAGE STREET , THIRUVOTTIYUR , CHENNAI -19', '2018-01-22 12:09:58', 'A'),
(37, 'HARI(OTHERS)', '8056269366', 'THIRUVOTTIYUR', '2018-01-26 16:04:55', 'A'),
(38, 'SK AGENCY', '8056269366', 'NO.25,RAJAKADDAI,THIRUVOTTRIYUR', '2018-03-08 15:48:11', 'A'),
(39, 'SRI KRISHNA TRANS', '9790418953', 'NO.14,EZHIL NAGAR,MANALI NEW TOWN,CHENNAI.', '2018-03-08 17:16:44', 'A'),
(40, 'AKSHITHAA TRANSPORT', '9790764119', 'NO-14/29,Avoor Muthaiah Maistry Street, New Washermen Pet,Chennai.', '2018-03-21 17:59:35', 'A'),
(41, 'PBS TRANSPORT', '9500063527', 'NO', '2018-03-21 18:02:11', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `transport_payment`
--

CREATE TABLE `transport_payment` (
  `Transport_payment_id` int(11) NOT NULL,
  `Transport_payment_trans_name` int(11) NOT NULL COMMENT 'Transport name refer id transport details',
  `Transport_payment_amount` int(11) NOT NULL,
  `Transport_payment_date` date NOT NULL,
  `Transport_payment_paid_status` enum('U','P') NOT NULL COMMENT 'U=Unpaid,P=Paid',
  `Transport_payment_remark` text NOT NULL,
  `Transport_payment_creatred_dt_tme` datetime NOT NULL,
  `Transport_payment_status` enum('A','D') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_details`
--

CREATE TABLE `vehicle_details` (
  `Vehicle_dtl_id` int(11) NOT NULL,
  `Vehicle_dtl_number` varchar(60) NOT NULL,
  `Vehicle_dtl_make` varchar(60) NOT NULL,
  `Vehicle_dtl_permit` varchar(60) NOT NULL,
  `Vehicle_dtl_transport` enum('T','O') NOT NULL,
  `Vehicle_dtl_transport_name` int(11) NOT NULL COMMENT 'transport details table reference id',
  `Vehicle_dtl_created_dt_time` datetime NOT NULL,
  `Vehicle_dtl_status` enum('A','D') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(55, 'TN22AH2133', '', '', 'O', 5, '2017-10-06 16:23:23', 'A'),
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
(68, 'TN04AP1284', '', '', 'O', 26, '2017-05-01 13:14:39', 'A'),
(69, 'TN34 L8740', '', '', 'O', 27, '2017-05-17 14:02:03', 'A'),
(71, 'TN51 D0670', '', '', 'O', 23, '2017-05-23 11:07:15', 'A'),
(72, 'TN21 L7318', '', '', 'O', 23, '2017-05-23 11:07:41', 'A'),
(73, 'TN04 U5313', '', '', 'O', 23, '2017-05-23 11:08:08', 'A'),
(74, 'TN03 R1784', '', '', 'O', 23, '2017-05-23 11:08:48', 'A'),
(75, 'TN04AA4316', '', '', 'O', 23, '2017-05-23 11:09:08', 'A'),
(76, 'TN02 X5196', '', '', 'O', 27, '2017-06-10 10:35:50', 'A'),
(77, 'TN20 AW7754', '', '', 'O', 29, '2017-06-10 10:38:07', 'A'),
(78, 'TN21 K0605', '', '', 'O', 32, '2017-07-21 13:23:07', 'A'),
(79, 'TN28AH8794', '', '', 'O', 11, '2017-06-17 11:15:40', 'A'),
(80, 'TN04AH2416', 'TATA 2516', 'TN PARMEET', 'T', 0, '2018-03-19 13:54:24', 'A'),
(81, 'TN23AD5326', '', '', 'O', 5, '2017-06-17 12:11:22', 'A'),
(82, 'TN28AM4122', '', '', 'O', 25, '2017-07-18 14:27:53', 'A'),
(83, 'TN20BS5576', '', '', 'O', 25, '2017-07-18 14:50:35', 'A'),
(84, 'TN41AA1839', '', '', 'O', 5, '2017-07-18 15:07:57', 'A'),
(85, 'TN09AJ7831', '', '', 'O', 25, '2017-07-18 16:35:52', 'A'),
(86, 'TN51A 5496', '', '', 'O', 31, '2017-07-21 13:23:36', 'A'),
(87, 'TN05 Y2966', '', '', 'O', 5, '2017-07-28 14:48:23', 'A'),
(88, 'TN04AC0407', 'ASHOK LEYLAND', 'NP', 'T', 0, '2017-08-22 11:33:48', 'A'),
(89, 'AP16TV3223', '', '', 'O', 27, '2017-08-22 19:32:19', 'A'),
(90, 'TN04 K4713', '', '', 'O', 18, '2017-09-11 14:29:30', 'A'),
(91, 'TN28AF9759', '', '', 'O', 33, '2017-09-11 14:29:49', 'A'),
(92, 'TN28AH2287', '', '', 'O', 33, '2017-09-11 14:30:05', 'A'),
(93, 'TN04S 6301', '', '', 'O', 34, '2017-10-06 16:16:15', 'A'),
(94, 'TN28AC7583', '', '', 'O', 34, '2017-10-06 16:16:52', 'A'),
(95, 'TN29C 9338', '', '', 'O', 25, '2017-11-23 15:44:27', 'A'),
(96, 'TN04AH4073', 'ASHOKLEYLAND', 'NP', 'T', 0, '2018-01-22 11:30:51', 'A'),
(97, 'TN20BP5007', '', '', 'O', 5, '2017-11-27 13:54:20', 'A'),
(98, 'TN73AB7029', '', '', 'O', 5, '2017-12-08 13:59:45', 'A'),
(99, 'TN32AF5331', '', '', 'O', 35, '2018-01-03 16:42:36', 'A'),
(100, 'TN05AQ1419', '', '', 'O', 35, '2018-01-03 16:43:10', 'A'),
(101, 'TN27H5688', '', '', 'O', 18, '2018-01-22 11:32:15', 'A'),
(102, 'TN88D0423', '', '', 'O', 36, '2018-01-22 12:10:35', 'A'),
(103, 'TN04 AF 9211', '', '', 'O', 27, '2018-01-22 17:06:27', 'A'),
(104, 'TN28AK4973', '', '', 'O', 36, '2018-01-22 17:37:10', 'A'),
(105, 'TN04AT3485', '', '', 'O', 37, '2018-01-26 16:58:07', 'A'),
(106, 'TN04AS0211', '', '', 'O', 37, '2018-01-26 16:59:42', 'A'),
(107, 'TN04AS0150', '', '', 'O', 37, '2018-01-27 10:56:50', 'A'),
(108, 'TN88C4051', '', '', 'O', 37, '2018-01-27 10:58:35', 'A'),
(109, 'TN04AE6890', '', '', 'O', 7, '2018-01-27 13:16:30', 'A'),
(110, 'TN04AT3528', '', '', 'O', 37, '2018-01-27 13:30:28', 'A'),
(111, 'TN03C4699', '', '', 'O', 20, '2018-02-06 12:30:48', 'A'),
(112, 'TN28AC2583', '', '', 'O', 34, '2018-02-09 16:40:04', 'A'),
(113, 'TN28AF4113', '', '', 'O', 34, '2018-02-09 16:40:24', 'A'),
(114, 'TN03R1784', '', '', 'O', 40, '2018-03-21 18:00:31', 'A'),
(115, 'TN04Q7332', '', '', 'O', 40, '2018-03-21 18:01:11', 'A'),
(116, 'TN04U5313', '', '', 'O', 40, '2018-03-21 18:01:34', 'A'),
(117, 'TN04J2520', '', '', 'O', 41, '2018-03-21 18:02:38', 'A'),
(118, 'TN20AP5937', '', '', 'O', 41, '2018-03-21 18:02:59', 'A'),
(119, 'TN04AA5526', '', '', 'O', 9, '2018-04-02 11:50:35', 'A'),
(120, 'TN04AK5735', '', '', 'O', 9, '2018-04-04 16:12:36', 'A'),
(121, 'TN04AK3012', '', '', 'O', 9, '2018-04-04 16:13:19', 'A'),
(122, 'TN20CP1456', '2018', 'TN PARMEET', 'T', 0, '2018-04-06 12:36:57', 'A'),
(123, 'TN20CP2266', '2018', 'TN PARMEET', 'T', 0, '2018-04-06 12:37:13', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_document_details`
--

CREATE TABLE `vehicle_document_details` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(11, 14, '2013-01-28', '2018-01-27', '2016-01-28', '2017-01-27', '1970-01-01', '1970-01-01', '2015-11-30', '2016-11-29', '2016-09-01', '2016-09-30', '2016-07-01', '2016-09-30', '2016-09-01', '2016-09-30', '2018-02-14 19:25:53', 'A'),
(12, 120, '2019-09-17', '2019-09-19', '1970-01-01', '1970-01-01', '1970-01-01', '1970-01-01', '2019-09-17', '2019-09-19', '2019-09-16', '2019-09-27', '2019-09-11', '2019-09-12', '2019-09-16', '2019-09-20', '2019-09-22 11:25:53', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_due_details`
--

CREATE TABLE `vehicle_due_details` (
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

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_maintenance`
--

CREATE TABLE `vehicle_maintenance` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `spare_part` varchar(250) NOT NULL,
  `amount` int(11) NOT NULL,
  `date` date NOT NULL,
  `notes` text NOT NULL,
  `status_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_permission`
--
ALTER TABLE `access_permission`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `common_status`
--
ALTER TABLE `common_status`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `modules_permissions`
--
ALTER TABLE `modules_permissions`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `vehicle_maintenance`
--
ALTER TABLE `vehicle_maintenance`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_permission`
--
ALTER TABLE `access_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_user_rights_details`
--
ALTER TABLE `admin_user_rights_details`
  MODIFY `User_rights_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `common_status`
--
ALTER TABLE `common_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `container_details`
--
ALTER TABLE `container_details`
  MODIFY `Container_dtl_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `daily_moment_details`
--
ALTER TABLE `daily_moment_details`
  MODIFY `Daily_mvnt_dtl_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `driver_details`
--
ALTER TABLE `driver_details`
  MODIFY `Driver_dtl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `driver_payment_details`
--
ALTER TABLE `driver_payment_details`
  MODIFY `Driver_pymnt_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `driver_pay_rate`
--
ALTER TABLE `driver_pay_rate`
  MODIFY `Driver_pay_rate_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `iso_movement_details`
--
ALTER TABLE `iso_movement_details`
  MODIFY `Iso_mvnt_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `modules_permissions`
--
ALTER TABLE `modules_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `party_billing`
--
ALTER TABLE `party_billing`
  MODIFY `Party_billing_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `party_details`
--
ALTER TABLE `party_details`
  MODIFY `Party_dtl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `party_payment`
--
ALTER TABLE `party_payment`
  MODIFY `Party_payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `party_pay_rate`
--
ALTER TABLE `party_pay_rate`
  MODIFY `party_pay_rate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=287;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transport_details`
--
ALTER TABLE `transport_details`
  MODIFY `Transport_dtl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `transport_payment`
--
ALTER TABLE `transport_payment`
  MODIFY `Transport_payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicle_details`
--
ALTER TABLE `vehicle_details`
  MODIFY `Vehicle_dtl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `vehicle_document_details`
--
ALTER TABLE `vehicle_document_details`
  MODIFY `Vehicle_doc_dtl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `vehicle_due_details`
--
ALTER TABLE `vehicle_due_details`
  MODIFY `Vehicle_due_dtl_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicle_maintenance`
--
ALTER TABLE `vehicle_maintenance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
