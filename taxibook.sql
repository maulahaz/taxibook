-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2020 at 04:44 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `taxibook`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking`
--

CREATE TABLE `tbl_booking` (
  `uid` int(11) NOT NULL,
  `Booker` varchar(20) NOT NULL,
  `Destination_id` int(11) NOT NULL,
  `Origin` varchar(100) NOT NULL,
  `Destination` varchar(100) NOT NULL,
  `Taxi_id` int(11) NOT NULL,
  `Passenger` int(11) NOT NULL,
  `Pickup_dt` int(11) NOT NULL,
  `Pickup_tm` int(11) NOT NULL,
  `Note` varchar(255) NOT NULL,
  `Created_dtm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_booking`
--

INSERT INTO `tbl_booking` (`uid`, `Booker`, `Destination_id`, `Origin`, `Destination`, `Taxi_id`, `Passenger`, `Pickup_dt`, `Pickup_tm`, `Note`, `Created_dtm`) VALUES
(1, 'hasmukh', 1, 'Ruwais', 'Abu Dhabi Airport', 2, 2, 1585384448, 1585382400, 'Pick at Bld.148', '2020-03-29 12:13:59'),
(2, 'admin', 3, 'Ruwais', 'Duabi Airport', 4, 1, 1585382400, 1585384448, 'Pick at Bld.56', '2020-03-29 12:14:03'),
(6, 'admin', 1, 'Ruwais', 'Dubai', 4, 3, 1585605600, 1585430700, '', '2020-03-28 18:21:39'),
(7, 'admin', 1, 'Ruwais', 'Sharjah', 4, 3, 1585778400, 1585407600, '', '2020-03-28 18:26:27'),
(8, 'admin', 1, 'Ruwais', 'Dubai', 2, 3, 1583449200, 1585508700, 'test', '2020-03-29 19:33:34'),
(9, 'admin', 1, 'Ruwais', 'Abu Dhabi Airport', 1, 7, 1593727200, 1585508700, 'Vacation', '2020-03-29 19:34:20'),
(10, 'hasmukh', 1, 'Dubai Airport', '4', 2, 2, 1585605600, 1585454400, 'Pick me in Terminal 4', '2020-03-29 20:02:49'),
(11, 'antil', 1, 'Ruwais', '1', 3, 2, 1585951200, 1585530000, 'Pick me at Bld.141', '2020-03-30 11:33:52'),
(12, 'hasmukh', 1, 'Ruwais', 'Dubai Airport', 2, 2, 1588975200, 1586318400, 'Pick me up at Bld.66', '2020-04-08 19:26:32');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_destination`
--

