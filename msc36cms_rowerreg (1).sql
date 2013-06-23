-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 09, 2012 at 08:20 AM
-- Server version: 5.0.95
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `msc36cms_rowerreg`
--

-- --------------------------------------------------------

--
-- Table structure for table `agestatus`
--

CREATE TABLE IF NOT EXISTS `agestatus` (
  `agestatusid` int(8) NOT NULL auto_increment,
  `agestatus` varchar(150) NOT NULL,
  PRIMARY KEY  (`agestatusid`),
  UNIQUE KEY `agestatus` (`agestatus`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `agestatus`
--

INSERT INTO `agestatus` (`agestatusid`, `agestatus`) VALUES
(1, 'Junior 14'),
(2, 'Junior 15'),
(5, 'Junior 16'),
(9, 'Junior 18 A'),
(6, 'Junior 18 B'),
(14, 'Masters Level A'),
(15, 'Masters Level B'),
(16, 'Masters Level C'),
(17, 'Masters Level D'),
(18, 'Masters Level E'),
(19, 'Masters Level F'),
(20, 'Masters Level G'),
(21, 'Masters Level H'),
(22, 'Over 23'),
(10, 'Under 20'),
(13, 'Under 23');

-- --------------------------------------------------------

--
-- Table structure for table `club`
--

CREATE TABLE IF NOT EXISTS `club` (
  `clubid` tinyint(2) NOT NULL auto_increment,
  `club` varchar(150) NOT NULL,
  PRIMARY KEY  (`clubid`),
  UNIQUE KEY `club` (`club`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `club`
--

INSERT INTO `club` (`clubid`, `club`) VALUES
(4, 'Athlunkard Boat Club'),
(3, 'Castleconnel Boat Club'),
(2, 'Shannon Rowing Club'),
(1, 'St.Michaels Rowing Club'),
(5, 'University of Limerick Rowing Club');

-- --------------------------------------------------------

--
-- Table structure for table `scullstatus`
--

CREATE TABLE IF NOT EXISTS `scullstatus` (
  `scullstatusid` int(8) NOT NULL auto_increment,
  `scullstatus` varchar(150) NOT NULL,
  PRIMARY KEY  (`scullstatusid`),
  UNIQUE KEY `scullstatus` (`scullstatus`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `scullstatus`
--

INSERT INTO `scullstatus` (`scullstatusid`, `scullstatus`) VALUES
(3, 'Inter 1'),
(4, 'Inter 2'),
(1, 'Novice 1'),
(2, 'Novice 2'),
(7, 'Senior');

-- --------------------------------------------------------

--
-- Table structure for table `sweepstatus`
--

CREATE TABLE IF NOT EXISTS `sweepstatus` (
  `sweepstatusid` int(8) NOT NULL auto_increment,
  `sweepstatus` varchar(150) NOT NULL,
  PRIMARY KEY  (`sweepstatusid`),
  UNIQUE KEY `sweepstatus` (`sweepstatus`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `sweepstatus`
--

INSERT INTO `sweepstatus` (`sweepstatusid`, `sweepstatus`) VALUES
(3, 'Inter 1'),
(4, 'Inter 2'),
(1, 'Novice 1'),
(2, 'Novice 2'),
(5, 'Senior');

-- --------------------------------------------------------

--
-- Table structure for table `userlevel`
--

CREATE TABLE IF NOT EXISTS `userlevel` (
  `userlevelid` int(8) NOT NULL auto_increment,
  `userlevel` varchar(150) NOT NULL,
  PRIMARY KEY  (`userlevelid`),
  UNIQUE KEY `userlevel` (`userlevel`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `userlevel`
--

INSERT INTO `userlevel` (`userlevelid`, `userlevel`) VALUES
(1, 'Admin'),
(2, 'Coach'),
(3, 'Rower');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userid` int(8) NOT NULL auto_increment,
  `username` varchar(30) NOT NULL,
  `password` varchar(150) NOT NULL,
  `userlevel` int(8) NOT NULL,
  `email` varchar(50) NOT NULL,
  `agestatus` tinyint(2) NOT NULL,
  `scullstatus` tinyint(2) NOT NULL,
  `sweepstatus` tinyint(2) NOT NULL,
  `club` tinyint(2) NOT NULL,
  PRIMARY KEY  (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `password`, `userlevel`, `email`, `agestatus`, `scullstatus`, `sweepstatus`, `club`) VALUES
(19, 'Tom Brett', 'qwerty1', 1, 'admin@gmail.com', 22, 4, 4, 1),
(20, 'Tom Brett', 'qwerty1', 2, 'coach@gmail.com', 22, 4, 2, 1),
(21, 'Tom Brett', 'qwerty1', 3, 'rower@gmail.com', 22, 1, 4, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
