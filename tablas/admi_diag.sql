-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-10-2024 a las 18:28:11
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
-- Estructura de tabla para la tabla `admi_diag`
--

CREATE TABLE `admi_diag` (
  `id` int(11) NOT NULL,
  `id_paciente` int(255) NOT NULL,
  `impresion_naturaleza` varchar(255) NOT NULL,
  `impresion_situacion` varchar(255) NOT NULL,
  `impresion_conciencia` varchar(255) NOT NULL,
  `impresion_expectativas` varchar(255) NOT NULL,
  `diagnostico_clinico` varchar(255) NOT NULL,
  `diagnostico_gravedad` varchar(255) NOT NULL,
  `factores_desencadenantes` varchar(255) NOT NULL,
  `personalidad_premorbida` varchar(255) NOT NULL,
  `incapacidad_social` varchar(255) NOT NULL,
  `indicaciones` varchar(255) NOT NULL,
  `pronostico` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `admi_diag`
--

INSERT INTO `admi_diag` (`id`, `id_paciente`, `impresion_naturaleza`, `impresion_situacion`, `impresion_conciencia`, `impresion_expectativas`, `diagnostico_clinico`, `diagnostico_gravedad`, `factores_desencadenantes`, `personalidad_premorbida`, `incapacidad_social`, `indicaciones`, `pronostico`) VALUES
(2, 150, 'test', 'test', 'test', 'test', 'test', 'test', 'test', 'test', 'test', 'test', 'test');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admi_diag`
--
ALTER TABLE `admi_diag`
  ADD PRIMARY KEY (`id`,`id_paciente`),
  ADD KEY `fk_admision_diag_paci` (`id_paciente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admi_diag`
--
ALTER TABLE `admi_diag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `admi_diag`
--
ALTER TABLE `admi_diag`
  ADD CONSTRAINT `fk_admision_diag_paci` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
