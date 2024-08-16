-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-07-2024 a las 18:17:05
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
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `obra_social` int(255) NOT NULL,
  `fecha_nac` date NOT NULL,
  `sexo` varchar(255) NOT NULL,
  `domicilio` varchar(255) NOT NULL,
  `localidad` varchar(255) NOT NULL,
  `partido` varchar(255) NOT NULL,
  `c_postal` int(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `tipo_doc` varchar(255) NOT NULL,
  `nro_doc` int(255) NOT NULL,
  `admision` date NOT NULL,
  `id_prof` int(255) NOT NULL,
  `benef` bigint(255) NOT NULL,
  `parentesco` varchar(2) NOT NULL,
  `hijos` int(255) NOT NULL,
  `ocupacion` varchar(255) NOT NULL,
  `tipo_afiliado` int(255) NOT NULL,
  `modalidad` int(11) NOT NULL,
  `op` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`id`, `nombre`, `obra_social`, `fecha_nac`, `sexo`, `domicilio`, `localidad`, `partido`, `c_postal`, `telefono`, `tipo_doc`, `nro_doc`, `admision`, `id_prof`, `benef`, `parentesco`, `hijos`, `ocupacion`, `tipo_afiliado`, `modalidad`, `op`) VALUES
(16, 'AVOLIO ANDRES', 4, '2024-07-16', 'Masculino', '143', 'Villa Espana', 'Berazategui', 1884, '1139114579', 'DNI', 123, '2024-07-16', 12, 10030397406, '00', 2, 'ARTES DIGITALES', 1, 1, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_obra_social_paciente` (`obra_social`),
  ADD KEY `fk_id_prof_paciente` (`id_prof`),
  ADD KEY `fk_tipo_afiliado_paciente` (`tipo_afiliado`),
  ADD KEY `fk_modalidad_paciente` (`modalidad`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD CONSTRAINT `fk_id_prof_paciente` FOREIGN KEY (`id_prof`) REFERENCES `profesional` (`id_prof`),
  ADD CONSTRAINT `fk_modalidad_paciente` FOREIGN KEY (`modalidad`) REFERENCES `modalidad` (`id`),
  ADD CONSTRAINT `fk_obra_social_paciente` FOREIGN KEY (`obra_social`) REFERENCES `obra_social` (`id`),
  ADD CONSTRAINT `fk_tipo_afiliado_paciente` FOREIGN KEY (`tipo_afiliado`) REFERENCES `tipo_afiliado` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
