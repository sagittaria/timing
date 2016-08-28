-- MySQL dump 10.13  Distrib 5.1.73, for redhat-linux-gnu (i386)
--
-- Host: localhost    Database: timingdb
-- ------------------------------------------------------
-- Server version	5.1.73

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
-- Table structure for table `timing_block`
--

DROP TABLE IF EXISTS `timing_block`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `timing_block` (
  `blockId` int(11) NOT NULL AUTO_INCREMENT,
  `blockName` varchar(50) DEFAULT NULL,
  `blockDescription` varchar(100) DEFAULT NULL,
  `blockFoundation` int(11) DEFAULT NULL,
  `blockStatus` smallint(5) unsigned DEFAULT NULL,
  `builderId` int(11) NOT NULL,
  PRIMARY KEY (`blockId`),
  KEY `timing_block_timing_builder_FK` (`builderId`),
  CONSTRAINT `timing_block_timing_builder_FK` FOREIGN KEY (`builderId`) REFERENCES `timing_builder` (`builderId`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `timing_block`
--

LOCK TABLES `timing_block` WRITE;
/*!40000 ALTER TABLE `timing_block` DISABLE KEYS */;
/*!40000 ALTER TABLE `timing_block` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `timing_brick`
--

DROP TABLE IF EXISTS `timing_brick`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `timing_brick` (
  `brickId` int(11) NOT NULL AUTO_INCREMENT,
  `brickStart` int(11) DEFAULT NULL,
  `brickDuration` int(11) DEFAULT NULL,
  `brickContent` varchar(100) DEFAULT NULL,
  `blockId` int(11) NOT NULL,
  PRIMARY KEY (`brickId`),
  KEY `timimg_brick_timing_block_FK` (`blockId`),
  CONSTRAINT `timimg_brick_timing_block_FK` FOREIGN KEY (`blockId`) REFERENCES `timing_block` (`blockId`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=136 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `timing_brick`
--

LOCK TABLES `timing_brick` WRITE;
/*!40000 ALTER TABLE `timing_brick` DISABLE KEYS */;
/*!40000 ALTER TABLE `timing_brick` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `timing_builder`
--

DROP TABLE IF EXISTS `timing_builder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `timing_builder` (
  `builderId` int(11) NOT NULL AUTO_INCREMENT,
  `builderUsername` varchar(25) NOT NULL,
  `builderPassword` char(32) NOT NULL,
  `builderEmail` varchar(40) NOT NULL,
  PRIMARY KEY (`builderId`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `timing_builder`
--

LOCK TABLES `timing_builder` WRITE;
/*!40000 ALTER TABLE `timing_builder` DISABLE KEYS */;
/*!40000 ALTER TABLE `timing_builder` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-08-28 17:55:42
