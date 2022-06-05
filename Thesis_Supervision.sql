-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 02, 2022 at 11:02 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Thesis_Supervision`
--

-- --------------------------------------------------------

--
-- Table structure for table `groupMembers`
--

CREATE TABLE `groupMembers` (
  `id` int(11) NOT NULL,
  `groupId` int(11) DEFAULT NULL,
  `stdId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `groupMembers`
--

INSERT INTO `groupMembers` (`id`, `groupId`, `stdId`) VALUES
(1, 1, 2),
(2, 1, 3),
(3, 1, 4),
(4, 2, 5),
(5, 2, 6),
(6, 2, 7);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `projectName` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `dateCompleted` varchar(255) DEFAULT NULL,
  `grade` varchar(255) DEFAULT NULL,
  `progress` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `projectName`, `description`, `dateCompleted`, `grade`, `progress`, `status`) VALUES
(1, 'Hate Speech Detection', 'ssssssssssss sssssssssss bbbbbbbbbbbb bbbbbbbbbbbb', '2022-06-23', '1', '100%', 1),
(2, 'Computer Vision', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', '2022-06-30', '0', '25%', 1);

-- --------------------------------------------------------

--
-- Table structure for table `groupSupervision`
--

CREATE TABLE `groupSupervision` (
  `id` int(11) NOT NULL,
  `groupId` int(11) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `groupSupervision`
--

INSERT INTO `groupSupervision` (`id`, `groupId`, `teacher_id`, `status`) VALUES
(1, 1, 11, 0),
(2, 2, 11, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'admin', 'admin@gmail.com', '12345', 'admin'),
(2, 'aaa', 'aaa@gmail.com', '12345', 'student'),
(3, 'bbb', 'bbb@gmail.com', '12345', 'student'),
(4, 'ccc', 'ccc@gmail.com', '12345', 'student'),
(5, 'ddd', 'ddd@gmail.com', '12345', 'student'),
(6, 'eee', 'eee@gmail.com', '12345', 'student'),
(7, 'fff', 'fff@gmail.com', '12345', 'student'),
(8, 'ggg', 'ggg@gmail.com', '12345', 'student'),
(9, 'hhh', 'hhh@gmail.com', '12345', 'student'),
(10, 'kkk', 'kkk@gmail.com', '12345', 'student'),
(11, 't1', 't1@gmail.com', '12345', 'teacher'),
(12, 't2', 't2@gmail.com', '12345', 'teacher'),
(13, 't3', 't3@gmail.com', '12345', 'teacher'),
(14, 't4', 't4@gmail.com', '12345', 'teacher');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groupMembers`
--
ALTER TABLE `groupMembers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `groupId` (`groupId`),
  ADD KEY `stdId` (`stdId`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groupSupervision`
--
ALTER TABLE `groupSupervision`
  ADD PRIMARY KEY (`id`),
  ADD KEY `groupId` (`groupId`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groupMembers`
--
ALTER TABLE `groupMembers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `groupSupervision`
--
ALTER TABLE `groupSupervision`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `groupMembers`
--
ALTER TABLE `groupMembers`
  ADD CONSTRAINT `groupmembers_ibfk_1` FOREIGN KEY (`groupId`) REFERENCES `groups` (`id`),
  ADD CONSTRAINT `groupmembers_ibfk_2` FOREIGN KEY (`stdId`) REFERENCES `users` (`id`);

--
-- Constraints for table `groupSupervision`
--
ALTER TABLE `groupSupervision`
  ADD CONSTRAINT `groupsupervision_ibfk_1` FOREIGN KEY (`groupId`) REFERENCES `groups` (`id`),
  ADD CONSTRAINT `groupsupervision_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
