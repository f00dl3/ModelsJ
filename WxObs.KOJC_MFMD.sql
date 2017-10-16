DROP TABLE IF EXISTS `KOJC_MFMD`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `KOJC_MFMD` (
  `ObsID` int(11) NOT NULL AUTO_INCREMENT,
  `RunString` varchar(25) DEFAULT NULL,
  `GFS` longtext,
  `NAM` longtext,
  `RAP` longtext,
  `CMC` longtext,
  `HRRR` json DEFAULT NULL,
  `HRWA` json DEFAULT NULL,
  `HRWN` json DEFAULT NULL,
  PRIMARY KEY (`ObsID`),
  KEY `RunString` (`RunString`)
) ENGINE=InnoDB AUTO_INCREMENT=4654 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
