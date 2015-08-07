-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2015 at 03:29 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fv_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE IF NOT EXISTS `album` (
  `album_id` int(3) NOT NULL AUTO_INCREMENT,
  `album_name` varchar(200) NOT NULL,
  `album_disc` varchar(500) NOT NULL,
  `album_image` varchar(300) NOT NULL,
  `album_cat_name` varchar(20) NOT NULL COMMENT 'img_category_name',
  PRIMARY KEY (`album_id`),
  KEY `album_cat_id` (`album_cat_name`),
  KEY `album_cat_name` (`album_cat_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`album_id`, `album_name`, `album_disc`, `album_image`, `album_cat_name`) VALUES
(1, 'Ishan & Jeewani', '', '', 'weddings'),
(2, 'Sampath & Anushi', '', '', 'preshoot');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `image_name` varchar(100) NOT NULL,
  `image_path` varchar(100) NOT NULL,
  `image_category` varchar(20) DEFAULT NULL,
  `image_album_id` int(3) NOT NULL,
  PRIMARY KEY (`image_id`),
  UNIQUE KEY `image_name` (`image_name`),
  KEY `image_category` (`image_category`,`image_album_id`),
  KEY `image_album_id` (`image_album_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `img_category`
--

CREATE TABLE IF NOT EXISTS `img_category` (
  `cat_id` int(2) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(20) NOT NULL,
  `cat_disc` varchar(50) NOT NULL,
  PRIMARY KEY (`cat_id`),
  UNIQUE KEY `cat_name_4` (`cat_name`),
  KEY `cat_name` (`cat_name`),
  KEY `cat_name_2` (`cat_name`),
  KEY `cat_name_3` (`cat_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `img_category`
--

INSERT INTO `img_category` (`cat_id`, `cat_name`, `cat_disc`) VALUES
(1, 'weddings', ''),
(2, 'homecoming', ''),
(3, 'preshoot', ''),
(4, 'events', '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `album_ibfk_1` FOREIGN KEY (`album_cat_name`) REFERENCES `img_category` (`cat_name`) ON UPDATE CASCADE;

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_2` FOREIGN KEY (`image_album_id`) REFERENCES `album` (`album_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`image_category`) REFERENCES `img_category` (`cat_name`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
