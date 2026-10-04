-- MySQL dump 10.13  Distrib 8.0.46, for Linux (x86_64)
--
-- Host: localhost    Database: visa_db
-- ------------------------------------------------------
-- Server version	8.0.46

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
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
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
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_06_18_182646_add_phone_and_dob_to_users_table',1),(5,'2026_06_18_183904_add_phone_number_to_users_table',1),(6,'2026_06_18_184353_add_passport_number_to_users_table',1),(7,'2026_06_19_000001_create_settings_table',1),(8,'2026_06_19_000002_add_otp_to_users_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
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
INSERT INTO `sessions` VALUES ('0ndIZXWeqpc7HVvqfmhvkSYjWyMcg844IZRnw6Ey',NULL,'34.116.160.247','Mozilla/5.0 (iPhone13,2; U; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/602.1.50 (KHTML, like Gecko) Version/10.0 Mobile/15E148 Safari/602.1','eyJfdG9rZW4iOiJDbTZ4QXBubmlqZno2N0hZQlhIeTRHQU5RMHF6c1J5VlIyZGhOWDF4IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786105897),('1JmJvxlaYjIW5fzVZTHOhlad3G4IAU2cXnyfNaDf',NULL,'74.7.227.151','Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; GPTBot/1.4; +https://openai.com/gptbot)','eyJfdG9rZW4iOiJwT0hTWlFqWUxNTFRmYVpON1kzd1FRWjE3c0dETW9mNnQxaHhmWTRQIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786107297),('1wQyZ6Lv0JMjjK2rCgvGEDasx0pkvESFKwgwfdz8',NULL,'172.24.0.1','Mozilla/5.0 (Linux; Android 16; SM-S921U) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.7632.6 Mobile Safari/537.36','eyJfdG9rZW4iOiJUUTRocVdGRDNmUGVRbE9Qem9sYlhMbkQ3a0xLM3h1dTNYY0VWSlpxIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2V2aXNhLmdvdnVrZXZpc2Etdmlldy1zaGFyZWNvZGUtaW1taWdyYXRpb24tc3RhdHVzLmluZm8iLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1786105510),('29ozExVijG0TdZ0x0Fy8w1hFE3O47Iev65BkCLwG',NULL,'172.24.0.1','Mozilla/5.0 (compatible; rust_sniffer/0.1; +https://github.com/)','eyJfdG9rZW4iOiJPbFpoQkVzVkZxNk9neXZVVk54UGN1VmhzbnVOSWlrcEZXU2w2aGM1IiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1786105383),('44bytBZqbziZbbpA5GjCYDnrZKUq2eQvEx6KCjvM',NULL,'172.111.15.80','Mozilla/5.0 (iPhone; CPU iPhone OS 16_6_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.5 Mobile/15E148 Safari/604.1','eyJfdG9rZW4iOiJrWnp1ODZnRUZjckI4dmNKNVNEQW9oTVdYS2swUHozS0dqanE2TzJ2IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786106552),('4k9CnsGH7xJiob9dlHcrnfTWPMPK8vqpayT0wsFm',NULL,'172.24.0.1','Mozilla/5.0 (Linux; Android 16; SM-S921U) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.7632.6 Mobile Safari/537.36','eyJfdG9rZW4iOiJ1VmVlZ1phTDVVdG14Z1BZdGF6T1ZlNVZPY0kySXlOTkE4UWZaTmkxIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2V2aXNhLmdvdnVrZXZpc2Etdmlldy1zaGFyZWNvZGUtaW1taWdyYXRpb24tc3RhdHVzLmluZm8iLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1786105539),('4LaxpvW2uJRsxTSJZlQtjxaCyxgqrSif54DjJjbu',NULL,'35.223.59.227','Python/3.11 aiohttp/3.13.5','eyJfdG9rZW4iOiJyS1JZOVVsTG9JdkZzamIzMkpvZVpmNWJLcDFCQTRqRHZCVGJMaG9wIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786106962),('4OVuRGATNhYGBcNHnx883wwcWY8SwHw7ZMqQt8uE',NULL,'223.228.12.207','curl/8.7.1','eyJfdG9rZW4iOiJaakQ3ZzZMOTJMd3kxMHFEdkhBYkxxbEszQUxUQTBBQUY1T2xOa1dMIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786105643),('5UMv7MeGWvYPEeSgZYU1pkOJfZ8fTDsE9VLxd1L7',NULL,'35.223.59.227','Python/3.11 aiohttp/3.13.5','eyJfdG9rZW4iOiI4UmZRakxoTkpzeHNCQVBTYkU0MjlOeFFlbTNWNnZKYWNPamJuVEROIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786106055),('6rRuuJJedhbtw0OYH1XPaoIZ3Z4SOiHDDl6jMyF2',NULL,'35.223.59.227','Python/3.11 aiohttp/3.13.5','eyJfdG9rZW4iOiJKZVZ2YjdTdGh0YzhxZEY5czhmaDBHT3dsRG5VM29LQnBIU1lIVnVaIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786105784),('6Y5Wyjg0i9gtUwgR9CUpnr2ftJnu7X2sgUxnx8E3',NULL,'65.108.62.161','Mozilla/5.0 (Linux; Android 10; SM-A205U) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.5735.130 Mobile Safari/537.36','eyJfdG9rZW4iOiJBenNZUVlSeENjeWhocWljS3MwOW1sWFNxc1Nscm95WDY4bDdBU09FIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786105899),('7t870XapDg6VcYvfILyC347x6VOTaohuFD1MUNlw',NULL,'152.59.52.59','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Mobile Safari/537.36','eyJfdG9rZW4iOiJMUEJqU1V6WjdJN3pvR1loZVhsTkxWcmhSMGtDQ29KTURDd3dQdEpDIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwiZG9jdW1lbnRfdHlwZSI6InBhc3Nwb3J0IiwiZG9jdW1lbnRfbnVtYmVyIjoiQzg5MjA1MTciLCJ1c2VyX2lkIjoyfQ==',1786107709),('93Zl9Nz4lEpy8IHm86cjBS7c5mDxxR0yco5tUvTh',NULL,'34.118.99.162','Mozilla/5.0 (iPhone13,2; U; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/602.1.50 (KHTML, like Gecko) Version/10.0 Mobile/15E148 Safari/602.1','eyJfdG9rZW4iOiJWNE9qVkNVbFpoUGlwQklzZVd4Z3lZd3ZaeHFVcEFvT25SNGF0UGJKIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786105766),('9bAUy0Pwa2doBOl5CHh6QGfLw6tMSpI8HHqm44Tm',NULL,'161.123.3.37','Mozilla/5.0 (iPhone; CPU iPhone OS 16_6_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.5 Mobile/15E148 Safari/604.1','eyJfdG9rZW4iOiJPSTF4bGhJRHFOZFplUXo0ZWpieFZLd1l0MTVwMnFZb1YySklnaGJJIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786106480),('9D6IgCO6sd677tjgUKcXYV0nfYdLGx187p9Esr7c',NULL,'172.24.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36 +https://forestengine.net/#opt-out','eyJfdG9rZW4iOiJibnNjdnI4VW56YWl1TkZVU29IeVZwNDhkcklzR3Vqejl2UVhIczBpIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2V2aXNhLmdvdnVrZXZpc2Etdmlldy1zaGFyZWNvZGUtaW1taWdyYXRpb24tc3RhdHVzLmluZm8iLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1786105351),('9UzyvSH8heGduxPNUjgF8CtOV7WPSHVFo93vTDpJ',NULL,'223.228.12.207','curl/8.7.1','eyJfdG9rZW4iOiJ6QTBWczAyMVljenVrZENkVHlNa3dSUGZ0WWhVaEhHZUZ5NWZUdmJ2IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786105648),('9WkBMDWNeeZayfssVSuFjZ6ZieT7oU2xTwZt2wYe',NULL,'91.196.152.147','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:134.0) Gecko/20100101 Firefox/134.0','eyJfdG9rZW4iOiJQWXhDcnNTRUJHcEFYYnZjc1BXSEtMVFlUYWt3N0tRaGlERkhGRElhIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786106477),('ASUSuPvaOpoLRsI4X7qTWG7mr95uFaHY2vPIc9t2',NULL,'172.24.0.1','Python/3.11 aiohttp/3.13.5','eyJfdG9rZW4iOiJIcDMxb3JQQmJLWFNDSllTc0NZYkpMRUtXNjBmUjh6QXY3emNEaU90IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2V2aXNhLmdvdnVrZXZpc2Etdmlldy1zaGFyZWNvZGUtaW1taWdyYXRpb24tc3RhdHVzLmluZm8iLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1786105384),('aT3XKHUguBkJM7HauoWv4lzIdz5PvOjfECdhwIjv',NULL,'172.24.0.1','Mozilla/5.0 (iPhone; CPU iPhone OS 17_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.5 Mobile/15E148 Safari/604.1','eyJfdG9rZW4iOiJKNVdmaDF1YUpha2RKTlhOUFR1NFJKUVhNcWRyS3JlQ1Bpc2QyOGhPIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2V2aXNhLmdvdnVrZXZpc2Etdmlldy1zaGFyZWNvZGUtaW1taWdyYXRpb24tc3RhdHVzLmluZm8iLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1786105372),('aypaVh4kAhpBCwCNB0HXO2lY8j2XhlD0VSCoG3FQ',NULL,'65.108.186.46','Mozilla/5.0 (Windows NT 10.0; Trident/7.0; rv:11.0) like Gecko','eyJfdG9rZW4iOiJJQklLUE5TV0hsdlFBeDdDTjdqdU1WWUIyOWRLM3hObnI4MlB1VGVpIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786105900),('bcFG11xGeSSw4BLPmX40W4mYbjN9FK9nF97DbdAS',NULL,'35.223.59.227','Python/3.11 aiohttp/3.13.5','eyJfdG9rZW4iOiJoNk9uY21PTEpyb0xxR01QWnhIb1l1Q1o4QmZxM29lN3R0eUZibTM0IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786106434),('boU9juXBCulM7gzYGET4RuQxxBnEGCdZ4woiWB2Z',NULL,'172.24.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:147.0) Gecko/20100101 Firefox/147.0','eyJfdG9rZW4iOiJMbFNjSzJIU1plZUZMeXpvR0NTTHdSSENYOWsxNzc4V3psaFNCT1hVIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2V2aXNhLmdvdnVrZXZpc2Etdmlldy1zaGFyZWNvZGUtaW1taWdyYXRpb24tc3RhdHVzLmluZm8iLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1786105443),('brWuE6ja7z0x38c6D3ePmZ0nmhJ8QpGVbznqVcId',NULL,'35.223.59.227','Python/3.11 aiohttp/3.13.5','eyJfdG9rZW4iOiJ4MU5oZVpXUnRoUkF1QlYyeU00SWN0ZG9ZSWl4bHM1dkJLZ1hxaDVqIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786106554),('C6nIW8P2EAL9dRzVZUwuUsPhRlSG9gcvNszIa2nN',NULL,'172.24.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:147.0) Gecko/20100101 Firefox/147.0','eyJfdG9rZW4iOiJQZVN0bzdsT1pFYjdrRmQ2RDFSZ3RPM0xHVHk5NWdCbTU0ZTRPYWFYIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2V2aXNhLmdvdnVrZXZpc2Etdmlldy1zaGFyZWNvZGUtaW1taWdyYXRpb24tc3RhdHVzLmluZm8iLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1786105444),('DoS5VrXt7s8Q9zmUhuHYgniFPy27cbfbo5GERSWk',NULL,'223.228.1.5','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Mobile Safari/537.36','eyJfdG9rZW4iOiJZN2t3Z3Fhc1RRemNZaGtlVVlHZ0JPVmxrbUZkcE14SXVJQ0NhRlNvIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786107446),('E14vQami1Xyi7kO4GdQMx8tdz4QlZNNr5oSBgiRY',NULL,'35.223.59.227','Python/3.11 aiohttp/3.13.5','eyJfdG9rZW4iOiJiN2prWllrNU54ZlR2dTdKem5rdXRqSmxrYVdUZ1VKSGNqTWd3aXA0IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786107708),('eJDrSJ63d7lxpFocwjMBJjQH3pJXmxsXqSHuCWyn',NULL,'172.111.15.162','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','eyJfdG9rZW4iOiI4THZSWkROSVVsczVOVVpveDNicUZ0WTJMMDFxR2I5cmE3aEM0anVQIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786106502),('etv1LELwG3FkFjekrjFaBeUjkVXYmGW7g97cKsK2',NULL,'172.111.15.144','Mozilla/5.0 (iPhone; CPU iPhone OS 16_6_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.5 Mobile/15E148 Safari/604.1','eyJfdG9rZW4iOiJUU0J2TTFHWHRMNmdiT0xtZnIzSkE2S0dZOEowS1RVekNZZ1JUZmNxIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786106409),('Ff9jHo4x8Ckex43shiPloe1BcX5tzhS6g0GogLIz',NULL,'172.24.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.7632.6 Safari/537.36','eyJfdG9rZW4iOiJhdFJOanVZMUNvTVdjSTJGUXE2YXV4Yjc0OVJJM3p1c3NHSFVYeVlWIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2V2aXNhLmdvdnVrZXZpc2Etdmlldy1zaGFyZWNvZGUtaW1taWdyYXRpb24tc3RhdHVzLmluZm8iLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1786105536),('FGzKfjlnXJF7LXUf1dLi07s9cGqcCQY4dvTGW339',NULL,'172.24.0.1','curl/8.5.0','eyJfdG9rZW4iOiJ5U05yYkhldzRjbTM4NEtJVEprRTFEMFcxakFickJrVkNQTkxwZGRQIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MTA0Iiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786105169),('fJEtsZojKFJOmrRmPA5YR2jvPRoE70m3YxrhPXPN',NULL,'172.111.15.0','Mozilla/5.0 (iPhone; CPU iPhone OS 16_6_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.5 Mobile/15E148 Safari/604.1','eyJfdG9rZW4iOiJUM0xZZnpwN0ZoTUZsbldmVW54VkFqeTdCMVlyNUk1d0RJa1ZqOXBNIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786106290),('fkNRIv3FfAsnF8ZIaPM3606pZjxoNPdmOKPpTqB1',NULL,'172.24.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJJS2ZWSkwxcTBlVkgyWUw0RGFVWDk3SkM4QU1XczljY0xEa1o2Z283IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2V2aXNhLmdvdnVrZXZpc2Etdmlldy1zaGFyZWNvZGUtaW1taWdyYXRpb24tc3RhdHVzLmluZm8iLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1786105430),('fUHPiRSqsXIREW1f5hyUzuC2UwAKNN0j4QUb6zzE',NULL,'35.223.59.227','Python/3.11 aiohttp/3.13.5','eyJfdG9rZW4iOiJyVmhPWjI1RnpoSFVkaDZKVDhYdFhldTNCTlZ0MHFxSlFwOEZUSlh5IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786105657),('gX5eaamCM3l4d82TpsaEk5PLKo8OCCbnOncQoYWB',NULL,'172.111.15.144','Mozilla/5.0 (iPhone; CPU iPhone OS 16_6_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.5 Mobile/15E148 Safari/604.1','eyJfdG9rZW4iOiJGOVdBb1BWa3hTM2hpbWJWWnlIZzlqY0dDZ1YxOGtQZUVXa0ExZjE4IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786106287),('hBaXzO70nrCqq8saRp0GOxrq7wl3gIUmPK0xCgL4',NULL,'172.24.0.1','curl/8.7.1','eyJfdG9rZW4iOiJYRHl5ZURPM0FmTUZRc3JsMEZmbnhzQ0NnaTlXMUxnNlFmc2Y4UXVBIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2V2aXNhLmdvdnVrZXZpc2Etdmlldy1zaGFyZWNvZGUtaW1taWdyYXRpb24tc3RhdHVzLmluZm8iLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1786105586),('IQYzyRrfqivgFelREied9w0C6FTiPpI2JS4Uu7DU',NULL,'98.93.20.158','axios/1.16.1','eyJfdG9rZW4iOiJjQmFrODFUelZHNjZNN3lxT3dzQ2hQOFpWaXFtcWRBcGt2cFhSWWxvIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786106037),('j1VM9MKtsfDhU6DPGl7K9pSndLLjrnqJnisJa8eB',NULL,'172.24.0.1','Python/3.11 aiohttp/3.13.5','eyJfdG9rZW4iOiJjWmtKNVI0TVZtSW11aU93UUxkb2RXa0RhTXFGSG5TQVB5SDBRZzA1IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2V2aXNhLmdvdnVrZXZpc2Etdmlldy1zaGFyZWNvZGUtaW1taWdyYXRpb24tc3RhdHVzLmluZm8iLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1786105517),('jjZEuve1H5CTWNv28NIZKf5gxQ2JAR73Ow6axJOl',NULL,'172.24.0.1','curl/8.5.0','eyJfdG9rZW4iOiJjZkdGdHl5OVNVNWpmRjM2SFBqeDVTWlp6N3d3d0VLRG9Xd1VINXlzIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MTA0Iiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786105227),('Jk3gL0k5J2UpE0gzRm6hnAjbpQKj9PrENM62owmw',1,'223.228.12.207','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJ4cm9ObkJNRE5QUlJLbHptVWxVTUc2MUpLaDhjYkNEeGh1ZUpjbGRvIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvXC9hcGlcL3VrdmlcL2V2aXNhXC9zaGFyZS1jb2RlIiwicm91dGUiOiJhcGkudWt2aS5ldmlzYS5zaGFyZS1jb2RlIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjEsImRvY3VtZW50X3R5cGUiOiJwYXNzcG9ydCIsImRvY3VtZW50X251bWJlciI6IlIyNTc1NjI3IiwidXNlcl9pZCI6MywiZGVsaXZlcnlfbWV0aG9kIjoiZW1haWwiLCJvdHBfZXhwaXJlc19hdCI6MTc4NjEwODEyNCwib3RwX3ZlcmlmaWVkIjp0cnVlLCJzaGFyZV9jb2RlIjoiREtFIDdZUiBaTlQifQ==',1786107554),('JOExQM8h72zKYSWHyVKBniPrnHvQ5UvFXdps2yFm',NULL,'172.24.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.7632.6 Safari/537.36','eyJfdG9rZW4iOiJ4R3QwZFVYeVpJRGtNRlljbkpXM1NISXFDOFU4eUN2NGp2NVVZS25mIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2V2aXNhLmdvdnVrZXZpc2Etdmlldy1zaGFyZWNvZGUtaW1taWdyYXRpb24tc3RhdHVzLmluZm8iLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1786105505),('jrReaP9j7W5lAL3VLgIFMtGUUF9uO7ibd5lFLzkW',NULL,'35.223.59.227','Python/3.11 aiohttp/3.13.5','eyJfdG9rZW4iOiJ5Rk05b1kzZUU4YVdkbktHMEZFVmhMVk9ZdTl5VExRNU1uNnl0ZFAyIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786107668),('Lucgc5xNYoxFRnZNtMAF9R5mda8Cih3BkmrytPgE',NULL,'35.223.59.227','Python/3.11 aiohttp/3.13.5','eyJfdG9rZW4iOiJWaG01cFNXZ2JYanVvZGx2YUJieHZ0SjMzYzhNNTlGUXluN0JRdjZOIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786107158),('MEtpQFd03w7KHisb1GWzCl8tUxH8WhxI79x2YFvK',NULL,'172.24.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.3','eyJfdG9rZW4iOiJLamE2U1QyTzNTZ0NYYmZuM2Z6RGIzNW9WVUdPV28xSDgxRmk4M1hhIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2V2aXNhLmdvdnVrZXZpc2Etdmlldy1zaGFyZWNvZGUtaW1taWdyYXRpb24tc3RhdHVzLmluZm8iLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1786105381),('MmedjcdiLD8vHQ13kluq9KWvlXEUM6BXuLbp1ogZ',NULL,'35.223.59.227','Python/3.11 aiohttp/3.13.5','eyJfdG9rZW4iOiJUMFRrME9lekpScDVqNGV2bGVCVllvUWJlR2NCVjd1WHlXaWpDRE9VIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786107298),('mYANSITg6MqvYHdHnNPCUgyRHFRl1nFZMD1tvHYB',NULL,'88.218.47.140','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJNUkcyWTByeUtOWU9oeld1eWRUZVB2UWQzOWxhaktWS2tscEd0VFBFIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786106963),('n0axMPThHJVQDRdSPXfiOZjNHL9yMZpXVAV8FwEF',NULL,'223.228.12.207','curl/8.7.1','eyJfdG9rZW4iOiJYVk1FNFhNQ1BsOEd1dVM0ZlFNTHI3VFpPOThDWHgyQUNFTFlzcGJtIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786106980),('nbb9ZrkZss7fm2tnStdo3sCkadroEwToo98jA6IU',1,'223.228.12.207','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Claude/1.25927.0 Chrome/148.0.7778.280 Electron/42.7.0 Safari/537.36','eyJfdG9rZW4iOiJwTksydk9mdFFHd3lKZXNNbFc2RDRhV3B4NmNOb1JhVkpCYTNjY3ZUIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvXC9hZG1pblwvc2V0dGluZ3MiLCJyb3V0ZSI6ImFkbWluLnNldHRpbmdzIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjF9',1786106421),('NeC4dUUetzaoJirRHmoRRjq3OcZ4h2WWOfuAWEz7',NULL,'91.231.89.121','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:134.0) Gecko/20100101 Firefox/134.0','eyJfdG9rZW4iOiI3RTJkR1J0dUxsYXlDZmlmcWFMOHdQWVFFVUltcnRuZHFYb3IzRlRLIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786106397),('OCTJb2M724WWN5C385yyg8IAl2dbgULvRac1BDAN',NULL,'35.223.59.227','Python/3.11 aiohttp/3.13.5','eyJfdG9rZW4iOiJvbURKYmgxTGpVVWdjOUs3cmdZbjNEdG03c2xmQVVScW8wdkM3aTBTIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786105924),('oJ5AOxM4jL9WOl2gkC7figdlGD7HKZFOx7utQml3',NULL,'172.24.0.1','curl/8.7.1','eyJfdG9rZW4iOiJPVlRaV0JWRlFjUG5LVUo4czR6UWFuMWMxbnhtZDV6bWYwbDd5Y1N1IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2V2aXNhLmdvdnVrZXZpc2Etdmlldy1zaGFyZWNvZGUtaW1taWdyYXRpb24tc3RhdHVzLmluZm8iLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1786105590),('oP0xAVfiU0RebzqZK7CFLF1g9CKr2ng2F1LpcULp',NULL,'35.223.59.227','Python/3.11 aiohttp/3.13.5','eyJfdG9rZW4iOiIxUHhSY3Z0dXlKaU9UUjZ2b3dMZlFuZXBnY1FjTXhTeks1d1lySHdUIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786106675),('q2xsVZZki2nZ1w3PcqrSndIqDL9Ltb99hcwTEoQ5',NULL,'223.228.12.207','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Safari/605.1.15','eyJfdG9rZW4iOiJjYkJlblRYS0ZreEFVRmRnY0NnUHhnUTVkUE5Sc3hCRGNwV1RRSld1IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786105957),('rQbsOfjRkXzo5tLx1HJXNRYn5rHvI0eRDKrzSxX4',NULL,'37.59.187.20','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0','eyJfdG9rZW4iOiJ4cEhuWG9ON3UzNHBPT3R1dE9qaXVBdUFKaG9odTJlQVJRem5sYW44IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786105916),('SaQP3IgbofpmqHiwLKZWxODt1EokF8bpTxCQAKCg',NULL,'172.24.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJQRHVhczFxRllNRGxCWEhxeVE2R1ZmTFBzYXhPMjdoNzdyeFZhM3E0IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2V2aXNhLmdvdnVrZXZpc2Etdmlldy1zaGFyZWNvZGUtaW1taWdyYXRpb24tc3RhdHVzLmluZm8iLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1786105424),('sjeNQWw9DI56QIr4sThpgYYv5jTNYl0lwN3091pR',NULL,'34.118.1.193','Mozilla/5.0 (iPhone13,2; U; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/602.1.50 (KHTML, like Gecko) Version/10.0 Mobile/15E148 Safari/602.1','eyJfdG9rZW4iOiJua2lDY05tUllod3lweTNwakJ5ZHVycTV4Q3pWWEtod1ltQ25LWXVvIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786106001),('SO0vMIVmpNby159BzfrXJlRmOfPs1S4qh1ZebTw3',NULL,'172.24.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36','eyJfdG9rZW4iOiIwZWEwVXhGRHVJNmVsOTBQTHJEdTB2WnoxVllZeDhrY3JxSVJBb0ZEIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2V2aXNhLmdvdnVrZXZpc2Etdmlldy1zaGFyZWNvZGUtaW1taWdyYXRpb24tc3RhdHVzLmluZm8iLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1786105424),('sTLu3RNZJ5seksQluhoVhDp1LWJgpRT7M37deClF',NULL,'172.24.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36 +https://forestengine.net/#opt-out','eyJfdG9rZW4iOiJLV0FKTG44MWVMZDJFT1o1b1ZjWm9zWTZPeXZ0WTVoN1lNTjhrVWlvIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2V2aXNhLmdvdnVrZXZpc2Etdmlldy1zaGFyZWNvZGUtaW1taWdyYXRpb24tc3RhdHVzLmluZm8iLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1786105352),('sVcKZbBffXEb2dlBQdu22NHSkXcFGrpQ46gi3ff5',NULL,'35.223.59.227','Python/3.11 aiohttp/3.13.5','eyJfdG9rZW4iOiJ1ZlYxZnczTXRzOHNZMll6emhwVzZmZVFVZFBUUGQ4MFBwbExFR1hvIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786106811),('t2MNnjfdC00KdzBQRuMdPLUlHuDgWSTEhi5mCVXX',NULL,'91.231.89.98','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:134.0) Gecko/20100101 Firefox/134.0','eyJfdG9rZW4iOiJCdVBhdUQ5ZnViUXpDVkY4SDRGUE1IcnAxVk1odjVNNEp3UU5LQUlqIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786106842),('tDlT7uzHlyUWnzdfQRZ80gyfoY5XxGbf4fo308ia',NULL,'45.132.186.245','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJmaElPUEtOb2xiRkloS2pPMWdaNXVkNDVQdXViSEw5Wlk5SkJUbHRIIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786106958),('TEWkds9fCa8xtyn5fjo5RoRy8OcNV60UzEReONvp',NULL,'35.223.59.227','Python/3.11 aiohttp/3.13.5','eyJfdG9rZW4iOiJ0RkRiYXE4eFlvamY3OEF1VnpHNGVLaXpyeTZuc0lrOW9UYU5kWER6IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786107558),('th1hYjZG0SJ3S2Y2Kq0doOGJWO40BpyZZndVzrj3',NULL,'172.24.0.1','curl/8.7.1','eyJfdG9rZW4iOiI5YU12OEhhMlVVeTBTTEJhQ3g4a3pXYUtiSU5GYU5nTFl0d0lnQUZOIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2V2aXNhLmdvdnVrZXZpc2Etdmlldy1zaGFyZWNvZGUtaW1taWdyYXRpb24tc3RhdHVzLmluZm8iLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1786105326),('TkGxLDsOV7mslnAVakKPq9SeKCUdSu6vrJdewKuP',NULL,'35.223.59.227','Python/3.11 aiohttp/3.13.5','eyJfdG9rZW4iOiJaVHlNOGFWV3FjaW90Tm96eXo5SmlWczFCQ1h5N3BsampqM2dKTDZGIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786106304),('ULgjFiN7vNjt7zPZqf89aoqLcV6sErqlgeKTTn1X',NULL,'172.24.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.7632.6 Safari/537.36','eyJfdG9rZW4iOiJXOVFYUXc4T0dOZk81UFFwbGtJUW4zeVlKM2RNU0QxcDlqNndpeUxlIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2V2aXNhLmdvdnVrZXZpc2Etdmlldy1zaGFyZWNvZGUtaW1taWdyYXRpb24tc3RhdHVzLmluZm8iLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1786105539),('vLwimo2NRCpRDypCOUijV03ZSN6IjVxUwACNny0e',NULL,'172.24.0.1','curl/8.5.0','eyJfdG9rZW4iOiJqR1BWVVd5bExjcG9wbUJrYUxsM29vTURtVVdkbnY4YVRmakVHZmNwIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MTA0Iiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786105161),('vQphhq06RirXWdNH033cWIbl3ZWoUtggpCe7UPAi',NULL,'172.24.0.1','curl/8.5.0','eyJfdG9rZW4iOiJ6VHczSzl0aW9mMFlQbDcyTGRFcHk3THI3R0tKNGhVd2xla3hZUUxCIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MTA0Iiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786105221),('vT2blKTgJlDDDiA4ihEihyMJkLjojaR8CnCKvjmo',NULL,'35.223.59.227','Python/3.11 aiohttp/3.13.5','eyJfdG9rZW4iOiJwZlowMFlTVnFsRDhVQXZHa1BPWUY2ZGxlU1F5NzN0NkIyYWdFYXNCIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786106177),('WLjU46gcpqFrgU7n3yjcVntlJIoALmBcPGpEEXvx',NULL,'150.129.246.5','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Mobile Safari/537.36','eyJfdG9rZW4iOiJhU293TFFPdTUwRHFUeGFRa0o5enI0M3pUZU5PdjBMQzNadXdibkNXIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786107451),('wPEaY3fGsapYFdFvskIIQO6HubZ2fqbM2Q0Otq5g',NULL,'185.242.177.4','axios/1.7.2','eyJfdG9rZW4iOiI0SmwwZVNlUU5Wb29qajJoZHk2aW45OENYRE1ia2oxelNub214UDdHIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786106351),('Y0datOmX2oEwzGWmnszoedjIXhRpnePfldFegLUv',NULL,'13.218.151.13','axios/1.16.1','eyJfdG9rZW4iOiIyVGMyT0hvcFo1c2w4WUtGalN4eXhpa3JHQVc4N2RkUmI3NE15SEY3IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786107341),('y0fx3YEdup4sIUg0C6TWticTTxkI4V91zkdksUwS',NULL,'134.122.108.118','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJGUGJJbjI4Q3Y3bXJ5OGdheW45MU9sc21ackUyOThwbnJmQnV1eUtXIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786105999),('Y4t64djzjx7PADtf8Z73qe8lU4AdlJppiIQWUwst',NULL,'172.111.15.162','Mozilla/5.0 (iPhone; CPU iPhone OS 16_6_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.5 Mobile/15E148 Safari/604.1','eyJfdG9rZW4iOiJOYlRzRnd0OUR5ZGVTRTIyZkpDWERLa3BRbFRMU3FhUnVzMXJZYXB1IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786106477),('y8bGFJeRTFhLhfiQwLz1nld56wK8K6vXhrvEdfPr',NULL,'172.24.0.1','Mozilla/5.0 (Linux; Android 16; SM-S921U) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.7632.6 Mobile Safari/537.36','eyJfdG9rZW4iOiJtYmtpNThjQmlUOVVHTm5qYWpzalp0YmtxeU1lZk9UY0NsTlpBYUxjIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2V2aXNhLmdvdnVrZXZpc2Etdmlldy1zaGFyZWNvZGUtaW1taWdyYXRpb24tc3RhdHVzLmluZm8iLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1786105544),('Ya23lIFVOvgpScLsg1BMunClEoIhnNKIILgRhrin',NULL,'34.116.215.171','Mozilla/5.0 (iPhone13,2; U; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/602.1.50 (KHTML, like Gecko) Version/10.0 Mobile/15E148 Safari/602.1','eyJfdG9rZW4iOiI1STJNZEJvQ051eHZvanZacGJlQU1STms0TWdac0pDTmNSUGNhREtIIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786106748),('yLrve9DNr9hAv1nygsTwUHGJihy3KIWbG3OeHY3G',NULL,'172.24.0.1','Mozilla/5.0 (Windows NT 6.3; Trident/7.0; rv:11.0) like Gecko','eyJfdG9rZW4iOiJ0MnBNMjRVSjhnTUhDeHFJMjBTNlozNnBWWDJNbDdWVGx3VVFxcHFVIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2V2aXNhLmdvdnVrZXZpc2Etdmlldy1zaGFyZWNvZGUtaW1taWdyYXRpb24tc3RhdHVzLmluZm8iLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1786105382),('yOHOB1Sk2LHr2MAR2nqKTKGw2JZyNFil7RirU9gK',NULL,'172.24.0.1','curl/8.7.1','eyJfdG9rZW4iOiJ0c0NUNnBsRHlnSXRoMkpyekZpVllzb1ZHWHVZcnZaNkZ4WVFXYlUzIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2V2aXNhLmdvdnVrZXZpc2Etdmlldy1zaGFyZWNvZGUtaW1taWdyYXRpb24tc3RhdHVzLmluZm8iLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1786105358),('Z0ciEkJ6CZHC4mQi0aIyqJW4sIdJrp28QIefggIm',NULL,'44.204.169.159','axios/1.16.1','eyJfdG9rZW4iOiJocUhoRFI5bWtiS3Frbjg3VVp3ZEFKaWhkbDNwbVNwWHcyRjRYT2tDIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786105899),('z6zf176qbj31Cm6IAw8ZALpxQwyFEtxol1Jd8Epj',NULL,'35.223.59.227','Python/3.11 aiohttp/3.13.5','eyJfdG9rZW4iOiIwd0N1YVlSZ1VkMExuZnV5eDZlOGZqZWZaOExBb2hKR3RpM0F1QkxBIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786107428),('zzqp0YWcLp4i9sEgz6unFx9BmhwE9mczAFWdZtFr',NULL,'172.111.15.192','Mozilla/5.0 (iPhone; CPU iPhone OS 16_6_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.5 Mobile/15E148 Safari/604.1','eyJfdG9rZW4iOiJDbjRWWnZ1ZGp4Uk5odXNiZXNwNDhjdWQ4ZU1ESlo1dDRUYUxHT0pKIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9ldmlzYS5nb3Z1a2V2aXNhLXZpZXctc2hhcmVjb2RlLWltbWlncmF0aW9uLXN0YXR1cy5pbmZvIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786106399);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `nationality` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valid_from` date DEFAULT NULL,
  `valid_until` date DEFAULT NULL,
  `national_insurance_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_valid_until` date DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp_expires_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_national_insurance_number_unique` (`national_insurance_number`),
  UNIQUE KEY `users_code_unique` (`code`),
  UNIQUE KEY `users_passport_number_unique` (`passport_number`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','admin@greenwebproject.com',NULL,'$2y$12$rRysRF6uobs7kLSYEbI5KuYBGOWpK4vRBFK3xhpfJIquMku8xkjwG',NULL,'2026-08-07 12:31:53','2026-08-07 12:31:53',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,'Rudra Jayantilal','rudrajayantilal9@gmail.com',NULL,'$2y$12$ZodagN8q.Kdah4l9.mq0ZuIh4NiQ1BcJ4IdJDPAzxjyAsONORnaD6',NULL,'2026-08-07 12:40:21','2026-08-07 12:58:26','2007-01-27','IND','EU Settlement','2026-07-31','2026-12-30',NULL,'photos/3c7178d5-6e40-4b3a-9e23-7b58eb351edb.jpg','KB9 DS4 CKM','2026-12-30',NULL,'C8920517',NULL,NULL),(3,'An','heyanzarkhan@gmail.com',NULL,'$2y$12$c8Y4NoWbD83/fQ5bJ8L2Nuwqu178PXZct.Q8Wp8.TMzQnkjnvCPCq',NULL,'2026-08-07 12:46:12','2026-08-07 12:59:09','1998-01-01','IND','EU Settlement','2026-08-07','2028-09-07','add','photos/1423b76c-1f99-4a8f-9b32-eb0795442516.jpg','DKE 7YR ZNT','2026-09-03',NULL,'R2575627',NULL,NULL),(4,'PAWANJIT SINGH','pp5024000@gmail.com',NULL,'$2y$12$alj2ZZScdUhHDt9RZb6uN.gP.h.bTo.LAnmM8uU9v.1B8LSKZPcn.',NULL,'2026-08-07 12:54:19','2026-08-07 12:54:19','1997-03-11','IND','EU Settlement','2026-07-31','2026-12-30',NULL,'photos/a38ec45e-526e-4447-95c6-908f9f22a9dd.jpg','MK4 KS3 LMN','2026-12-30',NULL,'Y9371843',NULL,NULL),(5,'Vhora Mohammedzakariya Yasinbhai','vahoraafjal2546@gmail.com',NULL,'$2y$12$yUGf8CHodbbtme6MhBrYie0Z1YwM48ELQBQvR4UGtrIk/fYMH3beW',NULL,'2026-08-07 12:57:43','2026-08-07 12:57:43','1993-10-26','IND','EU Settlement','2026-07-15','2026-12-14',NULL,'photos/968b905d-8fb7-4f8b-9832-a6636d2d5496.jpg','FN6 AM4 LMK','2026-11-20',NULL,'AM981307',NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'visa_db'
--

--
-- Dumping routines for database 'visa_db'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-08-07 13:02:03
