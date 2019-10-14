-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 14, 2019 at 12:46 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlinepublishing`
--

-- --------------------------------------------------------

--
-- Table structure for table `op_articles`
--

CREATE TABLE `op_articles` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  `title` text NOT NULL,
  `body` longblob NOT NULL,
  `category` varchar(20) NOT NULL,
  `img` longblob NOT NULL,
  `up_timestamp` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `op_remarks`
--

CREATE TABLE `op_remarks` (
  `id` int(255) NOT NULL,
  `target_id` int(255) NOT NULL,
  `body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `op_tokens`
--

CREATE TABLE `op_tokens` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `token` varchar(32) NOT NULL,
  `expiration` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `op_users`
--

CREATE TABLE `op_users` (
  `id` int(10) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `studentId` varchar(20) NOT NULL,
  `pw` varchar(32) NOT NULL,
  `role` varchar(10) NOT NULL,
  `token` varchar(32) NOT NULL,
  `course` varchar(100) NOT NULL,
  `dept` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `op_users`
--

INSERT INTO `op_users` (`id`, `fname`, `lname`, `studentId`, `pw`, `role`, `token`, `course`, `dept`) VALUES
(1, 'Writer', 'One', 'writer1', '31d68dc5397dda4d4a2d5305d4c9fbba', 'writer', '', '', ''),
(2, 'Admin', 'One', 'admin1', '31d68dc5397dda4d4a2d5305d4c9fbba', 'admin', '', '', ''),
(3, 'Student', 'One', 'student1', '31d68dc5397dda4d4a2d5305d4c9fbba', 'student', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `op_articles`
--
ALTER TABLE `op_articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `op_remarks`
--
ALTER TABLE `op_remarks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `op_tokens`
--
ALTER TABLE `op_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `op_users`
--
ALTER TABLE `op_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `op_articles`
--
ALTER TABLE `op_articles`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `op_remarks`
--
ALTER TABLE `op_remarks`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `op_tokens`
--
ALTER TABLE `op_tokens`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `op_users`
--
ALTER TABLE `op_users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
