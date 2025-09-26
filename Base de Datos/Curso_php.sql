-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 19-09-2025 a las 19:04:17
-- Versión del servidor: 8.0.42-0ubuntu0.20.04.1
-- Versión de PHP: 8.3.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `Curso_php`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `id` int NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Root', 'Super Administrador del sistema'),
(2, 'Administrador', 'Adminstrador de segundo nivel '),
(3, 'Coordinador', 'Administrador de Tercer Nivel'),
(4, 'Técnico ', 'Personas con perfil basico ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `primer_nombre` varchar(100) NOT NULL,
  `segundo_nombre` varchar(100) NOT NULL,
  `primer_apellido` varchar(100) NOT NULL,
  `segundo_apellido` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `cedula` bigint NOT NULL,
  `telefono_principal` varchar(100) NOT NULL,
  `telefono_segundario` varchar(100) NOT NULL,
  `id_perfil` int DEFAULT NULL,
  `estado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `clave`, `primer_nombre`, `segundo_nombre`, `primer_apellido`, `segundo_apellido`, `correo`, `cedula`, `telefono_principal`, `telefono_segundario`, `id_perfil`, `estado`) VALUES
(1, 'danny', 'Danny16029567*', 'Danny', 'Jóse', 'Jimenez', 'Gutierrez', 'dennaly88@gmail.com', 16029567, '04242814455', '02392125304', 1, 'Activo'),
(2, 'admin01', 'clave456', 'Ana', 'Maria', 'Diaz', 'Suarez', 'ana@example.com', 87654321, '555-8765', '555-4321', 2, 'Activo'),
(3, 'coordinador01', 'clave789', 'Luis', 'Fernando', 'Ramirez', 'Lopez', 'luis@example.com', 98765432, '555-1122', '555-3344', 3, 'Activo'),
(4, 'tecnico01', 'clave101', 'Sofia', 'Isabel', 'Morales', 'Castro', 'sofia@example.com', 23456789, '555-5566', '555-7788', 4, 'Activo'),
(5, 'admin02', 'clave112', 'Pedro', 'Jose', 'Torres', 'Vargas', 'pedro@example.com', 34567890, '555-9900', '555-1100', 2, 'Activo'),
(6, 'tecnico02', 'clave334', 'Elena', 'Gabriela', 'Jimenez', 'Rojas', 'elena@example.com', 45678901, '555-2233', '555-4455', 4, 'Activo'),
(7, 'coordinador02', 'clave556', 'Jorge', 'Andres', 'Mendez', 'Silva', 'jorge@example.com', 56789012, '555-6677', '555-8899', 3, 'Activo'),
(8, 'tecnico03', 'clave778', 'Laura', 'Patricia', 'Herrera', 'Ortega', 'laura@example.com', 67890123, '555-0011', '555-2200', 4, 'Activo'),
(9, 'superadmin02', 'clave990', 'Mario', 'David', 'Fuentes', 'Cano', 'mario@example.com', 78901234, '555-3322', '555-1122', 1, 'Activo'),
(10, 'tecnico04', 'clave1234', 'Valeria', 'Camila', 'Guerra', 'Marin', 'valeria@example.com', 89012345, '555-5544', '555-6655', 4, 'Activo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_perfil` (`id_perfil`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_perfil` FOREIGN KEY (`id_perfil`) REFERENCES `perfiles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
