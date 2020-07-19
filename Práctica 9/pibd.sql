-- --------------------------------------------------------
-- Host:                         localhost
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
  CONSTRAINT `FK_Albumes_Usuarios` FOREIGN KEY (`Usuario`) REFERENCES `usuarios` (`IdUsuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla pibd.albumes: ~30 rows (aproximadamente)
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla pibd.estilos: ~4 rows (aproximadamente)
DELETE FROM `estilos`;
/*!40000 ALTER TABLE `estilos` DISABLE KEYS */;
INSERT INTO `estilos` (`IdEstilo`, `Nombre`, `Descripcion`, `Fichero`) VALUES
	(1, 'Estilo normal', 'Estilo por defecto de la página web', 'normal'),
	(2, 'Estilo adaptativo', 'Estilo adaptativo para dispositivos móviles y tabletas', 'adaptativo'),
	(3, 'Estilo accesible', 'Estilo para personas con discapacidades o dificultades', 'accesible'),
	(4, 'Estilo impresión', 'Estilo para imprimir la página web', 'impresion');
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
  CONSTRAINT `FK_Fotos_Albumes` FOREIGN KEY (`Album`) REFERENCES `albumes` (`IdAlbum`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_Fotos_Paises` FOREIGN KEY (`Pais`) REFERENCES `paises` (`IdPais`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla pibd.fotos: ~12 rows (aproximadamente)
DELETE FROM `fotos`;
/*!40000 ALTER TABLE `fotos` DISABLE KEYS */;
/*!40000 ALTER TABLE `fotos` ENABLE KEYS */;

-- Volcando estructura para tabla pibd.paises
CREATE TABLE IF NOT EXISTS `paises` (
  `IdPais` int(11) NOT NULL AUTO_INCREMENT,
  `NomPais` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `Continente` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`IdPais`)
) ENGINE=InnoDB AUTO_INCREMENT=195 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla pibd.paises: ~194 rows (aproximadamente)
DELETE FROM `paises`;
/*!40000 ALTER TABLE `paises` DISABLE KEYS */;
INSERT INTO `paises` (`IdPais`, `NomPais`, `Continente`) VALUES
	(1, 'Antigua y Barbuda', 'América'),
	(2, 'Argentina', 'América'),
	(3, 'Bahamas', 'América'),
	(4, 'Barbados', 'América'),
	(5, 'Belice', 'América'),
	(6, 'Bolivia', 'América'),
	(7, 'Brasil', 'América'),
	(8, 'Canadá', 'América'),
	(9, 'Chile', 'América'),
	(10, 'Colombia', 'América'),
	(11, 'Costa Rica', 'América'),
	(12, 'Cuba', 'América'),
	(13, 'Dominica', 'América'),
	(14, 'Ecuador', 'América'),
	(15, 'El Salvador', 'América'),
	(16, 'Estados Unidos de América', 'América'),
	(17, 'Granada', 'América'),
	(18, 'Guatemala', 'América'),
	(19, 'Guyana', 'América'),
	(20, 'Haití', 'América'),
	(21, 'Honduras', 'América'),
	(22, 'Jamaica', 'América'),
	(23, 'México', 'América'),
	(24, 'Nicaragua', 'América'),
	(25, 'Panamá', 'América'),
	(26, 'Paraguay', 'América'),
	(27, 'Perú', 'América'),
	(28, 'República Dominicana', 'América'),
	(29, 'San Cristóbal y Nieves', 'América'),
	(30, 'San Vicente y las Granadinas', 'América'),
	(31, 'Santa Lucía', 'América'),
	(32, 'Surinam', 'América'),
	(33, 'Trinidad y Tobago', 'América'),
	(34, 'Uruguay', 'América'),
	(35, 'Venezuela', 'América'),
	(36, 'Albania', 'Europa'),
	(37, 'Alemania', 'Europa'),
	(38, 'Andorra', 'Europa'),
	(39, 'Austria', 'Europa'),
	(40, 'Bélgica', 'Europa'),
	(41, 'Bielorrusia', 'Europa'),
	(42, 'Bosnia y Herzegovina', 'Europa'),
	(43, 'Bulgaria', 'Europa'),
	(44, 'Ciudad del Vaticano', 'Europa'),
	(45, 'Croacia', 'Europa'),
	(46, 'Dinamarca', 'Europa'),
	(47, 'Eslovaquia', 'Europa'),
	(48, 'Eslovenia', 'Europa'),
	(49, 'España', 'Europa'),
	(50, 'Estonia', 'Europa'),
	(51, 'Finlandia', 'Europa'),
	(52, 'Francia', 'Europa'),
	(53, 'Grecia', 'Europa'),
	(54, 'Hungría', 'Europa'),
	(55, 'Irlanda', 'Europa'),
	(56, 'Islandia', 'Europa'),
	(57, 'Italia', 'Europa'),
	(58, 'Letonia', 'Europa'),
	(59, 'Liechtenstein', 'Europa'),
	(60, 'Lituania', 'Europa'),
	(61, 'Luxemburgo', 'Europa'),
	(62, 'Macedonia', 'Europa'),
	(63, 'Malta', 'Europa'),
	(64, 'Moldavia', 'Europa'),
	(65, 'Mónaco', 'Europa'),
	(66, 'Montenegro', 'Europa'),
	(67, 'Noruega', 'Europa'),
	(68, 'Países Bajos', 'Europa'),
	(69, 'Polonia', 'Europa'),
	(70, 'Portugal', 'Europa'),
	(71, 'Reino Unido', 'Europa'),
	(72, 'Répública Checa', 'Europa'),
	(73, 'Rumanía', 'Europa'),
	(74, 'San Marino', 'Europa'),
	(75, 'Serbia', 'Europa'),
	(76, 'Suecia', 'Europa'),
	(77, 'Suiza', 'Europa'),
	(78, 'Ucrania', 'Europa'),
	(79, 'Angola', 'África'),
	(80, 'Argelia', 'África'),
	(81, 'Benín', 'África'),
	(82, 'Botsuana', 'África'),
	(83, 'Burkina Faso', 'África'),
	(84, 'Burundi', 'África'),
	(85, 'Cabo Verde', 'África'),
	(86, 'Camerún', 'África'),
	(87, 'Chad', 'África'),
	(88, 'Comoras', 'África'),
	(89, 'Costa de Marfil', 'África'),
	(90, 'Egipto', 'África'),
	(91, 'Eritrea', 'África'),
	(92, 'Etiopía', 'África'),
	(93, 'Gabón', 'África'),
	(94, 'Gambia', 'África'),
	(95, 'Ghana', 'África'),
	(96, 'Guinea', 'África'),
	(97, 'Guinea-Bisáu', 'África'),
	(98, 'Guinea Ecuatorial', 'África'),
	(99, 'Kenia', 'África'),
	(100, 'Lesoto', 'África'),
	(101, 'Liberia', 'África'),
	(102, 'Libia', 'África'),
	(103, 'Madagascar', 'África'),
	(104, 'Malaui', 'África'),
	(105, 'Malí', 'África'),
	(106, 'Marruecos', 'África'),
	(107, 'Mauricio', 'África'),
	(108, 'Mauritania', 'África'),
	(109, 'Mozambique', 'África'),
	(110, 'Namibia', 'África'),
	(111, 'Níger', 'África'),
	(112, 'Nigeria', 'África'),
	(113, 'República Centroafricana', 'África'),
	(114, 'República del Congo', 'África'),
	(115, 'Répública Democrática del Congo', 'África'),
	(116, 'Ruanda', 'África'),
	(117, 'Santo Tomé y Principe', 'África'),
	(118, 'Senegal', 'África'),
	(119, 'Seychelles', 'África'),
	(120, 'Sierra Leona', 'África'),
	(121, 'Somalia', 'África'),
	(122, 'Suazilandia', 'África'),
	(123, 'Sudáfrica', 'África'),
	(124, 'Sudán', 'África'),
	(125, 'Sudán del Sur', 'África'),
	(126, 'Tanzania', 'África'),
	(127, 'Togo', 'África'),
	(128, 'Túnez', 'África'),
	(129, 'Uganda', 'África'),
	(130, 'Yibuti', 'África'),
	(131, 'Zambia', 'África'),
	(132, 'Zimbabue', 'África'),
	(133, 'Afganistán', 'Asia'),
	(134, 'Arabia Saudita', 'Asia'),
	(135, 'Bangladés', 'Asia'),
	(136, 'Baréin', 'Asia'),
	(137, 'Birmania (Myanmar)', 'Asia'),
	(138, 'Brunéi', 'Asia'),
	(139, 'Bután', 'Asia'),
	(140, 'Camboya', 'Asia'),
	(141, 'Catar', 'Asia'),
	(142, 'China', 'Asia'),
	(143, 'Corea del Norte', 'Asia'),
	(144, 'Corea del Sur', 'Asia'),
	(145, 'Emiratos Árabes Unidos', 'Asia'),
	(146, 'Filipinas', 'Asia'),
	(147, 'India', 'Asia'),
	(148, 'Indonesia', 'Asia'),
	(149, 'Irak', 'Asia'),
	(150, 'Irán', 'Asia'),
	(151, 'Israel', 'Asia'),
	(152, 'Japón', 'Asia'),
	(153, 'Jordania', 'Asia'),
	(154, 'Kirguistán', 'Asia'),
	(155, 'Kuwait', 'Asia'),
	(156, 'Laos', 'Asia'),
	(157, 'Líbano', 'Asia'),
	(158, 'Malasia', 'Asia'),
	(159, 'Maldivas', 'Asia'),
	(160, 'Mongolia', 'Asia'),
	(161, 'Nepal', 'Asia'),
	(162, 'Omán', 'Asia'),
	(163, 'Pakistán', 'Asia'),
	(164, 'Singapur', 'Asia'),
	(165, 'Siria', 'Asia'),
	(166, 'Sir Lanka', 'Asia'),
	(167, 'Tailandia', 'Asia'),
	(168, 'Tayikistán', 'Asia'),
	(169, 'Timor Oriental', 'Asia'),
	(170, 'Turkmenistán', 'Asia'),
	(171, 'Uzbekistán', 'Asia'),
	(172, 'Vietnam', 'Asia'),
	(173, 'Yemen', 'Asia'),
	(174, 'Australia', 'Oceanía'),
	(175, 'Fiyi', 'Oceanía'),
	(176, 'Islas Marshall', 'Oceanía'),
	(177, 'Islas Salomón', 'Oceanía'),
	(178, 'Kiribati', 'Oceanía'),
	(179, 'Micronesia', 'Oceanía'),
	(180, 'Nauru', 'Oceanía'),
	(181, 'Nueva Zelanda', 'Oceanía'),
	(182, 'Palaos', 'Oceanía'),
	(183, 'Papúa Nueva Guinea', 'Oceanía'),
	(184, 'Samoa', 'Oceanía'),
	(185, 'Tonga', 'Oceanía'),
	(186, 'Tuvalu', 'Oceanía'),
	(187, 'Vanuatu', 'Oceanía'),
	(188, 'Armenia', 'Euroasia'),
	(189, 'Azerbaiyán', 'Euroasia'),
	(190, 'Chipre', 'Euroasia'),
	(191, 'Georgia', 'Euroasia'),
	(192, 'Kazajistán', 'Euroasia'),
	(193, 'Rusia', 'Euroasia'),
	(194, 'Turquía', 'Euroasia');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla pibd.solicitudes: ~2 rows (aproximadamente)
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla pibd.usuarios: ~12 rows (aproximadamente)
DELETE FROM `usuarios`;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
