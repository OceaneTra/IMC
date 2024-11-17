-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 17 nov. 2024 à 01:53
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `infirmier`
--

INSERT INTO `infirmier` (`id_infirmier`, `nom_infirmier`, `prenom_infirmier`, `tel_infirmier`, `email_infirmier`, `mot_de_passe`, `photo`) VALUES
(2, 'Gomez', 'Ange Axel', '01724357689', 'gomez@gmail.com', '$2y$10$jjqxl.jVxzh6FqtXyJKobuKEHYyBFcsC4IGNi/HXm8.b/EXZB6r/G', ''),
(4, 'Sokoty', 'Othniel', '0798453214', 'sokoty@gmail.com', '$2y$10$bASX8YLD4evDX.0OXaCRguHK6t86pfLqzaDGmYsH.GFNcLK.dZNei', ''),
(5, 'krouma', 'francki', '0142493820', 'franckrouma2@gmail.com', '$2y$10$MeJQk4oihrbB2NPZQCFhG.R0Aa20uRBWSXTlCGnIBsBjnC6yCW5Kq', '');

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

--
-- Déchargement des données de la table `medecin`
--

INSERT INTO `medecin` (`id_medecin`, `nom_medecin`, `email_medecin`, `prenom_medecin`, `specialite`, `tel_medecin`, `mot_de_passe`, `photo`) VALUES
(1, 'krouma', 'franckrouma2@gmail.com', 'franck adams', '', '0142493820', '$2y$10$tBa6hKQdVY8gOj4RrlkEYebYaQjq4skKLxDR1cjXqa2NP47JohtuK', ''),
(4, 'Koffi', 'kassy@gmail.com', 'Christ', 'Cardiologue', '0512625892', '$2y$10$9dcqoRxXQlp9lgVdB73R2ewUxcGVhkyGnNToL5gH5y5wzwsew9J12', ''),
(5, 'Kassy', 'kassy@gmail.com', 'Yannis', 'Dentiste', '0505647892', '$2y$10$PtZbtFz.jDsRGnH7rDMHYu/Fn8c21sjtpaB//gb2lY16T6iOc0GUe', 'img/ail.png');

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
-- Structure de la table `paiements`
--

