-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-10-2024 a las 14:38:17
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
-- Estructura de tabla para la tabla `antecedentes_familiares`
--

CREATE TABLE `antecedentes_familiares` (
  `id` int(11) NOT NULL,
  `id_paciente` int(255) NOT NULL,
  `antecedentes_familiar_1` varchar(255) NOT NULL,
  `antecedentes_familiar_2` varchar(255) NOT NULL,
  `antecedentes_familiar_3` varchar(255) NOT NULL,
  `antecedentes_familiar_4` varchar(255) NOT NULL,
  `antecedentes_familiar_5` varchar(255) NOT NULL,
  `antecedentes_familiar_6` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `antecedentes_familiares`
--

INSERT INTO `antecedentes_familiares` (`id`, `id_paciente`, `antecedentes_familiar_1`, `antecedentes_familiar_2`, `antecedentes_familiar_3`, `antecedentes_familiar_4`, `antecedentes_familiar_5`, `antecedentes_familiar_6`) VALUES
(3, 150, 'A', 'A', 'A', 'AA', 'AA', 'BB');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `antecedentes_familiares`
--
ALTER TABLE `antecedentes_familiares`
  ADD PRIMARY KEY (`id`,`id_paciente`),
  ADD KEY `fk_paciente_antecedentes_familiares` (`id_paciente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `antecedentes_familiares`
--
ALTER TABLE `antecedentes_familiares`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `antecedentes_familiares`
--
ALTER TABLE `antecedentes_familiares`
  ADD CONSTRAINT `fk_paciente_antecedentes_familiares` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
