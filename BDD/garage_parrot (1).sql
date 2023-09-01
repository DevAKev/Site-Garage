-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 01 sep. 2023 à 14:22
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
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `title`, `description`, `picture`) VALUES
(1, 'Entretien & Mécanique', 'Notre équipe de mécaniciens expérimentés est à votre disposition pour réparer tout type de problème mécanique. Nous proposons une large gamme de services de réparation, quels que soient la marque et le modèle de votre véhicule.', 'Moteur-garage.jpg'),
(2, 'Carrosserie & Peinture', 'Nous prenons en charge la réparation et le redressement de la carrosserie de votre véhicule, pour lui redonner son aspect d\'origine. Vous êtes tout à fait libre de choisir votre réparateur, renseignez-vous auprès de votre assurance.', 'carrosserie.jpg'),
(3, 'test', 'TEST', '');

-- --------------------------------------------------------

--
-- Structure de la table `contact_messages`
--

DROP TABLE IF EXISTS `contact_messages`;
CREATE TABLE IF NOT EXISTS `contact_messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('lu','non lu') NOT NULL DEFAULT 'non lu',
  `objet` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `nom`, `prenom`, `email`, `phone_number`, `message`, `date`, `status`, `objet`) VALUES
(1, 'testA', 'TestA', 'test@test.com', '0123456789', 'TestA', '2023-08-15 12:13:37', 'non lu', NULL),
(7, 'TestG', 'TestG', 'TestG@gmail.com', '0123456789', 'TestG', '2023-08-15 17:35:43', 'lu', 'Demande d\'information pour Renault GT turbo (ID:100)'),
(8, 'TestG', 'TestG', 'TestG@gmail.com', '0123456789', 'TestG', '2023-08-15 17:37:55', 'non lu', 'Demande d\'information pour Renault GT turbo (ID:100)'),
(10, 'testH', 'testH', 'testH@test.com', '0123456789', 'testH', '2023-08-16 08:30:20', 'lu', 'Demande d\'information pour Audi A3 (ID:33)'),
(3, 'TestC', 'TestC', 'TestC@test.com', '0123456789', '                            TestC', '2023-08-15 13:28:25', 'lu', NULL),
(4, 'TestD', 'TestD', 'TestD@test.com', '0123456789', '                            TestD', '2023-08-15 13:33:23', 'lu', 'Demande d\'information pour Audi A3 (ID:33)');

-- --------------------------------------------------------

--
-- Structure de la table `customer_reviews`
--

DROP TABLE IF EXISTS `customer_reviews`;
CREATE TABLE IF NOT EXISTS `customer_reviews` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `commentaire` text NOT NULL,
  `note` int NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `customer_reviews`
--

INSERT INTO `customer_reviews` (`id`, `name`, `commentaire`, `note`, `publish`) VALUES
(1, 'Jean Dupont', 'Excellent service, personnel amical et compétent. Je recommande vivement le garage Parrot !', 5, 1),
(2, 'Marie M.', 'Non respect des délais annoncés. Les réparations sont trop lentes.', 2, 1),
(3, 'Pierre Dubois', 'Agréablement surpris par le professionnalisme du personnel. Prix raisonnables.', 4, 1),
(4, 'Sophie L.', 'Le garage indique avoir subi des vols sur leur parking et ma voiture a été endommagée !', 2, 1),
(5, 'Lucie Lambert', 'Service rapide et efficace. Le personnel est sympathique et compétent.', 5, 1),
(26, 'BOB', 'C\'est nul', 1, 0),
(45, 'Nadine', 'C\'est cool!', 4, 1);

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
(1, 'Lundi', '08:00:00', '12:00:00'),
(2, 'Lundi', '14:00:00', '18:30:00'),
(3, 'Mardi', '08:00:00', '12:00:00'),
(4, 'Mardi', '14:00:00', '18:30:00'),
(5, 'Mercredi', '08:00:00', '12:00:00'),
(6, 'Mercredi', '14:00:00', '18:30:00'),
(7, 'Jeudi', '08:00:00', '12:00:00'),
(8, 'Jeudi', '14:00:00', '18:30:00'),
(9, 'Vendredi', '08:00:00', '12:00:00'),
(10, 'Vendredi', '14:00:00', '18:30:00'),
(11, 'Samedi', '08:30:00', '14:30:00'),
(12, 'Dimanche', '00:00:00', '00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `categorie_id` int DEFAULT NULL,
  `mouvement` varchar(10) DEFAULT NULL,
  `lien_page` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `categorie_id` (`categorie_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`id`, `titre`, `description`, `image`, `categorie_id`, `mouvement`, `lien_page`) VALUES
