-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 08, 2015 at 07:08 PM
-- Server version: 5.5.41-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `Mapping`
--

-- --------------------------------------------------------

--
-- Table structure for table `Alumni`
--

CREATE TABLE IF NOT EXISTS `Alumni` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `AID` int(11) NOT NULL,
  `ITP1` int(11) NOT NULL,
  `ITP2` int(11) NOT NULL,
  `SLOT` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `AID` (`AID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `AlumniAdded`
--

CREATE TABLE IF NOT EXISTS `AlumniAdded` (
  `AID` int(11) NOT NULL AUTO_INCREMENT,
  `emailid` varchar(50) NOT NULL,
  `phoneno` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `degree` varchar(30) NOT NULL,
  `department` varchar(30) NOT NULL,
  `currentposition` varchar(50) NOT NULL,
  `company` varchar(50) NOT NULL,
  `YOP` int(11) NOT NULL,
  PRIMARY KEY (`AID`),
  UNIQUE KEY `emailid` (`emailid`,`phoneno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Students`
--

CREATE TABLE IF NOT EXISTS `Students` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `rollno` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phoneno` varchar(30) NOT NULL,
  `ITP1` int(11) NOT NULL,
  `ITP2` int(11) NOT NULL,
  `ITP3` int(11) NOT NULL,
  `SP1` int(11) NOT NULL,
  `SP2` int(11) NOT NULL,
  `degree` varchar(30) NOT NULL,
  `department` varchar(30) NOT NULL,
  PRIMARY KEY (`sid`),
  UNIQUE KEY `username` (`username`,`rollno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Alumni`
--
ALTER TABLE `Alumni`
  ADD CONSTRAINT `Alumni_ibfk_1` FOREIGN KEY (`AID`) REFERENCES `AlumniAdded` (`AID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
