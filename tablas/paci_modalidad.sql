-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-08-2024 a las 16:18:25
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
-- Estructura de tabla para la tabla `paci_modalidad`
--

CREATE TABLE `paci_modalidad` (
  `id_paciente` int(255) NOT NULL,
  `modalidad` int(255) NOT NULL,
  `fecha` date NOT NULL,
  `id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paci_modalidad`
--

INSERT INTO `paci_modalidad` (`id_paciente`, `modalidad`, `fecha`, `id`) VALUES
(78, 2, '2024-08-01', 8),
(78, 3, '2024-08-21', 9);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `paci_modalidad`
--
ALTER TABLE `paci_modalidad`
  ADD PRIMARY KEY (`id`,`id_paciente`),
  ADD KEY `fk_modalidad` (`modalidad`),
  ADD KEY `fk_id_paciente_modalidad` (`id_paciente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `paci_modalidad`
--
ALTER TABLE `paci_modalidad`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `paci_modalidad`
--
ALTER TABLE `paci_modalidad`
  ADD CONSTRAINT `fk_id_paciente_modalidad` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id`),
  ADD CONSTRAINT `fk_modalidad` FOREIGN KEY (`modalidad`) REFERENCES `modalidad` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
