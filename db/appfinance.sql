-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-11-2022 a las 14:51:53
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
  `status` enum('1','2') COLLATE utf8_spanish_ci NOT NULL DEFAULT '1',
  `id_ejecutivo` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `rfc`, `nom`, `apellidoP`, `apellidoM`, `curp`, `telefono`, `email`, `password`, `fechaNac`, `foto`, `genero`, `status`, `id_ejecutivo`) VALUES
(10, 'HAYDNRUTI2sdd', 'Gilberto', 'Valenzuela', 'Martinez', 'CIAJ020917HCMHRN23', '3141438337', 'cknanksc@gmail.com', '$2y$10$n9ZTpZVTtDwFCiXgV.2taOyk3kW6aRHS.VUcujsXsmh80aNAaZ9ou', '2002-09-17', NULL, 'Masculino', '1', 2018963),
(11, 'DASD', 'juan', 'pablo', 'chipres', 'CIAJ020917HCMHRNA2', '3143524724', 'max@gmail.com', '$2y$10$WzKPsKtcwkPiDO7tSHNZoe7Lg30484DDa5l6lvsE8VM.O9KUJkUVm', '2002-09-18', NULL, 'Masculino', '2', 2018963),
(12, 'HAYDNRUTI122', 'juan', 'pablo', 'chipres', 'CIAJ020917HCMHRNA8', '3145738904', 'pruebaemaik@gmail.com', '$2y$10$3QYBs.rADcvy7198/Fnp6OongBLUyrFgNogTTDT7g4iWbaDWUwfM2', '2006-07-04', NULL, 'Masculino', '2', 2018963),
(14, 'CIALMKAN7767', 'Juan pablo', 'Chipres', 'Arteaga', 'CIAJ020917HCMHRNA7', '3143524724', 'juanpablochipresarteaga@gmail.com', '$2y$10$Jouzp51oUpMa/LoEByURl.trDibNrQkP4f6k/hdI4mdvDlPSmz3e.', '2002-09-17', NULL, 'Masculino', '1', 2018963);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta`
--

CREATE TABLE `cuenta` (
  `numCta` int(16) NOT NULL,
  `saldo` float(10,2) NOT NULL DEFAULT 0.00,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cuenta`
--

INSERT INTO `cuenta` (`numCta`, `saldo`, `id_cliente`) VALUES
(191909, 4900.00, 10),
(730544724, 0.00, 14),
(1922144724, 0.00, 11),
(1952208904, 0.00, 12);

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
  `tipo` enum('Deposito','Retiro','Pago') NOT NULL,
  `monto` float(10,2) NOT NULL,
  `fecha_hora` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `movimientos`
--

INSERT INTO `movimientos` (`id_movimiento`, `numCta`, `tipo`, `monto`, `fecha_hora`) VALUES
(50, 191909, 'Deposito', 4000.00, '2022-11-23 20:17:36'),
(51, 191909, 'Deposito', 1000.00, '2022-11-23 20:18:48'),
(52, 191909, 'Retiro', 100.00, '2022-11-23 20:18:57');

--
-- Disparadores `movimientos`
--
DELIMITER $$
CREATE TRIGGER `Deposito_Retiro` AFTER INSERT ON `movimientos` FOR EACH ROW IF(new.tipo = 'Deposito') THEN SET @oldsaldo=(SELECT saldo FROM cuenta WHERE numCta=new.numCta);
UPDATE cuenta SET cuenta.saldo = new.monto + @oldsaldo WHERE cuenta.numCta=new.numCta;
ELSE 
	IF(new.tipo = 'Retiro') THEN SET @oldsaldo=(SELECT saldo FROM cuenta WHERE numCta=new.numCta);
UPDATE cuenta SET cuenta.saldo = @oldsaldo - new.monto WHERE cuenta.numCta=new.numCta;
	END IF;
END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id_pago` int(11) NOT NULL,
  `numCta` int(16) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `monto` float(10,2) NOT NULL,
  `id_prestamo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Disparadores `pagos`
--
DELIMITER $$
CREATE TRIGGER `movimientos_pagos` AFTER INSERT ON `pagos` FOR EACH ROW UPDATE cuenta SET cuenta.saldo = (SELECT saldo FROM cuenta WHERE numCta=new.numCta) - new.monto WHERE cuenta.numCta=new.numCta
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
  `restante` float(10,2) NOT NULL,
  `interes` float(4,2) NOT NULL,
  `status` enum('1','2') NOT NULL DEFAULT '1',
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
  ADD UNIQUE KEY `rfc` (`rfc`),
  ADD UNIQUE KEY `curp` (`curp`),
  ADD UNIQUE KEY `email` (`email`),
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
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id_pago`),
  ADD KEY `numCta` (`numCta`),
  ADD KEY `id_prestamo` (`id_prestamo`) USING BTREE;

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
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `id_movimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `id_prestamo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`id_prestamo`) REFERENCES `prestamos` (`id_prestamo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pagos_ibfk_2` FOREIGN KEY (`numCta`) REFERENCES `cuenta` (`numCta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD CONSTRAINT `prestamos_ibfk_1` FOREIGN KEY (`numCta`) REFERENCES `cuenta` (`numCta`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
