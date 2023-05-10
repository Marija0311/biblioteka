/*
SQLyog Community v13.1.9 (64 bit)
MySQL - 10.4.25-MariaDB : Database - library
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`library` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `library`;

/*Table structure for table `administrator` */

DROP TABLE IF EXISTS `administrator`;

CREATE TABLE `administrator` (
  `administratorid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  PRIMARY KEY (`administratorid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `administrator` */

insert  into `administrator`(`administratorid`,`username`,`password`) values 
(1,'marija031100@gmail.com','marija');

/*Table structure for table `book` */

DROP TABLE IF EXISTS `book`;

CREATE TABLE `book` (
  `bookid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `god` int(4) NOT NULL,
  `published_in` varchar(255) NOT NULL,
  `writerid` int(11) DEFAULT NULL,
  PRIMARY KEY (`bookid`),
  KEY `fk_w` (`writerid`),
  CONSTRAINT `fk_w` FOREIGN KEY (`writerid`) REFERENCES `writer` (`writerid`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

/*Data for the table `book` */

insert  into `book`(`bookid`,`title`,`god`,`published_in`,`writerid`) values 
(4,'Women        ',1978,'England   ',6),
(5,'The Metamorphosis',1915,'Germany',3),
(9,'Crime and Punishment',1889,'Russia',1);

/*Table structure for table `writer` */

DROP TABLE IF EXISTS `writer`;

CREATE TABLE `writer` (
  `writerid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`writerid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Data for the table `writer` */

insert  into `writer`(`writerid`,`name`) values 
(1,'Fyodor Dostoevsky'),
(2,'J. D. Salinger'),
(3,'Franz Kafka'),
(4,'George Orwell'),
(5,'Mikhail Bulgakov'),
(6,'Charles Bukowski'),
(7,'Edgar Allan Poe');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
