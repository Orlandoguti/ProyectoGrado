-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Volcando estructura para tabla proyecto_grado.cargos
CREATE TABLE IF NOT EXISTS `cargos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `condicion` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla proyecto_grado.cargos: ~5 rows (aproximadamente)
INSERT INTO `cargos` (`id`, `nombre`, `descripcion`, `condicion`) VALUES
	(0, 'Sin Cargo', 'Usuario sin cargo', 1),
	(1, 'Administrador de Area', 'Se encarga de administrar todas las areas de trabajo.', 1),
	(2, 'Arreador', 'Se encarga de gestionar los ganados registrar.', 1),
	(3, 'Faeneador', 'Se encarga de gestionar los ganados registrar.', 1);

-- Volcando estructura para tabla proyecto_grado.clasegresos
CREATE TABLE IF NOT EXISTS `clasegresos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `detalle` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'Sin Detalles',
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Volcando datos para la tabla proyecto_grado.clasegresos: ~4 rows (aproximadamente)
INSERT INTO `clasegresos` (`id`, `nombre`, `detalle`, `updated_at`, `created_at`) VALUES
	(7, 'Mantenimiento', 'Egreso para Mantenimiento de Equipos', '2023-08-24 21:42:19', '2023-08-24 21:42:19'),
	(8, 'Sueldos', 'Sin Detalles', '2023-08-24 22:32:14', '2023-08-24 22:32:15'),
	(9, 'Aniversarios', 'Aniversarios de la Institucion', '2023-08-28 20:14:37', '2023-08-28 20:14:37'),
	(10, 'Colas', 'Pago de Dinero de colas a Afiliados', '2023-08-28 20:15:16', '2023-08-28 20:15:16');

