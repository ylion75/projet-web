-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  sam. 20 mars 2021 à 23:27
-- Version du serveur :  10.4.6-MariaDB
-- Version de PHP :  7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `reddit`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `descriptif` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`, `descriptif`) VALUES
(1, 'Jeux Vidéo', 'gaming: jeux PC, jeux console, etc...'),
(2, 'Monde', 'sujets internationaux'),
(3, 'Animaux', NULL),
(4, 'Arts', NULL),
(5, 'Photos', NULL),
(6, 'Cinéma', NULL),
(7, 'Sport', NULL),
(8, 'Autre', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `content` text DEFAULT NULL,
  `author` int(11) NOT NULL,
  `date` date NOT NULL,
  `parent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`comment_id`, `content`, `author`, `date`, `parent_id`) VALUES
(1, 'coucou!', 1, '2021-02-16', 1),
(2, 'salut!', 1, '2021-02-17', 2),
(9, 'hello', 1, '2021-03-03', 1),
(10, 'salut!', 18, '2021-03-11', 1),
(11, 'zerez', 19, '2021-03-14', 1),
(12, 'zerez', 19, '2021-03-14', 1),
(13, 'coucou !!!', 19, '2021-03-14', 11),
(14, 'erezr', 19, '2021-03-15', 19),
(15, 'dvgfdr', 19, '2021-03-15', 1),
(16, 'efez', 20, '2021-03-15', 21),
(17, 'trhjtyj', 19, '2021-03-16', 1),
(18, 'yjy', 19, '2021-03-16', 1),
(19, 'thrthr', 21, '2021-03-17', 2),
(20, 'rthrthrh', 19, '2021-03-17', 3),
(21, 'ghcvgh', 19, '2021-03-20', 1),
(22, 'ghcvgh', 19, '2021-03-20', 1),
(23, NULL, 19, '2021-03-20', 1),
(24, 'coucou', 19, '2021-03-20', 1);

-- --------------------------------------------------------

--
-- Structure de la table `dislikes`
--

CREATE TABLE `dislikes` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `dislikes`
--

INSERT INTO `dislikes` (`post_id`, `user_id`) VALUES
(1, 19),
(1, 21),
(2, 21),
(3, 19),
(27, 19);

-- --------------------------------------------------------

--
-- Structure de la table `forum`
--

