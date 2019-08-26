-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 26, 2019 at 02:35 PM
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
  `up_timestamp` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `op_articles`
--

INSERT INTO `op_articles` (`id`, `user_id`, `status`, `title`, `body`, `category`, `up_timestamp`) VALUES
(3, 1, 'published', 'Lorem Ipsum Dolor', 0x266c743b696672616d6520636c6173733d2671756f743b716c2d766964656f2671756f743b206672616d65626f726465723d2671756f743b302671756f743b20616c6c6f7766756c6c73637265656e3d2671756f743b747275652671756f743b207372633d2671756f743b68747470733a2f2f7777772e796f75747562652e636f6d2f656d6265642f63377243796c6c354165593f73686f77696e666f3d302671756f743b2667743b266c743b2f696672616d652667743b266c743b702667743b266c743b62722667743b266c743b2f702667743b266c743b702667743b48656c6c6f20576f726c6421266c743b2f702667743b266c743b702667743b536f6d6520696e697469616c20266c743b7374726f6e672667743b626f6c64266c743b2f7374726f6e672667743b2074657874266c743b2f702667743b266c743b702667743b266c743b62722667743b266c743b2f702667743b, 'Sports', '1566791841'),
(4, 1, 'published', 'Lorem Ipsum', 0x4c6f72656d20497073756d, 'entertainment', '13245'),
(5, 1, 'published', 'Title Title', 0x266c743b702667743b26616d703b6e6273703b266c743b2f702667743b0a266c743b702667743b26616d703b6e6273703b266c743b2f702667743b, 'sports', '1565516819'),
(6, 2, 'published', 'Title Title', 0x266c743b702667743b26616d703b6e6273703b266c743b2f702667743b0a266c743b702667743b26616d703b6e6273703b266c743b2f702667743b, 'sports', '1565516834'),
(7, 2, 'published', 'Title Title', 0x266c743b702667743b27266c743b2f702667743b0d0a266c743b702667743b266c743b7374726f6e672667743b414243266c743b2f7374726f6e672667743b266c743b2f702667743b, 'sports', '1565517762'),
(8, 2, 'draft', 'Testing', 0x266c743b702667743b54657374696e67266c743b2f702667743b0a266c743b702667743b266c743b7374726f6e672667743b54657374696e672059656168266c743b2f7374726f6e672667743b266c743b2f702667743b, 'sports', '1565532164');

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
-- Table structure for table `op_tokens`
--

CREATE TABLE `op_tokens` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `token` varchar(32) NOT NULL,
  `expiration` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `op_tokens`
--

INSERT INTO `op_tokens` (`id`, `user_id`, `token`, `expiration`) VALUES
(13, 1, 'f6b9244f1deef95352d0e5cf2a8736d9', '1568215429'),
(15, 1, 'e59cdb03c18c3e742f80865e4a5f4603', '1568862942'),
(16, 1, '2cb32768e909ccb121bf44c79a1f5d37', '1568863401'),
(17, 1, 'bf8f8ce21d7bfe443d1b6aa07f40c5a9', '1568863686'),
(18, 1, '79aa3c148b2a472c35c29347a77b166c', '1568865895'),
(19, 1, '10961f67210900d8f39ddcd945b17fa8', '1568865939'),
(20, 1, 'b72fc8e38367478a3d862c3b96ffe472', '1568874458'),
(21, 1, 'b89d9cac8ae7d9ff1eb93323922bf548', '1568874485'),
(22, 1, 'f90fe1a4d1482818a20bfbd70241d76b', '1568874596'),
(23, 1, '66a56727e9949b55560e9890425e1030', '1568875384'),
(24, 1, 'e926551d9f5a935142691c565b0418a4', '1568875616'),
(36, 1, 'cf724cf05f22d4a702b6c115dce74fa8', '1568978694'),
(37, 1, 'd48dfca41734ca4f305ad28582526156', '1569370393'),
(38, 1, '74084aa70bf130ac99b5fab17e1d3279', '1569370499'),
(39, 1, '7382ec96431e5ca229e3f8a901edd1ac', '1569370521'),
(40, 1, 'fdc877be41680de4bc80d3e6cb219cd2', '1569370684'),
(41, 1, '5e6ed3d1f8eaf0521b7fb9846c264c07', '1569370748'),
(42, 1, '9366df7ccbd716352a36043d23effab5', '1569370863'),
(43, 2, 'e67a69783b7bc91118d13086d3cd5d9e', '1569371238'),
(44, 1, 'fd718e91faaed89deff9efd84a10a49e', '1569371556');

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
(2, 'Admin', 'One', 'admin1', '31d68dc5397dda4d4a2d5305d4c9fbba', 'admin', '098f6bcd4621d373cade4e832627b4f5', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `op_articles`
--
ALTER TABLE `op_articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `op_test`
--
ALTER TABLE `op_test`
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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `op_test`
--
ALTER TABLE `op_test`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `op_tokens`
--
ALTER TABLE `op_tokens`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `op_users`
--
ALTER TABLE `op_users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
