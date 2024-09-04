-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 04 sep. 2024 à 09:52
-- Version du serveur : 8.2.0
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `perfume-shop`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom_article` varchar(255) NOT NULL,
  `prix_commande` float NOT NULL,
  `prix_magasin` float NOT NULL,
  `prix_vip` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `nom_article`, `prix_commande`, `prix_magasin`, `prix_vip`) VALUES
(1, 'Parfum beauté', 17, 20, 18),
(2, 'Parfum rose', 46, 59, 56),
(9, 'Chanel', 255, 200, 45);

-- --------------------------------------------------------

--
-- Structure de la table `article_commande`
--

DROP TABLE IF EXISTS `article_commande`;
CREATE TABLE IF NOT EXISTS `article_commande` (
  `id_article` int NOT NULL,
  `id_commande` int NOT NULL,
  `quantite_commande` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_article`,`id_commande`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `article_commande`
--

INSERT INTO `article_commande` (`id_article`, `id_commande`, `quantite_commande`) VALUES
(2, 9, 1),
(1, 9, 7),
(1, 8, 19),
(2, 8, 7),
(9, 8, 1);

-- --------------------------------------------------------

--
-- Structure de la table `article_facture`
--

DROP TABLE IF EXISTS `article_facture`;
CREATE TABLE IF NOT EXISTS `article_facture` (
  `id_article` int NOT NULL,
  `id_facture` int NOT NULL,
  `Quantite` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_article`,`id_facture`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `article_facture`
--

INSERT INTO `article_facture` (`id_article`, `id_facture`, `Quantite`) VALUES
(2, 32, 1),
(1, 32, 7),
(2, 33, 1),
(1, 33, 4),
(1, 34, 19),
(2, 34, 7),
(9, 34, 1);

-- --------------------------------------------------------

--
-- Structure de la table `avantage`
--

DROP TABLE IF EXISTS `avantage`;
CREATE TABLE IF NOT EXISTS `avantage` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `avantage_membership`
--

DROP TABLE IF EXISTS `avantage_membership`;
CREATE TABLE IF NOT EXISTS `avantage_membership` (
  `id_avantage` int NOT NULL,
  `id_membership` int NOT NULL,
  PRIMARY KEY (`id_avantage`,`id_membership`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `id_membership` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `nom`, `adresse`, `facebook`, `instagram`, `email`, `telephone`, `id_membership`) VALUES
(16, 'mimi', '7 rue bonheur', 'smooooooooooooooooothing', 'mondos', 'mondos@gmail.com', '01765952', 1),
(13, 'mimi', '7 rue bonheur', 'smthing', 'mondos', 'mondos@gmail.com', '01765952', 1),
(14, 'mimi', '7 rue bonheur', 'test', 'mondos', 'mondos@gmail.com', '01765952', 1),
(17, 'mimi', '2', 'smooooooooooooooooothing', 'mondos', 'mondos@gmail.com', '01765952', 1),
(36, 'mimiiiiiiiiiiiiiiiiiiiii', '7 rue bonheur', 'smooooooooooooooooothing', 'mondos', 'mondos@gmail.com', '01765952', 1),
(20, 'mimi', '7 rue bonheur', 'smooooooooooooooooothing', 'mondos', 'mondos@gmail.com', '01765952', 1),
(21, 'mimi', '7 rue bonheur', 'smooooooooooooooooothing', NULL, 'mondos@gmail.com', '01765952', 1),
(22, 'mimi', '7 rue bonheur', 'smooooooooooooooooothing', NULL, 'mondos@gmail.com', '01765952', 1),
(23, 'mimi', '7 rue bonheur', 'smooooooooooooooooothing', 'mondos', 'mondos@gmail.com', '01765952', 1),
(24, 'mimi', '7 rue bonheur', 'smooooooooooooooooothing', 'mondos', 'mondos@gmail.com', '01765952', 1),
(25, 'mimi', '7 rue bonheur', 'smooooooooooooooooothing', 'mondos', 'mondos@gmail.com', '01765952', 1),
(26, 'mimi', '7 rue bonheur', 'smooooooooooooooooothing', NULL, 'mondos@gmail.com', '01765952', 1),
(27, 'mimi', '7 rue bonheur', 'smooooooooooooooooothing', NULL, 'mondos@gmail.com', '01765952', 1),
(28, 'mimi', '7 rue bonheur', 'smooooooooooooooooothing', 'mondos', 'mondos@gmail.com', '01765952', 1),
(29, 'mimi', '7 rue bonheur', 'smooooooooooooooooothing', NULL, 'mondos@gmail.com', '01765952', 1),
(30, 'mimi', '7 rue bonheur', 'smooooooooooooooooothing', 'mondos', 'mondos@gmail.com', '01765952', 1),
(31, 'mimi', '7 rue bonheur', 'smooooooooooooooooothing', 'mondos', 'mondos@gmail.com', '01765952', 1),
(32, 'mimi', '7 rue bonheur', 'smooooooooooooooooothing', 'mondos', 'mondos@gmail.com', '01765952', 1),
(33, 'mimi', '7 rue bonheur', 'smooooooooooooooooothing', 'mondos', 'mondos@gmail.com', '01765952', 1),
(34, 'mimi', '7 rue bonheur', 'smooooooooooooooooothing', 'mondos', 'mondos@gmail.com', '01765952', 1),
(37, 'mimiiiiiiiiiiiiiiiiiiiii', '7 rue bonheur', 'smooooooooooooooooothing', 'mondosss', 'mondos@gmail.com', '01765952', 1),
(38, 'mimiiiiiiiiiiiiiiiiiiiii', '7 rue bonheur', 'smooooooooooooooooothing', 'mondosss', 'mondos@gmail.com', '01765952', 1),
(39, 'mimiiiiiiiiiiiiiiiiiiiii', '7 rue bonheur', 'smooooooooooooooooothing', 'mondosss', 'mondos@gmail.com', '01765952', 1),
(40, 'mimiiiiiiiiiiiiiiiiiiiii', '7 rue bonheur', 'smooooooooooooooooothing', 'mondosss', 'mondos@gmail.com', '01765952', 1);

-- --------------------------------------------------------

--
-- Structure de la table `client_solde`
--

DROP TABLE IF EXISTS `client_solde`;
CREATE TABLE IF NOT EXISTS `client_solde` (
  `id_client` int NOT NULL,
  `id_solde` int NOT NULL,
  PRIMARY KEY (`id_client`,`id_solde`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `client_solde`
--

INSERT INTO `client_solde` (`id_client`, `id_solde`) VALUES
(12, 10);

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_commande` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total` float NOT NULL,
  `date_livraison` timestamp NOT NULL,
  `frais_depot` float NOT NULL,
  `restant_a_payer` float NOT NULL,
  `frais_livraison` float NOT NULL,
  `statut` enum('Acheté','Fini','Livré','Arrivé','Expédié','Emballé','Déja acheté') NOT NULL,
  `date_expedition` timestamp NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `id_client` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `date_commande`, `total`, `date_livraison`, `frais_depot`, `restant_a_payer`, `frais_livraison`, `statut`, `date_expedition`, `note`, `id_client`) VALUES
(9, '2024-04-26 22:00:00', 56, '2024-04-25 22:00:00', 67, 78, 78, 'Fini', '2024-04-22 22:00:00', 'sdpkfjdkf', 3),
(2, '2023-01-16 20:44:48', 567, '2023-02-08 20:43:30', 130, 567, 50, 'Acheté', '2023-02-01 20:43:30', 'Payé !', 10),
(3, '2023-01-09 23:00:00', 577, '2023-01-15 23:00:00', 67, 78, 17, 'Acheté', '2023-01-10 23:00:00', 'sdpkfjdkf', 12),
(8, '2024-04-18 22:00:00', 56, '2024-04-17 22:00:00', 67, 78, 78, 'Acheté', '2024-04-24 22:00:00', 'sdpkfjdkf', 3);

-- --------------------------------------------------------

--
-- Structure de la table `commande_expedition`
--

DROP TABLE IF EXISTS `commande_expedition`;
CREATE TABLE IF NOT EXISTS `commande_expedition` (
  `id_commande` int NOT NULL,
  `id_expedition` int NOT NULL,
  PRIMARY KEY (`id_commande`,`id_expedition`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `expedition`
--

DROP TABLE IF EXISTS `expedition`;
CREATE TABLE IF NOT EXISTS `expedition` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_expedition` timestamp NOT NULL,
  `numero_parcelle` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

DROP TABLE IF EXISTS `facture`;
CREATE TABLE IF NOT EXISTS `facture` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_mise_a_jour` timestamp NOT NULL,
  `montant` float NOT NULL,
  `id_commande` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `facture`
--

INSERT INTO `facture` (`id`, `date_creation`, `date_mise_a_jour`, `montant`, `id_commande`) VALUES
(32, '2024-04-10 18:24:04', '2024-04-10 18:24:04', 199, 9),
(33, '2024-04-10 18:24:44', '2024-04-10 18:24:44', 139, 9),
(34, '2024-04-10 18:29:14', '2024-04-10 18:29:14', 993, 8);

-- --------------------------------------------------------

--
-- Structure de la table `historique`
--

DROP TABLE IF EXISTS `historique`;
CREATE TABLE IF NOT EXISTS `historique` (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` varchar(255) DEFAULT NULL,
  `date_echange` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `membership`
--

DROP TABLE IF EXISTS `membership`;
CREATE TABLE IF NOT EXISTS `membership` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom_membership` varchar(255) NOT NULL,
  `solde_min` int NOT NULL,
  `solde_max` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `membership`
--

INSERT INTO `membership` (`id`, `nom_membership`, `solde_min`, `solde_max`) VALUES
(1, 'Silver', 0, 300),
(2, 'Gold', 301, 700),
(3, 'Platinium', 701, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

DROP TABLE IF EXISTS `paiement`;
CREATE TABLE IF NOT EXISTS `paiement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `montant` float NOT NULL,
  `date_paiement` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` enum('Carte Bancaire','Chèques','Espèces') NOT NULL,
  `id_commande` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `paiement_historique`
--

DROP TABLE IF EXISTS `paiement_historique`;
CREATE TABLE IF NOT EXISTS `paiement_historique` (
  `id_historique` int NOT NULL,
  `id_paiement` int NOT NULL,
  PRIMARY KEY (`id_historique`,`id_paiement`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `reduction`
--

DROP TABLE IF EXISTS `reduction`;
CREATE TABLE IF NOT EXISTS `reduction` (
  `id` int NOT NULL AUTO_INCREMENT,
  `quantite_points` int NOT NULL,
  `type_de_reduction` enum('Carte cadeau($)','Coupon(%)','Coupon($)','Cheques vacances') NOT NULL,
  `montant_de_reduction` float NOT NULL,
  `duree_de_validite` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `reduction_historique`
--

DROP TABLE IF EXISTS `reduction_historique`;
CREATE TABLE IF NOT EXISTS `reduction_historique` (
  `id_historique` int NOT NULL,
  `id_reduction` int NOT NULL,
  PRIMARY KEY (`id_historique`,`id_reduction`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `solde_de_points`
--

DROP TABLE IF EXISTS `solde_de_points`;
CREATE TABLE IF NOT EXISTS `solde_de_points` (
  `id_solde` int NOT NULL AUTO_INCREMENT,
  `nombre_points` int NOT NULL,
  `date_expiration` date DEFAULT NULL,
  PRIMARY KEY (`id_solde`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `solde_de_points`
--

INSERT INTO `solde_de_points` (`id_solde`, `nombre_points`, `date_expiration`) VALUES
(10, 5, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `id` int NOT NULL AUTO_INCREMENT,
  `statut_article` enum('En stock','Disponible','Indisponible','Hors stock','Cadeau gratuit','Emballé','Expédié','Arrivé','Livré','Autre') NOT NULL,
  `quantite_produit` int NOT NULL,
  `id_article` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `stock`
--

INSERT INTO `stock` (`id`, `statut_article`, `quantite_produit`, `id_article`) VALUES
(1, 'En stock', 200, 1),
(2, 'En stock', 2, 2),
(6, 'En stock', 200, 9);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
