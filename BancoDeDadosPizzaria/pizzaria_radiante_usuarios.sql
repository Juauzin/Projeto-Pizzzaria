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
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `senha` varchar(255) NOT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `ultimo_login` datetime DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cpf` (`cpf`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (15,'joao',NULL,'$2y$10$ZMUt2jsLxwKtsesTEoE8/OnnQdSo/RSFDiLluIFXuNa3f7Ajfh66.','rua teste1','123456789',NULL,0),(16,'joao roberto','472.227.188-77','$2y$10$uyGjjrEjJ72AQHgbaDh.kuhjR4QQsAg5W73QTrPd59nKPEK7EP6/y','Rua Armando Viera','123456',NULL,1),(17,'Bah','12345678','$2y$10$2XiEbp3n4rOQHHl5fAQdue13zqDjDfF1h5PnhS0ZB1zBGqH.aVPU.','12','151544864',NULL,0),(18,'joao ','1234','$2y$10$EIln2N8aoUhQ4p9tVz.k4uv64WnIWodC3f2Klqm15XdSB.v9MraeO','rua teste','12345678',NULL,0),(19,'Ruan Baiano','9876543210','$2y$10$CZdJEmC6FWzRJffvwTuNE.SWLeIlCGkJIniz..aOtpJcDZjFYlhlS','baiano96@gmail.com','69696969696',NULL,0),(20,'João Roberto De Almeida Marinho Da Silva','123456789','$2y$10$h.ExQqmpLyMslEQRtSmfM.lsbmGM8krTxmpi6Wlazo9z09S7A6CPa','Rua Armando Viera','11933738163',NULL,0),(21,'João Roberto De Almeida Marinho Da Silva','89623186010','$2y$10$/O6km606ju0xxhDzACB2oeYOd90Od.HBUnRB59Dy1PCzCsbTofTge','Rua Armando Viera','11933738163',NULL,0),(24,'maria','6437862482367','$2y$10$BUynyuXjnez9XC2iJ5RScuu8bGfOPF76ljNWPSQdyAIhwUnFvRoJm','Rua Armando Viera','325636712635','2025-04-22 18:45:10',0),(25,'Maria','81721845062','$2y$10$y6w1uzxtgpXcSR3k0dmcye0na9N00St2k9WcwEdlDTJA6TlwJHVZi','Rua Armando Viera','4537845387453',NULL,0),(26,'Jadson','73452317048','$2y$10$YYNQ0T.X2VFIMU1xtSf7J.t/MZjt4ha15QsDfL54LdbcX8VubR.76','rua teste','428873554387',NULL,0);
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

-- Dump completed on 2025-04-24 12:00:57
