-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 10 juil. 2023 à 12:48
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `drupal`
--

-- --------------------------------------------------------

--
-- Structure de la table `inscriptionpelerinage`
--

CREATE TABLE `inscriptionpelerinage` (
  `IdInscription` int(20) UNSIGNED NOT NULL,
  `IdAdherent` bigint(20) UNSIGNED NOT NULL,
  `IdPelerinage` int(20) UNSIGNED DEFAULT NULL,
  `DateNaissance` date DEFAULT NULL,
  `DateRecrutement` date DEFAULT NULL,
  `DateRetraite` date DEFAULT NULL,
  `Retraite` tinyint(1) DEFAULT NULL,
  `IdStatutInscriptionPelerinage` int(20) UNSIGNED DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `inscriptionpelerinage`
--
ALTER TABLE `inscriptionpelerinage`
  ADD PRIMARY KEY (`IdInscription`),
  ADD UNIQUE KEY `IdAdherent` (`IdAdherent`),
  ADD UNIQUE KEY `UK_Adherent_Pelerinage` (`IdAdherent`,`IdPelerinage`),
  ADD KEY `IdStatutInscriptionPelerinage` (`IdStatutInscriptionPelerinage`),
  ADD KEY `IdPelerinage` (`IdPelerinage`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `inscriptionpelerinage`
--
ALTER TABLE `inscriptionpelerinage`
  MODIFY `IdInscription` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `inscriptionpelerinage`
--
ALTER TABLE `inscriptionpelerinage`
  ADD CONSTRAINT `inscriptionpelerinage_ibfk_1` FOREIGN KEY (`IdAdherent`) REFERENCES `ab6` (`id_adh`),
  ADD CONSTRAINT `inscriptionpelerinage_ibfk_3` FOREIGN KEY (`IdStatutInscriptionPelerinage`) REFERENCES `statutinscriptionpelerinage` (`IdStatutInscriptionPelerinage`),
  ADD CONSTRAINT `inscriptionpelerinage_ibfk_4` FOREIGN KEY (`IdPelerinage`) REFERENCES `pelerinage23` (`IdPelerinage`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
