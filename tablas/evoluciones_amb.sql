-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-08-2024 a las 14:56:08
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
-- Estructura de tabla para la tabla `evoluciones_amb`
--

CREATE TABLE `evoluciones_amb` (
  `id_paciente` int(255) NOT NULL,
  `motivo` varchar(255) NOT NULL,
  `antecedentes` varchar(255) NOT NULL,
  `estado_actual` varchar(255) NOT NULL,
  `familia` varchar(255) NOT NULL,
  `diag` int(255) NOT NULL,
  `objetivo` varchar(255) NOT NULL,
  `duracion` varchar(255) NOT NULL,
  `frecuencia` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `evoluciones_amb`
--
ALTER TABLE `evoluciones_amb`
  ADD PRIMARY KEY (`id`,`id_paciente`),
  ADD KEY `fk_diag_evoluciones` (`diag`),
  ADD KEY `fk_id_paciente_evo` (`id_paciente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `evoluciones_amb`
--
ALTER TABLE `evoluciones_amb`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `evoluciones_amb`
--
ALTER TABLE `evoluciones_amb`
  ADD CONSTRAINT `fk_diag_evoluciones` FOREIGN KEY (`diag`) REFERENCES `diag` (`id`),
  ADD CONSTRAINT `fk_id_paciente_evo` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
