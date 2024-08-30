-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-08-2024 a las 22:23:01
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
-- Estructura de tabla para la tabla `hc_admision_ambulatorio`
--

CREATE TABLE `hc_admision_ambulatorio` (
  `id` int(11) NOT NULL,
  `id_paciente` int(255) NOT NULL,
  `id_responsable` int(255) NOT NULL,
  `id_prof` int(11) NOT NULL,
  `id_diag_amb` int(11) NOT NULL,
  `asc_psiquico` varchar(255) NOT NULL,
  `act_psiquica` varchar(255) NOT NULL,
  `act` varchar(255) NOT NULL,
  `orientacion` varchar(255) NOT NULL,
  `conciencia` varchar(255) NOT NULL,
  `memoria` varchar(255) NOT NULL,
  `atencion` varchar(255) NOT NULL,
  `pensamiento` varchar(255) NOT NULL,
  `cont_pensamiento` varchar(255) NOT NULL,
  `sensopercepcion` varchar(255) NOT NULL,
  `afectividad` varchar(255) NOT NULL,
  `inteligencia` varchar(255) NOT NULL,
  `juicio` varchar(255) NOT NULL,
  `esfinteres` varchar(255) NOT NULL,
  `tratamiento` varchar(255) NOT NULL,
  `evolucion` varchar(255) NOT NULL,
  `hc_cada_medi` varchar(255) NOT NULL,
  `hc_desc_medi` varchar(255) NOT NULL,
  `hc_fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `hc_admision_ambulatorio`
--
ALTER TABLE `hc_admision_ambulatorio`
  ADD PRIMARY KEY (`id`,`id_paciente`),
  ADD KEY `fk_hc_paciente` (`id_paciente`),
  ADD KEY `fk_hc_parent` (`id_responsable`),
  ADD KEY `fk_prof_hc` (`id_prof`),
  ADD KEY `fK_admision_amb_diag` (`id_diag_amb`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `hc_admision_ambulatorio`
--
ALTER TABLE `hc_admision_ambulatorio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `hc_admision_ambulatorio`
--
ALTER TABLE `hc_admision_ambulatorio`
  ADD CONSTRAINT `fK_admision_amb_diag` FOREIGN KEY (`id_diag_amb`) REFERENCES `diag` (`id`),
  ADD CONSTRAINT `fk_hc_paciente` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id`),
  ADD CONSTRAINT `fk_hc_parent` FOREIGN KEY (`id_responsable`) REFERENCES `responsable` (`id`),
  ADD CONSTRAINT `fk_prof_hc` FOREIGN KEY (`id_prof`) REFERENCES `profesional` (`id_prof`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
