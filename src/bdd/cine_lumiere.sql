-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 03 avr. 2026 à 12:38
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cine_lumiere`
--

-- --------------------------------------------------------

--
-- Structure de la table `code_promo`
--

DROP TABLE IF EXISTS `code_promo`;
CREATE TABLE IF NOT EXISTS `code_promo` (
  `id_code_promo` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `pourcentage` decimal(5,2) NOT NULL COMMENT 'Réduction en %',
  `etat` enum('actif','expiré') NOT NULL DEFAULT 'actif',
  PRIMARY KEY (`id_code_promo`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film`
--

DROP TABLE IF EXISTS `film`;
CREATE TABLE IF NOT EXISTS `film` (
  `id_film` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(200) NOT NULL,
  `duree` smallint UNSIGNED NOT NULL COMMENT 'Durée en minutes',
  `affiche` varchar(500) DEFAULT NULL COMMENT 'URL ou chemin de l''affiche',
  `genre` varchar(100) DEFAULT NULL,
  `age_min` tinyint UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Âge minimum requis',
  `realisateur` varchar(150) DEFAULT NULL,
  `date_sortie` date DEFAULT NULL,
  `bande_annonce` varchar(500) DEFAULT NULL COMMENT 'URL de la bande-annonce',
  PRIMARY KEY (`id_film`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `id_reservation` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `nbre_places_senior` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `nbre_places_etudiant` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `nbre_places_adulte` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `etat` enum('en attente','confirmée','annulée','remboursée') NOT NULL DEFAULT 'en attente',
  `mode_paiement` enum('carte','espèces','en ligne','chèque') NOT NULL DEFAULT 'en ligne',
  `ref_utilisateur` int UNSIGNED NOT NULL,
  `ref_seance` int UNSIGNED NOT NULL,
  `ref_code_promo` int UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id_reservation`),
  KEY `fk_resa_code_promo` (`ref_code_promo`),
  KEY `idx_resa_utilisateur` (`ref_utilisateur`),
  KEY `idx_resa_seance` (`ref_seance`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

DROP TABLE IF EXISTS `salle`;
CREATE TABLE IF NOT EXISTS `salle` (
  `id_salle` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `capacite_max` smallint UNSIGNED NOT NULL,
  `code` varchar(20) NOT NULL,
  `etat` enum('disponible','maintenance','fermée') NOT NULL DEFAULT 'disponible',
  PRIMARY KEY (`id_salle`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `seance`
--

DROP TABLE IF EXISTS `seance`;
CREATE TABLE IF NOT EXISTS `seance` (
  `id_seance` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `etat` enum('programmée','en cours','terminée','annulée') NOT NULL DEFAULT 'programmée',
  `ref_salle` int UNSIGNED NOT NULL,
  `ref_film` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id_seance`),
  KEY `fk_seance_salle` (`ref_salle`),
  KEY `idx_seance_date` (`date`),
  KEY `idx_seance_film` (`ref_film`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_utilisateur` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `mdp` varchar(255) NOT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `statut` enum('actif','inactif','banni') NOT NULL DEFAULT 'actif',
  `gestion` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 = admin / gestionnaire',
  PRIMARY KEY (`id_utilisateur`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `fk_resa_code_promo` FOREIGN KEY (`ref_code_promo`) REFERENCES `code_promo` (`id_code_promo`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_resa_seance` FOREIGN KEY (`ref_seance`) REFERENCES `seance` (`id_seance`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_resa_utilisateur` FOREIGN KEY (`ref_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Contraintes pour la table `seance`
--
ALTER TABLE `seance`
  ADD CONSTRAINT `fk_seance_film` FOREIGN KEY (`ref_film`) REFERENCES `film` (`id_film`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_seance_salle` FOREIGN KEY (`ref_salle`) REFERENCES `salle` (`id_salle`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
