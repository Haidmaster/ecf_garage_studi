-- MySQL dump 10.13  Distrib 8.0.35, for Win64 (x86_64)
--
-- Host: localhost    Database: ecf_garage_studi
-- ------------------------------------------------------
-- Server version	8.0.35

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `brand`
--

DROP TABLE IF EXISTS `brand`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `brand` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brand`
--

LOCK TABLES `brand` WRITE;
/*!40000 ALTER TABLE `brand` DISABLE KEYS */;
INSERT INTO `brand` VALUES (79,'Audi'),(80,'BMW'),(81,'Kia'),(82,'Toyota'),(83,'Mercedes'),(84,'Renault');
/*!40000 ALTER TABLE `brand` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `car`
--

DROP TABLE IF EXISTS `car`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `car` (
  `id` int NOT NULL AUTO_INCREMENT,
  `model_id` int NOT NULL,
  `gearbox_id` int DEFAULT NULL,
  `energy_id` int DEFAULT NULL,
  `mileage` int NOT NULL,
  `price` int NOT NULL,
  `options` longtext COLLATE utf8mb4_unicode_ci,
  `years` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_773DE69D7975B7E7` (`model_id`),
  KEY `IDX_773DE69DC826082F` (`gearbox_id`),
  KEY `IDX_773DE69DEDDF52D` (`energy_id`),
  CONSTRAINT `FK_773DE69D7975B7E7` FOREIGN KEY (`model_id`) REFERENCES `model` (`id`),
  CONSTRAINT `FK_773DE69DC826082F` FOREIGN KEY (`gearbox_id`) REFERENCES `gearbox` (`id`),
  CONSTRAINT `FK_773DE69DEDDF52D` FOREIGN KEY (`energy_id`) REFERENCES `energy` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `car`
--

