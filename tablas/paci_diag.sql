-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-08-2024 a las 21:18:24
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
-- Estructura de tabla para la tabla `paci_diag`
--

CREATE TABLE `paci_diag` (
  `id_paciente` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `codigo` int(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paci_diag`
--

INSERT INTO `paci_diag` (`id_paciente`, `fecha`, `codigo`, `id`) VALUES
(16, '2024-07-17', 1, 1),
(16, '2024-07-29', 2, 3),
(16, '2024-08-12', 2, 4),
(69, '2024-08-12', 2, 5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `paci_diag`
--
ALTER TABLE `paci_diag`
  ADD PRIMARY KEY (`id`,`id_paciente`),
  ADD KEY `fk_diag_paci_id_paci` (`id_paciente`),
  ADD KEY `fk_diag_paci` (`codigo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `paci_diag`
--
ALTER TABLE `paci_diag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `paci_diag`
--
ALTER TABLE `paci_diag`
  ADD CONSTRAINT `fk_diag_paci` FOREIGN KEY (`codigo`) REFERENCES `diag` (`id`),
  ADD CONSTRAINT `fk_diag_paci_id_paci` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