(6, 'ENTRETIEN & MECANIQUE', 'Notre équipe de mécaniciens expérimentés est à votre disposition pour réparer tout type de problème mécanique. Nous proposons une large gamme de services de réparation, quels que soient la marque et le modèle de votre véhicule.', '64d3e257ca624_moteur-garage-jpg', 1, 'left', 'Prestations-reparations-mecaniques.php'),
(7, 'CARROSSERIE & PEINTURE', 'Nous prenons en charge la réparation et le redressement de la carrosserie de votre véhicule, pour lui redonner son aspect d\'origine. Vous êtes tout à fait libre de choisir votre réparateur, renseignez-vous auprès de votre assurance.', 'carrosserie.jpg', 2, 'center', 'Prestations-reparation-carrosserie-peinture.php'),
(8, 'NOS VEHICULES D\'OCCASIONS', 'Nous vous proposons des véhicules d\'origine d\'occasions réparés par nos soins et disponible immédiatement à l\'achat, vous avez la possibilité de prendre rendez-vous auprès de notre équipe afin de venir voir celui qui vous intéresse directement sur place.', 'hypercar.jpg', 3, 'right', 'cars.php');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `password_hash` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `last_connexion` datetime DEFAULT NULL,
  `role` enum('employe','administrateur') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `password_hash`, `email`, `nom`, `prenom`, `last_connexion`, `role`) VALUES
(33, '$2y$10$R63haC4H725xwrsG29/yBegNbaqlG1khvUroQvCZ6coeCOjt2hp.6', 'Vanessa@gmail.com', 'VANESSA-TATA', 'Vanessa', '2023-08-27 14:34:59', 'employe'),
(34, '$2y$10$gaQETdr.t2SKU64QJebu5O3wsTJtiSm6yNcwu7NyMG0r6nLPwd4qm', 'Dupont@gmail.com', 'Dupont', 'Jean-paul', '2023-08-13 11:49:04', 'employe'),
(6, '$2y$10$ehLLFFVdou88Az08VSxSUuvQfm65hacxuvPbulO1oc0uXfjN81NHO', 'John.doe@gmail.com', 'Doe', 'John', '2023-08-16 19:25:01', 'employe'),
(5, '$2y$10$zsDq7RmdxowlyBIzSyQ7He7R78HXdRfXbI1HSt8UHlrZFktxZmtX6', 'Vincent.parrot@gmail.com', 'Parrot', 'Vincent', '2023-08-27 14:53:00', 'administrateur'),
(14, '$2y$10$Pvya10R4xb5nI6hEWeAqAOCHHpvvfVJxB5cjPeOtY.cVIhfSdJfLa', 'jose@test.com', 'PINTO', 'JOSE', '2023-08-25 15:43:34', 'employe'),
(32, '$2y$10$yKT99cTVNeiO7jOm/KyW.ehfeHOx4TPQhwy3PIdefjcGlzlSJPPLK', 'TestI@test.com', 'TestI', 'TestI-TestI', '2023-08-13 11:48:23', 'employe'),
(45, '$2y$10$OCc7k73G4/LQ0zht0UYO8uZykoRXh0/n/A/a/jef1LizSGK9VTNZi', 'Sarah@gmail.com', 'Sanchez', 'Sarah', '2023-08-15 19:04:59', 'employe');

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
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `annee_mise_en_circulation` int NOT NULL,
  `kilometrage` int NOT NULL,
  `galerie_images` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `caracteristiques` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `equipements_options` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `carburant` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=102 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `vehicules`
--

