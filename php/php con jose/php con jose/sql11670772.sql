-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Servidor: sql11.freemysqlhosting.net
-- Tiempo de generación: 17-12-2023 a las 23:15:04
-- Versión del servidor: 5.5.62-0ubuntu0.14.04.1
-- Versión de PHP: 7.0.33-0ubuntu0.16.04.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sql11670772`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autores`
--

CREATE TABLE `autores` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `autores`
--

INSERT INTO `autores` (`id`, `nombre`, `apellidos`, `email`, `password`) VALUES
(1, 'Juan', 'Nadie', 'jnadie@example.com', 'jnadie'),
(2, 'Ana', 'Alguien', 'aalguien@example.com', 'aalguien'),
(3, 'Beatriz', 'Mundo', 'bmundo@no.example.com', 'bmundo'),
(4, 'Pedro', 'Cualquiera', 'pcualquiera@no.example.com', 'pcualquiera'),
(5, 'Miguel', 'Zutano', 'mzutano@example.com', 'mzutano'),
(6, 'Marina', 'Azulada', 'mazulada@example.com', 'mazulada'),
(7, 'Niña', 'Quien Sea', 'nquiensea@no.example.com', 'nquiensea'),
(8, 'Pascual', 'Perengano', 'pperengano@example.com', 'pperengano');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE `notas` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `titulo` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `contenido` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `id_autor` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `notas`
--

INSERT INTO `notas` (`id`, `titulo`, `contenido`, `id_autor`) VALUES
(1, 'PHP 7', 'Lanzada la nueva versión de PHP 7.', 1),
(2, 'PHP 8', 'Lanzada la nueva versión de PHP 8.', 1),
(3, 'Laravel 9', 'Laravel 9 ya está en la calle.', 1),
(4, 'CSS4', 'Ver las novedades en CSS4', 4),
(5, '.NET', '¿Vale la pena?', 3),
(6, 'HTML', '¿Nuevas etiquetas?', 4),
(7, 'JavaScript', 'Novedades en la versión 2023.', 4),
(8, 'Adviento', 'Nuevos desafios', 5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autores`
--
ALTER TABLE `autores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `autores_email_unique` (`email`);

--
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `autores`
--
ALTER TABLE `autores`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `notas`
--
ALTER TABLE `notas`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `notas`
--
ALTER TABLE `notas`
  ADD CONSTRAINT `notas_id_foreign` FOREIGN KEY (`id`) REFERENCES `autores` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
