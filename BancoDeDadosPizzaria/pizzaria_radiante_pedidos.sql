-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: localhost    Database: pizzaria_radiante
-- ------------------------------------------------------
-- Server version	8.0.41

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedidos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `data_pedido` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `total` decimal(10,2) NOT NULL,
  `usuario_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=184 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` VALUES (7,'2025-03-15 00:09:48',545.00,0),(98,'2025-04-01 02:06:16',48.00,0),(99,'2025-04-01 02:23:47',103.00,0),(100,'2025-04-01 02:26:51',48.00,0),(101,'2025-04-01 02:27:25',48.00,0),(102,'2025-04-01 02:29:11',48.00,0),(103,'2025-04-01 20:17:14',48.00,0),(104,'2025-04-01 20:18:57',48.00,0),(105,'2025-04-01 20:23:31',48.00,0),(106,'2025-04-01 20:24:39',48.00,0),(107,'2025-04-01 20:25:44',48.00,0),(108,'2025-04-01 20:26:11',48.00,0),(109,'2025-04-01 20:26:37',48.00,0),(110,'2025-04-01 20:27:01',48.00,0),(111,'2025-04-01 20:45:17',0.00,0),(112,'2025-04-01 20:45:58',0.00,0),(113,'2025-04-01 20:47:06',0.00,0),(114,'2025-04-01 20:48:02',0.00,0),(115,'2025-04-01 20:48:10',0.00,0),(116,'2025-04-01 20:48:25',55.00,0),(117,'2025-04-01 20:52:02',55.00,0),(118,'2025-04-01 20:59:36',55.00,0),(119,'2025-04-01 21:00:29',55.00,0),(120,'2025-04-01 21:04:12',55.00,0),(121,'2025-04-01 21:08:24',55.00,0),(122,'2025-04-01 21:08:28',55.00,0),(123,'2025-04-01 21:10:18',55.00,0),(124,'2025-04-01 21:10:57',55.00,0),(125,'2025-04-01 21:11:23',55.00,0),(126,'2025-04-01 21:13:10',55.00,0),(127,'2025-04-01 21:14:07',55.00,0),(128,'2025-04-01 21:14:20',55.00,0),(129,'2025-04-01 21:17:03',55.00,0),(130,'2025-04-01 21:18:52',55.00,0),(131,'2025-04-01 21:22:39',55.00,0),(132,'2025-04-01 22:02:16',45.00,0),(133,'2025-04-01 22:02:16',45.00,0),(134,'2025-04-01 22:32:16',153.00,0),(135,'2025-04-01 23:02:25',351.00,0),(136,'2025-04-01 23:02:29',351.00,0),(137,'2025-04-01 23:02:31',351.00,0),(138,'2025-04-01 23:02:34',351.00,0),(139,'2025-04-01 23:02:41',351.00,0),(140,'2025-04-01 23:02:43',351.00,0),(141,'2025-04-02 21:56:52',103.00,0),(142,'2025-04-02 21:57:14',103.00,0),(143,'2025-04-02 22:01:10',103.00,0),(144,'2025-04-02 22:02:58',103.00,0),(145,'2025-04-02 22:03:45',103.00,0),(146,'2025-04-02 22:09:49',103.00,0),(147,'2025-04-02 22:12:07',103.00,0),(148,'2025-04-02 22:16:47',103.00,0),(149,'2025-04-02 22:23:20',103.00,0),(150,'2025-04-02 22:23:33',103.00,0),(151,'2025-04-02 22:25:30',103.00,0),(152,'2025-04-02 22:26:37',103.00,0),(153,'2025-04-02 22:30:28',103.00,0),(154,'2025-04-02 22:35:23',48.00,0),(155,'2025-04-02 22:35:54',48.00,0),(156,'2025-04-03 20:21:09',48.00,0),(157,'2025-04-03 20:24:57',55.00,0),(158,'2025-04-04 15:51:02',241.00,0),(159,'2025-04-04 15:54:15',208.00,0),(160,'2025-04-04 18:13:26',160.00,0),(161,'2025-04-04 18:26:05',105.00,0),(162,'2025-04-05 00:13:56',343.00,0),(163,'2025-04-05 17:38:53',103.00,0),(164,'2025-04-05 17:39:55',103.00,0),(165,'2025-04-05 17:50:18',111.00,0),(166,'2025-04-05 17:51:48',111.00,0),(167,'2025-04-10 20:50:03',48.00,0),(168,'2025-04-11 11:21:37',103.00,0),(169,'2025-04-11 11:21:53',111.00,0),(170,'2025-04-11 14:34:02',55.00,0),(171,'2025-04-11 14:34:23',55.00,0),(172,'2025-04-11 14:34:53',63.00,0),(173,'2025-04-11 14:35:14',71.00,0),(174,'2025-04-19 16:07:51',48.00,0),(175,'2025-04-19 18:34:39',153.00,0),(176,'2025-04-19 19:16:45',48.00,0),(177,'2025-04-19 19:59:54',103.00,0),(178,'2025-04-20 17:18:38',105.00,0),(179,'2025-04-20 17:56:36',105.00,0),(180,'2025-04-22 21:51:56',136.00,0),(181,'2025-04-22 21:55:39',136.00,16),(182,'2025-04-24 13:07:04',158.00,25),(183,'2025-04-24 14:57:44',153.00,26);
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-24 12:00:58
