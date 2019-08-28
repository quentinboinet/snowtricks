-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 26 août 2019 à 12:36
-- Version du serveur :  5.7.24
-- Version de PHP :  7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `snowtricks`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=235 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(230, 'Grab'),
(231, 'Rotation'),
(232, 'Flip'),
(233, 'Slide'),
(234, 'Old school');

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trick_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `published_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9474526CB281BE2E` (`trick_id`),
  KEY `IDX_9474526CA76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `trick_id`, `user_id`, `content`, `published_at`) VALUES
(108, 239, 145, 'Très simple ! Peut-être la plus simple de toutes.', '2019-08-19 13:11:56'),
(109, 238, 145, 'J\'ai mis 2 ans avant de la maîtriser entièrement. Vraiment pas une figure facile !', '2019-08-19 13:17:14');

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20190605144632', '2019-07-08 12:46:37'),
('20190605144929', '2019-07-08 12:46:38'),
('20190607132258', '2019-07-08 12:46:39'),
('20190612154514', '2019-07-08 12:46:39'),
('20190612154843', '2019-07-08 12:46:41'),
('20190613144723', '2019-07-08 12:46:42'),
('20190613144956', '2019-07-08 12:46:44'),
('20190614155612', '2019-07-08 12:46:44'),
('20190618142235', '2019-07-08 12:46:45'),
('20190701141033', '2019-07-08 12:46:46'),
('20190701141626', '2019-07-08 12:46:48'),
('20190701155814', '2019-07-08 12:46:49'),
('20190702125600', '2019-07-08 12:46:50'),
('20190704131749', '2019-07-08 12:46:52'),
('20190708123956', '2019-07-08 12:46:52'),
('20190708124152', '2019-07-08 12:46:53'),
('20190708124402', '2019-07-08 12:46:55'),
('20190709133716', '2019-07-09 13:39:56'),
('20190729134702', '2019-07-29 13:47:29'),
('20190731123024', '2019-07-31 12:31:07'),
('20190731124905', '2019-07-31 12:49:25');

-- --------------------------------------------------------

--
-- Structure de la table `password_token`
--

DROP TABLE IF EXISTS `password_token`;
CREATE TABLE IF NOT EXISTS `password_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expires_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BEAB6C24A76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `picture`
--

DROP TABLE IF EXISTS `picture`;
CREATE TABLE IF NOT EXISTS `picture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=147 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `picture`
--

INSERT INTO `picture` (`id`, `path`) VALUES
(129, '/images/uploads/5d5a941204470.jpeg'),
(130, '/images/uploads/5d5a94120527e.jpeg'),
(131, '/images/uploads/5d5a948041b99.jpeg'),
(132, '/images/uploads/5d5a9480435a4.jpeg'),
(133, '/images/uploads/5d5a948043e57.jpeg'),
(134, '/images/uploads/5d5a96073dc58.jpeg'),
(135, '/images/uploads/5d5a96073e4bb.jpeg'),
(136, '/images/uploads/5d5a96b89e87e.jpeg'),
(137, '/images/uploads/5d5a9754063fa.jpeg'),
(138, '/images/uploads/5d5a975408ab9.jpeg'),
(139, '/images/uploads/5d5a98c7d1b65.jpeg'),
(140, '/images/uploads/5d5a99b8d3b56.jpeg'),
(141, '/images/uploads/5d5a99b8d431d.jpeg'),
(142, '/images/uploads/5d5a9aa59c33b.jpeg'),
(143, '/images/uploads/5d5a9aa59d6e8.jpeg'),
(144, '/images/uploads/5d5a9bf743748.jpeg'),
(145, '/images/uploads/5d5a9bf744855.jpeg'),
(146, '/images/uploads/5d5aa07565c47.jpeg');

-- --------------------------------------------------------

--
-- Structure de la table `registration_token`
--

DROP TABLE IF EXISTS `registration_token`;
CREATE TABLE IF NOT EXISTS `registration_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expires_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D09D01D3A76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `registration_token`
--

INSERT INTO `registration_token` (`id`, `user_id`, `token`, `expires_at`) VALUES
(17, 163, '1da72dcbb427a44d75e88da2c730fa3496d44509c96b138e107a8efc3fa51f44972fae12a03467c1b230b0c9207c5dca4de29969a88a97ac53fb9e34', '2019-08-20 16:04:28');

-- --------------------------------------------------------

--
-- Structure de la table `trick`
--

