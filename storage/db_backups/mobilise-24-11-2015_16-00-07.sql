-- MySQL dump 10.13  Distrib 5.6.27, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: mobilise
-- ------------------------------------------------------
-- Server version	5.6.27-0ubuntu0.14.04.1

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
-- Table structure for table `contact_group`
--

DROP TABLE IF EXISTS `contact_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact_group` (
  `contact_id` int(11) unsigned NOT NULL,
  `group_id` int(11) unsigned NOT NULL,
  KEY `contact_id` (`contact_id`),
  KEY `group_id` (`group_id`),
  CONSTRAINT `contact_group_ibfk_1` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `contact_group_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_group`
--

LOCK TABLES `contact_group` WRITE;
/*!40000 ALTER TABLE `contact_group` DISABLE KEYS */;
INSERT INTO `contact_group` VALUES (59,2),(60,3),(61,3),(62,3),(64,3),(67,14),(69,14);
/*!40000 ALTER TABLE `contact_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `gsm` varchar(18) NOT NULL,
  `firstname` varchar(25) DEFAULT NULL,
  `lastname` varchar(25) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `birthdate` timestamp NULL DEFAULT NULL,
  `custom` text,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `gsm` (`gsm`),
  KEY `user_id` (`user_id`),
  KEY `user_id_2` (`user_id`),
  CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` VALUES (56,2,'08029449492','aderonke','','','0000-00-00 00:00:00',NULL,'2015-08-08 23:06:01','2015-09-26 12:38:31'),(57,2,'08099440165','Olumercy',NULL,NULL,NULL,NULL,'2015-08-13 16:13:05','2015-08-13 16:13:05'),(58,2,'08039012000','Consol Limited','','','0000-00-00 00:00:00',NULL,'2015-08-14 15:48:57','2015-09-02 17:59:33'),(59,2,'08038154647','feyi','','','0000-00-00 00:00:00','','2015-08-14 17:58:32','2015-08-14 17:58:32'),(60,2,'08124589856','shankar','','','0000-00-00 00:00:00','','2015-08-14 18:01:05','2015-08-14 18:01:05'),(61,2,'080388586984','bamgboye','','','0000-00-00 00:00:00','','2015-08-14 18:01:36','2015-08-14 18:01:36'),(62,2,'08022478965','Muse','Akinwale','muse@gmail.com','0000-00-00 00:00:00','a prefect, religious and a clown in school','2015-08-14 18:03:39','2015-08-14 18:03:39'),(63,2,'08069874454','kenny','davies','kenny@gmail.com',NULL,NULL,'2015-08-15 12:39:43','2015-08-15 12:39:43'),(64,2,'08022334015','larmar','','','0000-00-00 00:00:00','','2015-09-01 23:29:38','2015-09-01 23:29:38'),(66,2,'08016589987','yommi',NULL,NULL,NULL,NULL,'2015-09-02 17:14:44','2015-09-02 17:14:44'),(67,1,'08091002541','Bisi','','','0000-00-00 00:00:00','','2015-10-14 10:32:34','2015-10-14 10:32:34'),(68,1,'08020050012','adebola',NULL,NULL,NULL,NULL,'2015-10-14 10:34:33','2015-10-14 10:34:33'),(69,1,'08033452541','jayjay','','','0000-00-00 00:00:00','','2015-10-19 17:40:15','2015-10-19 17:40:15');
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` text COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faq`
--

DROP TABLE IF EXISTS `faq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faq` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `answer` text COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  `visibility` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faq`
--

LOCK TABLES `faq` WRITE;
/*!40000 ALTER TABLE `faq` DISABLE KEYS */;
INSERT INTO `faq` VALUES (1,'What is PayQuic?','PayQuic is a secure and easy to use online portal that facilitates quick payment for various virtual goods and services such as airtime and bills.',1,1,'2015-03-23 14:51:24','2015-03-26 15:50:20',NULL),(2,'How does PayQuic service work?','<strong>Using PayQuic is easy: </strong><br />\nTo buyairtime:\n<ul>\n<li>Log in into your account or sign up for a free PayQuic account. </li>\n<li>Enter amount, your recipient\'s phone number & your own payment information (You can pay with debit cards, credit cards or your PayQuic balance).</li>\n<li>Verify all the information entered in step above and hit Complete to finish the transaction.</li>\n<li>Receive confirmation of the transaction. With PayQuic, you can send as little as N200. We typically deliver within a minute.</li>\n</ul>',2,1,'2015-03-23 20:26:14','2015-03-26 15:50:31',NULL),(3,'What are the benefits of using PayQuic','<ul>\r\n<li>You can enjoy discounts/rewards, accumulate usage points, referral points, etc </li>\r\n<li>You can enjoy convenience of payments at home, at work, at school, and on the go</li>\r\n<li>No risk of carrying cash</li>\r\n<li>Airtime loan for qualified users</li>\r\n</ul>',3,1,'2015-03-23 20:30:36','2015-03-26 15:50:57',NULL),(4,'Why do I need to fund my Account?','Funding your account/PayQuic balance beforehand allows you to complete transactions quickly using the balance on your account without the need to enter payment details every time. This is especially important if you will be making many small transactions often.\r\n<ul>\r\n<li>PayQuic balance is an efficient and fast way to carry out transactions online without using your card.</li>\r\n<li>It provides the advantage of spending only what you have put aside, instead of spending all that is in your account</li>\r\n<li>It enables you to perform quicker transactions.</li>\r\n</ul>',4,1,'2015-03-25 20:24:30','2015-03-26 15:51:13',NULL),(5,'How soon will transaction be completed?','Transactions can be completed in as little as 30secs for virtual products such as airtime.<br />\r\nIn addition PayQuic may put suspicious orders on hold until we carry out further verification which may create a slight delay.',5,1,'2015-03-26 15:52:04','2015-03-26 16:00:57',NULL),(6,'How will my purchased item(s) be delivered?','For virtual products such as airtime or bill payment, PayQuic delivers the items directly to your device or biller and provide an order number for tracking purpose. You will also receive payment and delivery notifications via email.',6,1,'2015-03-26 15:52:25','2015-03-26 15:52:25',NULL),(7,'How can I ensure prompt delivery?','Please ensure that recipient information is correct as inaccurate and otherwise incomplete recipient information may significantly delay your transaction. Wrong recipient information may cause products to be delivered to wrong number or account especially for auto-delivery items;<br/>PayQuic will not be liable for inadvertent entry of wrong recipient information.',7,1,'2015-03-26 15:53:05','2015-03-26 15:53:05',NULL),(8,'What are the fees for this service?','There are no fees for Airtime purchase. A nominal fee is charged for providing PayQuic\'s bill payment services and fees vary depending on the service purchased; Fees charged for funds transfer are seen only after signing up or logging in and are very competitive.',8,1,'2015-03-26 15:55:41','2015-03-26 15:55:41',NULL),(9,'What forms of payment do you accept?','We accept Debit & Credit cards (Visa, MasterCard, American Express and Discover) and will soon accept ACH as well.\r\n<br />\r\nWe may accept other forms of payment in the future; accepted methods of payment will be updated on the PayQuic web site.',9,1,'2015-03-26 15:56:04','2015-03-26 16:14:34',NULL),(10,'What restrictions are applicable in using PayQuic\'s money transfer and ecommerce transactions?','PayQuic.com prohibits the use of her services to directly or indirectly fund illegal activities including but not limited to money laundering, support of terrorist activities, fraudulent sales, solicitations, or theft. In compliance with the law, we are required to gather additional information in certain transactions that meet the criteria of corresponding regulations.\r\n<br />\r\nPayQuic.com does not permit the Service to be used for the improper, unlawful, or fraudulent transfers of funds (\"Unauthorized Transactions\"). Any incidents of Unauthorized Transactions are subject to prosecution to the full extent of the law. International Beneficiaries of funds acquired through Unauthorized Transactions may also be subject to civil penalties and/or criminal prosecution in their country of residence including, but not limited to, the repossession of the total funds delivered and received as a result of an Unauthorized Transaction.',10,1,'2015-03-26 15:56:45','2015-03-26 16:15:48',NULL);
/*!40000 ALTER TABLE `faq` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forex_rates`
--

DROP TABLE IF EXISTS `forex_rates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forex_rates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `cbn_buy` decimal(5,2) NOT NULL,
  `cbn_sell` decimal(5,2) NOT NULL,
  `interbank_buy` decimal(5,2) NOT NULL,
  `interbank_sell` decimal(5,2) NOT NULL,
  `parallel_buy` decimal(5,2) DEFAULT '0.00',
  `parallel_sell` decimal(5,2) NOT NULL DEFAULT '0.00',
  `service_post` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forex_rates`
--

LOCK TABLES `forex_rates` WRITE;
/*!40000 ALTER TABLE `forex_rates` DISABLE KEYS */;
INSERT INTO `forex_rates` VALUES (4,'2015-06-24',195.90,196.90,198.03,199.03,207.30,209.10,0,'2015-06-24 16:41:49','2015-06-24 22:04:37'),(5,'2015-06-25',195.90,196.90,198.35,199.35,218.00,221.00,0,'2015-06-25 15:23:44','2015-06-25 15:24:24'),(6,'2015-06-26',195.90,196.90,198.50,199.50,218.00,221.00,1,'2015-06-26 09:59:53','2015-06-26 10:03:16'),(7,'2015-06-30',195.95,196.95,198.65,199.65,219.00,221.00,1,'2015-06-30 16:45:29','2015-06-30 16:48:26'),(8,'2015-07-10',195.95,196.95,198.70,199.70,0.00,0.00,0,'2015-07-10 11:14:47','2015-07-10 11:14:47'),(9,'2015-07-10',195.95,196.95,198.70,199.70,0.00,0.00,0,'2015-07-10 11:14:48','2015-07-10 11:14:48'),(10,'2015-07-11',195.95,196.95,196.95,197.95,0.00,0.00,0,'2015-07-11 13:33:46','2015-07-11 13:33:46'),(11,'2015-07-12',195.95,196.95,196.95,197.95,0.00,0.00,0,'2015-07-12 16:31:26','2015-07-12 16:31:26'),(12,'2015-07-13',195.95,196.95,198.50,199.50,235.00,236.00,1,'2015-07-13 10:55:02','2015-07-13 11:06:03'),(13,'2015-07-14',195.95,196.95,198.55,199.55,237.00,238.00,1,'2015-07-14 08:49:50','2015-07-14 14:45:07'),(14,'2015-07-16',195.95,196.95,198.42,199.42,238.00,241.00,1,'2015-07-16 15:06:22','2015-07-16 16:00:06'),(15,'2015-07-17',195.95,196.95,198.50,199.50,238.00,241.00,1,'2015-07-17 16:26:35','2015-07-17 16:28:16'),(16,'2015-07-21',195.95,196.95,198.75,199.75,240.00,241.00,1,'2015-07-21 10:25:32','2015-07-21 10:28:51'),(17,'2015-07-22',196.00,197.00,198.50,199.50,241.00,242.00,1,'2015-07-22 11:56:24','2015-07-22 12:09:25'),(18,'2015-07-23',196.00,197.00,197.99,198.99,0.00,0.00,0,'2015-07-23 13:49:05','2015-07-23 13:49:05'),(19,'2015-07-24',196.00,197.00,198.75,199.75,241.00,242.00,1,'2015-07-24 09:51:32','2015-07-24 09:52:30'),(20,'2015-07-27',196.00,197.00,198.52,199.52,242.00,243.00,1,'2015-07-27 13:48:18','2015-07-27 13:51:39'),(21,'2015-07-29',196.00,197.00,198.46,199.46,240.00,242.00,1,'2015-07-29 15:17:53','2015-07-29 15:40:57'),(22,'2015-07-30',196.00,197.00,198.50,199.50,240.00,242.00,1,'2015-07-30 12:50:40','2015-07-30 13:05:16'),(23,'2015-08-03',196.00,197.00,198.40,199.40,209.00,212.00,1,'2015-08-03 11:48:38','2015-08-03 11:51:45'),(24,'2015-08-05',196.00,197.00,198.38,199.38,234.00,237.00,1,'2015-08-05 15:25:37','2015-08-05 15:26:44'),(25,'2015-08-06',196.00,197.00,198.50,199.50,210.00,213.00,1,'2015-08-06 10:51:51','2015-08-06 10:52:37'),(26,'2015-08-07',196.00,197.00,198.55,199.55,213.00,217.00,1,'2015-08-07 14:09:17','2015-08-07 14:21:11'),(27,'2015-08-10',196.00,197.00,198.75,199.75,219.00,221.00,1,'2015-08-10 15:59:33','2015-08-10 16:02:00'),(28,'2015-08-11',196.00,197.00,198.75,199.75,221.00,223.00,1,'2015-08-11 14:50:48','2015-08-11 14:53:08'),(29,'2015-08-14',196.00,197.00,198.50,199.50,221.00,223.00,1,'2015-08-14 14:32:32','2015-08-14 16:13:52'),(30,'2015-08-17',196.00,197.00,198.55,199.55,219.00,222.00,1,'2015-08-17 13:04:05','2015-08-17 14:13:58'),(31,'2015-08-18',196.00,197.00,198.75,199.75,214.00,216.00,1,'2015-08-18 18:11:09','2015-08-18 18:17:15'),(32,'2015-09-02',196.00,197.00,198.50,199.50,218.00,219.00,1,'2015-09-02 13:12:25','2015-09-02 13:16:35'),(33,'2015-09-15',196.00,197.00,198.55,199.55,223.00,226.00,1,'2015-09-15 15:22:31','2015-09-15 15:23:32'),(34,'2015-09-16',196.00,197.00,198.55,199.55,223.00,226.00,1,'2015-09-16 10:41:34','2015-09-16 15:12:54'),(35,'2015-09-17',196.00,197.00,198.55,199.55,224.00,226.00,1,'2015-09-17 15:07:53','2015-09-17 15:54:06'),(38,'2015-09-18',196.00,197.00,198.45,199.45,225.00,227.00,1,'2015-09-18 11:04:35','2015-09-18 11:05:32'),(39,'2015-09-21',196.00,197.00,198.55,199.55,220.00,222.00,1,'2015-09-21 14:21:01','2015-09-21 14:21:38'),(40,'2015-09-28',196.00,197.00,198.65,199.65,220.00,222.00,1,'2015-09-28 10:24:03','2015-09-28 10:24:57'),(43,'2015-09-29',196.00,197.00,199.00,200.00,222.00,225.00,1,'2015-09-29 12:03:47','2015-09-29 12:04:43'),(44,'2015-10-02',195.95,196.95,198.05,199.05,224.00,226.00,1,'2015-10-02 09:21:29','2015-10-02 09:23:16'),(45,'2015-10-05',195.95,196.95,198.55,199.55,223.00,225.00,1,'2015-10-05 12:21:05','2015-10-05 12:21:36'),(46,'2015-10-06',196.00,197.00,198.55,199.55,223.00,225.00,1,'2015-10-06 11:51:22','2015-10-06 11:51:54'),(47,'2015-10-07',196.00,197.00,198.55,199.55,223.00,225.00,1,'2015-10-07 09:27:40','2015-10-07 09:28:41'),(48,'2015-10-08',196.00,197.00,198.75,199.75,224.00,226.00,1,'2015-10-08 09:25:25','2015-10-08 09:26:12'),(49,'2015-10-09',196.00,197.00,198.55,199.55,224.00,226.00,0,'2015-10-09 10:59:26','2015-10-09 10:59:26'),(50,'2015-10-12',196.00,197.00,198.73,199.73,224.00,226.00,1,'2015-10-12 13:38:20','2015-10-12 13:39:38'),(51,'2015-10-13',195.98,196.98,198.53,199.53,225.00,227.00,1,'2015-10-13 13:24:07','2015-10-13 13:27:12'),(52,'2015-10-14',195.98,196.98,197.99,198.99,225.00,227.00,1,'2015-10-14 08:34:05','2015-10-14 08:35:50'),(53,'2015-10-15',195.98,196.98,198.16,199.16,225.00,227.00,1,'2015-10-15 11:17:01','2015-10-15 11:17:17'),(54,'2015-10-19',196.00,197.00,198.55,199.55,224.00,226.00,1,'2015-10-19 14:01:17','2015-10-19 14:01:36'),(55,'2015-10-20',196.00,197.00,198.43,199.43,224.00,226.00,1,'2015-10-20 12:01:57','2015-10-20 12:02:35'),(56,'2015-10-21',195.98,196.98,198.75,199.75,224.00,226.00,1,'2015-10-21 09:39:30','2015-10-21 09:40:58'),(57,'2015-10-23',195.98,196.98,198.50,199.50,224.00,226.00,1,'2015-10-23 13:03:58','2015-10-23 13:04:14'),(58,'2015-10-26',196.00,197.00,198.52,199.52,224.00,226.00,1,'2015-10-26 14:16:58','2015-10-26 14:52:48'),(59,'2015-11-02',196.00,197.00,196.97,197.97,226.00,228.00,1,'2015-11-02 11:03:55','2015-11-02 11:06:45'),(60,'2015-11-03',195.98,196.98,196.67,197.67,225.00,227.00,0,'2015-11-03 11:55:18','2015-11-03 11:55:18'),(62,'2015-11-04',195.98,196.98,198.48,199.48,225.00,227.00,1,'2015-11-04 16:27:50','2015-11-04 16:28:13'),(63,'2015-11-06',196.00,197.00,198.25,199.25,228.00,231.00,1,'2015-11-06 13:48:32','2015-11-06 13:50:58'),(64,'2015-11-09',196.00,197.00,198.55,199.55,231.00,233.00,1,'2015-11-09 10:44:20','2015-11-09 10:44:46'),(65,'2015-11-11',195.98,196.98,196.55,197.55,232.00,234.00,1,'2015-11-11 12:42:35','2015-11-11 12:50:51'),(66,'2015-11-12',195.98,196.98,198.32,199.32,231.00,233.00,1,'2015-11-12 10:31:16','2015-11-12 10:31:41'),(67,'2015-11-16',196.00,197.00,197.98,198.98,230.00,232.00,0,'2015-11-16 13:01:55','2015-11-16 13:01:55'),(68,'2015-11-18',196.00,197.00,197.29,198.29,231.00,233.00,1,'2015-11-18 12:45:01','2015-11-18 13:10:27'),(69,'2015-11-19',195.97,196.97,196.50,197.50,230.00,232.00,1,'2015-11-19 16:56:07','2015-11-19 16:56:36'),(70,'2015-11-23',196.00,197.00,197.98,198.98,232.00,237.00,1,'2015-11-23 09:51:45','2015-11-23 09:52:21'),(71,'2015-11-24',196.00,197.00,198.00,199.00,235.00,239.00,1,'2015-11-24 13:04:31','2015-11-24 13:05:25');
/*!40000 ALTER TABLE `forex_rates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_name` text NOT NULL,
  `group_description` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `groups_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (2,2,'Another group','this is the group for us','2015-07-12 17:33:29','2015-07-12 17:33:29'),(3,2,'BBHS old boys','','2015-07-12 20:44:05','2015-07-12 20:44:05'),(5,2,'Another awesome group','','2015-07-12 21:13:47','2015-07-12 21:13:47'),(13,2,'INto Mobile','','2015-08-10 13:48:23','2015-08-10 13:48:23'),(14,1,'Hiv-Aids','Hiv Aids awareness group','2015-10-14 10:29:17','2015-10-14 10:29:17');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payload` text COLLATE utf8_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
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
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2015_02_14_160125_create_session_table',1),('2015_02_14_162238_create_users_details_table',1),('2015_02_14_210340_create_sms_credit_table',2),('2015_02_14_211714_create_sms_credit_usage_history_table',2),('2015_02_15_014820_create_sent_sms_history_table',3),('2015_02_18_163540_create_sms_draft-table',4),('2015_03_23_095453_create_faq_table',5),('2015_07_01_153019_create_jobs_table',6),('2015_07_25_161833_create_failed_jobs_table',7);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pricing`
--

DROP TABLE IF EXISTS `pricing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pricing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idn` varchar(5) NOT NULL,
  `lower_range` int(11) NOT NULL,
  `upper_range` int(11) NOT NULL,
  `unit_price` decimal(13,2) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pricing`
--

LOCK TABLES `pricing` WRITE;
/*!40000 ALTER TABLE `pricing` DISABLE KEYS */;
INSERT INTO `pricing` VALUES (1,'id001',100,4999,1.90,'2015-08-11 17:35:38','2015-08-11 17:35:38'),(2,'id002',5000,9999,1.80,'2015-08-11 17:36:49','2015-08-11 17:36:49'),(3,'id003',10000,49999,1.70,'2015-08-11 18:37:03','2015-08-11 18:37:03'),(4,'id004',50000,99999,1.60,'2015-08-11 18:37:33','2015-08-11 18:37:33'),(5,'id005',100000,499999,1.50,'2015-08-11 18:38:09','2015-08-11 18:38:09'),(6,'id006',500000,999999,1.40,'2015-08-11 18:38:51','2015-08-11 18:38:51'),(7,'id007',1000000,5000000,1.30,'2015-08-11 18:39:30','2015-08-11 18:39:30');
/*!40000 ALTER TABLE `pricing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sent_sms_history`
--

DROP TABLE IF EXISTS `sent_sms_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sent_sms_history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `senderid` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `recipients` text COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `schedule` timestamp NULL DEFAULT NULL,
  `response` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `delivered` int(11) NOT NULL,
  `units` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sent_sms_history_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sent_sms_history`
--

LOCK TABLES `sent_sms_history` WRITE;
/*!40000 ALTER TABLE `sent_sms_history` DISABLE KEYS */;
INSERT INTO `sent_sms_history` VALUES (1,1,'TACyouths','08094584551, 08188697770, 08038154606','Evening prayer meeting today at the church auditorium.','0000-00-00 00:00:00','message sent successfully',1,3,'2015-02-18 15:14:19','2015-02-18 15:14:19',NULL),(2,1,'testing','08188697770, 08099450165','Another message which i wanna test','0000-00-00 00:00:00','message sent successfully',1,2,'2015-03-09 13:49:40','2015-03-09 13:49:40',NULL),(3,2,'Mobiii','08188697770','test test','0000-00-00 00:00:00','message sent successfully',1,1,'2015-05-29 19:00:16','2015-05-29 19:00:16',NULL);
/*!40000 ALTER TABLE `sent_sms_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payload` text COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `sessions_id_unique` (`id`),
  KEY `sessions_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('0e7229980f68ab7339dc32ba8db267163950913e','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiR0VFaUxSbXF4SXliYjczS0NwcUhIeWNWMk1jazl3dmZqY05Rc200OSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly9sYXJhLmFwcC9ob21lIjt9czo1OiJmbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjk6Il9zZjJfbWV0YSI7YTozOntzOjE6InUiO2k6MTQyODQ3OTgyNztzOjE6ImMiO2k6MTQyODQ3NDY1MDtzOjE6ImwiO3M6MToiMCI7fX0=',1428479828,0),('3616795d5b6cd585c33ad9c4f020c82f959203d0','YTo3OntzOjY6Il90b2tlbiI7czo0MDoiSDJYbW43ZXN3OUtWbFV2U2Z1QjhuOVdRUFVvYU84cmZuSGl3M3ozciI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjIwOiJodHRwOi8vbGFyYS5hcHAvaG9tZSI7fXM6NToiZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozODoibG9naW5fODJlNWQyYzU2YmRkMDgxMTMxOGYwY2YwNzhiNzhiZmMiO2k6MjtzOjE4OiJmbGFzaF9ub3RpZmljYXRpb24iO2E6MDp7fXM6OToiX3NmMl9tZXRhIjthOjM6e3M6MToidSI7aToxNDI4NDMzNjM3O3M6MToiYyI7aToxNDI4NDE4OTQ0O3M6MToibCI7czoxOiIwIjt9fQ==',1428433638,0);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sms_credit`
--

DROP TABLE IF EXISTS `sms_credit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sms_credit` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `available_credit` decimal(6,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `sms_credit_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sms_credit`
--

LOCK TABLES `sms_credit` WRITE;
/*!40000 ALTER TABLE `sms_credit` DISABLE KEYS */;
INSERT INTO `sms_credit` VALUES (14,1,10.00,'2015-02-15 12:00:00','2015-02-15 11:00:00'),(15,2,2.00,'2015-05-30 22:28:13','2015-05-30 22:28:13'),(16,14,0.00,'2015-05-31 01:34:23','2015-05-31 01:34:23'),(17,15,0.00,'2015-05-31 01:35:33','2015-05-31 01:35:33'),(18,16,0.00,'2015-05-31 01:38:07','2015-05-31 01:38:07'),(19,17,0.00,'2015-05-31 01:39:32','2015-05-31 01:39:32'),(20,18,0.00,'2015-05-31 01:45:02','2015-05-31 01:45:02'),(21,19,0.00,'2015-05-31 01:51:50','2015-05-31 01:51:50'),(22,20,0.00,'2015-05-31 02:01:59','2015-05-31 02:01:59'),(25,26,0.00,'2015-09-20 20:44:55','2015-09-20 20:44:55'),(26,27,0.00,'2015-09-27 19:04:18','2015-09-27 19:04:18');
/*!40000 ALTER TABLE `sms_credit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sms_credit_usage_history`
--

DROP TABLE IF EXISTS `sms_credit_usage_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sms_credit_usage_history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `sms_history_id` int(11) NOT NULL,
  `used_units` int(11) NOT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `sms_credit_usage_history_user_id_foreign` (`user_id`),
  CONSTRAINT `sms_credit_usage_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sms_credit_usage_history`
--

LOCK TABLES `sms_credit_usage_history` WRITE;
/*!40000 ALTER TABLE `sms_credit_usage_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `sms_credit_usage_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sms_dlr`
--

DROP TABLE IF EXISTS `sms_dlr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sms_dlr` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `messageid` varchar(255) NOT NULL,
  `sentdate` varchar(255) NOT NULL,
  `donedate` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `gsmerrorcode` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `messageid` (`messageid`),
  KEY `messageid_2` (`messageid`),
  KEY `messageid_3` (`messageid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sms_dlr`
--

LOCK TABLES `sms_dlr` WRITE;
/*!40000 ALTER TABLE `sms_dlr` DISABLE KEYS */;
INSERT INTO `sms_dlr` VALUES (1,'2001','2015/07/29 16:00:00','2015/07/29 16:01:00','SENT','0','2015-07-30 08:31:25','2015-07-30 08:31:25'),(2,'2002','2015/07/30 16:00:00','2015/07/30 16:01:00','SENT','0','2015-07-30 10:05:53','2015-07-30 10:05:53'),(3,'145072902452425170','2015/07/30 16:00:00','2015/07/30 16:01:00','SENT','0','2015-07-30 10:11:38','2015-07-30 10:11:38');
/*!40000 ALTER TABLE `sms_dlr` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sms_draft`
--

DROP TABLE IF EXISTS `sms_draft`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sms_draft` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `sender` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `recipients` text COLLATE utf8_unicode_ci,
  `message` text COLLATE utf8_unicode_ci,
  `flash` tinyint(4) NOT NULL DEFAULT '0',
  `schedule` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sms_draft_user_id_index` (`user_id`),
  CONSTRAINT `sms_draft_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sms_draft`
--

LOCK TABLES `sms_draft` WRITE;
/*!40000 ALTER TABLE `sms_draft` DISABLE KEYS */;
INSERT INTO `sms_draft` VALUES (14,2,'BHS','08010056987','Mercy Mercy Mercy',0,NULL,'2015-08-03 15:48:13','2015-08-03 15:48:13',NULL),(17,2,'Curiousminds','08146527492,08185633740,08062382915','The project will be launched in less than 48hrs. All hands are on deck to finish up testing. Lets get two known faces test this stuff for us.',1,'2015-08-07 00:00:00','2015-08-05 11:53:52','2015-08-05 11:53:52',NULL),(19,2,'TRRRY','08099450165','Check this out',0,NULL,'2015-08-05 18:11:11','2015-08-05 18:11:11',NULL),(22,2,'Allen','08022445987','message',0,NULL,'2015-08-20 07:44:54','2015-08-20 07:44:54',NULL),(24,2,'TAC','08188697770','The message for offline use has been approved when the square was cleared and with all the effort put in. This sounds like it makes no sense but spare me and read inbetween the lines',0,NULL,'2015-10-04 21:38:11','2015-10-04 21:38:11',NULL);
/*!40000 ALTER TABLE `sms_draft` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sms_history`
--

DROP TABLE IF EXISTS `sms_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sms_history` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `sender` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `schedule` timestamp NULL DEFAULT NULL,
  `flash` tinyint(4) NOT NULL DEFAULT '0',
  `units` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `sms_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sms_history`
--

LOCK TABLES `sms_history` WRITE;
/*!40000 ALTER TABLE `sms_history` DISABLE KEYS */;
INSERT INTO `sms_history` VALUES (15,2,'MrKenny','You will get this message this time around','2015-07-02 16:44:02',0,1,'2015-07-02 17:44:02','2015-07-02 17:44:02','0000-00-00 00:00:00'),(17,2,'test_here','this is the test again','2015-07-07 16:38:41',1,2,'2015-07-07 17:38:41','2015-07-07 17:38:41','0000-00-00 00:00:00'),(18,2,'Amariya','The lord has done great in out midst','2015-07-07 16:42:19',0,2,'2015-07-07 17:42:19','2015-07-07 17:42:19','0000-00-00 00:00:00'),(20,2,'brainpower','Brain power message. very powerful','2015-07-29 02:45:23',1,1,'2015-07-29 03:45:23','2015-07-29 03:45:23','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `sms_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sms_history_recipients`
--

DROP TABLE IF EXISTS `sms_history_recipients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sms_history_recipients` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sms_history_id` int(11) unsigned NOT NULL,
  `status` varchar(4) NOT NULL,
  `messageid` varchar(99) DEFAULT NULL,
  `destination` varchar(21) NOT NULL,
  `sentdate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `donedate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `gsmerrorcode` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `sms_history_id` (`sms_history_id`),
  KEY `messageid` (`messageid`),
  KEY `messageid_2` (`messageid`),
  CONSTRAINT `sms_history_recipients_ibfk_1` FOREIGN KEY (`sms_history_id`) REFERENCES `sms_history` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sms_history_recipients`
--

LOCK TABLES `sms_history_recipients` WRITE;
/*!40000 ALTER TABLE `sms_history_recipients` DISABLE KEYS */;
INSERT INTO `sms_history_recipients` VALUES (14,15,'0','215070216440405080','2348033769900','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'2015-07-02 17:44:02','2015-07-02 17:44:02'),(15,15,'0','145070216440384439','2348188697770','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'2015-07-02 17:44:02','2015-07-02 17:44:02'),(16,17,'-22','','000000000000','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'2015-07-07 17:38:41','2015-07-07 17:38:41'),(17,17,'0','155060816184838810','2348099450165','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'2015-07-07 17:38:41','2015-07-07 17:38:41'),(18,18,'-22','','000000000000','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'2015-07-07 17:42:19','2015-07-07 17:42:19'),(19,18,'0','155060816184838810','2348099450165','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'2015-07-07 17:42:19','2015-07-07 17:42:19'),(22,20,'SENT','145072902452425170','2348099450165','2015-07-30 16:00:00','2015-07-30 16:01:00',0,'2015-07-29 03:45:23','2015-07-29 03:45:23');
/*!40000 ALTER TABLE `sms_history_recipients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  `social_auth` int(10) unsigned NOT NULL DEFAULT '0',
  `social_auth_type` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `confirmed` int(11) NOT NULL DEFAULT '0',
  `token` text COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `email` (`email`),
  KEY `username` (`username`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'shegun.babs','shegun.babs@gmail.com','$2y$10$5aqnZaPJsiCMdyjA7HlHZermtTCDbPoMg9P5A6HS7/hgROQzx3BPi',1,0,NULL,0,'','d48a9wJ3y7zMi41lchcbt3vUL0oMrEAm03iGd0FjoZcic8TVBCNJwoCLYDDW','2015-02-14 17:51:47','2015-11-09 13:30:26'),(2,'johndoe','johndoe@example.com','$2y$10$OFG2Sdk4P.w2e3JSZfD/F.quJSY/NLLYLzj8Kjt7CseJGCwGRIDdq',1,0,NULL,0,'','MRxnAlqSTuQ5vt9l9luz52pzHy0jMis77JHyKbwrfkfW4QET2reukwFR5VsV','2015-02-16 17:37:54','2015-10-22 10:08:33'),(14,'shegun','shegs@babs.com','$2y$10$anwBfobgSwZicU8l5DzJve1iZvIKLquDk8FofqAizhn1UgKfPF6hy',1,0,NULL,0,'',NULL,'2015-05-31 01:34:23','2015-05-31 01:34:23'),(15,'tunde','tunde@babs.com','$2y$10$ltrRs3sithWYFyebqHjMy.fW0lI39u2b7/.cWJd86Y2wiXQPkbNuW',1,0,NULL,0,'',NULL,'2015-05-31 01:35:32','2015-05-31 01:35:32'),(16,'dayo','dayo@test.com','$2y$10$8CqR.oj7RFLcO7smASkv0OZzz/BTOyva4d.61ta2dJt8ljTjcaqQO',1,0,NULL,0,'',NULL,'2015-05-31 01:38:07','2015-05-31 01:38:07'),(17,'ademu','ademu@test.com','$2y$10$9JdGamEqF0uEn.EXXElh7eGYD7qKIxSXPdxoxie727T3LgKsMfIwO',1,0,NULL,0,'',NULL,'2015-05-31 01:39:32','2015-05-31 01:39:32'),(18,'test','test@test.com','$2y$10$zIsRaLjqXvCf83T5OlIH2OxZAyZwxHuBou2zcV/OKHbDKu5ALo0RO',1,0,NULL,0,'',NULL,'2015-05-31 01:45:02','2015-05-31 01:45:02'),(19,'fade','fade@test.com','$2y$10$SsgYp93EFimMjuODltPqc.NUTgikjahsmz90YeaBPPvW6vVHIKSgW',1,0,NULL,0,'','0WAVRlawPAaKoBBaAMIecg90b9bqcWUruMMuYhnbgI4IoasIp3N1v7Wzo2eA','2015-05-31 01:51:50','2015-08-03 15:26:53'),(20,'olabisi','olabisi@test.com','$2y$10$Py4Bvb9GjDDl.2gJLXMm4OKjnLvg07OhEdo1o5O.5pH5XaeQiBe1C',1,0,NULL,0,'',NULL,'2015-05-31 02:01:59','2015-05-31 02:01:59'),(26,'shegun_babs','segxzyl@yahoo.co.uk','$2y$10$dumuyUWJD7OF1exG5ZwCA.PgZVLQ46sSQUuOldBjI.2VDEh3R35Eu',1,1,'facebook',0,'','bTdVusQcig1qnW34sqeLcjSTQ5jMxqluXFsOeV1myvGeKDAbx1DQ26smuEi8','2015-09-20 20:44:55','2015-09-26 12:55:00'),(27,'adewale_adekunle','adekunleadewale@gmail.com','$2y$10$CYLgOiFeAFke6NYRGaDGH.9dowFV.YvbT1cX.gRqRs7Cr02lKoTaO',1,1,'google',0,'','MnYtFxXVB5eCGkNFcbz4Gbi1Fu2cN7gMvNiKHTC2C2TC0ETvmmx3nEzpsf6b','2015-09-27 19:04:18','2015-09-27 19:04:50');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_details`
--

DROP TABLE IF EXISTS `users_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `avatar` text COLLATE utf8_unicode_ci,
  `firstname` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `dob` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `users_details_user_id_foreign` (`user_id`),
  CONSTRAINT `users_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_details`
--

LOCK TABLES `users_details` WRITE;
/*!40000 ALTER TABLE `users_details` DISABLE KEYS */;
INSERT INTO `users_details` VALUES (4,1,NULL,'see','babatunde','08038154606','plot 3009, westgate banana island, lagos','1984-01-01 00:00:00',NULL,'2015-10-17 18:52:20','2015-10-22 14:21:24'),(7,2,NULL,'johnn','doeman','08038154606',NULL,'1984-10-22 00:00:00',NULL,'2015-10-21 18:07:45','2015-11-18 13:19:41');
/*!40000 ALTER TABLE `users_details` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-11-24 15:00:07
