-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-01-2021 a las 04:43:52
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbrossana`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `copiarTabla` (IN `ID` INT(11), IN `ID_P` INT(11), IN `CANT` INT(5), IN `PRC` INT(5), IN `VEN` INT(5), IN `FCH` DATE, IN `CLI` VARCHAR(25))  BEGIN 
INSERT INTO `venta` (`Id_venta`, `Id_producto`, `Cantidad`, `Precio`, `Vendedor`, `Fecha`, `Cliente`)
VALUES (ID, ID_P , CANT , PRC, VEN ,FCH , CLI);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ventas_inventarios` (IN `_Id_venta` INT(11), IN `_Id_producto` INT(11), IN `_Cantidad` INT(5), IN `_Precio` FLOAT(11), IN `_Vendedor` INT(5), IN `_Fecha` DATE, IN `_Cliente` VARCHAR(25) CHARSET utf8, IN `accion` VARCHAR(6) CHARSET utf8)  BEGIN
	case accion
		when 'insert' then
			INSERT INTO `inventario_estadistica` (`Id_venta`, `Id_producto`, `Cantidad`, `Precio`, `Vendedor`, `Fecha`, `Cliente`)
VALUES (_Id_venta, _Id_producto , _Cantidad ,_Precio  , _Vendedor ,_Fecha ,_Cliente );

		when 'update' then 
			update inventario_estadistica set Id_venta = _Id_venta, Id_producto = _Id_producto , Cantidad =  Cantidad + _Cantidad, Precio = _Precio , Vendedor = _Vendedor, Fecha = _Fecha, Cliente =_Cliente where Id_producto=_Id_producto;
	end case;
	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `venta_inventario` (IN `_Id_venta` INT(11), IN `_Id_producto` INT(11), IN `_Cantidad` INT(5), IN `_Precio` FLOAT(11), IN `_Vendedor` INT(5), IN `_Fecha` DATE, IN `_Cliente` VARCHAR(25) CHARSET utf8, IN `accion` VARCHAR(6) CHARSET utf8)  BEGIN
	case accion
		when 'insert' then
			INSERT INTO `inventario_estadistica` (`identificador`,`Id_venta`, `Id_producto`, `Cantidad`, `Precio`, `Vendedor`, `Fecha`, `Cliente`)
VALUES (NULL,_Id_venta, _Id_producto , _Cantidad ,_Precio  , _Vendedor ,_Fecha ,_Cliente );

		when 'update' then 
			update inventario_estadistica set Id_venta = _Id_venta, Id_producto = _Id_producto , Cantidad =  Cantidad + _Cantidad, Precio = _Precio , Vendedor = _Vendedor, Fecha = _Fecha, Cliente =_Cliente where Id_producto=_Id_producto;
	end case;
	
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `contraseña` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Puesto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id`, `usuario`, `contraseña`, `Puesto`) VALUES
(1, 'Admi', '137946', 2),
(2, 'JoseA', '137946', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `Id_carro` int(5) NOT NULL,
  `Id_producto` int(5) NOT NULL,
  `Cantidad` int(5) NOT NULL,
  `Precio` float NOT NULL,
  `Vendedor` int(11) DEFAULT NULL,
  `Fecha` date NOT NULL,
  `Cliente` varchar(100) DEFAULT NULL,
  `ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`Id_carro`, `Id_producto`, `Cantidad`, `Precio`, `Vendedor`, `Fecha`, `Cliente`, `ID`) VALUES
