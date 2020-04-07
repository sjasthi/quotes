-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2020 at 07:11 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quotes_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `pref`
--

CREATE TABLE `pref` (
  `COLUMNS` int(10) NOT NULL COMMENT 'How many rows we can have',
  `Language` varchar(15) NOT NULL COMMENT 'What language we should assume a quote is in.',
  `ID` int(1) NOT NULL DEFAULT 1,
  `NAME` varchar(30) NOT NULL,
  `VALUE` varchar(10) NOT NULL,
  `COMMENTS` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pref`
--

INSERT INTO `pref` (`COLUMNS`, `Language`, `ID`, `NAME`, `VALUE`, `COMMENTS`) VALUES
(14, 'English', 1, '', '', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
