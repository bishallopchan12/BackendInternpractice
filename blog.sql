-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2024 at 09:35 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `description`, `category`, `created_at`) VALUES
(1, 'Updated Blog Title', 'This is an updated description for the blog.', 'Lifestyle', '2024-12-13 12:50:49'),
(2, 'Updated Blog Title', 'This is an updated description for the blog.', 'Lifestyle', '2024-12-13 12:57:06'),
(3, 'Droje Lama First Blog', 'Hello everyone, it\'s me Dorje Lama and welcome to my first blog!', 'k', '2024-12-13 13:00:45'),
(4, 'Droje Lama First Blog', 'Hello everyone, it\'s me Dorje Lama and welcome to my first blog!', 'k', '2024-12-13 13:01:09'),
(5, 'sambas First Blog', 'hello everyone its me Samba Dorje lama and welcome to my first blog', 'K xaina  vanna', '2024-12-13 14:15:22'),
(6, 'Droje Lama First Blog', 'Hello everyone, it\'s me Dorje Lama and welcome to my first blog!', 'k', '2024-12-13 14:15:28'),
(7, 'Updated Blog Title', 'This is an updated description for the blog.', 'Lifestyle', '2024-12-15 08:14:00'),
(8, 'Updated Blog Title', 'This is an updated description for the blog.', 'Lifestyle', '2024-12-15 08:14:06'),
(9, 'sambas First Blog', 'hello everyone its me Samba Dorje lama and welcome to my first blog', 'K xaina  vanna', '2024-12-15 08:14:50'),
(10, 'Updated Blog Title', 'This is an updated description for the blog.', 'Lifestyle', '2024-12-15 08:23:03'),
(11, 'sambas First Blog', 'hello everyone its me Samba Dorje lama and welcome to my first blog', 'K xaina  vanna', '2024-12-15 08:23:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
