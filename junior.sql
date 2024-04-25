-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-04-2024 a las 18:07:29
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `junior`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activo`
--

CREATE TABLE `activo` (
  `id_activo` int(11) NOT NULL,
  `nombre_activo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `activo`
--

INSERT INTO `activo` (`id_activo`, `nombre_activo`) VALUES
(1, 'Activo'),
(2, 'Inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(50) NOT NULL,
  `id_activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre_categoria`, `id_activo`) VALUES
(1, '', 1),
(2, 'Bebidas', 1),
(3, 'Comida Rapida', 1),
(4, 'Ejecutivo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `primer_nombre` varchar(50) NOT NULL,
  `segundo_nombre` varchar(50) NOT NULL,
  `primer_apellido` varchar(50) NOT NULL,
  `segundo_apellido` varchar(50) NOT NULL,
  `numero_cc` bigint(20) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `id_local` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `primer_nombre`, `segundo_nombre`, `primer_apellido`, `segundo_apellido`, `numero_cc`, `correo`, `id_local`) VALUES
(3, 'Jogan', 'Felipe', 'Rengifo', 'Solarte', 1070586140, 'feliperenjifoz@gmail.com', 1),
(4, 'Jogan', '', 'Rengifo', 'Solarte', 1070586140, 'feliperenjifoz@gmail.com', 1),
(5, 'Cristian', 'Camilo', 'Silva', '', 11111111, 'feliperenjifoz@gmail.com', 1),
(6, 'Cristian', '', 'Silva', '', 11111111, 'feliperenjifoz@gmail.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_mesa`
--

CREATE TABLE `estado_mesa` (
  `id_estado_mesa` int(11) NOT NULL,
  `nombre_estado` varchar(50) NOT NULL,
  `color_estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estado_mesa`
--

INSERT INTO `estado_mesa` (`id_estado_mesa`, `nombre_estado`, `color_estado`) VALUES
(1, 'Disponible', 'btn btn-secondary'),
(2, 'Atendido', 'btn btn-primary'),
(3, 'Preparación', 'btn btn-info'),
(4, 'Entregado', 'btn btn-success'),
(5, 'Pago parcial', 'btn btn-danger');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `descripcion` text NOT NULL,
  `color` text NOT NULL,
  `textColor` varchar(20) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id`, `title`, `descripcion`, `color`, `textColor`, `start`, `end`) VALUES
(1, 'Prueba Modificar', 'Prueba evento modificado', '#00ffb3', '#FFFFFF', '2024-04-12 10:03:00', '2024-04-12 10:03:00'),
(2, 'asdasd', 'dsadas', '#99ff00', '#FFFFFF', '2024-04-13 15:56:00', '2024-04-13 15:56:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id_factura` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_factura` date NOT NULL DEFAULT current_timestamp(),
  `total_factura` int(11) NOT NULL,
  `metodo_pago` varchar(20) DEFAULT NULL,
  `efectivo` int(11) DEFAULT NULL,
  `cambio` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`id_factura`, `id_usuario`, `fecha_factura`, `total_factura`, `metodo_pago`, `efectivo`, `cambio`, `id_cliente`) VALUES
(1, 23, '2024-04-19', 4000, 'nequi', 4000, 0, 4),
(2, 23, '2024-04-19', 11000, 'nequi', 11000, 0, 5),
(3, 23, '2024-04-23', 11000, 'nequi', 11000, 0, 3),
(4, 23, '2024-04-23', 11000, 'nequi', 11000, 0, 3),
(5, 23, '2024-04-23', 37000, 'nequi', 37000, 0, 3),
(6, 23, '2024-04-25', 330000, 'nequi', 330000, 0, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_proeevedor`
--

CREATE TABLE `factura_proeevedor` (
  `id_factura_proeevedor` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_proeevedor` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_medida` int(11) NOT NULL,
  `codigo_producto` bigint(20) NOT NULL,
  `nombre_producto` varchar(100) NOT NULL,
  `precio_unitario` int(11) NOT NULL,
  `cantidad_producto` bigint(20) NOT NULL,
  `fecha_ingreso` date NOT NULL DEFAULT current_timestamp(),
  `pago_factura` bigint(20) NOT NULL,
  `id_local` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `factura_proeevedor`
--

INSERT INTO `factura_proeevedor` (`id_factura_proeevedor`, `id_categoria`, `id_proeevedor`, `id_usuario`, `id_medida`, `codigo_producto`, `nombre_producto`, `precio_unitario`, `cantidad_producto`, `fecha_ingreso`, `pago_factura`, `id_local`) VALUES
(1, 1, 1, 23, 1, 1231, 'Prueba 2', 4000, 10, '2024-04-10', 0, 1),
(2, 1, 1, 23, 1, 132131, 'Prueba 3', 11000, 10, '2024-04-10', 0, 1),
(3, 1, 1, 23, 1, 32132131, 'Coca-cola 1.5 l', 11000, 10, '2024-04-10', 0, 1),
(4, 1, 1, 23, 1, 13123, '2 Hambuerguesas', 13000, 10, '2024-04-10', 0, 1),
(5, 1, 1, 23, 1, 132131, 'Promocion hamburguesa mas coca cola 400 ml', 15000, 10, '2024-04-11', 0, 1),
(6, 1, 1, 23, 1, 31231, 'Bandeja', 13000, 0, '2024-04-12', 0, 1),
(7, 2, 1, 23, 1, 1231231, 'fdfsfs', 1111, 20, '2024-04-16', 0, 1),
(8, 1, 1, 23, 1, 0, 'cebolla larga', 0, 10, '2024-04-16', 0, 1),
(9, 1, 1, 23, 1, 0, 'Agua', 0, 100, '2024-04-19', 10000, 1),
(10, 2, 1, 23, 1, 99, 'Paisa', 20000, 10, '2024-04-19', 60000, 1),
(11, 1, 1, 23, 1, 0, 'Agua', 0, 10, '2024-04-24', 0, 1),
(12, 1, 1, 23, 1, 0, 'Tomate', 0, 10, '2024-04-24', 0, 1),
(13, 1, 1, 23, 1, 0, 'Tomate', 0, 100, '2024-04-24', 0, 1),
(14, 1, 1, 23, 1, 0, 'Tomate', 0, 1, '2024-04-24', 0, 1),
(15, 1, 1, 23, 1, 0, 'Agua', 0, 1, '2024-04-24', 0, 1),
(16, 1, 1, 23, 1, 0, 'lentejas', 0, 1, '2024-04-24', 0, 1),
(17, 1, 1, 23, 1, 0, 'Jamón', 0, 1300, '2024-04-24', 0, 1),
(18, 2, 1, 23, 1, 111, 'Pizza', 11000, 10, '2024-04-25', 0, 1),
(19, 2, 1, 23, 1, 111, 'Pizzaaaaaaaa', 11000, 0, '2024-04-25', 0, 1),
(20, 2, 1, 23, 1, 111, 'Pizza jamon', 11000, 0, '2024-04-25', 0, 1),
(21, 1, 1, 23, 1, 0, 'Churrasco', 0, 0, '2024-04-25', 0, 1),
(22, 2, 1, 23, 2, 2, 'coca cola 400 ml', 4000, 0, '2024-04-25', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funiones`
--

CREATE TABLE `funiones` (
  `id_funciones` int(11) NOT NULL,
  `nombre_campo` varchar(50) NOT NULL,
  `nombre_confi` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `Nota` varchar(255) NOT NULL,
  `estado` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `funiones`
--

INSERT INTO `funiones` (`id_funciones`, `nombre_campo`, `nombre_confi`, `descripcion`, `Nota`, `estado`) VALUES
(1, 'impresionPos', 'Configuración impresión POS Cocina', 'Al Habilitar esta función el sistema reconocerá cuando el mesero haya realizado una comanda.', 'Nota: Es recomendable usar esta función cuando no se tenga una pantalla en la cocina.', 'true');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingrediente`
--

CREATE TABLE `ingrediente` (
  `id_ingrediente` int(11) NOT NULL,
  `nombre_ingrediente` varchar(100) NOT NULL,
  `id_medida` int(11) NOT NULL,
  `cantidad` bigint(20) NOT NULL,
  `id_local` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ingrediente`
--

INSERT INTO `ingrediente` (`id_ingrediente`, `nombre_ingrediente`, `id_medida`, `cantidad`, `id_local`) VALUES
(3, 'Tomate', 1, 113, 1),
(4, 'Array', 1, 10, 1),
(5, 'Cebolla', 1, 216, 1),
(6, 'lechuga', 1, -6264, 1),
(7, 'Jamón', 1, -2900, 1),
(8, 'Arroz', 1, 500, 1),
(9, 'frijol', 1, 1000, 1),
(11, 'lentejas', 1, 1001, 1),
(12, 'cebolla larga', 1, 10, 1),
(16, 'Churrasco', 1, 101, 1),
(17, 'Agua', 1, 10, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingrediente_producto`
--

CREATE TABLE `ingrediente_producto` (
  `id_ingrediente_producto` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_ingrediente` int(11) DEFAULT NULL,
  `cantidad` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ingrediente_producto`
--

INSERT INTO `ingrediente_producto` (`id_ingrediente_producto`, `id_producto`, `id_ingrediente`, `cantidad`) VALUES
(1, 2, 3, 2),
(2, 15, 5, 216),
(3, 15, 6, 216),
(4, 15, 7, 100),
(5, 2, 6, 216),
(6, 2, 5, 216),
(7, 1, 7, 100),
(8, 15, 7, 100),
(9, 1, 6, 216),
(10, 15, 16, 101),
(11, 15, 17, 40);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `local`
--

CREATE TABLE `local` (
  `id_local` int(11) NOT NULL,
  `nombre_local` varchar(100) NOT NULL,
  `nit` varchar(12) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `local`
--

INSERT INTO `local` (`id_local`, `nombre_local`, `nit`, `direccion`, `telefono`) VALUES
(1, 'local 1', '1111', 'Mz J Casa 15', 111111);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medida`
--

CREATE TABLE `medida` (
  `id_medida` int(11) NOT NULL,
  `nombre_medida` varchar(50) NOT NULL,
  `id_activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `medida`
--

INSERT INTO `medida` (`id_medida`, `nombre_medida`, `id_activo`) VALUES
(1, 'GR', 1),
(2, 'ML', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa`
--

CREATE TABLE `mesa` (
  `id_mesa` int(11) NOT NULL,
  `nombre_mesa` varchar(50) NOT NULL,
  `id_estado_mesa` int(11) NOT NULL,
  `id_piso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mesa`
--

INSERT INTO `mesa` (`id_mesa`, `nombre_mesa`, `id_estado_mesa`, `id_piso`) VALUES
(5, 'Mesa 1', 1, 1),
(6, 'Mesa 2', 1, 1),
(7, 'Mesa 3', 1, 1),
(8, 'Mesa 4', 1, 1),
(9, 'Mesa 5', 1, 1),
(10, 'Mesa 6', 1, 1),
(11, 'Mesa 7', 1, 1),
(12, 'Mesa 8', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nomina`
--

CREATE TABLE `nomina` (
  `id_nomina` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `rol` varchar(20) NOT NULL,
  `dias_trabajados` int(11) NOT NULL,
  `pago` int(11) NOT NULL,
  `fecha_ingreso` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `nomina`
--

INSERT INTO `nomina` (`id_nomina`, `id_usuario`, `nombre`, `apellido`, `rol`, `dias_trabajados`, `pago`, `fecha_ingreso`) VALUES
(1, 24, 'Ana', 'Ochica', 'Gerente', 0, 50000, '2024-04-19'),
(2, 24, 'Ana', 'Ochica', 'Gerente', 7, 420000, '2024-04-23'),
(3, 23, 'Jogan', 'Rengifo', 'Administrador', 2, 90000, '2024-04-23'),
(4, 25, 'Karen', 'Calderon', 'Gerente', 2, 100000, '2024-04-23'),
(5, 24, 'Ana', 'Ochica', 'Gerente', 1, 40000, '2024-04-25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `id_pedido` int(11) NOT NULL,
  `id_mesa` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `producto` varchar(200) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `id_estado_mesa` int(11) NOT NULL,
  `fecha_ingreso` datetime NOT NULL DEFAULT current_timestamp(),
  `id_usuario` int(11) NOT NULL,
  `print` int(11) NOT NULL,
  `cocina` int(11) NOT NULL,
  `pago` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id_pedido`, `id_mesa`, `id_producto`, `producto`, `descripcion`, `cantidad`, `id_estado_mesa`, `fecha_ingreso`, `id_usuario`, `print`, `cocina`, `pago`) VALUES
(8, 5, 2, 'Hamburguesa', 'Tomate, Cebolla, lechuga', 1, 4, '0000-00-00 00:00:00', 23, 1, 0, 0),
(9, 5, 2, 'Hamburguesa', 'Tomate, Cebolla', 1, 4, '0000-00-00 00:00:00', 23, 1, 0, 0),
(10, 5, 1, 'Pizza', 'Jamón', 1, 4, '0000-00-00 00:00:00', 23, 1, 0, 0),
(11, 5, 8, 'Coca-cola 1.5 l', '', 1, 4, '0000-00-00 00:00:00', 23, 1, 0, 0),
(12, 7, 1, 'Pizza', 'Jamón', 3, 4, '2024-04-11 01:07:46', 23, 1, 0, 0),
(13, 7, 3, 'coca cola 400 ml', '', 1, 4, '2024-04-11 01:07:46', 23, 1, 0, 0),
(14, 7, 2, 'Hamburguesa', 'Cebolla, lechuga', 1, 4, '2024-04-11 01:15:26', 23, 1, 0, 0),
(15, 7, 3, 'coca cola 400 ml', '', 1, 4, '2024-04-11 01:15:27', 23, 1, 0, 0),
(16, 5, 2, 'Hamburguesa', 'Tomate, Cebolla, lechuga', 2, 4, '0000-00-00 00:00:00', 23, 1, 0, 0),
(17, 5, 1, 'Pizza', 'Jamón', 1, 4, '0000-00-00 00:00:00', 23, 1, 0, 0),
(18, 5, 8, 'Coca-cola 1.5 l', '', 1, 4, '0000-00-00 00:00:00', 23, 1, 0, 0),
(19, 5, 2, 'Hamburguesa', 'Tomate, Cebolla, lechuga', 1, 4, '0000-00-00 00:00:00', 23, 1, 0, 0),
(20, 7, 2, 'Hamburguesa', 'Tomate, Cebolla, lechuga', 1, 4, '2024-04-11 11:00:07', 23, 1, 0, 0),
(21, 7, 1, 'Pizza', 'Jamón', 1, 4, '2024-04-11 11:00:07', 23, 1, 0, 0),
(22, 7, 3, 'coca cola 400 ml', '', 1, 4, '2024-04-11 11:00:07', 23, 1, 0, 0),
(23, 7, 1, 'Pizza', 'Jamón', 1, 4, '2024-04-12 10:46:35', 23, 1, 0, 0),
(24, 5, 2, 'Hamburguesa', 'Tomate, Cebolla, lechuga', 1, 4, '0000-00-00 00:00:00', 23, 1, 0, 0),
(25, 5, 15, 'Bandeja', '', 1, 4, '0000-00-00 00:00:00', 23, 1, 0, 0),
(26, 5, 13, '2 Hambuerguesas', '', 2, 4, '0000-00-00 00:00:00', 23, 1, 0, 0),
(27, 5, 2, 'Hamburguesa', 'Tomate, Cebolla, lechuga', 2, 4, '0000-00-00 00:00:00', 23, 1, 0, 0),
(28, 7, 2, 'Hamburguesa', 'Tomate, Cebolla ', 1, 4, '2024-04-13 15:49:24', 23, 1, 0, 0),
(29, 7, 1, 'Pizza', 'Jamón', 1, 4, '2024-04-13 15:49:24', 23, 1, 0, 0),
(30, 7, 14, 'Promocion hamburguesa mas coca cola 400 ml', '', 1, 4, '2024-04-13 15:51:22', 23, 1, 0, 0),
(31, 7, 2, 'Hamburguesa', 'Tomate, Cebolla, lechuga', 1, 4, '2024-04-13 15:52:36', 23, 1, 0, 0),
(32, 7, 3, 'coca cola 400 ml', '', 1, 4, '2024-04-13 15:52:36', 23, 1, 0, 0),
(33, 7, 15, 'Bandeja', '', 2, 4, '2024-04-13 15:52:36', 23, 1, 0, 0),
(34, 5, 2, 'Hamburguesa', 'Cebolla, lechuga', 1, 4, '0000-00-00 00:00:00', 23, 1, 0, 0),
(35, 7, 1, 'Pizza', 'Jamón', 1, 4, '2024-04-15 07:10:35', 23, 1, 1, 0),
(36, 5, 2, 'Hamburguesa', 'Tomate, Cebolla, lechuga', 1, 4, '0000-00-00 00:00:00', 23, 1, 1, 0),
(37, 5, 3, 'coca cola 400 ml', '', 1, 4, '2024-04-19 12:00:32', 23, 1, 1, 0),
(38, 5, 2, 'Hamburguesa', 'Tomate, Cebolla, lechuga', 2, 4, '2024-04-19 12:26:41', 23, 1, 0, 1),
(39, 5, 1, 'Pizza', 'Jamón', 1, 4, '2024-04-19 12:26:41', 23, 1, 0, 1),
(40, 5, 8, 'Coca-cola 1.5 l', '', 1, 4, '2024-04-19 12:26:41', 23, 1, 0, 1),
(41, 7, 2, 'Hamburguesa', 'Tomate, Cebolla, lechuga', 1, 4, '2024-04-19 16:54:39', 23, 1, 0, 0),
(42, 7, 13, '2 Hambuerguesas', '', 1, 4, '2024-04-19 10:36:13', 23, 1, 0, 0),
(43, 8, 14, 'Promocion hamburguesa mas coca cola 400 ml', '', 2, 3, '2024-04-19 10:40:30', 23, 1, 0, 1),
(44, 5, 3, 'coca cola 400 ml', '', 1, 3, '2024-04-19 12:26:41', 23, 1, 0, 1),
(45, 8, 3, 'coca cola 400 ml', '', 1, 4, '2024-04-19 15:42:44', 23, 1, 1, 1),
(46, 8, 1, 'Pizza', 'Jamón', 1, 4, '2024-04-19 15:42:44', 23, 1, 1, 1),
(47, 5, 2, 'Hamburguesa', 'Tomate, Cebolla, lechuga', 1, 4, '2024-04-23 15:21:36', 23, 1, 0, 1),
(48, 5, 2, 'Hamburguesa', 'Tomate, lechuga', 1, 4, '2024-04-23 15:21:36', 23, 1, 0, 1),
(49, 5, 2, 'Hamburguesa', 'Tomate, Cebolla, lechuga', 1, 4, '2024-04-23 15:34:03', 23, 1, 0, 0),
(50, 5, 1, 'Pizza', 'Jamón', 1, 4, '2024-04-23 15:34:03', 23, 1, 0, 0),
(51, 7, 2, 'Hamburguesa', 'Tomate, Cebolla', 1, 4, '2024-04-23 21:43:39', 23, 1, 0, 1),
(52, 7, 2, 'Hamburguesa', ' Cebolla, lechuga', 1, 4, '2024-04-23 21:43:39', 23, 1, 0, 1),
(53, 7, 2, 'Hamburguesa', 'Tomate, Cebolla, lechuga', 1, 4, '2024-04-23 21:43:39', 23, 1, 0, 1),
(54, 7, 3, 'coca cola 400 ml', '', 1, 4, '2024-04-23 21:43:39', 23, 1, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `piso`
--

CREATE TABLE `piso` (
  `id_piso` int(11) NOT NULL,
  `piso_nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `piso`
--

INSERT INTO `piso` (`id_piso`, `piso_nombre`) VALUES
(1, 'Piso 1'),
(2, 'Piso 2'),
(3, 'Piso 3'),
(4, 'Pasillo 1'),
(5, 'Pasillo 2'),
(6, 'Pasillo 3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `id_proeevedor` int(11) DEFAULT NULL,
  `codigo_producto` bigint(20) NOT NULL,
  `nombre_producto` varchar(50) NOT NULL,
  `precio_unitario` bigint(20) NOT NULL,
  `cantidad_producto` bigint(20) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_medida` int(11) NOT NULL,
  `id_local` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `id_proeevedor`, `codigo_producto`, `nombre_producto`, `precio_unitario`, `cantidad_producto`, `id_categoria`, `id_medida`, `id_local`) VALUES
(1, 1, 111, 'Pizza jamon', 11000, -10, 2, 1, 1),
(2, 1, 1, 'Hamburguesa', 11000, 30, 1, 1, 1),
(3, 1, 2, 'coca cola 400 ml', 4000, 50, 2, 2, 1),
(4, 1, 635, 'Jgtt', 777, 2, 1, 1, 1),
(5, 1, 1231, 'Prueba 2', 4000, 10, 1, 1, 1),
(6, 1, 1231, 'Prueba 2', 4000, 10, 1, 1, 1),
(7, 1, 132131, 'Prueba 3', 11000, 10, 1, 1, 1),
(8, 1, 32132131, 'Coca-cola 1.5 l', 11000, 0, 1, 1, 1),
(13, 1, 13123, '2 Hambuerguesas', 13000, 10, 1, 1, 1),
(14, 1, 132131, 'Promocion hamburguesa mas coca cola 400 ml', 15000, 20, 1, 1, 1),
(15, 1, 31231, 'Bandeja', 13000, 10, 1, 1, 1),
(16, 1, 1231231, 'fdfsfs', 1111, 20, 2, 1, 1),
(17, 1, 99, 'Paisa', 20000, 10, 2, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proeevedor`
--

CREATE TABLE `proeevedor` (
  `id_proeevedor` int(11) NOT NULL,
  `nit_proeevedor` varchar(12) NOT NULL,
  `nombre_proeevedor` varchar(100) NOT NULL,
  `telefono_proeevedor` int(11) NOT NULL,
  `direccion_proeevedor` varchar(100) NOT NULL,
  `id_local` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proeevedor`
--

INSERT INTO `proeevedor` (`id_proeevedor`, `nit_proeevedor`, `nombre_proeevedor`, `telefono_proeevedor`, `direccion_proeevedor`, `id_local`) VALUES
(1, '11111', 'Prueba 11', 1111, 'Direccion', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promocion`
--

CREATE TABLE `promocion` (
  `id_promocion` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_promocion_articulo` int(11) NOT NULL,
  `cantidad_promocion_producto` int(11) NOT NULL,
  `id_activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `promocion`
--

INSERT INTO `promocion` (`id_promocion`, `id_producto`, `id_promocion_articulo`, `cantidad_promocion_producto`, `id_activo`) VALUES
(2, 13, 2, 2, 1),
(3, 14, 2, 1, 1),
(4, 14, 3, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `nombre_rol`) VALUES
(1, 'Administrador'),
(2, 'Gerente'),
(3, 'Cocina'),
(4, 'Cajero'),
(5, 'Mesero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `primer_nombre` varchar(20) NOT NULL,
  `segundo_nombre` varchar(20) DEFAULT NULL,
  `primer_apellido` varchar(20) NOT NULL,
  `segundo_apellido` varchar(20) DEFAULT NULL,
  `usuario` varchar(20) NOT NULL,
  `clave` varchar(20) NOT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `id_rol` int(11) NOT NULL,
  `id_activo` int(11) NOT NULL,
  `id_local` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `primer_nombre`, `segundo_nombre`, `primer_apellido`, `segundo_apellido`, `usuario`, `clave`, `foto`, `id_rol`, `id_activo`, `id_local`) VALUES
(23, 'Jogan', 'Felipe', 'Rengifo', 'Solarte', 'JoganRen', 'Johan321', NULL, 1, 1, 1),
(24, 'Ana', 'Sofia', 'Ochica', 'Solarte', 'Sofi', 'sOFI321', NULL, 2, 2, 1),
(25, 'Karen', 'lili', 'Calderon', 'Solarte', 'Karen', 'Karen321', NULL, 2, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id_venta` int(11) NOT NULL,
  `id_factura` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `peso` int(11) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `valor_unitario` int(11) NOT NULL,
  `precio_compra` int(11) NOT NULL,
  `fecha_ingreso` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id_venta`, `id_factura`, `id_usuario`, `id_producto`, `peso`, `cantidad`, `valor_unitario`, `precio_compra`, `fecha_ingreso`) VALUES
(1, 1, 23, 3, NULL, 1, 4000, 4000, '2024-04-25'),
(2, 2, 23, 1, NULL, 1, 11000, 11000, '2024-03-01'),
(3, 3, 23, 8, NULL, 1, 11000, 11000, '2024-03-01'),
(4, 4, 23, 2, NULL, 1, 11000, 11000, '2024-04-23'),
(5, 5, 23, 2, NULL, 1, 11000, 11000, '2024-04-23'),
(6, 5, 23, 2, NULL, 1, 11000, 11000, '2024-04-23'),
(7, 5, 23, 2, NULL, 1, 11000, 11000, '2024-04-23'),
(8, 5, 23, 3, NULL, 1, 4000, 4000, '2024-02-07'),
(9, 6, 23, 1, NULL, 30, 11000, 330000, '2024-04-25');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `activo`
--
ALTER TABLE `activo`
  ADD PRIMARY KEY (`id_activo`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`),
  ADD KEY `id_activo` (`id_activo`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `id_local` (`id_local`);

--
-- Indices de la tabla `estado_mesa`
--
ALTER TABLE `estado_mesa`
  ADD PRIMARY KEY (`id_estado_mesa`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id_factura`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `factura_proeevedor`
--
ALTER TABLE `factura_proeevedor`
  ADD PRIMARY KEY (`id_factura_proeevedor`),
  ADD KEY `id_categoria` (`id_categoria`,`id_proeevedor`,`id_usuario`,`id_medida`),
  ADD KEY `id_proeevedor` (`id_proeevedor`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_medida` (`id_medida`),
  ADD KEY `id_local` (`id_local`);

--
-- Indices de la tabla `funiones`
--
ALTER TABLE `funiones`
  ADD PRIMARY KEY (`id_funciones`);

--
-- Indices de la tabla `ingrediente`
--
ALTER TABLE `ingrediente`
  ADD PRIMARY KEY (`id_ingrediente`),
  ADD KEY `id_medida` (`id_medida`),
  ADD KEY `id_local` (`id_local`);

--
-- Indices de la tabla `ingrediente_producto`
--
ALTER TABLE `ingrediente_producto`
  ADD PRIMARY KEY (`id_ingrediente_producto`),
  ADD KEY `id_producto` (`id_producto`,`id_ingrediente`),
  ADD KEY `id_ingrediente` (`id_ingrediente`);

--
-- Indices de la tabla `local`
--
ALTER TABLE `local`
  ADD PRIMARY KEY (`id_local`);

--
-- Indices de la tabla `medida`
--
ALTER TABLE `medida`
  ADD PRIMARY KEY (`id_medida`),
  ADD KEY `id_activo` (`id_activo`);

--
-- Indices de la tabla `mesa`
--
ALTER TABLE `mesa`
  ADD PRIMARY KEY (`id_mesa`),
  ADD KEY `id_estado_mesa` (`id_estado_mesa`),
  ADD KEY `id_piso` (`id_piso`);

--
-- Indices de la tabla `nomina`
--
ALTER TABLE `nomina`
  ADD PRIMARY KEY (`id_nomina`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_producto` (`id_producto`,`id_estado_mesa`),
  ADD KEY `id_estado_mesa` (`id_estado_mesa`),
  ADD KEY `id_mesa` (`id_mesa`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `piso`
--
ALTER TABLE `piso`
  ADD PRIMARY KEY (`id_piso`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_proeevedor` (`id_proeevedor`,`id_categoria`,`id_medida`),
  ADD KEY `id_medida` (`id_medida`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_local` (`id_local`);

--
-- Indices de la tabla `proeevedor`
--
ALTER TABLE `proeevedor`
  ADD PRIMARY KEY (`id_proeevedor`),
  ADD KEY `id_local` (`id_local`);

--
-- Indices de la tabla `promocion`
--
ALTER TABLE `promocion`
  ADD PRIMARY KEY (`id_promocion`),
  ADD KEY `id_producto` (`id_producto`,`id_promocion_articulo`,`id_activo`),
  ADD KEY `id_promocion_articulo` (`id_promocion_articulo`),
  ADD KEY `id_activo` (`id_activo`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_local` (`id_local`),
  ADD KEY `id_rol` (`id_rol`,`id_activo`),
  ADD KEY `id_activo` (`id_activo`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `id_factura` (`id_factura`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_producto` (`id_producto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `activo`
--
ALTER TABLE `activo`
  MODIFY `id_activo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `estado_mesa`
--
ALTER TABLE `estado_mesa`
  MODIFY `id_estado_mesa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `factura_proeevedor`
--
ALTER TABLE `factura_proeevedor`
  MODIFY `id_factura_proeevedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `funiones`
--
ALTER TABLE `funiones`
  MODIFY `id_funciones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ingrediente`
--
ALTER TABLE `ingrediente`
  MODIFY `id_ingrediente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `ingrediente_producto`
--
ALTER TABLE `ingrediente_producto`
  MODIFY `id_ingrediente_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `local`
--
ALTER TABLE `local`
  MODIFY `id_local` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `medida`
--
ALTER TABLE `medida`
  MODIFY `id_medida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `mesa`
--
ALTER TABLE `mesa`
  MODIFY `id_mesa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `nomina`
--
ALTER TABLE `nomina`
  MODIFY `id_nomina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `piso`
--
ALTER TABLE `piso`
  MODIFY `id_piso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `proeevedor`
--
ALTER TABLE `proeevedor`
  MODIFY `id_proeevedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `promocion`
--
ALTER TABLE `promocion`
  MODIFY `id_promocion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `categoria_ibfk_1` FOREIGN KEY (`id_activo`) REFERENCES `activo` (`id_activo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`id_local`) REFERENCES `local` (`id_local`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `factura_proeevedor`
--
ALTER TABLE `factura_proeevedor`
  ADD CONSTRAINT `factura_proeevedor_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `factura_proeevedor_ibfk_2` FOREIGN KEY (`id_proeevedor`) REFERENCES `proeevedor` (`id_proeevedor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `factura_proeevedor_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `factura_proeevedor_ibfk_4` FOREIGN KEY (`id_medida`) REFERENCES `medida` (`id_medida`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `factura_proeevedor_ibfk_5` FOREIGN KEY (`id_local`) REFERENCES `local` (`id_local`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ingrediente`
--
ALTER TABLE `ingrediente`
  ADD CONSTRAINT `ingrediente_ibfk_1` FOREIGN KEY (`id_medida`) REFERENCES `medida` (`id_medida`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ingrediente_producto`
--
ALTER TABLE `ingrediente_producto`
  ADD CONSTRAINT `ingrediente_producto_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ingrediente_producto_ibfk_2` FOREIGN KEY (`id_ingrediente`) REFERENCES `ingrediente` (`id_ingrediente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `medida`
--
ALTER TABLE `medida`
  ADD CONSTRAINT `medida_ibfk_1` FOREIGN KEY (`id_activo`) REFERENCES `activo` (`id_activo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mesa`
--
ALTER TABLE `mesa`
  ADD CONSTRAINT `mesa_ibfk_1` FOREIGN KEY (`id_estado_mesa`) REFERENCES `estado_mesa` (`id_estado_mesa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mesa_ibfk_2` FOREIGN KEY (`id_piso`) REFERENCES `piso` (`id_piso`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `nomina`
--
ALTER TABLE `nomina`
  ADD CONSTRAINT `nomina_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`id_estado_mesa`) REFERENCES `estado_mesa` (`id_estado_mesa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pedido_ibfk_3` FOREIGN KEY (`id_mesa`) REFERENCES `mesa` (`id_mesa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pedido_ibfk_4` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_medida`) REFERENCES `medida` (`id_medida`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_3` FOREIGN KEY (`id_proeevedor`) REFERENCES `proeevedor` (`id_proeevedor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_4` FOREIGN KEY (`id_local`) REFERENCES `local` (`id_local`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `proeevedor`
--
ALTER TABLE `proeevedor`
  ADD CONSTRAINT `proeevedor_ibfk_1` FOREIGN KEY (`id_local`) REFERENCES `local` (`id_local`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `promocion`
--
ALTER TABLE `promocion`
  ADD CONSTRAINT `promocion_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `promocion_ibfk_2` FOREIGN KEY (`id_promocion_articulo`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `promocion_ibfk_3` FOREIGN KEY (`id_activo`) REFERENCES `activo` (`id_activo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_3` FOREIGN KEY (`id_local`) REFERENCES `local` (`id_local`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_ibfk_4` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_ibfk_5` FOREIGN KEY (`id_activo`) REFERENCES `activo` (`id_activo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`id_factura`) REFERENCES `factura` (`id_factura`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `venta_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `venta_ibfk_3` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
