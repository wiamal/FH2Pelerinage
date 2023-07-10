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
-- Structure de la table `pelerinage23`
--

CREATE TABLE `pelerinage23` (
  `IdPelerinage` int(20) UNSIGNED NOT NULL,
  `DateDebut` date DEFAULT NULL,
  `Datefin` date DEFAULT NULL,
  `DhuAlHijjah` date DEFAULT NULL,
  `Annee` int(11) DEFAULT year(curdate()),
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `pelerinage23`
--

INSERT INTO `pelerinage23` (`IdPelerinage`, `DateDebut`, `Datefin`, `DhuAlHijjah`, `Annee`, `created_at`, `updated_at`) VALUES
(1, '2023-07-10', '2023-08-20', '2023-06-27', 2023, '2023-07-07 12:49:20', '2023-07-07 12:49:20');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `pelerinage23`
--
ALTER TABLE `pelerinage23`
  ADD PRIMARY KEY (`IdPelerinage`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `pelerinage23`
--
ALTER TABLE `pelerinage23`
  MODIFY `IdPelerinage` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
