-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 15 août 2019 à 15:37
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
) ENGINE=InnoDB AUTO_INCREMENT=240 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(230, 'Transportation and Material-Moving'),
(231, 'Postal Service Clerk'),
(232, 'Municipal Court Clerk'),
(233, 'Medical Records Technician'),
(234, 'Civil Drafter'),
(235, 'Computer Hardware Engineer'),
(236, 'Plating Operator OR Coating Machine Operator'),
(237, 'Dot Etcher'),
(238, 'Multi-Media Artist'),
(239, 'Automotive Specialty Technician');

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
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `trick_id`, `user_id`, `content`, `published_at`) VALUES
(2, 188, 140, 'Consequatur quod sed sed autem facere.', '2019-05-31 14:13:44'),
(3, 215, 138, 'Architecto ipsam et expedita neque cum.', '2019-06-28 14:13:44'),
(4, 218, 136, 'A qui pariatur aut magnam.', '2019-04-28 14:13:44'),
(5, 188, 132, 'Similique non error quod.', '2019-05-12 14:13:44'),
(6, 209, 138, 'Deleniti iusto quas dolor rerum quam maxime.', '2019-04-03 14:13:44'),
(8, 183, 134, 'Optio animi repudiandae in sit.', '2019-06-02 14:13:44'),
(9, 189, 136, 'Odit et provident corrupti placeat.', '2019-05-14 14:13:44'),
(11, 177, 141, 'Voluptatem ut architecto voluptas sit explicabo et.', '2019-06-18 14:13:44'),
(12, 177, 133, 'Molestiae neque quae quod error minus ut sequi.', '2019-05-21 14:13:44'),
(14, 216, 132, 'Aut quo incidunt iusto eos nostrum sed necessitatibus.', '2019-05-21 14:13:44'),
(15, 214, 138, 'Voluptatem error nesciunt assumenda natus aliquam architecto nostrum nostrum.', '2019-05-27 14:13:44'),
(16, 196, 141, 'Voluptas maiores explicabo quasi voluptatem.', '2019-04-20 14:13:44'),
(19, 194, 135, 'Sunt reprehenderit aliquid et est quod.', '2019-06-17 14:13:44'),
(20, 178, 133, 'Mollitia aut quod consequuntur eum accusamus.', '2019-06-11 14:13:44'),
(21, 208, 140, 'Ipsum veniam in blanditiis rem.', '2019-04-12 14:13:44'),
(22, 189, 138, 'Voluptatem omnis ducimus quidem sed voluptates.', '2019-06-17 14:13:44'),
(23, 213, 135, 'Aut dicta laboriosam ipsa illo.', '2019-04-14 14:13:44'),
(24, 175, 140, 'Minus ipsum rem ipsa soluta veniam necessitatibus iure.', '2019-06-24 14:13:44'),
(25, 186, 138, 'Eius omnis et sit sit sint.', '2019-06-01 14:13:44'),
(26, 213, 135, 'Aut sed sed maiores officiis qui error aliquam perspiciatis.', '2019-06-07 14:13:44'),
(27, 189, 133, 'Voluptas dolores sequi molestias voluptate.', '2019-05-15 14:13:44'),
(29, 213, 133, 'Voluptate distinctio quo eius eius culpa sint corrupti et.', '2019-07-04 14:13:44'),
(30, 208, 132, 'Pariatur facilis a explicabo praesentium.', '2019-05-11 14:13:44'),
(32, 208, 139, 'Ipsum eaque aliquam et reiciendis officiis ut.', '2019-05-31 14:13:44'),
(34, 224, 136, 'Amet consequatur tempore suscipit et facere.', '2019-04-02 14:13:44'),
(35, 178, 135, 'Molestiae enim ducimus aut.', '2019-05-17 14:13:44'),
(37, 195, 134, 'Aliquid quo numquam molestias sequi.', '2019-05-04 14:13:44'),
(38, 202, 139, 'Veritatis aut vel magnam dolorem dolores animi et.', '2019-06-18 14:13:44'),
(39, 224, 140, 'Vero earum ut ut amet perspiciatis maiores.', '2019-06-29 14:13:44'),
(40, 209, 134, 'Aliquam nemo nisi mollitia vitae eum.', '2019-04-06 14:13:44'),
(41, 186, 136, 'Velit ut libero ut cupiditate inventore est.', '2019-04-11 14:13:44'),
(44, 208, 135, 'Architecto reprehenderit est deleniti id qui dolorum qui.', '2019-05-14 14:13:44'),
(47, 202, 135, 'Vitae modi aut eligendi ut veniam exercitationem reiciendis.', '2019-05-24 14:13:44'),
(48, 192, 139, 'Porro culpa enim at pariatur quam eos quis.', '2019-05-24 14:13:44'),
(50, 175, 140, 'Aspernatur modi magni aliquid enim.', '2019-04-01 14:13:44'),
(51, 188, 137, 'Fugiat velit nesciunt aut id.', '2019-06-04 14:13:44'),
(53, 204, 132, 'Magni ut sed sequi omnis enim sunt.', '2019-05-19 14:13:44'),
(54, 197, 133, 'Explicabo incidunt et est.', '2019-05-28 14:13:44'),
(55, 208, 140, 'Dicta et sint fugiat esse expedita.', '2019-04-09 14:13:44'),
(58, 220, 137, 'Voluptas voluptas omnis sed et quidem ratione ullam.', '2019-07-05 14:13:44'),
(59, 217, 134, 'Maxime aliquid voluptas ut possimus aspernatur eum repellat.', '2019-06-07 14:13:44'),
(60, 214, 135, 'Quibusdam earum voluptas aut.', '2019-04-25 14:13:44'),
(62, 215, 138, 'Ex aut ut temporibus ullam repellendus.', '2019-04-18 14:13:44'),
(63, 209, 140, 'Occaecati qui iusto molestiae rerum vel aut consequatur.', '2019-05-15 14:13:44'),
(64, 181, 135, 'Neque omnis eos quia possimus consectetur.', '2019-05-29 14:13:44'),
(65, 213, 141, 'Omnis sed quam odit.', '2019-06-23 14:13:44'),
(66, 188, 135, 'Magni aliquid consequatur ex qui sit.', '2019-06-23 14:13:44'),
(67, 223, 132, 'Ut recusandae quisquam dolore ex.', '2019-06-08 14:13:44'),
(69, 216, 137, 'Laborum consequuntur laudantium aspernatur distinctio.', '2019-06-12 14:13:44'),
(70, 215, 135, 'Vitae aut quia reprehenderit architecto laborum hic sequi.', '2019-05-27 14:13:44'),
(71, 213, 133, 'Nemo odio blanditiis sint vel ut.', '2019-05-27 14:13:44'),
(72, 217, 135, 'Velit eos ratione omnis nihil in ut.', '2019-04-30 14:13:44'),
(73, 224, 139, 'Quia ut magnam laudantium ut et sit.', '2019-04-01 14:13:44'),
(74, 188, 138, 'Sit incidunt explicabo sunt.', '2019-04-21 14:13:44'),
(75, 194, 133, 'Perferendis eum ut mollitia itaque vel sapiente ab.', '2019-04-10 14:13:44'),
(76, 215, 132, 'Distinctio et officia ipsa aspernatur omnis voluptas consequuntur.', '2019-06-24 14:13:44'),
(77, 218, 137, 'Quia velit inventore qui ea blanditiis.', '2019-04-28 14:13:44'),
(78, 212, 135, 'Ullam ex aut dolore accusamus.', '2019-06-30 14:13:44'),
(79, 214, 141, 'Necessitatibus et et ut blanditiis.', '2019-04-03 14:13:44'),
(80, 189, 136, 'Odit soluta praesentium natus.', '2019-04-20 14:13:44'),
(81, 208, 135, 'Molestias nam laudantium et illum distinctio modi ipsa harum.', '2019-06-09 14:13:44'),
(82, 188, 139, 'Voluptatem et et porro velit consectetur.', '2019-04-20 14:13:44'),
(83, 209, 136, 'Rem aperiam odit qui.', '2019-04-03 14:13:44'),
(84, 204, 141, 'Et ducimus necessitatibus ad aut similique quia.', '2019-05-14 14:13:44'),
(85, 175, 137, 'Dolor laborum ipsum et quia velit ab.', '2019-05-18 14:13:44'),
(86, 215, 132, 'Consequatur qui cum modi quia rerum numquam temporibus.', '2019-04-06 14:13:44'),
(87, 199, 141, 'Quis ut culpa exercitationem sint qui placeat qui.', '2019-05-17 14:13:44'),
(88, 203, 133, 'Quia qui est est.', '2019-07-02 14:13:44'),
(89, 203, 136, 'Nobis doloremque culpa voluptas aliquam cupiditate minus.', '2019-06-23 14:13:44'),
(90, 215, 138, 'Sunt inventore totam dignissimos ratione est aliquid hic.', '2019-06-17 14:13:44'),
(91, 189, 132, 'Odit voluptate maiores corrupti corrupti.', '2019-06-08 14:13:44'),
(92, 177, 138, 'Velit fugit qui omnis quam quasi quia commodi accusamus.', '2019-05-19 14:13:44'),
(93, 199, 132, 'Repellat voluptas est quod quisquam ut.', '2019-06-01 14:13:44'),
(94, 179, 134, 'Blanditiis autem omnis illo consequatur qui corrupti.', '2019-05-22 14:13:44'),
(95, 221, 137, 'Sapiente in hic sed.', '2019-04-21 14:13:44'),
(96, 183, 136, 'Odio dolorem molestias dolorum labore voluptas dolore.', '2019-05-06 14:13:44'),
(97, 196, 141, 'Et repudiandae et saepe repellat.', '2019-05-16 14:13:44'),
(99, 199, 141, 'Rerum asperiores quidem quisquam rem necessitatibus ut quae.', '2019-05-07 14:13:44'),
(100, 197, 134, 'Aut sapiente voluptatem dignissimos consequatur qui enim iste.', '2019-05-03 14:13:44'),
(105, 213, 145, 'Voila', '2019-07-30 10:19:39'),
(106, 213, NULL, 'Test', '2019-07-31 12:25:43'),
(107, 189, 145, 'Test', '2019-07-31 12:51:46');

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
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `picture`
--

