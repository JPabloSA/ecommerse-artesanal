-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 15-11-2018 a las 10:33:10
-- Versión del servidor: 10.3.10-MariaDB-1:10.3.10+maria~stretch
-- Versión de PHP: 7.0.30-0+deb9u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_storesalca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idcategoria` int(11) NOT NULL,
  `empresa_idempresa` int(11) DEFAULT NULL,
  `nombre` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idcategoria`, `empresa_idempresa`, `nombre`) VALUES
(1, 1, 'Altaseda'),
(2, 1, 'Hilo Mish');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idcliente` int(11) NOT NULL,
  `usuario_idusuario` int(11) DEFAULT NULL,
  `nombre` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apellido` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nit` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idcliente`, `usuario_idusuario`, `nombre`, `apellido`, `direccion`, `nit`, `telefono`) VALUES
(1, 3, 'cliente', 'nuevo', 'ciudad', '123456789', '321654987');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colaborador`
--

CREATE TABLE `colaborador` (
  `idcolaborador` int(11) NOT NULL,
  `empresa_idempresa` int(11) DEFAULT NULL,
  `usuario_idusuario` int(11) DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `puesto` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `colaborador`
--

INSERT INTO `colaborador` (`idcolaborador`, `empresa_idempresa`, `usuario_idusuario`, `nombre`, `puesto`, `estado`) VALUES
(1, 1, 2, 'Jose Pablo', 'Gerente', 1),
(2, 1, 4, 'juan perez', 'Recepcion', NULL),
(3, 1, 5, 'juan perez 2', 'Bodega', NULL),
(4, 1, 6, 'juan perez 3', 'Produccion', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallepedido`
--

CREATE TABLE `detallepedido` (
  `iddetallepedido` int(11) NOT NULL,
  `pedido_idpedido` int(11) DEFAULT NULL,
  `producto_idproducto` int(11) DEFAULT NULL,
  `cantidad` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `detallepedido`
--

INSERT INTO `detallepedido` (`iddetallepedido`, `pedido_idpedido`, `producto_idproducto`, `cantidad`, `total`) VALUES
(17, 1, 1, '2', '2000'),
(18, 1, 3, '3', '4500'),
(19, 1, 2, '4', '4800');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `idempresa` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ubicacion` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logourl` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`idempresa`, `nombre`, `descripcion`, `ubicacion`, `logourl`) VALUES
(1, 'Textiles Americo', 'Empresa artesanal de creacion de cortes tipicos guatemaltecos', 'Salcaja,Quetzaltenango', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `idpedido` int(11) NOT NULL,
  `cliente_idcliente` int(11) DEFAULT NULL,
  `empresa_idempresa` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `total` double DEFAULT NULL,
  `envio` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `codigopedido` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipopago` int(11) DEFAULT NULL,
  `boleta` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`idpedido`, `cliente_idcliente`, `empresa_idempresa`, `fecha`, `total`, `envio`, `estado`, `codigopedido`, `tipopago`, `boleta`) VALUES
(1, 1, 1, '2018-10-13 10:51:51', 9, 'pendiente', 0, '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idproducto` int(11) NOT NULL,
  `categoria_idcategoria` int(11) DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` varchar(600) COLLATE utf8_unicode_ci DEFAULT NULL,
  `existencia` int(11) DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `preciomayorista` double DEFAULT NULL,
  `imgurl` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idproducto`, `categoria_idcategoria`, `nombre`, `descripcion`, `existencia`, `precio`, `preciomayorista`, `imgurl`) VALUES