(59, 1, 0, 0, 3, '2000-01-01', 'Ingresa cliente', 31);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`) VALUES
(6, 'Francisco Victorico'),
(8, 'Gabi'),
(9, 'Mata Gente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` int(11) NOT NULL,
  `nombres` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `apellido_p` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `apellido_m` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `usuario` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `contraseña` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cargo` int(11) DEFAULT NULL,
  `turno_entrada` time NOT NULL,
  `turno_salida` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `nombres`, `apellido_p`, `apellido_m`, `usuario`, `contraseña`, `cargo`, `turno_entrada`, `turno_salida`) VALUES
(3, 'José Alfredo', 'Martínez', 'Castro', 'JoseA', '137946', 1, '07:00:00', '14:00:00'),
(4, 'Jonathan Joshua', 'Santiago', 'García', 'Joshimura', '137946', 1, '14:00:00', '14:00:00'),
(6, 'Cesar', 'Luna', 'Lopez', 'Cisa16', '1379', 2, '10:35:00', '23:35:00'),
(7, 'Valeria ', 'Carreño', 'Loza', 'Loza', '137946', 1, '07:47:00', '19:47:00'),
(8, 'Joshua', 'Santiago', 'García', 'Joshimura', '137946', 1, '14:00:00', '14:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_estadistica`
--

CREATE TABLE `inventario_estadistica` (
  `identificador` int(11) NOT NULL,
  `Id_venta` int(11) NOT NULL,
  `Id_producto` int(11) NOT NULL,
  `Cantidad` int(5) NOT NULL,
  `Precio` float NOT NULL,
  `Vendedor` int(5) NOT NULL,
  `Fecha` date NOT NULL,
  `Cliente` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inventario_estadistica`
--

INSERT INTO `inventario_estadistica` (`identificador`, `Id_venta`, `Id_producto`, `Cantidad`, `Precio`, `Vendedor`, `Fecha`, `Cliente`) VALUES
(1, 28, 1, 4, 6.1, 3, '2020-11-30', 'Mata Gente'),
(2, 23, 39, 9, 5.5, 3, '2020-11-29', 'Joshua'),
(3, 4, 40, 3, 3, 3, '2020-11-28', 'Cesar Luna'),
(5, 16, 63, 3, 5.5, 3, '2020-11-29', 'Gabi'),
(6, 14, 43, 6, 2, 3, '2020-11-28', 'Bruno'),
(32, 21, 87, 2, 15.6, 3, '2020-11-29', 'Mata Gente'),
(33, 25, 74, 7, 7.5, 3, '2020-11-30', 'Mata Gente'),
(35, 27, 47, 1, 2.3, 3, '2020-11-30', 'Mata Gente'),
(36, 30, 2, 8, 6, 3, '2020-11-30', 'Cesar Luna');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `precio` float NOT NULL,
  `cantidad_existente` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` int(50) NOT NULL,
  `Tamaño` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `precio`, `cantidad_existente`, `tipo`, `Tamaño`) VALUES
