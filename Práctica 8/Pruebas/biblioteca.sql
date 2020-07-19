-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-11-2018 a las 16:00:45
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `biblioteca`
--
CREATE DATABASE IF NOT EXISTS `biblioteca` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `biblioteca`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `IdLibro` int(11) NOT NULL,
  `Titulo` text COLLATE utf8_spanish_ci NOT NULL,
  `Resumen` text COLLATE utf8_spanish_ci NOT NULL,
  `Autor` int(11) NOT NULL,
  `Categoria` int(11) NOT NULL,
  `Editorial` int(11) NOT NULL,
  `Anyo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`IdLibro`, `Titulo`, `Resumen`, `Autor`, `Categoria`, `Editorial`, `Anyo`) VALUES
(1, 'Don Quijote de la Mancha', 'Esta edición del Ingenioso hidalgo don Quijote de la Mancha ha sido adaptada para uso escolar por la Real Academia Española. Con ese objeto, y a fin de facilitar una lectura sin interrupciones de la trama principal de la novela cervantina, se han retirado del texto original algunos obstáculos y digresiones que podrían dificultar aquella. Esa labor de poda, muy prudente y calculada, dedica especial atención a la limpieza de los puntos de sutura de los párrafos eliminados, para que su ausencia no se advierta en una lectura convencional. Esto incluye la renumeración y refundición de algunos capítulos, que en su mayor parte conservan el título del episodio original al que pertenecen. En cada caso se han procurado respetar al máximo la integridad del texto, los episodios fundamentales, el tono y la estructura general de la obra. Todo ello convierte esta edición en una eficaz herramienta docente, y también en un texto de fácil acceso para toda clase de lectores.', 3, 1, 23, 1605),
(2, 'Cazadores de Sombras: Ciudad de Hueso', 'En Pandemónium, la discoteca de moda de Nueva York, Clary sigue a un joven de pelo azul hasta que presencia su muerte a manos de tres jóvenes cubiertos de extraños tatuajes. El muerto resulta ser un demonio y los tres jóvenes -los hermanos Alec e Isabelle Lightwood y Jace Wayland- son Cazadores de Sombras, guerreros dedicados a liberar a la tierra de aquellos seres malvados y místicos que quieren apoderarse del mundo . Desde esa noche, el destino de Clary se une al de los Cazadores de Sombras; sobre todo al de Jace: un chico guapo con aspecto de ángel y tendencia a actuar como si nada le importara más que él mismo.', 5, 7, 56, 2013);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`IdLibro`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `IdLibro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
