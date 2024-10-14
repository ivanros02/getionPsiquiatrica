-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-10-2024 a las 18:00:49
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
-- Estructura de tabla para la tabla `fisica`
--

CREATE TABLE `fisica` (
  `id` int(11) NOT NULL,
  `id_paciente` int(255) NOT NULL,
  `medico_tratante` int(255) NOT NULL,
  `objetivos_generales` varchar(255) NOT NULL,
  `examen_postural` varchar(255) NOT NULL,
  `examen_muscular` varchar(255) NOT NULL,
  `examen_flexibilidad` varchar(255) NOT NULL,
  `fuerza_miembros_inferiores` varchar(255) NOT NULL,
  `fuerza_miembros_superiores` varchar(255) NOT NULL,
  `equilibrio_normal` varchar(255) NOT NULL,
  `equilibrio_ojos_cerrados` varchar(255) NOT NULL,
  `equilibrio_base_sustentacion` varchar(255) NOT NULL,
  `movimiento_ms` varchar(255) NOT NULL,
  `movimiento_ml` varchar(255) NOT NULL,
  `movimiento_tronco` varchar(255) NOT NULL,
  `caminando_giros` varchar(255) NOT NULL,
  `observaciones_generales` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `fisica`
--

INSERT INTO `fisica` (`id`, `id_paciente`, `medico_tratante`, `objetivos_generales`, `examen_postural`, `examen_muscular`, `examen_flexibilidad`, `fuerza_miembros_inferiores`, `fuerza_miembros_superiores`, `equilibrio_normal`, `equilibrio_ojos_cerrados`, `equilibrio_base_sustentacion`, `movimiento_ms`, `movimiento_ml`, `movimiento_tronco`, `caminando_giros`, `observaciones_generales`) VALUES
(3, 150, 12, 'test', 'test', 'test', 'test', 'test', 'test', 'test', 'SI', 'test', 'test', 'test', 'test', 'test', 'test');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `fisica`
--
ALTER TABLE `fisica`
  ADD PRIMARY KEY (`id`,`id_paciente`),
  ADD KEY `fk_admisicion_fisica_paciente` (`id_paciente`),
  ADD KEY `fk_admisicion_fisica_medico` (`medico_tratante`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `fisica`
--
ALTER TABLE `fisica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `fisica`
--
ALTER TABLE `fisica`
  ADD CONSTRAINT `fk_admisicion_fisica_medico` FOREIGN KEY (`medico_tratante`) REFERENCES `profesional` (`id_prof`),
  ADD CONSTRAINT `fk_admisicion_fisica_paciente` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
