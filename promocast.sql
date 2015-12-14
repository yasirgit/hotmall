-- MySQL dump 10.11
--
-- Host: localhost    Database: hotmall_promocast
-- ------------------------------------------------------
-- Server version	5.0.92-community

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
-- Table structure for table `p_advertisers`
--

DROP TABLE IF EXISTS `p_advertisers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `p_advertisers` (
  `advertiser_id` int(11) NOT NULL auto_increment,
  `wlabel_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mbroker_id` int(11) default NULL,
  PRIMARY KEY  (`advertiser_id`),
  KEY `p_whitelabel_p_advertisers` (`wlabel_id`),
  KEY `p_users_p_advertisers` (`user_id`),
  KEY `p_mediabrokers_p_advertisers` (`mbroker_id`),
  CONSTRAINT `p_mediabrokers_p_advertisers` FOREIGN KEY (`mbroker_id`) REFERENCES `p_mediabrokers` (`mbroker_id`),
  CONSTRAINT `p_users_p_advertisers` FOREIGN KEY (`user_id`) REFERENCES `p_users` (`user_id`),
  CONSTRAINT `p_whitelabel_p_advertisers` FOREIGN KEY (`wlabel_id`) REFERENCES `p_whitelabel` (`wlabel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `p_advertisers`
--

