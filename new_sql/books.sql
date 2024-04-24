-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2023 at 02:27 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `books`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit_trail`
--

CREATE TABLE `audit_trail` (
  `audit_trail_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `novel_id` int(11) NOT NULL,
  `audit_description` varchar(255) NOT NULL,
  `audit_status` varchar(255) NOT NULL,
  `audit_datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `audit_trail`
--

INSERT INTO `audit_trail` (`audit_trail_id`, `users_id`, `novel_id`, `audit_description`, `audit_status`, `audit_datetime`) VALUES
(99, 56, 67, 'Submitted Novel', 'Pending', '2023-11-29 13:10:56'),
(100, 33, 67, 'Requested for Revision', 'Revision', '2023-11-29 13:11:18'),
(101, 56, 67, 'Submitted Novel', 'Pending', '2023-11-29 01:11:57'),
(104, 33, 67, 'Approved Novel', 'Approved', '2023-11-29 13:17:59'),
(105, 34, 67, 'Denied Novel', 'Denied', '2023-11-29 13:22:57'),
(106, 34, 67, 'Published Novel', 'Published', '2023-11-29 13:24:05');

-- --------------------------------------------------------

--
-- Table structure for table `chapters`
--

CREATE TABLE `chapters` (
  `chapter_id` int(11) NOT NULL,
  `chapter_number` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext DEFAULT NULL,
  `novel_id` int(11) DEFAULT NULL,
  `chapter_date_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comments_id` int(11) NOT NULL,
  `audit_trail_id` int(11) NOT NULL,
  `comments_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comments_id`, `audit_trail_id`, `comments_text`) VALUES
(22, 100, 'Wrong Grammar'),
(23, 101, 'Ive Fixed Grammar'),
(24, 105, 'Nudity');

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `donation_id` int(11) NOT NULL,
  `author` int(11) NOT NULL,
  `donator` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `amount` varchar(11) NOT NULL,
  `date_donate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`donation_id`, `author`, `donator`, `name`, `amount`, `date_donate`) VALUES
(39, 54, 56, '', '90', '2023-11-27 08:35:13'),
(41, 54, NULL, 'Unknown', '90', '2023-11-27 08:37:54'),
(49, 54, 56, 'Unknown', '80', '2023-11-27 08:52:35'),
(50, 32, 54, 'Deadpool', '90', '2023-11-27 09:08:36');

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `genre_id` int(11) NOT NULL,
  `novel_id` int(255) NOT NULL,
  `genre_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`genre_id`, `novel_id`, `genre_name`) VALUES
(244, 67, 'Adventure'),
(245, 67, 'Drama'),
(246, 67, 'Isekai'),
(247, 67, 'Mystery');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `history_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `novel_id` int(11) NOT NULL,
  `read_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`history_id`, `users_id`, `novel_id`, `read_date`) VALUES
(37, 56, 67, '2023-11-30 09:24:06');

-- --------------------------------------------------------

--
-- Table structure for table `novels`
--

CREATE TABLE `novels` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `subtitle` varchar(100) NOT NULL,
  `synopsis` text NOT NULL,
  `status` text NOT NULL,
  `novel_image` varchar(255) NOT NULL,
  `users_id` int(11) NOT NULL,
  `novel_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `novels`
--

INSERT INTO `novels` (`id`, `title`, `subtitle`, `synopsis`, `status`, `novel_image`, `users_id`, `novel_added`) VALUES
(67, 'ashdkhads', 'khakhsdkj', 'khaskjd', 'PUBLISHED', 'images/novel_images/65673858e3b33.jpeg', 56, '2023-11-29 13:10:48');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `profiles_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `birthday` date DEFAULT NULL,
  `profiles_about` text NOT NULL,
  `profiles_introtitle` text NOT NULL,
  `profiles_introtext` text NOT NULL,
  `users_id` int(11) DEFAULT NULL,
  `profile_picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`profiles_id`, `firstname`, `lastname`, `birthday`, `profiles_about`, `profiles_introtitle`, `profiles_introtext`, `users_id`, `profile_picture`) VALUES
