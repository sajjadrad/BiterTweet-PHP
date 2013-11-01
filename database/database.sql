-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 01, 2013 at 12:05 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `testt`
--

-- --------------------------------------------------------

--
-- Table structure for table `bt_token`
--

CREATE TABLE IF NOT EXISTS `bt_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bt_tokenstr` varchar(255) NOT NULL,
  `bt_use` tinyint(1) NOT NULL,
  `bt_date` varchar(25) NOT NULL,
  `bt_token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bt_tokenkey`
--

CREATE TABLE IF NOT EXISTS `bt_tokenkey` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bt_token` varchar(255) CHARACTER SET utf8 NOT NULL,
  `bt_stoken` varchar(255) CHARACTER SET utf8 NOT NULL,
  `bt_isvalid` tinyint(4) NOT NULL,
  `bt_userID` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bt_user`
--

CREATE TABLE IF NOT EXISTS `bt_user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `bt_em` varchar(255) NOT NULL,
  `bt_psw` varchar(255) NOT NULL,
  `bt_finm` varchar(255) NOT NULL,
  `bt_fanm` varchar(255) NOT NULL,
  `bt_sx` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
