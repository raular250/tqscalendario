-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2021 at 09:37 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `recordatorios`
--

CREATE TABLE `recordatorios` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `inicio` datetime NOT NULL,
  `fin` datetime NOT NULL,
  `frequencia` varchar(20) NOT NULL,
  `anterioridad` varchar(2) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recordatorios`
--

INSERT INTO `recordatorios` (`id`, `titulo`, `inicio`, `fin`, `frequencia`, `anterioridad`, `descripcion`, `user_id`) VALUES
(1, 'fghjfg', '2020-01-01 00:00:00', '2020-01-01 00:05:00', 'once', '5m', 'fghj', 3),
(2, 'fhj', '2020-01-01 00:00:00', '2020-01-01 00:05:00', 'once', '5m', '', 3),
(3, 'Prueba1', '2021-01-01 09:45:00', '2022-01-01 11:55:00', 'D', '5m', 'No se', 3),
(4, 'Yo k se pavo', '2023-09-22 02:00:00', '2025-06-01 21:11:00', '1D', '1s', 'Pues algo', 3),
(8, 'titulo', '2020-01-01 00:00:00', '2020-01-01 00:05:00', '2A', '1s', 'Hola esto es una descripcion', 1),
(9, 'titulo', '2020-01-01 00:00:00', '2020-01-01 00:05:00', '2A', '1s', 'Hola esto es una descripcion', 1),
(11, 'titulo', '2020-01-01 00:00:00', '2020-01-01 00:05:00', '2A', '1s', 'Hola esto es una descripcion', 1),
(13, 'titulo', '2020-01-01 00:00:00', '2020-01-01 00:05:00', '2A', '1s', 'Hola esto es una descripcion', 1),
(15, 'titulo', '2020-01-01 00:00:00', '2020-01-01 00:05:00', '2A', '1s', 'Hola esto es una descripcion', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `user` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `user`, `password`) VALUES
(1, 'Macananero2', '442445'),
(2, 'Frutesino5', 'bosque'),
(3, 'Maria', '123_456'),
(4, 'alejoHugo', '093284'),
(5, 'legendary', 'tekashi'),
(6, 'killshot122', 'scarce');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `recordatorios`
--
ALTER TABLE `recordatorios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `recordatorios`
--
ALTER TABLE `recordatorios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `recordatorios`
--
ALTER TABLE `recordatorios`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
