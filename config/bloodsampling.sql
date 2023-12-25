-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 25 déc. 2023 à 10:52
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bloodsampling`
--

-- --------------------------------------------------------

--
-- Structure de la table `blood_sampling`
--

CREATE TABLE `blood_sampling` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `daily_dose_before_blood_test` double NOT NULL,
  `inr` double NOT NULL,
  `daily_dose_modified_after_inr` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `any_comments` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_next_inr` datetime NOT NULL,
  `is_send` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `blood_sampling`
--

INSERT INTO `blood_sampling` (`id`, `created_at`, `daily_dose_before_blood_test`, `inr`, `daily_dose_modified_after_inr`, `any_comments`, `date_of_next_inr`, `is_send`) VALUES
(1, '2022-09-19 00:00:00', 1, 2.2, '1.1', 'Enrhumée', '2022-09-26 00:00:00', 1),
(2, '2022-09-26 00:00:00', 1.1, 4.4, '1', 'RAS', '2022-09-29 00:00:00', 1),
(3, '2022-09-29 00:00:00', 1, 5, 'Pas de coumadine ce soir', 'RAS', '2022-09-30 00:00:00', 1),
(4, '2022-09-30 00:00:00', 1, 4.3, 'Pas de modification de la dose', 'RAS', '2022-10-04 00:00:00', 1),
(5, '2022-10-04 00:00:00', 1, 4.2, '0.9', 'RAS', '2022-10-07 00:00:00', 1),
(6, '2022-10-08 00:00:00', 0.9, 4.5, '0.8', 'RAS', '2022-10-10 00:00:00', 1),
(7, '2022-10-10 00:00:00', 0.8, 4.4, '0.7', 'RAS', '2022-10-12 00:00:00', 1),
(8, '2022-10-12 00:00:00', 0.7, 3.4, '0.9', 'RAS', '2022-10-14 00:00:00', 1),
(9, '2022-10-14 00:00:00', 0.9, 3.4, 'Pas de modification de la dose', 'RAS', '2022-10-18 00:00:00', 1),
(10, '2022-10-18 00:00:00', 0.9, 3.3, 'Pas de modification de la dose', 'RAS', '2022-11-18 00:00:00', 1),
(11, '2022-11-24 00:00:00', 1, 2.2, 'Pas de modification de la dose', 'RAS', '2022-11-25 00:00:00', 1),
(12, '2022-11-25 00:00:00', 1, 2.3, 'Pas de modification de la dose', 'RAS', '2022-11-27 00:00:00', 1),
(13, '2022-11-27 00:00:00', 1, 2.6, 'Pas de modification de la dose', 'RAS', '2022-11-30 00:00:00', 1),
(14, '2022-11-30 00:00:00', 1, 3.3, '0.9', 'RAS', '2022-12-02 00:00:00', 1),
(15, '2022-12-02 00:00:00', 0.9, 3.4, 'Pas de modification de la dose', 'RAS', '2022-12-26 00:00:00', 1),
(16, '2022-12-26 00:00:00', 0.9, 2.8, 'Pas de modification de la dose', 'RAS', '2023-01-11 00:00:00', 1),
(17, '2023-01-11 00:00:00', 0.9, 2.6, 'Pas de modification de la dose', 'RAS', '2023-01-26 00:00:00', 1),
(18, '2023-01-28 00:00:00', 0.9, 3.3, 'Pas de modification de la dose', 'RAS', '2023-02-04 00:00:00', 1),
(19, '2023-02-04 00:00:00', 0.9, 2.1, '1', 'Enrhumée', '2023-02-06 00:00:00', 1),
(20, '2023-02-06 00:00:00', 1, 2.3, 'Pas de modification de la dose', 'Enrhumée', '2023-02-13 00:00:00', 1),
(21, '2023-02-13 00:00:00', 1, 2.5, '1.1', 'Enrhumée', '2023-02-16 00:00:00', 1),
(22, '2023-02-16 00:00:00', 1.1, 2.3, '1.2', 'Enrhumée', '2023-02-20 00:00:00', 1),
(23, '2023-02-20 00:00:00', 1.2, 3.2, '1.2', 'Enrhumée', '2023-02-23 00:00:00', 1),
(24, '2023-02-23 00:00:00', 1.2, 3.2, '1.2', 'Enrhumée', '2023-03-02 00:00:00', 1),
(25, '2023-03-03 00:00:00', 1.2, 3.9, '1.1', 'RAS', '2023-03-07 00:00:00', 1),
(26, '2023-07-07 00:00:00', 1.1, 4.7, '1', 'RAS', '2023-03-09 00:00:00', 1),
(27, '2023-03-09 00:00:00', 1, 4, 'Pas de modification de la dose', 'RAS', '2023-03-14 00:00:00', 1),
(28, '2023-03-14 00:00:00', 1, 3.7, 'Pas de modification de la dose', 'RAS', '2023-03-29 00:00:00', 1),
(29, '2023-03-29 00:00:00', 1, 3.8, 'Pas de modification de la dose', 'RAS', '2023-05-08 00:00:00', 1),
(30, '2023-05-14 00:00:00', 1, 3.3, 'Pas de modification de la dose', 'Enrhumée', '2023-06-05 00:00:00', 1),
(31, '2023-06-07 00:00:00', 1, 2.2, '1.1', 'RAS', '2023-06-09 00:00:00', 1),
(32, '2023-06-09 00:00:00', 1.1, 2.5, 'Pas de modification de la dose', 'RAS', '2023-06-14 00:00:00', 1),
(33, '2023-06-14 00:00:00', 1.1, 3.1, 'Pas de modification de la dose', 'RAS', '2023-06-21 00:00:00', 1),
(34, '2023-03-21 00:00:00', 1.1, 2.8, 'Pas de modification de la dose', 'RAS', '2023-07-01 00:00:00', 1),
(35, '2023-07-01 00:00:00', 1.1, 2.9, 'Pas de modification de la dose', 'RAS', '2023-07-17 00:00:00', 1),
(36, '2023-07-17 00:00:00', 1.1, 2.1, '1.2', 'RAS', '2023-07-19 00:00:00', 1),
(37, '2023-07-19 00:00:00', 1.2, 1.7, '1.3', 'RAS', '2023-07-20 00:00:00', 1),
(38, '2023-07-20 00:00:00', 1.3, 1.5, '1.4', 'RAS', '2023-07-27 00:00:00', 1),
(39, '2023-07-27 00:00:00', 1.4, 1.5, '1.6', 'RAS', '2023-07-29 00:00:00', 1),
(40, '2023-07-29 00:00:00', 1.6, 1.3, 'Pas de modification de la dose', 'RAS', '2023-07-30 00:00:00', 1),
(41, '2023-07-30 00:00:00', 1.6, 1.3, '1.4', 'RAS', '2023-08-09 00:00:00', 1),
(42, '2023-08-09 00:00:00', 1.4, 1.9, '1.5', 'RAS', '2023-08-10 00:00:00', 1),
(43, '2023-08-10 00:00:00', 1.5, 2, 'Pas de modification de la dose', 'RAS', '2023-08-11 00:00:00', 1),
(44, '2023-08-11 00:00:00', 1.5, 2.1, 'Pas de modification de la dose', 'RAS', '2023-08-14 00:00:00', 1),
(45, '2023-08-14 00:00:00', 1.5, 2.7, '1.4', 'RAS', '2023-08-16 00:00:00', 1),
(46, '2023-08-16 00:00:00', 1.4, 2.8, 'Pas de modification de la dose', 'RAS', '2023-08-21 00:00:00', 1),
(47, '2023-08-21 00:00:00', 1.4, 2.3, '1.5', 'RAS', '2023-08-25 00:00:00', 1),
(48, '2023-08-25 00:00:00', 1.5, 2.9, 'Pas de modification de la dose', 'RAS', '2023-09-01 00:00:00', 1),
(49, '2023-09-01 00:00:00', 1.5, 3.5, 'Pas de modification de la dose', 'RAS', '2023-09-05 00:00:00', 1),
(50, '2023-09-05 00:00:00', 1.5, 3, 'Pas de modification de la dose', 'RAS', '2023-09-13 00:00:00', 1),
(51, '2023-09-17 00:00:00', 1.5, 4.5, '1.4', 'RAS', '2023-09-22 00:00:00', 1),
(52, '2023-09-22 00:00:00', 1.4, 4.2, '1.2', 'RAS', '2023-09-28 00:00:00', 1),
(53, '2023-09-28 00:00:00', 1.2, 3.4, 'Pas de modification de la dose', 'RAS', '2023-10-08 00:00:00', 1),
(54, '2023-10-08 00:00:00', 1.2, 3.1, 'Pas de modification de la dose', 'RAS', '2023-10-20 00:00:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `roles`, `password`) VALUES
(2, 'Mamadou', '[\"ROLE_USER\"]', '$2y$13$fiNEHg9pRICtPP30.Nr/bOowcEsOA77ztr8APN458OM.XU89FLmSG');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `blood_sampling`
--
ALTER TABLE `blood_sampling`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `blood_sampling`
--
ALTER TABLE `blood_sampling`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
