-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2023 at 05:18 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pgas_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `ch_gen_tbl_mst_factory`
--

CREATE TABLE `ch_gen_tbl_mst_factory` (
  `factory_id` bigint(20) NOT NULL,
  `factory_name` varchar(150) NOT NULL,
  `factory_abbr` varchar(50) DEFAULT NULL,
  `factory_location` varchar(100) DEFAULT NULL,
  `factory_address` text DEFAULT NULL,
  `factory_phone` varchar(100) DEFAULT NULL,
  `factory_fax` varchar(100) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `ch_gen_tbl_mst_factory`
--

INSERT INTO `ch_gen_tbl_mst_factory` (`factory_id`, `factory_name`, `factory_abbr`, `factory_location`, `factory_address`, `factory_phone`, `factory_fax`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 'PT Pulau Sambu', 'PSG', 'Sungai Guntung', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'PT Pulau Sambu Kuala Enok', 'PSKE', 'Kuala Enok', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'PT Riau Sakti United Plantations', 'RSUP', 'Pulau Burung', 'Pulau Burung', '', '', NULL, NULL, 'HARRY', '2016-03-17 10:55:24'),
(4, 'PT. Pulau Sambu Jakarta', 'PSJ', 'Jakarta', 'Jakarta', '', '', 'HARRY', '2016-11-15 16:51:45', NULL, NULL),
(5, 'Singpore', 'SIN', 'Singapore', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'PT Sumatra TimurIndonesia', 'STI', 'Sungai Guntung', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ch_gen_tbl_user`
--

CREATE TABLE `ch_gen_tbl_user` (
  `userid` varchar(50) NOT NULL,
  `userpassword` varchar(50) DEFAULT NULL,
  `groupid` varchar(50) DEFAULT NULL,
  `position_id` int(11) NOT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(25) DEFAULT NULL,
  `mobilenumber` varchar(25) DEFAULT NULL,
  `photo` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `approval` bit(1) DEFAULT b'0',
  `notactive` bit(1) DEFAULT b'0',
  `telegramid` varchar(20) DEFAULT NULL,
  `otp` varchar(20) DEFAULT NULL,
  `count_otp_req` int(11) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp() COMMENT 'now()',
  `updated_by` varchar(50) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `factory_id` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ch_gen_tbl_user`
--

INSERT INTO `ch_gen_tbl_user` (`userid`, `userpassword`, `groupid`, `position_id`, `jabatan`, `firstname`, `lastname`, `mobilenumber`, `photo`, `email`, `approval`, `notactive`, `telegramid`, `otp`, `count_otp_req`, `created_by`, `created_date`, `updated_by`, `updated_date`, `factory_id`) VALUES
('aziz', '6116afedcb0bc31083935c1c262ff4c9', '1', 1, NULL, 'abdul azis', 'azis', NULL, NULL, NULL, b'1', b'0', NULL, NULL, NULL, NULL, '2023-05-21 19:32:38', NULL, NULL, NULL),
('admin', '6116afedcb0bc31083935c1c262ff4c9', '1', 0, NULL, 'adminstrator', NULL, NULL, NULL, NULL, b'1', b'0', NULL, NULL, NULL, NULL, '2023-05-28 00:45:15', NULL, NULL, NULL),
('user', '6116afedcb0bc31083935c1c262ff4c9', '2', 0, NULL, 'user', NULL, NULL, NULL, NULL, b'0', b'0', NULL, NULL, NULL, NULL, '2023-06-01 10:04:53', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ch_gen_tbl_utl_factory_access`
--

CREATE TABLE `ch_gen_tbl_utl_factory_access` (
  `user_group_id` bigint(20) DEFAULT NULL,
  `factory_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `ch_gen_tbl_utl_factory_access`
--

INSERT INTO `ch_gen_tbl_utl_factory_access` (`user_group_id`, `factory_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ch_gen_tbl_utl_menu_access`
--

CREATE TABLE `ch_gen_tbl_utl_menu_access` (
  `user_group_id` bigint(20) NOT NULL,
  `menu_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ch_gen_tbl_utl_menu_access`
--

INSERT INTO `ch_gen_tbl_utl_menu_access` (`user_group_id`, `menu_id`) VALUES
(1, 1000),
(1, 1100),
(1, 1200),
(1, 1300),
(1, 1400),
(1, 3000),
(1, 3100),
(1, 7000),
(2, 1000),
(2, 1100),
(2, 1200),
(2, 1300),
(2, 1400),
(2, 7000);

-- --------------------------------------------------------

--
-- Table structure for table `ch_gen_tbl_utl_menu_dtl`
--

CREATE TABLE `ch_gen_tbl_utl_menu_dtl` (
  `menudtl_id` bigint(20) NOT NULL,
  `menudtl_title` varchar(100) NOT NULL,
  `menudtl_link` varchar(150) DEFAULT NULL,
  `menudtl_icon` varchar(50) DEFAULT NULL,
  `column_group` bigint(20) DEFAULT NULL,
  `menuhdr_id` bigint(20) NOT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ch_gen_tbl_utl_menu_dtl`
--

INSERT INTO `ch_gen_tbl_utl_menu_dtl` (`menudtl_id`, `menudtl_title`, `menudtl_link`, `menudtl_icon`, `column_group`, `menuhdr_id`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1100, 'Employee', 'C_Employee', 'fa-align-left', NULL, 1000, 'aziz', '2023-05-31 18:22:32', NULL, NULL),
(1200, 'Department', 'C_Department', 'fa-align-left', NULL, 1000, 'aziz', '2023-05-31 18:22:57', NULL, NULL),
(1300, 'Spending', 'C_Spending', 'fa-align-left', NULL, 1000, 'aziz', '2023-05-31 18:23:39', NULL, NULL),
(1400, 'Report', 'C_Employee/Report', 'fa-align-left', NULL, 1000, 'aziz', '2023-06-01 01:31:19', NULL, NULL),
(3100, 'Users', 'C_Mst_User', 'fa-align-left', NULL, 3000, 'aziz', '2023-05-31 18:31:41', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ch_gen_tbl_utl_menu_dtlsub`
--

CREATE TABLE `ch_gen_tbl_utl_menu_dtlsub` (
  `menudtlsub_id` bigint(20) NOT NULL,
  `menudtlsub_title` varchar(100) NOT NULL,
  `menudtlsub_link` varchar(255) NOT NULL,
  `menudtlsub_icon` varchar(100) NOT NULL DEFAULT 'fa-angle-right',
  `menudtl_id` bigint(20) NOT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ch_gen_tbl_utl_menu_hdr`
--

CREATE TABLE `ch_gen_tbl_utl_menu_hdr` (
  `menuhdr_id` bigint(20) NOT NULL,
  `menuhdr_title` varchar(100) NOT NULL,
  `menu_style` varchar(50) DEFAULT NULL,
  `app_id` bigint(20) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ch_gen_tbl_utl_menu_hdr`
--

INSERT INTO `ch_gen_tbl_utl_menu_hdr` (`menuhdr_id`, `menuhdr_title`, `menu_style`, `app_id`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1000, 'Main Menu', NULL, NULL, 'aziz', '2023-05-31 18:20:07', NULL, NULL),
(2000, 'Report', NULL, NULL, 'aziz', '2023-05-31 18:20:18', NULL, NULL),
(3000, 'Utility', NULL, NULL, 'aziz', '2023-05-31 18:29:05', NULL, NULL),
(7000, 'Other Menu', NULL, NULL, 'aziz', '2023-05-31 18:20:31', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ch_gen_tbl_utl_user_group`
--

CREATE TABLE `ch_gen_tbl_utl_user_group` (
  `user_group_id` bigint(20) NOT NULL,
  `user_group_name` varchar(100) NOT NULL,
  `user_group_remark` varchar(255) DEFAULT NULL,
  `not_active` smallint(6) DEFAULT 0,
  `created_by` varchar(50) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ch_gen_tbl_utl_user_group`
--

INSERT INTO `ch_gen_tbl_utl_user_group` (`user_group_id`, `user_group_name`, `user_group_remark`, `not_active`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 'Adminstrator', '', 0, 'aziz', '2023-05-21 10:49:10', NULL, NULL),
(2, 'User', '', 0, 'aziz', '2023-05-31 18:17:11', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ch_logs`
--

CREATE TABLE `ch_logs` (
  `log_id` bigint(20) NOT NULL,
  `level` varchar(10) DEFAULT NULL,
  `class_name` varchar(200) DEFAULT NULL,
  `method_name` varchar(100) DEFAULT NULL,
  `message` varchar(100) DEFAULT NULL,
  `new_value` text DEFAULT NULL,
  `old_value` text DEFAULT NULL,
  `exception` text DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `log_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`ID`, `Name`) VALUES
(1, 'Information Technology'),
(2, 'Human Capital'),
(3, 'Finance');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `DepartmentID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`ID`, `Name`, `DepartmentID`) VALUES
(1, 'Budi', 1),
(2, 'Iwan', 2),
(3, 'Susi', 3),
(4, 'Amir', 1),
(5, 'Primus', 1),
(6, 'Tuti', 2),
(7, 'Sinta', 2),
(8, 'Santi', 3),
(9, 'Badu', 3),
(10, 'Marfuah', 3);

-- --------------------------------------------------------

--
-- Table structure for table `gen_tbl_mst_factory`
--

CREATE TABLE `gen_tbl_mst_factory` (
  `factory_id` bigint(20) NOT NULL,
  `factory_name` varchar(150) NOT NULL,
  `factory_abbr` varchar(50) DEFAULT NULL,
  `factory_location` varchar(100) DEFAULT NULL,
  `factory_address` text DEFAULT NULL,
  `factory_phone` varchar(100) DEFAULT NULL,
  `factory_fax` varchar(100) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gen_tbl_mst_position`
--

CREATE TABLE `gen_tbl_mst_position` (
  `position_id` bigint(20) NOT NULL,
  `position_name` varchar(50) DEFAULT NULL,
  `position_remark` varchar(255) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `gen_tbl_mst_position`
--

INSERT INTO `gen_tbl_mst_position` (`position_id`, `position_name`, `position_remark`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 'Programmer', 'Software developer for PSS application website', 'HARRY', '2016-03-02 09:35:51', NULL, NULL),
(2, 'Administrator', 'Administrator for PSS application website', 'HARRY', '2016-03-02 09:35:51', NULL, NULL),
(3, 'Sales Person', 'PSS Marketing Sales Person', 'HARRY', '2016-03-02 09:35:51', NULL, NULL),
(4, 'Purchaser', 'PSS Purchaser', 'HARRY', '2016-03-02 09:35:51', NULL, NULL),
(5, 'Accounting', 'PSS Accounting', 'HARRY', '2016-03-02 09:35:51', NULL, NULL),
(6, 'Shipping', 'PSS Shipping', 'DEKI', '2016-03-04 14:28:56', NULL, NULL),
(7, 'Sales Marketing', 'PSS Sales Marketing', 'HARRY', '2016-06-18 13:49:31', NULL, NULL),
(8, 'Shipment Liaison', 'Factory Shipment', 'HARRY', '2017-01-04 15:19:53', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `setting_web`
--

CREATE TABLE `setting_web` (
  `jadwal_daftar_ulang` date DEFAULT NULL,
  `nama_ketua_panitia` varchar(100) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `spending`
--

CREATE TABLE `spending` (
  `EmployeeID` int(11) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Value` int(11) DEFAULT NULL,
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Dumping data for table `spending`
--

INSERT INTO `spending` (`EmployeeID`, `Date`, `Value`, `ID`) VALUES
(1, '2020-03-04', 3000000, 1),
(4, '2020-04-06', 9826000, 2),
(5, '2020-04-06', 43879200, 3),
(4, '2020-09-08', 8983400, 4),
(6, '2020-12-06', 2425600, 5),
(7, '2021-04-02', 879200, 6),
(2, '2021-04-02', 68892340, 7),
(3, '2021-05-01', 3500000, 8),
(3, '2021-07-03', 567800, 9),
(4, '2021-07-03', 6786730, 10),
(8, '2021-08-02', 7893400, 11),
(3, '2021-10-03', 8200450, 12),
(1, '2021-12-23', 8982300, 13),
(2, '2022-02-03', 334890, 14),
(5, '2022-04-06', 2342460, 15),
(2, '2022-04-11', 78923400, 16),
(6, '2022-11-05', 23244600, 17),
(3, '2022-11-05', 32324900, 18),
(6, '2022-01-03', 5500100, 19),
(5, '2022-03-27', 2342350, 20),
(5, '2022-04-02', 2423400, 21),
(1, '2023-06-01', 120000, 24);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ch_gen_tbl_mst_factory`
--
ALTER TABLE `ch_gen_tbl_mst_factory`
  ADD PRIMARY KEY (`factory_id`) USING BTREE;

--
-- Indexes for table `ch_gen_tbl_utl_menu_dtl`
--
ALTER TABLE `ch_gen_tbl_utl_menu_dtl`
  ADD PRIMARY KEY (`menudtl_id`);

--
-- Indexes for table `ch_gen_tbl_utl_menu_dtlsub`
--
ALTER TABLE `ch_gen_tbl_utl_menu_dtlsub`
  ADD PRIMARY KEY (`menudtlsub_id`);

--
-- Indexes for table `ch_gen_tbl_utl_menu_hdr`
--
ALTER TABLE `ch_gen_tbl_utl_menu_hdr`
  ADD PRIMARY KEY (`menuhdr_id`);

--
-- Indexes for table `ch_gen_tbl_utl_user_group`
--
ALTER TABLE `ch_gen_tbl_utl_user_group`
  ADD PRIMARY KEY (`user_group_id`);

--
-- Indexes for table `ch_logs`
--
ALTER TABLE `ch_logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `gen_tbl_mst_factory`
--
ALTER TABLE `gen_tbl_mst_factory`
  ADD PRIMARY KEY (`factory_id`);

--
-- Indexes for table `gen_tbl_mst_position`
--
ALTER TABLE `gen_tbl_mst_position`
  ADD PRIMARY KEY (`position_id`) USING BTREE;

--
-- Indexes for table `setting_web`
--
ALTER TABLE `setting_web`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `spending`
--
ALTER TABLE `spending`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ch_gen_tbl_mst_factory`
--
ALTER TABLE `ch_gen_tbl_mst_factory`
  MODIFY `factory_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ch_gen_tbl_utl_user_group`
--
ALTER TABLE `ch_gen_tbl_utl_user_group`
  MODIFY `user_group_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `gen_tbl_mst_factory`
--
ALTER TABLE `gen_tbl_mst_factory`
  MODIFY `factory_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gen_tbl_mst_position`
--
ALTER TABLE `gen_tbl_mst_position`
  MODIFY `position_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `setting_web`
--
ALTER TABLE `setting_web`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `spending`
--
ALTER TABLE `spending`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
