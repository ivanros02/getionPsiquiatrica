-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-08-2024 a las 16:18:34
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
-- Estructura de tabla para la tabla `practicas`
--

CREATE TABLE `practicas` (
  `id_paciente` int(255) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `profesional` int(255) NOT NULL,
  `actividad` int(255) NOT NULL,
  `cant` int(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `practicas`
--

INSERT INTO `practicas` (`id_paciente`, `fecha`, `hora`, `profesional`, `actividad`, `cant`, `id`) VALUES
(78, '2024-08-28', '18:18:00', 16, 7, 1, 99),
(78, '2024-08-29', '18:18:00', 16, 7, 1, 100),
(78, '2024-08-30', '18:18:00', 16, 7, 1, 101),
(78, '2024-08-14', '19:00:00', 15, 8, 1, 102),
(78, '2024-08-15', '19:00:00', 15, 8, 1, 103);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `practicas`
--
ALTER TABLE `practicas`
  ADD PRIMARY KEY (`id`,`id_paciente`),
  ADD KEY `profesiona_fk` (`profesional`),
  ADD KEY `actividad_fk` (`actividad`),
  ADD KEY `fk_id_paciente_practica` (`id_paciente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `practicas`
--
ALTER TABLE `practicas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `practicas`
--
ALTER TABLE `practicas`
  ADD CONSTRAINT `actividad_fk` FOREIGN KEY (`actividad`) REFERENCES `actividades` (`id`),
  ADD CONSTRAINT `fk_id_paciente_practica` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id`),
  ADD CONSTRAINT `profesiona_fk` FOREIGN KEY (`profesional`) REFERENCES `profesional` (`id_prof`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
