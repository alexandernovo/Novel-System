-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2023 at 09:16 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

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
-- Table structure for table `chapters`
--

CREATE TABLE `chapters` (
  `chapter_id` int(11) NOT NULL,
  `chapter_number` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext DEFAULT NULL,
  `novel_id` int(11) DEFAULT NULL,
  `chapter_date_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chapters`
--

INSERT INTO `chapters` (`chapter_id`, `chapter_number`, `title`, `content`, `novel_id`, `chapter_date_added`) VALUES
(40, 1, '1', 'acascacascas', 36, '2023-10-20'),
(41, 2, '2', 'zczxczcszc', 36, '2023-10-20'),
(42, 1, 'Superstar', 'mmamkwkmackmcska', 38, '2023-10-23'),
(43, 2, 'asdac', 'asasccawca', 38, '2023-10-23'),
(44, 3, 'ascascaxqwcq', 'ascawcascascac', 38, '2023-10-23');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comments_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `novel_id` int(11) NOT NULL,
  `comments_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comments_id`, `users_id`, `novel_id`, `comments_text`) VALUES
(7, 33, 36, 'Wrong Grammar');

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `donation_id` int(11) NOT NULL,
  `author` int(11) NOT NULL,
  `donator` varchar(100) NOT NULL,
  `amount` varchar(11) NOT NULL,
  `date_donate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`donation_id`, `author`, `donator`, `amount`, `date_donate`) VALUES
(23, 32, 'Eveanne', '50', '2023-10-18 09:44:45'),
(24, 32, 'Rey', '100', '2023-10-20 08:31:46');

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `genre_id` int(11) NOT NULL,
  `novel_id` int(255) NOT NULL,
  `genre_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`genre_id`, `novel_id`, `genre_name`) VALUES
(80, 35, 'Adventure'),
(81, 35, 'Action'),
(82, 35, 'Comedy'),
(83, 35, 'Crime'),
(84, 35, 'Drama'),
(85, 35, 'Fantasy'),
(86, 35, 'Historical'),
(87, 35, 'Horror'),
(88, 35, 'Isekai'),
(89, 35, 'Mystery'),
(90, 35, 'Romance'),
(91, 35, 'Slice of Life'),
(92, 35, 'Shonen'),
(93, 35, 'Shojo'),
(94, 35, 'Seinen'),
(95, 35, 'Josei'),
(96, 36, 'Adventure'),
(97, 36, 'Isekai'),
(98, 37, 'Action'),
(99, 37, 'Mystery'),
(100, 37, 'Shojo'),
(101, 38, 'Action'),
(102, 38, 'Fantasy'),
(103, 38, 'Mystery');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `history_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `novel_id` int(11) NOT NULL,
  `read_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`history_id`, `users_id`, `novel_id`, `read_date`) VALUES
(18, 32, 35, '2023-10-23 09:00:18'),
(19, 37, 35, '2023-10-20 09:08:33'),
(20, 32, 38, '2023-10-23 09:02:01');

-- --------------------------------------------------------

--
-- Table structure for table `novels`
--

