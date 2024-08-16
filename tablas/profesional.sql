-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-06-2024 a las 01:27:06
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
-- Estructura de tabla para la tabla `profesional`
--

CREATE TABLE `profesional` (
  `id_prof` int(11) NOT NULL,
  `nombreYapellido` varchar(255) NOT NULL,
  `id_especialidad` int(11) NOT NULL,
  `domicilio` varchar(255) NOT NULL,
  `localidad` varchar(255) NOT NULL,
  `codigo_pos` varchar(255) NOT NULL,
  `matricula_p` varchar(255) NOT NULL,
  `matricula_n` varchar(255) NOT NULL,
  `telefono` int(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `profesional`
--

INSERT INTO `profesional` (`id_prof`, `nombreYapellido`, `id_especialidad`, `domicilio`, `localidad`, `codigo_pos`, `matricula_p`, `matricula_n`, `telefono`, `email`) VALUES
(11, 'PEREZ MURGA CARLOS ISMAEL', 22, '143', 'Berazategui', '1886', '124', '345', 1139114579, 'ivanrosendo1102@gmail.com'),
(12, 'WALTER ROSENDO', 25, '143', 'Villa Espana', '1886', '218', '796', 243567189, 'infowss@gmail.com'),
(15, 'LIVINGSTON ESTELA BEATRIZ', 22, '2651', 'Villa Espana', '1886', '123', '222', 2147483647, 'TEST34@gmail.com'),
(16, 'MONICA CEJAS', 25, '143', 'Berazategui', '1886', '123', '345', 2147483647, 'moni@gmail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `profesional`
--
ALTER TABLE `profesional`
  ADD PRIMARY KEY (`id_prof`),
  ADD KEY `especialidad` (`id_especialidad`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `profesional`
--
ALTER TABLE `profesional`
  MODIFY `id_prof` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `profesional`
--
ALTER TABLE `profesional`
  ADD CONSTRAINT `fk_profesional_especialidad` FOREIGN KEY (`id_especialidad`) REFERENCES `especialidad` (`id_especialidad`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
