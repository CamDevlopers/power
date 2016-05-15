-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 15, 2016 at 08:08 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `aeu-lamp`

-- --------------------------------------------------------

--
-- Table structure for table `tbl_equipments`
--

CREATE TABLE IF NOT EXISTS `tbl_equipments` (
  `eid` int(11) NOT NULL AUTO_INCREMENT,
  `etype` int(11) DEFAULT NULL COMMENT 'type = 1 is lamp, type = 2 is air',
  `ename` varchar(100) DEFAULT NULL,
  `eremote` int(11) DEFAULT '0',
  `eremoter` int(11) NOT NULL DEFAULT '0',
  `rid` int(11) NOT NULL,
  PRIMARY KEY (`eid`),
  KEY `fk_tbl_equipments_tbl_rooms1_idx` (`rid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `tbl_equipments`
--

INSERT INTO `tbl_equipments` (`eid`, `etype`, `ename`, `eremote`, `eremoter`, `rid`) VALUES
(1, 1, 'អំពូល', 0, 0, 1),
(2, 2, 'ម.ត្រជាក់', 0, 0, 1),
(3, 2, 'ម.ត្រជាក់', 0, 0, 1),
(4, 1, 'អំពូល', 0, 0, 2),
(5, 2, 'ម.ត្រជាក់', 0, 0, 2),
(6, 2, 'ម.ត្រជាក់', 0, 0, 2),
(7, 1, 'អំពូល', 0, 0, 3),
(8, 2, 'ម.ត្រជាក់', 0, 0, 3),
(9, 2, 'ម.ត្រជាក់', 0, 0, 3),
(10, 1, 'អំពូល', 0, 0, 4),
(11, 2, 'ម.ត្រជាក់', 0, 0, 4),
(12, 2, 'ម.ត្រជាក់', 0, 0, 4),
(13, 1, 'អំពូល', 0, 0, 5),
(14, 2, 'ម.ត្រជាក់', 0, 0, 5),
(15, 2, 'ម.ត្រជាក់', 0, 0, 5),
(16, 1, 'អំពូល', 0, 0, 6),
(17, 2, 'ម.ត្រជាក់', 0, 0, 6),
(18, 2, 'ម.ត្រជាក់', 0, 0, 6),
(19, 1, 'អំពូល', 0, 0, 7),
(20, 2, 'ម.ត្រជាក់', 0, 0, 7),
(21, 2, 'ម.ត្រជាក់', 0, 0, 7),
(22, 2, 'ម.ត្រជាក់', 0, 0, 7),
(23, 2, 'ម.ត្រជាក់', 0, 0, 7),
(24, 1, 'អំពូល', 0, 0, 8),
(25, 2, 'ម.ត្រជាក់', 0, 0, 8),
(26, 2, 'ម.ត្រជាក់', 0, 0, 8),
(27, 2, 'ម.ត្រជាក់', 0, 0, 8),
(28, 2, 'ម.ត្រជាក់', 0, 0, 8);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_floors`
--

CREATE TABLE IF NOT EXISTS `tbl_floors` (
  `fid` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`fid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_floors`
--

INSERT INTO `tbl_floors` (`fid`, `fname`) VALUES
(1, 'ជាន់ទី៥'),
(2, 'ជាន់ទី៦'),
(3, 'ជាន់ទី៧');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rooms`
--

CREATE TABLE IF NOT EXISTS `tbl_rooms` (
  `rid` int(11) NOT NULL AUTO_INCREMENT,
  `rname` varchar(400) DEFAULT NULL,
  `fid` int(11) NOT NULL,
  PRIMARY KEY (`rid`),
  KEY `fk_tbl_rooms_tbl_floors_idx` (`fid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_rooms`
--

INSERT INTO `tbl_rooms` (`rid`, `rname`, `fid`) VALUES
(1, 'បន្ទប់ G05-01', 1),
(2, 'បន្ទប់ G05-02', 1),
(3, 'បន្ទប់ G05-03', 1),
(4, 'បន្ទប់ G05-04', 1),
(5, 'បន្ទប់ G05-05', 1),
(6, 'បន្ទប់ G05-06', 1),
(7, 'បន្ទប់ G06-06', 2),
(8, 'បន្ទប់ G07-04', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(45) DEFAULT NULL,
  `uauthename` varchar(45) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`uid`, `uname`, `uauthename`, `password`) VALUES
(1, 'Vannakpanha', 'admin', 'fcea920f7412b5da7be0cf42b8c93759');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_equipments`
--
ALTER TABLE `tbl_equipments`
  ADD CONSTRAINT `fk_tbl_equipments_tbl_rooms1` FOREIGN KEY (`rid`) REFERENCES `tbl_rooms` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_rooms`
--
ALTER TABLE `tbl_rooms`
  ADD CONSTRAINT `fk_tbl_rooms_tbl_floors` FOREIGN KEY (`fid`) REFERENCES `tbl_floors` (`fid`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
