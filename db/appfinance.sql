-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-10-2022 a las 01:01:18
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `appfinance`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta`
--

CREATE TABLE `cuenta` (
  `id_cuenta` int(11) NOT NULL,
  `numCta` int(11) NOT NULL,
  `saldo` float(10,2) NOT NULL,
  `date` date NOT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `depositos`
--

CREATE TABLE `depositos` (
  `id_deposito` int(11) NOT NULL,
  `id_cuenta` int(11) NOT NULL,
  `monto` float(10,2) NOT NULL,
  `fecha_hora` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejecutivos`
--

CREATE TABLE `ejecutivos` (
  `id_ejecutivo` int(11) NOT NULL,
  `nombre` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `num_ejecutivo` int(8) NOT NULL,
  `email` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ejecutivos`
--

INSERT INTO `ejecutivos` (`id_ejecutivo`, `nombre`, `num_ejecutivo`, `email`, `password`) VALUES
(2018963, 'Juan Pablo Chipres', 20180961, 'jchipres@ucol.mx', '$2y$10$zCDr9y5zS9TpYKgNuVAdJ.KF4/oi7yuD9m9v7IyuytG6VO5ZXCuX2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero`
--

CREATE TABLE `genero` (
  `id_genero` tinyint(3) NOT NULL,
  `nombre` varchar(16) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `genero`
--

INSERT INTO `genero` (`id_genero`, `nombre`) VALUES
(1, 'masculino'),
(2, 'femenino');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `id_prestamo` int(11) NOT NULL,
  `id_cuenta` int(11) NOT NULL,
  `monto` float(10,2) NOT NULL,
  `interes` float(4,2) NOT NULL,
  `fechaInicial` date NOT NULL,
  `fechaTermino` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `retiros`
--

CREATE TABLE `retiros` (
  `id_retiro` int(11) NOT NULL,
  `id_cuenta` int(11) NOT NULL,
  `monto` float(10,2) NOT NULL,
  `fecha_hora` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_cliente` int(11) NOT NULL,
  `rfc` varchar(14) COLLATE utf8_spanish_ci NOT NULL,
  `nombres` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `apellidoP` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `apellidoM` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `curp` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `fechaNac` date NOT NULL,
  `foto` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_genero` tinyint(3) NOT NULL,
  `id_ejecutivo` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_cliente`, `rfc`, `nombres`, `apellidoP`, `apellidoM`, `curp`, `telefono`, `email`, `password`, `fechaNac`, `foto`, `id_genero`, `id_ejecutivo`) VALUES
(5, 'HAYDNRUTI3728', 'Juan Pablo', 'Chipres', 'Arteaga', 'CIAJ020917HCMHRNA7', '3143524724', 'juanpablochipresarteaga@gmail.com', '$2y$10$duE35vRkfmkCDuMeM/hmFubYEEe0uZ0Dt5clisVNC/aGupgnRbtJC', '2002-09-17', NULL, 1, 2018963);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD PRIMARY KEY (`id_cuenta`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `depositos`
--
ALTER TABLE `depositos`
  ADD PRIMARY KEY (`id_deposito`),
  ADD KEY `id_cuenta` (`id_cuenta`);

--
-- Indices de la tabla `ejecutivos`
--
ALTER TABLE `ejecutivos`
  ADD PRIMARY KEY (`id_ejecutivo`),
  ADD KEY `num_ejecutivo` (`num_ejecutivo`);

--
-- Indices de la tabla `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`id_genero`);

--
-- Indices de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`id_prestamo`),
  ADD KEY `id_cuenta` (`id_cuenta`);

--
-- Indices de la tabla `retiros`
--
ALTER TABLE `retiros`
  ADD PRIMARY KEY (`id_retiro`),
  ADD KEY `id_cuenta` (`id_cuenta`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `id_genero` (`id_genero`,`id_ejecutivo`),
  ADD KEY `id_ejecutivo` (`id_ejecutivo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  MODIFY `id_cuenta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `depositos`
--
ALTER TABLE `depositos`
  MODIFY `id_deposito` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ejecutivos`
--
ALTER TABLE `ejecutivos`
  MODIFY `id_ejecutivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2018964;

--
-- AUTO_INCREMENT de la tabla `genero`
--
ALTER TABLE `genero`
  MODIFY `id_genero` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `id_prestamo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `retiros`
--
ALTER TABLE `retiros`
  MODIFY `id_retiro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD CONSTRAINT `cuenta_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `usuarios` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `depositos`
--
ALTER TABLE `depositos`
  ADD CONSTRAINT `depositos_ibfk_1` FOREIGN KEY (`id_cuenta`) REFERENCES `cuenta` (`id_cuenta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD CONSTRAINT `prestamos_ibfk_1` FOREIGN KEY (`id_cuenta`) REFERENCES `cuenta` (`id_cuenta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `retiros`
--
ALTER TABLE `retiros`
  ADD CONSTRAINT `retiros_ibfk_1` FOREIGN KEY (`id_cuenta`) REFERENCES `cuenta` (`id_cuenta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_genero`) REFERENCES `genero` (`id_genero`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`id_ejecutivo`) REFERENCES `ejecutivos` (`id_ejecutivo`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
