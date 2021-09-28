# ************************************************************
# Sequel Pro SQL dump
# Version 5446
#
# https://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.6.4-MariaDB-1:10.6.4+maria~focal)
# Database: collection
# Generation Time: 2021-09-27 09:48:24 +0000
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `games` WRITE;
/*!40000 ALTER TABLE `games` DISABLE KEYS */;

INSERT INTO `games` (`id`, `name`, `genre`, `length`, `price`)
VALUES
	(1,'Call of duty: modern warfare.','FPS',6,59.99),
	(2,'Outer Wilds','RPG',12,39.99),
	(3,'Super Mario Galaxy','Platformer',20,49.99),
	(4,'A Hat in time','Platformer',20,29.99),
	(5,'Civ 6','Strategy',500,69.99),
	(6,'Bloodborne','RPG',30,49.99),
	(7,'Mario Kart 8','Racing',15,49.99),
	(8,'Metroid Prime','FPS',35,39.99),
	(9,'Pokemon Black 2','RPG',40,49.99),
	(10,'Risk of Rain 2','3rd person shooter',30,29.99),
	(11,'Journey','RPG',15,9.99);

/*!40000 ALTER TABLE `games` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
