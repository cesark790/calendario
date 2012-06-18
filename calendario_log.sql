-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 13-03-2012 a las 16:23:25
-- Versión del servidor: 5.5.8
-- Versión de PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `administracion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calendario_log`
--

CREATE TABLE IF NOT EXISTS `calendario_log` (
  `id_log` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `suceso` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_log`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=47 ;

--
-- Volcar la base de datos para la tabla `calendario_log`
--

INSERT INTO `calendario_log` (`id_log`, `suceso`, `fecha`, `user`) VALUES
(29, 'Elimino a un Usuario <ID> 8', '2012-03-12 14:16:03', 'julio'),
(30, 'Agrego a un Nuevo Usuario <Datos>  Nombre:prueba   Usuario:asdasd   Privilegios:   2', '2012-03-12 14:16:37', 'julio'),
(31, 'Agrego una Nueva Actividad <Datos>  Actividad:Prueba', '2012-03-12 14:26:56', 'julio'),
(32, 'Elimino una Actividad <ID> 9', '2012-03-12 14:27:23', 'julio'),
(33, 'Elimino una Actividad <ID> 8', '2012-03-12 14:27:33', 'julio'),
(34, 'Agrego una Actividad <Datos> id:5420   Aignada a: 1  Actividad: 2', '2012-03-12 14:28:04', 'julio'),
(35, 'Elimino el archivo del registro con el Id  ', '2012-03-12 14:31:46', 'julio'),
(36, 'Elimino el archivo del registro con el Id 5420 ', '2012-03-12 14:33:19', 'julio'),
(37, 'Elimino a un Usuario <ID> 9', '2012-03-12 16:01:16', 'julio'),
(38, 'Actualizo los siguientes campos                 ', '2012-03-12 16:57:01', 'julio'),
(39, 'Actualizo los siguientes campos    Nombre : Fabiolaa                 ', '2012-03-12 17:00:44', 'julio'),
(40, 'Actualizo los siguientes campos <CAMPOS>    Nombre : Fabiola                 ', '2012-03-12 17:01:19', 'julio'),
(41, 'Actualizo campos de la tabla ACTIIVIDAD <CAMPOS>  Entrega de Soporte y Factura al Cliente ', '2012-03-12 17:12:57', 'julio'),
(42, 'Agrego una Actividad <Datos> id: 5421   Aignada a: 1  Actividad: 2', '2012-03-12 17:14:49', 'julio'),
(43, 'Elimino el archivo del registro con el Id 5421 ', '2012-03-12 17:16:07', 'julio'),
(44, 'Elimino el archivo del registro con el Id 5421 ', '2012-03-12 17:17:03', 'julio'),
(45, 'Inicio Session', '2012-03-12 17:25:27', 'israel'),
(46, 'Actulizo la tabla ACITVIDADES  <DATOS>         Observerciones  : Aun no se ha facturado (es cliente de Christian Jimenez).      ', '2012-03-12 17:25:43', 'israel');
