-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-05-2024 a las 22:35:49
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
  `especialidad` varchar(255) NOT NULL,
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

INSERT INTO `profesional` (`id_prof`, `nombreYapellido`, `especialidad`, `domicilio`, `localidad`, `codigo_pos`, `matricula_p`, `matricula_n`, `telefono`, `email`) VALUES
(1, 'WALTER', 'TEST111', '143', 'Villa Espana', '1886', '123', '345', 2147483647, 'ivanrosendo1102@gmail.com'),
(3, 'IVAN', 'TEST', '143', 'Berazategui', '1886', '123', '345', 2147483647, 'TEST34512ttt@gmail.com'),
(8, 'WALTER ROSENDO', 'PRUEBA', '143', 'Berazategui', '1886', '123', '345', 1139114579, 'ivanrosendo@gmail.com'),
(9, 'LIVINGSTON ESTELA BEATRIZ', 'TEST', '143', 'Berazategui', '1886', '123', '345', 2147483647, 'ivanrosendo@gmail.com'),
(10, 'PEREZ MURGA CARLOS ISMAEL', 'Psiquiatria', '2651', 'Villa Espana', '1886', '123', '345', 2147483647, 'TEST34@gmail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `profesional`
--
ALTER TABLE `profesional`
  ADD PRIMARY KEY (`id_prof`),
  ADD KEY `especialidad` (`especialidad`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `profesional`
--
ALTER TABLE `profesional`
  MODIFY `id_prof` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
