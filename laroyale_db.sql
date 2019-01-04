-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-01-2019 a las 08:35:42
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `laroyale_db`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_usuario_verificar` (IN `_usuario` VARCHAR(50), IN `_clave` VARCHAR(50))  NO SQL
SELECT u.usu_codigo,u.usu_empleado,e.emp_telefono,e.emp_email,u.usu_estado,concat(e.emp_nombres,' ',e.emp_paterno) as 'usu_nombres' FROM usuario u INNER JOIN empleado e ON e.emp_codigo = u.usu_empleado WHERE u.usu_usuario = _usuario AND u.usu_clave$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `cat_codigo` int(11) NOT NULL,
  `cat_nombre` varchar(50) NOT NULL,
  `cat_abreviatura` char(10) NOT NULL,
  `cat_descripcion` varchar(50) NOT NULL,
  `cat_imagen` varchar(500) NOT NULL DEFAULT 'cloud/categoria/default_categoria.jpg',
  `cat_estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`cat_codigo`, `cat_nombre`, `cat_abreviatura`, `cat_descripcion`, `cat_imagen`, `cat_estado`) VALUES
(1, 'HAMBURGUESAS', 'HAMB', '', 'cloud/categoria/hamburguesas.jpg', 1),
(2, 'SALCHIPAPAS', 'SALCHI', '      ', 'cloud/categoria/SALCHIPAPAS.jpg', 1),
(3, 'SANDWICH DE FILETE DE POLLO', 'SAND', '      ', 'cloud/categoria/sandwich.jpg', 1),
(4, 'CERVEZA ARTESANAL', 'CERV', '  ', 'cloud/categoria/cervezas.jpg', 1),
(5, 'BEBIDAS', 'BEB', '  ', 'cloud/categoria/BEBIDAS.jpg', 1),
(6, 'BEBIDA CALIENTE', 'BEB_CAL', '          ', 'cloud/categoria/BEBIDA_CALIENTE.jpg', 1),
(7, 'EXTRAS', 'EXT', '', 'cloud/categoria/extra.jpg', 1),
(24, 'Dulce', 'DUL', '        ', 'cloud/categoria/default_categoria.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `cli_codigo` int(11) NOT NULL,
  `cli_dni` char(13) NOT NULL,
  `cli_nombres` varchar(50) NOT NULL,
  `cli_paterno` varchar(50) NOT NULL,
  `cli_materno` varchar(50) DEFAULT NULL,
  `cli_direccion` varchar(50) DEFAULT NULL,
  `cli_telefono` varchar(15) NOT NULL,
  `cli_tipocliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`cli_codigo`, `cli_dni`, `cli_nombres`, `cli_paterno`, `cli_materno`, `cli_direccion`, `cli_telefono`, `cli_tipocliente`) VALUES
(2, '70609378', 'Jenifer', 'Rojas', 'Salinas', '987452147', 'Av. 21 de abril', 1),
(3, '58964785', 'Luis ', 'Santos', 'Mont', '', '', 1),
(4, '58745630', 'Aldo ', 'Raine', 'Stfu', 'New York', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `emp_codigo` int(11) NOT NULL,
  `emp_tipodoc` int(11) DEFAULT '1',
  `emp_documento` char(15) NOT NULL,
  `emp_nombres` varchar(50) NOT NULL,
  `emp_paterno` varchar(50) NOT NULL,
  `emp_materno` varchar(50) NOT NULL,
  `emp_direccion` varchar(50) DEFAULT NULL,
  `emp_telefono` varchar(50) DEFAULT NULL,
  `emp_email` varchar(50) DEFAULT NULL,
  `emp_estado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`emp_codigo`, `emp_tipodoc`, `emp_documento`, `emp_nombres`, `emp_paterno`, `emp_materno`, `emp_direccion`, `emp_telefono`, `emp_email`, `emp_estado`) VALUES