CREATE TABLE `tbl_destination` (
  `uid` int(11) NOT NULL,
  `Origin` varchar(100) NOT NULL,
  `Destination` varchar(100) NOT NULL,
  `Orig_desti` varchar(100) NOT NULL,
  `Updated_dtm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_destination`
--

INSERT INTO `tbl_destination` (`uid`, `Origin`, `Destination`, `Orig_desti`, `Updated_dtm`) VALUES
(1, 'Ruwais', 'Abu Dhabi Airport', 'Ruwais - Abu Dhabi Airport', '2020-03-28 12:16:03'),
(2, 'Ruwais', 'Dubai Airport', 'Ruwais - Dubai Airport', '2020-03-28 12:16:03'),
(3, 'Abu Dhabi Airport', 'Ruwais', 'Abu Dhabi Airport - Ruwais', '2020-03-28 13:39:07'),
(4, 'Dubai', 'Ruwais', 'Ruwais - Dubai Airport', '2020-03-28 13:39:07');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_member`
--

CREATE TABLE `tbl_member` (
  `uid` int(11) NOT NULL,
  `Usr_id` varchar(20) NOT NULL,
  `Usr_pwd` varchar(100) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Nickname` varchar(10) NOT NULL,
  `Role_id` varchar(50) NOT NULL,
  `isActive` int(1) NOT NULL,
  `Status_data` varchar(10) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Photo` varchar(255) NOT NULL,
  `Phone1` varchar(20) NOT NULL,
  `Phone2` varchar(20) NOT NULL,
  `Updated_dtm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_member`
--

INSERT INTO `tbl_member` (`uid`, `Usr_id`, `Usr_pwd`, `Name`, `Nickname`, `Role_id`, `isActive`, `Status_data`, `Address`, `Email`, `Photo`, `Phone1`, `Phone2`, `Updated_dtm`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Administrator', '', 'admin', 1, 'active', 'Bld. 100', 'myemail@borouge.com', '', '056563000', '', '2020-04-08 16:59:17'),
(2, 'hasmukh', 'a008a6ac2607a718f2a8ba729864d76f949f16c4', 'Hasmukh K. Patel', '', 'member', 1, 'active', 'Bld. 140', 'ruwais@borouge.com', '', '056563424', '', '2020-04-08 16:59:45'),
(3, 'antil', 'f896be74960eda5b1bfc35ec104d3bb4c810cd2d', 'Antil K. Patel', '', 'member', 1, 'active', 'Bld. 155', 'antil.patel@borouge.com', '', '056566620', '', '2020-04-08 16:59:33');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_price`
--

CREATE TABLE `tbl_price` (
  `uid` int(11) NOT NULL,
  `Taxi_id` int(11) NOT NULL,
  `Destination_id` int(11) NOT NULL,
  `Origin` varchar(100) NOT NULL,
  `Destination` varchar(100) NOT NULL,
  `Orig_desti` varchar(100) NOT NULL,
  `Price` int(11) NOT NULL,
  `Status_data` varchar(10) NOT NULL,
  `Updated_dtm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_price`
--

INSERT INTO `tbl_price` (`uid`, `Taxi_id`, `Destination_id`, `Origin`, `Destination`, `Orig_desti`, `Price`, `Status_data`, `Updated_dtm`) VALUES
(1, 1, 1, 'RuwaisX', 'Abu Dhabi Airport X', 'Ruwais - Abu Dhabi Airport', 350, 'active', '2020-04-08 18:55:18'),
(2, 1, 2, 'RuwaisX', 'Dubai Airport X', 'Ruwais - Dubai Airport', 550, 'active', '2020-04-08 18:55:22'),
(3, 3, 4, '', '', '', 550, '1', '2020-04-08 18:59:18'),
(4, 3, 3, '', '', '', 300, '1', '2020-04-08 18:59:18'),
(5, 2, 4, '', '', '', 550, '1', '2020-04-08 19:00:38'),
(6, 2, 3, '', '', '', 320, '1', '2020-04-08 19:00:38');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_taxi`
--

CREATE TABLE `tbl_taxi` (
  `uid` int(11) NOT NULL,
  `Driver` varchar(100) NOT NULL,
  `Phone1` varchar(20) NOT NULL,
  `Phone2` varchar(20) NOT NULL,
  `Car_type` varchar(100) NOT NULL,
  `Seat_num` int(11) NOT NULL,
  `Photo` varchar(255) NOT NULL,
  `Status_data` varchar(10) NOT NULL,
  `Updated_dtm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_taxi`
--

INSERT INTO `tbl_taxi` (`uid`, `Driver`, `Phone1`, `Phone2`, `Car_type`, `Seat_num`, `Photo`, `Status_data`, `Updated_dtm`) VALUES
(1, 'Ali Pakistan', '0562426526', '0562426009', 'Innova', 7, '', 'inactive', '2020-03-29 12:12:49'),
(2, 'Ali Pakistan', '0562426526', '0562426009', 'Camry', 4, '', 'active', '2020-03-29 12:12:28'),
(3, 'Murali', '0675889868766', '0675889868755', 'Pajero', 5, '', 'active', '2020-03-29 12:12:32'),
(4, 'Suresh', '05433322366', '05433322300', 'Hyundai H-1', 7, '', 'active', '2020-03-29 12:12:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `tbl_destination`
--
ALTER TABLE `tbl_destination`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `tbl_member`
--
ALTER TABLE `tbl_member`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `tbl_price`
--
ALTER TABLE `tbl_price`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `tbl_taxi`
--
ALTER TABLE `tbl_taxi`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_destination`
--
ALTER TABLE `tbl_destination`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_member`
--
ALTER TABLE `tbl_member`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_price`
--
ALTER TABLE `tbl_price`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_taxi`
--
ALTER TABLE `tbl_taxi`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
