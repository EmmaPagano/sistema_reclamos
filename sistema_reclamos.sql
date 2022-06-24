-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: sistema_reclamos
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(250) NOT NULL,
  `descripcion` varchar(300) NOT NULL,
  `imgCategoria` varchar(300) NOT NULL,
  PRIMARY KEY (`idCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Alumbrado','Alumbrado público','alumbrado.png'),(2,'Animales','Animales en general','animales.png'),(3,'Arbolado','Arbolado público','arbolado.png'),(4,'Educación','Educación','educacion.png'),(5,'Espacios públicos','Espacios públicos','espaciospublicos.png'),(6,'Limpieza y recolección','Limpieza y recolección','limpiezayrecoleccion.png'),(7,'Salud','Salud','salud.png');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estados`
--

DROP TABLE IF EXISTS `estados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estados` (
  `idEstado` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(250) NOT NULL,
  PRIMARY KEY (`idEstado`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estados`
--

LOCK TABLES `estados` WRITE;
/*!40000 ALTER TABLE `estados` DISABLE KEYS */;
INSERT INTO `estados` VALUES (1,'Solicitud enviada'),(2,'En proceso de resolución'),(3,'Resuelto');
/*!40000 ALTER TABLE `estados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fotos_reclamos`
--

DROP TABLE IF EXISTS `fotos_reclamos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fotos_reclamos` (
  `idFoto` int(11) NOT NULL AUTO_INCREMENT,
  `urlFoto` varchar(250) NOT NULL,
  `idReclamo` int(11) NOT NULL,
  PRIMARY KEY (`idFoto`),
  KEY `FK_reclamo` (`idReclamo`),
  CONSTRAINT `relacion_foto_reclamo` FOREIGN KEY (`idReclamo`) REFERENCES `reclamos` (`idReclamo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fotos_reclamos`
--

LOCK TABLES `fotos_reclamos` WRITE;
/*!40000 ALTER TABLE `fotos_reclamos` DISABLE KEYS */;
INSERT INTO `fotos_reclamos` VALUES (1,'2.jpg',20002),(2,'3.jpg',20002);
/*!40000 ALTER TABLE `fotos_reclamos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reclamos`
--

DROP TABLE IF EXISTS `reclamos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reclamos` (
  `idReclamo` int(11) NOT NULL AUTO_INCREMENT,
  `idSubcategoria` int(11) NOT NULL,
  `fechaReclamo` date NOT NULL,
  `nombreVecino` varchar(250) NOT NULL,
  `dni` int(8) NOT NULL,
  `direccionReclamo` varchar(250) NOT NULL,
  `telefonoVecino` varchar(250) NOT NULL,
  `correoVecino` varchar(250) NOT NULL,
  `idEstado` int(11) NOT NULL,
  `comentario` text NOT NULL,
  PRIMARY KEY (`idReclamo`),
  KEY `FK_estado` (`idEstado`),
  KEY `FK_subcategoria` (`idSubcategoria`),
  CONSTRAINT `relacion_reclamo_estado` FOREIGN KEY (`idEstado`) REFERENCES `estados` (`idEstado`),
  CONSTRAINT `relacion_reclamo_subcategoria` FOREIGN KEY (`idSubcategoria`) REFERENCES `subcategorias` (`idSubcategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=20005 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reclamos`
--

LOCK TABLES `reclamos` WRITE;
/*!40000 ALTER TABLE `reclamos` DISABLE KEYS */;
INSERT INTO `reclamos` VALUES (20002,10,'2022-06-16','juan',0,'fddffd','dfdfddf','ddd',1,'fgfggf'),(20003,6,'2022-06-15','agustina gonzales',35000111,'av falsa 1200','2346 1544444','agustina@gmail.com',1,'sssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss'),(20004,13,'2022-05-11','Francisco JJJJJ',10849990,'Circ Gonzalez 123','011 15666666','fran@hotmaill.com',1,'hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh');
/*!40000 ALTER TABLE `reclamos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subcategorias`
--

DROP TABLE IF EXISTS `subcategorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subcategorias` (
  `idSubcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `subcategoria` varchar(250) NOT NULL,
  `descripcionSub` varchar(250) NOT NULL,
  `idCategoriaPadre` int(11) NOT NULL,
  PRIMARY KEY (`idSubcategoria`),
  KEY `FK_categoriaPadre` (`idCategoriaPadre`),
  CONSTRAINT `relacion_subcategoria_categoria` FOREIGN KEY (`idCategoriaPadre`) REFERENCES `categorias` (`idCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subcategorias`
--

LOCK TABLES `subcategorias` WRITE;
/*!40000 ALTER TABLE `subcategorias` DISABLE KEYS */;
INSERT INTO `subcategorias` VALUES (1,'Cable suelto','Cable suelto',1),(2,'Columna caída o por caerse','Columna caída o por caerse',1),(3,'Reparación de luminaria','Reparación de luminaria',1),(4,'Poda vía pública','Poda vía pública',3),(5,'Árbol seco','Árbol seco',3),(6,'Barrido','Barrido',6),(7,'Recolección de residuos','Recolección de residuos',6),(8,'Terrenos','Terrenos',6),(9,'EcoPlan','EcoPlan',6),(10,'Animales en la vía pública','Animales en la vía pública',2),(11,'Castración','Castración',2),(12,'Parque municipal','Parque municipal',5),(13,'Plazas','Plazas',5),(14,'Reparación de juegos','Reparación de juegos',5),(15,'Hospital municipal','Hospital municipal',7),(16,'Salitas','Salitas',7),(17,'Vacunación','Vacunación',7),(18,'Casa del estudiante','Casa del estudiante',4),(19,'Becas','Becas',4),(21,'Transporte gratuito a Chivilcoy','Transporte gratuito a Chivilcoy',4),(22,'Punto digital','Punto digital',4),(23,'Talleres culturales','Talleres culturales',4);
/*!40000 ALTER TABLE `subcategorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombreCompleto` varchar(250) NOT NULL,
  `dni` int(8) NOT NULL,
  `correo` varchar(250) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `password` varchar(300) NOT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Sergio Emmanuel Pagano',35101107,'emmanuel.pagano@gmail.com','2346418590','123456');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-06-24 14:24:48
