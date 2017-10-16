-- MySQL dump 10.13  Distrib 5.7.19, for Linux (x86_64)
--
-- Host: localhost    Database: WxObs
-- ------------------------------------------------------
-- Server version	5.7.19-0ubuntu0.17.04.1

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
-- Table structure for table `GFSFHA`
--

DROP TABLE IF EXISTS `GFSFHA`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GFSFHA` (
  `FHour` int(11) NOT NULL,
  `DoGet` int(11) DEFAULT NULL,
  `NAM` int(11) DEFAULT '0',
  `Round` int(11) DEFAULT NULL,
  `RAP` int(11) DEFAULT '0',
  `GFS` int(11) DEFAULT '1',
  `CMC` int(11) DEFAULT NULL,
  `HRRR` int(11) DEFAULT '0',
  `HRWA` int(11) DEFAULT NULL,
  PRIMARY KEY (`FHour`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GFSFHA`
--

LOCK TABLES `GFSFHA` WRITE;
/*!40000 ALTER TABLE `GFSFHA` DISABLE KEYS */;
INSERT INTO `GFSFHA` VALUES (1,1,1,1,1,1,0,1,1),(2,1,1,1,1,1,0,1,1),(3,1,1,1,1,1,1,1,1),(4,1,1,1,1,1,0,1,1),(5,1,1,2,1,1,0,1,1),(6,1,1,2,1,1,1,1,1),(7,1,1,2,1,1,0,1,1),(8,1,1,2,1,1,0,1,1),(9,1,1,3,1,1,1,1,1),(10,1,1,3,1,1,0,1,1),(11,1,1,3,1,1,0,1,1),(12,1,1,3,1,1,1,1,1),(13,1,1,4,1,1,0,1,1),(14,1,1,4,1,1,0,1,1),(15,1,1,4,1,1,1,1,1),(16,1,1,4,1,1,0,1,1),(17,1,1,5,1,1,0,0,1),(18,1,1,5,1,1,1,0,1),(19,1,1,5,1,1,0,0,1),(20,1,1,5,1,1,0,0,1),(21,1,1,6,1,1,1,0,1),(22,1,1,6,0,1,0,0,1),(23,1,1,6,0,1,0,0,1),(24,1,1,6,0,1,1,0,1),(27,1,1,7,0,1,1,0,1),(30,1,1,7,0,1,1,0,1),(33,1,1,7,0,1,1,0,1),(36,1,1,7,0,1,1,0,1),(39,1,1,8,0,1,1,0,1),(42,1,1,8,0,1,1,0,1),(45,1,1,8,0,1,1,0,1),(48,1,1,8,0,1,1,0,1),(51,1,1,9,0,1,1,0,0),(54,1,1,9,0,1,1,0,0),(57,1,1,9,0,1,1,0,0),(60,1,1,9,0,1,1,0,0),(63,1,0,10,0,1,1,0,0),(66,1,0,10,0,1,1,0,0),(69,1,0,10,0,1,1,0,0),(72,1,0,10,0,1,1,0,0),(75,1,0,11,0,1,1,0,0),(78,1,0,11,0,1,1,0,0),(81,1,0,11,0,1,1,0,0),(84,1,0,11,0,1,1,0,0),(87,1,0,12,0,1,1,0,0),(90,1,0,12,0,1,1,0,0),(93,1,0,12,0,1,1,0,0),(96,1,0,12,0,1,1,0,0),(99,1,0,13,0,1,1,0,0),(102,1,0,13,0,1,1,0,0),(105,1,0,13,0,1,1,0,0),(108,1,0,13,0,1,1,0,0),(111,1,0,14,0,1,1,0,0),(114,1,0,14,0,1,1,0,0),(117,1,0,14,0,1,1,0,0),(120,1,0,14,0,1,1,0,0),(123,1,0,15,0,1,1,0,0),(126,1,0,15,0,1,1,0,0),(129,1,0,15,0,1,1,0,0),(132,1,0,15,0,1,1,0,0),(135,1,0,16,0,1,1,0,0),(138,1,0,16,0,1,1,0,0),(141,1,0,16,0,1,1,0,0),(144,1,0,16,0,1,1,0,0),(147,1,0,17,0,1,1,0,0),(150,1,0,17,0,1,1,0,0),(153,1,0,17,0,1,1,0,0),(156,1,0,17,0,1,1,0,0),(159,1,0,18,0,1,1,0,0),(162,1,0,18,0,1,1,0,0),(165,1,0,18,0,1,1,0,0),(168,1,0,18,0,1,1,0,0),(171,1,0,19,0,1,1,0,0),(174,1,0,19,0,1,1,0,0),(177,1,0,19,0,1,1,0,0),(180,1,0,19,0,1,1,0,0),(183,1,0,20,0,1,1,0,0),(186,1,0,20,0,1,1,0,0),(189,1,0,20,0,1,1,0,0),(192,1,0,20,0,1,1,0,0),(195,1,0,21,0,1,1,0,0),(198,1,0,21,0,1,1,0,0),(201,1,0,21,0,1,1,0,0),(204,1,0,21,0,1,1,0,0),(207,1,0,22,0,1,1,0,0),(210,1,0,22,0,1,1,0,0),(213,1,0,22,0,1,1,0,0),(216,1,0,22,0,1,1,0,0),(219,1,0,23,0,1,1,0,0),(222,1,0,23,0,1,1,0,0),(225,1,0,23,0,1,1,0,0),(228,1,0,23,0,1,1,0,0),(231,1,0,24,0,1,1,0,0),(234,1,0,24,0,1,1,0,0),(237,1,0,24,0,1,1,0,0),(240,1,0,24,0,1,1,0,0),(252,1,0,25,0,1,0,0,0),(264,1,0,25,0,1,0,0,0),(276,1,0,25,0,1,0,0,0),(288,1,0,25,0,1,0,0,0),(300,1,0,26,0,1,0,0,0),(312,1,0,26,0,1,0,0,0),(324,1,0,26,0,1,0,0,0),(336,1,0,26,0,1,0,0,0),(348,1,0,27,0,1,0,0,0),(360,1,0,27,0,1,0,0,0),(372,1,0,27,0,1,0,0,0),(384,1,0,27,0,1,0,0,0);
/*!40000 ALTER TABLE `GFSFHA` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-10-16 17:26:51