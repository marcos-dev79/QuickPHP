CREATE DATABASE  IF NOT EXISTS `quickphp` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `quickphp`;
-- MySQL dump 10.13  Distrib 5.5.49, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: nolx
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
-- Table structure for table `deals`
--

DROP TABLE IF EXISTS `deals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deals` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '{"display_name":"Num. Identificação", "required":"false", "mask":"false", "DOM":"input", "readonly":"true","list":"true"}',
  `users` int(11) DEFAULT NULL COMMENT '{"display_name":"Usuário", "required":"true", "mask":"false", "DOM":"select", "link_fk":"users", "list":"true"}',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '{"display_name":"Criado em", "required":"false", "mask":"false", "class":"datepicker", "DOM":"input", "readonly":"true", "list":"true"}',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '{"display_name":"Atualizado em", "required":"false", "mask":"false", "class":"datepicker", "DOM":"input", "readonly":"true", "list":"true"}',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT '{"display_name":"Deletado em", "required":"false", "mask":"false", "class":"datepicker", "DOM":"input", "readonly":"true"}',
  `active` int(11) DEFAULT NULL COMMENT '{"display_name":"Ativo", "mask":"false", "DOM":"checkbox", "list":"true"}',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='{"display_name":"Vendas", "type":"storage", "display_fk":"id", "link_n":["products"]}';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deals`
--

LOCK TABLES `deals` WRITE;
/*!40000 ALTER TABLE `deals` DISABLE KEYS */;
INSERT INTO `deals` VALUES (1,2,'2016-04-18 13:37:10','2016-04-24 16:08:48',NULL,1),(2,3,'2016-04-24 01:06:43','2016-04-24 16:08:42',NULL,1);
/*!40000 ALTER TABLE `deals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deals_products`
--

DROP TABLE IF EXISTS `deals_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deals_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '{"display_name":"Num. Identificação", "required":"false", "mask":"false", "DOM":"input", "readonly":"true","list":"true"}',
  `products` int(11) DEFAULT NULL COMMENT '{"display_name":"Produto", "required":"false", "mask":"false", "DOM":"select", "link_fk":"products", "list":"true"}',
  `deals` int(11) DEFAULT NULL COMMENT '{"display_name":"Venda", "required":"false", "mask":"false", "DOM":"select", "link_fk":"deals", "list":"true"}',
  `active` int(11) DEFAULT NULL COMMENT '{"display_name":"Ativo", "mask":"false", "DOM":"checkbox", "list":"true"}',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '{"display_name":"Criado em", "required":"false", "mask":"false", "class":"datepicker", "DOM":"input", "readonly":"true", "list":"true"}',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '{"display_name":"Atualizado em", "required":"false", "mask":"false", "class":"datepicker", "DOM":"input", "readonly":"true", "list":"true"}',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT '{"display_name":"Deletado em", "required":"false", "mask":"false", "class":"datepicker", "DOM":"input", "readonly":"true"}',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='{"display_name":"Produtos da Venda", "type":"storage"}';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deals_products`
--

LOCK TABLES `deals_products` WRITE;
/*!40000 ALTER TABLE `deals_products` DISABLE KEYS */;
INSERT INTO `deals_products` VALUES (1,1,1,1,'2016-04-18 13:37:10','2016-04-26 18:27:36','2016-04-26 18:27:36'),(2,2,1,1,'2016-04-18 13:37:10','2016-04-26 18:27:33','2016-04-26 18:27:33'),(3,4,1,1,'2016-04-26 01:24:31','2016-04-26 18:27:27','2016-04-26 18:27:27'),(4,3,2,1,'2016-04-26 01:24:55','2016-04-26 18:06:49','2016-04-26 18:06:49'),(5,1,1,1,'2016-04-26 18:37:27','2016-04-26 19:31:00','2016-04-26 19:31:00'),(6,1,1,1,'2016-04-26 19:46:04','2016-04-26 19:50:48','2016-04-26 19:50:48'),(7,1,1,1,'2016-04-27 11:53:26','2016-04-27 11:53:26',NULL);
/*!40000 ALTER TABLE `deals_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '{"display_name":"Número de Identificação", "required":"false", "mask":"false", "DOM":"input", "readonly":"true", "list":"true"}',
  `table` varchar(45) COLLATE utf8_bin DEFAULT NULL COMMENT '{"display_name":"Tabela no BD", "required":"true", "mask":"false", "DOM":"input", "list":"true"}',
  `display_name` varchar(60) COLLATE utf8_bin DEFAULT NULL COMMENT '{"display_name":"Nome Exibição", "required":"true", "mask":"false", "DOM":"input", "list":"true"}',
  `url` varchar(120) COLLATE utf8_bin DEFAULT NULL COMMENT '{"display_name":"URL", "required":"true", "mask":"false", "DOM":"input", "list":"true"}',
  `father` int(11) DEFAULT NULL COMMENT '{"display_name":"Menu Pai", "required":"false", "mask":"false", "DOM":"input", "list":"true"}',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '{"display_name":"Atualizado em", "required":"false", "mask":"false", "class":"datepicker", "DOM":"input", "readonly":"true", "list":"true"}',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '{"display_name":"Criado em", "required":"false", "mask":"false", "class":"datepicker", "DOM":"input", "readonly":"true", "list":"true"}',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT '{"display_name":"Deletado em", "required":"false", "mask":"false", "class":"datepicker", "DOM":"input", "readonly":"true"}',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='{"display_name":"Menu", "type":"storage", "display_fk":"table"}';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,'users','Usuários','/listing/users',0,'2016-04-25 01:56:02','2016-04-25 01:56:02',NULL),(2,'products','Produtos','/listing/products',0,'2016-04-25 01:58:56','2016-04-25 01:58:56','0000-00-00 00:00:00'),(3,'products','Produtos','/listing/products',0,'2016-04-25 02:03:40','2016-04-25 02:03:25',NULL),(4,'deals','Vendas','/listing/deals',0,'2016-04-25 02:42:06','2016-04-25 02:42:06',NULL);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '{"display_name":"Num. Identificação", "required":"false", "mask":"false", "DOM":"input", "readonly":"true", "list":"true"}',
  `description` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '{"display_name":"Descrição", "required":"true", "mask":"false", "DOM":"input", "list":"true"}',
  `long_description` text COLLATE utf8_bin COMMENT '{"display_name":"Descrição Longa", "required":"false", "mask":"false", "DOM":"textarea", "tinymce":"false", "list":"true"}',
  `price` float DEFAULT NULL COMMENT '{"display_name":"Preço", "required":"true", "mask":"price", "DOM":"input", "list":"true"}',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '{"display_name":"Criado em", "required":"false", "mask":"false", "class":"datepicker", "DOM":"input", "readonly":"true"}',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '{"display_name":"Atualizado em", "required":"false", "mask":"false", "class":"datepicker", "DOM":"input", "readonly":"true"}',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT '{"display_name":"Deletado em", "required":"false", "mask":"false", "class":"datepicker", "DOM":"input", "readonly":"true"}',
  `image_path` varchar(120) COLLATE utf8_bin DEFAULT NULL COMMENT '{"display_name":"Imagem", "mask":"false", "DOM":"upload", "list":"true", "upload_type":"image/jpeg", "upload_msg":"Apenas arquivos JPG"}',
  `active` int(11) DEFAULT NULL COMMENT '{"display_name":"Ativo", "mask":"false", "DOM":"checkbox", "list":"true"}',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='{"display_name":"Produtos", "type":"storage", "display_fk":"description"}';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Product1','Product 1 Description',12000.6,'2016-04-18 13:37:10','2016-04-18 13:37:10',NULL,NULL,1),(2,'My Product2','My Product Description2',18359.7,'2016-04-18 13:37:10','2016-04-24 02:06:12',NULL,NULL,1),(3,'Product Special','Special Product',123.12,'2016-04-21 13:22:21','2016-04-21 13:22:21',NULL,NULL,1),(4,'Testing Plot','testing a new product',1234,'2016-04-26 01:21:33','2016-04-26 01:21:33',NULL,NULL,1),(5,'Test3','test3',1231,'2016-04-27 17:12:57','2016-04-27 17:12:57',NULL,NULL,1),(6,'Test366','6666666',666,'2016-04-27 17:55:07','2016-04-27 17:55:07',NULL,NULL,1),(7,'Test366','6666666',666,'2016-04-27 18:01:09','2016-04-27 18:01:09',NULL,NULL,1),(8,'Test3664444','44444',444,'2016-04-27 18:01:41','2016-04-27 18:01:41',NULL,NULL,1),(9,'Test3664444','44444',444,'2016-04-27 18:04:23','2016-04-27 18:04:23',NULL,NULL,1),(10,'Test3664444','44444',444,'2016-04-27 18:15:05','2016-04-27 18:21:01','2016-04-27 18:21:01',NULL,1),(11,'warrrr','arararra',423423,'2016-04-27 18:16:35','2016-04-27 18:16:35',NULL,NULL,1),(12,'warrrr','arararra',423423,'2016-04-27 18:16:59','2016-04-27 18:16:59',NULL,NULL,1),(13,'warrrr','arararra',423423,'2016-04-27 18:17:19','2016-04-27 18:17:19',NULL,'Uploads/products/MjA2NDgxODA3OTQ3.jpg',1),(14,'rrrr','rrrr jkjj',444,'2016-04-27 19:45:28','2016-04-27 19:55:25',NULL,'Uploads/products/MjkzMzMwNzE2Mjk2.jpg',1);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type`
