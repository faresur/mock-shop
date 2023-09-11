-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 11, 2023 at 06:11 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `diamond-data`
--

-- --------------------------------------------------------

--
-- Table structure for table `diamond_categories`
--

CREATE TABLE `diamond_categories` (
  `id_kat` smallint(6) NOT NULL,
  `nazov` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Dumping data for table `diamond_categories`
--

INSERT INTO `diamond_categories` (`id_kat`, `nazov`) VALUES
(1, 'Rings'),
(2, 'Earrings'),
(3, 'Pendants'),
(4, 'Bracelets');

-- --------------------------------------------------------

--
-- Table structure for table `diamond_orders`
--

CREATE TABLE `diamond_orders` (
  `id` smallint(6) NOT NULL,
  `uid` smallint(6) NOT NULL,
  `tovar` text NOT NULL,
  `datum` date NOT NULL,
  `vybavena` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Dumping data for table `diamond_orders`
--

INSERT INTO `diamond_orders` (`id`, `uid`, `tovar`, `datum`, `vybavena`) VALUES
(16, 3, '7;25;31;40', '2023-09-11', 0),
(17, 3, '20;19;37', '2023-09-11', 0),
(18, 4, '55;40;25;48', '2023-09-11', 0),
(19, 2, '12;10;40;56;59', '2023-09-11', 0);

-- --------------------------------------------------------

--
-- Table structure for table `diamond_products`
--

CREATE TABLE `diamond_products` (
  `kod` smallint(6) NOT NULL,
  `nazov` varchar(30) NOT NULL,
  `cena` float NOT NULL,
  `id_kat` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Dumping data for table `diamond_products`
--

INSERT INTO `diamond_products` (`kod`, `nazov`, `cena`, `id_kat`) VALUES
(1, 'Lavender Swarovski Crystal', 21.33, 1),
(2, 'Fancy Blue and White Swarovski', 25, 1),
(3, 'Meadow and White Swarovski', 25, 1),
(4, 'Gold Woven Design', 28.68, 1),
(5, 'Swarovski Pearl and Crystal', 28.68, 1),
(6, 'Onyx Ring', 28.68, 1),
(7, 'Azotic Ecstasy', 30.15, 1),
(8, 'Sapphire Drop', 21.32, 2),
(9, 'Zirconia Heart', 21.33, 2),
(10, 'Butterfly Pendant', 21.32, 3),
(11, 'Link Bracelet', 21.32, 4),
(12, 'Black and White Wave', 102.2, 1),
(13, 'Jessica Simpson Butterfly', 109.55, 1),
(14, 'Diamond Flower', 116.9, 1),
(15, 'Three Band Ring', 37.5, 1),
(16, 'Heart Bangle', 21.33, 4),
(17, 'Bubble Ring', 43.38, 1),
(18, 'Heart Hoop', 21.33, 2),
(19, 'Flower Earrings', 25, 2),
(20, 'Sapphire Ring', 43.38, 1),
(21, 'Double Heart', 21.33, 3),
(22, 'Vintage Tear Drop', 21.33, 3),
(23, 'Dome Ring', 43.38, 1),
(24, 'Shamballa', 28.68, 4),
(25, 'Bouquet Ring', 55.15, 1),
(26, 'Kabana Double Dolphin', 58.09, 1),
(27, 'Chocolate', 28.68, 4),
(28, 'Twist Bangle', 28.68, 4),
(29, 'Teal Bangle', 43.38, 4),
(30, 'Blue and White', 25, 2),
(31, 'Flower Stud', 25, 2),
(32, 'Onyx Earrings', 25, 2),
(33, 'Triple Hoop', 25, 2),
(34, 'Hoop Zirconia', 25, 2),
(35, 'Meadow and White Pendant', 21.32, 3),
(36, 'Onyx Pendant', 25, 3),
(37, 'Tie Pendant', 25, 3),
(38, 'Grey Pearl', 50.74, 4),
(39, 'Starfish', 69.85, 1),
(40, 'Calla Lily', 87.5, 1),
(41, 'Onyx Black and White', 94.85, 1),
(42, 'Tangle Black and White', 102.2, 1),
(43, 'Ruby and White', 314.95, 1),
(44, 'White Quartz', 205.37, 1),
(45, 'Two-Tone', 241.91, 1),
(46, 'Champagne Heart', 219.85, 1),
(47, 'Blue and White Ring', 131.62, 1),
(48, 'Pave Ring', 124.26, 1),
(49, 'Pink and White Engagement', 2940.44, 1),
(50, 'Cubetto Bracelet', 72.79, 4),
(51, 'Three Row', 72.79, 4),
(52, 'Zebra Bracelet', 80.15, 4),
(53, 'Black Ceramic Circle', 131.62, 4),
(54, 'Onyx Cuff', 146.33, 4),
(55, 'Black and White Bangle', 205.15, 4),
(56, 'Blue and White Drop', 28.68, 3),
(57, 'Pearl Bead', 50.74, 3),
(58, 'Champagne Flower', 94.85, 3),
(59, 'Blue and White Drops', 36.03, 2),
(60, 'Chocolate Pearl Drop', 43.38, 2);

-- --------------------------------------------------------

--
-- Table structure for table `diamond_users`
--

CREATE TABLE `diamond_users` (
  `uid` smallint(6) NOT NULL,
  `username` varchar(20) NOT NULL DEFAULT '',
  `heslo` varchar(50) NOT NULL DEFAULT '',
  `meno` varchar(20) NOT NULL DEFAULT '',
  `priezvisko` varchar(30) NOT NULL DEFAULT '',
  `admin` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Dumping data for table `diamond_users`
--

INSERT INTO `diamond_users` (`uid`, `username`, `heslo`, `meno`, `priezvisko`, `admin`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'System', 'Admin', 1),
(2, 'fares', 'f29fda580bc914dca191b2098300d2dd', 'Fares', 'Marwan', 0),
(3, 'jane', '5844a15e76563fedd11840fd6f40ea7b', 'Jane', 'Doe', 0),
(4, 'john', '527bd5b5d689e2c32ae974c6229ff785', 'John', 'Doe', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `diamond_categories`
--
ALTER TABLE `diamond_categories`
  ADD PRIMARY KEY (`id_kat`);

--
-- Indexes for table `diamond_orders`
--
ALTER TABLE `diamond_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diamond_products`
--
ALTER TABLE `diamond_products`
  ADD PRIMARY KEY (`kod`);

--
-- Indexes for table `diamond_users`
--
ALTER TABLE `diamond_users`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `diamond_categories`
--
ALTER TABLE `diamond_categories`
  MODIFY `id_kat` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `diamond_orders`
--
ALTER TABLE `diamond_orders`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `diamond_products`
--
ALTER TABLE `diamond_products`
  MODIFY `kod` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `diamond_users`
--
ALTER TABLE `diamond_users`
  MODIFY `uid` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
