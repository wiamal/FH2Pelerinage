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
-- Structure de la table `statutinscriptionpelerinage`
--

CREATE TABLE `statutinscriptionpelerinage` (
  `IdStatutInscriptionPelerinage` int(20) UNSIGNED NOT NULL,
  `StatutInscriptionPelerinage` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `statutinscriptionpelerinage`
--

INSERT INTO `statutinscriptionpelerinage` (`IdStatutInscriptionPelerinage`, `StatutInscriptionPelerinage`) VALUES
(1, 'En cours'),
(2, 'Valide'),
(3, 'Rejeté'),
(4, 'LOCAL_ERROR'),
(5, 'EXTERNAL_ERROR');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `statutinscriptionpelerinage`
--
ALTER TABLE `statutinscriptionpelerinage`
  ADD PRIMARY KEY (`IdStatutInscriptionPelerinage`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
