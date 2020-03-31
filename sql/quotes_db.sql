-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2020 at 05:25 PM
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
  `RowNum` int(10) NOT NULL COMMENT 'How many rows we can have',
  `Language` varchar(15) NOT NULL COMMENT 'What language we should assume a quote is in.',
  `ID` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pref`
--

INSERT INTO `pref` (`RowNum`, `Language`, `ID`) VALUES
(14, 'Telugu', 1);

-- --------------------------------------------------------

--
-- Table structure for table `quote_table`
--

CREATE TABLE `quote_table` (
  `id` int(5) NOT NULL,
  `author` varchar(50) DEFAULT NULL,
  `topic` varchar(50) DEFAULT NULL,
  `quote` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quote_table`
--

INSERT INTO `quote_table` (`id`, `author`, `topic`, `quote`) VALUES
(8, 'someone', 'all letters', 'Sphinx of Black Quartz, Judge my Vow'),
(9, 'gandhi', 'gandhi', 'చదవడం వలన ప్రయోజనమేమంటే నలుమూలల నుంచి వచ్చే విఙ్ఞానాన్ని పొందడం, దాన్నుంచి గుణ పాఠాలు తీసుకోవడం'),
(10, 'someone', 'someone', 'once told me the world is gonna roll me');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `quote_table`
--
ALTER TABLE `quote_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `quote_table`
--
ALTER TABLE `quote_table`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
