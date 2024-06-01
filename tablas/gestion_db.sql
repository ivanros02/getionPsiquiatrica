-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-06-2024 a las 22:04:23
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
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
  `descripcion` varchar(255) NOT NULL,
  `id` int(255) NOT NULL,
  `codigo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`descripcion`, `id`, `codigo`) VALUES
('musicoterapia', 4, '509001');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disponibilidad`
--

CREATE TABLE `disponibilidad` (
  `id` int(11) NOT NULL,
  `id_prof` int(11) NOT NULL,
  `dia_semana` varchar(255) NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `disponibilidad`
--

INSERT INTO `disponibilidad` (`id`, `id_prof`, `dia_semana`, `hora_inicio`, `hora_fin`) VALUES
(3, 1, 'Lunes', '08:00:00', '18:00:00'),
(4, 3, 'Lunes,Martes,Viernes', '08:00:00', '18:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidad`
--

CREATE TABLE `especialidad` (
  `id_especialidad` int(11) NOT NULL,
  `desc_especialidad` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `especialidad`
--

INSERT INTO `especialidad` (`id_especialidad`, `desc_especialidad`) VALUES
(22, 'musicoterapia'),
(25, 'gimnasia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obra_social`
--

CREATE TABLE `obra_social` (
  `id` int(11) NOT NULL,
  `siglas` varchar(255) NOT NULL,
  `razon_social` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `obra_social`
--

INSERT INTO `obra_social` (`id`, `siglas`, `razon_social`) VALUES
(4, 'INSSJP', 'PAMI');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `obra_social` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`id`, `nombre`, `obra_social`) VALUES
(1, 'IVAN', 'PAMI'),
(4, 'IVAN2', '1'),
(5, 'WALTER', 'PAMI'),
(6, 'MONICA', 'PAMI'),
(7, 'VALENTIN', 'PAMI'),
(8, 'WALTER NUEVO', 'PAMI');

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
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `profesional`
--

INSERT INTO `profesional` (`id_prof`, `nombreYapellido`, `id_especialidad`, `domicilio`, `localidad`, `codigo_pos`, `matricula_p`, `matricula_n`, `telefono`, `email`) VALUES
(11, 'PEREZ MURGA CARLOS ISMAEL', 22, '143', 'Berazategui', '1886', '123', '345', 1139114579, 'ivanrosendo1102@gmail.com'),
(12, 'WALTER ROSENDO', 25, '143', 'Villa Espana', '1886', '218', '796', 243567189, 'infowss@gmail.com'),
(14, 'messi', 25, '2651', 'Berazategui', '1886', '111', '222', 2147483647, 'ivanrosendo1102@gmail.com'),
(15, 'LIVINGSTON ESTELA BEATRIZ', 22, '2651', 'Villa Espana', '1886', '123', '222', 2147483647, 'TEST34@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_egreso`
--

CREATE TABLE `tipo_egreso` (
  `id` int(11) NOT NULL,
  `codigo` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_egreso`
--

INSERT INTO `tipo_egreso` (`id`, `codigo`, `descripcion`) VALUES
(1, 'AT', 'ABANDONO DE TRATAMIENTO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos`
--

CREATE TABLE `turnos` (
  `id_reserva` int(11) NOT NULL,
  `nombre_paciente` varchar(255) NOT NULL,
  `practica` int(255) NOT NULL,
  `fecha_turno` date NOT NULL,
  `fyh_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_prof` int(11) NOT NULL,
  `beneficio` int(15) NOT NULL,
  `hora` time NOT NULL,
  `title` varchar(255) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `color` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `turnos`
--

INSERT INTO `turnos` (`id_reserva`, `nombre_paciente`, `practica`, `fecha_turno`, `fyh_creacion`, `id_prof`, `beneficio`, `hora`, `title`, `start`, `end`, `color`) VALUES
(8, 'IVAN', 520, '2024-05-21', '2024-05-22 20:34:37', 3, 0, '08:00:00', 'IVAN', '2024-05-21 08:00:00', '2024-05-21 00:00:00', ''),
(9, 'WALTER', 322, '2024-05-24', '2024-05-22 20:35:06', 3, 0, '11:00:00', 'WALTER', '2024-05-24 11:00:00', '2024-05-24 00:00:00', ''),
(10, 'WALTER', 2, '2024-05-20', '2024-05-22 20:40:14', 1, 0, '09:30:00', 'WALTER', '2024-05-20 09:30:00', '2024-05-20 00:00:00', ''),
(11, 'WALTER', 322, '2024-05-27', '2024-05-26 03:58:48', 1, 0, '08:00:00', 'WALTER', '2024-05-27 08:00:00', '2024-05-27 00:00:00', ''),
(12, 'MONICA', 2, '2024-05-27', '2024-05-26 03:58:59', 1, 0, '10:30:00', 'MONICA', '2024-05-27 10:30:00', '2024-05-27 00:00:00', ''),
(13, 'IVAN', 2, '2024-05-31', '2024-05-26 03:59:12', 3, 0, '13:00:00', 'IVAN', '2024-05-31 13:00:00', '2024-05-31 00:00:00', ''),
(14, 'VALENTIN', 333, '2024-05-27', '2024-05-26 20:11:11', 1, 0, '13:00:00', 'VALENTIN', '2024-05-27 13:00:00', '2024-05-27 13:00:00', ''),
(15, 'WALTER', 333, '2024-05-27', '2024-05-26 20:28:26', 1, 0, '14:00:00', 'WALTER', '2024-05-27 14:00:00', '2024-05-27 15:00:00', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarioadmin`
--

CREATE TABLE `usuarioadmin` (
  `id` int(11) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `clave` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `clave` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `clave`) VALUES
(1, 'test', '$2y$10$nTuaorK71YC54CVEX/jOMe747g1BoUOzHr47CIX6Xe.DqWsZ/eCHK');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `disponibilidad`
--
ALTER TABLE `disponibilidad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_prof` (`id_prof`);

--
-- Indices de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  ADD PRIMARY KEY (`id_especialidad`);

--
-- Indices de la tabla `obra_social`
--
ALTER TABLE `obra_social`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `profesional`
--
ALTER TABLE `profesional`
  ADD PRIMARY KEY (`id_prof`),
  ADD KEY `especialidad` (`id_especialidad`);

--
-- Indices de la tabla `tipo_egreso`
--
ALTER TABLE `tipo_egreso`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `turnos`
--
ALTER TABLE `turnos`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `id_prof` (`id_prof`);

--
-- Indices de la tabla `usuarioadmin`
--
ALTER TABLE `usuarioadmin`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividades`
--
ALTER TABLE `actividades`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `disponibilidad`
--
ALTER TABLE `disponibilidad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  MODIFY `id_especialidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `obra_social`
--
ALTER TABLE `obra_social`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `profesional`
--
ALTER TABLE `profesional`
  MODIFY `id_prof` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `tipo_egreso`
--
ALTER TABLE `tipo_egreso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `turnos`
--
ALTER TABLE `turnos`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `usuarioadmin`
--
ALTER TABLE `usuarioadmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
