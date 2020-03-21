-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 21, 2020 at 05:28 PM
-- Server version: 5.7.25
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `MPTasks`
--
CREATE DATABASE IF NOT EXISTS `MPTasks` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `MPTasks`;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `text` varchar(255) NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `completed_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `id_user`, `text`, `completed`, `created_date`, `completed_date`) VALUES
(1, 1, 'delectus aut autem', 0, '2020-03-18 11:02:17', NULL),
(2, 1, 'quis ut nam facilis et officia qui', 1, '2020-03-18 11:02:17', NULL),
(3, 1, 'fugiat veniam minus', 1, '2020-03-18 11:02:17', NULL),
(4, 1, 'et porro tempora', 0, '2020-03-18 11:02:17', NULL),
(5, 1, 'laboriosam mollitia et enim quasi adipisci quia provident illum', 0, '2020-03-18 11:02:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `EmailUnique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `created`, `last_login`) VALUES
(1, 'demo@mixpanel.com', '2020-03-18 10:50:29', '2020-03-18 10:50:29');