-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-08-2022 a las 21:48:12
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6
CREATE DATABASE IF NOT EXISTS `dahlia` CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `dahlia`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dahlia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`) VALUES
(1, 'Blusas'),
(2, 'Faldas'),
(3, 'Accesorios'),
(5, 'Vestidos'),
(6, 'Abrigos'),
(7, 'Pantalones');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuraciones`
--

CREATE TABLE `configuraciones` (
  `id_configuracion` int(11) NOT NULL,
  `nombre_configuracion` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `valor_configuracion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `configuraciones`
--

INSERT INTO `configuraciones` (`id_configuracion`, `nombre_configuracion`, `valor_configuracion`) VALUES
(1, 'cantidad_productos', 6),
(2, 'cantidad_testimonios', 3),
(3, 'minutos_inactividad', 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `image_producto` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `stock_producto` int(10) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `precio_producto` int(11) NOT NULL,
  `descripcion_producto` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre_producto`, `image_producto`, `stock_producto`, `id_categoria`, `precio_producto`, `descripcion_producto`) VALUES
(1, 'Abrigo cargo blanco', 'product-1.jpg', 10, 6, 120, 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Distinctio vitae illum asperiores, ut, officia, praesentium consectetur maxime a molestiae quos odit nulla temporibus velit nemo!'),
(2, 'Sombrero de lana blanco', 'product-10.jpg', 19, 1, 70, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae eaque itaque corrupti placeat voluptatibus dignissimos provident perspiciatis pariatur, atque ipsa dicta nisi labore maxime officiis?'),
(3, 'Vestido azul marina', 'product-5.jpg', 5, 5, 85, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae eaque itaque corrupti placeat voluptatibus dignissimos provident perspiciatis pariatur, atque ipsa dicta nisi labore maxime officiis?'),
(5, 'Camisa esqueleto negra', 'product-2.jpg', 9, 1, 40, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Veniam, quidem?'),
(6, 'Vestido de seda amarillo', 'producto-9.jpg', 5, 5, 86, 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Architecto possimus amet incidunt reiciendis corrupti.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `testimonios`
--

CREATE TABLE `testimonios` (
  `id_testimonio` int(11) NOT NULL,
  `descripcion_testimonio` text COLLATE utf8_spanish_ci NOT NULL,
  `image_testimonio` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_testimonio` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `ubicacion_testimonio` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `testimonios`
--

INSERT INTO `testimonios` (`id_testimonio`, `descripcion_testimonio`, `image_testimonio`, `nombre_testimonio`, `ubicacion_testimonio`) VALUES
(1, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus culpa corporis explicabo animi doloremque pariatur nesciunt numquam ipsam error voluptatem! Voluptatem rerum vero reiciendis tempore.', 'persona-1.jpg', 'Sebastian Bornacelli', 'Bello, Antioquia'),
(2, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus expedita quam pariatur itaque neque nam ab ad, nostrum quo, corporis sequi. Cum quia obcaecati ut corrupti aliquid accusamus voluptatum aperiam.', 'persona-2.jpg', 'Pepito Perez', 'Bogotá, Bogotá D.C.'),
(3, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus expedita quam pariatur itaque neque nam ab ad, nostrum quo, corporis sequi. Cum quia.', 'persona-6.jpg', 'Lola Smith', 'Envigado, Antioquia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellido_usuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `sexo_usuario` enum('mujer','hombre','otro') COLLATE utf8_spanish_ci NOT NULL,
  `tipo_documento_usuario` enum('tarjeta de identidad','cédula de ciudadanía','otro') COLLATE utf8_spanish_ci NOT NULL,
  `documento_usuario` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `correo_usuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `password_usuario` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `tipo_usuario` tinyint(1) NOT NULL DEFAULT 0,
  `creado_usuario` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `apellido_usuario`, `sexo_usuario`, `tipo_documento_usuario`, `documento_usuario`, `correo_usuario`, `password_usuario`, `tipo_usuario`, `creado_usuario`) VALUES
(1, 'Dahlia', 'Michelle', 'mujer', 'tarjeta de identidad', '1000000001', 'correo@correo.com', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', 1, '2022-08-24 18:55:35'),
(2, 'Pepita', 'Gomez', 'otro', 'otro', '1000000000', 'correo2@correo.com', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', 0, '2022-08-24 18:55:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_producto` int(11) NOT NULL,
  `total_venta` int(11) NOT NULL,
  `fecha_venta` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_venta`, `id_usuario`, `id_producto`, `cantidad`, `precio_producto`, `total_venta`, `fecha_venta`) VALUES
(1, 1, 5, 2, 40, 80, '2022-08-15 19:47:53'),
(2, 1, 3, 1, 85, 85, '2022-08-15 19:47:53'),
(3, 1, 1, 1, 120, 120, '2022-08-15 19:47:53'),
(4, 1, 5, 1, 40, 40, '2022-08-15 19:47:53'),
(5, 1, 1, 2, 120, 240, '2022-08-15 19:47:53'),
(6, 1, 2, 1, 70, 70, '2022-08-15 19:47:53');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `configuraciones`
--
ALTER TABLE `configuraciones`
  ADD PRIMARY KEY (`id_configuracion`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `testimonios`
--
ALTER TABLE `testimonios`
  ADD PRIMARY KEY (`id_testimonio`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `documento` (`documento_usuario`),
  ADD UNIQUE KEY `correo electronico` (`correo_usuario`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `venta de usuario` (`id_usuario`),
  ADD KEY `venta producto` (`id_producto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `configuraciones`
--
ALTER TABLE `configuraciones`
  MODIFY `id_configuracion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `testimonios`
--
ALTER TABLE `testimonios`
  MODIFY `id_testimonio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
