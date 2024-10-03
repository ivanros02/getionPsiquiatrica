-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-10-2024 a las 16:50:57
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `terapia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presentaciones_especialidades`
--

CREATE TABLE `presentaciones_especialidades` (
  `presentacion_id` int(11) NOT NULL,
  `especialidad_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `presentaciones_especialidades`
--

INSERT INTO `presentaciones_especialidades` (`presentacion_id`, `especialidad_id`) VALUES
(1, 24),
(1, 27),
(1, 34),
(1, 40),
(2, 24),
(2, 27),
(3, 24),
(3, 27),
(5, 24),
(5, 27),
(5, 34);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `presentaciones_especialidades`
--
ALTER TABLE `presentaciones_especialidades`
  ADD PRIMARY KEY (`presentacion_id`,`especialidad_id`),
  ADD KEY `especialidad_id` (`especialidad_id`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `presentaciones_especialidades`
--
ALTER TABLE `presentaciones_especialidades`
  ADD CONSTRAINT `presentaciones_especialidades_ibfk_1` FOREIGN KEY (`presentacion_id`) REFERENCES `presentaciones` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `presentaciones_especialidades_ibfk_2` FOREIGN KEY (`especialidad_id`) REFERENCES `especialidades` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
