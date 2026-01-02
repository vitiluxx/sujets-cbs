-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 31, 2025 at 01:14 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sujetscbs`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_adm` int(11) NOT NULL COMMENT 'Identifiant unique de l''administrateur',
  `email_adm` varchar(255) NOT NULL COMMENT 'Email de l''administrateur',
  `mdp_adm` varchar(255) NOT NULL COMMENT 'Mot de passe hashé de l''administrateur',
  `role_adm` enum('administrateur','super_root') DEFAULT 'administrateur' COMMENT 'Rôle de l''administrateur',
  `date_creation_adm` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Date de création du compte admin',
  `date_modification_adm` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Date de dernière modification'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Table des administrateurs';

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_adm`, `email_adm`, `mdp_adm`, `role_adm`, `date_creation_adm`, `date_modification_adm`) VALUES
(1, 'gdc6.td@gmail.com', '$2y$10$gNPRRyZrXufmlwvdXDk3c.rwCs0s26B5HRuPIRbxF54Xx5kt6NV8O', 'administrateur', '2025-12-30 10:18:46', '2025-12-30 10:18:46');

-- --------------------------------------------------------

--
-- Table structure for table `cf`
--

CREATE TABLE `cf` (
  `id` int(11) NOT NULL COMMENT 'Identifiant unique du sujet',
  `matiere` varchar(50) NOT NULL COMMENT 'Nom de la matière',
  `annee` varchar(15) DEFAULT NULL COMMENT 'Intervalle années des sujets',
  `niveau` int(1) NOT NULL COMMENT 'Le niveau de la licence',
  `cc` varchar(150) DEFAULT NULL COMMENT 'Chemin vers le fichier PDF CC (Contrôle Continu)',
  `sn` varchar(150) DEFAULT NULL COMMENT 'Chemin vers le fichier PDF SN (Session Normale)',
  `sr` varchar(150) DEFAULT NULL COMMENT 'Chemin vers le fichier PDF SR (Session de Rattrapage)',
  `bts` varchar(150) DEFAULT NULL COMMENT 'Chemin vers le fichier PDF BTS (Brevet de Technicien Supérieur)',
  `td` varchar(150) DEFAULT NULL COMMENT 'Chemin vers le fichier PDF TD (Travaux Dirigés)',
  `tp` varchar(150) DEFAULT NULL COMMENT 'Chemin vers le fichier PDF TP (Travaux Pratiques)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Table des sujets PDF pour la filière Comptabilité et Finance';

-- --------------------------------------------------------

--
-- Table structure for table `dcj`
--

CREATE TABLE `dcj` (
  `id` int(11) NOT NULL COMMENT 'Identifiant unique du sujet',
  `matiere` varchar(50) NOT NULL COMMENT 'Nom de la matière',
  `annee` varchar(15) DEFAULT NULL COMMENT 'Intervalle années des sujets',
  `niveau` int(1) NOT NULL COMMENT 'Le niveau de la licence',
  `cc` varchar(150) DEFAULT NULL COMMENT 'Chemin vers le fichier PDF CC (Contrôle Continu)',
  `sn` varchar(150) DEFAULT NULL COMMENT 'Chemin vers le fichier PDF SN (Session Normale)',
  `sr` varchar(150) DEFAULT NULL COMMENT 'Chemin vers le fichier PDF SR (Session de Rattrapage)',
  `bts` varchar(150) DEFAULT NULL COMMENT 'Chemin vers le fichier PDF BTS (Brevet de Technicien Supérieur)',
  `td` varchar(150) DEFAULT NULL COMMENT 'Chemin vers le fichier PDF TD (Travaux Dirigés)',
  `tp` varchar(150) DEFAULT NULL COMMENT 'Chemin vers le fichier PDF TP (Travaux Pratiques)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Table des sujets PDF pour la filière Droit et Communication Juridique';

-- --------------------------------------------------------

--
-- Table structure for table `edd`
--

CREATE TABLE `edd` (
  `id` int(11) NOT NULL COMMENT 'Identifiant unique du sujet',
  `matiere` varchar(50) NOT NULL COMMENT 'Nom de la matière',
  `annee` varchar(15) DEFAULT NULL COMMENT 'Intervalle années des sujets',
  `niveau` int(1) NOT NULL COMMENT 'Le niveau de la licence',
  `cc` varchar(150) DEFAULT NULL COMMENT 'Chemin vers le fichier PDF CC (Contrôle Continu)',
  `sn` varchar(150) DEFAULT NULL COMMENT 'Chemin vers le fichier PDF SN (Session Normale)',
  `sr` varchar(150) DEFAULT NULL COMMENT 'Chemin vers le fichier PDF SR (Session de Rattrapage)',
  `bts` varchar(150) DEFAULT NULL COMMENT 'Chemin vers le fichier PDF BTS (Brevet de Technicien Supérieur)',
  `td` varchar(150) DEFAULT NULL COMMENT 'Chemin vers le fichier PDF TD (Travaux Dirigés)',
  `tp` varchar(150) DEFAULT NULL COMMENT 'Chemin vers le fichier PDF TP (Travaux Pratiques)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Table des sujets PDF pour la filière Économie et Développement Durable';

-- --------------------------------------------------------

--
-- Table structure for table `etudiant_cbs`
--

CREATE TABLE `etudiant_cbs` (
  `id_etu` int(11) NOT NULL COMMENT 'Identifiant unique de l''étudiant CBS',
  `prenom_etu` varchar(100) NOT NULL COMMENT 'Prénom de l''étudiant',
  `email_etu` varchar(255) NOT NULL COMMENT 'Email de l''étudiant',
  `identifiant_etu` varchar(100) NOT NULL COMMENT 'Identifiant de connexion CBS',
  `compte_confirme_etu` tinyint(1) DEFAULT 0 COMMENT 'Statut de confirmation du compte',
  `carte_recto_etu` varchar(500) DEFAULT NULL COMMENT 'Chemin vers l''image recto de la carte',
  `carte_verso_etu` varchar(500) DEFAULT NULL COMMENT 'Chemin vers l''image verso de la carte',
  `date_inscription_etu` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Date d''inscription',
  `date_confirmation_etu` timestamp NULL DEFAULT NULL COMMENT 'Date de confirmation du compte',
  `date_modification_etu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Date de dernière modification'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Table des étudiants CBS confirmés';

