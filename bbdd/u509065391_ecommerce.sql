-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 28-03-2022 a las 07:10:51
-- Versión del servidor: 10.5.12-MariaDB-cll-lve
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u509065391_ecommerce`
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
(1, 'Eustacio Bautista', '8119647445', 'arellanos.baaeus@gmail.com', '$2y$10$MrNlmhf6PKWP.jdwJsXzI.r.3h91ZPwuzVqkLV/1TSHPAM65rwequ', 'LAC0207121HL', 'Test test ', '2806:2f0:90a0:e015:f', '2022-03-28 06:06:47'),
(2, 'Hugo bautista', '7711244052', 'hugo.123@gmail.com', '$2y$10$HuwmsxtbCbebQMdnxt.t5eKBRlQpFGpwtDUyZcoy8Fktkbc1cME6S', 'UNA2907227Y5', 'Nuevo ', '2806:2f0:90a0:e015:f', '2022-03-28 06:09:41');

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
