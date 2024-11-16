-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 16 nov. 2024 à 01:01
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
  `nom_admin` varchar(50) NOT NULL,
  `prenom_admin` varchar(50) NOT NULL,
  `tel_admin` varchar(25) NOT NULL,
  `photo_profil` varchar(255) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `admin_imc`
--

DROP TABLE IF EXISTS `admin_imc`;
CREATE TABLE IF NOT EXISTS `admin_imc` (
  `id_imc` int(11) NOT NULL AUTO_INCREMENT,
  `nom_imc` varchar(50) NOT NULL,
  `email_imc` varchar(50) NOT NULL,
  `password_imc` varchar(30) NOT NULL,
  `photo_profil` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_imc`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `admin_imc`
--

INSERT INTO `admin_imc` (`id_imc`, `nom_imc`, `email_imc`, `password_imc`, `photo_profil`) VALUES
(1, 'Jean Dupont', 'jean.dupont@example.com', 'password123', '/Ivoire_Medical_Center/IMC/admin_imc/assets/images/img_profil1.png'),
(2, 'Marie Curie', 'marie.curie@example.com', 'securepass456', '/Ivoire_Medical_Center/IMC/admin_imc/assets/images/photo2.webp'),
(3, 'Albert Einstein', 'albert.einstein@yahoo.com', 'e=mc3', 'albert.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `centre_medical`
--

DROP TABLE IF EXISTS `centre_medical`;
CREATE TABLE IF NOT EXISTS `centre_medical` (
  `id_centre_medical` int(11) NOT NULL AUTO_INCREMENT,
  `nom_cm` int(11) NOT NULL,
  `description_cm` int(11) NOT NULL,
  `localisation_cm` int(11) NOT NULL,
  `tel_cm` int(11) NOT NULL,
  `email_cm` int(11) NOT NULL,
  PRIMARY KEY (`id_centre_medical`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `consultation`
--

DROP TABLE IF EXISTS `consultation`;
CREATE TABLE IF NOT EXISTS `consultation` (
  `id_consutation` int(11) NOT NULL AUTO_INCREMENT,
  `date_consultation` date NOT NULL,
  `heure_consultation` time NOT NULL,
  `id_patient` int(11) NOT NULL,
  `nom_patient` varchar(20) NOT NULL,
  `prenom_patient` varchar(60) NOT NULL,
  PRIMARY KEY (`id_consutation`),
  UNIQUE KEY `id_patient` (`id_patient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `dm`
--

DROP TABLE IF EXISTS `dm`;
CREATE TABLE IF NOT EXISTS `dm` (
  `id_dm` int(11) NOT NULL AUTO_INCREMENT,
  `date_creation_dm` timestamp NOT NULL,
  `antecedents` varchar(255) NOT NULL,
  `id_medecin` int(11) NOT NULL,
  `id_patient` int(11) NOT NULL,
  `note_medecin` varchar(255) NOT NULL,
  `traitements` varchar(255) NOT NULL,
  PRIMARY KEY (`id_dm`),
  UNIQUE KEY `id_consultation` (`id_medecin`,`id_patient`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `dm`
--

INSERT INTO `dm` (`id_dm`, `date_creation_dm`, `antecedents`, `id_medecin`, `id_patient`, `note_medecin`, `traitements`) VALUES
(1, '2024-11-19 22:02:02', 'asthme', 2, 2, 'Repos de deux jours', 'ballon');

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `forfaits`
--

INSERT INTO `forfaits` (`id_forfait`, `description_forfait`, `prix_forfait`, `type_forfait`, `statut_forfait`, `fonctionnalites`) VALUES
(1, 'fonctionnalitÃ©s de base pour jusqu\'Ã  10 utilisateurs', 6500, 'plan basic', 'actif', 'AccÃ¨s aux fonctionnalitÃ©s de base\r\nRapports et analyses de base\r\nJusqu\'Ã  10 utilisateurs individuels\r\n20 Go de donnÃ©es individuelles par utilisateur\r\nAssistance par chat et par e-mail de base'),
(2, 'Equipe en croissance allant jusqu\'Ã  20 utilisateurs', 12500, 'plan business', 'actif', 'AccÃ¨s aux fonctionnalitÃ©s de base\r\nRapports et analyses de base\r\nJusqu\'Ã  10 utilisateurs individuels\r\n20 Go de donnÃ©es individuelles par utilisateur\r\nAssistance par chat et par e-mail de base'),
(3, 'FonctionnalitÃ©s avancÃ©es + nombre d\'utilisateurs illimitÃ©s', 25000, 'plan entreprise', 'actif', 'AccÃ¨s aux fonctionnalitÃ©s de base\r\nRapports et analyses de base\r\nJusqu\'Ã  10 utilisateurs individuels\r\n20 Go de donnÃ©es individuelles par utilisateur\r\nAssistance par chat et par e-mail de base');

-- --------------------------------------------------------

--
-- Structure de la table `infirmier`
--

DROP TABLE IF EXISTS `infirmier`;
CREATE TABLE IF NOT EXISTS `infirmier` (
  `id_infirmier` int(11) NOT NULL AUTO_INCREMENT,
  `nom_infirmier` varchar(100) NOT NULL,
  `prenom_infirmier` varchar(100) NOT NULL,
  `tel_infirmier` varchar(20) NOT NULL,
  `email_infirmier` varchar(100) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `photo_profil` varchar(255) NOT NULL,
  PRIMARY KEY (`id_infirmier`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `infirmier`
--

INSERT INTO `infirmier` (`id_infirmier`, `nom_infirmier`, `prenom_infirmier`, `tel_infirmier`, `email_infirmier`, `mot_de_passe`, `photo_profil`) VALUES
(2, 'Gomez', 'Ange Axel', '01724357689', 'gomez@gmail.com', '$2y$10$jjqxl.jVxzh6FqtXyJKobuKEHYyBFcsC4IGNi/HXm8.b/EXZB6r/G', ''),
(4, 'Sokoty', 'Othniel', '0798453214', 'sokoty@gmail.com', '$2y$10$bASX8YLD4evDX.0OXaCRguHK6t86pfLqzaDGmYsH.GFNcLK.dZNei', '');

-- --------------------------------------------------------

--
-- Structure de la table `medecin`
--

DROP TABLE IF EXISTS `medecin`;
CREATE TABLE IF NOT EXISTS `medecin` (
  `id_medecin` int(11) NOT NULL AUTO_INCREMENT,
  `nom_medecin` varchar(20) NOT NULL,
  `prenom_medecin` varchar(30) NOT NULL,
  `email_medecin` varchar(100) NOT NULL,
  `specialite` varchar(50) NOT NULL,
  `tel_medecin` varchar(30) NOT NULL,
  `mot_de_passe` varchar(200) NOT NULL,
  `photo_profil` varchar(255) NOT NULL,
  PRIMARY KEY (`id_medecin`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `medecin`
--

INSERT INTO `medecin` (`id_medecin`, `nom_medecin`, `prenom_medecin`, `email_medecin`, `specialite`, `tel_medecin`, `mot_de_passe`, `photo_profil`) VALUES
(1, 'krouma', 'franck adams', 'franckrouma2@gmail.com', '', '0142493820', '$2y$10$tBa6hKQdVY8gOj4RrlkEYebYaQjq4skKLxDR1cjXqa2NP47JohtuK', ''),
(2, 'Kassy', 'Yannis', 'kassy@gmail.com', '', '0505647892', '$2y$10$jKIuhXJQqtrBIvw0Jvg5u.bPNRPSs7zcPxk3hONvLLi/S.NwUhAoe', ''),
(3, 'Yoro', 'Moussa', 'moussa@gmail.com', '', '0123576930', '$2y$10$mDg6XRmFN.9ohMcT923kwuCir2YUrGcHdfDHhIF.2282yO7wl7Ui2', '');

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
  `dosage` int(11) NOT NULL,
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
  `date_de_naissance` date DEFAULT NULL,
  `age_patient` int(11) NOT NULL,
  `sexe_patient` enum('Masculin','Feminin') NOT NULL,
  `groupe_sanguin` enum('A+','A-','B+','B-','O+','O-','AB+','AB-') NOT NULL,
  `adresse_patient` varchar(100) NOT NULL,
  `tel_patient` varchar(50) NOT NULL,
  `id_dm` int(11) NOT NULL,
  PRIMARY KEY (`id_patient`),
  UNIQUE KEY `id_dm` (`id_dm`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `patient`
--

INSERT INTO `patient` (`id_patient`, `nom_patient`, `prenom_patient`, `date_de_naissance`, `age_patient`, `sexe_patient`, `groupe_sanguin`, `adresse_patient`, `tel_patient`, `id_dm`) VALUES
(2, 'GOMEZ', 'Ange Axel', '2023-01-11', 21, 'Masculin', 'O+', 'axelangegomez@gmail.com', '0707019478', 1);

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
  `type_consultation` varchar(255) NOT NULL,
  `statut` enum('en attente','accepté','refusé') NOT NULL,
  PRIMARY KEY (`id_rdv`),
  UNIQUE KEY `id_patient` (`id_patient`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `rdv`
--

INSERT INTO `rdv` (`id_rdv`, `date_rdv`, `heure_rdv`, `id_patient`, `type_consultation`, `statut`) VALUES
(1, '2024-11-13', '12:15:23', 2, 'examen general', 'en attente');

-- --------------------------------------------------------

--
-- Structure de la table `secretaire`
--

DROP TABLE IF EXISTS `secretaire`;
CREATE TABLE IF NOT EXISTS `secretaire` (
  `id_secretaire` int(11) NOT NULL AUTO_INCREMENT,
  `nom_secretaire` varchar(100) NOT NULL,
  `prenom_secretaire` varchar(100) NOT NULL,
  `tel_secretaire` varchar(20) NOT NULL,
  `email_secretaire` varchar(100) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `photo_profil` varchar(255) NOT NULL,
  PRIMARY KEY (`id_secretaire`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `secretaire`
--

INSERT INTO `secretaire` (`id_secretaire`, `nom_secretaire`, `prenom_secretaire`, `tel_secretaire`, `email_secretaire`, `mot_de_passe`, `photo_profil`) VALUES
(1, 'Kassy', 'Yannis', '0505647892', 'kassy@gmail.com', '$2y$10$hgWd4wppl5xbClhhzd6YnestpjGDlx.xZ0YbaKj8IpHGSpHlZVgqS', '');

-- --------------------------------------------------------

--
-- Structure de la table `specialites`
--

DROP TABLE IF EXISTS `specialites`;
CREATE TABLE IF NOT EXISTS `specialites` (
  `id_specialite` int(11) NOT NULL AUTO_INCREMENT,
  `nom_specialite` int(11) NOT NULL,
  PRIMARY KEY (`id_specialite`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
