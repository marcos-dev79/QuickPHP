CREATE DATABASE  IF NOT EXISTS `standardqphp` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `standardqphp`;
-- THIS IS THE STANDARD DATABASE INSTALL FOR QUICK PHP
-- INSTALL THIS SCRIPT IN ORDER TO WORK
--
-- Host: 127.0.0.1    Database: standardqphp
-- ------------------------------------------------------
-- Server version	5.5.49-0ubuntu0.14.04.1

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
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '{"display_name":"ID", "required":"false", "mask":"false", "DOM":"input", "readonly":"true", "list":"true"}',
  `table` varchar(45) COLLATE utf8_bin DEFAULT NULL COMMENT '{"display_name":"Table in DB", "required":"true", "mask":"false", "DOM":"input", "list":"true"}',
  `display_name` varchar(60) COLLATE utf8_bin DEFAULT NULL COMMENT '{"display_name":"Display Name", "required":"true", "mask":"false", "DOM":"input", "list":"true"}',
  `url` varchar(120) COLLATE utf8_bin DEFAULT NULL COMMENT '{"display_name":"URL", "required":"true", "mask":"false", "DOM":"input", "list":"true"}',
  `father` int(11) DEFAULT NULL COMMENT '{"display_name":"Father Menu", "required":"false", "mask":"false", "DOM":"input", "list":"true"}',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '{"display_name":"Updated At", "required":"false", "mask":"false", "class":"datepicker", "DOM":"input", "readonly":"true", "list":"true"}',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '{"display_name":"Created At", "required":"false", "mask":"false", "class":"datepicker", "DOM":"input", "readonly":"true", "list":"true"}',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT '{"display_name":"Deleted At", "required":"false", "mask":"false", "class":"datepicker", "DOM":"input", "readonly":"true"}',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='{"display_name":"Menu", "type":"storage", "display_fk":"table"}';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,'users','Users','/listing/users',0,'2019-03-25 01:56:02','2019-03-25 01:56:02',NULL);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type`
--

DROP TABLE IF EXISTS `type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '{"display_name":"ID", "required":"false", "mask":"false", "DOM":"input", "readonly":"true", "list":"true"}',
  `description` varchar(120) COLLATE utf8_bin DEFAULT NULL COMMENT '{"display_name":"Description", "required":"true", "mask":"false", "DOM":"input", "list":"true"}',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '{"display_name":"Created At", "required":"false", "mask":"false", "class":"datepicker", "DOM":"input", "readonly":"true"}',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '{"display_name":"Updated At", "required":"false", "mask":"false", "class":"datepicker", "DOM":"input", "readonly":"true"}',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT '{"display_name":"Deleted At", "required":"false", "mask":"false", "class":"datepicker", "DOM":"input", "readonly":"true"}',
  `active` int(11) DEFAULT NULL COMMENT '{"display_name":"Active", "mask":"false", "DOM":"checkbox"}',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='{"display_name":"User Types", "type":"userdata", "display_fk":"description"}';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type`
--

LOCK TABLES `type` WRITE;
/*!40000 ALTER TABLE `type` DISABLE KEYS */;
INSERT INTO `type` VALUES (1,'Standard',NULL,NULL,NULL,1),(2,'Administrator',NULL,NULL,NULL,1),(3,'Client','2016-04-21 12:53:04','2016-04-21 12:53:04',NULL,1);
/*!40000 ALTER TABLE `type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '{"display_name":"ID", "required":"false", "mask":"false", "DOM":"input", "readonly":"true", "list":"true"}',
  `type` int(11) DEFAULT NULL COMMENT '{"display_name":"User Type", "required":"false", "mask":"false", "DOM":"select", "link_fk":"type", "list":"true"}',
  `name` varchar(200) COLLATE utf8_bin DEFAULT NULL COMMENT '{"display_name":"Name", "required":"true", "mask":"false", "DOM":"input", "list":"true"}',
  `email` varchar(120) COLLATE utf8_bin DEFAULT NULL COMMENT '{"display_name":"E-Mail", "required":"true", "mask":"false", "DOM":"email", "list":"true"}',
  `password` text COLLATE utf8_bin COMMENT '{"display_name":"Password", "required":"true", "mask":"false", "DOM":"password"}',
  `birthday` date DEFAULT NULL COMMENT '{"display_name":"Birthday", "required":"true", "mask":"false", "class":"datepicker", "DOM":"input", "list":"true"}',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '{"display_name":"Created At", "required":"false", "mask":"false", "class":"datepicker", "DOM":"input", "readonly":"true", "list":"true"}',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '{"display_name":"Updated At", "required":"false", "mask":"false", "class":"datepicker", "DOM":"input", "readonly":"true", "list":"true"}',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT '{"display_name":"Deleted At", "required":"false", "mask":"false", "class":"datepicker", "DOM":"input", "readonly":"true"}',
  `active` int(11) DEFAULT NULL COMMENT '{"display_name":"Active", "mask":"false", "DOM":"checkbox", "list":"true"}',
  PRIMARY KEY (`id`),
  KEY `fk_users_type_idx` (`type`) COMMENT 'FK',
  CONSTRAINT `fk_users_type` FOREIGN KEY (`type`) REFERENCES `type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='{"display_name":"Users", "type":"userdata", "display_fk":"name"}';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,2,'Admin User','admin@admin.com','$2y$10$YE8qLqSjrX99hA7xnqZ2pe/D3n9.7MfP4yTlzd8nDn4C2p0tqQ/dC','1979-11-04','2016-04-14 15:37:00',NULL,NULL,1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;


CREATE TABLE `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '{"display_name":"ID", "required":"false", "mask":"false", "DOM":"input", "readonly":"true", "list":"true"}',
  `log` text COLLATE utf8_bin COMMENT '{"display_name":"Log Message", "required":"true", "mask":"false", "DOM":"textarea", "readonly":"true", "tinymce":"false", "list":"true"}',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '{"display_name":"Created At", "required":"false", "mask":"false", "class":"datepicker", "DOM":"input", "readonly":"true"}',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '{"display_name":"Updated At", "required":"false", "mask":"false", "class":"datepicker", "DOM":"input", "readonly":"true"}',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT '{"display_name":"Deleted At", "required":"false", "mask":"false", "class":"datepicker", "DOM":"input", "readonly":"true"}',
  `active` int(11) DEFAULT NULL COMMENT '{"display_name":"Active", "mask":"false", "DOM":"checkbox", "readonly":"true"}',
  `user` int(11) DEFAULT NULL COMMENT '{"display_name":"User", "required":"true", "mask":"false", "readonly":"true","DOM":"select", "link_fk":"users", "list":"true"}',
  `table` varchar(120) COLLATE utf8_bin DEFAULT NULL COMMENT '{"display_name":"Table Changed", "required":"true", "mask":"false", "DOM":"input","readonly":"true", "tinymce":"false", "list":"true"}',
  `recordid` int(11) DEFAULT NULL COMMENT '{"display_name":"Record ID", "required":"false", "mask":"false", "DOM":"input", "readonly":"true", "list":"true"}',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='{"display_name":"System Logs", "type":"userdata", "display_fk":"log"}';





/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-04-27 17:00:43
