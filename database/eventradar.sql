-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2022 at 10:05 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eventradar`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryId` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryId`, `category_name`) VALUES
(1, 'Football'),
(2, 'Hockey'),
(3, 'Basketball'),
(4, 'Handball'),
(5, 'American Football');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `eventId` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `event_time` time NOT NULL,
  `description` varchar(1000) NOT NULL,
  `picture` varchar(1000) DEFAULT NULL,
  `fk_teamA_Id` int(11) DEFAULT NULL,
  `fk_teamB_Id` int(11) DEFAULT NULL,
  `fk_categoryId` int(11) DEFAULT NULL,
  `fk_locationId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`eventId`, `event_name`, `event_date`, `event_time`, `description`, `picture`, `fk_teamA_Id`, `fk_teamB_Id`, `fk_categoryId`, `fk_locationId`) VALUES
(1, 'Friendly match', '2022-02-18', '21:00:00', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Vel quam repellat architecto! Id possimus sit sed quasi voluptas ad. Dolorem ipsam incidunt voluptate delectus laboriosam, dolore commodi voluptatum culpa perferendis?', 'https://images.unsplash.com/photo-1520455468264-5a9704f4e993?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1116&q=80', 1, 1, 1, 2),
(6, 'Icehockey Classic', '2022-01-16', '22:00:00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer efficitur fermentum neque vitae venenatis. Nam tincidunt vel diam vitae euismod. Praesent luctus vitae metus non fermentum. Praesent vel rhoncus odio, eget commodo libero. In et magna elit.', 'https://images.unsplash.com/photo-1486128105845-91daff43f404?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80', 20, 7, 2, 4),
(8, 'Austrian Cup', '2022-02-09', '15:00:00', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio, impedit maxime fugit incidunt nemo id eligendi quaerat deserunt voluptates placeat, harum facere numquam! Nulla, iusto?', 'https://cdn.pixabay.com/photo/2014/09/03/12/50/wembley-434365_960_720.jpg', 25, 8, 1, 1),
(9, 'Basketball Bundesliga', '2022-01-18', '18:30:00', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio, impedit maxime fugit incidunt nemo id eligendi quaerat deserunt voluptates placeat, harum facere numquam! Nulla, iusto?', 'https://images.unsplash.com/photo-1504450758481-7338eba7524a?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1469&q=80', 29, 11, 3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `locationId` int(11) NOT NULL,
  `location_name` varchar(255) NOT NULL,
  `street` varchar(50) DEFAULT NULL,
  `street_no` int(5) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `zip_code` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`locationId`, `location_name`, `street`, `street_no`, `city`, `zip_code`) VALUES
(1, 'Allianz Stadion', 'Gerhard-Hanappi-Platz', 3, 'Vienna', '1140'),
(2, 'Generali-Arena', 'Horrpl.', 1, 'Vienna', '1100'),
(4, 'Erste Bank Arena', 'Meiereistrasse ', 7, 'Vienna', '1020'),
(5, ' ASKO Ballsport Center', 'Bernoullistrasse', 9, 'Vienna', '1220');

-- --------------------------------------------------------

--
-- Table structure for table `teama`
--

CREATE TABLE `teama` (
  `teamId` int(11) NOT NULL,
  `teamA_name` varchar(100) NOT NULL,
  `logo` varchar(1000) DEFAULT NULL,
  `fk_categoryId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teama`
--

INSERT INTO `teama` (`teamId`, `teamA_name`, `logo`, `fk_categoryId`) VALUES
(1, 'Vienna Rapid', '', 1),
(2, 'Vienna Capitals', 'https://upload.wikimedia.org/wikipedia/en/thumb/3/3e/Vienna_Capitals_logo.svg/1200px-Vienna_Capitals_logo.svg.png', 1),
(20, 'Graz99ers', '', 2),
(25, 'Linzer Athletik-Sport-Klub', NULL, 1),
(27, 'FC W. Innsbruck', NULL, 1),
(28, 'Dornbirner EC', NULL, 2),
(29, 'BC Vienna', NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `teamb`
--

CREATE TABLE `teamb` (
  `teamId` int(11) NOT NULL,
  `teamB_name` varchar(100) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `fk_categoryId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teamb`
--

INSERT INTO `teamb` (`teamId`, `teamB_name`, `logo`, `fk_categoryId`) VALUES
(1, 'Austria Vienna', '', 1),
(7, 'EC KAC', '', 2),
(8, 'Grazer AK', NULL, 1),
(9, 'Floridsdorfer AC', NULL, 1),
(10, 'EC VSV', NULL, 2),
(11, 'Flyers Wels', NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(4) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `email`, `password`, `status`) VALUES
(1, 'user@mail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'user'),
(2, 'test@mail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'user'),
(3, 'test2@mail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'user'),
(4, 'test3@mail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'user'),
(5, 'test4@mail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`eventId`),
  ADD KEY `fk_teamA_Id` (`fk_teamA_Id`),
  ADD KEY `fk_teamB_Id` (`fk_teamB_Id`),
  ADD KEY `fk_categoryId` (`fk_categoryId`),
  ADD KEY `fk_locationId` (`fk_locationId`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`locationId`);

--
-- Indexes for table `teama`
--
ALTER TABLE `teama`
  ADD PRIMARY KEY (`teamId`),
  ADD KEY `fk_categoryId` (`fk_categoryId`);

--
-- Indexes for table `teamb`
--
ALTER TABLE `teamb`
  ADD PRIMARY KEY (`teamId`),
  ADD KEY `fk_categoryId` (`fk_categoryId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `eventId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `locationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `teama`
--
ALTER TABLE `teama`
  MODIFY `teamId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `teamb`
--
ALTER TABLE `teamb`
  MODIFY `teamId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`fk_teamA_Id`) REFERENCES `teama` (`teamId`) ON DELETE SET NULL,
  ADD CONSTRAINT `events_ibfk_2` FOREIGN KEY (`fk_teamB_Id`) REFERENCES `teamb` (`teamId`) ON DELETE SET NULL,
  ADD CONSTRAINT `events_ibfk_3` FOREIGN KEY (`fk_categoryId`) REFERENCES `category` (`categoryId`) ON DELETE SET NULL,
  ADD CONSTRAINT `events_ibfk_4` FOREIGN KEY (`fk_locationId`) REFERENCES `location` (`locationId`) ON DELETE SET NULL;

--
-- Constraints for table `teama`
--
ALTER TABLE `teama`
  ADD CONSTRAINT `teama_ibfk_1` FOREIGN KEY (`fk_categoryId`) REFERENCES `category` (`categoryId`) ON DELETE SET NULL;

--
-- Constraints for table `teamb`
--
ALTER TABLE `teamb`
  ADD CONSTRAINT `teamb_ibfk_1` FOREIGN KEY (`fk_categoryId`) REFERENCES `category` (`categoryId`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
