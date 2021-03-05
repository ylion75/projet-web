-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 05 mars 2021 à 12:29
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `reddit`
--

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) NOT NULL,
  `password` varchar(80) NOT NULL,
  `email` varchar(70) NOT NULL,
  `avatar` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

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
(17, 'testmdp', '$2y$10$O8RGggnn68bHrqUPqRwkOukpR4Z1L0qKznAskWDE11jPqCWni8It2', 'mdp@mdp', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
