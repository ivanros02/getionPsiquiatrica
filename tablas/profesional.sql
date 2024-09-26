-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-09-2024 a las 01:45:25
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
  `email` varchar(255) NOT NULL,
  `tipo_doc` varchar(255) NOT NULL,
  `nro_doc` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `profesional`
--

INSERT INTO `profesional` (`id_prof`, `nombreYapellido`, `id_especialidad`, `domicilio`, `localidad`, `codigo_pos`, `matricula_p`, `matricula_n`, `telefono`, `email`, `tipo_doc`, `nro_doc`) VALUES
(12, 'WALTER ROSENDO', 1000, '143', 'Villa Espana', '1886', '218', '796', 243567189, 'infowss@gmail.com', 'DNI', 21879630),
(15, 'LIVINGSTON ESTELA BEATRIZ', 1000, '2651', 'Villa Espana', '1886', '123', '222', 2147483647, 'TEST34@gmail.com', 'LE', 7680072),
(16, 'MONICA CEJAS', 1000, '143', 'Berazategui', '1886', '123', '345', 2147483647, 'moni@gmail.com', 'LE', 7680072),
(17, 'VALENTIN ROSENDO', 1000, '143', 'Berazategui', '1886', '1232', '3453', 2147483647, 'valentin@gmail.com', 'LE', 7680072),
(18, 'IVAN ROSENDO', 1000, '2651', 'Berazategui', '1886', '777', '743', 1139114579, 'ivanrosendo1102@gmail.com', 'DNI', 44379377),
(19, 'Zoe', 1000, '143', 'Villa Espana', '1886', '123', '345', 1139114579, 'ivanrosendo1102@gmail.com', 'LE', 7680072);

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
  MODIFY `id_prof` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
