-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-10-2017 a las 11:11:52
-- Versión del servidor: 10.1.25-MariaDB
-- Versión de PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `quiz`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `questions`
--

CREATE TABLE `questions` (
  `ID` int(10) NOT NULL,
  `Eposta` varchar(100) NOT NULL,
  `Galdera` text NOT NULL,
  `ErantzunZuzena` text NOT NULL,
  `ErantzunOkerra1` text NOT NULL,
  `Erantzunokerra2` text NOT NULL,
  `ErantzunOkerra3` text NOT NULL,
  `Zailtasuna` int(1) NOT NULL,
  `GaiArloa` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `questions`
--

INSERT INTO `questions` (`ID`, `Eposta`, `Galdera`, `ErantzunZuzena`, `ErantzunOkerra1`, `Erantzunokerra2`, `ErantzunOkerra3`, `Zailtasuna`, `GaiArloa`) VALUES
(1, 'jiparsar003@ikasle.ehu.eus', 'aaaaaaaaaaaaaaaaaaa', 'a', 'a', 'a', 'a', 3, 'a'),
(2, 'jiparsar003@ikasle.ehu.eus', 'Zein urte da?', '2017', '6565', '654', '2010', 1, 'Urtea'),
(3, 'jiparsar003@ikasle.ehu.eus', 'Zein urte da?', '2017', '6565', '654', '2001', 2, 'Ur'),
(4, 'jiparsar003@ikasle.ehu.eus', 'aaaaaaaaaaaaaaaaaaa', 'a', 'b', 'c', 'd', 5, 'a'),
(5, 'jiparsar003@ikasle.ehu.eus', 'bbbbbbbbbbbbbbbbbbb', 'b', 'a', 'c', 'd', 5, 'b'),
(6, 'jiparsar003@ikasle.ehu.eus', 'Zein urte da?', 'dgf', 'hgfh', 'gf', 'hgfhg', 5, 'gfhg'),
(7, 'jiparsar003@ikasle.ehu.eus', 'Zein urte da?', 'khgsjh', 'jhjgaj', 'jgj', 'hgjhg', 5, 'jhgjh');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `questions`
--
ALTER TABLE `questions`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
