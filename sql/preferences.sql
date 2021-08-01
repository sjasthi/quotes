-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2021 at 12:49 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `preferences`
--

CREATE TABLE `preferences` (
  `id` int(2) NOT NULL,
  `name` varchar(40) NOT NULL,
  `value` varchar(10) NOT NULL,
  `comments` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='for storing model and UI preferences';

--
-- Dumping data for table `preferences`
--

INSERT INTO `preferences` (`id`, `name`, `value`, `comments`) VALUES
(1, 'DEFAULT_LANGUAGE', 'Telugu', 'Telugu and English are two possible values'),
(2, 'DEFAULT_COLUMN_COUNT', '15', 'this is the default column count for the puzzle'),
(3, 'DEFAULT_HOME_PAGE_DISPLAY', 'Puzzles', 'Puzzles, Quote, Both - are three possible values'),
(4, 'DEFAULT_CHUNK_SIZE', '3', 'For  SplitQuote, how many characters in each block'),
(5, 'NO_OF_QUOTES_TO_DISPLAY', '10', 'The quotes are ordered by the ID in des order'),
(6, 'FEELING_LUCKY_MODE', 'LAST', 'Feeling Lucky --> brings up LAST, FIRST or RANDOM quote for puzzle playing'),
(7, 'FEELING_LUCKY_TYPE', 'DROPQUOTE', 'DropQuote, FloatQuote, DropFloat, Scrambler, Splitter, Slider16 (used by Feeling Lucky)'),
(8, 'GRID_HEIGHT', '8', NULL),
(9, 'GRID_WIDTH', '2', NULL),
(10, 'KEEP_PUNCTUATION_MARKS', 'TRUE', 'Split quote punctuation'),
(11, 'SQUARE_COLOR_1', 'RED', 'Predetermined color for squares for button 1'),
(12, 'LETTER_COLOR_1', 'YELLOW', 'Predetermined color for letters for button 1'),
(13, 'LINE_COLOR_1', 'BLACK', 'Predetermined color for lines for button 1'),
(14, 'FILL_COLOR_1', 'WHITE', 'Preset for fill color for button 1'),
(15, 'LETTER_COLOR_2', 'RED', 'Predetermined color for letters for button 2'),
(16, 'LINE_COLOR_2', 'WHITE', 'Predetermined color for lines for button 2'),
(17, 'FILL_COLOR_2', 'BLACK', 'Preset for fill color for button 2'),
(18, 'LETTER_COLOR_3', 'BLACK', 'Predetermined color for letters for button 3'),
(19, 'LINE_COLOR_3', 'BLUE', 'Predetermined color for lines for button 3'),
(20, 'SQUARE_COLOR_2', 'YELLOW', 'Predetermined color for squares for button 2'),
(21, 'FILL_COLOR_3', 'RED', 'Preset for fill color for button 3'),
(22, 'SQUARE_COLOR_3', 'GREEN', 'Predetermined color for squares for button 3'),
(23, 'SQUARE_COLOR_PREFERENCE', 'YELLOW', 'Square color default'),
(24, 'LINE_COLOR_PREFERENCE', 'BLUE', 'Line color default'),
(25, 'LETTER_COLOR_PREFERENCE', 'RED', 'Letter color default'),
(26, 'FILL_COLOR_PREFERENCE', 'BLACK', 'fill color default');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `preferences`
--
ALTER TABLE `preferences`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
