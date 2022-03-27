-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-03-2022 a las 01:21:45
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `perti-test`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblusers`
--

CREATE TABLE `tblusers` (
  `id` int(5) NOT NULL,
  `nameus` varchar(40) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `passwordus` varchar(255) NOT NULL,
  `rfc` varchar(20) NOT NULL,
  `notes` varchar(10) NOT NULL,
  `ipaddress` varchar(20) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tblusers`
--

INSERT INTO `tblusers` (`id`, `nameus`, `phone`, `email`, `passwordus`, `rfc`, `notes`, `ipaddress`, `date_created`) VALUES
(1, 'Eustacio', '7711244052', 'eustacio@gmail.com', '$2y$10$zGwkg9KQMI52K/1/bgnFJ.BKFwU804kVGU0v7O1gYDG/J766yZqE6', 'CAPV841211G54', 'demo, demo', '127.0.0.1', '2022-03-27 15:56:27'),
(2, 'Arellanos', '4762633850', 'arellanos.ba@gmail.com', '$2y$10$kCuyuvNNr3d8obcoa8xxNu0ng5blnr8sZttYjh6J3Sys9VKm0CLei', 'QUMA470929F37', 'test 1, te', '127.0.0.1', '2022-03-27 17:08:15');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
