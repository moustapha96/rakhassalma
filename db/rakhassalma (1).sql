-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 25 jan. 2024 à 08:29
-- Version du serveur : 8.0.31
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `rakhassalma`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresses`
--

DROP TABLE IF EXISTS `adresses`;
CREATE TABLE IF NOT EXISTS `adresses` (
  `idAdresses` int NOT NULL AUTO_INCREMENT,
  `lieu` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `coordonnee` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idClients` int NOT NULL,
  PRIMARY KEY (`idAdresses`),
  KEY `fk_Adresses_Clients1_idx` (`idClients`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `idClients` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `prenom` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `adresse` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telephone` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `localisation` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idClients`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `etats`
--

DROP TABLE IF EXISTS `etats`;
CREATE TABLE IF NOT EXISTS `etats` (
  `idEtats` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `statut` tinyint DEFAULT NULL,
  PRIMARY KEY (`idEtats`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `laveur`
--

DROP TABLE IF EXISTS `laveur`;
CREATE TABLE IF NOT EXISTS `laveur` (
  `idLaveur` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idStations` int NOT NULL,
  PRIMARY KEY (`idLaveur`),
  KEY `fk_Laveur_Stations1_idx` (`idStations`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

DROP TABLE IF EXISTS `paiement`;
CREATE TABLE IF NOT EXISTS `paiement` (
  `idPaiement` int NOT NULL AUTO_INCREMENT,
  `montant` float DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `statut` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idPaiement`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `parametres`
--

DROP TABLE IF EXISTS `parametres`;
CREATE TABLE IF NOT EXISTS `parametres` (
  `idParametres` int NOT NULL AUTO_INCREMENT,
  `logo` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telephone` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(9) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nom` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idParametres`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `telephone_UNIQUE` (`telephone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `idReservation` int NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `idClients` int NOT NULL,
  `idStations` int NOT NULL,
  `idPaiement` int NOT NULL,
  `idEtats` int NOT NULL,
  `idType_de_lavage` int NOT NULL,
  PRIMARY KEY (`idReservation`),
  KEY `fk_Reservations_Clients_idx` (`idClients`),
  KEY `fk_Reservations_Stations1_idx` (`idStations`),
  KEY `fk_Reservations_Paiement1_idx` (`idPaiement`),
  KEY `fk_Reservations_Etats1_idx` (`idEtats`),
  KEY `fk_Reservations_Type_de_lavage1_idx` (`idType_de_lavage`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `stations`
--

DROP TABLE IF EXISTS `stations`;
CREATE TABLE IF NOT EXISTS `stations` (
  `idStations` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `coordonnee` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `compte` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `logo` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telephone` varchar(9) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idStations`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `station_favorie`
--

DROP TABLE IF EXISTS `station_favorie`;
CREATE TABLE IF NOT EXISTS `station_favorie` (
  `idStation_favorie` int NOT NULL AUTO_INCREMENT,
  `Clients_idClients` int NOT NULL,
  `Stations_idStations` int NOT NULL,
  PRIMARY KEY (`idStation_favorie`),
  KEY `fk_Station_favorie_Clients1_idx` (`Clients_idClients`),
  KEY `fk_Station_favorie_Stations1_idx` (`Stations_idStations`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tarifs`
--

DROP TABLE IF EXISTS `tarifs`;
CREATE TABLE IF NOT EXISTS `tarifs` (
  `idType_de_lavage` int NOT NULL,
  `idVoitures` int NOT NULL,
  `montant` float DEFAULT NULL,
  PRIMARY KEY (`idType_de_lavage`,`idVoitures`),
  KEY `fk_Type_de_lavage_has_Voitures_Voitures1_idx` (`idVoitures`),
  KEY `fk_Type_de_lavage_has_Voitures_Type_de_lavage1_idx` (`idType_de_lavage`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `type_de_lavage`
--

DROP TABLE IF EXISTS `type_de_lavage`;
CREATE TABLE IF NOT EXISTS `type_de_lavage` (
  `idType_de_lavage` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `statut` tinyint DEFAULT NULL,
  PRIMARY KEY (`idType_de_lavage`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `idAdmin` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `prenom` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `adresse` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telephone` varchar(9) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `motspass` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `matricule` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idAdmin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `voitures`
--

DROP TABLE IF EXISTS `voitures`;
CREATE TABLE IF NOT EXISTS `voitures` (
  `idVoitures` int NOT NULL,
  `marque` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `modele` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `annee` date DEFAULT NULL,
  `couleur` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `type` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idVoitures`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adresses`
--
ALTER TABLE `adresses`
  ADD CONSTRAINT `fk_Adresses_Clients1` FOREIGN KEY (`idClients`) REFERENCES `clients` (`idClients`);

--
-- Contraintes pour la table `laveur`
--
ALTER TABLE `laveur`
  ADD CONSTRAINT `fk_Laveur_Stations1` FOREIGN KEY (`idStations`) REFERENCES `stations` (`idStations`);

--
-- Contraintes pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `fk_Reservations_Clients` FOREIGN KEY (`idClients`) REFERENCES `clients` (`idClients`),
  ADD CONSTRAINT `fk_Reservations_Etats1` FOREIGN KEY (`idEtats`) REFERENCES `etats` (`idEtats`),
  ADD CONSTRAINT `fk_Reservations_Paiement1` FOREIGN KEY (`idPaiement`) REFERENCES `paiement` (`idPaiement`),
  ADD CONSTRAINT `fk_Reservations_Stations1` FOREIGN KEY (`idStations`) REFERENCES `stations` (`idStations`),
  ADD CONSTRAINT `fk_Reservations_Type_de_lavage1` FOREIGN KEY (`idType_de_lavage`) REFERENCES `type_de_lavage` (`idType_de_lavage`);

--
-- Contraintes pour la table `station_favorie`
--
ALTER TABLE `station_favorie`
  ADD CONSTRAINT `fk_Station_favorie_Clients1` FOREIGN KEY (`Clients_idClients`) REFERENCES `clients` (`idClients`),
  ADD CONSTRAINT `fk_Station_favorie_Stations1` FOREIGN KEY (`Stations_idStations`) REFERENCES `stations` (`idStations`);

--
-- Contraintes pour la table `tarifs`
--
ALTER TABLE `tarifs`
  ADD CONSTRAINT `fk_Type_de_lavage_has_Voitures_Type_de_lavage1` FOREIGN KEY (`idType_de_lavage`) REFERENCES `type_de_lavage` (`idType_de_lavage`),
  ADD CONSTRAINT `fk_Type_de_lavage_has_Voitures_Voitures1` FOREIGN KEY (`idVoitures`) REFERENCES `voitures` (`idVoitures`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