CREATE TABLE `novels` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `subtitle` varchar(100) NOT NULL,
  `synopsis` text NOT NULL,
  `status` text NOT NULL,
  `novel_image` varchar(255) NOT NULL,
  `users_id` int(11) NOT NULL,
  `novel_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `novels`
--

INSERT INTO `novels` (`id`, `title`, `author`, `subtitle`, `synopsis`, `status`, `novel_image`, `users_id`, `novel_added`) VALUES
(35, 'Sample', 'Sample', 'Sample', 'Sample', 'PUBLISHED', 'images/novel_images/652fe06944542.jpg', 32, '2023-10-18 13:40:57'),
(36, 'sample1', 'sample1', 'sample1', 'sample1', 'PUBLISHED', 'images/novel_images/6531cd9c2cc13.png', 32, '2023-10-20 00:45:16'),
(37, 'dassdasd', 'zcxcz', 'sadsad', 'xzccxzczz', 'PUBLISHED', 'images/novel_images/6531d005d7b84.jpg', 32, '2023-10-20 00:55:33'),
(38, 'dfasdfasdd', 'dasdasddsas', 'cascascacasc', 'ascascacw', 'PUBLISHED', 'images/novel_images/6536679991d41.png', 32, '2023-10-23 12:31:21');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `profiles_id` int(11) NOT NULL,
  `profiles_about` text NOT NULL,
  `profiles_introtitle` text NOT NULL,
  `profiles_introtext` text NOT NULL,
  `users_id` int(11) DEFAULT NULL,
  `profile_picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`profiles_id`, `profiles_about`, `profiles_introtitle`, `profiles_introtext`, `users_id`, `profile_picture`) VALUES
(22, 'I only say Egg', 'Egg', '', 32, 'images/profile/652fe0e25326d.jpg');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`rating_id`, `users_id`, `user_rating`, `user_rev`, `novel_id`, `date`) VALUES
(22, 32, 5, 'Sample', 35, '2023-10-18'),
(23, 37, 2, 'adssda', 35, '2023-10-20');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `users_username`, `users_email`, `users_pwd`, `users_status`, `users_role`) VALUES
(32, 'author', 'author@gmail.com', '$2y$10$.Q1aQiyG93Q0pP3d6xhg4.LImiV5QlT/RyrlkVa/5KbGcY7zZawxK', '', 'AUTHOR'),
(33, 'editor', 'editor@gmail.com', '$2y$10$a7ouVnjzXqfq1An3S8rJ.epBtUbZZK9hdTK30vzj93sb5vwtMOz62', '', 'EDITOR'),
(34, 'admin', 'admin@gmail.com', '$2y$10$vyfmyFKHBX97ibl22eSQOuaJ/9avkpiXleIBAUoLAvWq8vRgr0iEu', '', 'ADMIN'),
(35, 'author2', 'author2@gmail.com', '$2y$10$DTQbkyEQ4n8AcsaStxJJ3u2Doe9L0WX4.rXAT3QuEfMqadaWoI4CW', '', 'AUTHOR'),
(36, 'author3', 'author3@gmail.com', '$2y$10$KLD.h7ywyxKmyLGim5kO8e6960dfFvRt1TJnzVtZJriPKlvwH4sOW', 'PENDING', 'AUTHOR'),
(37, 'author4', 'author4@gmail.com', '$2y$10$Sww36rm6QwjuGSRGrf9I3esTEMcXcckkfyi8I/.FwFkkRhx6NYI1e', '', 'AUTHOR');

--
-- Indexes for dumped tables
--

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
  ADD KEY `users_id` (`users_id`),
  ADD KEY `novel_id` (`novel_id`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`donation_id`),
  ADD KEY `author` (`author`);

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
-- AUTO_INCREMENT for table `chapters`
--
ALTER TABLE `chapters`
  MODIFY `chapter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comments_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `donation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `genre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `novels`
--
ALTER TABLE `novels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `profiles_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chapters`
--
ALTER TABLE `chapters`
  ADD CONSTRAINT `chapters_ibfk_1` FOREIGN KEY (`novel_id`) REFERENCES `novels` (`id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`novel_id`) REFERENCES `novels` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `donations`
--
ALTER TABLE `donations`
  ADD CONSTRAINT `donations_ibfk_1` FOREIGN KEY (`author`) REFERENCES `users` (`users_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `genre`
--
ALTER TABLE `genre`
  ADD CONSTRAINT `genre_ibfk_1` FOREIGN KEY (`novel_id`) REFERENCES `novels` (`id`);

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_ibfk_1` FOREIGN KEY (`novel_id`) REFERENCES `novels` (`id`),
  ADD CONSTRAINT `history_ibfk_2` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`);

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`);

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
