-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2021 at 09:34 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project2`
--

-- --------------------------------------------------------

--
-- Table structure for table `deleted_messages`
--

CREATE TABLE `deleted_messages` (
  `user` varchar(100) NOT NULL,
  `message_id` int(11) NOT NULL,
  `date_` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `friendrequest`
--

CREATE TABLE `friendrequest` (
  `sender` varchar(100) NOT NULL,
  `reciever` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `friendrequest`
--

INSERT INTO `friendrequest` (`sender`, `reciever`, `date`) VALUES
('emmerance', 'mike', '2021-10-17 11:41:11'),
('enzo', 'mike', '2021-10-17 10:42:53'),
('valentin', 'mike', '2021-10-17 10:42:16');

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `friend` varchar(100) NOT NULL,
  `partener` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`friend`, `partener`) VALUES
('emmerance', 'coder'),
('emmerance', 'james'),
('enzo', 'coder'),
('enzo', 'emmerance'),
('enzo', 'james'),
('valentin', 'coder'),
('valentin', 'emmerance'),
('valentin', 'enzo'),
('valentin', 'james');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender` varchar(100) NOT NULL,
  `reciever` varchar(100) NOT NULL,
  `body` varchar(1000) NOT NULL,
  `date_` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(10) NOT NULL DEFAULT 'unread',
  `story_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender`, `reciever`, `body`, `date_`, `status`, `story_id`) VALUES
