-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: bd
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.26-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cargo`
--
CREATE DATABASE bd;
USE bd;
DROP TABLE IF EXISTS `cargo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cargo` (
  `idCargos` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `nivel` int(11) NOT NULL,
  PRIMARY KEY (`idCargos`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cargo`
--

LOCK TABLES `cargo` WRITE;
/*!40000 ALTER TABLE `cargo` DISABLE KEYS */;
INSERT INTO `cargo` VALUES (1,'Desarollador',0),(2,'Administrador',1),(3,'Coordinador',2),(4,'Lider de proceso',3),(5,'Usuario demo',4);
/*!40000 ALTER TABLE `cargo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cuenta`
--

DROP TABLE IF EXISTS `cuenta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cuenta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contrasena` varchar(45) NOT NULL,
  `empleado_cedula` bigint(50) NOT NULL,
  PRIMARY KEY (`id`,`empleado_cedula`),
  KEY `fk_cuenta_empleado1_idx` (`empleado_cedula`),
  CONSTRAINT `fk_cuenta_empleado1` FOREIGN KEY (`empleado_cedula`) REFERENCES `empleado` (`cedula`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cuenta`
--

LOCK TABLES `cuenta` WRITE;
/*!40000 ALTER TABLE `cuenta` DISABLE KEYS */;
INSERT INTO `cuenta` VALUES (1,'UbcFeuR35Wcuy+vusRINTg==',123456),(2,'UbcFeuR35Wcuy+vusRINTg==',456789),(3,'UbcFeuR35Wcuy+vusRINTg==',251721),(4,'UbcFeuR35Wcuy+vusRINTg==',789123),(5,'UbcFeuR35Wcuy+vusRINTg==',1012456674),(6,'UbcFeuR35Wcuy+vusRINTg==',98092420329);
/*!40000 ALTER TABLE `cuenta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cuenta_has_registro`
--

DROP TABLE IF EXISTS `cuenta_has_registro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cuenta_has_registro` (
  `cuenta_id` int(11) NOT NULL,
  `cuenta_cedula` bigint(50) NOT NULL,
  `cuenta_idSeccional` int(11) NOT NULL,
  `cuenta_idCargos` int(11) NOT NULL,
  `registro_idRegistro` int(11) NOT NULL,
  PRIMARY KEY (`cuenta_id`,`cuenta_cedula`,`cuenta_idSeccional`,`cuenta_idCargos`,`registro_idRegistro`),
  KEY `fk_cuenta_has_registro_registro1_idx` (`registro_idRegistro`),
  KEY `fk_cuenta_has_registro_cuenta1_idx` (`cuenta_id`,`cuenta_cedula`,`cuenta_idSeccional`,`cuenta_idCargos`),
  CONSTRAINT `fk_cuenta_has_registro_cuenta1` FOREIGN KEY (`cuenta_id`) REFERENCES `cuenta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cuenta_has_registro_registro1` FOREIGN KEY (`registro_idRegistro`) REFERENCES `registro` (`idRegistro`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cuenta_has_registro`
--

LOCK TABLES `cuenta_has_registro` WRITE;
/*!40000 ALTER TABLE `cuenta_has_registro` DISABLE KEYS */;
/*!40000 ALTER TABLE `cuenta_has_registro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empleado`
--

DROP TABLE IF EXISTS `empleado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empleado` (
  `cedula` bigint(50) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `numero` varchar(45) NOT NULL,
  `sexo` varchar(3) NOT NULL,
  `idSeccional` int(11) NOT NULL,
  `idCargos` int(11) NOT NULL,
  PRIMARY KEY (`cedula`,`idSeccional`,`idCargos`),
  KEY `fk_empleado_seccional_idx` (`idSeccional`),
  KEY `fk_empleado_cargo1_idx` (`idCargos`),
  CONSTRAINT `fk_empleado_cargo1` FOREIGN KEY (`idCargos`) REFERENCES `cargo` (`idCargos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_empleado_seccional` FOREIGN KEY (`idSeccional`) REFERENCES `seccional` (`idSeccional`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleado`
--

LOCK TABLES `empleado` WRITE;
/*!40000 ALTER TABLE `empleado` DISABLE KEYS */;
INSERT INTO `empleado` VALUES (123456,'Alfredo','Rodríguez','alfredo@andreslargo.com','31234','Cll 21 ','346123','m',1,0),(456789,'Emilio','Rodríguez','emilio@andreslargo.com','1234','Cll 211 ','343','m',1,1),(789123,'Wanda','Velasquez','wanda@andreslargo.com','334','Cll 21 ','343','f',1,2),(1012456674,'José','Rodríguez','asd@andreslargo.com','3456','Cll 18 X','346','m',1,3),(98092420329,'Andres é','Cuenca Pérez','cohchino@andreslargo.com','3228456','Cll 18 B','3646','m',1,4);
/*!40000 ALTER TABLE `empleado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registro`
--

DROP TABLE IF EXISTS `registro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registro` (
  `idRegistro` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`idRegistro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registro`
--

LOCK TABLES `registro` WRITE;
/*!40000 ALTER TABLE `registro` DISABLE KEYS */;
/*!40000 ALTER TABLE `registro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registro_has_cuenta`
--

DROP TABLE IF EXISTS `registro_has_cuenta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registro_has_cuenta` (
  `registro_idRegistro` int(11) NOT NULL,
  `cuenta_id` int(11) NOT NULL,
  `cuenta_empleado_cedula` bigint(50) NOT NULL,
  PRIMARY KEY (`registro_idRegistro`,`cuenta_id`,`cuenta_empleado_cedula`),
  KEY `fk_registro_has_cuenta_cuenta1_idx` (`cuenta_id`,`cuenta_empleado_cedula`),
  KEY `fk_registro_has_cuenta_registro1_idx` (`registro_idRegistro`),
  CONSTRAINT `fk_registro_has_cuenta_cuenta1` FOREIGN KEY (`cuenta_id`, `cuenta_empleado_cedula`) REFERENCES `cuenta` (`id`, `empleado_cedula`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_registro_has_cuenta_registro1` FOREIGN KEY (`registro_idRegistro`) REFERENCES `registro` (`idRegistro`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registro_has_cuenta`
--

LOCK TABLES `registro_has_cuenta` WRITE;
/*!40000 ALTER TABLE `registro_has_cuenta` DISABLE KEYS */;
/*!40000 ALTER TABLE `registro_has_cuenta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seccional`
--

DROP TABLE IF EXISTS `seccional`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seccional` (
  `idSeccional` int(11) NOT NULL AUTO_INCREMENT,
  `ciudad` varchar(45) NOT NULL,
  `pais` varchar(45) NOT NULL,
  `departamento` varchar(45) NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `liderProceso` varchar(45) NOT NULL,
  `Tipo` varchar(45) NOT NULL,
  PRIMARY KEY (`idSeccional`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seccional`
--

LOCK TABLES `seccional` WRITE;
/*!40000 ALTER TABLE `seccional` DISABLE KEYS */;
INSERT INTO `seccional` VALUES (1,'Bogotá','Colombia','Distrito especial','cLL 26 D','0','Principal');
/*!40000 ALTER TABLE `seccional` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-04-19  0:12:41
