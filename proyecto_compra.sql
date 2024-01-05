-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-05-2022 a las 04:42:36
-- Versión del servidor: 10.1.34-MariaDB
-- Versión de PHP: 5.6.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto_compra`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoriamenu`
--

CREATE TABLE `categoriamenu` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `orden` int(11) NOT NULL,
  `icono` varchar(100) NOT NULL,
  `estado` char(1) NOT NULL COMMENT 'N = Normal, A = Anulado, E = Eliminado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoriamenu`
--

INSERT INTO `categoriamenu` (`id`, `nombre`, `orden`, `icono`, `estado`) VALUES
(1, 'Configuracion', 1, 'nav-icon fas fa-columns', 'N'),
(2, 'Almacen', 2, 'nav-icon fas fa-columns', 'N');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoriaproducto`
--

CREATE TABLE `categoriaproducto` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `estado` char(1) NOT NULL COMMENT 'N= Normal, A= Anulado, E= Eliminado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoriaproducto`
--

INSERT INTO `categoriaproducto` (`id`, `nombre`, `estado`) VALUES
(1, 'GOLOSINAS', 'N'),
(2, 'CERVEZAS', 'N');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallemovimiento`
--

CREATE TABLE `detallemovimiento` (
  `id` int(10) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL,
  `preciounitario` decimal(9,2) NOT NULL,
  `subtotal` decimal(9,2) NOT NULL,
  `producto_id` int(10) UNSIGNED NOT NULL,
  `movimiento_id` int(10) UNSIGNED NOT NULL,
  `estado` char(1) NOT NULL COMMENT 'N= Normal, A= Anulado, E= Eliminado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detallemovimiento`
--

INSERT INTO `detallemovimiento` (`id`, `cantidad`, `preciounitario`, `subtotal`, `producto_id`, `movimiento_id`, `estado`) VALUES
(1, 4, '4.00', '16.00', 1, 1, 'N'),
(2, 4, '3.50', '14.00', 2, 1, 'N'),
(3, 4, '4.00', '16.00', 1, 2, 'N'),
(4, 4, '3.50', '14.00', 2, 2, 'N'),
(5, 6, '4.00', '24.00', 1, 3, 'N');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kardex`
--

CREATE TABLE `kardex` (
  `id` int(10) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `tipo` char(1) NOT NULL COMMENT 'I=Ingreso, S = Salida',
  `cantidad` int(11) NOT NULL,
  `stockanterior` int(11) NOT NULL,
  `stockactual` int(11) NOT NULL,
  `producto_id` int(10) UNSIGNED NOT NULL,
  `detallemovimiento_id` int(10) UNSIGNED NOT NULL,
  `estado` char(1) NOT NULL COMMENT 'N= Normal, A= Anulado, E= Eliminado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `kardex`
--

INSERT INTO `kardex` (`id`, `fecha`, `tipo`, `cantidad`, `stockanterior`, `stockactual`, `producto_id`, `detallemovimiento_id`, `estado`) VALUES
(1, '2022-05-13', 'I', 4, 0, 4, 1, 3, 'N'),
(2, '2022-05-13', 'I', 4, 0, 4, 2, 4, 'N'),
(3, '2022-05-13', 'I', 6, 4, 10, 1, 5, 'N');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimiento`
--

