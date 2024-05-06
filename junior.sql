-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-05-2024 a las 09:26:40
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
(4, 'Fast Food', 1),
(5, 'Hamburguesa', 1),
(11, 'Pizzas', 1),
(12, 'Adicionales', 1),
(13, 'Bebidas', 1),
(14, 'Pizza', 1);

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
(22, 2, 1, 23, 2, 2, 'coca cola 400 ml', 4000, 0, '2024-04-25', 0, 1),
(23, 2, 1, 23, 1, 111, 'Pizza jamon', 11000, 10, '2024-04-25', 60000, 1),
(24, 4, 1, 23, 2, 12312, 'Fresa', 1000, 10, '2024-04-25', 0, 1),
(25, 2, 1, 23, 1, 12312, 'fresa', 1111, 1, '2024-04-25', 0, 1),
(26, 2, 1, 23, 1, 12312, 'fresa', 1111, 10, '2024-04-25', 0, 1),
(27, 1, 1, 23, 1, 0, 'Coco', 0, 100, '2024-04-25', 0, 1),
(28, 1, 1, 23, 1, 0, 'Coco', 0, 100, '2024-04-25', 0, 1),
(29, 2, 1, 23, 1, 1, 'Harochas De Chicharron Acevichado', 15000, 100, '2024-05-03', 0, 1),
(30, 2, 1, 23, 1, 2, 'Harichas De Ceviche De Camaro', 22000, 100, '2024-05-03', 0, 1),
(31, 2, 1, 23, 1, 3, 'Patacones Con Salsa De la Casa de la casa y queso costeño', 13000, 100, '2024-05-03', 0, 1),
(32, 2, 1, 23, 1, 4, 'Chorizo Artesanal', 13000, 100, '2024-05-03', 0, 1),
(33, 2, 1, 23, 1, 5, 'Varas Rivereñas', 15000, 100, '2024-05-03', 0, 1),
(34, 2, 1, 23, 1, 6, 'Empanadas Gourmet', 17000, 100, '2024-05-03', 0, 1),
(35, 3, 1, 23, 1, 7, 'Viudo De Capaz', 48000, 100, '2024-05-03', 0, 1),
(36, 3, 1, 23, 1, 8, 'Mojarra Frita', 40000, 100, '2024-05-03', 0, 1),
(37, 3, 1, 23, 1, 9, 'Bocachicao Frito', 45000, 100, '2024-05-03', 0, 1),
(38, 3, 1, 23, 1, 10, 'Viudo de Bocachico', 45000, 100, '2024-05-03', 0, 1),
(39, 3, 1, 23, 1, 11, 'Bagre En Salsa Criolla', 43000, 100, '2024-05-03', 0, 1),
(40, 3, 1, 23, 1, 12, 'Bagre Frito', 43000, 100, '2024-05-03', 0, 1),
(41, 3, 1, 23, 1, 14, 'Viudo De Nicuro', 43000, 100, '2024-05-03', 0, 1),
(42, 3, 1, 23, 1, 15, 'Trucha Marinera', 51000, 100, '2024-05-03', 0, 1),
(43, 3, 1, 23, 1, 16, 'Trucha Gratinada', 46000, 100, '2024-05-03', 0, 1),
(44, 3, 1, 23, 1, 17, 'Trucha Al Ajillo', 43000, 100, '2024-05-03', 0, 1),
(45, 3, 1, 23, 1, 18, 'Salmon En Salsa Maracuya', 58000, 100, '2024-05-03', 0, 1),
(46, 3, 1, 23, 1, 19, 'Cazuela De Marisco', 50000, 100, '2024-05-03', 0, 1),
(47, 3, 1, 23, 1, 20, 'Cazuela De Bagre', 45000, 100, '2024-05-03', 0, 1),
(48, 3, 1, 23, 1, 13, 'Cachama Frita', 46000, 100, '2024-05-03', 0, 1),
(49, 4, 1, 23, 1, 21, 'Punta De Anca', 40000, 100, '2024-05-03', 0, 1),
(50, 4, 1, 23, 1, 22, 'Churrasco', 43000, 100, '2024-05-03', 0, 1),
(51, 4, 1, 23, 1, 23, 'Baby Beef', 55000, 100, '2024-05-03', 0, 1),
(52, 4, 1, 23, 1, 24, 'Lomo De Cerdo En Salsa Tropical', 41000, 100, '2024-05-03', 0, 1),
(53, 4, 1, 23, 1, 25, 'Costillas Rawp', 43000, 100, '2024-05-03', 0, 1),
(54, 5, 1, 23, 1, 26, 'Pechuga a la Parrilla', 35000, 100, '2024-05-03', 0, 1),
(55, 5, 1, 23, 1, 27, 'Pechuga Gratinada', 38000, 100, '2024-05-03', 0, 1),
(56, 5, 1, 23, 1, 28, 'Pechuga Hawaiana', 42000, 100, '2024-05-03', 0, 1),
(57, 6, 1, 23, 1, 29, 'Churrasquito', 28000, 100, '2024-05-03', 0, 1),
(58, 6, 1, 23, 1, 30, 'Nuggets De Pollo', 23000, 100, '2024-05-03', 0, 1),
(59, 6, 1, 23, 1, 31, 'Salchipapas', 17000, 100, '2024-05-03', 0, 1),
(60, 6, 1, 23, 1, 32, 'Alas B.B.Q', 22000, 100, '2024-05-03', 0, 1),
(61, 11, 1, 23, 1, 33, 'Ensalada Nicois', 38000, 100, '2024-05-03', 0, 1),
(62, 11, 1, 23, 1, 34, 'Ensalada Puerto Magdalena', 45000, 100, '2024-05-03', 0, 1),
(63, 11, 1, 23, 1, 35, 'Ensalada Mixta', 32000, 100, '2024-05-03', 0, 1),
(64, 12, 1, 23, 1, 36, 'Porcion De Arroz', 5000, 100, '2024-05-03', 0, 1),
(65, 12, 1, 23, 1, 37, 'Porcion De Arroz Coco', 5000, 100, '2024-05-03', 0, 1),
(66, 12, 1, 23, 1, 38, 'Porcion De Yuca', 4000, 100, '2024-05-03', 0, 1),
(67, 12, 1, 23, 1, 39, 'Porcion de Papa a la Francesa', 5000, 100, '2024-05-03', 0, 1),
(68, 12, 1, 23, 1, 40, 'Porcion De Papa Salada', 4000, 100, '2024-05-03', 0, 1),
(69, 12, 1, 23, 1, 41, 'Porcion De Patacon', 4000, 100, '2024-05-03', 0, 1),
(70, 12, 1, 23, 1, 42, 'Porcion De Ensalada', 5000, 100, '2024-05-03', 0, 1),
(71, 13, 1, 23, 1, 43, 'Limonada Natural', 8000, 100, '2024-05-03', 0, 1),
(72, 13, 1, 23, 1, 44, 'Limonada De Coco', 8000, 100, '2024-05-03', 0, 1),
(73, 13, 1, 23, 1, 45, 'Limonada De Panela', 8000, 100, '2024-05-03', 0, 1),
(74, 13, 1, 23, 1, 46, 'Jugo De Agua', 8000, 100, '2024-05-03', 0, 1),
(75, 13, 1, 23, 1, 47, 'Jugo En Leche', 9000, 100, '2024-05-03', 0, 1),
(76, 13, 1, 23, 1, 48, 'Gaseosa', 5000, 100, '2024-05-03', 0, 1),
(77, 13, 1, 23, 1, 49, 'Agua', 4000, 100, '2024-05-03', 0, 1),
(78, 13, 1, 23, 1, 50, 'Frutos Rojos', 12000, 100, '2024-05-03', 0, 1),
(79, 13, 1, 23, 1, 51, 'Maracuya', 12000, 100, '2024-05-03', 0, 1),
(80, 13, 1, 23, 1, 52, 'Puerto Magdalena', 12000, 100, '2024-05-03', 0, 1),
(81, 13, 1, 23, 1, 53, 'Light', 6000, 100, '2024-05-03', 0, 1),
(82, 13, 1, 23, 1, 54, 'Club Colombia', 7000, 100, '2024-05-03', 0, 1),
(83, 13, 1, 23, 1, 55, 'Corona', 9000, 100, '2024-05-03', 0, 1),
(84, 13, 1, 23, 1, 56, 'Stella Artois', 9000, 100, '2024-05-03', 0, 1),
(85, 14, 1, 23, 2, 57, 'Mojito Maracuya', 21000, 100, '2024-05-03', 0, 1),
(86, 14, 1, 23, 2, 58, 'Tinto De Verano', 21000, 100, '2024-05-03', 0, 1),
(87, 14, 1, 23, 2, 59, 'Puerto Magdalena', 23000, 100, '2024-05-03', 0, 1),
(88, 14, 1, 23, 2, 60, 'Frozen  Paradise', 21000, 100, '2024-05-03', 0, 1),
(89, 14, 1, 23, 2, 61, 'Margarita Tradicional', 21000, 100, '2024-05-03', 0, 1),
(90, 14, 1, 23, 2, 62, 'Margarita Blue', 23000, 100, '2024-05-03', 0, 1),
(91, 14, 1, 23, 2, 63, 'Caipirina', 20000, 100, '2024-05-03', 0, 1),
(92, 14, 1, 23, 2, 64, 'Tequilazo', 15000, 100, '2024-05-03', 0, 1),
(93, 14, 1, 23, 2, 65, 'Daiquiri De Frutos Rojos o Fruto Amarillos', 23000, 100, '2024-05-03', 0, 1),
(94, 14, 1, 23, 2, 66, 'Orgasmo ', 25000, 100, '2024-05-03', 0, 1),
(95, 14, 1, 23, 2, 67, 'Guaya Para 3', 61000, 100, '2024-05-03', 0, 1),
(96, 14, 1, 23, 2, 68, 'Sangria (4 Copas)', 55000, 100, '2024-05-03', 0, 1),
(97, 1, 1, 23, 1, 0, 'Canasta de platano picado', 0, 1000, '2024-05-03', 0, 1),
(98, 1, 1, 23, 1, 0, 'Panceta de Cerdo peruano', 0, 1000, '2024-05-03', 0, 1),
(99, 1, 1, 23, 1, 0, 'Ceviche de Camaron', 0, 1000, '2024-05-03', 0, 1),
(100, 1, 1, 23, 1, 0, 'Aji de la casa', 0, 1000, '2024-05-03', 0, 1),
(101, 1, 1, 23, 1, 0, 'Chimichuri argentino', 0, 1000, '2024-05-03', 0, 1),
(102, 1, 1, 23, 1, 0, 'Papa Coctel', 0, 1000, '2024-05-03', 0, 1),
(103, 1, 1, 23, 1, 0, 'Arepa de Queso', 0, 1000, '2024-05-03', 0, 1),
(104, 1, 1, 23, 1, 0, 'Empanadas', 0, 1000, '2024-05-03', 0, 1),
(105, 1, 1, 23, 1, 0, 'Yuca', 0, 1000, '2024-05-03', 0, 1),
(106, 1, 1, 23, 1, 0, 'Papa', 0, 1000, '2024-05-03', 0, 1),
(107, 1, 1, 23, 1, 0, 'Platano', 0, 1000, '2024-05-03', 0, 1),
(108, 1, 1, 23, 1, 0, 'Consome', 0, 1000, '2024-05-03', 0, 1),
(109, 1, 1, 23, 1, 0, 'Ensalada', 0, 1000, '2024-05-03', 0, 1),
(112, 1, 1, 23, 1, 0, 'Papa Francesa', 0, 1000, '2024-05-03', 0, 1),
(113, 1, 1, 23, 1, 0, 'Arroz', 0, 1000, '2024-05-03', 0, 1),
(114, 1, 1, 23, 1, 0, 'Patacon', 0, 1000, '2024-05-03', 0, 1),
(115, 1, 1, 23, 1, 0, 'Croqueta de yuca', 0, 1000, '2024-05-03', 0, 1),
(116, 1, 1, 23, 1, 0, 'Pure de Papa', 0, 1000, '2024-05-03', 0, 1),
(117, 1, 1, 23, 1, 0, 'Verduras wok', 0, 1000, '2024-05-03', 0, 1),
(118, 14, 1, 23, 1, 1, 'Salchipizza Porcion', 11000, 100, '2024-05-03', 0, 1),
(119, 14, 1, 23, 1, 2, 'Pollo con Champiñones Porcion', 11000, 100, '2024-05-03', 0, 1),
(120, 14, 1, 23, 1, 3, 'Hawaiana', 11000, 100, '2024-05-03', 0, 1),
(121, 14, 1, 23, 1, 4, 'Jamon y queso', 11000, 100, '2024-05-03', 0, 1),
(122, 14, 1, 23, 1, 5, 'Jamon y pollo', 11000, 100, '2024-05-03', 0, 1),
(123, 14, 1, 23, 1, 6, 'Pollo y Maiz', 11000, 100, '2024-05-03', 0, 1),
(124, 14, 1, 23, 1, 3, 'Hawaiana Porcion', 11000, 0, '2024-05-06', 0, 1),
(125, 14, 1, 23, 1, 4, 'Jamon y queso Porcion', 11000, 0, '2024-05-06', 0, 1),
(126, 14, 1, 23, 1, 5, 'Jamon y pollo Porcion', 11000, 0, '2024-05-06', 0, 1),
(127, 14, 1, 23, 1, 6, 'Pollo y Maiz Porcion', 11000, 0, '2024-05-06', 0, 1),
(128, 14, 1, 23, 1, 7, 'Pizza Medida', 58000, 100, '2024-05-06', 0, 1),
(129, 14, 1, 23, 1, 8, 'Pizza Grande', 83000, 100, '2024-05-06', 0, 1),
(130, 11, 1, 23, 1, 9, 'Pizza Vegetariana Porcion', 11000, 100, '2024-05-06', 0, 1),
(131, 11, 1, 23, 1, 10, 'La Queso Porcion', 11000, 100, '2024-05-06', 0, 1),
(132, 11, 1, 23, 1, 11, 'Ranchera Porcion', 11000, 100, '2024-05-06', 0, 1),
(133, 11, 1, 23, 1, 12, 'Carnes Especial', 11000, 100, '2024-05-06', 0, 1),
(134, 11, 1, 23, 1, 13, 'Peperoni Porcion', 11000, 100, '2024-05-06', 0, 1),
(135, 11, 1, 23, 1, 14, 'Napolitana Porcion', 11000, 100, '2024-05-06', 0, 1),
(136, 11, 1, 23, 1, 15, 'Pizza Mexicana Porcion', 11000, 100, '2024-05-06', 0, 1),
(137, 13, 1, 23, 2, 16, 'Gaseosa 400 ml', 4000, 100, '2024-05-06', 0, 1),
(138, 13, 1, 23, 2, 17, 'Gaseosa 1.5 l', 8000, 100, '2024-05-06', 0, 1),
(139, 13, 1, 23, 2, 18, 'Gaseosa 2.5 l', 10000, 100, '2024-05-06', 0, 1),
(140, 13, 1, 23, 2, 19, 'Té Helado', 4000, 100, '2024-05-06', 0, 1),
(141, 13, 1, 23, 2, 20, 'Jugos Del Valle', 4000, 100, '2024-05-06', 0, 1),
(142, 13, 1, 23, 2, 21, 'Agua en Botella', 4000, 100, '2024-05-06', 0, 1),
(143, 13, 1, 23, 2, 22, 'Cerveza en Lata', 4500, 100, '2024-05-06', 0, 1),
(144, 5, 1, 23, 1, 23, 'Hamburguesa Sencilla', 12500, 100, '2024-05-06', 0, 1),
(145, 5, 1, 23, 1, 24, 'Hamburguesa De Res', 17500, 100, '2024-05-06', 0, 1),
(146, 5, 1, 23, 1, 25, 'Hamburguesa De Pollo', 14000, 100, '2024-05-06', 0, 1),
(147, 5, 1, 23, 1, 26, 'Hamburguesa Doble', 20000, 100, '2024-05-06', 0, 1),
(148, 5, 1, 23, 1, 27, 'Hamburguesa Mexicana', 18000, 100, '2024-05-06', 0, 1),
(149, 5, 1, 23, 1, 28, 'Hamburguesa Hawaiana', 18000, 100, '2024-05-06', 0, 1),
(150, 5, 1, 23, 1, 29, 'Hamburguesa Ranchera', 18000, 100, '2024-05-06', 0, 1),
(151, 5, 1, 23, 1, 30, 'Hamburguesa Sencilla Con Francesa', 15000, 100, '2024-05-06', 0, 1),
(152, 5, 1, 23, 1, 31, 'Hamburguesa De Res Con Francesa', 20000, 100, '2024-05-06', 0, 1),
(153, 5, 1, 23, 1, 32, 'Hamburguesa De Pollo Con Francesa', 17000, 100, '2024-05-06', 0, 1),
(154, 5, 1, 23, 1, 33, 'Hamburguesa Doble Con Francesa', 23000, 100, '2024-05-06', 0, 1),
(155, 5, 1, 23, 1, 34, 'Hamburguesa Mexicana Con Francesa', 21000, 100, '2024-05-06', 0, 1),
(156, 5, 1, 23, 1, 35, 'Hamburguesa Hawaiana Con Francesa', 21000, 100, '2024-05-06', 0, 1),
(157, 5, 1, 23, 1, 36, 'Hamburguesa Ranchera Con Francesa', 21000, 100, '2024-05-06', 0, 1),
(158, 4, 1, 23, 1, 37, 'Super Perro', 13000, 100, '2024-05-06', 0, 1),
(159, 4, 1, 23, 1, 38, 'Super Perro Con Papas', 15000, 100, '2024-05-06', 0, 1),
(160, 4, 1, 23, 1, 39, 'Perro Ranchero', 15000, 100, '2024-05-06', 0, 1),
(161, 4, 1, 23, 1, 40, 'Perro Ranchero Con Papas', 18000, 100, '2024-05-06', 0, 1),
(162, 4, 1, 23, 1, 41, 'Perro Mexicano', 14000, 100, '2024-05-06', 0, 1),
(163, 4, 1, 23, 1, 42, 'Perro Mexicano Con Papas', 18000, 100, '2024-05-06', 0, 1),
(164, 4, 1, 23, 1, 43, 'Chorriperro ', 14000, 100, '2024-05-06', 0, 1),
(165, 4, 1, 23, 1, 44, 'Chorriperro Con Papas', 17000, 100, '2024-05-06', 0, 1),
(166, 4, 1, 23, 1, 45, 'Mazorcada sencilla', 20000, 100, '2024-05-06', 0, 1),
(167, 4, 1, 23, 1, 46, 'Mazorcada Doble', 34000, 100, '2024-05-06', 0, 1),
(168, 4, 1, 23, 1, 47, 'Salchipapa', 16000, 100, '2024-05-06', 0, 1),
(169, 4, 1, 23, 1, 48, 'Choripapa', 17000, 100, '2024-05-06', 0, 1),
(170, 4, 1, 23, 1, 49, 'Salchi Mazorcada', 26000, 100, '2024-05-06', 0, 1),
(171, 4, 1, 23, 1, 50, 'Salchi Mazorcada Doble', 39000, 100, '2024-05-06', 0, 1),
(172, 4, 1, 23, 1, 51, 'Costillas de Cerdo BBQ', 28000, 100, '2024-05-06', 0, 1),
(173, 4, 1, 23, 1, 52, 'Lasagna', 22000, 100, '2024-05-06', 0, 1),
(174, 12, 1, 23, 1, 53, 'Papa a la Francesa', 7000, 100, '2024-05-06', 0, 1),
(175, 12, 1, 23, 1, 54, 'Porcion de Queso', 2000, 100, '2024-05-06', 0, 1),
(176, 12, 1, 23, 1, 55, 'Porcion Tocineta', 2000, 100, '2024-05-06', 0, 1),
(177, 12, 1, 23, 1, 56, 'Porcion Chorizo', 3000, 100, '2024-05-06', 0, 1),
(178, 1, 1, 23, 1, 0, 'Salchica llanera', 0, 1000, '2024-05-06', 0, 1),
(179, 1, 1, 23, 1, 0, 'Jamon', 0, 1000, '2024-05-06', 0, 1),
(180, 1, 1, 23, 1, 0, 'Queso', 0, 1000, '2024-05-06', 0, 1),
(181, 1, 1, 23, 1, 0, 'Pollo', 0, 1000, '2024-05-06', 0, 1),
(182, 1, 1, 23, 1, 0, 'Champiñones', 0, 1000, '2024-05-06', 0, 1),
(183, 1, 1, 23, 1, 0, 'Piña', 0, 1000, '2024-05-06', 0, 1),
(184, 1, 1, 23, 1, 0, 'Maiz tierno', 0, 1000, '2024-05-06', 0, 1),
(185, 1, 1, 23, 1, 0, 'Tomate', 0, 1000, '2024-05-06', 0, 1),
(186, 1, 1, 23, 1, 0, 'Cebollita', 0, 1000, '2024-05-06', 0, 1),
(187, 1, 1, 23, 1, 0, 'Pimenton', 0, 1000, '2024-05-06', 0, 1),
(188, 1, 1, 23, 1, 0, 'Perejil', 0, 1000, '2024-05-06', 0, 1),
(189, 1, 1, 23, 1, 0, 'Orégamo', 0, 1000, '2024-05-06', 0, 1),
(190, 1, 1, 23, 1, 0, 'Chorizo', 0, 1000, '2024-05-06', 0, 1),
(191, 1, 1, 23, 1, 0, 'Salsa bbq', 0, 1000, '2024-05-06', 0, 1),
(192, 1, 1, 23, 1, 0, 'Carne bolañesa', 0, 1000, '2024-05-06', 0, 1),
(193, 1, 1, 23, 1, 0, 'Cerveroni picado', 0, 1000, '2024-05-06', 0, 1),
(194, 1, 1, 23, 1, 0, 'Pollo desmechado', 0, 1000, '2024-05-06', 0, 1),
(195, 1, 1, 23, 1, 0, 'Tomate en tajadas', 0, 1000, '2024-05-06', 0, 1),
(196, 1, 1, 23, 1, 0, 'Jalapeño', 0, 1000, '2024-05-06', 0, 1),
(197, 1, 1, 23, 1, 0, 'Doritos', 0, 1000, '2024-05-06', 0, 1),
(198, 1, 1, 23, 1, 0, 'Carne Zenu', 0, 1000, '2024-05-06', 0, 1),
(199, 1, 1, 23, 1, 0, 'Lechuga Crespa', 0, 1000, '2024-05-06', 0, 1),
(200, 1, 1, 23, 1, 0, 'Queso Fundido', 0, 1000, '2024-05-06', 0, 1),
(201, 1, 1, 23, 1, 0, 'Salsa De La Casa', 0, 1000, '2024-05-06', 0, 1),
(202, 1, 1, 23, 1, 0, 'Carne de res artesanal', 0, 1000, '2024-05-06', 0, 1),
(203, 1, 1, 23, 1, 0, 'Cebolla grille o cruda', 0, 1000, '2024-05-06', 0, 1),
(204, 1, 1, 23, 1, 0, 'Carne de pollo apanado', 0, 1000, '2024-05-06', 0, 1),
(205, 1, 1, 23, 1, 0, 'Doble Carne de res artesanal', 0, 1000, '2024-05-06', 0, 1),
(206, 1, 1, 23, 1, 0, 'Carne de res artesanal', 0, 1000, '2024-05-06', 0, 1),
(207, 1, 1, 23, 1, 0, 'Piña dulce', 0, 1000, '2024-05-06', 0, 1),
(208, 1, 1, 23, 1, 0, 'Salchipapa americana original', 0, 1000, '2024-05-06', 0, 1),
(209, 1, 1, 23, 1, 0, 'Pan perro', 0, 1000, '2024-05-06', 0, 1),
(210, 1, 1, 23, 1, 0, 'Queso Doble Crema', 0, 1000, '2024-05-06', 0, 1),
(211, 1, 1, 23, 1, 0, 'Piña melada', 0, 1000, '2024-05-06', 0, 1),
(212, 1, 1, 23, 1, 0, 'Cebollita piacada', 0, 1000, '2024-05-06', 0, 1),
(213, 1, 1, 23, 1, 0, 'Papa ripio', 0, 1000, '2024-05-06', 0, 1),
(214, 1, 1, 23, 1, 0, 'Tocineta', 0, 1000, '2024-05-06', 0, 1),
(215, 1, 1, 23, 1, 0, 'Chorizo de ternera', 0, 1000, '2024-05-06', 0, 1),
(216, 1, 1, 23, 1, 0, 'Lomo de cerdo', 0, 1000, '2024-05-06', 0, 1),
(217, 1, 1, 23, 1, 0, 'Pechuga', 0, 1000, '2024-05-06', 0, 1),
(218, 1, 1, 23, 1, 0, 'Costillas de Cerdo', 0, 1000, '2024-05-06', 0, 1),
(219, 1, 1, 23, 1, 0, 'Ensalada', 0, 1000, '2024-05-06', 0, 1),
(220, 1, 1, 23, 1, 0, 'Salchicha llanera', 0, 0, '2024-05-06', 0, 1),
(221, 1, 1, 23, 1, 0, 'Salchica', 0, 0, '2024-05-06', 0, 1),
(222, 1, 1, 23, 1, 0, 'Peperoni', 0, 1000, '2024-05-06', 0, 1),
(223, 1, 1, 23, 1, 0, 'Papas a la francesa', 0, 1000, '2024-05-06', 0, 1),
(224, 1, 1, 23, 1, 0, 'Salsa bechamel', 0, 1000, '2024-05-06', 0, 1),
(225, 4, 1, 23, 1, 37, 'Super Perro Sencillo', 13000, 0, '2024-05-06', 0, 1),
(226, 1, 1, 23, 1, 0, 'Cebollita picada', 0, 0, '2024-05-06', 0, 1);

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
(1, 'impresionPos', 'Configuración impresión POS Cocina', 'Al Habilitar esta función el sistema reconocerá cuando el mesero haya realizado una comanda.', 'Nota: Es recomendable usar esta función cuando no se tenga una pantalla en la cocina.', 'true'),
(3, 'propina', 'Configuración de propinas', 'Al habilitar esta función automáticamente el sistema cobrara una propina al usuario la cual se calcula según el precio de la factura y se cargara a la factura.', 'Nota: Esta propina podrá ser modificada por si el cliente quiere agregar o disminuir la propina.', 'false');

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
(1, 'Salchicha llanera', 1, 1000, 1),
(2, 'Jamon', 1, 1000, 1),
(3, 'Queso', 1, 1000, 1),
(4, 'Pollo', 1, 1000, 1),
(5, 'Champiñones', 1, 1000, 1),
(6, 'Piña', 1, 1000, 1),
(7, 'Maiz tierno', 1, 1000, 1),
(8, 'Tomate', 1, 1000, 1),
(9, 'Cebollita', 1, 1000, 1),
(10, 'Pimenton', 1, 1000, 1),
(11, 'Perejil', 1, 1000, 1),
(12, 'Orégamo', 1, 1000, 1),
(13, 'Chorizo', 1, 1000, 1),
(14, 'Salsa bbq', 1, 1000, 1),
(15, 'Carne bolañesa', 1, 1000, 1),
(16, 'Cerveroni picado', 1, 1000, 1),
(17, 'Pollo desmechado', 1, 1000, 1),
(18, 'Tomate en tajadas', 1, 1000, 1),
(19, 'Jalapeño', 1, 1000, 1),
(20, 'Doritos', 1, 1000, 1),
(21, 'Carne Zenu', 1, 1000, 1),
(22, 'Lechuga Crespa', 1, 1000, 1),
(23, 'Queso Fundido', 1, 1000, 1),
(24, 'Salsa De La Casa', 1, 1000, 1),
(25, 'Carne de res artesanal', 1, 1000, 1),
(26, 'Cebolla grille o cruda', 1, 1000, 1),
(27, 'Carne de pollo apanado', 1, 1000, 1),
(28, 'Doble Carne de res artesanal', 1, 1000, 1),
(29, 'Carne de res artesanal', 1, 1000, 1),
(30, 'Piña dulce', 1, 1000, 1),
(31, 'Salchipapa americana original', 1, 1000, 1),
(32, 'Pan perro', 1, 1000, 1),
(33, 'Queso Doble Crema', 1, 1000, 1),
(34, 'Piña melada', 1, 1000, 1),
(35, 'Cebollita picada', 1, 1000, 1),
(36, 'Papa ripio', 1, 1000, 1),
(37, 'Tocineta', 1, 1000, 1),
(38, 'Chorizo de ternera', 1, 1000, 1),
(39, 'Lomo de cerdo', 1, 1000, 1),
(40, 'Pechuga', 1, 1000, 1),
(41, 'Costillas de Cerdo', 1, 1000, 1),
(42, 'Ensalada', 1, 1000, 1),
(43, 'Salchica', 1, 0, 1),
(44, 'Peperoni', 1, 1000, 1),
(45, 'Papas a la francesa', 1, 1000, 1),
(46, 'Salsa bechamel', 1, 1000, 1);

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
(1, 1, 1, 0),
(2, 1, 2, 0),
(3, 1, 3, 0),
(4, 2, 4, 0),
(5, 2, 5, 0),
(6, 2, 3, 0),
(7, 3, 6, 0),
(8, 3, 2, 0),
(9, 3, 3, 0),
(10, 4, 2, 0),
(11, 4, 3, 0),
(12, 5, 2, 0),
(13, 5, 4, 0),
(14, 5, 3, 0),
(15, 6, 4, 0),
(16, 6, 7, 0),
(17, 6, 3, 0),
(18, 9, 8, 0),
(19, 9, 7, 0),
(20, 9, 9, 0),
(21, 9, 5, 0),
(22, 9, 10, 0),
(23, 9, 11, 0),
(24, 10, 3, 0),
(25, 10, 12, 0),
(26, 11, 13, 0),
(27, 11, 43, 0),
(28, 11, 7, 0),
(29, 11, 14, 0),
(30, 11, 10, 0),
(31, 11, 11, 0),
(32, 11, 3, 0),
(33, 12, 15, 0),
(34, 12, 16, 0),
(35, 12, 17, 0),
(36, 12, 10, 0),
(37, 12, 11, 0),
(38, 12, 3, 0),
(39, 13, 44, 0),
(40, 13, 3, 0),
(41, 14, 18, 0),
(42, 14, 5, 0),
(43, 14, 12, 0),
(44, 14, 10, 0),
(45, 14, 11, 0),
(46, 14, 3, 0),
(47, 15, 19, 0),
(48, 15, 15, 0),
(49, 15, 20, 0),
(50, 15, 3, 0),
(51, 23, 21, 0),
(52, 23, 22, 0),
(53, 23, 9, 0),
(54, 23, 8, 0),
(55, 23, 23, 0),
(56, 23, 24, 0),
(57, 24, 25, 0),
(58, 24, 22, 0),
(59, 24, 26, 0),
(60, 24, 8, 0),
(61, 24, 23, 0),
(62, 24, 24, 0),
(63, 25, 27, 0),
(64, 25, 22, 0),
(65, 25, 26, 0),
(66, 25, 8, 0),
(67, 25, 23, 0),
(68, 25, 24, 0),
(69, 26, 28, 0),
(70, 26, 22, 0),
(71, 26, 26, 0),
(72, 26, 8, 0),
(73, 26, 23, 0),
(74, 26, 24, 0),
(75, 27, 19, 0),
(76, 27, 20, 0),
(77, 27, 25, 0),
(78, 27, 22, 0),
(79, 27, 26, 0),
(80, 27, 8, 0),
(81, 27, 23, 0),
(82, 27, 24, 0),
(83, 28, 25, 0),
(84, 28, 30, 0),
(85, 28, 23, 0),
(86, 28, 22, 0),
(87, 28, 8, 0),
(88, 28, 24, 0),
(89, 29, 13, 0),
(90, 29, 25, 0),
(91, 29, 7, 0),
(92, 29, 8, 0),
(93, 29, 22, 0),
(94, 29, 26, 0),
(95, 29, 23, 0),
(96, 29, 24, 0),
(97, 30, 21, 0),
(98, 30, 22, 0),
(99, 30, 9, 0),
(100, 30, 8, 0),
(101, 30, 23, 0),
(102, 30, 24, 0),
(103, 30, 45, 0),
(104, 31, 25, 0),
(105, 31, 22, 0),
(106, 31, 9, 0),
(107, 31, 8, 0),
(108, 31, 23, 0),
(109, 31, 24, 0),
(110, 31, 45, 0),
(111, 32, 27, 0),
(112, 32, 22, 0),
(113, 32, 26, 0),
(114, 32, 8, 0),
(115, 32, 23, 0),
(116, 32, 24, 0),
(117, 32, 45, 0),
(118, 33, 28, 0),
(119, 33, 22, 0),
(120, 33, 26, 0),
(121, 33, 8, 0),
(122, 33, 23, 0),
(123, 33, 24, 0),
(124, 34, 19, 0),
(125, 34, 20, 0),
(126, 34, 29, 0),
(127, 34, 22, 0),
(128, 34, 26, 0),
(129, 34, 8, 0),
(130, 34, 23, 0),
(131, 34, 24, 0),
(132, 35, 25, 0),
(133, 35, 30, 0),
(134, 35, 23, 0),
(135, 35, 22, 0),
(136, 35, 8, 0),
(137, 35, 24, 0),
(138, 36, 13, 0),
(139, 36, 25, 0),
(140, 36, 7, 0),
(141, 36, 8, 0),
(142, 36, 22, 0),
(143, 36, 26, 0),
(144, 36, 23, 0),
(145, 36, 24, 0),
(146, 36, 45, 0),
(147, 37, 31, 0),
(148, 37, 32, 0),
(149, 37, 33, 0),
(150, 37, 34, 0),
(151, 37, 35, 0),
(152, 37, 24, 0),
(153, 37, 36, 0),
(154, 38, 31, 0),
(155, 38, 32, 0),
(156, 38, 33, 0),
(157, 38, 34, 0),
(158, 38, 35, 0),
(159, 38, 24, 0),
(160, 38, 36, 0),
(161, 38, 45, 0),
(162, 39, 37, 0),
(163, 39, 35, 0),
(164, 39, 7, 0),
(165, 39, 14, 0),
(166, 39, 33, 0),
(167, 39, 24, 0),
(168, 39, 36, 0),
(169, 40, 37, 0),
(170, 40, 35, 0),
(171, 40, 7, 0),
(172, 40, 14, 0),
(173, 40, 33, 0),
(174, 40, 24, 0),
(175, 40, 36, 0),
(176, 40, 45, 0),
(177, 41, 19, 0),
(178, 41, 20, 0),
(179, 41, 31, 0),
(180, 41, 35, 0),
(181, 41, 33, 0),
(182, 41, 24, 0),
(183, 41, 36, 0),
(184, 42, 19, 0),
(185, 42, 20, 0),
(186, 42, 31, 0),
(187, 42, 35, 0),
(188, 42, 33, 0),
(189, 42, 24, 0),
(190, 42, 36, 0),
(191, 43, 38, 0),
(192, 43, 32, 0),
(193, 43, 33, 0),
(194, 43, 34, 0),
(195, 43, 35, 0),
(196, 43, 24, 0),
(197, 43, 36, 0),
(198, 44, 38, 0),
(199, 44, 32, 0),
(200, 44, 33, 0),
(201, 44, 34, 0),
(202, 44, 35, 0),
(203, 44, 24, 0),
(204, 44, 36, 0),
(205, 44, 45, 0),
(206, 45, 29, 0),
(207, 45, 39, 0),
(208, 45, 40, 0),
(209, 45, 38, 0),
(210, 45, 37, 0),
(211, 45, 7, 0),
(212, 45, 23, 0),
(213, 45, 24, 0),
(214, 45, 36, 0),
(215, 46, 29, 0),
(216, 46, 39, 0),
(217, 46, 40, 0),
(218, 46, 38, 0),
(219, 46, 7, 0),
(220, 46, 23, 0),
(221, 46, 24, 0),
(222, 46, 36, 0),
(223, 47, 43, 0),
(224, 47, 45, 0),
(225, 48, 13, 0),
(226, 48, 45, 0),
(227, 49, 43, 0),
(228, 49, 29, 0),
(229, 49, 39, 0),
(230, 49, 40, 0),
(231, 49, 38, 0),
(232, 49, 7, 0),
(233, 49, 23, 0),
(234, 49, 24, 0),
(235, 49, 36, 0),
(236, 50, 43, 0),
(237, 50, 29, 0),
(238, 50, 39, 0),
(239, 50, 40, 0),
(240, 50, 38, 0),
(241, 50, 7, 0),
(242, 50, 23, 0),
(243, 50, 24, 0),
(244, 50, 36, 0),
(245, 51, 41, 0),
(246, 51, 45, 0),
(247, 51, 42, 0),
(248, 52, 15, 0),
(249, 52, 46, 0);

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
(1, 1, 1, 'Salchipizza Porcion', 11000, 98, 14, 1, 1),
(2, 1, 2, 'Pollo con Champiñones Porcion', 11000, 99, 14, 1, 1),
(3, 1, 3, 'Hawaiana Porcion', 11000, 100, 14, 1, 1),
(4, 1, 4, 'Jamon y queso Porcion', 11000, 100, 14, 1, 1),
(5, 1, 5, 'Jamon y pollo Porcion', 11000, 97, 14, 1, 1),
(6, 1, 6, 'Pollo y Maiz Porcion', 11000, 99, 14, 1, 1),
(7, 1, 7, 'Pizza Medida', 58000, 100, 14, 1, 1),
(8, 1, 8, 'Pizza Grande', 83000, 100, 14, 1, 1),
(9, 1, 9, 'Pizza Vegetariana Porcion', 11000, 100, 11, 1, 1),
(10, 1, 10, 'La Queso Porcion', 11000, 100, 11, 1, 1),
(11, 1, 11, 'Ranchera Porcion', 11000, 100, 11, 1, 1),
(12, 1, 12, 'Carnes Especial', 11000, 100, 11, 1, 1),
(13, 1, 13, 'Peperoni Porcion', 11000, 100, 11, 1, 1),
(14, 1, 14, 'Napolitana Porcion', 11000, 100, 11, 1, 1),
(15, 1, 15, 'Pizza Mexicana Porcion', 11000, 100, 11, 1, 1),
(16, 1, 16, 'Gaseosa 400 ml', 4000, 100, 13, 2, 1),
(17, 1, 17, 'Gaseosa 1.5 l', 8000, 100, 13, 2, 1),
(18, 1, 18, 'Gaseosa 2.5 l', 10000, 100, 13, 2, 1),
(19, 1, 19, 'Té Helado', 4000, 100, 13, 2, 1),
(20, 1, 20, 'Jugos Del Valle', 4000, 100, 13, 2, 1),
(21, 1, 21, 'Agua en Botella', 4000, 100, 13, 2, 1),
(22, 1, 22, 'Cerveza en Lata', 4500, 100, 13, 2, 1),
(23, 1, 23, 'Hamburguesa Sencilla', 12500, 100, 5, 1, 1),
(24, 1, 24, 'Hamburguesa De Res', 17500, 100, 5, 1, 1),
(25, 1, 25, 'Hamburguesa De Pollo', 14000, 100, 5, 1, 1),
(26, 1, 26, 'Hamburguesa Doble', 20000, 100, 5, 1, 1),
(27, 1, 27, 'Hamburguesa Mexicana', 18000, 100, 5, 1, 1),
(28, 1, 28, 'Hamburguesa Hawaiana', 18000, 100, 5, 1, 1),
(29, 1, 29, 'Hamburguesa Ranchera', 18000, 100, 5, 1, 1),
(30, 1, 30, 'Hamburguesa Sencilla Con Francesa', 15000, 100, 5, 1, 1),
(31, 1, 31, 'Hamburguesa De Res Con Francesa', 20000, 100, 5, 1, 1),
(32, 1, 32, 'Hamburguesa De Pollo Con Francesa', 17000, 100, 5, 1, 1),
(33, 1, 33, 'Hamburguesa Doble Con Francesa', 23000, 100, 5, 1, 1),
(34, 1, 34, 'Hamburguesa Mexicana Con Francesa', 21000, 100, 5, 1, 1),
(35, 1, 35, 'Hamburguesa Hawaiana Con Francesa', 21000, 100, 5, 1, 1),
(36, 1, 36, 'Hamburguesa Ranchera Con Francesa', 21000, 100, 5, 1, 1),
(37, 1, 37, 'Super Perro Sencillo', 13000, 100, 4, 1, 1),
(38, 1, 38, 'Super Perro Con Papas', 15000, 100, 4, 1, 1),
(39, 1, 39, 'Perro Ranchero', 15000, 100, 4, 1, 1),
(40, 1, 40, 'Perro Ranchero Con Papas', 18000, 100, 4, 1, 1),
(41, 1, 41, 'Perro Mexicano', 14000, 100, 4, 1, 1),
(42, 1, 42, 'Perro Mexicano Con Papas', 18000, 100, 4, 1, 1),
(43, 1, 43, 'Chorriperro ', 14000, 100, 4, 1, 1),
(44, 1, 44, 'Chorriperro Con Papas', 17000, 100, 4, 1, 1),
(45, 1, 45, 'Mazorcada sencilla', 20000, 100, 4, 1, 1),
(46, 1, 46, 'Mazorcada Doble', 34000, 100, 4, 1, 1),
(47, 1, 47, 'Salchipapa', 16000, 100, 4, 1, 1),
(48, 1, 48, 'Choripapa', 17000, 100, 4, 1, 1),
(49, 1, 49, 'Salchi Mazorcada', 26000, 100, 4, 1, 1),
(50, 1, 50, 'Salchi Mazorcada Doble', 39000, 100, 4, 1, 1),
(51, 1, 51, 'Costillas de Cerdo BBQ', 28000, 100, 4, 1, 1),
(52, 1, 52, 'Lasagna', 22000, 100, 4, 1, 1),
(53, 1, 53, 'Papa a la Francesa', 7000, 100, 12, 1, 1),
(54, 1, 54, 'Porcion de Queso', 2000, 100, 12, 1, 1),
(55, 1, 55, 'Porcion Tocineta', 2000, 100, 12, 1, 1),
(56, 1, 56, 'Porcion Chorizo', 3000, 100, 12, 1, 1);

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propinas`
--

CREATE TABLE `propinas` (
  `id_propinas` int(11) NOT NULL,
  `id_factura` int(11) NOT NULL,
  `valor_propinas` int(11) NOT NULL,
  `fecha_ingreso` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Indices de la tabla `propinas`
--
ALTER TABLE `propinas`
  ADD PRIMARY KEY (`id_propinas`);

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
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `factura_proeevedor`
--
ALTER TABLE `factura_proeevedor`
  MODIFY `id_factura_proeevedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=227;

--
-- AUTO_INCREMENT de la tabla `funiones`
--
ALTER TABLE `funiones`
  MODIFY `id_funciones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ingrediente`
--
ALTER TABLE `ingrediente`
  MODIFY `id_ingrediente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `ingrediente_producto`
--
ALTER TABLE `ingrediente_producto`
  MODIFY `id_ingrediente_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;

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
  MODIFY `id_nomina` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `piso`
--
ALTER TABLE `piso`
  MODIFY `id_piso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `proeevedor`
--
ALTER TABLE `proeevedor`
  MODIFY `id_proeevedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `promocion`
--
ALTER TABLE `promocion`
  MODIFY `id_promocion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `propinas`
--
ALTER TABLE `propinas`
  MODIFY `id_propinas` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT;

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
