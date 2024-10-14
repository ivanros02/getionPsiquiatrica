-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-10-2024 a las 14:59:57
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
-- Estructura de tabla para la tabla `antecedentes_personales`
--

CREATE TABLE `antecedentes_personales` (
  `id` int(11) NOT NULL,
  `id_paciente` int(255) NOT NULL,
  `complicaciones_nacimiento` varchar(255) NOT NULL,
  `desarrollo_ninez` varchar(255) NOT NULL,
  `enfermedades_principales` varchar(255) NOT NULL,
  `sistema_nervioso` varchar(255) NOT NULL,
  `estudios` varchar(255) NOT NULL,
  `actividad_sexual` varchar(255) NOT NULL,
  `historial_marital` varchar(255) NOT NULL,
  `embarazos_hijos` varchar(255) NOT NULL,
  `interrelacion_familiar` varchar(255) NOT NULL,
  `actividades_laborales` varchar(255) NOT NULL,
  `habitos` varchar(255) NOT NULL,
  `intereses` varchar(255) NOT NULL,
  `actividad_social` varchar(255) NOT NULL,
  `creencias_religiosas` varchar(255) NOT NULL,
  `toxicomanias` varchar(255) NOT NULL,
  `rasgos_personalidad` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `antecedentes_personales`
--

INSERT INTO `antecedentes_personales` (`id`, `id_paciente`, `complicaciones_nacimiento`, `desarrollo_ninez`, `enfermedades_principales`, `sistema_nervioso`, `estudios`, `actividad_sexual`, `historial_marital`, `embarazos_hijos`, `interrelacion_familiar`, `actividades_laborales`, `habitos`, `intereses`, `actividad_social`, `creencias_religiosas`, `toxicomanias`, `rasgos_personalidad`) VALUES
(3, 150, 'test', 'test', 'test', 'test', 'test', 'test', 'test', 'test', 'test', 'test', 'test', 'test', 'test', 'test', 'test', 'test');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `antecedentes_personales`
--
ALTER TABLE `antecedentes_personales`
  ADD PRIMARY KEY (`id`,`id_paciente`),
  ADD KEY `fk_antecendes_personales_paciente` (`id_paciente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `antecedentes_personales`
--
ALTER TABLE `antecedentes_personales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `antecedentes_personales`
--
ALTER TABLE `antecedentes_personales`
  ADD CONSTRAINT `fk_antecendes_personales_paciente` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
