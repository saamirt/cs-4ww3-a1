CREATE DATABASE  IF NOT EXISTS `pokestopdb`;
USE `pokestopdb`;
-- MySQL dump 10.13  Distrib 8.0.18, for Win64 (x86_64)
--
-- Host: localhost    Database: pokestopdb
-- ------------------------------------------------------
-- Server version	8.0.18

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `pokestops`
--

DROP TABLE IF EXISTS `pokestops`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pokestops` (
  `pokestopID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `description` varchar(256) NOT NULL,
  PRIMARY KEY (`pokestopID`)
) ENGINE=InnoDB AUTO_INCREMENT=13;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pokestops`
--

LOCK TABLES `pokestops` WRITE;
/*!40000 ALTER TABLE `pokestops` DISABLE KEYS */;
INSERT INTO `pokestops` VALUES (0,'University at Life Sciences',43.260891,-79.918625,'Bus stop outside the Life Sciences building towards the John Hodgins Engineering building.'),(1,'Health Sciences Entrance',43.260274,-79.918101,'Entrance to Health Sciences building facing towards Life Sciences building.'),(2,'Willy Dog',43.262887,-79.918727,'Hot Dog stand outside McMaster University Student Centre and Mills Memorial Library.'),(3,'East Meets West Bistro',43.262418,-79.922495,'International restaurant-style dining featuring multicultural cuisine inside the Mary Keyes building.'),(4,'Arts Quad',43.263992,-79.917618,'Paved area located between the McMaster University Student Centre, Kenneth Taylor Hall, and Togo Salmon Hall.'),(5,'Dalewood Recreation Centre',43.258357,-79.912333,'Community recreation centre located near the Westdale area on Main st.'),(6,'Dough Box Wood Fired Pizza',43.257474,-79.924041,'Hot Dog stand outside McMaster University Student Centre and Mills Memorial Library.'),(7,'Lazeez Shawarma',43.261548,-79.906421,'Middle Eastern fast-food restaurant located in the Westdale area.'),(8,'OneZo Tapioca',43.261359,-79.906909,'Bubble Tea restaurant in the Westdale area known for making their own tapioca pearls.');
/*!40000 ALTER TABLE `pokestops` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reviews` (
  `reviewID` int(11) NOT NULL AUTO_INCREMENT,
  `pokestopID` int(11) NOT NULL,
  `title` varchar(45) NOT NULL,
  `rating` int(11) NOT NULL,
  `text` varchar(512) NOT NULL,
  `author` varchar(45) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`reviewID`),
  KEY `pokestopID_idx` (`pokestopID`),
  CONSTRAINT `pokestopID` FOREIGN KEY (`pokestopID`) REFERENCES `pokestops` (`pokestopID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=927;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES (0,0,'Best PokeStop Ever!',5,'This is the best pokestop I have ever been to. I have yet to go to other PokeStops but surely this one is the best. I wanna be the very best Like no one ever was To catch them is my real test To train them is my cause I will travel across the land Searching far and wide Teach Pokemon to understand The power that\'s inside Pokemon! Gotta catch \'em all It\'s you and me I know it\'s my destiny Pokemon! Oh, you\'re my best friend In a world we must defend','PokemonGoUser123','2019-12-01 09:02:45'),(1,0,'Worse PokeStop Ever',5,'This is the worst pokestop I have ever been to. I have yet to go to other PokeStops but surely this one is the best. I wanna be the very best Like no one ever was To catch them is my real test To train them is my cause I will travel across the land Searching far and wide Teach Pokemon to understand The power that\'s inside Pokemon! Gotta catch \'em all It\'s you and me I know it\'s my destiny Pokemon! Oh, you\'re my best friend In a world we must defend','saamirt','2019-12-01 09:05:27'),(2,0,'Pretty Good PokeStop',5,'This is the most okay pokestop I have ever been to. I have yet to go to other PokeStops but surely this one is the best. I wanna be the very best Like no one ever was To catch them is my real test To train them is my cause I will travel across the land Searching far and wide Teach Pokemon to understand The power that\'s inside Pokemon! Gotta catch \'em all It\'s you and me I know it\'s my destiny Pokemon! Oh, you\'re my best friend In a world we must defend','ashketchum','2019-12-01 09:05:27'),(3,1,'Best PokeStop Ever!',5,'This is the best pokestop I have ever been to. I have yet to go to other PokeStops but surely this one is the best. I wanna be the very best Like no one ever was To catch them is my real test To train them is my cause I will travel across the land Searching far and wide Teach Pokemon to understand The power that\'s inside Pokemon! Gotta catch \'em all It\'s you and me I know it\'s my destiny Pokemon! Oh, you\'re my best friend In a world we must defend','PokemonGoUser123','2019-12-01 09:05:27'),(4,1,'Worse PokeStop Ever',5,'This is the worst pokestop I have ever been to. I have yet to go to other PokeStops but surely this one is the best. I wanna be the very best Like no one ever was To catch them is my real test To train them is my cause I will travel across the land Searching far and wide Teach Pokemon to understand The power that\'s inside Pokemon! Gotta catch \'em all It\'s you and me I know it\'s my destiny Pokemon! Oh, you\'re my best friend In a world we must defend','saamirt','2019-12-01 09:05:27'),(5,1,'Pretty Good PokeStop',5,'This is the most okay pokestop I have ever been to. I have yet to go to other PokeStops but surely this one is the best. I wanna be the very best Like no one ever was To catch them is my real test To train them is my cause I will travel across the land Searching far and wide Teach Pokemon to understand The power that\'s inside Pokemon! Gotta catch \'em all It\'s you and me I know it\'s my destiny Pokemon! Oh, you\'re my best friend In a world we must defend','ashketchum','2019-12-01 09:05:27'),(6,2,'Best PokeStop Ever!',5,'This is the best pokestop I have ever been to. I have yet to go to other PokeStops but surely this one is the best. I wanna be the very best Like no one ever was To catch them is my real test To train them is my cause I will travel across the land Searching far and wide Teach Pokemon to understand The power that\'s inside Pokemon! Gotta catch \'em all It\'s you and me I know it\'s my destiny Pokemon! Oh, you\'re my best friend In a world we must defend','PokemonGoUser123','2019-12-01 09:05:27'),(7,2,'Worse PokeStop Ever',5,'This is the worst pokestop I have ever been to. I have yet to go to other PokeStops but surely this one is the best. I wanna be the very best Like no one ever was To catch them is my real test To train them is my cause I will travel across the land Searching far and wide Teach Pokemon to understand The power that\'s inside Pokemon! Gotta catch \'em all It\'s you and me I know it\'s my destiny Pokemon! Oh, you\'re my best friend In a world we must defend','saamirt','2019-12-01 09:05:27'),(8,2,'Pretty Good PokeStop',5,'This is the most okay pokestop I have ever been to. I have yet to go to other PokeStops but surely this one is the best. I wanna be the very best Like no one ever was To catch them is my real test To train them is my cause I will travel across the land Searching far and wide Teach Pokemon to understand The power that\'s inside Pokemon! Gotta catch \'em all It\'s you and me I know it\'s my destiny Pokemon! Oh, you\'re my best friend In a world we must defend','ashketchum','2019-12-01 09:05:27'),(9,3,'Best PokeStop Ever!',5,'This is the best pokestop I have ever been to. I have yet to go to other PokeStops but surely this one is the best. I wanna be the very best Like no one ever was To catch them is my real test To train them is my cause I will travel across the land Searching far and wide Teach Pokemon to understand The power that\'s inside Pokemon! Gotta catch \'em all It\'s you and me I know it\'s my destiny Pokemon! Oh, you\'re my best friend In a world we must defend','PokemonGoUser123','2019-12-01 09:05:27'),(10,3,'Worse PokeStop Ever',5,'This is the worst pokestop I have ever been to. I have yet to go to other PokeStops but surely this one is the best. I wanna be the very best Like no one ever was To catch them is my real test To train them is my cause I will travel across the land Searching far and wide Teach Pokemon to understand The power that\'s inside Pokemon! Gotta catch \'em all It\'s you and me I know it\'s my destiny Pokemon! Oh, you\'re my best friend In a world we must defend','saamirt','2019-12-01 09:05:27'),(11,3,'Pretty Good PokeStop',5,'This is the most okay pokestop I have ever been to. I have yet to go to other PokeStops but surely this one is the best. I wanna be the very best Like no one ever was To catch them is my real test To train them is my cause I will travel across the land Searching far and wide Teach Pokemon to understand The power that\'s inside Pokemon! Gotta catch \'em all It\'s you and me I know it\'s my destiny Pokemon! Oh, you\'re my best friend In a world we must defend','ashketchum','2019-12-01 09:05:27'),(12,4,'Best PokeStop Ever!',5,'This is the best pokestop I have ever been to. I have yet to go to other PokeStops but surely this one is the best. I wanna be the very best Like no one ever was To catch them is my real test To train them is my cause I will travel across the land Searching far and wide Teach Pokemon to understand The power that\'s inside Pokemon! Gotta catch \'em all It\'s you and me I know it\'s my destiny Pokemon! Oh, you\'re my best friend In a world we must defend','PokemonGoUser123','2019-12-01 09:05:27'),(13,4,'Worse PokeStop Ever',5,'This is the worst pokestop I have ever been to. I have yet to go to other PokeStops but surely this one is the best. I wanna be the very best Like no one ever was To catch them is my real test To train them is my cause I will travel across the land Searching far and wide Teach Pokemon to understand The power that\'s inside Pokemon! Gotta catch \'em all It\'s you and me I know it\'s my destiny Pokemon! Oh, you\'re my best friend In a world we must defend','saamirt','2019-12-01 09:05:27'),(14,4,'Pretty Good PokeStop',5,'This is the most okay pokestop I have ever been to. I have yet to go to other PokeStops but surely this one is the best. I wanna be the very best Like no one ever was To catch them is my real test To train them is my cause I will travel across the land Searching far and wide Teach Pokemon to understand The power that\'s inside Pokemon! Gotta catch \'em all It\'s you and me I know it\'s my destiny Pokemon! Oh, you\'re my best friend In a world we must defend','ashketchum','2019-12-01 09:05:27'),(15,5,'Best PokeStop Ever!',5,'This is the best pokestop I have ever been to. I have yet to go to other PokeStops but surely this one is the best. I wanna be the very best Like no one ever was To catch them is my real test To train them is my cause I will travel across the land Searching far and wide Teach Pokemon to understand The power that\'s inside Pokemon! Gotta catch \'em all It\'s you and me I know it\'s my destiny Pokemon! Oh, you\'re my best friend In a world we must defend','PokemonGoUser123','2019-12-01 09:05:27'),(16,5,'Worse PokeStop Ever',5,'This is the worst pokestop I have ever been to. I have yet to go to other PokeStops but surely this one is the best. I wanna be the very best Like no one ever was To catch them is my real test To train them is my cause I will travel across the land Searching far and wide Teach Pokemon to understand The power that\'s inside Pokemon! Gotta catch \'em all It\'s you and me I know it\'s my destiny Pokemon! Oh, you\'re my best friend In a world we must defend','saamirt','2019-12-01 09:05:27'),(17,5,'Pretty Good PokeStop',5,'This is the most okay pokestop I have ever been to. I have yet to go to other PokeStops but surely this one is the best. I wanna be the very best Like no one ever was To catch them is my real test To train them is my cause I will travel across the land Searching far and wide Teach Pokemon to understand The power that\'s inside Pokemon! Gotta catch \'em all It\'s you and me I know it\'s my destiny Pokemon! Oh, you\'re my best friend In a world we must defend','ashketchum','2019-12-01 09:05:27'),(18,6,'Best PokeStop Ever!',5,'This is the best pokestop I have ever been to. I have yet to go to other PokeStops but surely this one is the best. I wanna be the very best Like no one ever was To catch them is my real test To train them is my cause I will travel across the land Searching far and wide Teach Pokemon to understand The power that\'s inside Pokemon! Gotta catch \'em all It\'s you and me I know it\'s my destiny Pokemon! Oh, you\'re my best friend In a world we must defend','PokemonGoUser123','2019-12-01 09:05:27'),(19,6,'Worse PokeStop Ever',5,'This is the worst pokestop I have ever been to. I have yet to go to other PokeStops but surely this one is the best. I wanna be the very best Like no one ever was To catch them is my real test To train them is my cause I will travel across the land Searching far and wide Teach Pokemon to understand The power that\'s inside Pokemon! Gotta catch \'em all It\'s you and me I know it\'s my destiny Pokemon! Oh, you\'re my best friend In a world we must defend','saamirt','2019-12-01 09:05:27'),(20,6,'Pretty Good PokeStop',5,'This is the most okay pokestop I have ever been to. I have yet to go to other PokeStops but surely this one is the best. I wanna be the very best Like no one ever was To catch them is my real test To train them is my cause I will travel across the land Searching far and wide Teach Pokemon to understand The power that\'s inside Pokemon! Gotta catch \'em all It\'s you and me I know it\'s my destiny Pokemon! Oh, you\'re my best friend In a world we must defend','ashketchum','2019-12-01 09:05:27'),(21,7,'Best PokeStop Ever!',5,'This is the best pokestop I have ever been to. I have yet to go to other PokeStops but surely this one is the best. I wanna be the very best Like no one ever was To catch them is my real test To train them is my cause I will travel across the land Searching far and wide Teach Pokemon to understand The power that\'s inside Pokemon! Gotta catch \'em all It\'s you and me I know it\'s my destiny Pokemon! Oh, you\'re my best friend In a world we must defend','PokemonGoUser123','2019-12-01 09:05:27'),(22,7,'Worse PokeStop Ever',5,'This is the worst pokestop I have ever been to. I have yet to go to other PokeStops but surely this one is the best. I wanna be the very best Like no one ever was To catch them is my real test To train them is my cause I will travel across the land Searching far and wide Teach Pokemon to understand The power that\'s inside Pokemon! Gotta catch \'em all It\'s you and me I know it\'s my destiny Pokemon! Oh, you\'re my best friend In a world we must defend','saamirt','2019-12-01 09:05:27'),(23,7,'Pretty Good PokeStop',5,'This is the most okay pokestop I have ever been to. I have yet to go to other PokeStops but surely this one is the best. I wanna be the very best Like no one ever was To catch them is my real test To train them is my cause I will travel across the land Searching far and wide Teach Pokemon to understand The power that\'s inside Pokemon! Gotta catch \'em all It\'s you and me I know it\'s my destiny Pokemon! Oh, you\'re my best friend In a world we must defend','ashketchum','2019-12-01 09:05:27'),(24,8,'Best PokeStop Ever!',5,'This is the best pokestop I have ever been to. I have yet to go to other PokeStops but surely this one is the best. I wanna be the very best Like no one ever was To catch them is my real test To train them is my cause I will travel across the land Searching far and wide Teach Pokemon to understand The power that\'s inside Pokemon! Gotta catch \'em all It\'s you and me I know it\'s my destiny Pokemon! Oh, you\'re my best friend In a world we must defend','PokemonGoUser123','2019-12-01 09:05:27'),(25,8,'Worse PokeStop Ever',5,'This is the worst pokestop I have ever been to. I have yet to go to other PokeStops but surely this one is the best. I wanna be the very best Like no one ever was To catch them is my real test To train them is my cause I will travel across the land Searching far and wide Teach Pokemon to understand The power that\'s inside Pokemon! Gotta catch \'em all It\'s you and me I know it\'s my destiny Pokemon! Oh, you\'re my best friend In a world we must defend','saamirt','2019-12-01 09:05:27'),(26,8,'Pretty Good PokeStop',5,'This is the most okay pokestop I have ever been to. I have yet to go to other PokeStops but surely this one is the best. I wanna be the very best Like no one ever was To catch them is my real test To train them is my cause I will travel across the land Searching far and wide Teach Pokemon to understand The power that\'s inside Pokemon! Gotta catch \'em all It\'s you and me I know it\'s my destiny Pokemon! Oh, you\'re my best friend In a world we must defend','ashketchum','2019-12-01 09:05:27');
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `birthdate` date NOT NULL,
  `password` varchar(64) NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Ash','Ketchum','Ashketchum@gmail.com','1990-02-20','ash'),(2,'PokemonUser123','Smith','pokemonuser123@gmail.com','2001-02-01','pokemonuser123'),(3,'Aamir','Tahir','saamirt@gmail.com','1999-05-01','aamir');
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

-- Dump completed on 2019-12-01 16:08:45
