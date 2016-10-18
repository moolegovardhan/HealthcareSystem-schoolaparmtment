-- phpMyAdmin SQL Dump
-- version 4.4.9
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Jul 28, 2015 at 07:05 PM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `acl_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `app`
--

DROP TABLE IF EXISTS `app`;
CREATE TABLE `app` (
  `ID` int(11) unsigned zerofill NOT NULL,
  `restore` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

DROP TABLE IF EXISTS `appointment`;
CREATE TABLE `appointment` (
  `id` int(10) NOT NULL,
  `StaffId` int(100) NOT NULL,
  `StaffName` varchar(200) NOT NULL,
  `DoctorId` int(100) NOT NULL,
  `DoctorName` varchar(200) NOT NULL,
  `HospitalName` varchar(200) NOT NULL,
  `AppointementDate` date NOT NULL,
  `AppointmentTime` varchar(10) NOT NULL,
  `PhoneMumber` int(20) NOT NULL,
  `Address` varchar(1000) NOT NULL,
  `status` varchar(1) NOT NULL,
  `PatientId` int(100) NOT NULL,
  `PatientName` varchar(200) NOT NULL,
  `HosiptalId` bigint(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `StaffId`, `StaffName`, `DoctorId`, `DoctorName`, `HospitalName`, `AppointementDate`, `AppointmentTime`, `PhoneMumber`, `Address`, `status`, `PatientId`, `PatientName`, `HosiptalId`) VALUES
(1, 0, '', 56, 'Pavan Kumar Kuppa', 'Vijay', '2015-07-19', '10.00', 0, '', 'Y', 2, 'Patient Name', 7),
(2, 0, '', 56, 'Pavan Kumar Kuppa', 'Vijay', '2015-07-19', '3.00', 0, '', 'N', 2, 'Patient Name', 7),
(3, 0, '', 56, 'Pavan Kumar', 'Vijay', '2015-07-28', '11.30', 0, '', 'N', 56, 'Pavan Kumar', 7),
(4, 0, '', 56, 'Pavan Kumar', 'Vijay', '2015-07-28', '11.30', 0, '', 'N', 56, 'Pavan Kumar', 7),
(5, 0, '', 56, 'Pavan Kumar', 'Vijay', '2015-07-27', '9.30', 0, '', 'N', 56, 'Pavan Kumar', 7),
(6, 0, '', 56, 'Pavan Kumar', 'Vijay', '2015-07-27', '9.30', 0, '', 'Y', 2, 'Patient Name', 7),
(7, 0, '', 56, 'Pavan Kumar', 'Vijay', '2015-07-20', '10.00', 0, '', 'N', 59, 'CGH GROUP CHITRA', 7),
(8, 0, '', 76, 'Pavan Kumar', 'Vijay', '2015-07-28', '11.00', 0, '', 'N', 59, 'CGH GROUP CHITRA', 14),
(9, 0, '', 76, 'Pavan Kumar Kuppa', 'Vijay Sai Hosiptal', '2015-07-28', '11.30', 0, '', 'N', 2, 'Patient Name', 14);

-- --------------------------------------------------------

--
-- Table structure for table `consultationdiagnosisdetails`
--

DROP TABLE IF EXISTS `consultationdiagnosisdetails`;
CREATE TABLE `consultationdiagnosisdetails` (
  `id` bigint(10) NOT NULL,
  `type` varchar(20) NOT NULL,
  `namevalue` varchar(100) NOT NULL,
  `appointmentid` bigint(10) NOT NULL,
  `patientid` bigint(10) NOT NULL,
  `status` varchar(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `consultationdiagnosisdetails`
--

INSERT INTO `consultationdiagnosisdetails` (`id`, `type`, `namevalue`, `appointmentid`, `patientid`, `status`) VALUES
(1, 'DISEASES', 'Stomach', 1, 2, 'Y'),
(2, 'DISEASES', 'Leg', 1, 2, 'Y'),
(3, 'DISEASES', 'Hearth', 2, 2, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `diagnostics`
--

DROP TABLE IF EXISTS `diagnostics`;
CREATE TABLE `diagnostics` (
  `id` int(10) NOT NULL,
  `diagnosticsname` varchar(100) NOT NULL,
  `haddress` varchar(100) NOT NULL,
  `status` varchar(2) NOT NULL,
  `addressline1` varchar(100) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `landline` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `tin` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `adminid` varchar(50) NOT NULL,
  `zipcode` varchar(50) NOT NULL,
  `addressline2` varchar(100) NOT NULL,
  `createddt` date NOT NULL,
  `district` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `diagnostics`
--

INSERT INTO `diagnostics` (`id`, `diagnosticsname`, `haddress`, `status`, `addressline1`, `mobile`, `landline`, `city`, `tin`, `state`, `adminid`, `zipcode`, `addressline2`, `createddt`, `district`, `email`) VALUES
(1, 'Diagnostics', 'Address Line 1 Address Line 2', 'Y', 'Address Line 1', '99922999', '9999999', 'City', '', 'State', '', '560062', 'Address Line 2', '2015-07-26', 'District', 'email@email.com');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

DROP TABLE IF EXISTS `doctor`;
CREATE TABLE `doctor` (
  `id` bigint(10) NOT NULL,
  `doctorid` int(20) NOT NULL,
  `starttime` time NOT NULL,
  `endtime` time NOT NULL,
  `Monday` varchar(1) NOT NULL,
  `Tuesday` varchar(1) NOT NULL,
  `Wednesday` varchar(1) NOT NULL,
  `Thursday` varchar(1) NOT NULL,
  `Friday` varchar(1) NOT NULL,
  `Saturday` varchar(1) NOT NULL,
  `Sunday` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_hosiptal`
