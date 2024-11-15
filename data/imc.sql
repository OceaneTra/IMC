-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 15 nov. 2024 à 04:15
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `id_admin` int NOT NULL AUTO_INCREMENT,
  `email_admin` varchar(100) NOT NULL,
  `password_admin` varchar(30) NOT NULL,
  `nom_admin` int NOT NULL,
  `prenom_admin` int NOT NULL,
  `tel_admin` int NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `admin_imc`
--

DROP TABLE IF EXISTS `admin_imc`;
CREATE TABLE IF NOT EXISTS `admin_imc` (
  `id_imc` int NOT NULL AUTO_INCREMENT,
  `nom_imc` varchar(20) NOT NULL,
  `email_imc` varchar(50) NOT NULL,
  `password_imc` varchar(30) NOT NULL,
  PRIMARY KEY (`id_imc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `centre_medical`
--

DROP TABLE IF EXISTS `centre_medical`;
CREATE TABLE IF NOT EXISTS `centre_medical` (
  `id_centre_medical` int NOT NULL AUTO_INCREMENT,
  `nom_cm` int NOT NULL,
  `description_cm` int NOT NULL,
  `localisation_cm` int NOT NULL,
  `tel_cm` int NOT NULL,
  `email_cm` int NOT NULL,
  PRIMARY KEY (`id_centre_medical`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `consultation`
--

DROP TABLE IF EXISTS `consultation`;
CREATE TABLE IF NOT EXISTS `consultation` (
  `id_consutation` int NOT NULL AUTO_INCREMENT,
  `date_consultation` date NOT NULL,
  `heure_consultation` time NOT NULL,
  `id_patient` int NOT NULL,
  `nom_patient` varchar(20) NOT NULL,
  `prenom_patient` varchar(60) NOT NULL,
  PRIMARY KEY (`id_consutation`),
  UNIQUE KEY `id_patient` (`id_patient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `dm`
--

DROP TABLE IF EXISTS `dm`;
CREATE TABLE IF NOT EXISTS `dm` (
  `id_dm` int NOT NULL AUTO_INCREMENT,
  `date_dm` date NOT NULL,
  `num_chambre` int NOT NULL,
  `id_consultation` int NOT NULL,
  `id_medecin` int NOT NULL,
  `id_patient` int NOT NULL,
  `type_analyse` varchar(30) NOT NULL,
  `type_chirurgie` varchar(30) NOT NULL,
  `num_sejour` int NOT NULL,
  PRIMARY KEY (`id_dm`),
  UNIQUE KEY `id_consultation` (`id_consultation`,`id_medecin`,`id_patient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

DROP TABLE IF EXISTS `facture`;
CREATE TABLE IF NOT EXISTS `facture` (
  `id_facture` int NOT NULL AUTO_INCREMENT,
  `nom_patient` varchar(20) NOT NULL,
  `prenom_patient` varchar(60) NOT NULL,
  `date_facture` date NOT NULL,
  `heure_facture` time NOT NULL,
  `prix_total` decimal(10,0) NOT NULL,
  `id_patient` int NOT NULL,
  PRIMARY KEY (`id_facture`),
  UNIQUE KEY `id_patient` (`id_patient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `infirmier`
--

DROP TABLE IF EXISTS `infirmier`;
CREATE TABLE IF NOT EXISTS `infirmier` (
  `id_infirmier` int NOT NULL AUTO_INCREMENT,
  `nom_infirmier` varchar(100) NOT NULL,
  `prenom_infirmier` varchar(100) NOT NULL,
  `tel_infirmier` varchar(20) NOT NULL,
  `email_infirmier` varchar(100) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `photo` varchar(150) NOT NULL,
  PRIMARY KEY (`id_infirmier`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `infirmier`
--

INSERT INTO `infirmier` (`id_infirmier`, `nom_infirmier`, `prenom_infirmier`, `tel_infirmier`, `email_infirmier`, `mot_de_passe`, `photo`) VALUES
(6, 'krouma', 'franck', '0142493820', 'franckrouma2@gmail.com', '$2y$10$ODikzWXy4zo.yTYKs8TUyOI1pTDBSp6S1fdpctG8EGEixT.87Xybi', 'img/Photo identité.jpg'),
(7, 'Gomez', 'ange', '0129384756', 'ange@gmail.com', '$2y$10$Tn1QyI/HXO5A1mJfrVwaDOjs4TfpKPumaVh85viPa64WuRfI7o7..', 'img/Drogba.jpeg'),
(8, 'Assoumou', 'esther', '0102034523', 'assoumou@gmail.com', '$2y$10$DMU7T7qGjBjGub2RqRffMe8LGwGTkJ5e2Y1GK1yj91HXefinXwk2m', 'img/sokoty.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `medecin`
--

DROP TABLE IF EXISTS `medecin`;
CREATE TABLE IF NOT EXISTS `medecin` (
  `id_medecin` int NOT NULL AUTO_INCREMENT,
  `nom_medecin` varchar(20) NOT NULL,
  `email_medecin` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `prenom_medecin` varchar(30) NOT NULL,
  `specialite` varchar(50) NOT NULL,
  `tel_medecin` varchar(30) NOT NULL,
  `mot_de_passe` varchar(200) NOT NULL,
  `photo` varchar(150) NOT NULL,
  PRIMARY KEY (`id_medecin`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ordonnance`
--

DROP TABLE IF EXISTS `ordonnance`;
CREATE TABLE IF NOT EXISTS `ordonnance` (
  `id_ordonnance` int NOT NULL AUTO_INCREMENT,
  `date_ordonnance` date NOT NULL,
  `heure_ordonnance` time NOT NULL,
  `nom_patient` varchar(20) NOT NULL,
  `prenom_patient` varchar(60) NOT NULL,
  `id_patient` int NOT NULL,
  `dosage` int NOT NULL,
  PRIMARY KEY (`id_ordonnance`),
  UNIQUE KEY `id_patient` (`id_patient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `patient`
--

DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient` (
  `id_patient` int NOT NULL AUTO_INCREMENT,
  `nom_patient` varchar(20) NOT NULL,
  `prenom_patient` varchar(60) NOT NULL,
  `age_patient` int NOT NULL,
  `sexe_patient` varchar(20) NOT NULL,
  `adresse_patient` varchar(100) NOT NULL,
  `tel_patient` varchar(50) NOT NULL,
  `id_dm` int NOT NULL,
  PRIMARY KEY (`id_patient`),
  UNIQUE KEY `id_dm` (`id_dm`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `patient`
--

INSERT INTO `patient` (`id_patient`, `nom_patient`, `prenom_patient`, `age_patient`, `sexe_patient`, `adresse_patient`, `tel_patient`, `id_dm`) VALUES
(1, 'Katie', 'Myriam', 18, 'F', 'katie@gmail.com', '0505945527', 2);

-- --------------------------------------------------------

--
-- Structure de la table `rdv`
--

DROP TABLE IF EXISTS `rdv`;
CREATE TABLE IF NOT EXISTS `rdv` (
  `id_rdv` int NOT NULL AUTO_INCREMENT,
  `date_rdv` date NOT NULL,
  `heure_rdv` time NOT NULL,
  `id_patient` int NOT NULL,
  PRIMARY KEY (`id_rdv`),
  UNIQUE KEY `id_patient` (`id_patient`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `rdv`
--

INSERT INTO `rdv` (`id_rdv`, `date_rdv`, `heure_rdv`, `id_patient`) VALUES
(1, '0000-00-00', '08:00:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `secretaire`
--

DROP TABLE IF EXISTS `secretaire`;
CREATE TABLE IF NOT EXISTS `secretaire` (
  `id_secretaire` int NOT NULL AUTO_INCREMENT,
  `nom_secretaire` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `prenom_secretaire` varchar(100) NOT NULL,
  `tel_secretaire` varchar(20) NOT NULL,
  `email_secretaire` varchar(100) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `photo` varchar(150) NOT NULL,
  PRIMARY KEY (`id_secretaire`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `secretaire`
--

INSERT INTO `secretaire` (`id_secretaire`, `nom_secretaire`, `prenom_secretaire`, `tel_secretaire`, `email_secretaire`, `mot_de_passe`, `photo`) VALUES
(2, 'Kouadio', 'chantal', '0140651234', 'chantal@gmail.com', '$2y$10$VMihCJkJf1jSwsHDA0Bzg.A1x69wM9Oz9Q/a64Ro4Vde/kpPVWA22', 'img/WhatsApp Image 2023-10-01 à 14.30.55_eb1a94f3.jpg'),
(3, 'nguessan', 'amlan', '0707877953', 'priscillenguessan@gmail.com', '$2y$10$GYv3L3qwkfd0o60DiQxydeOgl0qrAI4FJD9ANWs4bcfOAR0gQ8cRu', 'img/sara.jpg'),
(4, 'krouma', 'kady', '0103707775', 'kady@gmail.com', '$2y$10$2sb6tzha/VuiTp2W7emdSeRwQVct9VGVH72i6UlQKHHV74RqYGtPi', 'img/sokoty.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
