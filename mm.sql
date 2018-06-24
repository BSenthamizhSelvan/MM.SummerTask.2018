-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 24, 2018 at 06:45 AM
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `content`, `summary`, `img`, `date`, `ctg`, `reptr_name`, `modified`, `user_id`, `views`) VALUES
(1, 'A DOLEFUL DEPARTURE: SRI BANSIDHAR PANDA', 'In an extremely sad turn of events, Sri Bansidhar Panda, former chairman of the Board of Governors of NIT Rourkela[2003-08] passed away at a ripe old age of 87 at his official residence in Bhubaneswar.\r\n\r\nSri Bansidhar Panda graduated from Benaras Hindu University, earned an MS from Harvard University and went on to get a Ph.D. from Michigan Technological university. He founded the IMFA in 1961 and went on to become one of the most respected industrialists in the entire country. He served on the BoG of IIT Kharagpur and IIM Calcutta as well as NITR. Sri Bansidhar Panda was a social worker and pioneer having established the Sarala award for Odiya literature and Eklavya award for sports achievement. He founded the Bansidhar and Illa Panda foundation for socio-economic outreach to the downtrodden.\r\n\r\nA great scientist, accomplished industrialist, an eminent leader and above all a great human being Sri Bansidhar Panda was. He was a man of simplicity and a generous host and again a wellspring of inspiration and guidance for those around him. The people close to him say that he always used to focus on the fundamentals and always said \r\n\r\nSadly, he is no more with us and departed for his rightful abode in the heavens on 22nd of May, 2018 (Tuesday). A condolence meeting was convened at Bhubaneswar Behera Auditorium in honor of his graceful memory last Wednesday evening and was attended by faculty, staff and students alike. The Registrar Er. S. K. Upadhyay as well as Dean Alumni Relations Prof. Sukhdev Meher fondly recalled their memories and past experiences with Sri Banshidhar Panda recounting how he was a true gentleman and an unparalleled leader as well as a kind human being.\r\n\r\nMonday Morning mourns the loss of a great leader known for his genial personality and forward vision who was a meaningful contributor in the progress of Odisha and India.\r\n\r\n[Picture Credits: http://odishatv.in]', 'A great scientist, accomplished industrialist, an eminent leader and above all a great human being Sri Bansidhar Panda was. He was a man of simplicity and a generous host and again a wellspring of inspiration and guidance for those around him.', 'bansidhar-panda.jpg', '2018-06-22', 'Featured', 'B', '2018-06-22 21:05:34', 1, 0);

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `privilege`) VALUES
(1, 'Selvan', 'madselvan@gmail.com', '5a17ef619083c0e6ba917a4ee1aeb5d5', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