CREATE TABLE `forum` (
  `idForum` int(11) NOT NULL,
  `nomForum` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `admin` int(11) NOT NULL,
  `dateCreation` date NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `categorie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `forum`
--

INSERT INTO `forum` (`idForum`, `nomForum`, `admin`, `dateCreation`, `description`, `categorie_id`) VALUES
(1, 'Nintendo', 1, '2021-03-14', 'Parlons des produits de la franchise Nintendo !', 1),
(2, 'Nouvelles du monde', 1, '2021-03-14', 'news internationales', 2),
(3, 'Bons petits plats', 4, '2021-03-14', 'recettes de cuisines, miam !', 8),
(4, 'Marathon', 3, '2021-03-14', '....', 7);

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

CREATE TABLE `likes` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `likes`
--

INSERT INTO `likes` (`post_id`, `user_id`) VALUES
(1, 19),
(1, 21),
(2, 19),
(2, 21),
(3, 19),
(4, 21),
(27, 19);

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` text DEFAULT NULL,
  `date` date NOT NULL,
  `author` int(11) NOT NULL,
  `forum_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `title`, `content`, `date`, `author`, `forum_id`) VALUES
(1, 'First post ever !', 'Hello', '2021-02-03', 1, 1),
(2, 'Second post huh', 'good mood over here !', '2021-02-03', 2, 1),
(3, 'Love jojo', 'title', '2021-02-04', 1, 2),
(4, 'test', 'blabla', '2021-02-03', 3, 1),
(5, 'test2', 'blabla2', '2021-02-03', 3, 0),
(6, 'test3', 'blabla3', '2021-02-03', 3, 0),
(25, 'rtghrth', 'thrtht', '2021-03-17', 19, 2),
(27, 'lol', '', '2021-03-20', 19, 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `login` varchar(20) NOT NULL,
  `password` varchar(80) NOT NULL,
  `email` varchar(70) NOT NULL,
  `avatar` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `email`, `avatar`) VALUES
(1, 'jojo', 'lion', '', ''),
(2, 'jotaro', 'kujo', '', ''),
(3, 'jonathan', 'joestar', '', ''),
(12, 'test03031', '$2y$10$xJTGxsq5g2p9hgdtfpD15.7O5nB18X/gvFi/2AwUsuAv6KxmCueBW', 'test@im2', NULL),
(13, 'test03032', '$2y$10$0tDLIEn5VAP2Qni1QXwG1ORaXfZI/.2MbRCkkAf8yoCFTS9DKlagy', 'test@im2', NULL),
(14, 'testpsg', '$2y$10$b14b1xCiaoWNKYd5MmUJg.HRX3Y7XieaS0NEYfLeHKOZJq3/dIIzC', '123@psg', NULL),
(15, 'micheltest', '$2y$10$.1gIR4hCfb0m8UuxIjSzI.82a8f/x/vd0d0pZ9ixBTa3XcynwhPnG', '123@michel', NULL),
(16, 'test@jojo', '$2y$10$3KjobBgdenHT7pgO7qcWMeJcTErHKgBv8L4Orf46jyp.Xot3D/WEK', 'jojo@lion', NULL),
(17, 'testmdp', '$2y$10$O8RGggnn68bHrqUPqRwkOukpR4Z1L0qKznAskWDE11jPqCWni8It2', 'mdp@mdp', NULL),
(18, 'julliah', '$2y$10$xtfxOaHyXNVhI1atENMbAe/4sS.fwIuP67clBwKGjIDey5pL51N4.', 'julliahsothiraj@gmail.com', NULL),
(19, 'guest', '$2y$10$e5QHbOPvqjteG0RK8fmqteSvQ4gsd7/N1NuY4zJA5QuhmRVCZWaNe', '12345@guest', NULL),
(20, 'guest2', '$2y$10$sz7WM.8xnnEgN/vvGeUrouQwzO2XIsrNig7FgH.DYDJJOdqUwOoPO', 'guest2@1234.fr', NULL),
(21, 'guest4', '$2y$10$LtL9dhI0EucRuLUfF5/qtOJZWXVGPuvQ5tZsaXZUGzhqMzeEqXyMu', 'guest4@1234.fr', NULL),
(25, 'guest5', '$2y$10$bdUC5MTrjQLGn5poEKNeW.RoIGzK/b2UQ56f/8l8vfB7xaOHP7U8S', 'guest5@12345', 'NULL'),
(26, 'guest6', '$2y$10$BtmvrWyJ6vylg1bMKtN.dez8n5cvHFJ0IbsAwZYNV1zCZo0q9OZyy', 'guest6@123456', 'NULL');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `author` (`author`),
  ADD KEY `id` (`parent_id`) USING BTREE;

--
-- Index pour la table `dislikes`
--
ALTER TABLE `dislikes`
  ADD PRIMARY KEY (`post_id`,`user_id`),
  ADD KEY `fk_userId` (`user_id`),
  ADD KEY `fk_postId` (`post_id`);

--
-- Index pour la table `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`idForum`),
  ADD KEY `FKcategorie` (`categorie_id`);

--
-- Index pour la table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`post_id`,`user_id`),
  ADD KEY `fk_user_id` (`user_id`),
  ADD KEY `fk_post_id` (`post_id`);

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_author` (`author`),
  ADD KEY `forum_id` (`forum_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `forum`
--
ALTER TABLE `forum`
  MODIFY `idForum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `dislikes`
--
ALTER TABLE `dislikes`
  ADD CONSTRAINT `fk_postId` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_userId` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `fk_post_id` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
