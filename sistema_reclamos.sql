-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-07-2022 a las 20:38:55
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema_reclamos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calles`
--

CREATE TABLE `calles` (
  `idCalle` int(11) NOT NULL,
  `calle` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `calles`
--

INSERT INTO `calles` (`idCalle`, `calle`) VALUES
(1, 'Av. Vaccarezza'),
(2, '9 de Julio'),
(3, 'Raúl Lozza');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `idCategoria` int(11) NOT NULL,
  `categoria` varchar(250) NOT NULL,
  `descripcion` varchar(300) NOT NULL,
  `imgCategoria` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`idCategoria`, `categoria`, `descripcion`, `imgCategoria`) VALUES
(1, 'Alumbrado', 'Alumbrado público', 'alumbrado.png'),
(2, 'Animales', 'Animales en general', 'animales.png'),
(3, 'Arbolado', 'Arbolado público', 'arbolado.png'),
(4, 'Educación', 'Educación', 'educacion.png'),
(5, 'Espacios públicos', 'Espacios públicos', 'espaciospublicos.png'),
(6, 'Limpieza y recolección', 'Limpieza y recolección', 'limpiezayrecoleccion.png'),
(7, 'Salud', 'Salud', 'salud.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `idEstado` int(11) NOT NULL,
  `estado` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`idEstado`, `estado`) VALUES
(1, 'Solicitud enviada'),
(2, 'En proceso de resolución'),
(3, 'Resuelto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos_reclamos`
--

