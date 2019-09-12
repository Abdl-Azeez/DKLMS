-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2019 at 02:48 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fyp`
--

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `Id` int(50) NOT NULL,
  `StaffName` varchar(40) NOT NULL,
  `StaffID` varchar(10) NOT NULL,
  `Position` varchar(40) NOT NULL,
  `Departments` varchar(100) NOT NULL,
  `leaveType` varchar(40) NOT NULL,
  `DateFrom` varchar(125) NOT NULL,
  `DateTo` varchar(125) NOT NULL,
  `Reason` varchar(200) NOT NULL,
  `Attachment` varchar(100) NOT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Status` int(10) NOT NULL,
  `Remark` varchar(500) NOT NULL,
  `ActionDate` varchar(45) NOT NULL,
  `AdminDate` varchar(50) NOT NULL,
  `Checked` int(11) NOT NULL,
  `NoDays` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`Id`, `StaffName`, `StaffID`, `Position`, `Departments`, `leaveType`, `DateFrom`, `DateTo`, `Reason`, `Attachment`, `PostingDate`, `Status`, `Remark`, `ActionDate`, `AdminDate`, `Checked`, `NoDays`) VALUES
(13, 'Azeez Adediran', 'TECH002', 'Superior', 'TECHNICAL DEPARTMENT', '2', '2019-03-15', '2019-03-16', '', '', '2019-03-15 01:44:08', 0, '', '', '', 0, 4),
(14, 'Azeez Adediran', 'TECH001', 'Staff', 'TECHNICAL DEPARTMENT', '2', '2019-03-15', '2019-03-16', '', '', '2019-03-15 02:01:10', 1, '', '15-03-2019 10:01:51am ', '15-03-2019 11:45:33am ', 1, 2),
(15, 'Azeez Adediran Dolapo', 'TECH002', 'Superior', 'TECHNICAL DEPARTMENT', '3', '2019-03-15', '2019-03-17', '', '', '2019-03-15 03:46:40', 1, '', '', '15-03-2019 11:48:52am ', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(50) NOT NULL,
  `StaffID` varchar(10) DEFAULT NULL,
  `Username` varchar(25) DEFAULT NULL,
  `Email` varchar(40) NOT NULL,
  `Password` varchar(500) DEFAULT NULL,
  `StaffName` varchar(40) NOT NULL,
  `MobileNum` varchar(15) DEFAULT NULL,
  `Gender` char(6) NOT NULL,
  `Roles` varchar(50) NOT NULL,
  `Department` varchar(250) NOT NULL,
  `EL` int(10) NOT NULL,
  `ELtaken` int(10) NOT NULL,
  `ELbalance` int(10) DEFAULT NULL,
  `CL` int(10) NOT NULL,
  `CLtaken` int(10) NOT NULL,
  `CLbalance` int(10) DEFAULT NULL,
  `Annual` int(10) NOT NULL,
  `Annualtaken` int(10) NOT NULL,
  `Annualbalance` int(10) DEFAULT NULL,
  `OL` int(10) NOT NULL,
  `OLtaken` int(10) NOT NULL,
  `OLbalance` int(10) DEFAULT NULL,
  `ProfileImg` varchar(100) NOT NULL,
  `TOS` varchar(250) NOT NULL,
  `DSW` varchar(20) NOT NULL,
  `Token` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `StaffID`, `Username`, `Email`, `Password`, `StaffName`, `MobileNum`, `Gender`, `Roles`, `Department`, `EL`, `ELtaken`, `ELbalance`, `CL`, `CLtaken`, `CLbalance`, `Annual`, `Annualtaken`, `Annualbalance`, `OL`, `OLtaken`, `OLbalance`, `ProfileImg`, `TOS`, `DSW`, `Token`) VALUES
(1, 'DEEN-SICT', 'DEAN-SICT', 'hazeezadediran@gmail.com', '$2y$12$vRzeqsIWZPVu0MekFBBoT.0qiiWBjhCO608Rs8yG1/WEMP3PQh/dW', 'DEENSICT', '01938456', 'Male', 'Admin', 'School Of Information Communication Technology', 0, 0, NULL, 0, 0, NULL, 0, 0, NULL, 0, 0, NULL, 'WhatsApp Image 2019-03-04 at 9.34.31 PM.jpeg', 'Permanent', '', ''),
(2, 'DCS2232', 'firdaus', 'hazeezadediran@gmail.com', '$2y$12$w/sBdCVMUZe4GCKshqTBx.4VO7Soj2gaE6WTZ23wBdUDlOY0hnN7m', 'Firdaus Azlan ', '+60149671561', 'Male', 'HR', 'HR', 35, 0, 35, 35, 0, 35, 35, 0, 35, 35, 0, 35, '', 'Contract', '2008', ''),
(7, 'TECH001', 'AZEEZ', 'hazeezadediran@gmail.com', '$2y$12$K8jE6NvG8X8ifxxOcvF.R./MUtMCgYm7s8wHOKdqS4Xr.Gb7xTr96', 'Azeez Adediran', '+60149671561', 'Male', 'Staff', 'TECHNICAL DEPARTMENT', 25, 2, 25, 25, 0, 25, 25, 9, 14, 25, 0, 25, '', 'Contract', '', ''),
(13, 'TECH002', 'HAZEEZ', 'hazeezadediran@gmail.com', '$2y$12$VFFWWjpzg8xH/.uuaKhhcOShY5r87gbSJYmT7SBE6o6RG/DECXsu6', 'Azeez Adediran Dolapo', '+60149671561', 'Male', 'Superior', 'TECHNICAL DEPARTMENT', 0, 0, NULL, 10, 0, 10, 10, 0, 10, 10, 0, 10, 'hazeez2.jpg', 'Contract', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `Id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
