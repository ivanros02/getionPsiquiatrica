-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-09-2024 a las 23:08:18
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
-- Estructura de tabla para la tabla `modalidad`
--

CREATE TABLE `modalidad` (
  `id` int(11) NOT NULL,
  `codigo` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `modalidad`
--

INSERT INTO `modalidad` (`id`, `codigo`, `descripcion`) VALUES
(1, '1', 'Atencion programada a domicilio'),
(2, '2', 'Atencion domiciliaria de urgencia'),
(3, '3', 'Atencion telefonica'),
(4, '4', 'Consultorio externo'),
(5, '5', 'Hospital de dia jornada simple'),
(6, '6', 'Hospital de dia jornada completa'),
(7, '7', 'Atencion en jurisd.alejadas de c.urbanos'),
(8, '8', 'Viviendia Asistida'),
(9, '9', 'Residencia Transitoria'),
(10, '10', 'MODULO DE CENTRO DE DIA (DIARIO)'),
(11, '11', 'Internacion Cronica'),
(12, '12', 'Internacion Aguda'),
(13, '13', 'OME'),
(14, '14', 'ATENCION A LA CRISIS'),
(15, '15', 'EMERGENCIAS'),
(16, '16', 'CLINICA INTEGRAL');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `modalidad`
--
ALTER TABLE `modalidad`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `modalidad`
--
ALTER TABLE `modalidad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
