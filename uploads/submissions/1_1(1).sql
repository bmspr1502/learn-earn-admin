-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: remotemysql.com
-- Generation Time: Jun 16, 2021 at 05:37 AM
-- Server version: 8.0.13-4
-- PHP Version: 7.2.24-0ubuntu0.18.04.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lO4zmJJqK1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_details`
--

CREATE TABLE `admin_details` (
  `Admin_Id` int(10) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Email` varchar(20) NOT NULL,
  `Phone` int(10) NOT NULL,
  `Bio` text NOT NULL,
  `Qualifications` text NOT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `Admin_Id` int(10) NOT NULL,
  `Password` varchar(20) NOT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `admin_student_mapping`
--

CREATE TABLE `admin_student_mapping` (
  `Admin_Id` int(10) NOT NULL,
  `Student_Id` int(10) NOT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `student_details`
--

CREATE TABLE `student_details` (
  `Student_Id` int(10) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Bio` text NOT NULL,
  `Mentor` int(10) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Phone` int(10) NOT NULL,
  `A/C number` int(20) NOT NULL,
  `Amount` int(10) NOT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `student_login`
--

CREATE TABLE `student_login` (
  `Student_Id` int(10) NOT NULL,
  `Password` varchar(20) NOT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `student_notification`
--

CREATE TABLE `student_notification` (
  `Student_Id` int(10) NOT NULL,
  `Content` text NOT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `super_admin`
--

CREATE TABLE `super_admin` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `super_admin`
--

INSERT INTO `super_admin` (`username`, `password`) VALUES
('jj', 'll'),
('viswa', 'prasad'),
('viswa', 'prasad'),
('viswa', 'prasad'),
('viswa', 'prasad'),
('viswa', 'prasad'),
('ria', 'kapur'),
('ria', 'kapur'),
('viswa', 'prasad');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `Task_id` int(10) NOT NULL,
  `mentor_id` int(10) NOT NULL,
  `Student_id` int(10) NOT NULL,
  `Task_Question` text NOT NULL,
  `Task_Result` text NOT NULL,
  `Task_Status` int(1) NOT NULL,
  `Submission_file` text NOT NULL,
  `Due_Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Submission_date_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Marks` int(3) NOT NULL,
  `Comment` text NOT NULL
);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_details`
--
ALTER TABLE `admin_details`
  ADD KEY `Admin_Id` (`Admin_Id`);

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`Admin_Id`);

--
-- Indexes for table `admin_student_mapping`
--
ALTER TABLE `admin_student_mapping`
  ADD KEY `Admin_Id` (`Admin_Id`),
  ADD KEY `Student_Id` (`Student_Id`);

--
-- Indexes for table `student_details`
--
ALTER TABLE `student_details`
  ADD KEY `Student_Id` (`Student_Id`);

--
-- Indexes for table `student_login`
--
ALTER TABLE `student_login`
  ADD PRIMARY KEY (`Student_Id`);

--
-- Indexes for table `student_notification`
--
ALTER TABLE `student_notification`
  ADD KEY `Student_Id` (`Student_Id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`Task_id`),
  ADD KEY `Student_id` (`Student_id`),
  ADD KEY `mentor_id` (`mentor_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_details`
--
ALTER TABLE `admin_details`
  ADD CONSTRAINT `admin_details_ibfk_1` FOREIGN KEY (`Admin_Id`) REFERENCES `admin_login` (`admin_id`);

--
-- Constraints for table `admin_student_mapping`
--
ALTER TABLE `admin_student_mapping`
  ADD CONSTRAINT `admin_student_mapping_ibfk_1` FOREIGN KEY (`Admin_Id`) REFERENCES `admin_login` (`admin_id`),
  ADD CONSTRAINT `admin_student_mapping_ibfk_2` FOREIGN KEY (`Student_Id`) REFERENCES `student_login` (`student_id`);

--
-- Constraints for table `student_details`
--
ALTER TABLE `student_details`
  ADD CONSTRAINT `student_details_ibfk_1` FOREIGN KEY (`Student_Id`) REFERENCES `student_login` (`student_id`);

--
-- Constraints for table `student_notification`
--
ALTER TABLE `student_notification`
  ADD CONSTRAINT `student_notification_ibfk_1` FOREIGN KEY (`Student_Id`) REFERENCES `student_login` (`student_id`);

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`Student_id`) REFERENCES `student_login` (`student_id`),
  ADD CONSTRAINT `tasks_ibfk_2` FOREIGN KEY (`mentor_id`) REFERENCES `admin_login` (`admin_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