(1, 'Aceite Primor', 6.1, '25', 1, '1 litro'),
(2, 'Aceite Cocinero', 6, '40', 1, '1 litro'),
(3, 'Aderezos Maggi', 2, '48', 1, '200 ml'),
(4, 'Sazonador Sazon Lopesa', 0.3, '50', 1, '80 g'),
(5, 'Avena Tres Ositos', 8.2, '50', 1, '1 kg'),
(6, 'Avena Quaker', 7.8, '50', 1, '1 kg'),
(7, 'Azucar Bell´s', 12.9, '50', 1, '5 kg'),
(8, 'Azucar Cartavio', 12.1, '50', 1, '5 kg'),
(9, 'Harina Blanca Flor', 6.1, '50', 1, '1 kg'),
(10, 'Sal Marina', 2, '50', 1, '1 kg'),
(11, 'Mayonesa Alacena', 9, '50', 1, '950 g'),
(12, 'Mermelada Fanny', 9.1, '50', 1, '800 g'),
(13, 'Mermelada Gloria', 11.4, '50', 1, '1 kg'),
(14, 'Mantequilla Manty', 3.1, '50', 1, '300 g'),
(15, 'Mantequilla Gloria', 8.2, '50', 1, '200 g'),
(16, 'Vinagre Florinda', 2.2, '50', 1, '625 ml'),
(17, 'Vinagre Del Firme', 3.5, '50', 1, '1 litro'),
(18, 'Huevo La Calera', 7.3, '50', 1, '12 unidades'),
(19, 'Pastas Don Vittorio', 3.7, '50', 1, '1 kg'),
(20, 'Pastas Molitalia', 2, '50', 1, '500 g'),
(21, 'Arroz Costeño', 3.5, '50', 1, '700 g'),
(22, 'Galleta de agua San Jorge', 2.8, '50', 1, '450 g'),
(23, 'Bezo de moza', 6.5, '50', 2, '9 unidades'),
(24, 'Sublime', 9.5, '50', 2, '10 unidades'),
(25, 'Triangulo', 1.3, '50', 2, '30 g'),
(26, 'Lenteja', 1.3, '50', 2, '30 g'),
(27, 'Costa', 0.5, '50', 2, '19 g'),
(28, 'Visio', 7, '50', 2, '131 g'),
(29, 'Chin Chin', 11.1, '50', 2, '320 g'),
(30, 'Bombon', 18.5, '50', 2, '450 g'),
(31, 'Golpe', 9.2, '50', 2, '24 unidades'),
(32, 'Batimix', 3, '50', 2, '125 g'),
(33, 'Morochas', 3, '50', 2, '6 unidades'),
(34, 'Picaras', 3, '50', 2, '6 unidades'),
(35, 'Nick', 2.3, '50', 2, '6 unidades'),
(36, 'Choco¡Boom!', 3, '50', 2, '6 unidades'),
(37, 'Tentacion', 2.5, '50', 2, '6 unidades'),
(38, 'Durazno Dos Caballas', 6.5, '50', 3, '822 g'),
(39, 'Atun Florida', 5.5, '40', 3, '170 g'),
(40, 'Atun Bells', 3.8, '47', 3, '170 g'),
(41, 'Sopa Instantanea Ajinomen', 2.3, '50', 3, '51 g'),
(42, 'Frugos Manzana ', 3.5, '50', 4, '1 litro'),
(43, 'Gatorade', 2.3, '39', 4, '500 ml'),
(44, 'Pulp', 9.2, '50', 4, '145 ml'),
(45, 'San Luis', 2.3, '50', 4, '2 litros'),
(46, 'Electrolight', 1.9, '50', 4, '475 ml'),
(47, 'Cielo', 2.3, '50', 4, '2.5 litros'),
(48, 'San Mateo', 2.5, '50', 4, '2.5 litros'),
(49, 'Sporade', 2.1, '50', 4, '500 ml'),
(50, 'Powerade', 2.3, '50', 4, '500 ml'),
(51, 'Naranja', 1.3, '50', 5, '1 kg'),
(52, 'Maracuya', 3.5, '50', 5, '1 kg'),
(53, 'Platano', 3, '50', 5, '1 kg'),
(54, 'Papaya', 3.8, '50', 5, '1 kg'),
(55, 'Mango', 3.1, '50', 5, '1 kg'),
(56, 'Piña', 4.2, '50', 5, '1 kg'),
(57, 'Manzana', 5.5, '50', 5, '1 kg'),
(58, 'Sandia', 1.3, '50', 5, '1 kg'),
(59, 'Limon', 1.3, '50', 5, '500 g'),
(60, 'Zanahoria', 3.2, '50', 5, '1 kg'),
(61, 'Zapallo', 1.8, '50', 5, '1 kg'),
(62, 'Palta', 9, '50', 5, '1 kg'),
(63, 'Arveja', 5.5, '45', 5, '1 kg'),
(64, 'Choclo', 1.3, '50', 5, '1 unidad'),
(65, 'Apio', 1.3, '50', 5, '1 unidad'),
(66, 'Papa', 1.3, '50', 5, '1 kg'),
(67, 'Culantro', 1.5, '50', 5, '1 unidad'),
(68, 'Betarraga', 2.5, '50', 5, '1 kg'),
(69, 'Tomate', 2.5, '50', 5, '1 kg'),
(70, 'Pimiento', 6.7, '50', 5, '1 kg'),
(71, 'Cebolla', 2.5, '50', 5, '1 kg'),
(72, 'Perejil', 2, '50', 5, '1 unidad'),
(73, 'Brocoli', 3.2, '50', 5, '1 kg'),
(74, 'Ajo', 7.5, '43', 5, '500 g'),
(75, 'Vainita Americana', 3.5, '50', 5, '1 kg'),
(76, 'Nabo', 1.1, '50', 5, '1 unidad'),
(77, 'Maiz Morado', 3.3, '50', 5, '500 g'),
(78, 'Camote', 1.8, '50', 5, '600 g'),
(79, 'Bistec', 18.5, '50', 6, '700 g'),
(80, 'Carne Molida', 9.9, '50', 6, '700 g'),
(81, 'Guiso De Res', 16.9, '50', 6, '700 g'),
(82, 'Lomo Saltado', 21.6, '50', 6, '700 g'),
(83, 'Carne Molida', 19.5, '50', 6, '700 g'),
(84, 'Mondongo Italiano', 5.9, '50', 6, '500 g'),
(85, 'Modongo de Cau Cau', 5.9, '50', 6, '500 g'),
(86, 'Higado de Pollo', 4.8, '50', 6, '800 g'),
(87, 'Chorizo', 15.6, '48', 6, '500 g'),
(88, 'Pierna con Encuentro', 10.6, '50', 6, '1 kg'),
(89, 'Rodaja de Pierna', 13.8, '50', 6, '1 kg'),
(90, 'Pierna Especial', 12.7, '50', 6, '1 kg'),
(100, 'Pierna con Muslo', 10.5, '50', 6, '605 g'),
(101, 'Pollo Entero', 14.4, '50', 6, '1 kg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_proveedor`
--

CREATE TABLE `producto_proveedor` (
  `id_producto` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id` int(11) NOT NULL,
  `empresa` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puesto`
--

CREATE TABLE `puesto` (
  `Id_puesto` int(11) NOT NULL,
  `Puesto` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `puesto`
--

INSERT INTO `puesto` (`Id_puesto`, `Puesto`) VALUES
(1, 'Vendedor'),
(2, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket`
--

CREATE TABLE `ticket` (
  `Id` int(2) DEFAULT NULL,
  `nombre` varchar(50) NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `horario_apertura` time DEFAULT NULL,
  `horario_cierre` time DEFAULT NULL,
  `telefono` varchar(11) DEFAULT NULL,
  `saludo` text DEFAULT NULL,
  `saludo_2` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ticket`
--

INSERT INTO `ticket` (`Id`, `nombre`, `direccion`, `horario_apertura`, `horario_cierre`, `telefono`, `saludo`, `saludo_2`) VALUES
(1, 'Bodega Rossanna', 'Av. Martir José Olaya 1280, Huancayo.', '08:00:00', '22:00:00', '9516147039', '¡Gracias por visitarnos y hacer sus compras aquí!', 'Estamos contentos de que haya encontrado lo que estaba buscando');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE `tipo` (
  `id` int(11) NOT NULL,
  `tipo` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`id`, `tipo`) VALUES
(1, 'Abarrotes'),
(2, 'Confiteria'),
(3, 'Enlatados'),
(4, 'Bebidas'),
(5, 'Frutas y Verduras'),
(6, 'Congelados');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `Id_venta` int(11) NOT NULL,
  `Id_producto` int(11) NOT NULL,
  `Cantidad` int(5) NOT NULL,
  `Precio` float NOT NULL,
  `Vendedor` int(5) NOT NULL,
  `Fecha` date NOT NULL,
  `Cliente` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`Id_venta`, `Id_producto`, `Cantidad`, `Precio`, `Vendedor`, `Fecha`, `Cliente`) VALUES
(3, 43, 5, 2, 3, '2020-11-28', 'Ximena'),
(4, 40, 3, 3, 3, '2020-11-28', 'Cesar Luna'),
(5, 1, 2, 6, 3, '2020-11-28', 'Francisco Victorico'),
(5, 1, 2, 6, 3, '2020-11-28', 'Francisco Victorico'),
(5, 1, 2, 6, 3, '2020-11-28', 'Francisco Victorico'),
(6, 1, 2, 6, 3, '2020-11-28', 'Mata Gente'),
(7, 1, 2, 6, 3, '2020-11-28', 'Rodolfo'),
(8, 1, 2, 6, 3, '2020-11-28', 'Rosa'),
(9, 1, 3, 6, 3, '2020-11-28', 'Gabi'),
(10, 3, 2, 2, 3, '2020-11-28', 'Chico'),
(11, 1, 10, 6, 3, '2020-11-28', 'Cassie'),
(13, 43, 3, 2, 3, '2020-11-28', 'Chepe'),
(14, 43, 3, 2, 3, '2020-11-28', 'Bruno'),
(15, 39, 3, 5, 3, '2020-11-28', 'Mata Gente'),
(16, 63, 5, 5, 3, '2020-11-29', 'Gabi'),
(18, 1, 2, 6, 3, '2020-11-29', 'Cesar Luna'),
(20, 39, 1, 5, 3, '2020-11-29', 'Francisco Victorico'),
(21, 87, 2, 15, 3, '2020-11-29', 'Mata Gente'),
(22, 39, 3, 5, 3, '2020-11-29', 'Mata Gente'),
(23, 39, 3, 5, 3, '2020-11-29', 'Joshua'),
(25, 74, 7, 7, 3, '2020-11-30', 'Mata Gente'),
(27, 47, 1, 2, 3, '2020-11-30', 'Mata Gente'),
(28, 1, 1, 6, 3, '2020-11-30', 'Mata Gente'),
(30, 2, 8, 6, 3, '2020-11-30', 'Cesar Luna');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Puesto` (`Puesto`);

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`Id_carro`),
  ADD KEY `Id_producto` (`Id_producto`),
  ADD KEY `Vendedor` (`Vendedor`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cargo` (`cargo`);

--
-- Indices de la tabla `inventario_estadistica`
--
ALTER TABLE `inventario_estadistica`
  ADD PRIMARY KEY (`identificador`),
  ADD KEY `Id_producto` (`Id_producto`),
  ADD KEY `Id_venta` (`Id_venta`),
  ADD KEY `Vendedor` (`Vendedor`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productos_ibfk_1` (`tipo`);

--
-- Indices de la tabla `producto_proveedor`
--
ALTER TABLE `producto_proveedor`
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_proveedor` (`id_proveedor`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `puesto`
--
ALTER TABLE `puesto`
  ADD PRIMARY KEY (`Id_puesto`);

--
-- Indices de la tabla `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD KEY `Id_producto` (`Id_producto`),
  ADD KEY `Vendedor` (`Vendedor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `Id_carro` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `inventario_estadistica`
--
ALTER TABLE `inventario_estadistica`
  MODIFY `identificador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `puesto`
--
ALTER TABLE `puesto`
  MODIFY `Id_puesto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo`
--
ALTER TABLE `tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD CONSTRAINT `administrador_ibfk_1` FOREIGN KEY (`Puesto`) REFERENCES `puesto` (`Id_puesto`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`Id_producto`) REFERENCES `productos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`Vendedor`) REFERENCES `empleados` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `empleados_ibfk_1` FOREIGN KEY (`cargo`) REFERENCES `puesto` (`Id_puesto`);

--
-- Filtros para la tabla `inventario_estadistica`
--
ALTER TABLE `inventario_estadistica`
  ADD CONSTRAINT `inventario_estadistica_ibfk_1` FOREIGN KEY (`Id_producto`) REFERENCES `productos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `inventario_estadistica_ibfk_2` FOREIGN KEY (`Vendedor`) REFERENCES `empleados` (`id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`tipo`) REFERENCES `tipo` (`id`);

--
-- Filtros para la tabla `producto_proveedor`
--
ALTER TABLE `producto_proveedor`
  ADD CONSTRAINT `producto_proveedor_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `producto_proveedor_ibfk_2` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id`);

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`Id_producto`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `venta_ibfk_2` FOREIGN KEY (`Vendedor`) REFERENCES `empleados` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
