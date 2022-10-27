-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-10-2022 a las 02:59:46
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
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `rfc` varchar(14) COLLATE utf8_spanish_ci NOT NULL,
  `nom` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `apellidoP` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `apellidoM` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `curp` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `fechaNac` date NOT NULL,
  `foto` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  `genero` enum('Masculino','Femenino') COLLATE utf8_spanish_ci NOT NULL,
  `id_ejecutivo` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `rfc`, `nom`, `apellidoP`, `apellidoM`, `curp`, `telefono`, `email`, `password`, `fechaNac`, `foto`, `genero`, `id_ejecutivo`) VALUES
(1, 'HAYDNRUTI3728', 'Juan Pablo', 'Chipres', 'Arteaga', 'CIAJ020917HCMHRNA7', '3143524724', 'juanpablochipresarteaga@gmail.com', '$2y$10$o.RJZ8MytjnYgeCiZCgF3.GeNOZr4S3D8.2Zin2p6ei40VewZRsxW', '2002-09-17', NULL, 'Masculino', 2018963);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta`
--

CREATE TABLE `cuenta` (
  `numCta` int(16) NOT NULL,
  `saldo` float(10,2) DEFAULT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cuenta`
--

INSERT INTO `cuenta` (`numCta`, `saldo`, `id_cliente`) VALUES
(843424724, 2000.00, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejecutivos`
--

CREATE TABLE `ejecutivos` (
  `id_ejecutivo` int(11) NOT NULL,
  `nom` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `num_ejecutivo` int(8) NOT NULL,
  `email` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ejecutivos`
--

INSERT INTO `ejecutivos` (`id_ejecutivo`, `nom`, `num_ejecutivo`, `email`, `password`) VALUES
(2018963, 'Juan Pablo Chipres', 20180961, 'jchipres@ucol.mx', '$2y$10$zCDr9y5zS9TpYKgNuVAdJ.KF4/oi7yuD9m9v7IyuytG6VO5ZXCuX2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE `movimientos` (
  `id_movimiento` int(11) NOT NULL,
  `numCta` int(16) NOT NULL,
  `tipo` enum('Deposito','Retiro') NOT NULL,
  `monto` float(10,2) NOT NULL,
  `fecha_hora` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `movimientos`
--

INSERT INTO `movimientos` (`id_movimiento`, `numCta`, `tipo`, `monto`, `fecha_hora`) VALUES
(1, 843424724, 'Deposito', 2500.00, '2022-10-25 21:26:57'),
(2, 843424724, 'Retiro', 700.00, '2022-10-25 21:27:41'),
(3, 843424724, 'Retiro', 700.00, '2022-10-25 21:27:41');

--
-- Disparadores `movimientos`
--
DELIMITER $$
CREATE TRIGGER `tr_saldo` AFTER INSERT ON `movimientos` FOR EACH ROW IF(movimientos.tipo) = 'Deposito' THEN
UPDATE cuenta SET cuenta.saldo = (movimientos.monto) WHERE cuenta.numCta=(movimientos.numCta);
END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `id_prestamo` int(11) NOT NULL,
  `numCta` int(16) NOT NULL,
  `monto` float(10,2) NOT NULL,
  `interes` float(4,2) NOT NULL,
  `fechaInicial` date NOT NULL,
  `fechaTermino` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `id_ejecutivo` (`id_ejecutivo`);

--
-- Indices de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD PRIMARY KEY (`numCta`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `ejecutivos`
--
ALTER TABLE `ejecutivos`
  ADD PRIMARY KEY (`id_ejecutivo`);

--
-- Indices de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD PRIMARY KEY (`id_movimiento`),
  ADD KEY `numCta` (`numCta`);

--
-- Indices de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`id_prestamo`),
  ADD KEY `numCta` (`numCta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `id_movimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `id_prestamo` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`id_ejecutivo`) REFERENCES `ejecutivos` (`id_ejecutivo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD CONSTRAINT `cuenta_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD CONSTRAINT `movimientos_ibfk_1` FOREIGN KEY (`numCta`) REFERENCES `cuenta` (`numCta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD CONSTRAINT `prestamos_ibfk_1` FOREIGN KEY (`numCta`) REFERENCES `cuenta` (`numCta`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
