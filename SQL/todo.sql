-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 03, 2023 at 02:58 PM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id20921698_todo`
--

-- --------------------------------------------------------

--
-- Table structure for table `todos`
--

CREATE TABLE `todos` (
  `id` int(11) NOT NULL,
  `item` varchar(255) NOT NULL,
  `checked` tinyint(11) NOT NULL DEFAULT 0,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `todos`
--

INSERT INTO `todos` (`id`, `item`, `checked`, `user_id`) VALUES
(62, 'Study for Internals', 0, 21),
(64, 'Edit the m7 clip ', 0, 21),
(72, 'DAP Practical Assignment', 0, 21),
(74, 'Get your 5k back', 0, 21),
(121, 'Do LinkedIn Quiz Questions of Courses', 0, 21),
(147, 'Add new Skills in Github Profile', 0, 21),
(151, 'Rs 500 for freshers', 0, 21),
(154, 'Write Review Paper on AI Effect on Humans', 1, 21),
(159, 'Reduce Review Paper to 3-4 pages', 1, 21),
(160, 'Prepare for Aptitude test (Alteast give mock test on first naukri) Last Date to learn 8th Oct', 0, 21),
(161, 'Prepare for Codevita After Internals with development', 0, 21),
(162, 'Add Drag and Drop feature in this TodoApp', 0, 21);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(13, 'Tester', 'tester@gmail.com', '$2y$10$tGYcu6a7zp4IZQG84nW3pOdk59obInbOlmAEgpOxOb874jpqSGkr.'),
(21, 'Abhijit', 'abhijit@gmail.com', '$2y$10$rilT4UQJDVLxtn7HV9Nsr.lLp4RRm0zNMAQUJ89/M9CivIWuzynP2'),
(22, 'Learn', 'learn@gmail.com', '$2y$10$NcnYFdyiXs1U1dNiypUAZOvqdbXVhXi2H6NLkRojlcnh.JdeaN/P2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `todos`
--
ALTER TABLE `todos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `todos`
--
ALTER TABLE `todos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `todos`
--
ALTER TABLE `todos`
  ADD CONSTRAINT `todos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