(1, 1, '70609372', 'Carlos', 'Henostroza ', 'Ramos', 'Av. aviacion', '928005868', 'blackrap13@gmail.com', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa`
--

CREATE TABLE `mesa` (
  `mes_codigo` int(11) NOT NULL,
  `mes_numero` char(20) NOT NULL,
  `mes_descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `mesa`
--

INSERT INTO `mesa` (`mes_codigo`, `mes_numero`, `mes_descripcion`) VALUES
(1, '01', ''),
(2, '02', ''),
(3, '03', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `prod_codigo` int(11) NOT NULL,
  `prod_nombre` varchar(50) NOT NULL,
  `prod_abreviatura` char(15) NOT NULL,
  `prod_descripcion` varchar(100) NOT NULL,
  `prod_precio` decimal(8,2) NOT NULL,
  `prod_categoria` int(11) NOT NULL,
  `prod_estado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`prod_codigo`, `prod_nombre`, `prod_abreviatura`, `prod_descripcion`, `prod_precio`, `prod_categoria`, `prod_estado`) VALUES
(1, 'CON QUESO', 'C-QUESO', '', '7.00', 1, 1),
(2, 'MONTADA', 'MONT', '', '7.00', 1, 1),
(5, 'SIN QUESO', 'AABC', '																																		', '10.00', 1, 0),
(7, 'CON QUESO SOLO', 'AAB', '																																		', '10.00', 2, 0),
(8, 'CHORIPAPA', 'CHOR', '', '12.00', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_cliente`
--

CREATE TABLE `tipo_cliente` (
  `tcli_codigo` int(11) NOT NULL,
  `tcli_titulo` varchar(50) NOT NULL,
  `tcli_descripcion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_cliente`
--

INSERT INTO `tipo_cliente` (`tcli_codigo`, `tcli_titulo`, `tcli_descripcion`) VALUES
(1, 'Publico en general', ''),
(2, 'Empresa', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `tdoc_codigo` int(11) NOT NULL,
  `tdoc_titulo` varchar(50) NOT NULL,
  `tdo_descripcion` varchar(200) DEFAULT NULL,
  `tdoc_cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`tdoc_codigo`, `tdoc_titulo`, `tdo_descripcion`, `tdoc_cantidad`) VALUES
(1, 'DNI', NULL, 8),
(2, 'RUC', NULL, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usu_codigo` int(11) NOT NULL,
  `usu_empleado` int(11) NOT NULL,
  `usu_usuario` varchar(50) NOT NULL,
  `usu_clave` varchar(50) NOT NULL,
  `usu_estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usu_codigo`, `usu_empleado`, `usu_usuario`, `usu_clave`, `usu_estado`) VALUES
(1, 1, 'coda', '1013', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`cat_codigo`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cli_codigo`),
  ADD KEY `cli_tipocliente` (`cli_tipocliente`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`emp_codigo`),
  ADD KEY `emp_tipodoc` (`emp_tipodoc`);

--
-- Indices de la tabla `mesa`
--
ALTER TABLE `mesa`
  ADD PRIMARY KEY (`mes_codigo`),
  ADD UNIQUE KEY `mes_nombre` (`mes_numero`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`prod_codigo`),
  ADD UNIQUE KEY `prod_nombre` (`prod_nombre`),
  ADD UNIQUE KEY `prod_abreviatura` (`prod_abreviatura`);

--
-- Indices de la tabla `tipo_cliente`
--
ALTER TABLE `tipo_cliente`
  ADD PRIMARY KEY (`tcli_codigo`);

--
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`tdoc_codigo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usu_codigo`),
  ADD KEY `usu_empleado` (`usu_empleado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `cat_codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `cli_codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `emp_codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `mesa`
--
ALTER TABLE `mesa`
  MODIFY `mes_codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `prod_codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `tipo_cliente`
--
ALTER TABLE `tipo_cliente`
  MODIFY `tcli_codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  MODIFY `tdoc_codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usu_codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`cli_tipocliente`) REFERENCES `tipo_cliente` (`tcli_codigo`);

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`emp_tipodoc`) REFERENCES `tipo_documento` (`tdoc_codigo`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`usu_empleado`) REFERENCES `empleado` (`emp_codigo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
