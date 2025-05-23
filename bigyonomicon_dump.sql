-- MariaDB dump 10.19  Distrib 10.4.27-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: bigyonomicon
-- ------------------------------------------------------
-- Server version	10.4.27-MariaDB

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
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('bigyonomicon_cache_bartamark1220@gmail.com|127.0.0.1','i:1;',1747043608),('bigyonomicon_cache_bartamark1220@gmail.com|127.0.0.1:timer','i:1747043608;',1747043608),('bigyonomicon_cache_fake|127.0.0.1','i:1;',1747006255),('bigyonomicon_cache_fake|127.0.0.1:timer','i:1747006255;',1747006255),('bigyonomicon_cache_test@example.com|127.0.0.1','i:1;',1747044970),('bigyonomicon_cache_test@example.com|127.0.0.1:timer','i:1747044970;',1747044970),('bigyonomicon_cache_test123@example.com|127.0.0.1','i:1;',1747045001),('bigyonomicon_cache_test123@example.com|127.0.0.1:timer','i:1747045001;',1747045001);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart_items`
--

DROP TABLE IF EXISTS `cart_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cart_items_user_id_foreign` (`user_id`),
  KEY `cart_items_product_id_foreign` (`product_id`),
  CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `cart_items_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart_items`
--

LOCK TABLES `cart_items` WRITE;
/*!40000 ALTER TABLE `cart_items` DISABLE KEYS */;
INSERT INTO `cart_items` VALUES (1,9,1,4,'2025-05-12 08:27:50','2025-05-12 08:32:03'),(2,9,3,2,'2025-05-12 08:28:04','2025-05-12 11:52:34'),(3,9,7,4,'2025-05-12 13:18:54','2025-05-12 14:39:04');
/*!40000 ALTER TABLE `cart_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'main',
  `parent_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categories_parent_id_foreign` (`parent_id`),
  CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'B├║tor','main',NULL,'2025-05-11 19:27:51','2025-05-11 19:27:51'),(2,'Elektronika','main',NULL,'2025-05-11 19:27:51','2025-05-11 19:27:51'),(3,'Konyhai eszk├Âz├Âk','main',NULL,'2025-05-11 19:27:51','2025-05-11 19:27:51'),(4,'├ëtkez┼Ĺasztal','sub',1,'2025-05-11 19:27:51','2025-05-11 19:27:51'),(5,'├ťl┼Ĺgarnit├║ra','sub',1,'2025-05-11 19:27:51','2025-05-11 19:27:51'),(6,'Szekr├ęny','sub',1,'2025-05-11 19:27:51','2025-05-11 19:27:51'),(7,'├ügy','sub',1,'2025-05-11 19:27:51','2025-05-11 19:27:51'),(8,'Sz├ęk','sub',1,'2025-05-11 19:27:51','2025-05-11 19:27:51'),(9,'Telev├şzi├│','sub',2,'2025-05-11 19:27:51','2025-05-11 19:27:51'),(10,'Sz├ím├şt├│g├ęp','sub',2,'2025-05-11 19:27:51','2025-05-11 19:27:51'),(11,'Okostelefon','sub',2,'2025-05-11 19:27:51','2025-05-11 19:27:51'),(12,'H├íztart├ísi g├ęp','sub',2,'2025-05-11 19:27:51','2025-05-11 19:27:51'),(13,'Audi├│ eszk├Âz','sub',2,'2025-05-11 19:27:51','2025-05-11 19:27:51'),(14,'Ed├ęny','sub',3,'2025-05-11 19:27:51','2025-05-11 19:27:51'),(15,'Ev┼Ĺeszk├Âz','sub',3,'2025-05-11 19:27:51','2025-05-11 19:27:51'),(16,'Konyhai kisg├ęp','sub',3,'2025-05-11 19:27:51','2025-05-11 19:27:51'),(17,'T├ílal├│eszk├Âz','sub',3,'2025-05-11 19:27:51','2025-05-11 19:27:51'),(18,'S├╝t┼Ĺforma','sub',3,'2025-05-11 19:27:51','2025-05-11 19:27:51'),(19,'├Źr├│asztal','main',NULL,'2025-05-12 10:37:51','2025-05-12 10:37:51'),(20,'Vil├íg├şt├ís','main',NULL,'2025-05-12 10:41:23','2025-05-12 10:41:23'),(21,'├üll├│l├ímpa','main',NULL,'2025-05-12 10:41:23','2025-05-12 10:41:23'),(22,'Ker├ímia','main',NULL,'2025-05-12 10:45:54','2025-05-12 10:45:54'),(23,'Dekor├íci├│','main',NULL,'2025-05-12 10:45:54','2025-05-12 10:45:54'),(24,'├ëlelmiszer','main',NULL,'2025-05-12 10:48:46','2025-05-12 10:48:46'),(25,'Gy├╝m├Âlcs','main',NULL,'2025-05-12 10:48:46','2025-05-12 10:48:46'),(26,'B├║tor','main',NULL,'2025-05-12 11:41:16','2025-05-12 11:41:16'),(27,'Elektronika','main',NULL,'2025-05-12 11:41:16','2025-05-12 11:41:16'),(28,'Konyhai eszk├Âz├Âk','main',NULL,'2025-05-12 11:41:16','2025-05-12 11:41:16'),(29,'Sport ├ęs szabadid┼Ĺ','main',NULL,'2025-05-12 11:41:16','2025-05-12 11:41:16'),(30,'Dekor├íci├│','main',NULL,'2025-05-12 11:41:16','2025-05-12 11:41:16'),(31,'├ëlelmiszer','main',NULL,'2025-05-12 11:41:16','2025-05-12 11:41:16'),(32,'├ëtkez┼Ĺasztal','sub',1,'2025-05-12 11:41:16','2025-05-12 11:41:16'),(33,'├ťl┼Ĺgarnit├║ra','sub',1,'2025-05-12 11:41:16','2025-05-12 11:41:16'),(34,'Szekr├ęny','sub',1,'2025-05-12 11:41:16','2025-05-12 11:41:16'),(35,'├ügy','sub',1,'2025-05-12 11:41:16','2025-05-12 11:41:16'),(36,'Sz├ęk','sub',1,'2025-05-12 11:41:16','2025-05-12 11:41:16'),(37,'├Źr├│asztal','sub',1,'2025-05-12 11:41:16','2025-05-12 11:41:16'),(38,'L├ímpa','sub',1,'2025-05-12 11:41:16','2025-05-12 11:41:16'),(39,'Telev├şzi├│','sub',2,'2025-05-12 11:41:16','2025-05-12 11:41:16'),(40,'Laptop','sub',2,'2025-05-12 11:41:16','2025-05-12 11:41:16'),(41,'Okos├│ra','sub',2,'2025-05-12 11:41:16','2025-05-12 11:41:16'),(42,'Okostelefon','sub',2,'2025-05-12 11:41:16','2025-05-12 11:41:16'),(43,'Audi├│ eszk├Âz','sub',2,'2025-05-12 11:41:16','2025-05-12 11:41:16'),(44,'Ed├ęny','sub',3,'2025-05-12 11:41:16','2025-05-12 11:41:16'),(45,'Robotg├ęp','sub',3,'2025-05-12 11:41:16','2025-05-12 11:41:16'),(46,'K├ív├ęf┼Ĺz┼Ĺ','sub',3,'2025-05-12 11:41:16','2025-05-12 11:41:16'),(47,'H┼▒t┼Ĺszekr├ęny','sub',3,'2025-05-12 11:41:16','2025-05-12 11:41:16'),(48,'Ker├ękp├ír','sub',4,'2025-05-12 11:41:16','2025-05-12 11:41:16'),(49,'V├íza','sub',5,'2025-05-12 11:41:16','2025-05-12 11:41:16'),(50,'Gy├╝m├Âlcs','sub',6,'2025-05-12 11:41:16','2025-05-12 11:41:16');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `content` text NOT NULL,
  `rating` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_user_id_foreign` (`user_id`),
  KEY `comments_product_id_foreign` (`product_id`),
  CONSTRAINT `comments_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,12,1,'Gy├Âny├Âr┼▒ asztal, t├Âk├ęletesen illik az ├ętkez┼Ĺnkbe. A fa mint├ízata egyedi ├ęs a kidolgoz├ís kiv├íl├│ min┼Ĺs├ęg┼▒. Nagyon el├ęgedett vagyok a v├ís├írl├íssal!',9,'2025-05-12 11:41:54','2025-05-12 11:41:54'),(2,13,1,'Sz├ęp darab, de az ├Âsszeszerel├ęs kicsit neh├ęzkes volt. A v├ęgeredm├ęny azonban meg├ęrte a f├írads├ígot. Stabil ├ęs eleg├íns.',8,'2025-05-12 11:41:54','2025-05-12 11:41:54'),(3,12,2,'Rendk├şv├╝l k├ęnyelmes ├ęs eleg├íns kanap├ę. A b┼Ĺr min┼Ĺs├ęge kiv├íl├│, ├ęs a sz├şne pontosan olyan, mint a k├ępen. Vend├ęgeink is mindig megdics├ęrik.',10,'2025-05-12 11:41:54','2025-05-12 11:41:54'),(4,13,2,'Nagyon el├ęgedett vagyok a kanap├ęval. K├ęnyelmes, strapab├şr├│ ├ęs k├Ânnyen tiszt├şthat├│. Az egyetlen apr├│ negat├şvum, hogy a sz├íll├şt├ís kicsit k├ęsett.',9,'2025-05-12 11:41:54','2025-05-12 11:41:54'),(5,12,3,'T├Âk├ęletes v├ílaszt├ís volt a h├íl├│szob├ínkba. Rengeteg t├írol├│helyet biztos├şt, ├ęs a minimalista diz├íjn remek├╝l illik a lak├ísunk st├şlus├íhoz.',9,'2025-05-12 11:41:54','2025-05-12 11:41:54'),(6,13,3,'Sz├ęp szekr├ęny, de a cs├║sz├│ ajt├│k n├ęha beragadnak. Az ├Âsszeszerel├ęs sem volt egyszer┼▒, de a v├ęgeredm├ęny sz├ęp lett.',7,'2025-05-12 11:41:54','2025-05-12 11:41:54'),(7,12,4,'Kiv├íl├│ min┼Ĺs├ęg┼▒ ├şr├│asztal, t├Âk├ęletes a home office munk├íhoz. A k├íbelrendez┼Ĺ rendszer nagyon praktikus, ├ęs a fel├╝let val├│ban cs├Âkkenti a k├ęperny┼Ĺ t├╝kr├Âz┼Ĺd├ęs├ęt.',9,'2025-05-12 11:41:54','2025-05-12 11:41:54'),(8,13,4,'J├│ ├ír-├ęrt├ęk ar├íny├║ term├ęk. Stabil, j├│l n├ęz ki, ├ęs a fi├│kjai is t├ígasak. Aj├ínlom mindenkinek, aki otthoni irod├ít rendez be.',8,'2025-05-12 11:41:54','2025-05-12 11:41:54'),(9,12,5,'Csod├ílatos darab, igazi szemet gy├Âny├Ârk├Âdtet┼Ĺ lakberendez├ęsi t├írgy. A f├ęnye kellemes, meleg hangulatot teremt a nappaliban.',10,'2025-05-12 11:41:54','2025-05-12 11:41:54'),(10,13,5,'Nagyon tetszik a l├ímpa diz├íjnja, t├Âk├ęletesen illik a vintage st├şlus├║ nappalinkba. Az okosotthon kompatibilit├ís nagy el┼Ĺny!',9,'2025-05-12 11:41:54','2025-05-12 11:41:54'),(11,12,6,'Gy├Âny├Âr┼▒ darab, pontosan olyan, mint a le├şr├ísban. Val├│di m┼▒alkot├ís, amely egyedi hangulatot ad a nappalinknak.',10,'2025-05-12 11:41:54','2025-05-12 11:41:54'),(12,13,6,'El├ęgedett vagyok a v├íz├íval, b├ír kicsit kisebb, mint amire sz├ím├ştottam. A kidolgoz├ís ├ęs a r├ęszletek azonban leny┼▒g├Âz┼Ĺek.',8,'2025-05-12 11:41:54','2025-05-12 11:41:54'),(13,12,7,'Fantasztikusan finom ├ęs ropog├│s alm├ík! L├ítszik, hogy gondosan v├ílogatt├ík ┼Ĺket. Biztosan ├║jra rendelek.',10,'2025-05-12 11:41:54','2025-05-12 11:41:54'),(14,13,7,'Nagyon ├şzletes ├ęs friss alm├ík. J├│ ├ęrz├ęs, hogy vegyszermentes term├ęket fogyaszthatunk. A gyerekek is im├ídj├ík!',9,'2025-05-12 11:41:54','2025-05-12 11:41:54'),(15,12,8,'Kiv├íl├│ min┼Ĺs├ęg┼▒ ban├ínok, t├Âk├ęletesen ├ęrettek ├ęs nagyon ├şzletesek. Smoothie-khoz ├ęs s├╝t├ęshez is remek alapanyag.',9,'2025-05-12 11:41:54','2025-05-12 11:41:54'),(16,13,8,'Finom ban├ínok, de n├ęh├íny darab m├ír t├║l├ęrett volt a csomag alj├ín. Ett┼Ĺl f├╝ggetlen├╝l j├│ ├ír-├ęrt├ęk ar├íny├║ term├ęk.',8,'2025-05-12 11:41:54','2025-05-12 11:41:54'),(17,12,9,'├ëletem legjobb mang├│ja! T├Âk├ęletesen ├ęrett, ├ędes ├ęs l├ęd├║s. M├ír t├Âbbsz├Âr rendeltem, ├ęs mindig kiv├íl├│ min┼Ĺs├ęget kaptam.',10,'2025-05-12 11:41:54','2025-05-12 11:41:54'),(18,13,9,'Nagyon finom, de az ├íra kicsit borsos. K├╝l├Ânleges alkalmakra azonban t├Âk├ęletes v├ílaszt├ís.',8,'2025-05-12 11:41:54','2025-05-12 11:41:54'),(19,12,10,'Rendk├şv├╝l ├ędes ├ęs l├ęd├║s anan├ísz, sokkal jobb, mint amit a szupermarketekben lehet kapni. Meg├ęri az ├ír├ít!',10,'2025-05-12 11:41:54','2025-05-12 11:41:54'),(20,13,10,'Nagyon finom ├ęs friss anan├ísz. K├Ânny┼▒ volt megtiszt├ştani, ├ęs a csal├ídom im├ídta az ├şz├ęt. Biztosan ├║jra v├ís├írolok.',9,'2025-05-12 11:41:54','2025-05-12 11:41:54'),(21,12,11,'T├Âk├ęletesen ├ęrett avok├íd├│k, kr├ęmes text├║r├íval ├ęs gazdag ├şzzel. Guacamole k├ęsz├şt├ęs├ęhez ide├ílis!',10,'2025-05-12 11:41:54','2025-05-12 11:41:54'),(22,13,11,'J├│ min┼Ĺs├ęg┼▒ avok├íd├│k, b├ír n├ęh├íny darab m├ęg ├ęretlen volt. ├ľsszess├ęg├ęben el├ęgedett vagyok, ├ęs ├║jra rendelek majd.',8,'2025-05-12 11:41:54','2025-05-12 11:41:54'),(23,12,12,'Gy├Âny├Âr┼▒ ├ęs ├şzletes gy├╝m├Âlcs! Nemcsak dekorat├şv, de nagyon finom is. Smoothie-khoz k├╝l├Ân├Âsen aj├ínlom.',9,'2025-05-12 11:41:54','2025-05-12 11:41:54'),(24,13,12,'├ërdekes ├ęs k├╝l├Ânleges gy├╝m├Âlcs, b├ír az ├şze enyh├ębb, mint amire sz├ím├ştottam. Mindenesetre ├Âr├╝l├Âk, hogy kipr├│b├íltam.',8,'2025-05-12 11:41:54','2025-05-12 11:41:54'),(25,9,1,'jo',5,'2025-05-12 11:51:04','2025-05-12 11:51:04'),(26,9,7,'jo alma',5,'2025-05-12 14:39:38','2025-05-12 14:39:38');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_05_11_210600_create_products_table',1),(5,'2025_05_11_210611_create_comments_table',1),(6,'2025_05_11_210617_create_cart_items_table',1),(7,'2025_05_11_210622_create_categories_table',1),(8,'2025_05_11_212152_add_foreign_keys_to_products_table',1),(9,'2025_05_12_134223_add_option2_image_to_products_table',2),(10,'2025_05_12_150842_update_product_categories',3),(11,'2025_05_12_151520_fix_product_categories',4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `option2_image` varchar(255) DEFAULT NULL,
  `rating` decimal(3,1) NOT NULL DEFAULT 0.0,
  `rating_count` int(11) NOT NULL DEFAULT 0,
  `category_id` bigint(20) unsigned DEFAULT NULL,
  `subcategory_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_subcategory_id_foreign` (`subcategory_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `products_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'T├Âlgyfa ├ëtkez┼Ĺasztal','Ez a k├ęzzel k├ęsz├ştett t├Âlgyfa ├ętkez┼Ĺasztal t├Âk├ęletes v├ílaszt├ís a modern ├ęs klasszikus otthonokba egyar├ínt. Massz├şv szerkezet├ęnek k├Âsz├Ânhet┼Ĺen gener├íci├│kon ├ít szolg├ílhatja csal├ídj├ít. A term├ęszetes t├Âlgyfa mint├ízat minden darabot egyediv├ę tesz, m├şg a pr├ęmium olajoz├ís kiemeli a fa term├ęszetes sz├ęps├ęg├ęt ├ęs v├ędelmet ny├║jt a mindennapi haszn├ílat sor├ín. Az asztal l├íbai k├╝l├Ânleges, k├ęzzel faragott mint├ízattal rendelkeznek, amely eleg├íns megjelen├ęst k├Âlcs├Ân├Âz. Ak├ír csal├ídi vacsor├íkhoz, ak├ír bar├íti ├Âsszej├Âvetelekhez, ez az asztal lesz otthona k├Âzponti eleme.',149000.00,'product1.png','https://www.perfect-design.hu/public/0746/product/1191/889/big/tundra-tomor-tolgy-etkezoasztal-160-180-200cm-39438_3e93f37402b532b1d8e5bf3f57b98e6f.jpg',8.3,2,1,4,'2025-05-11 19:27:51','2025-05-12 16:50:17'),(2,'B┼Ĺr Kanap├ę','Ez a pr├ęmium min┼Ĺs├ęg┼▒ b┼Ĺr kanap├ę t├Âk├ęletes v├ílaszt├ís a modern ├ęs eleg├íns otthonokba. A val├│di b┼Ĺr bor├şt├ís nem csak luxus megjelen├ęst biztos├şt, hanem tart├│ss├ígot ├ęs k├Ânny┼▒ tiszt├şthat├│s├ígot is. A kanap├ę ergonomikus kialak├şt├ísa ├ęs a magas min┼Ĺs├ęg┼▒ habszivacs t├Âltet kiv├ęteles k├ęnyelmet ny├║jt. A massz├şv fa v├íz ├ęs a rozsdamentes ac├ęl l├íbak stabil alapot biztos├ştanak. A kanap├ę 3 szem├ęlyes, ├şgy t├Âk├ęletes v├ílaszt├ís csal├ídi haszn├ílatra vagy vend├ęgek fogad├ís├íra. A klasszikus diz├íjn biztos├ştja, hogy ez a darab ├ęveken ├ít st├şlusos marad.',289000.00,'product2.png','https://bigbutor.hu/wp-content/uploads/2022/05/20240207_172619.jpg',9.1,3,1,5,'2025-05-11 19:27:51','2025-05-12 13:06:26'),(3,'Skandin├ív Ruh├ísszekr├ęny','Ez a skandin├ív st├şlus├║ ruh├ísszekr├ęny t├Âk├ęletes egyens├║lyt teremt a funkcionalit├ís ├ęs az eszt├ętika k├Âz├Âtt. A minimalista diz├íjn ├ęs a vil├ígos sz├şnek t├ígasabb├í teszik a teret, m├şg a praktikus bels┼Ĺ elrendez├ęs maxim├ílis t├írol├│helyet biztos├şt. A szekr├ęny ny├şrf├íb├│l k├ęsz├╝lt, amely term├ęszetes sz├ęps├ęget ├ęs tart├│ss├ígot k├Âlcs├Ân├Âz. A cs├║sz├│ ajt├│k puh├ín ├ęs csendesen m┼▒k├Âdnek, a bels┼Ĺ polcok ├íll├şthat├│ magass├íg├║ak, ├şgy szem├ęlyre szabhatja a t├írol├│teret. A szekr├ęny alj├ín tal├ílhat├│ fi├│k t├Âk├ęletes a kisebb ruhadarabok t├írol├ís├íra. A matt fel├╝let k├Ânnyen tiszt├şthat├│ ├ęs ellen├íll a karcol├ísoknak. Ez a szekr├ęny nemcsak t├írol├│hely, hanem st├şlusos kieg├ęsz├şt┼Ĺje is otthon├ínak.',179000.00,'product3.png','https://www.csodaorszag.eu/wp-content/uploads/2023/04/Skandinav-szekrenyek-bal-oldal.jpg',8.7,5,1,6,'2025-05-11 19:27:51','2025-05-12 13:06:26'),(4,'Modern ├Źr├│asztal','Ez a modern ├şr├│asztal t├Âk├ęletes v├ílaszt├ís otthoni irod├íj├íba vagy dolgoz├│sark├íba. Az ergonomikus kialak├şt├ís hossz├║ ├│r├íkon ├ít k├ęnyelmes munkav├ęgz├ęst biztos├şt. A minimalista diz├íjn b├írmilyen bels┼Ĺ t├ęrhez illeszkedik, m├şg a praktikus t├írol├│rekeszek seg├ştenek rendben tartani a munkater├╝letet. Az asztal fel├╝lete speci├ílis, matt bevonattal rendelkezik, amely cs├Âkkenti a k├ęperny┼Ĺ t├╝kr├Âz┼Ĺd├ęs├ęt ├ęs a szemf├íradts├ígot. A be├ęp├ştett k├íbelrendez┼Ĺ rendszer seg├şt elker├╝lni a k├íbelrengeteg kialakul├ís├ít. Az asztal l├íbai ├íll├şthat├│ magass├íg├║ak, ├şgy t├Âk├ęletesen szem├ęlyre szabhat├│. A kiv├íl├│ min┼Ĺs├ęg┼▒ anyagok ├ęs a gondos kivitelez├ęs hossz├║ ├ęlettartamot biztos├ştanak ennek a praktikus ├ęs st├şlusos b├║tordarabnak.',129000.00,'product4.png','https://dodo.hu/cdn/shop/products/fast-trade-feher-iroasztal-120cm-dodo-designban-otthon-546.jpg?v=1744107533',8.9,4,1,7,'2025-05-11 19:27:51','2025-05-12 13:06:26'),(5,'Vintage ├üll├│l├ímpa','Ez a vintage st├şlus├║ ├íll├│l├ímpa t├Âk├ęletes kieg├ęsz├şt┼Ĺje lehet b├írmely nappalinak vagy olvas├│saroknak. Az ipari diz├íjn elemeit ├Âtv├Âzi a klasszikus form├íkkal, ├şgy egyedi hangulatot teremt otthon├íban. A l├ímpa teste k├ęzzel megmunk├ílt f├ęmb┼Ĺl k├ęsz├╝lt, antikolt r├ęz bevonattal, amely id┼Ĺt├íll├│ megjelen├ęst biztos├şt. A l├ímpaerny┼Ĺ k├ęzzel k├ęsz├ştett, term├ęszetes lenv├íszonb├│l, amely kellemes, meleg f├ęnyt sz├│r a helyis├ęgben. A l├ímpa magass├íga ├íll├şthat├│, ├şgy t├Âk├ęletesen igaz├şthat├│ az ├ľn ig├ęnyeihez. A talpazat neh├ęz ├Ânt├Âttvasb├│l k├ęsz├╝lt, amely stabil ├íll├íst biztos├şt. A l├ímpa kompatibilis az okosotthon rendszerekkel, ├ęs t├ívir├íny├şt├│val is vez├ęrelhet┼Ĺ. Ez a darab nemcsak vil├íg├şt├│test, hanem m┼▒v├ęszi ├ęrt├ęk┼▒ lakberendez├ęsi t├írgy is.',89000.00,'product5.png','https://www.lampaszalon.hu/(36)518-087/images/scha-2.jpg',9.5,8,5,8,'2025-05-11 19:27:51','2025-05-12 13:06:26'),(6,'Antik V├íza','Ez az antik v├íza egy igazi m┼▒remek, amely t├Âk├ęletesen ├Âtv├Âzi a funkcionalit├íst ├ęs az eszt├ętik├ít. A 19. sz├ízad k├Âzep├ęn k├ęsz├╝lt, k├ęzzel festett mot├şvumokkal d├şsz├ştett ker├ímia v├íza nemcsak dekor├íci├│s elemk├ęnt szolg├íl, hanem egy darab t├Ârt├ęnelmet is hoz otthon├íba. A v├íza kiv├íl├│ ├íllapotban maradt fenn, apr├│ kop├ísnyomokkal, amelyek csak n├Âvelik autentikus jelleg├ęt. T├Âk├ęletes v├ílaszt├ís gy┼▒jt┼Ĺknek vagy azoknak, akik egyedi, t├Ârt├ęnelmi ├ęrt├ękkel b├şr├│ darabokkal szeretn├ęk gazdag├ştani otthonukat.',59000.00,'product6.png','https://homeconcept.hu/wp-content/uploads/2022/10/NVI-41552-Orient-Copper-Antik-vaza-35-6.jpg',9.2,6,5,18,'2025-05-11 19:27:51','2025-05-12 13:06:26'),(7,'Bio Alma','A bio alma egy k├╝l├Ânleges, vegyszermentes termeszt├ęs┼▒ gy├╝m├Âlcs, amely tele van vitaminokkal ├ęs ├ísv├ínyi anyagokkal. Ez a fajta alma a Jonagold fajt├íhoz tartozik, amely ├ędes-savanyk├ís ├şz├ęvel ├ęs ropog├│s h├║s├íval t┼▒nik ki. A gy├╝m├Âlcs├Ât k├ęzi szed├ęssel takar├ştj├ík be, hogy elker├╝lj├ęk a s├ęr├╝l├ęseket, ├ęs gondosan v├ílogatj├ík, hogy csak a legjobb min┼Ĺs├ęg┼▒ term├ękek ker├╝ljenek a v├ís├írl├│khoz. Fogyaszthat├│ nyersen, de kiv├íl├│ alapanyag s├╝tem├ęnyekhez, komp├│tokhoz vagy ak├ír smoothie-khoz is. A bio termeszt├ęsnek k├Âsz├Ânhet┼Ĺen nem tartalmaz k├íros vegyszermaradv├ínyokat, ├şgy biztons├ígosan fogyaszthat├│ az eg├ęsz csal├íd sz├ím├íra.',990.00,'product7.png','https://file.culinaris.hu/product_images/800x600/resize/593641_cm82or1c.jpg?v=1',8.0,3,6,19,'2025-05-11 19:27:51','2025-05-12 14:39:38'),(8,'Pr├ęmium Ban├ín','Ez a pr├ęmium min┼Ĺs├ęg┼▒ ban├ín Ecuador naps├╝t├Âtte ├╝ltetv├ęnyeir┼Ĺl sz├írmazik, ahol a t├Âk├ęletes kl├şma ├ęs a gondos termeszt├ęs biztos├ştja a gy├╝m├Âlcs kiv├íl├│ min┼Ĺs├ęg├ęt. A Cavendish fajt├íhoz tartoz├│ ban├ín k├Âzepesen nagy m├ęret┼▒, egyenletes ├ęr├ęs┼▒ ├ęs t├Âk├ęletesen ├ędes ├şz┼▒. Magas k├ílium-, magn├ęzium- ├ęs B6-vitamin-tartalma miatt kiv├íl├│ energiaforr├ís, k├╝l├Ân├Âsen sportol├│k sz├ím├íra. A ban├ín term├ęszetes csomagol├ísban ├ęrkezik, ├şgy minimaliz├ílva az ├Âkol├│giai l├íbnyomot. Fogyaszthat├│ ├Ânmag├íban, gy├╝m├Âlcssal├ít├íkban, smoothie-kban, vagy ak├ír s├╝t├ęshez is haszn├ílhat├│. Az ├ęr├ęsi folyamat term├ęszetes, vegyszermentes, ├şgy a gy├╝m├Âlcs meg┼Ĺrzi eredeti ├şz├ęt ├ęs t├íp├ęrt├ęk├ęt.',790.00,'product8.png','https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTu5jxxpUObW0jXyLfgNc77Y-Jc1COG1vuBsA&s',9.4,7,6,19,'2025-05-11 19:27:51','2025-05-12 13:06:26'),(9,'Egzotikus Mang├│','Ez a pr├ęmium min┼Ĺs├ęg┼▒ mang├│ Thaif├Âld naps├╝t├Âtte ├╝ltetv├ęnyeir┼Ĺl sz├írmazik, ahol a tr├│pusi kl├şma ├ęs a hagyom├ínyos termeszt├ęsi m├│dszerek biztos├ştj├ík a gy├╝m├Âlcs p├íratlan ├şz├ęt ├ęs min┼Ĺs├ęg├ęt. Az Alphonso fajt├íhoz tartoz├│ mang├│ k├Âzepesen nagy m├ęret┼▒, aranys├írga sz├şn┼▒ ├ęs rendk├şv├╝l ├ędes, arom├ís ├şz┼▒. Magas A- ├ęs C-vitamin tartalma, valamint antioxid├ínsokban gazdag ├Âsszet├ętele miatt kiv├íl├│ v├ílaszt├ís az eg├ęszs├ęgtudatos fogyaszt├│k sz├ím├íra. A mang├│ k├ęzzel szedett ├ęs gondosan v├ílogatott, hogy csak a legjobb min┼Ĺs├ęg┼▒ gy├╝m├Âlcs├Âk ker├╝ljenek export├íl├ísra. Fogyaszthat├│ frissen, gy├╝m├Âlcssal├ít├íkban, turmixokban, vagy ak├ír k├╝l├Ânleges desszertekhez is felhaszn├ílhat├│. Az ├ęrlel├ęsi folyamat term├ęszetes, ├şgy a gy├╝m├Âlcs meg┼Ĺrzi eredeti ├şz├ęt ├ęs t├íp├ęrt├ęk├ęt.',1290.00,'product9.png','https://bananfa.cdn.shoprenter.hu/custom/bananfa/image/cache/w570h570wt1q100/product/Egzotikus/mango_alacsony1.jpg.webp?lastmod=1742316005.1582213581',8.8,5,6,19,'2025-05-11 19:27:51','2025-05-12 13:06:26'),(10,'K├╝l├Ânleges Anan├ísz','Ez a k├╝l├Ânleges anan├ísz Costa Rica vulkanikus talaj├║ ├╝ltetv├ęnyeir┼Ĺl sz├írmazik, ahol az egyedi mikrokl├şma ├ęs a hagyom├ínyos termeszt├ęsi m├│dszerek biztos├ştj├ík a gy├╝m├Âlcs kiv├ęteles ├ędess├ęg├ęt ├ęs arom├íj├ít. A Gold MD-2 fajt├íhoz tartoz├│ anan├ísz k├Âzepes m├ęret┼▒, aranys├írga h├║s├║ ├ęs rendk├şv├╝l l├ęd├║s. Magas C-vitamin tartalma ├ęs enzimekben gazdag ├Âsszet├ętele miatt kiv├íl├│ v├ílaszt├ís az eg├ęszs├ęgtudatos fogyaszt├│k sz├ím├íra. Az anan├íszt k├ęzzel szedik ├ęs v├ílogatj├ík, hogy csak a t├Âk├ęletesen ├ęrett p├ęld├ínyok ker├╝ljenek export├íl├ísra. Fogyaszthat├│ frissen, gy├╝m├Âlcssal├ít├íkban, turmixokban, grillezve vagy ak├ír k├╝l├Ânleges desszertekhez is felhaszn├ílhat├│. A term├ęszetes ├ęrlel├ęsi folyamatnak k├Âsz├Ânhet┼Ĺen a gy├╝m├Âlcs meg┼Ĺrzi eredeti ├şz├ęt ├ęs t├íp├ęrt├ęk├ęt, mik├Âzben minim├ílis a k├Ârnyezeti terhel├ęs.',1490.00,'product10.png','https://ketkes.com/wp-content/uploads/2018/01/a-szomszedasszonyom-kulonleges-ajandekkal-lepte-meg-a-ferjet-mikor-meglattam-mit-csinal-en-is-elkeszitettem-1024x534.jpg',9.3,12,6,19,'2025-05-11 19:27:51','2025-05-12 13:06:26'),(11,'Pr├ęmium Avok├íd├│','Ez a pr├ęmium min┼Ĺs├ęg┼▒ Hass avok├íd├│ Mexik├│ naps├╝t├Âtte ├╝ltetv├ęnyeir┼Ĺl sz├írmazik, ahol a k├╝l├Ânleges mikrokl├şma ├ęs a hagyom├ínyos termeszt├ęsi m├│dszerek biztos├ştj├ík a gy├╝m├Âlcs kiv├ęteles min┼Ĺs├ęg├ęt ├ęs ├şz├ęt. A Hass fajta k├Âzepesen nagy m├ęret┼▒, s├Ât├ęt, r├╝csk├Âs h├ęj├║ ├ęs kr├ęmes, z├Âldes-s├írg├ís h├║s├║. Rendk├şv├╝l gazdag eg├ęszs├ęges, tel├ştetlen zs├şrokban, feh├ęrj├ęben, rostokban ├ęs sz├ímos vitaminban, ├ísv├ínyi anyagban. Az avok├íd├│ igazi szuper├ętel, amely t├ímogatja a sz├şv- ├ęs ├ęrrendszer eg├ęszs├ęg├ęt, seg├şti az em├ęszt├ęst ├ęs hozz├íj├írul a b┼Ĺr sz├ęps├ęg├ęhez. Minden darab k├ęzzel szedett ├ęs gondosan v├ílogatott, hogy csak a megfelel┼Ĺ ├ęretts├ęg┼▒ gy├╝m├Âlcs├Âk ker├╝ljenek forgalomba. Fogyaszthat├│ ├Ânmag├íban, szendvicsekben, sal├ít├íkban, vagy a klasszikus guacamole elk├ęsz├şt├ęs├ęhez. Az avok├íd├│ fenntarthat├│ gazd├ílkod├ísb├│l sz├írmazik, ├şgy k├Ârnyezettudatos v├ílaszt├ís is egyben.',890.00,'product11.png','https://www.egzotikusdisznovenyek.hu/wp-content/uploads/2019/07/avocado-1.jpg',9.6,8,6,19,'2025-05-11 19:27:51','2025-05-12 13:06:26'),(12,'Egzotikus S├írk├ínygy├╝m├Âlcs','Ez a k├╝l├Ânleges s├írk├ínygy├╝m├Âlcs (pitaya) Vietn├ím tr├│pusi ├╝ltetv├ęnyeir┼Ĺl sz├írmazik, ahol a meleg, p├ír├ís kl├şma ide├ílis felt├ęteleket biztos├şt a n├Âv├ęny sz├ím├íra. A gy├╝m├Âlcs k├╝lseje ├ęl├ęnk r├│zsasz├şn, z├Âld \"pikkelyekkel\" d├şsz├ştett, belseje pedig feh├ęr alapon fekete, ehet┼Ĺ magvakkal p├Âtty├Âz├Âtt. A s├írk├ínygy├╝m├Âlcs alacsony kal├│riatartalma ├ęs magas rost-, valamint antioxid├íns-tartalma miatt n├ępszer┼▒ a tudatos t├ípl├ílkoz├íst k├Âvet┼Ĺk k├Âr├ęben. ├Źze enyh├ęn ├ędes, a kivi ├ęs a k├Ârte kever├ęk├ęhez hasonl├şthat├│, text├║r├íja pedig a kivire eml├ękeztet. A gy├╝m├Âlcs├Ât k├ęzzel szedik ├ęs v├ílogatj├ík, hogy csak a legjobb min┼Ĺs├ęg┼▒ p├ęld├ínyok ker├╝ljenek export├íl├ísra. Fogyaszthat├│ frissen, gy├╝m├Âlcssal├ít├íkban, smoothie-kban, vagy ak├ír k├╝l├Ânleges desszertekhez is felhaszn├ílhat├│. A s├írk├ínygy├╝m├Âlcs fenntarthat├│ gazd├ílkod├ísb├│l sz├írmazik, ├şgy k├Ârnyezettudatos v├ílaszt├ís is egyben.',1990.00,'product12.png','https://www.egzotikusdisznovenyek.hu/wp-content/uploads/2020/08/s%C3%A1rk%C3%A1nygy%C3%BCm%C3%B6lcs1.jpg',9.0,7,6,19,'2025-05-11 19:27:51','2025-05-12 13:06:26');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('DKi7etxR3WVqYvvjAfg4AOYjAGdohV2uX3lJyfoz',9,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVjlpRHBqaVB4RGk1S3hhTmZ5RWtHeXVkYVhMdkZBV0dRRk16dmJicSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zdG9yZSI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjk7fQ==',1747079330);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Test User','test@example.com','2025-05-11 19:27:51','$2y$12$TGtMLRgUG2nq5WWNi.47L.BuiBQ5IWltMnKH4lljf2GrsjXHg5Lum','8gSDlDCbIo','2025-05-11 19:27:51','2025-05-11 19:27:51'),(2,'Diamond Aufderhar','gislason.jalon@example.net','2025-05-11 19:27:51','$2y$12$TGtMLRgUG2nq5WWNi.47L.BuiBQ5IWltMnKH4lljf2GrsjXHg5Lum','f3aHjQthc6','2025-05-11 19:27:51','2025-05-11 19:27:51'),(3,'Keira West III','bmueller@example.com','2025-05-11 19:27:51','$2y$12$TGtMLRgUG2nq5WWNi.47L.BuiBQ5IWltMnKH4lljf2GrsjXHg5Lum','Ts4AEDhYG7','2025-05-11 19:27:51','2025-05-11 19:27:51'),(4,'Ms. Mercedes Russel','flatley.gisselle@example.org','2025-05-11 19:27:51','$2y$12$TGtMLRgUG2nq5WWNi.47L.BuiBQ5IWltMnKH4lljf2GrsjXHg5Lum','02K9yuNRoq','2025-05-11 19:27:51','2025-05-11 19:27:51'),(5,'Karley Corwin','della.osinski@example.net','2025-05-11 19:27:51','$2y$12$TGtMLRgUG2nq5WWNi.47L.BuiBQ5IWltMnKH4lljf2GrsjXHg5Lum','kUqSrkBE90','2025-05-11 19:27:51','2025-05-11 19:27:51'),(6,'Orlo Harris DDS','russell.rogahn@example.org','2025-05-11 19:27:51','$2y$12$TGtMLRgUG2nq5WWNi.47L.BuiBQ5IWltMnKH4lljf2GrsjXHg5Lum','0Z2PTjUuSX','2025-05-11 19:27:51','2025-05-11 19:27:51'),(8,'John Doe','john@example.com',NULL,'$2y$12$j9JlftwRzVYYIKzw.gmmletTKc9vXbfckEAXProwaXfyNrAk4Lh.6',NULL,'2025-05-12 08:07:14','2025-05-12 08:07:14'),(9,'test123','test123@example.com',NULL,'$2y$12$pSUWkPTLnCFKDG8alLXiROJzYBfojGAW9r7L7L6Pxrrc1l9NbMtVu',NULL,'2025-05-12 08:26:07','2025-05-12 08:26:07'),(10,'test1232','test1232@example.com',NULL,'$2y$12$G5EgklnUSfsjELylnhrC3.HvX1HDBqCFhnNEZyvwFtq8soxqEnyce',NULL,'2025-05-12 08:32:37','2025-05-12 08:32:37'),(11,'asd','asd@gmail.com',NULL,'$2y$12$M0YkLpKrcc0UitRnfgFGdOp53w3JrUZo6qhztgfbLqM5mvFlN/zT2',NULL,'2025-05-12 08:34:48','2025-05-12 08:34:48'),(12,'Kov├ícs J├ínos','commenter1@example.com',NULL,'$2y$12$ausjyc8Eugc8PW9ZkNmuNOd2ERzDlsbqNGXV4m2EOIYYa1.CvHFbu',NULL,'2025-05-12 11:41:53','2025-05-12 11:41:53'),(13,'Nagy Eszter','commenter2@example.com',NULL,'$2y$12$TLD2tc20787q7hKOBoVZ/ezbuhxJo7lrVDHq.xi1uW19cAitbVfn2',NULL,'2025-05-12 11:41:54','2025-05-12 11:41:54');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-12 21:52:56