INSERT INTO `picture` (`id`, `path`) VALUES
(115, '/images/uploads/5d2d9c95a45c8.jpeg'),
(118, '/images/uploads/5d372dfe334ef.jpeg'),
(122, '/images/uploads/5d41a2f727d49.jpeg'),
(125, '/images/uploads/5d41a1601d9d7.jpeg'),
(127, '/images/uploads/5d41a1607370b.jpeg'),
(128, '/images/uploads/5d43edfa803f3.jpeg');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=233 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `trick`
--

INSERT INTO `trick` (`id`, `name`, `slug`, `description`, `published_at`, `updated_at`, `author_name_id`, `category_id`) VALUES
(175, 'Backflip-0', 'backflip-0', '    Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,\r\n    lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit\r\n    labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow\r\n    **turkey** shank eu pork belly meatball non cupim.\r\n    Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur\r\n    laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,\r\n    capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing\r\n    picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt\r\n    occaecat lorem meatball prosciutto quis strip steak.\r\n    Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak\r\n    mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon\r\n    strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur\r\n    cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck\r\n    fugiat.', '2019-05-21 14:13:44', '2019-05-21 14:13:44', 140, 239),
(177, 'Backflip-2', 'backflip-2', '    Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,\r\n    lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit\r\n    labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow\r\n    **turkey** shank eu pork belly meatball non cupim.\r\n    Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur\r\n    laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,\r\n    capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing\r\n    picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt\r\n    occaecat lorem meatball prosciutto quis strip steak.\r\n    Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak\r\n    mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon\r\n    strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur\r\n    cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck\r\n    fugiat.', '2019-05-23 14:13:44', '2019-05-23 14:13:44', 135, 235),
(178, 'Backflip-3', 'backflip-3', '    Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,\r\n    lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit\r\n    labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow\r\n    **turkey** shank eu pork belly meatball non cupim.\r\n    Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur\r\n    laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,\r\n    capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing\r\n    picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt\r\n    occaecat lorem meatball prosciutto quis strip steak.\r\n    Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak\r\n    mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon\r\n    strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur\r\n    cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck\r\n    fugiat.', '2019-06-13 14:13:44', '2019-04-27 14:13:44', 140, 236),
(179, 'Backflip-4', 'backflip-4', '    Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,\r\n    lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit\r\n    labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow\r\n    **turkey** shank eu pork belly meatball non cupim.\r\n    Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur\r\n    laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,\r\n    capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing\r\n    picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt\r\n    occaecat lorem meatball prosciutto quis strip steak.\r\n    Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak\r\n    mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon\r\n    strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur\r\n    cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck\r\n    fugiat.', '2019-05-05 14:13:44', '2019-06-16 14:13:44', 140, 237),
(180, 'Backflip-5', 'backflip-5', '    Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,\r\n    lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit\r\n    labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow\r\n    **turkey** shank eu pork belly meatball non cupim.\r\n    Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur\r\n    laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,\r\n    capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing\r\n    picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt\r\n    occaecat lorem meatball prosciutto quis strip steak.\r\n    Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak\r\n    mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon\r\n    strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur\r\n    cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck\r\n    fugiat.', '2019-05-06 14:13:44', '2019-04-09 14:13:44', 138, 230),
(181, 'Backflip-6', 'backflip-6', '    Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,\r\n    lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit\r\n    labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow\r\n    **turkey** shank eu pork belly meatball non cupim.\r\n    Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur\r\n    laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,\r\n    capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing\r\n    picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt\r\n    occaecat lorem meatball prosciutto quis strip steak.\r\n    Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak\r\n    mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon\r\n    strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur\r\n    cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck\r\n    fugiat.', '2019-05-01 14:13:44', '2019-04-08 14:13:44', 135, 238),
(182, 'Backflip-7', 'backflip-7', '    Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,\r\n    lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit\r\n    labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow\r\n    **turkey** shank eu pork belly meatball non cupim.\r\n    Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur\r\n    laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,\r\n    capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing\r\n    picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt\r\n    occaecat lorem meatball prosciutto quis strip steak.\r\n    Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak\r\n    mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon\r\n    strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur\r\n    cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck\r\n    fugiat.', '2019-06-29 14:13:44', '2019-05-11 14:13:44', 135, 233),
(183, 'Backflip-8', 'backflip-8', '    Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,\r\n    lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit\r\n    labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow\r\n    **turkey** shank eu pork belly meatball non cupim.\r\n    Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur\r\n    laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,\r\n    capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing\r\n    picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt\r\n    occaecat lorem meatball prosciutto quis strip steak.\r\n    Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak\r\n    mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon\r\n    strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur\r\n    cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck\r\n    fugiat.', '2019-04-12 14:13:44', '2019-04-16 14:13:44', 137, 233),
(184, 'Backflip-9', 'backflip-9', '    Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,\r\n    lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit\r\n    labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow\r\n    **turkey** shank eu pork belly meatball non cupim.\r\n    Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur\r\n    laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,\r\n    capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing\r\n    picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt\r\n    occaecat lorem meatball prosciutto quis strip steak.\r\n    Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak\r\n    mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon\r\n    strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur\r\n    cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck\r\n    fugiat.', '2019-06-19 14:13:44', '2019-05-02 14:13:44', 134, 239),
(186, 'Backflip-11', 'backflip-11', '    Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,\r\n    lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit\r\n    labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow\r\n    **turkey** shank eu pork belly meatball non cupim.\r\n    Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur\r\n    laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,\r\n    capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing\r\n    picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt\r\n    occaecat lorem meatball prosciutto quis strip steak.\r\n    Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak\r\n    mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon\r\n    strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur\r\n    cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck\r\n    fugiat.', '2019-05-27 14:13:44', '2019-04-22 14:13:44', 141, 235),
(187, 'Backflip-12', 'backflip-12', '    Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,\r\n    lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit\r\n    labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow\r\n    **turkey** shank eu pork belly meatball non cupim.\r\n    Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur\r\n    laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,\r\n    capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing\r\n    picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt\r\n    occaecat lorem meatball prosciutto quis strip steak.\r\n    Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak\r\n    mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon\r\n    strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur\r\n    cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck\r\n    fugiat.', '2019-04-14 14:13:44', '2019-06-30 14:13:44', 132, 232),
(188, 'Backflip-13', 'backflip-13', '    Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,\r\n    lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit\r\n    labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow\r\n    **turkey** shank eu pork belly meatball non cupim.\r\n    Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur\r\n    laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,\r\n    capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing\r\n    picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt\r\n    occaecat lorem meatball prosciutto quis strip steak.\r\n    Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak\r\n    mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon\r\n    strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur\r\n    cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck\r\n    fugiat.', '2019-04-13 14:13:44', '2019-05-10 14:13:44', 134, 236),
(189, 'Backflip-14', 'backflip-14', '    Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,\r\n    lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit\r\n    labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow\r\n    **turkey** shank eu pork belly meatball non cupim.\r\n    Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur\r\n    laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,\r\n    capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing\r\n    picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt\r\n    occaecat lorem meatball prosciutto quis strip steak.\r\n    Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak\r\n    mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon\r\n    strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur\r\n    cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck\r\n    fugiat.', '2019-05-16 14:13:44', '2019-06-28 14:13:44', 139, 239),
(192, 'Backflip-17', 'backflip-17', '    Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,\r\n    lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit\r\n    labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow\r\n    **turkey** shank eu pork belly meatball non cupim.\r\n    Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur\r\n    laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,\r\n    capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing\r\n    picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt\r\n    occaecat lorem meatball prosciutto quis strip steak.\r\n    Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak\r\n    mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon\r\n    strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur\r\n    cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck\r\n    fugiat.', '2019-04-03 14:13:44', '2019-04-13 14:13:44', 133, 235),
(193, 'Backflip-18', 'backflip-18', '    Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,\r\n    lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit\r\n    labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow\r\n    **turkey** shank eu pork belly meatball non cupim.\r\n    Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur\r\n    laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,\r\n    capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing\r\n    picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt\r\n    occaecat lorem meatball prosciutto quis strip steak.\r\n    Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak\r\n    mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon\r\n    strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur\r\n    cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck\r\n    fugiat.', '2019-06-08 14:13:44', '2019-04-24 14:13:44', 132, 233),
(194, 'Backflip-19', 'backflip-19', '    Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,\r\n    lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit\r\n    labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow\r\n    **turkey** shank eu pork belly meatball non cupim.\r\n    Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur\r\n    laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,\r\n    capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing\r\n    picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt\r\n    occaecat lorem meatball prosciutto quis strip steak.\r\n    Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak\r\n    mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon\r\n    strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur\r\n    cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck\r\n    fugiat.', '2019-05-12 14:13:44', '2019-05-27 14:13:44', 138, 235),
(195, 'Backflip-20', 'backflip-20', '    Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,\r\n    lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit\r\n    labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow\r\n    **turkey** shank eu pork belly meatball non cupim.\r\n    Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur\r\n    laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,\r\n    capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing\r\n    picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt\r\n    occaecat lorem meatball prosciutto quis strip steak.\r\n    Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak\r\n    mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon\r\n    strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur\r\n    cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck\r\n    fugiat.', '2019-06-23 14:13:44', '2019-04-27 14:13:44', 137, 230),
(196, 'Backflip-21', 'backflip-21', '    Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,\r\n    lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit\r\n    labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow\r\n    **turkey** shank eu pork belly meatball non cupim.\r\n    Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur\r\n    laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,\r\n    capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing\r\n    picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt\r\n    occaecat lorem meatball prosciutto quis strip steak.\r\n    Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak\r\n    mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon\r\n    strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur\r\n    cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck\r\n    fugiat.', '2019-04-11 14:13:44', '2019-04-12 14:13:44', 137, 235),
(197, 'Backflip-22', 'backflip-22', '    Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,\r\n    lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit\r\n    labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow\r\n    **turkey** shank eu pork belly meatball non cupim.\r\n    Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur\r\n    laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,\r\n    capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing\r\n    picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt\r\n    occaecat lorem meatball prosciutto quis strip steak.\r\n    Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak\r\n    mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon\r\n    strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur\r\n    cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck\r\n    fugiat.', '2019-04-13 14:13:44', '2019-04-09 14:13:44', 132, 238),
(199, 'Backflip-24', 'backflip-24', '    Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,\r\n    lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit\r\n    labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow\r\n    **turkey** shank eu pork belly meatball non cupim.\r\n    Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur\r\n    laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,\r\n    capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing\r\n    picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt\r\n    occaecat lorem meatball prosciutto quis strip steak.\r\n    Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak\r\n    mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon\r\n    strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur\r\n    cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck\r\n    fugiat.', '2019-04-03 14:13:44', '2019-05-24 14:13:44', 138, 239),
(200, 'Backflip-25', 'backflip-25', '    Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,\r\n    lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit\r\n    labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow\r\n    **turkey** shank eu pork belly meatball non cupim.\r\n    Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur\r\n    laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,\r\n    capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing\r\n    picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt\r\n    occaecat lorem meatball prosciutto quis strip steak.\r\n    Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak\r\n    mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon\r\n    strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur\r\n    cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck\r\n    fugiat.', '2019-04-17 14:13:44', '2019-04-15 14:13:44', 138, 238),
(201, 'Backflip-26', 'backflip-26', '    Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,\r\n    lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit\r\n    labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow\r\n    **turkey** shank eu pork belly meatball non cupim.\r\n    Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur\r\n    laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,\r\n    capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing\r\n    picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt\r\n    occaecat lorem meatball prosciutto quis strip steak.\r\n    Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak\r\n    mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon\r\n    strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur\r\n    cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck\r\n    fugiat.', '2019-05-09 14:13:44', '2019-06-13 14:13:44', 133, 232),
(202, 'Backflip-27', 'backflip-27', '    Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,\r\n    lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit\r\n    labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow\r\n    **turkey** shank eu pork belly meatball non cupim.\r\n    Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur\r\n    laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,\r\n    capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing\r\n    picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt\r\n    occaecat lorem meatball prosciutto quis strip steak.\r\n    Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak\r\n    mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon\r\n    strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur\r\n    cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck\r\n    fugiat.', '2019-06-06 14:13:44', '2019-06-09 14:13:44', 136, 237),
(203, 'Backflip-28', 'backflip-28', '    Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,\r\n    lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit\r\n    labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow\r\n    **turkey** shank eu pork belly meatball non cupim.\r\n    Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur\r\n    laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,\r\n    capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing\r\n    picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt\r\n    occaecat lorem meatball prosciutto quis strip steak.\r\n    Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak\r\n    mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon\r\n    strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur\r\n    cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck\r\n    fugiat.', '2019-06-22 14:13:44', '2019-04-12 14:13:44', 133, 231),
(204, 'Backflip-29', 'backflip-29', '    Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,\r\n    lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit\r\n    labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow\r\n    **turkey** shank eu pork belly meatball non cupim.\r\n    Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur\r\n    laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,\r\n    capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing\r\n    picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt\r\n    occaecat lorem meatball prosciutto quis strip steak.\r\n    Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak\r\n    mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon\r\n    strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur\r\n    cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck\r\n    fugiat.', '2019-04-09 14:13:44', '2019-05-04 14:13:44', 141, 234),
(206, 'Backflip-31', 'backflip-31', '    Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,\r\n    lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit\r\n    labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow\r\n    **turkey** shank eu pork belly meatball non cupim.\r\n    Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur\r\n    laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,\r\n    capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing\r\n    picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt\r\n    occaecat lorem meatball prosciutto quis strip steak.\r\n    Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak\r\n    mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon\r\n    strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur\r\n    cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck\r\n    fugiat.', '2019-06-03 14:13:44', '2019-04-09 14:13:44', 132, 231),
(208, 'Backflip-33', 'backflip-33', '    Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,\r\n    lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit\r\n    labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow\r\n    **turkey** shank eu pork belly meatball non cupim.\r\n    Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur\r\n    laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,\r\n    capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing\r\n    picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt\r\n    occaecat lorem meatball prosciutto quis strip steak.\r\n    Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak\r\n    mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon\r\n    strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur\r\n    cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck\r\n    fugiat.', '2019-06-16 14:13:44', '2019-06-19 14:13:44', 141, 230),
(209, 'Backflip-34', 'backflip-34', '    Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,\r\n    lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit\r\n    labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow\r\n    **turkey** shank eu pork belly meatball non cupim.\r\n    Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur\r\n    laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,\r\n    capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing\r\n    picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt\r\n    occaecat lorem meatball prosciutto quis strip steak.\r\n    Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak\r\n    mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon\r\n    strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur\r\n    cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck\r\n    fugiat.', '2019-06-08 14:13:44', '2019-04-20 14:13:44', 140, 230),
(212, 'Backflip-37', 'backflip-37', '    Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,\r\n    lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit\r\n    labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow\r\n    **turkey** shank eu pork belly meatball non cupim.\r\n    Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur\r\n    laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,\r\n    capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing\r\n    picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt\r\n    occaecat lorem meatball prosciutto quis strip steak.\r\n    Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak\r\n    mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon\r\n    strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur\r\n    cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck\r\n    fugiat.', '2019-04-26 14:13:44', '2019-06-08 14:13:44', 136, 230),
(213, 'Backflip-38', 'backflip-38', '    Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,\r\n    lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit\r\n    labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow\r\n    **turkey** shank eu pork belly meatball non cupim.\r\n    Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur\r\n    laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,\r\n    capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing\r\n    picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt\r\n    occaecat lorem meatball prosciutto quis strip steak.\r\n    Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak\r\n    mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon\r\n    strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur\r\n    cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck\r\n    fugiat.', '2019-05-22 14:13:44', '2019-06-24 14:13:44', NULL, 239),
(214, 'Backflip-39', 'backflip-39', '    Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,\r\n    lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit\r\n    labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow\r\n    **turkey** shank eu pork belly meatball non cupim.\r\n    Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur\r\n    laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,\r\n    capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing\r\n    picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt\r\n    occaecat lorem meatball prosciutto quis strip steak.\r\n    Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak\r\n    mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon\r\n    strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur\r\n    cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck\r\n    fugiat.', '2019-05-27 14:13:44', '2019-04-22 14:13:44', 135, 230),
(215, 'Backflip-40', 'backflip-40', '    Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,\r\n    lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit\r\n    labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow\r\n    **turkey** shank eu pork belly meatball non cupim.\r\n    Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur\r\n    laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,\r\n    capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing\r\n    picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt\r\n    occaecat lorem meatball prosciutto quis strip steak.\r\n    Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak\r\n    mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon\r\n    strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur\r\n    cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck\r\n    fugiat.', '2019-05-19 14:13:44', '2019-04-20 14:13:44', 133, 234),
(216, 'Backflip-41', 'backflip-41', '    Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,\r\n    lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit\r\n    labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow\r\n    **turkey** shank eu pork belly meatball non cupim.\r\n    Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur\r\n    laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,\r\n    capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing\r\n    picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt\r\n    occaecat lorem meatball prosciutto quis strip steak.\r\n    Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak\r\n    mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon\r\n    strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur\r\n    cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck\r\n    fugiat.', '2019-05-20 14:13:44', '2019-06-20 14:13:44', 136, 237),
(217, 'Backflip-42', 'backflip-42', '    Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,\r\n    lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit\r\n    labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow\r\n    **turkey** shank eu pork belly meatball non cupim.\r\n    Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur\r\n    laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,\r\n    capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing\r\n    picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt\r\n    occaecat lorem meatball prosciutto quis strip steak.\r\n    Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak\r\n    mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon\r\n    strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur\r\n    cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck\r\n    fugiat.', '2019-04-25 14:13:44', '2019-06-13 14:13:44', 136, 231);
INSERT INTO `trick` (`id`, `name`, `slug`, `description`, `published_at`, `updated_at`, `author_name_id`, `category_id`) VALUES
(218, 'Backflip-43', 'backflip-43', '    Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,\r\n    lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit\r\n    labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow\r\n    **turkey** shank eu pork belly meatball non cupim.\r\n    Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur\r\n    laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,\r\n    capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing\r\n    picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt\r\n    occaecat lorem meatball prosciutto quis strip steak.\r\n    Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak\r\n    mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon\r\n    strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur\r\n    cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck\r\n    fugiat.', '2019-04-09 14:13:44', '2019-04-13 14:13:44', 136, 235),
(219, 'Backflip-44', 'backflip-44', '    Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,\r\n    lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit\r\n    labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow\r\n    **turkey** shank eu pork belly meatball non cupim.\r\n    Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur\r\n    laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,\r\n    capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing\r\n    picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt\r\n    occaecat lorem meatball prosciutto quis strip steak.\r\n    Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak\r\n    mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon\r\n    strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur\r\n    cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck\r\n    fugiat.', '2019-05-25 14:13:44', '2019-04-11 14:13:44', 137, 233),
(220, 'Backflip-45', 'backflip-45', '    Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,\r\n    lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit\r\n    labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow\r\n    **turkey** shank eu pork belly meatball non cupim.\r\n    Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur\r\n    laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,\r\n    capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing\r\n    picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt\r\n    occaecat lorem meatball prosciutto quis strip steak.\r\n    Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak\r\n    mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon\r\n    strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur\r\n    cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck\r\n    fugiat.', '2019-04-03 14:13:44', '2019-05-13 14:13:44', 139, 230),
(221, 'Backflip-46', 'backflip-46', '    Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,\r\n    lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit\r\n    labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow\r\n    **turkey** shank eu pork belly meatball non cupim.\r\n    Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur\r\n    laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,\r\n    capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing\r\n    picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt\r\n    occaecat lorem meatball prosciutto quis strip steak.\r\n    Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak\r\n    mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon\r\n    strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur\r\n    cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck\r\n    fugiat.', '2019-04-26 14:13:44', '2019-04-11 14:13:44', 140, 239),
(223, 'Backflip-48', 'backflip-48', '    Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,\r\n    lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit\r\n    labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow\r\n    **turkey** shank eu pork belly meatball non cupim.\r\n    Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur\r\n    laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,\r\n    capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing\r\n    picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt\r\n    occaecat lorem meatball prosciutto quis strip steak.\r\n    Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak\r\n    mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon\r\n    strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur\r\n    cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck\r\n    fugiat.', '2019-06-11 14:13:44', '2019-04-12 14:13:44', 138, 234),
(224, 'Backflip-49', 'backflip-49', '    Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,\r\n    lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit\r\n    labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow\r\n    **turkey** shank eu pork belly meatball non cupim.\r\n    Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur\r\n    laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,\r\n    capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing\r\n    picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt\r\n    occaecat lorem meatball prosciutto quis strip steak.\r\n    Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak\r\n    mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon\r\n    strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur\r\n    cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck\r\n    fugiat.', '2019-05-08 14:13:44', '2019-05-01 14:13:44', 132, 235),
(229, 'Essai2', 'essai2', 'OK', '2019-07-18 09:57:11', '2019-07-18 09:57:11', 145, 230),
(231, 'Test 21', 'test-21', 'Figure de test\r\nTest', '2019-07-31 14:06:27', '2019-07-31 14:10:40', 145, 237),
(232, 'Test', 'test', 'Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,\r\nlorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit\r\nlabore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow **turkey**shank eu pork belly meatball non cupim.Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip', '2019-08-01 14:06:56', '2019-08-02 08:02:02', 145, 230);

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
(231, 125),
(231, 127),
(232, 128);

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
(180, 104),
(184, 104),
(195, 104),
(200, 104),
(212, 104),
(229, 118),
(229, 119),
(231, 123),
(231, 124);

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
) ENGINE=InnoDB AUTO_INCREMENT=147 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(145, 'quentinboinet', '[]', 'quentinboinet@live.fr', 'Boinet', 'Quentin', '$2y$13$d/P//0rGvcxIRSEnOv67Ku.6aBFBy4N3dCKjuqI5LtfVV7Wob2wYO', 1, 122),
(146, 'quentin', '[]', 'quentin@activup.net', NULL, NULL, '$2y$13$iTY453He4SFZxc6Jm4aVfuW8xKrR82.uK1vXZ6HDF9SNyd3nFflBe', 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `video`
--

DROP TABLE IF EXISTS `video`;
CREATE TABLE IF NOT EXISTS `video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `video`
--

INSERT INTO `video` (`id`, `url`) VALUES
(104, 'https://www.youtube.com/embed/dSZ7_TXcEdM'),
(116, 'Lien 1'),
(117, 'htttp://youtube.fr'),
(118, 'https://player.vimeo.com/video/6969232737373733383782383273287328327342873'),
(119, 'https://www.youtube.com/embed/123456789012'),
(123, 'https://www.youtube.com/embed/dxyZ6BB9trI'),
(124, 'https://www.youtube.com/embed/dxyZ6BB9trI');

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
