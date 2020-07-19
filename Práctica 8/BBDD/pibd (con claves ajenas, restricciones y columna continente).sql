-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.36-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para pibd
CREATE DATABASE IF NOT EXISTS `pibd` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;
USE `pibd`;

-- Volcando estructura para tabla pibd.albumes
CREATE TABLE IF NOT EXISTS `albumes` (
  `IdAlbum` int(11) NOT NULL AUTO_INCREMENT,
  `Titulo` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `Descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `Usuario` int(11) NOT NULL,
  PRIMARY KEY (`IdAlbum`),
  KEY `FK_Albumes_Usuarios` (`Usuario`),
  CONSTRAINT `FK_Albumes_Usuarios` FOREIGN KEY (`Usuario`) REFERENCES `usuarios` (`IdUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla pibd.albumes: ~0 rows (aproximadamente)
DELETE FROM `albumes`;
/*!40000 ALTER TABLE `albumes` DISABLE KEYS */;
/*!40000 ALTER TABLE `albumes` ENABLE KEYS */;

-- Volcando estructura para tabla pibd.estilos
CREATE TABLE IF NOT EXISTS `estilos` (
  `IdEstilo` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `Descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `Fichero` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`IdEstilo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla pibd.estilos: ~0 rows (aproximadamente)
DELETE FROM `estilos`;
/*!40000 ALTER TABLE `estilos` DISABLE KEYS */;
/*!40000 ALTER TABLE `estilos` ENABLE KEYS */;

-- Volcando estructura para tabla pibd.fotos
CREATE TABLE IF NOT EXISTS `fotos` (
  `IdFoto` int(11) NOT NULL AUTO_INCREMENT,
  `Titulo` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `Descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `Fecha` date NOT NULL COMMENT 'Fecha en la que se tomó la foto, se puede dejar en blanco',
  `Pais` int(11) NOT NULL COMMENT 'País en el que se tomó la foto',
  `Album` int(11) NOT NULL COMMENT 'Una foto siempre tiene que estar asociada a un álbum',
  `Fichero` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `Alternativo` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `FRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Usado para mostrar las últimas 5 fotos subidas en la pag principal',
  PRIMARY KEY (`IdFoto`),
  KEY `FK_Fotos_Paises` (`Pais`),
  KEY `FK_Fotos_Albumes` (`Album`),
  CONSTRAINT `FK_Fotos_Albumes` FOREIGN KEY (`Album`) REFERENCES `albumes` (`IdAlbum`),
  CONSTRAINT `FK_Fotos_Paises` FOREIGN KEY (`Pais`) REFERENCES `paises` (`IdPais`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla pibd.fotos: ~0 rows (aproximadamente)
DELETE FROM `fotos`;
/*!40000 ALTER TABLE `fotos` DISABLE KEYS */;
/*!40000 ALTER TABLE `fotos` ENABLE KEYS */;

-- Volcando estructura para tabla pibd.paises
CREATE TABLE IF NOT EXISTS `paises` (
  `IdPais` int(11) NOT NULL AUTO_INCREMENT,
  `NomPais` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `Continente` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`IdPais`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla pibd.paises: ~0 rows (aproximadamente)
DELETE FROM `paises`;
/*!40000 ALTER TABLE `paises` DISABLE KEYS */;
/*!40000 ALTER TABLE `paises` ENABLE KEYS */;

-- Volcando estructura para tabla pibd.solicitudes
CREATE TABLE IF NOT EXISTS `solicitudes` (
  `IdSolicutud` int(11) NOT NULL AUTO_INCREMENT,
  `Album` int(11) NOT NULL,
  `Nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `Titulo` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `Descripcion` varchar(4000) COLLATE utf8_spanish_ci NOT NULL,
  `Email` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `Calle` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `Numero` int(11) NOT NULL,
  `Puerta` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `CP` int(11) NOT NULL,
  `Localidad` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `Provincia` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `Pais` int(11) NOT NULL,
  `Color` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `Copias` int(11) NOT NULL,
  `Resolucion` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `IColor` tinyint(1) NOT NULL,
  `FRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Coste` double NOT NULL,
  PRIMARY KEY (`IdSolicutud`),
  KEY `FK_Solicitudes_Albumes` (`Album`),
  KEY `FK_Solicitudes_Paises` (`Pais`),
  CONSTRAINT `FK_Solicitudes_Albumes` FOREIGN KEY (`Album`) REFERENCES `albumes` (`IdAlbum`),
  CONSTRAINT `FK_Solicitudes_Paises` FOREIGN KEY (`Pais`) REFERENCES `paises` (`IdPais`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla pibd.solicitudes: ~0 rows (aproximadamente)
DELETE FROM `solicitudes`;
/*!40000 ALTER TABLE `solicitudes` DISABLE KEYS */;
/*!40000 ALTER TABLE `solicitudes` ENABLE KEYS */;

-- Volcando estructura para tabla pibd.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `IdUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `NomUsuario` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `Clave` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `Email` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `Sexo` smallint(6) NOT NULL,
  `FNacimiento` date NOT NULL,
  `Ciudad` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `Pais` int(11) NOT NULL,
  `Foto` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `FRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Estilo` int(11) NOT NULL,
  PRIMARY KEY (`IdUsuario`),
  UNIQUE KEY `NomUsuario` (`NomUsuario`),
  KEY `FK_Usuarios_Paises` (`Pais`),
  KEY `FK_Usuarios_Estilos` (`Estilo`),
  CONSTRAINT `FK_Usuarios_Estilos` FOREIGN KEY (`Estilo`) REFERENCES `estilos` (`IdEstilo`),
  CONSTRAINT `FK_Usuarios_Paises` FOREIGN KEY (`Pais`) REFERENCES `paises` (`IdPais`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla pibd.usuarios: ~0 rows (aproximadamente)
DELETE FROM `usuarios`;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
