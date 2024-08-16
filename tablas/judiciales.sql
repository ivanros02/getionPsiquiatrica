-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-07-2024 a las 17:41:09
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
-- Estructura de tabla para la tabla `judiciales`
--

CREATE TABLE `judiciales` (
  `id_paciente` int(255) NOT NULL,
  `juzgado` int(255) NOT NULL,
  `secre` int(255) NOT NULL,
  `cura` int(255) NOT NULL,
  `tribu` int(255) NOT NULL,
  `t_juicio` int(11) NOT NULL,
  `vencimiento` date NOT NULL,
  `obs` varchar(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `judiciales`
--

INSERT INTO `judiciales` (`id_paciente`, `juzgado`, `secre`, `cura`, `tribu`, `t_juicio`, `vencimiento`, `obs`, `id`) VALUES
(16, 1, 1, 1, 1, 1, '2024-07-17', 'holi', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `judiciales`
--
ALTER TABLE `judiciales`
  ADD PRIMARY KEY (`id`,`id_paciente`),
  ADD KEY `fk_judiciales_paciente` (`id_paciente`),
  ADD KEY `fk_judiciales_juzgado` (`juzgado`),
  ADD KEY `fk_judiciales_secretaria` (`secre`),
  ADD KEY `fk_judiciales_curaduria` (`cura`),
  ADD KEY `fk_judiciales_tribunales` (`tribu`),
  ADD KEY `fk_judiciales_tipo_juicio` (`t_juicio`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `judiciales`
--
ALTER TABLE `judiciales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `judiciales`
--
ALTER TABLE `judiciales`
  ADD CONSTRAINT `fk_judiciales_curaduria` FOREIGN KEY (`cura`) REFERENCES `curaduria` (`id`),
  ADD CONSTRAINT `fk_judiciales_juzgado` FOREIGN KEY (`juzgado`) REFERENCES `juzgado` (`id`),
  ADD CONSTRAINT `fk_judiciales_paciente` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id`),
  ADD CONSTRAINT `fk_judiciales_secretaria` FOREIGN KEY (`secre`) REFERENCES `secretaria` (`id`),
  ADD CONSTRAINT `fk_judiciales_tipo_juicio` FOREIGN KEY (`t_juicio`) REFERENCES `t_juicio` (`id`),
  ADD CONSTRAINT `fk_judiciales_tribunales` FOREIGN KEY (`tribu`) REFERENCES `curaduria` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