DROP TABLE IF EXISTS `trick`;
CREATE TABLE IF NOT EXISTS `trick` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `published_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `author_name_id` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_D8F0A91E989D9B62` (`slug`),
  KEY `IDX_D8F0A91E342D0395` (`author_name_id`),
  KEY `IDX_D8F0A91E12469DE2` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=243 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `trick`
--

INSERT INTO `trick` (`id`, `name`, `slug`, `description`, `published_at`, `updated_at`, `author_name_id`, `category_id`) VALUES
(233, 'Tail grab', 'tail-grab', 'Un grab consiste à attraper la planche avec la main pendant le saut. Le verbe anglais to grab signifie « attraper. » \r\nLe tail grab consiste à saisir la partie arrière de la planche, avec sa main arrière.', '2019-08-19 12:20:33', '2019-08-19 12:20:33', 145, 230),
(234, 'Mute grab', 'mute-grab', 'Un grab consiste à attraper la planche avec la main pendant le saut. Le verbe anglais to grab signifie « attraper. » \r\nLe mute grab est la saisie de la carre frontside de la planche entre les deux pieds avec la main avant.', '2019-08-19 12:22:24', '2019-08-19 12:22:24', 145, 230),
(235, 'Frontside 360', 'frontside-360', 'On désigne par le mot « rotation » uniquement des rotations horizontales. Le principe est d\'effectuer une rotation horizontale pendant le saut, puis d\'attérir en position switch ou normal. \r\nLe frontside 360 consiste à réaliser un tour entier, soit 360 degrès.', '2019-08-19 12:25:21', '2019-08-19 12:25:21', 145, 231),
(236, 'Backflip', 'backflip', 'Il consiste à réaliser un salto arrière. Concrètement, afin de le réaliser, vous devez lancer votre têtes (et épaules) en arrière en essayant le plus vite possible d’avoir un contact visuel avec votre réception. Au moment du pop (qui doit impérativement se faire au dernier moment, c’est-à-dire sur l’arrête du kicker), pensez à donner un bon coup de bassin pour essayer de monter vos hanches vers le haut. Cela vous permettra de réaliser un beau backflip dit « laid out », autrement dit, allongé. \r\nAttention, la synchronisation du pop et du déséquilibre arrière est extrêmement importante pour garder au mieux le contrôle dans votre backflip. Comme vous pourrez le voir, il est essentiel de vite voir votre réception afin de savoir quand déplier votre backflip, et ainsi, contrôler au mieux votre rotation. Ce qu’il faut à tout pris éviter c’est de underrotate (ne pas tourner assez) ou d’overrorate (tourner trop et partir sur 1,5 backflip par exemple).', '2019-08-19 12:28:55', '2019-08-19 12:28:55', 145, 232),
(237, 'Sideflip/Lincoln', 'sideflip-lincoln', 'Le sideflip en ski freestyle est une figure relativement simple à réaliser. Il s’agît simplement de réaliser un flip sur le côté (d’où « side »). Vous devrez donc sauter en lançant votre corps vers la droite ou vers la gauche (selon votre préférence) et essayer au maximum de cruncher (plier) votre corps pour contrôler au mieux votre rotation.', '2019-08-19 12:31:52', '2019-08-19 12:31:52', 145, 232),
(238, 'Rodeo', 'rodeo', 'Ce flip consiste à réaliser à la fois un backflip et une rotation (180, 360,540,…).\r\nAfin de le réaliser, vous devrez lancer votre rotation de côté et légèrement en arrière.', '2019-08-19 12:34:28', '2019-08-19 12:34:40', 145, 232),
(239, 'Slide 50-50', 'slide-50-50', 'Ce slide est une figure facile à apprendre et très bien pour débuter.\r\nIl s\'agit simplement de se laisser glisser sur le module de slide que l\'on aborde.', '2019-08-19 12:40:39', '2019-08-19 12:40:39', 145, 233),
(240, 'Method Air', 'method-air', 'Cette figure – qui consiste à attraper sa planche d\'une main et le tourner perpendiculairement au sol – est un classique \"old school\". Il n\'empêche qu\'il est indémodable, avec de vrais ambassadeurs comme Jamie Lynn ou la star Terje Haakonsen. En 2007, ce dernier a même battu le record du monde du \"air\" le plus haut en s\'élevant à 9,8 mètres au-dessus du kick (sommet d\'un mur d\'une rampe ou autre structure de saut).', '2019-08-19 12:44:40', '2019-08-19 12:44:40', 145, 234),
(241, 'Rocket air', 'rocket-air', 'Cette figure, catégorisée de \"old school\" est réalisée avec la main avant qui attrape la carre front devant la fix avant (mute), la jambe arrière est tendue et la board est perpendiculaire au sol.\r\n', '2019-08-19 12:48:37', '2019-08-19 12:48:37', 145, 234),
(242, 'Backside triple cork 1440', 'backside-triple-cork-1440', 'En langage snowboard, un cork est une rotation horizontale plus ou moins désaxée, selon un mouvement d\'épaules effectué juste au moment du saut. Le tout premier Triple Cork a été plaqué par Mark McMorris en 2011, lequel a récidivé lors des Winter X Games 2012... avant de se faire voler la vedette par Torstein Horgmo, lors de ce même championnat. Le Norvégien réalisa son propre Backside Triple Cork 1440 et obtint la note parfaite de 50/50.', '2019-08-19 12:54:15', '2019-08-19 12:54:15', 145, 232);

