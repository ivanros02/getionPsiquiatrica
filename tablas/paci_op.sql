-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-09-2024 a las 14:03:50
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
-- Estructura de tabla para la tabla `paci_op`
--

CREATE TABLE `paci_op` (
  `id` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `op` bigint(255) NOT NULL,
  `cant` int(11) NOT NULL,
  `modalidad_op` int(255) NOT NULL,
  `fecha_vencimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paci_op`
--

INSERT INTO `paci_op` (`id`, `id_paciente`, `fecha`, `op`, `cant`, `modalidad_op`, `fecha_vencimiento`) VALUES
(4, 131, '2024-08-27', 9925850389, 6, 4, '2025-02-23'),
(5, 134, '2024-08-19', 9925850389, 6, 11, '2025-02-15'),
(6, 133, '2024-08-05', 9925850389, 6, 12, '2025-02-01'),
(8, 133, '2024-08-22', 9925857388, 6, 11, '2025-02-18');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `paci_op`
--
ALTER TABLE `paci_op`
  ADD PRIMARY KEY (`id`,`id_paciente`),
  ADD KEY `fk_paci_op` (`id_paciente`),
  ADD KEY `fk_op_modalidad` (`modalidad_op`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `paci_op`
--
ALTER TABLE `paci_op`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `paci_op`
--
ALTER TABLE `paci_op`
  ADD CONSTRAINT `fk_op_modalidad` FOREIGN KEY (`modalidad_op`) REFERENCES `modalidad` (`id`),
  ADD CONSTRAINT `fk_paci_op` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
