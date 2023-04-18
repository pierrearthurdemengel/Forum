-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour forum_pierre-arthur
CREATE DATABASE IF NOT EXISTS `forum_pierre-arthur` /*!40100 DEFAULT CHARACTER SET latin1 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `forum_pierre-arthur`;

-- Listage de la structure de table forum_pierre-arthur. category
CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `dateCreation` datetime DEFAULT CURRENT_TIMESTAMP,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id_category`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum_pierre-arthur.category : ~5 rows (environ)
INSERT INTO `category` (`id_category`, `categoryName`, `dateCreation`, `user_id`) VALUES
	(2, 'les fleurs des champs', '2023-04-04 10:37:19', 1),
	(3, 'les plantes commestibles', '2023-04-04 10:37:36', 1),
	(10, 'La cat&eacute;gorie &agrave; supprimer', NULL, NULL);

-- Listage de la structure de table forum_pierre-arthur. post
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '0',
  `text` text NOT NULL,
  `datePost` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int NOT NULL DEFAULT '0',
  `topic_id` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_post`) USING BTREE,
  KEY `user_id` (`user_id`),
  KEY `topic_id` (`topic_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum_pierre-arthur.post : ~2 rows (environ)
INSERT INTO `post` (`id_post`, `title`, `text`, `datePost`, `user_id`, `topic_id`) VALUES
	(24, '0', ' ggggggggggg', '2023-04-14 09:46:43', 1, 16),
	(25, '0', ' ggggggggggg', '2023-04-14 09:46:47', 1, 16);

-- Listage de la structure de table forum_pierre-arthur. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int NOT NULL AUTO_INCREMENT,
  `topicName` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `locked` tinyint(1) DEFAULT '0',
  `user_id` int NOT NULL,
  `category_id` int NOT NULL,
  PRIMARY KEY (`id_topic`),
  KEY `user_id` (`user_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum_pierre-arthur.topic : ~6 rows (environ)
INSERT INTO `topic` (`id_topic`, `topicName`, `creationDate`, `locked`, `user_id`, `category_id`) VALUES
	(4, '4th', '2023-04-04 13:40:48', 0, 1, 3),
	(6, 'les coquelicots', '2023-04-04 13:47:51', 0, 1, 2),
	(15, 'les orties', '2023-04-11 14:24:31', 0, 1, 3),
	(16, 'les pissenlits', '2023-04-14 09:04:48', 0, 1, 3);

-- Listage de la structure de table forum_pierre-arthur. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(255) NOT NULL,
  `dateSignIn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT 'user',
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum_pierre-arthur.user : ~3 rows (environ)
INSERT INTO `user` (`id_user`, `pseudo`, `email`, `password`, `dateSignIn`, `role`) VALUES
	(1, 'pesudo', 'email@email', '123', '2023-04-04 09:19:17', 'ROLE_ADMIN'),
	(2, 'ipoucht', 'ipoucht@gmail.com', '456', '2023-04-04 11:13:37', 'user'),
	(3, 'Pierre-Arthur', 'pademengel@gmail.com', '789', '2023-04-04 11:14:05', 'ROLE_ADMIN'),
	(5, 'micka', 'micka@exemple.com', '$2y$10$nHuNw372QKuDgiWZyKMS2.y2u1TysFt/OSiFMWw4G.Ef3cAqO7cFq', '2023-04-14 14:22:42', 'user'),
	(6, 'Ipoucht', 'ipouchtdu67@gmail.com', '$2y$10$XlysHdoodi1OKvHGYkDAq.Qxq7I6Wx/L8XNtjxeAn55gyzaIXu6XS', '2023-04-14 15:56:38', NULL),
	(7, 'Ipoucht', 'ipouchtdu67@gmail.com', '$2y$10$STokhsLoepj.0FuMqXXIVuPXPq0FK.YGCZBzFyfn1YwZDS2z1OWoK', '2023-04-14 16:15:03', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
