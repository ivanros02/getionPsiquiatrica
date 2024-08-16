-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-08-2024 a las 17:13:29
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
-- Estructura de tabla para la tabla `turnos`
--

CREATE TABLE `turnos` (
  `id` int(255) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `paciente` int(11) NOT NULL,
  `id_prof` int(255) NOT NULL,
  `motivo` int(255) NOT NULL,
  `llego` varchar(255) NOT NULL,
  `atendido` varchar(255) NOT NULL,
  `observaciones` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `turnos`
--

INSERT INTO `turnos` (`id`, `fecha`, `hora`, `paciente`, `id_prof`, `motivo`, `llego`, `atendido`, `observaciones`) VALUES
(52, '2024-08-26', '07:30:00', 16, 12, 4, 'a', 'a', 'a'),
(53, '2024-08-09', '07:30:00', 16, 12, 6, 'nada', 'nada', 'nada');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `turnos`
--
ALTER TABLE `turnos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_profesional` (`id_prof`),
  ADD KEY `fk_turno_paciente` (`paciente`),
  ADD KEY `fk_motivo_actividad` (`motivo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `turnos`
--
ALTER TABLE `turnos`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `turnos`
--
ALTER TABLE `turnos`
  ADD CONSTRAINT `fk_motivo_actividad` FOREIGN KEY (`motivo`) REFERENCES `actividades` (`id`),
  ADD CONSTRAINT `fk_profesional` FOREIGN KEY (`id_prof`) REFERENCES `profesional` (`id_prof`),
  ADD CONSTRAINT `fk_turno_paciente` FOREIGN KEY (`paciente`) REFERENCES `paciente` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
