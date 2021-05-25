-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 22-07-2020 a las 11:51:09
-- Versión del servidor: 5.7.26
-- Versión de PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `aereopuerto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `avion`
--

DROP TABLE IF EXISTS `avion`;
CREATE TABLE IF NOT EXISTS `avion` (
  `matricula` varchar(30) NOT NULL,
  `fabricante` varchar(30) DEFAULT NULL,
  `modelo` varchar(30) DEFAULT NULL,
  `capacidad` int(3) DEFAULT NULL,
  `autonomia` int(4) DEFAULT NULL,
  PRIMARY KEY (`matricula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `avion`
--

INSERT INTO `avion` (`matricula`, `fabricante`, `modelo`, `capacidad`, `autonomia`) VALUES
('ADAS4351', 'BOINJ', '747', 160, 150),
('GDSG649', 'ADMOTORS', '727', 130, 115),
('J1423J15', 'BOINJ', '737', 100, 80),
('JSADJ214', 'ADMOTORS', '717', 80, 100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_de_pasajeros`
--

DROP TABLE IF EXISTS `lista_de_pasajeros`;
CREATE TABLE IF NOT EXISTS `lista_de_pasajeros` (
  `id_vuelo` int(11) DEFAULT NULL,
  `cedula` int(11) DEFAULT NULL,
  `puesto` int(11) DEFAULT NULL,
  `clase` varchar(30) DEFAULT NULL,
  KEY `lista_de_pasajeros_ibfk_1` (`id_vuelo`),
  KEY `lista_de_pasajeros_ibfk_2` (`cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `lista_de_pasajeros`
--

INSERT INTO `lista_de_pasajeros` (`id_vuelo`, `cedula`, `puesto`, `clase`) VALUES
(2, 9876, 1, 'Primera Clase'),
(2, 987654, 2, 'Primera Clase'),
(1, 9876543, 1, 'Turista'),
(1, 98765, 2, 'Turista'),
(2, 987, 3, 'Turista');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

DROP TABLE IF EXISTS `personal`;
CREATE TABLE IF NOT EXISTS `personal` (
  `cedula` int(11) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `categoria` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`cedula`, `nombre`, `categoria`) VALUES
(123, 'Yesenia', 'Azafata'),
(1234, 'Julian', 'Piloto'),
(12345, 'Ronaldo', 'Piloto'),
(123456, 'Alexandra', 'Azafata'),
(1234567, 'Julicio', 'Bartender');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tripulacion`
--

DROP TABLE IF EXISTS `tripulacion`;
CREATE TABLE IF NOT EXISTS `tripulacion` (
  `id_vuelo` int(11) DEFAULT NULL,
  `puesto` int(11) DEFAULT NULL,
  `cedula` int(11) DEFAULT NULL,
  KEY `tripulacion_ibfk_1` (`id_vuelo`),
  KEY `tripulacion_ibfk_2` (`cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tripulacion`
--

INSERT INTO `tripulacion` (`id_vuelo`, `puesto`, `cedula`) VALUES
(1, 1, 123456),
(3, 2, 1234),
(2, 1, 12345),
(4, 2, 123);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `cedula` int(11) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`cedula`, `nombre`) VALUES
(987, 'Johana'),
(9876, 'David'),
(98765, 'Javier'),
(987654, 'Jesus'),
(9876543, 'Felicio'),
(98765432, 'Yisus');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vuelo`
--

DROP TABLE IF EXISTS `vuelo`;
CREATE TABLE IF NOT EXISTS `vuelo` (
  `id_vuelo` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `destino` varchar(30) DEFAULT NULL,
  `origen` varchar(30) DEFAULT NULL,
  `matricula` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_vuelo`),
  KEY `vuelo_ibfk_1` (`matricula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `vuelo`
--

INSERT INTO `vuelo` (`id_vuelo`, `fecha`, `destino`, `origen`, `matricula`) VALUES
(1, '2020-07-30', 'Los Angeles', 'Caracas', 'J1423J15'),
(2, '2020-07-30', 'Seattle', 'Caracas', 'JSADJ214'),
(3, '2020-07-22', 'New York', 'Caracas', 'ADAS4351'),
(4, '2020-07-25', 'Chicago', 'Caracas', 'GDSG649'),
(5, '2020-08-12', 'Las Vegas', 'Caracas', 'JSADJ214');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `lista_de_pasajeros`
--
ALTER TABLE `lista_de_pasajeros`
  ADD CONSTRAINT `lista_de_pasajeros_ibfk_1` FOREIGN KEY (`id_vuelo`) REFERENCES `vuelo` (`id_vuelo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lista_de_pasajeros_ibfk_2` FOREIGN KEY (`cedula`) REFERENCES `usuarios` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tripulacion`
--
ALTER TABLE `tripulacion`
  ADD CONSTRAINT `tripulacion_ibfk_1` FOREIGN KEY (`id_vuelo`) REFERENCES `vuelo` (`id_vuelo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tripulacion_ibfk_2` FOREIGN KEY (`cedula`) REFERENCES `personal` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `vuelo`
--
ALTER TABLE `vuelo`
  ADD CONSTRAINT `vuelo_ibfk_1` FOREIGN KEY (`matricula`) REFERENCES `avion` (`matricula`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
