# ************************************************************
# Sequel Pro SQL dump
# Version 5446
#
# https://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.6.4-MariaDB-1:10.6.4+maria~focal)
# Database: collection
# Generation Time: 2021-09-29 13:50:32 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table games
# ------------------------------------------------------------

DROP TABLE IF EXISTS `games`;

CREATE TABLE `games` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `genre` varchar(30) DEFAULT NULL,
  `length` smallint(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `delete` tinyint(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `games` WRITE;
/*!40000 ALTER TABLE `games` DISABLE KEYS */;

INSERT INTO `games` (`id`, `name`, `genre`, `length`, `price`, `delete`)
VALUES
	(1,'Call of duty: modern warfare.','FPS',6,59.99,0),
	(2,'Outer Wilds','RPG',12,39.99,0),
	(3,'Super Mario Galaxy','Platformer',20,49.99,0),
	(4,'A Hat in time','Platformer',20,29.99,0),
	(5,'Civ 6','Strategy',500,69.99,0),
	(6,'Bloodborne','RPG',30,49.99,0),
	(7,'Mario Kart 8','Racing',15,49.99,0),
	(8,'Metroid Prime','FPS',35,39.99,0),
	(9,'Pokemon Black 2','RPG',40,49.99,0),
	(10,'Risk of Rain 2','Rouge like',40,39.99,0),
	(11,'Journey','Platformer',50,49.99,0),
	(12,'Dota','MOBA',20,0,0),
	(13,'WoW','MMO RPG',300,59.99,0),
	(15,'SSB Melee','Fighting',50,59.99,0),
	(16,'Castlevania 4','Platformer',30,19.99,0),
	(26,'QWOP','rage',5,1.99,0),
	(28,'Final fantasy 7','RPG',100,9.99,0),
	(31,'Super Mario 64','Platformer',20,15.99,0),
	(32,'Call of Duty 3','FPS',10,10.99,0),
	(37,'Jet Set Radio','RPG',20,29.99,0),
	(44,'SSB Brawl','Fighting',30,59.99,0),
	(46,'Castlevania 2','Platformer',20,10.99,0),
	(47,'Super Metroid','Platformer',30,10.99,0),
	(53,'Turok','FPS',20,9.99,0),
	(54,'Donkey Kong Country','Platformer',20,29.99,0),
	(59,'Trine 3','Platformer',30,9.99,0),
	(61,'Far Cry','RPG',50,59.99,0),
	(67,'Pokemon GO','mobile',1,0,0);

/*!40000 ALTER TABLE `games` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