CREATE TABLE `fotos_reclamos` (
  `idFoto` int(11) NOT NULL,
  `urlFoto` varchar(250) NOT NULL,
  `idReclamo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `fotos_reclamos`
--

INSERT INTO `fotos_reclamos` (`idFoto`, `urlFoto`, `idReclamo`) VALUES
(1, '2.jpg', 20002),
(2, '3.jpg', 20002),
(5, '1.jpg', 20004),
(6, '2.jpg', 20004),
(7, '3.jpg', 20004),
(8, 'ans.jpg', 20005),
(9, 'EJ.jpg', 20005),
(10, 'historialSV.jpg', 20005),
(11, 'suma de matrices.jpg', 20006),
(12, 'ans.jpg', 20007),
(13, 'ans.jpg', 20008),
(14, 'ans.jpg', 20009),
(15, '1.jpg', 20010),
(16, '2.jpg', 20010),
(17, '1.jpg', 20011),
(18, '2.jpg', 20011),
(19, '1.jpg', 20012),
(20, '2.jpg', 20012),
(21, '1.jpg', 20013),
(22, '2.jpg', 20013),
(23, '1.jpg', 20014),
(24, '2.jpg', 20014),
(25, '1.jpg', 20015),
(26, '2.jpg', 20015),
(27, '1.jpg', 20016),
(28, '2.jpg', 20016),
(29, '1.jpg', 20017),
(30, '2.jpg', 20017),
(31, '1.jpg', 20018),
(32, '2.jpg', 20018),
(33, '1.jpg', 20019),
(34, '2.jpg', 20019),
(35, '1.jpg', 20020),
(36, '2.jpg', 20020),
(37, '1.jpg', 20021),
(38, '2.jpg', 20021);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reclamos`
--

CREATE TABLE `reclamos` (
  `idReclamo` int(11) NOT NULL,
  `idSubcategoria` int(11) NOT NULL,
  `fechaReclamo` date NOT NULL,
  `nombreVecino` varchar(250) NOT NULL,
  `dni` int(8) NOT NULL,
  `idCalle` int(11) NOT NULL,
  `altura` int(11) NOT NULL,
  `telefonoVecino` varchar(250) NOT NULL,
  `correoVecino` varchar(250) NOT NULL,
  `idEstado` int(11) NOT NULL,
  `comentario` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `reclamos`
--

INSERT INTO `reclamos` (`idReclamo`, `idSubcategoria`, `fechaReclamo`, `nombreVecino`, `dni`, `idCalle`, `altura`, `telefonoVecino`, `correoVecino`, `idEstado`, `comentario`) VALUES
(20002, 7, '2022-06-16', 'juan', 0, 1, 0, '11 22334455', 'ddd@hhhhhh', 3, 'llllllllllllllllllllllllllllll'),
(20003, 11, '2022-06-15', 'agustina gonzales', 35000111, 2, 0, '2346 150000000000000', 'agustina@gmail.com.ar', 1, '////////////////////////////////////////////7'),
(20004, 13, '2022-05-11', 'Francisco JJJJJ', 10849990, 3, 0, '011 15666666', 'fran@hotmaill.com', 2, 'hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh'),
(20005, 11, '2022-07-08', 'Juan Perez', 45665874, 2, 123456, '23546456454', 'juan@gmail.com', 1, 'Consulta castración'),
(20006, 10, '2022-07-12', 'Emmanuel', 35101107, 3, 164, '2346418590', 'emmanuel.pagano@gmail.com', 1, 'aaaaaaaaaaaaaaaa'),
(20007, 10, '2022-07-12', 'Sergio Emmanuel Pagano', 35101107, 3, 164, '2346418590', 'emmanuel.pagano@gmail.com', 1, 'wwwwwwwwwwwwwwwwwwwww'),
(20008, 10, '2022-07-12', 'Sergio Emmanuel Pagano', 35101107, 3, 164, '2346418590', 'emmanuel.pagano@gmail.com', 1, 'wwwwwwwwwwwwwwwwwwwww'),
(20009, 10, '2022-07-12', 'Sergio Emmanuel Pagano', 35101107, 3, 164, '2346418590', 'emmanuel.pagano@gmail.com', 1, 'wwwwwwwwwwwwwwwwwwwww'),
(20010, 10, '2022-07-12', 'Emmanuel', 35101107, 2, 123123, '11', 'emmanuel.pagano@gmail.com', 1, 'asdasd'),
(20011, 10, '2022-07-12', 'Emmanuel', 35101107, 2, 123123, '11', 'emmanuel.pagano@gmail.com', 1, 'asdasd'),
(20012, 10, '2022-07-12', 'Emmanuel', 35101107, 2, 123123, '11', 'emmanuel.pagano@gmail.com', 1, 'asdasd'),
(20013, 10, '2022-07-12', 'Emmanuel', 35101107, 2, 123123, '11', 'emmanuel.pagano@gmail.com', 1, 'asdasd'),
(20014, 10, '2022-07-12', 'Emmanuel', 35101107, 2, 123123, '11', 'emmanuel.pagano@gmail.com', 1, 'asdasd'),
(20015, 10, '2022-07-12', 'Emmanuel', 35101107, 2, 123123, '11', 'emmanuel.pagano@gmail.com', 1, 'asdasd'),
(20016, 10, '2022-07-12', 'Emmanuel', 35101107, 2, 123123, '11', 'emmanuel.pagano@gmail.com', 1, 'asdasd'),
(20017, 10, '2022-07-12', 'Emmanuel', 35101107, 2, 123123, '11', 'emmanuel.pagano@gmail.com', 1, 'asdasd'),
(20018, 10, '2022-07-12', 'Emmanuel', 35101107, 2, 123123, '11', 'emmanuel.pagano@gmail.com', 1, 'asdasd'),
(20019, 10, '2022-07-12', 'Emmanuel', 35101107, 2, 123123, '11', 'emmanuel.pagano@gmail.com', 1, 'asdasd'),
(20020, 10, '2022-07-12', 'Emmanuel', 35101107, 2, 123123, '11', 'emmanuel.pagano@gmail.com', 1, 'asdasd'),
(20021, 10, '2022-07-12', 'Emmanuel', 35101107, 2, 123123, '11', 'emmanuel.pagano@gmail.com', 1, 'asdasd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategorias`
--

CREATE TABLE `subcategorias` (
  `idSubcategoria` int(11) NOT NULL,
  `subcategoria` varchar(250) NOT NULL,
  `descripcionSub` varchar(250) NOT NULL,
  `idCategoriaPadre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `subcategorias`
--

INSERT INTO `subcategorias` (`idSubcategoria`, `subcategoria`, `descripcionSub`, `idCategoriaPadre`) VALUES
(1, 'Cable suelto', 'Cable suelto', 1),
(2, 'Columna caída o por caerse', 'Columna caída o por caerse', 1),
(3, 'Reparación de luminaria', 'Reparación de luminaria', 1),
(4, 'Poda vía pública', 'Poda vía pública', 3),
(5, 'Árbol seco', 'Árbol seco', 3),
(6, 'Barrido', 'Barrido', 6),
(7, 'Recolección de residuos', 'Recolección de residuos', 6),
(8, 'Terrenos', 'Terrenos', 6),
(9, 'EcoPlan', 'EcoPlan', 6),
(10, 'Animales en la vía pública', 'Animales en la vía pública', 2),
(11, 'Castración', 'Castración', 2),
(12, 'Parque municipal', 'Parque municipal', 5),
(13, 'Plazas', 'Plazas', 5),
(14, 'Reparación de juegos', 'Reparación de juegos', 5),
(15, 'Hospital municipal', 'Hospital municipal', 7),
(16, 'Salitas', 'Salitas', 7),
(17, 'Vacunación', 'Vacunación', 7),
(18, 'Casa del estudiante', 'Casa del estudiante', 4),
(19, 'Becas', 'Becas', 4),
(21, 'Transporte gratuito a Chivilcoy', 'Transporte gratuito a Chivilcoy', 4),
(22, 'Punto digital', 'Punto digital', 4),
(23, 'Talleres culturales', 'Talleres culturales', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `nombreCompleto` varchar(250) NOT NULL,
  `dni` int(8) NOT NULL,
  `correo` varchar(250) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `password` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nombreCompleto`, `dni`, `correo`, `telefono`, `password`) VALUES
(1, 'Sergio Emmanuel Pagano', 35101107, 'emmanuel.pagano@gmail.com', '2346418590', '123456');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `calles`
--
ALTER TABLE `calles`
  ADD PRIMARY KEY (`idCalle`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`idEstado`);

--
-- Indices de la tabla `fotos_reclamos`
--
ALTER TABLE `fotos_reclamos`
  ADD PRIMARY KEY (`idFoto`),
  ADD KEY `FK_reclamo` (`idReclamo`);

--
-- Indices de la tabla `reclamos`
--
ALTER TABLE `reclamos`
  ADD PRIMARY KEY (`idReclamo`),
  ADD KEY `FK_estado` (`idEstado`),
  ADD KEY `FK_subcategoria` (`idSubcategoria`),
  ADD KEY `FK_calle` (`idCalle`);

--
-- Indices de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD PRIMARY KEY (`idSubcategoria`),
  ADD KEY `FK_categoriaPadre` (`idCategoriaPadre`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `calles`
--
ALTER TABLE `calles`
  MODIFY `idCalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `idEstado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `fotos_reclamos`
--
ALTER TABLE `fotos_reclamos`
  MODIFY `idFoto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `reclamos`
--
ALTER TABLE `reclamos`
  MODIFY `idReclamo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20022;

--
-- AUTO_INCREMENT de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  MODIFY `idSubcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `fotos_reclamos`
--
ALTER TABLE `fotos_reclamos`
  ADD CONSTRAINT `relacion_foto_reclamo` FOREIGN KEY (`idReclamo`) REFERENCES `reclamos` (`idReclamo`);

--
-- Filtros para la tabla `reclamos`
--
ALTER TABLE `reclamos`
  ADD CONSTRAINT `relacion_reclamo_calle` FOREIGN KEY (`idCalle`) REFERENCES `calles` (`idCalle`),
  ADD CONSTRAINT `relacion_reclamo_estado` FOREIGN KEY (`idEstado`) REFERENCES `estados` (`idEstado`),
  ADD CONSTRAINT `relacion_reclamo_subcategoria` FOREIGN KEY (`idSubcategoria`) REFERENCES `subcategorias` (`idSubcategoria`);

--
-- Filtros para la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD CONSTRAINT `relacion_subcategoria_categoria` FOREIGN KEY (`idCategoriaPadre`) REFERENCES `categorias` (`idCategoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
