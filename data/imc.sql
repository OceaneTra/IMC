-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 11 nov. 2024 à 22:05
-- Version du serveur :  5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `imc`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin_cm`
--

DROP TABLE IF EXISTS `admin_cm`;
CREATE TABLE IF NOT EXISTS `admin_cm` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `email_admin` varchar(100) NOT NULL,
  `password_admin` varchar(30) NOT NULL,
  `nom_admin` varchar(100) NOT NULL,
  `prenom_admin` varchar(100) NOT NULL,
  `tel_admin` varchar(15) NOT NULL,
  `photo` varchar(255) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `admin_imc`
--

DROP TABLE IF EXISTS `admin_imc`;
CREATE TABLE IF NOT EXISTS `admin_imc` (
  `id_imc` int(11) NOT NULL AUTO_INCREMENT,
  `nom_imc` varchar(20) NOT NULL,
  `email_imc` varchar(50) NOT NULL,
  `password_imc` varchar(30) NOT NULL,
  `photo` int(11) NOT NULL,
  PRIMARY KEY (`id_imc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `centre_medical`
--

DROP TABLE IF EXISTS `centre_medical`;
CREATE TABLE IF NOT EXISTS `centre_medical` (
  `id_centre_medical` int(11) NOT NULL AUTO_INCREMENT,
  `nom_cm` varchar(100) NOT NULL,
  `description_cm` varchar(255) NOT NULL,
  `localisation_cm` varchar(100) NOT NULL,
  `tel_cm` varchar(20) NOT NULL,
  `email_cm` varchar(100) NOT NULL,
  PRIMARY KEY (`id_centre_medical`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `consultation`
--

DROP TABLE IF EXISTS `consultation`;
CREATE TABLE IF NOT EXISTS `consultation` (
  `id_consultation` int(11) NOT NULL AUTO_INCREMENT,
  `date_consultation` date NOT NULL,
  `heure_consultation` time NOT NULL,
  `id_patient` int(11) NOT NULL,
  `nom_patient` varchar(20) NOT NULL,
  `prenom_patient` varchar(60) NOT NULL,
  PRIMARY KEY (`id_consultation`),
  UNIQUE KEY `id_patient` (`id_patient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `dm`
--

DROP TABLE IF EXISTS `dm`;
CREATE TABLE IF NOT EXISTS `dm` (
  `id_dm` int(11) NOT NULL AUTO_INCREMENT,
  `date_dm` date NOT NULL,
  `num_chambre` int(11) NOT NULL,
  `id_consultation` int(11) NOT NULL,
  `id_medecin` int(11) NOT NULL,
  `id_patient` int(11) NOT NULL,
  `type_analyse` varchar(30) NOT NULL,
  `type_chirurgie` varchar(30) NOT NULL,
  `num_sejour` int(11) NOT NULL,
  PRIMARY KEY (`id_dm`),
  UNIQUE KEY `id_consultation` (`id_consultation`,`id_medecin`,`id_patient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

DROP TABLE IF EXISTS `facture`;
CREATE TABLE IF NOT EXISTS `facture` (
  `id_facture` int(11) NOT NULL AUTO_INCREMENT,
  `nom_patient` varchar(20) NOT NULL,
  `prenom_patient` varchar(60) NOT NULL,
  `date_facture` date NOT NULL,
  `heure_facture` time NOT NULL,
  `prix_total` decimal(10,0) NOT NULL,
  `id_patient` int(11) NOT NULL,
  PRIMARY KEY (`id_facture`),
  UNIQUE KEY `id_patient` (`id_patient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `forfaits`
--

DROP TABLE IF EXISTS `forfaits`;
CREATE TABLE IF NOT EXISTS `forfaits` (
  `id_forfait` int(11) NOT NULL AUTO_INCREMENT,
  `description_forfait` varchar(255) NOT NULL,
  `prix_forfait` int(11) NOT NULL,
  `type_forfait` enum('plan basic','plan business','plan entreprise') NOT NULL,
  `statut_forfait` enum('actif','inactif') NOT NULL,
  `fonctionnalites` varchar(255) NOT NULL,
  PRIMARY KEY (`id_forfait`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `medecin`
--

DROP TABLE IF EXISTS `medecin`;
CREATE TABLE IF NOT EXISTS `medecin` (
  `id_medecin` int(11) NOT NULL AUTO_INCREMENT,
  `nom_medecin` varchar(20) NOT NULL,
  `adresse_medecin` varchar(100) NOT NULL,
  `prenom_medecin` varchar(30) NOT NULL,
  `specialite` varchar(50) NOT NULL,
  `tel_medecin` varchar(30) NOT NULL,
  `photo` varchar(255) NOT NULL,
  PRIMARY KEY (`id_medecin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `ordonnance`
--

DROP TABLE IF EXISTS `ordonnance`;
CREATE TABLE IF NOT EXISTS `ordonnance` (
  `id_ordonnance` int(11) NOT NULL AUTO_INCREMENT,
  `date_ordonnance` date NOT NULL,
  `heure_ordonnance` time NOT NULL,
  `nom_patient` varchar(20) NOT NULL,
  `prenom_patient` varchar(60) NOT NULL,
  `id_patient` int(11) NOT NULL,
  `dosage` varchar(100) NOT NULL,
  PRIMARY KEY (`id_ordonnance`),
  UNIQUE KEY `id_patient` (`id_patient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `patient`
--

DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient` (
  `id_patient` int(11) NOT NULL AUTO_INCREMENT,
  `nom_patient` varchar(20) NOT NULL,
  `prenom_patient` varchar(60) NOT NULL,
  `sexe_patient` enum('Homme','Femme') NOT NULL,
  `adresse_mail_patient` varchar(100) NOT NULL,
  `tel_patient` varchar(50) NOT NULL,
  `id_dm` int(11) NOT NULL,
  PRIMARY KEY (`id_patient`),
  UNIQUE KEY `id_dm` (`id_dm`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `personnels`
--

DROP TABLE IF EXISTS `personnels`;
CREATE TABLE IF NOT EXISTS `personnels` (
  `id_personnel` int(11) NOT NULL AUTO_INCREMENT,
  `type_personnel` varchar(20) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id_personnel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `rdv`
--

DROP TABLE IF EXISTS `rdv`;
CREATE TABLE IF NOT EXISTS `rdv` (
  `id_rdv` int(11) NOT NULL AUTO_INCREMENT,
  `date_rdv` date NOT NULL,
  `heure_rdv` time NOT NULL,
  `id_patient` int(11) NOT NULL,
  PRIMARY KEY (`id_rdv`),
  UNIQUE KEY `id_patient` (`id_patient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
