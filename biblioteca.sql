-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-11-2024 a las 01:23:46
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `biblioteca`
--
CREATE DATABASE IF NOT EXISTS `biblioteca` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `biblioteca`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `author`
--
-- Creación: 21-11-2024 a las 23:38:50
--

DROP TABLE IF EXISTS `author`;
CREATE TABLE `author` (
  `ID_AUTHOR` bigint(20) NOT NULL,
  `FULL_NAME` varchar(255) NOT NULL,
  `DATE_OF_BIRTH` date NOT NULL,
  `DATE_OF_DEATH` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `author`
--

INSERT INTO `author` (`ID_AUTHOR`, `FULL_NAME`, `DATE_OF_BIRTH`, `DATE_OF_DEATH`) VALUES
(1, 'Gabriel García Márquez', '1927-03-06', '2014-04-17'),
(2, 'Jane Austen', '1775-12-16', '1817-07-18'),
(3, 'J.K. Rowling', '1965-07-31', NULL),
(4, 'George Orwell', '1903-06-25', '1950-01-21'),
(5, 'Mark Twain', '1835-11-30', '1910-04-21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `book`
--
-- Creación: 21-11-2024 a las 23:38:50
--

DROP TABLE IF EXISTS `book`;
CREATE TABLE `book` (
  `ID_BOOK` bigint(20) NOT NULL,
  `TITLE` varchar(255) NOT NULL,
  `DESCRIPTION` varchar(255) DEFAULT NULL,
  `YEAR_PUBLICATION` year(4) DEFAULT NULL,
  `ID_AUTHOR` bigint(20) NOT NULL,
  `ID_GENRE` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `book`
--

INSERT INTO `book` (`ID_BOOK`, `TITLE`, `DESCRIPTION`, `YEAR_PUBLICATION`, `ID_AUTHOR`, `ID_GENRE`) VALUES
(1, 'Mysthic Book 2', 'A Mysthic Book', '2024', 3, 3),
(2, 'Pride and Prejudice', 'A romantic novel of manners.', '0000', 2, 3),
(3, 'Harry Potter and the Philosopher\'s Stone', 'A young wizard\'s journey begins.', '1997', 3, 2),
(4, '1984', 'A dystopian social science fiction novel.', '1949', 4, 4),
(5, 'The Adventures of Tom Sawyer', 'The adventures of a young boy.', '0000', 5, 3),
(6, 'a', 'a', '0000', 1, 1),
(7, 'a', 'a', '0000', 1, 1),
(8, 'a', 'a', '0000', 1, 1),
(9, 'b', 'a', '2000', 2, 1),
(10, 'b', 'a', '2000', 2, 1),
(11, 'Testing', 'test', '2024', 2, 1),
(12, 'Testing', 'test', '2024', 2, 1),
(13, 'Testing', 'a', '2024', 2, 1),
(14, 'j', 'j', '2007', 2, 1),
(19, 'Mysthic Book', 'A Mysthic Book', '2024', 3, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genre`
--
-- Creación: 21-11-2024 a las 23:38:50
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE `genre` (
  `ID_GENRE` bigint(20) NOT NULL,
  `NAME` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `genre`
--

INSERT INTO `genre` (`ID_GENRE`, `NAME`) VALUES
(1, 'Fiction'),
(2, 'Fantasy'),
(3, 'Classics'),
(4, 'Science Fiction'),
(5, 'Biography');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock`
--
-- Creación: 21-11-2024 a las 23:38:50
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE `stock` (
  `ID_STOCK` bigint(20) NOT NULL,
  `ID_BOOK` bigint(20) NOT NULL,
  `TOTAL_STOCK` int(11) NOT NULL,
  `NOTES` varchar(255) DEFAULT NULL,
  `LAST_INVENTORY` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `stock`
--

INSERT INTO `stock` (`ID_STOCK`, `ID_BOOK`, `TOTAL_STOCK`, `NOTES`, `LAST_INVENTORY`) VALUES
(1, 1, 25, 'Popular among Latin American readers.', '2024-11-01'),
(2, 2, 10, 'Classic literature.', '2024-11-10'),
(3, 3, 50, 'Bestseller in fantasy genre.', '2024-11-15'),
(4, 4, 15, 'Frequently borrowed.', '2024-11-18'),
(5, 5, 20, 'Favorite among young readers.', '2024-11-20');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`ID_AUTHOR`);

--
-- Indices de la tabla `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`ID_BOOK`),
  ADD KEY `ID_AUTHOR` (`ID_AUTHOR`),
  ADD KEY `ID_GENRE` (`ID_GENRE`);

--
-- Indices de la tabla `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`ID_GENRE`);

--
-- Indices de la tabla `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`ID_STOCK`),
  ADD KEY `ID_BOOK` (`ID_BOOK`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `author`
--
ALTER TABLE `author`
  MODIFY `ID_AUTHOR` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `book`
--
ALTER TABLE `book`
  MODIFY `ID_BOOK` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `genre`
--
ALTER TABLE `genre`
  MODIFY `ID_GENRE` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `stock`
--
ALTER TABLE `stock`
  MODIFY `ID_STOCK` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`ID_AUTHOR`) REFERENCES `author` (`ID_AUTHOR`),
  ADD CONSTRAINT `book_ibfk_2` FOREIGN KEY (`ID_GENRE`) REFERENCES `genre` (`ID_GENRE`);

--
-- Filtros para la tabla `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`ID_BOOK`) REFERENCES `book` (`ID_BOOK`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
