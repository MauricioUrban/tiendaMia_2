-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 14-10-2021 a las 00:02:24
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_tienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'pantalones'),
(2, 'remeras'),
(4, 'sweaters'),
(28, 'camisas'),
(29, 'camperas'),
(34, 'sacones'),
(35, 'Bermudas'),
(37, 'vestidos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `size` varchar(5) NOT NULL,
  `image` varchar(200) DEFAULT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `size`, `image`, `category_id`) VALUES
(22, 'pullover azul', 10101, 'L', NULL, 4),
(23, 'Remera piquet blanca', 2399.54, 'XS', NULL, 2),
(27, 'sans days', 5200, 'M', NULL, 1),
(28, 'chenille escote en V', 1250, 'S', NULL, 4),
(29, 'polar cierre ', 3799, 'XXL', NULL, 4),
(30, 'slim fit hombre blanca a rayas', 3469, 'XS', NULL, 28),
(37, 'valentin beige', 2300, 'M', NULL, 4),
(38, 'lino rouge', 6599, 'M', NULL, 34),
(39, 'fit denim', 324.45, 'XS', NULL, 28),
(40, 'jean recto  negro ', 4569, 'S', NULL, 1),
(42, 'winterNow', 3244.5, 'XL', NULL, 4),
(43, 'rompeviento reversible', 5401, 'M', NULL, 29),
(44, 'vanish style', 1790, 'XXL', NULL, 2),
(45, 'sateniers', 2345, 'L', NULL, 1),
(46, 'clasic T-shirt', 2345, 'XS', NULL, 2),
(47, 'tommy recta', 7324.45, 'M', NULL, 35),
(50, 'prune redwine', 3245, 'L', NULL, 1),
(51, 'vintage', 324.45, 'L', NULL, 34);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `is_admin` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `is_admin`) VALUES
(12, 'prueba@gmail.com', '$2y$10$GXPO2/iyabtISERP1Po9FOX2DkcYsrLOYmdFKLY5Z82XnaqpQbxqe', 0),
(17, 'joseluis@gmail.com', '$2y$10$qhssqq943WzVaoC4xbjAp.8sEvdJtZvhBLS03ybzJfyO2R/6FIuT2', 0),
(19, 'pedro@hotmail.com', '$2y$10$HXe1GnZX0fWTrCppkBANzOvo8d3bwjat/.VS1cgQEANj6Z9BrhmkW', 0),
(20, 'dairagalceran@gmail.com', '$2y$10$XzWH1mhDww8oHrLyUUvx6ORherBIEU/hEY39qI4C3IuptwM76gr76', 0),
(21, 'mauriciourban@gmail.com', '$2y$10$zWzPO4xs7BgiX4wyqvzt4OnaZ5CvO8ORIjj0/gv9TLV5Oe6fjVu.O', 0),
(22, 'jose@gmail.com', '$2y$10$pIxrC9kL45lJXDfrk3Yhu.pBT6fh.8YCTpa5be3N8PK/08Bh8356e', 0),
(23, 'mica@yahoo.com', '$2y$10$cxF3eTZt9wxcCiEHn56GjunS5QBeI7qxNztgcRlr7hp9gE4zHIAqi', 0),
(24, 'pepito@prueba', '$2y$10$24VyH7CpVNG5PDOSvh8qF.7uO3cjh8mJ/4KJ7mSKLQ1jVJ7MLt9wO', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`) USING BTREE;

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_fk` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
