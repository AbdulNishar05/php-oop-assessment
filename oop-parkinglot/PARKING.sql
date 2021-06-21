-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 21, 2021 at 03:25 PM
-- Server version: 5.7.34-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `PARKING`
--

-- --------------------------------------------------------

--
-- Table structure for table `addparking`
--

CREATE TABLE `addparking` (
  `id` int(11) NOT NULL,
  `Area` varchar(30) NOT NULL,
  `vehicleType` varchar(15) NOT NULL,
  `parkingslots` int(15) NOT NULL,
  `slotcharge` varchar(15) NOT NULL,
  `slotperhour` varchar(15) NOT NULL,
  `Cancellation` varchar(10) NOT NULL,
  `cutofftime` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `addparking`
--

INSERT INTO `addparking` (`id`, `Area`, `vehicleType`, `parkingslots`, `slotcharge`, `slotperhour`, `Cancellation`, `cutofftime`) VALUES
(8, 'tenkasi', 'Heavy', 5, 'paid', '100', '20', '2hr');

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
  `id` int(10) NOT NULL,
  `username` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(4) NOT NULL,
  `date` date DEFAULT NULL,
  `cid` varchar(10) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `area` varchar(100) DEFAULT NULL,
  `vehicle_type` varchar(100) DEFAULT NULL,
  `slot_type` varchar(100) DEFAULT NULL,
  `st_time` varchar(100) DEFAULT NULL,
  `cut_time` varchar(100) DEFAULT NULL,
  `slot_no` varchar(100) DEFAULT NULL,
  `amt` varchar(100) DEFAULT NULL,
  `amt_status` varchar(100) DEFAULT NULL,
  `pid` varchar(100) DEFAULT NULL,
  `regdate` varchar(100) DEFAULT NULL,
  `canc_charge` varchar(100) DEFAULT NULL,
  `canc_reason` varchar(100) DEFAULT NULL,
  `et_time` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `date`, `cid`, `status`, `area`, `vehicle_type`, `slot_type`, `st_time`, `cut_time`, `slot_no`, `amt`, `amt_status`, `pid`, `regdate`, `canc_charge`, `canc_reason`, `et_time`) VALUES
(19, '2020-02-12', '', 'OUT', 'tenkasi', 'heavy', 'paid', '11:11', '1', '4', '100', 'PAID', '8', '21-06-2021', NULL, NULL, '03:01'),
(20, '4554-03-12', '', 'OUT', 'tenkasi', 'heavy', 'paid', '22:02', '1', '5', '100', 'PAID', '8', '21-06-2021', NULL, NULL, '03:10');

-- --------------------------------------------------------

--
-- Table structure for table `customerDetails`
--

CREATE TABLE `customerDetails` (
  `id` int(11) NOT NULL,
  `Firstname` varchar(255) DEFAULT NULL,
  `Lastname` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `MobileNo` int(10) DEFAULT NULL,
  `VehicleNo` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `wallet` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customerDetails`
--

INSERT INTO `customerDetails` (`id`, `Firstname`, `Lastname`, `Email`, `MobileNo`, `VehicleNo`, `password`, `wallet`) VALUES
(4, 'Abdul', 'Nishar', 'abdilnizar899@gmail.com', 123456789, '12/35/5559', '12345678', '500');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addparking`
--
ALTER TABLE `addparking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customerDetails`
--
ALTER TABLE `customerDetails`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addparking`
--
ALTER TABLE `addparking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `customerDetails`
--
ALTER TABLE `customerDetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
