-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.29-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para biblioteca
CREATE DATABASE IF NOT EXISTS `biblioteca` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `biblioteca`;

-- Volcando estructura para tabla biblioteca.autores
CREATE TABLE IF NOT EXISTS `autores` (
  `Id_autor` int(11) NOT NULL AUTO_INCREMENT,
  `Id_libro` int(11) NOT NULL,
  `Nombre` varchar(40) NOT NULL,
  `Activo` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`Id_autor`),
  KEY `FK_autores_libros` (`Id_libro`),
  CONSTRAINT `FK_autores_libros` FOREIGN KEY (`Id_libro`) REFERENCES `libros` (`Id_libro`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla biblioteca.autores: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `autores` DISABLE KEYS */;
INSERT IGNORE INTO `autores` (`Id_autor`, `Id_libro`, `Nombre`, `Activo`) VALUES
	(6, 3, 'Gabriel Garcia Marquez', 1),
	(7, 6, 'pedro lopez', 1);
/*!40000 ALTER TABLE `autores` ENABLE KEYS */;

-- Volcando estructura para tabla biblioteca.consulta
CREATE TABLE IF NOT EXISTS `consulta` (
  `Id_consulta` int(11) NOT NULL AUTO_INCREMENT,
  `Id_persona` int(11) NOT NULL,
  `Id_libro` int(11) NOT NULL,
  `Fecha_visita` date NOT NULL,
  `Hora_entrada` time NOT NULL,
  `Hora_salida` time NOT NULL,
  PRIMARY KEY (`Id_consulta`) USING BTREE,
  KEY `FK__personas` (`Id_persona`),
  KEY `FK_consulta_libros` (`Id_libro`),
  CONSTRAINT `FK__personas` FOREIGN KEY (`Id_persona`) REFERENCES `personas` (`Id_persona`) ON DELETE CASCADE,
  CONSTRAINT `FK_consulta_libros` FOREIGN KEY (`Id_libro`) REFERENCES `libros` (`Id_libro`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla biblioteca.consulta: ~18 rows (aproximadamente)
/*!40000 ALTER TABLE `consulta` DISABLE KEYS */;
INSERT IGNORE INTO `consulta` (`Id_consulta`, `Id_persona`, `Id_libro`, `Fecha_visita`, `Hora_entrada`, `Hora_salida`) VALUES
	(1, 3, 4, '2020-07-07', '09:10:00', '11:10:00'),
	(2, 4, 6, '2020-07-06', '03:10:00', '05:10:00'),
	(3, 3, 3, '2020-07-05', '13:11:00', '16:11:00'),
	(4, 4, 9, '2020-07-04', '02:11:00', '03:11:00'),
	(5, 1, 12, '2020-07-04', '14:11:00', '16:16:00'),
	(6, 1, 1, '2020-06-28', '14:13:00', '16:00:00'),
	(7, 6, 5, '2020-07-10', '15:21:00', '18:23:00'),
	(8, 2, 15, '2020-05-08', '16:18:00', '18:30:00'),
	(10, 5, 17, '2020-06-29', '10:20:00', '12:20:00'),
	(11, 3, 9, '2020-07-16', '13:23:00', '17:21:00'),
	(12, 1, 12, '2020-02-05', '23:25:00', '13:11:00'),
	(13, 5, 13, '2019-07-20', '13:30:00', '15:10:00'),
	(14, 4, 7, '2020-03-10', '08:26:00', '10:30:00'),
	(16, 3, 13, '2020-05-13', '15:30:00', '17:25:00'),
	(17, 6, 2, '2020-01-20', '12:26:00', '14:29:00'),
	(18, 1, 6, '2020-03-25', '22:27:00', '12:34:00'),
	(19, 4, 5, '2019-08-05', '15:29:00', '17:33:00'),
	(20, 6, 10, '2017-01-15', '14:10:00', '16:59:00');
/*!40000 ALTER TABLE `consulta` ENABLE KEYS */;

-- Volcando estructura para tabla biblioteca.detalle
CREATE TABLE IF NOT EXISTS `detalle` (
  `Id_prestamo` int(11) NOT NULL,
  `Id_libro` int(11) NOT NULL,
  `Descripcion` varchar(80) NOT NULL,
  KEY `FK_detalle_libros` (`Id_libro`),
  KEY `FK_detalle_prestamos` (`Id_prestamo`),
  CONSTRAINT `FK_detalle_libros` FOREIGN KEY (`Id_libro`) REFERENCES `libros` (`Id_libro`),
  CONSTRAINT `FK_detalle_prestamos` FOREIGN KEY (`Id_prestamo`) REFERENCES `prestamos` (`Id_prestamo`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla biblioteca.detalle: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `detalle` DISABLE KEYS */;
INSERT IGNORE INTO `detalle` (`Id_prestamo`, `Id_libro`, `Descripcion`) VALUES
	(1, 4, 'Libro en buen estado'),
	(2, 8, 'Libro en buen estado'),
	(3, 9, 'Libro en buen estado'),
	(4, 12, 'Libro en buen estado'),
	(5, 12, 'Libro en buen estado'),
	(6, 3, 'Libro en buen estado'),
	(7, 15, 'Libro en buen estado');
/*!40000 ALTER TABLE `detalle` ENABLE KEYS */;

-- Volcando estructura para tabla biblioteca.empleados
CREATE TABLE IF NOT EXISTS `empleados` (
  `Id_empleado` int(11) NOT NULL AUTO_INCREMENT,
  `Id_persona` int(11) NOT NULL,
  `Id_puesto` int(11) NOT NULL,
  `Fecha_contratacion` date NOT NULL,
  `Activo` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`Id_empleado`),
  KEY `FK_empleados_puesto` (`Id_puesto`),
  KEY `FK_empleados_personas` (`Id_persona`),
  CONSTRAINT `FK_empleados_personas` FOREIGN KEY (`Id_persona`) REFERENCES `personas` (`Id_persona`),
  CONSTRAINT `FK_empleados_puesto` FOREIGN KEY (`Id_puesto`) REFERENCES `puesto` (`Id_puesto`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla biblioteca.empleados: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `empleados` DISABLE KEYS */;
INSERT IGNORE INTO `empleados` (`Id_empleado`, `Id_persona`, `Id_puesto`, `Fecha_contratacion`, `Activo`) VALUES
	(1, 1, 2, '2020-06-01', 1),
	(2, 5, 2, '2020-06-25', 1),
	(3, 6, 2, '2020-06-30', 1);
/*!40000 ALTER TABLE `empleados` ENABLE KEYS */;

-- Volcando estructura para tabla biblioteca.libros
CREATE TABLE IF NOT EXISTS `libros` (
  `Id_libro` int(11) NOT NULL AUTO_INCREMENT,
  `Titulo` varchar(50) NOT NULL,
  `Copias` int(1) NOT NULL,
  `Editorial` varchar(30) NOT NULL,
  `Fecha_edicion` date DEFAULT NULL,
  `Categoria` varchar(30) NOT NULL,
  `Estante` int(1) NOT NULL,
  `Activo` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`Id_libro`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla biblioteca.libros: ~21 rows (aproximadamente)
/*!40000 ALTER TABLE `libros` DISABLE KEYS */;
INSERT IGNORE INTO `libros` (`Id_libro`, `Titulo`, `Copias`, `Editorial`, `Fecha_edicion`, `Categoria`, `Estante`, `Activo`) VALUES
	(1, 'los 3 cerditos', 3, 'Trillas', '2020-06-24', 'Cuentos infantiles', 1, 1),
	(2, 'Pinocho', 3, 'Trillas', '2020-06-24', 'Cuentos ', 2, 1),
	(3, 'Los frijoles magicos', 3, 'Trillas', '2020-06-24', 'Cuentos ', 3, 1),
	(4, 'Base de datos', 2, 'Trillas', '2020-06-24', 'Informática', 2, 1),
	(5, 'POO', 2, 'Omega', '2020-06-24', 'Informática', 3, 1),
	(6, 'Frances', 3, 'Trillas', '2020-06-24', 'Idiomas', 3, 1),
	(7, 'Álgebra', 3, 'Omega', '2020-06-24', 'Matemáticas', 3, 1),
	(8, 'Cálculo', 3, 'Omega', '2020-06-24', 'Matemáticas', 3, 1),
	(9, 'Programación', 3, 'Trillas', '2020-06-24', 'Informática', 1, 1),
	(10, 'Anatomia', 2, 'Trillas', '2020-06-24', 'Salud', 1, 1),
	(12, 'Los frijoles magicos', 1, 'Omega', '2020-06-24', 'Matemáticas', 1, 1),
	(13, 'Ingles 2', 3, 'Trillas', '2020-06-24', 'Idiomas', 1, 1),
	(14, 'Ingles 3', 3, 'Omega', '2020-06-24', 'Idiomas', 3, 1),
	(15, 'HTML 5', 3, 'Omega', '2020-06-24', 'Informática', 3, 1),
	(16, 'HTML 3', 1, 'Omega', '2020-06-24', 'Informática', 2, 1),
	(17, 'Caperucita roja', 3, 'Omega', '2020-06-24', 'Cuentos ', 2, 1),
	(19, 'Los frijoles magicos', 3, 'Omega', '2020-06-24', 'Matemáticas', 5, 1),
	(22, 'Base de datos', 3, 'Trillas', '2020-06-24', 'Idiomas', 3, 1),
	(23, 'Ingles 2', 3, 'Omega', '2020-06-09', 'Matemáticas', 2, 1),
	(24, 'Ingles 3', 3, 'Omega', '2020-06-24', 'Informática', 1, 1),
	(25, 'La casa de piedra', 3, 'Omega', '2020-06-24', 'Cuentos ', 3, 1);
/*!40000 ALTER TABLE `libros` ENABLE KEYS */;

-- Volcando estructura para tabla biblioteca.personas
CREATE TABLE IF NOT EXISTS `personas` (
  `Id_persona` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(40) NOT NULL,
  `Barrio` varchar(16) NOT NULL,
  `Calle` varchar(16) NOT NULL,
  `Numero` int(3) unsigned DEFAULT NULL,
  `Estado` varchar(18) NOT NULL,
  `Ciudad` varchar(18) NOT NULL,
  `Sexo` varchar(9) NOT NULL,
  `Fecha_nacimiento` date NOT NULL,
  `Telefono` varchar(10) NOT NULL,
  `Correo` varchar(50) DEFAULT NULL,
  `Activo` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`Id_persona`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla biblioteca.personas: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `personas` DISABLE KEYS */;
INSERT IGNORE INTO `personas` (`Id_persona`, `Nombre`, `Barrio`, `Calle`, `Numero`, `Estado`, `Ciudad`, `Sexo`, `Fecha_nacimiento`, `Telefono`, `Correo`, `Activo`) VALUES
	(1, 'Miguel de Jesús López López ', 'Bonampack', 'Yaxchilan', 18, 'Chiapas', 'Ocosingo', 'Masculino', '2001-07-07', '9191936817', 'shippudenmigue@gmial.com', 1),
	(2, 'Alfredo Gómez López', 'Nuevo', 'Avenidad', 5, 'Chiapas', 'Ocosingo', 'Masculino', '2001-07-07', '9191936817', 'jesuslpz@gmail.com', 1),
	(3, 'Esther López Cruz', 'Bonampack', 'Avenidad', 6, 'Chiapas', 'Ocosingo', 'Masculino', '2020-06-24', '9191936817', 'lopez@gmail.com', 1),
	(4, 'Pedro López Gómez', 'Bonampack', 'Yaxchilan', 2, 'Chiapas', 'Ocosingo', 'Masculino', '2020-06-24', '9191936817', 'jesuslpz@gmail.com', 1),
	(5, 'pedro lopez', 'Bonampack', 'Yaxchilan', 1, 'Chiapas', 'Ocosingo', 'Femenino', '2020-07-05', '9191936817', 'jesuslpz@gmail.com', 1),
	(6, 'Enrique lopez', 'Nuevo', 'Avenidad', 18, 'Chiapas', 'Ocosingo', 'Masculino', '1995-10-13', '9191570217', '', 1);
/*!40000 ALTER TABLE `personas` ENABLE KEYS */;

-- Volcando estructura para tabla biblioteca.prestamos
CREATE TABLE IF NOT EXISTS `prestamos` (
  `Id_prestamo` int(11) NOT NULL AUTO_INCREMENT,
  `Id_empleado` int(11) NOT NULL,
  `Id_persona` int(11) NOT NULL,
  `Cantidad` int(1) NOT NULL,
  `Identificacion` varchar(20) NOT NULL,
  `Fecha_prestamo` date NOT NULL,
  `Fecha_devolucion` date NOT NULL,
  `Estatus` varchar(9) NOT NULL,
  PRIMARY KEY (`Id_prestamo`),
  KEY `FK__empleados` (`Id_empleado`),
  KEY `FK_prestamos_personas` (`Id_persona`),
  CONSTRAINT `FK__empleados` FOREIGN KEY (`Id_empleado`) REFERENCES `empleados` (`Id_empleado`),
  CONSTRAINT `FK_prestamos_personas` FOREIGN KEY (`Id_persona`) REFERENCES `personas` (`Id_persona`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla biblioteca.prestamos: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `prestamos` DISABLE KEYS */;
INSERT IGNORE INTO `prestamos` (`Id_prestamo`, `Id_empleado`, `Id_persona`, `Cantidad`, `Identificacion`, `Fecha_prestamo`, `Fecha_devolucion`, `Estatus`) VALUES
	(1, 1, 4, 1, 'Credencial', '2020-07-14', '2020-07-11', 'Entregado'),
	(2, 2, 6, 1, 'Credencial', '2020-07-20', '2020-07-23', 'Pendiente'),
	(3, 1, 2, 1, 'Credencial', '2020-07-18', '2020-07-20', 'Pendiente'),
	(4, 1, 3, 1, 'Credencial', '2020-07-17', '2020-07-20', 'Pendiente'),
	(5, 1, 2, 1, 'Credencial', '2020-07-18', '2020-07-21', 'Pendiente'),
	(6, 1, 4, 1, 'Credencial', '2020-07-19', '2020-07-24', 'Pendiente'),
	(7, 1, 3, 1, 'Credencial', '2020-07-15', '2020-07-18', 'Entregado');
/*!40000 ALTER TABLE `prestamos` ENABLE KEYS */;

-- Volcando estructura para tabla biblioteca.puesto
CREATE TABLE IF NOT EXISTS `puesto` (
  `Id_puesto` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(15) NOT NULL,
  `Activo` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`Id_puesto`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla biblioteca.puesto: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `puesto` DISABLE KEYS */;
INSERT IGNORE INTO `puesto` (`Id_puesto`, `Descripcion`, `Activo`) VALUES
	(1, 'Supervisor', 1),
	(2, 'Encargado', 1);
/*!40000 ALTER TABLE `puesto` ENABLE KEYS */;

-- Volcando estructura para tabla biblioteca.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `Id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `Id_empleado` int(11) NOT NULL,
  `Nombre_usuario` varchar(16) NOT NULL,
  `Password` varchar(16) NOT NULL,
  `Activo` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`Id_usuario`),
  KEY `FK_usuarios_empleados` (`Id_empleado`),
  CONSTRAINT `FK_usuarios_empleados` FOREIGN KEY (`Id_empleado`) REFERENCES `empleados` (`Id_empleado`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla biblioteca.usuarios: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT IGNORE INTO `usuarios` (`Id_usuario`, `Id_empleado`, `Nombre_usuario`, `Password`, `Activo`) VALUES
	(1, 1, 'js', 'js', b'1'),
	(2, 2, 'jss', 'pedro', b'1'),
	(3, 3, 'jose', 'chepe', b'1');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