LOCK TABLES `car` WRITE;
/*!40000 ALTER TABLE `car` DISABLE KEYS */;
INSERT INTO `car` VALUES (1,339,41,55,21000,36500,'caméras à 360°, sièges avant ventilés , sièges arrière chauffants , toit solaire photovoltaïque.',2023),(2,332,41,54,23000,45000,'Caméra de recule, freinage d\'urgence anti-collision',2022),(3,341,41,55,18700,41200,'Caméra de recul\r\nCaméra à 360°\r\nFreinage assisté Inclus\r\nSurveillance de l\'angle mort\r\nAvertisseur de dérive',2023),(4,326,40,53,52000,21500,'radio 6HP à écran tactile 8,8’’, le radar de recul et les jantes alu de 16 pouces',2017);
/*!40000 ALTER TABLE `car` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20240211175842','2024-02-11 17:59:01',1068),('DoctrineMigrations\\Version20240211202325','2024-02-11 20:23:31',191),('DoctrineMigrations\\Version20240211211617','2024-02-11 21:16:27',192),('DoctrineMigrations\\Version20240211234128','2024-02-11 23:42:14',153);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `energy`
--

DROP TABLE IF EXISTS `energy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `energy` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `energy`
--

LOCK TABLES `energy` WRITE;
/*!40000 ALTER TABLE `energy` DISABLE KEYS */;
INSERT INTO `energy` VALUES (53,'Diesel'),(54,'Essence'),(55,'Hybride'),(56,'Electrique');
/*!40000 ALTER TABLE `energy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gearbox`
--

DROP TABLE IF EXISTS `gearbox`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gearbox` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gearbox`
--

LOCK TABLES `gearbox` WRITE;
/*!40000 ALTER TABLE `gearbox` DISABLE KEYS */;
INSERT INTO `gearbox` VALUES (40,'Manuelle'),(41,'Automatique'),(42,'Semi-automatique');
/*!40000 ALTER TABLE `gearbox` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `image`
--

DROP TABLE IF EXISTS `image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `image` (
  `id` int NOT NULL AUTO_INCREMENT,
  `car_id` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C53D045FC3C6F69F` (`car_id`),
  CONSTRAINT `FK_C53D045FC3C6F69F` FOREIGN KEY (`car_id`) REFERENCES `car` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `image`
--

LOCK TABLES `image` WRITE;
/*!40000 ALTER TABLE `image` DISABLE KEYS */;
INSERT INTO `image` VALUES (1,1,'93a4c4335d4fcfc6086540f6a22a53f7.webp'),(2,1,'fcc293d8637d29ae45927b25945cb60b.webp'),(3,1,'e7256381a46f03afdf4c5c1456afca51.webp'),(4,NULL,'42efc002fcea5819c355373c1d06e965.webp'),(5,NULL,'1bff84583ef686349cd9341d92d838f7.webp'),(6,NULL,'49bab14dfa0a0c6950f6f79cb37ffb2a.webp'),(7,2,'95e51aa9d57d3bf5c7119f6975dbf924.webp'),(8,2,'06b5fe81b4ca9152400bca770cdb9f94.webp'),(9,2,'44cee942c6bf1305b1d9cd6622db6b7b.webp'),(10,3,'6641e2cb0351321d98335f5845e14afd.webp'),(11,3,'a8c58273366b89aee9c12b052ea44e34.webp'),(12,3,'d8ceef6561d80a9ce12caf1f26062cf2.webp'),(13,4,'7c67d817096b28ffb243b2688a6d1a43.webp'),(14,4,'a34c20d1fe38be0173a1b83f062d6113.webp'),(15,4,'9a3a5e18347f30fadd5266e1c6581718.webp');
/*!40000 ALTER TABLE `image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model`
--

DROP TABLE IF EXISTS `model`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model` (
  `id` int NOT NULL AUTO_INCREMENT,
  `brand_id` int DEFAULT NULL,
  `name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D79572D944F5D008` (`brand_id`),
  CONSTRAINT `FK_D79572D944F5D008` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=352 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model`
--

LOCK TABLES `model` WRITE;
/*!40000 ALTER TABLE `model` DISABLE KEYS */;
INSERT INTO `model` VALUES (326,79,'a1'),(327,79,'a3'),(328,79,'a4'),(329,79,'q5'),(330,80,'Serie-1'),(331,80,'Serie-2'),(332,80,'Serie-3'),(333,80,'Serie-4'),(334,81,'Niro'),(335,81,'Sportage'),(336,81,'EV6'),(337,81,'Proceed'),(338,81,'Ceed'),(339,82,'Prius'),(340,82,'Corolla'),(341,82,'Camry'),(342,82,'Rav-4'),(343,83,'Classe-A'),(344,83,'Classe-E'),(345,83,'Classe-C'),(346,83,'Classe-S'),(347,84,'Clio'),(348,84,'Megane'),(349,84,'Austral'),(350,84,'Arkana'),(351,82,'Supra');
/*!40000 ALTER TABLE `model` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `opening_day`
--

DROP TABLE IF EXISTS `opening_day`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `opening_day` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opening_hours_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_33A03DFCE298D68` (`opening_hours_id`),
  CONSTRAINT `FK_33A03DFCE298D68` FOREIGN KEY (`opening_hours_id`) REFERENCES `opening_hour` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opening_day`
--

LOCK TABLES `opening_day` WRITE;
/*!40000 ALTER TABLE `opening_day` DISABLE KEYS */;
/*!40000 ALTER TABLE `opening_day` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `opening_hour`
--

DROP TABLE IF EXISTS `opening_hour`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `opening_hour` (
  `id` int NOT NULL AUTO_INCREMENT,
  `open_am` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `close_am` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `open_pm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `close_pm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opening_hour`
--

LOCK TABLES `opening_hour` WRITE;
/*!40000 ALTER TABLE `opening_hour` DISABLE KEYS */;
/*!40000 ALTER TABLE `opening_hour` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prestation`
--

DROP TABLE IF EXISTS `prestation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prestation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `image_id` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_51C88FAD3DA5256D` (`image_id`),
  CONSTRAINT `FK_51C88FAD3DA5256D` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prestation`
--

LOCK TABLES `prestation` WRITE;
/*!40000 ALTER TABLE `prestation` DISABLE KEYS */;
INSERT INTO `prestation` VALUES (1,4,'Diagnostic et recherche de pannes','Le garage est équipé de matériel diagnostic haut de gamme mis à jour afin de pouvoir interroger vos calculateurs et faire le meilleur diagnostic possible.'),(2,5,'Mécanique générale','Nous intervenons sur tous types de travaux, sur de l’entretien classique aussi bien que sur de la mécanique lourde, comme remplacement ou réfection d’un moteur.'),(3,6,'Entretien avec remise à zéro','Le Garage effectue vos révisions périodiques et vidanges avec remise à zéro des témoins d’entretien, sur tous types de véhicules, même les plus récents.');
/*!40000 ALTER TABLE `prestation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (7,'admin@site.com','[\"ROLE_ADMIN\"]','$2y$13$s9kljJxa0EpSLJpbMb1S4.6eUj3h8WWrixE51y4Pd7icWdBeATUzm'),(8,'employe1@site.com','[\"ROLE_ADMIN_EMPLOYEE\"]','$2y$13$LJ6/VN1/k3EDsdefdYL1gO3ma48FBrKqpGqoKoFDfdQf3TNUj6p/m');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'ecf_garage_studi'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-02-20 15:31:38
