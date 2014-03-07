-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 07 Mars 2014 à 04:01
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `cortex`
--
CREATE DATABASE IF NOT EXISTS `cortex` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cortex`;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id_Cat` int(255) NOT NULL AUTO_INCREMENT,
  `nom_Cat` varchar(255) NOT NULL,
  `avancement` int(255) NOT NULL,
  PRIMARY KEY (`id_Cat`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id_Cat`, `nom_Cat`, `avancement`) VALUES
(1, 'Musique', 0),
(2, 'Arts-Littérature', 0),
(3, 'Sciences', 0),
(4, 'Geek', 0),
(5, 'Divertissement', 0),
(6, 'Sport', 0);

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `id_Question` int(11) NOT NULL AUTO_INCREMENT,
  `id_User` int(255) NOT NULL,
  `Pseudo` varchar(255) NOT NULL,
  `Question` varchar(256) NOT NULL,
  `Reponse` varchar(256) NOT NULL,
  `id_Cat` int(255) NOT NULL,
  `nomDefi` varchar(256) NOT NULL,
  `Message` varchar(255) NOT NULL,
  `id_User2` int(255) NOT NULL,
  `Reponse_User2` varchar(256) NOT NULL,
  `Image` varchar(255) NOT NULL,
  PRIMARY KEY (`id_Question`),
  UNIQUE KEY `id_Question` (`id_Question`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=199 ;

--
-- Contenu de la table `question`
--

INSERT INTO `question` (`id_Question`, `id_User`, `Pseudo`, `Question`, `Reponse`, `id_Cat`, `nomDefi`, `Message`, `id_User2`, `Reponse_User2`, `Image`) VALUES
(2, 1, 'laura', 'Quelle est l''émission d''actualité qui passe le samedi soir sur France 2 ?', 'On n''est pas couché', 5, 'Ton premier défi', 'coucou c''est moi !', 2, '', ''),
(8, 1, 'laura', 'Quel est le sport qui a eu 2 médailles dans la même course aux JO ?', 'biathlon', 6, 'Le défi sportif', '', 2, '', 'public/assets/sochi.jpg'),
(13, 2, 'seb', 'Quel est le nombre de médailles françaises aux JO de Sotchi ?', '15', 6, 'Défi mathématique', 'Yep, voila un beau défi.', 1, '', ''),
(14, 2, 'seb', 'Quelle force est exercée sur un corps dans l''eau ?', 'la poussée d''archimède', 5, 'Défi sciences', 'petit message pour te dire que ma question est super dure ahah', 1, '', 'public/assets/bateau.jpg'),
(15, 2, 'seb', 'Quel est le nom du chanteur de U2 ?', 'bono', 4, 'chanteur VS groupe', 'salut, voici un défi assez facile.', 1, '', 'public/assets/bono.jpg'),
(26, 1, 'laura', 'Quel est la loi physique que Newton a inventée ?', 'gravité', 3, 'THE super défi', 'alors c''est dur ?', 2, '', ''),
(27, 1, 'laura', 'Quel est le nom de cet animal ?', 'manchot', 3, 'Défi animalier', 'Coucou, j''espère que tu trouveras la réponse !', 2, '', 'public/assets/penguins.jpg'),
(192, 57, 'monsieur', 'qui est représenté sur cette photo?', 'tulipe', 5, 'défi1', 'bonne chance', 2, '', 'public/assets/tulips.jpg'),
(193, 58, 'madam', 'ertge?', 'tttttttttttttttttgyyyyyyyyyyy', 3, 'dsrg', 'hello', 4, '', ''),
(194, 1, 'laura', 'Quel est le nom de l''inventeur du célèbre réseau social ?', 'Zuckerberg', 4, 'Histoire d''un réseau', 'Hey c''est facile comme question ! ', 2, '', ''),
(198, 2, 'seb', 'Quelle est la couleur du cheval blanc d''Henri IV ?', 'blanc', 5, 'Défi archi classique', 'Hey, cette question est posée 100 mille fois à un enfant de 5 ans.', 1, '', 'public/assets/henri.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_User` int(40) NOT NULL AUTO_INCREMENT,
  `Pseudo` varchar(256) NOT NULL,
  `Mdp` varchar(256) NOT NULL,
  `Email` varchar(256) NOT NULL,
  `img_Profil` varchar(256) NOT NULL,
  `Niveau` int(11) NOT NULL,
  PRIMARY KEY (`id_User`),
  UNIQUE KEY `Pseudo` (`Pseudo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=66 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id_User`, `Pseudo`, `Mdp`, `Email`, `img_Profil`, `Niveau`) VALUES
(1, 'laura', 'f4f263e439cf40925e6a412387a9472a6773c2580212a4fb50d224d3a817de17', 'laura@laura.fr', 'public/assets/ao-laura.png', 3),
(2, 'seb', 'f4f263e439cf40925e6a412387a9472a6773c2580212a4fb50d224d3a817de17', 'seb@seb.fr', 'public/assets/defaut-profil.jpg', 5),
(3, 'pierre', 'd5a5d66b94e8da0cf63d4cd6d66cd489d78e77b697039c6c48e3ff8d81752139', 'pierre@pierre.fr', '', 0),
(4, 'julien', 'e23c3d7ff76f6e6235ce091f2fcd5fd35748677799d1637acf5ba2bca350e258', 'julien@julien.fr', '', 0),
(5, 'frantz', '8580b174437b92e5c3c0ef894b84a3a019438c8b4191d5a116faa51e55b0166c', 'frantz@frantz.fr', '', 0),
(6, 'bernard', 'dc814a25c3ae905ad4ba942072b101599f8e7c3617c79e3b10e9c20ca8952339', 'bernard@bernard.fr', '', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
