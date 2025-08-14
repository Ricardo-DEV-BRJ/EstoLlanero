-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-08-2025 a las 05:02:30
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
-- Base de datos: `pruebasphp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `ruta_imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id`, `nombre`, `ruta_imagen`) VALUES
(5, 'ricardito', '1755140441_4ccf1b0c53b66529e865.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `genero` varchar(10) DEFAULT NULL,
  `pais` varchar(50) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT current_timestamp(),
  `activo` tinyint(1) DEFAULT 1,
  `saldo` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `email`, `fecha_nacimiento`, `genero`, `pais`, `fecha_registro`, `activo`, `saldo`) VALUES
(1, 'Juan', 'Pérez', 'juan.perez@example.com', '1990-05-15', 'Masculino', 'México', '2023-01-10 09:30:00', 1, 1250.50),
(2, 'María', 'Gómez', 'maria.gomez@example.com', '1985-08-22', 'Femenino', 'España', '2023-02-15 14:20:00', 1, 850.75),
(3, 'Carlos', 'López', 'carlos.lopez@example.com', '1992-11-30', 'Masculino', 'Argentina', '2023-03-05 11:15:00', 0, 320.00),
(4, 'Ana', 'Martínez', 'ana.martinez@example.com', '1988-04-18', 'Femenino', 'Colombia', '2023-01-22 16:45:00', 1, 2100.00),
(5, 'Luis', 'Rodríguez', 'luis.rodriguez@example.com', '1995-07-12', 'Masculino', 'Chile', '2023-04-01 10:00:00', 1, 500.25),
(6, 'Sofía', 'Hernández', 'sofia.hernandez@example.com', '1991-09-25', 'Femenino', 'México', '2023-02-28 13:30:00', 0, 75.50),
(7, 'Pedro', 'García', 'pedro.garcia@example.com', '1987-12-05', 'Masculino', 'Perú', '2023-03-15 08:45:00', 1, 1800.00),
(8, 'Laura', 'Díaz', 'laura.diaz@example.com', '1993-06-08', 'Femenino', 'España', '2023-01-05 17:20:00', 1, 950.30),
(9, 'Jorge', 'Sánchez', 'jorge.sanchez@example.com', '1994-03-20', 'Masculino', 'Argentina', '2023-04-10 12:10:00', 0, 420.75),
(10, 'Mónica', 'Ramírez', 'monica.ramirez@example.com', '1989-10-15', 'Femenino', 'Colombia', '2023-02-05 15:35:00', 1, 1350.00);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