-- --------------------------------------------------------

--
-- Structure de la table `trick_picture`
--

DROP TABLE IF EXISTS `trick_picture`;
CREATE TABLE IF NOT EXISTS `trick_picture` (
  `trick_id` int(11) NOT NULL,
  `picture_id` int(11) NOT NULL,
  PRIMARY KEY (`trick_id`,`picture_id`),
  KEY `IDX_758636D1B281BE2E` (`trick_id`),
  KEY `IDX_758636D1EE45BDBF` (`picture_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `trick_picture`
--

INSERT INTO `trick_picture` (`trick_id`, `picture_id`) VALUES
(233, 129),
(233, 130),
(234, 131),
(234, 132),
(234, 133),
(236, 134),
(236, 135),
(237, 136),
(238, 137),
(238, 138),
(239, 139),
(240, 140),
(240, 141),
(241, 142),
(241, 143),
(242, 144),
(242, 145);

-- --------------------------------------------------------

--
-- Structure de la table `trick_video`
--

DROP TABLE IF EXISTS `trick_video`;
CREATE TABLE IF NOT EXISTS `trick_video` (
  `trick_id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL,
  PRIMARY KEY (`trick_id`,`video_id`),
  KEY `IDX_B7E8DA93B281BE2E` (`trick_id`),
  KEY `IDX_B7E8DA9329C1004E` (`video_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `trick_video`
--

INSERT INTO `trick_video` (`trick_id`, `video_id`) VALUES
(235, 125),
(236, 126),
(238, 127),
(238, 128),
(239, 129),
(240, 130),
(241, 131),
(242, 132);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `profile_picture_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`),
  KEY `IDX_8D93D649292E8AE2` (`profile_picture_id`)
) ENGINE=InnoDB AUTO_INCREMENT=164 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `roles`, `email`, `last_name`, `first_name`, `password`, `status`, `profile_picture_id`) VALUES
(132, 'dummy_user0', '[]', 'dummy_user0@gmail.com', 'Gottlieb', 'Elyse', '$2y$13$UE7lGqeGJ1aUCQDDAvaUBuChw1B3bA5UcQDIhD5iPn7wPexZh5zqO', 1, NULL),
(133, 'dummy_user1', '[]', 'dummy_user1@gmail.com', 'Olson', 'Austin', '$2y$13$zqPWKtbsTANeaaSVxsrHHeHEgxZGHabPn6yfOnis9dLEOmb9Nv7nm', 1, NULL),
(134, 'dummy_user2', '[]', 'dummy_user2@gmail.com', 'Ankunding', 'Golden', '$2y$13$3M58Q23tNaUpQXmxkTYzX.DIZiBRAIJMef91C71BDHG9Bfzvgyati', 1, NULL),
(135, 'dummy_user3', '[]', 'dummy_user3@gmail.com', 'Harris', 'Robert', '$2y$13$2Hj9.chpHY0S.xyU0w5igeJs2cWyL7Ir283nmwDK51LAbITtLgrMi', 1, NULL),
(136, 'dummy_user4', '[]', 'dummy_user4@gmail.com', 'McGlynn', 'Alexanne', '$2y$13$P4tLS7CLOtuO27kWpk/CReyroNIzyjYGu3tiJg0QM7PdZokLYeQQK', 1, NULL),
(137, 'dummy_user5', '[]', 'dummy_user5@gmail.com', 'Schoen', 'Cecelia', '$2y$13$DmI5C8POXEVJr/KztZt3YOpS1VaUoiL.Jef0nTRIZIlJK/6hw7M7C', 1, NULL),
(138, 'dummy_user6', '[]', 'dummy_user6@gmail.com', 'Kshlerin', 'Jessy', '$2y$13$no0Yx6JKnefcePUjUXsqTOaDlVjkyZiNQ6gjY6PZScrLvqlbHCZu.', 1, NULL),
(139, 'dummy_user7', '[]', 'dummy_user7@gmail.com', 'Rutherford', 'Danika', '$2y$13$nClBXsNrqHOxo0/TJJlRUeY4o22IiDg8XqtPMBasdMqveaW2emqR.', 1, NULL),
(140, 'dummy_user8', '[]', 'dummy_user8@gmail.com', 'Lynch', 'Aubrey', '$2y$13$Bs2LaN/.gZ3mLQY1G4GJZOrzZT/oArvoe9L53ntolk8NPmYpDRuyi', 1, NULL),
(141, 'dummy_user9', '[]', 'dummy_user9@gmail.com', 'Wehner', 'Aniyah', '$2y$13$bmFZiQv7TLZtAl5G1zEL8uZ7tGcVlQhdhM3MOYRl9sANrCUncvqbu', 1, NULL),
(142, 'admin_user0', '[\"ROLE_ADMIN\"]', 'admin_user0@gmail.com', 'Reichert', 'Domenick', '$2y$13$oXwpAptL6gb7ecxWhnQXO.msOQ/VqaP1hxnzWRVLKKs3jc8s4iDna', 1, NULL),
(143, 'admin_user1', '[\"ROLE_ADMIN\"]', 'admin_user1@gmail.com', 'Spencer', 'Milan', '$2y$13$Yq9zjOWoeL1ita9KYztb/ei4PefHrmjkcRaVrh4k5ZXdlL2B09f.W', 1, NULL),
(144, 'admin_user2', '[\"ROLE_ADMIN\"]', 'admin_user2@gmail.com', 'O\'Hara', 'Jerad', '$2y$13$kSIoSqWBjIbVGw7DdbvPLee1OQk5WOaJiXm1GA9ohPq7D0KUAAvwi', 1, NULL),
(145, 'quentinboinet', '[]', 'quentinboinet@live.fr', 'Boinet', 'Quentin', '$2y$13$d/P//0rGvcxIRSEnOv67Ku.6aBFBy4N3dCKjuqI5LtfVV7Wob2wYO', 1, 146),
(163, 'quentin', '[]', 'quentin@activup.net', NULL, NULL, '$2y$13$dGsdZ67PXiKXlMyaCrJK...D9R8kJgZy94LyESpuxEC9iINx9Oop.', 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `video`
--

DROP TABLE IF EXISTS `video`;
CREATE TABLE IF NOT EXISTS `video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `video`
--

INSERT INTO `video` (`id`, `url`) VALUES
(125, 'https://www.youtube.com/embed/9T5AWWDxYM4'),
(126, 'https://www.youtube.com/embed/Q_R3yJLuMZw'),
(127, 'https://www.youtube.com/embed/vf9Z05XY79A'),
(128, 'https://www.youtube.com/embed/u5UNlhdNNTg'),
(129, 'https://www.youtube.com/embed/kxZbQGjSg4w'),
(130, 'https://www.youtube.com/embed/2Ul5P-KucE8'),
(131, 'https://www.youtube.com/embed/nom7QBoGh5w'),
(132, 'https://www.youtube.com/embed/Br6ZJM01I6s');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_9474526CB281BE2E` FOREIGN KEY (`trick_id`) REFERENCES `trick` (`id`);

--
-- Contraintes pour la table `password_token`
--
ALTER TABLE `password_token`
  ADD CONSTRAINT `FK_BEAB6C24A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `registration_token`
--
ALTER TABLE `registration_token`
  ADD CONSTRAINT `FK_D09D01D3A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `trick`
--
ALTER TABLE `trick`
  ADD CONSTRAINT `FK_D8F0A91E12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `FK_D8F0A91E342D0395` FOREIGN KEY (`author_name_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `trick_picture`
--
ALTER TABLE `trick_picture`
  ADD CONSTRAINT `FK_758636D1B281BE2E` FOREIGN KEY (`trick_id`) REFERENCES `trick` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_758636D1EE45BDBF` FOREIGN KEY (`picture_id`) REFERENCES `picture` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `trick_video`
--
ALTER TABLE `trick_video`
  ADD CONSTRAINT `FK_B7E8DA9329C1004E` FOREIGN KEY (`video_id`) REFERENCES `video` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_B7E8DA93B281BE2E` FOREIGN KEY (`trick_id`) REFERENCES `trick` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D649292E8AE2` FOREIGN KEY (`profile_picture_id`) REFERENCES `picture` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
