-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-08-2024 a las 02:16:42
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
-- Estructura de tabla para la tabla `parametro_sistema`
--

CREATE TABLE `parametro_sistema` (
  `id` int(11) NOT NULL,
  `inst` varchar(255) NOT NULL,
  `razon_social` varchar(255) NOT NULL,
  `c_interno` int(11) NOT NULL,
  `c_pami` int(11) NOT NULL,
  `cuit` int(11) NOT NULL,
  `u_efect` varchar(255) NOT NULL,
  `clave_efect` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `boca_ate` int(11) NOT NULL,
  `dir` varchar(255) NOT NULL,
  `localidad` varchar(255) NOT NULL,
  `cod_sucursal` int(11) NOT NULL,
  `tel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `parametro_sistema`
--
ALTER TABLE `parametro_sistema`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `parametro_sistema`
--
ALTER TABLE `parametro_sistema`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;