--
-- Dumping data for table `etudiant_cbs`
--

INSERT INTO `etudiant_cbs` (`id_etu`, `prenom_etu`, `email_etu`, `identifiant_etu`, `compte_confirme_etu`, `carte_recto_etu`, `carte_verso_etu`, `date_inscription_etu`, `date_confirmation_etu`, `date_modification_etu`) VALUES
(1, 'luxx', 'luxx@gmail.com', 'luxx0', 1, NULL, NULL, '2025-12-30 10:34:28', NULL, '2025-12-30 10:34:28');

-- --------------------------------------------------------

--
-- Table structure for table `etudiant_cbs_temp`
--

CREATE TABLE `etudiant_cbs_temp` (
  `id_etu` int(11) NOT NULL COMMENT 'Identifiant unique de la demande',
  `prenom_etu` varchar(100) NOT NULL COMMENT 'Prénom de l''étudiant',
  `email_etu` varchar(255) NOT NULL COMMENT 'Email de l''étudiant',
  `carte_recto_etu` varchar(500) DEFAULT NULL COMMENT 'Chemin vers l''image recto de la carte',
  `carte_verso_etu` varchar(500) DEFAULT NULL COMMENT 'Chemin vers l''image verso de la carte',
  `compte_confirme_etu` tinyint(1) DEFAULT 0,
  `identifiant_etu` varchar(100) DEFAULT NULL COMMENT 'Identifiant généré pour l''étudiant',
  `date_inscription_etu` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Date de la demande d''inscription',
  `statut_demande` enum('en_attente','approuvee','rejetee') DEFAULT 'en_attente' COMMENT 'Statut de la demande'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Table des demandes d''inscription CBS en attente';

-- --------------------------------------------------------

--
-- Table structure for table `gi`
--

CREATE TABLE `gi` (
  `id` int(11) NOT NULL COMMENT 'Identifiant unique du sujet',
  `matiere` varchar(50) NOT NULL COMMENT 'Nom de la matière',
  `annee` varchar(15) DEFAULT NULL COMMENT 'Intervalle années des sujets',
  `niveau` int(1) NOT NULL COMMENT 'Le niveau de la licence',
  `cc` varchar(150) DEFAULT NULL COMMENT 'Chemin vers le fichier PDF CC (Contrôle Continu)',
  `sn` varchar(150) DEFAULT NULL COMMENT 'Chemin vers le fichier PDF SN (Session Normale)',
  `sr` varchar(150) DEFAULT NULL COMMENT 'Chemin vers le fichier PDF SR (Session de Rattrapage)',
  `bts` varchar(150) DEFAULT NULL COMMENT 'Chemin vers le fichier PDF BTS (Brevet de Technicien Supérieur)',
  `td` varchar(150) DEFAULT NULL COMMENT 'Chemin vers le fichier PDF TD (Travaux Dirigés)',
  `tp` varchar(150) DEFAULT NULL COMMENT 'Chemin vers le fichier PDF TP (Travaux Pratiques)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Table des sujets PDF pour la filière Gestion Informatique';

--
-- Dumping data for table `gi`
--

INSERT INTO `gi` (`id`, `matiere`, `annee`, `niveau`, `cc`, `sn`, `sr`, `bts`, `td`, `tp`) VALUES
(2, 'ALGORITHMIQUE', '2021', 1, 'cc-ALGORITHMIQUE-2021-gi1.pdf', NULL, NULL, NULL, NULL, NULL),
(3, 'ALGEBRE LINEAIRE', '2021', 1, 'cc-ALGEBRE_LINEAIRE-2021-gi1.pdf', NULL, NULL, NULL, NULL, NULL),
(4, 'ANGLAIS', '2022', 1, 'cc-ANGLAIS-2022-gi1.pdf', NULL, NULL, NULL, NULL, NULL),
(5, 'ARCHITECTURE DES ORDINATEURS', '2022', 1, 'cc-ARCHITECTURE_DES_ORDINATEURS-2022-gi1.pdf', NULL, NULL, NULL, NULL, NULL),
(6, 'ECONOMIE GENERALE', '2022', 1, 'cc-ECONOMIE_GENERALE-2022-gi1.pdf', NULL, NULL, NULL, NULL, NULL),
(7, 'LOGIQUE MATHEMATIQUE', '2022', 1, 'cc-LOGIQUE_MATHEMATIQUE-2022-gi1.pdf', NULL, NULL, NULL, NULL, NULL),
(8, 'PROGRAMMATION C', 'xxxx', 1, 'cc-PROGRAMMATION_C-gi1.pdf', NULL, NULL, NULL, NULL, NULL),
(9, 'STATISTIQUE DESCRIPTIVE', '2022', 1, 'cc-STATISTIQUE_DESCRIPTIVE-2022-gi1.pdf', NULL, NULL, NULL, NULL, NULL),
(10, 'ANALYSE 2', '2022', 1, NULL, 'sn-ANALYSE_2-2022-gi1.pdf', NULL, NULL, NULL, NULL),
(11, 'CIRCUITS LOGIQUES', '2022', 1, NULL, 'sn-CIRCUITS_LOGIQUES-2022-gi1.pdf', NULL, NULL, NULL, NULL),
(12, 'ECONOMIE GENERALE', '2022', 1, NULL, 'sn-ECONOMIE_GENERALE-2022-gi1.pdf', NULL, NULL, NULL, NULL),
(13, 'INITIATION A LA PROGRAMMATION WEB', '2022', 1, NULL, 'sn-INITIATION_A_LA_PROGRAMMATION_WEB-2022-gi1.pdf', NULL, NULL, NULL, NULL),
(14, 'METHODOLOGIE D\'ANALYSE', '2022', 1, NULL, 'sn-METHODOLOGIE_ANALYSE-2022-gi1.pdf', NULL, NULL, NULL, NULL),
(15, 'SYSTEME D\'EXPLOITATION', 'xxxx', 1, NULL, 'sn-SYSTEME_EXPLOITATION-gi1.pdf', NULL, NULL, NULL, NULL),
(16, 'ANALYSE 1', '2022', 1, NULL, NULL, NULL, NULL, 'td-ANALYSE_1-2022-gi1.pdf', NULL),
(17, 'SYSTEME D\'EXPLOITATION', 'xxxx', 1, NULL, NULL, NULL, NULL, NULL, 'tp-SYSTEME_EXPLOITATION-gi1_1.pdf'),
(18, 'ANALYSE NUMERIQUE', '2023', 2, 'cc-ANALYSE_NUMERIQUE-2023-gi2.pdf', NULL, NULL, NULL, NULL, NULL),
(19, 'ELECTRONIQUE NUMERIQUE', 'xxxx', 2, 'cc-ELECTRONIQUE_NUMERIQUE-gi2.pdf', NULL, NULL, NULL, NULL, NULL),
(20, 'PROGRAMMATION FONCTIONNELLE', 'xxxx', 2, 'cc-PROGRAMMATION_FONCTIONNELLE-gi2.pdf', NULL, NULL, NULL, NULL, NULL),
(21, 'PROGRAMMATION SYSTEME ET RESEAU', '2023', 2, 'cc-PROGRAMMATION_SYSTEME_ET_RESEAU-2023-gi2.pdf', NULL, NULL, NULL, NULL, NULL),
(22, 'SYSTEME EXPLOITATION', 'xxxx', 2, 'cc-SYSTEME_EXPLOITATION-gi2.pdf', NULL, NULL, NULL, NULL, NULL),
(23, 'THEORIE DES LANGAGES', '2023', 2, 'cc-THEORIE_DES_LANGAGES-2023-gi2.pdf', NULL, NULL, NULL, NULL, NULL),
(24, 'BASE DE DONNEES RELATIONNELLES', 'xxxx', 2, NULL, 'sn-BD_RELATIONNELLES-gi2.pdf', NULL, NULL, NULL, NULL),
(25, 'ELECTRONIQUE NUMERIQUE', '2023', 2, NULL, 'sn-ELECTRONIQUE_NUMERIQUE-2023-gi2.pdf', NULL, NULL, NULL, NULL),
(26, 'MAINTENANCE INFORMATIQUE', '2023', 2, NULL, 'sn-MAINTENANCE_INFORMATIQUE-2023-gi2.pdf', NULL, NULL, NULL, NULL),
(27, 'PROBABILITES ET STATISTIQUES', '2024', 2, NULL, 'sn-PROBABILITES_ET_STATISTIQUES-2024_gi2.pdf', NULL, NULL, NULL, NULL),
(28, 'PROGRAMMATION FONCTIONNELLE', 'xxxx', 2, NULL, 'sn-PROGRAMMATION_FONCTIONNELLE-gi2.pdf', NULL, NULL, NULL, NULL),
(29, 'PROGRAMMATION SYSTEME ET RESEAU', '2021', 2, NULL, 'sn-PROGRAMMATION_SYSTEME_ET_RESEAU-2021-gi2.pdf', NULL, NULL, NULL, NULL),
(30, 'PROGRAMMATION SYSTEME ET RESEAU', '2021', 2, NULL, 'sn-PROGRAMMATION_SYSTEME_ET_RESEAU-2021-gi2.pdf', NULL, NULL, NULL, NULL),
(31, 'PROGRAMMATION WEB DYNAMIQUE', '2023', 2, NULL, 'sn-PROGRAMMATION_WEB_DYNAMIQUE-2023-gi2.pdf', NULL, NULL, NULL, NULL),
(32, 'RESEAU', '2023', 2, NULL, 'sn-RESEAU-2023-gi2.pdf', NULL, NULL, NULL, NULL),
(33, 'STRUCTURE DE DONNEES', '2023', 2, NULL, 'sn-STRUCTURE_DE_DONNEES-2023-gi2.pdf', NULL, NULL, NULL, NULL),
(34, 'SYSTEME D\'EXPLOITATION', 'xxxx', 2, NULL, 'sn-SYSTEME_EXPLOITATION-gi2.pdf', NULL, NULL, NULL, NULL),
(35, 'THEORIE DE GRAPHES', '2023', 2, NULL, 'sn-THEORIE_DE_GRAPHES-2023-gi2.pdf', NULL, NULL, NULL, NULL),
(36, 'THEORIE DES LANGAGES', '2024', 2, NULL, 'sn-THEORIE_DES_LANGAGES-2024-gi2.pdf', NULL, NULL, NULL, NULL),
(37, 'ANALYSE NUMERIQUE', '2023', 2, NULL, NULL, 'sr-ANALYSE_NUMERIQUE-2023-gi2.pdf', NULL, NULL, NULL),
(38, 'BASE DE DONNEES RELATIONNELLES', '2025', 2, NULL, NULL, 'sr-BD_RELATIONNELLES-2025-gi2.pdf', NULL, NULL, NULL),
(39, 'GENIE LOGICIEL', '2023', 2, NULL, NULL, 'sr-GENIE_LOGICIEL-2023-gi2.pdf', NULL, NULL, NULL),
(40, 'ANALYSE NUMERIQUE', '2023', 2, NULL, NULL, NULL, NULL, 'td-ANALYSE_NUMERIQUE-2023-gi2.pdf', NULL),
(41, 'PROBABILITES ET STATISTIQUES', '2023', 2, NULL, NULL, NULL, NULL, 'td-PROBABILITES_ET_STATISTIQUES-2023_gi2 - Copy.pdf', NULL),
(42, 'THEORIE DES LANGAGES', '2023', 2, NULL, NULL, NULL, NULL, 'td-THEORIE_DES_LANGAGES-2023-gi2.pdf', NULL),
(43, 'ATELIER DE GENIE LOGICIEL', '2025', 3, 'cc-ATELIER_DE_GENIE_LOGICIEL-2025-gi3.pdf', NULL, NULL, NULL, NULL, NULL),
(44, 'ENTREPOT DES DONNEES', '2025', 3, 'cc-ENTREPOT_DES_DONNEES-2025-gi3.pdf', NULL, NULL, NULL, NULL, NULL),
(45, 'ANGLAIS', '2025', 3, NULL, 'sn-ANGLAIS-2025-gi3.pdf', NULL, NULL, NULL, NULL),
(46, 'ATELIER DE GENIE LOGICIEL', '2025', 3, NULL, 'sn-ATELIER_DE_GENIE_LOGICIEL-2025-gi3.pdf', NULL, NULL, NULL, NULL),
(47, 'BASE DE DONNEES MOBILES', '2025', 3, NULL, 'sn-BASE_DE_DONNEES_MOBILES-2025-gi3.pdf', NULL, NULL, NULL, NULL),
(48, 'COMPILATION', '2022', 3, NULL, 'sn-COMPILATION-2022-gi3.pdf', NULL, NULL, NULL, NULL),
(49, 'DROIT DES AFFAIRES', '2025', 3, NULL, 'sn-DROIT_DES_AFFAIRES-2025-gi3.pdf', NULL, NULL, NULL, NULL),
(50, 'GESTION ET CONDUITE DE PROJET', '2025', 3, NULL, 'sn-GESTION_ET_CONDUITE_DE_PROJET-2025-gi3.pdf', NULL, NULL, NULL, NULL),
(51, 'SYSTEME D\'EXPLOITATION', '2024 à 2025', 3, NULL, 'sn-SE-2024_2025-gi3.pdf', NULL, NULL, NULL, NULL),
(52, 'SYSTEME DISTRIBUE', '2025', 3, NULL, 'sn-SYSTEME_DISTRIBUE-2025-gi3.pdf', NULL, NULL, NULL, NULL),
(53, 'WEB SERVICE', '2025', 3, NULL, 'sn-WEB_SERVICE-2025-gi3.pdf', NULL, NULL, NULL, NULL),
(54, 'CONCEPTS IA', '2025', 3, NULL, NULL, 'sr-CONCEPTS_IA-2025-gi3.pdf', NULL, NULL, NULL),
(55, 'ENTREPOT DES DONNEES', '2025', 3, NULL, NULL, 'sr-ENTREPOT_DES_DONNEES-2025-gi3.pdf', NULL, NULL, NULL),
(56, 'SYSTEME D\'EXPLOITATION', '2025', 3, NULL, NULL, 'sr-SE-2025-gi3.pdf', NULL, NULL, NULL),
(57, 'SYSTEME DISTRIBUE', '2025', 3, NULL, NULL, 'sr-SYSTEME_DISTRIBUE-2025-gi3.pdf', NULL, NULL, NULL),
(58, 'BASE DE DONNEES AVANCEES', 'xxxx', 3, NULL, NULL, NULL, NULL, 'td-base_de_donnees_avancees-gi3.pdf', NULL),
(59, 'COMPILATION', '2025', 3, NULL, NULL, NULL, NULL, 'td-COMPILATION-2025-gi3.pdf', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `grh`
--

CREATE TABLE `grh` (
  `id` int(11) NOT NULL COMMENT 'Identifiant unique du sujet',
  `matiere` varchar(50) NOT NULL COMMENT 'Nom de la matière',
  `annee` varchar(15) DEFAULT NULL COMMENT 'Intervalle années des sujets',
  `niveau` int(1) NOT NULL COMMENT 'Le niveau de la licence',
  `cc` varchar(150) DEFAULT NULL COMMENT 'Chemin vers le fichier PDF CC (Contrôle Continu)',
  `sn` varchar(150) DEFAULT NULL COMMENT 'Chemin vers le fichier PDF SN (Session Normale)',
  `sr` varchar(150) DEFAULT NULL COMMENT 'Chemin vers le fichier PDF SR (Session de Rattrapage)',
  `bts` varchar(150) DEFAULT NULL COMMENT 'Chemin vers le fichier PDF BTS (Brevet de Technicien Supérieur)',
  `td` varchar(150) DEFAULT NULL COMMENT 'Chemin vers le fichier PDF TD (Travaux Dirigés)',
  `tp` varchar(150) DEFAULT NULL COMMENT 'Chemin vers le fichier PDF TP (Travaux Pratiques)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Table des sujets PDF pour la filière Gestion des Ressources Humaines';

-- --------------------------------------------------------

--
-- Table structure for table `lt`
--

CREATE TABLE `lt` (
  `id` int(11) NOT NULL COMMENT 'Identifiant unique du sujet',
  `matiere` varchar(50) NOT NULL COMMENT 'Nom de la matière',
  `annee` varchar(15) DEFAULT NULL COMMENT 'Intervalle années des sujets',
  `niveau` int(1) NOT NULL COMMENT 'Le niveau de la licence',
  `cc` varchar(150) DEFAULT NULL COMMENT 'Chemin vers le fichier PDF CC (Contrôle Continu)',
  `sn` varchar(150) DEFAULT NULL COMMENT 'Chemin vers le fichier PDF SN (Session Normale)',
  `sr` varchar(150) DEFAULT NULL COMMENT 'Chemin vers le fichier PDF SR (Session de Rattrapage)',
  `bts` varchar(150) DEFAULT NULL COMMENT 'Chemin vers le fichier PDF BTS (Brevet de Technicien Supérieur)',
  `td` varchar(150) DEFAULT NULL COMMENT 'Chemin vers le fichier PDF TD (Travaux Dirigés)',
  `tp` varchar(150) DEFAULT NULL COMMENT 'Chemin vers le fichier PDF TP (Travaux Pratiques)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Table des sujets PDF pour la filière Lettres et Traduction';

-- --------------------------------------------------------

--
-- Table structure for table `mcd`
--

CREATE TABLE `mcd` (
  `id` int(11) NOT NULL COMMENT 'Identifiant unique du sujet',
  `matiere` varchar(50) NOT NULL COMMENT 'Nom de la matière',
  `annee` varchar(15) DEFAULT NULL COMMENT 'Intervalle années des sujets',
  `niveau` int(1) NOT NULL COMMENT 'Le niveau de la licence',
  `cc` varchar(150) DEFAULT NULL COMMENT 'Chemin vers le fichier PDF CC (Contrôle Continu)',
  `sn` varchar(150) DEFAULT NULL COMMENT 'Chemin vers le fichier PDF SN (Session Normale)',
  `sr` varchar(150) DEFAULT NULL COMMENT 'Chemin vers le fichier PDF SR (Session de Rattrapage)',
  `bts` varchar(150) DEFAULT NULL COMMENT 'Chemin vers le fichier PDF BTS (Brevet de Technicien Supérieur)',
  `td` varchar(150) DEFAULT NULL COMMENT 'Chemin vers le fichier PDF TD (Travaux Dirigés)',
  `tp` varchar(150) DEFAULT NULL COMMENT 'Chemin vers le fichier PDF TP (Travaux Pratiques)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Table des sujets PDF pour la filière Marketing et Communication Digitale';

-- --------------------------------------------------------

--
-- Table structure for table `scienceid`
--

CREATE TABLE `scienceid` (
  `id` int(11) NOT NULL COMMENT 'Identifiant unique du sujet',
  `matiere` varchar(50) NOT NULL COMMENT 'Nom de la matière',
  `annee` varchar(15) DEFAULT NULL COMMENT 'Intervalle années des sujets',
  `niveau` int(1) NOT NULL COMMENT 'Le niveau de la licence',
  `cc` varchar(150) DEFAULT NULL COMMENT 'Chemin vers le fichier PDF CC (Contrôle Continu)',
  `sn` varchar(150) DEFAULT NULL COMMENT 'Chemin vers le fichier PDF SN (Session Normale)',
  `sr` varchar(150) DEFAULT NULL COMMENT 'Chemin vers le fichier PDF SR (Session de Rattrapage)',
  `bts` varchar(150) DEFAULT NULL COMMENT 'Chemin vers le fichier PDF BTS (Brevet de Technicien Supérieur)',
  `td` varchar(150) DEFAULT NULL COMMENT 'Chemin vers le fichier PDF TD (Travaux Dirigés)',
  `tp` varchar(150) DEFAULT NULL COMMENT 'Chemin vers le fichier PDF TP (Travaux Pratiques)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Table des sujets PDF pour la filière Sciences de l''Information et Documentation';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_adm`),
  ADD UNIQUE KEY `email_adm` (`email_adm`);

--
-- Indexes for table `cf`
--
ALTER TABLE `cf`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_cf_matiere` (`matiere`),
  ADD KEY `idx_cf_annee` (`annee`);

--
-- Indexes for table `dcj`
--
ALTER TABLE `dcj`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_dcj_matiere` (`matiere`),
  ADD KEY `idx_dcj_annee` (`annee`);

--
-- Indexes for table `edd`
--
ALTER TABLE `edd`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_edd_matiere` (`matiere`),
  ADD KEY `idx_edd_annee` (`annee`);

--
-- Indexes for table `etudiant_cbs`
--
ALTER TABLE `etudiant_cbs`
  ADD PRIMARY KEY (`id_etu`),
  ADD UNIQUE KEY `email_etu` (`email_etu`),
  ADD UNIQUE KEY `identifiant_etu` (`identifiant_etu`);

--
-- Indexes for table `etudiant_cbs_temp`
--
ALTER TABLE `etudiant_cbs_temp`
  ADD PRIMARY KEY (`id_etu`);

--
-- Indexes for table `gi`
--
ALTER TABLE `gi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_gi_matiere` (`matiere`),
  ADD KEY `idx_gi_annee` (`annee`);

--
-- Indexes for table `grh`
--
ALTER TABLE `grh`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_grh_matiere` (`matiere`),
  ADD KEY `idx_grh_annee` (`annee`);

--
-- Indexes for table `lt`
--
ALTER TABLE `lt`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_lt_matiere` (`matiere`),
  ADD KEY `idx_lt_annee` (`annee`);

--
-- Indexes for table `mcd`
--
ALTER TABLE `mcd`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_mcd_matiere` (`matiere`),
  ADD KEY `idx_mcd_annee` (`annee`);

--
-- Indexes for table `scienceid`
--
ALTER TABLE `scienceid`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_scienceid_matiere` (`matiere`),
  ADD KEY `idx_scienceid_annee` (`annee`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_adm` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant unique de l''administrateur', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cf`
--
ALTER TABLE `cf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant unique du sujet';

--
-- AUTO_INCREMENT for table `dcj`
--
ALTER TABLE `dcj`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant unique du sujet';

--
-- AUTO_INCREMENT for table `edd`
--
ALTER TABLE `edd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant unique du sujet';

--
-- AUTO_INCREMENT for table `etudiant_cbs`
--
ALTER TABLE `etudiant_cbs`
  MODIFY `id_etu` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant unique de l''étudiant CBS', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `etudiant_cbs_temp`
--
ALTER TABLE `etudiant_cbs_temp`
  MODIFY `id_etu` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant unique de la demande', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gi`
--
ALTER TABLE `gi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant unique du sujet', AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `grh`
--
ALTER TABLE `grh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant unique du sujet';

--
-- AUTO_INCREMENT for table `lt`
--
ALTER TABLE `lt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant unique du sujet';

--
-- AUTO_INCREMENT for table `mcd`
--
ALTER TABLE `mcd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant unique du sujet', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `scienceid`
--
ALTER TABLE `scienceid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant unique du sujet';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