DROP TABLE IF EXISTS `paiements`;
CREATE TABLE IF NOT EXISTS `paiements` (
  `id_paiement` int NOT NULL AUTO_INCREMENT,
  `nom_carte` varchar(100) NOT NULL,
  `numero_carte` varchar(20) NOT NULL,
  `date_expiration` varchar(10) NOT NULL,
  `cvv` varchar(5) NOT NULL,
  `methode_paiement` varchar(50) NOT NULL,
  `montant` varchar(255) NOT NULL,
  `forfait` varchar(20) NOT NULL,
  PRIMARY KEY (`id_paiement`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `paiements`
--

INSERT INTO `paiements` (`id_paiement`, `nom_carte`, `numero_carte`, `date_expiration`, `cvv`, `methode_paiement`, `montant`, `forfait`) VALUES
(1, 'Jean', '5678', '13/2023', '456', 'Visa/Mastercard', '30000', 'Basic Plan - 30 000 '),
(2, 'Julien', '3456', '02/2024', '222', 'Visa/Mastercard', '60000', 'Business Plan - 60 0'),
(3, 'Julien', '3456', '02/2024', '222', 'Visa/Mastercard', '60000', 'Business Plan - 60 0'),
(4, 'Julien', '567', '14/2025', '123', 'paypal', '30000', 'Basic Plan - 30 000 '),
(5, 'Julien', '567', '14/2025', '123', 'paypal', '30000', 'Basic Plan - 30 000 '),
(6, 'Jean', '555', '12/07', '444', 'Visa/Mastercard', '80000', 'Entreprise Plan - 80'),
(7, 'Jean', '444', '11/2024', '555', 'Visa/Mastercard', '60000', 'Business Plan - 60 0'),
(8, 'Jean', '444', '11/2024', '555', 'Visa/Mastercard', '60000', 'Business Plan - 60 0'),
(9, 'Jean', '345678', '11/2024', '667', 'Visa/Mastercard', '30000', 'Basic Plan - 30 000 '),
(10, 'Jean', '345678', '11/2024', '667', 'Visa/Mastercard', '30000', 'Basic Plan - 30 000 '),
(11, 'Jean', '345678', '11/2024', '667', 'Visa/Mastercard', '30000', 'Basic Plan - 30 000 '),
(12, 'Jean', '345678', '11/2024', '667', 'Visa/Mastercard', '30000', 'Basic Plan - 30 000 '),
(13, 'Julien', '556', '12/2023', '111', 'paypal', '30000', 'Basic Plan - 30 000 '),
(14, 'Julien', '234567', '12/2024', '222', 'paypal', '60000', 'Business Plan - 60 0'),
(15, 'Julien', '234567', '12/2024', '222', 'paypal', '60000', 'Business Plan - 60 0'),
(16, 'Julien', '234567', '12/2024', '222', 'paypal', '60000', 'Business Plan - 60 0'),
(17, 'Julien', '234567', '12/2024', '222', 'paypal', '60000', 'Business Plan - 60 0'),
(18, 'Julien', '234567', '12/2024', '222', 'paypal', '60000', 'Business Plan - 60 0'),
(19, 'Julien', '234567', '12/2024', '222', 'paypal', '60000', 'Business Plan - 60 0'),
(20, 'Julien', '234567', '12/2024', '222', 'paypal', '60000', 'Business Plan - 60 0'),
(21, 'Julien', '234567', '12/2024', '222', 'paypal', '60000', 'Business Plan - 60 0'),
(22, 'Julien', '234567', '12/2024', '222', 'paypal', '60000', 'Business Plan - 60 0'),
(23, 'Julien', '234567', '12/2024', '222', 'paypal', '60000', 'Business Plan - 60 0'),
(24, 'Julien', '0865432', '04/2024', '126', 'paypal', '60000', 'Business Plan - 60 0'),
(25, 'Julien', '0865432', '04/2024', '126', 'paypal', '60000', 'Business Plan - 60 0'),
(26, 'Julien', '0865432', '04/2024', '126', 'paypal', '60000', 'Business Plan - 60 0'),
(27, 'Julien', '0865432', '04/2024', '126', 'paypal', '60000', 'Business Plan - 60 0'),
(28, 'Julien', '0865432', '04/2024', '126', 'paypal', '60000', 'Business Plan - 60 0'),
(29, 'Jean', '77798', '10/2024', '114', 'wave', '80000', 'Entreprise Plan - 80'),
(30, 'Julien', '55334', '09/2024', '444', 'orange', '30000', 'Basic Plan - 30 000 '),
(31, 'Jean', '333', '12/2024', '643', 'Visa/Mastercard', '30000', 'Basic Plan - 30 000 '),
(32, 'Marie', '222', '12/2025', '111', 'Visa/Mastercard', '30000', 'Basic Plan - 30 000 '),
(33, 'Marie', '3335', '10/2024', '888', 'Visa/Mastercard', '60000', 'Business Plan - 60 0'),
(34, 'Marie', '3335', '10/2024', '888', 'Visa/Mastercard', '60000', 'Business Plan - 60 0'),
(35, 'Marie', '222345', '04/2025', '222', 'Visa/Mastercard', '80000', 'Entreprise Plan - 80'),
(36, 'Marie', '222345', '04/2025', '222', 'Visa/Mastercard', '80000', 'Entreprise Plan - 80'),
(37, 'Marie', '222345', '04/2025', '222', 'Visa/Mastercard', '80000', 'Entreprise Plan - 80'),
(38, 'Marie', '222345', '04/2025', '222', 'Visa/Mastercard', '80000', 'Entreprise Plan - 80'),
(39, 'Marie', '222345', '04/2025', '222', 'Visa/Mastercard', '80000', 'Entreprise Plan - 80'),
(40, 'Marie', '222345', '04/2025', '222', 'Visa/Mastercard', '80000', 'Entreprise Plan - 80'),
(41, 'Marie', '222345', '04/2025', '222', 'Visa/Mastercard', '80000', 'Entreprise Plan - 80'),
(42, 'Marie', '222345', '04/2025', '222', 'Visa/Mastercard', '80000', 'Entreprise Plan - 80'),
(43, 'Marie', '222345', '04/2025', '222', 'Visa/Mastercard', '80000', 'Entreprise Plan - 80'),
(44, 'Marie', '222345', '04/2025', '222', 'Visa/Mastercard', '80000', 'Entreprise Plan - 80'),
(45, 'Marie', '222345', '04/2025', '222', 'Visa/Mastercard', '80000', 'Entreprise Plan - 80');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `secretaire`
--

INSERT INTO `secretaire` (`id_secretaire`, `nom_secretaire`, `prenom_secretaire`, `tel_secretaire`, `email_secretaire`, `mot_de_passe`, `photo`) VALUES
(1, 'Kassy', 'Yannis', '0505647892', 'kassy@gmail.com', '$2y$10$hgWd4wppl5xbClhhzd6YnestpjGDlx.xZ0YbaKj8IpHGSpHlZVgqS', '0');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