(23, 'Logan', 'Murphy', NULL, '', '', '\"A failure man is not a failure at all, he\'s just a lack of confidence,\"', 32, 'images/profile/655b642a5af4c.jpg'),
(24, '', '', NULL, 'aujsncjqanwc', 'Eggslash', 'acnanwcasc', 49, 'images/profile/655b5c649d8e0.jpg'),
(25, '', '', NULL, 'Lorem ipsum dolor sit amet,', 'Lorem ipsum dolor sit amet,', 'Lorem ipsum dolor sit amet,', 50, 'images/profile/655b746118c5d.jpg'),
(26, 'Ryan', 'Chan', NULL, 'Inspiring Author', 'Inspiring Author', 'Inspiring Author', 54, 'images/profile/6560263b96586.webp'),
(28, 'Patrick', 'Martinez', '2000-11-24', '', '', '', 56, 'images/profile/656884ffc7b67.jpeg'),
(29, 'Jean', 'Grey', NULL, '', '', '\"A failure man is not a failure at all, he\'s just a lack of confidence,\"', 33, 'images/profile/655b642a5af4c.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `rating_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `user_rating` int(11) NOT NULL,
  `user_rev` text NOT NULL,
  `novel_id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`rating_id`, `users_id`, `user_rating`, `user_rev`, `novel_id`, `date`) VALUES
(25, 56, 4, 'Ugly Novel', 67, '2023-11-30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `users_username` tinytext NOT NULL,
  `users_email` tinytext NOT NULL,
  `users_pwd` varchar(255) NOT NULL,
  `users_status` varchar(12) NOT NULL,
  `users_role` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `users_username`, `users_email`, `users_pwd`, `users_status`, `users_role`) VALUES
(32, 'author', 'author@gmail.com', '$2y$10$.Q1aQiyG93Q0pP3d6xhg4.LImiV5QlT/RyrlkVa/5KbGcY7zZawxK', 'PENDING', 'AUTHOR'),
(33, 'editor', 'editor@gmail.com', '$2y$10$a7ouVnjzXqfq1An3S8rJ.epBtUbZZK9hdTK30vzj93sb5vwtMOz62', '', 'EDITOR'),
(34, 'admin', 'admin@gmail.com', '$2y$10$vyfmyFKHBX97ibl22eSQOuaJ/9avkpiXleIBAUoLAvWq8vRgr0iEu', '', 'ADMIN'),
(40, 'reader', 'reader@example.com', '$2y$10$pwvDK4KhAPEd6aWCaYY2DOOBtRVXAVYMnBag8AQSmoM0kMaQKzD8a', '', 'AUTHOR'),
(49, 'reader2', 'reader2@example.com', '$2y$10$Cm0W2/JM/U02m9VoDtmEmeMdzu2/mfhcWilyo1ITz0UoGUy7k2SmW', '', 'AUTHOR'),
(50, 'author2', 'author2@gmail.com', '$2y$10$GZplJTZ4I67beuAEH6jVl.K66ahpC4mC08JtCiF7Y8pEQFwntoiCC', '', 'AUTHOR'),
(51, 'admin2', 'admin2@gmail.com', '$2y$10$c4JQxnz99GRQBwkB/QfYI.1V/Et.BkFIg8p1VQpfcnch1cWZkCNTK', '', 'ADMIN'),
(54, 'Rey13', 'rey@example.ph', '$2y$10$zMi3LQmhiuX8cH1uMwg2Leg9TWhb0q9REMsbFbJngzxaQFn4adFZG', '', 'AUTHOR'),
(56, 'qehocy', 'reader69@mailinator.com', '$2y$10$uK15R1qdGnb.4D6AnpSgC./dcQ3T8CRlhwORJFY68kp/QaIt1cC92', 'PENDING', 'AUTHOR');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_trail`
--
ALTER TABLE `audit_trail`
  ADD PRIMARY KEY (`audit_trail_id`),
  ADD KEY `users_id` (`users_id`),
  ADD KEY `novel_id` (`novel_id`);

--
-- Indexes for table `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`chapter_id`),
  ADD KEY `novel_id` (`novel_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comments_id`),
  ADD KEY `audit_trail_id` (`audit_trail_id`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`donation_id`),
  ADD KEY `author` (`author`),
  ADD KEY `author_2` (`author`),
  ADD KEY `author_3` (`author`),
  ADD KEY `donator` (`donator`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`genre_id`),
  ADD KEY `novel_id` (`novel_id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`history_id`),
  ADD KEY `users_id` (`users_id`),
  ADD KEY `novel_id` (`novel_id`);

--
-- Indexes for table `novels`
--
ALTER TABLE `novels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`profiles_id`),
  ADD KEY `users_id` (`users_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `novel_id` (`novel_id`),
  ADD KEY `users_id` (`users_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit_trail`
--
ALTER TABLE `audit_trail`
  MODIFY `audit_trail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `chapters`
--
ALTER TABLE `chapters`
  MODIFY `chapter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comments_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `donation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `genre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=248;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `novels`
--
ALTER TABLE `novels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `profiles_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `audit_trail`
--
ALTER TABLE `audit_trail`
  ADD CONSTRAINT `audit_trail_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `audit_trail_ibfk_2` FOREIGN KEY (`novel_id`) REFERENCES `novels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chapters`
--
ALTER TABLE `chapters`
  ADD CONSTRAINT `chapters_ibfk_1` FOREIGN KEY (`novel_id`) REFERENCES `novels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`audit_trail_id`) REFERENCES `audit_trail` (`audit_trail_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `donations`
--
ALTER TABLE `donations`
  ADD CONSTRAINT `donations_ibfk_1` FOREIGN KEY (`author`) REFERENCES `users` (`users_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `donations_ibfk_2` FOREIGN KEY (`donator`) REFERENCES `users` (`users_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `genre`
--
ALTER TABLE `genre`
  ADD CONSTRAINT `genre_ibfk_1` FOREIGN KEY (`novel_id`) REFERENCES `novels` (`id`);

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `history_ibfk_2` FOREIGN KEY (`novel_id`) REFERENCES `novels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `novels`
--
ALTER TABLE `novels`
  ADD CONSTRAINT `novels_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`);

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`),
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`novel_id`) REFERENCES `novels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