(1, 1, 'Solomeros', 'Cortes tipico guatemalteco', 10, 1000, 900, 'http://www.terraexperience.com/images/Doll_Clothes_fit_18_American_Girl_Doll/DC_T_CC/10d2.JPG'),
(2, 1, 'Mariposa', 'Corte Tipico mariposa', 10, 1200, 1100, 'http://www.terraexperience.com/images/Doll_Clothes_fit_18_American_Girl_Doll/DC_T_CC/10d2.JPG'),
(3, 1, 'Mixtos', 'Cortes tipico estilo mixto', 10, 1500, 1300, 'http://www.terraexperience.com/images/Doll_Clothes_fit_18_American_Girl_Doll/DC_T_CC/10d2.JPG');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rol` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `username`, `password`, `rol`, `estado`) VALUES
(2, 'admin@gmail.com', '$2a$04$MxUJVcNylYsS76sfcMAUVOZd4o3D7I788g1u6pHu5JAUMQk0fkEY6', 'Empresa', 1),
(3, 'cliente@gmail.com', '$2a$04$8c1DieSPJWIYRKDRrEfp6.jRCNyWNW3A0RST.CxVoFFm193kCWHdC', 'Cliente', 1),
(4, 'juan@gmail.com', '$2y$04$ocx8yHEUey4NG8tGLxAzieTVVHcb/0.u.g6UJOegz/WL80c97WSEK', 'Empresa', 1),
(5, 'juan2@gmail.com', '$2y$04$B6FSbj8u2T.MjkLSTZoeF.DlOgtiT4wRrRc1OT3bc6rkHD/Md7LlW', 'Empresa', 1),
(6, 'juan3@gmail.com', '$2y$04$.pNeh1psd2h3uuHtNSXrzO.SWJIJQ2gXgjDiWJ4okAwoH1MB8/Oau', 'Empresa', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idcategoria`),
  ADD KEY `fk_categoria_empresa1_idx` (`empresa_idempresa`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idcliente`),
  ADD KEY `fk_cliente_usuario1_idx` (`usuario_idusuario`);

--
-- Indices de la tabla `colaborador`
--
ALTER TABLE `colaborador`
  ADD PRIMARY KEY (`idcolaborador`),
  ADD KEY `fk_colaborador_usuario1_idx` (`usuario_idusuario`),
  ADD KEY `fk_colaborador_empresa1_idx` (`empresa_idempresa`);

--
-- Indices de la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  ADD PRIMARY KEY (`iddetallepedido`),
  ADD KEY `fk_detallepedido_pedido1_idx` (`pedido_idpedido`),
  ADD KEY `fk_detallepedido_producto1_idx` (`producto_idproducto`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`idempresa`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`idpedido`),
  ADD KEY `fk_pedido_empresa1_idx` (`empresa_idempresa`),
  ADD KEY `fk_pedido_cliente1_idx` (`cliente_idcliente`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idproducto`),
  ADD KEY `fk_producto_categoria1_idx` (`categoria_idcategoria`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `colaborador`
--
ALTER TABLE `colaborador`
  MODIFY `idcolaborador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  MODIFY `iddetallepedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `idempresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `idpedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `FK_4E10122D6B659A41` FOREIGN KEY (`empresa_idempresa`) REFERENCES `empresa` (`idempresa`);

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `FK_F41C9B25745A0821` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`);

--
-- Filtros para la tabla `colaborador`
--
ALTER TABLE `colaborador`
  ADD CONSTRAINT `FK_D2F80BB36B659A41` FOREIGN KEY (`empresa_idempresa`) REFERENCES `empresa` (`idempresa`),
  ADD CONSTRAINT `FK_D2F80BB3745A0821` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`);

--
-- Filtros para la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  ADD CONSTRAINT `FK_90A2B006A398EB5` FOREIGN KEY (`pedido_idpedido`) REFERENCES `pedido` (`idpedido`),
  ADD CONSTRAINT `FK_90A2B006D623167B` FOREIGN KEY (`producto_idproducto`) REFERENCES `producto` (`idproducto`);

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `FK_C4EC16CE3C15468F` FOREIGN KEY (`cliente_idcliente`) REFERENCES `cliente` (`idcliente`),
  ADD CONSTRAINT `FK_C4EC16CE6B659A41` FOREIGN KEY (`empresa_idempresa`) REFERENCES `empresa` (`idempresa`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `FK_A7BB06152F4CF747` FOREIGN KEY (`categoria_idcategoria`) REFERENCES `categoria` (`idcategoria`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
