-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2019 at 04:10 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

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
  `body` text NOT NULL,
  `up_timestamp` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `op_test`
--

CREATE TABLE `op_test` (
  `id` int(255) NOT NULL,
  `article` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `op_test`
--

INSERT INTO `op_test` (`id`, `article`) VALUES
(1, '<p>dlaksdjklasjd</p>'),
(2, '<h2><strong>Lorem Ipsum Dolor</strong></h2><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut tempore quia possimus aspernatur totam numquam facilis soluta consectetur mollitia officiis. Temporibus odio repellendus nulla et omnis corporis, itaque unde dignissimos!</p>'),
(3, '<h2><strong>Lorem Ipsum</strong></h2><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut tempore quia possimus aspernatur totam numquam facilis soluta consectetur mollitia officiis. Temporibus odio repellendus nulla et omnis corporis, itaque unde dignissimos!</p><blockquote><p><i>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut tempore quia possimus aspernatur totam numquam facilis soluta consectetur mollitia officiis. Temporibus odio repellendus nulla et omnis corporis, itaque unde dignissimos!</i></p></blockquote><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut tempore quia possimus aspernatur totam numquam facilis soluta consectetur mollitia officiis. Temporibus odio repellendus nulla et omnis corporis, itaque unde dignissimos!</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut tempore quia possimus aspernatur totam numquam facilis soluta consectetur mollitia officiis. Temporibus odio repellendus nulla et omnis corporis, itaque unde dignissimos!</p><p>&lt;h2&gt;&lt;strong&gt;Lorem Ipsum Dolor&lt;/strong&gt;&lt;/h2&gt;&lt;p&gt;Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut tempore quia possimus aspernatur totam numquam facilis soluta consectetur mollitia officiis. Temporibus odio repellendus nulla et omnis corporis, itaque unde dignissimos!&lt;/p&gt;</p>');

-- --------------------------------------------------------

--
-- Table structure for table `op_users`
--

CREATE TABLE `op_users` (
  `id` int(10) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `pw` varchar(32) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `op_users`
--

INSERT INTO `op_users` (`id`, `fname`, `lname`, `username`, `pw`, `role`) VALUES
(1, 'Writer', 'One', 'writer1', '916171e9a6951662b2665bbf072f85f0', 'writer'),
(2, 'Admin', 'One', 'admin1', '916171e9a6951662b2665bbf072f85f0', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `op_test`
--
ALTER TABLE `op_test`
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
-- AUTO_INCREMENT for table `op_test`
--
ALTER TABLE `op_test`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `op_users`
--
ALTER TABLE `op_users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
