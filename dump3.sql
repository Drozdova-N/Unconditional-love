-- MySQL dump 10.13  Distrib 5.5.23, for Win64 (x86)
--
-- Host: localhost    Database: lab_mysql_2
-- ------------------------------------------------------
-- Server version	5.5.23

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
-- Table structure for table `exam_m`
--

DROP TABLE IF EXISTS `exam_m`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exam_m` (
  `ID_ex` int(10) NOT NULL AUTO_INCREMENT,
  `ID_Subj` int(10) NOT NULL,
  `ID_st` int(10) NOT NULL,
  `ID_Le` int(10) NOT NULL,
  `ex_mark` int(10) NOT NULL DEFAULT '2',
  `Date_ex` date NOT NULL,
  PRIMARY KEY (`ID_ex`),
  KEY `ID_Subj` (`ID_Subj`),
  KEY `ID_st` (`ID_st`),
  KEY `ID_Le` (`ID_Le`),
  CONSTRAINT `exam_m_ibfk_1` FOREIGN KEY (`ID_Subj`) REFERENCES `subj` (`ID_Subj`),
  CONSTRAINT `exam_m_ibfk_2` FOREIGN KEY (`ID_st`) REFERENCES `stud` (`ID_st`),
  CONSTRAINT `exam_m_ibfk_3` FOREIGN KEY (`ID_Le`) REFERENCES `lecturer` (`ID_Lec`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exam_m`
--

LOCK TABLES `exam_m` WRITE;
/*!40000 ALTER TABLE `exam_m` DISABLE KEYS */;
/*!40000 ALTER TABLE `exam_m` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lecturer`
--

DROP TABLE IF EXISTS `lecturer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lecturer` (
  `ID_Lec` int(50) NOT NULL AUTO_INCREMENT,
  `First_n` char(20) NOT NULL,
  `Last_n` char(20) NOT NULL,
  `City` char(30) DEFAULT NULL,
  `ID_univ` int(30) DEFAULT NULL,
  PRIMARY KEY (`ID_Lec`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lecturer`
--

LOCK TABLES `lecturer` WRITE;
/*!40000 ALTER TABLE `lecturer` DISABLE KEYS */;
/*!40000 ALTER TABLE `lecturer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stud`
--

DROP TABLE IF EXISTS `stud`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stud` (
  `ID_st` int(50) NOT NULL AUTO_INCREMENT,
  `First` char(20) NOT NULL,
  `Last_n` char(30) NOT NULL,
  `City` char(30) DEFAULT NULL,
  `DateBirth` date DEFAULT NULL,
  `ID_Group` int(50) NOT NULL,
  PRIMARY KEY (`ID_st`),
  KEY `ID_Group` (`ID_Group`),
  CONSTRAINT `stud_ibfk_1` FOREIGN KEY (`ID_Group`) REFERENCES `tt` (`ID_gr`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=cp1251;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stud`
--

LOCK TABLES `stud` WRITE;
/*!40000 ALTER TABLE `stud` DISABLE KEYS */;
INSERT INTO `stud` VALUES (2,'Petrov','Ivan','SPb','1998-04-19',1);
/*!40000 ALTER TABLE `stud` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subj`
--

DROP TABLE IF EXISTS `subj`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subj` (
  `ID_Subj` int(10) NOT NULL AUTO_INCREMENT,
  `Name_subj` char(20) NOT NULL,
  `Coun_lec` smallint(10) NOT NULL DEFAULT '0',
  `Count_lab` smallint(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_Subj`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subj`
--

LOCK TABLES `subj` WRITE;
/*!40000 ALTER TABLE `subj` DISABLE KEYS */;
/*!40000 ALTER TABLE `subj` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tt`
--

DROP TABLE IF EXISTS `tt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tt` (
  `ID_gr` int(50) NOT NULL AUTO_INCREMENT,
  `Nam_gr` char(15) NOT NULL,
  `kol_st` int(10) DEFAULT NULL,
  `specialty` char(10) DEFAULT NULL,
  PRIMARY KEY (`ID_gr`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=cp1251;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tt`
--

LOCK TABLES `tt` WRITE;
/*!40000 ALTER TABLE `tt` DISABLE KEYS */;
INSERT INTO `tt` VALUES (1,'5',10,'PKS'),(2,'563',15,NULL);
/*!40000 ALTER TABLE `tt` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-06-09  0:23:32
