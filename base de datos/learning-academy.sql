-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Temps de generació: 20-09-2023 a les 20:01:01
-- Versió del servidor: 10.4.28-MariaDB
-- Versió de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de dades: `learning-academy`
--

-- --------------------------------------------------------

--
-- Estructura de la taula `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `Nom` varchar(255) DEFAULT NULL,
  `contrasenya` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `admin`
--

INSERT INTO `admin` (`id`, `Nom`, `contrasenya`) VALUES
(1, 'admin', '52e30e060520bb109b826f4abc0022322756b99481d89f1df7c1ef6dd1ad8913');

-- --------------------------------------------------------

--
-- Estructura de la taula `alumnes`
--

CREATE TABLE `alumnes` (
  `DNI` int(11) NOT NULL,
  `Nom` varchar(255) DEFAULT NULL,
  `Cognom` varchar(255) DEFAULT NULL,
  `Edad` int(11) DEFAULT NULL,
  `Foto` varchar(255) DEFAULT NULL,
  `Contrasenya` varchar(255) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de la taula `cursos`
--

CREATE TABLE `cursos` (
  `Codigo` int(11) NOT NULL,
  `Nom` varchar(255) DEFAULT NULL,
  `Foto` varchar(255) DEFAULT NULL,
  `Descripcion` text DEFAULT NULL,
  `NumeroHoras` int(11) DEFAULT NULL,
  `DataInici` date DEFAULT NULL,
  `Profe` int(11) DEFAULT NULL,
  `Estado` tinyint(1) DEFAULT NULL,
  `DataFinal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `cursos`
--

INSERT INTO `cursos` (`Codigo`, `Nom`, `Foto`, `Descripcion`, `NumeroHoras`, `DataInici`, `Profe`, `Estado`, `DataFinal`) VALUES
(1, 'Animacion 3d', 'foto.jpg', 'animacion 3d', 8, '2023-09-20', 2, 1, '2023-09-21');

-- --------------------------------------------------------

--
-- Estructura de la taula `curso_alumne`
--

CREATE TABLE `curso_alumne` (
  `curso` int(11) NOT NULL,
  `alumne` int(11) NOT NULL,
  `nota` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de la taula `profes`
--

CREATE TABLE `profes` (
  `Dni` int(11) NOT NULL,
  `Nom` varchar(255) DEFAULT NULL,
  `Cognom` varchar(255) DEFAULT NULL,
  `titol` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `contrasenya` varchar(255) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `profes`
--

INSERT INTO `profes` (`Dni`, `Nom`, `Cognom`, `titol`, `foto`, `contrasenya`, `estado`) VALUES
(1, 'Ruben', 'jimenez', 'Master en informatica', 'foto.jpg', 'be1962e4a3f33fa0430c7c4244ca9957cf237c51a3a38b50a8eadb91858307ec', 1),
(2, 'Hugo', 'Varela', 'Master en informatica', 'foto.jpg', '52e30e060520bb109b826f4abc0022322756b99481d89f1df7c1ef6dd1ad8913', 1);

--
-- Índexs per a les taules bolcades
--

--
-- Índexs per a la taula `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Índexs per a la taula `alumnes`
--
ALTER TABLE `alumnes`
  ADD PRIMARY KEY (`DNI`);

--
-- Índexs per a la taula `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`Codigo`),
  ADD KEY `Profe` (`Profe`);

--
-- Índexs per a la taula `curso_alumne`
--
ALTER TABLE `curso_alumne`
  ADD PRIMARY KEY (`curso`,`alumne`),
  ADD KEY `alumne` (`alumne`);

--
-- Índexs per a la taula `profes`
--
ALTER TABLE `profes`
  ADD PRIMARY KEY (`Dni`);

--
-- Restriccions per a les taules bolcades
--

--
-- Restriccions per a la taula `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `cursos_ibfk_1` FOREIGN KEY (`Profe`) REFERENCES `profes` (`Dni`);

--
-- Restriccions per a la taula `curso_alumne`
--
ALTER TABLE `curso_alumne`
  ADD CONSTRAINT `curso_alumne_ibfk_1` FOREIGN KEY (`curso`) REFERENCES `cursos` (`Codigo`),
  ADD CONSTRAINT `curso_alumne_ibfk_2` FOREIGN KEY (`alumne`) REFERENCES `alumnes` (`DNI`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
