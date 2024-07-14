-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 20, 2023 at 05:23 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `conciergerie`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id_article` int(11) NOT NULL AUTO_INCREMENT,
  `nom_article` varchar(255) NOT NULL,
  `prix_commande` float NOT NULL,
  `prix_magasin` float NOT NULL,
  `prix_vip` float DEFAULT NULL,
  PRIMARY KEY (`id_article`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id_article`, `nom_article`, `prix_commande`, `prix_magasin`, `prix_vip`) VALUES
(1, 'Parfum beauté', 17, 20, 18),
(2, 'Parfum rose', 46, 59, 56),
(9, 'Chanel', 255, 200, 45);

-- --------------------------------------------------------

--
-- Table structure for table `article_commande`
--

DROP TABLE IF EXISTS `article_commande`;
CREATE TABLE IF NOT EXISTS `article_commande` (
  `id_article` int(11) NOT NULL,
  `id_commande` int(11) NOT NULL,
  `quantite_commande` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_article`,`id_commande`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `article_commande`
--

INSERT INTO `article_commande` (`id_article`, `id_commande`, `quantite_commande`) VALUES
(1, 1, 5),
(2, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `article_facture`
--

DROP TABLE IF EXISTS `article_facture`;
CREATE TABLE IF NOT EXISTS `article_facture` (
  `id_article` int(11) NOT NULL,
  `id_facture` int(11) NOT NULL,
  `Quantite` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_article`,`id_facture`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `avantage`
--

DROP TABLE IF EXISTS `avantage`;
CREATE TABLE IF NOT EXISTS `avantage` (
  `id_avantage` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`id_avantage`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `avantage_membership`
--

DROP TABLE IF EXISTS `avantage_membership`;
CREATE TABLE IF NOT EXISTS `avantage_membership` (
  `id_avantage` int(255) NOT NULL,
  `id_membership` int(255) NOT NULL,
  PRIMARY KEY (`id_avantage`,`id_membership`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id_client` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `id_membership` int(11) NOT NULL,
  PRIMARY KEY (`id_client`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id_client`, `nom`, `adresse`, `facebook`, `instagram`, `email`, `telephone`, `id_membership`) VALUES
(12, 'mimi', '7 rue bonheur', 'smthing', 'mondos', 'mondos@gmail.com', '01765952', 1),
(10, 'mindi', '7 rue bonheur', 'changement1', 'mondos', 'mondos@gmail.com', '01765952', 1);

-- --------------------------------------------------------

--
-- Table structure for table `client_solde`
--

DROP TABLE IF EXISTS `client_solde`;
CREATE TABLE IF NOT EXISTS `client_solde` (
  `id_client` int(11) NOT NULL,
  `id_solde` int(11) NOT NULL,
  PRIMARY KEY (`id_client`,`id_solde`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client_solde`
--

INSERT INTO `client_solde` (`id_client`, `id_solde`) VALUES
(10, 3),
(12, 10);

-- --------------------------------------------------------

--
-- Table structure for table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id_commande` int(11) NOT NULL AUTO_INCREMENT,
  `date_commande` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total` float NOT NULL,
  `date_livraison` timestamp NOT NULL,
  `frais_depot` float NOT NULL,
  `restant_a_payer` float NOT NULL,
  `frais_livraison` float NOT NULL,
  `statut` enum('Acheté','Fini','Livré','Arrivé','Expédié','Emballé','Déja acheté') NOT NULL,
  `date_expedition` timestamp NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `id_client` int(11) NOT NULL,
  PRIMARY KEY (`id_commande`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `commande`
--

INSERT INTO `commande` (`id_commande`, `date_commande`, `total`, `date_livraison`, `frais_depot`, `restant_a_payer`, `frais_livraison`, `statut`, `date_expedition`, `note`, `id_client`) VALUES
(1, '2023-01-15 21:01:04', 255, '2023-01-24 20:59:37', 200, 55, 17, 'Acheté', '2023-01-16 20:59:37', 'salut', 10),
(2, '2023-01-16 20:44:48', 567, '2023-02-08 20:43:30', 130, 567, 50, 'Acheté', '2023-02-01 20:43:30', 'Payé !', 10),
(3, '2023-01-09 23:00:00', 577, '2023-01-15 23:00:00', 67, 78, 17, 'Acheté', '2023-01-10 23:00:00', 'sdpkfjdkf', 12);

-- --------------------------------------------------------

--
-- Table structure for table `commande_expedition`
--

DROP TABLE IF EXISTS `commande_expedition`;
CREATE TABLE IF NOT EXISTS `commande_expedition` (
  `id_commande` int(11) NOT NULL,
  `id_expedition` int(11) NOT NULL,
  PRIMARY KEY (`id_commande`,`id_expedition`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `expedition`
--

DROP TABLE IF EXISTS `expedition`;
CREATE TABLE IF NOT EXISTS `expedition` (
  `id_expedition` int(11) NOT NULL AUTO_INCREMENT,
  `date_expedition` timestamp NOT NULL,
  `numero_parcelle` varchar(255) NOT NULL,
  PRIMARY KEY (`id_expedition`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `facture`
--

DROP TABLE IF EXISTS `facture`;
CREATE TABLE IF NOT EXISTS `facture` (
  `id_facture` int(255) NOT NULL AUTO_INCREMENT,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_mise_a_jour` timestamp NOT NULL,
  `montant` float NOT NULL,
  `id_commande` int(255) NOT NULL,
  PRIMARY KEY (`id_facture`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `historique`
--

DROP TABLE IF EXISTS `historique`;
CREATE TABLE IF NOT EXISTS `historique` (
  `id_historique` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) DEFAULT NULL,
  `date_echange` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_historique`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

DROP TABLE IF EXISTS `membership`;
CREATE TABLE IF NOT EXISTS `membership` (
  `id_membership` int(11) NOT NULL AUTO_INCREMENT,
  `nom_membership` varchar(255) NOT NULL,
  `solde_min` int(11) NOT NULL,
  `solde_max` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_membership`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `membership`
--

INSERT INTO `membership` (`id_membership`, `nom_membership`, `solde_min`, `solde_max`) VALUES
(1, 'Silver', 0, 300),
(2, 'Gold', 301, 700),
(3, 'Platinium', 701, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `paiement`
--

DROP TABLE IF EXISTS `paiement`;
CREATE TABLE IF NOT EXISTS `paiement` (
  `id_paiement` int(11) NOT NULL AUTO_INCREMENT,
  `montant` float NOT NULL,
  `date_paiement` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` enum('Carte Bancaire','Chèques','Espèces') NOT NULL,
  `id_commande` int(11) NOT NULL,
  PRIMARY KEY (`id_paiement`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `paiement_historique`
--

DROP TABLE IF EXISTS `paiement_historique`;
CREATE TABLE IF NOT EXISTS `paiement_historique` (
  `id_historique` int(11) NOT NULL,
  `id_paiement` int(11) NOT NULL,
  PRIMARY KEY (`id_historique`,`id_paiement`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `reduction`
--

DROP TABLE IF EXISTS `reduction`;
CREATE TABLE IF NOT EXISTS `reduction` (
  `id_reduction` int(11) NOT NULL AUTO_INCREMENT,
  `quantite_points` int(11) NOT NULL,
  `type_de_reduction` enum('Carte cadeau($)','Coupon(%)','Coupon($)','Cheques vacances') NOT NULL,
  `montant_de_reduction` float NOT NULL,
  `duree_de_validite` float NOT NULL,
  PRIMARY KEY (`id_reduction`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `reduction_historique`
--

DROP TABLE IF EXISTS `reduction_historique`;
CREATE TABLE IF NOT EXISTS `reduction_historique` (
  `id_historique` int(11) NOT NULL,
  `id_reduction` int(11) NOT NULL,
  PRIMARY KEY (`id_historique`,`id_reduction`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `solde_de_points`
--

DROP TABLE IF EXISTS `solde_de_points`;
CREATE TABLE IF NOT EXISTS `solde_de_points` (
  `id_solde` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_points` int(11) NOT NULL,
  `date_expiration` date DEFAULT NULL,
  PRIMARY KEY (`id_solde`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `solde_de_points`
--

INSERT INTO `solde_de_points` (`id_solde`, `nombre_points`, `date_expiration`) VALUES
(10, 5, NULL),
(3, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `id_stock` int(11) NOT NULL AUTO_INCREMENT,
  `statut_article` enum('En stock','Disponible','Indisponible','Hors stock','Cadeau gratuit','Emballé','Expédié','Arrivé','Livré','Autre') NOT NULL,
  `quantite_produit` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  PRIMARY KEY (`id_stock`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id_stock`, `statut_article`, `quantite_produit`, `id_article`) VALUES
(1, 'Expédié', 2, 1),
(2, 'En stock', 2, 2),
(6, 'Cadeau gratuit', 2, 9);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
