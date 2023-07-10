-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 10 juil. 2023 à 12:46
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
-- Structure de la table `TypeDocumentPelerinage`
--

CREATE TABLE `TypeDocumentPelerinage` (
  `IdTypeDocument` int(11) NOT NULL,
  `Titre` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `TypeDocumentPelerinage`
--

INSERT INTO `TypeDocumentPelerinage` (`IdTypeDocument`, `Titre`) VALUES
(1, 'Demande adressée au président de la Fondation dument rempli'),
(2, 'Copie de la facture ou de la quittance de paiement des dépenses'),
(3, 'Certificat des services du ministère de la Santé et de la Protection Sociale ou des institutions publiques relevant de sa compétence, attestant que le demandeur, en tant qu\'exerçant ou retraité, n\'a pas bénéficié précédemment du pèlerinage'),
(4, 'Déclaration sur l\'honneur dans laquelle le demandeur atteste de l\'authenticité de tous les documents fournis conformément aux conditions requises dans cette annonce'),
(5, 'Copie du visa pour effectuer les rites du Hajj, ainsi que de la première page du passeport et du cachet d\'entrée et de sortie du Royaume d\'Arabie saoudite'),
(6, 'Attestation de Relevé d\'Identité Bancaire (RIB) originale');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `TypeDocumentPelerinage`
--
ALTER TABLE `TypeDocumentPelerinage`
  ADD PRIMARY KEY (`IdTypeDocument`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `TypeDocumentPelerinage`
--
ALTER TABLE `TypeDocumentPelerinage`
  MODIFY `IdTypeDocument` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