--

DROP TABLE IF EXISTS `type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '{"display_name":"Num. Identificação", "required":"false", "mask":"false", "DOM":"input", "readonly":"true", "list":"true"}',
  `description` varchar(120) COLLATE utf8_bin DEFAULT NULL COMMENT '{"display_name":"Descrição", "required":"true", "mask":"false", "DOM":"input", "list":"true"}',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '{"display_name":"Criado em", "required":"false", "mask":"false", "class":"datepicker", "DOM":"input", "readonly":"true"}',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '{"display_name":"Atualizado em", "required":"false", "mask":"false", "class":"datepicker", "DOM":"input", "readonly":"true"}',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT '{"display_name":"Deletado em", "required":"false", "mask":"false", "class":"datepicker", "DOM":"input", "readonly":"true"}',
  `active` int(11) DEFAULT NULL COMMENT '{"display_name":"Ativo", "mask":"false", "DOM":"checkbox"}',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='{"display_name":"Tipos de Usuários", "type":"userdata", "display_fk":"description"}';
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
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '{"display_name":"Num. Identificação", "required":"false", "mask":"false", "DOM":"input", "readonly":"true", "list":"true"}',
  `type` int(11) DEFAULT NULL COMMENT '{"display_name":"Tipo de Usuário", "required":"false", "mask":"false", "DOM":"select", "link_fk":"type", "list":"true"}',
  `name` varchar(200) COLLATE utf8_bin DEFAULT NULL COMMENT '{"display_name":"Nome", "required":"true", "mask":"false", "DOM":"input", "list":"true"}',
  `email` varchar(120) COLLATE utf8_bin DEFAULT NULL COMMENT '{"display_name":"E-Mail", "required":"true", "mask":"false", "DOM":"email", "list":"true"}',
  `password` text COLLATE utf8_bin COMMENT '{"display_name":"Senha", "required":"true", "mask":"false", "DOM":"password"}',
  `birthday` date DEFAULT NULL COMMENT '{"display_name":"Nascimento", "required":"true", "mask":"false", "class":"datepicker", "DOM":"input", "list":"true"}',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '{"display_name":"Criado em", "required":"false", "mask":"false", "class":"datepicker", "DOM":"input", "readonly":"true", "list":"true"}',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '{"display_name":"Atualizado em", "required":"false", "mask":"false", "class":"datepicker", "DOM":"input", "readonly":"true", "list":"true"}',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT '{"display_name":"Deletado em", "required":"false", "mask":"false", "class":"datepicker", "DOM":"input", "readonly":"true"}',
  `active` int(11) DEFAULT NULL COMMENT '{"display_name":"Ativo", "mask":"false", "DOM":"checkbox", "list":"true"}',
  PRIMARY KEY (`id`),
  KEY `fk_users_type_idx` (`type`) COMMENT 'FK',
  CONSTRAINT `fk_users_type` FOREIGN KEY (`type`) REFERENCES `type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='{"display_name":"Usuários", "type":"userdata", "display_fk":"name"}';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,2,'Marcos Riso','mriso@intelitica.com','$2y$10$YE8qLqSjrX99hA7xnqZ2pe/D3n9.7MfP4yTlzd8nDn4C2p0tqQ/dC','1979-11-04','2016-04-14 15:37:00',NULL,NULL,1);
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

-- Dump completed on 2016-04-27 17:00:43