--

DROP TABLE IF EXISTS `doctor_hosiptal`;
CREATE TABLE `doctor_hosiptal` (
  `id` int(10) NOT NULL,
  `doctorid` int(10) NOT NULL,
  `hosiptalid` int(10) NOT NULL,
  `department` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `doctor_hosiptal`
--

INSERT INTO `doctor_hosiptal` (`id`, `doctorid`, `hosiptalid`, `department`) VALUES
(7, 56, 7, 'Nuclear');

-- --------------------------------------------------------

--
-- Table structure for table `healthparameters`
--

DROP TABLE IF EXISTS `healthparameters`;
CREATE TABLE `healthparameters` (
  `patientid` bigint(10) NOT NULL,
  `id` bigint(10) NOT NULL,
  `weight` varchar(10) NOT NULL,
  `height` varchar(10) NOT NULL,
  `bmi` varchar(10) NOT NULL,
  `hemoglobin` varchar(10) NOT NULL,
  `sugar` varchar(10) NOT NULL,
  `bp` varchar(10) NOT NULL,
  `createdby` varchar(10) NOT NULL,
  `createddate` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `healthparameters`
--

INSERT INTO `healthparameters` (`patientid`, `id`, `weight`, `height`, `bmi`, `hemoglobin`, `sugar`, `bp`, `createdby`, `createddate`) VALUES
(2, 4, '100', '2 Feet 3 I', '190', '7', '2000 Post ', '111', '', '2015-07-18'),
(2, 5, '111', '23', '100', '10', '900', '121', '', '2015-07-18'),
(72, 10, '100', '2 Feet 3 I', '190', '11', '130', '100', '', '2015-07-27'),
(72, 11, '100', '2 Feet 3 I', '190', '11', '130', '100', '', '2015-07-27'),
(72, 12, '100', '2 Feet 3 I', '190', '11', '130', '100', '', '2015-07-27'),
(72, 13, '100', '2 Feet 3 I', '190', '11', '130', '100', '', '2015-07-27'),
(72, 14, '100', '2 Feet 3 I', '190', '11', '130', '100', '', '2015-07-27'),
(72, 15, '100', '2 Feet 3 I', '190', '11', '130', '100', '', '2015-07-27'),
(72, 16, '100', '2 Feet 3 I', '190', '11', '130', '100', '', '2015-07-27'),
(72, 17, '100', '2 Feet 3 I', '190', '7', '2000 Post ', '1111', '', '2015-07-27'),
(72, 18, '100', '2', '2', '2', '2', '2', '', '2015-07-28'),
(72, 19, '122', '222', '222', '222', '222', '222', '', '2015-07-28'),
(72, 20, '123', '123', '123', '123', '123', '123', '', '2015-07-28'),
(72, 21, '121', '12', '121', '121', '1212', '121', '', '2015-07-28');

-- --------------------------------------------------------

--
-- Table structure for table `hosiptal`
--

DROP TABLE IF EXISTS `hosiptal`;
CREATE TABLE `hosiptal` (
  `id` int(10) NOT NULL,
  `hosiptalname` varchar(100) NOT NULL,
  `haddress` varchar(100) NOT NULL,
  `status` varchar(2) NOT NULL,
  `addressline1` varchar(100) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `landline` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `tin` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `adminid` varchar(50) NOT NULL,
  `zipcode` varchar(50) NOT NULL,
  `addressline2` varchar(100) NOT NULL,
  `createddt` date NOT NULL,
  `district` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hosiptal`
--

INSERT INTO `hosiptal` (`id`, `hosiptalname`, `haddress`, `status`, `addressline1`, `mobile`, `landline`, `city`, `tin`, `state`, `adminid`, `zipcode`, `addressline2`, `createddt`, `district`, `email`) VALUES
(7, 'Vijay Hospital', '', 'Y', 'Address Line 1', '7777777', '7777777', 'City', '', 'State', '', '560062', 'Address Line 2', '0000-00-00', 'District', 'vijay@email.com'),
(14, 'Vijay Sai Hosiptal', '', 'Y', 'Flat no 205,Unicon Foland,Reshmi Nagara, 2nd Main,', '7777777', '234567890', 'Bangalore', '', 'Karnataka', '', '560062', ' Vajrahalli road, Off Kankapura road, Bangalore', '2015-07-14', 'Bangalore', 'emailid@email.com'),
(15, 'Vijay', 'Flat no 205,Unicon Foland,Reshmi Nagara, 2nd Main, Vajrahalli road, Off Kankapura road, Bangalore', 'Y', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

DROP TABLE IF EXISTS `medicines`;
CREATE TABLE `medicines` (
  `patientid` bigint(10) NOT NULL,
  `id` bigint(10) NOT NULL,
  `medicinename` varchar(100) NOT NULL,
  `MBF` varchar(2) DEFAULT NULL,
  `MAF` varchar(2) DEFAULT NULL,
  `ABF` varchar(2) DEFAULT NULL,
  `AAF` varchar(2) DEFAULT NULL,
  `EBF` varchar(2) DEFAULT NULL,
  `EAF` varchar(2) DEFAULT NULL,
  `appointmentid` bigint(10) NOT NULL,
  `noofdays` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `patienttests`
--

DROP TABLE IF EXISTS `patienttests`;
CREATE TABLE `patienttests` (
  `id` bigint(10) NOT NULL,
  `patientid` bigint(10) NOT NULL,
  `testname` varchar(100) NOT NULL,
  `status` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `patienttranscripts`
--

DROP TABLE IF EXISTS `patienttranscripts`;
CREATE TABLE `patienttranscripts` (
  `id` bigint(10) NOT NULL,
  `patientid` bigint(10) NOT NULL,
  `appointmentid` bigint(10) NOT NULL,
  `reportname` varchar(50) NOT NULL,
  `filename` varchar(50) NOT NULL,
  `path` varchar(1000) NOT NULL,
  `reporttype` varchar(20) NOT NULL,
  `status` varchar(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patienttranscripts`
--

INSERT INTO `patienttranscripts` (`id`, `patientid`, `appointmentid`, `reportname`, `filename`, `path`, `reporttype`, `status`) VALUES
(1, 2, 1, '', 'IMG-20150614-WA0026.jpg', 'Transcripts/Patient Name/Reports', '', ''),
(2, 2, 1, '', 'IMG-20150615-WA0000.jpg', 'Transcripts/Patient Name/Reports', '', ''),
(3, 2, 1, '', 'IMG-20150614-WA0025.jpg', 'Transcripts/Patient Name/Prescription', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `ID` bigint(20) unsigned zerofill NOT NULL,
  `permKey` varchar(30) NOT NULL,
  `permName` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`ID`, `permKey`, `permName`) VALUES
(00000000000000000001, 'access_site', 'Access Site'),
(00000000000000000002, 'access_admin', 'Access Admin System'),
(00000000000000000003, 'publish_articles', 'Publish Articles'),
(00000000000000000004, 'publish_events', 'Publish Events'),
(00000000000000000005, 'install_modules', 'Install Modules'),
(00000000000000000006, 'post_comments', 'Post Comments'),
(00000000000000000007, 'access_premium_content', 'Access Premium Content'),
(00000000000000000008, 'limited_admin', 'Limited Admin');

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

DROP TABLE IF EXISTS `prescription`;
CREATE TABLE `prescription` (
  `id` bigint(10) NOT NULL,
  `appointmentid` bigint(10) NOT NULL,
  `patientid` bigint(10) NOT NULL,
  `patientname` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `doctorid` bigint(10) NOT NULL,
  `hositpalid` bigint(10) NOT NULL,
  `appointmentdt` date NOT NULL,
  `nextappointmentdt` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`id`, `appointmentid`, `patientid`, `patientname`, `description`, `doctorid`, `hositpalid`, `appointmentdt`, `nextappointmentdt`) VALUES
(1, 1, 2, 'Pavan Kumar', 'Test For Consultation', 56, 25, '2015-07-07', '2015-07-29'),
(2, 2, 2, 'Pavan Kumar', 'Test For Consultation', 58, 25, '2015-07-29', '2015-08-05');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `ID` bigint(20) unsigned zerofill NOT NULL,
  `roleName` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`ID`, `roleName`) VALUES
(00000000000000000001, 'Administrators'),
(00000000000000000002, 'All Users'),
(00000000000000000003, 'Authors'),
(00000000000000000007, 'Doctor'),
(00000000000000000005, 'Patient'),
(00000000000000000004, 'Premium Members'),
(00000000000000000006, 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `role_perms`
--

DROP TABLE IF EXISTS `role_perms`;
CREATE TABLE `role_perms` (
  `ID` bigint(20) unsigned zerofill NOT NULL,
  `roleID` bigint(20) NOT NULL,
  `permID` bigint(20) NOT NULL,
  `value` tinyint(1) NOT NULL DEFAULT '0',
  `addDate` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role_perms`
--

INSERT INTO `role_perms` (`ID`, `roleID`, `permID`, `value`, `addDate`) VALUES
(00000000000000000016, 1, 2, 1, '2009-03-02 17:13:21'),
(00000000000000000017, 1, 7, 1, '2009-03-02 17:13:21'),
(00000000000000000018, 1, 1, 1, '2009-03-02 17:13:21'),
(00000000000000000019, 1, 5, 1, '2009-03-02 17:13:21'),
(00000000000000000020, 1, 8, 1, '2009-03-02 17:13:21'),
(00000000000000000021, 1, 6, 1, '2009-03-02 17:13:21'),
(00000000000000000022, 1, 3, 1, '2009-03-02 17:13:21'),
(00000000000000000023, 1, 4, 1, '2009-03-02 17:13:21'),
(00000000000000000024, 2, 1, 1, '2009-03-02 17:13:31'),
(00000000000000000025, 3, 7, 1, '2009-03-02 17:13:38'),
(00000000000000000026, 3, 8, 1, '2009-03-02 17:13:38'),
(00000000000000000027, 3, 6, 1, '2009-03-02 17:13:38'),
(00000000000000000028, 3, 3, 1, '2009-03-02 17:13:38'),
(00000000000000000029, 3, 4, 1, '2009-03-02 17:13:38'),
(00000000000000000030, 4, 7, 1, '2009-03-02 17:13:42'),
(00000000000000000031, 4, 6, 1, '2009-03-02 17:13:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `ID` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `altmobile` varchar(10) NOT NULL,
  `profession` varchar(10) DEFAULT NULL,
  `address` varchar(1000) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(20) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `aadharcard` varchar(20) NOT NULL,
  `addressline1` varchar(100) NOT NULL,
  `addressline2` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `officeid` bigint(10) NOT NULL,
  `createdby` varchar(10) NOT NULL,
  `createddate` date NOT NULL,
  `status` varchar(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `username`, `password`, `email`, `mobile`, `altmobile`, `profession`, `address`, `name`, `middlename`, `lastname`, `firstname`, `dob`, `gender`, `city`, `state`, `zipcode`, `aadharcard`, `addressline1`, `addressline2`, `district`, `officeid`, `createdby`, `createddate`, `status`) VALUES
(1, 'staff', 'hanuman', 'kpavan16@gmail.com', '7760059002', '', 'Staff', 'Flat no 205,Unicon Foland,Reshmi Nagara, 2nd Main, Vajrahalli road, Off Kankapura road, Bangalore', 'CHS Hospital Staff', 'Staff Middle', 'Staff Last', 'Staff First', '2015-07-01', 'male', 'City', 'State', '560062', 'AAD001', 'ADDRESS LINE 1', 'ADDRESS LINE 2', 'Bangalore', 14, '', '0000-00-00', 'N'),
(2, 'patient', 'hanuman', 'kpavan18@gmail.com', '+917760059004', '0776005900', 'Others', 'Flat no 205,Unicon Foland,Reshmi Nagara, 2nd Main, Vajrahalli road, Off Kankapura road, Hyderabad', 'Patient Name', 'Patient Middle', 'Patient Last', 'Patient First', '2015-07-02', 'male', 'City', 'State', '560062', 'AAD002', 'ADDRESS LINE 1', 'ADDRESS LINE 2', 'Karnataka', 0, '', '0000-00-00', 'N'),
(25, 'vijaya', 'hanuman', 'kpavan18@gmail.com', '+917760059005', '22222', 'Hosiptal', 'ADDRESS LINE 1 ADDRESS LINE 2', 'Patient First Patient Middle Patient Last', 'Patient Middle', 'Patient Last', 'Patient First', '0000-00-00', 'male', 'City', 'State', '560062', 'AAD003', 'ADDRESS LINE 1', 'ADDRESS LINE 2', 'Karnataka', 0, '', '0000-00-00', 'N'),
(49, 'srirama', 'hanuman', 'sri@yahoo.com', '999999', '', 'Lab', 'Flat no 205,Unicon Foland,Reshmi Nagara, 2nd Main, Vajrahalli road, Off Kankapura road, Bangalore', 'Sri Rama', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', 0, '', '0000-00-00', 'N'),
(56, 'doctor', 'hanuman', 'kpavan16@hotmail.com', '07760059002', '7760059002', 'Doctor', 'Flat no 205,Unicon Foland,Reshmi Nagara, 2nd Main, Vajrahalli road, Off Kankapura road, Bangalore', 'Pavan Kumar', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', 0, '', '0000-00-00', 'N'),
(57, 'pavan', 'hanuman', 'pranav@yahoo.com', '9999999', '', 'Others', 'Plot No 16/1 Srinivasapura', 'Pranav SaiSri', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', 0, '', '0000-00-00', 'N'),
(58, 'pranav', 'hanuman', 'vani@yahoo.com', '999999', '', 'Staff', 'Plot No 16/1 Srinivasapura', 'Sri Vani', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', 0, '', '0000-00-00', 'N'),
(59, 'CGHGROUP', 'saihanuman', 'kpavan16@hotmail.com', '07760059006', '', 'Others', 'Plot No 16/1 Srinivasapura ADDRESS LINE 2', 'CGH GROUP CHITRA', 'GROUP', 'CHITRA', 'CGH', '0000-00-00', 'male', 'Bangalore', 'Karnataka', '560062', 'AAD002', 'Plot No 16/1 Srinivasapura', 'ADDRESS LINE 2', 'Bangalore', 0, '', '0000-00-00', 'N'),
(60, 'CHITRAGROUP', 'hanuman', 'kpavan16@hotmail.com', '07760059002', '', 'Staff', 'Flat no 205,Unicon Foland,Reshmi Nagara, 2nd Main, Vajrahalli road, Off Kankapura road, Bangalore AADRESS2', 'CGH GROUP CHITRA', 'GROUP', 'CHITRA', 'CGH', '2015-07-06', 'male', 'Bangalore', 'Karnataka', '560062', 'AAD001', 'Flat no 205,Unicon Foland,Reshmi Nagara, 2nd Main, Vajrahalli road, Off Kankapura road, Bangalore', 'AADRESS2', 'DISTRICT', 0, '', '0000-00-00', 'N'),
(61, 'KRISHNAGROUP', 'HANUMAN', 'kpavan16@hotmail.com', '07760059002', '', 'Staff', 'Flat no 205,Unicon Foland,Reshmi Nagara, 2nd Main, Vajrahalli road, Off Kankapura road, Bangalore ADDRESS2', 'Pavan Kumar Kuppa', 'Kumar', 'Kuppa', 'Pavan', '2015-07-28', 'male', 'Bangalore', 'Karnataka', '560062', 'AAD001', 'Flat no 205,Unicon Foland,Reshmi Nagara, 2nd Main, Vajrahalli road, Off Kankapura road, Bangalore', 'ADDRESS2', 'DISTRICT', 0, '', '0000-00-00', 'N'),
(62, 'SASGROUP', 'HANUMAN', 'kpavan16@hotmail.com', '07760059002', '', 'Staff', 'Flat no 205,Unicon Foland,Reshmi Nagara, 2nd Main, Vajrahalli road, Off Kankapura road, Bangalore AADRESS2', 'Pavan Kumar Kuppa', 'Kumar', 'Kuppa', 'Pavan', '2015-07-27', 'male', 'Bangalore', 'Karnataka', '560062', 'AAD001', 'Flat no 205,Unicon Foland,Reshmi Nagara, 2nd Main, Vajrahalli road, Off Kankapura road, Bangalore', 'AADRESS2', 'DISTRICT', 0, '', '0000-00-00', 'N'),
(63, 'PavanUser', 'hanuman', 'kpavan@kpavan.com', '7760059002', '', 'Staff', 'Flat no 205,Unicon Foland,Reshmi Nagara, 2nd Main, Vajrahalli road, Off Kankapura road, Bangalore 16/1', 'Pavan First Pavan Middle Pavan Last', 'Pavan Middle', 'Pavan Last', 'Pavan First', '2015-07-19', '2015-07-19', 'AAD001', 'Karnataka', '560062', 'male', 'Flat no 205,Unicon Foland,Reshmi Nagara, 2nd Main, Vajrahalli road, Off Kankapura road, Bangalore', '16/1', 'Bangalore', 0, '', '0000-00-00', 'N'),
(64, 'cgh', 'hanuman', 'kpavan16@hotmail.com', '07760059002', '', 'Staff', 'Flat no 205,Unicon Foland,Reshmi Nagara, 2nd Main, Vajrahalli road, Off Kankapura road, Bangalore Address Line 2', 'CGH First CGH Middle CGH Last', 'CGH Middle', 'CGH Last', 'CGH First', '2015-07-20', 'male', 'Bangalore', 'Karnataka', '560062', 'ADDHAR001', 'Flat no 205,Unicon Foland,Reshmi Nagara, 2nd Main, Vajrahalli road, Off Kankapura road, Bangalore', 'Address Line 2', 'Bangalore', 0, '', '0000-00-00', 'N'),
(68, 'cghtech', 'hanuman', 'kpavan16@hotmail.com', '07760059002', '', 'Others', 'Flat no 205,Unicon Foland,Reshmi Nagara, 2nd Main, Vajrahalli road, Off Kankapura road, Bangalore Address Line 2', 'Pavan Kumar Kuppa', 'Kumar', 'Kuppa', 'Pavan', '2015-07-20', 'male', 'Bangalore', 'Karnataka', '560062', 'AAD001', 'Flat no 205,Unicon Foland,Reshmi Nagara, 2nd Main, Vajrahalli road, Off Kankapura road, Bangalore', 'Address Line 2', 'Bangalore', 0, '', '0000-00-00', 'N'),
(69, 'superadmin', 'hanuman', 'kpavan16@gmail.com', '7760059002', '7760059002', 'superadmin', 'CGH', 'Super Admin', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', 0, '', '0000-00-00', 'Y'),
(71, 'vijayaadmin', 'hanuman', 'kpavan16@hotmail.com', '07760059002', '', 'Staff', 'Flat no 205,Unicon Foland,Reshmi Nagara, 2nd Main, Vajrahalli road, Off Kankapura road, Bangalore Address Line 2', 'Vijaya Staff Hospital Admin', 'Hospital', 'Admin', 'Vijaya Staff', '2015-07-28', 'male', 'Bangalore', 'Karnataka', '560062', 'AAD001', 'Flat no 205,Unicon Foland,Reshmi Nagara, 2nd Main, Vajrahalli road, Off Kankapura road, Bangalore', 'Address Line 2', 'Bangalore', 14, '', '0000-00-00', 'Y'),
(72, 'vijayapatient', 'hanuman', 'kpavan16@hotmail.com', '07760059002', '', 'Others', 'Flat no 205,Unicon Foland,Reshmi Nagara, 2nd Main, Vajrahalli road, Off Kankapura road, Bangalore Address Line 2', 'First name Middle name Last name', 'Middle name', 'Last name', 'First name', '2015-07-27', 'female', 'Bangalore', 'Karnataka', '560062', 'AAD001', 'Flat no 205,Unicon Foland,Reshmi Nagara, 2nd Main, Vajrahalli road, Off Kankapura road, Bangalore', 'Address Line 2', 'District', 14, '', '0000-00-00', 'Y'),
(76, 'vijayadoctor', 'hanuman', 'kpavan16@hotmail.com', '07760059002', '', 'Doctor', 'Flat no 205,Unicon Foland,Reshmi Nagara, 2nd Main, Vajrahalli road, Off Kankapura road, Bangalore Address Line 2', 'Pavan Kumar Kuppa', 'Kumar', 'Kuppa', 'Pavan', '2015-07-27', 'male', 'Bangalore', 'Karnataka', '560062', 'AAD002', 'Flat no 205,Unicon Foland,Reshmi Nagara, 2nd Main, Vajrahalli road, Off Kankapura road, Bangalore', 'Address Line 2', 'District', 14, '', '0000-00-00', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `user_perms`
--

DROP TABLE IF EXISTS `user_perms`;
CREATE TABLE `user_perms` (
  `ID` bigint(20) unsigned zerofill NOT NULL,
  `userID` bigint(20) NOT NULL,
  `permID` bigint(20) NOT NULL,
  `value` tinyint(1) NOT NULL DEFAULT '0',
  `addDate` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_perms`
--

INSERT INTO `user_perms` (`ID`, `userID`, `permID`, `value`, `addDate`) VALUES
(00000000000000000001, 1, 2, 1, '2015-07-07 09:32:57'),
(00000000000000000002, 1, 7, 1, '2015-07-07 09:32:57'),
(00000000000000000003, 1, 1, 1, '2015-07-07 09:32:57'),
(00000000000000000004, 1, 5, 1, '2015-07-07 09:32:57'),
(00000000000000000005, 1, 6, 1, '2015-07-07 09:32:57');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
CREATE TABLE `user_roles` (
  `userID` bigint(20) NOT NULL,
  `roleID` bigint(20) NOT NULL,
  `addDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`userID`, `roleID`, `addDate`) VALUES
(1, 1, '2009-03-02 17:14:45'),
(1, 2, '2009-03-02 17:14:45'),
(2, 2, '2009-03-02 17:27:23'),
(2, 3, '2009-03-02 17:27:23'),
(3, 2, '2009-03-02 17:27:05'),
(4, 2, '2009-03-02 17:27:32'),
(4, 4, '2009-03-02 17:27:32'),
(5, 5, '2015-07-09 21:41:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app`
--
ALTER TABLE `app`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `consultationdiagnosisdetails`
--
ALTER TABLE `consultationdiagnosisdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diagnostics`
--
ALTER TABLE `diagnostics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor_hosiptal`
--
ALTER TABLE `doctor_hosiptal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `healthparameters`
--
ALTER TABLE `healthparameters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hosiptal`
--
ALTER TABLE `hosiptal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patienttests`
--
ALTER TABLE `patienttests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patienttranscripts`
--
ALTER TABLE `patienttranscripts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `permKey` (`permKey`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `roleName` (`roleName`);

--
-- Indexes for table `role_perms`
--
ALTER TABLE `role_perms`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `roleID_2` (`roleID`,`permID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Username` (`username`);

--
-- Indexes for table `user_perms`
--
ALTER TABLE `user_perms`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `userID` (`userID`,`permID`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD UNIQUE KEY `userID` (`userID`,`roleID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app`
--
ALTER TABLE `app`
  MODIFY `ID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `consultationdiagnosisdetails`
--
ALTER TABLE `consultationdiagnosisdetails`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `diagnostics`
--
ALTER TABLE `diagnostics`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `doctor_hosiptal`
--
ALTER TABLE `doctor_hosiptal`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `healthparameters`
--
ALTER TABLE `healthparameters`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `hosiptal`
--
ALTER TABLE `hosiptal`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `patienttests`
--
ALTER TABLE `patienttests`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `patienttranscripts`
--
ALTER TABLE `patienttranscripts`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `ID` bigint(20) unsigned zerofill NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `ID` bigint(20) unsigned zerofill NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `role_perms`
--
ALTER TABLE `role_perms`
  MODIFY `ID` bigint(20) unsigned zerofill NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT for table `user_perms`
--
ALTER TABLE `user_perms`
  MODIFY `ID` bigint(20) unsigned zerofill NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
