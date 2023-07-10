-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 10 juil. 2023 à 12:47
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
-- Structure de la table `pelerinage-files`
--

CREATE TABLE `pelerinage-files` (
  `IdFile` int(11) NOT NULL,
  `IdInscription` int(20) UNSIGNED NOT NULL,
  `IdTypeDocument` int(2) NOT NULL,
  `URL` varchar(500) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `pelerinage-files`
--
ALTER TABLE `pelerinage-files`
  ADD PRIMARY KEY (`IdFile`),
  ADD KEY `IdInscription` (`IdInscription`),
  ADD KEY `IdTypeDocument` (`IdTypeDocument`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `pelerinage-files`
--
ALTER TABLE `pelerinage-files`
  MODIFY `IdFile` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `pelerinage-files`
--
ALTER TABLE `pelerinage-files`
  ADD CONSTRAINT `pelerinage-files_ibfk_1` FOREIGN KEY (`IdInscription`) REFERENCES `inscriptionpelerinage` (`IdInscription`),
  ADD CONSTRAINT `pelerinage-files_ibfk_2` FOREIGN KEY (`IdTypeDocument`) REFERENCES `TypeDocumentPelerinage` (`IdTypeDocument`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
