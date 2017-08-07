-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2017 at 11:45 AM
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

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `convert_10_to_62` (`id_num` INT) RETURNS CHAR(6) CHARSET latin1 BEGIN
    DECLARE key_url CHAR(6);
    DECLARE remainder INT;
    DECLARE count_i INT;
    SET key_url = '';
    SET count_i = 0;
	WHILE count_i < 6  DO
        SET remainder = id_num % 62;
    	IF id_num > 0 THEN
        	SET key_url = CONCAT(convert_one_char(remainder), key_url);
        ELSE
        	SET key_url = CONCAT('0', key_url);
        END IF;
        SET id_num = ROUND(id_num / 62 - 0.5);
        SET count_i = count_i + 1;
  	END WHILE;
    
    RETURN key_url;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `convert_one_char` (`i` INT) RETURNS CHAR(1) CHARSET latin1 BEGIN
    DECLARE result VARCHAR(1);
	CASE i 
        WHEN 0 THEN SET result = '0';
        WHEN 1 THEN SET result = '1';
        WHEN 2 THEN SET result = '2';
        WHEN 3 THEN SET result = '3';
        WHEN 4 THEN SET result = '4';
        WHEN 5 THEN SET result = '5';
        WHEN 6 THEN SET result = '6';
        WHEN 7 THEN SET result = '7';
        WHEN 8 THEN SET result = '8';
        WHEN 9 THEN SET result = '9';
        WHEN 10 THEN SET result = 'a';
        WHEN 11 THEN SET result = 'b';
        WHEN 12 THEN SET result = 'c';
        WHEN 13 THEN SET result = 'd';
        WHEN 14 THEN SET result = 'e';
        WHEN 15 THEN SET result = 'f';
        WHEN 16 THEN SET result = 'g';
        WHEN 17 THEN SET result = 'h';
        WHEN 18 THEN SET result = 'i';
        WHEN 19 THEN SET result = 'j';
        WHEN 20 THEN SET result = 'k';
        WHEN 21 THEN SET result = 'l';
        WHEN 22 THEN SET result = 'm';
        WHEN 23 THEN SET result = 'n';
        WHEN 24 THEN SET result = 'o';
        WHEN 25 THEN SET result = 'p';
        WHEN 26 THEN SET result = 'q';
        WHEN 27 THEN SET result = 'r';
        WHEN 28 THEN SET result = 's';
        WHEN 29 THEN SET result = 't';
        WHEN 30 THEN SET result = 'u';
        WHEN 31 THEN SET result = 'v';
        WHEN 32 THEN SET result = 'w';
        WHEN 33 THEN SET result = 'x';
        WHEN 34 THEN SET result = 'y';
        WHEN 35 THEN SET result = 'z';
        WHEN 36 THEN SET result = 'A';
        WHEN 37 THEN SET result = 'B';
        WHEN 38 THEN SET result = 'C';
        WHEN 39 THEN SET result = 'D';
        WHEN 40 THEN SET result = 'E';
        WHEN 41 THEN SET result = 'F';
        WHEN 42 THEN SET result = 'G';
        WHEN 43 THEN SET result = 'H';
        WHEN 44 THEN SET result = 'I';
        WHEN 45 THEN SET result = 'J';
        WHEN 46 THEN SET result = 'K';
        WHEN 47 THEN SET result = 'L';
        WHEN 48 THEN SET result = 'M';
        WHEN 49 THEN SET result = 'N';
        WHEN 50 THEN SET result = 'O';
        WHEN 51 THEN SET result = 'P';
        WHEN 52 THEN SET result = 'Q';
        WHEN 53 THEN SET result = 'R';
        WHEN 54 THEN SET result = 'S';
        WHEN 55 THEN SET result = 'T';
        WHEN 56 THEN SET result = 'U';
        WHEN 57 THEN SET result = 'V';
        WHEN 58 THEN SET result = 'W';
        WHEN 59 THEN SET result = 'X';
        WHEN 60 THEN SET result = 'Y';
        WHEN 61 THEN SET result = 'Z';
	END CASE;
    RETURN result;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `access`
--

CREATE TABLE `access` (
  `id` bigint(11) NOT NULL,
  `browser` tinyint(1) NOT NULL,
  `clicked_time` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `url`
--

CREATE TABLE `url` (
  `id` bigint(11) NOT NULL,
  `key_url` char(6) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `original_link` text NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `url`
--

INSERT INTO `url` (`id`, `key_url`, `original_link`, `created_time`) VALUES
(1, '000001', 'https://stackoverflow.com/questions/559363/matching-a-space-in-regex', '2017-08-07 09:33:53');

--
-- Triggers `url`
--
DELIMITER $$
CREATE TRIGGER `set_key_url` BEFORE INSERT ON `url` FOR EACH ROW BEGIN
   DECLARE next_id BIGINT;
   SET next_id = (SELECT MAX(id) FROM `url`) + 1;
   IF ISNULL(next_id) THEN
   		SET next_id = 1;
   END IF;
   SET NEW.key_url=convert_10_to_62(next_id);
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access`
--
ALTER TABLE `access`
  ADD PRIMARY KEY (`id`,`browser`);

--
-- Indexes for table `url`
--
ALTER TABLE `url`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `url`
--
ALTER TABLE `url`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `access`
--
ALTER TABLE `access`
  ADD CONSTRAINT `access_ibfk_1` FOREIGN KEY (`id`) REFERENCES `url` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
