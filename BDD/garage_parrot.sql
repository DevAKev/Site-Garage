-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 08 juil. 2023 à 14:33
-- Version du serveur : 8.0.31
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `garage_parrot`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

DROP TABLE IF EXISTS `administrateur`;
CREATE TABLE IF NOT EXISTS `administrateur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`id`, `nom`, `prenom`, `email`, `role`, `password`) VALUES
(1, 'Parrot', 'Vincent', 'Vincent.parrot@gmail.com', 'administrateur', 'a9153492bcb2107856f0d4be70c3faf446297554'),
(2, 'Parrot', 'Vincent', 'vincent.parrot@gmail.com', 'administrateur', '$2y$10$poK21eAuNktYPoG2.L9aPOoRyhN3iNQXHR.jtTMn4n5I4BNKgk/Mm'),
(3, 'Parrot', 'Vincent', 'vincent.parrot@gmail.com', 'administrateur', '$2y$10$oTPmqww.L9LFUv2SbNzqGePXillmjzLkQl5lDxawb5jtrLQGTqiPO'),
(4, 'Parrot', 'Vincent', 'vincent.parrot@gmail.com', 'administrateur', '$2y$10$hBq2mGMV3RPJe59kAMu2N.3ezyMzvjFiaKhsfPCobf6c900PVuVFK'),
(5, 'Parrot', 'Vincent', 'vincent.parrot@gmail.com', 'administrateur', '$2y$10$lz5hpsKxTe.1kQmSh.SSWeEin/JRTm7NCHk7ojMKu3j4F5CcaNzuu'),
(6, 'Parrot', 'Vincent', 'vincent.parrot@gmail.com', 'administrateur', '$2y$10$YzQDUQxD9adYPE6T4qBRKe9QbPwF/.H37U4lBMvmNkUXZX8EcKl4u'),
(7, 'Parrot', 'Vincent', 'vincent.parrot@gmail.com', 'administrateur', '$2y$10$9gxWyuXIE3/JQ6j5ywx8HOlLrvfL/crC3Ji.b2o6r4.pr.oeiOd4O'),
(8, 'Parrot', 'Vincent', 'vincent.parrot@gmail.com', 'administrateur', '$2y$10$Q7KTSvCdMLity8w1WUUVs.tOoNvyRkfcW743gCnffxVk9vKGq1ZKG'),
(9, 'Parrot', 'Vincent', 'vincent.parrot@gmail.com', 'administrateur', '$2y$10$fEJnozGvIEJxu44JKdalCu0oY1nl1nLnZ48uMnKtUB2ZB1GWLaXmW'),
(10, 'Parrot', 'Vincent', 'vincent.parrot@gmail.com', 'administrateur', '$2y$10$wqDJpuoQ/jMX1H0Cw72LTupgusDb/fFF7CDkD3GNrOTwLqCbiZ4pu');

-- --------------------------------------------------------

--
-- Structure de la table `employés`
--

DROP TABLE IF EXISTS `employés`;
CREATE TABLE IF NOT EXISTS `employés` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `employés`
--

INSERT INTO `employés` (`id`, `nom`, `prenom`, `email`, `role`, `password`) VALUES
(1, 'Doe', 'John', 'john.doe@example.com', 'employé', '$2y$10$gbux20I6o5oLYWXM.zSB5OrlfU5/chhi638KMFORdWpKXfr2XK74O'),
(2, 'Doe', 'John', 'john.doe@example.com', 'employé', '$2y$10$LFnQDUSyUkpJOHR5IVSqyub1hT2EWY7gQ7Ots8XWfLJAzfsQXO9XO'),
(3, 'Doe', 'John', 'john.doe@example.com', 'employé', '$2y$10$PJ770vRNXfOamP8fzW/HK.Uxhokn2M3cCkvl0ifA394XPbd/BzTIm'),
(4, 'Doe', 'John', 'john.doe@example.com', 'employé', '$2y$10$jeWwe7Ombw93l5UxxDzRpuOy9GGXOEkYXlggGGL6B6v6RK85ocj56'),
(5, 'Doe', 'John', 'john.doe@example.com', 'employé', '$2y$10$f02ezgmwGcVkS55S9rEV.eEOhm6GtUSbBetRnDmTpynSMyyowrd3K'),
(6, 'Doe', 'John', 'john.doe@example.com', 'employé', '$2y$10$7Y5yaFg7aFBaCcH7Krf1xuH2mRizPhrFTnV/VMnI/1UgM3F6qWMfy'),
(7, 'Doe', 'John', 'john.doe@example.com', 'employé', '$2y$10$O7vXBxUHbtX5/a6EQywZ9eotnZhmvnXMMljmF.2SQR.Kwrzkamd2i');

-- --------------------------------------------------------

--
-- Structure de la table `schedules`
--

DROP TABLE IF EXISTS `schedules`;
CREATE TABLE IF NOT EXISTS `schedules` (
  `id` int NOT NULL AUTO_INCREMENT,
  `jour_semaine` varchar(20) NOT NULL,
  `heure_ouverture` time DEFAULT NULL,
  `heure_fermeture` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `schedules`
--

INSERT INTO `schedules` (`id`, `jour_semaine`, `heure_ouverture`, `heure_fermeture`) VALUES
(1, 'Lundi', '08:30:00', '12:00:00'),
(2, 'Lundi', '14:00:00', '18:30:00'),
(3, 'Mardi', '08:30:00', '12:00:00'),
(4, 'Mardi', '14:00:00', '18:30:00'),
(5, 'Mercredi', '08:30:00', '12:00:00'),
(6, 'Mercredi', '14:00:00', '18:30:00'),
(7, 'Jeudi', '08:30:00', '12:00:00'),
(8, 'Jeudi', '14:00:00', '18:30:00'),
(9, 'Vendredi', '08:30:00', '12:00:00'),
(10, 'Vendredi', '14:00:00', '18:30:00'),
(11, 'Samedi', '08:30:00', '14:00:00'),
(12, 'Dimanche', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `vehicules`
--

DROP TABLE IF EXISTS `vehicules`;
CREATE TABLE IF NOT EXISTS `vehicules` (
  `id` int NOT NULL AUTO_INCREMENT,
  `marque` varchar(50) NOT NULL,
  `modele` varchar(50) NOT NULL,
  `prix` decimal(10,0) NOT NULL,
  `image` varchar(255) NOT NULL,
  `annee_mise_en_circulation` int NOT NULL,
  `kilometrage` int NOT NULL,
  `galerie_images` text,
  `caracteristiques` text,
  `equipements_options` text,
  `carburant` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `vehicules`
--

INSERT INTO `vehicules` (`id`, `marque`, `modele`, `prix`, `image`, `annee_mise_en_circulation`, `kilometrage`, `galerie_images`, `caracteristiques`, `equipements_options`, `carburant`) VALUES
(34, 'Mercedes-Benz', 'Classe C', '17000', 'image8.jpg', 2017, 60000, 'image1.jpg,image3.jpg,image4.jpg', 'Caractéristique 22, Caractéristique 23, Caractéristique 24', 'Option 22, Option 23, Option 24', 'Diesel'),
(33, 'Audi', 'A3', '14000', 'image7.jpg', 2016, 75000, 'image2.jpg,image3.jpg,image4.jpg', 'Caractéristique 19, Caractéristique 20, Caractéristique 21', 'Option 19, Option 20, Option 21', 'Diesel'),
(32, 'BMW', 'Série 3', '19000', 'image6.jpg', 2017, 55000, 'image1.jpg,image2.jpg,image4.jpg', 'Caractéristique 16, Caractéristique 17, Caractéristique 18', 'Option 16, Option 17, Option 18', 'Diesel'),
(31, 'Ford', 'Focus', '13000', 'image5.jpg', 2015, 80000, 'image1.jpg,image3.jpg,image4.jpg', 'Caractéristique 13, Caractéristique 14, Caractéristique 15', 'Option 13, Option 14, Option 15', 'Diesel'),
(30, 'Toyota', 'Corolla', '9000', 'image4.jpg', 2019, 40000, 'image2.jpg,image3.jpg,image4.jpg', 'Caractéristique 10, Caractéristique 11, Caractéristique 12', 'Option 10, Option 11, Option 12', 'Hybride'),
(29, 'Volkswagen', 'Golf', '18000', 'image3.jpg', 2017, 60000, 'image1.jpg,image2.jpg,image4.jpg', 'Caractéristique 7, Caractéristique 8, Caractéristique 9', 'Option 7, Option 8, Option 9', 'Diesel'),
(28, 'Peugeot', '208', '12000', 'image2.jpg', 2016, 70000, 'image1.jpg,image3.jpg,image4.jpg', 'Caractéristique 4, Caractéristique 5, Caractéristique 6', 'Option 4, Option 5, Option 6', 'Diesel'),
(27, 'Renault', 'Clio', '15000', 'image1.jpg', 2018, 50000, 'image2.jpg,image3.jpg,image4.jpg', 'Caractéristique 1, Caractéristique 2, Caractéristique 3', 'Option 1, Option 2, Option 3', 'Diesel'),
(26, 'Audi', 'RS3', '38000', 'audi.jpg', 2018, 50000, 'image2.jpg,image3.jpg,image4.jpg', 'Audi V8 à 90°, 3,6 L, 40 soupapes, Caractéristique 2, Caractéristique 3', 'Option 1, Option 2, Option 3', 'Essence'),
(25, 'Tesla', 'Modele S', '40000', 'tesla.webp', 2022, 20000, 'image2.jpg,image3.jpg,image4.jpg', 'Tesla V8 à 90°, 3,6 L, 40 soupapes, Caractéristique 2, Caractéristique 3', 'Option 1, Option 2, Option 3', 'Electrique'),
(24, 'Ferrari', '360 Modena', '50000', 'ferrari-2468015_1280.jpg', 2020, 50000, 'image2.jpg,image3.jpg,image4.jpg', 'Ferrari V8 à 90°, 3,6 L, 40 soupapes, Caractéristique 2, Caractéristique 3', 'Option 1, Option 2, Option 3', 'Essence'),
(35, 'Nissan', 'Qashqai', '22000', 'image9.jpg', 2018, 45000, 'image1.jpg,image2.jpg,image4.jpg', 'Caractéristique 25, Caractéristique 26, Caractéristique 27', 'Option 25, Option 26, Option 27', 'Diesel'),
(36, 'Opel', 'Corsa', '12000', 'image10.jpg', 2015, 85000, 'image2.jpg,image3.jpg,image4.jpg', 'Caractéristique 28, Caractéristique 29, Caractéristique 30', 'Option 28, Option 29, Option 30', 'Essence');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
