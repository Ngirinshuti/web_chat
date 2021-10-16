-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2021 at 08:34 PM
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
('valentin', 'prudent', '2021-10-16 16:02:34');

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
('emmerance', 'brad'),
('emmerance', 'mike'),
('emmerance', 'prudent'),
('prudent', 'brad'),
('prudent', 'mike'),
('valentin', 'brad'),
('valentin', 'emmerance'),
('valentin', 'mike');

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
  `status` varchar(10) NOT NULL DEFAULT 'unread'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(26, 'valentin', 'IMG_20210328_162644.jpg', 'Remembering old times', 0, '2021-10-16 17:54:02', 0, '', 0),
(27, 'mike', '', 'Hey brothers;\r\nGood whishes</br>Bye!', 0, '2021-10-16 18:12:49', 0, '', 0),
(28, 'mike', '', '\r\n                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores mollitia non, optio reprehenderit quisquam explicabo est et, velit magnam laudantium atque quae ex aut, laboriosam ullam cum aliquid voluptatem. Sit soluta fuga dolorum tenetur ipsam quaerat magni eveniet illo minus molestiae ullam animi dolor aspernatur suscipit consectetur perspiciatis, voluptates ut dolorem corporis deleniti sequi rem? Odit animi quas corrupti sequi perferendis maxime voluptatum rerum totam temporibus sapiente aperiam minima vitae, magni impedit assumenda illo unde quam consequuntur. Dicta modi nemo atque, explicabo ab et similique, maiores velit ipsa voluptatem omnis molestiae eum facilis iusto, ratione doloremque officia tempore culpa necessitatibus corporis? Pariatur, esse maxime placeat hic eligendi, sapiente debitis dolorum nulla obcaecati reiciendis alias autem atque sit ipsum numquam dignissimos, voluptatem quam aspernatur vitae error corrupti! Distinctio aut illum molestias, pariatur itaque aliquam dolores, voluptas vitae quaerat culpa provident. Similique laudantium modi harum autem fuga possimus sapiente porro quam quis maxime, numquam asperiores amet, aut praesentium. Aperiam, quibusdam repudiandae aliquid praesentium corrupti amet asperiores? Omnis exercitationem earum eos minus ullam suscipit! Inventore itaque nulla eligendi dicta illo qui, similique excepturi expedita. Alias, voluptatem ad sunt delectus eum eveniet ab! Quos, fugit! Quis adipisci, modi amet voluptatem laborum reiciendis quaerat explicabo dolore. Laboriosam voluptatum quae adipisci cum suscipit beatae cumque temporibus iste deleniti inventore, vero at in veniam voluptatibus corrupti sunt numquam nobis sint non commodi hic a vitae natus dicta. Et amet repellendus quia! Velit natus saepe, expedita alias provident atque amet quis ex voluptatem qui illo dignissimos ut exercitationem obcaecati dolorem placeat, repellendus dolorum quasi laboriosam ullam laborum fugit, pariatur veritatis. Voluptatem blanditiis veniam rerum quo ipsam? Rem explicabo unde voluptate. Placeat omnis vel accusamus harum necessitatibus vero, fugit cupiditate odio obcaecati in soluta corporis consequuntur saepe recusandae, pariatur hic, expedita repellendus minima suscipit laborum maiores iusto deleniti rerum!', 0, '2021-10-16 18:13:34', 0, '', 0);

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
(26, 'mike'),
(27, 'valentin'),
(28, 'valentin');

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
  `status` varchar(10) NOT NULL DEFAULT 'offline'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`fname`, `lname`, `email`, `dob`, `sex`, `username`, `password`, `about`, `profile_pic`, `address`, `status`) VALUES
('Brad', 'Scott', 'brad@gmail.com', '1997-03-03', 'Male', 'brad', '$2y$10$7FRz990qKqnLhUvUMvTPn.7io9p4KGUKCH8BJbJCufbDxqS2dFqFu', 'Unknown', '275.jpg', 'Unknown', 'offline'),
('GUHIRWA', 'Emmerance', 'emme@gmail.com', '2001-04-03', 'Male', 'emmerance', '$2y$10$Lu4SGkKtTLrw1jFhiU8.veO59Bh/MMLneSleQdh2zObyw9kd/b4qC', 'Unknown', 'default.png', 'Unknown', 'online'),
('Mike', 'Brant', 'mike@gmail.com', '2004-08-14', 'Male', 'mike', '$2y$10$n5jj32S3gtpyUyQr/xTY9eMM0PjCoB/h6boah/dinfq3N/AxOUJ26', 'Unknown', 'default.png', 'Unknown', 'online'),
('Ngirnshuti', 'Prudent', 'prudent@gmail.com', '1999-04-03', 'Male', 'prudent', '$2y$10$s25VXCrAUfn/mJsmhIXP7ObalVFSQzPlF18.Ay8ErYQEWfBGdLaB.', 'Unknown', 'default.png', 'Unknown', 'offline'),
('ISHIMWE', 'Valentin', 'ishimwevalentin3@gmail.com', '2001-02-02', 'Male', 'valentin', '$2y$10$DmotpxFL.1//H/J9tRFXPONFFdOqiXB25LV17NV6PPoOElJhwlOXm', 'Unknown', '523.jpg', 'Unknown', 'online');

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
  ADD KEY `sender` (`sender`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3342;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stories`
--
ALTER TABLE `stories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

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
  ADD CONSTRAINT `sender` FOREIGN KEY (`sender`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

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
