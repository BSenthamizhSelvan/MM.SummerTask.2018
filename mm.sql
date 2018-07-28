-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 28, 2018 at 06:11 PM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mm`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `summary` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `ctg` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reptr_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `content`, `summary`, `img`, `date`, `ctg`, `reptr_name`, `modified`, `user_id`, `views`) VALUES
(1, 'test', 'Test l\r\n	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\n	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\n	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\n	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\n	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Test\r\n	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\n	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\n	consequat. Duis aute', 'img11.jpg', '2018-06-30', 'Forum', 'testuser', '2018-07-26 13:31:55', 1, 9),
(2, 'test2', 'Test l\r\n	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\n	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\n	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\n	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\n	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Test\r\n	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\n	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\n	consequat. Duis aute', 'img3.jpg', '2018-07-08', 'Forum', 'B', '2018-07-08 21:38:44', 1, 14),
(3, 'security analyist', 'qwertysdfg', 'Goods yu', 'img31.JPG', '2018-07-25', 'Interview', 'B', '2018-07-28 11:26:16', 1, 13);

-- --------------------------------------------------------

--
-- Table structure for table `article_comments`
--

DROP TABLE IF EXISTS `article_comments`;
CREATE TABLE IF NOT EXISTS `article_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `article_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `approved` tinyint(3) UNSIGNED DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `article_comments`
--

INSERT INTO `article_comments` (`id`, `content`, `article_id`, `user_id`, `date`, `approved`) VALUES
(1, 'hello there', 1, 1, '2018-07-14 11:22:15', 1),
(2, 'hello again', 1, 1, '2018-07-14 11:25:08', 1),
(3, 'test comment-1', 1, 3, '2018-07-25 08:14:36', 1),
(4, 'hello', 1, 3, '2018-07-25 08:15:04', 0),
(5, 'test\r\n', 2, 3, '2018-07-25 08:18:23', 1),
(6, 'hello', 3, 1, '2018-07-25 08:49:06', 1),
(7, 'hello', 2, 1, '2018-07-26 13:58:37', 1),
(8, 'xyz', 1, 2, '2018-07-28 17:54:07', 0),
(9, 'xyz', 1, 2, '2018-07-28 17:54:57', 0);

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

DROP TABLE IF EXISTS `forum`;
CREATE TABLE IF NOT EXISTS `forum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topic` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_created` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `last_id` int(11) NOT NULL,
  `last_date` datetime NOT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  `replies` int(11) NOT NULL DEFAULT '0',
  `approved` tinyint(3) UNSIGNED DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`id`, `topic`, `content`, `user_created`, `created_date`, `last_id`, `last_date`, `views`, `replies`, `approved`) VALUES
(1, 'Test', 'test', 2, '2018-07-18 12:14:45', 1, '2018-07-18 14:01:04', 4, 3, 1),
(2, 'New thread test-1', 'this is test forum-1', 3, '2018-07-25 08:19:08', 3, '2018-07-25 08:19:08', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `forum_data`
--

DROP TABLE IF EXISTS `forum_data`;
CREATE TABLE IF NOT EXISTS `forum_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `approved` tinyint(3) UNSIGNED DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `forum_data`
--

INSERT INTO `forum_data` (`id`, `content`, `user_id`, `thread_id`, `date`, `approved`) VALUES
(2, 'hi', 1, 1, '2018-07-18 14:00:55', 1),
(3, 'hello', 1, 1, '2018-07-18 14:01:01', 1),
(4, 'hi', 1, 1, '2018-07-18 14:01:04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `poll`
--

DROP TABLE IF EXISTS `poll`;
CREATE TABLE IF NOT EXISTS `poll` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `option1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `option2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `option3` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `count1` int(11) UNSIGNED DEFAULT '0',
  `count2` int(11) UNSIGNED DEFAULT '0',
  `count3` int(11) UNSIGNED DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `poll`
--

INSERT INTO `poll` (`id`, `question`, `option1`, `option2`, `option3`, `count1`, `count2`, `count3`) VALUES
(1, 'test poll', 'option 1', 'option 2\r\n', 'option 3', 14, 11, 17);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text COLLATE utf8_unicode_ci NOT NULL,
  `person` text COLLATE utf8_unicode_ci NOT NULL,
  `approved` tinyint(3) UNSIGNED DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `question`, `person`, `approved`) VALUES
(1, 'test', 'dean', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `privilege` tinyint(3) UNSIGNED DEFAULT '0',
  `vote` tinyint(3) UNSIGNED DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `privilege`, `vote`) VALUES
(1, 'Selvan', 'selvan@gmail.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', 1, 1),
(2, 'harish', 'harish@gmail.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', 0, 0),
(3, 'testuser', 'testuser@gmail.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', 2, 0),
(4, 'checkauthor', 'checkauthopr@gmail.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', 2, 0),
(5, 'author', 'author@gmail.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', 0, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