LOCK TABLES `p_advertisers` WRITE;
/*!40000 ALTER TABLE `p_advertisers` DISABLE KEYS */;
INSERT INTO `p_advertisers` VALUES (1,2,3,NULL),(2,2,4,NULL),(6,2,14,NULL),(7,2,15,NULL),(8,2,16,NULL),(9,4,21,NULL),(10,4,22,NULL),(11,2,23,NULL),(12,2,24,NULL),(14,4,27,NULL),(15,2,29,7);
/*!40000 ALTER TABLE `p_advertisers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `p_autoresponders`
--

DROP TABLE IF EXISTS `p_autoresponders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `p_autoresponders` (
  `autoresponder_id` int(11) NOT NULL auto_increment,
  `wlabel_id` int(11) NOT NULL,
  `subject` varchar(250) collate utf8_unicode_ci NOT NULL,
  `message` text collate utf8_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL,
  PRIMARY KEY  (`autoresponder_id`),
  KEY `p_whitelabel_p_autoresponders` (`wlabel_id`),
  CONSTRAINT `p_whitelabel_p_autoresponders` FOREIGN KEY (`wlabel_id`) REFERENCES `p_whitelabel` (`wlabel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `p_autoresponders`
--

LOCK TABLES `p_autoresponders` WRITE;
/*!40000 ALTER TABLE `p_autoresponders` DISABLE KEYS */;
INSERT INTO `p_autoresponders` VALUES (1,2,'anyone',' ',1),(2,2,'anyone',' ',2),(3,2,'anyone',' ',3),(4,3,' ',' ',1),(5,3,' ',' ',2),(6,3,' ',' ',3),(7,4,' ',' ',1),(8,4,' ',' ',2),(9,4,' ',' ',3);
/*!40000 ALTER TABLE `p_autoresponders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `p_categories`
--

DROP TABLE IF EXISTS `p_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `p_categories` (
  `category_id` int(11) NOT NULL auto_increment,
  `parent_category_id` int(11) default '0',
  `wlabel_id` int(11) NOT NULL,
  `name` varchar(100) collate utf8_unicode_ci NOT NULL,
  `domain` varchar(100) collate utf8_unicode_ci default NULL,
  `sort_order` int(11) NOT NULL default '0',
  `icon` varchar(40) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`category_id`),
  KEY `p_whitelabel_p_categories` (`wlabel_id`),
  KEY `p_categories_p_categories` (`parent_category_id`),
  CONSTRAINT `p_categories_p_categories` FOREIGN KEY (`parent_category_id`) REFERENCES `p_categories` (`category_id`),
  CONSTRAINT `p_whitelabel_p_categories` FOREIGN KEY (`wlabel_id`) REFERENCES `p_whitelabel` (`wlabel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=235 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `p_categories`
--

LOCK TABLES `p_categories` WRITE;
/*!40000 ALTER TABLE `p_categories` DISABLE KEYS */;
INSERT INTO `p_categories` VALUES (159,NULL,2,'Where To Dine',NULL,1,NULL),(160,159,2,'American',NULL,3,NULL),(161,159,2,'BBQ',NULL,4,NULL),(162,159,2,'Chicken',NULL,2,NULL),(163,159,2,'Chinese & Japanese',NULL,5,NULL),(165,159,2,'Deli & Sandwich',NULL,6,NULL),(186,NULL,2,'Where To Play',NULL,7,NULL),(187,186,2,'Amusement Places',NULL,8,NULL),(189,186,2,'Events',NULL,9,NULL),(190,186,2,'Kids',NULL,10,NULL),(191,186,2,'Movies',NULL,11,NULL),(192,186,2,'Music',NULL,12,NULL),(193,186,2,'Night Clubs',NULL,13,NULL),(199,NULL,2,'Where To Stay',NULL,14,NULL),(200,199,2,'Apartments',NULL,15,NULL),(203,199,2,'Hotels',NULL,16,NULL),(204,NULL,2,'Find Businesses',NULL,17,NULL),(212,204,2,'Boat Dealers',NULL,18,NULL),(215,204,2,'Churches',NULL,19,NULL),(216,204,2,'Cleaning Services',NULL,20,NULL),(217,204,2,'Contractors',NULL,21,NULL),(221,204,2,'Doctors',NULL,22,NULL),(222,204,2,'Dentists',NULL,23,NULL),(223,159,2,'some','some',7,''),(224,204,2,'test11','test11',24,''),(225,199,2,'test1','test1',17,''),(226,159,2,'waleed','http://www.sourcingapparelltd.com',8,'7426605724ee8c9141ca99.png'),(227,159,2,'test','test',9,'6582332994ee90574cea98.png'),(228,NULL,2,'test','oh',1,''),(229,NULL,4,'Test','mycategory.proximitymarketingservices.net',1,'19904805464eeb61bd92dc2.PNG'),(230,229,4,'test 2','test2.proximitymarketingservices.com',1,'16627270254eee08f73088b.png'),(232,229,4,'test2b','test2b.proximitymarketingservices.net',2,''),(233,NULL,3,'sd','sd',1,''),(234,228,2,'Test 3','',1,'13918335614eef87f61d025.PNG');
/*!40000 ALTER TABLE `p_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `p_coupons`
--

DROP TABLE IF EXISTS `p_coupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `p_coupons` (
  `coupon_id` int(11) NOT NULL auto_increment,
  `listing_id` int(11) NOT NULL,
  `wlabel_id` int(11) NOT NULL,
  `code` varchar(40) collate utf8_unicode_ci NOT NULL,
  `headline` varchar(100) collate utf8_unicode_ci NOT NULL,
  `description` text collate utf8_unicode_ci,
  `url_text` varchar(100) collate utf8_unicode_ci default NULL,
  `url_link` varchar(200) collate utf8_unicode_ci default NULL,
  `expiration` varchar(40) collate utf8_unicode_ci default NULL,
  `disclaimer` varchar(255) collate utf8_unicode_ci default NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `date_expiration` date default NULL,
  PRIMARY KEY  (`coupon_id`),
  KEY `p_listings_p_coupons` (`listing_id`),
  KEY `p_whitelabel_p_coupons` (`wlabel_id`),
  CONSTRAINT `p_listings_p_coupons` FOREIGN KEY (`listing_id`) REFERENCES `p_listings` (`listing_id`),
  CONSTRAINT `p_whitelabel_p_coupons` FOREIGN KEY (`wlabel_id`) REFERENCES `p_whitelabel` (`wlabel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `p_coupons`
--

LOCK TABLES `p_coupons` WRITE;
/*!40000 ALTER TABLE `p_coupons` DISABLE KEYS */;
INSERT INTO `p_coupons` VALUES (4,9,2,'11111','Free Rabies Vaccination','Lorem ipsum dolor sit amet, consectetur adipisici elit','','','','','2011-11-01','2011-12-24','0000-00-00'),(5,12,4,'11111','First testing coupon','','','','','','2011-11-11','0000-00-00','0000-00-00'),(6,13,4,'test','test','test','test','test.com','','','0000-00-00','0000-00-00','0000-00-00');
/*!40000 ALTER TABLE `p_coupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `p_coupons_redemptions`
--

DROP TABLE IF EXISTS `p_coupons_redemptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `p_coupons_redemptions` (
  `credemption_id` int(11) NOT NULL auto_increment,
  `coupon_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `customer_id` int(11) default NULL,
  `phone` varchar(40) collate utf8_unicode_ci NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY  (`credemption_id`),
  KEY `p_coupons_p_coupons_redemptions` (`coupon_id`),
  KEY `p_employees_p_coupons_redemptions` (`employee_id`),
  KEY `p_customers_p_coupons_redemptions` (`customer_id`),
  CONSTRAINT `p_coupons_p_coupons_redemptions` FOREIGN KEY (`coupon_id`) REFERENCES `p_coupons` (`coupon_id`),
  CONSTRAINT `p_customers_p_coupons_redemptions` FOREIGN KEY (`customer_id`) REFERENCES `p_customers` (`customer_id`),
  CONSTRAINT `p_employees_p_coupons_redemptions` FOREIGN KEY (`employee_id`) REFERENCES `p_employees` (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `p_coupons_redemptions`
--

LOCK TABLES `p_coupons_redemptions` WRITE;
/*!40000 ALTER TABLE `p_coupons_redemptions` DISABLE KEYS */;
INSERT INTO `p_coupons_redemptions` VALUES (1,4,1,1,'aaa','2011-12-04 11:29:22');
/*!40000 ALTER TABLE `p_coupons_redemptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `p_customers`
--

DROP TABLE IF EXISTS `p_customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `p_customers` (
  `customer_id` int(11) NOT NULL auto_increment,
  `wlabel_id` int(11) NOT NULL,
  `first_name` varchar(100) collate utf8_unicode_ci default NULL,
  `last_name` varchar(100) collate utf8_unicode_ci default NULL,
  `email` varchar(100) collate utf8_unicode_ci NOT NULL,
  `mobile` varchar(100) collate utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL default '0',
  `date_created` datetime NOT NULL,
  `password` varchar(100) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`customer_id`),
  KEY `p_whitelabel_p_customers` (`wlabel_id`),
  CONSTRAINT `p_whitelabel_p_customers` FOREIGN KEY (`wlabel_id`) REFERENCES `p_whitelabel` (`wlabel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `p_customers`
--

LOCK TABLES `p_customers` WRITE;
/*!40000 ALTER TABLE `p_customers` DISABLE KEYS */;
INSERT INTO `p_customers` VALUES (1,2,'aaa','aaa','aaa','aaa',0,'2011-12-04 11:25:51','aaa'),(2,2,'test56','test56','test56','test56',0,'2011-12-12 01:49:07','test56'),(4,2,'bilal','test','bilalabbasee@live.com','+9236665545',0,'2011-12-15 01:56:32','bilal'),(5,2,'Keith','Webb','Drkeithwebb@gmail.com','2147287987',0,'2011-12-15 08:44:09','petdoctor1418'),(6,2,'','','Drkeithwebb@gmail.com','2147287887',0,'2011-12-17 09:41:20','igo');
/*!40000 ALTER TABLE `p_customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `p_employees`
--

DROP TABLE IF EXISTS `p_employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `p_employees` (
  `employee_id` int(11) NOT NULL auto_increment,
  `wlabel_id` int(11) NOT NULL,
  `advertiser_id` int(11) NOT NULL,
  `name` varchar(100) collate utf8_unicode_ci NOT NULL,
  `email` varchar(100) collate utf8_unicode_ci default NULL,
  `phone` varchar(40) collate utf8_unicode_ci default NULL,
  `id` varchar(40) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`employee_id`),
  KEY `p_advertisers_p_employees` (`advertiser_id`),
  KEY `p_whitelabel_p_employees` (`wlabel_id`),
  CONSTRAINT `p_advertisers_p_employees` FOREIGN KEY (`advertiser_id`) REFERENCES `p_advertisers` (`advertiser_id`),
  CONSTRAINT `p_whitelabel_p_employees` FOREIGN KEY (`wlabel_id`) REFERENCES `p_whitelabel` (`wlabel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `p_employees`
--

LOCK TABLES `p_employees` WRITE;
/*!40000 ALTER TABLE `p_employees` DISABLE KEYS */;
INSERT INTO `p_employees` VALUES (1,2,1,'mark','mark','mark','mark'),(2,4,14,'Trey Brister','webstandardcss@gmail.com','2144448750','123');
/*!40000 ALTER TABLE `p_employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `p_listings`
--

DROP TABLE IF EXISTS `p_listings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `p_listings` (
  `listing_id` int(11) NOT NULL auto_increment,
  `wlabel_id` int(11) default NULL,
  `advertiser_id` int(11) NOT NULL,
  `url` varchar(100) collate utf8_unicode_ci NOT NULL,
  `name` varchar(100) collate utf8_unicode_ci NOT NULL,
  `street_address` varchar(100) collate utf8_unicode_ci NOT NULL,
  `city` varchar(40) collate utf8_unicode_ci NOT NULL,
  `state` varchar(40) collate utf8_unicode_ci NOT NULL,
  `zip` varchar(40) collate utf8_unicode_ci NOT NULL,
  `phone` varchar(40) collate utf8_unicode_ci NOT NULL,
  `description` text collate utf8_unicode_ci,
  `logo` varchar(40) collate utf8_unicode_ci default NULL,
  `type` tinyint(4) NOT NULL default '0',
  `date_created` datetime NOT NULL,
  `mon_open` varchar(40) collate utf8_unicode_ci default NULL,
  `mon_close` varchar(40) collate utf8_unicode_ci default NULL,
  `tue_open` varchar(40) collate utf8_unicode_ci default NULL,
  `tue_close` varchar(40) collate utf8_unicode_ci default NULL,
  `wed_open` varchar(40) collate utf8_unicode_ci default NULL,
  `wed_close` varchar(40) collate utf8_unicode_ci default NULL,
  `thu_open` varchar(40) collate utf8_unicode_ci default NULL,
  `thu_close` varchar(40) collate utf8_unicode_ci default NULL,
  `fri_open` varchar(40) collate utf8_unicode_ci default NULL,
  `fri_close` varchar(40) collate utf8_unicode_ci default NULL,
  `sat_open` varchar(40) collate utf8_unicode_ci default NULL,
  `sat_close` varchar(40) collate utf8_unicode_ci default NULL,
  `sun_open` varchar(40) collate utf8_unicode_ci default NULL,
  `sun_close` varchar(40) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`listing_id`),
  KEY `p_advertisers_p_listings` (`advertiser_id`),
  KEY `p_whitelabel_p_listings` (`wlabel_id`),
  CONSTRAINT `p_advertisers_p_listings` FOREIGN KEY (`advertiser_id`) REFERENCES `p_advertisers` (`advertiser_id`),
  CONSTRAINT `p_whitelabel_p_listings` FOREIGN KEY (`wlabel_id`) REFERENCES `p_whitelabel` (`wlabel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `p_listings`
--

LOCK TABLES `p_listings` WRITE;
/*!40000 ALTER TABLE `p_listings` DISABLE KEYS */;
INSERT INTO `p_listings` VALUES (9,2,1,'petdoctor','Pet Doctor','something','something','something','something','something','Lorem ipsum dolor sit amet, consectetur adipisici elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquid ex ea commodi consequat. Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','95634ec53de519cde.jpg',0,'2011-11-13 07:03:54',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(10,2,1,'cleaning','Cleaning Service','address2','address2','address2','address2','address2','lorem ipsum','16493841424eee65aa2a839.PNG',0,'2011-11-13 07:28:54',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(12,4,9,'http://www.google.com','First listing','dfsfd','sdfs','sdfs','sdf','sdfs','','17183199284eee097b11b44.jpg',0,'2011-12-18 09:40:43',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(13,4,14,'test.com','test','P.O. Box 406','Lillian','Texas','76061','4448750','test','17523649754eeee7875f60b.PNG',1,'2011-12-19 01:28:07',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(14,2,1,'test.com','test','PO Box 406','Lillian','TX','76061-0406','2144448750','test','8729032614eef91d5d6da2.PNG',0,'2011-12-19 01:34:45',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `p_listings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `p_listings_categories`
--

DROP TABLE IF EXISTS `p_listings_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `p_listings_categories` (
  `listing_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY  (`listing_id`,`category_id`),
  KEY `p_categories_p_listings_categories` (`category_id`),
  CONSTRAINT `p_categories_p_listings_categories` FOREIGN KEY (`category_id`) REFERENCES `p_categories` (`category_id`),
  CONSTRAINT `p_listings_p_listings_categories` FOREIGN KEY (`listing_id`) REFERENCES `p_listings` (`listing_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `p_listings_categories`
--

LOCK TABLES `p_listings_categories` WRITE;
/*!40000 ALTER TABLE `p_listings_categories` DISABLE KEYS */;
INSERT INTO `p_listings_categories` VALUES (14,159),(14,160),(14,161),(14,162),(14,163),(14,165),(14,186),(14,187),(14,189),(14,190),(14,191),(14,192),(14,193),(14,199),(14,200),(14,203),(14,204),(14,212),(14,215),(10,216),(14,216),(14,217),(9,221),(14,221),(14,222),(14,223),(14,224),(14,225),(14,226),(14,227),(14,228),(12,230),(13,230),(14,234);
/*!40000 ALTER TABLE `p_listings_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `p_listings_locations`
--

DROP TABLE IF EXISTS `p_listings_locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `p_listings_locations` (
  `listing_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  PRIMARY KEY  (`listing_id`,`location_id`),
  KEY `p_locations_p_listings_locations` (`location_id`),
  CONSTRAINT `p_listings_p_listings_locations` FOREIGN KEY (`listing_id`) REFERENCES `p_listings` (`listing_id`),
  CONSTRAINT `p_locations_p_listings_locations` FOREIGN KEY (`location_id`) REFERENCES `p_locations` (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `p_listings_locations`
--

LOCK TABLES `p_listings_locations` WRITE;
/*!40000 ALTER TABLE `p_listings_locations` DISABLE KEYS */;
INSERT INTO `p_listings_locations` VALUES (9,1),(9,22),(10,22),(9,23),(10,23),(9,30),(10,30),(9,31),(10,31),(10,38),(12,65),(13,65),(14,66);
/*!40000 ALTER TABLE `p_listings_locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `p_locations`
--

DROP TABLE IF EXISTS `p_locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `p_locations` (
  `location_id` int(11) NOT NULL auto_increment,
  `parent_location_id` int(11) default '0',
  `wlabel_id` int(11) NOT NULL,
  `name` varchar(255) collate utf8_unicode_ci NOT NULL,
  `domain` varchar(150) collate utf8_unicode_ci default NULL,
  `logo` varchar(200) collate utf8_unicode_ci default NULL,
  `header_html` text collate utf8_unicode_ci NOT NULL,
  `footer_html` text collate utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY  (`location_id`),
  KEY `p_locations_p_locations` (`parent_location_id`),
  KEY `p_whitelabel_p_locations` (`wlabel_id`),
  CONSTRAINT `p_locations_p_locations` FOREIGN KEY (`parent_location_id`) REFERENCES `p_locations` (`location_id`),
  CONSTRAINT `p_whitelabel_p_locations` FOREIGN KEY (`wlabel_id`) REFERENCES `p_whitelabel` (`wlabel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `p_locations`
--

LOCK TABLES `p_locations` WRITE;
/*!40000 ALTER TABLE `p_locations` DISABLE KEYS */;
INSERT INTO `p_locations` VALUES (1,NULL,2,'Collin County','collincounty',NULL,'','',1),(22,1,2,'Plano','plano',NULL,'','',1),(23,1,2,'Princeton','princeton',NULL,'','',1),(30,NULL,2,'Dallas County','dallascounty',NULL,'','',1),(31,30,2,'Addison','addison',NULL,'','',1),(38,30,2,'Dallas','dallas',NULL,'','',1),(62,NULL,2,'Denton County','dentoncounty',NULL,'','',1),(63,62,2,'Argyle','argyle',NULL,'','',1),(64,62,2,'Aubrey','aubrey',NULL,'','',1),(65,NULL,4,'Texas','texas','','dfdg','dfg',1),(66,22,2,'Trey Location','trey445','9512457374eef8e33ca03e.PNG','test','test',1);
/*!40000 ALTER TABLE `p_locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `p_mediabrokers`
--

DROP TABLE IF EXISTS `p_mediabrokers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `p_mediabrokers` (
  `mbroker_id` int(11) NOT NULL auto_increment,
  `wlabel_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `promocode` varchar(20) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`mbroker_id`),
  KEY `p_whitelabel_p_mediabrokers` (`wlabel_id`),
  KEY `p_users_p_mediabrokers` (`user_id`),
  CONSTRAINT `p_users_p_mediabrokers` FOREIGN KEY (`user_id`) REFERENCES `p_users` (`user_id`),
  CONSTRAINT `p_whitelabel_p_mediabrokers` FOREIGN KEY (`wlabel_id`) REFERENCES `p_whitelabel` (`wlabel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `p_mediabrokers`
--

LOCK TABLES `p_mediabrokers` WRITE;
/*!40000 ALTER TABLE `p_mediabrokers` DISABLE KEYS */;
INSERT INTO `p_mediabrokers` VALUES (1,2,5,'markfric209'),(5,2,17,'ssf88'),(6,2,18,'ss895'),(7,2,28,'keitwebb93e');
/*!40000 ALTER TABLE `p_mediabrokers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `p_mediabrokers_clicks`
--

DROP TABLE IF EXISTS `p_mediabrokers_clicks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `p_mediabrokers_clicks` (
  `mbclicks_id` int(11) NOT NULL auto_increment,
  `mbroker_id` int(11) default NULL,
  `date_created` datetime NOT NULL,
  `referer` varchar(250) collate utf8_unicode_ci default NULL,
  `url` varchar(250) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`mbclicks_id`),
  KEY `p_mediabrokers_p_mediabrokers_clicks` (`mbroker_id`),
  CONSTRAINT `p_mediabrokers_p_mediabrokers_clicks` FOREIGN KEY (`mbroker_id`) REFERENCES `p_mediabrokers` (`mbroker_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `p_mediabrokers_clicks`
--

LOCK TABLES `p_mediabrokers_clicks` WRITE;
/*!40000 ALTER TABLE `p_mediabrokers_clicks` DISABLE KEYS */;
INSERT INTO `p_mediabrokers_clicks` VALUES (1,1,'2011-12-08 03:29:24','','www.proximitymarketingservices.net/?pc=markfric209'),(2,7,'2011-12-18 10:03:37','http://proximitymarketingservices.net/siteadmin','proximitymarketingservices.net/?pc=keitwebb93e');
/*!40000 ALTER TABLE `p_mediabrokers_clicks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `p_mediabrokers_commissions`
--

DROP TABLE IF EXISTS `p_mediabrokers_commissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `p_mediabrokers_commissions` (
  `mbcommission_id` int(11) NOT NULL auto_increment,
  `mbroker_id` int(11) NOT NULL,
  `pppayment_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `date_paid` datetime default NULL,
  `status` tinyint(4) default NULL,
  `paystatus` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`mbcommission_id`),
  KEY `p_mediabrokers_p_mediabrokers_commissions` (`mbroker_id`),
  KEY `p_purchased_plans_payments_p_mediabrokers_commissions` (`pppayment_id`),
  CONSTRAINT `p_mediabrokers_p_mediabrokers_commissions` FOREIGN KEY (`mbroker_id`) REFERENCES `p_mediabrokers` (`mbroker_id`),
  CONSTRAINT `p_purchased_plans_payments_p_mediabrokers_commissions` FOREIGN KEY (`pppayment_id`) REFERENCES `p_purchased_plans_payments` (`pppayment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `p_mediabrokers_commissions`
--

LOCK TABLES `p_mediabrokers_commissions` WRITE;
/*!40000 ALTER TABLE `p_mediabrokers_commissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `p_mediabrokers_commissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `p_newsletters`
--

DROP TABLE IF EXISTS `p_newsletters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `p_newsletters` (
  `newsletter_id` int(11) NOT NULL auto_increment,
  `recipients` varchar(20) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` text,
  `scheduled_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `attachment` varchar(200) default NULL,
  PRIMARY KEY  (`newsletter_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `p_newsletters`
--

LOCK TABLES `p_newsletters` WRITE;
/*!40000 ALTER TABLE `p_newsletters` DISABLE KEYS */;
INSERT INTO `p_newsletters` VALUES (1,'Advertisers','dedede','dededede','2011-12-22 12:15:23',NULL);
/*!40000 ALTER TABLE `p_newsletters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `p_payments_log`
--

DROP TABLE IF EXISTS `p_payments_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `p_payments_log` (
  `paymentlog_id` int(11) NOT NULL auto_increment,
  `date_created` datetime NOT NULL,
  `log` text collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`paymentlog_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `p_payments_log`
--

LOCK TABLES `p_payments_log` WRITE;
/*!40000 ALTER TABLE `p_payments_log` DISABLE KEYS */;
INSERT INTO `p_payments_log` VALUES (1,'2011-12-02 04:19:34','PHPSESSID = a1a1df25a83e4fe21dee844bc53cf8b0\r\n'),(2,'2011-12-02 04:21:10','PHPSESSID = a1a1df25a83e4fe21dee844bc53cf8b0\r\n'),(3,'2011-12-02 04:22:41','PHPSESSID = a1a1df25a83e4fe21dee844bc53cf8b0\r\n'),(4,'2011-12-02 04:25:33','mc_gross = 19.00\r\nprotection_eligibility = Eligible\r\naddress_status = confirmed\r\npayer_id = NG6LB6XGH4DJ2\r\naddress_street = 1 Main St\r\npayment_date = 02:25:20 Dec 02, 2011 PST\r\npayment_status = Completed\r\ncharset = windows-1252\r\naddress_zip = 95131\r\nfirst_name = Test\r\nmc_fee = 0.85\r\naddress_country_code = US\r\naddress_name = Test User\r\nnotify_version = 3.4\r\nsubscr_id = I-NMDFA2WJLKVT\r\npayer_status = verified\r\nbusiness = pselle_1322728555_biz@gmail.com\r\naddress_country = United States\r\naddress_city = San Jose\r\nverify_sign = AUPVCSEjWw5rOB9cy1FwWIa4GJyRAv-u3M5PG71jVDCqCWorsYVse7-o\r\npayer_email = pbuyer_1322728483_per@gmail.com\r\ntxn_id = 65G99744UJ3203000\r\npayment_type = instant\r\nlast_name = User\r\naddress_state = CA\r\nreceiver_email = pselle_1322728555_biz@gmail.com\r\npayment_fee = 0.85\r\nreceiver_id = W8JR25BKMUYU4\r\ntxn_type = subscr_payment\r\nitem_name = Plan Subscription\r\nmc_currency = USD\r\nitem_number = 2_1\r\nresidence_country = US\r\ntest_ipn = 1\r\ntransaction_subject = Plan Subscription\r\npayment_gross = 19.00\r\nipn_track_id = tW0d28GTnhEDRWMhWD.Q-w\r\n'),(5,'2011-12-02 04:25:46','mc_gross = 19.00\r\nprotection_eligibility = Eligible\r\naddress_status = confirmed\r\npayer_id = NG6LB6XGH4DJ2\r\naddress_street = 1 Main St\r\npayment_date = 02:25:20 Dec 02, 2011 PST\r\npayment_status = Completed\r\ncharset = windows-1252\r\naddress_zip = 95131\r\nfirst_name = Test\r\nmc_fee = 0.85\r\naddress_country_code = US\r\naddress_name = Test User\r\nnotify_version = 3.4\r\nsubscr_id = I-NMDFA2WJLKVT\r\npayer_status = verified\r\nbusiness = pselle_1322728555_biz@gmail.com\r\naddress_country = United States\r\naddress_city = San Jose\r\nverify_sign = AUPVCSEjWw5rOB9cy1FwWIa4GJyRAv-u3M5PG71jVDCqCWorsYVse7-o\r\npayer_email = pbuyer_1322728483_per@gmail.com\r\ntxn_id = 65G99744UJ3203000\r\npayment_type = instant\r\nlast_name = User\r\naddress_state = CA\r\nreceiver_email = pselle_1322728555_biz@gmail.com\r\npayment_fee = 0.85\r\nreceiver_id = W8JR25BKMUYU4\r\ntxn_type = subscr_payment\r\nitem_name = Plan Subscription\r\nmc_currency = USD\r\nitem_number = 2_1\r\nresidence_country = US\r\ntest_ipn = 1\r\ntransaction_subject = Plan Subscription\r\npayment_gross = 19.00\r\nipn_track_id = tW0d28GTnhEDRWMhWD.Q-w\r\n'),(6,'2011-12-02 04:26:08','mc_gross = 19.00\r\nprotection_eligibility = Eligible\r\naddress_status = confirmed\r\npayer_id = NG6LB6XGH4DJ2\r\naddress_street = 1 Main St\r\npayment_date = 02:25:20 Dec 02, 2011 PST\r\npayment_status = Completed\r\ncharset = windows-1252\r\naddress_zip = 95131\r\nfirst_name = Test\r\nmc_fee = 0.85\r\naddress_country_code = US\r\naddress_name = Test User\r\nnotify_version = 3.4\r\nsubscr_id = I-NMDFA2WJLKVT\r\npayer_status = verified\r\nbusiness = pselle_1322728555_biz@gmail.com\r\naddress_country = United States\r\naddress_city = San Jose\r\nverify_sign = AUPVCSEjWw5rOB9cy1FwWIa4GJyRAv-u3M5PG71jVDCqCWorsYVse7-o\r\npayer_email = pbuyer_1322728483_per@gmail.com\r\ntxn_id = 65G99744UJ3203000\r\npayment_type = instant\r\nlast_name = User\r\naddress_state = CA\r\nreceiver_email = pselle_1322728555_biz@gmail.com\r\npayment_fee = 0.85\r\nreceiver_id = W8JR25BKMUYU4\r\ntxn_type = subscr_payment\r\nitem_name = Plan Subscription\r\nmc_currency = USD\r\nitem_number = 2_1\r\nresidence_country = US\r\ntest_ipn = 1\r\ntransaction_subject = Plan Subscription\r\npayment_gross = 19.00\r\nipn_track_id = tW0d28GTnhEDRWMhWD.Q-w\r\n'),(7,'2011-12-02 04:26:15','txn_type = subscr_signup\r\nsubscr_id = I-NMDFA2WJLKVT\r\nlast_name = User\r\nresidence_country = US\r\nmc_currency = USD\r\nitem_name = Plan Subscription\r\nbusiness = pselle_1322728555_biz@gmail.com\r\namount3 = 19.00\r\nrecurring = 1\r\naddress_street = 1 Main St\r\nverify_sign = AvFV.0.njlYEtJnuRs8cLTgPD0ZKAWtSByIsHWk1VuRdMv1c2lb3Pmmg\r\npayer_status = verified\r\ntest_ipn = 1\r\npayer_email = pbuyer_1322728483_per@gmail.com\r\naddress_status = confirmed\r\nfirst_name = Test\r\nreceiver_email = pselle_1322728555_biz@gmail.com\r\naddress_country_code = US\r\npayer_id = NG6LB6XGH4DJ2\r\naddress_city = San Jose\r\nreattempt = 1\r\nitem_number = 2_1\r\naddress_state = CA\r\nsubscr_date = 02:25:15 Dec 02, 2011 PST\r\naddress_zip = 95131\r\ncharset = windows-1252\r\nnotify_version = 3.4\r\nperiod3 = 30 D\r\naddress_country = United States\r\nmc_amount3 = 19.00\r\naddress_name = Test User\r\nipn_track_id = oamsQ2CRLWA.T5WqwchdXg\r\n'),(8,'2011-12-02 04:26:28','txn_type = subscr_signup\r\nsubscr_id = I-NMDFA2WJLKVT\r\nlast_name = User\r\nresidence_country = US\r\nmc_currency = USD\r\nitem_name = Plan Subscription\r\nbusiness = pselle_1322728555_biz@gmail.com\r\namount3 = 19.00\r\nrecurring = 1\r\naddress_street = 1 Main St\r\nverify_sign = AvFV.0.njlYEtJnuRs8cLTgPD0ZKAWtSByIsHWk1VuRdMv1c2lb3Pmmg\r\npayer_status = verified\r\ntest_ipn = 1\r\npayer_email = pbuyer_1322728483_per@gmail.com\r\naddress_status = confirmed\r\nfirst_name = Test\r\nreceiver_email = pselle_1322728555_biz@gmail.com\r\naddress_country_code = US\r\npayer_id = NG6LB6XGH4DJ2\r\naddress_city = San Jose\r\nreattempt = 1\r\nitem_number = 2_1\r\naddress_state = CA\r\nsubscr_date = 02:25:15 Dec 02, 2011 PST\r\naddress_zip = 95131\r\ncharset = windows-1252\r\nnotify_version = 3.4\r\nperiod3 = 30 D\r\naddress_country = United States\r\nmc_amount3 = 19.00\r\naddress_name = Test User\r\nipn_track_id = oamsQ2CRLWA.T5WqwchdXg\r\n'),(9,'2011-12-02 04:26:51','mc_gross = 19.00\r\nprotection_eligibility = Eligible\r\naddress_status = confirmed\r\npayer_id = NG6LB6XGH4DJ2\r\naddress_street = 1 Main St\r\npayment_date = 02:25:20 Dec 02, 2011 PST\r\npayment_status = Completed\r\ncharset = windows-1252\r\naddress_zip = 95131\r\nfirst_name = Test\r\nmc_fee = 0.85\r\naddress_country_code = US\r\naddress_name = Test User\r\nnotify_version = 3.4\r\nsubscr_id = I-NMDFA2WJLKVT\r\npayer_status = verified\r\nbusiness = pselle_1322728555_biz@gmail.com\r\naddress_country = United States\r\naddress_city = San Jose\r\nverify_sign = AUPVCSEjWw5rOB9cy1FwWIa4GJyRAv-u3M5PG71jVDCqCWorsYVse7-o\r\npayer_email = pbuyer_1322728483_per@gmail.com\r\ntxn_id = 65G99744UJ3203000\r\npayment_type = instant\r\nlast_name = User\r\naddress_state = CA\r\nreceiver_email = pselle_1322728555_biz@gmail.com\r\npayment_fee = 0.85\r\nreceiver_id = W8JR25BKMUYU4\r\ntxn_type = subscr_payment\r\nitem_name = Plan Subscription\r\nmc_currency = USD\r\nitem_number = 2_1\r\nresidence_country = US\r\ntest_ipn = 1\r\ntransaction_subject = Plan Subscription\r\npayment_gross = 19.00\r\nipn_track_id = tW0d28GTnhEDRWMhWD.Q-w\r\n'),(10,'2011-12-02 04:26:51','txn_type = subscr_signup\r\nsubscr_id = I-NMDFA2WJLKVT\r\nlast_name = User\r\nresidence_country = US\r\nmc_currency = USD\r\nitem_name = Plan Subscription\r\nbusiness = pselle_1322728555_biz@gmail.com\r\namount3 = 19.00\r\nrecurring = 1\r\naddress_street = 1 Main St\r\nverify_sign = AvFV.0.njlYEtJnuRs8cLTgPD0ZKAWtSByIsHWk1VuRdMv1c2lb3Pmmg\r\npayer_status = verified\r\ntest_ipn = 1\r\npayer_email = pbuyer_1322728483_per@gmail.com\r\naddress_status = confirmed\r\nfirst_name = Test\r\nreceiver_email = pselle_1322728555_biz@gmail.com\r\naddress_country_code = US\r\npayer_id = NG6LB6XGH4DJ2\r\naddress_city = San Jose\r\nreattempt = 1\r\nitem_number = 2_1\r\naddress_state = CA\r\nsubscr_date = 02:25:15 Dec 02, 2011 PST\r\naddress_zip = 95131\r\ncharset = windows-1252\r\nnotify_version = 3.4\r\nperiod3 = 30 D\r\naddress_country = United States\r\nmc_amount3 = 19.00\r\naddress_name = Test User\r\nipn_track_id = oamsQ2CRLWA.T5WqwchdXg\r\n'),(11,'2011-12-02 04:27:35','txn_type = subscr_signup\r\nsubscr_id = I-NMDFA2WJLKVT\r\nlast_name = User\r\nresidence_country = US\r\nmc_currency = USD\r\nitem_name = Plan Subscription\r\nbusiness = pselle_1322728555_biz@gmail.com\r\namount3 = 19.00\r\nrecurring = 1\r\naddress_street = 1 Main St\r\nverify_sign = AvFV.0.njlYEtJnuRs8cLTgPD0ZKAWtSByIsHWk1VuRdMv1c2lb3Pmmg\r\npayer_status = verified\r\ntest_ipn = 1\r\npayer_email = pbuyer_1322728483_per@gmail.com\r\naddress_status = confirmed\r\nfirst_name = Test\r\nreceiver_email = pselle_1322728555_biz@gmail.com\r\naddress_country_code = US\r\npayer_id = NG6LB6XGH4DJ2\r\naddress_city = San Jose\r\nreattempt = 1\r\nitem_number = 2_1\r\naddress_state = CA\r\nsubscr_date = 02:25:15 Dec 02, 2011 PST\r\naddress_zip = 95131\r\ncharset = windows-1252\r\nnotify_version = 3.4\r\nperiod3 = 30 D\r\naddress_country = United States\r\nmc_amount3 = 19.00\r\naddress_name = Test User\r\nipn_track_id = oamsQ2CRLWA.T5WqwchdXg\r\n'),(12,'2011-12-02 04:28:13','mc_gross = 19.00\r\nprotection_eligibility = Eligible\r\naddress_status = confirmed\r\npayer_id = NG6LB6XGH4DJ2\r\naddress_street = 1 Main St\r\npayment_date = 02:25:20 Dec 02, 2011 PST\r\npayment_status = Completed\r\ncharset = windows-1252\r\naddress_zip = 95131\r\nfirst_name = Test\r\nmc_fee = 0.85\r\naddress_country_code = US\r\naddress_name = Test User\r\nnotify_version = 3.4\r\nsubscr_id = I-NMDFA2WJLKVT\r\npayer_status = verified\r\nbusiness = pselle_1322728555_biz@gmail.com\r\naddress_country = United States\r\naddress_city = San Jose\r\nverify_sign = AUPVCSEjWw5rOB9cy1FwWIa4GJyRAv-u3M5PG71jVDCqCWorsYVse7-o\r\npayer_email = pbuyer_1322728483_per@gmail.com\r\ntxn_id = 65G99744UJ3203000\r\npayment_type = instant\r\nlast_name = User\r\naddress_state = CA\r\nreceiver_email = pselle_1322728555_biz@gmail.com\r\npayment_fee = 0.85\r\nreceiver_id = W8JR25BKMUYU4\r\ntxn_type = subscr_payment\r\nitem_name = Plan Subscription\r\nmc_currency = USD\r\nitem_number = 2_1\r\nresidence_country = US\r\ntest_ipn = 1\r\ntransaction_subject = Plan Subscription\r\npayment_gross = 19.00\r\nipn_track_id = tW0d28GTnhEDRWMhWD.Q-w\r\n'),(13,'2011-12-02 04:28:57','txn_type = subscr_signup\r\nsubscr_id = I-NMDFA2WJLKVT\r\nlast_name = User\r\nresidence_country = US\r\nmc_currency = USD\r\nitem_name = Plan Subscription\r\nbusiness = pselle_1322728555_biz@gmail.com\r\namount3 = 19.00\r\nrecurring = 1\r\naddress_street = 1 Main St\r\nverify_sign = AvFV.0.njlYEtJnuRs8cLTgPD0ZKAWtSByIsHWk1VuRdMv1c2lb3Pmmg\r\npayer_status = verified\r\ntest_ipn = 1\r\npayer_email = pbuyer_1322728483_per@gmail.com\r\naddress_status = confirmed\r\nfirst_name = Test\r\nreceiver_email = pselle_1322728555_biz@gmail.com\r\naddress_country_code = US\r\npayer_id = NG6LB6XGH4DJ2\r\naddress_city = San Jose\r\nreattempt = 1\r\nitem_number = 2_1\r\naddress_state = CA\r\nsubscr_date = 02:25:15 Dec 02, 2011 PST\r\naddress_zip = 95131\r\ncharset = windows-1252\r\nnotify_version = 3.4\r\nperiod3 = 30 D\r\naddress_country = United States\r\nmc_amount3 = 19.00\r\naddress_name = Test User\r\nipn_track_id = oamsQ2CRLWA.T5WqwchdXg\r\n'),(14,'2011-12-02 04:31:41','txn_type = subscr_signup\r\nsubscr_id = I-NMDFA2WJLKVT\r\nlast_name = User\r\nresidence_country = US\r\nmc_currency = USD\r\nitem_name = Plan Subscription\r\nbusiness = pselle_1322728555_biz@gmail.com\r\namount3 = 19.00\r\nrecurring = 1\r\naddress_street = 1 Main St\r\nverify_sign = AvFV.0.njlYEtJnuRs8cLTgPD0ZKAWtSByIsHWk1VuRdMv1c2lb3Pmmg\r\npayer_status = verified\r\ntest_ipn = 1\r\npayer_email = pbuyer_1322728483_per@gmail.com\r\naddress_status = confirmed\r\nfirst_name = Test\r\nreceiver_email = pselle_1322728555_biz@gmail.com\r\naddress_country_code = US\r\npayer_id = NG6LB6XGH4DJ2\r\naddress_city = San Jose\r\nreattempt = 1\r\nitem_number = 2_1\r\naddress_state = CA\r\nsubscr_date = 02:25:15 Dec 02, 2011 PST\r\naddress_zip = 95131\r\ncharset = windows-1252\r\nnotify_version = 3.4\r\nperiod3 = 30 D\r\naddress_country = United States\r\nmc_amount3 = 19.00\r\naddress_name = Test User\r\nipn_track_id = oamsQ2CRLWA.T5WqwchdXg\r\n'),(15,'2011-12-02 04:43:16','txn_type = subscr_signup\r\nsubscr_id = I-R3H8GRDSCWDR\r\nlast_name = User\r\nresidence_country = US\r\nmc_currency = USD\r\nitem_name = Plan Subscription\r\nbusiness = pselle_1322728555_biz@gmail.com\r\namount3 = 19.00\r\nrecurring = 1\r\naddress_street = 1 Main St\r\nverify_sign = AWumPBQkNl1VS3oL5706t9cxEs-yADFawYvMbj1JWbQGoPtxGKcqQNsf\r\npayer_status = verified\r\ntest_ipn = 1\r\npayer_email = pbuyer_1322728483_per@gmail.com\r\naddress_status = confirmed\r\nfirst_name = Test\r\nreceiver_email = pselle_1322728555_biz@gmail.com\r\naddress_country_code = US\r\npayer_id = NG6LB6XGH4DJ2\r\naddress_city = San Jose\r\nreattempt = 1\r\nitem_number = 2_1\r\naddress_state = CA\r\nsubscr_date = 02:42:28 Dec 02, 2011 PST\r\naddress_zip = 95131\r\ncharset = windows-1252\r\nnotify_version = 3.4\r\nperiod3 = 30 D\r\naddress_country = United States\r\nmc_amount3 = 19.00\r\naddress_name = Test User\r\nipn_track_id = AGyNmFsUu0vrgQXLYEO0ow\r\n'),(16,'2011-12-02 04:49:46','mc_gross = 19.00\r\nprotection_eligibility = Eligible\r\naddress_status = confirmed\r\npayer_id = NG6LB6XGH4DJ2\r\naddress_street = 1 Main St\r\npayment_date = 02:49:35 Dec 02, 2011 PST\r\npayment_status = Completed\r\ncharset = windows-1252\r\naddress_zip = 95131\r\nfirst_name = Test\r\nmc_fee = 0.85\r\naddress_country_code = US\r\naddress_name = Test User\r\nnotify_version = 3.4\r\nsubscr_id = I-V9UMGE24PJNE\r\npayer_status = verified\r\nbusiness = pselle_1322728555_biz@gmail.com\r\naddress_country = United States\r\naddress_city = San Jose\r\nverify_sign = AXdPP3-s-HrIWlYDYtZifLCl0JuWAC1Vi4DHeSV-lVsgJRF.YD2z5OX7\r\npayer_email = pbuyer_1322728483_per@gmail.com\r\ntxn_id = 3MG05133N89432354\r\npayment_type = instant\r\nlast_name = User\r\naddress_state = CA\r\nreceiver_email = pselle_1322728555_biz@gmail.com\r\npayment_fee = 0.85\r\nreceiver_id = W8JR25BKMUYU4\r\ntxn_type = subscr_payment\r\nitem_name = Plan Subscription\r\nmc_currency = USD\r\nitem_number = 2_1\r\nresidence_country = US\r\ntest_ipn = 1\r\ntransaction_subject = Plan Subscription\r\npayment_gross = 19.00\r\nipn_track_id = fPnhrGsB2r805E-Jqs6.FQ\r\n'),(17,'2011-12-02 04:50:24','txn_type = subscr_signup\r\nsubscr_id = I-V9UMGE24PJNE\r\nlast_name = User\r\nresidence_country = US\r\nmc_currency = USD\r\nitem_name = Plan Subscription\r\nbusiness = pselle_1322728555_biz@gmail.com\r\namount3 = 19.00\r\nrecurring = 1\r\naddress_street = 1 Main St\r\nverify_sign = AZ7Hxu-n48McObdoVTynlZvdI66NAuLMFDQB8eWQi3K5kfZbNrA8c27z\r\npayer_status = verified\r\ntest_ipn = 1\r\npayer_email = pbuyer_1322728483_per@gmail.com\r\naddress_status = confirmed\r\nfirst_name = Test\r\nreceiver_email = pselle_1322728555_biz@gmail.com\r\naddress_country_code = US\r\npayer_id = NG6LB6XGH4DJ2\r\naddress_city = San Jose\r\nreattempt = 1\r\nitem_number = 2_1\r\naddress_state = CA\r\nsubscr_date = 02:49:31 Dec 02, 2011 PST\r\naddress_zip = 95131\r\ncharset = windows-1252\r\nnotify_version = 3.4\r\nperiod3 = 30 D\r\naddress_country = United States\r\nmc_amount3 = 19.00\r\naddress_name = Test User\r\nipn_track_id = omP820rTCeJy5ZrbS5zdVA\r\n'),(18,'2011-12-02 04:54:05','txn_type = subscr_signup\r\nsubscr_id = I-8XDARF4TA1LH\r\nlast_name = User\r\nresidence_country = US\r\nmc_currency = USD\r\nitem_name = Plan Subscription\r\nbusiness = pselle_1322728555_biz@gmail.com\r\namount3 = 19.00\r\nrecurring = 1\r\naddress_street = 1 Main St\r\nverify_sign = AUAu4g1x.6htnWwmYWGPUP-CzSLsABSt18XbmPRHjBOLMaOqqOAAMgVP\r\npayer_status = verified\r\ntest_ipn = 1\r\npayer_email = pbuyer_1322728483_per@gmail.com\r\naddress_status = confirmed\r\nfirst_name = Test\r\nreceiver_email = pselle_1322728555_biz@gmail.com\r\naddress_country_code = US\r\npayer_id = NG6LB6XGH4DJ2\r\naddress_city = San Jose\r\nreattempt = 1\r\nitem_number = 2_1\r\naddress_state = CA\r\nsubscr_date = 02:53:51 Dec 02, 2011 PST\r\naddress_zip = 95131\r\ncharset = windows-1252\r\nnotify_version = 3.4\r\nperiod3 = 30 D\r\naddress_country = United States\r\nmc_amount3 = 19.00\r\naddress_name = Test User\r\nipn_track_id = piATUNaTc3o9XyknW0erNA\r\n'),(19,'2011-12-02 04:54:13','mc_gross = 19.00\r\nprotection_eligibility = Eligible\r\naddress_status = confirmed\r\npayer_id = NG6LB6XGH4DJ2\r\naddress_street = 1 Main St\r\npayment_date = 02:53:55 Dec 02, 2011 PST\r\npayment_status = Completed\r\ncharset = windows-1252\r\naddress_zip = 95131\r\nfirst_name = Test\r\nmc_fee = 0.85\r\naddress_country_code = US\r\naddress_name = Test User\r\nnotify_version = 3.4\r\nsubscr_id = I-8XDARF4TA1LH\r\npayer_status = verified\r\nbusiness = pselle_1322728555_biz@gmail.com\r\naddress_country = United States\r\naddress_city = San Jose\r\nverify_sign = AXiMFXRWkmt9OxNFdW5tF1mgblXiAVbXancjfX7akUTRdvh6otIs9tFz\r\npayer_email = pbuyer_1322728483_per@gmail.com\r\ntxn_id = 8398379027967910F\r\npayment_type = instant\r\nlast_name = User\r\naddress_state = CA\r\nreceiver_email = pselle_1322728555_biz@gmail.com\r\npayment_fee = 0.85\r\nreceiver_id = W8JR25BKMUYU4\r\ntxn_type = subscr_payment\r\nitem_name = Plan Subscription\r\nmc_currency = USD\r\nitem_number = 2_1\r\nresidence_country = US\r\ntest_ipn = 1\r\ntransaction_subject = Plan Subscription\r\npayment_gross = 19.00\r\nipn_track_id = HHo1mDI4h7gObaRcFQ2b-w\r\n'),(20,'2011-12-02 04:56:45','txn_type = subscr_signup\r\nsubscr_id = I-LW218Y4CGGF1\r\nlast_name = User\r\nresidence_country = US\r\nmc_currency = USD\r\nitem_name = Plan Subscription\r\nbusiness = pselle_1322728555_biz@gmail.com\r\namount3 = 19.00\r\nrecurring = 1\r\naddress_street = 1 Main St\r\nverify_sign = Ate.YT39DDkq5aAHdCALU45WucKOA3I-zI8GChXpTXYB8QAcYTXIweds\r\npayer_status = verified\r\ntest_ipn = 1\r\npayer_email = pbuyer_1322728483_per@gmail.com\r\naddress_status = confirmed\r\nfirst_name = Test\r\nreceiver_email = pselle_1322728555_biz@gmail.com\r\naddress_country_code = US\r\npayer_id = NG6LB6XGH4DJ2\r\naddress_city = San Jose\r\nreattempt = 1\r\nitem_number = 2_1\r\naddress_state = CA\r\nsubscr_date = 02:56:31 Dec 02, 2011 PST\r\naddress_zip = 95131\r\ncharset = windows-1252\r\nnotify_version = 3.4\r\nperiod3 = 30 D\r\naddress_country = United States\r\nmc_amount3 = 19.00\r\naddress_name = Test User\r\nipn_track_id = MbZuEQ1osH21pDThKUt2Ww\r\n'),(21,'2011-12-02 04:57:16','mc_gross = 19.00\r\nprotection_eligibility = Eligible\r\naddress_status = confirmed\r\npayer_id = NG6LB6XGH4DJ2\r\naddress_street = 1 Main St\r\npayment_date = 02:56:36 Dec 02, 2011 PST\r\npayment_status = Completed\r\ncharset = windows-1252\r\naddress_zip = 95131\r\nfirst_name = Test\r\nmc_fee = 0.85\r\naddress_country_code = US\r\naddress_name = Test User\r\nnotify_version = 3.4\r\nsubscr_id = I-LW218Y4CGGF1\r\npayer_status = verified\r\nbusiness = pselle_1322728555_biz@gmail.com\r\naddress_country = United States\r\naddress_city = San Jose\r\nverify_sign = ASl.kxkjc6DCPdrEnPiQC1WYPm-XAeTZtP9kqutQAuMFQqX6ser987RP\r\npayer_email = pbuyer_1322728483_per@gmail.com\r\ntxn_id = 97V35245JA3808620\r\npayment_type = instant\r\nlast_name = User\r\naddress_state = CA\r\nreceiver_email = pselle_1322728555_biz@gmail.com\r\npayment_fee = 0.85\r\nreceiver_id = W8JR25BKMUYU4\r\ntxn_type = subscr_payment\r\nitem_name = Plan Subscription\r\nmc_currency = USD\r\nitem_number = 2_1\r\nresidence_country = US\r\ntest_ipn = 1\r\ntransaction_subject = Plan Subscription\r\npayment_gross = 19.00\r\nipn_track_id = -Id0n2tiZDO1tZLKYObEbQ\r\n'),(22,'2011-12-18 09:41:23','mc_gross = 1.00\r\nprotection_eligibility = Eligible\r\naddress_status = confirmed\r\npayer_id = WDALKT72EMNDS\r\naddress_street = 2703 Market Center Drive\r\npayment_date = 19:41:19 Dec 18, 2011 PST\r\npayment_status = Completed\r\ncharset = windows-1252\r\naddress_zip = 75032\r\nfirst_name = Keith\r\nmc_fee = 0.33\r\naddress_country_code = US\r\naddress_name = Keith Webb\r\nnotify_version = 3.4\r\nsubscr_id = I-JGXB06VL2FPY\r\npayer_status = verified\r\nbusiness = trey@dsouth.net\r\naddress_country = United States\r\naddress_city = Rockwall\r\nverify_sign = AyKN.5DMpF9uuKe-cWr4VZT.6lGXAoE2N0dXzTbLMou8JsOL0V86f4Dd\r\npayer_email = doc@dogandcat.com\r\ntxn_id = 6VA43881TX653500U\r\npayment_type = instant\r\nlast_name = Webb\r\naddress_state = TX\r\nreceiver_email = trey@dsouth.net\r\npayment_fee = 0.33\r\nreceiver_id = BNDNJSAD6ELFQ\r\ntxn_type = subscr_payment\r\nitem_name = Plan Subscription\r\nmc_currency = USD\r\nitem_number = 10_14\r\nresidence_country = US\r\ntransaction_subject = Plan Subscription\r\npayment_gross = 1.00\r\nipn_track_id = CI9pXym8--sHxVLUyi-4cw\r\n'),(23,'2011-12-18 09:41:35','txn_type = subscr_signup\r\nsubscr_id = I-JGXB06VL2FPY\r\nlast_name = Webb\r\nresidence_country = US\r\nmc_currency = USD\r\nitem_name = Plan Subscription\r\nbusiness = trey@dsouth.net\r\namount3 = 1.00\r\nrecurring = 1\r\naddress_street = 2703 Market Center Drive\r\nverify_sign = ACyvZdQnyX7FIQLizBw0EsWqUXB8Ad3Ps8BysrCbUbfJ-gmcf.og.uaL\r\npayer_status = verified\r\npayer_email = doc@dogandcat.com\r\naddress_status = confirmed\r\nfirst_name = Keith\r\nreceiver_email = trey@dsouth.net\r\naddress_country_code = US\r\npayer_id = WDALKT72EMNDS\r\naddress_city = Rockwall\r\nreattempt = 1\r\nitem_number = 10_14\r\naddress_state = TX\r\nsubscr_date = 19:41:15 Dec 18, 2011 PST\r\naddress_zip = 75032\r\ncharset = windows-1252\r\nnotify_version = 3.4\r\nperiod3 = 20 D\r\naddress_country = United States\r\nmc_amount3 = 1.00\r\naddress_name = Keith Webb\r\nipn_track_id = Q-RAKat-gxLfDTRo3HXIpw\r\n');
/*!40000 ALTER TABLE `p_payments_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `p_plans`
--

DROP TABLE IF EXISTS `p_plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `p_plans` (
  `plan_id` int(11) NOT NULL auto_increment,
  `wlabel_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `name` varchar(100) collate utf8_unicode_ci NOT NULL,
  `duration` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  PRIMARY KEY  (`plan_id`),
  KEY `p_whitelabel_p_plans` (`wlabel_id`),
  CONSTRAINT `p_whitelabel_p_plans` FOREIGN KEY (`wlabel_id`) REFERENCES `p_whitelabel` (`wlabel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `p_plans`
--

LOCK TABLES `p_plans` WRITE;
/*!40000 ALTER TABLE `p_plans` DISABLE KEYS */;
INSERT INTO `p_plans` VALUES (1,2,2,'Standard Plan',30,'199'),(2,2,1,'Standard Advertiser Plan',30,'1'),(9,2,2,'Big Plan',365,'0'),(10,4,1,'trey plan',20,'1');
/*!40000 ALTER TABLE `p_plans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `p_plans_limits`
--

DROP TABLE IF EXISTS `p_plans_limits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `p_plans_limits` (
  `plimit_id` int(11) NOT NULL auto_increment,
  `plan_id` int(11) NOT NULL,
  `resource_type` int(11) NOT NULL,
  `limit_amount` int(11) NOT NULL,
  PRIMARY KEY  (`plimit_id`),
  KEY `p_plans_p_plans_limits` (`plan_id`),
  CONSTRAINT `p_plans_p_plans_limits` FOREIGN KEY (`plan_id`) REFERENCES `p_plans` (`plan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `p_plans_limits`
--

LOCK TABLES `p_plans_limits` WRITE;
/*!40000 ALTER TABLE `p_plans_limits` DISABLE KEYS */;
INSERT INTO `p_plans_limits` VALUES (1,1,102,10),(2,2,1,1500),(3,2,2,5),(4,2,3,10),(5,2,10,10),(8,2,1,54),(11,2,1,1000),(14,9,102,66),(15,10,2,66);
/*!40000 ALTER TABLE `p_plans_limits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `p_premiumads`
--

DROP TABLE IF EXISTS `p_premiumads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `p_premiumads` (
  `premiumad_id` int(11) NOT NULL auto_increment,
  `wlabel_id` int(11) NOT NULL,
  `advertiser_id` int(11) default NULL,
  `headline` varchar(200) collate utf8_unicode_ci NOT NULL,
  `description` text collate utf8_unicode_ci NOT NULL,
  `image` varchar(100) collate utf8_unicode_ci default NULL,
  `link_text` varchar(250) collate utf8_unicode_ci NOT NULL,
  `link_url` varchar(250) collate utf8_unicode_ci NOT NULL,
  `position` tinyint(4) NOT NULL,
  `display_type` tinyint(4) NOT NULL,
  `show_on_static` tinyint(4) default NULL,
  PRIMARY KEY  (`premiumad_id`),
  KEY `p_whitelabel_p_premiumads` (`wlabel_id`),
  KEY `p_advertisers_p_premiumads` (`advertiser_id`),
  CONSTRAINT `p_advertisers_p_premiumads` FOREIGN KEY (`advertiser_id`) REFERENCES `p_advertisers` (`advertiser_id`),
  CONSTRAINT `p_whitelabel_p_premiumads` FOREIGN KEY (`wlabel_id`) REFERENCES `p_whitelabel` (`wlabel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `p_premiumads`
--

LOCK TABLES `p_premiumads` WRITE;
/*!40000 ALTER TABLE `p_premiumads` DISABLE KEYS */;
INSERT INTO `p_premiumads` VALUES (8,2,1,'Promocast 1','The Promocast System Is An Innovative Way To Increase The Revenues Of Local Retailers While Generating More Advertising Income For You!','239614ec53c6fdf6b2.jpeg','Click Here For Details','http://www.google.com',1,1,1),(9,2,1,'Promocast 2','The Promocast System Is A Great Way For Associations and Organizations To Boost Memberships!','103344ec53cc23ac30.gif','Click Here','http://www.yahoo.com',1,1,1),(10,2,1,'Promocast 3','Malls Have Been Looking For A Cost Effective Way To Promote Their Tenants? The Promocast System Is The Answer!','10874ec53ce85e27e.jpeg','Click Here to Find Out more','http://www.promocast.com',1,1,1),(11,2,1,'Side Promo1','Advertisers On The Promocast System Will Attract More Customers, Encourage Repeat Business And Increase Their Bottom Line!','209844ec5439098db9.jpg','link','link',3,1,1),(12,2,1,'Side 2','Just Imagine Having A Targeted List Of Your Best Performing Promotions And Most Loyal Customers? You Can!','149334ec53d8605aad.jpg','Sign Up Here','http://www.bing.com',3,1,1),(13,2,1,'Bottom 1','Promocast Mobile Offers Anyone The Chance To Get In On The Ground Floor Of An Amazing Opportunity With Our Business In A Box Promotion? Ask Us How!','277544ec53dbe3ff05.jpeg','Click Here','http://www.google.com',2,1,1),(14,2,1,'Bottom 2','Your Advertiser?s Content Will Have A Prospect?s 100% Full Attention? No Other Media Can Make That Claim!','95634ec53de519cde.jpeg','Click Here For Details','http://www.promocast.com',2,1,0),(19,4,14,'Test Headline','Test Description','21315421814eeeb573cd199.PNG','Link Text','http://yahoo.com',1,1,1);
/*!40000 ALTER TABLE `p_premiumads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `p_premiumads_categories`
--

DROP TABLE IF EXISTS `p_premiumads_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `p_premiumads_categories` (
  `premiumad_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY  (`premiumad_id`,`category_id`),
  KEY `p_categories_p_premiumads_categories` (`category_id`),
  CONSTRAINT `p_categories_p_premiumads_categories` FOREIGN KEY (`category_id`) REFERENCES `p_categories` (`category_id`),
  CONSTRAINT `p_premiumads_p_premiumads_categories` FOREIGN KEY (`premiumad_id`) REFERENCES `p_premiumads` (`premiumad_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `p_premiumads_categories`
--

LOCK TABLES `p_premiumads_categories` WRITE;
/*!40000 ALTER TABLE `p_premiumads_categories` DISABLE KEYS */;
INSERT INTO `p_premiumads_categories` VALUES (8,159),(9,159),(10,159),(11,159),(12,159),(13,159),(14,159),(8,160),(9,160),(10,160),(11,160),(12,160),(13,160),(14,160),(8,161),(9,161),(10,161),(11,161),(12,161),(13,161),(14,161),(8,162),(9,162),(10,162),(11,162),(12,162),(13,162),(14,162),(8,163),(9,163),(10,163),(11,163),(12,163),(13,163),(14,163),(8,165),(9,165),(10,165),(11,165),(12,165),(13,165),(14,165),(8,186),(9,186),(10,186),(11,186),(12,186),(13,186),(14,186),(8,187),(9,187),(10,187),(11,187),(12,187),(13,187),(14,187),(8,189),(9,189),(10,189),(11,189),(12,189),(13,189),(14,189),(8,190),(9,190),(10,190),(11,190),(12,190),(13,190),(14,190),(8,191),(9,191),(10,191),(11,191),(12,191),(13,191),(14,191),(8,192),(9,192),(10,192),(11,192),(12,192),(13,192),(14,192),(8,193),(9,193),(10,193),(11,193),(12,193),(13,193),(14,193),(8,199),(9,199),(10,199),(11,199),(12,199),(13,199),(14,199),(8,200),(9,200),(10,200),(11,200),(12,200),(13,200),(14,200),(8,203),(9,203),(10,203),(11,203),(12,203),(13,203),(14,203),(8,204),(9,204),(10,204),(11,204),(12,204),(13,204),(14,204),(8,212),(9,212),(10,212),(11,212),(12,212),(13,212),(14,212),(8,215),(9,215),(10,215),(11,215),(12,215),(13,215),(14,215),(8,216),(9,216),(10,216),(11,216),(12,216),(13,216),(14,216),(8,217),(9,217),(10,217),(11,217),(12,217),(13,217),(14,217),(8,221),(9,221),(10,221),(11,221),(12,221),(13,221),(14,221),(8,222),(9,222),(10,222),(11,222),(12,222),(13,222),(14,222),(19,230);
/*!40000 ALTER TABLE `p_premiumads_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `p_premiumads_listings`
--

DROP TABLE IF EXISTS `p_premiumads_listings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `p_premiumads_listings` (
  `premiumad_id` int(11) NOT NULL,
  `listing_id` int(11) NOT NULL,
  PRIMARY KEY  (`premiumad_id`,`listing_id`),
  KEY `p_listings_p_premiumads_listings` (`listing_id`),
  CONSTRAINT `p_listings_p_premiumads_listings` FOREIGN KEY (`listing_id`) REFERENCES `p_listings` (`listing_id`),
  CONSTRAINT `p_premiumads_p_premiumads_listings` FOREIGN KEY (`premiumad_id`) REFERENCES `p_premiumads` (`premiumad_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `p_premiumads_listings`
--

LOCK TABLES `p_premiumads_listings` WRITE;
/*!40000 ALTER TABLE `p_premiumads_listings` DISABLE KEYS */;
INSERT INTO `p_premiumads_listings` VALUES (8,9),(19,12);
/*!40000 ALTER TABLE `p_premiumads_listings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `p_premiumads_locations`
--

DROP TABLE IF EXISTS `p_premiumads_locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `p_premiumads_locations` (
  `premiumad_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  PRIMARY KEY  (`premiumad_id`,`location_id`),
  KEY `p_locations_p_premiumads_locations` (`location_id`),
  CONSTRAINT `p_locations_p_premiumads_locations` FOREIGN KEY (`location_id`) REFERENCES `p_locations` (`location_id`),
  CONSTRAINT `p_premiumads_p_premiumads_locations` FOREIGN KEY (`premiumad_id`) REFERENCES `p_premiumads` (`premiumad_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `p_premiumads_locations`
--

LOCK TABLES `p_premiumads_locations` WRITE;
/*!40000 ALTER TABLE `p_premiumads_locations` DISABLE KEYS */;
INSERT INTO `p_premiumads_locations` VALUES (8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(8,22),(9,22),(10,22),(11,22),(12,22),(13,22),(14,22),(8,23),(9,23),(10,23),(11,23),(12,23),(13,23),(14,23),(9,30),(10,30),(11,30),(12,30),(13,30),(14,30),(8,31),(9,31),(10,31),(11,31),(12,31),(13,31),(14,31),(8,38),(9,38),(10,38),(11,38),(12,38),(13,38),(14,38),(8,62),(9,62),(10,62),(11,62),(12,62),(13,62),(14,62),(8,63),(9,63),(10,63),(11,63),(12,63),(13,63),(14,63),(8,64),(9,64),(10,64),(11,64),(12,64),(13,64),(14,64),(19,65);
/*!40000 ALTER TABLE `p_premiumads_locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `p_purchased_plans`
--

DROP TABLE IF EXISTS `p_purchased_plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `p_purchased_plans` (
  `pplan_id` int(11) NOT NULL auto_increment,
  `wlabel_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `advertiser_id` int(11) default NULL,
  `type` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `method` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `subscription_id` varchar(100) collate utf8_unicode_ci default NULL,
  `expired` tinyint(4) NOT NULL default '0',
  `duration` int(11) default '0',
  PRIMARY KEY  (`pplan_id`),
  KEY `p_plans_p_purchased_plans` (`plan_id`),
  KEY `p_advertisers_p_purchased_plans` (`advertiser_id`),
  KEY `p_whitelabel_p_purchased_plans` (`wlabel_id`),
  CONSTRAINT `p_advertisers_p_purchased_plans` FOREIGN KEY (`advertiser_id`) REFERENCES `p_advertisers` (`advertiser_id`),
  CONSTRAINT `p_plans_p_purchased_plans` FOREIGN KEY (`plan_id`) REFERENCES `p_plans` (`plan_id`),
  CONSTRAINT `p_whitelabel_p_purchased_plans` FOREIGN KEY (`wlabel_id`) REFERENCES `p_whitelabel` (`wlabel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `p_purchased_plans`
--

LOCK TABLES `p_purchased_plans` WRITE;
/*!40000 ALTER TABLE `p_purchased_plans` DISABLE KEYS */;
INSERT INTO `p_purchased_plans` VALUES (1,2,1,NULL,2,'2011-12-01 12:56:52',0,'199',NULL,0,0),(2,2,2,1,1,'2011-12-01 01:21:33',0,'19',NULL,0,0),(3,2,2,1,1,'2011-12-02 04:57:17',1,'19','I-LW218Y4CGGF1',0,0),(4,2,2,1,1,'2011-12-12 02:43:17',0,'19',NULL,0,0),(5,2,2,2,1,'2011-12-12 02:43:30',0,'19',NULL,0,0),(6,4,10,10,1,'2011-12-16 08:05:04',0,'1',NULL,0,0),(7,4,10,9,1,'2011-12-18 09:40:29',0,'1',NULL,0,0),(8,4,10,14,1,'2011-12-18 09:41:24',1,'1','I-JGXB06VL2FPY',0,0);
/*!40000 ALTER TABLE `p_purchased_plans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `p_purchased_plans_payments`
--

DROP TABLE IF EXISTS `p_purchased_plans_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `p_purchased_plans_payments` (
  `pppayment_id` int(11) NOT NULL auto_increment,
  `pplan_id` int(11) NOT NULL,
  `date_paid` datetime NOT NULL,
  `date_expire` datetime NOT NULL,
  `transaction_id` varchar(150) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`pppayment_id`),
  KEY `p_purchased_plans_p_purchased_plans_payments` (`pplan_id`),
  CONSTRAINT `p_purchased_plans_p_purchased_plans_payments` FOREIGN KEY (`pplan_id`) REFERENCES `p_purchased_plans` (`pplan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `p_purchased_plans_payments`
--

LOCK TABLES `p_purchased_plans_payments` WRITE;
/*!40000 ALTER TABLE `p_purchased_plans_payments` DISABLE KEYS */;
INSERT INTO `p_purchased_plans_payments` VALUES (1,1,'2011-12-01 12:56:52','2011-12-31 00:00:00','TEST_PAYMENT'),(2,2,'2011-12-01 01:21:33','2011-12-31 00:00:00','TEST_PAYMENT'),(3,3,'2011-12-02 04:57:17','2012-01-01 00:00:00','97V35245JA3808620'),(4,4,'2011-12-12 02:43:17','2012-01-11 00:00:00','TEST_PAYMENT'),(5,5,'2011-12-12 02:43:30','2012-01-11 00:00:00','TEST_PAYMENT'),(6,6,'2011-12-16 08:05:04','2012-01-05 00:00:00','TEST_PAYMENT'),(7,7,'2011-12-18 09:40:29','2012-01-07 00:00:00','TEST_PAYMENT'),(8,8,'2011-12-18 09:41:24','2012-01-07 00:00:00','6VA43881TX653500U');
/*!40000 ALTER TABLE `p_purchased_plans_payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `p_users`
--

DROP TABLE IF EXISTS `p_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `p_users` (
  `user_id` int(11) NOT NULL auto_increment,
  `wlabel_id` int(11) NOT NULL,
  `username` varchar(50) collate utf8_unicode_ci NOT NULL,
  `password` varchar(50) collate utf8_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT 'Type of user - super admin, customer, ',
  `status` tinyint(4) NOT NULL COMMENT 'status of user - 0 - pending, 1 - approved',
  `date_created` datetime NOT NULL,
  `date_lastlogin` datetime default NULL,
  `first_name` varchar(50) collate utf8_unicode_ci default NULL,
  `last_name` varchar(50) collate utf8_unicode_ci default NULL,
  `address` varchar(100) collate utf8_unicode_ci default NULL,
  `city` varchar(50) collate utf8_unicode_ci default NULL,
  `state` varchar(40) collate utf8_unicode_ci default NULL,
  `zipcode` varchar(40) collate utf8_unicode_ci default NULL,
  `country` varchar(40) collate utf8_unicode_ci default NULL,
  `phone` varchar(40) collate utf8_unicode_ci default NULL,
  `alt_phone` varchar(40) collate utf8_unicode_ci default NULL,
  `fax` varchar(40) collate utf8_unicode_ci default NULL,
  `email` varchar(40) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`user_id`),
  KEY `p_whitelabel_p_users` (`wlabel_id`),
  CONSTRAINT `p_whitelabel_p_users` FOREIGN KEY (`wlabel_id`) REFERENCES `p_whitelabel` (`wlabel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `p_users`
--

LOCK TABLES `p_users` WRITE;
/*!40000 ALTER TABLE `p_users` DISABLE KEYS */;
INSERT INTO `p_users` VALUES (1,1,'superadmin','17c4520f6cfd1ab53d8745e84681eb49',1,1,'2011-11-01 00:00:00',NULL,'any','any','any','any','anyy','any','any','any','any','amny','any'),(2,2,'wladmin','64bbb10db7bb88953d73d38c18d95c07',2,1,'2011-11-01 00:00:00',NULL,'waleed','','','','','','','','','',''),(3,2,'advertiser','02452e3484c42211b1c2884ad9b60c93',3,1,'2011-12-01 00:00:00',NULL,'Tom','Jones','test','test','test','test','test','test','test','test','tomjones@sample.com'),(4,2,'advertiser2','86b3259708069e232f011aaa97e223e1',3,0,'2011-12-14 00:00:00',NULL,'John','Smith','test','test','test','test','test','test','test','test','advertiser2@samplemail.com'),(5,2,'affiliate','6d0bd9c8d2eadeb088b34895fde10c55',5,1,'2011-12-08 00:00:00',NULL,'Mark','Fric','test','test','test','test','test','test','test','test','maros.fric@gmail.com'),(6,2,'bilal','59afafedb8c7274741e3be5ac2969bd2',5,0,'2011-12-12 00:00:00',NULL,'bilal','test','bilal','bilal','bilal','bilal','bilal','bilal','bilal','bilal','bilal'),(9,2,'Bilal','5ae1c881ad1d8d750f15c232a3232379',5,0,'2011-12-12 00:00:00',NULL,'b','b','b','b','b','b','b','b','b','b','b'),(10,2,'b','92eb5ffee6ae2fec3ad71c777531578f',5,1,'2011-12-12 00:00:00',NULL,'b','c','b','bb','b','b','b','b','b','b','b'),(12,3,'wladmin2','76dcc517d55ff5fe2bc09dcc33dd7e32',2,1,'2011-12-14 00:00:00',NULL,'','','','','','','','','','',''),(13,1,'wladmin2','76dcc517d55ff5fe2bc09dcc33dd7e32',2,1,'2011-12-14 00:00:00',NULL,'','','','','','','','','','',''),(14,2,'waleed','a7f7d8b439b0250a9ae2f3ce36ce16e7',3,0,'2011-12-14 00:00:00',NULL,'jasfaj','jaljsdf','jajsdfh','jaljsfajsb','basdbfqjkb','jbasbdfjqbbn','jbqasbf','basjbf','bakfsjb;','jb;qba','jasjdfh'),(15,2,'--bilal--','5ae1c881ad1d8d750f15c232a3232379',3,0,'2011-12-14 00:00:00',NULL,'','bilal','bilal','bilal','bilal','bilal','bilal','bilal','bilal','bilal','bilal'),(16,2,'bilal--','5ae1c881ad1d8d750f15c232a3232379',3,1,'2011-12-14 00:00:00',NULL,'bilal','bilal','bilal','bilal','bilal','bilal','bilal','bilal','bilal','bilal','bilal'),(17,2,'--s','03c7c0ace395d80182db07ae2c30f034',5,0,'2011-12-14 00:00:00',NULL,'s','s','s','s','s','s','s','s','s','s','s'),(18,2,'sasssss','03c7c0ace395d80182db07ae2c30f034',5,1,'2011-12-14 00:00:00',NULL,'s','s','s','s','s','s','s','s','s','s','s'),(19,4,'trey','bf8eba0d2a296e4e801f774cf5deb67f',2,1,'2011-12-15 00:00:00',NULL,'Trey','Brister','PO Box 406','Lillian','TX','76061-0406','United States','2144448750','2144448750','','webstandardcss@gmail.com'),(21,4,'treyadv','bf8eba0d2a296e4e801f774cf5deb67f',3,1,'2011-12-16 00:00:00',NULL,'Trey','Brister','P.O. Box 406','Lillian','Texas','76061','United States','4448750','4448750','','webstandardcss@gmail.com'),(22,4,'treyadv2','bf8eba0d2a296e4e801f774cf5deb67f',3,1,'2011-12-18 00:00:00',NULL,'Trey','Brister','P.O. Box 406','Lillian','Texas','76061','United States','4448750','4448750','','webstandardcss@gmail.com'),(23,4,'trey2','bf8eba0d2a296e4e801f774cf5deb67f',3,1,'2011-12-16 00:00:00',NULL,'Trey','Brister','P.O. Box 406','Lillian','Texas','76061','United States','2144448750','2144448750','2144448750','webstandardcss@gmail.com'),(24,2,'trey3','bf8eba0d2a296e4e801f774cf5deb67f',3,0,'2011-12-16 00:00:00',NULL,'Trey','Brister','P.O. Box 406','Lillian','Texas','76061','United States','4448750','4448750','','webstandardcss@gmail.com'),(25,4,'maros','63ecd87c72ef8828c1491e2f594cedb9',2,1,'2011-12-18 00:00:00',NULL,'','','','','','','','','','',''),(27,4,'trey4','bf8eba0d2a296e4e801f774cf5deb67f',3,1,'2011-12-18 00:00:00',NULL,'Trey','Brister','P.O. Box 406','Lillian','Texas','76061','United States','4448750','4448750','','webstandardcss@gmail.com'),(28,2,'drkeithwebb','c0cd8ec95058ff7edf79c5a6d499aa42',5,1,'2011-12-18 00:00:00',NULL,'Keith','Webb','2703 Market Center Drive','Rockwall','TX','75032','USA','9727727777','','','drkeithwebb@gmail.com'),(29,2,'drkeithwebb1','d2c96a81f5da148bcd83a46c8556b790',3,1,'2011-12-18 00:00:00',NULL,'Keith','Webb','2703 Market Center Drve','Rockwall','TX','75032','USA','9727727777','','','drkeithwebb@gmail.com');
/*!40000 ALTER TABLE `p_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `p_view_categories`
--

DROP TABLE IF EXISTS `p_view_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `p_view_categories` (
  `view_id` int(11) NOT NULL auto_increment,
  `date_created` datetime NOT NULL,
  `views` int(11) NOT NULL default '0',
  `unique_users` int(11) NOT NULL default '0',
  `time_on_page` decimal(10,0) NOT NULL default '0',
  `wlabel_id` int(11) NOT NULL,
  `advertiser_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `visits` int(11) NOT NULL default '0',
  PRIMARY KEY  (`view_id`),
  UNIQUE KEY `IDX_p_view_categories_1` (`date_created`,`wlabel_id`,`advertiser_id`,`category_id`,`location_id`)
) ENGINE=MyISAM AUTO_INCREMENT=304 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `p_view_categories`
--

LOCK TABLES `p_view_categories` WRITE;
/*!40000 ALTER TABLE `p_view_categories` DISABLE KEYS */;
INSERT INTO `p_view_categories` VALUES (1,'2011-12-09 02:00:00',1,1,'1',2,0,0,1,0),(2,'2011-12-09 02:00:00',1,1,'10',2,0,0,30,0),(3,'2011-12-09 02:00:00',1,0,'7',2,0,204,30,0),(4,'2011-12-09 03:00:00',1,1,'1',2,0,0,1,0),(5,'2011-12-09 10:00:00',1,1,'1',2,0,0,1,0),(6,'2011-12-09 12:00:00',1,1,'1',2,0,0,1,0),(7,'2011-12-09 16:00:00',1,1,'1',2,0,0,1,0),(8,'2011-12-09 18:00:00',1,1,'1',2,0,0,1,0),(9,'2011-12-09 21:00:00',1,1,'1',2,0,0,1,0),(10,'2011-12-10 02:00:00',1,1,'1',2,0,0,1,0),(11,'2011-12-10 04:00:00',1,1,'1',2,0,159,1,0),(12,'2011-12-10 06:00:00',1,1,'1',2,0,0,1,0),(13,'2011-12-10 10:00:00',1,1,'1',2,0,0,1,0),(14,'2011-12-10 11:00:00',2,2,'2',2,0,0,1,0),(15,'2011-12-10 15:00:00',1,1,'1',2,0,0,1,0),(16,'2011-12-10 16:00:00',1,1,'1',2,0,0,1,0),(17,'2011-12-10 19:00:00',1,1,'1',2,0,0,1,0),(18,'2011-12-10 20:00:00',1,1,'1',2,0,0,1,0),(19,'2011-12-10 21:00:00',7,7,'7',2,0,0,62,0),(20,'2011-12-10 21:00:00',4,4,'4',2,0,0,1,0),(21,'2011-12-10 21:00:00',3,3,'3',2,0,0,30,0),(22,'2011-12-10 21:00:00',1,1,'1',2,0,186,62,0),(23,'2011-12-10 21:00:00',1,1,'1',2,0,199,62,0),(24,'2011-12-10 21:00:00',1,1,'1',2,0,204,1,0),(25,'2011-12-10 21:00:00',1,1,'1',2,0,186,30,0),(26,'2011-12-10 21:00:00',1,1,'1',2,0,204,62,0),(27,'2011-12-10 21:00:00',1,1,'1',2,0,186,1,0),(28,'2011-12-10 21:00:00',1,1,'1',2,0,159,1,0),(29,'2011-12-10 21:00:00',1,1,'1',2,0,199,30,0),(30,'2011-12-10 21:00:00',1,1,'1',2,0,199,1,0),(31,'2011-12-10 21:00:00',1,1,'1',2,0,204,30,0),(32,'2011-12-10 21:00:00',1,1,'1',2,0,159,62,0),(33,'2011-12-10 21:00:00',1,1,'1',2,0,159,30,0),(34,'2011-12-10 22:00:00',8,8,'8',2,0,0,1,0),(35,'2011-12-10 22:00:00',7,7,'7',2,0,0,30,0),(36,'2011-12-10 22:00:00',2,2,'2',2,0,0,62,0),(37,'2011-12-10 23:00:00',2,2,'2',2,0,0,1,0),(38,'2011-12-11 02:00:00',11,11,'11',2,0,0,1,0),(39,'2011-12-11 02:00:00',1,1,'1',2,0,204,1,0),(40,'2011-12-11 02:00:00',1,1,'1',2,0,199,1,0),(41,'2011-12-11 02:00:00',1,1,'1',2,0,159,1,0),(42,'2011-12-11 02:00:00',1,1,'1',2,0,186,1,0),(43,'2011-12-11 09:00:00',9,9,'9',2,0,0,1,0),(44,'2011-12-11 09:00:00',1,1,'1',2,0,159,1,0),(45,'2011-12-11 09:00:00',1,1,'1',2,0,186,1,0),(46,'2011-12-11 13:00:00',1,1,'1',2,0,0,1,0),(47,'2011-12-11 13:00:00',1,1,'1',2,0,159,1,0),(48,'2011-12-11 14:00:00',1,1,'1',2,0,0,1,0),(49,'2011-12-11 14:00:00',1,1,'1',2,0,199,1,0),(50,'2011-12-11 16:00:00',1,1,'1',2,0,0,1,0),(51,'2011-12-11 17:00:00',1,1,'1',2,0,0,1,0),(52,'2011-12-11 18:00:00',2,2,'2',2,0,0,1,0),(53,'2011-12-11 19:00:00',3,3,'3',2,0,0,1,0),(54,'2011-12-11 19:00:00',1,1,'1',2,0,0,62,0),(55,'2011-12-11 19:00:00',1,1,'1',2,0,0,30,0),(56,'2011-12-11 21:00:00',1,1,'1',2,0,204,1,0),(57,'2011-12-11 21:00:00',2,2,'2',2,0,0,1,0),(58,'2011-12-11 22:00:00',1,1,'1',2,0,0,1,0),(59,'2011-12-11 23:00:00',1,1,'1',2,0,0,1,0),(60,'2011-12-12 02:00:00',1,1,'1',2,0,0,1,0),(61,'2011-12-12 04:00:00',1,1,'1',2,0,0,1,0),(62,'2011-12-12 05:00:00',1,0,'1',2,0,0,1,0),(63,'2011-12-12 06:00:00',1,1,'1',2,0,0,1,0),(64,'2011-12-12 09:00:00',5,2,'24',2,0,0,1,1),(65,'2011-12-12 09:00:00',1,0,'11',2,0,159,1,0),(66,'2011-12-12 09:00:00',1,0,'4',2,0,204,1,0),(67,'2011-12-12 09:00:00',1,0,'6',2,0,0,30,0),(68,'2011-12-12 10:00:00',2,1,'2',2,0,0,1,1),(69,'2011-12-12 11:00:00',2,1,'59',2,0,0,1,1),(70,'2011-12-12 11:00:00',1,0,'586',2,0,199,1,0),(71,'2011-12-12 12:00:00',1,1,'1',2,0,0,1,1),(72,'2011-12-12 13:00:00',8,1,'247',2,0,0,1,1),(73,'2011-12-12 13:00:00',2,0,'18',2,0,159,1,0),(74,'2011-12-12 13:00:00',9,0,'64',2,0,204,1,0),(75,'2011-12-12 13:00:00',2,0,'8',2,0,199,1,0),(76,'2011-12-12 14:00:00',6,2,'1611',2,0,0,1,2),(77,'2011-12-12 15:00:00',5,0,'695',2,0,0,1,0),(78,'2011-12-12 15:00:00',2,0,'687',2,0,204,1,0),(79,'2011-12-12 23:00:00',1,1,'1',2,0,0,1,1),(80,'2011-12-13 01:00:00',1,1,'1',2,0,0,1,1),(81,'2011-12-13 07:00:00',2,0,'62301',2,0,0,1,0),(82,'2011-12-13 10:00:00',9,0,'9',2,0,0,1,1),(83,'2011-12-13 10:00:00',1,0,'1',2,0,0,30,0),(84,'2011-12-13 10:00:00',6,0,'6',2,0,0,62,0),(85,'2011-12-13 10:00:00',1,0,'1',2,0,159,62,0),(86,'2011-12-13 11:00:00',7,1,'852',2,0,0,1,2),(87,'2011-12-13 12:00:00',1,0,'1',2,0,159,1,0),(88,'2011-12-13 12:00:00',1,0,'1',2,0,186,1,0),(89,'2011-12-13 12:00:00',1,0,'1',2,0,199,1,0),(90,'2011-12-13 12:00:00',1,0,'1',2,0,204,1,0),(91,'2011-12-13 12:00:00',2,0,'2',2,0,0,1,1),(92,'2011-12-13 18:00:00',1,1,'1',2,0,0,1,1),(93,'2011-12-13 19:00:00',2,2,'2',2,0,0,1,2),(94,'2011-12-13 20:00:00',2,2,'2',2,0,0,1,2),(95,'2011-12-13 21:00:00',1,1,'1',2,0,0,1,1),(96,'2011-12-13 22:00:00',1,1,'1',2,0,0,1,1),(97,'2011-12-13 22:00:00',1,1,'1',2,0,186,1,1),(98,'2011-12-14 00:00:00',1,1,'1',2,0,159,1,1),(99,'2011-12-14 01:00:00',1,1,'1',2,0,0,1,1),(100,'2011-12-14 02:00:00',1,1,'1',2,0,199,1,1),(101,'2011-12-14 02:00:00',1,1,'1',2,0,0,1,1),(102,'2011-12-14 05:00:00',1,1,'1',2,0,0,1,1),(103,'2011-12-14 06:00:00',2,0,'104',3,0,0,0,0),(104,'2011-12-14 09:00:00',5,1,'1607',2,0,0,1,3),(105,'2011-12-14 10:00:00',9,8,'2950',2,0,0,1,8),(106,'2011-12-14 10:00:00',2,0,'1430',2,0,0,30,0),(107,'2011-12-14 10:00:00',2,0,'67',2,0,204,30,0),(108,'2011-12-14 11:00:00',5,0,'65',2,0,0,1,3),(109,'2011-12-14 11:00:00',1,0,'1',2,0,159,1,1),(110,'2011-12-14 12:00:00',2,1,'2',2,0,0,1,1),(111,'2011-12-14 12:00:00',1,1,'1',3,0,0,0,1),(112,'2011-12-14 12:00:00',1,0,'1',2,0,159,1,0),(113,'2011-12-14 13:00:00',2,0,'11',2,0,0,1,0),(114,'2011-12-14 14:00:00',1,1,'1',2,0,0,1,1),(115,'2011-12-14 18:00:00',3,3,'3',2,0,0,1,3),(116,'2011-12-14 19:00:00',2,2,'2',2,0,0,1,2),(117,'2011-12-14 19:00:00',1,1,'1',2,0,0,30,1),(118,'2011-12-14 19:00:00',1,1,'1',2,0,0,62,1),(119,'2011-12-14 22:00:00',1,1,'1',2,0,0,1,1),(120,'2011-12-15 09:00:00',2,1,'2',2,0,0,1,1),(121,'2011-12-15 09:00:00',1,0,'4',2,0,204,1,0),(122,'2011-12-15 10:00:00',1,1,'1',2,0,159,1,1),(123,'2011-12-15 11:00:00',2,0,'17',2,0,0,1,1),(124,'2011-12-15 12:00:00',4,1,'1244',2,0,0,1,2),(125,'2011-12-15 12:00:00',1,0,'1',2,0,159,1,1),(126,'2011-12-15 12:00:00',1,1,'1',3,0,0,0,1),(127,'2011-12-15 13:00:00',12,0,'1106',2,0,0,1,0),(128,'2011-12-15 13:00:00',8,0,'2794',2,0,159,1,0),(129,'2011-12-15 13:00:00',5,0,'144',2,0,204,1,0),(130,'2011-12-15 13:00:00',6,0,'40',2,0,199,1,0),(131,'2011-12-15 13:00:00',1,0,'4',2,0,186,1,0),(132,'2011-12-15 13:00:00',1,0,'6',2,0,228,1,0),(133,'2011-12-15 14:00:00',15,0,'1285',2,0,0,1,0),(134,'2011-12-15 14:00:00',2,0,'21',2,0,199,1,0),(135,'2011-12-15 14:00:00',4,0,'36',2,0,159,1,0),(136,'2011-12-15 14:00:00',7,0,'87',2,0,186,1,0),(137,'2011-12-15 14:00:00',1,0,'5',2,0,204,1,0),(138,'2011-12-15 15:00:00',1,1,'1',3,0,0,0,1),(139,'2011-12-15 18:00:00',1,1,'1',2,0,0,1,1),(140,'2011-12-15 19:00:00',1,1,'1',2,0,0,1,1),(141,'2011-12-15 20:00:00',6,1,'322',2,0,0,1,1),(142,'2011-12-15 20:00:00',3,0,'39',2,0,204,1,0),(143,'2011-12-15 21:00:00',2,0,'4',2,0,0,1,1),(144,'2011-12-15 21:00:00',2,0,'46',2,0,159,1,0),(145,'2011-12-15 23:00:00',1,1,'1',3,0,0,0,1),(146,'2011-12-16 00:00:00',1,1,'1',2,0,0,1,1),(147,'2011-12-16 03:00:00',2,2,'2',2,0,0,1,2),(148,'2011-12-16 04:00:00',1,1,'1',2,0,0,1,1),(149,'2011-12-16 05:00:00',1,1,'1',2,0,204,1,1),(150,'2011-12-16 08:00:00',2,0,'25',2,0,0,1,0),(151,'2011-12-16 09:00:00',4,4,'4',3,0,0,0,4),(152,'2011-12-16 11:00:00',3,1,'7',2,0,204,1,1),(153,'2011-12-16 11:00:00',2,0,'12',2,0,0,1,1),(154,'2011-12-16 12:00:00',1,1,'1',2,0,159,1,1),(155,'2011-12-16 13:00:00',3,3,'3',2,0,0,1,3),(156,'2011-12-16 16:00:00',1,1,'1',2,0,0,1,1),(157,'2011-12-16 17:00:00',1,1,'1',2,0,0,1,1),(158,'2011-12-16 18:00:00',1,1,'1',2,0,0,1,1),(159,'2011-12-16 18:00:00',1,0,'1',2,0,204,1,0),(160,'2011-12-16 19:00:00',1,0,'615',2,0,199,1,0),(161,'2011-12-16 19:00:00',1,0,'539',2,0,186,1,0),(162,'2011-12-16 19:00:00',1,0,'95',2,0,159,1,0),(163,'2011-12-16 19:00:00',2,1,'201',2,0,228,1,1),(164,'2011-12-16 19:00:00',6,2,'1537',2,0,0,1,3),(165,'2011-12-16 19:00:00',1,0,'35',2,0,204,1,0),(166,'2011-12-16 20:00:00',1,1,'1',2,0,0,62,1),(167,'2011-12-16 20:00:00',1,0,'1663',2,0,0,1,0),(168,'2011-12-16 21:00:00',4,4,'4',2,0,0,1,4),(169,'2011-12-16 21:00:00',2,2,'2',2,0,228,1,2),(170,'2011-12-17 03:00:00',1,1,'1',2,0,0,1,1),(171,'2011-12-17 04:00:00',1,1,'1',2,0,199,1,1),(172,'2011-12-17 05:00:00',1,1,'1',2,0,0,1,1),(173,'2011-12-17 08:00:00',1,1,'1',2,0,0,30,1),(174,'2011-12-17 09:00:00',4,1,'118',2,0,0,1,1),(175,'2011-12-17 09:00:00',2,0,'14',2,0,204,1,0),(176,'2011-12-17 10:00:00',2,2,'2',2,0,0,1,2),(177,'2011-12-17 11:00:00',1,1,'1',2,0,186,1,1),(178,'2011-12-17 12:00:00',2,2,'2',2,0,0,1,2),(179,'2011-12-17 12:00:00',1,1,'1',2,0,204,1,1),(180,'2011-12-17 14:00:00',1,1,'1',2,0,0,1,1),(181,'2011-12-17 15:00:00',1,1,'1',2,0,0,1,1),(182,'2011-12-17 15:00:00',1,1,'1',2,0,0,30,1),(183,'2011-12-17 15:00:00',1,1,'1',2,0,0,62,1),(184,'2011-12-17 16:00:00',5,0,'402',2,0,0,1,0),(185,'2011-12-17 19:00:00',2,2,'2',2,0,0,1,2),(186,'2011-12-17 19:00:00',1,1,'1',2,0,228,1,1),(187,'2011-12-17 19:00:00',1,1,'1',2,0,0,62,1),(188,'2011-12-17 19:00:00',2,2,'2',2,0,231,1,2),(189,'2011-12-17 19:00:00',1,1,'1',2,0,0,30,1),(190,'2011-12-17 19:00:00',1,1,'1',2,0,228,62,1),(191,'2011-12-17 20:00:00',1,1,'1',2,0,231,62,1),(192,'2011-12-17 20:00:00',1,1,'1',2,0,228,30,1),(193,'2011-12-17 20:00:00',1,1,'1',2,0,231,30,1),(194,'2011-12-17 21:00:00',1,1,'1',2,0,0,1,1),(195,'2011-12-17 22:00:00',13,6,'870',2,0,0,1,7),(196,'2011-12-17 22:00:00',3,1,'16',2,0,204,1,1),(197,'2011-12-17 22:00:00',1,1,'1',2,0,228,1,1),(198,'2011-12-17 22:00:00',1,1,'1',2,0,186,1,1),(199,'2011-12-17 22:00:00',1,1,'1',2,0,159,1,1),(200,'2011-12-17 22:00:00',1,1,'1',2,0,199,1,1),(201,'2011-12-17 22:00:00',1,1,'1',2,0,231,1,1),(202,'2011-12-17 23:00:00',1,1,'1',2,0,0,1,1),(203,'2011-12-18 02:00:00',4,3,'4',2,0,0,1,3),(204,'2011-12-18 02:00:00',1,0,'1',3,0,0,0,1),(205,'2011-12-18 02:00:00',1,1,'1',2,0,228,1,1),(206,'2011-12-18 02:00:00',1,1,'1',2,0,204,1,1),(207,'2011-12-18 02:00:00',1,1,'1',4,0,0,0,1),(208,'2011-12-18 03:00:00',2,2,'2',3,0,0,0,2),(209,'2011-12-18 03:00:00',2,0,'4',2,0,0,1,1),(210,'2011-12-18 05:00:00',2,2,'2',3,0,0,0,2),(211,'2011-12-18 07:00:00',4,4,'4',4,0,0,0,4),(212,'2011-12-18 08:00:00',1,1,'1',2,0,186,1,1),(213,'2011-12-18 09:00:00',4,1,'390',4,0,0,0,1),(214,'2011-12-18 09:00:00',2,2,'2',3,0,0,0,2),(215,'2011-12-18 09:00:00',2,0,'157',4,0,0,65,0),(216,'2011-12-18 09:00:00',1,0,'3',4,0,229,65,0),(217,'2011-12-18 09:00:00',1,0,'1',2,0,0,1,1),(218,'2011-12-18 10:00:00',2,2,'2',4,0,0,65,2),(219,'2011-12-18 10:00:00',1,1,'1',4,0,229,65,1),(220,'2011-12-18 11:00:00',1,1,'1',3,0,0,0,1),(221,'2011-12-18 13:00:00',2,0,'2',4,0,0,65,2),(222,'2011-12-18 13:00:00',1,0,'1',4,0,229,65,1),(223,'2011-12-18 13:00:00',1,1,'1',3,0,0,0,1),(224,'2011-12-18 13:00:00',2,1,'2',2,0,0,1,2),(225,'2011-12-18 14:00:00',2,0,'2',4,0,0,65,2),(226,'2011-12-18 14:00:00',1,0,'1',4,0,229,65,1),(227,'2011-12-18 14:00:00',1,1,'1',2,0,0,1,1),(228,'2011-12-18 15:00:00',1,1,'1',4,0,0,65,1),(229,'2011-12-18 15:00:00',1,1,'1',2,0,0,1,1),(230,'2011-12-18 16:00:00',2,0,'70',2,0,0,1,0),(231,'2011-12-18 17:00:00',1,1,'1',3,0,0,0,1),(232,'2011-12-18 17:00:00',1,0,'1',2,0,159,1,0),(233,'2011-12-18 17:00:00',3,1,'28',4,0,0,65,1),(234,'2011-12-18 17:00:00',1,0,'5',4,0,229,65,0),(235,'2011-12-18 17:00:00',1,1,'1',2,0,0,1,1),(236,'2011-12-18 18:00:00',5,4,'5',2,0,0,1,4),(237,'2011-12-18 18:00:00',1,0,'35',2,0,0,30,0),(238,'2011-12-18 18:00:00',1,0,'8',2,0,204,30,0),(239,'2011-12-18 20:00:00',2,2,'2',3,0,0,0,2),(240,'2011-12-18 20:00:00',1,1,'1',2,0,0,1,1),(241,'2011-12-18 21:00:00',4,1,'1634',4,0,0,65,1),(242,'2011-12-18 21:00:00',2,1,'2',2,0,0,1,1),(243,'2011-12-18 22:00:00',2,1,'486',2,0,0,1,1),(244,'2011-12-18 23:00:00',2,2,'2',4,0,0,65,2),(245,'2011-12-18 23:00:00',1,1,'1',4,0,229,65,1),(246,'2011-12-19 01:00:00',3,1,'1560',2,0,0,1,1),(247,'2011-12-19 01:00:00',1,0,'1',4,0,0,65,0),(248,'2011-12-19 01:00:00',1,0,'2',4,0,229,65,0),(249,'2011-12-19 01:00:00',2,0,'13',2,0,204,1,0),(250,'2011-12-19 02:00:00',2,2,'2',2,0,0,1,2),(251,'2011-12-19 04:00:00',1,1,'1',3,0,0,0,1),(252,'2011-12-19 08:00:00',1,1,'1',2,0,0,1,1),(253,'2011-12-19 08:00:00',1,1,'1',2,0,228,1,1),(254,'2011-12-19 09:00:00',1,1,'1',2,0,228,1,1),(255,'2011-12-19 10:00:00',1,0,'1',2,0,0,1,0),(256,'2011-12-19 11:00:00',1,1,'1',2,0,0,1,1),(257,'2011-12-19 12:00:00',1,1,'1',4,0,0,65,1),(258,'2011-12-19 12:00:00',9,3,'1385',2,0,0,1,3),(259,'2011-12-19 12:00:00',2,1,'3',2,0,204,1,1),(260,'2011-12-19 13:00:00',1,1,'1',3,0,0,0,1),(261,'2011-12-19 13:00:00',7,0,'2604',2,0,0,1,0),(262,'2011-12-19 13:00:00',4,0,'1337',2,0,0,62,0),(263,'2011-12-19 13:00:00',4,0,'16',2,0,0,30,0),(264,'2011-12-19 13:00:00',2,0,'3',2,0,204,30,0),(265,'2011-12-19 13:00:00',1,0,'2',2,0,204,1,0),(266,'2011-12-19 16:00:00',1,0,'1',2,0,0,1,0),(267,'2011-12-19 16:00:00',1,0,'1',2,0,204,1,0),(268,'2011-12-19 17:00:00',1,1,'1',2,0,0,1,1),(269,'2011-12-19 18:00:00',4,4,'4',4,0,0,65,4),(270,'2011-12-19 18:00:00',1,1,'1',3,0,0,0,1),(271,'2011-12-19 19:00:00',1,1,'1',2,0,0,1,1),(272,'2011-12-19 19:00:00',1,1,'1',4,0,0,65,1),(273,'2011-12-19 20:00:00',5,5,'5',4,0,0,65,5),(274,'2011-12-19 20:00:00',1,1,'1',2,0,0,62,1),(275,'2011-12-19 20:00:00',1,1,'1',4,0,229,65,1),(276,'2011-12-19 21:00:00',2,1,'2',2,0,0,1,1),(277,'2011-12-19 21:00:00',1,1,'1',4,0,0,65,1),(278,'2011-12-19 22:00:00',2,2,'2',4,0,0,65,2),(279,'2011-12-19 22:00:00',1,1,'1',2,0,0,1,1),(280,'2011-12-20 01:00:00',2,1,'2',2,0,0,1,2),(281,'2011-12-20 01:00:00',1,0,'7',2,0,204,1,0),(282,'2011-12-20 02:00:00',2,2,'2',2,0,0,1,2),(283,'2011-12-20 03:00:00',1,1,'1',2,0,0,1,1),(284,'2011-12-20 03:00:00',2,2,'2',2,0,228,1,0),(285,'2011-12-20 06:00:00',3,3,'3',2,0,0,1,3),(286,'2011-12-20 06:00:00',4,4,'4',2,0,159,1,4),(287,'2011-12-20 08:00:00',1,1,'1',2,0,0,1,1),(288,'2011-12-20 13:00:00',1,1,'1',2,0,0,1,1),(289,'2011-12-20 17:00:00',1,1,'1',2,0,0,1,1),(290,'2011-12-20 18:00:00',1,1,'1',2,0,0,1,1),(291,'2011-12-20 22:00:00',1,1,'1',2,0,0,1,1),(292,'2011-12-21 12:00:00',1,1,'1',2,0,0,1,1),(293,'2011-12-21 13:00:00',2,2,'2',2,0,0,1,2),(294,'2011-12-21 16:00:00',2,2,'2',2,0,0,1,2),(295,'2011-12-21 20:00:00',1,1,'1',2,0,0,1,1),(296,'2011-12-21 23:00:00',3,3,'3',2,0,0,1,3),(297,'2011-12-22 02:00:00',1,1,'1',2,0,0,1,1),(298,'2011-12-22 03:00:00',2,2,'2',2,0,0,1,2),(299,'2011-12-22 04:00:00',2,2,'2',2,0,0,1,2),(300,'2011-12-22 05:00:00',1,1,'1',2,0,204,1,1),(301,'2011-12-22 05:00:00',4,4,'4',2,0,0,1,4),(302,'2011-12-22 06:00:00',1,1,'1',2,0,0,1,1),(303,'2011-12-22 13:00:00',1,1,'1',2,0,0,1,1);
/*!40000 ALTER TABLE `p_view_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `p_view_coupons`
--

DROP TABLE IF EXISTS `p_view_coupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `p_view_coupons` (
  `view_id` int(11) NOT NULL auto_increment,
  `date_created` datetime NOT NULL,
  `views` int(11) NOT NULL default '0',
  `unique_users` int(11) NOT NULL default '0',
  `time_on_page` decimal(10,0) NOT NULL default '0',
  `wlabel_id` int(11) NOT NULL,
  `advertiser_id` int(11) NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `visits` int(11) NOT NULL default '0',
  PRIMARY KEY  (`view_id`),
  UNIQUE KEY `IDX_p_view_coupons_1` (`date_created`,`wlabel_id`,`advertiser_id`,`coupon_id`,`location_id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `p_view_coupons`
--

LOCK TABLES `p_view_coupons` WRITE;
/*!40000 ALTER TABLE `p_view_coupons` DISABLE KEYS */;
INSERT INTO `p_view_coupons` VALUES (1,'2011-12-09 02:00:00',1,0,'2',2,0,4,30,0),(2,'2011-12-10 22:00:00',1,1,'1',2,0,4,30,0),(3,'2011-12-10 22:00:00',1,1,'1',2,0,4,1,0),(4,'2011-12-12 09:00:00',1,0,'5',2,0,4,1,0),(5,'2011-12-12 13:00:00',1,0,'7',2,0,4,1,0),(6,'2011-12-13 11:00:00',1,0,'1',2,0,4,1,0),(7,'2011-12-14 10:00:00',1,0,'223',2,0,4,1,0),(8,'2011-12-15 07:00:00',1,1,'1',2,0,4,1,1),(9,'2011-12-15 13:00:00',6,0,'928',2,0,4,1,0),(10,'2011-12-15 14:00:00',5,0,'700',2,0,4,1,0),(11,'2011-12-15 20:00:00',3,0,'27',2,0,4,1,0),(12,'2011-12-16 04:00:00',1,1,'1',2,0,4,1,1),(13,'2011-12-16 11:00:00',1,0,'4',2,0,4,1,0),(14,'2011-12-16 21:00:00',3,3,'3',2,0,4,1,3),(15,'2011-12-17 07:00:00',1,1,'1',2,0,4,1,1),(16,'2011-12-17 09:00:00',4,0,'69',2,0,4,1,0),(17,'2011-12-17 10:00:00',2,2,'2',2,0,4,1,2),(18,'2011-12-18 09:00:00',1,0,'3',4,0,5,65,0),(19,'2011-12-18 13:00:00',1,0,'15',2,0,4,1,0),(20,'2011-12-19 01:00:00',5,0,'107',4,0,6,65,0),(21,'2011-12-19 12:00:00',1,1,'1',2,0,4,1,1),(22,'2011-12-19 21:00:00',1,1,'1',4,0,5,65,1),(23,'2011-12-19 21:00:00',1,1,'1',4,0,6,65,1),(24,'2011-12-20 03:00:00',1,1,'1',2,0,4,1,0),(25,'2011-12-22 05:00:00',1,1,'1',2,0,4,1,1);
/*!40000 ALTER TABLE `p_view_coupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `p_view_listings`
--

DROP TABLE IF EXISTS `p_view_listings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `p_view_listings` (
  `view_id` int(11) NOT NULL auto_increment,
  `date_created` datetime NOT NULL,
  `views` int(11) NOT NULL default '0',
  `unique_users` int(11) NOT NULL default '0',
  `time_on_page` decimal(10,0) NOT NULL default '0',
  `wlabel_id` int(11) NOT NULL,
  `advertiser_id` int(11) NOT NULL,
  `listing_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `visits` int(11) NOT NULL default '0',
  PRIMARY KEY  (`view_id`),
  UNIQUE KEY `IDX_p_view_listings_1` (`date_created`,`wlabel_id`,`advertiser_id`,`listing_id`,`location_id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `p_view_listings`
--

LOCK TABLES `p_view_listings` WRITE;
/*!40000 ALTER TABLE `p_view_listings` DISABLE KEYS */;
INSERT INTO `p_view_listings` VALUES (1,'2011-12-09 02:00:00',1,0,'2',2,0,9,30,0),(2,'2011-12-10 22:00:00',1,1,'1',2,0,9,30,0),(3,'2011-12-10 22:00:00',1,1,'1',2,0,9,1,0),(4,'2011-12-10 22:00:00',1,1,'1',2,0,10,62,0),(5,'2011-12-10 22:00:00',1,1,'1',2,0,10,30,0),(6,'2011-12-10 22:00:00',1,1,'1',2,0,10,1,0),(7,'2011-12-12 13:00:00',6,0,'246',2,0,9,1,0),(8,'2011-12-12 13:00:00',1,0,'7',2,0,10,1,0),(9,'2011-12-13 12:00:00',3,0,'3',2,0,9,1,0),(10,'2011-12-14 10:00:00',1,0,'8',2,0,10,30,0),(11,'2011-12-15 13:00:00',1,0,'4',2,0,9,1,0),(12,'2011-12-15 13:00:00',9,0,'506',2,0,10,1,0),(13,'2011-12-15 14:00:00',1,0,'14',2,0,10,1,0),(14,'2011-12-15 20:00:00',1,0,'6',2,0,10,1,0),(15,'2011-12-15 20:00:00',4,0,'40',2,0,9,1,0),(16,'2011-12-16 11:00:00',3,0,'24',2,0,10,1,0),(17,'2011-12-16 11:00:00',1,0,'3',2,0,9,1,0),(18,'2011-12-16 19:00:00',1,0,'3',2,0,10,1,0),(19,'2011-12-17 09:00:00',2,0,'7',2,0,9,1,0),(20,'2011-12-17 22:00:00',1,0,'2',2,0,10,1,0),(21,'2011-12-18 09:00:00',1,0,'2',4,0,12,65,0),(22,'2011-12-18 13:00:00',1,0,'58',2,0,9,1,0),(23,'2011-12-18 17:00:00',1,0,'2',4,0,12,65,0),(24,'2011-12-18 18:00:00',1,0,'2',2,0,9,30,0),(25,'2011-12-18 18:00:00',1,1,'1',2,0,9,1,1),(26,'2011-12-19 01:00:00',3,0,'20',2,0,9,1,0),(27,'2011-12-19 01:00:00',4,0,'128',4,0,13,65,0),(28,'2011-12-19 12:00:00',4,0,'151',2,0,9,1,0),(29,'2011-12-19 13:00:00',1,0,'1',2,0,9,1,0),(30,'2011-12-19 16:00:00',1,0,'1',2,0,9,1,0),(31,'2011-12-19 17:00:00',1,1,'1',2,0,9,1,1),(32,'2011-12-19 21:00:00',1,1,'1',4,0,12,65,1),(33,'2011-12-19 21:00:00',1,1,'1',4,0,13,65,1),(34,'2011-12-22 06:00:00',1,1,'1',2,0,9,1,1);
/*!40000 ALTER TABLE `p_view_listings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `p_view_subcategories`
--

DROP TABLE IF EXISTS `p_view_subcategories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `p_view_subcategories` (
  `view_id` int(11) NOT NULL auto_increment,
  `date_created` datetime NOT NULL,
  `views` int(11) NOT NULL default '0',
  `unique_users` int(11) NOT NULL default '0',
  `time_on_page` decimal(10,0) NOT NULL default '0',
  `wlabel_id` int(11) NOT NULL,
  `advertiser_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `visits` int(11) NOT NULL default '0',
  PRIMARY KEY  (`view_id`),
  UNIQUE KEY `IDX_p_view_subcategories_1` (`date_created`,`wlabel_id`,`advertiser_id`,`category_id`,`location_id`)
) ENGINE=MyISAM AUTO_INCREMENT=186 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `p_view_subcategories`
--

LOCK TABLES `p_view_subcategories` WRITE;
/*!40000 ALTER TABLE `p_view_subcategories` DISABLE KEYS */;
INSERT INTO `p_view_subcategories` VALUES (1,'2011-12-09 02:00:00',1,0,'2',2,0,221,30,0),(2,'2011-12-10 21:00:00',1,1,'1',2,0,192,62,0),(3,'2011-12-10 21:00:00',1,1,'1',2,0,193,62,0),(4,'2011-12-10 21:00:00',1,1,'1',2,0,190,62,0),(5,'2011-12-10 21:00:00',1,1,'1',2,0,200,62,0),(6,'2011-12-10 21:00:00',1,1,'1',2,0,203,62,0),(7,'2011-12-10 21:00:00',1,1,'1',2,0,189,62,0),(8,'2011-12-10 21:00:00',1,1,'1',2,0,191,62,0),(9,'2011-12-10 21:00:00',1,1,'1',2,0,187,62,0),(10,'2011-12-10 22:00:00',1,1,'1',2,0,222,30,0),(11,'2011-12-10 22:00:00',1,1,'1',2,0,187,1,0),(12,'2011-12-10 22:00:00',1,1,'1',2,0,200,1,0),(13,'2011-12-10 22:00:00',1,1,'1',2,0,189,1,0),(14,'2011-12-10 22:00:00',1,1,'1',2,0,165,1,0),(15,'2011-12-10 22:00:00',1,1,'1',2,0,163,1,0),(16,'2011-12-10 22:00:00',1,1,'1',2,0,221,1,0),(17,'2011-12-10 22:00:00',1,1,'1',2,0,222,1,0),(18,'2011-12-10 22:00:00',1,1,'1',2,0,203,30,0),(19,'2011-12-10 22:00:00',1,1,'1',2,0,193,1,0),(20,'2011-12-10 22:00:00',1,1,'1',2,0,203,1,0),(21,'2011-12-10 22:00:00',1,1,'1',2,0,217,62,0),(22,'2011-12-10 22:00:00',1,1,'1',2,0,216,62,0),(23,'2011-12-10 22:00:00',1,1,'1',2,0,216,30,0),(24,'2011-12-10 22:00:00',1,1,'1',2,0,193,30,0),(25,'2011-12-10 22:00:00',1,1,'1',2,0,215,62,0),(26,'2011-12-10 22:00:00',1,1,'1',2,0,212,62,0),(27,'2011-12-10 22:00:00',1,1,'1',2,0,221,62,0),(28,'2011-12-10 22:00:00',1,1,'1',2,0,215,1,0),(29,'2011-12-10 22:00:00',1,1,'1',2,0,222,62,0),(30,'2011-12-10 22:00:00',1,1,'1',2,0,215,30,0),(31,'2011-12-10 22:00:00',1,1,'1',2,0,217,30,0),(32,'2011-12-10 22:00:00',1,1,'1',2,0,187,30,0),(33,'2011-12-10 22:00:00',1,1,'1',2,0,217,1,0),(34,'2011-12-10 22:00:00',1,1,'1',2,0,191,30,0),(35,'2011-12-10 22:00:00',1,1,'1',2,0,189,30,0),(36,'2011-12-10 22:00:00',1,1,'1',2,0,191,1,0),(37,'2011-12-10 22:00:00',1,1,'1',2,0,162,1,0),(38,'2011-12-10 22:00:00',1,1,'1',2,0,200,30,0),(39,'2011-12-10 22:00:00',1,1,'1',2,0,221,30,0),(40,'2011-12-10 22:00:00',1,1,'1',2,0,192,1,0),(41,'2011-12-10 22:00:00',1,1,'1',2,0,190,1,0),(42,'2011-12-10 22:00:00',1,1,'1',2,0,190,30,0),(43,'2011-12-10 22:00:00',1,1,'1',2,0,212,1,0),(44,'2011-12-10 22:00:00',1,1,'1',2,0,192,30,0),(45,'2011-12-10 22:00:00',1,1,'1',2,0,161,1,0),(46,'2011-12-10 22:00:00',1,1,'1',2,0,160,1,0),(47,'2011-12-10 22:00:00',1,1,'1',2,0,212,30,0),(48,'2011-12-10 22:00:00',1,1,'1',2,0,216,1,0),(49,'2011-12-10 22:00:00',1,1,'1',2,0,165,30,0),(50,'2011-12-10 22:00:00',1,1,'1',2,0,165,62,0),(51,'2011-12-10 22:00:00',1,1,'1',2,0,162,62,0),(52,'2011-12-10 22:00:00',1,1,'1',2,0,160,62,0),(53,'2011-12-10 22:00:00',1,1,'1',2,0,161,30,0),(54,'2011-12-10 22:00:00',1,1,'1',2,0,162,30,0),(55,'2011-12-10 22:00:00',1,1,'1',2,0,163,30,0),(56,'2011-12-10 22:00:00',1,1,'1',2,0,163,62,0),(57,'2011-12-10 22:00:00',1,1,'1',2,0,161,62,0),(58,'2011-12-10 22:00:00',1,1,'1',2,0,160,30,0),(59,'2011-12-11 02:00:00',1,1,'1',2,0,212,1,0),(60,'2011-12-11 02:00:00',1,1,'1',2,0,222,1,0),(61,'2011-12-11 02:00:00',1,1,'1',2,0,221,1,0),(62,'2011-12-11 02:00:00',1,1,'1',2,0,216,1,0),(63,'2011-12-11 02:00:00',1,1,'1',2,0,215,1,0),(64,'2011-12-11 02:00:00',1,1,'1',2,0,217,1,0),(65,'2011-12-12 09:00:00',1,0,'2',2,0,221,1,0),(66,'2011-12-12 09:00:00',1,0,'922',2,0,161,1,1),(67,'2011-12-12 13:00:00',1,0,'7',2,0,223,1,0),(68,'2011-12-12 13:00:00',1,0,'4',2,0,222,1,0),(69,'2011-12-12 13:00:00',6,0,'195',2,0,221,1,0),(70,'2011-12-12 13:00:00',3,0,'33',2,0,216,1,0),(71,'2011-12-12 13:00:00',1,0,'11',2,0,224,1,0),(72,'2011-12-12 13:00:00',1,0,'4',2,0,203,1,0),(73,'2011-12-13 12:00:00',1,0,'1',2,0,160,1,0),(74,'2011-12-13 12:00:00',1,0,'1',2,0,161,1,0),(75,'2011-12-13 12:00:00',1,0,'1',2,0,221,1,0),(76,'2011-12-13 18:00:00',1,1,'1',2,0,163,1,1),(77,'2011-12-14 02:00:00',1,1,'1',2,0,225,1,1),(78,'2011-12-14 10:00:00',2,0,'81',2,0,216,30,0),(79,'2011-12-14 16:00:00',1,1,'1',2,0,203,1,1),(80,'2011-12-14 20:00:00',1,1,'1',2,0,200,1,1),(81,'2011-12-15 13:00:00',1,0,'15',2,0,227,1,0),(82,'2011-12-15 13:00:00',2,0,'133',2,0,226,1,0),(83,'2011-12-15 13:00:00',1,0,'180',2,0,224,1,0),(84,'2011-12-15 13:00:00',1,0,'5',2,0,222,1,0),(85,'2011-12-15 13:00:00',2,0,'29',2,0,221,1,0),(86,'2011-12-15 13:00:00',1,0,'53',2,0,216,1,0),(87,'2011-12-15 13:00:00',1,0,'8',2,0,225,1,0),(88,'2011-12-15 13:00:00',1,0,'3',2,0,203,1,0),(89,'2011-12-15 13:00:00',2,0,'10',2,0,200,1,0),(90,'2011-12-15 14:00:00',1,0,'3',2,0,216,1,0),(91,'2011-12-15 14:00:00',1,0,'81',2,0,225,1,0),(92,'2011-12-15 14:00:00',1,0,'38',2,0,160,1,0),(93,'2011-12-15 14:00:00',1,0,'2',2,0,162,1,0),(94,'2011-12-15 14:00:00',1,0,'6',2,0,193,1,0),(95,'2011-12-15 14:00:00',1,0,'7',2,0,192,1,0),(96,'2011-12-15 14:00:00',1,0,'3',2,0,191,1,0),(97,'2011-12-15 14:00:00',1,0,'4',2,0,189,1,0),(98,'2011-12-15 14:00:00',1,0,'3',2,0,187,1,0),(99,'2011-12-15 19:00:00',1,1,'1',2,0,217,1,1),(100,'2011-12-15 20:00:00',1,0,'19',2,0,216,1,0),(101,'2011-12-15 20:00:00',2,0,'14',2,0,221,1,0),(102,'2011-12-15 21:00:00',1,0,'3',2,0,161,1,0),(103,'2011-12-15 21:00:00',1,0,'5',2,0,163,1,0),(104,'2011-12-16 03:00:00',1,1,'1',2,0,215,1,1),(105,'2011-12-16 11:00:00',2,0,'21',2,0,216,1,0),(106,'2011-12-16 11:00:00',1,0,'7',2,0,221,1,0),(107,'2011-12-16 15:00:00',1,1,'1',2,0,222,1,1),(108,'2011-12-16 15:00:00',1,1,'1',2,0,217,1,1),(109,'2011-12-16 16:00:00',1,1,'1',2,0,212,1,1),(110,'2011-12-16 19:00:00',1,1,'1',2,0,221,30,1),(111,'2011-12-16 19:00:00',1,0,'3',2,0,216,1,0),(112,'2011-12-17 08:00:00',1,1,'1',2,0,165,1,1),(113,'2011-12-17 09:00:00',1,1,'1',2,0,193,1,1),(114,'2011-12-17 09:00:00',2,0,'14',2,0,221,1,0),(115,'2011-12-17 15:00:00',1,1,'1',2,0,215,1,1),(116,'2011-12-17 15:00:00',1,0,'252',2,0,200,1,0),(117,'2011-12-17 16:00:00',1,0,'188',2,0,193,1,0),(118,'2011-12-17 16:00:00',1,0,'153',2,0,223,1,0),(119,'2011-12-17 16:00:00',1,0,'105',2,0,187,1,0),(120,'2011-12-17 16:00:00',1,0,'103',2,0,217,1,0),(121,'2011-12-17 16:00:00',1,0,'124',2,0,225,1,0),(122,'2011-12-17 16:00:00',1,0,'88',2,0,189,1,0),(123,'2011-12-17 16:00:00',1,0,'177',2,0,227,1,0),(124,'2011-12-17 16:00:00',1,0,'155',2,0,212,1,0),(125,'2011-12-17 16:00:00',1,0,'63',2,0,190,1,0),(126,'2011-12-17 16:00:00',1,0,'65',2,0,161,1,0),(127,'2011-12-17 16:00:00',1,0,'187',2,0,192,1,0),(128,'2011-12-17 16:00:00',1,0,'88',2,0,222,1,0),(129,'2011-12-17 16:00:00',1,0,'52',2,0,163,1,0),(130,'2011-12-17 16:00:00',1,0,'66',2,0,216,1,0),(131,'2011-12-17 16:00:00',1,0,'127',2,0,224,1,0),(132,'2011-12-17 16:00:00',1,0,'82',2,0,165,1,0),(133,'2011-12-17 16:00:00',1,0,'171',2,0,203,1,0),(134,'2011-12-17 16:00:00',1,0,'58',2,0,226,1,0),(135,'2011-12-17 16:00:00',1,0,'43',2,0,160,1,0),(136,'2011-12-17 16:00:00',1,0,'88',2,0,191,1,0),(137,'2011-12-17 16:00:00',1,0,'55',2,0,221,1,0),(138,'2011-12-17 16:00:00',1,0,'45',2,0,162,1,0),(139,'2011-12-17 18:00:00',1,1,'1',2,0,163,1,1),(140,'2011-12-17 19:00:00',1,1,'1',2,0,192,1,1),(141,'2011-12-17 22:00:00',1,0,'2',2,0,216,1,0),(142,'2011-12-17 22:00:00',1,0,'3',2,0,221,1,0),(143,'2011-12-18 00:00:00',1,1,'1',2,0,223,1,1),(144,'2011-12-18 01:00:00',1,1,'1',2,0,216,1,1),(145,'2011-12-18 01:00:00',1,1,'1',2,0,193,1,1),(146,'2011-12-18 02:00:00',1,1,'1',2,0,190,1,1),(147,'2011-12-18 03:00:00',1,1,'1',2,0,189,1,1),(148,'2011-12-18 03:00:00',1,1,'1',2,0,165,1,1),(149,'2011-12-18 04:00:00',1,1,'1',2,0,160,1,1),(150,'2011-12-18 09:00:00',1,0,'2',4,0,230,65,0),(151,'2011-12-18 12:00:00',1,1,'1',2,0,226,1,1),(152,'2011-12-18 13:00:00',1,1,'1',2,0,192,1,1),(153,'2011-12-18 15:00:00',1,1,'1',2,0,161,1,1),(154,'2011-12-18 16:00:00',1,1,'1',2,0,163,1,1),(155,'2011-12-18 16:00:00',1,1,'1',2,0,221,1,1),(156,'2011-12-18 17:00:00',1,1,'1',2,0,187,1,1),(157,'2011-12-18 17:00:00',1,0,'2',4,0,230,65,0),(158,'2011-12-18 18:00:00',1,1,'1',2,0,191,1,1),(159,'2011-12-18 18:00:00',1,0,'2',2,0,221,30,0),(160,'2011-12-18 21:00:00',1,1,'1',2,0,216,1,1),(161,'2011-12-18 21:00:00',1,1,'1',2,0,189,1,1),(162,'2011-12-19 00:00:00',1,1,'1',2,0,162,1,1),(163,'2011-12-19 00:00:00',1,1,'1',2,0,165,1,1),(164,'2011-12-19 01:00:00',1,0,'1',4,0,230,65,0),(165,'2011-12-19 01:00:00',2,0,'5',2,0,221,1,0),(166,'2011-12-19 03:00:00',1,1,'1',2,0,223,1,1),(167,'2011-12-19 04:00:00',1,1,'1',2,0,160,1,1),(168,'2011-12-19 10:00:00',1,1,'1',2,0,190,30,1),(169,'2011-12-19 10:00:00',1,1,'1',2,0,187,1,1),(170,'2011-12-19 12:00:00',1,1,'1',2,0,165,62,1),(171,'2011-12-19 12:00:00',1,0,'1',2,0,221,1,0),(172,'2011-12-19 13:00:00',1,0,'3',2,0,216,30,0),(173,'2011-12-19 13:00:00',2,1,'2',2,0,221,1,1),(174,'2011-12-19 15:00:00',1,1,'1',2,0,191,1,1),(175,'2011-12-19 15:00:00',1,1,'1',2,0,161,1,1),(176,'2011-12-19 16:00:00',1,0,'1',2,0,221,1,0),(177,'2011-12-19 20:00:00',1,1,'1',4,0,230,65,1),(178,'2011-12-19 23:00:00',1,1,'1',2,0,165,1,1),(179,'2011-12-20 00:00:00',1,1,'1',2,0,160,1,1),(180,'2011-12-20 02:00:00',1,1,'1',2,0,162,1,1),(181,'2011-12-20 03:00:00',1,1,'1',2,0,234,1,0),(182,'2011-12-20 06:00:00',1,1,'1',2,0,226,1,1),(183,'2011-12-20 06:00:00',1,1,'1',2,0,163,1,1),(184,'2011-12-20 06:00:00',1,1,'1',2,0,227,1,1),(185,'2011-12-22 05:00:00',1,1,'1',2,0,221,1,1);
/*!40000 ALTER TABLE `p_view_subcategories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `p_whitelabel`
--

DROP TABLE IF EXISTS `p_whitelabel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `p_whitelabel` (
  `wlabel_id` int(11) NOT NULL auto_increment,
  `name` varchar(40) collate utf8_unicode_ci NOT NULL,
  `domain` varchar(250) collate utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL default '0',
  `site_area` varchar(250) collate utf8_unicode_ci NOT NULL,
  `site_title` varchar(250) collate utf8_unicode_ci NOT NULL,
  `site_keywords` text collate utf8_unicode_ci,
  `site_desc` text collate utf8_unicode_ci,
  `show_listing_from_all` tinyint(4) NOT NULL default '0',
  `moderate_members` tinyint(4) NOT NULL default '0',
  `moderate_mediabrokers` tinyint(4) NOT NULL default '0',
  `premiumad_priority` tinyint(4) NOT NULL,
  `site_terms` text collate utf8_unicode_ci,
  `site_testimonial` text collate utf8_unicode_ci,
  `site_welcome` text collate utf8_unicode_ci,
  `site_dailydeals` text collate utf8_unicode_ci,
  `site_mostpopular` text collate utf8_unicode_ci,
  `contact_email` varchar(250) collate utf8_unicode_ci NOT NULL,
  `payment_type` tinyint(4) NOT NULL,
  `paypal_email` varchar(250) collate utf8_unicode_ci default NULL,
  `auth_api_id` varchar(250) collate utf8_unicode_ci default NULL,
  `auth_trans_key` varchar(40) collate utf8_unicode_ci default NULL,
  `news_price` decimal(10,0) default NULL,
  `banner_price` decimal(10,0) default NULL,
  `premiumad_display_type` tinyint(4) NOT NULL,
  `mb_commission_type` tinyint(4) default NULL,
  `mb_commission` decimal(10,0) default NULL,
  `mbroker_id` int(11) default NULL,
  PRIMARY KEY  (`wlabel_id`),
  KEY `p_mediabrokers_p_whitelabel` (`mbroker_id`),
  CONSTRAINT `p_mediabrokers_p_whitelabel` FOREIGN KEY (`mbroker_id`) REFERENCES `p_mediabrokers` (`mbroker_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `p_whitelabel`
--

LOCK TABLES `p_whitelabel` WRITE;
/*!40000 ALTER TABLE `p_whitelabel` DISABLE KEYS */;
INSERT INTO `p_whitelabel` VALUES (1,'None (Superadmin)','none',1,'','',NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,NULL,'',0,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL),(2,'First white label','proximitymarketingservices.net',1,'Texas','Promocast Sample','asdfasdf','asdfasdf',0,0,0,0,'asdfsadfa','asdfsadfasd','asdfasdf','asd','asdfasdf','test@someemail.com',1,'pselle_1322728555_biz@gmail.com','6N8ZfT7wh','7Mx5Wk5ssN9K623M','0','1000',0,2,'25',NULL),(3,'Testing White Label','authorizedcheckout.com',1,'texas','Promocast 2','','',0,0,0,0,'','','','','','maros.fric@gmail.com',1,'pselle_1322728555_biz@gmail.com','','','0','0',0,2,'44',NULL),(4,'Treys Directory','couponhotlist.com',1,'Dallas Texas','Treys Directory','test,keyword','This is my new site description',1,0,0,1,'terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  \r\n\r\nterms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  \r\n\r\nterms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  terms  \r\n','testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial \r\n\r\ntestimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial \r\n\r\ntestimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial \r\n\r\ntestimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial \r\n\r\ntestimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial \r\n\r\ntestimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial \r\n\r\ntestimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial testimonial \r\n','Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome \r\n\r\nSite welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome \r\n\r\nSite welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome \r\n\r\nSite welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome \r\n\r\nSite welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome Site welcome \r\n','Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals \r\n\r\nDaily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals \r\n\r\nDaily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals \r\n\r\nDaily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals Daily Deals Daily DealsDaily Deals Daily Deals \r\n','Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular \r\n\r\nMost popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular \r\n\r\nMost popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular \r\n\r\nMost popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular \r\n\r\nMost popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular Most popular \r\n','webstandardcss@gmail.com',1,'webstandardcss@gmail.com','','','2','5',0,1,'5',NULL);
/*!40000 ALTER TABLE `p_whitelabel` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2011-12-22 13:08:45
