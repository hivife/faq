-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2019 at 08:51 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `name` text COLLATE utf8_bin NOT NULL,
  `category_id` int(11) NOT NULL,
  `private` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`name`, `category_id`, `private`) VALUES
('category1', 1, 0),
('category2', 2, 0),
('private category', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `qa`
--

CREATE TABLE `qa` (
  `question` text COLLATE utf8_bin NOT NULL,
  `answer` text COLLATE utf8_bin NOT NULL,
  `private` tinyint(1) NOT NULL,
  `category_id` int(8) NOT NULL,
  `helpful` int(11) NOT NULL DEFAULT 1,
  `nothelpful` int(11) NOT NULL DEFAULT 1,
  `question_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `qa`
--

INSERT INTO `qa` (`question`, `answer`, `private`, `category_id`, `helpful`, `nothelpful`, `question_id`) VALUES
('undefined', 'undefined', 0, 2, 13, 16, 1),
('Hi', '', 1, 1, 3, 0, 2),
('Ð¸ÑÐºÑƒÑÑÑ‚Ð²Ð°Â», Ð¿Ð¸ÑÐ°Ð», Ñ‡Ñ‚Ð¾ ÑÐ¾Ð²ÐµÑ‚ÑÐºÐ¸Ð¹ Ñ‡ÐµÐ»Ð¾Ð²ÐµÐº Ð½Ðµ Ð¼Ð¾Ð¶ÐµÑ‚ Ð¿Ñ€ÐµÐ´ÑÑ‚Ð°Ð²Ð¸Ñ‚ÑŒ Ð¿Ð¸ÑÐ°Ñ‚ÐµÐ»Ñ Ð¸Ð½Ñ‹Ð¼, Ñ‡ÐµÐ¼ Ð¸Ð·Ð¾Ð±Ñ€Ð°Ð·Ð¸Ð» ÐµÐ³Ð¾ Ñ…ÑƒÐ´Ð¾Ð¶Ð½Ð¸Ðº Ð½Ð° ÑÑ‚Ð¾Ð¼ Ð¿Ð¾Ð»Ð¾Ñ‚Ð½Ðµ. ÐŸÐ¾ Ð¼Ð½ÐµÐ½Ð¸ÑŽ Ð´Ð¾ÐºÑ‚Ð¾Ñ€Ð° Ð¸ÑÐºÑƒÑÑÑ‚Ð²Ð¾Ð²ÐµÐ´ÐµÐ½Ð¸Ñ Ð”Ð¼Ð¸Ñ‚Ñ€Ð¸Ñ Ð¡Ð°Ñ€Ð°Ð±ÑŒÑÐ½Ð¾Ð²Ð°, Ñ…ÑƒÐ´Ð¾Ð¶Ð½Ð¸ÐºÑƒ ÑƒÐ´Ð°Ð»Ð¾ÑÑŒ Ð·Ð°Ð¿ÐµÑ‡Ð°Ñ‚Ð»ÐµÑ‚ÑŒ Ð½Ð° Ð¿Ð¾Ñ€Ñ‚Ñ€ÐµÑ‚Ðµ Ð¾Ð±Ñ€Ð°Ð· Ð½Ð¾Ð²Ð¾Ð³Ð¾ ÑÐ¾Ð²ÐµÑ‚ÑÐºÐ¾Ð³Ð¾ Ñ‡ÐµÐ»Ð¾Ð²ÐµÐºÐ° â€” Ð¸Ð½Ñ‚ÐµÐ»Ð»Ð¸Ð³ÐµÐ½Ñ‚Ð° Ð¸ Ð³ÑƒÐ¼Ð°Ð½Ð¸ÑÑ‚Ð°, ÑÑ‚Ð°Ð²ÑˆÐµÐ³Ð¾ Ð¿Ñ€ÐµÐµÐ¼Ð½Ð¸ÐºÐ¾Ð¼ Ð²ÑÐµÐ³Ð¾ Ð¿Ñ€Ð¾Ð³Ñ€ÐµÑÑÐ¸Ð²Ð½Ð¾Ð³Ð¾, Ñ‡Ñ‚Ð¾ Ð±Ñ‹Ð»Ð¾ Ð² ÐºÑƒÐ»ÑŒÑ‚ÑƒÑ€Ð½Ð¾Ð¼ Ð½Ð°ÑÐ»ÐµÐ´Ð¸Ð¸ Ð´Ð¾Ñ€ÐµÐ²Ð¾Ð»ÑŽÑ†Ð¸Ð¾Ð½Ð½Ð¾Ð¹ Ð Ð¾ÑÑÐ¸Ð¸.  ÐšÐ°Ð½Ð´Ð¸Ð´Ð°Ñ‚ Ð¸ÑÐºÑƒÑÑÑ‚Ð²Ð¾Ð²ÐµÐ´ÐµÐ½Ð¸Ñ ÐšÐ¸Ñ€Ð° Ð¡Ð°Ð·Ð¾Ð½Ð¾Ð²Ð° ÑÑ‡Ð¸Ñ‚Ð°Ð»Ð°, Ñ‡Ñ‚Ð¾ Â«ÐŸÐ¾Ñ€Ñ‚Ñ€ÐµÑ‚ Ð”. Ð. Ð¤ÑƒÑ€Ð¼Ð°Ð½Ð¾Ð²Ð°Â» Ð½ÐµÐ¾Ð±Ñ‹Ñ‡ÐµÐ½ Ð¿Ð¾ ÑÐ²Ð¾ÐµÐ¹ Ð¶Ð¸Ð²Ð¾Ð¿Ð¸ÑÐ½Ð¾-Ð¿Ð»Ð°ÑÑ‚Ð¸Ñ‡ÐµÑÐºÐ¾Ð¹ ÑÑ‚Ñ€ÑƒÐºÑ‚ÑƒÑ€Ðµ Ð¸ Ð¸ÑÐ¿Ð¾Ð»ÑŒÐ·Ð¾Ð²Ð°Ð½Ð½Ñ‹Ð¼ Ñ…ÑƒÐ´Ð¾Ð¶Ð½Ð¸ÐºÐ¾Ð¼ Ð¿Ð¾ÑÑ‚Ð¸Ñ‡ÐµÑÐºÐ¸Ð¼ ÑÑ€ÐµÐ´ÑÑ‚Ð²Ð°Ð¼. Ð¡ Ð¾Ð´Ð½Ð¾Ð¹ ÑÑ‚Ð¾Ñ€Ð¾Ð½Ñ‹, Ð¾Ð½ Ð´Ð¾ÑÑ‚Ð°Ñ‚Ð¾Ñ‡Ð½Ð¾ Ñ‚Ñ€Ð°Ð´Ð¸Ñ†Ð¸Ð¾Ð½ÐµÐ½ (ÑÐ¾Ð·Ð´Ð°Ð½ Ð² Ð¿Ñ€Ð¾Ð´Ð¾Ð»Ð¶ÐµÐ½Ð¸Ðµ Ñ€ÐµÐ°Ð»Ð¸ÑÑ‚Ð¸Ñ‡ÐµÑÐºÐ¸Ñ… Ñ‚Ñ€Ð°Ð´Ð¸Ñ†Ð¸Ð¹ Ð´Ð¾Ñ€ÐµÐ²Ð¾Ð»ÑŽÑ†Ð¸Ð¾Ð½Ð½Ð¾Ð¹ Ð Ð¾ÑÑÐ¸Ð¸). Ð¡ Ð´Ñ€ÑƒÐ³Ð¾Ð¹ ÑÑ‚Ð¾Ñ€Ð¾Ð½Ñ‹, Ð¿Ð¾Ñ€Ñ‚Ñ€ÐµÑ‚ Ð½Ðµ Ñ‚Ð¾Ð»ÑŒÐºÐ¾ Ð±Ñ‹Ð» Ð¿Ñ€Ð¾Ð¸Ð·Ð²ÐµÐ´ÐµÐ½Ð¸ÐµÐ¼ Ð½Ð¾Ð²Ð¾Ð³Ð¾ Ð²Ñ€ÐµÐ¼ÐµÐ½Ð¸, Ð½Ð¾ Ð¸ Ð·Ð°ÐºÐ»Ð°Ð´Ñ‹Ð²Ð°Ð» ÑÐ°Ð¼ Ñ„ÑƒÐ½Ð´Ð°Ð¼ÐµÐ½Ñ‚ Ð½Ð¾Ð²Ð¾Ð³Ð¾ Ð¸ÑÐºÑƒÑÑÑ‚Ð²Ð°. ÐšÐ°Ð½Ð´Ð¸Ð´Ð°Ñ‚ Ð¸ÑÐºÑƒÑÑÑ‚Ð²Ð¾Ð²ÐµÐ´ÐµÐ½Ð¸Ñ Ð’Ð°Ð»ÐµÐ½Ñ‚Ð¸Ð½Ð° ÐšÐ½ÑÐ·ÐµÐ²Ð° ÑÑ‡Ð¸Ñ‚Ð°Ð»Ð°, Ñ‡Ñ‚Ð¾ ÐºÐ°Ñ€Ñ‚Ð¸Ð½Ð° ÐœÐ°Ð»ÑŽÑ‚Ð¸Ð½Ð° ÑÐ¾Ð·Ð´Ð°Ð²Ð°Ð»Ð° Ð¾ÑÐ½Ð¾Ð²Ñ‹ Ð±ÑƒÐ´ÑƒÑ‰ÐµÐ³Ð¾ Ð¼ÐµÑ‚Ð¾Ð´Ð° ÑÐ¾Ñ†Ð¸Ð°Ð»Ð¸ÑÑ‚Ð¸Ñ‡ÐµÑÐºÐ¾Ð³Ð¾ Ñ€ÐµÐ°Ð»Ð¸Ð·Ð¼Ð°, Ñ‚Ð°Ðº ÐºÐ°Ðº Ð¾Ð½Ð° Ð¿ÐµÑ€ÐµÐ´Ð°Ñ‘Ñ‚ Ð² Ð»Ð¸Ñ‡Ð½Ð¾ÑÑ‚Ð¸ Ð³ÐµÑ€Ð¾Ñ ÐºÐ°Ðº Ð¸Ð½Ð´Ð¸Ð²Ð¸Ð´ÑƒÐ°Ð»ÑŒÐ½Ð¾Ðµ Ð½Ð°Ñ‡Ð°Ð»Ð¾, Ñ‚Ð°Ðº Ð¸ ', 'sjdhfsudf', 0, 1, 3, 0, 3),
('123', '456', 1, 2, 2, 2, 4),
('FirstQueshio', 'AnswerFirst', 0, 0, 5, 3, 5),
('Queshion2', 'Answer2', 1, 0, 16, 4, 6);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(30) COLLATE utf8_bin NOT NULL,
  `password` varchar(30) COLLATE utf8_bin NOT NULL,
  `token` varchar(256) COLLATE utf8_bin NOT NULL,
  `validate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `token`, `validate`) VALUES
('tim', '123', 'a028c6951542b915dc2964785a1d323824b567b2b821bb694540f046f7b5ac855dfe8179fb656714c493619e32dbecca43559cd3ed36489cae384bb1489da3e5', '2019-08-09 03:43:56'),
('pooya', '456', 'a74241bd64d03695fa999469e1ff1a3b8ae0a43a644035e3d5f2baf09d5adcf6a334897905022e7274412808664ba2888697813e3474591ae67ca3b82d7a5cf2cad7c0031772e1f564c102db8d1afc68d56fbd991a16b002f9b6e119dd8960c99b0033c6bf9719c7870261ab17b5a87dbf0b2a23ad8a583dac372bffac019a87', '2019-08-07 06:21:43');

--
-- Triggers `user`
--
DELIMITER $$
CREATE TRIGGER `update question token` BEFORE UPDATE ON `user` FOR EACH ROW UPDATE qa INNER JOIN user SET userid = NEW.id
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `qa`
--
ALTER TABLE `qa`
  ADD PRIMARY KEY (`question_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `qa`
--
ALTER TABLE `qa`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
