-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-08-2024 a las 16:18:00
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
-- Estructura de tabla para la tabla `egresos`
--

CREATE TABLE `egresos` (
  `id_paciente` int(255) NOT NULL,
  `fecha_egreso` date NOT NULL,
  `diag` int(255) NOT NULL,
  `modalidad` int(255) NOT NULL,
  `motivo` int(255) DEFAULT NULL,
  `id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `egresos`
--

INSERT INTO `egresos` (`id_paciente`, `fecha_egreso`, `diag`, `modalidad`, `motivo`, `id`) VALUES
(78, '2024-08-20', 1, 2, 1, 23);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `egresos`
--
ALTER TABLE `egresos`
  ADD PRIMARY KEY (`id`,`id_paciente`),
  ADD KEY `fk_tipo_egreso` (`motivo`),
  ADD KEY `fk_diagnostico` (`diag`),
  ADD KEY `fk_modalidad_egreso` (`modalidad`),
  ADD KEY `fk_id_paciente_egreso` (`id_paciente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `egresos`
--
ALTER TABLE `egresos`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `egresos`
--
ALTER TABLE `egresos`
  ADD CONSTRAINT `fk_diagnostico` FOREIGN KEY (`diag`) REFERENCES `diag` (`id`),
  ADD CONSTRAINT `fk_id_paciente_egreso` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id`),
  ADD CONSTRAINT `fk_modalidad_egreso` FOREIGN KEY (`modalidad`) REFERENCES `modalidad` (`id`),
  ADD CONSTRAINT `fk_tipo_egreso` FOREIGN KEY (`motivo`) REFERENCES `tipo_egreso` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
