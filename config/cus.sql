-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2017 at 07:51 AM
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
  `key_url` varchar(6) CHARACTER SET utf32 COLLATE utf32_bin NOT NULL,
  `browser` tinyint(1) NOT NULL,
  `clicked_time` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `access`
--

INSERT INTO `access` (`key_url`, `browser`, `clicked_time`) VALUES
('00000B', 0, '1501221064');

-- --------------------------------------------------------

--
-- Table structure for table `url`
--

CREATE TABLE `url` (
  `key_url` char(6) CHARACTER SET utf32 COLLATE utf32_bin NOT NULL,
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
('000005', 'https://github.com/cvn-intern-2017/cus', '2017-07-27 03:21:24'),
('000006', 'http://bongdaplus.vn/', '2017-07-27 05:57:53'),
('000007', 'https://ko.wikipedia.org/wiki/%EC%9C%84%ED%82%A4%EB%B0%B1%EA%B3%BC:%EB%8C%80%EB%AC%B8', '2017-07-27 06:08:45'),
('000008', 'https://bozuman.cybozu.com/g/schedule/view.csp?event=1259059&bdate=2017-07-28&uid=1854&gid=462&referer_key=f9c8e58b62d73e02eed0d3f977d08c90&start_day=&end_day=', '2017-07-27 06:12:51'),
('000009', 'https://www.facebook.com/', '2017-07-27 06:18:52'),
('00000A', 'https://github.com/liubin/fluentd-agent', '2017-07-28 05:49:06'),
('00000B', 'https://github.com/cvn-intern-2017/cus/graphs/contributors', '2017-07-28 05:49:50'),
('00000a', 'https://abc.com', '2017-07-27 06:20:30'),
('00000b', 'https://github.com/cvn-intern-2017/cus/blob/master/config/cus.sql', '2017-07-27 06:31:38'),
('00000c', 'https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-on-ubuntu-16-04', '2017-07-27 06:53:19'),
('00000d', 'https://bozuman.cybozu.com/g/schedule/view.csp?uid=1854&event=1274113&bdate=2017-07-27&nid=31651020', '2017-07-27 06:55:30'),
('00000e', 'https://www.chiark.greenend.org.uk/~sgtatham/putty/latest.html', '2017-07-27 06:58:22'),
('00000f', 'http://localhost/phpmyadmin/sql.php?db=cus&goto=db_structure.php&table=url&pos=0', '2017-07-27 07:11:55'),
('00000g', 'https://bozuman.cybozu.com/g/schedule/mobile/personal_week.csp?', '2017-07-27 07:14:51'),
('00000h', 'https://bozuman.cybozu.com/g/schedule/mobile/group_day.csp?bdate=2017-07-27&uid=1854&gid=462&search_text=', '2017-07-27 07:16:38'),
('00000i', 'https://bozuman.cybozu.com/g/schedule/mobile/group_day.csp?bdate=2017-07-28&uid=&gid=462&event=&event_date=&sp=0&search_text=&uids=&fids=', '2017-07-27 07:18:00'),
('00000j', 'http://localhost/phpmyadmin/sql.php?db=cus&goto=db_structure.php&table=url&po', '2017-07-27 07:18:45'),
('00000k', 'http://cus.dev.cybozu.xyz/', '2017-07-27 07:20:06'),
('00000l', 'http://materializecss.com/forms.html', '2017-07-27 07:30:45'),
('00000m', 'http://localhost/phpmyadmin/sql.php?db=cus&goto=db_structure.php', '2017-07-27 07:47:19'),
('00000n', 'http://php.net/manual/en/function.parse-ini-file.php', '2017-07-28 04:29:58'),
('00000o', 'https://www.google.co.jp/?gfe_rd=cr&ei=n7h6WYqWKqrz8Ae2w4eADA', '2017-07-28 04:30:33'),
('00000p', 'http://qiita.com/liubin/items/3722ab10a73154863bd4', '2017-07-28 04:31:27'),
('00000q', 'http://cus.dev.cybozu.xyz/00000o', '2017-07-28 04:37:13'),
('00000r', 'http://cus.dev.cybozu.xyz/00000z', '2017-07-28 04:37:25'),
('00000s', 'https://stackoverflow.com/questions/37239970/connect-to-mysql-server-without-sudo', '2017-07-28 04:40:39'),
('00000t', 'http://qiita.com/liubin/items/92a4e7e3917143ae4aaf', '2017-07-28 04:41:12'),
('00000u', 'https://github.com/cvn-intern-2017/cus/wiki/Specification:-Feature-1---Shorten-URL', '2017-07-28 04:41:27'),
('00000v', 'http://cus.dev.cybozu.xyz/00000', '2017-07-28 04:41:41'),
('00000w', 'http://cus.dev.cybozu.xyz/00000v', '2017-07-28 04:41:45'),
('00000x', 'http://cus.dev.cybozu.xyz/00000w', '2017-07-28 04:41:52'),
('00000z', 'http://cus.dev.cybozu.xyz/00000y', '2017-07-28 04:42:00');

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
