-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2022 at 11:57 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(10) NOT NULL,
  `booking_cid` date NOT NULL,
  `booking_cod` date NOT NULL,
  `no_booking` int(100) NOT NULL,
  `room_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `booking_cid`, `booking_cod`, `no_booking`, `room_id`) VALUES
(1, '2020-12-08', '2020-12-10', 2, 1),
(2, '2020-12-21', '2020-12-24', 5, 1),
(3, '2020-12-07', '2020-12-08', 2, 1),
(4, '2020-12-07', '2020-12-08', 2, 1),
(5, '2021-01-01', '2021-01-02', 1, 1),
(6, '2021-01-01', '2021-01-02', 5, 3),
(7, '2021-01-12', '2021-01-13', 3, 1),
(20, '2022-01-11', '2022-01-19', 2, 1),
(21, '2022-01-26', '2022-01-27', 1, 1),
(22, '2022-01-29', '2022-01-30', 1, 1),
(23, '2022-01-28', '2022-01-31', 1, 1),
(25, '2022-03-04', '2022-03-05', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cus_id` int(10) NOT NULL,
  `cus_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `cus_password` varchar(100) CHARACTER SET utf8 NOT NULL,
  `cus_dob` varchar(20) CHARACTER SET utf8 NOT NULL,
  `cus_address` varchar(100) CHARACTER SET utf8 NOT NULL,
  `cus_hpno` varchar(12) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cus_id`, `cus_name`, `cus_password`, `cus_dob`, `cus_address`, `cus_hpno`) VALUES
(1, 'Jeviena', '4444', '10.11.2002', 'Penang', '01139467151'),
(2, 'Yaani', '8888', '22/11/1979', 'Seremban', '0122267428'),
(3, 'Tamil', '9999', '18/02/2002', 'Melaka', '0113456789'),
(5, 'Patel Babu', '1234', '15/08/1998', 'Johor', '01225446875'),
(22, 'Nandu', '1432', '14/03/2002', 'Ulu Tiram', '012092228722'),
(24, 'rinima', '5678', '10/12/2000', 'Kelantan', '01213498764'),
(27, 'Kevina', '2022', '10/11/2000', 'Johor', '01128976154');

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `owner_id` int(10) NOT NULL,
  `owner_name` varchar(100) NOT NULL,
  `owner_password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`owner_id`, `owner_name`, `owner_password`) VALUES
(1, 'Jebi', '1011'),
(2, 'Jibi\r\n', '0210'),
(11, 'Zayana', '1012'),
(13, 'Rini', '4322'),
(14, 'Yaani', '5678'),
(15, 'Tamilu', '8765');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` int(100) NOT NULL,
  `room_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `room_availability` int(100) NOT NULL,
  `room_price` int(100) NOT NULL,
  `room_rating` int(100) NOT NULL,
  `room_description` text CHARACTER SET utf8 NOT NULL,
  `room_location` varchar(100) CHARACTER SET utf8 NOT NULL,
  `room_image` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `room_name`, `room_availability`, `room_price`, `room_rating`, `room_description`, `room_location`, `room_image`) VALUES
(1, 'Gold  (R01 - R05)', 6, 85, 5, 'single bed, single bathroom, 1 study table, 1 TV and with AC, WIFI', 'ground floor', '1.jpg'),
(2, 'Gold  (R06 - R10)', 5, 90, 4, 'single bed, single bathroom, 1 study table, 1 TV, and with AC, WIFI', '1st floor', '1.jpg'),
(3, 'Luxury (R11-R15)', 5, 190, 5, '2 or 3 or 4 single beds, single bathroom, 1 study table, 1 big size TV, with AC, WIFI.', '2nd floor', '2.jpg'),
(4, 'Platinum (R16-R20)', 5, 290, 5, 'Queen size bed, single bathroom, 1 study desk, 1 dressing table, 1 big cupboard, 1 big LED smart TV, with AC, with private WIFI only for the room.', '3rd floor', '3.jpg'),
(5, 'Diamond (R21-R25)', 5, 390, 5, 'King size bed, single bathroom with bath tub, 1 study desk, 1 dressing table, 1 big cupboard, 1 big LED smart TV, with AC, with private WIFI only for the room.', '4th floor', '4.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cus_id`);

--
-- Indexes for table `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`owner_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cus_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `owner`
--
ALTER TABLE `owner`
  MODIFY `owner_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