-- Volcando estructura para tabla proyecto_grado.detalle_listas
CREATE TABLE IF NOT EXISTS `detalle_listas` (
  `id` int(9) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `idpersona` int unsigned DEFAULT NULL,
  `detalle` varchar(350) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idpersona` (`idpersona`),
  CONSTRAINT `FK_detalle_listas_personas` FOREIGN KEY (`idpersona`) REFERENCES `personas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=279 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla proyecto_grado.detalle_listas: ~0 rows (aproximadamente)
INSERT INTO `detalle_listas` (`id`, `idpersona`, `detalle`, `fecha`, `created_at`, `updated_at`) VALUES
	(000000277, 52, '{"registros":[{"idingreso":10563,"cantidad":1,"total":24,"idgrupo":1,"fecha":"2023-10-12"},{"idingreso":10564,"cantidad":1,"total":24,"idgrupo":1,"fecha":"2023-10-12"},{"idingreso":10565,"cantidad":1,"total":24,"idgrupo":1,"fecha":"2023-10-12"}]}', '2023-10-12', '2023-10-12 23:07:24', '2023-10-12 23:07:24'),
	(000000278, 62, '{"registros":[{"idingreso":10566,"cantidad":1,"total":24,"idgrupo":1,"fecha":"2023-10-15"}]}', '2023-10-15', '2023-10-15 15:10:37', '2023-10-15 15:10:37');

-- Volcando estructura para tabla proyecto_grado.egresos
CREATE TABLE IF NOT EXISTS `egresos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idclasegreso` int DEFAULT NULL,
  `egreso` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `monto` int DEFAULT NULL,
  `respaldo` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `descripcion` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'Sin Detalles',
  `fecha` date DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idclasegreso` (`idclasegreso`),
  CONSTRAINT `FK1_idclasegreso` FOREIGN KEY (`idclasegreso`) REFERENCES `clasegresos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla proyecto_grado.egresos: ~10 rows (aproximadamente)
INSERT INTO `egresos` (`id`, `idclasegreso`, `egreso`, `monto`, `respaldo`, `descripcion`, `fecha`, `updated_at`, `created_at`) VALUES
	(96, 7, 'Sueldo Mes de Agosto', 35, '1694309237_My project-1.png', 'Sin Detalles', '2023-09-09', '2023-09-10 01:27:17', '2023-09-10 01:27:17'),
	(97, 10, 'Desenbolso para Pago de Colas', 700, '1696287748_toro2der-removebg-preview.png', 'Sin Detalles', '2023-10-02', '2023-10-02 23:02:28', '2023-10-02 23:02:28'),
	(98, 7, 'qweqw', 123, '1697072473_1693361733_ANA APAZA EJEMPLO TRABAJO DE GRADO.docx', 'asdasd', '2023-10-11', '2023-10-12 01:01:13', '2023-10-12 01:01:13'),
	(99, 10, 'adasdas', 0, '1697072900_Avatar-Profile-PNG-Image-File.png', 'asdasdas', '2023-10-11', '2023-10-12 01:08:20', '2023-10-12 01:08:20'),
	(100, 10, '123123', 123, '1697073089_pngwing.com.png', 'asdasd', '2023-10-11', '2023-10-12 01:11:29', '2023-10-12 01:11:29'),
	(101, 10, 'asdsad', 123, '1697073258_DOCUMENTO FINAL DE PROYECTO DE GRADO - DEYNAR ADIR MAMANI TANGARA.pdf', 'asdasd', '2023-10-11', '2023-10-12 01:14:18', '2023-10-12 01:14:18'),
	(102, 10, 'asdasd', 123, '1697073321_My project-1.jpg', 'adasd', '2023-10-11', '2023-10-12 01:15:21', '2023-10-12 01:15:21'),
	(103, 9, 'asdasd', 123, '1697073696_toro2der-removebg-preview.png', 'adasd', '2023-10-11', '2023-10-12 01:21:36', '2023-10-12 01:21:36'),
	(104, 7, '22222', 12, '1697073743_toro2der-removebg-preview.png', '2222', '2023-10-11', '2023-10-12 01:22:23', '2023-10-12 01:22:23'),
	(105, 10, 'cccc', 123, '1697073830_My project-1.png', 'ccccc', '2023-10-11', '2023-10-12 01:23:50', '2023-10-12 01:23:50');

-- Volcando estructura para tabla proyecto_grado.generos
CREATE TABLE IF NOT EXISTS `generos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla proyecto_grado.generos: ~3 rows (aproximadamente)
INSERT INTO `generos` (`id`, `nombre`) VALUES
	(0, 'No Encontrado'),
	(1, 'Toro'),
	(2, 'Vaca');

-- Volcando estructura para tabla proyecto_grado.grupos
CREATE TABLE IF NOT EXISTS `grupos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `detalle` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'Sin Detalles',
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla proyecto_grado.grupos: ~7 rows (aproximadamente)
INSERT INTO `grupos` (`id`, `nombre`, `detalle`, `updated_at`, `created_at`) VALUES
	(0, 'Sin Asignar', 'Sin Detalles', '2023-08-23 22:17:55', '2023-08-23 22:17:56'),
	(1, 'Grupo 1', 'Grupo 1 de Faeneo', '2023-08-23 22:17:57', '2023-08-23 22:17:57'),
	(2, 'Grupo 2', 'Grupo 2 de Faeneo', '2023-08-23 22:17:58', '2023-08-23 22:17:57'),
	(3, 'Grupo 3', 'Grupo 3 de Faeneo', '2023-08-23 22:17:58', '2023-08-23 22:17:59'),
	(4, 'Grupo 4', 'Grupo 4 de Faeneo', '2023-08-23 22:18:00', '2023-08-23 22:17:59'),
	(5, 'Grupo 5', 'Grupo 5 de Faeneo', '2023-08-23 22:25:17', '2023-08-23 22:25:19'),
	(6, 'Grupo 6', 'Grupo 6 de Faeneo', '2023-08-23 22:30:17', '2023-08-23 22:30:17');

-- Volcando estructura para tabla proyecto_grado.informaciones
CREATE TABLE IF NOT EXISTS `informaciones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idpersona` int unsigned DEFAULT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `contenido` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_persona` (`idpersona`) USING BTREE,
  CONSTRAINT `FK_informaciones_personas` FOREIGN KEY (`idpersona`) REFERENCES `personas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla proyecto_grado.informaciones: ~6 rows (aproximadamente)
INSERT INTO `informaciones` (`id`, `idpersona`, `titulo`, `contenido`, `fecha`) VALUES
	(8, 1, 'Paro Civico 15/08/2023', 'agwqweascz123124151', '2023-09-25'),
	(9, 1, 'APMPLIADO JUEVES  08/08/2023', '12456', '2023-09-25'),
	(10, 1, 'HolA', '123456', '2023-09-25'),
	(11, 1, 'papappa', '123456', '2023-09-25'),
	(13, 1, 'papappa123124', 'asdasdasdas', '2023-09-25');

-- Volcando estructura para tabla proyecto_grado.listas
CREATE TABLE IF NOT EXISTS `listas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idgrupo` int NOT NULL DEFAULT '0',
  `idpersona` int unsigned NOT NULL,
  `idgenero` int DEFAULT '0',
  `estado` int DEFAULT NULL,
  `cantidad` int DEFAULT NULL,
  `total` int DEFAULT NULL,
  `cantidad_registrada` int DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_persona` (`idpersona`) USING BTREE,
  KEY `grupo` (`idgrupo`),
  KEY `idgenero` (`idgenero`),
  CONSTRAINT `grupo_ibfk_2` FOREIGN KEY (`idgrupo`) REFERENCES `grupos` (`id`),
  CONSTRAINT `idgenero` FOREIGN KEY (`idgenero`) REFERENCES `generos` (`id`),
  CONSTRAINT `listas_ibfk_1` FOREIGN KEY (`idpersona`) REFERENCES `personas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10567 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Volcando datos para la tabla proyecto_grado.listas: ~2 rows (aproximadamente)
INSERT INTO `listas` (`id`, `idgrupo`, `idpersona`, `idgenero`, `estado`, `cantidad`, `total`, `cantidad_registrada`, `fecha`, `created_at`, `updated_at`) VALUES
	(10563, 1, 52, 0, 0, 1, 24, 1, '2023-10-12', '2023-10-12 23:07:24', '2023-10-12 23:07:24'),
	(10564, 1, 52, 0, 0, 1, 24, 1, '2023-10-12', '2023-10-12 23:07:24', '2023-10-12 23:07:24'),
	(10565, 1, 52, 0, 0, 1, 24, 1, '2023-10-12', '2023-10-12 23:07:24', '2023-10-12 23:07:24'),
	(10566, 1, 62, 1, 1, 0, 24, 1, '2023-10-15', '2023-10-15 15:10:37', '2023-10-15 15:12:17');

-- Volcando estructura para tabla proyecto_grado.noticias
CREATE TABLE IF NOT EXISTS `noticias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idpersona` int unsigned DEFAULT NULL,
  `imagen` varchar(250) DEFAULT NULL,
  `titulo` varchar(250) DEFAULT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_persona` (`idpersona`) USING BTREE,
  CONSTRAINT `FK_noticias_personas` FOREIGN KEY (`idpersona`) REFERENCES `personas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla proyecto_grado.noticias: ~5 rows (aproximadamente)
INSERT INTO `noticias` (`id`, `idpersona`, `imagen`, `titulo`, `descripcion`, `fecha`) VALUES
	(1, 1, '1691195752_futecra-8-nov.jpg', 'Marcha 6 de Marzo', 'Este Lunes 6 de marzo se realizo la marcha por las fiestas patrias al rededor de la avenida 6 de marzo rumbo ala plaza libertad de la 16 de julio.', NULL),
	(3, 1, '1691196027_futecra-El-Alto.png', 'Festividad 06 de Marzo', 'Se tiene el agradecimiento de toda la poblacion para las festividades del dia de la paz.', NULL),
	(4, 1, '1691196114_0000_CARNE_EL_ALTO.jpg', 'Carne de Altura', 'Hoy 05 de mayo nos visita el canal 11 Red Uno para presentar la carne de primera que ofrecemos en el Matadero Municipal de Los Andes.', NULL),
	(5, 1, '1691196221_alcaldesa-con-medios-PRENSA-RENUEVA..jpeg', 'Visita de La Alcaldesa', 'Hoy 17 de Mayo nos visita la alcaldesa de el Alto en la inaguracion del campeonato interno que se realizara en el Establecimiento.', NULL),
	(8, 1, '1691196348_eva-futecra-scaled.jpg', 'Campeones de F.U.T.E.C.R.A', 'Hoy celebramos el triunfo de la sociedad Tiendas y Friales en el campeonato del Matadero Municipal de los Andes junto a nuestra alcaldesa Eva Copa.', NULL);

-- Volcando estructura para tabla proyecto_grado.personas
CREATE TABLE IF NOT EXISTS `personas` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idcargo` int DEFAULT NULL,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `marca` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_documento` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imagen` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personas_nombre_unique` (`nombre`),
  KEY `idcargo` (`idcargo`),
  CONSTRAINT `FK_personas_cargos` FOREIGN KEY (`idcargo`) REFERENCES `cargos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla proyecto_grado.personas: ~12 rows (aproximadamente)
INSERT INTO `personas` (`id`, `idcargo`, `nombre`, `marca`, `num_documento`, `direccion`, `telefono`, `imagen`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Orlando Marvin Gutierrez Hidalgo', 'Sin Marca', '13116407', 'Z: Pedro Domingo Murillo', '69849349', 'orlando.jpg', '2023-07-26 14:12:26', '2023-10-12 23:26:54'),
	(42, 0, 'Milenka Pocoaca Mmani', 'MP', '13085252', 'Pedro Domingo Murillo', '67023449', 'avatarafiliado.png', '2023-07-29 01:12:36', '2023-07-29 01:12:36'),
	(43, 2, 'Cristian Condori Suxo', 'Sin Marca', '100452455', 'Vinto', '62345458', 'avatartrabajador.png', '2023-07-29 01:49:05', '2023-07-29 01:49:05'),
	(44, 0, 'Jhonatan Luis Gutierrez Hidalgo', 'JG', '13116405', 'Pedro Domingo Murillo', '69849349', 'avatarafiliado.png', '2023-07-29 01:50:39', '2023-07-29 01:50:39'),
	(45, 3, 'Deynar Adir Mamani Tangara', 'Sin Marca', '15451452', 'Senkata', '69849349', 'avatartrabajador.png', '2023-07-29 01:58:33', '2023-07-29 01:58:33'),
	(48, 0, 'Javier Figueredo Choque', 'JF', '12457565', 'Santiago II', '62548145', 'avatarafiliado.png', '2023-07-29 02:01:34', '2023-07-29 02:01:34'),
	(51, 0, 'Deynar Adir Mamani Colque', 'DAT', '15156446', 'Senkata', '69849349', 'avatarafiliado.png', '2023-08-15 21:44:13', '2023-08-15 21:44:13'),
	(52, 0, 'Ariel Wilson Hidalgo', 'AW', '12345648', '16 de Julio', '69849349', 'avatarafiliado.png', '2023-08-15 21:45:27', '2023-08-15 21:45:27'),
	(54, 2, 'Roberto', 'Sin Marca', '13116407', 'Z:Ballivian', '69849349', 'avatartrabajador.png', '2023-10-13 01:05:01', '2023-10-13 01:05:01'),
	(55, 2, 'Nombre Haaaa', 'Sin Marca', '12345678', '12345678', '12345678', 'avatartrabajador.png', '2023-10-13 01:23:24', '2023-10-13 01:23:24'),
	(56, NULL, 'Pepito Perez', 'PP', '13085252', 'Z:Villa Tunari', '67023449', 'avatarafiliado.png', '2023-10-13 01:40:39', '2023-10-13 01:40:39'),
	(59, 3, 'Pepito Perez Perez', 'Sin Marca', '11111111', 'iiiiiiiiii', '11111111', 'avatartrabajador.png', '2023-10-13 01:45:54', '2023-10-13 01:45:54'),
	(60, NULL, 'Alaaa Usss', 'AU', '12345678', '123456ASD', '11111111', 'avatarafiliado.png', '2023-10-13 01:48:23', '2023-10-13 01:48:23'),
	(61, 2, 'Jorge Parrra', 'Sin Marca', '12345678', 'Zona:Villa Bala', '12345678', 'avatartrabajador.png', '2023-10-13 03:27:36', '2023-10-13 03:29:58'),
	(62, NULL, 'Janeth Flora Hidallgo', 'JGF', '12457841', 'Z: Villa Tunari', '62293735', 'avatarafiliado.png', '2023-10-15 15:02:28', '2023-10-15 15:02:28');

-- Volcando estructura para tabla proyecto_grado.rfids
CREATE TABLE IF NOT EXISTS `rfids` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idrfid` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `idpersona` int unsigned DEFAULT NULL,
  `idgenero` int DEFAULT NULL,
  `idgrupo` int DEFAULT '0',
  `asignado` int DEFAULT NULL,
  `estado` int DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `idregistro` int unsigned DEFAULT NULL,
  `idprocesofaeneo` int unsigned DEFAULT NULL,
  `idfaeneo` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_persona` (`idpersona`) USING BTREE,
  KEY `idgenero` (`idgenero`),
  KEY `idgrupo` (`idgrupo`),
  KEY `idregistro` (`idregistro`),
  KEY `idprocesofaeneo` (`idprocesofaeneo`),
  KEY `idfaeneo` (`idfaeneo`),
  CONSTRAINT `FK1_id_persona` FOREIGN KEY (`idpersona`) REFERENCES `personas` (`id`),
  CONSTRAINT `FK2_id_genero` FOREIGN KEY (`idgenero`) REFERENCES `generos` (`id`),
  CONSTRAINT `FK3_id_grupo` FOREIGN KEY (`idgrupo`) REFERENCES `grupos` (`id`),
  CONSTRAINT `id_faeneo` FOREIGN KEY (`idfaeneo`) REFERENCES `personas` (`id`),
  CONSTRAINT `id_procesofaeneo` FOREIGN KEY (`idprocesofaeneo`) REFERENCES `personas` (`id`),
  CONSTRAINT `id_registro` FOREIGN KEY (`idregistro`) REFERENCES `personas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Volcando datos para la tabla proyecto_grado.rfids: ~32 rows (aproximadamente)
INSERT INTO `rfids` (`id`, `idrfid`, `idpersona`, `idgenero`, `idgrupo`, `asignado`, `estado`, `fecha`, `created_at`, `updated_at`, `idregistro`, `idprocesofaeneo`, `idfaeneo`) VALUES
	(56, '0000AW', 52, 1, 1, 1, 2, '2023-09-09', '2023-09-10 00:36:30', '2023-09-10 00:37:11', 1, NULL, NULL),
	(57, '0001AW', 52, 2, 2, 1, 2, '2023-09-09', '2023-09-10 00:36:42', '2023-09-10 00:37:11', 1, NULL, NULL),
	(58, '0002AW', 52, 2, 3, 1, 2, '2023-09-09', '2023-09-10 00:36:55', '2023-09-10 00:37:11', 1, NULL, NULL),
	(59, '0002AW', 52, 2, 4, 1, 2, '2023-09-09', '2023-09-10 00:36:55', '2023-09-10 00:57:40', 1, NULL, NULL),
	(60, '0002AW', 52, 1, 1, 1, 2, '2023-09-09', '2023-09-10 00:36:55', '2023-09-10 00:57:40', 1, NULL, NULL),
	(61, '0002AW', 52, 1, 2, 1, 0, '2023-09-09', '2023-09-10 00:36:55', '2023-09-10 00:57:40', 1, NULL, NULL),
	(62, '000MP', 42, 1, 0, 1, 0, '2023-09-10', '2023-09-10 22:27:18', '2023-09-10 22:27:18', 1, NULL, NULL),
	(63, '0002MP', 42, 2, 0, 1, 0, '2023-09-10', '2023-09-10 22:28:07', '2023-09-10 22:28:07', 1, NULL, NULL),
	(64, '0000AW', 52, 1, 0, 1, 0, '2023-09-10', '2023-09-10 22:28:17', '2023-09-10 22:39:15', 1, NULL, NULL),
	(66, 'B6EEC1F7', 48, 1, 0, 1, 0, '2023-10-09', '2023-10-10 00:24:27', '2023-10-10 00:24:27', 1, NULL, NULL),
	(67, '0aaa', NULL, NULL, 0, 0, 0, '2023-10-09', '2023-10-10 00:26:58', '2023-10-10 00:26:58', 1, NULL, NULL),
	(68, 'asdasda', 52, NULL, 0, 1, 0, '2023-10-09', '2023-10-10 00:27:11', '2023-10-10 00:27:11', 1, NULL, NULL),
	(69, 'asdasdas', 44, 1, 0, 1, 0, '2023-10-09', '2023-10-10 00:27:27', '2023-10-10 22:42:42', 1, NULL, NULL),
	(70, '0asdas', NULL, NULL, 0, 0, 0, '2023-10-09', '2023-10-10 00:27:34', '2023-10-10 00:27:34', 1, NULL, NULL),
	(71, 'asdq31231', 52, NULL, 0, 1, 0, '2023-10-09', '2023-10-10 00:28:09', '2023-10-10 00:28:09', 1, NULL, NULL),
	(72, 'B6EEC1F71', 51, 1, 0, 1, 0, '2023-10-09', '2023-10-10 00:33:28', '2023-10-10 00:33:28', 1, NULL, NULL),
	(73, 'B6EEC1F72', 51, 1, 0, 1, 0, '2023-10-09', '2023-10-10 00:36:36', '2023-10-10 00:36:36', 1, NULL, NULL),
	(74, '123124124', 51, 1, 0, 1, 0, '2023-10-09', '2023-10-10 00:44:06', '2023-10-10 00:44:06', 1, NULL, NULL),
	(75, '1235dsfsdfsd', 51, 1, 0, 1, 0, '2023-10-09', '2023-10-10 00:45:22', '2023-10-10 00:45:22', 1, NULL, NULL),
	(76, '123214', 51, 2, 0, 1, 0, '2023-10-09', '2023-10-10 00:48:03', '2023-10-10 00:48:03', 1, NULL, NULL),
	(77, '123124', 51, 2, 0, 1, 0, '2023-10-09', '2023-10-10 00:49:05', '2023-10-10 00:49:05', 1, NULL, NULL),
	(78, '123124asdasdasd', 51, 2, 0, 1, 0, '2023-10-09', '2023-10-10 00:57:58', '2023-10-10 00:57:58', 1, NULL, NULL),
	(79, '123124124asdasd', 51, 1, 0, 1, 0, '2023-10-09', '2023-10-10 01:07:00', '2023-10-10 01:07:00', 1, NULL, NULL),
	(80, '123qwer', 52, 2, 0, 1, 0, '2023-10-09', '2023-10-10 01:10:21', '2023-10-10 01:10:21', 1, NULL, NULL),
	(81, 'nmvcbnc', 51, 1, 0, 1, 0, '2023-10-09', '2023-10-10 01:13:35', '2023-10-10 01:13:35', 1, NULL, NULL),
	(82, 'lkhjkh', 51, 2, 0, 1, 0, '2023-10-09', '2023-10-10 01:16:15', '2023-10-10 12:45:35', 1, NULL, NULL),
	(83, 'MMMP123', 42, 1, 0, 1, 0, '2023-10-09', '2023-10-10 01:17:09', '2023-10-10 01:17:09', 1, NULL, NULL),
	(84, 'B6EEC1F77', 51, 1, 0, 1, 0, '2023-10-09', '2023-10-10 01:19:14', '2023-10-10 12:45:35', 1, NULL, NULL),
	(85, 'B6EEC1F777123', 51, 1, 0, 1, 0, '2023-10-09', '2023-10-10 01:20:05', '2023-10-10 12:45:35', 1, NULL, NULL),
	(86, '00005G', 51, 1, 0, 1, 0, '2023-10-10', '2023-10-10 20:56:56', '2023-10-10 21:46:53', 1, NULL, NULL),
	(96, 'asdasdas123', 56, 1, 0, 0, 0, '2023-10-14', '2023-10-14 12:11:39', '2023-10-14 12:11:39', 1, NULL, NULL),
	(97, 'D08F6E32', 62, 1, 1, 2, 2, '2023-10-15', '2023-10-15 15:08:12', '2023-10-15 15:12:48', 1, 1, 1);

-- Volcando estructura para tabla proyecto_grado.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_nombre_unique` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla proyecto_grado.roles: ~3 rows (aproximadamente)
INSERT INTO `roles` (`id`, `nombre`, `descripcion`, `condicion`) VALUES
	(1, 'Administrador', 'Administradores del Sistema', 1),
	(2, 'Trabajador', 'Trabajadores del Matadero', 1),
	(3, 'Afiliado', 'Afiliados del Matadero', 1);

-- Volcando estructura para tabla proyecto_grado.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int unsigned NOT NULL,
  `idrol` int unsigned NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  UNIQUE KEY `email` (`email`),
  KEY `users_id_foreign` (`id`),
  KEY `idrol` (`idrol`),
  CONSTRAINT `FK_users_roles` FOREIGN KEY (`idrol`) REFERENCES `roles` (`id`),
  CONSTRAINT `users_id_foreign` FOREIGN KEY (`id`) REFERENCES `personas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla proyecto_grado.users: ~14 rows (aproximadamente)
INSERT INTO `users` (`id`, `idrol`, `email`, `password`, `condicion`, `remember_token`) VALUES
	(1, 1, 'orlandoguti698@gmail.com', '$2y$10$kGNjUHYP0GrXx5ihKRF0uuTbCgzmF0ZnvzRXtQFrBBt/KyTTuSVcy', 1, NULL),
	(42, 3, 'milenkapocoaca18@gmail.com', '$2y$10$FfvD2RpRCjlkU92/K3xkm.sbTA7.d/7KcfbRZ7xPVB1xrudtI/iWq', 1, NULL),
	(43, 2, 'cris@gmail.com', '$2y$10$5rH2fDauuJ/VldI9F.QXCuZnSVyvRYtqLC2kQEZdpANoURFnXBG32', 1, NULL),
	(44, 3, 'jonathan@gmail.com', '$2y$10$6.3DohbbvA4QH7rskL3sD.TRoI8pZxcjXNiLRRznyWlzUgyW14596', 1, NULL),
	(45, 2, 'deynar@gmail.com', '$2y$10$ZVyQDnOkIB0Wbww8NI1aruOtqxEoqBOPTZF.a8QPGx.X4.McqHRAS', 1, NULL),
	(48, 3, 'javi@gmail.com', '$2y$10$beK/l8.PT0y8uZtUeSSnKeHPEWQS8RYpJDZr/E6fNETikfNQJaJoW', 1, NULL),
	(51, 3, 'deynaradir@gmail.com', '$2y$10$4O/vKTwAeu6J9UzjiMADKuXc0cs2qGHeYoa9B456ERDwyUuoGcPau', 1, NULL),
	(52, 3, 'ariel@gmail.com', '$2y$10$nNUls37HG0YnyywP.Dgzd.UfNxGRsC8BPMI.0kiN/Ir4wuB4Dtsvm', 1, NULL),
	(54, 2, 'roberto@gmail.com', '$2y$10$mec36kECkykb8fLwPZBMkejKj6fGYfiK.rF3n8TrfjPnnAzUXUchu', 1, NULL),
	(55, 2, '123456@132', '$2y$10$7GmvsdLx.PqXpOUkAvAqm.CQkGwukVEEhMhQc6kUcCveMMR6cyVBO', 1, NULL),
	(56, 3, 'pepitoperez@gmail.com', '$2y$10$qlmJAZ0DYtH4Yk8Sfvs.WOhuYCdYLBLOjeoYDJ/6nPAVobzoklu2G', 1, NULL),
	(59, 2, 'iiiiii@gmail.com', '$2y$10$t.sQ7Lpu4j7pPtNGGE2fFeGfzvMpNALvitoePpQ7R5.BeQ76lbGGi', 1, NULL),
	(60, 3, '123456@GMAIL.COM', '$2y$10$zYbD.Zkg8pAbJfMSenRO8eaD9Aaah5ObvveHTHVHBU.Nj33wjjsTu', 1, NULL),
	(61, 2, 'jorgeparra@gmail.com', '$2y$10$/c7q1S7Brq/rF4/yT0jUZ.M6uViRRwBVzkO5DGHWa37Z2ea9SuvTq', 1, NULL),
	(62, 3, 'janeth@gmail.com', '$2y$10$8Fmcf4jEWhACyPXefyka7e39Vwcpnwmx5EORrh7pyCGEmLbJXE3rO', 1, NULL);

-- Volcando estructura para tabla proyecto_grado.variables
CREATE TABLE IF NOT EXISTS `variables` (
  `egresos` int DEFAULT NULL,
  `ingresos` int DEFAULT NULL,
  `totalfaeneo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_persona` int unsigned DEFAULT NULL,
  KEY `id_persona` (`id_persona`),
  CONSTRAINT `FK_variables_personas` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla proyecto_grado.variables: ~0 rows (aproximadamente)
INSERT INTO `variables` (`egresos`, `ingresos`, `totalfaeneo`, `updated_at`, `id_persona`) VALUES
	(2835, 96, '5', '2023-10-10 21:46:37', 1);

-- Volcando estructura para disparador proyecto_grado.UpdateEgresos
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `UpdateEgresos` AFTER INSERT ON `egresos` FOR EACH ROW BEGIN
    DECLARE totalCantidad INT;

    -- Calcular la suma de la cantidad de la tabla egresos
    SELECT SUM(monto) INTO totalCantidad FROM egresos;

    -- Actualizar la variable 'egresos' en la tabla 'variables'
    UPDATE variables SET egresos = totalCantidad;
    
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Volcando estructura para disparador proyecto_grado.UpdateIngresos
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `UpdateIngresos` AFTER INSERT ON `listas` FOR EACH ROW BEGIN
    DECLARE totalCantidad INT;

    -- Calcular la suma de la cantidad de la tabla egresos
    SELECT SUM(total) INTO totalCantidad FROM listas;

    -- Actualizar la variable 'ingresos' en la tabla 'variables'
    UPDATE variables SET ingresos = totalCantidad;
    
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
