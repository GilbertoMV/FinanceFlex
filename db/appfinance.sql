-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-11-2022 a las 14:18:06
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
(5, 'KASDKASMJASK', 'JUAN', 'SADAS', 'ARTEAGA', 'CIAJ020917HANCJRN8', '3141113999', 'asda@gmail.com', '$2y$10$K6cOK/A8CF6wjJhg7PGMB.RjUu1fdAu7ii4AyxIyBU5kPjCNCdk76', '2002-09-17', '', 'Masculino', '1', 2018963),
(10, 'HAYDNRUTI2sdd', 'adnkasndk', 'ansndaknsd', 'kndanksdnk', 'CIAJ020917HCMHRN23', 'sdfnksdf', 'cknanksc@gmail.com', '$2y$10$n9ZTpZVTtDwFCiXgV.2taOyk3kW6aRHS.VUcujsXsmh80aNAaZ9ou', '2002-09-17', NULL, 'Masculino', '2', 2018963),
(11, 'DASD', 'juan', 'pablo', 'chipres', 'CIAJ020917HCMHRNA2', '3143524724', 'max@gmail.com', '$2y$10$WzKPsKtcwkPiDO7tSHNZoe7Lg30484DDa5l6lvsE8VM.O9KUJkUVm', '2002-09-18', NULL, 'Masculino', '1', 2018963),
(12, 'HAYDNRUTI122', 'juan', 'pablo', 'chipres', 'CIAJ020917HCMHRNA7', '3145738904', 'pruebaemaik@gmail.com', '$2y$10$3QYBs.rADcvy7198/Fnp6OongBLUyrFgNogTTDT7g4iWbaDWUwfM2', '2006-07-04', NULL, 'Masculino', '1', 2018963);

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
(191909, 0.00, 10),
(1922144724, 200.00, 11),
(1952208904, 14044.00, 12),
(2036024724, 0.00, 5);

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
(9, 2036024724, 'Deposito', 20.00, '2022-11-18 18:38:22'),
(10, 2036024724, 'Deposito', 20.00, '2022-11-18 18:38:22'),
(13, 2036024724, 'Deposito', 1000.00, '2022-11-18 18:47:08'),
(16, 1952208904, 'Deposito', 700.00, '2022-11-18 19:00:08'),
(17, 1952208904, 'Deposito', 1000.00, '2022-11-18 19:03:04'),
(18, 2036024724, 'Deposito', 700.00, '2022-11-18 19:18:37'),
(20, 2036024724, 'Deposito', 11.00, NULL),
(21, 2036024724, 'Retiro', 11.00, NULL),
(22, 2036024724, 'Retiro', 11.00, NULL),
(23, 2036024724, 'Deposito', 500.00, '2022-11-18 19:44:51'),
(24, 2036024724, 'Deposito', 700.00, NULL),
(25, 2036024724, 'Deposito', 700.00, NULL),
(26, 2036024724, 'Deposito', 500.00, NULL),
(27, 2036024724, 'Deposito', 700.00, NULL),
(28, 2036024724, 'Deposito', 700.00, NULL),
(29, 1952208904, 'Deposito', 12344.00, NULL),
(30, 2036024724, '', 700.00, NULL),
(31, 2036024724, 'Deposito', 700.00, NULL),
(32, 1922144724, 'Deposito', 200.00, NULL),
(33, 2036024724, 'Deposito', 700.00, NULL),
(34, 2036024724, 'Retiro', 200.00, NULL),
(35, 2036024724, 'Deposito', 500.00, NULL),
(36, 2036024724, 'Retiro', 22.00, NULL),
(37, 2036024724, 'Retiro', 78.00, NULL),
(38, 2036024724, 'Retiro', 20.00, NULL),
(39, 2036024724, 'Retiro', 20.00, NULL),
(40, 2036024724, 'Retiro', 20.00, NULL),
(41, 2036024724, 'Retiro', 40.00, NULL),
(42, 2036024724, 'Retiro', 800.00, NULL);

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
-- Volcado de datos para la tabla `prestamos`
--

INSERT INTO `prestamos` (`id_prestamo`, `numCta`, `monto`, `restante`, `interes`, `status`, `fechaInicial`, `fechaTermino`) VALUES
(1, 2036024724, 4000.00, 4000.00, 3.00, '1', '2022-11-07', '2023-02-07');

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
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `id_movimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `id_prestamo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
