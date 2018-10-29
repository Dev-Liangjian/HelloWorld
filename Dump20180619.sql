CREATE DATABASE  IF NOT EXISTS `forum` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `forum`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: forum
-- ------------------------------------------------------
-- Server version	5.6.14

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
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `category_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '栏目ID',
  `category_name` varchar(50) NOT NULL COMMENT '栏目标题',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'非技术分享'),(2,'开发分享'),(3,'测试分享');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `note`
--

DROP TABLE IF EXISTS `note`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `note` (
  `note_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `note_title` varchar(50) NOT NULL COMMENT '帖子标题',
  `note_content` text NOT NULL COMMENT '帖子内容',
  `note_owner` varchar(20) NOT NULL COMMENT '发帖者(楼主)',
  `note_time` int(10) unsigned NOT NULL COMMENT '发帖时间戳',
  `note_hits` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '帖子点击量',
  `note_category_id` int(10) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`note_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `note`
--

LOCK TABLES `note` WRITE;
/*!40000 ALTER TABLE `note` DISABLE KEYS */;
INSERT INTO `note` VALUES (13,'liang测试发帖','登录后进行发帖','Dliang',1525827270,8,1),
(14,'SQLtest','sql test;','Dliang',1525916602,29,1),(15,'sql','test; \'hello\';','Dliang',1525918195,40,1),
(16,'回帖时间及数量测试','测试一下list_father.php是否正常运行？','Dliang',1526025734,8,1),
(17,'关键字sql','测试关键字','Dliang',1526184910,2,1),(18,'关键字Sql','测试关键字描红','Dliang',1526184951,8,1),
(19,'你好','你好，我是良剑','test123456',1526191633,6,1),(20,'Devliang','i am devliang','Devliang',1526313771,22,1),
(21,'Java开发','增加栏目后进行测试发帖','Dliang',1526546582,8,2),
(22,'测试栏目','增加一个\"测试分享\"栏目的内容','Dliang',1526550922,16,3),
(23,'测试1','测试利用公共link进行发帖','Dliang',1526563473,1,3),
(24,'发新帖','哈哈哈，我是开发者','Devliang',1526910104,2,2),
(25,'发帖来了','我又来发贴了。哈哈','Devliang',1529414616,0,2);
/*!40000 ALTER TABLE `note` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reply`
--

DROP TABLE IF EXISTS `reply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reply` (
  `reply_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '回帖主键ID',
  `reply_note_id` int(10) unsigned NOT NULL COMMENT '所属主贴(外键)',
  `reply_user` varchar(20) NOT NULL COMMENT '回帖者昵称(外键)',
  `reply_content` text NOT NULL COMMENT '回复内容',
  `reply_time` int(10) unsigned NOT NULL COMMENT '回帖时间戳',
  `reply_quote_id` int(10) unsigned NOT NULL DEFAULT '0',
  `reply_floor` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`reply_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reply`
--

LOCK TABLES `reply` WRITE;
/*!40000 ALTER TABLE `reply` DISABLE KEYS */;
INSERT INTO `reply` VALUES (1,6,'回帖游客','回帖测试',1525533607,0,0),
(2,6,'回帖游客','继续进行回帖测试',1525533656,0,0),
(3,5,'回帖游客','PHP第一次测试',1525534135,0,0),
(4,5,'回帖游客','PHP第二次回帖测试',1525534155,0,0),
(5,6,'回帖游客','reply test',1525589591,0,0),
(6,6,'回帖游客','4',1525610408,0,0),
(7,6,'回帖游客','5',1525610413,0,0),
(8,6,'回帖游客','6',1525610418,0,0),
(9,13,'Devliang','Devliang  测试回帖',1525827339,0,0),
(10,14,'Dliang','SQLtest;;;xxxxxxxxxx',1525916616,0,0),
(11,14,'Dliang','sql test; \'\'\'\' ',1525918147,0,0),
(12,15,'Dliang','改变回帖表后，测试回帖功能是否正常',1525939799,0,0),
(13,15,'Dliang','这是引用回帖',1525943350,12,1),(
14,15,'Dliang','测试引用回帖功能？',1525948191,13,2),
(15,15,'Devliang','测试用户信息——头像是否正常。',1525966402,0,0),
(16,15,'Devliang','测试成功',1525967077,14,3),
(17,15,'Dliang','测试回复',1526397025,0,0),
(18,20,'Dliang','1',1526397410,0,0),
(19,20,'Dliang','2',1526397412,0,0),
(20,20,'Dliang','3',1526397415,0,0),
(21,20,'Dliang','4',1526397418,0,0),
(22,20,'Dliang','5',1526397421,0,0),
(23,20,'Dliang','6',1526397424,0,0),
(24,20,'Dliang','7',1526397428,0,0),
(25,20,'Dliang','8888',1526397439,23,6),
(26,19,'Dliang','我知道',1526547661,0,0),
(27,18,'zhuce3','使用公共链接 link  进行回帖测试',1526564488,0,0),
(30,14,'Devliang','xxxxxxxxxxxxxxxx',1526910018,0,0),
(31,18,'Devliang','????????????',1526910051,0,0),
(35,20,'Devliang','看看disabled是否可用',1528716637,0,0),
(37,20,'Devliang','22222222222222',1528717471,35,9),
(38,20,'Devliang','回帖设计与实现',1529414710,0,0);
/*!40000 ALTER TABLE `reply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `user_name` varchar(20) NOT NULL COMMENT '用户名',
  `user_password` char(32) NOT NULL COMMENT '用户密码',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Dliang','e10adc3949ba59abbe56e057f20f883e'),
(2,'Devliang','e10adc3949ba59abbe56e057f20f883e'),
(3,'test123456','c33367701511b4f6020ec61ded352059'),
(4,'zhuce1','e10adc3949ba59abbe56e057f20f883e'),
(5,'zhuce2','e10adc3949ba59abbe56e057f20f883e'),
(6,'zhuce3','e10adc3949ba59abbe56e057f20f883e');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userinfo`
--

DROP TABLE IF EXISTS `userinfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userinfo` (
  `userinfo_id` int(10) unsigned NOT NULL,
  `userinfo_sex` enum('man','woman','secret') DEFAULT NULL COMMENT '性别',
  `userinfo_region` varchar(20) DEFAULT NULL COMMENT '所在地区',
  `userinfo_industry` varchar(30) DEFAULT NULL COMMENT '熟悉领域',
  `userinfo_text` text COMMENT '简述',
  `userinfo_image` varchar(50) NOT NULL DEFAULT 'default.jpg',
  `userinfo_email` varchar(50) DEFAULT NULL COMMENT '邮箱',
  PRIMARY KEY (`userinfo_id`),
  CONSTRAINT `fk_userinfo_user` FOREIGN KEY (`userinfo_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userinfo`
--

LOCK TABLES `userinfo` WRITE;
/*!40000 ALTER TABLE `userinfo` DISABLE KEYS */;
INSERT INTO `userinfo` VALUES (1,NULL,NULL,NULL,NULL,'201805102152316034.jpg',NULL),
(2,'woman','广东江门','互联网','不一样的自我介绍 我是本站的开发人员','201806111945364460.jpg','857719089@qq.com'),
(3,NULL,NULL,NULL,NULL,'201805142357138431.jpg',NULL),
(4,NULL,NULL,NULL,NULL,'default.jpg',NULL),
(5,NULL,NULL,NULL,NULL,'default.jpg',NULL),
(6,NULL,NULL,NULL,NULL,'default.jpg',NULL);
/*!40000 ALTER TABLE `userinfo` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-06-19 21:43:45
