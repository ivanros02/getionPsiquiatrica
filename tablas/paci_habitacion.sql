-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-08-2024 a las 00:49:50
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
-- Base de datos: `gestion_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paci_habitacion`
--

CREATE TABLE `paci_habitacion` (
  `id_paciente` int(255) NOT NULL,
  `habitacion` int(11) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `fecha_egreso` date NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paci_habitacion`
--

INSERT INTO `paci_habitacion` (`id_paciente`, `habitacion`, `fecha_ingreso`, `fecha_egreso`, `id`) VALUES
(16, 2, '2024-07-17', '2024-07-24', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `paci_habitacion`
--
ALTER TABLE `paci_habitacion`
  ADD PRIMARY KEY (`id`,`id_paciente`),
  ADD KEY `fk_habitacion_paciente` (`habitacion`),
  ADD KEY `fk_habitacion_paciente_id` (`id_paciente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `paci_habitacion`
--
ALTER TABLE `paci_habitacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `paci_habitacion`
--
ALTER TABLE `paci_habitacion`
  ADD CONSTRAINT `fk_habitacion_paciente` FOREIGN KEY (`habitacion`) REFERENCES `habitaciones` (`id`),
  ADD CONSTRAINT `fk_habitacion_paciente_id` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
