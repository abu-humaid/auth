-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2020 at 11:11 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fb_395`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `uname` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cell` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `created_at` int(100) NOT NULL DEFAULT current_timestamp(),
  `status` varchar(10) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `uname`, `email`, `cell`, `password`, `photo`, `created_at`, `status`) VALUES
(12, 'Sohan Khan', 'sohan', 'so@gmail.com', '01717700811', '$2y$10$mY353Lfj..gWXXLQnxw8JeFdp.svt6dVOue9M3anfF5/6kKYdig..', '390bab6db1cbab88d842c8c04da969e8.jpg', 2147483647, 'active'),
(13, 'Asraful HAque', 'haq', 'haq@gmail.com', '01717700812', '$2y$10$7d7Cf09F717bZSHfM1LLYuxg9IRQexIW2uVVYZUnA.PPcHLntAbDe', 'e9aa0e545fc6d00602f5c9885e261d5b.jpg', 2147483647, 'active'),
(14, 'Salim', 'salim', 'salim@gmail.com', '01717700813', '$2y$10$58txAtRrAarUrxMOU6zfaep/v0P2HrHGGxl1ZRgHnoni9PMp8Ta0y', '6a4b26da92af19beb578c9efb2221396.jpg', 2147483647, 'active'),
(15, 'Zulfikar', 'zulfikar', 'zulfikar@gmail.com', '01717700814', '$2y$10$T48xZOmyQPx2jl9n3wosQeh6G1.If216POfuLgVtw2ZK458j2YKYW', '6cb293e78194cb86c202cb35ace89053.jpg', 2147483647, 'active'),
(16, 'Ifthakar Mahmud', 'if', 'if@gmail.com', '11111111', '$2y$10$Ww9n0Q5i4IZXj2hqKYdQZOV67N1jtolvnBIFkBRX7fyruaAQH9tA.', '9369caaad341ed4a63ad496c28108f2e.jpg', 2147483647, 'active'),
(17, 'Sorna Das', 'sorna', 'sor@gmail.com', '222222', '$2y$10$m//SYL7/CCF2wKLZCrL0xenBARWK6NyJ5gby1TCIkhi85NALeWtxa', '5ed2d62f8d33fe9ef9002500d4fc450b.jpg', 2147483647, 'active'),
(18, 'Sanu', 'sanu', 'sa@gmail.com', '333333', '$2y$10$EvFTxZqQ/ZOv0Asehhyawu4ILftUm.hiTiAaVEKh6hVTMvwevaiam', 'e631bb489d0daac31db7a709fa83cee0.jpg', 2147483647, 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