(273, 'valentin', 'emmerance', 'Heey', '2021-10-17 13:53:05', 'read', NULL),
(378, 'emmerance', 'valentin', '................', '2021-10-17 14:00:05', 'read', NULL),
(1081, 'emmerance', 'valentin', 'hhhh', '2021-10-17 13:56:16', 'read', NULL),
(1599, 'valentin', 'emmerance', 'kk', '2021-10-17 13:55:56', 'read', NULL),
(1878, 'valentin', 'emmerance', 'What is up bro?', '2021-10-17 13:52:54', 'read', NULL),
(2007, 'valentin', 'emmerance', 'ok', '2021-10-17 13:55:49', 'read', NULL),
(844035, 'emmerance', 'coder', 'I just like that (:', '2021-10-17 18:50:17', 'read', 35),
(1297330, 'emmerance', 'coder', 'ver nice girl keep it up!', '2021-10-17 18:49:53', 'read', 35),
(1709858, 'valentin', 'james', 'Great story bro!', '2021-10-17 16:32:23', 'read', 32),
(1936440, 'valentin', 'james', 'Great story bro!', '2021-10-17 16:51:42', 'read', 32),
(2994141, 'emmerance', 'coder', 'Hey there men', '2021-10-17 18:55:16', 'read', NULL),
(3063088, 'james', 'valentin', 'Okay', '2021-10-17 16:33:25', 'read', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `post` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stories`
--

CREATE TABLE `stories` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `image` varchar(300) NOT NULL,
  `description` text NOT NULL,
  `expired` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `has_media` tinyint(4) DEFAULT 0,
  `media` varchar(300) NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stories`
--

INSERT INTO `stories` (`id`, `username`, `image`, `description`, `expired`, `created_at`, `has_media`, `media`, `views`) VALUES
(29, 'james', '', 'James story', 0, '2021-10-17 09:17:52', 0, '', 0),
(30, 'valentin', '_E__Mine_new_downloads_pics_IMG_20210815_153435_264%20(1).png(Moto G4).png', 'This is my life', 0, '2021-10-17 09:18:32', 0, '', 0),
(31, 'valentin', '127.0.0.1_5500_index.html(Galaxy S5).png', '', 0, '2021-10-17 09:22:14', 0, '', 0),
(32, 'james', 'IMG_20210328_162440.jpg', 'That\'s me brother', 0, '2021-10-17 09:26:20', 0, '', 0),
(33, 'valentin', '', 'H', 0, '2021-10-17 09:26:58', 0, '', 0),
(34, 'emmerance', 'IMG_20210328_163224.jpg', 'Here is my boi', 0, '2021-10-17 11:41:36', 0, '', 0),
(35, 'coder', '', 'Coding forever', 0, '2021-10-17 16:04:48', 0, '', 0),
(36, 'james', '', '||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||', 0, '2021-10-17 17:50:36', 0, '', 0),
(37, 'james', 'IMG_20210328_163156.jpg', 'Akumiro ni icupa', 0, '2021-10-17 18:33:36', 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `story_views`
--

CREATE TABLE `story_views` (
  `story_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `story_views`
--

INSERT INTO `story_views` (`story_id`, `username`) VALUES
(29, 'emmerance'),
(29, 'james'),
(29, 'valentin'),
(30, 'coder'),
(30, 'emmerance'),
(30, 'enzo'),
(30, 'james'),
(30, 'valentin'),
(31, 'coder'),
(31, 'emmerance'),
(31, 'enzo'),
(31, 'james'),
(31, 'valentin'),
(32, 'emmerance'),
(32, 'james'),
(32, 'valentin'),
(33, 'coder'),
(33, 'emmerance'),
(33, 'enzo'),
(33, 'james'),
(33, 'valentin'),
(34, 'coder'),
(34, 'emmerance'),
(34, 'james'),
(34, 'valentin'),
(35, 'coder'),
(35, 'emmerance'),
(36, 'emmerance'),
(36, 'james'),
(36, 'valentin'),
(37, 'emmerance'),
(37, 'james'),
(37, 'valentin');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `sex` varchar(7) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `about` varchar(500) NOT NULL DEFAULT 'Unknown',
  `profile_pic` varchar(500) NOT NULL DEFAULT 'default.png',
  `address` varchar(100) DEFAULT 'Unknown',
  `status` varchar(10) NOT NULL DEFAULT 'offline',
  `code` varchar(200) NOT NULL,
  `verify` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`fname`, `lname`, `email`, `dob`, `sex`, `username`, `password`, `about`, `profile_pic`, `address`, `status`, `code`, `verify`) VALUES
('Coder', 'Coder', 'coder@gmail.com', '2007-04-04', 'Male', 'coder', '$2y$10$SFie0/hXXy5Znxehn6/m4uC5tshaT.kuD1rd1r6itsxJ.ZAtg3VZq', 'Unknown', 'default.png', 'Unknown', 'online', '', ''),
('GUHIRWA', 'Emmerance', 'emme@gmail.com', '2001-04-03', 'Male', 'emmerance', '$2y$10$Lu4SGkKtTLrw1jFhiU8.veO59Bh/MMLneSleQdh2zObyw9kd/b4qC', 'Unknown', 'default.png', 'Unknown', 'online', '', ''),
('Prudent', 'Ngiri', 'enzo@gmail.com', '1999-05-04', 'Male', 'enzo', '$2y$10$mi.GemZWjuwd2G2plWjsuerfJUiLCUjsdPOc3X/qKXiSyeXrrT.IK', 'Unknown', 'default.png', 'Unknown', 'offline', '', ''),
('baddest', 'james', 'james@gmail.com', '2008-11-06', 'Male', 'james', '$2y$10$znKxMtSem8vQA3B7S7eJrOTKwHGHHYIL6yV2/tmN5oCQ94YvRmiXS', 'Unknown', '165.jpg', 'Unknown', 'offline', '', ''),
('Mike', 'Brant', 'mike@gmail.com', '2004-08-14', 'Male', 'mike', '$2y$10$Ia/NVh5fo.wj5fECNPxtAeMVmAvTM5kYRxvhWI02XbiiJ6fizfN7K', 'Unknown', 'default.png', 'Unknown', 'offline', '', ''),
('ISHIMWE', 'Valentin', 'ishimwevalentin3@gmail.com', '2002-09-20', 'Male', 'valentin', '$2y$10$v0asGwqFhvw9QaufwXTpdeRuWxZQnT8ijTqFT2CJgFf.NjarEuaQW', 'Unknown', 'default.png', 'Universe', 'offline', '737538', 'Verified');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `deleted_messages`
--
ALTER TABLE `deleted_messages`
  ADD KEY `delete_message` (`message_id`),
  ADD KEY `userdeletedmessage` (`user`);

--
-- Indexes for table `friendrequest`
--
ALTER TABLE `friendrequest`
  ADD PRIMARY KEY (`sender`,`reciever`),
  ADD KEY `reciever` (`reciever`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`friend`,`partener`),
  ADD KEY `partener` (`partener`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `date_` (`date_`),
  ADD KEY `reciever` (`reciever`),
  ADD KEY `sender` (`sender`),
  ADD KEY `story_reply_message` (`story_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_ibfk_1` (`username`);

--
-- Indexes for table `stories`
--
ALTER TABLE `stories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_stories` (`username`);

--
-- Indexes for table `story_views`
--
ALTER TABLE `story_views`
  ADD PRIMARY KEY (`story_id`,`username`),
  ADD KEY `story_viewer` (`username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3063089;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stories`
--
ALTER TABLE `stories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `deleted_messages`
--
ALTER TABLE `deleted_messages`
  ADD CONSTRAINT `delete_message` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userdeletedmessage` FOREIGN KEY (`user`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `friendrequest`
--
ALTER TABLE `friendrequest`
  ADD CONSTRAINT `friendrequest_ibfk_1` FOREIGN KEY (`reciever`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `friendrequest_ibfk_2` FOREIGN KEY (`sender`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`friend`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `friends_ibfk_2` FOREIGN KEY (`partener`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `reciever` FOREIGN KEY (`reciever`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sender` FOREIGN KEY (`sender`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `story_reply_message` FOREIGN KEY (`story_id`) REFERENCES `stories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stories`
--
ALTER TABLE `stories`
  ADD CONSTRAINT `user_stories` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `story_views`
--
ALTER TABLE `story_views`
  ADD CONSTRAINT `story_viewed` FOREIGN KEY (`story_id`) REFERENCES `stories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `story_viewer` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
