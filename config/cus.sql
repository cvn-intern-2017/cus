-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2017 at 06:39 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cus`
--

-- --------------------------------------------------------

--
-- Table structure for table `access`
--

CREATE TABLE `access` (
  `key_url` varchar(6) NOT NULL,
  `browser` tinyint(1) NOT NULL,
  `clicked_time` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `access`
--

INSERT INTO `access` (`key_url`, `browser`, `clicked_time`) VALUES
('000000', 1, '1501055244'),
('000001', 2, '1501055246'),
('000004', 0, '1501123869');

-- --------------------------------------------------------

--
-- Table structure for table `url`
--

CREATE TABLE `url` (
  `key_url` char(6) NOT NULL,
  `original_link` text NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `url`
--

INSERT INTO `url` (`key_url`, `original_link`, `created_time`) VALUES
('000000', 'https://bozuman.cybozu.com/g/schedule/index.csp?', '2017-07-26 07:24:10'),
('000001', 'http://localhost/phpmyadmin/tbl_change.php?db=cus&table=url', '2017-07-26 07:24:35'),
('000002', 'https://github.com/namnguyen95?tab=overview&from=2017-07-01&to=2017-07-26', '2017-07-26 09:57:11'),
('000003', 'https://github.com/', '2017-07-27 02:12:09'),
('000004', 'https://translate.google.com/?hl=vi', '2017-07-27 02:32:16'),
('000005', 'https://github.com/cvn-intern-2017/cus', '2017-07-27 03:21:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access`
--
ALTER TABLE `access`
  ADD PRIMARY KEY (`key_url`,`browser`),
  ADD KEY `index_browser` (`browser`);

--
-- Indexes for table `url`
--
ALTER TABLE `url`
  ADD PRIMARY KEY (`key_url`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `access`
--
ALTER TABLE `access`
  ADD CONSTRAINT `access_ibfk_1` FOREIGN KEY (`key_url`) REFERENCES `url` (`key_url`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
