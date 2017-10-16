--
-- Table structure for table `MOS_Index`
--

DROP TABLE IF EXISTS `MOS_Index`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MOS_Index` (
  `RunID` int(11) NOT NULL AUTO_INCREMENT,
  `RunString` varchar(50) DEFAULT NULL,
  `GFS` int(11) DEFAULT NULL,
  `NAM4KM` int(11) DEFAULT NULL,
  `RAP` int(11) DEFAULT '0',
  `CMC` int(11) DEFAULT '0',
  `HRRR` int(11) DEFAULT '0',
  `HRWA` int(11) DEFAULT '0',
  `HRWN` int(11) DEFAULT '0',
  PRIMARY KEY (`RunID`)
) ENGINE=InnoDB AUTO_INCREMENT=4731 DEFAULT CHARSET=latin1;
