-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-10-2024 a las 18:31:46
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
-- Estructura de tabla para la tabla `ex_psiquiatrico`
--

CREATE TABLE `ex_psiquiatrico` (
  `id` int(11) NOT NULL,
  `id_paciente` int(255) NOT NULL,
  `forma_presentarse` varchar(255) NOT NULL,
  `vestimenta` varchar(255) NOT NULL,
  `peso` varchar(255) NOT NULL,
  `grado_actividad` varchar(255) NOT NULL,
  `cualidad_formal` varchar(255) NOT NULL,
  `pertinente` varchar(255) NOT NULL,
  `signos_ansiedad` varchar(255) NOT NULL,
  `bradilalia` varchar(255) NOT NULL,
  `cooperativo` varchar(255) NOT NULL,
  `comunicativo` varchar(255) NOT NULL,
  `escala_actitudes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ex_psiquiatrico`
--

INSERT INTO `ex_psiquiatrico` (`id`, `id_paciente`, `forma_presentarse`, `vestimenta`, `peso`, `grado_actividad`, `cualidad_formal`, `pertinente`, `signos_ansiedad`, `bradilalia`, `cooperativo`, `comunicativo`, `escala_actitudes`) VALUES
(2, 150, 'test', 'hola', 'test', 'test', 'test', 'test', 'test', 'test', 'test', 'test', 'test');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ex_psiquiatrico`
--
ALTER TABLE `ex_psiquiatrico`
  ADD PRIMARY KEY (`id`,`id_paciente`),
  ADD KEY `fk_ex_paciente` (`id_paciente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ex_psiquiatrico`
--
ALTER TABLE `ex_psiquiatrico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ex_psiquiatrico`
--
ALTER TABLE `ex_psiquiatrico`
  ADD CONSTRAINT `fk_ex_paciente` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
