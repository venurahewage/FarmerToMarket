-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2024 at 02:36 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `1125125`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` int(8) NOT NULL,
  `type` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `district` varchar(25) NOT NULL,
  `city` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tel` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `price` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `details` varchar(2000) NOT NULL,
  `timee` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `img` varchar(40) NOT NULL,
  `owner` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `type`, `district`, `city`, `tel`, `price`, `details`, `timee`, `img`, `owner`) VALUES
(46, 'Coconut', 'Kurunegala', 'Polgahawela', '0771234567', '80', 'පොල් තොග ඇත.\r\nඅමතන්න - 0771234567 ', '2024:11:09 - 23:42:05', 'prodImgs/46.jpg', 'Venura'),
(47, 'Mango', 'Anuradhapura', 'Anuradhapura', '0771234567', '60', 'තොග ඇත.\nඅමතන්න - 0771234567 - mango lot - call 0771234568', '2024:11:09 - 23:50:09', 'prodImgs/47.jpg', 'Venura');

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `cid` int(8) NOT NULL,
  `msg` varchar(512) NOT NULL,
  `timee` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`cid`, `msg`, `timee`) VALUES
(3, 'අඹ විකිනීමට තිබේ නම් දැනුම් දෙන්න. කොලඹ, ගම්පහ අවට. දුරකතන - 0761234567 අමල් ', '2024:11:10 - 01:56:19'),
(4, 'This is test message..!', '2024:11:10 - 08:06:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(8) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `pswd` varchar(40) NOT NULL,
  `contact` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `pswd`, `contact`) VALUES
(33, 'Venura', 'Hewage', '123456', '0771234567'),
(42, 'Bandula', 'Perera', '454545', '0712345678');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `cid` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