INSERT INTO `vehicules` (`id`, `marque`, `modele`, `prix`, `image`, `annee_mise_en_circulation`, `kilometrage`, `galerie_images`, `caracteristiques`, `equipements_options`, `carburant`) VALUES
(34, 'Mercedes-Benz', 'Classe C', '17000', 'mercedes-benz-class-c-break.jpg', 2017, 60000, 'image1.jpg,image3.jpg,image4.jpg', 'Caractéristique 22\r\nCaractéristique 23\r\nCaractéristique 24', 'Option 22\r\nOption 23\r\nOption 24', 'Diesel'),
(33, 'Audi', 'A3', '14000', 'audi-a3.jpg', 2016, 75000, 'image2.jpg,image3.jpg,image4.jpg', 'Caractéristique 22\r\nCaractéristique 23\r\nCaractéristique 24', 'Option 19\r\nOption 20\r\nOption 21', 'Diesel'),
(32, 'BMW', 'Série 3', '19000', 'BMW Série 3.jpg', 2022, 55000, 'image1.jpg,image2.jpg,image4.jpg', 'Caractéristique 22\r\nCaractéristique 23\r\nCaractéristique 24', 'Option 16\r\nOption 17\r\nOption 18', 'essence'),
(31, 'Ford', 'Focus', '13000', 'Ford Focus.jpg', 2015, 80000, 'image1.jpg,image3.jpg,image4.jpg', 'Caractéristique 22\r\nCaractéristique 23\r\nCaractéristique 24', 'Option 13\r\nOption 14\r\nOption 15', 'Diesel'),
(30, 'Toyota', 'Corolla', '15000', '', 2022, 50000, 'image2.jpg,image3.jpg,image4.jpg', 'GPS\r\nSiège chauffant\r\nCaractéristique 24', 'Option 10\r\nOption 11\r\nOption 12', 'essence'),
(29, 'Volkswagen', 'Golf', '22000', 'Volkswagen-Golf.jpg', 2022, 45000, 'image1.jpg,image2.jpg,image4.jpg', 'Siège en cuir\r\nGPS\r\nCaractéristique 23\r\nCaractéristique 24', 'Option 7\r\nOption 8\r\nOption 9', 'diesel'),
(28, 'Peugeot', '208', '12000', 'peugeot-208.jpg', 2016, 70000, 'peugeot-208-2.jpg,image3.jpg,image4.jpg', 'Caractéristique 22\r\nCaractéristique 23\r\nCaractéristique 24', 'Option 4\r\nOption 5\r\nOption 6', 'Diesel'),
(27, 'Renault', 'Clio', '15000', 'Renault-Clio.jpg', 2018, 50000, 'image2.jpg,image3.jpg,image4.jpg', 'Caractéristique 22\r\nCaractéristique 23\r\nCaractéristique 24', 'Option 1\r\nOption 2\r\nOption 3', 'Diesel'),
(26, 'Audi', 'RS3', '38000', 'audi.jpg', 2018, 50000, 'image2.jpg,image3.jpg,image4.jpg', 'Audi V8 à 90°\r\n3,6 L, 40 soupapes\r\nCaractéristique 2\r\nCaractéristique 3', 'Option 1\r\nOption 2\r\nOption 3', 'Essence'),
(25, 'Tesla', 'Modele S', '40000', 'tesla.webp', 2022, 20000, 'audi-test.jpg,image3.jpg,image4.jpg', 'Tesla V8 à 90°\r\n3,6 L, 40 soupapes\r\nCaractéristique 2\r\nCaractéristique 3', 'Option 1\r\nOption 2\r\nOption 3', 'Electrique'),
(24, 'Ferrari', '360 Modena', '50000', 'ferrari-360-spyder.jpg', 2020, 50000, 'audi-rs6.jpg,audi-test.jpg,hypercar.jpg', 'Ferrari V8 à 90°\r\n3,6 L, 40 soupapes\r\nCaractéristique 2\r\nCaractéristique 3', 'Option 1\r\nOption 2\r\nOption 3', 'essence'),
(35, 'Nissan', 'Qashqai', '22000', '', 2018, 45000, 'image1.jpg,image2.jpg,image4.jpg', 'Caractéristique 25\r\nCaractéristique 26\r\nCaractéristique 27', 'Option 25\r\nOption 26\r\nOption 27', 'Diesel'),
(36, 'Opel', 'Corsa', '12000', 'Opel-Corsa.jpg', 2020, 100000, 'image2.jpg,image3.jpg,image4.jpg', 'Caractéristique 28\r\nCaractéristique 29\r\nCaractéristique 30', 'Option 28\r\nOption 29\r\nOption 30', 'Essence'),
(85, 'AUDItest', 'A3', '10000', '64b3f7187f31c_hypercar4-jpg', 2023, 100000, '64b3f71880586_hypercar-jpg,64b3f7189aad9_moteur-garage-jpg,64b3f7189b7f5_mustang-inscription-jpg', 'TEST', 'TEST', 'Diesel'),
(93, 'FFFFF', 'xxxx', '0', '64bbe597851c1_ferrari-2468015-1280-jpg', 2022, 10000, '64bbe5978dbbd_hypercar3-jpg,64bbe5978eb1f_hypercar4-jpg', 'XXXX', 'XXXX', 'essence'),
(94, 'AAAA', 'AAAAA', '7676', '64bbfafae824a_hypercar3-jpg', 2022, 67868, '64bbfafaece7d_carrosserie-jpg', 'GEZGEZ', 'EGEZG', 'essence'),
(101, 'Tracteur', 'Renault', '150000', '64dca7f65906a_tractor-jpg', 1980, 100000, '64dca7f665719_tractor-385681-1280-jpg', 'TEST', 'TEST', 'essence'),
(100, 'Renault', 'GT turbo', '10000', '64d7b662a6a80_renault-2942017-1280-jpg', 1990, 200000, '64d7b662b5647_oldtimer-1537007-1280-jpg', 'zetezt', 'teztze', 'Essence');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
