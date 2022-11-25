-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 25-11-2022 a las 06:52:21
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
-- Base de datos: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autores`
--

CREATE TABLE `autores` (
  `Id_autor` int(11) NOT NULL,
  `Id_libro` int(11) NOT NULL,
  `Nombre` varchar(40) CHARACTER SET utf8 NOT NULL,
  `Activo` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consulta`
--

CREATE TABLE `consulta` (
  `Id_consulta` int(11) NOT NULL,
  `Id_persona` int(11) NOT NULL,
  `Id_libro` int(11) NOT NULL,
  `Fecha_visita` date NOT NULL,
  `Hora_entrada` time NOT NULL,
  `Hora_salida` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle`
--

CREATE TABLE `detalle` (
  `Id_prestamo` int(11) NOT NULL,
  `Id_libro` int(11) NOT NULL,
  `Descripcion` varchar(80) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `Id_empleado` int(11) NOT NULL,
  `Id_persona` int(11) NOT NULL,
  `Id_puesto` int(11) NOT NULL,
  `Fecha_contratacion` date NOT NULL,
  `Activo` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`Id_empleado`, `Id_persona`, `Id_puesto`, `Fecha_contratacion`, `Activo`) VALUES
(1, 1, 1, '2022-10-27', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envio_modulos`
--

CREATE TABLE `envio_modulos` (
  `Id_envio` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `usuario` int(11) NOT NULL,
  `ubicacion` varchar(250) DEFAULT NULL,
  `envioa` varchar(250) DEFAULT NULL,
  `fechaenvio` date DEFAULT NULL,
  `recibe` int(11) DEFAULT NULL,
  `testigo` varchar(250) DEFAULT NULL,
  `titulo` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `envio_modulos`
--

INSERT INTO `envio_modulos` (`Id_envio`, `fecha`, `usuario`, `ubicacion`, `envioa`, `fechaenvio`, `recibe`, `testigo`, `titulo`, `cantidad`) VALUES
(1, '0000-00-00 00:00:00', 0, 'bodega_chica', 'municipio', '2022-11-24', 1, 'gook', 1, 5),
(2, '0000-00-00 00:00:00', 0, 'bodega_chica', 'municipio', '2022-11-24', 1, 'gook', 1, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidencias`
--

CREATE TABLE `incidencias` (
  `Id_incidencia` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `usuario` int(11) NOT NULL,
  `fechaenvio` date NOT NULL,
  `fecharecibido` date NOT NULL,
  `usuarioenvio` int(11) NOT NULL,
  `usuariorecibio` int(11) NOT NULL,
  `testigo` varchar(250) NOT NULL,
  `incidencia` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `incidencias`
--

INSERT INTO `incidencias` (`Id_incidencia`, `fecha`, `usuario`, `fechaenvio`, `fecharecibido`, `usuarioenvio`, `usuariorecibio`, `testigo`, `incidencia`) VALUES
(1, '2022-11-24 09:00:04', 1, '2022-11-24', '2022-11-24', 1, 1, 'soy testigo', 'prueba de envio de incidencia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `Id_libro` int(11) NOT NULL,
  `Titulo` varchar(50) CHARACTER SET utf8 NOT NULL,
  `Copias` int(1) DEFAULT NULL,
  `Editorial` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `Fecha_edicion` date DEFAULT NULL,
  `Categoria` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `Estante` int(1) DEFAULT NULL,
  `Activo` int(1) NOT NULL DEFAULT 1,
  `estado` varchar(25) NOT NULL,
  `nivel` varchar(25) NOT NULL,
  `material` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`Id_libro`, `Titulo`, `Copias`, `Editorial`, `Fecha_edicion`, `Categoria`, `Estante`, `Activo`, `estado`, `nivel`, `material`) VALUES
(1, 'prueba libro', NULL, NULL, NULL, NULL, NULL, 1, 'usado', 'secundaria', 'diversificado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `Id_persona` int(11) NOT NULL,
  `Nombre` varchar(40) CHARACTER SET utf8 NOT NULL,
  `Barrio` varchar(16) CHARACTER SET utf8 NOT NULL,
  `Calle` varchar(16) CHARACTER SET utf8 NOT NULL,
  `Numero` int(3) UNSIGNED DEFAULT NULL,
  `Estado` varchar(18) CHARACTER SET utf8 NOT NULL,
  `Ciudad` varchar(18) CHARACTER SET utf8 NOT NULL,
  `Sexo` varchar(9) CHARACTER SET utf8 NOT NULL,
  `Fecha_nacimiento` date NOT NULL,
  `Telefono` varchar(10) CHARACTER SET utf8 NOT NULL,
  `Correo` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Activo` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`Id_persona`, `Nombre`, `Barrio`, `Calle`, `Numero`, `Estado`, `Ciudad`, `Sexo`, `Fecha_nacimiento`, `Telefono`, `Correo`, `Activo`) VALUES
(1, 'Administrador', 'conocido', 'conocida', NULL, 'Sinaloa', 'Culiacán', 'F', '2016-11-14', '5555555555', 'admin@admin.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `Id_prestamo` int(11) NOT NULL,
  `Id_empleado` int(11) NOT NULL,
  `Id_persona` int(11) NOT NULL,
  `Cantidad` int(1) NOT NULL,
  `Identificacion` varchar(20) CHARACTER SET utf8 NOT NULL,
  `Fecha_prestamo` date NOT NULL,
  `Fecha_devolucion` date NOT NULL,
  `Estatus` varchar(9) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puesto`
--

CREATE TABLE `puesto` (
  `Id_puesto` int(11) NOT NULL,
  `Descripcion` varchar(30) CHARACTER SET utf8 NOT NULL,
  `Activo` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `puesto`
--

INSERT INTO `puesto` (`Id_puesto`, `Descripcion`, `Activo`) VALUES
(1, 'Administrador', 1),
(2, 'Responsable Estatal', 1),
(3, 'Coordinador de Zona', 1),
(4, 'Administrador', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recibido_modulos`
--

CREATE TABLE `recibido_modulos` (
  `Id_recibido` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `usuario` int(11) NOT NULL,
  `ubicacion` varchar(250) DEFAULT NULL,
  `envioa` varchar(250) DEFAULT NULL,
  `fecharecibo` date DEFAULT NULL,
  `recibe` int(11) DEFAULT NULL,
  `testigo` varchar(250) DEFAULT NULL,
  `titulo` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `retorno_modulos`
--

CREATE TABLE `retorno_modulos` (
  `Id_retorno` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `usuario` int(11) NOT NULL,
  `ubicacion` varchar(250) DEFAULT NULL,
  `envioa` varchar(250) DEFAULT NULL,
  `fecharetorno` date DEFAULT NULL,
  `recibe` int(11) DEFAULT NULL,
  `testigo` varchar(250) DEFAULT NULL,
  `titulo` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Id_usuario` int(11) NOT NULL,
  `Id_empleado` int(11) NOT NULL,
  `Nombre_usuario` varchar(16) CHARACTER SET utf8 NOT NULL,
  `Password` varchar(16) CHARACTER SET utf8 NOT NULL,
  `Activo` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Id_usuario`, `Id_empleado`, `Nombre_usuario`, `Password`, `Activo`) VALUES
(1, 1, 'admin', '123456', b'1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autores`
--
ALTER TABLE `autores`
  ADD PRIMARY KEY (`Id_autor`),
  ADD KEY `FK_autores_libros` (`Id_libro`);

--
-- Indices de la tabla `consulta`
--
ALTER TABLE `consulta`
  ADD PRIMARY KEY (`Id_consulta`) USING BTREE,
  ADD KEY `FK__personas` (`Id_persona`),
  ADD KEY `FK_consulta_libros` (`Id_libro`);

--
-- Indices de la tabla `detalle`
--
ALTER TABLE `detalle`
  ADD KEY `FK_detalle_libros` (`Id_libro`),
  ADD KEY `FK_detalle_prestamos` (`Id_prestamo`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`Id_empleado`),
  ADD KEY `FK_empleados_puesto` (`Id_puesto`),
  ADD KEY `FK_empleados_personas` (`Id_persona`);

--
-- Indices de la tabla `envio_modulos`
--
ALTER TABLE `envio_modulos`
  ADD PRIMARY KEY (`Id_envio`);

--
-- Indices de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD PRIMARY KEY (`Id_incidencia`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`Id_libro`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`Id_persona`);

--
-- Indices de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`Id_prestamo`),
  ADD KEY `FK__empleados` (`Id_empleado`),
  ADD KEY `FK_prestamos_personas` (`Id_persona`);

--
-- Indices de la tabla `puesto`
--
ALTER TABLE `puesto`
  ADD PRIMARY KEY (`Id_puesto`);

--
-- Indices de la tabla `recibido_modulos`
--
ALTER TABLE `recibido_modulos`
  ADD PRIMARY KEY (`Id_recibido`);

--
-- Indices de la tabla `retorno_modulos`
--
ALTER TABLE `retorno_modulos`
  ADD PRIMARY KEY (`Id_retorno`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Id_usuario`),
  ADD KEY `FK_usuarios_empleados` (`Id_empleado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `autores`
--
ALTER TABLE `autores`
  MODIFY `Id_autor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `consulta`
--
ALTER TABLE `consulta`
  MODIFY `Id_consulta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `Id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `envio_modulos`
--
ALTER TABLE `envio_modulos`
  MODIFY `Id_envio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  MODIFY `Id_incidencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `Id_libro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `Id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `Id_prestamo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `puesto`
--
ALTER TABLE `puesto`
  MODIFY `Id_puesto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `recibido_modulos`
--
ALTER TABLE `recibido_modulos`
  MODIFY `Id_recibido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `retorno_modulos`
--
ALTER TABLE `retorno_modulos`
  MODIFY `Id_retorno` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `Id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `autores`
--
ALTER TABLE `autores`
  ADD CONSTRAINT `FK_autores_libros` FOREIGN KEY (`Id_libro`) REFERENCES `libros` (`Id_libro`) ON DELETE NO ACTION;

--
-- Filtros para la tabla `consulta`
--
ALTER TABLE `consulta`
  ADD CONSTRAINT `FK__personas` FOREIGN KEY (`Id_persona`) REFERENCES `personas` (`Id_persona`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_consulta_libros` FOREIGN KEY (`Id_libro`) REFERENCES `libros` (`Id_libro`) ON DELETE CASCADE;

--
-- Filtros para la tabla `detalle`
--
ALTER TABLE `detalle`
  ADD CONSTRAINT `FK_detalle_libros` FOREIGN KEY (`Id_libro`) REFERENCES `libros` (`Id_libro`),
  ADD CONSTRAINT `FK_detalle_prestamos` FOREIGN KEY (`Id_prestamo`) REFERENCES `prestamos` (`Id_prestamo`) ON DELETE CASCADE;

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `FK_empleados_personas` FOREIGN KEY (`Id_persona`) REFERENCES `personas` (`Id_persona`),
  ADD CONSTRAINT `FK_empleados_puesto` FOREIGN KEY (`Id_puesto`) REFERENCES `puesto` (`Id_puesto`);

--
-- Filtros para la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD CONSTRAINT `FK__empleados` FOREIGN KEY (`Id_empleado`) REFERENCES `empleados` (`Id_empleado`),
  ADD CONSTRAINT `FK_prestamos_personas` FOREIGN KEY (`Id_persona`) REFERENCES `personas` (`Id_persona`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `FK_usuarios_empleados` FOREIGN KEY (`Id_empleado`) REFERENCES `empleados` (`Id_empleado`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