CREATE TABLE `movimiento` (
  `id` int(10) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `total` decimal(9,2) NOT NULL,
  `serie` varchar(5) NOT NULL,
  `numerodocumento` varchar(10) NOT NULL,
  `persona_id` int(10) UNSIGNED NOT NULL,
  `tipomovimiento_id` int(10) UNSIGNED NOT NULL,
  `estado` char(1) NOT NULL COMMENT 'N= Normal, A= Anulado, E= Eliminado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `movimiento`
--

INSERT INTO `movimiento` (`id`, `fecha`, `total`, `serie`, `numerodocumento`, `persona_id`, `tipomovimiento_id`, `estado`) VALUES
(1, '2022-05-13', '30.00', '001', '0000021', 2, 1, 'N'),
(2, '2022-05-13', '30.00', '001', '0000021', 2, 1, 'N'),
(3, '2022-05-13', '24.00', '001', '00000022', 1, 1, 'N');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opcionmenu`
--

CREATE TABLE `opcionmenu` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `link` text NOT NULL,
  `orden` int(11) NOT NULL,
  `categoriamenu_id` int(10) UNSIGNED NOT NULL,
  `estado` char(1) NOT NULL COMMENT 'N= Normal, A=Anulado, E= Eliminado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `opcionmenu`
--

INSERT INTO `opcionmenu` (`id`, `nombre`, `link`, `orden`, `categoriamenu_id`, `estado`) VALUES
(3, 'Categoria de Productos', 'presentacion/adminCategoriaproducto.php', 1, 1, 'N'),
(4, 'Productos', 'presentacion/adminProducto.php', 2, 1, 'N'),
(5, 'Compras', 'presentacion/adminCompra.php', 1, 2, 'N'),
(6, 'Kardex', 'presentacion/adminKardex.php', 2, 2, 'N'),
(7, 'Proveedores', 'presentacion/adminProveedor.php', 3, 1, 'N');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `id` int(10) UNSIGNED NOT NULL,
  `tipousuario_id` int(10) UNSIGNED NOT NULL,
  `opcionmenu_id` int(10) UNSIGNED NOT NULL,
  `estado` char(1) NOT NULL COMMENT 'N= Normal, A= Anulado, E= Eliminado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`id`, `tipousuario_id`, `opcionmenu_id`, `estado`) VALUES
(1, 1, 3, 'N'),
(2, 1, 4, 'N'),
(3, 1, 5, 'N'),
(4, 1, 6, 'N'),
(5, 1, 7, 'N');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombres` varchar(100) DEFAULT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `dni` char(8) DEFAULT NULL,
  `ruc` char(11) DEFAULT NULL,
  `razon_social` varchar(100) DEFAULT NULL,
  `tipopersona` char(1) NOT NULL COMMENT 'P=Persona, E=Empresa',
  `direccion` text NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `tipocliente` char(1) NOT NULL COMMENT 'S=SI, N = NO',
  `tipoproveedor` char(1) NOT NULL COMMENT 'S=SI, N = NO',
  `estado` char(1) NOT NULL COMMENT 'N= Normal, A= Anulado, E= Eliminado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id`, `nombres`, `apellidos`, `dni`, `ruc`, `razon_social`, `tipopersona`, `direccion`, `telefono`, `tipocliente`, `tipoproveedor`, `estado`) VALUES
(1, 'SERGIO', 'PERALTE BENAVIDES', '00000001', '', '', 'P', 'Calle Galvez 285', '987541236', 'N', 'S', 'N'),
(2, '', '', '', '20607599727', 'INSTITUTO DE SOFTWARE ISI S.A.C', 'E', 'Juan Cuglievan 216', '979176300', 'N', 'S', 'N');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `preciocompra` decimal(9,2) NOT NULL,
  `precioventa` decimal(9,2) NOT NULL,
  `stockminimo` int(11) NOT NULL,
  `categoriaproducto_id` int(10) UNSIGNED NOT NULL,
  `estado` char(1) NOT NULL COMMENT 'N= Normal, A= Anulado, E= Eliminado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `nombre`, `preciocompra`, `precioventa`, `stockminimo`, `categoriaproducto_id`, `estado`) VALUES
(1, 'PILSEN', '4.00', '8.00', 24, 2, 'N'),
(2, 'CRISTAL', '3.50', '5.00', 36, 2, 'N'),
(3, 'CORONA', '4.50', '6.00', 24, 2, 'N');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipomovimiento`
--

CREATE TABLE `tipomovimiento` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `estado` char(1) NOT NULL COMMENT 'N= Normal, A= Anulado, E= Eliminado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipomovimiento`
--

INSERT INTO `tipomovimiento` (`id`, `nombre`, `estado`) VALUES
(1, 'COMPRA', 'N');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipousuario`
--

CREATE TABLE `tipousuario` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `estado` char(1) NOT NULL COMMENT 'N= Normal, A= Anulado, E= Eliminado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipousuario`
--

INSERT INTO `tipousuario` (`id`, `nombre`, `estado`) VALUES
(1, 'ADMINISTRADOR', 'N');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(10) UNSIGNED NOT NULL,
  `login` varchar(15) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `tipousuario_id` int(10) UNSIGNED NOT NULL,
  `estado` char(1) NOT NULL COMMENT 'N= Normal, A= Anulado, E= Eliminado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `login`, `clave`, `tipousuario_id`, `estado`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, 'N');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoriamenu`
--
ALTER TABLE `categoriamenu`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categoriaproducto`
--
ALTER TABLE `categoriaproducto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detallemovimiento`
--
ALTER TABLE `detallemovimiento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_id` (`producto_id`),
  ADD KEY `movimiento_id` (`movimiento_id`);

--
-- Indices de la tabla `kardex`
--
ALTER TABLE `kardex`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_id` (`producto_id`),
  ADD KEY `detallemovimiento_id` (`detallemovimiento_id`);

--
-- Indices de la tabla `movimiento`
--
ALTER TABLE `movimiento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `persona_id` (`persona_id`),
  ADD KEY `tipomovimiento_id` (`tipomovimiento_id`);

--
-- Indices de la tabla `opcionmenu`
--
ALTER TABLE `opcionmenu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoriamenu_id` (`categoriamenu_id`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tipousuario_id` (`tipousuario_id`),
  ADD KEY `opcionmenu_id` (`opcionmenu_id`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoriaproducto_id` (`categoriaproducto_id`);

--
-- Indices de la tabla `tipomovimiento`
--
ALTER TABLE `tipomovimiento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tipousuario_id` (`tipousuario_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoriamenu`
--
ALTER TABLE `categoriamenu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `categoriaproducto`
--
ALTER TABLE `categoriaproducto`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `detallemovimiento`
--
ALTER TABLE `detallemovimiento`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `kardex`
--
ALTER TABLE `kardex`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `movimiento`
--
ALTER TABLE `movimiento`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `opcionmenu`
--
ALTER TABLE `opcionmenu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipomovimiento`
--
ALTER TABLE `tipomovimiento`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detallemovimiento`
--
ALTER TABLE `detallemovimiento`
  ADD CONSTRAINT `fr_detallemovimiento_movimiento_id` FOREIGN KEY (`movimiento_id`) REFERENCES `movimiento` (`id`),
  ADD CONSTRAINT `fr_detallemovimiento_producto_id` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`);

--
-- Filtros para la tabla `kardex`
--
ALTER TABLE `kardex`
  ADD CONSTRAINT `fr_kardex_detallemovimiento_id` FOREIGN KEY (`detallemovimiento_id`) REFERENCES `detallemovimiento` (`id`),
  ADD CONSTRAINT `fr_kardex_producto_id` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`);

--
-- Filtros para la tabla `movimiento`
--
ALTER TABLE `movimiento`
  ADD CONSTRAINT `fr_movimiento_persona_id` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`),
  ADD CONSTRAINT `fr_movimiento_tipomovimiento_id` FOREIGN KEY (`tipomovimiento_id`) REFERENCES `tipomovimiento` (`id`);

--
-- Filtros para la tabla `opcionmenu`
--
ALTER TABLE `opcionmenu`
  ADD CONSTRAINT `fr_opcionmenu_categoriamenu_id` FOREIGN KEY (`categoriamenu_id`) REFERENCES `categoriamenu` (`id`);

--
-- Filtros para la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD CONSTRAINT `fr_permiso_tipousuario_id` FOREIGN KEY (`tipousuario_id`) REFERENCES `tipousuario` (`id`),
  ADD CONSTRAINT `permiso_ibfk_1` FOREIGN KEY (`opcionmenu_id`) REFERENCES `opcionmenu` (`id`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fr_producto_categoriaproducto_id` FOREIGN KEY (`categoriaproducto_id`) REFERENCES `categoriaproducto` (`id`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fr_usuario_tipousuario_id` FOREIGN KEY (`tipousuario_id`) REFERENCES `tipousuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
